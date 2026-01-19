<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['key'=>'admin', 'display_name'=>'Admin'],
            ['key'=>'moderator', 'display_name'=>'Moderator'],
            ['key'=>'editor', 'display_name'=>'Editor'],
            ['key'=>'user', 'display_name'=>'User'],
            ['key'=>'guest', 'display_name'=>'Guest'],
        ];

        foreach ($roles as $r) Role::updateOrCreate(['key'=>$r['key']], $r);
    }
}
