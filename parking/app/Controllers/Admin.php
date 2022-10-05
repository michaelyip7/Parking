<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\TransaksiModel;
use App\Models\KendaraanModel;
use App\Models\InstitusiModel;
use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->KendaraanModel = new KendaraanModel();
        $this->InstitusiModel = new InstitusiModel();
    }

    public function index()
    {
        $id = $_SESSION['universitas_id'];
        $data = [
            'contain' => 'container-fluid',
            'user' => $this->AdminModel->where("jabatan!=", "admin")->select('institusi.*,user.*')->join('institusi', 'user.universitas_id=institusi.universitas_id')->orderby('jabatan', 'pemimpin')->findAll(),
            'admin' => $this->AdminModel->select('institusi.*')->join('institusi', 'user.universitas_id=institusi.universitas_id')->where('user.universitas_id', $id)->first()
        ];
        echo view('layout/header', $data);
        echo view('admin/admin_view', $data);
        echo view('layout/footer');
    }
    public function updateuser($id, $status)
    {
        $updateuser = new AdminModel();
        $updateuser->update($id, ['status' => $status]);
        return redirect()->to(base_url('Admin'));
    }
    public function create_institusi()
    {

        $id = $_SESSION['universitas_id'];
        $data = [
            'validation' => \Config\Services::validation(),
            'institusi' => $this->InstitusiModel->findAll(),
            'admin' => $this->AdminModel->select('institusi.*')->join('institusi', 'user.universitas_id=institusi.universitas_id')->where('user.universitas_id', $id)->first()
        ];

        echo view('layout/header', $data);
        echo view('admin/create_institusi', $data);
        echo view('layout/footer');
    }

    public function update_institusi()
    {
        if (!$this->validate([
            'universitas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ],
            'logo' => [
                'rules' => 'uploaded[logo]|max_size[logo,1024]|is_image[logo]|mime_in[logo,image/jpg,image/png,image/jpeg]', //1024=1mb
                'errors' => [
                    'uploaded' => 'Please choose image!',
                    'max_size' => 'image size to big!',
                    'is_image' => 'Only image can be oplouded',
                    'mime_in' => 'Only image can be oplouded'
                ]
            ]
        ])) {
            return redirect()->to('/Admin/create_institusi')->withInput();
        }

        //logo
        $getlogo = $this->request->getFile('logo');
        //move logo
        $getlogo->move('image');
        //take name
        $logoname = $getlogo->getName();

        $this->InstitusiModel->update(1, [
            'universitas' => $this->request->getVar('universitas'),
            'logo' => $logoname
        ]);
        session()->setFlashdata('success msg', 'Data berhasil ditambahkan.');
        return redirect()->to('admin');
    }
    public function create_account()
    {
        $id = $_SESSION['universitas_id'];
        $data = [
            'validation' => \Config\Services::validation(),
            'institusi' => $this->InstitusiModel->first(),
            'admin' => $this->AdminModel->select('institusi.*')->join('institusi', 'user.universitas_id=institusi.universitas_id')->where('user.universitas_id', $id)->first()

        ];

        echo view('layout/header', $data);
        echo view('admin/create_account', $data);
        echo view('layout/footer');
    }
    public function save_account()
    {
        if (!$this->validate([

            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[user.email]',
                'errors' => [
                    'required' => '{field} is required!',
                    'is_unique' => '{field} cannot be the same!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ]

        ])) {
            return redirect()->to('/Admin/create_account')->withInput();
        }

        $this->AdminModel->save([

            'universitas_id' => $this->request->getVar('universitas_id'),
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'jabatan' => $this->request->getVar('jabatan'),
            'status' => $this->request->getVar('status')
        ]);
        return redirect()->to('admin');
    }
    public function create_tarif()
    {

        $id = $_SESSION['universitas_id'];
        $data = [
            'validation' => \Config\Services::validation(),
            'tarif' => $this->KendaraanModel->findAll(),
            'admin' => $this->AdminModel->select('institusi.*')->join('institusi', 'user.universitas_id=institusi.universitas_id')->where('user.universitas_id', $id)->first()
        ];

        echo view('layout/header', $data);
        echo view('admin/edit_tarif', $data);
        echo view('layout/footer');
    }

    public function update_tarif()
    {

        if (!$this->validate([
            'newprice_fixed' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} is required!',
                    'numeric' => 'New Price must be number'
                ]

            ],
            'newprice_flat' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} is required!',
                    'numeric' => 'New Price must be number'
                ]

            ]

        ])) {
            return redirect()->to('/Admin/create_tarif')->withInput();
        }
        $tipe = $this->request->getVar('tipe');
        $harga = $this->request->getVar('newprice_fixed');
        $harga_flat = $this->request->getVar('newprice_flat');
        $kendaraan_id = $this->request->getVar('kendaraan_id');
        $this->KendaraanModel->set('type', $tipe)->set('harga', $harga)->set('harga_flat', $harga_flat)->where('kendaraan_id', $kendaraan_id)->update();
        session()->setFlashdata('success msg', 'Tarif berhasil diubah.');
        return redirect()->to('admin');
    }
}
