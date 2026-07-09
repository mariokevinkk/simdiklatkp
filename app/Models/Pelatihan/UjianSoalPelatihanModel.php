<?php
namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class UjianSoalPelatihanModel extends Model
{
    protected $table            = 'ujian_soal_pelatihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ujian_id', 'tipe_soal', 'pertanyaan', 'file_path', 'opsi_a', 'opsi_b', 'opsi_c', 'opsi_d', 'jawaban_benar'];

    // Dates
    protected $useTimestamps = false;
}
