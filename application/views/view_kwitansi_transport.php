<div class="form-group" >
	<label for="username" class="col-sm-4 control-label" ></label>
	  <div class="col-sm-8">
	    <div class="input-group input-group-sm" style="width: 100%;">
	        <div class="box box-info" style="width: 95%;border: 1px solid #5da0a2;">
	           
	            <!-- /.box-header -->
	            <div class="box-body" style="">
	              	<table class="table table-condensed  table-bordered" id="tabel_detail_transport" style="font-size: 12px;">
		                
		                <thead>
		                	<tr style="background-color: #00adb5;">
		                		<td colspan="5" align="center" ><b>Biaya Transport</b></td>
		                	</tr>
		                	<tr style="background-color: #00adb5;">
				                <th style="width: 200px;text-align: center;" >Dari</th>
				                <th style="width: 200px;text-align: center;" >Tujuan PP</th>
				                <th style="width: 100px;text-align: center;" >Jumlah</th>
				                <th style="width: 200px;text-align: center;" >Keterangan</th>
				                <th style="width: 10px;"></th>
				                
			                </tr>
		                </thead>
		                <tbody>
		                	
		              	</tbody>
		              	<tfoot>
		              		<tr>
		              			<td colspan="3" align="center"><b>Total Biaya Transport</b></td>
		              			<td align="right"><span id="total_transport" >0</span></td>
		              			<td><button type="button" onclick="addrow_transport()" class="btn btn-block btn-info btn-sm">Tambah</button></td>
		              		</tr>

		              		
		              	</tfoot>
		              	
		          	</table>
	            </div>
	            <!-- /.box-body -->
	        </div>
	    </div>
	    
	</div>
</div>

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
	
<script type="text/javascript">
	$(document).ready(function() {
		$('.trans_nBiaya').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

	});

	$('#tabel_detail_transport').on('keyup', '.trans_nBiaya', function(){
	    sum_value_trans()
	});




	function  addrow_transport() {
		var row_content = '';

        row_content   = '<tr>';
      
        row_content  += '<td><input style="width: 90%;text-align:left;" type="text" class="vTransDari" name="vTransDari[]" value="" ></td>'

        row_content  += '<td><input style="width: 90%;text-align:left;" type="text" class="vTransTujuan" name="vTransTujuan[]" value="" ></td>'

        row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="trans_nBiaya" name="trans_nBiaya[]" value="" data-a-dec="." data-a-sep="," onkeyup="sum_nilaikwitansi()" ></td>'

        row_content += '<td><textarea style="width: 100%;" class="trans_vKeterangan" name="trans_vKeterangan[]"></textarea></td>';

        row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row_transport(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';

        row_content  += '</tr>';

 

        jQuery("#tabel_detail_transport tbody").append(row_content);
        $('.trans_nBiaya').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

	}

	function del_row_transport(dis) {
    	var jwb = confirm("Hapus data ini ?");
    	if (jwb==1){
    		$(dis).parent().parent().remove();
    	}
    	sum_value_trans();
	}


	function sum_value_trans() {
		var total 		= 0;
		var i			=0;

		$('.trans_nBiaya').each(function() {
			if ($('.trans_nBiaya').eq(i).val() != '') {				
				total += parseInt(stripCharacters($('.trans_nBiaya').eq(i).val()));
			}

			i++;
		});

		$('#total_transport').html(addCommas(total));

		sum_nilaikwitansi();
	}
</script>