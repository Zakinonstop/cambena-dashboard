<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct()
     {
        parent:: __construct();
        $this->load->model('AuthModel');    
    }
	public function index()
	{
        $data = [
            'content' => 'admin/dashboard',
        ];
		$this->load->view('layout_admin', $data);
	}

    function register()
    {
        $this->load->view('register');    
    }

    function postRegister()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'password' => $this->input->post('password'),
        ];

        $action = $this->AuthModel->postRegister($data);
        if ($action) {
            return redirect('login');
        }
    }

    function login()
    {
        $this->load->view('login');    
    }
    function loginAdmin()
    {
        $this->load->view('login_admin');    
    }

    function logout()
    {
        $this->session->sess_destroy();
        return redirect();    
    }
    
    function postLogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $cek = $this->AuthModel->postLogin($email, $password);
        // var_dump($username);
        // die;
        if ($cek->num_rows() > 0) {
            $username = $cek->row()->nama;
            $id = $cek->row()->id;
            $userdata = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
            ];

            $this->session->set_userdata($userdata);
            return redirect('order');  
        }
        return redirect('login');  
    }
    function postLoginAdmin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $cek = $this->AuthModel->postLoginAdmin($email, $password);
        
        if ($cek->num_rows() > 0) {
            $username = $cek->row()->nama;
            $id = $cek->row()->id;
            $userdata = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
            ];

            $this->session->set_userdata($userdata);
            return redirect('master-barang');  
        }
        return redirect('login-admin');  
    }
}
