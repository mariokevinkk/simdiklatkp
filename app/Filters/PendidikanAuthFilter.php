<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PendidikanAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        log_message('error', 'PendidikanAuthFilter Triggered. URL: ' . current_url() . ' | Session ID: ' . session_id() . ' | Session Data: ' . print_r($_SESSION, true));
        if (!$session->has('role')) {
            return redirect()->to('/pendidikan/login')->with('error', 'Silakan login terlebih dahulu (Pendidikan).');
        }

        if ($arguments) {
            $role = $session->get('role');
            if (!in_array($role, $arguments)) {
                return redirect()->to('/pendidikan/login')->with('error', 'Akses ditolak.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (method_exists($response, 'noCache')) {
            $response->noCache();
        } else {
            $response->setHeader('Cache-Control', 'no-store, max-age=0, no-cache, must-revalidate');
            $response->setHeader('Pragma', 'no-cache');
            $response->setHeader('Expires', '0');
        }
    }
}
