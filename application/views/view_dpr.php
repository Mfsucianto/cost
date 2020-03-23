<div class="form-group" id="div_detail_rkt" >
	<label for="username" class="col-sm-4 control-label" ></label>
	  <div class="col-sm-8">
	    <div class="input-group input-group-sm" style="width: 100%;">
	        <div class="box box-warning" style="width: 95%;border: 1px solid #74f9ff;">
	            <!-- /.box-header -->
	            <div class="box-body" style="">
	              	<table class="table table-condensed  table-bordered" id="tabel_detail_dpr" style="font-size: 12px;">
		                
		                <thead>
		                	<tr style="background-color: #fffcca;">
		                		<td colspan="4" align="center" ><b>Biaya Yang Tidak Memperoleh Bukti</b></td>
		                	</tr>
		                	<tr style="background-color: #fffcca;">
				                <th style="width: 50px;text-align: center;" >No</th>
				                <th style="width: 300px;text-align: center;" >Perincian Biaya</th>
				                <th style="width: 100px;text-align: center;" >Jumlah</th>
				                <th style="width: 10px;"></th>
			                </tr>
		                </thead>
		                <tbody>

		              	</tbody>
		              	<tfoot>
		              		<tr>
		              			<td colspan="2" align="center"><b>Jumlah</b></td>
		              			<td align="right"><span id="total_dpr" >0</span></td>
		              			<td><button type="button" onclick="addrow_dpr()" class="btn btn-block btn-info btn-sm">Tambah</button></td>
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


	$('#tabel_detail_dpr').on('keyup', '.dpr_nJumlah', function(){
	    sum_value_dpr();
	});

	


	function  addrow_dpr() {
		var row = $('table#tabel_detail_dpr tbody tr:last').clone();

		$("span.tabel_detail_dpr_num:first").text('1');
		var n = $("span.tabel_detail_dpr_num:last").text();

		if (n.length == 0) {

			var row_content = '';
	        row_content   = '<tr>';
	        row_content  += '<td><span class="tabel_detail_dpr_num">1</span></td>';

	        row_content  += '<td><input style="width: 90%;text-align:left;" type="text" class="dpr_vPerincian" name="dpr_vPerincian[]"   ></td>'
	        row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="dpr_nJumlah" name="dpr_nJumlah[]" value="" data-a-dec="." data-a-sep=","  ></td>'
	        row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row_dpr(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';
	        row_content  += '</tr>';
	        jQuery("#tabel_detail_dpr tbody").append(row_content);
		}else{
			var no = parseInt(n);
			var c = no + 1;
			$('table#tabel_detail_dpr tbody tr:last').after(row);
			$('table#tabel_detail_dpr tbody tr:last input').val("");
			$('table#tabel_detail_dpr tbody tr:last div').text("");
			$("span.tabel_detail_dpr_num:last").text(c);	
		}
		

        $('.dpr_nJumlah').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

	}

	
    function del_row_dpr(dis) {
    	var jwb = confirm("Hapus data ini ?");
    	if (jwb==1){
    		$(dis).parent().parent().remove();
    	}
    	sum_value_dpr()
	}


	function sum_value_dpr() {
		var total 		= 0;
		var i			=0;

		$('.dpr_nJumlah').each(function() {
			if ($('.dpr_nJumlah').eq(i).val() != '') {				
				total += parseInt(stripCharacters($('.dpr_nJumlah').eq(i).val()));
			}

			i++;
		});

		$('#total_dpr').html(addCommas(total));

		sum_nilaikwitansi();
	}

	function sum_nilaikwitansi() {
		var total 		= 0;


		var i			=0;
		$('.dpr_nJumlah').each(function() {
			if ($('.dpr_nJumlah').eq(i).val() != '') {				
				total += parseInt(stripCharacters($('.dpr_nJumlah').eq(i).val()));
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