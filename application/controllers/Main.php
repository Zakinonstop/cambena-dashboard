<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function index()
    {
        $this->load->view('user/header');
        $this->load->view('user/index');
        $this->load->view('user/footer');
    }

    public function signin()
    {
        $this->load->view('signin');
    }

    public function signup()
    {
        $this->load->view('signup');
    }
}
