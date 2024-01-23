<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $password = Hash::make('password');
        $adminRecords  = [
            'id' => 1,
            'name' => 'Shishir Kumar',
            'type' => 'admin',
            'mobile' => 8052785942,
            'email' => 'admin@sky.com',
            'password' => $password,
            'image' => '',
            'status' => 1
        ];
        Admin::insert($adminRecords);
    }
}
