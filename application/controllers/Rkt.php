<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rkt extends CI_Controller {


    function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
     
        $this->dataFrom = array();

        $addList = array(
				'cTahun' 		=> 'Tahun',
				'vUnitPelaksana' => 'Nomor Unit Pelaksana',
				'iBidangId' 	=> 'Bidang',
				'iDipaId' 		=> 'Kode DIPA',
				'cNomorRkt' 	=> 'Nomor RKT ',
				'cKodeAccount' 	=> 'Kode Akun ',
				'cKodeRkt' 		=> 'Kode RKT ',
				'cNamaItem' 	=> 'Nama Item ',
				'cKelompok' 	=> 'Kelompok Kegiatan ',
				'iJenis' 		=> 'PKPT/PKU ',
				'iJumlahRencana'=> 'Jumlah Rencana Penugasan ',
				'fAnggaran' 	=> 'Jumlah Anggaran'
			);

        $dataFrom['caption'] 		= 'RKT';
        $dataFrom['controller'] 	= 'rkt';
        $dataFrom['primaryKey'] 	= 'id';
        $dataFrom['dbName'] 		= 'rkt';
        $dataFrom['addList'] 		= $addList;
    
        

        $this->dataFrom = $dataFrom;
        //print_r($dataFrom);

    }

	public function index(){
		if ($this->session->userdata('cUserId') && $this->session->userdata('iPeran')==1) {
	       $this->load->view('view_rkt');
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

		
		$arr_jenis =array(''=>'',0=>'0 PKAU',1=>'1 PKAU',2=>'PKPT');

		$sql = "SELECT a.id,a.cTahun,a.vUnitPelaksana,a.iBidangId,
				(SELECT vBidangName FROM cost.ms_bidang WHERE a.iBidangId=iBidangId) AS vBidangName,
				a.iDipaId,a.cNomorRkt,a.cKodeAccount,a.cKodeRkt,a.cNamaItem,
				a.cKelompok,a.iJenis,a.iJumlahRencana,a.fAnggaran,b.cKodeDipa 
				FROM cost.rkt AS a
				INNER JOIN cost.dipa AS b ON b.id=a.iDipaId
				WHERE a.lDeleted=0";

		$query 	= $this->db->query($sql);
	
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
                
              

				$html .= "<td>".$row['cTahun']."</td>";
				$html .= "<td>".$row['vUnitPelaksana']."</td>";
				$html .= "<td>".$row['vBidangName']."</td>";
				$html .= "<td>".$row['cKodeDipa']."</td>";
				$html .= "<td>".$row['cNomorRkt']."</td>";
				$html .= "<td>".$row['cKodeAccount']."</td>";
				$html .= "<td>".$row['cKodeRkt']."</td>";
				$html .= "<td>".$row['cNamaItem']."</td>";
				$html .= "<td>".$row['cKelompok']."</td>";
				$html .= "<td>".$arr_jenis[$row['iJenis']]."</td>";
				$html .= "<td>".$row['iJumlahRencana']."</td>";
				$html .= "<td align='right' >".number_format($row['fAnggaran'])."</td>";
				
				
				
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

		
		$post['iJumlahRencana'] = str_replace(",", '', $post['iJumlahRencana']);
		$post['fAnggaran'] 		= str_replace(",", '', $post['fAnggaran']);
		
		$post['vUnitPelaksana']  = '204';

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
			
			$data =  array(
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
		$text_iDipaId = '';
		$dataFrom 	= $this->dataFrom;
		/*foreach ($dataFrom['addList'] as $f => $c) {
			$this->db->select($f);
		}*/

		//$this->db->select($dataFrom['primaryKey']);
		$this->db->where($dataFrom['primaryKey'],$id);
		$query 	= $this->db->get($dataFrom['dbName']);

		if ($query->num_rows() > 0) {
			$row 			= $query->row();

			$row->iJumlahRencana = number_format($row->iJumlahRencana);
			$row->fAnggaran = number_format($row->fAnggaran);

			$sql = 'SELECT cKodeDipa,vNamaItem FROM cost.dipa WHERE id="'.$row->iDipaId.'"';
			$query = $this->db->query($sql);
			if ($query->num_rows()>0){
				$r = $query->row();
				$text_iDipaId = $r->cKodeDipa." - ".$r->vNamaItem;
			}

			$row->text_iDipaId = $text_iDipaId;
			echo json_encode($row);

		}

		exit();
	}

	


	function cekPlafon(){
		$id 		= $_POST['id'];
		$iDipaId 	= $_POST['iDipaId'];
		$fAnggaran 	= str_replace(",",'',$_POST['fAnggaran']);
		$ret = '';

		$fJumlahAnggaran = 0;
		$sql = "SELECT a.fJumlahAnggaran FROM cost.dipa as a WHERE a.id='{$iDipaId}' ";
		$query = $this->db->query($sql);
		if ($query->num_rows()>0){
			$row = $query->row();
			$fJumlahAnggaran = $row->fJumlahAnggaran;

			if ($fAnggaran > $fJumlahAnggaran){
				$ret = "Opps, Jumlah Anggaran Over | Jumlah Anggaran RKT Melebihi Anggaran DIPA, Jumlah Anggran DIPA adalah ".number_format($fJumlahAnggaran);
			}

		}else{
			$ret = "Opps, Data DIPA tidak ditemukan|";
		}

		//Cek apa Saldo DIPA sudah abis atau belum
		if ($fJumlahAnggaran > 0){
			$xs = "";
			if ($id > 0){
				$xs = " AND id!=".$id;
			}

			$sql = "SELECT SUM(fAnggaran) as terpakai_rkt FROM cost.rkt WHERE iDipaId='{$iDipaId}'  ".$xs." AND lDeleted=0";
			$query = $this->db->query($sql);
			if ($query->num_rows()>0){
				$r = $query->row();
				$saldo = $fJumlahAnggaran - $r->terpakai_rkt;
				if ($fAnggaran > $saldo){
					$ret = "Opps, Saldo DIPA tidak mencukupi | 
							Anggran Dipa : ".number_format($fJumlahAnggaran).", Dialokasikan Ke RKT : 
							".number_format($r->terpakai_rkt).", Saldo yang dapat dialokasikan : ".number_format($saldo) ;
				}
			}
		}

		

		echo $ret;
		
	}

	function getListDataDipa(){

		$cTahun 	= $_POST['cTahun'];
		$iBidangId 	= $_POST['iBidangId'];

		$sql = "SELECT a.id,a.cTahun,a.cKodeDipa,a.vNamaItem,a.cKodeAccount,a.iJenis,a.fJumlahAnggaran,
				(SELECT COALESCE(SUM(fAnggaran),0) AS fAnggaran FROM cost.rkt WHERE iDipaId=a.id) AS anggaran_rkt
				FROM cost.dipa AS a WHERE a.cTahun='{$cTahun}' AND a.iBidangId='{$iBidangId}' AND  a.lDeleted=0";
		$query = $this->db->query($sql);

		$html 	= '<table id="list_popup" class="table table-bordered table-striped" style="width:100%">
			<thead>
              <tr>
               
                <th >Pilih</th>
                <th >Kode DIPA</th>
                <th >Nama Item</th>
                <th >Anggaran</th>
                	
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;

				$tersedia = $row['fJumlahAnggaran'] - $row['anggaran_rkt'];
				
				$html .= "<tr>";
                
                $html .= "<td  width='50px' align='center'  > 
                			<input type='radio' onclick='select_row(
                			\"".$row['id']."\",
                			\"".$row['cTahun']."\",
                			\"".$row['cKodeDipa']."\",
                			\"".$row['fJumlahAnggaran']."\",
                			\"".$row['vNamaItem']."\"

                			)' />
                		</td>";	
				$html .= "<td>".$row['cKodeDipa']."</td>";
				$html .= "<td>".$row['vNamaItem']."</td>";
				$html .= "<td align='left' style='white-space: nowrap;' >
							
							<table>
								<tr>
									<td>Anggaran DIPA</td>
									<td>: </td>
									<td>".number_format($row['fJumlahAnggaran'])."</td>
								</tr>

								<tr>
									<td>Dianggarkan ke-RKT</td>
									<td>: </td>
									<td>".number_format($row['anggaran_rkt'])."</td>
								</tr>

								<tr>
									<td>Anggaran Tersedia</td>
									<td>: </td>
									<td>".number_format($tersedia)."</td>
								</tr>

							</table>

						</td>";
                $html .= "</tr>";
			}
		}

		echo $html;


	}

	
}

?>