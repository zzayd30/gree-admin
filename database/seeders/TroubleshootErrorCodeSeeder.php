<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TroubleshootErrorCode;
use App\Models\TroubleshootStep;
use Illuminate\Support\Facades\File;

class TroubleshootErrorCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Read data from data.json file
        $jsonPath = base_path('data.json');
        
        if (File::exists($jsonPath)) {
            $jsonData = json_decode(File::get($jsonPath), true);
            
            // Create the main troubleshoot error code record
            $troubleshoot = TroubleshootErrorCode::create([
                'name' => $jsonData['procedure'],
                'description' => 'Diagnostic procedure for ' . $jsonData['procedure'],
                'status' => 'active',
                'created_by' => null,
            ]);
            
            // Create steps for the troubleshoot
            foreach ($jsonData['steps'] as $stepData) {
                TroubleshootStep::create([
                    'troubleshoot_error_code_id' => $troubleshoot->id,
                    'step_number' => $stepData['step'],
                    'action' => $stepData['action'],
                    'tips' => $stepData['tips'] ?? null,
                    'sensor_type' => $stepData['sensorType'] ?? null,
                    'sensor_types' => $stepData['sensorTypes'] ?? null,
                ]);
            }
            
            $this->command->info('Troubleshoot error code data seeded successfully!');
            $this->command->info('Created 1 troubleshoot procedure with ' . count($jsonData['steps']) . ' steps.');
        } else {
            $this->command->error('data.json file not found!');
        }
    }
}
