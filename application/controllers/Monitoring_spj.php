<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class monitoring_spj extends CI_Controller {


    function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
    	$this->load->library('report');
    }

	public function index(){
		if ($this->session->userdata('cUserId') && $this->session->userdata('iPeran')==1) {
	       $this->load->view('view_monitoring_spj');
	    }else{
	    	$this->load->view('view_login');
	    }		
	}

	public function getData(){
		$cTahun = $_POST['cTahun'];
		

		$sql = "select a.dTglKwitansi,a.vNomorKwitansi,a.vNip,(select vName from cost.ms_pegawai where vNip=a.vNip) as vName,
				st.vUraianPenugasan,b.vTujuan,a.nNilaiKwitansi,a.vNoSPPD
				from cost.cs_detail as a
				inner join cost.cs_header as b on b.iCsId=a.iCsId
				inner join cost.st_header as st on st.iStId=b.iStId
				where a.cTahunKwitansi='".$cTahun."' and a.lDeleted=0 and b.lDeleted=0 ";


		$query 	= $this->db->query($sql);
	
		$html 	= '<table id="example1" class="table table-bordered table-striped" style="white-space: nowrap;">
			<thead>
              <tr>
               	<td>No</td>
               	<td>No SPD</td>
               	<td>Tgl Kwitansi</td>
               	<td>Nomor Kwitansi</td>
               	<td>NIP</td>
               	<td>Nama</td>
               	<td>Nama Penugasan</td>
               	<td>Tujuan</td>
               	<td>Biaya</td>
               	<td>Rupiah</td>
               
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;
				$html .= "<tr>";
                $html .= "<td width='50px'>".$no."</td>";
				$html .= "<td>".$row['vNoSPPD']."</td>";
				$html .= "<td>".date('d-m-Y',strtotime($row['dTglKwitansi']))."</td>";
				$html .= "<td>".$row['vNomorKwitansi']."</td>";
				$html .= "<td>".$row['vNip']."</td>";
				$html .= "<td>".$row['vName']."</td>";
				$html .= "<td>".$row['vUraianPenugasan']."</td>";
				$html .= "<td>".$row['vTujuan']."</td>";
				$html .= "<td>perwakilan BPKP Provinsi Riau</td>";
				$html .= "<td>".number_format($row['nNilaiKwitansi'])."</td>";
				
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