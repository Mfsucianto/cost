<?php 
$this->load->view('template/head');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
$uniqid = uniqid();

$dataFrom   = $this->dataFrom;
$caption    = $dataFrom['caption'];

$arryFildJs = '[';
$arryCapFildJs = '[';
$x= '';
$y= '';
foreach ($dataFrom['addList'] as $f => $c) {
    $x.= '"'.$f.'",';
    $y.= '"'.$c.'",';
}

$x = rtrim($x,",");
$y = rtrim($y,",");

$arryFildJs .= $x;
$arryFildJs .= ']';

$arryCapFildJs .= $y;
$arryCapFildJs .= ']';






?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $caption; ?>
        <small></small>
    </h1>
   
</section>

<!-- Main content -->
<section class="content" id="section_list">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                
                <button onclick="tambah()" class="btn btn-info"  ><i class="fa fa-plus"> Tambah</i></button>
            </div>
        </div>
        <div class="box-body">
            <div id="isi_table" >
                <center>--please wait while generating data--</center> 
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->



<section class="content" id="from_add" style="display: none;">
    <div class="box box-info box-solid">
        <div class="box-header with-border">
          <h4 class="box-title title" style="font-size: 15px;font-weight: bold;">Tambah Data DIPA</h4>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
            <form class="form-horizontal" id="form_data" name="form_data" autocomplete="off">
                <?php
                    echo '<input type="hidden" readonly class="form-control input-sm" id="id" name="id" value="0">';
                    echo '<input type="hidden" readonly class="form-control input-sm" id="fJumlahAnggaran" value="0">';
                    echo '<input type="hidden" readonly class="form-control input-sm" id="iDipaId" name="iDipaId" value="0">';

                    

                    echo $this->lib_util->drawFiledText('Tahun','cTahun','100px');
                   
                    echo '<div class="form-group">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Nomor Unit Pelaksana</label>
                              <div class="col-sm-7">
                                <input type="text" style="width:100px;" readonly class="form-control input-sm" id="vUnitPelaksana" name=""  value="204" >
                               
                              </div>
                            </div>';

                    $datchgbid = array();
                    $sql = "SELECT iBidangId,vBidangName FROM  ms_bidang order by vBidangName ASC";
                    $query  = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result_array() as $row) {
                            $datchgbid[$row['iBidangId']] = $row['vBidangName'];
                        }
                    }

                   
                    echo $this->lib_util->drawcombo('iBidangId','Bidang',$datchgbid,'300px');

                  

                    echo '<div class="form-group">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Kode DIPA</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <input type="text" readonly id="text_iDipaId" class="form-control">
                                        <span class="input-group-btn">
                                          <button type="button" onclick="searchDIPA()"  class="btn btn-info btn-flat" >Search</button>
                                        </span>
                                </div>
                                
                              </div>
                            </div>';

                   /* echo $this->lib_util->drawcombo('iDipaId','Kode DIPA',$dataDipa,'300px');*/
                    echo $this->lib_util->drawFiledText('Nomor RKT','cNomorRkt','300px');
                    echo $this->lib_util->drawFiledText('Kode Akun','cKodeAccount','100px');
                    echo $this->lib_util->drawFiledText('Kode RKT','cKodeRkt','300px');
                    echo $this->lib_util->drawFiledText('Nama Item','cNamaItem');
                    echo $this->lib_util->drawcombo('cKelompok','Kelompok Kegiatan',array(''=>'',
                                    'kelompok kegiatan Instansi Pemerintah Pusat' => 'kelompok kegiatan Instansi Pemerintah Pusat', 
                                    'kelompok kegiatan Akuntabilitas Pemda' => 'kelompok kegiatan Akuntabilitas Pemda', 
                                    'kelompok kegiatan Akuntan Negara' => 'kelompok kegiatan Akuntan Negara', 
                                    'kelompok kegiatan investigasi' => 'kelompok kegiatan investigasi', 
                                    'Kelompok kegiatan Program' => 'Kelompok kegiatan Program', 
                                    'Pelaporan dan Pembinaan APIP' => 'Pelaporan dan Pembinaan APIP', 
                                    'Kelompok kegiatan Sub Bagian Keuangan' => 'Kelompok kegiatan Sub Bagian Keuangan', 
                                    'Kelompok kegiatan Sub Bagian Kepegawaian' => 'Kelompok kegiatan Sub Bagian Kepegawaian', 
                                    'Kelompok Bagian sub Bagian Umum' => 'Kelompok Bagian sub Bagian Umum', 
                                    'Kelompok kegiatan Tatausaha' => 'Kelompok kegiatan Tatausaha'
                                ));



                    echo $this->lib_util->drawcombo('iJenis','PKPT/PKAU',array(''=>'',0=>'0 PKAU',1=>'1 PKAU',2=>'PKPT'),'100px');
                    echo $this->lib_util->drawFiledText('Jumlah Rencana Penugasan','iJumlahRencana','150px');
                    echo $this->lib_util->drawFiledText('Jumlah Anggaran (Rp.)','fAnggaran','150px');


                   

                ?>
                    

            </form>

        </div>
        <!-- /.box-body -->

        <div  class="box-footer">
            <button type="button" class="btn btn-warning" onclick="batal()" >Cancel</button>
            <button type="button" onclick="simpanData()" class="btn btn-info pull-right">Save</button>
        </div>
    </div>



</section>



<!--  Modal content for the above example -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">List DIPA</h4>
        </div>
        <div class="modal-body" id="list_data_dipa">
           
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->



<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->

<?php
$this->load->view('template/foot');
?>



<script type="text/javascript">
    
    $(document).ready(function() {
        refreshData();

        $('#iJumlahRencana').autoNumeric('init', {vMin:'0', vMax:'99999'});
        $('#fAnggaran').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});

       
    });


    function  searchDIPA() {
        var cTahun    = $('#cTahun').val();
        var iBidangId = $('#iBidangId').val();

        if (cTahun==''){
            custom_alert('Lengkapi Tahun terlebih dahulu');
            return false;
        }

        if (iBidangId==''){
            custom_alert('Pilih Bidang terlebih dahulu');
            return false;
        }


        $('.bs-example-modal-lg').modal({
            backdrop: 'static',
            keyboard: false
            })
        
        //$('#list_data_dipa').html('<center>Mohon tunggu, sedang menyiapkan data</center>')

        var list_data = getListDataDipa(cTahun,iBidangId);
        $('#list_data_dipa').html(list_data);
        $('#list_popup').DataTable({
            "bSort": false
        });



        $('.bs-example-modal-lg').modal('show');
    }

    function getListDataDipa(cTahun,iBidangId){
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/getListDataDipa'; ?>";
        return $.ajax({
            type: 'POST', 
            url: url,
            data:'cTahun='+cTahun+'&iBidangId='+iBidangId,
            async:false
        }).responseText
    }

    function batal() {
        $('#from_add').hide();
        $('#section_list').show();
    }

    function tambah(){
         $('.title').html('Tambah <?php echo $caption; ?>');
        $('#<?php echo $dataFrom["primaryKey"]; ?>').val('0');
        var arrFiled = JSON.parse('<?php echo $arryFildJs;?>');
        var arrayLength = arrFiled.length;
        for (var i = 0; i < arrayLength; i++) {
            $('#'+arrFiled[i]).val('');
        }

        $('#iBidangId').trigger('change');
        $('#iJenis').trigger('change');
        $('#text_iDipaId').val('');
        $('#vUnitPelaksana').val('204');
        $('#section_list').hide();
        $('#from_add').show();
        
    }


    function refreshData(){
        var data = loadData();
        $('#isi_table').html(data);
        $('#example1').DataTable({
            scrollY:        300,
            scrollX:        true,
            scrollCollapse: true,
            fixedColumns:   {
                leftColumns: 2,
                rightColumns: 0,
            }
        });
    }

    function loadData(){
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/getData'; ?>";
        return $.ajax({
            type: 'POST', 
            url: url,
            async:false
        }).responseText
    }

   

    function simpanData(){
        var arrFiled        = JSON.parse('<?php echo $arryFildJs;?>');
        var arryCapFildJs   = JSON.parse('<?php echo $arryCapFildJs;?>');

        var arrayLength = arrFiled.length;
        for (var i = 0; i < arrayLength; i++) {
            if ($('#'+arrFiled[i]).val()==''){
                
                custom_alert('Mohon Lengkapi '+arryCapFildJs[i]);
                $('#'+arrFiled[i]).focus();
                return false;
            }


        }

        //cek NIP sudah pernah ada apa belum

        var id   = $('#id').val();
        var fAnggaran   = $('#fAnggaran').val();
        var iDipaId   = $('#iDipaId').val();
        
        var ada = cekPlafon(iDipaId,fAnggaran,id).trim();
        if (ada!=''){
            x_ada = ada.split('|');

            custom_alert(x_ada['0'],x_ada['1'],'error');
            return false;
        }
        
        

        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/simpanData'; ?>";
        var jwb = confirm("Simpan data ini ?");
        if (jwb==1){

            $.ajax({
                url: url,
                type: 'post',
                data: $('#form_data').serialize(),
                success: function(data) {
                    if (data == 1) {
                        alert("Data berhasil disimpan");
                         $('#section_list').show();
                         $('#from_add').hide();
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
        $('#section_list').hide();
        $('#from_add').show();
        var data = loadDataEdit(id);
        rowData  = JSON.parse(data);
        $('.title').html('Ubah <?php echo $caption; ?>');

        $('#<?php echo $dataFrom["primaryKey"]; ?>').val(rowData['<?php echo $dataFrom["primaryKey"]; ?>']);
        var arrFiled = JSON.parse('<?php echo $arryFildJs;?>');
        var arrayLength = arrFiled.length;
        for (var i = 0; i < arrayLength; i++) {

            $('#'+arrFiled[i]).val(rowData[arrFiled[i]]).trigger('change');
        }

        
       $('#text_iDipaId').val(rowData['text_iDipaId']);
    }


    function cekPlafon(iDipaId,fAnggaran,id) {
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/cekPlafon'; ?>";
        return $.ajax({
            type: 'POST',
            data:'iDipaId='+iDipaId+'&fAnggaran='+fAnggaran+'&id='+id, 
            url: url,
            async:false
        }).responseText
    }

   

    function loadDataEdit(id){
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/getDataEdit'; ?>";
        return $.ajax({
            type: 'POST',
            data:'id='+id, 
            url: url,
            async:false
        }).responseText
    }

    function hapus(id){
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/hapusData'; ?>";
        var jwb = confirm("Hapus data ini ?");
        if (jwb==1){
            $.post(url, {
                id:id}, function(data) {
                if (data > 0) {
                    alert("Success..");
                    refreshData();
                    return false;
                } else {
                   alert("Faild");
                   return false;
                }
                
            }); 
        }
    }
    function  select_row(id,cTahun,cKodeDipa,fJumlahAnggaran,vNamaItem) {
       $('#text_iDipaId').val(cKodeDipa+' - '+vNamaItem);
       $('#iDipaId').val(id);
       $('#fJumlahAnggaran').val(fJumlahAnggaran);

       $('.bs-example-modal-lg').modal('hide')
    }
</script>