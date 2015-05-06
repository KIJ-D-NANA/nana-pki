<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        include(APPPATH.'library/phpseclib/Crypt/RSA.php');
        include(APPPATH.'library/phpseclib/File/X509.php');
        if ($this->session->userdata['user_id'] == "admin"){
            redirect(site_url('login'));
        }
        $this->load->model('certs_model');
    }
    
    public function index(){
        $data["cert"] = $this->certs_model->getCertificateList();
        $this->load->view('page-torevoke', $data);
    }
    
    public function generate_crl(){
        // Load the CA and its private key.
        $pemcakey = file_get_contents('myCAprivkey.pem');
        $cakey = new Crypt_RSA();
        $cakey->loadKey($pemcakey);
        $pemca = file_get_contents('myCA.pem');
        $ca = new File_X509();
        $ca->loadX509($pemca);
        $ca->setPrivateKey($cakey);
        
        // Load the CRL.
        $crl = new File_X509();
        $crl->loadCA($pemca); // For later signature check.
        $pemcrl = file_get_contents('myCRL.pem');
        $crl->loadCRL($pemcrl);
        
        // Validate the CRL.
        if ($crl->validateSignature() !== 1) {
            exit("CRL signature is invalid\n");
        }
        
        // Update the revocation list.
        $crl->setRevokedCertificateExtension('4321', 'id-ce-cRLReasons', 'privilegeWithdrawn');
        
        // Generate the new CRL.
        $crl->setEndDate('+3 months');
        $newcrl = $crl->signCRL($ca, $crl);
        
        // Output it.
        echo $crl->saveCRL($newcrl) . "\n";
    }
    
}