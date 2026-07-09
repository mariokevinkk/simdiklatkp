<?php

namespace App\Controllers\Pendidikan\Institusi;

use App\Controllers\BaseController;
use App\Models\InstitusiPendidikanModel;
use App\Models\UserPendidikanModel;

class Profil extends BaseController
{
    public function index()
    {
        $sessionData = session()->get();
        if (!isset($sessionData['institusi_id'])) {
            return redirect()->to('pendidikan/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $institusiModel = new InstitusiPendidikanModel();
        $userModel = new UserPendidikanModel();

        $institusi = $institusiModel->find($sessionData['institusi_id']);
        $user = $userModel->find($sessionData['user_id']);

        if (!$institusi) {
            return redirect()->to('pendidikan/login')->with('error', 'Data institusi tidak ditemukan.');
        }

        $data = [
            'title' => 'Profil Institusi',
            'institusi' => $institusi,
            'user' => $user
        ];

        return view('pendidikan/institusi/profil/index', $data);
    }

    public function update()
    {
        $sessionData = session()->get();
        if (!isset($sessionData['institusi_id'])) {
            return redirect()->to('pendidikan/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $institusiModel = new InstitusiPendidikanModel();
        $institusi_id = $sessionData['institusi_id'];
        $institusi_lama = $institusiModel->find($institusi_id);

        $dataUpdate = [
            'nama_institusi' => $this->request->getPost('nama_institusi'),
            'alamat'         => $this->request->getPost('alamat'),
            'no_telp'        => $this->request->getPost('no_telp'),
            'nama_kontak'    => $this->request->getPost('nama_kontak'),
        ];

        $uploadPath = FCPATH . 'uploads/institusi/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $file_mou = $this->request->getFile('file_mou');
        if ($file_mou && $file_mou->isValid() && !$file_mou->hasMoved()) {
            $newNameMou = $file_mou->getRandomName();
            $file_mou->move($uploadPath, $newNameMou);
            $dataUpdate['file_mou'] = $newNameMou;
            
            // Delete old if exists
            if (!empty($institusi_lama['file_mou']) && file_exists($uploadPath . $institusi_lama['file_mou'])) {
                @unlink($uploadPath . $institusi_lama['file_mou']);
            }
        }

        $file_permohonan = $this->request->getFile('file_permohonan');
        if ($file_permohonan && $file_permohonan->isValid() && !$file_permohonan->hasMoved()) {
            $newNamePermohonan = $file_permohonan->getRandomName();
            $file_permohonan->move($uploadPath, $newNamePermohonan);
            $dataUpdate['file_permohonan'] = $newNamePermohonan;

            // Delete old if exists
            if (!empty($institusi_lama['file_permohonan']) && file_exists($uploadPath . $institusi_lama['file_permohonan'])) {
                @unlink($uploadPath . $institusi_lama['file_permohonan']);
            }
        }

        $institusiModel->update($institusi_id, $dataUpdate);

        return redirect()->to('pendidikan/institusi/profil')->with('success', 'Profil institusi berhasil diperbarui.');
    }
}
