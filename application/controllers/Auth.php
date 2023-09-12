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

    function login()
    {
        $this->load->view('login');    
    }

    function logout()
    {
        $this->session->sess_destroy();
        return redirect('login');    
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
}
