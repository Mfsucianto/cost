<?php 
$this->load->view('template/head');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
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
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                
                <button onclick="tambah()" class="btn btn-info"  data-toggle="modal" data-target="#modal-info" ><i class="fa fa-plus"> Tambah</i></button>
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


<div class="modal modal-info fade" id="modal-info">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah <?php echo $caption; ?></h4>
          </div>
          <div class="modal-body">
             <form class="form-horizontal" id="form_data" name="form_data" autocomplete="off">

                

                <?php
                    echo '<input type="hidden" readonly class="form-control input-sm" 
                            id="'.$dataFrom['primaryKey'].'" name="'.$dataFrom['primaryKey'].'" value="0">';

                    foreach ($dataFrom['addList'] as $f => $c) {

                        if(in_array($f, $listChange)){
                            $frm = $this->lib_util->drawFiledCustom($f,$c,$dataFrom['changeFiled']);
                        }else{
                            $frm = $this->lib_util->drawFiledText($c,$f);
                        }

                        echo $frm;
                    }
                ?>
                

            </form>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
            <button type="button" onclick="simpanData()" class="btn btn-outline">Save</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

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
        refreshData();
    });

    function tambah(){
        $('#<?php echo $dataFrom["primaryKey"]; ?>').val('0');
        var arrFiled = JSON.parse('<?php echo $arryFildJs;?>');
        var arrayLength = arrFiled.length;
        for (var i = 0; i < arrayLength; i++) {
            $('#'+arrFiled[i]).val('');
        }
    }


    function refreshData(){
        var data = loadData();
        $('#isi_table').html(data);
        $('#example1').DataTable();
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
                alert('Lengkapi '+arryCapFildJs[i]);
                $('#'+arrFiled[i]).focus();
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
        var data = loadDataEdit(id);
        rowData  = JSON.parse(data);
        $('.modal-title').html('Edit <?php echo $caption; ?>');

        $('#<?php echo $dataFrom["primaryKey"]; ?>').val(rowData['<?php echo $dataFrom["primaryKey"]; ?>']);
        var arrFiled = JSON.parse('<?php echo $arryFildJs;?>');
        var arrayLength = arrFiled.length;
        for (var i = 0; i < arrayLength; i++) {
            $('#'+arrFiled[i]).val(rowData[arrFiled[i]]);
        }
       
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