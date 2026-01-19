<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::updateOrCreate(['slug' => 'reports'], [
            'title' => 'Reports',
            'iframe_url' => 'https://example.com/reports',
            'is_active' => true,
        ]);
    }
}
