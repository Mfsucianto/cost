<section class="content" id="section_list_cs">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                
                <button onclick="tambah_cs()" class="btn btn-info"  ><i class="fa fa-plus"> Tambah Cost Sheet</i></button>
            </div>
        </div>
        <div class="box-body">
            <div id="isi_table_cs" >
                <center>--please wait while generating data--</center> 
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->

<section class="content" id="from_add_cs" style="display: none;">
    <div class="box box-info box-solid">
        <div class="box-header with-border">
          <h4 class="box-title title" style="font-size: 15px;font-weight: bold;">Data Cost Sheet</h4>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="overflow: auto;max-height: 400px;">
            <form class="form-horizontal" id="form_data_cs" name="form_data_cs" autocomplete="off">
                <?php 
                    echo '<input type="hidden" readonly class="form-control input-sm" id="iCsId" name="iCsId" value="0">';

                    echo $this->lib_util->drawFiledLabel('Nomor Cost Sheet','vNomorCs');
                    echo $this->lib_util->drawFiledText('Tanggal Cost Sheet','dTanggalCS','100px');

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


                    echo "<legend>Data Personil</legend>";
                    echo "
                        <div id='div_list_personil' >
                            <center ><span class='label bg-green'>--Simpan Data Terlebih Dahulu Untuk memasukan data personil--</span></center>
                        </div>";
                ?>



            </form>

        </div>
        <!-- /.box-body -->

        <div  class="box-footer">
            <button type="button" class="btn btn-warning" onclick="batal_inputcs()" >Cancel/Close</button>
            <button type="button" class="btn btn-success" onclick="cetak_cs()" >Cetak Cost Sheet</button>
           
            <button type="button" onclick="simpanDataCS()" class="btn btn-info pull-right">Simpan</button> &nbsp

            
        </div>
    </div>
</section>



<!-- ====================================Form Personil CS========================================== -->
<!-- ====================================Form Personil CS========================================== -->
<!-- ====================================Form Personil CS========================================== -->

<!--  Modal content for the above example -->
<div class="modal fade dialog_personil" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabeldialog_personil">
<div class="modal-dialog  modal-dialog-centered" role="document">
  <div class="modal-content">

    <div class="modal-header">
     
      <h4 class="modal-title" id="myLargeModalLabeldialog_personil">Personel Cost Sheet</h4>
    </div>
    <div class="modal-body" id="div_from_add_personil">
        <form class="form-horizontal" id="form_data_personil_cs" name="form_data_personil_cs" autocomplete="off">
            <?php
                
                echo '<input type="hidden" readonly class="form-control input-sm" id="iCsDetailId" name="iCsDetailId" value="0">';

                $datatmcs = array();
                $sql = "select a.vNip,(select vName from cost.ms_pegawai where vNip=a.vNip) as vName 
                        from cost.st_detail_team as a where a.iStId='".$this->iStId."' and a.lDeleted=0 ";
                $query  = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    foreach($query->result_array() as $row) {
                        $datatmcs[$row['vNip']] = $row['vName'];
                    }
                }
                echo $this->lib_util->drawcombo('vNip_cs','NIP',$datatmcs,'300px');

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

                echo "<div id='non_nihil' >";

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
                                                    ,'300px'); 

                    echo $this->lib_util->drawcombo('iOpsiHariSabtu','Opsi Hari Sabtu ',array(0=>'',
                                                                                                1=>'Hari Sabtu Tidak Diperbolehkan',
                                                                                                2=>'Hari Sabtu Diperbolehkan TAPI Tidak Dibiayai',
                                                                                                3=>'Hari Sabtu Diperbolehkan dan Dibiayai'
                                                                                                )
                                                    ,'300px');

                     echo $this->lib_util->drawcombo('iOpsiHariMinggu','Opsi Hari Minggu ',array(0=>'',
                                                                                                1=>'Hari Minggu Tidak Diperbolehkan',
                                                                                                2=>'Hari Minggu Diperbolehkan TAPI Tidak Dibiayai',
                                                                                                3=>'Hari Minggu Diperbolehkan dan Dibiayai'
                                                                                                )
                                                    ,'300px');

                    
                    

                echo "</div>";

                
                

                echo $this->lib_util->drawFiledText('Biaya Uang Harian (Rp)','nBiayaUangHarian','200px');
                echo $this->lib_util->drawFiledText('Biaya Representatif (Rp)','nBiayaRepre','200px');
                echo $this->lib_util->drawFiledText('Biaya Transport (Rp)','nBiayaTransport','200px');

                echo $this->lib_util->drawcombo('iJenisAkomodasi','Jenis Akomodasi ',array(0=>'',1=>'Fullboard',2=>'Non Fullboard'));

                echo $this->lib_util->drawFiledText('Biaya Penginapan (Rp)','nBiayaPenginapan','200px');
                echo $this->lib_util->drawFiledText('Honor Jasa Profesi (Rp)','nHonorJasa','200px');
            ?>
        </form>
    </div>
    <div  class="box-footer">
        <button type="button" class="btn btn-warning" onclick="batal_input_personilcs()" >Cancel/Close</button>
       
        <button type="button" onclick="simpanDataPersonilCs()" class="btn btn-info pull-right">Simpan</button> &nbsp
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--  Modal content for the above example -->
<div class="modal fade dialog_cetak" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabeldialog_cetak">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content">

    <div class="modal-header">
     
      <h4 class="modal-title" id="myLargeModalLabeldialog_cetak">Cetak Cost Sheet</h4>
    </div>
    <div class="modal-body" id="div_from_cetak">
        <form class="form-horizontal" id="form_data_cetak" name="form_data_cetak" autocomplete="off">
            <?php

                $datatmcs = array();
                $opt = '<option></option>';
                $sql = "select vNip,vName from cost.ms_pegawai WHERE lDeleted=0 ";
                $query  = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    foreach($query->result_array() as $row) {
                       
                        $opt .= '<option value="'.$row['vNip']."|".$row['vName'].'"  >'.$row['vNip']." - ".$row['vName'].'</option>';
                    }
                }


                echo  '<div class="form-group">
                          <label for="username" class="col-sm-3 control-label" style="font-weight: 400;width:200px;">Kepala Bagian Tata Usaha</label>
                          <div class="col-sm-7">
                                <select class="orm-control input-sm select2" style="width:500px;" id="niptu" name="niptu">
                                    '.$opt.'
                                </select>
                          </div>
                        </div>';

                echo  '<div class="form-group">
                          <label for="username" class="col-sm-3 control-label" style="font-weight: 400;width:200px;">Kasubbag Keuangan</label>
                          <div class="col-sm-7">
                                <select class="orm-control input-sm select2" style="width:500px;" id="nipkeuangan" name="nipkeuangan">
                                    '.$opt.'
                                </select>
                          </div>
                        </div>';

                echo  '<div class="form-group">
                          <label for="username" class="col-sm-3 control-label" style="font-weight: 400;width:200px;">Korwas P3A</label>
                          <div class="col-sm-7">
                                <select class="orm-control input-sm select2" style="width:500px;" id="nipp3a" name="nipp3a">
                                    '.$opt.'
                                </select>
                          </div>
                        </div>';


                echo  '<div class="form-group">
                          <label for="username" class="col-sm-3 control-label" style="font-weight: 400;width:200px;">Korwas JFA</label>
                          <div class="col-sm-7">
                                <select class="orm-control input-sm select2" style="width:500px;" id="nipKorwas" name="nipKorwas">
                                   
                                </select>
                          </div>
                        </div>';

                echo "<legend></legend>";

                echo  '<div class="form-group">
                          <label for="username" class="col-sm-3 control-label" style="font-weight: 400;width:200px;">Dalnis/KaSubBag</label>
                          <div class="col-sm-7">
                                <select class="orm-control input-sm select2" style="width:500px;" id="nipDalnis" name="nipDalnis">
                                    '.$opt.'
                                </select>
                          </div>
                        </div>';

                echo  '<div class="form-group">
                          <label for="username" class="col-sm-3 control-label" style="font-weight: 400;width:200px;">Kepala Bidang/Bagian</label>
                          <div class="col-sm-7">
                                

                                
                                <table>
                                    <tr>
                                        <td>
                                            <select class="orm-control input-sm select2" style="width:300px;" id="nipKabag" name="nipiKabag">
                                                '.$opt.'
                                            </select>
                                        </td>
                                        <td> &nbsp &nbsp </td>
                                        <td>
                                           <select class="orm-control input-sm select2" style="width:200px;" id="iKabag" name="iKabag">
                                                <option value="Kepala Bagian" >Kabid/Kabag</option>
                                                <option value="Pelaksana Harian Kepala Bagian" >Plh Kabid/Kabag</option>
                                                <option value="Pelaksana Tugas Kepala Bagian" >Plt Kabid/Kabag</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>


                          </div>
                        </div>';


                echo  '<div class="form-group">
                          <label for="username" class="col-sm-4 control-label" style="font-weight: 400;width:200px;">Kepala Perwakilan</label>
                          <div class="col-sm-7">

                                <table>
                                    <tr>
                                        <td>
                                            <select class="orm-control input-sm select2" style="width:300px;" id="nipiKaPer" name="nipiKaPer">
                                                '.$opt.'
                                            </select>
                                        </td>
                                        <td> &nbsp &nbsp </td>
                                        <td>
                                            <select class="orm-control input-sm select2" style="width:300px;" id="iKaPer" name="iKaPer">
                                                <option value="Kepala Perwakilan" >Kepala Perwakilan</option>
                                                <option value="Pelaksana Harian Kepala Perwakilan" >Plh Kepala Perwakilan</option>
                                                <option value="Pelaksana Tugas Kepala Perwakilan" >Plt Kepala Perwakilan</option>

                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                

                                
                          </div>
                        </div>';

                echo $this->lib_util->drawFiledText('Dikeluarkan Di ','diKelurkandi','200px');
                echo $this->lib_util->drawFiledText('Tanggal ','dKeluarkanTgl','200px');
               
            ?>
        </form>
    </div>
    <div  class="box-footer">
        <button type="button" class="btn btn-warning" onclick="batal_cetak()" >Cancel</button>
       
        <button type="button" onclick="proses_cetak_cs()" class="btn btn-info pull-right">Print</button> &nbsp
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
    $(document).ready(function() {
        refreshDataCS();

        $('.select2').select2({
            placeholder: "--select--",
            allowClear: true
        });

       $("#iJenisPerDinas").change(function() {
            
            /*if ($(this).val()==1 || $(this).val()==2){
                $('#non_nihil').show();
            }else{
                $('#non_nihil').hide();
                
            }*/
        });

        dMulai = $('#dMulai').val();
        nJangkaWaktu = $('#nJangkaWaktu').val();



        x_dMulai = dMulai.split('-');
        dMulai = x_dMulai['2']+"-"+x_dMulai['1']+"-"+x_dMulai['0'];
        var dateMulai = new Date(dMulai);
        var dateAkhir = new Date(dMulai);
      
        for (i = 0; i < nJangkaWaktu; ++i) {
            var dm  = dateAkhir.getDay();
            if(dm==6){
                 dateAkhir.setDate(dateAkhir.getDate() + 3);
            }else{
                dateAkhir.setDate(dateAkhir.getDate() + 1);
            }
            
        }

 

        
        $('#dKeluarkanTgl').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });

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
        }).on('hide', function(ev) { // <-----------
           cekValidPeriode()
            
        });

       

        $('#dPerjalananEnd').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            startDate: dateMulai,
            endDate: dateAkhir,
            disableTouchKeyboard : true
        }).on('hide', function(ev) { // <-----------
            cekValidPeriode()
            
        });

        $('#dTanggalCS').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });

        

    });

    
    function cekValidPeriode() {
        var vNip_cs          = $('#vNip_cs').val();
        var dPerjalananEnd = $('#dPerjalananEnd').val();
        var dPerjalananStart = $('#dPerjalananStart').val();
        var iCsId   = $('#iCsId').val()
        var url     = "<?php echo site_url().'/cost_sheet/cekValidPeriode'; ?>";

        if (vNip_cs==''){
            custom_alert('','Pilih Personil terlebih dahulu');
            $('#dPerjalananStart').val('')
            $('#dPerjalananEnd').val('')
            return false;
        }

        if (dPerjalananEnd!='' && dPerjalananStart!=''){
           
            $.ajax({
                url: url,
                type: 'post',
                data:'iCsId='+iCsId+'&vNip='+vNip_cs+'&dPerjalananStart='+dPerjalananStart+'&dPerjalananEnd='+dPerjalananEnd, 
                success: function(data) {
                    if (data != '') {
                        custom_alert('Periode Bentok',data,'error');
                         $('#dPerjalananStart').val('');
                         $('#dPerjalananEnd').val('');
                        return false;
                    }
                }
            })

        }
        
        

    }

    function refreshDataCS(){

        var data = loadDataCS();
        $('#isi_table_cs').html(data);
        $('#tabel_cs').DataTable({
            scrollY:        300,
            scrollX:        true,
            scrollCollapse: true,
            fixedColumns:   {
                leftColumns: 2,
                rightColumns: 0,
            }
        });
    }

    function loadDataCS(){
        var iStId = $('#iStId').val();
        var url = "<?php echo site_url().'/cost_sheet/getData'; ?>";
        return $.ajax({
            type: 'POST',
            data:'iStId='+iStId, 
            url: url,
            async:false
        }).responseText
    }

    function batal_inputcs() {
        $('#from_add_cs').hide(200);
        $('#section_list_cs').show(200);
    }

    function tambah_cs() {
        kosongin_form_team()
        $('#section_list_cs').hide(200);
        $('#from_add_cs').show(200);
        
    }

    function editDataCS(id) {
        kosongin_form_team()
        $('#section_list_cs').hide(200);
        $('#from_add_cs').show(200);
        $('#div_list_personil').html('<center>--please wait while loading--</center>');
        var data_cs = getEditDataCS(id);
        var rowDatacs  = JSON.parse(data_cs);
        
      
        $('#text_vNomorCs').html(rowDatacs['vNomorCs']);
        //$('#text_vNomorCs').html(rowDatacs['vNomorCs']);
      
        

        $('#iCsId').val(rowDatacs['iCsId']);
        $('#dTanggalCS').val(rowDatacs['dTanggalCS']);
        $('#dMasaStrat').val(rowDatacs['dMasaStrat']);
        $('#dMasaEnd').val(rowDatacs['dMasaEnd']);
        $('#nLama').val(rowDatacs['nLama']);
        $('#iJenisPerDinas').val(rowDatacs['iJenisPerDinas']).trigger('change');
        $('#vDari').val(rowDatacs['vDari']);
        $('#vTujuan').val(rowDatacs['vTujuan']);
        

        var tabel_personil = getTablePeronilCS(id,rowDatacs['iJenisPerDinas']);
        $('#div_list_personil').html(tabel_personil);

        var korwas = getDataKorwas(rowDatacs['iBidangId']);
        var rowDatakorwas  = JSON.parse(korwas);
        for(i=0;i<rowDatakorwas.length;i++) {
            
            var newOption = new Option(rowDatakorwas[i].value, rowDatakorwas[i].key, false, false);
            $('#nipKorwas').append(newOption).trigger('change');
        }

    }  


    function getDataKorwas(iBidangId) {
        var url = "<?php echo site_url().'/cost_sheet/getDataKorwas'; ?>";
        return $.ajax({
            type: 'POST',
            data:'iBidangId='+iBidangId, 
            url: url,
            async:false
        }).responseText
     }

    function getEditDataCS(id) {
        var url = "<?php echo site_url().'/cost_sheet/getDataEdit'; ?>";
        return $.ajax({
            type: 'POST',
            data:'id='+id, 
            url: url,
            async:false
        }).responseText
     } 

    function getTablePeronilCS(id,iJenisPerDinas) {
        var url = "<?php echo site_url().'/cost_sheet/getTablePeronilCS'; ?>";
        return $.ajax({
            type: 'POST',
            data:'id='+id+'&iJenisPerDinas='+iJenisPerDinas, 
            url: url,
            async:false
        }).responseText
     } 


    function kosongin_form_team() {
         $('#iCsId').val('0')
         $('#dTanggalCS').val('')
         $('#dMasaStrat').val('')
         $('#dMasaEnd').val('')
         $('#nLama').val('')
         $('#iJenisPerDinas').val('').trigger('change');
         $('#vDari').val('')
         $('#vTujuan').val('')
        

         $('#div_list_personil').html("<center ><span class='label bg-green'>--Simpan Data Terlebih Dahulu Untuk memasukan data personil--</span></center>");


        
    }

    function simpanDataCS() {
        var iCsId      = $('#iCsId').val()
        var dTanggalCS      = $('#dTanggalCS').val()
        var dMasaStrat      = $('#dMasaStrat').val()
        var dMasaEnd        = $('#dMasaEnd').val()
        var nLama           = $('#nLama').val()
        var iJenisPerDinas      = $('#iJenisPerDinas').val()
        var vDari               = $('#vDari').val()
        var vTujuan             = $('#vTujuan').val()
        

        if ($('#dTanggalCS').val() == ''){
            custom_alert('','Lengkapi Tanggal Cost Sheet');
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
        

        var iStId = $('#iStId').val();

        var url = "<?php echo site_url().'/cost_sheet/insertData'; ?>";
        var jwb = confirm("Simpan data ini ?");
        if (jwb==1){

            $.ajax({
                url: url,
                type: 'post',
                data: 'iStId='+iStId+'&iCsId='+iCsId+'&dTanggalCS='+dTanggalCS+'&dMasaStrat='+dMasaStrat+ '&dMasaEnd='+dMasaEnd+ '&nLama='+nLama+ '&iJenisPerDinas='+iJenisPerDinas+ '&vDari='+vDari+ '&vTujuan='+vTujuan,
                success: function(data) {
                    if (data > 0) {
                        custom_alert('','Data berhasil disimpan','success');
                        refreshDataCS();
                        editDataCS(data)
                        return false;
                    }else {
                       alert("Data Gagal disimpan");
                       return false;
                    }
                }
            })
           
        }
    }


    function hapusDataCs(id) {
        var url = "<?php echo site_url().'/cost_sheet/hapusDataCS'; ?>";
        var jwb = confirm("Hapus data ini ?");
        if (jwb==1){
            $.post(url, {
                id:id}, function(data) {
                if (data > 0) {
                    custom_alert('','Data berhasil dihapus','success');
                    refreshDataCS();
                    return false;
                } else {
                   custom_alert('','Data gagal dihapus','error');
                   return false;
                }
                
            }); 
        }
    }

    function addPersonelCS() {
        var iJenisPerDinas = $('#iJenisPerDinas').val();
        $('#vNip_cs').val('').trigger('change');

         $('#dPerjalananStart').val('')
         $('#dPerjalananEnd').val('')
         $('#iAlatAngkut').val('').trigger('change');
         $('#iOpsiHariLibur').val('').trigger('change');
         $('#iOpsiHariSabtu').val('').trigger('change');
        $('#iOpsiHariMinggu').val('').trigger('change');

        $('#nBiayaUangHarian').val('');
        $('#nBiayaRepre').val('');
        $('#nBiayaTransport').val('');
        $('#iJenisAkomodasi').val('').trigger('change');
        $('#nBiayaPenginapan').val('');
        $('#nHonorJasa').val('');
        $('#iCsDetailId').val(0);

        $('.dialog_personil').modal({
            backdrop: 'static',
            keyboard: false
            })


        $('.dialog_personil').modal('show');

        $('#div_nBiayaUangHarian').hide();
        $('#div_nBiayaRepre').hide();
        $('#div_nBiayaTransport').hide();
        $('#div_nBiayaPenginapan').hide();
        $('#div_nHonorJasa').hide();
        $('#div_iJenisAkomodasi').hide();

        //if (iJenisPerDinas==1){
            
            $('#div_nBiayaUangHarian').show();
            $('#div_nBiayaRepre').show();
            $('#div_nBiayaTransport').show();
            $('#div_nBiayaPenginapan').show();
            $('#div_nHonorJasa').show();
            $('#div_iJenisAkomodasi').show();
        //}else if (iJenisPerDinas==2){
            //$('#div_nBiayaUangHarian').show();
        //}

        $('#nBiayaUangHarian').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nBiayaRepre').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nBiayaTransport').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nBiayaPenginapan').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nHonorJasa').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
    }

    function batal_input_personilcs() {
       $('.dialog_personil').modal('hide');
    }

    function simpanDataPersonilCs() {
        
        var iDipaId      = $('#iDipaId').val()
        var iStId           = $('#iStId').val();
        var vNip_cs          = $('#vNip_cs').val();
        var iJenisPerDinas = $('#iJenisPerDinas').val();
        var iSumberDana = $('#iSumberDana').val();

        var dPerjalananStart    = $('#dPerjalananStart').val()
        var dPerjalananEnd      = $('#dPerjalananEnd').val()
        var iAlatAngkut         = $('#iAlatAngkut').val()
        var iOpsiHariLibur      = $('#iOpsiHariLibur').val()
        var iOpsiHariSabtu      = $('#iOpsiHariSabtu').val()
        var iOpsiHariMinggu     = $('#iOpsiHariMinggu').val()

        var nBiayaUangHarian = $('#nBiayaUangHarian').val();
        var nBiayaRepre      = $('#nBiayaRepre').val();
        var nBiayaTransport  = $('#nBiayaTransport').val();
        var iJenisAkomodasi  = $('#iJenisAkomodasi').val();
        var nBiayaPenginapan = $('#nBiayaPenginapan').val();
        var nHonorJasa       = $('#nHonorJasa').val();
        var iCsId            = $('#iCsId').val();
        var iCsDetailId      = $('#iCsDetailId').val();
      
        if (vNip_cs==''){
            custom_alert('','Pilih Personil');
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


        //if ($('#iJenisPerDinas').val()==1 || $('#iJenisPerDinas').val()==2){

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
       // }


        /*if (iJenisPerDinas!=3){
            if (nBiayaUangHarian==''){
                custom_alert('Lengkapi Uang Harian');
                return false;
            }
        }else if (iJenisPerDinas==1){*/
            if (nBiayaRepre==''){
                custom_alert('Lengkapi Biaya Representatif');
                return false;
            }

            if (nBiayaTransport==''){
                custom_alert('Lengkapi Biaya Transportasi');
                return false;
            }

            if (iJenisAkomodasi==''){
                custom_alert('Pilih Jenis Akomodasi');
                return false;
            }

            if (nBiayaPenginapan==''){
                custom_alert('Lengkapi Biaya Penginapan');
                return false;
            }

            if (nHonorJasa==''){
                nHonorJasa = 0;
                //custom_alert('Lengkapi Honor Jasa Profesi');
                //return false;
            }
        //}

        

        

        var total_semua = getTotalSemua();

        var ada = cekValidPersonil(iCsId,vNip_cs,iCsDetailId).trim();
        if (ada!=''){
            x_ada = ada.split('|');
            custom_alert(x_ada['0'],x_ada['1'],'error');  
            return false;
        }

        var url = "<?php echo site_url().'/cost_sheet/simpanDataPersonilCs'; ?>";
        var jwb = confirm("Simpan data ini ?");
        if (jwb==1){

            $.ajax({
                url: url,
                type: 'post',
                data: 'iCsId='+iCsId+'&iCsDetailId='+iCsDetailId+'&vNip='+vNip_cs+'&nBiayaUangHarian='+nBiayaUangHarian+'&nBiayaRepre='+nBiayaRepre+'&nBiayaTransport='+nBiayaTransport+'&iJenisAkomodasi='+iJenisAkomodasi+'&nBiayaPenginapan='+nBiayaPenginapan+'&nHonorJasa='+nHonorJasa+'&dPerjalananStart='+dPerjalananStart+ '&dPerjalananEnd='+dPerjalananEnd+ '&iAlatAngkut='+iAlatAngkut+ '&iOpsiHariLibur='+iOpsiHariLibur+ '&iOpsiHariSabtu='+iOpsiHariSabtu+ '&iOpsiHariMinggu='+iOpsiHariMinggu+'&iStId='+iStId+'&iDipaId='+iDipaId+'&iJenisPerDinas='+iJenisPerDinas+'&iSumberDana='+iSumberDana,
                success: function(data) {
                    if (data == '') {
                        
                        custom_alert('','Data berhasil disimpan','success');
                        var tabel_personil = getTablePeronilCS(iCsId,iJenisPerDinas);
                        $('#div_list_personil').html(tabel_personil);
                        $('.dialog_personil').modal('hide');
                        return false;
                    }else {
                       custom_alert(data);
                       return false;
                    }
                }
            })
           
        }
        
    }


    function getTotalSemua() {
        var nBiayaUangHarian = stripCharacters($('#nBiayaUangHarian').val());
        var nBiayaRepre      = stripCharacters($('#nBiayaRepre').val());
        var nBiayaTransport  = stripCharacters($('#nBiayaTransport').val());
        var nBiayaPenginapan = stripCharacters($('#nBiayaPenginapan').val());
        //var nHonorJasa       = stripCharacters($('#nHonorJasa').val());

        var total = parseInt(nBiayaUangHarian) +  parseInt(nBiayaRepre) +  parseInt(nBiayaTransport) +  parseInt(nBiayaPenginapan);

        return total;
    }

    function cekValidPersonil(iCsId,vNip,iCsDetailId) {
        var url = "<?php echo site_url().'/cost_sheet/cekValidPersonil'; ?>";
        return $.ajax({
            type: 'POST',
            data:'iCsId='+iCsId+'&vNip='+vNip+'&iCsDetailId='+iCsDetailId, 
            url: url,
            async:false
        }).responseText
    }

    function  edit_data_personil(id) {
        var iJenisPerDinas = parseInt($('#iJenisPerDinas').val());
        var iCsId            = $('#iCsId').val();

        var data_personil_cs = getEditDataPersonilCS(id);
        var rowDataPscs      = JSON.parse(data_personil_cs);

       
        $('#iCsDetailId').val(rowDataPscs['id']).trigger('change');
        $('#vNip_cs').val(rowDataPscs['vNip']).trigger('change');
        $('#dPerjalananStart').val(rowDataPscs['dPerjalananStart']);
        $('#dPerjalananEnd').val(rowDataPscs['dPerjalananEnd']);
        $('#iAlatAngkut').val(rowDataPscs['iAlatAngkut']).trigger('change');
        $('#iOpsiHariLibur').val(rowDataPscs['iOpsiHariLibur']).trigger('change');
        $('#iOpsiHariSabtu').val(rowDataPscs['iOpsiHariSabtu']).trigger('change');
        $('#iOpsiHariMinggu').val(rowDataPscs['iOpsiHariMinggu']).trigger('change');
        
        $('#nBiayaUangHarian').val(rowDataPscs['nBiayaUangHarian']);
        $('#nBiayaRepre').val(rowDataPscs['nBiayaRepre']);
        $('#nBiayaTransport').val(rowDataPscs['nBiayaTransport']);
        $('#iJenisAkomodasi').val(rowDataPscs['iJenisAkomodasi']).trigger('change');
        $('#nBiayaPenginapan').val(rowDataPscs['nBiayaPenginapan']);
        $('#nHonorJasa').val(rowDataPscs['nHonorJasa']);

        

        $('#div_nBiayaUangHarian').hide();
        $('#div_nBiayaRepre').hide();
        $('#div_nBiayaTransport').hide();
        $('#div_nBiayaPenginapan').hide();
        $('#div_nHonorJasa').hide();
        $('#div_iJenisAkomodasi').hide();

        

        //if (iJenisPerDinas==1){
            
            $('#div_nBiayaUangHarian').show();
            $('#div_nBiayaRepre').show();
            $('#div_nBiayaTransport').show();
            $('#div_nBiayaPenginapan').show();
            $('#div_nHonorJasa').show();
            $('#div_iJenisAkomodasi').show();
       /* }else if (iJenisPerDinas==2){
            $('#div_nBiayaUangHarian').show();
        }*/

        $('#nBiayaUangHarian').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nBiayaRepre').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nBiayaTransport').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nBiayaPenginapan').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        $('#nHonorJasa').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

        $('.dialog_personil').modal({
            backdrop: 'static',
            keyboard: false
            })


        $('.dialog_personil').modal('show');

    }

    function hapus_data_personil(id) {
        var iJenisPerDinas = parseInt($('#iJenisPerDinas').val());
        var iCsId            = $('#iCsId').val();

        var url = "<?php echo site_url().'/cost_sheet/hapusDataPersonilCS'; ?>";
        var jwb = confirm("Hapus data ini ?");
        if (jwb==1){
            $.post(url, {
                id:id}, function(data) {
                if (data > 0) {
                    custom_alert('','Data berhasil dihapus','success');
                    var tabel_personil = getTablePeronilCS(iCsId,iJenisPerDinas);
                    $('#div_list_personil').html(tabel_personil);
                    $('.dialog_personil').modal('hide');
                    return false;
                } else {
                   custom_alert('','Data gagal dihapus','error');
                   return false;
                }
                
            }); 
        }
    }

    
    function getEditDataPersonilCS(id) {
        var url = "<?php echo site_url().'/cost_sheet/getEditDataPersonilCS'; ?>";
        return $.ajax({
            type: 'POST',
            data:'id='+id, 
            url: url,
            async:false
        }).responseText
    }


    function cetak_cs() {
        $('.dialog_cetak').modal('show');
    }

     function proses_cetak_cs() {
        var iCsId       = $('#iCsId').val();
        var iStId       = $('#iStId').val();
        var nipDalnis   = $('#nipDalnis').val();
        var nipKabag    = $('#nipKabag').val();
        var iKabag      = $('#iKabag').val();
        var nipiKaPer   = $('#nipiKaPer').val();
        var iKaPer      = $('#iKaPer').val();
        var diKelurkandi = $('#diKelurkandi').val();
        var dKeluarkanTgl = $('#dKeluarkanTgl').val();
        var nipKorwas   = $('#nipKorwas').val();
        var nipp3a      = $('#nipp3a').val();
        var niptu       = $('#niptu').val();
        var nipkeuangan = $('#nipkeuangan').val();

        if (nipDalnis == "" || nipKabag == "" || iKabag == "" || nipiKaPer == "" || iKaPer == "" || diKelurkandi == "" || dKeluarkanTgl == "" || nipKorwas == "" || nipp3a == "" || niptu == "" || nipkeuangan == "" ){
            custom_alert("Lengkapi Parameter Cetak ini");
            return false
        }

        var url = "<?php echo site_url().'/st/cetakCs?iCsId='; ?>"+iCsId+"&nipDalnis="+nipDalnis+"&nipKabag="+nipKabag+"&iKabag="+iKabag+"&nipiKaPer="+nipiKaPer+"&iKaPer="+iKaPer+'&diKelurkandi='+diKelurkandi+'&dKeluarkanTgl='+dKeluarkanTgl+"&nipKorwas="+nipKorwas+"&nipp3a="+nipp3a+"&niptu="+niptu+"&nipkeuangan="+nipkeuangan+"&iStId="+iStId;

        var jwb = confirm('Cetak Data Cost Sheet ?');

        if (jwb==1){
            document.getElementById('iframe_preview').src = url;
        }
    } 



     function batal_cetak() {
        $('.dialog_cetak').modal('hide');
     }

</script>