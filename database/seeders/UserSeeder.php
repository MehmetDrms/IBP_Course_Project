<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Mehmet',
            'surname'=>'Durmuş',
            'tel_no'=>'5389405372',
            'email'=>'mehmet@drms.com',
            'password'=>Hash::make('1234'),
            'role'=>1
        ]);
        User::create([
            'name'=>'Ali',
            'surname'=>'Veli',
            'tel_no'=>'5389405371',
            'email'=>'ali@veli.com',
            'password'=>Hash::make('1234'),
            'role'=>2
        ]);
    }
}
