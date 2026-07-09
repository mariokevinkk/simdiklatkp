<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSuperAdmin extends Migration
{
    public function up()
    {
        // 1. Tambahkan Role Super Admin jika belum ada (id = 5)
        $roleData = [
            'id' => 5,
            'nama_role' => 'Super Admin'
        ];
        
        $db = \Config\Database::connect();
        $builderRole = $db->table('roles_pendidikan');
        $existingRole = $builderRole->where('id', 5)->get()->getRow();
        if (!$existingRole) {
            $builderRole->insert($roleData);
        }

        // 2. Tambahkan User Super Admin Default
        $userData = [
            'role_id' => 5,
            'email' => 'superadmin@admin.com',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        $builderUser = $db->table('users_pendidikan');
        $existingUser = $builderUser->where('email', 'superadmin@admin.com')->get()->getRow();
        if (!$existingUser) {
            $builderUser->insert($userData);
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $db->table('users_pendidikan')->where('email', 'superadmin@admin.com')->delete();
        $db->table('roles_pendidikan')->where('id', 5)->delete();
    }
}
