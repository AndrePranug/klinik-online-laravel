<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    public function run(): void
    {
        $specializations = [
            ['name' => 'Umum', 'description' => 'Dokter Umum'],
            ['name' => 'Gigi', 'description' => 'Dokter Spesialis Gigi'],
            ['name' => 'Anak', 'description' => 'Dokter Spesialis Anak'],
            ['name' => 'Jantung', 'description' => 'Dokter Spesialis Jantung'],
            ['name' => 'Kulit', 'description' => 'Dokter Spesialis Kulit dan Kelamin'],
        ];

        foreach ($specializations as $spec) {
            Specialization::create($spec);
        }
    }
}