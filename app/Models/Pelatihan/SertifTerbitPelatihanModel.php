<?php

namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class SertifTerbitPelatihanModel extends Model
{
    protected $table            = 'sertif_terbit_pelatihan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'pelatihan_id', 'no_sertifikat', 'background_color', 'logo_header', 'pejabat_id_1', 'pejabat_id_2', 'status',
        'custom_an_1', 'custom_jabatan_1', 'custom_nama_1', 'custom_nip_1', 'custom_qr_1',
        'custom_an_2', 'custom_jabatan_2', 'custom_nama_2', 'custom_nip_2', 'custom_qr_2'
    ];
    protected $useTimestamps    = true;
}
