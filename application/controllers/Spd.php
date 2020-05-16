<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class spd extends CI_Controller {


    function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
    	$this->load->library('report');
    }

	public function index(){
		if ($this->session->userdata('cUserId') && $this->session->userdata('iPeran')==1) {
	       $this->load->view('view_spd');
	    }else{
	    	$this->load->view('view_login');
	    }		
	}

	public function getData(){
		$iBarcode = $_POST['iBarcode'];
		$vNomorCs = $_POST['vNomorCs'];
		
		if ($vNomorCs!=''){
			$q = " AND st.vNomorCs='".$vNomorCs."' ";
		}else{
			$q = "";
		}



		$sql = "select a.id,st.iBarcode,st.cNomorST,c.vNomorCs,a.vNip,b.vName,a.vNoSPPD,a.dTglSPPD,a.iBatalSPD 
				from cost.cs_detail as a
				left join cost.ms_pegawai as b on b.vNip=a.vNip
				inner join cost.cs_header as c on c.iCsId=a.iCsId
				inner join cost.st_header as st on st.iStId=c.iStId
				where st.iBarcode='".$iBarcode."' ".$q." and a.lDeleted=0 and c.lDeleted=0";


		$query 	= $this->db->query($sql);
	
		$html 	= '<table id="example1" class="table table-bordered table-striped" style="white-space: nowrap;">
			<thead>
              <tr>
               	<td>No</td>
               	<td>ID ST</td>
               	<td>Nomor Cost Sheet</td>
               	<td>NIP</td>
               	<td>Nama</td>
               	<td>Nomor SPPD</td>
               	<td>Tgl SPPD</td>
               	<td></td>
               
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;
				$id = $row['id'];
				$vNoSPPD = $row['vNoSPPD'];
				$iBatalSPD = $row['iBatalSPD'];

				if ($iBatalSPD==1){
					$col = "style='color:red'";
				}else{
					$col = "";
				}
				
				$html .= "<tr>";
                $html .= "<td width='50px'>".$no."</td>";
                /*$html .= "<td align='center'  width='100px' >
                        <a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' onclick='edit(\"".$id."\")' ><i class='fa fa-edit'></i></a> || 
                        <a  href='#' onclick='hapus(\"".$id."\")' ><i class='fa fa-trash-o'></i></a>
                </td>";*/
                
             	if ($row['dTglSPPD']=='' || $row['dTglSPPD']=='0000-00-00'){
             		$dTglSPPD = '';
             	}else{
             		$dTglSPPD =  date('d-m-Y',strtotime($row['dTglSPPD']));
             	}
				
				
				$html .= "<td>".$row['iBarcode']."</td>";
				$html .= "<td>".$row['vNomorCs']."</td>";
				$html .= "<td>".$row['vNip']."</td>";
				$html .= "<td>".$row['vName']."</td>";
				$html .= "<td ".$col." >".$row['vNoSPPD']."</td>";
				$html .= "<td ".$col." >".$dTglSPPD."</td>";
				$html .= "<td style='text-align:center;' ><a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' onclick='edit(\"".$id."\")' ><i class='fa fa-edit'></i></a> ";

				if ($row['vNoSPPD']!='' && $iBatalSPD==0){
					$html .= "<button type='button' onclick='batal_spd(\"".$id."\",\"".$vNoSPPD."\")' class='btn btn-block btn-warning btn-xs'>Batal SPD</button>";
				}else if ( $iBatalSPD==1){
					$html .= "<button type='button' onclick='aktifkan_spd(\"".$id."\",\"".$vNoSPPD."\")' class='btn btn-block btn-warning btn-xs'>Aktifkan SPD</button>";
				}
				$html .= "</td>";
						


				
				
                $html .= "</tr>";

			}
		}

        $html .= '</tbody> </table>';
		echo $html;
		exit();
	}



	function simpanData(){
		$id 		= $_POST['id'];
		$vNoSPPD 	= $_POST['vNoSPPD'];
		$dTglSPPD 	= $_POST['dTglSPPD'];
		$vJenisSPD 	= $_POST['vJenisSPD'];

		$cUserId 	= $this->session->userdata('cUserId');

		
		$dTglSPPD = date('Y-m-d',strtotime($dTglSPPD));
		


		try {
			
			$data = array(
				'vNoSPPD' => $vNoSPPD,
				'dTglSPPD'   => $dTglSPPD,
				'vJenisSPD'   => $vJenisSPD,
				'tUpdated'   => date('Y-m-d H:i:s'),
				'cUpdatedBy'   => $cUserId

			);
			$this->db->where('id',$id);
			$this->db->update('cost.cs_detail',$data);

			$x = 1;
		} catch (Exception $e) {
			$x = 0;
		}

		echo $x;
	}

	function getFormDataSPD(){
		$id = $_POST['id'];
		
		$sql = "select a.vNoSPPD,a.dTglSPPD,a.vJenisSPD,a.iJenisAkomodasi,a.vNip,b.vName,
				a.dPerjalananStart,a.dPerjalananEnd,c.vDari,c.vTujuan,a.iAlatAngkut,st.iSumberDana,st.vUraianPenugasan,
				bd.iNomor
				from cost.cs_detail as a
				left join cost.ms_pegawai as b on b.vNip=a.vNip
				left join cost.cs_header as c on c.iCsId=a.iCsId 
				left join cost.st_header as st on st.iStId=c.iStId
				inner join cost.ms_bidang as bd on bd.iBidangId = st.iBidangId
				where a.id='".$id."' ";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();

			if ($row->dTglSPPD != ''){
				$row->dTglSPPD  = date('d-m-Y',strtotime($row->dTglSPPD));
			}
			$row->dPerjalananStart  = date('d-m-Y',strtotime($row->dPerjalananStart));
			$row->dPerjalananEnd  = date('d-m-Y',strtotime($row->dPerjalananEnd));

			echo json_encode($row);
		}

	}


	function loadDataMonitoring(){
		$cTahun = $_POST['cTahun'];
		$iBidangId = $_POST['iBidangId'];

		if ($iBidangId=='' || $iBidangId ==0){
			$qb = "";
		}else{
			$qb = " AND st.iBidangId='".$iBidangId."' ";
		}

		$sql = "select a.vNoSPPD,a.dTglSPPD,a.vJenisSPD,a.iJenisAkomodasi,a.vNip,b.vName,
			a.dPerjalananStart,a.dPerjalananEnd,c.vDari,c.vTujuan,a.iAlatAngkut,st.iSumberDana,st.vUraianPenugasan,
			st.iBidangId,bd.vNickName,a.iBatalSPD
			from cost.cs_detail as a
			left join cost.ms_pegawai as b on b.vNip=a.vNip
			left join cost.cs_header as c on c.iCsId=a.iCsId 
			left join cost.st_header as st on st.iStId=c.iStId
			left join cost.ms_bidang as bd on bd.iBidangId =st.iBidangId
			where date_format(a.dTglSPPD,'%Y')='{$cTahun}' and a.lDeleted=0 ".$qb;

		$query = $this->db->query($sql);

		$html 	= '<table id="example1" class="table table-bordered table-striped" style="white-space: nowrap;">
			<thead>
              <tr>
               	<td>No</td>
               	<td>NIP</td>
               	<td>Nama</td>
               	<td>Bidang</td>
               	<td>Nomor SPPD</td>
               	<td>Tgl SPPD</td>
               	<td>Jenis SPPD</td>
               	<td>Jenis Akomodasi</td>
               	<td>Sumber Dana</td>
               	<td>Maksud Perjalanan</td>
               	
              </tr>
            </thead>
            <tbody>';

        $arry_akom = array(0=>'',1=>'Fullboard',2=>'Non Fullboard');

        $arr_jns_biaya = array(0=>'',1=>'DIPA PERWAKILAN',
                                    2=>'SKPA',
                                    3=>'DROPING',
                                    4=>'PIHAK III',
                                    5=>'UNIT BPKP LAIN',
                                    6=>'SHARING');

        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;
				$dTglSPPD =  date('d-m-Y',strtotime($row['dTglSPPD']));
				$iBatalSPD = $row['iBatalSPD'];
				if ($iBatalSPD==1){
					$col = "style='color:red'";
				}else{
					$col = "";
				}

				$html .= "<tr ".$col.">";
                $html .= "<td width='50px'>".$no."</td>";
				$html .= "<td>".$row['vNip']."</td>";
				$html .= "<td>".$row['vName']."</td>";
				$html .= "<td>".$row['vNickName']."</td>";
				$html .= "<td  >".$row['vNoSPPD']."</td>";
				$html .= "<td>".$dTglSPPD."</td>";
				$html .= "<td>".$row['vJenisSPD']."</td>";
				$html .= "<td>".$arry_akom[$row['iJenisAkomodasi']]."</td>";
				$html .= "<td>".$arr_jns_biaya[$row['iSumberDana']]."</td>";
				$html .= "<td>".$row['vUraianPenugasan']."</td>";
                $html .= "</tr>";

			}
		}

        $html .= '</tbody> </table>';
		echo $html;
		exit();

	}

	function cetakspd(){
		$this->load->helper('download'); 
		
		$path = $this->config->item('report_path');
		

		$id 			= $_GET['id'];
		$vNoSPPD 			= str_replace("/", "-", $_GET['vNoSPPD']);
		$pejabatTTD 	= $_GET['pejabatTTD'];
		$vNip_ppk 		= explode("|", $_GET['vNip_ppk']);
		$jabatan1 		= $_GET['jabatan1'];
		$jabatan2 		= $_GET['jabatan2'];
		$diKelurkandi 	= $_GET['diKelurkandi'];
		if ($_GET['dKeluarkanTgl']!=''){
			$dKeluarkanTgl =  date('d F Y',strtotime($_GET['dKeluarkanTgl']));
		}else{
			$dKeluarkanTgl 	= $_GET['dKeluarkanTgl'];
		}
		
		
		$sql = "select nLama from cost.cs_detail where id = '".$id."'  ";
		$query = $this->db->query($sql);
		$row = $query->row();
		$nLama = $row->nLama;

		$lama = $nLama." (".ucwords($this->Terbilang($nLama)).") Hari";
		
		$params = new Java("java.util.HashMap");
		$params->put('id', (int)$id);	
		$params->put('SUBREPORT_DIR', $path);		
		$params->put('dikeluarkan', $diKelurkandi);		
		$params->put('tglKeluar', $dKeluarkanTgl);		
		$params->put('baris1', $jabatan1);		
		$params->put('baris2', $jabatan2);		
		$params->put('nip_pejabat', $vNip_ppk['0']);		
		$params->put('Nama_pejabat', $vNip_ppk['1']);		
		$params->put('lama', $lama);		
		$params->put('pejabatTTD', $pejabatTTD);		
		
		$reportAsal   = "spd.jrxml";
		$reportTujuan = "SPD_".$vNoSPPD.".pdf";

				
		$nama_file = explode('.', $reportAsal);		
		
		$this->report->showReport($path, $reportAsal, $reportTujuan, $params,1);	
		$open_file = file_get_contents($path.$reportTujuan);
		
		force_download($nama_file[0], $open_file);	
	}
	

	function Terbilang($x){
		
		$x = intval($x);
		  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		  if ($x < 12)
			return $abil[$x];
		  elseif ($x < 20)
			return $this->Terbilang($x - 10) . " belas";
		  elseif ($x < 100)
			return  $this->Terbilang($x / 10) . " puluh" .  $this->Terbilang($x % 10);
		  elseif ($x < 200)
			return " seratus" .  $this->Terbilang($x - 100);
		  elseif ($x < 1000)
			return  $this->Terbilang($x / 100) . " ratus" .  $this->Terbilang($x % 100);
		  elseif ($x < 2000)
			return " seribu" .  $this->Terbilang($x - 1000);
		  elseif ($x < 1000000)
			return  $this->Terbilang($x / 1000) . " ribu" .  $this->Terbilang($x % 1000);
		  elseif ($x < 1000000000)
			return  $this->Terbilang($x / 1000000) . " juta" .  $this->Terbilang($x % 1000000);
	}



	function getListDataST(){
		$sql = "SELECT a.iStId,a.iBarcode,a.iBidangId,a.cNomorST,a.vUraianPenugasan,
				(select vNickName from cost.ms_bidang where iBidangId=a.iBidangId) as nama_bidang,
				(SELECT dt.vNoSPPD FROM cost.cs_detail AS dt
					INNER JOIN cost.cs_header AS dh ON dh.iCsId=dt.iCsId
					WHERE dh.iStId=a.iStId ORDER BY dt.vNoSPPD DESC LIMIT 1) AS vNoSPPD
				from st_header as a where a.lDeleted=0  order by a.iBarcode DESC";

		$query 	= $this->db->query($sql);
	
		$html 	= '<table id="tabel_list_st" class="table table-bordered table-striped" style="width: 100%;" >
			<thead>
              <tr>
               	<td  >No</td>
               	<td>Pilih</td>
               	<td>ID ST</td>
               	<td>Nomor ST</td>
               	<td>Bidang</td>
               	<td>Uraian Penugasan</td>
               	<td>Status</td>
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;

				if ($row['vNoSPPD']!=''){
					$status = 'Sudah Proses SPD';
				}else{
					$status  = '';
				}

				$html .= "<tr>";
                $html .= "<td style='width:5%;' >".$no."</td>";
               	$html .= "<td  style='width:5%' align='center'  > 
                			<input type='radio' onclick='select_row_st(
                			\"".$row['iBarcode']."\"

                			)' />
                		</td>";	
  
				$html .= "<td>".$row['iBarcode']."</td>";
				$html .= "<td>".$row['cNomorST']."</td>";
				$html .= "<td>".$row['nama_bidang']."</td>";
				$html .= "<td>".$row['vUraianPenugasan']."</td>";
				$html .= "<td>".$status."</td>";
                $html .= "</tr>";
			}
		}

		$html .= '</tbody> </table>';
		echo $html;
		exit();

	}

	function batalSPD(){
		$id = $_POST['id'];
		$iBatalSPD = $_POST['iBatalSPD'];
		
		$cUserId 	= $this->session->userdata('cUserId');

		try {

			$sql = "UPDATE cost.cs_detail SET iBatalSPD='".$iBatalSPD."',tUpdated=CURRENT_TIMESTAMP,
					cUpdatedBy='".$cUserId."' WHERE id='".$id."'";
			$this->db->query($sql);

			$x = 1;
		} catch (Exception $e) {
			$x = 0;
		}

		echo $x;
	}

}

?>