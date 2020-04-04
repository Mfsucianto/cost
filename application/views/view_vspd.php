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

                    if ($this->session->userdata('iPeran')==1 || $this->session->userdata('iPeran')==6 ){
                        $qb = "";
                        $qa = "";
                    }else{
                        $qb = " a.iBidangId='".$this->session->userdata('iBidangId')."' AND ";
                        $qa = " a.iBidangId='".$this->session->userdata('iBidangId')."' AND ";
                    }

                    if ($this->session->userdata('iPeran')==2 && $this->session->userdata('iBidangId') ==1){
                        //jika pegawai dan bidang TU
                        $qb .= " a.iSubBidangId = '".$this->session->userdata('iSubBidangId')."' AND  ";
                    }

                    if ($this->session->userdata('iPeran')==2){
                        $qb = " a.vNip='".$this->session->userdata('nip')."' AND ";
                    }

                    $sql = "select a.vNip,a.vName from cost.ms_pegawai as a WHERE ".$qb." a.lDeleted=0 ";


                    $query  = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result_array() as $row) {
                            $datatmcs[$row['vNip']] =$row['vNip']." - ". $row['vName'];
                            $nip = $row['vNip'];
                            $nama = $row['vName'];

                        }
                    }

                    if ($this->session->userdata('iPeran')!=2){
                        echo $this->lib_util->drawcombo('vNip','NIP / Nama ',$datatmcs,'300px');
                    }else{
                        echo '<div class="form-group" >
                                  <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">NIP / Nama</label>
                                  <div class="col-sm-7">
                                    <div class="input-group input-group-sm">
                                        <input type="hidden"   id="vNip" name="vNip" style="width:300px;" class="form-control" value="'.$nip.'" > <span><b>'.$nip.' - '.$nama.'</b></span>
                                    </div>
                                    
                                  </div>
                                </div>';
                    }
                    


                    $datatmcs = array();
                    $sql = "select a.iBidangId,a.vBidangName from cost.ms_bidang as a WHERE {$qa} a.lDeleted=0 ";
                    $query  = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result_array() as $row) {
                            $datatmcs[$row['iBidangId']] = $row['vBidangName'];
                            $bidangid = $row['iBidangId'];
                            $bidangnm = $row['vBidangName'];
                        }
                    }

                    if ($this->session->userdata('iPeran')!=2){
                        echo $this->lib_util->drawcombo('iBidangId','Bidang',$datatmcs,'300px');
                    }else{
                        echo '<div class="form-group" >
                                  <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Bidang</label>
                                  <div class="col-sm-7">
                                    <div class="input-group input-group-sm">
                                        <input type="hidden"   id="iBidangId" name="iBidangId" style="width:300px;" class="form-control" value="'.$bidangid.'" > <span><b>'.$bidangnm.'</b></span>
                                    </div>
                                    
                                  </div>
                                </div>';
                    }
                    


                    
                    echo '<div class="form-group" >
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


                   
                     echo '<div class="form-group" id="div_iDipaId">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;"></label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">

                                   <a class="btn btn-app" onclick="viewSPD()">
                                        <i class="fa fa-search"   ></i> View
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
        

        $('#dPerjalananStart').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });

        $('#dPerjalananEnd').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });

    });


   
   function viewSPD() {
        var iBarcode = $('#iBarcode').val(); 
        var vNomorCs = $('#vNomorCs').val();

        var vNip = $('#vNip').val();
        var iBidangId = $('#iBidangId').val();
        var dPerjalananStart = $('#dPerjalananStart').val();
        var dPerjalananEnd = $('#dPerjalananEnd').val();

        // if (vNip=='' && iBidangId==''){
        //     custom_alert('','Pilih NIP Atau Bidang yang dicari');
        //     return false
        // }

        if (dPerjalananStart=='' || dPerjalananEnd==''){
            custom_alert('','Lengkapi Tanggal Perjalanan');
            return false
        }

       

        $('#section_list_spd').show(200);
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
        });
    }

    function loadData(){
        var vNip = $('#vNip').val();
        var iBidangId = $('#iBidangId').val();
        var dPerjalananStart = $('#dPerjalananStart').val();
        var dPerjalananEnd = $('#dPerjalananEnd').val();

        var url = "<?php echo site_url().'/vspd/getData'; ?>";
        return $.ajax({
            type: 'POST',
            data: 'vNip='+vNip+'&iBidangId='+iBidangId+'&dPerjalananStart='+dPerjalananStart+'&dPerjalananEnd='+dPerjalananEnd, 
            url: url,
            async:false
        }).responseText
    }

   

    

    
</script>