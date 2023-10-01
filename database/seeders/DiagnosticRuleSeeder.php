<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiagnosticRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample diagnostic rules data
        $diagnosticRules = [
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Двигун шумить')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Несправність двигуна')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Двигун перенагрівається')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Витікання охолоджуючої рідини')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Втрата потужності')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Проскальзування коробки передач')->value('id'),
            ],
            // Add more diagnostic rules based on symptoms and malfunctions

            // Example of a malfunction with multiple symptoms
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Двигун шумить')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Низький тиск масла')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Втрата мастила')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Низький тиск масла')->value('id'),
            ],
            // Add more malfunctions with multiple symptoms

        ];

        // Insert the data into the 'diagnostic_rules' table
        DB::table('diagnostic_rules')->insert($diagnosticRules);

        // Create additional diagnostic rules
        $symptoms = DB::table('symptoms')->get();
        $malfunctions = DB::table('malfunctions')->get();

        foreach ($malfunctions as $malfunction) {
            // Create multiple diagnostic rules for each malfunction
            for ($i = 0; $i < 3; $i++) {
                DB::table('diagnostic_rules')->insert([
                    'symptom_id' => $symptoms->random()->id,
                    'malfunction_id' => $malfunction->id,
                ]);
            }
        }
    }
}
