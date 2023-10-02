<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DiagnosticRuleSeeder extends Seeder
{
    public function run()
    {
        $diagnosticRules = [
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Двигун перенагрівається')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Витікання охолоджуючої рідини')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Втрата потужності')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Витікання охолоджуючої рідини')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Надмірні вихлопні гази')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Витікання охолоджуючої рідини')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Втрата потужності')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Проскальзування коробки передач')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Втрата потужності')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Низький тиск масла')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Надмірні вихлопні гази')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Низький тиск масла')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Автомобіль не заводиться')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Несправність генератора')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Дивний звук')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Несправність генератора')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Горить індикатор двигуна')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Несправність двигуна')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Дивний звук')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Несправність двигуна')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Надмірні вихлопні гази')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Несправність двигуна')->value('id'),
            ],
            [
                'symptom_id' => DB::table('symptoms')->where('name', 'Втрата потужності')->value('id'),
                'malfunction_id' => DB::table('malfunctions')->where('name', 'Несправність двигуна')->value('id'),
            ],

        ];
        DB::table('diagnostic_rules')->insert($diagnosticRules);
    }
}
