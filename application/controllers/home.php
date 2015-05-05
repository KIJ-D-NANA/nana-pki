<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata['user_id'] == null){
            redirect(site_url('login'));
        }
        $this->load->model('csr_model');
    }

    public function index() {
        $this->load->view('page-home');
    }
    
    public function createCert(){
        $this->load->view('page-create-cert');
    }
    
    public function submitCsr(){
        $this->load->view('page-submit-csr');
    }
    
    public function uploadCsr(){
        $csr = $this->input->post('csr');
        
        $this->csr_model->saveCsr($csr);
        
        redirect(site_url('home'));
    }
}
