<?php

if (!function_exists('format_pengajuan_id')) {
    /**
     * @param int|string $id
     * @param string $jenis
     * @return string
     */
    function format_pengajuan_id($id, $jenis) {
        $db = \Config\Database::connect();
        if ($jenis == 'studi_pendahuluan' || $jenis == 'penelitian') {
            $builder = $db->table('pengajuan_riset');
            $builder->where('jenis_pengajuan', $jenis);
            $builder->where('id <=', $id);
            $count = $builder->countAllResults();
            $prefix = ($jenis == 'studi_pendahuluan') ? 'SP' : 'IP';
            return $prefix . $count;
        } else if ($jenis == 'publikasi') {
            $builder = $db->table('publikasi_riset');
            $builder->where('id <=', $id);
            $count = $builder->countAllResults();
            return 'PB' . $count;
        }
        return '#' . $id;
    }
}
