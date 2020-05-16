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

$listChange = array();
if (isset($dataFrom['changeFiled'])){
    foreach ($dataFrom['changeFiled'] as $key => $value) {
       $listChange[] = $key;
    }
}




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
          <h4 class="box-title title" style="font-size: 15px;font-weight: bold;">Tambah Data Pegawai</h4>

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
                            id="iPegawaiId" name="iPegawaiId" value="0">';

                    
                     $addList = array(
                            'vNip'      => 'Nomor Induk Pegawai',
                            'vName'     => 'Nama Lengkap ',
                            'cSex'      => 'Jenis Kelamin ',
                            'vGelar'    => 'Gelar ',
                            'iJabatanId' => 'Jabatan ',
                            'cGolongan' => 'Golongan ',
                            'nGolTarif' => 'Golongan Tarif ',
                            'iBidangId' => 'Bidang ',
                            'iSubBidangId' => 'Sub Bidang ',
                            'iPeran'    => 'Peran ',
                            'cUserId'   => 'User ID ',
                            'vPassword' => 'Password ',
                            'vImage'    => 'Photo '
                        );

                     echo $this->lib_util->drawFiledText('Nomor Induk Pegawai','vNip','300px');
                     echo $this->lib_util->drawFiledText('Nama Lengkap','vName');
                     echo $this->lib_util->drawcombo('cSex','Jenis Kelamin',array(''=>'','L'=>'Laki-Laki','P'=>'Perempuan'),'200px');
                     echo $this->lib_util->drawFiledText('Gelar','vGelar','300px');


                    $datchg = array();
                    $sql = "SELECT iJabatanId,vJabatanName FROM  ms_jabatan order by vJabatanName ASC";
                    $query  = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result_array() as $row) {
                            $datchg[$row['iJabatanId']] = $row['vJabatanName'];
                        }
                    }

                    echo $this->lib_util->drawcombo('iJabatanId','Jabatan',$datchg,'300px');
                    echo $this->lib_util->drawFiledText('Golongan','cGolongan','300px');
                    echo $this->lib_util->drawFiledText('Golongan Tarif','nGolTarif','300px');


                    $datchgbid = array();
                    $sql = "SELECT iBidangId,vBidangName FROM  ms_bidang order by vBidangName ASC";
                    $query  = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result_array() as $row) {
                            $datchgbid[$row['iBidangId']] = $row['vBidangName'];
                        }
                    }

                    echo $this->lib_util->drawcombo('iBidangId','Bidang',$datchgbid,'300px');

                    $datchgsubbid = array();
                    $sql = "SELECT iSubBidangId,vSubBidangName FROM cost.ms_sub_bidang WHERE lDeleted=0";
                    $query  = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result_array() as $row) {
                            $datchgsubbid[$row['iSubBidangId']] = $row['vSubBidangName'];
                        }
                    }
                    echo $this->lib_util->drawcombo('iSubBidangId','Sub Bidang',$datchgsubbid,'300px');


                    echo $this->lib_util->drawcombo('iPeran','Peran',array(0=>'',1=>'Admin',2=>'Pegawai',3=>'Kepala Bagian',4=>'Sub Bagian',5=>'Skretaris Bidang',6=>'Kepala Perwakilan'),'300px');

                    echo "<legend></legend>";

                    echo $this->lib_util->drawFiledText('User Id','cUserId','300px');
                    echo $this->lib_util->drawFiledText('Password','vPassword','300px');

                ?>
                    <div class="form-group">
                      <label for="vImage" class="col-sm-4 control-label">Foto</label>
                      <div class="col-sm-7">
                        <input type="file" class="form-control input-sm" id="vImage" name="vImage" placeholder="User Image">

                        <input type="hidden" class="form-control input-sm" id="uniqid" name="uniqid" value="" >
                        <div class="pull-left image">
                            <img id="imagePleace" name='imagePleace' src='<?php echo base_url()."/images/user/logo.png";  ?>' 
                            class="img-circle" alt="User Image" style="width: 200px;
                                                                height: 200px;
                                                                border: solid 2px #534E4E;
                                                                padding: 2px;" />
                        </div>
                        <div id="filename"></div>
                        <div id="progress"></div>
                        <div id="'progressBar"></div>

                      </div>
                    </div>
                    
                    
                   

            </form>

        </div>
        <!-- /.box-body -->

        <div  class="box-footer">
            <button type="button" class="btn btn-warning" onclick="batal()" >Cancel</button>
            <button type="button" onclick="simpanData()" class="btn btn-info pull-right">Save</button>
        </div>
    </div>
</section>





<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script src="<?php echo base_url('assets/js/simpleupload.js') ?>" type="text/javascript"></script>

<?php
$this->load->view('template/foot');
?>



<script type="text/javascript">
    $(function () {
        $('input[type=file]').change(function(){

            var url = "<?php echo site_url() ?>";       
            var url = url+"/pegawai/uploadFile/<?php echo $uniqid ?>";
            $(this).simpleUpload(url, {
                allowedExts: ['jpeg','png','gif','jpg'],
                allowedTypes: ['image/pjpeg', 'image/jpeg', 'image/png', 'image/x-png', 'image/gif', 'image/x-gif'],
                
                maxFileSize: 5000000, //5MB in bytes
                

                start: function(file){
                    //upload started
                    //$('#filename').html(file.name);
                    $('#progress').html('');
                    $('#progressBar').width(0);
                },

                progress: function(progress){
                    //received progress
                    //$('#progress').html('Progress: ' + Math.round(progress) + '%');
                    $('#progressBar').width(progress + '%');
                },

                success: function(data){
                    //upload successful
                    //$('#progress').html('Success!<br>Data: ' + JSON.stringify(data));
                    $('#uniqid').val(data);
                    var src = "../images/user/"+data;
                    $('#imagePleace').show();
                    var imagePleace = document.getElementById('imagePleace');
                    imagePleace.src = src;
                },

                error: function(error){
                    //upload failed
                    $('#progress').html('Failure!<br>' + error.name + ': ' + error.message);
                    alert('Failure ' + error.name + ' : ' + error.message);
                    $('#filename').html('');
                }

            });

        });

    });
    $(document).ready(function() {
        refreshData();

        //$('#nGolTarif').autoNumeric('init', {vMin:'-999999999999999999', vMax:'999999999999999999'});

        $( "#iBidangId" ).change(function() {
            
           $('#iSubBidangId').val('').trigger('change');
           if ($(this).val()==1){
                $('#div_iSubBidangId').show();
           }else{

                $('#div_iSubBidangId').hide();
           }    
        });
    });



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


        $('#cSex').val('').trigger('change');
        $('#iJabatanId').val('').trigger('change');
        $('#iBidangId').val('').trigger('change');
        $('#iSubBidangId').val('').trigger('change');
        $('#iPeran').val('').trigger('change');

        $('#cUserId').val('');
        $('#vPassword').val('');

        $('#section_list').hide();
        $('#from_add').show();
        $('#imagePleace').hide();
        
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
            if ($('#'+arrFiled[i]).val()=='' && arrFiled[i]!='iSubBidangId'){
                
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
        var iPegawaiId  = $('#iPegawaiId').val();
        var cNip        = $('#vNip').val();
        var cUserId     = $('#cUserId').val();
        var vPassword   = $('#vPassword').val();

        var ada = checkNip(cNip,iPegawaiId);
        if (ada=='ADA'){
            alert("NIP "+cNip+ " Sudah terdaftar");
            return false;
        }
        
        if (cUserId!="" && vPassword=="" && iPegawaiId==0){
            alert("Masukan Password");
            return false;
        }
        
        if (cUserId!=""){
            var adaUserId = cekUserId(cUserId,iPegawaiId);
            if (adaUserId=='ADA'){
                alert("User ID "+cUserId+ " Sudah terpakai");
                return false;
            }
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

        var vImage      = rowData['vImage'].trim();
       
        if (vImage!=''){
            var src = "../images/user/"+vImage;
            $('#imagePleace').show();
            var imagePleace = document.getElementById('imagePleace');
            imagePleace.src = src;
        }else{
            $('#imagePleace').hide();
        }

        $('#cUserId').val(rowData['cUserId']);
        $('#vPassword').val(rowData['vPassword']);
       
    }


    function checkNip(nip,iPegawaiId) {
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/checkNip'; ?>";
        return $.ajax({
            type: 'POST',
            data:'nip='+nip+'&iPegawaiId='+iPegawaiId, 
            url: url,
            async:false
        }).responseText
    }

    function cekUserId(userid,iPegawaiId) {
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/cekUserId'; ?>";
        return $.ajax({
            type: 'POST',
            data:'userid='+userid+'&iPegawaiId='+iPegawaiId, 
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
</script>