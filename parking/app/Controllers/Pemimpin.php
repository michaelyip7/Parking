<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\AdminModel;
use App\Controllers\BaseController;


class Pemimpin extends BaseController
{

    public function __construct()
    {
        $this->TransaksiModel = new TransaksiModel();
        $this->AdminModel = new AdminModel();
    }
    public function index()
    {

        $tgl = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');
        $choice = $this->request->getVar('option');

        if (!$choice) {
            $choice = date('Y');
        }
        if (!$tgl) {
            $tgl = date('Y-m-d');
            $tgl_akhir = date('Y-m-d');
        }

        $waktu_awal = date('Y-m-d 00:00:00', strtotime($tgl));
        $waktu_akhir = date('Y-m-d 23:59:59', strtotime($tgl_akhir));

        $waktu_harian1 = date('Y-m-d 00:00:00', strtotime($tgl));
        $waktu_harian2 = date('Y-m-d 23:59:59', strtotime($tgl));
        $waktu_mingguan = date('Y-m-d', strtotime($tgl));
        $waktu_bulanan1 = date('Y-m-01', strtotime($tgl));
        $waktu_bulanan2 = date('Y-m-31', strtotime($tgl));
        $waktu_tahunan1 = date('Y-01-01', strtotime($tgl));
        $waktu_tahunan2 = date('Y-12-31', strtotime($tgl));



        $id = $_SESSION['universitas_id'];
        $data = [
            'admin' => $this->AdminModel->select('institusi.*')->join('institusi', 'user.universitas_id=institusi.universitas_id')->where('user.universitas_id', $id)->first(),
            'tgl' => $tgl,
            'choice' => $choice,
            'tgl_akhir' => $tgl_akhir,
            'option' => $this->TransaksiModel->select('min(date_format(waktu_masuk,"%Y")) as min')->select('max(date_format(waktu_masuk,"%Y")) as max')->first(),
            'total_mobil' => $this->TransaksiModel->where('kendaraan_id', '1')->where('date_format(waktu_masuk,"%Y")="' . $choice . '"')->selectCount('kendaraan_id')->first(),
            'total_motor' => $this->TransaksiModel->where('kendaraan_id', '2')->where('date_format(waktu_masuk,"%Y")="' . $choice . '"')->selectCount('kendaraan_id')->first(),
            'total_sepeda' => $this->TransaksiModel->where('kendaraan_id', '3')->where('date_format(waktu_masuk,"%Y")="' . $choice . '"')->selectCount('kendaraan_id')->first(),
            'total_pilihan' => $this->TransaksiModel->where('waktu_keluar >=', $waktu_awal)->where('waktu_keluar <=', $waktu_akhir)->where('status', 'out')->selectSum('tarif')->first(),
            'total_harian' => $this->TransaksiModel->where('waktu_keluar >=', $waktu_harian1)->where('waktu_keluar <=', $waktu_harian2)->where('status', 'out')->selectSum('tarif')->first(),
            'total_mingguan' => $this->TransaksiModel->where('((date_format(waktu_keluar, "%d") - 1) DIV 7)=((date_format("' . $waktu_mingguan . '", "%d") - 1) DIV 7)')->where('date_format(waktu_keluar, "%Y%m")=date_format("' . $waktu_mingguan . '", "%Y%m")')->where('status', 'out')->selectSum('tarif')->first(),
            'total_bulanan' => $this->TransaksiModel->where('waktu_keluar >=', $waktu_bulanan1)->where('waktu_keluar <=', $waktu_bulanan2)->where('status', 'out')->selectSum('tarif')->first(),
            'total_tahunan' => $this->TransaksiModel->where('waktu_keluar >=', $waktu_tahunan1)->where('waktu_keluar <=', $waktu_tahunan2)->where('status', 'out')->selectSum('tarif')->first()
        ];
        //d($data['total_mingguan']);
        // var_dump($data['total_tahunan']);


        echo view('layout/header', $data);
        echo view('pemimpin/pemimpin_view', $data);
        echo view('layout/footer');
    }
}
