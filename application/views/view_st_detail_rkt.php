<div class="form-group" id="div_detail_rkt" style="display: none;">
	<label for="username" class="col-sm-4 control-label" >Uraian RKT</label>
	  <div class="col-sm-8">
	    <div class="input-group input-group-sm" style="width: 100%;">
	        <!-- <table class="table">
	        	<thead>
	        		<th>#</th>
	        		<th>No Urut RKT</th>
	        		<th>Uraian RKT</th>
	        		<th>Alokasi Dana</th>
	        	</thead>
	        </table> -->
	        <input type="hidden" name="list_rkt_dipilih" id="list_rkt_dipilih" value="">

	        <div class="box box-warning" style="width: 95%;border: 1px solid #f39c12;">
	            <div class="box-header with-border">
	              <h3 class="box-title">Data RKT</h3>

	              <div class="box-tools pull-right">
	                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	                </button>
	              </div>
	              <!-- /.box-tools -->
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body" style="">
	              	<table class="table table-condensed  table-bordered" id="tabel_detail_rkt" style="font-size: 12px;">
		                
		                <thead>
		                	<tr style="background-color: #a1e6e3;">
			                <th style="width: 100px">No Urut</th>
			                <th>Uraian RKT</th>
			                <th style="width: 100px">Alokasi Dana</th>
			                <th style="width: 10px"></th>
			                </tr>
		                </thead>
		                <tbody>

		              	</tbody>
		              	<tfoot>
		              		<tr>
		              			<td colspan="2" align="center"><b>Total Alokasi Dana</b></td>
		              			<td align="right"><span id="total_alokasi" >0</span></td>
		              		</tr>

		              		<tr>
		              			<td  colspan="2"></td>
		              			<td colspan="2" >
		              				<button type="button" onclick="addrow_rkt()" class="btn btn-block btn-info btn-sm">Tambah RKT</button>
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

<script type="text/javascript">
	/*$(document).ready(function() {
		$('.detail_rkt_nValue').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

	});*/

	function  addrow_rkt() {
		var iDipaId = $('#iDipaId').val();
		var list_rkt_dipilih = $('#list_rkt_dipilih').val();
		list_rkt_dipilih = list_rkt_dipilih.slice(',',-1);
		if (iDipaId==''){
			custom_alert('','Pilih DIPA terlebih dahulu');
			return false;
		}


		
		var list_data = getListRkt(iDipaId,list_rkt_dipilih);
        $('#list_data_dipa').html(list_data);
        $('#myLargeModalLabel').html('List RKT');
        $('#list_popup').DataTable({
            "bSort": false
        });



        $('.bs-example-modal-lg').modal('show');
	}

	function getListRkt(iDipaId,list_rkt_dipilih){
        var url = "<?php echo site_url().'/st/getListRkt'; ?>";
        return $.ajax({
            type: 'POST', 
            url: url,
            data:'iDipaId='+iDipaId+'&list_rkt_dipilih='+list_rkt_dipilih,
            async:false
        }).responseText
    }


    function  select_row_rkt(id,cNomorRkt,cNamaItem,qty_count,tersedia,) {
    	var list_rkt_dipilih = $('#list_rkt_dipilih').val();
    	var row_content = '';

        row_content   = '<tr>';
        row_content  += '<td>'+cNomorRkt
        row_content  += '<input type="hidden" readonly class="detail_rkt_iRktId" name="detail_rkt_iRktId[]" value="'+id+'" ></td>';
        row_content  += '<td>'+cNamaItem+'</td>'
        row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="detail_rkt_nValue" name="detail_rkt_nValue[]" value="" data-a-dec="." data-a-sep="," onkeyup="sum_value_anggaran()" ></td>'
        row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';

        row_content  += '</tr>';

        $('#list_rkt_dipilih').val(list_rkt_dipilih+id+',');

        jQuery("#tabel_detail_rkt tbody").append(row_content);

        $('.detail_rkt_nValue').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});



        $('.bs-example-modal-lg').modal('hide')

    }

    function del_row(dis) {
    	var jwb = confirm("Hapus data ini ?");
    	if (jwb==1){
    		$(dis).parent().parent().remove();
    	}

    	drow_id_rkt();
    	sum_value_anggaran()
		
	}


	function drow_id_rkt() {
		var i=0;
		var id_rkt = '';
		$('.detail_rkt_iRktId').each(function() {
			if ($('.detail_rkt_iRktId').eq(i).val() != '') {				
				id_rkt += $('.detail_rkt_iRktId').eq(i).val()+',';
			}
			i++;
		});

		$('#list_rkt_dipilih').val(id_rkt);
	}


	


	function sum_value_anggaran() {
		var total 		= 0;
		var i			=0;

		$('.detail_rkt_nValue').each(function() {
			if ($('.detail_rkt_nValue').eq(i).val() != '') {				
				total += parseInt(stripCharacters($('.detail_rkt_nValue').eq(i).val()));
			}

			i++;
		});

		$('#total_alokasi').html(addCommas(total));
	}

	

</script>