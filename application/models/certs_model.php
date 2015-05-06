<?php

class Certs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getCertificateList(){
        $sql = 'select * from certificates';
        $query = $this->db->query($sql);
        $i = 0;
        foreach ($query->result() as row){
            $cert[$i]["serial_number"] = $row->serial_number;
            $i = $i + 1;
        }
        return $cert;
    }
    

    public function checkSerial($serial) {
        $sql = 'select * from certificates where serial_number = \''.$serial.'\'';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
           return true; // Found
        }
        else {
            return false; // Not found
        }
    }
    
    public function saveCertificate($serial, $csr_id, $cert) {
        $user_id = $this->session->userdata('user_id');
        $sql = 'insert into certificates values(\''.$serial.'\',\''.$user_id.'\''.',\''.$csr_id.'\''.',\''.$cert.'\')';
        $this->db->query($sql);
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