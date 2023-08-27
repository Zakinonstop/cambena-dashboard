<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
        // if (isset($_SESSION['username'])) { } else {
        //     redirect('start');
        // }
    }

	public function index()
	{
        $data = [
            'content' => 'user/order',
        ];
		$this->load->view('layout_user', $data);
	}

     function getOrder()
    {
        $output = $this->OrderModel->getOrder();
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

            $action = $this->OrderModel->remove($id);
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
            'id_model' => $this->input->post('id_model'),
            'id_jenis_pakaian' => $this->input->post('id_jenis_pakaian'),
            'id_jenis_kain' => $this->input->post('id_jenis_kain'),
'id_ukuran' => $this->input->post('id_ukuran'),
'id_warna' => $this->input->post('id_warna'),
'id_keterangan' => $this->input->post('id_keterangan'),
        ];
        
        $result = $this->OrderModel->create($data);

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

    function getOrderById()
    {
        if ($this->input->method() == 'post') {
            $id = $this->input->post('id');

            $action = $this->OrderModel->getOrderById($id)->row();
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
            $Order = $this->OrderModel->find($id);  
            $nama_foto = $Order->foto;
            $file_path = '../upload/Order/img/'. $nama_foto;
            
            $file = $_FILES['foto'];
            $file_name = $file['name'];
            
            if($file['error'] === UPLOAD_ERR_OK) { //cek file ok
                //jika file teredit/ berubah
                $uniq_name = uniqid().'-'.$file_name;
                
                // ambil data, termasuk namanya
                $data = [
                    'id_model' => $this->input->post('id_model'),
                    'id_jenis_pakaian' => $this->input->post('id_jenis_pakaian'),
                    'id_jenis_kain' => $this->input->post('id_jenis_kain'),
                    'id_ukuran' => $this->input->post('id_ukuran'),
                    'id_warna' => $this->input->post('id_warna'),
                    'id_keterangan' => $this->input->post('id_keterangan'),
                    'foto' => $uniq_name,
                ];
                
                $tmp = $file['tmp_name']; //temporary name path
                
                $uploadDir = '../upload/Order/img/';
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
                        'id_model' => $this->input->post('id_model'),
                        'id_jenis_pakaian' => $this->input->post('id_jenis_pakaian'),
                        'id_jenis_kain' => $this->input->post('id_jenis_kain'),
                        'id_ukuran' => $this->input->post('id_ukuran'),
                        'id_warna' => $this->input->post('id_warna'),
                        'id_keterangan' => $this->input->post('id_keterangan'),
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
                        'id_model' => $this->input->post('id_model'),
                        'id_jenis_pakaian' => $this->input->post('id_jenis_pakaian'),
                        'id_jenis_kain' => $this->input->post('id_jenis_kain'),
                        'id_ukuran' => $this->input->post('id_ukuran'),
                        'id_warna' => $this->input->post('id_warna'),
                        'id_keterangan' => $this->input->post('id_keterangan'),
                    ];
                    
                }
            }
            
        }else {
            $data = [
                'id_model' => $this->input->post('id_model'),
                'id_jenis_pakaian' => $this->input->post('id_jenis_pakaian'),
                'id_jenis_kain' => $this->input->post('id_jenis_kain'),
                'id_ukuran' => $this->input->post('id_ukuran'),
                'id_warna' => $this->input->post('id_warna'),
                'id_keterangan' => $this->input->post('id_keterangan'),
            ];
        }

        // Simpan data ke dalam tabel
        $result = $this->OrderModel->update($id, $data);

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
