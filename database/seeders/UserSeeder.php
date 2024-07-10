<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@tasksoft.com';
        $user->password = Hash::make('admin123');
        $user->save();

        $user2 = new User();
        $user2->name = 'Soporte';
        $user2->email = 'soporte@tasksoft.com';
        $user2->password = Hash::make('soporte123');
        $user2->save();
    }
}
