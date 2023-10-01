<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample symptoms data
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

        // Insert the data into the 'symptoms' table
        DB::table('symptoms')->insert($symptoms);
    }
}
