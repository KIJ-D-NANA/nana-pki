<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cert1 extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata['user_id'] == null){
            redirect(site_url('login'));
        }
    }

    public function index() {
       $config = array(
            "digest_alg" => "sha256",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );
    $dn = array(
            "countryName" => "ID",
            "organizationName" => "OwnCA Beta Inc",
            "organizationalUnitName" => "OwnCA Certification Authority",
            "commonName" => "OwnCA Certification Authority",
            "emailAddress" => "admin@nana-pki-raizan.c9.io"
        );
        // Create the private and public key
        $res = openssl_pkey_new($config);
        openssl_pkey_export($res, $privkey);
        $pubkey=openssl_pkey_get_details($res);
        var_dump($privkey);
        echo '<br>';
        var_dump($pubkey['key']);
        echo '<br>';
         $csr = openssl_csr_new($dn, $privkey);
          $bytes = openssl_random_pseudo_bytes(8, $cstrong);
        $sscert = openssl_csr_sign($csr, null, $privkey, 365,$config,hexdec(bin2hex($bytes)));
         openssl_csr_export($csr, $csrout) and var_dump($csrout);
         echo '<br>';
        openssl_x509_export($sscert, $certout) and var_dump( $certout);
        echo '<br>';
        openssl_pkey_export($privkey, $pkeyout, "mypassword") and var_dump( $pkeyout);
         if ( ! write_file('certificates/cert/test.csr', $csrout, 'wb')) {
             echo 'Unable to write the file';
        }
        else {
             echo 'File written!';
        }
    }
    public function create(){
        var_dump($this->input->post());
        var_dump($_FILES);
       $csr = read_file($_FILES['csr']['tmp_name']); 
       $ca = read_file('certificates/ca/ca.crt');
       echo $csr;
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
        
        
    }

}
