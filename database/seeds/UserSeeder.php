<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'=>Str::uuid()->toString(),
                'first_Name' => 'Administrator',
                'last_Name'=>'',
                'email' => 'info@gpa.rw',
                'role'=>'Administrator',
                'password' => Hash::make('GPA#123'),
                'status'=>'ACTIVE'
            ],
            [
                'id'=>Str::uuid()->toString(),
                'first_Name' => 'First',
                'last_Name'=>'User',
                'email' => 'user@gmail.com',
                'role'=>'User',
                'password' => Hash::make('user12345'),
                'status'=>'ACTIVE'
            ]
        ]);
    }
}
