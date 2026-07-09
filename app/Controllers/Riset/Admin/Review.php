<?php

namespace App\Controllers\Riset\Admin;

use App\Controllers\BaseController;
use App\Models\PengajuanRisetModel;
use App\Models\DokumenRisetModel;

class Review extends BaseController
{
    protected PengajuanRisetModel $pengajuanModel;
    protected DokumenRisetModel $dokumenModel;

    public function __construct()
    {
        $this->pengajuanModel = new PengajuanRisetModel();
        $this->dokumenModel = new DokumenRisetModel();
    }

    public function index()
    {
        $daftar = $this->pengajuanModel
            ->where('jenis_pengajuan', 'studi_pendahuluan')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('Riset/admin/review/index', [
            'title'       => 'Review Pengajuan',
            'active_menu' => 'review',
            'daftar'      => $daftar
        ]);
    }

    public function detail($id = null)
    {
        $pengajuan = $this->pengajuanModel->find($id);

        if (!$pengajuan) {
            return redirect()->to(base_url('riset/admin/review'))->with('error', 'Data pengajuan tidak ditemukan.');
        }

        $dokumen = $this->dokumenModel->where('pengajuan_riset_id', $id)
                                      ->whereIn('jenis_dokumen', ['Surat Permohonan', 'Proposal', 'CV', 'Draft Wawancara'])
                                      ->findAll();
        $pengajuan['dokumen'] = $dokumen;

        // Fetch user data for contact info
        $userModel = new \App\Models\UserRisetModel();
        $user = $userModel->find($pengajuan['user_riset_id']);
        $pengajuan['email'] = $user['email'] ?? 'Tidak ada';
        $pengajuan['no_telp'] = $user['no_telp'] ?? 'Tidak ada';
        $pengajuan['tanggal'] = date('d/m/Y', strtotime($pengajuan['created_at'] ?? 'now'));

        $count = $this->pengajuanModel->where('nomor_surat IS NOT NULL')->countAllResults();
        $increment = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $romans = ['01'=>'I', '02'=>'II', '03'=>'III', '04'=>'IV', '05'=>'V', '06'=>'VI', '07'=>'VII', '08'=>'VIII', '09'=>'IX', '10'=>'X', '11'=>'XI', '12'=>'XII'];
        $romanMonth = $romans[date('m')];
        $default_nomor_surat = "{$increment}/SIP-RSUDY/{$romanMonth}/" . date('Y');

        return view('Riset/admin/review/detail', [
            'title'               => 'Detail Pengajuan',
            'active_menu'         => 'review',
            'id'                  => $id,
            'data'                => $pengajuan,
            'default_nomor_surat' => $default_nomor_surat
        ]);
    }

    public function approve()
    {
        $id               = $this->request->getPost('id');
        $status_validasi  = $this->request->getPost('status_validasi');
        $catatan          = $this->request->getPost('catatan');
        $nominal          = $this->request->getPost('nominal_bayar');
        $nomor_surat      = $this->request->getPost('nomor_surat');

        $updateData = [];

        if ($status_validasi == 'konfirmasi_dokumen') {
            $updateData['status'] = 'menunggu_pembayaran';
            $updateData['catatan_revisi'] = null;
            if ($nominal) {
                $updateData['nominal_bayar'] = $nominal;
            }
            $message = 'Dokumen disetujui. Menunggu pembayaran dari peneliti.';
        } elseif ($status_validasi == 'konfirmasi_bayar') {
            $updateData['status'] = 'selesai';
            $updateData['catatan_revisi'] = null;
            if ($nomor_surat) {
                $updateData['nomor_surat'] = $nomor_surat;
            }
            $message = 'Pembayaran divalidasi. Surat Izin berhasil diterbitkan.';
        } elseif ($status_validasi == 'revisi') {
            $updateData['status'] = 'direvisi';
            $updateData['catatan_revisi'] = $catatan;
            $message = 'Status pengajuan berhasil diperbarui menjadi Revisi.';
        } elseif ($status_validasi == 'revisi_bayar') {
            $updateData['status'] = 'menunggu_pembayaran';
            $updateData['catatan_revisi'] = $catatan;
            $message = 'Bukti pembayaran dikembalikan untuk direvisi.';
        } elseif ($status_validasi == 'tolak') {
            $updateData['status'] = 'ditolak';
            $updateData['catatan_penolakan'] = $catatan;
            $message = 'Pengajuan berhasil ditolak.';
        } else {
            $updateData['status'] = 'selesai';
            $message = 'Pendaftaran riset berhasil divalidasi dan disetujui.';
        }

        $this->pengajuanModel->update($id, $updateData);

        return redirect()->to(base_url('riset/admin/review'))
            ->with('success', $message);
    }
}
