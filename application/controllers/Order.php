<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public $app_key = 'd8e92e25a897b3f365900ad50099a4db';

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

    function getProvinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $this->app_key"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }    
    }

    function getKota()
    {
        $province_id = $this->input->post('province_id');
        $curl = curl_init();

        curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=39&province=5",
        // CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=${province_id}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $this->app_key"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
    }

    function getOngkir()
    {
        $origin = 501; //jogja
        $destination_id = $this->input->post('destination_id');
        $weight = $this->input->post('berat');
        $kurir = $this->input->post('kurir');
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=${origin}&destination=${destination_id}&weight=${weight}&courier=${kurir}",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: $this->app_key"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }    
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
            'provinsi' => $this->input->post('hidden_provinsi'),
            'kota' => $this->input->post('hidden_kota'),
            'ongkir' => $this->input->post('ongkir'),
            'berat' => $this->input->post('berat'),
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
                    'provinsi' => $this->input->post('hidden_provinsi'),
                    'kota' => $this->input->post('hidden_kota'),
                    'ongkir' => $this->input->post('ongkir'),
                    'berat' => $this->input->post('berat'),
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
                        'provinsi' => $this->input->post('hidden_provinsi'),
                        'kota' => $this->input->post('hidden_kota'),
                        'ongkir' => $this->input->post('ongkir'),
                        'berat' => $this->input->post('berat'),
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
                        'provinsi' => $this->input->post('hidden_provinsi'),
                        'kota' => $this->input->post('hidden_kota'),
                        'ongkir' => $this->input->post('ongkir'),
                        'berat' => $this->input->post('berat'),
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
                'provinsi' => $this->input->post('provinsi'),
                'kota' => $this->input->post('kota'),
                'ongkir' => $this->input->post('ongkir'),
                'berat' => $this->input->post('berat'),
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
