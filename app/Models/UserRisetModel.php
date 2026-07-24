<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRisetModel extends Model
{
    protected $table            = 'users_riset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'email', 'password', 'role', 'institusi', 'no_telp', 'identitas', 'prodi', 'alamat', 'foto_profil', 'reset_token', 'reset_expires_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
