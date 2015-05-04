<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata['user_id'] == null){
            redirect(site_url('login'));
        }
    }

    public function index() {
        $this->load->view('page-home');
    }
    public function createCert(){
        $this->load->view('page-create-cert');
    }
}
