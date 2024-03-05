<?php

namespace Database\Seeders;

use App\Models\Users as ModelsUsers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsUsers::create([
            'username' => 'petugas',
            'employeeID' => '6',
            'password' => bcrypt('12345678'),
            'role' => 'petugas',
        ]);
    }
}
