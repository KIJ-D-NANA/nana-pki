<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata['user_id'] == "admin"){
            redirect(site_url('login'));
        }
    }
    
    public function generate_crl(){
        $cert = "file://path/to/ca.cert.pem";
        $key = "file://path/to/ca.key.pem";
        $crl = "file://path/to/crl.pem";
        $generating = proc_open("openssl ca -keyfile $key -cert $cert -gencrl -out $crl");
    }
    
    public function revoke(){
        $privatekey = "ca.key.pem";
        $cert = "ca.cert.pem";
        $usercert = "someone.cert.pem";
        $revoking = proc_open("openssl ca -keyfile $privatekey -cert $cert -revoke $usercert");
    }
}