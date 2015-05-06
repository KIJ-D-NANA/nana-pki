<?php

class Csr_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function saveCsr($csr, $usage) {
        $uuid = $this->generate_uuid_v4();
        $user_id = $this->session->userdata('user_id');
        
        $sql = 'insert into csr values(\''.$uuid.'\',\''.$user_id.'\''.',\''.$csr.'\', 0,\''.$usage.'\', now())';
        $this->db->query($sql);
    }
    
    public function getAll() {
        $sql = 'select * from csr, users where csr.user_id = users.user_id and csr.csr_signed = false';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
           return $query->result();
        }
        else {
            // Failed
        }
    }
    
    public function signCsr($csr_id) {
        $sql = 'update csr set csr_signed = 1 where csr_id = \''.$csr_id.'\'';
        $query = $this->db->query($sql);
    }
    
    public function getCsr($csr_id) {
        $sql = 'select csr_content from csr where csr_id = \''.$csr_id.'\'';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
           $result = $query->row();
           return $result->csr_content;
        }
        else {
            // Failed
        }
    }
    
    public function getUsage($csr_id) {
        $sql = 'select cert_usage from csr where csr_id = \''.$csr_id.'\'';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
           $result = $query->row();
           return $result->cert_usage;
        }
        else {
            // Failed
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