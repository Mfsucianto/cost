<div class="form-group" >
	<label for="username" class="col-sm-4 control-label" ></label>
	  <div class="col-sm-8">
	    <div class="input-group input-group-sm" style="width: 100%;">
	        <div class="box box-info" style="width: 95%;border: 1px solid #7f4a88;">
	           
	            <!-- /.box-header -->
	            <div class="box-body" style="">
	              	<table class="table table-condensed  table-bordered" id="tabel_detail_repre" style="font-size: 12px;">
		                
		                <thead>
		                	<tr style="background-color: #de95ba;">
		                		<td colspan="5" align="center" ><b>Biaya Representattif</b></td>
		                	</tr>
		                	<tr style="background-color: #de95ba;">
				                <th style="width: 100px;text-align: center;" >Lama (Hari)</th>
				                <th style="width: 100px;text-align: center;" >Biaya</th>
				                <th style="width: 100px;text-align: center;" >Jumlah</th>
				                <th style="width: 200px;text-align: center;" >Keterangan</th>
				                <th style="width: 10px;"></th>
			                </tr>
		                </thead>
		                <tbody>

		              	</tbody>
		              	<tfoot>
		              		<tr>
		              			<td colspan="3" align="center"><b>Total Biaya Representattif</b></td>
		              			<td align="right"><span id="total_repre" >0</span></td>
		              			<td><button type="button" onclick="addrow_repre()" class="btn btn-block btn-info btn-sm">Tambah</button></td>
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


	$('#tabel_detail_repre').on('keyup', '.repre_nHari', function(){
	    var ix = $('.repre_nHari').index($(this));
		hitungSubTotalrepre(ix);
	});

	$('#tabel_detail_repre').on('keyup', '.repre_nBiaya', function(){
	    var ix = $('.repre_nBiaya').index($(this));
		hitungSubTotalrepre(ix);
	});


	function hitungSubTotalrepre(ix) {
		console.log(ix);
		var nHari  = stripCharacters($('.repre_nHari').eq(ix).val());
		var nBiaya  = stripCharacters($('.repre_nBiaya').eq(ix).val());
		var jumlah = nHari * nBiaya;

		$('.repre_nJumlah').eq(ix).val(addCommas(jumlah.toFixed(0)));

		sum_value_repre();
	}


	function  addrow_repre() {
		var row_content = '';

        row_content   = '<tr>';
      
        row_content  += '<td><input type="hidden" readonly class="repre_iJenis" name="repre_iJenis[]" value="3" ><input style="width: 90%;text-align:right;" type="text" class="repre_nHari" name="repre_nHari[]" value="" data-a-dec="." data-a-sep=","  ></td>'

        row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="repre_nBiaya" name="repre_nBiaya[]" value="" data-a-dec="." data-a-sep="," ></td>'

        row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="repre_nJumlah" name="repre_nJumlah[]" value="" data-a-dec="." data-a-sep="," readonly ></td>'

        row_content += '<td><textarea style="width: 100%;" class="repre_vKeterangan" name="repre_vKeterangan[]" ></textarea></td>';

        row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row_repre(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';

        row_content  += '</tr>';

 

        jQuery("#tabel_detail_repre tbody").append(row_content);

        $('.repre_nHari').autoNumeric('init', {vMin:'0', vMax:'999'});
        $('.repre_nBiaya').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('.repre_nJumlah').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

	}

	
    function del_row_repre(dis) {
    	var jwb = confirm("Hapus data ini ?");
    	if (jwb==1){
    		$(dis).parent().parent().remove();
    	}
    	sum_value_repre()
	}


	function sum_value_repre() {
		var total 		= 0;
		var i			=0;

		$('.repre_nJumlah').each(function() {
			if ($('.repre_nJumlah').eq(i).val() != '') {				
				total += parseInt(stripCharacters($('.repre_nJumlah').eq(i).val()));
			}

			i++;
		});

		$('#total_repre').html(addCommas(total));

		sum_nilaikwitansi();
	}

	

</script>