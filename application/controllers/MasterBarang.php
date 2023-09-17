<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterBarang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('JenisKainModel');
        $this->load->model('UkuranModel');
        $this->load->model('ModelModel');
        $this->load->model('JenisPakaianModel');
        $this->load->model('WarnaModel');
        $this->load->model('KeteranganModel');
        // $this->load->model('MasterBarangModel');
        // if (isset($_SESSION['username'])) { } else {
        //     redirect('start');
        // }
    }

	public function index()
	{
        $data = [
            'content' => 'admin/master_barang',
            'jenisKain' => $this->JenisKainModel->getJenisKain(),
            'ukuran' => $this->UkuranModel->getUkuran(),
            'model' => $this->ModelModel->getModel(),
            'jenisPakaian' => $this->JenisPakaianModel->getJenisPakaian(),
            'warna' => $this->WarnaModel->getWarna(),
            'keterangan' => $this->KeteranganModel->getKeterangan(),
            // 'masterBarang' => $this->MasterBarangModel->getMasterBarang(),
        ];
		$this->load->view('layout_admin', $data);
	}

}