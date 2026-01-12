<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Elitbang',
            'email' => 'flutteruikit@gmail.com',
            'password' => bcrypt('admin'),
        ])->assignRole('superadmin');

        User::create([
            'name' => 'Dinas Kesehatan',
            'email' => 'yassirmuin@gmail.com',
            'password' => bcrypt('123456'),
        ])->assignRole('opd');
    }
}
