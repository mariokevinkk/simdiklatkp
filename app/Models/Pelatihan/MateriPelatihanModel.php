<?php
namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class MateriPelatihanModel extends Model
{
    protected $table            = 'materi_pelatihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pelatihan_id', 'sesi_id', 'segmen', 'urutan', 'judul', 'tipe', 'deskripsi', 'file_path', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
}