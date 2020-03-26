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
		                		<td colspan="4" align="center" ><b>Biaya Transport</b></td>
		                	</tr>
		                	<tr style="background-color: #00adb5;">
				                <th style="width: 200px;text-align: center;" >Dari</th>
				                <th style="width: 200px;text-align: center;" >Tujuan PP</th>
				                <th style="width: 100px;text-align: center;" >Jumlah</th>
				                <th style="width: 200px;text-align: center;" >Keterangan</th>
				                
			                </tr>
		                </thead>
		                <tbody>
		                	<tr>
		                		<td>
		                			<input style="width: 90%;text-align:left;" type="text" class="vTransDari" name="vTransDari" value="" >
		                		</td>

		                		<td><input style="width: 90%;text-align:left;" type="text" class="vTransTujuan" name="vTransTujuan" value="" ></td>
		                		<td>
		                			<input style="width: 90%;text-align:right;" type="text" class="trans_nBiaya" name="trans_nBiaya" value="" data-a-dec="." data-a-sep="," onkeyup="sum_nilaikwitansi()" >
		                		</td>

		                		<td><textarea style="width: 100%;" class="trans_vKeterangan" name="trans_vKeterangan"></textarea></td>
		                	</tr>
		              	</tbody>
		              	
		          	</table>
	            </div>
	            <!-- /.box-body -->
	        </div>
	    </div>
	    
	</div>
</div>


	
<script type="text/javascript">
	$(document).ready(function() {
		$('.trans_nBiaya').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

	});
</script>