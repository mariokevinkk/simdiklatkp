<?php

namespace App\Controllers;

class SuperAdmin extends BaseController
{
    public function dashboard()
    {
        $db = \Config\Database::connect();
        
        // Ambil data admin dari ketiga modul
        $adminRiset = $db->table('users_riset')->where('role', 'admin')->get()->getResultArray();
        $adminPelatihan = $db->table('users_pelatihan')->whereIn('role', ['admin', 'admin_pengabdian'])->get()->getResultArray();
        $adminPendidikan = $db->table('users_pendidikan')->where('role_id', 1)->get()->getResultArray();

        return view('SuperAdmin/dashboard', [
            'adminRiset' => $adminRiset,
            'adminPelatihan' => $adminPelatihan,
            'adminPendidikan' => $adminPendidikan
        ]);
    }

    public function create_admin()
    {
        $tipeAdmin = $this->request->getPost('tipe_admin');
        $nik = $this->request->getPost('nik');
        $namaLengkap = $this->request->getPost('nama_lengkap');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $db = \Config\Database::connect();

        try {
            if ($tipeAdmin == 'riset') {
                $builder = $db->table('users_riset');
                if ($builder->where('email', $email)->countAllResults() > 0) {
                    return redirect()->back()->with('error', 'Email sudah terdaftar di modul Riset!');
                }
                $builder->insert([
                    'nama' => $namaLengkap,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role' => 'admin',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            } elseif ($tipeAdmin == 'pelatihan' || $tipeAdmin == 'admin_pengabdian') {
                $roleToInsert = ($tipeAdmin == 'admin_pengabdian') ? 'admin_pengabdian' : 'admin';
                $builder = $db->table('users_pelatihan');
                if ($builder->where('email', $email)->countAllResults() > 0) {
                    return redirect()->back()->with('error', 'Email sudah terdaftar di modul Pelatihan!');
                }
                if ($builder->where('nik', $nik)->countAllResults() > 0) {
                    return redirect()->back()->with('error', 'NIK sudah terdaftar di modul Pelatihan!');
                }
                $builder->insert([
                    'nik' => $nik,
                    'nama_lengkap' => $namaLengkap,
                    'email' => $email,
                    'no_wa' => '-', 
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role' => $roleToInsert,
                    'status' => 'aktif',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            } elseif ($tipeAdmin == 'pendidikan') {
                $builder = $db->table('users_pendidikan');
                if ($builder->where('email', $email)->countAllResults() > 0) {
                    return redirect()->back()->with('error', 'Email sudah terdaftar di modul Pendidikan!');
                }
                $builder->insert([
                    'role_id' => 1,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                return redirect()->back()->with('error', 'Tipe admin tidak dikenali!');
            }

            return redirect()->back()->with('success', 'Berhasil membuat Admin ' . ucfirst($tipeAdmin));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat admin: ' . $e->getMessage());
        }
    }

    public function update_password()
    {
        $id = $this->request->getPost('id');
        $modul = $this->request->getPost('modul');
        $passwordBaru = $this->request->getPost('password_baru');

        if (empty($id) || empty($modul) || empty($passwordBaru)) {
            return redirect()->back()->with('error', 'Data tidak lengkap!');
        }

        $db = \Config\Database::connect();
        $hashPassword = password_hash($passwordBaru, PASSWORD_DEFAULT);

        try {
            if ($modul == 'riset') {
                $db->table('users_riset')->where('id', $id)->update(['password' => $hashPassword]);
            } elseif ($modul == 'pelatihan') {
                // Di pelatihan, primary key-nya adalah NIK
                $db->table('users_pelatihan')->where('nik', $id)->update(['password' => $hashPassword]);
            } elseif ($modul == 'pendidikan') {
                $db->table('users_pendidikan')->where('id', $id)->update(['password' => $hashPassword]);
            } else {
                return redirect()->back()->with('error', 'Modul tidak dikenali!');
            }

            return redirect()->back()->with('success', 'Password berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui password: ' . $e->getMessage());
        }
    }
}
