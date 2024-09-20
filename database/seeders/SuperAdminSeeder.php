<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123123123'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('superadmin');

    }
}
