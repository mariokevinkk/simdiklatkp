<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDitolakToPaymentStatusMahasiswa extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE mahasiswa_pendidikan MODIFY COLUMN payment_status ENUM('Belum Invoice', 'Belum Bayar', 'Menunggu Verifikasi', 'Lunas', 'Ditolak') DEFAULT 'Belum Invoice'");
    }

    public function down()
    {
        $this->db->query("UPDATE mahasiswa_pendidikan SET payment_status = 'Belum Bayar' WHERE payment_status = 'Ditolak'");
        $this->db->query("ALTER TABLE mahasiswa_pendidikan MODIFY COLUMN payment_status ENUM('Belum Invoice', 'Belum Bayar', 'Menunggu Verifikasi', 'Lunas') DEFAULT 'Belum Invoice'");
    }
}
