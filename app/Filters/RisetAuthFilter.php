<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RisetAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah user sudah login di modul riset
        if (!session()->get('riset_logged_in')) {
            return redirect()->to(base_url('riset/login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek role jika ada argumen (admin/peneliti)
        if ($arguments) {
            $role = session()->get('riset_role');
            if (!in_array($role, $arguments)) {
                return redirect()->to(base_url('riset/login'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $response->noCache();
        $response->setHeader('Cache-Control', 'no-store, max-age=0, no-cache, must-revalidate');
        $response->setHeader('Pragma', 'no-cache');
        $response->setHeader('Expires', '0');
    }
}
