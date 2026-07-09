<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class RunMig extends Controller
{
    public function index()
    {
        $forge = \Config\Database::forge();
        require APPPATH . 'Database/Migrations/2026-07-08-113500_UpdateStasePendidikanCiRuangan.php';
        $m = new \App\Database\Migrations\UpdateStasePendidikanCiRuangan($forge);
        $m->up();
        return 'Migration successfully executed! Table created.';
    }
}
