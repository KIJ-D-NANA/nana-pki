<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata['user_id'] == null){
            redirect('login');
        }
    }

    public function index()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */