<?php

namespace App\Console\Commands;

use App;
use File;
use Storage;
use Illuminate\Console\Command;

class Validation extends Command
{
    protected $stub;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:validation {name} {rules?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new validation class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $rules = $this->argument('rules');

        $stub = $this->getStub();

        $stub = str_replace('DummyClass', studly_case($name), $stub);
        $stub = str_replace('DummyRules', "'" . implode("',\n'", $rules) . "'", $stub);
        $stub = str_replace('DummyNamespace', App::getNamespace() . 'Validations', $stub);

        $this->generateFile($stub);
    }

    private function generateFile($content)
    {
        $written = Storage::disk('app')
            ->put('Validations/' . studly_case($this->argument('name')) . '.php', $content);

        if ($written) {
            $message = 'Created new validation '
                . $this->argument('name') . '.php in '
                . App::getNamespace() . '\Validations.';

            $this->info($message);
        } else {
            $this->info('Something went wrong');
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return File::get(__DIR__ . '/stubs/validation.stub');
    }
}
