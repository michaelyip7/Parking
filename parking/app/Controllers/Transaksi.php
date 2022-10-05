<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\KendaraanModel;
use App\Models\AdminModel;

use CodeIgniter\I18n\Time;

class Transaksi extends BaseController
{

	public function __construct()
	{
		$this->TransaksiModel = new TransaksiModel();
		$this->KendaraanModel = new KendaraanModel();
		$this->AdminModel = new AdminModel();
	}
	public function index()
	{
		$id = $_SESSION['universitas_id'];
		$currentPage = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

		$keyword = $this->request->getVar('keyword');

		if ($keyword) {
			$transaksi = $this->TransaksiModel->search($keyword);
			$transaksi2 = $transaksi->join('jenis_kendaraan', 'transaksi.kendaraan_id=jenis_kendaraan.kendaraan_id')->paginate(5, 'transaksi');
		} else {
			$transaksi2 = $this->TransaksiModel->orderby('id', 'ASC')->join('jenis_kendaraan', 'transaksi.kendaraan_id=jenis_kendaraan.kendaraan_id')->paginate(5, 'transaksi');
		}


		$data = [
			'title' => 'Home',
			'transaksi' => $transaksi2,
			'pager' => $this->TransaksiModel->pager,
			'currentPage' => $currentPage,
			'admin' => $this->AdminModel->select('institusi.*')->join('institusi', 'user.universitas_id=institusi.universitas_id')->where('user.universitas_id', $id)->first()
		];
		echo view('layout/header', $data);
		echo view('petugas/home_view', $data);
		echo view('layout/footer');
	}

	public function selesai($id)
	{
		$asd = $_SESSION['universitas_id'];
		$data = [
			'title' => 'detail transaksi',
			'transaksi' => $this->TransaksiModel->getDetail($id),
			'admin' => $this->AdminModel->select('institusi.*')->join('institusi', 'user.universitas_id=institusi.universitas_id')->where('user.universitas_id', $asd)->first(),
			'kendaraan' => $this->TransaksiModel->select('transaksi.*,jenis_kendaraan.*')->join('jenis_kendaraan', 'transaksi.kendaraan_id=jenis_kendaraan.kendaraan_id')
		];

		if (empty($data['transaksi'])) {
			throw new \CodeIgniter\exceptions\PageNotFoundException('Tiket with ID ' . $id . ' cannot be found.');
		}
		echo view('layout/header', $data);
		echo view('petugas/detail_view', $data);
		echo view('layout/footer');
	}

	public function create()
	{
		$id = $_SESSION['universitas_id'];
		$data = [
			'validation' => \Config\Services::validation(),
			'kendaraan' => $this->KendaraanModel->findAll(),
			'admin' => $this->AdminModel->select('institusi.*')->join('institusi', 'user.universitas_id=institusi.universitas_id')->where('user.universitas_id', $id)->first()

		];

		echo view('layout/header', $data);
		echo view('petugas/create_view', $data);
		echo view('layout/footer');
	}

	public function save()
	{
		if (!$this->validate([
			'plat_nomor' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} is required!'
				]

			]

		])) {
			return redirect()->to('/Transaksi/create')->withInput();
		}
		$this->TransaksiModel->save([
			'kendaraan_id' => $this->request->getVar('kendaraan_id'),
			'plat_nomor' => $this->request->getVar('plat_nomor'),
			'petugas' => $_SESSION['nama'],
			'status' => $this->request->getVar('status')
		]);

		session()->setFlashdata('success msg', 'Data berhasil ditambahkan.');

		return redirect()->to('/transaksi');
	}

	public function update()
	{
		$this->TransaksiModel->save([
			'status' => $this->request->getVar('status')
		]);

		session()->setFlashdata('success msg', 'Data berhasil diubah.');

		return redirect()->to('/transaksi');
	}
	function finish($id)
	{
		$waktu = $this->TransaksiModel->getDetail($id);
		$tarif =  $this->TransaksiModel->select('jenis_kendaraan.*, transaksi.*')->join('jenis_kendaraan', 'transaksi.kendaraan_id=jenis_kendaraan.kendaraan_id')->getDetail($id);
		$waktu_masuk  = Time::parse($waktu['waktu_masuk']);
		$waktu_keluar = date('Y-m-d H:i:s');

		$diff = $waktu_masuk->difference($waktu_keluar);
		$gethour = $diff->getHours() + 1; // 24


		$total = $gethour * $tarif['harga'];

		if ($tarif['type'] == 'flat') {
			$total = ($gethour - 1) * $tarif['harga_flat'] + $tarif['harga'];
		}

		$hasil = $this->TransaksiModel->set('tarif', $total)
			->set('status', 'out')
			->where('id', $id)
			->update();

		return redirect()->to('/transaksi');
	}
}
