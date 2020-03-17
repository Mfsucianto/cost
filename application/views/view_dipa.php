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
                    echo '<input type="hidden" readonly class="form-control input-sm" 
                            id="id" name="id" value="0">';

                    
                     

                    echo $this->lib_util->drawFiledText('Tahun','cTahun','100px');
                    $datchgbid = array();
                    $sql = "SELECT iBidangId,vBidangName FROM  ms_bidang order by vBidangName ASC";
                    $query  = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result_array() as $row) {
                            $datchgbid[$row['iBidangId']] = $row['vBidangName'];
                        }
                    }

                    echo $this->lib_util->drawcombo('iBidangId','Bidang',$datchgbid,'300px');
                    echo $this->lib_util->drawFiledText('Kode DIPA','cKodeDipa','300px');
                    echo $this->lib_util->drawFiledText('Nama Item','vNamaItem');
                    echo $this->lib_util->drawFiledText('Kode Akun','cKodeAccount','100px');

                    echo $this->lib_util->drawcombo('iJenis','PKPT/PKAU',array(''=>'',0=>'PKAU',1=>'PKPT',2=>'NON PKPT'),'100px');
                    echo $this->lib_util->drawFiledText('Jumlah Anggaran (Rp.)','fJumlahAnggaran','100px');


                   

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

<!-- =========================================View Content============================================== -->
<section class="content" id="from_view" style="display: none;">
    <div class="box box-info box-solid">
        <div class="box-header with-border">
          <h4 class="box-title title" style="font-size: 15px;font-weight: bold;">View Data DIPA</h4>

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
                    echo '<input type="hidden" readonly class="form-control input-sm" 
                            id="id" name="id" value="0">';
                    echo $this->lib_util->drawFiledLabel('Tahun','cTahun','');
                    echo $this->lib_util->drawFiledLabel('Bidang','iBidangId','');
                    echo $this->lib_util->drawFiledLabel('Kode DIPA','cKodeDipa','');
                    echo $this->lib_util->drawFiledLabel('Nama Item','vNamaItem');
                    echo $this->lib_util->drawFiledLabel('Kode Akun','cKodeAccount','');
                    echo $this->lib_util->drawFiledLabel('PKPT/PKAU','iJenis','');
                    echo $this->lib_util->drawFiledLabel('Jumlah Anggaran (Rp.)','fJumlahAnggaran','font-weight: bold;');
                    echo "<legend style='margin-bottom: 0px;border: 1px solid #87deec;'></legend>";
                    
                ?>
                    
                <div class="form-group">
                    <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Dialokasikan Ke RKT</label>
                    <div class="col-sm-7">
                        <span id="text_alokasi"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-sm-4 control-label" style="font-weight: 400;"> Saldo Yang Dapat dialokasikan</label>
                    <div class="col-sm-7">
                        <span id="text_tersedia"></span>
                    </div>
                </div>
                <legend style='margin-bottom: 0px;border: 1px solid #87deec;'></legend>
            </form>

        </div>
        <!-- /.box-body -->

        <div  class="box-footer">
            <button type="button" class="btn btn-warning" onclick="batal()" >Close</button>
        </div>
    </div>
</section>




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

        $('#fJumlahAnggaran').autoNumeric('init', {vMin:'-999999999999999999', vMax:'999999999999999999'});

       
    });

    function batal() {
        $('#from_add').hide();
        $('#from_view').hide();
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
                
                Swal.fire({
                  title: 'Lengkapi '+arryCapFildJs[i],
                  showClass: {
                    popup: 'animated fadeInDown faster'
                  },
                  hideClass: {
                    popup: 'animated fadeOutUp faster'
                  }
                })

                $('#'+arrFiled[i]).focus();
                return false;
            }


        }

        //cek NIP sudah pernah ada apa belum
        var id          = $('#id').val();
        var cTahun       = $('#cTahun').val();
        var cKodeDipa   = $('#cKodeDipa').val();
      
        var ada = checkKode(id,cKodeDipa,cTahun);
        if (ada=='ADA'){
            alert("Kode DIPA "+cKodeDipa+ " Sudah terdaftar");
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

        if (rowData['fAnggaran']!= '0'){
            custom_alert('Tidak dapat diedit','Data DIPA sudah terdapat RKT');
            $('#from_add').hide();
            view(id);
            return false;
        }

        $('.title').html('Ubah <?php echo $caption; ?>');

        $('#<?php echo $dataFrom["primaryKey"]; ?>').val(rowData['<?php echo $dataFrom["primaryKey"]; ?>']);
        var arrFiled = JSON.parse('<?php echo $arryFildJs;?>');
        var arrayLength = arrFiled.length;
        for (var i = 0; i < arrayLength; i++) {

            $('#'+arrFiled[i]).val(rowData[arrFiled[i]]).trigger('change');
        }
    }

    function view(id) {
        $('#section_list').hide();
        $('#from_view').show();
        var data = loadDataView(id);
        rowData  = JSON.parse(data);
        $('.title').html('Lihat <?php echo $caption; ?>');

        $('#<?php echo $dataFrom["primaryKey"]; ?>').val(rowData['<?php echo $dataFrom["primaryKey"]; ?>']);
        var arrFiled = JSON.parse('<?php echo $arryFildJs;?>');
        var arrayLength = arrFiled.length;
        for (var i = 0; i < arrayLength; i++) {
            $('#text_'+arrFiled[i]).html(rowData[arrFiled[i]]);
        }

        var iJenis = rowData['iJenis'];
        if (iJenis==0){
            $('#text_iJenis').html('PKAU');
        }else if (iJenis==1){
            $('#text_iJenis').html('PKPT');
        }else if (iJenis==2){
            $('#text_iJenis').html('NON PKPT');
        }

        $('#text_alokasi').html(rowData['fAnggaran']);
        $('#text_tersedia').html(rowData['tersedia']);
       
    }

    function  loadDataView(id) {
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/getDataView'; ?>";
        return $.ajax({
            type: 'POST',
            data:'id='+id, 
            url: url,
            async:false
        }).responseText
    }

    function checkKode(id,cKodeDipa,cTahun) {
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/checkKode'; ?>";
        return $.ajax({
            type: 'POST',
            data:'id='+id+'&cKodeDipa='+cKodeDipa+'&cTahun='+cTahun, 
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

    function hapus(id,anggaran_rkt){
        if (anggaran_rkt!= '0'){
            custom_alert('Tidak dapat dihapus','Data DIPA sudah terdapat RKT');
            return false;
        }
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
</script>