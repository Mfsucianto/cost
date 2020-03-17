<?php 
$this->load->view('template/head');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');


?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View SPD
        <small></small>
    </h1>
   
</section>

<!-- Main content -->
<section class="content" id="sec_spd" >

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                
               
            </div>
        </div>
        <div class="box-body">
            <div >
                <form class="form-horizontal" id="form_data" name="form_data" autocomplete="off">

                

                <?php

                    $datatmcs = array();
                    $sql = "select a.vNip,a.vName from cost.ms_pegawai as a WHERE a.lDeleted=0 ";
                    $query  = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result_array() as $row) {
                            $datatmcs[$row['vNip']] = $row['vName'];
                        }
                    }
                    echo $this->lib_util->drawcombo('vNip','NIP / Nama ',$datatmcs,'300px');


                    
                    echo $this->lib_util->drawFiledText('ID ST','iBarcode','300px');
                    /*echo '<div class="form-group" id="div_iBarcode">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 300;">ID ST</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <input type="text" readonly id="iBarcode" name="iBarcode" class="form-control">
                                        <span class="input-group-btn">
                                          <button type="button" onclick="search()"  class="btn btn-info btn-flat" >Search</button>
                                        </span>
                                </div>
                                
                              </div>
                            </div>';*/

                    echo $this->lib_util->drawFiledText('Nomor Cost Sheet','vNomorCs','300px');

                   
                     echo '<div class="form-group" id="div_iDipaId">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;"></label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">

                                   <a class="btn btn-app" onclick="searchSPD()">
                                        <i class="fa fa-search"   ></i> Cari
                                    </a>

                                    <a class="btn btn-app" onclick="monitoringSPD()">
                                        <i class="fa fa-video-camera"  ></i> Monitoring SPD
                                    </a>
                                </div>
                                
                              </div>
                            </div>';
                ?>
                

            </form>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->





<section class="content" style="display: none;" id="section_list_spd">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title" id="box_title_list" >List SPD</h3>
            <div class="box-tools pull-right">
            
            </div>
        </div>
        <div class="box-body">
            <div id="isi_table" >
                
            </div>
        </div><!-- /.box-body -->
       
    </div><!-- /.box -->

</section><!-- /.content -->




<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <div class="modal-header" style="background-color: gray;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myLargeModalLabel"></h4>
    </div>
    <div class="modal-body" id="list_data">
        <form class="form-horizontal" id="form_data" name="form_data" autocomplete="off">
            <?php
                echo '<input type="hidden" readonly class="form-control input-sm" id="id" name="id" value="">';

                 echo '<legend>Cetak SPD</legend>';
                 echo $this->lib_util->drawcombo('iHalaman','Halaman Depan',array(1=>'Halaman Depan'));
                 echo $this->lib_util->drawcombo('pejabatTTD','Pejabat Yang Bertandatangan',array(1=>'Penjabat Pembuat Komitmen'));

                 echo '<legend>Pejabat Penandatangan</legend>';

                $datatmcs = array();
                $sql = "select a.vNip,a.vName FROM cost.ms_pegawai as a  where a.lDeleted=0 ";
                $query  = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    foreach($query->result_array() as $row) {
                        $datatmcs[$row['vNip']] = $row['vName'];
                    }
                }
                echo $this->lib_util->drawcombo('vNip_ppk','NIP/Nama PPK',$datatmcs,'300px');
                echo $this->lib_util->drawFiledText('Jabatan Baris 1','jabatan1','300px');
                echo $this->lib_util->drawFiledText('Jabatan Baris 2','jabatan2','300px');

                 echo '<legend>Detail Data</legend>';

                echo $this->lib_util->drawFiledText('Nomor SPD','vNoSPPD','300px');
                echo $this->lib_util->drawFiledText('Tanggal SPD','dTglSPPD','100px');
                echo $this->lib_util->drawFiledText('Jenis SPD','vJenisSPD','100px');
                echo $this->lib_util->drawcombo('iJenisAkomodasi','Jenis Akomodasi ',array(0=>'',1=>'Fullboard',2=>'Non Fullboard'));
                echo $this->lib_util->drawFiledText('NIP / Nama','vNip','100px');

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

                echo $this->lib_util->drawFiledText('Kota Asal','vDari','200px');
                echo $this->lib_util->drawFiledText('Kota Tujuan','vTujuan','200px');
                echo $this->lib_util->drawcombo('iAlatAngkut','Alat Angkutan ',
                    array(0=>'', 1=>'Pesawat Terbang', 
                                2=>'Kapal Laut', 
                                3=>'Kendaraan Umum', 
                                4=>'Kereta API', 
                                5=>'Kendaraan Dinas') ,'300px'); 

                echo $this->lib_util->drawcombo('iSumberDana','Sumber Dana Yang Akan Diajukan',
                        array(0=>'',1=>'DIPA PERWAKILAN',
                                    2=>'SKPA',
                                    3=>'DROPING',
                                    4=>'PIHAK III',
                                    5=>'UNIT BPKP LAIN',
                                    6=>'SHARING'),'300px');

                echo $this->lib_util->drawFiledTextarea('Maksud Perjalanan','vUraianPenugasan');

                echo $this->lib_util->drawFiledText('Dikeluarkan Di ','diKelurkandi','200px');
                echo $this->lib_util->drawFiledText('Tanggal ','dKeluarkanTgl','100px');

                ?>

        </form>
    </div>

    <div class="modal-footer" style="background-color: gray;">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline "  onclick="cetakDataSPD()" >Cetak SPD</button>
        <button type="button" onclick="simpanData()" class="btn btn-outline">Save</button>
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script src="<?php echo base_url('assets/js/simpleupload.js') ?>" type="text/javascript"></script>
<?php
$this->load->view('template/foot');
?>



<script type="text/javascript">

    $(document).ready(function() {
       
    });


    function cetakDataSPD() {
        var id = $('#id').val();
        var iHalaman = $('#iHalaman').val();
        var pejabatTTD = $('#pejabatTTD').val();
        var vNip_ppk = $('#vNip_ppk').val();
        var jabatan1 = $('#jabatan1').val();
        var jabatan2 = $('#jabatan2').val();
        var diKelurkandi = $('#diKelurkandi').val();
        var dKeluarkanTgl = $('#dKeluarkanTgl').val();



    }
   
   function searchSPD() {
        var iBarcode = $('#iBarcode').val(); 
        var vNomorCs = $('#vNomorCs').val();

        if (iBarcode==''){
            custom_alert('','Masukan ID ST');
            return false
        }

        $('#section_list_spd').show(200);
        $('#isi_table').html('<center>--please wait while colecting data--</center>');
        refreshData();

   }


    function refreshData(){
        var data = loadData();
        $('#isi_table').html(data);
        $('#example1').DataTable();
    }

    function loadData(){
        var iBarcode = $('#iBarcode').val(); 
        var vNomorCs = $('#vNomorCs').val();
        var url = "<?php echo site_url().'/spd/getData'; ?>";
        return $.ajax({
            type: 'POST',
            data: 'iBarcode='+iBarcode+'&vNomorCs='+vNomorCs, 
            url: url,
            async:false
        }).responseText
    }

   

    function simpanData(){
        var id = $('#id').val();
        var vNoSPPD = $('#vNoSPPD').val()
        var dTglSPPD = $('#dTglSPPD').val()
        var vJenisSPD = $('#vJenisSPD').val()
        
        if (vNoSPPD==''){
            custom_alert('','Lengkapi Nomor SPD');
            return false;
        }

        if (dTglSPPD==''){
            custom_alert('','Lengkapi Tanggal SPD');
            return false;
        }

        if (vJenisSPD==''){
            custom_alert('','Lengkapi Jenis SPD');
            return false;
        }

        var url = "<?php echo site_url().'/spd/simpanData'; ?>";
        var jwb = confirm("Simpan data ini ?");
        if (jwb==1){

            $.ajax({
                url: url,
                type: 'post',
                data: 'id='+id+'&vNoSPPD='+vNoSPPD+'&dTglSPPD='+dTglSPPD+'&vJenisSPD='+vJenisSPD,
                success: function(data) {
                    if (data == 1) {
                        custom_alert('',"Data berhasil disimpan",'success');
                        refreshData();
                        $('#modal-info').modal('toggle');
                        return false;
                    }else {
                       alert("Data Gagal disimpan");
                       return false;
                    }
                }
            })
           
        }
    }

    function edit(id){
        
        $('.bs-example-modal-lg').modal({
            backdrop: 'static',
            keyboard: false
            })


        var list_data = getFormDataSPD(id);
        rowData  = JSON.parse(list_data);

        $('#id').val(id).val();
        $('#vNoSPPD').val(rowData['vNoSPPD']).val();
        $('#vJenisSPD').val(rowData['vJenisSPD']).val();
        $('#dTglSPPD').val(rowData['dTglSPPD']).val();
        $('#iJenisAkomodasi').val(rowData['iJenisAkomodasi']).trigger('change');
        $('#vNip').val(rowData['vNip']);
        $('#dPerjalananStart').val(rowData['dPerjalananStart']);
        $('#dPerjalananEnd').val(rowData['dPerjalananEnd']);
        $('#vDari').val(rowData['vDari']);
        $('#vTujuan').val(rowData['vTujuan']);
        $('#vUraianPenugasan').val(rowData['vUraianPenugasan']);
        $('#iAlatAngkut').val(rowData['iAlatAngkut']).trigger('change');
        $('#iSumberDana').val(rowData['iSumberDana']).trigger('change');

        $('.bs-example-modal-lg').modal('show');

        $("#iJenisAkomodasi").prop('disabled', true);
        $("#vNip").prop('disabled', true);
        $("#dPerjalananStart").prop('disabled', true);
        $("#dPerjalananEnd").prop('disabled', true);
        $("#vDari").prop('disabled', true);
        $("#vTujuan").prop('disabled', true);
        $("#iAlatAngkut").prop('disabled', true);
        $("#iSumberDana").prop('disabled', true);
        $("#vUraianPenugasan").prop('disabled', true);

        // iJenisAkomodasi
        // vNip
        // dPerjalananStart
        // dPerjalananEnd
        // vDari
        // vTujuan
        // iAlatAngkut
        // iSumberDana

        $('#dTglSPPD').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true
      
        });

    }



    function getFormDataSPD(id) {
         var url = "<?php echo site_url().'/spd/getFormDataSPD'; ?>";
        return $.ajax({
            type: 'POST', 
            url: url,
            data:'id='+id,
            async:false
        }).responseText
    }

   
    function monitoringSPD() {
        $('#sec_spd').hide(200);
        $('#sec_monitoring').show(200);
        $('#section_list_spd').hide();
        $('#isi_table').html('');
    }

    
    function searchMonitoring() {
        if ($('#cTahun')==''){
            custom_alert('','Masukan Tahun');
            return false;
        }

         $('#section_list_spd').show();
         $('#isi_table').html('<center>--please wait while colecting data--</center>');

        var data = loadDataMonitoring();
        $('#isi_table').html(data);
        
        $('#example1').DataTable({
            scrollY:        300,
            scrollX:        true,
            scrollCollapse: true,
            fixedColumns:   {
                leftColumns: 3,
                rightColumns: 0,
            }
        });

    }

    function loadDataMonitoring(){
        var cTahun = $('#cTahun').val(); 
        var iBidangId = $('#iBidangId').val();
        var url = "<?php echo site_url().'/spd/loadDataMonitoring'; ?>";
        return $.ajax({
            type: 'POST',
            data: 'cTahun='+cTahun+'&iBidangId='+iBidangId, 
            url: url,
            async:false
        }).responseText
    }

    
</script>