<?php
namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class PesertaPelatihanModel extends Model
{
    protected $table            = 'peserta_pelatihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'pelatihan_id', 'status_peserta', 'bukti_bayar', 'status_pembayaran', 'status_akses', 'waktu_daftar', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
}