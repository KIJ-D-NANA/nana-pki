<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata['user_id'] == null){
            redirect(site_url('login'));
        }
        $this->load->model('csr_model');
        $this->load->model('certs_model');
    }

    public function index() {
        $data['title'] =  "Create your own Certificate";
        $data['url'] = 'home';
        $this->load->view('client_header',$data);
        $this->load->view('page-home');
        $this->load->view('footer');
    }
    
    public function submitCsr(){
        $data['title'] = "Request Signed Certificate";
        $data['url'] = 'home/submitCsr';
        $this->load->view('client_header',$data);
        $this->load->view('title_header',$data);
        $this->load->view('page-submit-csr');
        $this->load->view('footer');
    }

    public function listUserCert(){
        $result = $this->certs_model->getCertificateList();
        $i = 0;
        $pack = array();
        foreach ($result as $row) {
            $pack[$i]["serial_number"] = $row->serial_number;
        }
        $data["pack"] = $pack;
        $data['title'] =  "Certificate List";
        $data['url'] = 'home/listUserCert';
        $this->load->view('client_header',$data);
        $this->load->view('title_header',$data);
        $this->load->view('page-user-cert',$data);
        $this->load->view('footer');
    
    }
    
    public function listUserCsr(){
        $result = $this->csr_model->getAll();
        $i = 0;
        $pack = array();
        
        foreach ($result as $row) {
            $pack[$i]["csr_id"] = $row->csr_id;
        }
        
        $data["pack"] = $pack;
        $this->load->view('page-user-csr', $data);
    }

    public function uploadCsr(){
        $csr = read_file($_FILES['csr']['tmp_name']); 
        $usage = $this->input->post('usage');
        $this->csr_model->saveCsr($csr,$usage);
        
        redirect(site_url('home'));
    }
    
    public function listCert(){
        // Client can download his/her certificate here, using any format he/she requested.
        // Can request to revoke the certificate, dont forget to ask the reason
        // Data representation: Table
    }
    
    public function exportcert($format, $serial_number){
        
    }
}
