<?php

namespace Database\Seeders;
use \App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('12345678'),
            'namaLengkap' => 'Alya Mutiara',
            'role' => 'admin',
            'verifikasi' => 'sudah',
            'alamat' => 'cikuda'
        ]);
    }
}
