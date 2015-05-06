<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ca extends CI_Controller {

	public function __construct(){
		parent::__construct();
		        $this->load->helper('download');
		$ca =  file_get_contents("certificates/ca/signing-ca.crt");
		$name = "signing-ca.crt";
         force_download($name,$ca);
    }
}