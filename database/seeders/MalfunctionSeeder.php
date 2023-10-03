<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MalfunctionSeeder extends Seeder
{
    public function run(): void
    {
        $malfunctions = [
            ['name' => 'Несправність двигуна', 'description' => 'Помилки циліндра, що призводять до нестабільної роботи.'],
            ['name' => 'Витікання охолоджуючої рідини', 'description' => 'Витікання охолоджуючої рідини з двигуна.'],
            ['name' => 'Несправність генератора', 'description' => 'Генератор не заряджає батарею.'],
            ['name' => 'Проскальзування коробки передач', 'description' => 'Передачі коробки передач проскальзовують під час руху.'],
            ['name' => 'Низький тиск масла', 'description' => 'Низький рівень тиску масла в системі.'],
        ];
        DB::table('malfunctions')->insert($malfunctions);;
    }
}
