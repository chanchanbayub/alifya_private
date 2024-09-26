<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProfilController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'About Us | Alifya Private',
        ];
        return view('users/profil_v', $data);
    }
}
