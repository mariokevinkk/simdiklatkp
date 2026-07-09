<?php
namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class NotifikasiPelatihanModel extends Model
{
    protected $table            = 'notifikasi_pelatihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'title', 'message', 'type', 'is_read', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
