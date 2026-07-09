<?php
namespace App\Controllers;
use CodeIgniter\Controller;
class MigrateController extends Controller
{
    public function index()
    {
        $migrate = \Config\Services::migrations();
        try {
            $migrate->latest();
            echo "Migrations ran successfully.<br>";
            
            $history = $migrate->getHistory('App');
            echo "<pre>";
            print_r($history);
            echo "</pre>";
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
