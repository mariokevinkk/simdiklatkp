<?php

if (!function_exists('get_system_logo')) {
    function get_system_logo() {
        try {
            $db = \Config\Database::connect();
            $row = $db->table('pengaturan_logo_sistem_pelatihan')->where('id', 1)->get()->getRowArray();
            if ($row && !empty($row['logo_path'])) {
                // If it is stored as assets/... return base_url, otherwise if uploaded under uploads return base_url(uploads/...)
                if (strpos($row['logo_path'], 'assets/') === 0) {
                    return base_url($row['logo_path']);
                }
                return base_url('uploads/pelatihan/' . $row['logo_path']);
            }
        } catch (\Exception $e) {
            // fallback
        }
        return base_url('assets/img/logo_rs.jpg');
    }
}

if (!function_exists('get_system_favicon')) {
    function get_system_favicon() {
        try {
            $db = \Config\Database::connect();
            $row = $db->table('pengaturan_logo_sistem_pelatihan')->where('id', 1)->get()->getRowArray();
            if ($row && !empty($row['favicon_path'])) {
                if (strpos($row['favicon_path'], 'assets/') === 0) {
                    return base_url($row['favicon_path']);
                }
                return base_url('uploads/pelatihan/' . $row['favicon_path']);
            }
        } catch (\Exception $e) {
            // fallback
        }
        return base_url('assets/img/logo_rs.jpg');
    }
}

if (!function_exists('tanggal_indo')) {
    function tanggal_indo(?string $tanggal, bool $cetak_hari = false): string
    {
        if (empty($tanggal) || $tanggal === '0000-00-00' || $tanggal === '0000-00-00 00:00:00') {
            return '-';
        }
        
        $hari = [
            1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'
        ];
        
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $ts = strtotime($tanggal);
        $tgl = date('d', $ts);
        $bln = (int)date('m', $ts);
        $thn = date('Y', $ts);
        
        $str = $tgl . ' ' . $bulan[$bln] . ' ' . $thn;
        
        if ($cetak_hari) {
            $num = date('N', $ts);
            return $hari[$num] . ', ' . $str;
        }
        return $str;
    }
}
