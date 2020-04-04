<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penugasan extends CI_Controller {


    function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
    
    }

	public function index(){
		if ($this->session->userdata('cUserId') /*&& $this->session->userdata('iPeran')==1*/) {
	       $this->load->view('view_penugasan');
	    }else{
	    	$this->load->view('view_login');
	    }		
	}

	public function getData(){
		$th  		= '';

	
		$arr_jenis = array(''=>'',0=>'PKAU',1=>'PKPT',2=>'NON PKPT');
		$arr_sumberdana = array(0=>'',1=>'DIPA PERWAKILAN',2=>'SKPA',3=>'DROPING',4=>'PIHAK III',4=>'UNIT BPKP LAIN',5=>'SHARING');
		
		if ($this->session->userdata('iPeran')==1 || $this->session->userdata('iPeran')==6 ){
		 	$qb = "";
		 }else{
		 	$qb = " a.iBidangId='".$this->session->userdata('iBidangId')."' AND ";
		 }

		/*if ($this->session->userdata('iPeran')==2 && $this->session->userdata('iBidangId') ==1){
		 	//jika pegawai dan bidang TU
		 	$qb .= " a.iSubBidangId = '".$this->session->userdata('iSubBidangId')."' AND  ";
		}*/

		if ($this->session->userdata('iPeran')==2){
			$listST = $this->lib_util->getListIdST($this->session->userdata('nip'));
			$qb = " a.iStId in (".$listST.") AND ";
		}


		$sql = "SELECT a.iStId,a.iBidangId,a.iJenisRkt,a.cNomorST,a.dTglST,a.iSumberDana,a.vUraianPenugasan,
				a.dMulai,a.nNilaiPengajuan,a.nRealiasi,b.vBidangName,
				(select coalesce(sum(nValueAju),0) as nilai_aju 
					from cost.st_detail_rkt where  iStId=a.iStId and lDeleted=0)  as nilai_aju,
				(select coalesce(sum(nRealisasi),0) as nilai_realisasi 
					from cost.st_detail_rkt where  iStId=a.iStId and lDeleted=0)  as nilai_realisasi
				FROM cost.st_header as a
				left join cost.ms_bidang as b on b.iBidangId=a.iBidangId
				where {$qb} a.lDeleted=0";

		$query 	= $this->db->query($sql);
	
		$html 	= '<table id="example1" class="table table-bordered table-striped" style="white-space: nowrap;">
			<thead>
              <tr>
               	<td>No</td>
               	<td>Status</td>
               	<td>Bidang</td>
               	<td>Jenis RKT</td>
               	<td>Uraian Penugasan</td>
               	<td>Nomor RKT</td>
               	<td>Nomor ST</td>
               	<td>Tgl ST</td>
               
               
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;
				$id = $row['iStId'];

				$nomor_rkt = $this->getListRKT($id);
				

				if ($row['dTglST']=='' or $row['dTglST']=='0000-00-00'){
					$dTglST = '';
				}else{
					$dTglST = date('d-m-Y',strtotime($row['dTglST']));
				}

				if ($this->session->userdata('iPeran')==1){
					$btn_edit =  " <a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' 
									onclick='edit(\"".$id."\",\"".$row['cNomorST']."\",\"".$dTglST."\")' ><i class='fa fa-edit pull-right'></i></a>";
				}else{
					$btn_edit =  "";
				}
				
				if ($row['dTglST']=='' or $row['dTglST']=='0000-00-00'){
					$dTglST = $btn_edit;
				}else{
					$dTglST = date('d-m-Y',strtotime($row['dTglST'])).$btn_edit;
				}

				$html .= "<tr>";
                $html .= "<td width='50px'>".$no."</td>";
                /*$html .= "<td align='center'  width='100px' >
                        <a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' onclick='edit(\"".$id."\")' ><i class='fa fa-edit'></i></a> || 
                        <a  href='#' onclick='hapus(\"".$id."\")' ><i class='fa fa-trash-o'></i></a>
                </td>";*/
                
             
				
				$html .= "<td></td>";
				$html .= "<td>".$row['vBidangName']."</td>";
				$html .= "<td>".$arr_jenis[$row['iJenisRkt']]."</td>";
				$html .= "<td>".$row['vUraianPenugasan']."</td>";
				$html .= "<td  >".$nomor_rkt."</td>";
				$html .= "<td>".$row['cNomorST']."</td>";
				$html .= "<td>".$dTglST."</td>";
				
				
                $html .= "</tr>";

			}
		}

        $html .= '</tbody> </table>';
		echo $html;
		exit();
	}


	function getListRKT($id){
		$ret = '';
		$sql = "select b.cNomorRkt from cost.st_detail_rkt as a
				inner join cost.rkt as b on b.id = a.iRktId 
				where a.iStId ='".$id."' and a.lDeleted = 0 ";

		$query = $this->db->query($sql);		
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$ret .= $row['cNomorRkt'].",";
			}
		}

		$ret = rtrim($ret,",");

		return $ret;

	}

	function simpanData(){
		$iStId 		= $_POST['iStId'];
		$cNomorST 	= $_POST['cNomorST'];
		$dTglST 	= $_POST['dTglST'];

		$cUserId 	= $this->session->userdata('cUserId');

		if ($dTglST!=''){
			$dTglST = date('Y-m-d',strtotime($dTglST));
		}


		try {
			
			$data = array(
				'cNomorST' => $cNomorST,
				'dTglST'   => $dTglST,
				'tUpdated'   => date('Y-m-d H:i:s'),
				'cUpdatedBy'   => $cUserId

			);
			$this->db->where('iStId',$iStId);
			$this->db->update('cost.st_header',$data);

			$x = 1;
		} catch (Exception $e) {
			$x = 0;
		}

		echo $x;
	}
	

}

?>