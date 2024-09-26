<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if (!session()->get('isLogedIn')) {
            return redirect()->to(site_url('auth/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (!session()->get('isLogedIn')) {
            if (session()->get('role_management_id') == 1) {
                return redirect()->to(site_url('admin/dashboard'));
            } else {
                return redirect()->to(site_url('mitra_pengajar/dashboard'));
            }
        }
    }
}
