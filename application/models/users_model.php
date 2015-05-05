<?php

class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function createUser($username, $password) {
        $is_exist = $this->checkUsername($username);
        $salted_password = $password.$username;
        $hashed_password = hash('sha256', $salted_password);
        if (!$is_exist) {
            $sql = 'insert into users values(\''.$this->generate_uuid_v4().'\',\''.$username.'\''.',\''.$hashed_password.'\')';
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
        $salted_password = $password.$username;
        $hashed_password = hash('sha256', $salted_password);
        $sql = 'select user_id, user_name from users where user_name = \''.$username.'\' and user_password = \''.$hashed_password.'\'';
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