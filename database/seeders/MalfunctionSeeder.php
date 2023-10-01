<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MalfunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $malfunctions = [
            ['name' => 'Несправність двигуна', 'description' => 'Помилки циліндра, що призводять до нестабільної роботи.'],
            ['name' => 'Витікання охолоджуючої рідини', 'description' => 'Витікання охолоджуючої рідини з двигуна.'],
            ['name' => 'Несправність генератора', 'description' => 'Генератор не заряджає батарею.'],
            ['name' => 'Проскальзування коробки передач', 'description' => 'Передачі коробки передач проскальзовують під час руху.'],
            ['name' => 'Низький тиск масла', 'description' => 'Низький рівень тиску масла в системі.'],
            ['name' => 'Не включається стартер', 'description' => 'Стартер не вмикається при спробі запуску двигуна.'],
        ];

        DB::table('malfunctions')->insert($malfunctions);;
    }
}
