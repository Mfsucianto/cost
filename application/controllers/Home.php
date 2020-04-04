<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $dbset;
    function __construct() {
        parent::__construct();
        
    }
	public function index()
	{	
		$iPeran      = $this->session->userdata('iPeran');

		if ($this->session->userdata('cUserId')) {
			if ($iPeran==1){
				$this->load->view('view_home');
			}else{
				$this->load->view('view_home_pegawai');
			}
	       
	    }else{
	    	$this->load->view('view_login');
	    }
		
	}


	
}
