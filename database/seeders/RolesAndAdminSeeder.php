<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $dentist = Role::firstOrCreate(['name' => 'dentist', 'guard_name' => 'web']);
        $patient = Role::firstOrCreate(['name' => 'patient', 'guard_name' => 'web']);

        // Admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@demo.test'],
            ['name' => 'Admin', 'password' => Hash::make('password')]
        );
        $adminUser->assignRole($admin);

        // Dentist user + profile
        $dentistUser = User::firstOrCreate(
            ['email' => 'dentist@demo.test'],
            ['name' => 'Dr. Demo', 'password' => Hash::make('password')]
        );
        $dentistUser->assignRole($dentist);
        \App\Models\Dentist::firstOrCreate(
            ['user_id' => $dentistUser->id],
            ['specialty' => 'Orthodontics']
        );

        // Patient user
        $patientUser = User::firstOrCreate(
            ['email' => 'patient@demo.test'],
            ['name' => 'Patient Demo', 'password' => Hash::make('password')]
        );
        $patientUser->assignRole($patient);

        // Services
        \App\Models\Service::firstOrCreate(['name' => 'Tẩy trắng răng'], ['price' => 800000, 'duration_mins' => 60]);
        \App\Models\Service::firstOrCreate(['name' => 'Trám răng'], ['price' => 500000, 'duration_mins' => 45]);
        \App\Models\Service::firstOrCreate(['name' => 'Khám tổng quát'], ['price' => 200000, 'duration_mins' => 20]);

        // Basic weekly schedule for demo dentist (Mon-Fri 09:00-17:00, 30-min slots)
        for ($d = 1; $d <= 5; $d++) {
            \App\Models\Schedule::firstOrCreate(
                ['dentist_id' => \App\Models\Dentist::first()->id, 'weekday' => $d],
                ['start_time' => '09:00', 'end_time' => '17:00', 'slot_minutes' => 30]
            );
        }

        \App\Models\Appointment::firstOrCreate([
            'patient_id' => $patientUser->id,
            'dentist_id' => \App\Models\Dentist::first()->id,
            'service_id' => \App\Models\Service::first()->id,
            'starts_at' => now()->addDays(1)->setTime(10, 0),
            'ends_at' => now()->addDays(1)->setTime(10, 30),
            'status' => 'confirmed',
            'notes' => 'Hẹn khám thử nghiệm.',
        ]);

        // Thêm quyền demo
        $permissions = [
            'manage appointments',
            'manage dentists',
            'manage services',
            'view reports',
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // Gán tất cả quyền cho admin
        $admin->givePermissionTo($permissions);
    }
}
