<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cost_sheet extends CI_Controller {

	public $iStId;
    function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
     
        $this->iStId = $this->input->post('iStId');
        

       //print_r($_POST);

    }

	public function index(){
		$this->load->view('view_cost_sheet');	
	}

	public function getData(){

		$iStId =  $this->iStId;
		

		$sql = "select a.iCsId,a.vNomorCs,a.dMasaStrat,a.dMasaEnd,a.dTanggalCS,
				(select coalesce(SUM(nTotalBiaya),0) from cost.cs_detail where iCsId=a.iCsId) as nTotalBiaya
				from cost.cs_header as a
				where a.iStId='".$iStId."' and a.lDeleted=0 ";
		$query = $this->db->query($sql);

		$html 	= '<table id="example1" class="table table-bordered table-striped">
			<thead>
              <tr>
                <th >No</th>
                <th >Action</th>
                <th >Tanggal CS</th>
                <th >Nomor Cost Sheet</th>
                <th >Masa Penugasan</th>
                <th >Total</th>
              </tr>
            </thead>
            <tbody>';
        $no=0;
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$no++;
				$id = $row['iCsId'];

				if ($row['dTanggalCS']=='' || $row['dTanggalCS']=='0000-00-00'){
					$dTanggalCS = '';
				}else{
					$dTanggalCS = date('d-m-Y',strtotime($row['dTanggalCS']));
				}
				
				$html .= "<tr>";
                $html .= "<td style='width:10%;'>".$no."</td>";
                $html .= "<td align='center'  width='100px' >
                        <a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' onclick='editDataCS(\"".$id."\")' ><i class='fa fa-edit'></i></a> || 
                        <a  href='#' onclick='hapusDataCs(\"".$id."\")' ><i class='fa fa-trash-o'></i></a>
                </td>";
                $html .= "<td>".$dTanggalCS."</td>";
                $html .= "<td>".$row['vNomorCs']."</td>";
                $html .= "<td>".date('d-m-Y',strtotime($row['dMasaStrat']))." s/d ".date('d-m-Y',strtotime($row['dMasaEnd']))."</td>";
                
                $html .= "<td style='text-align:right;' >".number_format($row['nTotalBiaya'])."</td>";

                $html .= "</tr>";

			}
		}

        $html .= '</tbody> </table>';
		echo $html;
		exit();
	}

	


	function hapusDataCS(){
		$id 		= $_POST['id'];
		$cUserId 	= $this->session->userdata('cUserId');

		try {
			
			$data =  array(
				'lDeleted' => 1,
				'tUpdated' => date('Y-m-d H:i:s'),
				'cUpdatedBy' => $cUserId
			);

			$this->db->where('iCsId',$id);
			$this->db->update('cost.cs_header',$data);

			//hapus ke detailya
			$data =  array(
				'lDeleted' => 1,
				'tUpdated' => date('Y-m-d H:i:s'),
				'cUpdatedBy' => $cUserId
			);

			$this->db->where('iCsId',$id);
			$this->db->update('cost.cs_detail',$data);


			$x = 1;
		} catch (Exception $e) {
			$x = 0;
		}

		echo $x;
	}

	function getDataEdit(){
		$id = $_POST['id'];

		$sql = "select a.iCsId,a.iStId,a.vNomorCs,a.dTanggalCS,a.dMasaStrat,a.dMasaEnd,
				a.nLama,a.iJenisPerDinas,a.vDari,a.vTujuan,b.iBidangId
				from cost.cs_header as a
				inner join st_header as b on b.iStId=a.iStId 
				where a.iCsId='".$id."' ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row 			= $query->row();

			$row->dTanggalCS 		= date('d-m-Y',strtotime($row->dTanggalCS));
			$row->dMasaStrat 		= date('d-m-Y',strtotime($row->dMasaStrat));
			$row->dMasaEnd 			= date('d-m-Y',strtotime($row->dMasaEnd));

			
			echo json_encode($row);
		}

		exit();
	}

	function getDataKorwas(){
		$iBidangId = $_POST['iBidangId'];

		$data = array();
		$sql = 'select vNip,vName from cost.ms_pegawai where iJabatanId=3 AND iBidangId = "'.$iBidangId.'" and lDeleted =0 order by vName asc';
		$query = $this->db->query($sql);
		$no = 0;
		if ($query->num_rows()>0){
			foreach($query->result_array() as $row) {
				$data_arr['key'] 	= $row['vNip']."|".$row['vName'];
				$data_arr['value'] 	= $row['vNip']." - ".$row['vName'];

				array_push($data, $data_arr);
			}
		}

		echo json_encode($data);

	}

	function insertData(){
		$cUserId 	= $this->session->userdata('cUserId');
		$post = $_POST;
		$iCsId = $post['iCsId'];
		

		$post['dTanggalCS'] = date('Y-m-d',strtotime($post['dTanggalCS']));
		$post['dMasaStrat'] = date('Y-m-d',strtotime($post['dMasaStrat']));
		$post['dMasaEnd'] = date('Y-m-d',strtotime($post['dMasaEnd']));
		$post['nLama'] = str_replace(",", "", $post['nLama']);
		

		
		if ($iCsId > 0){
			$post['tUpdated'] = date('Y-m-d H:i:s');
			$post['cUpdatedby'] = $cUserId;

			try {
				$this->db->where('iCsId',$iCsId);
				$this->db->update('cost.cs_header',$post);
				
				$x = $iCsId;
			} catch (Exception $e) {
				$x = 0;
			}

		}else{
			$vNomorCs = $this->generateNomorCS($post['iStId']);
			$post['vNomorCs'] = $vNomorCs;
			$post['tCreated'] = date('Y-m-d H:i:s');
			$post['cCreatedBy'] = $cUserId;
					
			try {
				$this->db->insert('cost.cs_header',$post);
				$last_id = $this->db->insert_id();
				$x = $last_id;
			} catch (Exception $e) {
				$x = 0;
			}
		}

		

		echo $x;
	}

	function generateNomorCS($iStId){
		$cTahun = date('Y');
		$autogenerated_code = '';
		$sql = "select a.iBidangId,b.iNomor,
				COALESCE((SELECT iLastNumber FROM cost.tabcount  where cCode='CS' and cTahun='".$cTahun."' ),0) AS iLastNumber
				from cost.st_header as a
				left join cost.ms_bidang as b on b.iBidangId=a.iBidangId
				where a.iStId='".$iStId."' ";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$r = $query->row();
			$iNomor = $r->iNomor;
			$iBidangId = $r->iBidangId;
			$iLastNumber = $r->iLastNumber;

			if ($iLastNumber==0){
				$iLastNumber = 1;
				$sqli = "INSERT INTO cost.tabcount (cCode,cTahun,iLastNumber,vDesc) VALUES ('CS','".$cTahun."',1,'Penomoran Cost Sheet')";
			}else{
				$iLastNumber = $iLastNumber + 1;
				$sqli = "UPDATE cost.tabcount SET iLastNumber='".$iLastNumber."' 
						 WHERE cCode='CS' AND cTahun='".$cTahun."'  ";
			}

			$this->db->query($sqli);

			$autogenerated_code = "CS-".$iLastNumber."/PW04/".$iNomor."/".$cTahun;
		}
		return $autogenerated_code;
	}

	function getTablePeronilCS(){
		$iCsId 			= $_POST['id'];
		$iJenisPerDinas = $_POST['iJenisPerDinas'];

		$sql = "select a.id,a.iCsId,c.iJenisPerDinas,a.vNip,b.vName,
				a.nLama,a.nTotalUangHarian,a.nTotalTransport,a.nTotalPenginapan,
				a.nBiayaUangHarian,
				a.nBiayaRepre,a.nBiayaTransport,a.iJenisAkomodasi,
				a.nBiayaPenginapan,a.nHonorJasa,a.nTotalBiaya,
				a.vNoSPPD 
				from cost.cs_detail as a
				left join cost.ms_pegawai as b on b.vNip = a.vNip
				left join cost.cs_header as c on c.iCsId = a.iCsId 
				WHERE a.iCsId='".$iCsId."' and a.lDeleted=0 ";

		$html = '<table class="table table-bordered" style="font-size: 11px;">
					<tr style="background-color: antiquewhite;">
						<td>No</td>
						<td>NIP</td>
						<td>NAMA PERSONIL</td>
						<td>NO SPD</td>
						<td style="text-align:center;" >LAMA <br/>
							<small>(hari)</small>
						</td>

						';
		//if ($iJenisPerDinas==1 || $iJenisPerDinas==2){
			$html .= '<td>UANG HARIAN</td>';
		//}
		
		//if ($iJenisPerDinas==1){
			$html .= '		
							<td>REPRE</td>
							<td>PENGINAPAN</td>
							<td>TRANSPORT</td>
							<td>HONOR JASA</td>';
		//}

		$html .= '<td></td>';

		$html .= '	</tr>';
		$query = $this->db->query($sql);
		$no = 0;
		if ($query->num_rows()>0){
			foreach($query->result_array() as $row) {
				$no++;
				$id = $row['id'];

				$html .= '
				<tr>
					<td>'.$no.'</td>
					<td>'.$row['vNip'].'</td>
					<td>'.$row['vName'].'</td>
					<td>'.$row['vNoSPPD'].'</td>
					<td>'.$row['nLama'].'</td>

					';

				//if ($row['iJenisPerDinas']==1 || $row['iJenisPerDinas']==2){
					$html  .='<td style="text-align:right;" >'.number_format($row['nTotalUangHarian']).'</td>';
				//}
				


				//if ($row['iJenisPerDinas']==1){
					$html  .='
					<td style="text-align:right;" >'.number_format($row['nBiayaRepre']).'</td>
					<td style="text-align:right;" >'.number_format($row['nTotalPenginapan']).'</td>
					<td style="text-align:right;" >'.number_format($row['nTotalTransport']).'</td>
					<td style="text-align:right;" >'.number_format($row['nHonorJasa']).'</td>';
				//}
				
				 $html .= "<td align='center'  style='width: 7%;'  >
                        <a  href='javasript:void(0)' data-toggle='modal' data-target='#modal-info' onclick='edit_data_personil(\"".$id."\")' ><i class='fa fa-edit'></i></a> || 
                        <a  href='#' onclick='hapus_data_personil(\"".$id."\")' ><i class='fa fa-trash-o'></i></a>
                </td>";

				$html .= '</tr>';
			}
		}

		$html .= "</table>";

		$html .= '<center><button type="button" onclick="addPersonelCS()" class="btn bg-purple margin">Tambah Personel</button></center>';

		echo $html;

	}

	function cekValidPersonil(){
		$iCsId = $_POST['iCsId'];
		$vNip  = $_POST['vNip'];
		$iCsDetailId  = $_POST['iCsDetailId'];
		$ret = '';

		//cek udah terdaftar apa belom di cs ini
		$sql = "select vNip from cost.cs_detail where iCsId='".$iCsId."' AND vNip='".$vNip."' and id!='".$iCsDetailId."' and lDeleted=0 ";
		$query = $this->db->query($sql);
		if ($query->num_rows()>0){
			$ret = 'Opps..|Personil sudah terdaftar';
			echo $ret;
			exit();
		}


	}

	function simpanDataPersonilCs(){
		$iCsId 		= $_POST['iCsId'];
		$vNip  		= $_POST['vNip'];
		$cUserId 	= $this->session->userdata('cUserId');
		$ret 		= '';
		$post 		= $_POST;
		$iStId 		= $_POST['iStId'];
		$iCsDetailId 		= $_POST['iCsDetailId'];
		$iJenisPerDinas		= $_POST['iJenisPerDinas'];
		$iSumberDana		= $_POST['iSumberDana'];
		unset($post['iCsDetailId']);
		unset($post['iStId']);
		unset($post['iJenisPerDinas']);
		unset($post['iSumberDana']);

		$post['nBiayaUangHarian'] 	= str_replace(",", "",$post['nBiayaUangHarian']);
		$post['nBiayaRepre'] 		= str_replace(",", "",$post['nBiayaRepre']);
		$post['nBiayaTransport'] 	= str_replace(",", "",$post['nBiayaTransport']);
		$post['nBiayaPenginapan'] 	= str_replace(",", "",$post['nBiayaPenginapan']);
		$post['nHonorJasa'] 		= str_replace(",", "",$post['nHonorJasa']);

		$post['dPerjalananStart'] = date('Y-m-d',strtotime($post['dPerjalananStart']));
		$post['dPerjalananEnd'] = date('Y-m-d',strtotime($post['dPerjalananEnd']));
		
		$dPerjalananStart = $post['dPerjalananStart'];
		$dPerjalananEnd = $post['dPerjalananEnd'];
		


		
		$nLama = $this->lib_util->hitungLamaPerjalanan($post['iOpsiHariLibur'],$post['iOpsiHariSabtu'],$post['iOpsiHariMinggu'],$post['dPerjalananStart'],$post['dPerjalananEnd']);

		$post['nTotalUangHarian'] = $nLama * $post['nBiayaUangHarian'];
		//$post['nTotalTransport'] = 2 * $post['nBiayaTransport'];
		$post['nTotalTransport'] = $post['nBiayaTransport'];

		if ($nLama > 1){
			$post['nTotalPenginapan'] = ($nLama-1) * $post['nBiayaPenginapan'];
		}else{
			$post['nTotalPenginapan'] =  $post['nBiayaPenginapan'];
		}


		$post['nLama'] = $nLama;


		$post['nTotalBiaya'] = $post['nTotalUangHarian'] + $post['nBiayaRepre'] + $post['nTotalTransport'] + $post['nTotalPenginapan'];

		//cek plafon yg tersedia
		if ($iJenisPerDinas==1 && $iSumberDana==1){
			$sqlc = "SELECT coalesce(sum(nValueAju),0) as nValueAju,
				coalesce((select sum(b.nTotalBiaya) from cost.cs_detail as b 
				inner join cost.cs_header as c on c.iCsId=b.iCsId
				WHERE c.iStId='{$iStId}' and b.lDeleted=0 and c.lDeleted=0 and b.id!='{$iCsDetailId}' and c.iJenisPerDinas=1 and b.iBatalSPD=0 ),0) as terpakai_cs
				from cost.st_detail_rkt  as a where a.iStId='{$iStId}' and a.lDeleted=0";

			$queryc = $this->db->query($sqlc);
			if ($queryc->num_rows() > 0){
				$rc = $queryc->row();
				$saldo 	 = $rc->nValueAju - $rc->terpakai_cs;
				
				if ($post['nTotalBiaya'] > $saldo){
					echo "Biaya tidak tersedia";
					exit();
				}
			}	
		}
		


		//cek udah terdaftar apa belom di cs ini
		$sql = "select vNip from cost.cs_detail where iCsId='".$iCsId."' AND vNip='".$vNip."'";
		$query = $this->db->query($sql);
		if ($query->num_rows()>0){
			
			try {
				$post['tUpdated'] = date('Y-m-d H:i:s');
				$post['cUpdatedBy'] = $cUserId;

				$this->db->where('iCsId',$iCsId);
				$this->db->where('vNip',$vNip);
				$this->db->update('cost.cs_detail',$post);
				$x = '';
			} catch (Exception $e) {
				$x = "Error While Save Data..";
			}	
		}else{
			try {
				$post['tCreated'] = date('Y-m-d H:i:s');
				$post['cCreatedBy'] = $cUserId;
				
				$this->db->insert('cost.cs_detail',$post);
				$last_id = $this->db->insert_id();
				$x = '';
			} catch (Exception $e) {
				$x = "Error While Save Data..";
			}
		}

		echo $x;
	}


	function cekValidPeriode(){
		$iCsId = $_POST['iCsId'];
		$vNip = $_POST['vNip'];
		$dPerjalananStart = date('Y-m-d',strtotime($_POST['dPerjalananStart']));
		$dPerjalananEnd = date('Y-m-d',strtotime($_POST['dPerjalananEnd']));

	

		//cek bentrok apa gak perjalannya
		$sqlc = "SELECT a.iCsId,b.vNomorCs,a.dPerjalananStart,a.dPerjalananEnd 
				from cost.cs_detail as a 
				inner join cost.cs_header as b on b.iCsId=a.iCsId
				where a.iCsId !='{$iCsId}' and a.vNip = '{$vNip}' and 
				((a.dPerjalananStart between '{$dPerjalananStart}' and '{$dPerjalananEnd}' or a.dPerjalananEnd between '{$dPerjalananStart}' and '{$dPerjalananEnd}' ) or 
				('{$dPerjalananStart}' between a.dPerjalananStart and a.dPerjalananEnd or '{$dPerjalananEnd}' between a.dPerjalananStart and a.dPerjalananEnd))
				and a.lDeleted = 0";

	
		$queryc = $this->db->query($sqlc);
		if ($queryc->num_rows() > 0){
			$rc = $queryc->row();
			echo "Periode Perjalanan Bentrok Dengan Nomor CS ".$rc->vNomorCs." 
				   Periode : ".date('d-m-Y',strtotime($rc->dPerjalananStart))." s/d ".date('d-m-Y',strtotime($rc->dPerjalananEnd))."
				  ";
			exit();
		}

	}
	function getEditDataPersonilCS(){
		$id = $_POST['id'];
		$sql = "select a.id,a.iCsId,a.vNip,b.vName,a.nBiayaUangHarian,
				a.nBiayaRepre,a.nBiayaTransport,a.iJenisAkomodasi,
				a.nBiayaPenginapan,a.nHonorJasa,a.nTotalBiaya,a.dPerjalananStart,a.dPerjalananEnd,
				a.iAlatAngkut,a.iOpsiHariLibur,a.iOpsiHariMinggu,a.iOpsiHariSabtu 
				from cost.cs_detail as a
				left join cost.ms_pegawai as b on b.vNip = a.vNip
				where a.id='".$id."' ";
		$query = $this->db->query($sql);
		if ($query->num_rows()>0){
			$row = $query->row();

			$row->nBiayaUangHarian  = number_format($row->nBiayaUangHarian);
			$row->nBiayaRepre 		= number_format($row->nBiayaRepre);
			$row->nBiayaTransport 	= number_format($row->nBiayaTransport);
			$row->nBiayaPenginapan	= number_format($row->nBiayaPenginapan);
			$row->nHonorJasa 		= number_format($row->nHonorJasa);
			$row->nTotalBiaya 		= number_format($row->nTotalBiaya);

			$row->dPerjalananStart 	= date('d-m-Y',strtotime($row->dPerjalananStart));
			$row->dPerjalananEnd 	= date('d-m-Y',strtotime($row->dPerjalananEnd));

			echo json_encode($row);
		}

	}

	function hapusDataPersonilCS(){
		$id 		= $_POST['id'];
		$cUserId 	= $this->session->userdata('cUserId');

		try {
			
			$data =  array(
				'lDeleted' => 1,
				'tUpdated' => date('Y-m-d H:i:s'),
				'cUpdatedBy' => $cUserId
			);

			$this->db->where('id',$id);
			$this->db->update('cost.cs_detail',$data);

			//hapus ke detailya
			$data =  array(
				'lDeleted' => 1,
				'tUpdated' => date('Y-m-d H:i:s'),
				'cUpdatedBy' => $cUserId
			);

			$this->db->where('id',$id);
			$this->db->update('cost.cs_detail',$data);


			$x = 1;
		} catch (Exception $e) {
			$x = 0;
		}

		echo $x;
	}
}

?>