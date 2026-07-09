<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesPendidikanModel extends Model
{
    protected $table            = 'roles_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_role'];
}
