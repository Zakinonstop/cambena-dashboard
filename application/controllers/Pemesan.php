<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PemesanModel');
        $this->load->model('PesananModel');
        // if (isset($_SESSION['username'])) { } else {
        //     redirect('start');
        // }
    }

	public function index()
	{
        $data = [
            'content' => 'admin/pemesan',
            'pemesan' => $this->PemesanModel->getPemesan(),
            'pesanan' => $this->PesananModel->getPesanan(),
        ];
		$this->load->view('layout_admin', $data);
	}

    
    function getPemesan()
    {
        $output = $this->PemesanModel->getPemesan();
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

            $action = $this->PemesanModel->remove($id);
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
        
        $result = $this->PemesanModel->create($data);

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

    function getPemesanById()
    {
        if ($this->input->method() == 'post') {
            $id = $this->input->post('id');

            $action = $this->PemesanModel->getPemesanById($id)->row();
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
            $Pemesan = $this->PemesanModel->find($id);  
            $nama_foto = $Pemesan->foto;
            $file_path = '../upload/Pemesan/img/'. $nama_foto;
            
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
                
                $uploadDir = '../upload/Pemesan/img/';
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
        $result = $this->PemesanModel->update($id, $data);

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
