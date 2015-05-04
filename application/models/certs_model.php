<?php

class Certs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function createCert(){
        // Fill in data for the distinguished name to be used in the cert
        // You must change the values of these keys to match your name and
        // company, or more precisely, the name and company of the person/site
        // that you are generating the certificate for.
        // For SSL certificates, the commonName is usually the domain name of
        // that will be using the certificate, but for S/MIME certificates,
        // the commonName will be the name of the individual who will use the
        // certificate.
        $dn = array(
            "countryName" => "UK",
            "stateOrProvinceName" => "Somerset",
            "localityName" => "Glastonbury",
            "organizationName" => "The Brain Room Limited",
            "organizationalUnitName" => "PHP Documentation Team",
            "commonName" => "Wez Furlong",
            "emailAddress" => "wez@example.com"
        );
        
        // Generate a new private (and public) key pair
        $privkey = openssl_pkey_new();
        
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
        openssl_x509_export($sscert, $certout) and var_dump($certout);
        openssl_pkey_export($privkey, $pkeyout, "mypassword") and var_dump($pkeyout);
        
        // Show any errors that occurred here
        while (($e = openssl_error_string()) !== false) {
            echo $e . "\n";
        }
        
    }
    public function createUser($username, $password) {
        $is_exist = $this->checkUsername($username);

        if (!$is_exist) {
            $sql = 'insert into users values(\''.$this->generate_uuid_v4().'\',\''.$username.'\''.',\''.sha1($password).'\')';
            return $this->db->query($sql);
        }
        else {
            return false; // User exists
        }

    }

    public function checkUsername($username) {
        $sql = 'select * from users where user_name = \''.$username.'\'';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true; // User with $username found
        }
        else {
            return false; // Not found
        }

    }

    public function login($username, $password) {
        $sql = 'select user_id, user_name from users where user_name = \''.$username.'\' and user_password = \''.sha1($password).'\'';
        echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $user_data = $query->first_row();
            $this->session->set_userdata('user_id', $user_data->user_id);
            $this->session->set_userdata('user_name', $user_data->user_name);
            return true; // User and password match
        }
        else {
            return false; // User and password doesn't match or user doesn't exist
        }
    }

    private function generate_uuid_v4() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}