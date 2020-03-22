<div class="form-group" id="div_detail_rkt" >
	<label for="username" class="col-sm-4 control-label" ></label>
	  <div class="col-sm-8">
	    <div class="input-group input-group-sm" style="width: 100%;">
	        
	        <input type="hidden" name="list_rkt_dipilih" id="list_rkt_dipilih" value="">

	        <div class="box box-warning" style="width: 95%;border: 1px solid #74f9ff;">
	           
	            <!-- /.box-header -->
	            <div class="box-body" style="">
	              	<table class="table table-condensed  table-bordered" id="tabel_detail_penugasan" style="font-size: 12px;">
		                
		                <thead>
		                	<tr style="background-color: #fffcca;">
		                		<td colspan="4" align="center" ><b>Biaya Penugasan</b></td>
		                	</tr>
		                	<tr style="background-color: #fffcca;">
				                <th style="width: 100px;text-align: center;" >Lama (Hari)</th>
				                <th style="width: 200px;text-align: center;" >Biaya</th>
				                <th style="width: 200px;text-align: center;" >Jumlah</th>
				                <th style="width: 10px"></th>
			                </tr>
		                </thead>
		                <tbody>

		              	</tbody>
		              	<tfoot>
		              		<tr>
		              			<td colspan="2" align="center"><b>Total Biaya Penugasan</b></td>
		              			<td align="right"><span id="total_penugasan" >0</span></td>
		              			<td><button type="button" onclick="addrow_penugasan()" class="btn btn-block btn-info btn-sm">Tambah</button></td>
		              		</tr>

		              		<tr>
		              			<td  colspan="2"></td>
		              			<td colspan="2" >
		              				
		              			</td>
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


	$('#tabel_detail_penugasan').on('keyup', '.penugasan_nHari', function(){
	    var ix = $('.penugasan_nHari').index($(this));
		hitungSubTotalPenugasan(ix);
	});

	$('#tabel_detail_penugasan').on('keyup', '.penugasan_nBiaya', function(){
	    var ix = $('.penugasan_nBiaya').index($(this));
		hitungSubTotalPenugasan(ix);
	});


	function hitungSubTotalPenugasan(ix) {
		console.log(ix);
		var nHari  = stripCharacters($('.penugasan_nHari').eq(ix).val());
		var nBiaya  = stripCharacters($('.penugasan_nBiaya').eq(ix).val());
		var jumlah = nHari * nBiaya;

		$('.penugasan_nJumlah').eq(ix).val(addCommas(jumlah.toFixed(0)));

		sum_value_penugasan();
	}


	function  addrow_penugasan() {
		var row_content = '';

        row_content   = '<tr>';
      
        row_content  += '<td><input type="hidden" readonly class="penugasan_iJenis" name="penugasan_iJenis[]" value="1" ><input style="width: 90%;text-align:right;" type="text" class="penugasan_nHari" name="penugasan_nHari[]" value="" data-a-dec="." data-a-sep=","  ></td>'

        row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="penugasan_nBiaya" name="penugasan_nBiaya[]" value="" data-a-dec="." data-a-sep="," ></td>'

        row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="penugasan_nJumlah" name="penugasan_nJumlah[]" value="" data-a-dec="." data-a-sep="," readonly ></td>'


        row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row_penugasan(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';

        row_content  += '</tr>';

 

        jQuery("#tabel_detail_penugasan tbody").append(row_content);

        $('.penugasan_nHari').autoNumeric('init', {vMin:'0', vMax:'999'});
        $('.penugasan_nBiaya').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('.penugasan_nJumlah').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

	}

	
    function del_row_penugasan(dis) {
    	var jwb = confirm("Hapus data ini ?");
    	if (jwb==1){
    		$(dis).parent().parent().remove();
    	}
    	sum_value_penugasan()
	}


	function sum_value_penugasan() {
		var total 		= 0;
		var i			=0;

		$('.penugasan_nJumlah').each(function() {
			if ($('.penugasan_nJumlah').eq(i).val() != '') {				
				total += parseInt(stripCharacters($('.penugasan_nJumlah').eq(i).val()));
			}

			i++;
		});

		$('#total_penugasan').html(addCommas(total));

		sum_nilaikwitansi();
	}

	function sum_nilaikwitansi() {
		var total 		= 0;


		var i			=0;
		$('.penugasan_nJumlah').each(function() {
			if ($('.penugasan_nJumlah').eq(i).val() != '') {				
				total += parseInt(stripCharacters($('.penugasan_nJumlah').eq(i).val()));
			}

			i++;
		});


		var i			=0;
		$('.penginapan_nJumlah').each(function() {
			if ($('.penginapan_nJumlah').eq(i).val() != '') {				
				total += parseInt(stripCharacters($('.penginapan_nJumlah').eq(i).val()));
			}

			i++;
		});


		var i			=0;
		$('.repre_nJumlah').each(function() {
			if ($('.repre_nJumlah').eq(i).val() != '') {				
				total += parseInt(stripCharacters($('.repre_nJumlah').eq(i).val()));
			}

			i++;
		});

		
		if ($('.trans_nBiaya').val() != ''){
			total += parseInt(stripCharacters($('.trans_nBiaya').val()));
		}
		//total += parseInt(stripCharacters($('.trans_nBiaya').val()));

		var say = terbilang(total);

		$('#terbilang').val(say);
		$('#nNilaiKwitansi').val(addCommas(total));
		$('#nNilaiKwitansi2').val(addCommas(total));

		var paguawal = parseInt(stripCharacters($('#nSisaPaguAwal').val()));
		paguakhir = paguawal - total;

		$('#nSisaPaguAkhir').val(addCommas(paguakhir));

	}
	

</script>