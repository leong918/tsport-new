<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeds matches with real uploaded images
     */
    public function run(): void
    {
        // Get the SQL file path
        $sqlFilePath = database_path('seeders/sql/matches_backup.sql');
        
        if (!file_exists($sqlFilePath)) {
            $this->command->error("SQL file not found: {$sqlFilePath}");
            return;
        }

        // Read and process the SQL file
        $sql = file_get_contents($sqlFilePath);
        
        // Remove comments (lines starting with --)
        $cleanSql = preg_replace('/^--.*$/m', '', $sql);
        
        // Split into statements by semicolon
        $statements = array_filter(
            array_map('trim', explode(';', $cleanSql)),
            function($statement) {
                return !empty($statement);
            }
        );

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        try {
            // Execute each statement
            foreach ($statements as $statement) {
                if (!empty(trim($statement))) {
                    DB::statement($statement);
                }
            }
            
            $this->command->info('Matches seeded successfully from backup file');
            $this->command->info('✅ All matches have proper uploaded images');
            
        } catch (\Exception $e) {
            $this->command->error('Error restoring matches: ' . $e->getMessage());
        } finally {
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
