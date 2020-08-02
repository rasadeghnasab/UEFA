<?php

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    public function truncateTable($table)
    {
        $tables = is_array($table) ? $table : [$table];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($tables as $table) {
            $this->command->getOutput()->writeln("<comment>Truncating:</comment>  {$table}");
            DB::table($table)->truncate();
            $this->command->getOutput()->writeln("<info>Truncated:</info>  {$table}");
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
