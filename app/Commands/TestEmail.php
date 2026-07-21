<?php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class TestEmail extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'test:email';
    protected $description = 'Test email configuration';

    public function run(array $params)
    {
        $email = \Config\Services::email();
        $email->setTo('ruskia335@gmail.com');
        $email->setSubject('Test Email CI4');
        $email->setMessage('This is a test email.');
        
        if ($email->send()) {
            CLI::write('Email sent successfully!', 'green');
        } else {
            CLI::write($email->printDebugger(['headers']), 'red');
        }
    }
}
