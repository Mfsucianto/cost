<?php 
$this->load->view('template/head');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');


?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <small></small>
    </h1>
   
</section>

<!-- Main content -->
<section class="content" id="sec_spj" >

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Monitoring SPJ</h3>
            <div class="box-tools pull-right">
                
               
            </div>
        </div>
        <div class="box-body">
            <div >
                <form class="form-horizontal" id="form_data" name="form_data" autocomplete="off">

                

                <?php
                    
                    $y = date('Y')+2;
                    $now = date('Y');

                    $cb = '<select id="cTahun" name="cTahun" class="form-control" >';
                    for ($i=$y; $i > 2000; $i--) {
                        if ($now==$i){
                            $sel = 'selected';
                        }else{
                            $sel = '';
                        } 
                       $cb .= '<option '.$sel.' value="'.$i.'" >'.$i.'</option>';
                    }

                    $cb .= '</select>';
                   
                    echo '<div class="form-group" id="div_iBarcode">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 300;">Tahun</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm" style="width: 140px;">
                                    '.$cb.'
                                        <span class="input-group-btn">
                                          <button type="button" onclick="searchSPJ()"  class="btn btn-info btn-flat" ><i class="fa fa-search" ></i> Cari</button>
                                        </span>
                                </div>
                                
                              </div>
                            </div>';

                   
                ?>
                

                </form>
                <legend></legend>
                <div id="isi_table" >
                    
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->








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


   
   
   function searchSPJ() {
        $('#isi_table').html('<center>--please wait while colecting data--</center>');
        refreshData();

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
        var cTahun = $('#cTahun').val();
        var url = "<?php echo site_url().'/monitoring_spj/getData'; ?>";
        return $.ajax({
            type: 'POST',
            data: 'cTahun='+cTahun, 
            url: url,
            async:false
        }).responseText
    }

   

   

    
</script>