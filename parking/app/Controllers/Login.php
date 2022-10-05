<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Login extends BaseController
{
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
    }
    public function index()
    {
        $session = \Config\Services::session();

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');


            $result =  $this->AdminModel->select(array('universitas_id', 'nama', 'email', 'password', 'jabatan', 'status'))
                ->where('email', $email)
                ->where('password', $password)
                ->first();

            if ($result) {

                $session->set(array(
                    'universitas_id' => $result['universitas_id'],
                    'nama' => $result['nama'],
                    'email' => $result['email'],
                    'password' => $result['password'],
                    'jabatan' => $result['jabatan'],
                    'status' => $result['status'],
                    'isLogin' => true
                ));

                $status = $session->get('status');
                $jabatan = $session->get('jabatan');
                if ($status == 'Enable' || $status == '') {
                    if ($jabatan == 'admin') {
                        return redirect()->to(base_url('admin'));
                    } else if ($jabatan == 'pemimpin') {
                        return redirect()->to(base_url('pemimpin'));
                    } else {
                        return redirect()->to(base_url('transaksi'));
                    }
                } else {
                    $message = "Your Account is Disabled!";
                    echo "<script type='text/javascript'>alert('$message'); </script>";
                }
            } elseif ($email != 'email' && $password != 'password') {
                $message = "Email or Password is Wrong!";
                echo "<script type='text/javascript'>alert('$message'); </script>";
            }
        }

        echo view('layout/header_login');
        echo view('login_view');
        echo view('layout/footer');
    }

    public function Logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to('../');
    }
}
