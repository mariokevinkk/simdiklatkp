<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = service('session');
        $uri = service('uri');
        $module = $uri->getSegment(1); // 'pelatihan' or 'pendidikan'
        if ($module === 'index.php') {
            $module = $uri->getSegment(2);
        }

        if (!$session->has('logged_in')) {
            if ($module === 'pendidikan') {
                return redirect()->to('/pendidikan/login')->with('error', 'Silakan login terlebih dahulu.');
            }
            return redirect()->to('/pelatihan/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($arguments) {
            $role = $session->get('role');
            if (!in_array($role, $arguments)) {
                if ($module === 'pendidikan') {
                    return redirect()->to('/pendidikan/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
                }
                return redirect()->to('/pelatihan/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
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
