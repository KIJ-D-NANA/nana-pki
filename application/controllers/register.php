<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function index() {
        $this->load->view('page-register');
    }

    public function create() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $confirmation = $this->input->post('confirmation');

        if ($password != $confirmation) {
            // Handling here
            redirect(site_url('register'));
        }

        else {
            $query = $this->users_model->createUser($username, $password);
            if ($query == true) {
                redirect(site_url('login'));
            }
            else {
                // Handling here
                // User with that username already exists
                redirect(site_url('register'));
            }
        }
    }


}

/* End of file login.php */
/* Location: ./application/controllers/login.php */