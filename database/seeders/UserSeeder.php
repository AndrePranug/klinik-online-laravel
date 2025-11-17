<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@klinik.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin'); // GUNAKAN SPATIE

        // Dokter 1
        $doctor1 = User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'budi@klinik.com',
            'password' => Hash::make('password'),
            'phone' => '081234567891',
            'email_verified_at' => now(),
        ]);
        $doctor1->assignRole('doctor'); // GUNAKAN SPATIE

        $doctorProfile1 = Doctor::create([
            'user_id' => $doctor1->id,
            'specialization_id' => 1,
            'license_number' => 'DOC001',
            'bio' => 'Dokter umum berpengalaman 10 tahun',
            'experience_years' => 10,
            'consultation_fee' => 100000,
        ]);

        Schedule::create([
            'doctor_id' => $doctorProfile1->id,
            'day' => 'Senin',
            'start_time' => '08:00',
            'end_time' => '12:00',
            'slot_duration' => 30,
        ]);

        Schedule::create([
            'doctor_id' => $doctorProfile1->id,
            'day' => 'Rabu',
            'start_time' => '13:00',
            'end_time' => '17:00',
            'slot_duration' => 30,
        ]);

        // Dokter 2
        $doctor2 = User::create([
            'name' => 'Dr. Siti Aminah, Sp.A',
            'email' => 'siti@klinik.com',
            'password' => Hash::make('password'),
            'phone' => '081234567892',
            'email_verified_at' => now(),
        ]);
        $doctor2->assignRole('doctor'); // GUNAKAN SPATIE

        $doctorProfile2 = Doctor::create([
            'user_id' => $doctor2->id,
            'specialization_id' => 3,
            'license_number' => 'DOC002',
            'bio' => 'Spesialis anak dengan pengalaman 8 tahun',
            'experience_years' => 8,
            'consultation_fee' => 150000,
        ]);

        Schedule::create([
            'doctor_id' => $doctorProfile2->id,
            'day' => 'Selasa',
            'start_time' => '09:00',
            'end_time' => '13:00',
            'slot_duration' => 30,
        ]);

        Schedule::create([
            'doctor_id' => $doctorProfile2->id,
            'day' => 'Kamis',
            'start_time' => '14:00',
            'end_time' => '18:00',
            'slot_duration' => 30,
        ]);

        // Pasien
        $patient = User::create([
            'name' => 'Ahmad Patient',
            'email' => 'patient@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '081234567893',
            'date_of_birth' => '1990-01-01',
            'gender' => 'male',
            'address' => 'Jl. Contoh No. 123',
            'email_verified_at' => now(),
        ]);
        $patient->assignRole('patient'); // GUNAKAN SPATIE
    }
}