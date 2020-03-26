<div class="form-group" id="div_detail_rkt" >
	<label for="username" class="col-sm-4 control-label" ></label>
	  <div class="col-sm-8">
	    <div class="input-group input-group-sm" style="width: 100%;">
	        <div class="box box-info" style="width: 95%;border: 1px solid #005792;">
	           
	            <!-- /.box-header -->
	            <div class="box-body" style="">
	              	<table class="table table-condensed  table-bordered" id="tabel_detail_penginapan" style="font-size: 12px;">
		                
		                <thead>
		                	<tr style="background-color: #d9faff;">
		                		<td colspan="5" align="center" ><b>Biaya penginapan</b></td>
		                	</tr>
		                	<tr style="background-color: #d9faff;">
				                <th style="width: 100px;text-align: center;" >Lama (Hari)</th>
				                <th style="width: 100px;text-align: center;" >Biaya</th>
				                <th style="width: 100px;text-align: center;" >Jumlah</th>
				                <th style="width: 200px;text-align: center;" >Keterangan</th>
				                <th style="width: 10px"></th>
			                </tr>
		                </thead>
		                <tbody>

		              	</tbody>
		              	<tfoot>
		              		<tr>
		              			<td colspan="3" align="center"><b>Total Biaya penginapan</b></td>
		              			<td align="right"><span id="total_penginapan" >0</span></td>
		              			<td><button type="button" onclick="addrow_penginapan()" class="btn btn-block btn-info btn-sm">Tambah</button></td>
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
	/*$(document).ready(function() {
		$('.detail_rkt_nValue').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

	});*/


	$('#tabel_detail_penginapan').on('keyup', '.penginapan_nHari', function(){
	    var ix = $('.penginapan_nHari').index($(this));
		hitungSubTotalpenginapan(ix);
	});

	$('#tabel_detail_penginapan').on('keyup', '.penginapan_nBiaya', function(){
	    var ix = $('.penginapan_nBiaya').index($(this));
		hitungSubTotalpenginapan(ix);
	});


	function hitungSubTotalpenginapan(ix) {
		console.log(ix);
		var nHari  = stripCharacters($('.penginapan_nHari').eq(ix).val());
		var nBiaya  = stripCharacters($('.penginapan_nBiaya').eq(ix).val());
		var jumlah = nHari * nBiaya;

		$('.penginapan_nJumlah').eq(ix).val(addCommas(jumlah.toFixed(0)));

		sum_value_penginapan();
	}


	function  addrow_penginapan() {
		var row_content = '';

        row_content   = '<tr>';
      
        row_content  += '<td><input type="hidden" readonly class="penginapan_iJenis" name="penginapan_iJenis[]" value="2" ><input style="width: 90%;text-align:right;" type="text" class="penginapan_nHari" name="penginapan_nHari[]" value="" data-a-dec="." data-a-sep=","  ></td>'

        row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="penginapan_nBiaya" name="penginapan_nBiaya[]" value="" data-a-dec="." data-a-sep="," ></td>'

        row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="penginapan_nJumlah" name="penginapan_nJumlah[]" value="" data-a-dec="." data-a-sep="," readonly ></td>'

        row_content += '<td><textarea style="width: 100%;" class="penginapan_vKeterangan" name="penginapan_vKeterangan[]" ></textarea></td>';


        row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row_penginapan(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';

        row_content  += '</tr>';

 

        jQuery("#tabel_detail_penginapan tbody").append(row_content);

        $('.penginapan_nHari').autoNumeric('init', {vMin:'0', vMax:'999'});
        $('.penginapan_nBiaya').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('.penginapan_nJumlah').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

	}

	
    function del_row_penginapan(dis) {
    	var jwb = confirm("Hapus data ini ?");
    	if (jwb==1){
    		$(dis).parent().parent().remove();
    	}
    	sum_value_penginapan()
	}


	function sum_value_penginapan() {
		var total 		= 0;
		var i			=0;

		$('.penginapan_nJumlah').each(function() {
			if ($('.penginapan_nJumlah').eq(i).val() != '') {				
				total += parseInt(stripCharacters($('.penginapan_nJumlah').eq(i).val()));
			}

			i++;
		});

		$('#total_penginapan').html(addCommas(total));
		sum_nilaikwitansi();
	}

	

</script>