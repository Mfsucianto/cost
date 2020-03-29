<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class st extends CI_Controller {


    function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
     	$this->load->library('report');
        $this->dataFrom = array();

        $addList = array(
				'dMulai' 		=> 'Tgl Mulai Penugasan',
				'iBidangId' 	=> 'Bidang',
				'iJenisRkt' 	=> 'Jenis RKT',
				'iSumberDana' 	=> 'Sumber Dana',
				'cNomorST' 		=> 'Nomor ST ',
				'dTglST' 		=> 'Tanggal ST ',
				'nNilaiPengajuan' 	=> 'Nilai Pengajuan ',
				'nRealiasi' 	=> 'Nilai Realisasi '
			);

        $dataFrom['caption'] 		= 'ST & Cost Sheet';
        $dataFrom['controller'] 	= 'st';
        $dataFrom['primaryKey'] 	= 'iStId';
        $dataFrom['dbName'] 		= 'st_header';
        $dataFrom['addList'] 		= $addList;
    
        

        $this->dataFrom = $dataFrom;
        //print_r($dataFrom);

    }

	public function index(){
		if ($this->session->userdata('cUserId') ) {
	       $this->load->view('view_st');
	    }else{
	    	$this->load->view('view_login');
	    }		
	}

	public function getData(){
		$dataFrom 	= $this->dataFrom;
		$th  		= '';

		
		foreach ($dataFrom['addList'] as $f => $c) {
			$this->db->select($f);
			$th 	.= '<th >'.$c.'</th> ';
		}

		
		$arr_jenis = array(''=>'',0=>'PKAU',1=>'PKPT',2=>'NON PKPT');
		$arr_sumberdana = array(0=>'',1=>'DIPA PERWAKILAN',2=>'SKPA',3=>'DROPING',4=>'PIHAK III',4=>'UNIT BPKP LAIN',5=>'SHARING');
		

		$sql = "SELECT a.iStId,a.iBarcode,a.iBidangId,a.iJenisRkt,a.cNomorST,a.dTglST,a.iSumberDana,
				a.dMulai,a.nNilaiPengajuan,a.nRealiasi,b.vBidangName,
				(select coalesce(sum(nValueAju),0) as nilai_aju 
					from cost.st_detail_rkt where  iStId=a.iStId and lDeleted=0)  as nilai_aju,
				(select coalesce(sum(nRealisasi),0) as nilai_realisasi 
					from cost.st_detail_rkt where  iStId=a.iStId and lDeleted=0)  as nilai_realisasi
				FROM cost.st_header as a
				left join cost.ms_bidang as b on b.iBidangId=a.iBidangId
				where a.lDeleted=0";

		$query 	= $this->db->query($sql);
		

		$html 	= '<table id="example1" class="table table-bordered table-striped" style="white-space: nowrap;">
			<thead>
              <tr>
                <th >No</th>
                <th >Action</th>
                <th >ID ST</th>
                '.$th.'
                
               
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;
				$id = $row[$dataFrom['primaryKey']];
				
				if ($row['dTglST']=='' or $row['dTglST']=='0000-00-00'){
					$dTglST = '';
				}else{
					$dTglST = date('d-m-Y',strtotime($row['dTglST']));
				}

				$html .= "<tr>";
                $html .= "<td width='50px'>".$no."</td>";

                if ($dTglST==''){
                	 $html .= "<td align='center'  width='100px' >
                        <a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' onclick='edit(\"".$id."\")' ><i class='fa fa-edit'></i></a> || 
                        <a  href='#' onclick='hapus(\"".$id."\")' ><i class='fa fa-trash-o'></i></a>
                	</td>";
                }else{
                	 $html .= "<td align='center'  width='100px' >
                        <a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' onclick='edit(\"".$id."\")' ><i class='fa fa-edit'></i></a>
                	</td>";
                }
               
                
             	$html .= "<td>".$row['iBarcode']."</td>";
				$html .= "<td style='text-align:center;' >".date('d-m-Y',strtotime($row['dMulai']))."</td>";
				$html .= "<td>".$row['vBidangName']."</td>";
				$html .= "<td>".$arr_jenis[$row['iJenisRkt']]."</td>";
				$html .= "<td>".$arr_sumberdana[$row['iSumberDana']]."</td>";

				$html .= "<td>".$row['cNomorST']."</td>";
				$html .= "<td>".$dTglST."</td>";
				$html .= "<td align='right' >".number_format($row['nilai_aju'])."</td>";
				$html .= "<td align='right' >".number_format($row['nilai_realisasi'])."</td>";
				
                $html .= "</tr>";

			}
		}

        $html .= '</tbody> </table>';

       
		echo $html;
		exit();
	}

	

	function simpanData(){
		$dataFrom 	= $this->dataFrom;


		$primaryKey = $_POST['iStId'];
		$cUserId 	= $this->session->userdata('cUserId');
			
		$post 		= $_POST;

		unset($post['vNip']);
		unset($post['cGolongan']);
		unset($post['iPeran']);
		unset($post['nJumlahHP']);
		unset($post['dMasaStrat']);
		unset($post['dMasaEnd']);
		unset($post['nLama']);
		unset($post['iJenisPerDinas']);
		unset($post['vDari']);
		unset($post['vTujuan']);
		unset($post['dPerjalananStart']);
		unset($post['dPerjalananEnd']);
		unset($post['iAlatAngkut']);
		unset($post['iOpsiHariLibur']);
		unset($post['iOpsiHariSabtu']);
		unset($post['iOpsiHariMinggu']);
		unset($post['nBiayaUangHarian']);
		unset($post['nBiayaRepre']);
		unset($post['nBiayaTransport']);
		unset($post['iJenisAkomodasi']);
		unset($post['nBiayaPenginapan']);
		unset($post['nHonorJasa']);
		unset($post['vPeranst']);
		if ($post['iStId']==0){
			
			$iBarcode = $this->generateNomorBarcode();
			$post['iBarcode'] = $iBarcode;

		}else{
			unset($post['vNomorCs']);
		}

	

		$post['dTglSrtDasar'] = date('Y-m-d',strtotime($post['dTglSrtDasar']));
		$post['dMulai'] = date('Y-m-d',strtotime($post['dMulai']));
		$post['nJangkaWaktu'] = str_replace(",", '', $post['nJangkaWaktu']);

		$iRktId = array();
		$nValue = array();

		foreach($post as $k=>$v) {
			if (preg_match('/^detail_rkt_iRktId(.*)$/', $k, $match)) {
				$iRktId[] = $v;
			}

			if (preg_match('/^detail_rkt_nValue(.*)$/', $k, $match)) {
				$nValue[] =str_replace(",", '',  $v);
			}
		}

		
		

		unset($post['list_rkt_dipilih']);
		unset($post['detail_rkt_iRktId']);
		unset($post['detail_rkt_nValue']);

		

		if ($primaryKey > 0) {
			$last_id = $primaryKey;

			try {
				$post['tUpdated'] = date('Y-m-d H:i:s');
				$post['cUpdatedBy'] = $cUserId;

				$this->db->where('iStId',$primaryKey);
				$this->db->update('cost.st_header',$post);
				$x = $last_id;
			} catch (Exception $e) {
				$x = 0;
			}

			
		}else{
			unset($post['iStId']);
			try {

				$post['tCreated'] = date('Y-m-d H:i:s');
				$post['cCreatedBy'] = $cUserId;
				
				$this->db->insert('cost.st_header',$post);
				$last_id = $this->db->insert_id();
				$x = $last_id;
			} catch (Exception $e) {
				$x = 0;
			}
			
		}

		//mulai proses detail rkt
		$sql = "DELETE FROM cost.st_detail_rkt WHERE iStId=".$last_id;
		$this->db->query($sql);

		foreach($iRktId as $key=>$value) {
			foreach($value as $k=>$v) {
				$data_rkt = array(
					'iStId' 	=> $last_id,
					'iRktId'	=> $v,
					'nValueAju'	=> $nValue[0][$k],
					'nValue'	=> $nValue[0][$k],
					'tCreated' 	=> date('Y-m-d H:i:s'),
					'cCreatedby' => $cUserId
				);

				$this->db->insert('st_detail_rkt',$data_rkt);
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

			$this->db->where('iStId',$id);
			$this->db->update('st_header',$data);

			//hpaus ke detail rkt
			$this->db->where('iStId',$id);
			$this->db->update('st_detail_rkt',$data);

			//hpaus ke detail team
			$this->db->where('iStId',$id);
			$this->db->update('st_detail_team',$data);


			$x = 1;
		} catch (Exception $e) {
			$x = 0;
		}

		echo $x;
	}

	function getDataEdit(){
		$id = $_POST['id'];
		$text_iDipaId = '';
		
		$sql = "select a.iStId,a.vNomorCs,a.iBidangId,a.iSubBidangId,a.iJenisRkt,a.iJenisSt,
				a.vJenisPenugasan,a.vDasarPenugasan,a.cNoSrtDasar,a.dTglSrtDasar,
				a.cObyekPenugasan,a.vUraianPenugasan,a.dMulai,a.nJangkaWaktu,a.iSumberDana,
				a.iDipaId,a.vUraianSumberDana
				from cost.st_header as a
				where a.iStId='".$id."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row 			= $query->row();

			$row->dTglSrtDasar  = date('d-m-Y',strtotime($row->dTglSrtDasar));
			$row->dMulai 		= date('d-m-Y',strtotime($row->dMulai));

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

	


	function cekSaldoRKT(){
		
		$iRktId = $_POST['iRktId'];
		$nValue = str_replace(",",'', $_POST['nValue']);
		$iStId 	= $_POST['iStId'];
		$ret = '';

		$fJumlahAnggaran = 0;
		$sql = "select cNomorRkt,fAnggaran from cost.rkt where id={$iRktId} ";
		$query = $this->db->query($sql);
		if ($query->num_rows()>0){
			$row = $query->row();
			$cNomorRkt	 	 = $row->cNomorRkt;
			$fJumlahAnggaran = $row->fAnggaran;

			if ($nValue > $fJumlahAnggaran){
				$ret = "Opps, Jumlah Anggaran Over | Jumlah Anggaran Dana Melebihi Nilai Anggaran RKT , Jumlah Anggran RKT ".$cNomorRkt." adalah ".number_format($fJumlahAnggaran);
			}

		}else{
			$ret = "Opps, Data RKT tidak ditemukan|";
		}

		//Cek apa Saldo DIPA sudah abis atau belum
		if ($fJumlahAnggaran > 0){
			$xs = "";
			if ($iStId > 0){
				$xs = " AND iStId!=".$iStId;
			}

		
			$sql = "select coalesce(sum(nValue),0) as terpakai_rkt from cost.st_detail_rkt 
					where iRktId='{$iRktId}' ".$xs." and lDeleted=0";
			$query = $this->db->query($sql);
			if ($query->num_rows()>0){
				$r = $query->row();
				$saldo = $fJumlahAnggaran - $r->terpakai_rkt;
				if ($nValue > $saldo){
					$ret = "Opps, Saldo RKT tidak mencukupi | 
							Anggran RKT ".$cNomorRkt." : ".number_format($fJumlahAnggaran).", Dialokasikan : 
							".number_format($r->terpakai_rkt).", Saldo yang dapat dialokasikan : ".number_format($saldo) ;
				}
			}
		}

		echo $ret;
		
	}

	function getListDataDipa(){

		$cTahun 	= date('Y',strtotime($_POST['cTahun']));
		$iBidangId 	= $_POST['iBidangId'];

		
		$sql = "SELECT a.id,a.cTahun,a.cKodeDipa,a.vNamaItem,a.cKodeAccount,a.iJenis,a.fJumlahAnggaran,
				(select coalesce(sum(dt.nNilaiKwitansi),0) as nNilaiKwitansi
				from cost.cs_detail as dt
				where dt.iDipaId=a.id and dt.lDeleted=0 ) as nNilaiKwitansi,
				(select coalesce(sum(dt.nTotalBiaya),0) as nTotalBiaya
				from cost.cs_detail as dt
				where dt.iDipaId=a.id  and  dt.lDeleted=0 and dt.nNilaiKwitansi=0 ) as nTotalBiaya
				FROM cost.dipa AS a WHERE a.cTahun='{$cTahun}' AND a.iBidangId='{$iBidangId}' AND a.lDeleted=0;";

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

				$tersedia = $row['fJumlahAnggaran'] - $row['nTotalBiaya'] - $row['nNilaiKwitansi'];
				
				$html .= "<tr>";
                
                $html .= "<td  style='width:5%' align='center'  > 
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
									<td>Anggaran DIPA </td>
									<td>: </td>
									<td>".number_format($row['fJumlahAnggaran'])."</td>
								</tr>

								<tr>
									<td>Outstanding </td>
									<td>: </td>
									<td>".number_format($row['nTotalBiaya'])."</td>
								</tr>

								<tr>
									<td>Realisasi </td>
									<td>: </td>
									<td>".number_format($row['nNilaiKwitansi'])."</td>
								</tr>

								<tr>
									<td>Sisa Anggaran </td>
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


	function getListRkt(){
		$iDipaId = $_POST['iDipaId'];
		$exld = $_POST['list_rkt_dipilih'];

		if ($exld!=''){
			$ex = " a.id not in (".$exld.") AND ";
		}else{
			$ex = "";
		}
		$sql = "SELECT
					a.id,
					a.cNomorRkt,
					a.cNamaItem,
					a.iJumlahRencana,
					a.fAnggaran,
					(
					select
						coalesce(sum(rd.nValue),
						0) as anggaran_terpakai
					from
						cost.st_detail_rkt as rd
					inner join cost.st_header as rh on
						rh.iStId = rh.iStId
					where
						rd.iRktId = a.id 
						and rd.lDeleted = 0
						and rh.lDeleted = 0) as anggaran_terpakai,
					(
					select
						count(*) as qty_count
					from
						cost.st_detail_rkt as rd
					inner join cost.st_header as rh on
						rh.iStId = rd.iStId
					where
						rd.iRktId = a.id 
						and rd.lDeleted = 0
						and rh.lDeleted = 0) as qty_count
				FROM
					cost.rkt as a
				WHERE ".$ex."
					a.iDipaId ='{$iDipaId}' 
					and lDeleted = 0;
				";

		$query = $this->db->query($sql);

		$html 	= '<table id="list_popup" class="table table-bordered table-striped" style="width:100%">
			<thead>
              <tr>
               
                <th >Pilih</th>
                <th >Nomor RKT</th>
                <th >Nama Item</th>
                <th >Jumlah Rencana Penugasan</th>
                <th >Sisa Rencana Penugasan</th>
                <th >Saldo Anggaran</th>
                	
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;

				$tersedia = $row['fAnggaran'] - $row['anggaran_terpakai'];
				$sisa_pagu = $row['iJumlahRencana'] - $row['qty_count'];
				$html .= "<tr>";
                
                if ($sisa_pagu > 0 && $tersedia > 0){
                	$html .= "<td   style='width:5%' align='center'  > 
                			<input type='radio' onclick='select_row_rkt(
                			\"".$row['id']."\",
                			\"".$row['cNomorRkt']."\",
                			\"".$row['cNamaItem']."\",
                			\"".$row['qty_count']."\",
                			\"".$tersedia."\"

                			)' />
                		</td>";	
                	}else{
                		$html .= "<td></td>";
                	}
                
				$html .= "<td>".$row['cNomorRkt']."</td>";
				$html .= "<td>".$row['cNamaItem']."</td>";
				$html .= "<td>".$row['iJumlahRencana']."</td>";
				$html .= "<td>".$sisa_pagu."</td>";
				$html .= "<td align='left' style='white-space: nowrap;' >
							".number_format($tersedia)."

						</td>";
                $html .= "</tr>";
			}
		}

		echo $html;
	}


	function generateNomorCS($iBidangId){
		$cTahun = date('Y');
		$sql = "SELECT a.iBidangId,a.iNomor,
				COALESCE((SELECT iLastNumber FROM cost.counter_st WHERE iBidangId=a.iBidangId and cTahun='".$cTahun."' ),0) AS iLastNumber 
				FROM cost.ms_bidang AS a WHERE a.iBidangId='".$iBidangId."'";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$r = $query->row();
			$iNomor = $r->iNomor;
			$iLastNumber = $r->iLastNumber;

			if ($iLastNumber==0){
				$iLastNumber = 1;
				$sqli = "INSERT INTO cost.counter_st (iBidangId,cTahun,iLastNumber) VALUES (
						'".$iBidangId."','".$cTahun."',1)";
			}else{
				$iLastNumber = $iLastNumber + 1;
				$sqli = "UPDATE cost.counter_st SET iLastNumber='".$iLastNumber."' 
						 WHERE iBidangId='".$iBidangId."' and cTahun='".$cTahun."'  ";
			}

			$this->db->query($sqli);

			$autogenerated_code = "CS-".$iLastNumber."/PW04/".$iNomor."/".$cTahun;
			return $autogenerated_code;

		}
	}


	function generateNomorBarcode(){
		$cTahun = date('Y');
		$yy = date('y');
		$sql = "SELECT iLastNUmber FROM cost.tabcount WHERE cCode='BAR' AND cTahun='".$cTahun."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$r = $query->row();
			$iLastNUmber = $r->iLastNUmber + 1;

			$sqlu = "UPDATE cost.tabcount SET iLastNUmber='".$iLastNUmber."' WHERE cCode='BAR' AND cTahun='".$cTahun."'";
		}else{
			$iLastNUmber = 1;
			$sqlu = "INSERT INTO cost.tabcount (cCode,cTahun,iLastNumber,vDesc) VALUES ('BAR','".$cTahun."',1,'Counter For Barcode Cost Sheet')";
		}

		$autogenerated_code = $yy.str_pad($iLastNUmber, 4, "0", STR_PAD_LEFT);
		
		$this->db->query($sqlu);
		return $autogenerated_code;
	}


	function getDataDetailRKT(){
		$iStId = $_POST['iStId'];

		$data = array();

		$sql = "select a.iRktId,b.cNomorRkt,b.cNamaItem,a.nValue 
				from cost.st_detail_rkt as a
				left join cost.rkt as b on b.id = a.iRktId 
				where a.iStId='".$iStId."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$r_data['iRktId'] 	 = $row['iRktId'];
				$r_data['cNomorRkt'] = $row['cNomorRkt'];
				$r_data['cNamaItem'] = $row['cNamaItem'];
				$r_data['nValue']    = $row['nValue'];

				array_push($data, $r_data);
			}
		}
		echo json_encode($data);
		exit;	
	}

	function getListPersonalTeam(){
		$iStId = $_POST['iStId'];

		$arr_peran = array(''=>'',	0=>'Pembantu Penanggung Jawab', 1=>'Pengendali Mutu', 2=>'Pengendali Teknis', 3=>'Ketua Tim', 4=>'Anggota Tim', 5=>'Penanggung Jawab'); 
		$data = array();

		$sql = "select a.id,a.vNip,b.vName,a.iPeran,a.nJumlahHP,
				a.dMasaStrat,a.dMasaEnd,a.vPeranst
				from cost.st_detail_team  as a
				left join cost.ms_pegawai as b on b.vNip=a.vNip
				where a.iStId ='".$iStId."' and a.lDeleted=0";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$r_data['id'] 			= $row['id'];
				$r_data['vNip'] 		= $row['vNip'];
				$r_data['vName'] 		= $row['vName'];
				$r_data['peran']    	= $arr_peran[$row['iPeran']];
				$r_data['vPeranst']    = $row['vPeranst'];
				$r_data['nJumlahHP']    = $row['nJumlahHP'];
				$r_data['dMasa']    	= date('d-m-Y',strtotime($row['dMasaStrat']))." s/d ".date('d-m-Y',strtotime($row['dMasaEnd']));

				array_push($data, $r_data);
			}
		}
		echo json_encode($data);
		exit;	
	}


	function getListPegawai(){
		$iBidangId 	= $_POST['iBidangId'];
		$iStId 	= $_POST['iStId'];
		$nip_ex = '(';
		$sql = "SELECT vNip FROM cost.st_detail_team WHERE iStId='".$iStId."' AND lDeleted=0";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$nip_ex .= "'".$row['vNip']."',";
			}
			$nip_ex = rtrim($nip_ex,",").")";

			$xc = " and vNip not in ".$nip_ex." ";
		}else{
			$xc = "";
		}



		$sql = "select vNip,vName,cGolongan from cost.ms_pegawai where lDeleted = 0  ".$xc."  ";
		$query = $this->db->query($sql);

		$html 	= '<table id="list_popup" class="table table-bordered table-striped" style="width:100%">
			<thead>
              <tr>
               
                <th >Pilih</th>
                <th >NIP</th>
                <th >Nama</th>
                <th >Golongan</th>
                	
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;

				
				
				$html .= "<tr>";
                
                $html .= "<td  style='width:5%' align='center'  > 
                			<input type='radio' onclick='select_row_pegawai(
                			\"".$row['vNip']."\",
                			\"".$row['vName']."\",
                			\"".$row['cGolongan']."\"

                			)' />
                		</td>";	
				$html .= "<td>".$row['vNip']."</td>";
				$html .= "<td>".$row['vName']."</td>";
				$html .= "<td style='width:10%' >".$row['cGolongan']."</td>";
                $html .= "</tr>";
			}
		}

		echo $html;
	}



	function simpanDataTeam(){
		
		$post = $_POST;

		$iStId 		= $post['iStId'];
		$vNip 		= $post['vNip'];
		$cUserId 	= $this->session->userdata('cUserId');


		$post['nJumlahHP'] 	= str_replace(",", '',$post['nJumlahHP']);
		

		$post['lDeleted'] 			= 0;

		try {
			$sqlc = "SELECT * FROM cost.st_detail_team WHERE iStId='".$iStId."' AND vNip='".$vNip."' ";
			$queryc = $this->db->query($sqlc);
			if ($queryc->num_rows() > 0){
				$post['tUpdated'] =  date('Y-m-d H:i:s');
				$post['cUpdatedBy'] = $cUserId;

				$this->db->where('iStId',$iStId);
				$this->db->where('vNip',$vNip);
				$this->db->update('cost.st_detail_team',$post);
			}else{
				$post['tCreated'] =  date('Y-m-d H:i:s');
				$post['cCreatedby'] = $cUserId;

				$this->db->insert('cost.st_detail_team',$post);
			}

			$x = 2;
		} catch (Exception $e) {
			$x = 0;
		}

		echo $x;

		

	}

	function hapusDataTeam(){
		$id 		= $_POST['id'];
		$cUserId 	= $this->session->userdata('cUserId');

		try {
			
			$data =  array(
				'lDeleted' => 1,
				'tUpdated' => date('Y-m-d H:i:s'),
				'cUpdatedBy' => $cUserId
			);

			$this->db->where('id',$id);
			$this->db->update('st_detail_team',$data);

			$x = 1;
		} catch (Exception $e) {
			$x = 0;
		}

		echo $x;
	}

	function getDataEditTeam(){
		$id = $_POST['id'];
		
		$data = array();

		$sql = "select a.id,a.vNip,b.vName,a.iPeran,a.vPeranst,a.nJumlahHP,b.cGolongan
				from cost.st_detail_team  as a
				left join cost.ms_pegawai as b on b.vNip=a.vNip
				where a.id ='".$id."' ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();

			echo json_encode($row);
			
		}
		
	}

	function cetakST2(){
		$iStId = $_GET['iStId'];

		$this->load->helper('download'); 
		
		$path = $this->config->item('report_path');
		
		
		
		$params = new Java("java.util.HashMap");
		$params->put('iStId', (int)$iStId);	
		$params->put('SUBREPORT_DIR', $path);		
		
		$reportAsal   = "st.jrxml";
		$reportTujuan = "surat_tugas.pdf";

				
		$nama_file = explode('.', $reportAsal);		
		
		$this->report->showReport($path, $reportAsal, $reportTujuan, $params,1);	
		$open_file = file_get_contents($path.$reportTujuan);
		
		force_download($nama_file[0], $open_file);	
	}

	function cetakCs(){
		$iCsId 		= $_GET['iCsId'];
		$nipDalnis 	= explode("|", $_GET['nipDalnis']);
		$nipKabag 	= explode("|", $_GET['nipKabag']);
		$iKabag 	= $_GET['iKabag'];
		$nipiKaPer 	= explode("|",$_GET['nipiKaPer']);
		$iKaPer 	= $_GET['iKaPer'];
		$diKelurkandi 	= $_GET['diKelurkandi'];
		$dKeluarkanTgl 	= $_GET['dKeluarkanTgl'];

		$this->load->helper('download'); 
		
		$path = $this->config->item('report_path');
		
		
		
		$params = new Java("java.util.HashMap");
		$params->put('icsId', (int)$iCsId);	
		$params->put('SUBREPORT_DIR', $path);		
		$params->put('nip_kaper', $nipiKaPer['0']);		
		$params->put('nama_kaper', $nipiKaPer['1']);		
		$params->put('nip_kabag', $nipKabag['0']);		
		$params->put('nama_kabag', $nipKabag['1']);		
		$params->put('nip_kasubag', $nipDalnis['0']);		
		$params->put('nama_kasubag', $nipDalnis['1']);
		$params->put('diKelurkandi',$diKelurkandi);		
		$params->put('dKeluarkanTgl',$dKeluarkanTgl);		
		
		$reportAsal   = "cs.jrxml";
		$reportTujuan = "cost_sheet.pdf";

				
		$nama_file = explode('.', $reportAsal);		
		
		$this->report->showReport($path, $reportAsal, $reportTujuan, $params,1);	
		$open_file = file_get_contents($path.$reportTujuan);
		
		force_download($nama_file[0], $open_file);	
	}	
	
}

?>