<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['key' => 'documents.view', 'display_name' => 'عرض المستندات'],
            ['key' => 'documents.create', 'display_name' => 'إضافة مستند'],
            ['key' => 'documents.update', 'display_name' => 'تعديل مستند'],
            ['key' => 'documents.delete', 'display_name' => 'حذف مستند'],
            ['key' => 'documents.print', 'display_name' => 'طباعة مستند'],
            ['key' => 'documents.files.delete', 'display_name' => 'حذف ملف'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['key' => $permission['key']],
                ['display_name' => $permission['display_name']]
            );
        }
    }
}
