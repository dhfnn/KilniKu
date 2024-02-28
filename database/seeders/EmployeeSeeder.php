<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data karyawan dengan berbagai jabatan
        $employees = [
            [
                'name' => 'John Doe',
                'position' => 'Dokter',
                'birthdate' => '1985-10-15',
                'phoneNumber' => '123456789',
                'address' => 'Jl. Contoh No. 123',
                'startWork' => '2020-01-15',
            ],
            [
                'name' => 'Jane Doe',
                'position' => 'Perawat',
                'birthdate' => '1990-05-20',
                'phoneNumber' => '987654321',
                'address' => 'Jl. Contoh No. 456',
                'startWork' => '2021-03-10',
            ],
            [
                'name' => 'Michael Smith',
                'position' => 'Administrasi',
                'birthdate' => '1988-07-25',
                'phoneNumber' => '5551234567',
                'address' => '123 Main St',
                'startWork' => '2019-11-20',
            ],
            [
                'name' => 'Emily Johnson',
                'position' => 'Karyawan',
                'birthdate' => '1995-04-12',
                'phoneNumber' => '9879879876',
                'address' => '456 Elm St',
                'startWork' => '2022-02-05',
            ],
            [
                'name' => 'David Brown',
                'position' => 'Farmasis',
                'birthdate' => '1980-12-30',
                'phoneNumber' => '1112223333',
                'address' => '789 Oak St',
                'startWork' => '2018-05-15',
            ],
            // Tambahkan data karyawan dengan jabatan lain di sini
        ];

        // Masukkan data karyawan ke dalam database
        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
