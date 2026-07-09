<?php

namespace App\Controllers\Riset\Admin;

use App\Controllers\BaseController;
use App\Models\PublikasiRisetModel;
use App\Models\DokumenRisetModel;

class Publikasi extends BaseController
{
    protected PublikasiRisetModel $publikasiModel;
    protected DokumenRisetModel $dokumenModel;

    public function __construct()
    {
        $this->publikasiModel = new PublikasiRisetModel();
        $this->dokumenModel = new DokumenRisetModel();
    }

    public function index()
    {
        $daftar = $this->publikasiModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('Riset/admin/publikasi/index', [
            'title'       => 'Review Publikasi',
            'active_menu' => 'publikasi',
            'daftar'      => $daftar
        ]);
    }

    public function detail($id = null)
    {
        $publikasi = $this->publikasiModel->find($id);

        if (!$publikasi) {
            return redirect()->to(base_url('riset/admin/publikasi'))->with('error', 'Data publikasi tidak ditemukan.');
        }

        // Ambil dokumen terkait
        $dokumen = $this->dokumenModel->where('pengajuan_riset_id', $id)
                                      ->whereIn('jenis_dokumen', ['publikasi', 'permohonan_izin', 'salinan_izin_penelitian', 'draft_artikel', 'pernyataan_anonimitas'])
                                      ->findAll();
        $publikasi['dokumen'] = $dokumen;
        
        // Fetch user data for contact info
        $userModel = new \App\Models\UserRisetModel();
        $user = $userModel->find($publikasi['user_riset_id']);
        $publikasi['email'] = $user['email'] ?? 'Tidak ada';
        $publikasi['no_telp'] = $user['no_telp'] ?? 'Tidak ada';
        $publikasi['tanggal'] = date('d/m/Y', strtotime($publikasi['created_at'] ?? 'now'));

        $count = $this->publikasiModel->where('no_surat_izin IS NOT NULL')->countAllResults();
        $increment = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $romans = ['01'=>'I', '02'=>'II', '03'=>'III', '04'=>'IV', '05'=>'V', '06'=>'VI', '07'=>'VII', '08'=>'VIII', '09'=>'IX', '10'=>'X', '11'=>'XI', '12'=>'XII'];
        $romanMonth = $romans[date('m')];
        $default_nomor_surat = "{$increment}/SIP-PUB/{$romanMonth}/" . date('Y');

        return view('Riset/admin/publikasi/detail', [
            'title'               => 'Detail Draft Publikasi',
            'active_menu'         => 'publikasi',
            'id'                  => $id,
            'data'                => $publikasi,
            'default_nomor_surat' => $default_nomor_surat
        ]);
    }

    public function approve()
    {
        $id       = $this->request->getPost('id');
        $status   = $this->request->getPost('status_validasi');
        $catatan  = $this->request->getPost('catatan');
        $nominal  = $this->request->getPost('nominal_bayar');
        $nomor_surat = $this->request->getPost('nomor_surat');

        $updateData = [];

        if ($status === 'konfirmasi_dokumen') {
            $updateData['status'] = 'menunggu_pembayaran';
            $updateData['catatan_revisi'] = null;
            if ($nominal) {
                $updateData['nominal_bayar'] = $nominal;
            }
            $message = 'Dokumen disetujui. Menunggu pembayaran dari peneliti.';
        } elseif ($status === 'konfirmasi_bayar_izin') {
            $updateData['status'] = 'selesai';
            $updateData['catatan_revisi'] = null;
            // Generate nomor surat izin
            if ($nomor_surat) {
                $updateData['no_surat_izin'] = $nomor_surat;
            } else {
                $count = $this->publikasiModel->where('no_surat_izin IS NOT NULL')->countAllResults();
                $updateData['no_surat_izin'] = str_pad($count + 1, 3, '0', STR_PAD_LEFT) . '/SIP-PUB/' . date('n') . '/' . date('Y');
            }
            $message = 'Pembayaran divalidasi. Surat Izin Publikasi diterbitkan dan diarsipkan otomatis!';
        } elseif ($status === 'konfirmasi_bayar_terima') {
            $updateData['status'] = 'selesai';
            $updateData['catatan_revisi'] = null;
            $message = 'Pembayaran divalidasi. Laporan hasil riset diarsipkan tanpa penerbitan surat izin.';
        } elseif ($status === 'revisi') {
            $updateData['status'] = 'direvisi';
            $updateData['catatan_revisi'] = $catatan;
            $message = 'Berkas dikembalikan untuk revisi.';
        } elseif ($status === 'revisi_bayar') {
            $updateData['status'] = 'menunggu_pembayaran';
            $updateData['catatan_revisi'] = $catatan;
            $message = 'Bukti pembayaran dikembalikan untuk direvisi.';
        } elseif ($status === 'tolak') {
            $updateData['status'] = 'ditolak';
            $updateData['catatan_revisi'] = $catatan;
            $message = 'Berkas ditolak. Catatan: ' . ($catatan ?: 'Mohon perbaiki draft sesuai standar.');
        } else {
            return redirect()->to(base_url('riset/admin/publikasi'))
                ->with('warning', 'Status validasi tidak dikenali.');
        }

        $this->publikasiModel->update($id, $updateData);

        return redirect()->to(base_url('riset/admin/publikasi'))
            ->with('success', $message);
    }

    public function buka_arsip($id)
    {
        $publikasi = $this->publikasiModel->find($id);
        if (!$publikasi) {
            return redirect()->back()->with('error', 'Data publikasi tidak ditemukan.');
        }

        // Cari dokumen artikel/laporan (selalu disimpan sebagai 'draft_artikel' pada form submission)
        $dokumen = $this->dokumenModel->where('pengajuan_riset_id', $id)
                                      ->groupStart()
                                        ->where('jenis_dokumen', 'draft_artikel')
                                        ->orWhere('jenis_dokumen', 'publikasi')
                                      ->groupEnd()
                                      ->first();

        if ($dokumen && !empty($dokumen['file_path'])) {
            return redirect()->to(base_url($dokumen['file_path']));
        }

        return redirect()->back()->with('error', 'File PDF dokumen tidak ditemukan di dalam sistem.');
    }
}
