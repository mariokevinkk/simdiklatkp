<?php

namespace App\Controllers\Riset\Admin;

use App\Controllers\BaseController;
use App\Models\UserRisetModel;

class Profil extends BaseController
{
    protected UserRisetModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserRisetModel();
    }

    public function index()
    {
        $userId = session()->get('riset_user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to(base_url('riset/login'))->with('error', 'Sesi telah habis, silakan login kembali.');
        }

        return view('Riset/admin/profil/index', [
            'title'       => 'Profil Saya',
            'active_menu' => 'profil',
            'user'        => $user
        ]);
    }

    public function update()
    {
        $userId = session()->get('riset_user_id');
        
        $rules = [
            'nama'      => 'required',
            'email'     => 'required|valid_email',
            'no_telp'   => 'required',
            'institusi' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Semua field dengan tanda bintang (*) wajib diisi.');
        }

        $data = [
            'nama'      => $this->request->getPost('nama'),
            'email'     => $this->request->getPost('email'),
            'no_telp'   => $this->request->getPost('no_telp'),
            'institusi' => $this->request->getPost('institusi'),
            'alamat'    => $this->request->getPost('alamat'),
        ];

        // Handle foto profil upload
        $foto = $this->request->getFile('foto_profil');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Hapus foto lama jika ada
            $oldUser = $this->userModel->find($userId);
            if (!empty($oldUser['foto_profil']) && file_exists(FCPATH . $oldUser['foto_profil'])) {
                @unlink(FCPATH . $oldUser['foto_profil']);
            }

            $newName = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads/riset/profil', $newName);
            $data['foto_profil'] = 'uploads/riset/profil/' . $newName;
        }

        // Handle password update if provided
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($userId, $data);

        return redirect()->to(base_url('riset/admin/profil'))->with('success', 'Profil berhasil diperbarui.');
    }
}
