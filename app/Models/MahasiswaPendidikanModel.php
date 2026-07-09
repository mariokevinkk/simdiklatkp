<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaPendidikanModel extends Model
{
    protected $table            = 'mahasiswa_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'institusi_id',
        'id_profesi',
        'nim',
        'nama_lengkap',
        'jenis_kelamin',
        'jenjang',
        'program_studi',
        'tanggal_lahir',
        'semester',
        'no_hp',
        'email',
        'id_profesi',
        'file_foto',
        'file_ijazah',
        'file_sk',
        'status',
        'payment_status',
        'file_bukti_bayar',
        'invoice_file',
        'nominal',
        'nilai_akhir'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
