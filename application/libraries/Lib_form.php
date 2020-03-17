<?php
Class lib_form {
	private $_ci;
	private $dbset;


	function __construct() {
		$this->_ci = &get_instance();
		$this->dbset = $this->_ci->load->database('default', true);

	}

	function load_form_search($title,$theList,$url){

		/*=============== Draw Form Search ==============================*/

		//lookup count form search
		$count_search = 0;
		foreach ($theList as $key => $value) {
			if ($value['search']==1){
				$count_search++;
			}
		}



		if ($count_search > 0){
			$form_search = '<section class="content">';
			$form_search .= '<div class="box box-info box-solid">
					    <div class="box-header with-border" style="padding: 5px;">
					     	<span>Search '.$title.'</span>

					      <div class="box-tools pull-right">
					        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					        </button>
					      </div>
					      <!-- /.box-tools -->
					    </div>
					    <!-- /.box-header -->
					    <div class="box-body" style="">';
			foreach ($theList as $key => $value) {
				if ($value['search']==1){
					
					$field = $value['field'];
					$label = $value['label'];
					$type  = $value['type'];
					$form_search .= '<div class="form-horizontal">
				        	<div class="form-group input-group-sm">
				                <label for="search_'.$url.'_'.$field.'" class="col-sm-2 control-label" style="text-align: left;font-weight: unset;">'.$label.'</label>

				                <div class="col-sm-3 input-group-sm">
				                  <input class="form-control" id="'.$url.'_'.$field.'" name="'.$field.'" type="text">
				                </div>
				            </div>
				         </div>';
				}
			}

	    	$form_search .= '
	    		<div class="box-footer ">
                <button type="submit" class="btn btn-info ">Reset Search</button>
                <button type="submit" class="btn btn-info pull-right">Search</button>
              </div>
	    		
	    	</div><!-- /.box-body --></div></section>';
	    	echo $form_search;
		}


		
		
	}


	function load_form_list($title,$theList,$url){
		$form_list = '<section class="content">';
		$form_list .= '<div class="box box-info box-solid">
					    <div class="box-header with-border" style="padding: 5px;">
					     	<span>List '.$title.'</span>

					      <div class="box-tools pull-right">
					        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					        </button>
					      </div>
					      <!-- /.box-tools -->
					    </div>
					    <!-- /.box-header -->
					    <div class="box-body" style="">

					    <div id="isi_table" >
                			<center>--please wait while generating data--</center> 
            			</div>
					    ';
	    	$form_list .= '</div><!-- /.box-body -->
	    		<legend></legend>
	    		<button type="submit" class="btn btn-info pull-right">Add New Record</button>
	    	</div> ';

		$form_list .= '</section>';

		echo $form_list;
	}
}

?>

