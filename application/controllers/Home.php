<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $dbset;
    function __construct() {
        parent::__construct();
        
    }
	public function index()
	{
		if ($this->session->userdata('cUserId')) {
	       $this->load->view('view_home');
	    }else{
	    	$this->load->view('view_login');
	    }
		
	}


	
}
