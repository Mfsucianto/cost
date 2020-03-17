
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
		                <th>Peran</th>
		                <th>Jumlah HP</th>
		                <th>Masa Penugasan</th>
		                <th style="width: 10px"></th>
	                </tr>
                </thead>
                <tbody>

              	</tbody>
              	<tfoot>
              		

              		<tr>
              			<td  colspan="6"></td>
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
       			echo $this->lib_util->drawFiledText('Jumlah HP (hari)','nJumlahHP','100px');
       			

       			echo "<legend>Data Penugasan</legend>";

       			echo '<div class="form-group" >
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Masa Penugasan</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    
                                    <table>
                                    	<tr>
                                    		<td><input type="text"   id="dMasaStrat" name="dMasaStrat" style="width:100px;" class="form-control"></td>
                                    		<td>&nbsp s/d &nbsp </td>
                                    		<td><input type="text"  id="dMasaEnd" name="dMasaEnd" style="width:100px;" class="form-control"></td>
                                    	</tr>
                                    </table>
                                    
                                </div>
                                
                              </div>
                            </div>'; 

                echo $this->lib_util->drawFiledText('Lama (hari)','nLama','100px');
               

                echo "<legend>Data Perjalanan Dinas</legend>";

                echo $this->lib_util->drawcombo('iJenisPerDinas','Jenis Perjalanan Dinas ',array(0=>'',1=>'Luar Kota',2=>'Translok',3=>'Nihil'),'300px');

                echo $this->lib_util->drawFiledText('Berangkat Dari','vDari','200px');
                echo $this->lib_util->drawFiledText('Kota Tujuan','vTujuan','200px');


                echo '<div class="form-group">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Tanggal Perjalanan</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    
                                    <table>
                                    	<tr>
                                    		<td><input type="text"   id="dPerjalananStart" name="dPerjalananStart" style="width:100px;" class="form-control"></td>
                                    		<td>&nbsp s/d &nbsp </td>
                                    		<td><input type="text"  id="dPerjalananEnd" name="dPerjalananEnd" style="width:100px;" class="form-control"></td>
                                    	</tr>
                                    </table>
                                    
                                </div>
                                
                              </div>
                            </div>';



            echo "<div id='non_nihil' style='display:none;' >";

                echo $this->lib_util->drawcombo('iAlatAngkut','Alat Angkutan ',array(0=>'',
       																					  	1=>'Pesawat Terbang',
       																					  	2=>'Kapal Laut',
       																					  	3=>'Kendaraan Umum',
       																					  	4=>'Kereta API',
       																					  	5=>'Kendaraan Dinas'
       																					  	)
       											,'300px');

                echo $this->lib_util->drawcombo('iOpsiHariLibur','Opsi Hari Libur ',array(0=>'',
       																					  	1=>'Hari Libur Tidak Diperbolehkan',
       																					  	2=>'Hari Libur Diperbolehkan TAPI Tidak Dibiayai',
       																					  	3=>'Hari Libur Diperbolehkan dan Dibiayai'
       																					  	)
       											,'400px'); 

                echo $this->lib_util->drawcombo('iOpsiHariSabtu','Opsi Hari Sabtu ',array(0=>'',
       																					  	1=>'Hari Sabtu Tidak Diperbolehkan',
       																					  	2=>'Hari Sabtu Diperbolehkan TAPI Tidak Dibiayai',
       																					  	3=>'Hari Sabtu Diperbolehkan dan Dibiayai'
       																					  	)
       											,'400px');

                 echo $this->lib_util->drawcombo('iOpsiHariMinggu','Opsi Hari Minggu ',array(0=>'',
       																					  	1=>'Hari Minggu Tidak Diperbolehkan',
       																					  	2=>'Hari Minggu Diperbolehkan TAPI Tidak Dibiayai',
       																					  	3=>'Hari Minggu Diperbolehkan dan Dibiayai'
       																					  	)
       											,'400px');

                 echo $this->lib_util->drawFiledText('Biaya Uang Harian (Rp)','nBiayaUangHarian','200px');
                

            echo "</div>";

            echo "<div id='perjalanan_dinas' style='display:none;' >";
            	echo $this->lib_util->drawFiledText('Biaya Representatif (Rp)','nBiayaRepre','200px');
            	echo $this->lib_util->drawFiledText('Biaya Transport (Rp)','nBiayaTransport','200px');

            	echo $this->lib_util->drawcombo('iJenisAkomodasi','Jenis Akomodasi ',array(0=>'','400px'));

            	echo $this->lib_util->drawFiledText('Biaya Penginapan (Rp)','nBiayaPenginapan','200px');
            	echo $this->lib_util->drawFiledText('Honor Jasa Profesi (Rp)','nHonorJasa','200px');
            	
            echo "</div>";

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
		var nJumlahHP 		= $('#nJumlahHP').val()
		var dMasaStrat 		= $('#dMasaStrat').val()
		var dMasaEnd 		= $('#dMasaEnd').val()
		var nLama 			= $('#nLama').val()
		var iJenisPerDinas 		= $('#iJenisPerDinas').val()
		var vDari 				= $('#vDari').val()
		var vTujuan 			= $('#vTujuan').val()
		var dPerjalananStart 	= $('#dPerjalananStart').val()
		var dPerjalananEnd 		= $('#dPerjalananEnd').val()
		var iAlatAngkut 		= $('#iAlatAngkut').val()
		var iOpsiHariLibur 		= $('#iOpsiHariLibur').val()
		var iOpsiHariSabtu 		= $('#iOpsiHariSabtu').val()
		var iOpsiHariMinggu 	= $('#iOpsiHariMinggu').val()
		var nBiayaUangHarian 	= $('#nBiayaUangHarian').val()
		var nBiayaRepre 		= $('#nBiayaRepre').val()
		var nBiayaTransport 	= $('#nBiayaTransport').val()
		var iJenisAkomodasi 	= $('#iJenisAkomodasi').val()
		var nBiayaPenginapan 	= $('#nBiayaPenginapan').val()
		var nHonorJasa 			= $('#nHonorJasa').val()

		if ($('#vNip').val() == ''){
			custom_alert('','Lengkapi Data Personil');
			return false;
		}
		if ($('#cGolongan').val() == ''){
			custom_alert('','Lengkapi Golongan');
			return false;
		}
		if ($('#iPeran').val() == ''){
			custom_alert('','Lengkapi Peran Dalam team');
			return false;
		}
		if ($('#nJumlahHP').val() == ''){
			custom_alert('','Lengkapi Jumlah HP');
			return false;
		}
		if ($('#dMasaStrat').val() == ''){
			custom_alert('','Lengkapi Masa Penugasan');
			return false;
		}
		if ($('#dMasaEnd').val() == ''){
			custom_alert('','Lengkapi Masa Penugasan');
			return false;
		}


		//disini ngecek orang tersebut free gak pada tgl tersebut

		if ($('#nLama').val() == ''){
			custom_alert('','Lengkapi Lama hari');
			return false;
		}
		if ($('#iJenisPerDinas').val() == '' || $('#iJenisPerDinas').val()==0){
			custom_alert('','Pilih Jenis Perjlanan Dinas');
			return false;
		}
		if ($('#vDari').val() == ''){
			custom_alert('','Lengkapi Berangkat Dari');
			return false;
		}
		if ($('#vTujuan').val() == ''){
			custom_alert('','Lengkapi Kota Tujuan');
			return false;
		}
		if ($('#dPerjalananStart').val() == ''){
			custom_alert('','Lengkapi Tanggal Perjalanan');
			return false;
		}
		if ($('#dPerjalananEnd').val() == ''){
			custom_alert('','Lengkapi Tanggal Perjalanan');
			return false;
		}

		if ($('#iJenisPerDinas').val()==1 || $('#iJenisPerDinas').val()==2){

			if ($('#iAlatAngkut').val() == '' || $('#iAlatAngkut').val()==0 ){
				custom_alert('','Pilih Alat Angkut');
				return false;
			}
			if ($('#iOpsiHariLibur').val() == '' || $('#iOpsiHariLibur').val() == 0){
				custom_alert('','Pilih Opsi Hari Libur');
				return false;
			}
			if ($('#iOpsiHariSabtu').val() == '' ||  $('#iOpsiHariSabtu').val() == 0){
				custom_alert('','Pilih Opsi hari Sabtu');
				return false;
			}
			if ($('#iOpsiHariMinggu').val() == '' ||  $('#iOpsiHariMinggu').val() == 0){
				custom_alert('','Pilih Opsi Hari Minggu');
				return false;
			}

			if ($('#nBiayaUangHarian').val() == ''){
				custom_alert('','Lengkapi Biaya Uang harian');
				return false;
			}
		}

		if ($('#iJenisPerDinas').val()==1){
			if ($('#nBiayaRepre').val() == ''){
				custom_alert('','Lengkapi Biaya Representatif');
				return false;
			}
			if ($('#nBiayaTransport').val() == ''){
				custom_alert('','Lengkapi Biaya Transport ');
				return false;
			}
			if ($('#iJenisAkomodasi').val() == ''){
				custom_alert('','Pilih Jenis Akomodasi');
				return false;
			}
			if ($('#nBiayaPenginapan').val() == ''){
				custom_alert('','Lengkapi Biaya Penginapan ');
				return false;
			}
			if ($('#nHonorJasa').val() == ''){
				custom_alert('','Lengkapi Honor Jasa Profesi');
				return false;
			}
		}


		var url = "<?php echo site_url().'/st/simpanDataTeam'; ?>";
        var jwb = confirm("Simpan data ini ?");
        if (jwb==1){

            $.ajax({
                url: url,
                type: 'post',
                data: 'iStId='+iStId+'&vNip='+vNip+ '&cGolongan='+cGolongan+ '&iPeran='+iPeran+ '&nJumlahHP='+nJumlahHP+ '&dMasaStrat='+dMasaStrat+ '&dMasaEnd='+dMasaEnd+ '&nLama='+nLama+ '&iJenisPerDinas='+iJenisPerDinas+ '&vDari='+vDari+ '&vTujuan='+vTujuan+ '&dPerjalananStart='+dPerjalananStart+ '&dPerjalananEnd='+dPerjalananEnd+ '&iAlatAngkut='+iAlatAngkut+ '&iOpsiHariLibur='+iOpsiHariLibur+ '&iOpsiHariSabtu='+iOpsiHariSabtu+ '&iOpsiHariMinggu='+iOpsiHariMinggu+ '&nBiayaUangHarian='+nBiayaUangHarian+ '&nBiayaRepre='+nBiayaRepre+ '&nBiayaTransport='+nBiayaTransport+ '&iJenisAkomodasi='+iJenisAkomodasi+ '&nBiayaPenginapan='+nBiayaPenginapan+ '&nHonorJasa='+nHonorJasa,
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
		 $('#dMasaStrat').val('')
		 $('#dMasaEnd').val('')
		 $('#nLama').val('')
		 $('#iJenisPerDinas').val('').trigger('change');
		 $('#vDari').val('')
		 $('#vTujuan').val('')
		 $('#dPerjalananStart').val('')
		 $('#dPerjalananEnd').val('')
		 $('#iAlatAngkut').val('').trigger('change');
		 $('#iOpsiHariLibur').val('').trigger('change');
		 $('#iOpsiHariSabtu').val('').trigger('change');
		 $('#iOpsiHariMinggu').val('').trigger('change');
		 $('#nBiayaUangHarian').val('')
		 $('#nBiayaRepre').val('')
		 $('#nBiayaTransport').val('')
		 $('#iJenisAkomodasi').val('').trigger('change');
		 $('#nBiayaPenginapan').val('')
		 $('#nHonorJasa').val('')
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
		var data_edit = loadDataEditTeam();
		var rowDataTeam  = JSON.parse(data_edit);

	}

	function loadDataEditTeam(id){
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/getDataEdit'; ?>";
        return $.ajax({
            type: 'POST',
            data:'id='+id, 
            url: url,
            async:false
        }).responseText
    }

</script>