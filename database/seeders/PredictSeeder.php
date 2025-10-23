<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Predict;
use App\Models\Matches;
use Illuminate\Support\Facades\DB;

class PredictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Try to load from SQL backup first
        $sqlFile = database_path('seeders/sql/predict_backup.sql');
        
        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            
            // Check if SQL file has INSERT statements
            if (str_contains($sql, 'INSERT INTO')) {
                $this->command->info('Loading predict data from SQL backup...');
                
                // Disable foreign key checks temporarily
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                
                // Remove UTF-8 BOM if present
                $sql = str_replace("\xEF\xBB\xBF", '', $sql);
                
                // Remove comments
                $sql = preg_replace('/^--.*$/m', '', $sql);
                
                // Execute SQL
                try {
                    DB::unprepared($sql);
                    $this->command->info('SQL statements executed successfully.');
                } catch (\Exception $e) {
                    $this->command->error('Error executing SQL: ' . $e->getMessage());
                }
                
                // Re-enable foreign key checks
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                
                $count = DB::table('predict')->count();
                $this->command->info("Predict table seeded successfully with {$count} records from SQL backup.");
                return;
            }
        }
        
        // If no SQL backup or empty, create sample data
        $this->command->info('No SQL backup found or empty. Creating sample predict data...');
        
        // Get some matches to work with
        $matches = Matches::where('status', 1)->limit(3)->get();
        
        if ($matches->isEmpty()) {
            $this->command->warn('No active matches found. Please create some matches first.');
            return;
        }
        
        $expertNames = ['Expert1', 'Expert2', 'Expert3', 'Analyst A', 'Analyst B'];
        $sampleImages = [
            'predicts/sample1.png',
            'predicts/sample2.png',
            'predicts/sample3.png',
        ];
        
        foreach ($matches as $match) {
            // Create 2-3 predictions per match
            $predictCount = rand(2, 3);
            
            for ($i = 0; $i < $predictCount; $i++) {
                Predict::create([
                    'match_id' => $match->id,
                    'character_name' => $expertNames[array_rand($expertNames)],
                    'image' => $sampleImages[array_rand($sampleImages)],
                    'description' => '<h4><strong>Match Prediction Analysis</strong></h4>
<p><strong>Key Points:</strong> This is a detailed analysis of the match based on team performance, recent form, and head-to-head records.</p>
<p><strong>Prediction:</strong> We expect a competitive match with both teams showing strong form. The key will be the midfield battle and defensive organization.</p>
<p><strong>Conclusion:</strong> This should be an exciting match for fans, with both teams eager to secure the points.</p>',
                    'status' => 1,
                    'like_count' => rand(0, 10),
                    'created_at' => now()->subDays(rand(1, 7)),
                    'updated_at' => now(),
                ]);
            }
        }
        
        $count = Predict::count();
        $this->command->info("Created {$count} sample predict records.");
    }
}
