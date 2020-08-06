<?php

namespace App\Models;

use App\Enums\LevelsEnum;
use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\TournamentTeamInterface;
use Exception;

class Schedule extends Model implements TournamentTeamInterface
{
    protected $fillable = ['competition_id', 'level', 'group', 'home_id', 'away_id', 'home_goals', 'away_goals', 'winner_id', 'due_date'];

    protected $dates = ['due_date',];

    protected $levelsOrder = [
        LevelsEnum::Group => LevelsEnum::OneEighth,
        LevelsEnum::OneEighth => LevelsEnum::OneFourth,
        LevelsEnum::OneFourth => LevelsEnum::SemiFinal,
        LevelsEnum::SemiFinal => LevelsEnum::Final,
    ];

    public function home()
    {
        return $this->belongsTo(Team::class, 'home_id');
    }

    public function away()
    {
        return $this->belongsTo(Team::class, 'away_id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function redrawTable()
    {
        if (!$this->levelGamesFinished() || in_array($this->level, [LevelsEnum::Final, LevelsEnum::Classfication])) {
            return;
        }

        // schedule next level games
        $nextLevelSchedule = sprintf('schedule%sLevel', ucfirst($this->nextLevel()));

        if (!method_exists($this, $nextLevelSchedule)) {
            throw new Exception(sprintf('You should implement %s in the class %', $nextLevelSchedule, __CLASS__));
        }

        $this->$nextLevelSchedule();
    }

    public function nextLevel()
    {
        return $this->levelsOrder[$this->level];
    }

    private function calculateLevelFinalScores()
    {
        $matches = self::query()
            ->where('level', $this->level)
            ->where('competition_id', $this->competition_id)
            ->get();

        $level_final_scores = [];
        foreach ($matches as $match) {
            $level_final_scores[$match->group][$match->home_id] = $level_final_scores[$match->group][$match->home_id] ?? 0;
            $level_final_scores[$match->group][$match->away_id] = $level_final_scores[$match->group][$match->away_id] ?? 0;

            $home_points = $away_points = 1;
            if ($match->winner_id == $match->home_id) {
                $home_points = 3;
                $away_points = 0;
            } elseif ($match->winner_id == $match->away_id) {
                $home_points = 0;
                $away_points = 3;
            }

            $level_final_scores[$match->group][$match->home_id] = $level_final_scores[$match->group][$match->home_id] + $home_points;
            $level_final_scores[$match->group][$match->away_id] = $level_final_scores[$match->group][$match->away_id] + $away_points;
        }

        return $level_final_scores;
    }

    private function scheduleFinalLevel()
    {
        $level_final_scores = $this->calculateLevelFinalScores();

        $finalist = [];
        $classification = [];
        foreach ($level_final_scores as $group_scores) {
            arsort($group_scores);
            $teams_id = array_keys($group_scores);
            $finalist[] = $teams_id[0];
            $classification[] = $teams_id[1];
        }

        $this->fillSchedules([$classification[0]], [$classification[1]], LevelsEnum::Classfication);
        $this->fillSchedules([$finalist[0]], [$finalist[1]], LevelsEnum::Final);
    }

    private function scheduleSemiFinalLevel()
    {
        $level_final_scores = $this->calculateLevelFinalScores();

        $teams_go_to_next_level = [];
        foreach ($level_final_scores as $group_scores) {
            arsort($group_scores);
            $teams_id = array_keys($group_scores);
            $teams_go_to_next_level[] = $teams_id[0];
        }
        $chunked_teams = array_chunk($teams_go_to_next_level, count($teams_go_to_next_level) / 2);

        $this->fillSchedules($chunked_teams[0], $chunked_teams[1]);
    }

    private function scheduleRoundEightLevel()
    {
        $level_final_scores = $this->calculateLevelFinalScores();

        $teams_go_to_next_level = [];
        foreach ($level_final_scores as $group_scores) {
            arsort($group_scores);
            $teams_id = array_keys($group_scores);
            $teams_go_to_next_level[] = $teams_id[0];
        }
        $chunked_teams = array_chunk($teams_go_to_next_level, count($teams_go_to_next_level) / 2);

        $this->fillSchedules($chunked_teams[0], $chunked_teams[1]);
    }

    private function scheduleRoundSixteenLevel()
    {
        $level_final_scores = $this->calculateLevelFinalScores();

        $teams_go_to_next_level = [
            'a' => [],
            'b' => [],
        ];
        foreach ($level_final_scores as $group_scores) {
            arsort($group_scores);
            $teams_id = array_keys($group_scores);
            $teams_go_to_next_level['a'][] = $teams_id[0];
            $teams_go_to_next_level['b'][] = $teams_id[1];
        }
        shuffle($teams_go_to_next_level['a']);
        shuffle($teams_go_to_next_level['b']);

        $this->fillSchedules($teams_go_to_next_level['a'], $teams_go_to_next_level['b']);
    }

    private function fillSchedules(array $teams_a, array $teams_b, string $next_level = null): void
    {
        $grouped_schedules = self::where('competition_id', $this->competition_id)
            ->where('level', $next_level ?? $this->nextLevel())
            ->orderBy('group')->get()->groupBy('group');

        try {
            foreach ($grouped_schedules as $group_name => $schedules) {
                $team_a = array_shift($teams_a);
                $team_b = array_shift($teams_b);

                $schedules[0]->home_id = $team_b;
                $schedules[0]->away_id = $team_a;
                $schedules[0]->save();

                if (isset($schedules[1])) {
                    $schedules[1]->home_id = $team_a;
                    $schedules[1]->away_id = $team_b;
                    $schedules[1]->save();
                }
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function levelGamesFinished(): bool
    {
        return self::query()
            ->where('group', $this->group)
            ->where('level', $this->level)
            ->where('competition_id', $this->competition_id)
            ->whereNull('home_goals')
            ->whereNull('away_goals')
            ->count() == 0;
    }

    public function levelFinalResult()
    {
        return false;
    }

    public function lastXResults(Team $team, int $maches_to_look_back = 1): Collection
    {
        return $this
            ->where('competition_id', $this->competition_id)
            ->where(function ($query) use ($team) {
                $query->where('home_id', $team->id)->orWhere('away_id', $team->id);
            })
            ->orderBy('due_date', 'desc')
            ->limit($maches_to_look_back)
            ->get();
    }
}
