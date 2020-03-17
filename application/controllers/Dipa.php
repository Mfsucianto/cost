<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dipa extends CI_Controller {


    function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
     
        $this->dataFrom = array();

        $addList = array(
				'cTahun' 		=> 'Tahun',
				'iBidangId' 	=> 'Bidang',
				'cKodeDipa' 	=> 'Kode DIPA',
				'vNamaItem' 	=> 'Nama Item ',
				'cKodeAccount' => 'Kode Akun ',
				'iJenis' => 'PKPT/PKU ',
				'fJumlahAnggaran' => 'Jumlah Anggaran'
			);

       


	


        $dataFrom['caption'] 		= 'DIPA';
        $dataFrom['controller'] 	= 'dipa';
        $dataFrom['primaryKey'] 	= 'id';
        $dataFrom['dbName'] 		= 'dipa';
        $dataFrom['addList'] 		= $addList;
    
        

        $this->dataFrom = $dataFrom;
        //print_r($dataFrom);

    }

	public function index(){
		if ($this->session->userdata('cUserId') && $this->session->userdata('iPeran')==1) {
	       $this->load->view('view_dipa');
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

		
		$arr_jenis = array(''=>'',0=>'PKAU',1=>'PKPT',2=>'NON PKPT');

		$sql = "SELECT a.id,a.cTahun,a.iBidangId,
				(SELECT vBidangName FROM cost.ms_bidang WHERE a.iBidangId=iBidangId) AS vBidangName,
				a.cKodeDipa,a.vNamaItem,a.cKodeAccount,a.iJenis,a.fJumlahAnggaran,
				(SELECT COALESCE(SUM(fAnggaran),0) FROM cost.rkt WHERE iDipaId=a.id AND lDeleted=0) as anggaran_rkt
				FROM cost.dipa AS a
				WHERE a.lDeleted=0";

		$query 	= $this->db->query($sql);
	
		$html 	= '<table id="example1" class="table table-bordered table-striped" style="white-space: nowrap;">
			<thead>
              <tr>
                <th >No</th>
                <th >Action</th>
                '.$th.'
                
               	<th>Dialokasikan ke RKT</th>
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;
				$id = $row[$dataFrom['primaryKey']];
				
				if ($row['anggaran_rkt'] > 0){
					$gry = "style='color: gray;'";
				}else{
					$gry = '';
				}

				$html .= "<tr>";
                $html .= "<td width='50px'>".$no."</td>";
                $html .= "<td align='center'  width='100px' >
                        <a  href='#' onclick='view(\"".$id."\")'  title='view' ><i class='fa  fa-eye'></i></a> || 
                        <a  href='#' onclick='edit(\"".$id."\")'  ".$gry." title='edit' ><i class='fa fa-edit'></i></a> || 
                        <a  href='#' onclick='hapus(\"".$id."\",\"".$row['anggaran_rkt']."\")' ".$gry."  title='Delete' ><i class='fa fa-trash-o'></i></a>
                </td>";
                
               
				$html .= "<td>".$row['cTahun']."</td>";
				$html .= "<td>".$row['vBidangName']."</td>";
				$html .= "<td>".$row['cKodeDipa']."</td>";
				$html .= "<td>".$row['vNamaItem']."</td>";
				$html .= "<td>".$row['cKodeAccount']."</td>";
				$html .= "<td>".$arr_jenis[$row['iJenis']]."</td>";
				$html .= "<td align='right' >".number_format($row['fJumlahAnggaran'])."</td>";
				$html .= "<td align='right' >".number_format($row['anggaran_rkt'])."</td>";
				
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

		$post['fJumlahAnggaran'] = str_replace(",", '', $post['fJumlahAnggaran']);
		

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
			unset($post['id']);
			unset($post['vName']);
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
		$cUserId 	= $this->session->userdata('cUserId');

		try {
			
			$data = array(
				'lDeleted' => 1,
				'tUpdated' => date('Y-m-d H:i:s'),
				'cUpdatedBy' => $cUserId
			);

			$this->db->where($dataFrom['primaryKey'],$id);
			$this->db->update($dataFrom['dbName'],$data);
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

			
			//cek data rkt
			$sql = "SELECT SUM(fAnggaran) as fAnggaran FROM cost.rkt WHERE iDipaId='{$row->id}' AND lDeleted=0";
			$qry = $this->db->query($sql);
			$fAnggaran = 0;
			if ($qry->num_rows()>0){
				$r = $qry->row();
				$fAnggaran = $r->fAnggaran;
			}
			$tersedia = $row->fJumlahAnggaran - $fAnggaran;

			$row->fJumlahAnggaran = number_format($row->fJumlahAnggaran);
			$row->fAnggaran 	  = number_format($fAnggaran);
			$row->tersedia 	  	  = number_format($tersedia);
			echo json_encode($row);

		}

		exit();
	}


	function getDataView(){
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

			

			//cek data rkt
			$sql = "SELECT SUM(fAnggaran) as fAnggaran FROM cost.rkt WHERE iDipaId='{$row->id}' AND lDeleted=0";
			$qry = $this->db->query($sql);
			$fAnggaran = 0;
			if ($qry->num_rows()>0){
				$r = $qry->row();
				$fAnggaran = $r->fAnggaran;
			}
			$tersedia = $row->fJumlahAnggaran - $fAnggaran;

			$row->fJumlahAnggaran = number_format($row->fJumlahAnggaran);
			$row->fAnggaran 	  = number_format($fAnggaran);
			$row->tersedia 	  	  = number_format($tersedia);
			echo json_encode($row);


		}

		exit();
	}
	


	function checkKode(){
		$id = $_POST['id'];
		$cKodeDipa = $_POST['cKodeDipa'];
		$cTahun = $_POST['cTahun'];
		
		if ($id==0){
			$this->db->where('cTahun',$cTahun);
			$this->db->where('cKodeDipa',$cKodeDipa);
			$query = $this->db->get('dipa');
		}else{
			
			$this->db->where('cTahun',$cTahun);
			$this->db->where('cKodeDipa',$cKodeDipa);
			$this->db->where('id !=',$id);
			$query = $this->db->get('dipa');
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