<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rencana extends CI_Controller {


    function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
    	$this->load->library('report');
    }

	public function index(){
		if ($this->session->userdata('cUserId') && $this->session->userdata('iPeran')==1) {
	       $this->load->view('view_rencana');
	    }else{
	    	$this->load->view('view_login');
	    }		
	}

	public function getListDataSpd(){
		
		$arr_sum = array(
						0=>'',
						1=>'DIPA PERWAKILAN',
                        2=>'SKPA',
                        3=>'DROPING',
                        4=>'PIHAK III',
                        5=>'UNIT BPKP LAIN',
                        6=>'SHARING');

		$sql = "select a.id,st.iBarcode,st.cNomorST,c.vNomorCs,a.vNip,b.vName,a.vNoSPPD,a.dTglSPPD,
				b.cGolongan,jb.vJabatanName,st.vUraianPenugasan,
				case 
						when a.iAlatAngkut=1 then 'Pesawat Terbang'
						when a.iAlatAngkut=2 then 'Kapal Laut'
						when a.iAlatAngkut=3 then 'Kendaraan Umum'
						when a.iAlatAngkut=4 then 'Kereta AP'
						when a.iAlatAngkut=5 then 'Kendaraan Dinas'
						else ''
					end as alat_angkut,
				iOpsiHariLibur, iOpsiHariSabtu, iOpsiHariMinggu, dPerjalananStart, dPerjalananEnd,
				st.iSumberDana,iCheckSuratTugas,
				iChekSpd, iChekPenginapan, iChekTransportasi, iChekPengeluaran, dTerimaSpj,
				c.vDari,c.vTujuan,a.vNomorKwitansi,a.dTglKwitansi,a.nNilaiKwitansi,a.dLumpsumpAwal,a.dLumpsumpAkhir, 
				dp.cTahun,dp.cKodeDipa,dp.fJumlahAnggaran
				from cost.cs_detail as a
				left join cost.ms_pegawai as b on b.vNip=a.vNip
				inner join cost.cs_header as c on c.iCsId=a.iCsId
				inner join cost.st_header as st on st.iStId=c.iStId
				left join cost.ms_jabatan as jb on jb.iJabatanId = b.iJabatanId
				inner join cost.dipa as dp on dp.id=st.iDipaId

				where a.vNoSPPD!='' and a.lDeleted=0 and c.lDeleted=0 ";


		$query 	= $this->db->query($sql);
	
		$html 	= '<table id="example1" class="table table-bordered table-striped" style="white-space: nowrap;">
			<thead>
              <tr>
               	<td>No</td>
               	<td>Pilih</td>
               	<td>ID ST</td>
               	<td>Nomor Cost Sheet</td>
               	<td>NIP</td>
               	<td>Nama</td>
               	<td>Nomor SPPD</td>
               	<td>Tgl SPPD</td>
               
               
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;
				$id = $row['id'];
				
				if ($row['dTglSPPD']=='' || $row['dTglSPPD']=='0000-00-00'){
             		$dTglSPPD = '';
             	}else{
             		$dTglSPPD =  date('d-m-Y',strtotime($row['dTglSPPD']));
             	}

             	if ($row['dTerimaSpj']=='' || $row['dTerimaSpj']=='0000-00-00'){
             		$dTerimaSpj = '';
             	}else{
             		$dTerimaSpj =  date('d-m-Y',strtotime($row['dTerimaSpj']));
             	}

             	if ($row['dTglKwitansi']=='' || $row['dTglKwitansi']=='0000-00-00'){
             		$dTglKwitansi = '';
             	}else{
             		$dTglKwitansi =  date('d-m-Y',strtotime($row['dTglKwitansi']));
             	}

             	if ($row['dLumpsumpAwal']=='' || $row['dLumpsumpAwal']=='0000-00-00'){
             		$dLumpsumpAwal = '';
             	}else{
             		$dLumpsumpAwal =  date('d-m-Y',strtotime($row['dLumpsumpAwal']));
             	}

             	if ($row['dLumpsumpAkhir']=='' || $row['dLumpsumpAkhir']=='0000-00-00'){
             		$dLumpsumpAkhir = '';
             	}else{
             		$dLumpsumpAkhir =  date('d-m-Y',strtotime($row['dLumpsumpAkhir']));
             	}


             	
				
				$nSisaPaguAkhir = $row['fJumlahAnggaran'] - $row['nNilaiKwitansi'];
				
				

				$nLama = $this->lib_util->hitungLamaPerjalanan2($row['iOpsiHariLibur'],$row['iOpsiHariSabtu'],$row['iOpsiHariMinggu'],$row['dPerjalananStart'],$row['dPerjalananEnd']);

				$html .= "<tr>";
                $html .= "<td width='50px'>".$no."</td>";
               	$html .= "<td  style='width:5%' align='center'  > 
                			<input type='radio' onclick='select_row_spd(
                			\"".$row['id']."\",
                			\"".$dTglSPPD."\",
                			\"".$row['vNoSPPD']."\",
                			\"".$row['vNip']."\",
                			\"".$row['vName']."\",
                			\"".$row['cGolongan']."\",
                			\"".$row['vJabatanName']."\",
                			\"".$row['vUraianPenugasan']."\",
                			\"".$row['alat_angkut']."\",
                			\"".$nLama."\",
                			\"".date('d-m-Y',strtotime($row['dPerjalananStart']))."\",
                			\"".date('d-m-Y',strtotime($row['dPerjalananEnd']))."\",
                			\"".$arr_sum[$row['iSumberDana']]."\",
                			\"".$row['iCheckSuratTugas']."\",
                			\"".$row['iChekSpd']."\",
                			\"".$row['iChekPenginapan']."\",
                			\"".$row['iChekTransportasi']."\",
                			\"".$row['iChekPengeluaran']."\",
                			\"".$dTerimaSpj."\",
                			\"".$row['vDari']."\",
                			\"".$row['vTujuan']."\",
                			\"".$row['cTahun']."\",
                			\"".$row['cKodeDipa']."\",
                			\"".$row['vNomorKwitansi']."\",
                			\"".$dTglKwitansi."\",
                			\"".number_format($row['nNilaiKwitansi'])."\",
                			\"".$dLumpsumpAwal."\",
                			\"".$dLumpsumpAkhir."\",
                			\"".number_format($row['fJumlahAnggaran'])."\",
                			\"".number_format($nSisaPaguAkhir)."\",

                			)' />
                		</td>";	
  
				$html .= "<td>".$row['iBarcode']."</td>";
				$html .= "<td>".$row['vNomorCs']."</td>";
				$html .= "<td>".$row['vNip']."</td>";
				$html .= "<td>".$row['vName']."</td>";
				$html .= "<td>".$row['vNoSPPD']."</td>";
				$html .= "<td>".$dTglSPPD."</td>";
                $html .= "</tr>";

			}
		}

        $html .= '</tbody> </table>';
		echo $html;
		exit();
	}



	function simpanData(){
		$id 				= $_POST['id'];
		$iCheckSuratTugas 	= $_POST['iCheckSuratTugas'];
		$iChekSpd 			= $_POST['iChekSpd'];
		$iChekPenginapan 	= $_POST['iChekPenginapan'];
		$iChekTransportasi 	= $_POST['iChekTransportasi'];
		$iChekPengeluaran 	= $_POST['iChekPengeluaran'];
		$dTerimaSpj 		= date('Y-m-d',strtotime($_POST['dTerimaSpj']));

		$cUserId 	= $this->session->userdata('cUserId');


		try {
			
			$data = array(
				'iCheckSuratTugas' 	=> $iCheckSuratTugas,
				'iChekSpd'   		=> $iChekSpd,
				'iChekPenginapan'   => $iChekPenginapan,
				'iChekTransportasi' => $iChekTransportasi,
				'iChekPengeluaran'  => $iChekPengeluaran,
				'dTerimaSpj'   		=> $dTerimaSpj,
				'tUpdated'   		=> date('Y-m-d H:i:s'),
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
			where date_format(a.dTglSPPD,'%Y')='2020' and a.lDeleted=0 ".$qb;

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
	



	function simpanDataKwitansi(){
		$post = $_POST;


		$id = $post['id'];


		$vNomorKwitansi = $post['vNomorKwitansi'];
		$dTglKwitansi =date('Y-m-d',strtotime( $post['dTglKwitansi']));
		$dLumpsumpAwal =date('Y-m-d',strtotime( $post['dLumpsumpAwal']));
		$dLumpsumpAkhir =date('Y-m-d',strtotime( $post['dLumpsumpAkhir']));
		
		$penugasan_nHari 	= array();
		$penugasan_nBiaya 	= array();
		$penugasan_vKeterangan 	= array();

		$penginapan_nHari	= array();
		$penginapan_nBiaya  = array();
		$penginapan_vKeterangan  = array();

		$repre_nHari 		= array();
		$repre_nBiaya		= array();
		$repre_vKeterangan		= array();

		$vTransDari 		= $post['vTransDari'];
		$vTransTujuan 		= $post['vTransTujuan'];
		$trans_nBiaya 		= str_replace(",", '', $post['trans_nBiaya']);
		$trans_vKeterangan 		= $post['trans_vKeterangan'];


		

		$nNilaiKwitansi      = 0;

		foreach($post as $k=>$v) {
		
			if (preg_match('/^penugasan_nHari(.*)$/', $k, $match)) {
				$penugasan_nHari[] = str_replace(",", "", $v);
			}

			if (preg_match('/^penugasan_nBiaya(.*)$/', $k, $match)) {
				$penugasan_nBiaya[] = str_replace(",", "", $v);
			}

			if (preg_match('/^penugasan_vKeterangan(.*)$/', $k, $match)) {
				$penugasan_vKeterangan[] = $v;
			}

			if (preg_match('/^penginapan_nHari(.*)$/', $k, $match)) {
				$penginapan_nHari[] = str_replace(",", "", $v);
			}

			if (preg_match('/^penginapan_nBiaya(.*)$/', $k, $match)) {
				$penginapan_nBiaya[] = str_replace(",", "", $v);
			}

			if (preg_match('/^penginapan_vKeterangan(.*)$/', $k, $match)) {
				$penginapan_vKeterangan[] = $v;
			}



			if (preg_match('/^repre_nHari(.*)$/', $k, $match)) {
				$repre_nHari[] = str_replace(",", "", $v);
			}

			if (preg_match('/^repre_nBiaya(.*)$/', $k, $match)) {
				$repre_nBiaya[] = str_replace(",", "", $v);
			}

			if (preg_match('/^repre_vKeterangan(.*)$/', $k, $match)) {
				$repre_vKeterangan[] = $v;
			}

		}


		//delete detailnya dulu 
		$sql = "DELETE FROM cost.cs_detail_kwitansi WHERE iCsDetailId='".$id."' ";
		$this->db->query($sql);

		foreach($penugasan_nHari as $key=>$value) {
			foreach($value as $k=>$v) {
				$nJumlah  		= $v *  $penugasan_nBiaya[0][$k];
				$nNilaiKwitansi = $nNilaiKwitansi + $nJumlah;

				$data_kwitansi = array(
						'iCsDetailId' => $id,
						'iJenis'	  =>1,
						'nHari'		  => $v,
						'nBiaya'	  => $penugasan_nBiaya[0][$k],
						'vKeterangan' => $penugasan_vKeterangan[0][$k],
						'nJumlah'	  => $nJumlah
					);
				$this->db->insert('cost.cs_detail_kwitansi',$data_kwitansi);
			}
		}


		//=========Penginapan=============
		foreach($penginapan_nHari as $key=>$value) {
			foreach($value as $k=>$v) {
				$nJumlah  		= $v *  $penginapan_nBiaya[0][$k];
				$nNilaiKwitansi = $nNilaiKwitansi + $nJumlah;

				$data_kwitansi = array(
						'iCsDetailId' => $id,
						'iJenis'	  => 2,
						'nHari'		  => $v,
						'nBiaya'	  => $penginapan_nBiaya[0][$k],
						'vKeterangan' => $penginapan_vKeterangan[0][$k],
						'nJumlah'	  => $nJumlah
					);
				$this->db->insert('cost.cs_detail_kwitansi',$data_kwitansi);
			}
		}

		//=============Repre
		foreach($repre_nHari as $key=>$value) {
			foreach($value as $k=>$v) {
				$nJumlah  		= $v *  $repre_nBiaya[0][$k];
				$nNilaiKwitansi = $nNilaiKwitansi + $nJumlah;

				$data_kwitansi = array(
						'iCsDetailId' => $id,
						'iJenis'	  =>3,
						'nHari'		  => $v,
						'nBiaya'	  => $repre_nBiaya[0][$k],
						'vKeterangan' => $repre_vKeterangan[0][$k],
						'nJumlah'	  => $nJumlah
					);

				$this->db->insert('cost.cs_detail_kwitansi',$data_kwitansi);
			}
		}

		//transport


		$nNilaiKwitansi = $nNilaiKwitansi + $trans_nBiaya;
		$data_kwitansi = array(
						'iCsDetailId' => $id,
						'iJenis'	  =>4,
						'vTransDari'  => $vTransDari,
						'vTransTujuan' => $vTransTujuan,
						'vKeterangan' => $trans_vKeterangan,
						'nJumlah'	  => $trans_nBiaya
					);

		$this->db->insert('cost.cs_detail_kwitansi',$data_kwitansi);


		$data = array(
			'vNomorKwitansi' => $vNomorKwitansi,
			'dTglKwitansi'	=> $dTglKwitansi,
			'dLumpsumpAwal' => $dLumpsumpAwal,
			'dLumpsumpAkhir' => $dLumpsumpAkhir,
			'nNilaiKwitansi' => $nNilaiKwitansi
		);

		try {
			$this->db->where('id',$id);
			$this->db->update('cost.cs_detail',$data);
			$x = 1;
		} catch (Exception $e) {
			$x = 0;
		}
		
		echo $x;
	}


	function getListKwitansi(){
		$iCsDetailId = $_POST['id'];
		$data = array();

		$sql = "SELECT iJenis,nHari,nBiaya,nJumlah,vTransDari,vTransTujuan,vKeterangan FROM cost.cs_detail_kwitansi WHERE iCsDetailId='".$iCsDetailId."'";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$r_data['iJenis'] 		= $row['iJenis'];
				$r_data['nHari'] 		= $row['nHari'];
				$r_data['nBiaya'] 		= number_format($row['nBiaya']);
				$r_data['nJumlah'] 		= number_format($row['nJumlah']);
				$r_data['vTransDari'] 	= $row['vTransDari'];
				$r_data['vTransTujuan'] = $row['vTransTujuan'];
				$r_data['vKeterangan'] = $row['vKeterangan'];
				array_push($data, $r_data);
			}
		}
		echo json_encode($data);
		exit;	
	}


	function simpanDataDpr(){
		$id = $_POST['id_dpr'];

		$post = $_POST;

		$vPerincian = array();
		$nJumlah	= array();

		foreach($post as $k=>$v) {
		
			if (preg_match('/^dpr_vPerincian(.*)$/', $k, $match)) {
				$vPerincian[] = $v;
			}

			if (preg_match('/^dpr_nJumlah(.*)$/', $k, $match)) {
				$nJumlah[] = str_replace(",", "", $v);
			}
		}

		$sql = "DELETE FROM cost.cd_detail_dpr WHERE iCsDetailId='".$id."' ";
		$this->db->query($sql);

		foreach($vPerincian as $key=>$value) {
			foreach($value as $k=>$v) {
				
				$data_dpr = array(
						'iCsDetailId' => $id,
						'vPerincian'  => $v,
						'nJumlah'	  => $nJumlah[0][$k]
					);

				$this->db->insert('cost.cd_detail_dpr',$data_dpr);
			}
		}

		echo '1';
	}

	function getListDpr(){
		$iCsDetailId = $_POST['id'];
		$data = array();

		$sql = "SELECT vPerincian,nJumlah FROM cost.cd_detail_dpr WHERE iCsDetailId='".$iCsDetailId."'";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$r_data['vPerincian'] 		= $row['vPerincian'];
				$r_data['nJumlah'] 		= number_format($row['nJumlah']);
				array_push($data, $r_data);
			}
		}
		echo json_encode($data);
		exit;	
	}


	function cetakkwitansi(){
		$this->load->helper('download');
		$path = $this->config->item('report_path'); 
		$id = $_GET['id'];

		$x_vPejabatKwitansi 	= explode("|", $_GET['vPejabatKwitansi']);
		$x_vBendaharaKwitansi 	= explode("|", $_GET['vBendaharaKwitansi']);

		$nm_bendahara 	= $x_vBendaharaKwitansi['1'];
		$nip_bendahara 	= $x_vBendaharaKwitansi['0'];
		$nip_pejabat  	= $x_vPejabatKwitansi['0'];
		$nm_pejabat 	= $x_vPejabatKwitansi['1'];
		$dibuat_di 		= $_GET['dibuatdiKwitansi'];
		$tgl_dibuat 	= $_GET['tgl_dibuatKwitansi'];
		$terbilang 	= $_GET['terbilang'];

		$params = new Java("java.util.HashMap");
		$params->put('id', (int)$id);	
		$params->put('SUBREPORT_DIR', $path);		
		$params->put('nm_bendahara', $nm_bendahara);		
		$params->put('nip_bendahara', $nip_bendahara);		
		$params->put('nip_pejabat', $nip_pejabat);		
		$params->put('nm_pejabat', $nm_pejabat);		
		$params->put('dibuat_di', $dibuat_di);		
		$params->put('tgl_dibuat', $tgl_dibuat);		
		$params->put('terbilang', $terbilang);		
		
		$reportAsal   = "kwitansi.jrxml";
		$reportTujuan = "kwitansi_.pdf";

				
		$nama_file = explode('.', $reportAsal);		
		
		$this->report->showReport($path, $reportAsal, $reportTujuan, $params,1);	
		$open_file = file_get_contents($path.$reportTujuan);
		
		force_download($nama_file[0], $open_file);


	}

	function cetakperjadin(){
		$this->load->helper('download');
        $path = $this->config->item('report_path'); 
        $id = $_GET['id'];

        $x_vPejabatperjadin     = explode("|", $_GET['vPejabatperjadin']);
        $x_vBendaharaperjadin   = explode("|", $_GET['vBendaharaperjadin']);

        $nm_bendahara   = $x_vBendaharaperjadin['1'];
        $nip_bendahara  = $x_vBendaharaperjadin['0'];
        $nip_pejabat    = $x_vPejabatperjadin['0'];
        $nm_pejabat     = $x_vPejabatperjadin['1'];
        $dibuat_di      = $_GET['dibuatdiperjadin'];
        $tgl_dibuat     = $_GET['tgl_dibuatperjadin'];
        $terbilang  = $_GET['terbilang'];

        $params = new Java("java.util.HashMap");
        $params->put('id', (int)$id);   
        $params->put('SUBREPORT_DIR', $path);       
        $params->put('nm_bendahara', $nm_bendahara);        
        $params->put('nip_bendahara', $nip_bendahara);      
        $params->put('nip_pejabat', $nip_pejabat);      
        $params->put('nm_pejabat', $nm_pejabat);        
        $params->put('dibuat_di', $dibuat_di);      
        $params->put('tgl_dibuat', $tgl_dibuat);        
        $params->put('terbilang', $terbilang);      
        
        $reportAsal   = "perjadin.jrxml";
        $reportTujuan = "perjadin_.pdf";

                
        $nama_file = explode('.', $reportAsal);     
        
        $this->report->showReport($path, $reportAsal, $reportTujuan, $params,1);    
        $open_file = file_get_contents($path.$reportTujuan);
        
        force_download($nama_file[0], $open_file);
	}
}

?>