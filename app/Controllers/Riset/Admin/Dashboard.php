<?php

namespace App\Controllers\Riset\Admin;

use App\Controllers\BaseController;
use App\Models\PengajuanRisetModel;
use App\Models\PublikasiRisetModel;

class Dashboard extends BaseController
{
    protected PengajuanRisetModel $pengajuanModel;
    protected PublikasiRisetModel $publikasiModel;

    public function __construct()
    {
        $this->pengajuanModel = new PengajuanRisetModel();
        $this->publikasiModel = new PublikasiRisetModel();
    }

    public function index()
    {
        // Statistik Studi Pendahuluan
        $totalStupen      = $this->pengajuanModel->where('jenis_pengajuan', 'studi_pendahuluan')->countAllResults();
        $stupenPending     = $this->pengajuanModel->where('jenis_pengajuan', 'studi_pendahuluan')->whereNotIn('status', ['selesai', 'disetujui', 'ditolak', 'direvisi', 'revisi'])->countAllResults();
        $stupenDisetujui   = $this->pengajuanModel->where('jenis_pengajuan', 'studi_pendahuluan')->whereIn('status', ['selesai', 'disetujui'])->countAllResults();

        // Statistik Izin Penelitian
        $totalIzin         = $this->pengajuanModel->where('jenis_pengajuan', 'penelitian')->countAllResults();
        $izinPending       = $this->pengajuanModel->where('jenis_pengajuan', 'penelitian')->whereNotIn('status', ['selesai', 'disetujui', 'ditolak', 'direvisi', 'revisi'])->countAllResults();
        $izinDisetujui     = $this->pengajuanModel->where('jenis_pengajuan', 'penelitian')->whereIn('status', ['selesai', 'disetujui'])->countAllResults();

        // Statistik Publikasi
        $totalPublikasi    = $this->publikasiModel->countAllResults();
        $publikasiPending  = $this->publikasiModel->whereNotIn('status', ['selesai', 'disetujui', 'ditolak', 'direvisi', 'revisi'])->countAllResults();
        $publikasiSelesai  = $this->publikasiModel->whereIn('status', ['selesai', 'disetujui'])->countAllResults();

        // Agregat
        $totalAll = $totalStupen + $totalIzin + $totalPublikasi;
        $totalPending = $stupenPending + $izinPending + $publikasiPending;
        $totalSelesai = $stupenDisetujui + $izinDisetujui + $publikasiSelesai;
        
        $totalRevisi = $this->pengajuanModel->whereIn('status', ['direvisi', 'revisi'])->countAllResults() + 
                       $this->publikasiModel->whereIn('status', ['direvisi', 'revisi'])->countAllResults();

        // Pengajuan terbaru (5 terakhir, semua jenis)
        $pengajuan = $this->pengajuanModel->orderBy('created_at', 'DESC')->findAll(5);
        $publikasi = $this->publikasiModel->orderBy('created_at', 'DESC')->findAll(5);
        
        $pengajuanTerbaru = array_merge($pengajuan, $publikasi);
        usort($pengajuanTerbaru, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        
        // Pastikan jenis_pengajuan ada untuk publikasi
        foreach ($pengajuanTerbaru as &$item) {
            if (!isset($item['jenis_pengajuan'])) {
                $item['jenis_pengajuan'] = 'publikasi_riset';
            }
        }
        $pengajuanTerbaru = array_slice($pengajuanTerbaru, 0, 5);

        return view('Riset/admin/dashboard/index', [
            'title'       => 'Dashboard Overview',
            'active_menu' => 'dashboard',
            'stats'       => [
                'total_stupen'       => $totalStupen,
                'stupen_pending'     => $stupenPending,
                'stupen_disetujui'   => $stupenDisetujui,
                'total_izin'         => $totalIzin,
                'izin_pending'       => $izinPending,
                'izin_disetujui'     => $izinDisetujui,
                'total_publikasi'    => $totalPublikasi,
                'publikasi_pending'  => $publikasiPending,
                'publikasi_selesai'  => $publikasiSelesai,
                'total_all'          => $totalAll,
                'total_pending'      => $totalPending,
                'total_selesai'      => $totalSelesai,
                'total_revisi'       => $totalRevisi,
            ],
            'pengajuan_terbaru' => $pengajuanTerbaru,
        ]);
    }
}
