<?php
namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class SesiInteraktifPelatihanModel extends Model
{
    protected $table            = 'sesi_interaktif_pelatihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pelatihan_id', 'tipe_sesi', 'nama_sesi', 'tanggal', 'waktu', 'jam_tutup', 'lokasi_ruang', 'tempat', 'alamat', 'maps_url', 'meeting_link', 'meeting_pass', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
}