<?php
namespace App\Controllers\Pelatihan\Admin;
use App\Controllers\BaseController;

class DataMaster extends BaseController
{
    /**
     * Menampilkan halaman Master Data Profesi.
     * Route: GET /pelatihan/admin/data_master/profesi
     */
    public function profesi()
    {
        $model = new \App\Models\Pelatihan\ProfesiPelatihanModel();
        $data = [
            'title' => 'Data Master Profesi',
            'type'  => 'profesi',
            'list'  => $model->findAll()
        ];
        return view('pelatihan/admin/data_master/index', $data);
    }

    /**
     * Menampilkan halaman Master Data Ruangan.
     * Route: GET /pelatihan/admin/data_master/ruangan
     */
    public function ruangan()
    {
        $data = [
            'title' => 'Data Master Ruangan',
            'type' => 'ruangan',
            'list' => $this->session->get('master_ruangan') ?? ['Aula Utama', 'Lab Simulasi A', 'Lab Simulasi B', 'Ruang Rapat Merapi', 'Ruang Rapat Parangtritis']
        ];
        return view('pelatihan/admin/data_master/index', $data);
    }

    /**
     * Menampilkan halaman Master Data Kategori Evaluasi.
     * Route: GET /pelatihan/admin/data_master/kategori_evaluasi
     */
    public function kategori_evaluasi()
    {
        $model = new \App\Models\Pelatihan\KategoriEvaluasiPelatihanModel();
        $items = $model->findAll();
        $list = array_column($items, 'nama_kategori');
        
        $data = [
            'title' => 'Data Master Kategori Evaluasi',
            'type' => 'kategori_evaluasi',
            'list' => $list
        ];
        return view('pelatihan/admin/data_master/index', $data);
    }

    /**
     * Menampilkan halaman Master Data Kategori SKP.
     * Route: GET /pelatihan/admin/data_master/kategori_skp
     */
    public function kategori_skp()
    {
        $model = new \App\Models\Pelatihan\MasterKategoriSkpPelatihanModel();
        $all = $model->orderBy('ranah')->orderBy('nama_kategori')->findAll();

        // Group by ranah
        $grouped = [];
        $ranah_list = [];
        foreach ($all as $item) {
            $grouped[$item['ranah']][] = $item;
            if (!in_array($item['ranah'], $ranah_list)) {
                $ranah_list[] = $item['ranah'];
            }
        }

        return view('pelatihan/admin/data_master/kategori_skp', [
            'title'      => 'Ranah & Kategori SKP',
            'grouped'    => $grouped,
            'ranah_list' => $ranah_list,
        ]);
    }

    /**
     * Menyimpan data Kategori SKP baru.
     * Route: POST /pelatihan/admin/data_master/simpan_kategori_skp
     */
    public function simpan_kategori_skp()
    {
        $ranah      = trim($this->request->getPost('ranah') ?? '');
        $ranah_baru = trim($this->request->getPost('ranah_baru') ?? '');
        $kategori   = trim($this->request->getPost('nama_kategori') ?? '');

        // Allow creating new ranah
        if ($ranah === '__baru__' && !empty($ranah_baru)) {
            $ranah = $ranah_baru;
        }

        if (empty($ranah) || empty($kategori)) {
            return redirect()->back()->with('error', 'Ranah dan Nama Kategori tidak boleh kosong.');
        }

        $model = new \App\Models\Pelatihan\MasterKategoriSkpPelatihanModel();
        $existing = $model->where('ranah', $ranah)->where('nama_kategori', $kategori)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Kategori tersebut sudah ada di ranah yang sama.');
        }

        $model->insert(['ranah' => $ranah, 'nama_kategori' => $kategori]);
        return redirect()->back()->with('success', 'Kategori SKP berhasil ditambahkan.');
    }

    /**
     * Menghapus data Kategori SKP berdasarkan ID.
     * Route: GET /pelatihan/admin/data_master/hapus_kategori_skp/(:num)
     * @param int $id ID kategori yang akan dihapus
     */
    public function hapus_kategori_skp(int $id)
    {
        $model = new \App\Models\Pelatihan\MasterKategoriSkpPelatihanModel();
        $item  = $model->find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        $model->delete($id);
        return redirect()->back()->with('success', 'Kategori SKP berhasil dihapus.');
    }

    /**
     * Mengubah nama ranah SKP (menggabungkan atau merubah nama).
     * Route: POST /pelatihan/admin/data_master/rename_ranah
     */
    public function rename_ranah()
    {
        $ranah_lama = trim($this->request->getPost('ranah_lama') ?? '');
        $ranah_baru = trim($this->request->getPost('ranah_baru') ?? '');

        if (empty($ranah_lama) || empty($ranah_baru)) {
            return redirect()->back()->with('error', 'Nama ranah tidak boleh kosong.');
        }
        if ($ranah_lama === $ranah_baru) {
            return redirect()->back()->with('error', 'Nama ranah baru sama dengan yang lama.');
        }

        $db = \Config\Database::connect();
        // Check if target ranah name already exists (to avoid collision)
        $existing = $db->table('master_kategori_skp_pelatihan')->where('ranah', $ranah_baru)->countAllResults();
        if ($existing > 0) {
            // Merge: update ranah_lama rows to ranah_baru, duplicates will be deduplicated
            $db->table('master_kategori_skp_pelatihan')
               ->where('ranah', $ranah_lama)
               ->update(['ranah' => $ranah_baru]);
            return redirect()->back()->with('success', 'Ranah berhasil digabungkan ke "' . $ranah_baru . '".');
        }

        $db->table('master_kategori_skp_pelatihan')
           ->where('ranah', $ranah_lama)
           ->update(['ranah' => $ranah_baru]);

        return redirect()->back()->with('success', 'Ranah berhasil diubah dari "' . $ranah_lama . '" menjadi "' . $ranah_baru . '".');
    }

    /**
     * Menghapus ranah beserta seluruh kategorinya.
     * Route: GET /pelatihan/admin/data_master/hapus_ranah/(.*)
     * @param string $ranah Nama ranah yang akan dihapus
     */
    public function hapus_ranah(string $ranah)
    {
        $ranah = urldecode($ranah);
        $db = \Config\Database::connect();
        $count = $db->table('master_kategori_skp_pelatihan')->where('ranah', $ranah)->countAllResults();
        if ($count === 0) {
            return redirect()->back()->with('error', 'Ranah tidak ditemukan.');
        }
        $db->table('master_kategori_skp_pelatihan')->where('ranah', $ranah)->delete();
        return redirect()->back()->with('success', 'Ranah "' . $ranah . '" beserta ' . $count . ' kategori berhasil dihapus.');
    }

    /**
     * Menyimpan data master lainnya (kategori evaluasi, profesi, ruangan).
     * Route: POST /pelatihan/admin/data_master/simpan/(:any)
     * @param string $type Jenis data master
     */
    public function simpan(string $type)
    {
        $name = $this->request->getPost('name') ?? $this->request->getPost('nama');
        
        if ($type === 'kategori_evaluasi') {
            $model = new \App\Models\Pelatihan\KategoriEvaluasiPelatihanModel();
            $existing = $model->where('nama_kategori', $name)->first();
            if (!$existing) {
                $model->insert(['nama_kategori' => $name]);
                return redirect()->back()->with('success', 'Data Kategori Evaluasi berhasil ditambahkan.');
            }
            return redirect()->back()->with('error', 'Kategori tersebut sudah ada.');
        }

        if ($type === 'profesi') {
            $model = new \App\Models\Pelatihan\ProfesiPelatihanModel();
            $existing = $model->where('nama_profesi', $name)->first();
            if (!$existing) {
                $model->insert([
                    'nama_profesi'    => $name,
                    'kategori_target' => $this->request->getPost('kategori_target') ?? 'Non-Named',
                    'target_jpl'      => $this->request->getPost('target_jpl') ?? 20
                ]);
                return redirect()->back()->with('success', 'Data Profesi berhasil ditambahkan.');
            }
            return redirect()->back()->with('error', 'Profesi tersebut sudah ada.');
        }

        $sessionKey = 'master_' . $type;
        $list = $this->session->get($sessionKey) ?? [];
        
        if ($type == 'ruangan' && empty($this->session->get('master_ruangan'))) {
            $list = ['Aula Utama', 'Lab Simulasi A', 'Lab Simulasi B', 'Ruang Rapat Merapi', 'Ruang Rapat Parangtritis'];
        }

        if (!in_array($name, $list)) {
            $list[] = $name;
            $this->session->set($sessionKey, $list);
            return redirect()->back()->with('success', 'Data ' . $type . ' berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'Data sudah ada.');
    }

    /**
     * Menghapus data master lainnya (kategori evaluasi, profesi, ruangan).
     * Route: GET /pelatihan/admin/data_master/hapus/(:any)/(:any)
     * @param string $type Jenis data master
     * @param string $indexOrName ID atau nama item yang dihapus
     */
    public function hapus(string $type, string $indexOrName)
    {
        if ($type === 'kategori_evaluasi') {
            $model = new \App\Models\Pelatihan\KategoriEvaluasiPelatihanModel();
            $items = $model->findAll();
            $list = array_column($items, 'nama_kategori');
            
            if (isset($list[$indexOrName])) {
                $nameToDelete = $list[$indexOrName];
                $model->where('nama_kategori', $nameToDelete)->delete();
                return redirect()->back()->with('success', 'Data Kategori Evaluasi berhasil dihapus.');
            }
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        if ($type === 'profesi') {
            $model = new \App\Models\Pelatihan\ProfesiPelatihanModel();
            $model->delete($indexOrName);
            return redirect()->back()->with('success', 'Data Profesi berhasil dihapus.');
        }

        $sessionKey = 'master_' . $type;
        $list = $this->session->get($sessionKey) ?? [];
        
        if (isset($list[$indexOrName])) {
            unset($list[$indexOrName]);
            $list = array_values($list);
            $this->session->set($sessionKey, $list);
            return redirect()->back()->with('success', 'Data ' . $type . ' berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }
}
