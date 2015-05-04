<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('users_model');
	}

	public function index() {
		$this->load->view('page-login');
	}

	public function check() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $login = $this->users_model->login($username, $password);

        if ($login) {
            // Session started
            redirect('home');
        }
        else {
            // Set message incorrect username or password
            redirect('login', 'refresh');
        }
    }
    
}