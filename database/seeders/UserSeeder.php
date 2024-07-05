<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'sadmin',
            'fname' => 'Super',
            'mname' => 'Duper',
            'lname' => 'Admin',
            'role' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'birthday' => null,
            'gender' => 'Male',
            'address' => 'Earth',
            'contact' => null,
            'email_verified_at' => now()->toDateTimeString(),
            'password' => '654321'
        ]);

        User::create([
            'username' => 'admin',
            'fname' => 'David',
            'mname' => 'Roga',
            'lname' => 'Mendoza',
            'role' => 'Admin',
            'email' => 'davidmendozaofficial@gmail.com',
            'birthday' => null,
            'gender' => 'Male',
            'address' => null,
            'contact' => null,
            'email_verified_at' => now()->toDateTimeString(),
            'password' => '123456'
        ]);

        User::create([
            'username' => 'chanragmat',
            'fname' => 'Christian',
            'mname' => 'Lagunsad',
            'lname' => 'Ragmat',
            'role' => 'Admin',
            'email' => 'chan.ragmat@gmail.com',
            'birthday' => null,
            'gender' => 'Male',
            'address' => null,
            'contact' => null,
            'email_verified_at' => now()->toDateTimeString(),
            'password' => '123456'
        ]);
    }
}
