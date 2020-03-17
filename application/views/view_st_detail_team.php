
<section id="list_personal_team" >
    <div class="box box-warning" style="width: 100%;border: 1px solid #05dfd7;">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Personal Team</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
          	<table class="table table-condensed  table-bordered" id="tabel_detail_team" name="tabel_detail_team" style="font-size: 12px;">
                
                <thead>
                	<tr style="background-color: #beebe9;">
		                <th style="width: 50px">No</th>
		                <th>NIP</th>
		                <th>Nama</th>
		                <th>Peran Dalam Team</th>
                        <th>Peran Dalam ST</th>
		                <th>Jumlah HP</th>
		                <th style="width: 75px"></th>
	                </tr>
                </thead>
                <tbody>

              	</tbody>
              	<tfoot>
              		

              		<tr>
              			<td  colspan="5"></td>
              			<td >
              				<button type="button" onclick="add_personil()" class="btn btn-block btn-info btn-sm">Tambah Personil</button>
              			</td>
              		</tr>
              	</tfoot>
          	</table>
        </div>
        <!-- /.box-body -->
    </div>
	    
</section>



<!--  Modal content for the above example -->
<div class="modal fade div_modal_add_team" tabindex="-1" role="dialog" aria-labelledby="modal_add_team" >
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="modal_add_team">Tambah Personil</h4>
    </div>
    <div class="modal-body" id="div_form_personil" style="max-height: 400px;overflow: auto;">
    	<form class="form-horizontal" id="form_data_team" name="form_data_team" autocomplete="off">
    		<?php
       			
       			echo $this->lib_util->drawFiledLabel('Uraian Penugasan','vUraianPenugasan');
       			echo $this->lib_util->drawFiledLabel('Tanggal Mulai Penugasan','dMulai','100px');
       			echo $this->lib_util->drawFiledLabel('Jangka Waktu Penugasan (hari)','nJangkaWaktu','100px');
       			

       			echo "<legend>Data Personil Team</legend>";

       			echo '<div class="form-group" >
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">NIP / Nama</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <input type="hidden" readonly id="vNip" name="vNip" class="form-control">
                                    <input type="text" readonly id="text_vNip" class="form-control">
                                        <span class="input-group-btn">
                                          <button type="button" onclick="searchPegawai()"  class="btn btn-info btn-flat" >Search</button>
                                        </span>
                                </div>
                                
                              </div>
                            </div>';

       			
                 echo '<div class="form-group">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Golongan</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <input type="text" readonly id="cGolongan" name="cGolongan" style="width:100px;" class="form-control">
                                    
                                </div>
                                
                              </div>
                            </div>';          

       			echo $this->lib_util->drawcombo('iPeran','Peran Dalam Team ',array(''=>'',	0=>'Pembantu Penanggung Jawab',
       																					  	1=>'Pengendali Mutu',
       																					  	2=>'Pengendali Teknis',
       																					  	3=>'Ketua Tim',
       																					  	4=>'Anggota Tim',
       																					  	5=>'Penanggung Jawab'
       																					  	)
       											,'300px');

            
       		echo $this->lib_util->drawFiledText('Peran Dalam ST','vPeranst','300px');
            echo $this->lib_util->drawFiledText('Jumlah HP (hari)','nJumlahHP','100px');
       			

       			

       		?>
    	</form>
       

    </div>

    <div  class="box-footer" style="background-color: #ededed;">
            <button type="button" class="btn btn-warning" onclick="batal_team()" >Cancel/Close</button>
            <button type="button" onclick="simpanData_team()" class="btn btn-info pull-right">Simpan</button>
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">


	function batal_team() {
		$('.div_modal_add_team').modal('hide');
	}

	function  add_personil() {
		kosongin_form_team()
		var iStId = $('#iStId').val();
		var vNomorCs = $('#vNomorCs').val();

		$('#text_vUraianPenugasan').html($('#vUraianPenugasan').val());
		$('#text_dMulai').html($('#dMulai').val());
		$('#text_nJangkaWaktu').html($('#nJangkaWaktu').val());




        $('#modal_add_team').html('Tambah Personil '+vNomorCs);
       

       $('.div_modal_add_team').modal({
            backdrop: 'static',
            keyboard: false
            })

        $('.div_modal_add_team').modal('show');

        $('#nJumlahHP').autoNumeric('init', {vMin:'0', vMax:'9999'});


	}

	function  add_personil_asli() {
		kosongin_form_team()
		var iStId = $('#iStId').val();
		var vNomorCs = $('#vNomorCs').val();

		$('#text_vUraianPenugasan').html($('#vUraianPenugasan').val());
		$('#text_dMulai').html($('#dMulai').val());
		$('#text_nJangkaWaktu').html($('#nJangkaWaktu').val());




        $('#modal_add_team').html('Tambah Personil '+vNomorCs);
       

       $('.div_modal_add_team').modal({
            backdrop: 'static',
            keyboard: false
            })

        $('.div_modal_add_team').modal('show');

        dMulai = $('#dMulai').val();
        nJangkaWaktu = $('#nJangkaWaktu').val();

        x_dMulai = dMulai.split('-');
        dMulai = x_dMulai['2']+"-"+x_dMulai['1']+"-"+x_dMulai['0'];
        var dateMulai = new Date(dMulai);
        var dateAkhir = new Date(dMulai);

       
        dateAkhir.setDate(dateAkhir.getDate() + parseInt(nJangkaWaktu))

		
		$('#dMasaStrat').datepicker({
    		format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            startDate: dateMulai,
            endDate: dateAkhir,
            disableTouchKeyboard : true
        });

        $('#dMasaEnd').datepicker({
    		format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            startDate: dateMulai,
            endDate: dateAkhir,
            disableTouchKeyboard : true
        });


        $('#dPerjalananStart').datepicker({
    		format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            startDate: dateMulai,
            endDate: dateAkhir,
            disableTouchKeyboard : true
        });

        $('#dPerjalananEnd').datepicker({
    		format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            startDate: dateMulai,
            endDate: dateAkhir,
            disableTouchKeyboard : true
        });

        $('#nBiayaUangHarian').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nBiayaRepre').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nBiayaTransport').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nBiayaPenginapan').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nHonorJasa').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});


	}

	function searchPegawai() {
		$('.bs-example-modal-lg').modal({
            backdrop: 'static',
            keyboard: false
            })
        
        //$('#list_data_dipa').html('<center>Mohon tunggu, sedang menyiapkan data</center>')
        var iBidangId = $('#iBidangId').val();
        var list_data = getListPegawai(iBidangId);
        $('#list_data_dipa').html(list_data);
        $('#myLargeModalLabel').html('List Pegawai');
        $('#list_popup').DataTable({
            "bSort": false
        });



        $('.bs-example-modal-lg').modal('show');
	}


	function  getListPegawai(iBidangId) {
		var iStId = $('#iStId').val();
		var url = "<?php echo site_url().'/st/getListPegawai'; ?>";
        return $.ajax({
            type: 'POST', 
            url: url,
            data:'iBidangId='+iBidangId+'&iStId='+iStId,
            async:false
        }).responseText
	}

	function select_row_pegawai(vNip,vName,cGolongan) {
		$('#text_vNip').val(vNip+" / "+vName);
		$('#vNip').val(vNip);
		$('#cGolongan').val(cGolongan);

		$('.bs-example-modal-lg').modal('hide');
	}


	function simpanData_team() {
		var iStId 			= $('#iStId').val()
		var vNip 			= $('#vNip').val()
		var cGolongan 		= $('#cGolongan').val()
		var iPeran 			= $('#iPeran').val()
        var vPeranst          = $('#vPeranst').val()
		var nJumlahHP 		= $('#nJumlahHP').val()
		

		if ($('#vNip').val() == ''){
			custom_alert('','Lengkapi Data Personil');
			return false;
		}
		if ($('#cGolongan').val() == ''){
			custom_alert('','Lengkapi Golongan');
			return false;
		}
		if ($('#iPeran').val() == ''){
			custom_alert('','Lengkapi Peran Dalam Team');
			return false;
		}

        if ($('#vPeranst').val() == ''){
            custom_alert('','Lengkapi Peran Dalam ST');
            return false;
        }

		if ($('#nJumlahHP').val() == ''){
			custom_alert('','Lengkapi Jumlah HP');
			return false;
		}
		


		var url = "<?php echo site_url().'/st/simpanDataTeam'; ?>";
        var jwb = confirm("Simpan data ini ?");
        if (jwb==1){

            $.ajax({
                url: url,
                type: 'post',
                data: 'iStId='+iStId+'&vNip='+vNip+ '&cGolongan='+cGolongan+ '&iPeran='+iPeran+ '&nJumlahHP='+nJumlahHP+'&vPeranst='+vPeranst,
                success: function(data) {
                    if (data > 1) {
                        alert("Data berhasil disimpan");
                        $('.div_modal_add_team').modal('hide');
                        darw_list_team(iStId);
                        return false;
                    }else {
                       alert("Data Gagal disimpan");
                       return false;
                    }
                }
            })
           
        }


		
		
	}


	function kosongin_form_team() {
		 $('#vNip').val('')
		 $('#text_vNip').val('')
		 $('#cGolongan').val('')
		 $('#iPeran').val('').trigger('change');
		 $('#nJumlahHP').val('')
		 
	}



	function del_team(id) {
		var iStId 			= $('#iStId').val()
        var url = "<?php echo site_url().'/st/hapusDataTeam'; ?>";
        var jwb =  confirm('Hapus Data Team ini ?');
        if (jwb==1){
        	 $.post(url, {
                id:id}, function(data) {
                if (data > 0) {
                    custom_alert('','Data berhasil dihapus','success');
                    darw_list_team(iStId);
                    return false;
                } else {
                   custom_alert('','Data gagal dihapus','error');
                   return false;
                }
                
            }); 
        }
    }

	
	function edit_team(id) {
		add_personil();
		var data_edit = loadDataEditTeam(id);
		var rowDataTeam  = JSON.parse(data_edit);
		console.log(rowDataTeam);

		$('#vNip').val(rowDataTeam['vNip']);
		$('#text_vNip').val(rowDataTeam['vNip']+" "+rowDataTeam['vName']);
		$('#cGolongan').val(rowDataTeam['cGolongan']);
		$('#iPeran').val(rowDataTeam['iPeran']).trigger('change');
		$('#nJumlahHP').val(rowDataTeam['nJumlahHP']);
        $('#vPeranst').val(rowDataTeam['vPeranst']);
		

	}

	function loadDataEditTeam(id){
        var url = "<?php echo site_url().'/st/getDataEditTeam'; ?>";
        return $.ajax({
            type: 'POST',
            data:'id='+id, 
            url: url,
            async:false
        }).responseText
    }

</script>