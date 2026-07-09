<?php
namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class SertifikatPelatihanModel extends Model
{
    protected $table            = 'sertifikat_pelatihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'user_nama', 'user_profesi', 'judul', 'ranah', 'kategori_kegiatan', 'skp', 'tgl_mulai', 'tgl_selesai', 'penerbit', 'jenis_dokumen', 'verifikasi', 'alasan_penolakan', 'tgl_upload', 'tgl_verifikasi', 'pelatihan_id', 'file_path', 'surat_tugas_path', 'no_sertifikat', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
