<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata['user_id'] == null){
            redirect(site_url('login'));
        }
        else if($this->session->userdata['user_name']=='admin'){
            redirect(site_url('admin'));
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
        $result = $this->certs_model->getCertificateList($this->session->userdata('user_id'));
        $i = 0;
        $pack = array();
        if(isset($result)){
            foreach ($result as $row) {
            $pack[$i]["serial_number"] = $row->serial_number;
            $i++;
        }
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
        $result = $this->csr_model->getAll($this->session->userdata['user_id']);
        $i = 0;
        $pack = array();
        if(isset($result)){
            foreach ($result as $row) {
                $pack[$i]["csr_id"] = $row->csr_id;
                $pack[$i]["dn"] = openssl_csr_get_subject($row->csr_content);
                $i++;
            }
        }
        $data["pack"] = $pack;
        $data['title'] =  "CSR List";
        $data['url'] = 'home/listUserCsr';
        $this->load->view('client_header',$data);
        $this->load->view('title_header',$data);
        $this->load->view('page-user-csr',$data);
        $this->load->view('footer');
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
    
    public function exportcert(){
        $serial = $this->input->post('serial_number');
        $format = $this->input->post('format');
        $passphrase = $this->input->post('passphrase');
        
        
        $cert = $this->certs_model->getCertificate($serial);
        
        $this->load->helper('download');
        if ($format == "crt") {
            $name = $serial.'.crt';
            force_download($name, $cert);
        }
        
        // else if ($format == "pkcs12") {
        //     if (isset($passphrase)){
        //         openssl_pkcs12_export($cert, $p12content, $passphrase);
        //         $name = $serial.'.p12';
        //         force_download($name, $p12content);
        //     }     
        // }
        
        else {
            redirect(site_url('home/listusercert'));
        }
    }
}
