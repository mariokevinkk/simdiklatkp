<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPendidikanModel extends Model
{
    protected $table            = 'users_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['role_id', 'email', 'password', 'is_active', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
