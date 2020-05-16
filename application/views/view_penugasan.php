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
                   
                    echo '<div class="form-group" id="div_cNomorST">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Nomor ST</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <table >
                                        <tr>
                                            <td>
                                                <select class="select2" style="width:70px;" id="jenis_nomor_st" >
                                                    <option></option>
                                                    <option value="V" >V</option>
                                                    <option value="S" >S</option>
                                                    <option value="ST" >ST</option>
                                                </select> 
                                            </td>
                                            <td>
                                                -
                                            </td>
                                            <td>
                                                <input type="text"  id="nomor_urut_st" class="form-control input-sm" style="width:70px;">
                                            </td>
                                            <td>
                                                -
                                            </td>

                                            <td>
                                                <input type="hidden" readonly id="cNomorST" class="form-control input-sm">
                                                <input type="text" readonly id="nomor_tahun_st" class="form-control input-sm">
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    
                                    
                                </div>
                                
                              </div>
                            </div>';

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
        $('#nomor_urut_st').autoNumeric('init', {vMin:'0', vMax:'999999'});
       
        var dateToday = new Date();
        $('#dTglST').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            endDate: dateToday
        });

        $('#jenis_nomor_st').change(function() {
            var jenis_nomor_st = $('#jenis_nomor_st').val();
            var nomor_urut_st  = stripCharacters($('#nomor_urut_st').val());
            var nomor_tahun_st = $('#nomor_tahun_st').val();

            cNomorST = jenis_nomor_st+"-"+nomor_urut_st+nomor_tahun_st;
            if (jenis_nomor_st!='' && nomor_urut_st!='' ){
                $('#cNomorST').val(cNomorST);
            }else{
                $('#cNomorST').val('');
            }
            
        });

        $('#nomor_urut_st').keyup(function() {
            var jenis_nomor_st = $('#jenis_nomor_st').val();
            var nomor_urut_st  = stripCharacters($('#nomor_urut_st').val());
            var nomor_tahun_st = $('#nomor_tahun_st').val();

            cNomorST = jenis_nomor_st+"-"+nomor_urut_st+nomor_tahun_st;
            if (jenis_nomor_st!='' && nomor_urut_st!='' ){
                $('#cNomorST').val(cNomorST);
            }else{
                $('#cNomorST').val('');
            }
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

    function edit(id,nomorst,tglst,nomor_bidang){
        
        $('.modal-title').html('Edit ST');

        
        //ST-1/PW04/6/2020

        if (nomorst==''){
            tahun = new Date().getFullYear();

            $('#jenis_nomor_st').val('').trigger('change');
            $('#nomor_urut_st').val('');
            $('#nomor_tahun_st').val('/PW04/'+nomor_bidang+'/'+tahun);
        }else{
            var s_nomor =  nomorst.split("/");
            var j_st    =  s_nomor['0'].split('-');

            $('#jenis_nomor_st').val(j_st['0']).trigger('change');
            $('#nomor_urut_st').val(j_st['1']);
            $('#nomor_tahun_st').val('/PW04/'+s_nomor['2']+'/'+s_nomor['3']);
        }

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