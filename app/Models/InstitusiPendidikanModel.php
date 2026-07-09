<?php

namespace App\Models;

use CodeIgniter\Model;

class InstitusiPendidikanModel extends Model
{
    protected $table            = 'institusi_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'nama_institusi',
        'alamat',
        'no_telp',
        'nama_kontak',
        'file_mou',
        'file_permohonan',
        'status_verifikasi',
        'status_pembayaran',
        'catatan_revisi',
        'alasan_penolakan',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
