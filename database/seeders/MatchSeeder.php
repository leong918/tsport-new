<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sqlFile = database_path('seeders/sql/matches_backup.sql');
        
        if (!file_exists($sqlFile)) {
            $this->command->error('SQL file not found: ' . $sqlFile);
            return;
        }

        $this->command->info('Loading match data from SQL backup...');

        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Read SQL file
        $sql = file_get_contents($sqlFile);
        
        // Remove UTF-8 BOM if present
        $sql = str_replace("\xEF\xBB\xBF", '', $sql);
        
        // Remove comments
        $sql = preg_replace('/^--.*$/m', '', $sql);
        
        // Execute the entire SQL content
        try {
            DB::unprepared($sql);
            $this->command->info('SQL statements executed successfully.');
        } catch (\Exception $e) {
            $this->command->error('Error executing SQL: ' . $e->getMessage());
        }
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $count = DB::table('match')->count();
        $this->command->info("Match table seeded successfully with {$count} records from SQL backup.");
    }
}
