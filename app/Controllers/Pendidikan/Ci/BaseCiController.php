<?php

namespace App\Controllers\Pendidikan\Ci;

use App\Controllers\BaseController;
use Config\Database;

class BaseCiController extends BaseController
{
    protected $ciId;
    protected $ciName;
    protected $db;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        helper('text'); // Load text helper for word_limiter
        $this->db = Database::connect();
        $this->resolveCi();
    }

    protected function resolveCi()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            $this->redirectLogin();
            return;
        }

        $ci = $this->db->table('ci_pendidikan')->where('user_id', $userId)->get()->getRowArray();
        if (!$ci) {
            $this->redirectLogin();
            return;
        }

        $this->ciId = $ci['id'];
        $this->ciName = $ci['nama_lengkap'];
    }

    protected function redirectLogin()
    {
        if ($this->request->isAJAX()) {
            $this->response->setStatusCode(401)->setJSON(['error' => 'Unauthorized'])->send();
            exit;
        }
        
        // Use redirect directly, but since we're in initController we might need to send and exit
        header('Location: ' . site_url('pendidikan/login'));
        exit;
    }

    /**
     * Check if CI is assigned to this room
     */
    protected function verifyCiAccess($staseId, $ruanganId)
    {
        $mapping = $this->db->table('stase_ruangan_ci_pendidikan')
            ->where('stase_id', $staseId)
            ->where('ruangan_id', $ruanganId)
            ->where('ci_id', $this->ciId)
            ->get()->getRowArray();

        if (!$mapping) {
            if ($this->request->isAJAX()) {
                $this->response->setStatusCode(403)->setJSON(['error' => 'Forbidden access to this room'])->send();
                exit;
            }
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Anda tidak memiliki akses ke ruangan ini.');
        }

        return $mapping;
    }
}
