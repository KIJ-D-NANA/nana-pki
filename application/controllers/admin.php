<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata['user_id'] == "admin"){
            redirect(site_url('login'));
        }
        $this->load->model('csr_model');
    }

    public function index() {
        echo "Home admin";
        echo "<br> Tambahkan link ke csrlist(), certlist()";
    }
    
    public function csrlist() {
        $result = $this->csr_model->getAll();
        $i = 0;
        $pack = array();
        foreach ($result as $row) {
            $pack[$i]["dn"] = openssl_csr_get_subject($row->csr_content);
            $pack[$i]["username"] = $row->user_name;
            $pack[$i]["csr_id"] = $row->csr_id;
        }
        
        $data["pack"] = $pack;
        $this->load->view('page-admin', $data);
    }
    
    public function signCsr($csr_id) {
        
        // Get CSR from database
        $csrdata = $this->csr_model->getCsr($csr_id);
        
        $cacert_path = "certificates/ca/signing-ca.crt";
        $cacert_open = fopen($cacert_path, 'rb');
        $cacert = fread($cacert_open, filesize($cacert_path));
        
        $privkey_path = "certificates/ca/signing-ca.key";
        $privkey_open = fopen($privkey_path, 'rb');
        $privkey = fread($privkey_open, filesize($privkey_path));
        
        // Noticed that client should have privilege to choose
        // what configuration we should use when signing
        // Example: 
        // $config = array(
        //    "digest_alg" => "sha256",
        //    "private_key_bits" => 2048,
        //    "private_key_type" => OPENSSL_KEYTYPE_RSA,
        // );
        // And they should choose the type of certificate
        // (See: certificate key usage field)
        // Reference: http://www.databasemart.com/howto/SQLoverssl/How_To_Request_Certificate_From_Certificate_Authority_Server_In_Internet_Explore.aspx
        
        $config = array(
            "digest_alg" => "sha256",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA
        );
        
        
        $seed = openssl_random_pseudo_bytes(8, $cstrong); // Generate serial number
        $serial = hexdec(bin2hex($seed));
        // Query here: check if serial number is already exist
        // If it doesn't exist, then you can sign the certificate
        // Else randomize again and check until you get the unique one
        $usercert = openssl_csr_sign($csrdata, $cacert, array($privkey, "raizan"), 365, $config, $serial);
        
        // Get serial number, save certificate to database
        openssl_x509_export($usercert, $certout);
        
        
        // Codes below tell you how to export certificate to pkcs#12 format, so you can import it to browser
        $privkey_path = "certificates/cert/www_raizan_com.key";
        $privkey_open = fopen($privkey_path, 'rb');
        $privkey = fread($privkey_open, filesize($privkey_path));
        
        // raizan here is a password that will be asked when you're gonna import this certificate
        openssl_pkcs12_export ( $certout , $p12out , $privkey, "raizan");  
        
        $open = fopen("certificates/cert/raizan.p12", 'wb');
        fwrite($open, $p12out);
        // I propose that client can choose which format their certificate will be exported when requested.
    }
    
    public function certlist() {
        // Untuk listing sertifikat
        // Revoke bisa dilakukan di sini
        // Presentasi data dalam bentuk tabel
    }
    
}
