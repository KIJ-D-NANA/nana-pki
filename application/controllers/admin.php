<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // include(APPPATH.'libraries/phpseclib/Crypt/RSA.php');
        // include(APPPATH.'libraries/phpseclib/File/X509.php');
        if ($this->session->userdata['user_name'] != "admin"){
            redirect(site_url('home'));
        }
        $this->load->model('csr_model');
        $this->load->model('certs_model');
    }

    public function index() {
        // Fokus please bikin nya
        // $this->load->view('page-admin');
       $data['title'] =  "Admin";
        $data['url'] = 'admin';
        $this->load->view('admin_header',$data);
        $this->load->view('page-home');
        $this->load->view('footer');;
    }
    
    public function csrlist() {
        $result = $this->csr_model->getAll();
        $i = 0;
        $pack = array();
        if(isset($result)) {
            foreach ($result as $row) {
                $pack[$i]["dn"] = openssl_csr_get_subject($row->csr_content);
                $pack[$i]["username"] = $row->user_name;
                $pack[$i]["csr_id"] = $row->csr_id;
                $i++;
            }
        }
        
        $data["pack"] = $pack;
        $data['url'] = "home/csrlist";
        $data['title'] = "Certificate Signing Request";
        $this->load->view('admin_header',$data);
        $this->load->view('page-csr-list', $data);
        $this->load->view('footer');
    }
    
    public function signCsr($csr_id) {
        
        // Get CSR and usage from database
        $csrdata = $this->csr_model->getCsr($csr_id);
        $certusage = $this->csr_model->getUsage($csr_id);
        
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
        
        if ($certusage == "tls") {
            $config = array(
                "config" => "certificates/config/signing-ca.conf",
                "x509_extensions" => "server_ext",
                "digest_alg" => "sha256",
                "private_key_bits" => 2048,
                "private_key_type" => OPENSSL_KEYTYPE_RSA
            );
        }
        
        else if ($certusage == "email") {
            $config = array(
                "config" => "certificates/config/signing-ca.conf",
                "x509_extensions" => "email_ext",
                "digest_alg" => "sha256",
                "private_key_bits" => 2048,
                "private_key_type" => OPENSSL_KEYTYPE_RSA
            );
        }
        
        $serial = null;
        
        while(true){
            $seed = openssl_random_pseudo_bytes(8, $cstrong); // Generate serial number
            $serial = hexdec(bin2hex($seed));
            
            
            // Query here: check if serial number is already exist
            // If it doesn't exist, then you can sign the certificate
            // Else randomize again and check until you get the unique one
            
            $is_exist = $this->certs_model->checkSerial($serial);
            if(!$is_exist) {
                break;
            }
        }
        
        // raizan here is passphrase for private key
        $usercert = openssl_csr_sign($csrdata, $cacert, array($privkey, "raizan"), 365, $config, $serial);
        
        // Get serial number
        openssl_x509_export($usercert, $certout);
        // Update CSR Signed flag to "true"
        $this->csr_model->signCsr($csr_id);
        // Save certificate to database
        $this->certs_model->saveCertificate($serial, $csr_id, $certout);
        
        redirect(site_url('admin/csrlist'));
        
        // // Codes below tell you how to export certificate to pkcs#12 format, so you can import it to browser
        // $privkey_path = "certificates/cert/www_raizan_com.key";
        // $privkey_open = fopen($privkey_path, 'rb');
        // $privkey = fread($privkey_open, filesize($privkey_path));
        
        // // raizan here is a password that will be asked when you're gonna import this certificate
        // openssl_pkcs12_export ( $certout , $p12out , $privkey, "raizan");  
        
        // $open = fopen("certificates/cert/raizan.p12", 'wb');
        // fwrite($open, $p12out);
        // // I propose that client can choose which format their certificate will be exported when requested.
    }
    
    public function certlist() {
        // Untuk listing sertifikat
        // Revoke bisa dilakukan di sini
        $result = $this->certs_model->getCertificateList();
        $i = 0;
        $pack = array();
        
        foreach ($result as $row) {
            $pack[$i]["serial_number"] = $row->serial_number;
            $content = openssl_x509_parse($row->certificate_content);
            $pack[$i]["name"] = $content["name"];
            $pack[$i]["revoke_request"] = $row->revoke_request;
            $i++;
        }    
        $data["pack"] = $pack;
        // Presentasi data dalam bentuk tabel
        $data["pack"] = $pack;
        $data['url'] = "home/certlist";
        $data['title'] = "Certificate List";
        $this->load->view('admin_header',$data);
        $this->load->view('page-cert-list', $data);
        $this->load->view('footer');
    }

    public function revoke($serial_number){
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
