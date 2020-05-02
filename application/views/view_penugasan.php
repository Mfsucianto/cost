<?php 
$this->load->view('template/head');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');


?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Penugasan
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
            <h4 class="modal-title">Update Nomor ST</h4>
          </div>
          <div class="modal-body">
             <form class="form-horizontal" id="form_data" name="form_data" autocomplete="off">

                

                <?php
                    echo '<input type="hidden" readonly class="form-control input-sm" id="iStId" name="iStId" value="0">';
                    echo $this->lib_util->drawFiledText('Nomor ST','cNomorST','300px');
                    echo $this->lib_util->drawFiledText('Tanggal ST','dTglST','100px');
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

       
        var dateToday = new Date();
        $('#dTglST').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            endDate: dateToday
        });

    });

   


    function refreshData(){
        var data = loadData();
        $('#isi_table').html(data);
        $('#example1').DataTable({
            scrollY:        300,
            scrollX:        true,
            scrollCollapse: true
           
        });

        /*$('#example1').DataTable({
            scrollY:        300,
            scrollX:        true,
            scrollCollapse: true,
            fixedColumns:   {
                leftColumns: 1,
                rightColumns: 2,
            }
        });*/
    }

    function loadData(){
        var url = "<?php echo site_url().'/penugasan/getData'; ?>";
        return $.ajax({
            type: 'POST', 
            url: url,
            async:false
        }).responseText
    }

   

    function simpanData(){
       
        
        var url = "<?php echo site_url().'/penugasan/simpanData'; ?>";
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

    function edit(id,nomorst,tglst){
        
        $('.modal-title').html('Edit ST');

        $('#iStId').val(id);
        $('#cNomorST').val(nomorst);



        $('#dTglST').val(tglst);
    }

    function simpanData() {
        var iStId = $('#iStId').val();
        var cNomorST = $('#cNomorST').val();
        var dTglST = $('#dTglST').val();

        var url = "<?php echo site_url().'/penugasan/simpanData'; ?>";
        var jwb = confirm("Simpan data ini ?");
        if (jwb==1){

            $.ajax({
                url: url,
                type: 'post',
                data: 'iStId='+iStId+'&cNomorST='+cNomorST+'&dTglST='+dTglST,
                success: function(data) {
                    if (data > 0) {
                        custom_alert('','Data berhasil disimpan','success');
                        $('#modal-info').modal('toggle');
                        refreshData();
                        return false;
                    }else {
                       alert("Data Gagal disimpan");
                       return false;
                    }
                }
            })
           
        }
    }


   

    
</script>