<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cert extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata['user_id'] == null){
            redirect(site_url('login'));
        }
    }

    public function index() {
        $this->load->view('page-home');
    }
    public function create(){
        var_dump($this->input->post());
        var_dump($_FILES);
       $publickey = read_file($_FILES['publickey']['tmp_name']); 
       echo $publickey;
         // Fill in data for the distinguished name to be used in the cert
        // You must change the values of these keys to match your name and
        // company, or more precisely, the name and company of the person/site
        // that you are generating the certificate for.
        // For SSL certificates, the commonName is usually the domain name of
        // that will be using the certificate, but for S/MIME certificates,
        // the commonName will be the name of the individual who will use the
        // certificate.
        $dn = array(
            "countryName" => $this->input->post('countryname'),
            "stateOrProvinceName" => $this->input->post('stateorprovincename'),
            "localityName" => $this->input->post('localityname'),
            "organizationName" => $this->input->post('organizationname'),
            "organizationalUnitName" => $this->input->post('organizationalunitname'),
            "commonName" => $this->input->post('commonname'),
            "emailAddress" => $this->input->post('emailaddress')
        );
         $config = array(
            "digest_alg" => "sha256",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );
        var_dump($dn);
        // Generate a new private (and public) key pair
        $privkey = openssl_pkey_new($config);
        
        // Generate a certificate signing request
        $csr = openssl_csr_new($dn, $privkey);
        
        // You will usually want to create a self-signed certificate at this
        // point until your CA fulfills your request.
        // This creates a self-signed cert that is valid for 365 days
        $sscert = openssl_csr_sign($csr, null, $privkey, 365);
        
        // Now you will want to preserve your private key, CSR and self-signed
        // cert so that they can be installed into your web server, mail server
        // or mail client (depending on the intended use of the certificate).
        // This example shows how to get those things into variables, but you
        // can also store them directly into files.
        // Typically, you will send the CSR on to your CA who will then issue
        // you with the "real" certificate.
        openssl_csr_export($csr, $csrout) and var_dump($csrout);
        openssl_x509_export($sscert, $certout) and var_dump( $certout);
        openssl_pkey_export($privkey, $pkeyout, "mypassword") and var_dump( $pkeyout);
        
        // Show any errors that occurred here
        while (($e = openssl_error_string()) !== false) {
            echo $e . "\n";
        }
         if ( ! write_file('certificates/cert/client.crt', $certout, 'wb')) {
             echo 'Unable to write the file';
        }
        else {
             echo 'File written!';
        }
    }

}
