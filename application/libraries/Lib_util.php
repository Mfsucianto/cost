<?php
class lib_util {
	private $_ci;
	private $dbset;
	function __construct() {
		$this->_ci = &get_instance();
		$this->dbset = $this->_ci->load->database('default', true);

	}


	
	function hitungLamaPerjalanan($iOpsiHariLibur, $iOpsiHariSabtu, $iOpsiHariMinggu, $dstart, $dend){
		$start 		= new DateTime($dstart);
		$end 		= new DateTime($dend);
		$end->modify('+1 day');
		$period 	= new DatePeriod($start, new DateInterval('P1D'), $end);

		$holidays = $this->getHolyday($dstart,$dend);

		
		$lama = 0;
		foreach($period as $dt) {
			
			$tanggal = $dt->format('Y-m-d');
			$D = $dt->format('D');

			if (in_array($dt->format('Y-m-d'), $holidays) && $iOpsiHariLibur!=3) {
				continue;
			}

			if ($iOpsiHariSabtu!=3 && $D == 'Sat'){
				continue;
			}

			if ($iOpsiHariMinggu!=3 && $D == 'Sun'){
				continue;
			}


			$lama++;
			
		}

		return $lama;

	}


	function hitungLamaPerjalanan2($iOpsiHariLibur, $iOpsiHariSabtu, $iOpsiHariMinggu, $dstart, $dend){
		$start 		= new DateTime($dstart);
		$end 		= new DateTime($dend);
		$end->modify('+1 day');
		$period 	= new DatePeriod($start, new DateInterval('P1D'), $end);

		$holidays = $this->getHolyday($dstart,$dend);

		
		$lama = 0;
		foreach($period as $dt) {
			
			$tanggal = $dt->format('Y-m-d');
			$D = $dt->format('D');

			if (in_array($dt->format('Y-m-d'), $holidays) && $iOpsiHariLibur==1) {
				continue;
			}

			if ($iOpsiHariSabtu==1 && $D == 'Sat'){
				continue;
			}

			if ($iOpsiHariMinggu==1 && $D == 'Sun'){
				continue;
			}


			$lama++;
			
		}

		return $lama;

	}

	function getHolyday($dstart,$dend){
		$holidays = array();
    	
    	$sql = "SELECT dDate FROM cost.holyday WHERE dDate BETWEEN '{$dstart}' AND '{$dend}' AND lDeleted=0";

    	$query = $this->dbset->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				array_push($holidays, $row['dDate']);
			}
		}


 		return $holidays;
	}

	function getSysparam($var){
		$value = '';
		$sql = "SELECT vValue FROM sysparam WHERE cProg='".$var."'";

		$query = $this->dbset->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $value = $row->vValue;
        }

        return $value;

	}


	

	function drawFiledCombobox($dbname,$key,$value,$condition=''){

		$html = '<select class="orm-control input-sm select2" style="width: 100%;" id="'.$key.'" name="'.$key.'">
					<option></option>
				';
        
        if ($condition!=''){
        	foreach ($condition as $c => $f) {
        		
        		$a = $f['field']." ".$f['condition'];

        		//echo $a;
        		$this->dbset->where($a, $f['val']);

        		//$this->db->where('name !=', $name);

        	}
        }

        $this->dbset->select($key);
        $this->dbset->select($value);
        $query = $this->dbset->get($dbname);
        if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$k = $row[$key];
				$v = $row[$value];
				$html .= '<option value="'.$k.'"  >'.$v.'</option>';
			}
		}
        	          	     
        $html .= '</select>';
		return $html;
	}

	function drawFiledText($caption,$id,$width='100%',$type='text'){

		$html = '<div class="form-group" id="div_'.$id.'" >
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">'.$caption.'</label>
                              <div class="col-sm-7">
                                <input type="'.$type.'" style="width:'.$width.'" class="form-control input-sm" id="'.$id.'" name="'.$id.'" placeholder="'.$caption.'">
                               
                              </div>
                            </div>';

        return $html;
	}

	function drawFiledLabel($caption,$id,$style=''){

		$html = '
			<div class="form-group" id="div_'.$id.'">
              	<label for="username" class="col-sm-4 control-label" style="font-weight: 400;">'.$caption.'</label>
              	<div class="col-sm-7" style="padding-top: 7px;">
                	<span id="text_'.$id.'" style="'.$style.'" ></span>
              	</div>
            </div>';

        return $html;
	}

	function drawFiledTextarea($caption,$id,$width='100%'){

		$html = '
			<div class="form-group" id="div_'.$id.'" >
              	<label for="username" class="col-sm-4 control-label" style="font-weight: 400;">'.$caption.'</label>
              	<div class="col-sm-7">
                	<textarea style="width:'.$width.'" class="form-control" row="3" id="'.$id.'" name="'.$id.'"></textarea>

              	</div>
            </div>';

        return $html;
	}

	function drawFiledCustom($filed,$caption,$rowForm){
		foreach ($rowForm as $key => $value) {
			if ($key==$filed){
				$type = $value['type'];
				$data = $value['data'];

				if ($type=='combobox'){
					$html = $this->drawcombo($filed,$caption,$data);
				}
			}
		}


		return $html;
	}


	function drawcombo($filed,$caption,$data,$width='100%'){

		

		$x = '<select class="orm-control input-sm select2" style="width:'.$width.';" id="'.$filed.'" name="'.$filed.'">
					<option></option>
				';
        
		foreach($data as $k => $v) {
			$x .= '<option value="'.$k.'"  >'.$v.'</option>';
		}
        	          	     
        $x .= '</select>';


        $html = '<div class="form-group" id="div_'.$filed.'">
              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">'.$caption.'</label>
              <div class="col-sm-7">
                	'.$x.'
              </div>
            </div>';
		return $html;
	}

	function drawBindFiled($value,$text,$dbname){
		$datchg = array();
        $sql = "SELECT iJabatanId,vJabatanName FROM  ms_jabatan order by vJabatanName ASC";
        $query 	= $this->dbset->query($sql);
        if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$datchg[$row['iJabatanId']] = $row['vJabatanName'];
			}
		}
	}

	
	function getListIdST($vNip){
		$list = '0';
		$sql = "SELECT iStId FROM cost.st_detail_team WHERE vNip='".$vNip."' AND lDeleted=0";
		$query 	= $this->dbset->query($sql);
        if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$list .= $row['iStId'].",";
			}
		}

		$list = rtrim($list,",");

		return $list;
	}

	function getListIdDipa($vNip){
		$list = '0';
		$sql = "SELECT st.iDipaId
				FROM cost.st_detail_team AS a
				inner join cost.st_header as st on st.iStId = a.iStId 
				WHERE a.vNip='".$vNip."' AND a.lDeleted=0";
		$query 	= $this->dbset->query($sql);
        if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$list .= $row['iDipaId'].",";
			}
		}

		$list = rtrim($list,",");

		return $list; 
	}

	function force_download($filename, $data){
		$mimes = array(	'hqx'	=>	'application/mac-binhex40',
				'cpt'	=>	'application/mac-compactpro',
				'csv'	=>	array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel'),
				'bin'	=>	'application/macbinary',
				'dms'	=>	'application/octet-stream',
				'lha'	=>	'application/octet-stream',
				'lzh'	=>	'application/octet-stream',
				'exe'	=>	array('application/octet-stream', 'application/x-msdownload'),
				'class'	=>	'application/octet-stream',
				'psd'	=>	'application/x-photoshop',
				'so'	=>	'application/octet-stream',
				'sea'	=>	'application/octet-stream',
				'dll'	=>	'application/octet-stream',
				'oda'	=>	'application/oda',
				'pdf'	=>	array('application/pdf', 'application/x-download'),
				'ai'	=>	'application/postscript',
				'eps'	=>	'application/postscript',
				'ps'	=>	'application/postscript',
				'smi'	=>	'application/smil',
				'smil'	=>	'application/smil',
				'mif'	=>	'application/vnd.mif',
				'xls'	=>	array('application/excel', 'application/vnd.ms-excel', 'application/msexcel'),
				'ppt'	=>	array('application/powerpoint', 'application/vnd.ms-powerpoint'),
				'wbxml'	=>	'application/wbxml',
				'wmlc'	=>	'application/wmlc',
				'dcr'	=>	'application/x-director',
				'dir'	=>	'application/x-director',
				'dxr'	=>	'application/x-director',
				'dvi'	=>	'application/x-dvi',
				'gtar'	=>	'application/x-gtar',
				'gz'	=>	'application/x-gzip',
				'php'	=>	'application/x-httpd-php',
				'php4'	=>	'application/x-httpd-php',
				'php3'	=>	'application/x-httpd-php',
				'phtml'	=>	'application/x-httpd-php',
				'phps'	=>	'application/x-httpd-php-source',
				'js'	=>	'application/x-javascript',
				'swf'	=>	'application/x-shockwave-flash',
				'sit'	=>	'application/x-stuffit',
				'tar'	=>	'application/x-tar',
				'tgz'	=>	array('application/x-tar', 'application/x-gzip-compressed'),
				'xhtml'	=>	'application/xhtml+xml',
				'xht'	=>	'application/xhtml+xml',
				'zip'	=>  array('application/x-zip', 'application/zip', 'application/x-zip-compressed'),
				'mid'	=>	'audio/midi',
				'midi'	=>	'audio/midi',
				'mpga'	=>	'audio/mpeg',
				'mp2'	=>	'audio/mpeg',
				'mp3'	=>	array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'),
				'aif'	=>	'audio/x-aiff',
				'aiff'	=>	'audio/x-aiff',
				'aifc'	=>	'audio/x-aiff',
				'ram'	=>	'audio/x-pn-realaudio',
				'rm'	=>	'audio/x-pn-realaudio',
				'rpm'	=>	'audio/x-pn-realaudio-plugin',
				'ra'	=>	'audio/x-realaudio',
				'rv'	=>	'video/vnd.rn-realvideo',
				'wav'	=>	array('audio/x-wav', 'audio/wave', 'audio/wav'),
				'bmp'	=>	array('image/bmp', 'image/x-windows-bmp'),
				'gif'	=>	'image/gif',
				'jpeg'	=>	array('image/jpeg', 'image/pjpeg'),
				'jpg'	=>	array('image/jpeg', 'image/pjpeg'),
				'jpe'	=>	array('image/jpeg', 'image/pjpeg'),
				'png'	=>	array('image/png',  'image/x-png'),
				'tiff'	=>	'image/tiff',
				'tif'	=>	'image/tiff',
				'css'	=>	'text/css',
				'html'	=>	'text/html',
				'htm'	=>	'text/html',
				'shtml'	=>	'text/html',
				'txt'	=>	'text/plain',
				'text'	=>	'text/plain',
				'log'	=>	array('text/plain', 'text/x-log'),
				'rtx'	=>	'text/richtext',
				'rtf'	=>	'text/rtf',
				'xml'	=>	'text/xml',
				'xsl'	=>	'text/xml',
				'mpeg'	=>	'video/mpeg',
				'mpg'	=>	'video/mpeg',
				'mpe'	=>	'video/mpeg',
				'qt'	=>	'video/quicktime',
				'mov'	=>	'video/quicktime',
				'avi'	=>	'video/x-msvideo',
				'movie'	=>	'video/x-sgi-movie',
				'doc'	=>	'application/msword',
				'docx'	=>	array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip'),
				'xlsx'	=>	array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip'),
				'word'	=>	array('application/msword', 'application/octet-stream'),
				'xl'	=>	'application/excel',
				'eml'	=>	'message/rfc822',
				'json' => array('application/json', 'text/json')
			);

		if ($filename == '' OR $data == '')
		{
			return FALSE;
		}

		// Try to determine if the filename includes a file extension.
		// We need it in order to set the MIME type
		if (FALSE === strpos($filename, '.'))
		{
			return FALSE;
		}

		// Grab the file extension
		$x = explode('.', $filename);
		$extension = end($x);

		// Load the mime types
		

		// Set a default mime if we can't find it
		if ( ! isset($mimes[$extension])){
			$mime = 'application/octet-stream';
		}else{
			$mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
		}

		
		// Generate the server headers
		if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== FALSE)
		{
			
			header('Content-Type: "'.$mime.'"');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header("Content-Transfer-Encoding: binary");
			header('Pragma: public');
			header("Content-Length: ".strlen($data));
		}
		else
		{
			
			header('Content-Type: "'.$mime.'"');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header("Content-Transfer-Encoding: binary");
			header('Expires: 0');
			header('Pragma: no-cache');
			header("Content-Length: ".strlen($data));
		}
		
		exit($data);
	}


	

}


?>