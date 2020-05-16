<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	 function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
       
    }

	public function index(){
		//print_r($this->session->userdata);
		if ($this->session->userdata('cUserId')) {
	       $this->load->view('view_home');
	    }else{
	    	$this->load->view('view_login');
	    }
	}
        
	public function login(){
		$userid 	= $_POST['_userid'];
		$password 	= $_POST['_password'];

		$vU = $this->lib_util->getSysparam('vU');
		$vP = $this->lib_util->getSysparam('vP');

		if ($userid == $vU && $password==$vP){
			$sess_data['logged_in'] 		= TRUE;
          	$sess_data['nip'] 			= 'root';
          	$sess_data['cUserId'] 			= $vU;
          	$sess_data['vUserName']	 		= 'Super Admin';
          	$sess_data['vImage'] 			= '';
          	$sess_data['iPeran'] 			= 99;
          	$sess_data['nama_akses']		= 'Super Admin';
          	$sess_data['iBidangId'] 		= 0;
          	$sess_data['vBidangName'] 		= '';
          	$sess_data['iSubBidangId'] 		= 0;
          	$sess_data['vSubBidangName'] 	= '';
          	$sess_data['iJabatanId'] 		= '';
          	$sess_data['vJabatanName'] 		= '';
          	$this->session->set_userdata($sess_data);
          	$x = 1;

		}else{

			$this->db->select('a.vNip,a.vName,a.iJabatanId,a.iBidangId,a.iSubBidangId,a.iPeran,a.vImage,b.vJabatanName,a.cUserId,c.vBidangName,d.vSubBidangName');
			$this->db->from('cost.ms_pegawai as a');
			$this->db->join('cost.ms_jabatan as b', 'b.iJabatanId = a.iJabatanId','left');
			$this->db->join('cost.ms_bidang as c', 'c.iBidangId = a.iBidangId','left');
			$this->db->join('cost.ms_sub_bidang as d', 'd.iSubBidangId = a.iSubBidangId','left');
			$this->db->where('a.cUserId',$userid);
			$this->db->where(" a.vPassword='".$password."'");
			$query = $this->db->get();

			
			if ($query->num_rows() > 0) {
				$row = $query->row();

				$list_level = array(0=>'',1=>'Admin',2=>'Pegawai',3=>'Kepala Bagian',4=>'Sub Bagian',5=>'Skretaris Bidang',6=>'Kepala Perwakilan');


			   	$sess_data['logged_in'] 		= TRUE;
	          	$sess_data['cUserId'] 			= $row->cUserId;
	          	$sess_data['nip'] 				= $row->vNip;
	          	$sess_data['vUserName']	 		= $row->vName;
	          	$sess_data['vImage'] 			= $row->vImage;
	          	$sess_data['iPeran'] 			= $row->iPeran;
	          	$sess_data['nama_akses']		= $list_level[$row->iPeran];
	          	$sess_data['iBidangId'] 		= $row->iBidangId;
	          	$sess_data['vBidangName'] 		= $row->vBidangName;
	          	$sess_data['iSubBidangId'] 		= $row->iSubBidangId;
	          	$sess_data['vSubBidangName'] 	= $row->vSubBidangName;
	          	$sess_data['iJabatanId'] 		= $row->iJabatanId;
	          	$sess_data['vJabatanName'] 		= $row->vJabatanName;
	          	$this->session->set_userdata($sess_data);
	          	$x = 1;
	          	//redirect('dashboard1');
			}else{
				$x = 0;
			}
		}

		

		echo $x;
		exit();
		
	}
        
   	public function logout(){
   		$sess_data['logged_in'] 		= FALSE;
      	$sess_data['cUserId'] 			= '';
      	$sess_data['vUserName']	 		= '';
      	$sess_data['vImage'] 			= '';
      	$sess_data['iPeran'] 			= '';
      	$sess_data['nama_akses']		= '';
      	$sess_data['iBidangId'] 		= '';
      	$sess_data['vBidangName'] 		= '';
      	$sess_data['iSubBidangId'] 		= '';
      	$sess_data['vSubBidangName'] 	= '';
      	$sess_data['iJabatanId'] 		= '';
      	$sess_data['vJabatanName'] 		= '';
        $this->session->unset_userdata($sess_data);
        $this->session->sess_destroy();
    
        redirect('auth');
	}


}

?>

 

