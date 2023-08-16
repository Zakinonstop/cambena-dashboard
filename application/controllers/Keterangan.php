<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keterangan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('KeteranganModel');
        // if (isset($_SESSION['username'])) { } else {
        //     redirect('start');
        // }
    }

	public function index()
	{
        $data = [
            'content' => 'admin/keterangan',
            'keterangan' => $this->KeteranganModel->getKeterangan(),
        ];
		$this->load->view('layout_admin', $data);
	}
    
    function getKeterangan()
    {
        $output = $this->KeteranganModel->getKeterangan();
        echo json_encode($output);
    }

    function getKategori()
    {
        $response = $this->KategoriModel->getKategori();
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
            exit;
    }

    public function remove()
    {
        if ($this->input->method() == 'post') {
            $id = $this->input->post('id');

            $action = $this->KeteranganModel->remove($id);
            if ($action) {
                $response = [
                    'status' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Data berhasil dihapus',
                ];
            }else {
                $response = [
                    'status' => 'gagal',
                    'title' => 'Gagal!',
                    'message' => 'Data gagal dihapus',
                ];
            }

            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
            exit;
        }
    }

    public function create()
    {
        $data = [
            'nama' => $this->input->post('nama'),
        ];
        
        $result = $this->KeteranganModel->create($data);

        if ($result) {
            $response = [
                'status' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Data berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => 'error',
                'title' => 'Gagal!',
                'message' => 'Data gagal ditambahkan',
            ];
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    function getKeteranganById()
    {
        if ($this->input->method() == 'post') {
            $id = $this->input->post('id');

            $action = $this->KeteranganModel->getKeteranganById($id)->row();
            $response = $action;

            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
            exit;
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        
        //jika ada fotonya
        if(isset($_FILES['foto'])) { 
            $no_foto = $this->input->post('no_foto');
            $Keterangan = $this->KeteranganModel->find($id);  
            $nama_foto = $Keterangan->foto;
            $file_path = '../upload/Keterangan/img/'. $nama_foto;
            
            $file = $_FILES['foto'];
            $file_name = $file['name'];
            
            if($file['error'] === UPLOAD_ERR_OK) { //cek file ok
                //jika file teredit/ berubah
                $uniq_name = uniqid().'-'.$file_name;
                
                // ambil data, termasuk namanya
                $data = [
                    'nama' => $this->input->post('nama'),
                    'foto' => $uniq_name,
                ];
                
                $tmp = $file['tmp_name']; //temporary name path
                
                $uploadDir = '../upload/Keterangan/img/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                move_uploaded_file($tmp, $uploadDir.$uniq_name);
                
                // file yang lama dihapus 
                if($nama_foto){
                    unlink($file_path);
                }
                
            }else {
                // jika foto kosong
                if($no_foto == 'no_foto') {
                    // ambil datanya, beri nilai kosong pada foto 
                    $data = [
                        'nama' => $this->input->post('nama'),
                        'foto' => '',
                    ];
                    
                    // file yang lama dihapus
                    if($nama_foto) {
                        unlink($file_path);
                    }
                    
                // jika file tidak teredit
                }else {
                    // ambil datanya, tanpa nama foto 
                    $data = [
                        'nama' => $this->input->post('nama'),
                    ];
                    
                }
            }
            
        }else {
            $data = [
                'nama' => $this->input->post('nama'),
            ];
        }

        // Simpan data ke dalam tabel
        $result = $this->KeteranganModel->update($id, $data);

        if ($result) {
            $response = [
                'status' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Data berhasil diperbarui',
            ];
        } else {
            $response = [
                'status' => 'error',
                'title' => 'Gagal!',
                'message' => 'Data gagal diperbarui',
            ];
        }

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
            exit;
    }
}
