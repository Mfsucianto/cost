<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class instansi extends CI_Controller {


    function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
        $this->load->library('grid');
        $this->dataFrom = array();

        $addList = array(
				'vInstansiName' => 'Nama Instansi'
			);

        $dataFrom['caption'] 		= 'Master Instansi';
        $dataFrom['controller'] 	= 'instansi';
        $dataFrom['primaryKey'] 	= 'iInstansiId';
        $dataFrom['dbName'] 		= 'ms_instansi';
        $dataFrom['addList'] 		= $addList;
        

        $this->dataFrom = $dataFrom;
        //print_r($dataFrom);

    }

	public function index(){
		if ($this->session->userdata('cUserId') && $this->session->userdata('iLevel')==1) {
	       $this->load->view('view_master');
	    }else{
	    	$this->load->view('view_login');
	    }		
	}

	public function getData(){
		$dataFrom 	= $this->dataFrom;
		$iUnitId 	= $this->session->userdata('iUnitId');
		$th  		= '';
		foreach ($dataFrom['addList'] as $f => $c) {
			$this->db->select($f);
			$th 	.= '<th >'.$c.'</th> ';
		}

		$this->db->select($dataFrom['primaryKey']);
		$query 	= $this->db->get($dataFrom['dbName']);
	
		$html 	= '<table id="example1" class="table table-bordered table-striped">
			<thead>
              <tr>
                <th >No</th>
                '.$th.'
                <th >Action</th>
               
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;
				$id = $row[$dataFrom['primaryKey']];
				
				$html .= "<tr>";
                $html .= "<td width='50px'>".$no."</td>";
                foreach ($dataFrom['addList'] as $f => $c) {
					$html .= "<td>".$row[$f]."</td>";
				}
                $html .= "<td align='center'  width='100px' >
                        <a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' onclick='edit(\"".$id."\")' ><i class='fa fa-edit'></i></a> || 
                        <a  href='#' onclick='hapus(\"".$id."\")' ><i class='fa fa-trash-o'></i></a>
                </td>";
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
		$post 		= $_POST;

		if ($primaryKey > 0) {
			try {
				$post['tUpdated'] = date('Y-m-d H:i:s');
				$post['cUpdatedBy'] = $cUserId;

				$this->db->where($dataFrom['primaryKey'],$primaryKey);
				$this->db->update($dataFrom['dbName'],$post);
				$x = 1;
			} catch (Exception $e) {
				$x = 0;
			}

			
		}else{
			try {

				$post['tCreated'] = date('Y-m-d H:i:s');
				$post['cCreatedBy'] = $cUserId;

				$this->db->insert($dataFrom['dbName'],$post);
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
		foreach ($dataFrom['addList'] as $f => $c) {
			$this->db->select($f);
		}

		$this->db->select($dataFrom['primaryKey']);
		$this->db->where($dataFrom['primaryKey'],$id);
		$query 	= $this->db->get($dataFrom['dbName']);

		if ($query->num_rows() > 0) {
			$row 			= $query->row();

			echo json_encode($row);

		}

		exit();
	}
}

?>