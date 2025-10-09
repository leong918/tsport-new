<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder reads directly from the SQL backup file.
     */
    public function run(): void
    {
        $sqlBackupFile = database_path('seeders/sql/events_backup.sql');
        
        if (!File::exists($sqlBackupFile)) {
            $this->command->error("SQL backup file not found: {$sqlBackupFile}");
            return;
        }

        // Read and execute the SQL file
        $sql = File::get($sqlBackupFile);
        
        // Remove comments first
        $lines = explode("\n", $sql);
        $cleanLines = array_filter($lines, function($line) {
            $line = trim($line);
            return !empty($line) && !str_starts_with($line, '--');
        });
        $cleanSql = implode("\n", $cleanLines);
        
        // Split by semicolons and execute each statement
        $statements = array_filter(
            array_map('trim', explode(';', $cleanSql)),
            function ($statement) {
                return !empty($statement);
            }
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        foreach ($statements as $statement) {
            if (!empty($statement)) {
                try {
                    DB::statement($statement);
                } catch (\Exception $e) {
                    $this->command->error("Error executing statement: " . $e->getMessage());
                    $this->command->error("Statement: " . $statement);
                }
            }
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Events seeded successfully from SQL backup file');
    }
}
