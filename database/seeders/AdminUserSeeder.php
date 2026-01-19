<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('key', 'admin')->first();

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'        => 'System Admin',
                'password'    => Hash::make('password'),
                'role_id'     => $adminRole->id,
                'is_approved' => true,
            ]
        );
    }
}
