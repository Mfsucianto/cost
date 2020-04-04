<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pegawai extends CI_Controller {


    function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
     
        $this->dataFrom = array();

        $addList = array(
				'vNip' 		=> 'Nomor Induk Pegawai',
				'vName' 	=> 'Nama Lengkap ',
				'cSex' 		=> 'Jenis Kelamin ',
				'vGelar' 	=> 'Gelar ',
				'iJabatanId' => 'Jabatan ',
				'cGolongan' => 'Golongan ',
				'nGolTarif' => 'Golongan Tarif ',
				'iBidangId' => 'Bidang ',
				'iSubBidangId' => 'Sub Bidang ',
				'iPeran' 	=> 'Peran '
			);

        $datchg = array();
        $sql = "SELECT iJabatanId,vJabatanName FROM  ms_jabatan order by vJabatanName ASC";
        $query 	= $this->db->query($sql);
        if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$datchg[$row['iJabatanId']] = $row['vJabatanName'];
			}
		}


		$datchgbid = array();
        $sql = "SELECT iBidangId,vBidangName FROM  ms_bidang order by vBidangName ASC";
        $query 	= $this->db->query($sql);
        if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$datchgbid[$row['iBidangId']] = $row['vBidangName'];
			}
		}


		 $chgfld = array(
        		'iJabatanId' => array(
    							'type' => 'combobox',
    							'data' => $datchg
    						),
        		'iBidangId' => array(
    							'type' => 'combobox',
    							'data' => $datchgbid
    						),
        		'iPeran' => array(
        						'type' => 'combobox',
        						'data' => array(0=>'',1=>'Admin',2=>'Pegawai',3=>'Kepala Bagian',4=>'Sub Bagian',5=>'Skretaris Bidang',6=>'Kepala Perwakilan')
        					),
        		'cSex' => array(
        					'type' => 'combobox',
        					'data' => array(''=>'','L'=>'Laki-Laki','P'=>'Perempuan')
        		)
        	);

        $dataFrom['caption'] 		= 'Master Pegawai';
        $dataFrom['controller'] 	= 'pegawai';
        $dataFrom['primaryKey'] 	= 'iPegawaiId';
        $dataFrom['dbName'] 		= 'ms_pegawai';
        $dataFrom['addList'] 		= $addList;
        $dataFrom['changeFiled']	= $chgfld;
        

        $this->dataFrom = $dataFrom;
        //print_r($dataFrom);

    }

	public function index(){
		if ($this->session->userdata('cUserId') && ($this->session->userdata('iPeran')==99 || $this->session->userdata('iPeran')==1) ) {
	       $this->load->view('view_pegawai');
	    }else{
	    	$this->load->view('view_login');
	    }		
	}

	public function getData(){
		$dataFrom 	= $this->dataFrom;
		$iInstansiId 	= $this->session->userdata('iInstansiId');
		$th  		= '';

		
		foreach ($dataFrom['addList'] as $f => $c) {
			$this->db->select($f);
			$th 	.= '<th >'.$c.'</th> ';
		}

		$this->db->select($dataFrom['primaryKey']);

		$sql = " SELECT a.*,b.vJabatanName,c.vBidangName,d.vSubBidangName 
				FROM cost.ms_pegawai AS a
				LEFT JOIN cost.ms_jabatan AS b ON b.iJabatanId=a.iJabatanId
				LEFT JOIN cost.ms_bidang AS c ON c.iBidangId=a.iBidangId
				LEFT JOIN cost.ms_sub_bidang AS d ON d.iSubBidangId=a.iSubBidangId WHERE a.lDeleted=0";

		$query 	= $this->db->get($dataFrom['dbName']);
	
		$html 	= '<table id="example1" class="table table-bordered table-striped" style="white-space: nowrap;">
			<thead>
              <tr>
                <th >No</th>
                <th >Action</th>
                '.$th.'
                
               
              </tr>
            </thead>
            <tbody>';
        $no=0;
        
        $peran = array(0=>'',1=>'Admin',2=>'Pegawai',3=>'Kepala Bagian',4=>'Sub Bagian',5=>'Skretaris Bidang',6=>'Kepala Perwakilan');

		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;
				$id = $row[$dataFrom['primaryKey']];
				
				$html .= "<tr>";
                $html .= "<td width='50px'>".$no."</td>";
                $html .= "<td align='center'  width='100px' >
                        <a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' onclick='edit(\"".$id."\")' ><i class='fa fa-edit'></i></a> || 
                        <a  href='#' onclick='hapus(\"".$id."\")' ><i class='fa fa-trash-o'></i></a>
                </td>";
                
                foreach ($dataFrom['addList'] as $f => $c) {

                	if ($f=='iPeran'){
                		$html .= "<td>".$peran[$row[$f]]."</td>";
                	}else{
                		$html .= "<td>".$row[$f]."</td>";
                	}

					
				}
                $html .= "</tr>";

			}
		}

        $html .= '</tbody> </table>';
		echo $html;
		exit();
	}

	

	function simpanData(){
		$dataFrom 	= $this->dataFrom;

		$primaryKey = $_POST[$dataFrom['primaryKey']];
		$cUserId 	= $this->session->userdata('cUserId');
		$uniqid     = $_POST['uniqid'];
		$post 		= $_POST;

		unset($post['uniqid']);

		if ($post['vPassword']==''){
			unset($post['vPassword']);	
		}else{
			$post['vPassword'] = do_hash($post['vPassword'],'md5');
		}

		if ($uniqid!=''){
			$post['vImage'] = $uniqid;
		}
		
		$post['vNip'] = str_replace(" ", "", $post['vNip']);

		if ($primaryKey > 0) {
			try {
				$post['tUpdated'] = date('Y-m-d H:i:s');
				$post['cUpdatedBy'] = $cUserId;

				$this->db->where('iPegawaiId',$primaryKey);
				$this->db->update($dataFrom['dbName'],$post);
				$x = 1;
			} catch (Exception $e) {
				$x = 0;
			}

			
		}else{
			unset($post['iPegawaiId']);


			try {

				$post['tCreated'] = date('Y-m-d H:i:s');
				$post['cCreatedBy'] = $cUserId;
				
				$this->db->insert('cost.ms_pegawai',$post);
				$last_id = $this->db->insert_id();
				$x = 1;
			} catch (Exception $e) {
				$x = 0;
			}
			
		}
		echo $x;
		exit();
	}

	function hapusData(){
		$id 		= $_POST['id'];
		$dataFrom 	= $this->dataFrom;
		try {
			$this->db->where($dataFrom['primaryKey'],$id);
			$this->db->delete($dataFrom['dbName']);
			$x = 1;
		} catch (Exception $e) {
			$x = 0;
		}

		echo $x;
	}

	function getDataEdit(){
		$id = $_POST['id'];

		$dataFrom 	= $this->dataFrom;
		/*foreach ($dataFrom['addList'] as $f => $c) {
			$this->db->select($f);
		}*/

		//$this->db->select($dataFrom['primaryKey']);
		$this->db->where($dataFrom['primaryKey'],$id);
		$query 	= $this->db->get($dataFrom['dbName']);

		if ($query->num_rows() > 0) {
			$row 			= $query->row();

			echo json_encode($row);

		}

		exit();
	}

	function uploadFile(){
		$uniqid =  "user_".$this->uri->segment(3);
		
		$files = $_FILES;
		$realname 	= $files["vImage"]["name"];
		$ext 		= pathinfo($realname, PATHINFO_EXTENSION);
		$newName	= $uniqid.".".$ext;
		$newName 	=  str_replace("/", "_", $newName);
		$upload_dir = 'images/user/'.$newName;

		if (file_exists($upload_dir)){
			unlink($upload_dir);
		}
		
		echo $newName;
		move_uploaded_file($files["vImage"]["tmp_name"], $upload_dir);

		
		exit();
	}


	function checkNip(){
		$vNip = $_POST['nip'];
		$iPegawaiId = $_POST['iPegawaiId'];
		
		if ($iPegawaiId==0){
			$query = $this->db->get_where('ms_pegawai', array('vNip' => $vNip));
		}else{
			$this->db->where('iPegawaiId !=',$iPegawaiId);
			$this->db->where('vNip',$vNip);
			$query = $this->db->get('ms_pegawai');
		}
		
		if ($query->num_rows() > 0){
			$ret = "ADA";
		}else{
			$ret = "TIDAK";
		}

		echo $ret;
		
	}

	function cekUserId(){
		$userid = $_POST['userid'];
		$iPegawaiId = $_POST['iPegawaiId'];
		
		if ($iPegawaiId==0){
			$query = $this->db->get_where('ms_pegawai', array('cUserId' => $userid));
		}else{
			$this->db->where('iPegawaiId !=',$iPegawaiId);
			$this->db->where('cUserId',$userid);
			$query = $this->db->get('ms_pegawai');
		}
		
		if ($query->num_rows() > 0){
			$ret = "ADA";
		}else{
			$ret = "TIDAK";
		}

		echo $ret;
		
	}
}

?>