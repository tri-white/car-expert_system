<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SymptomSeeder extends Seeder
{
    public function run(): void
    {
        $symptoms = [
            ['name' => 'Двигун шумить'],
            ['name' => 'Двигун перенагрівається'],
            ['name' => 'Втрата потужності'],
            ['name' => 'Надмірні вихлопні гази'],
            ['name' => 'Двигун глохне'],
            ['name' => 'Втрата мастила'],
            ['name' => 'Автомобіль не заводиться'],
            ['name' => 'Дивний звук'],
            ['name' => 'Горить індикатор двигуна'],
        ];
        DB::table('symptoms')->insert($symptoms);
    }
}
