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



		$sql = "select a.id,st.iBarcode,st.cNomorST,c.vNomorCs,a.vNip,b.vName,a.vNoSPPD,a.dTglSPPD 
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
				$html .= "<td>".$row['vNoSPPD']."</td>";
				$html .= "<td>".$dTglSPPD."</td>";
				$html .= "<td style='text-align:center;' ><a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' onclick='edit(\"".$id."\")' ><i class='fa fa-edit'></i></a></td>";
				
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
				a.dPerjalananStart,a.dPerjalananEnd,c.vDari,c.vTujuan,a.iAlatAngkut,st.iSumberDana,st.vUraianPenugasan 
				from cost.cs_detail as a
				left join cost.ms_pegawai as b on b.vNip=a.vNip
				left join cost.cs_header as c on c.iCsId=a.iCsId 
				left join cost.st_header as st on st.iStId=c.iStId
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
			st.iBidangId,bd.vNickName
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
				
				$html .= "<tr>";
                $html .= "<td width='50px'>".$no."</td>";
				$html .= "<td>".$row['vNip']."</td>";
				$html .= "<td>".$row['vName']."</td>";
				$html .= "<td>".$row['vNickName']."</td>";
				$html .= "<td>".$row['vNoSPPD']."</td>";
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
		$pejabatTTD 	= $_GET['pejabatTTD'];
		$vNip_ppk 		= $_GET['vNip_ppk'];
		$jabatan1 		= $_GET['jabatan1'];
		$jabatan2 		= $_GET['jabatan2'];
		$diKelurkandi 	= $_GET['diKelurkandi'];
		$dKeluarkanTgl 	= $_GET['dKeluarkanTgl'];
		
		
		$params = new Java("java.util.HashMap");
		$params->put('id', (int)$id);	
		$params->put('SUBREPORT_DIR', $path);		
		$params->put('dikeluarkan', $diKelurkandi);		
		$params->put('tglKeluar', $dKeluarkanTgl);		
		$params->put('baris1', $jabatan1);		
		$params->put('baris2', $jabatan2);		
		$params->put('Nama_pejabat', $vNip_ppk);		
		
		$reportAsal   = "spd.jrxml";
		$reportTujuan = "spd.pdf";

				
		$nama_file = explode('.', $reportAsal);		
		
		$this->report->showReport($path, $reportAsal, $reportTujuan, $params,1);	
		$open_file = file_get_contents($path.$reportTujuan);
		
		force_download($nama_file[0], $open_file);	
	}
	

}

?>