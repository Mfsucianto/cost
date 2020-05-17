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


<!-- ======================================FORM ADD/EDIT====================================================
 --><section class="content" id="from_add" style="display: none;">
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
        <div class="box-body" style="overflow: auto;max-height: 450px;">
            <form class="form-horizontal" id="form_data" name="form_data" autocomplete="off">
                <?php
                    echo '<input type="hidden" readonly class="form-control input-sm" id="iStId" name="iStId" value="0">';
                    echo '<input type="hidden" readonly class="form-control input-sm" id="iDipaId" name="iDipaId" value="">';
                   
                    
                    $datchgbid = array();

                    if ($this->session->userdata('iPeran')==1 || $this->session->userdata('iPeran')==6 ){
                        $sql = "SELECT iBidangId,vBidangName FROM  ms_bidang ";
                    }else{
                        //$sql = "SELECT iBidangId,vBidangName FROM  ms_bidang WHERE iBidangId='".$this->session->userdata('iBidangId')."' ";
                        $sql = "SELECT iBidangId,vBidangName FROM  ms_bidang ";
                    }
                    
                    $query  = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result_array() as $row) {
                            $datchgbid[$row['iBidangId']] = $row['vBidangName'];
                        }
                    }

                   
                    echo $this->lib_util->drawcombo('iBidangId','Bidang Penugasan',$datchgbid);

                    if ($this->session->userdata('iBidangId') ==1){
                        $datchgsubbid = array();
                        if ($this->session->userdata('iPeran')==2){ 
                            //jik pegawai
                             /*$sql = "SELECT iSubBidangId,vSubBidangName FROM cost.ms_sub_bidang 
                                    WHERE iSubBidangId='".$this->session->userdata('iSubBidangId')."' AND lDeleted=0";*/

                            $sql = "SELECT iSubBidangId,vSubBidangName FROM cost.ms_sub_bidang WHERE lDeleted=0";

                        }else{
                             $sql = "SELECT iSubBidangId,vSubBidangName FROM cost.ms_sub_bidang WHERE lDeleted=0";
                        }
                       
                        $query  = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                            foreach($query->result_array() as $row) {
                                $datchgsubbid[$row['iSubBidangId']] = $row['vSubBidangName'];
                            }
                        }
                        echo $this->lib_util->drawcombo('iSubBidangId','Sub Bidang',$datchgsubbid,'300px');
                    }


                    echo $this->lib_util->drawcombo('iJenisRkt','Jenis RKT',array(''=>'',0=>'PKAU',1=>'PKPT',2=>'NON PKPT'),'150px');
                    echo $this->lib_util->drawcombo('iJenisSt','Jenis Surat Tugas',array(0=>'',1=>'PENUGASAN BARU',2=>'PERPANJANGAN PENUGASAN',3=>'SUB PENUGASAN'),'300px');

                    echo $this->lib_util->drawcombo('vJenisPenugasan','Jenis Penugasan',array());

                    
                    echo $this->lib_util->drawFiledTextarea('Dasar Penugasan','vDasarPenugasan');
                    echo $this->lib_util->drawFiledText('Nomor Surat Dasar Penugasan','cNoSrtDasar','300px');
                    echo $this->lib_util->drawFiledText('Tanggal Surat Dasar Penugasan','dTglSrtDasar','100px');
                    echo $this->lib_util->drawFiledText('Obyek Penugasan','cObyekPenugasan');
                    
                    echo $this->lib_util->drawFiledTextarea('Uraian Penugasan','vUraianPenugasan');
                    

                    echo $this->lib_util->drawFiledText('Tanggal Mulai','dMulai','100px');
                    echo $this->lib_util->drawFiledText('Tanggal Akhir','dAkhir','100px');
                    echo $this->lib_util->drawFiledText('Jangka Waktu Penugasan (hari)','nJangkaWaktu','100px');

                    echo "<legend></legend>";

                    echo $this->lib_util->drawcombo('iSumberDana','Sumber Dana Yang Akan Diajukan',
                        array(0=>'',1=>'DIPA PERWAKILAN',
                                    2=>'SKPA',
                                    3=>'DROPING',
                                    4=>'PIHAK III',
                                    5=>'UNIT BPKP LAIN',
                                    6=>'SHARING'),'300px');

                    echo $this->lib_util->drawFiledTextarea('Uraian Sumber Dana','vUraianSumberDana');

                    echo '<div class="form-group" id="div_iDipaId">
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


                    $this->load->view('view_st_detail_rkt');
                    echo "<legend style='border: 1px solid gray;'></legend>";
                    $this->load->view('view_st_detail_team');

                ?>
                    

            </form>

        </div>
        <!-- /.box-body -->

        <div  class="box-footer">
            <button type="button" class="btn btn-warning" onclick="batal()" >Cancel/Close</button>
           
            <button type="button" onclick="simpanData()" class="btn btn-info pull-right">Simpan</button> &nbsp

             <button type="button" onclick="cetakST()" id="btn_CetakST" style="display: none" class="btn btn-info">Cetak ST</button>
             <button type="button" onclick="showCostSheet()" id="btn_costSheet" style="display: none" class="btn btn-info">Cost Sheet</button>
        </div>
    </div>



</section>

<!-- ======================================END OF FORM ADD/EDIT==================================================== -->


<!--  Modal content for the above example -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">List </h4>
        </div>
        <div class="modal-body" id="list_data_dipa">
           
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<!-- ============================Modal Cetak ST=================================== -->

<!--  Modal content for the above example -->
<div class="modal fade dialog_cetak_st combo_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabeldialog_cetak_st">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content">

    <div class="modal-header">
     
      <h4 class="modal-title" id="myLargeModalLabeldialog_cetak_st">Cetak Surat Tugas</h4>
    </div>
    <div class="modal-body" id="div_from_cetak">
        <form class="form-horizontal" id="form_data_cetak_st" name="form_data_cetak_st" autocomplete="off">
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
                          <label for="username" class="col-sm-3 control-label" style="font-weight: 400;width:200px;">Nomor ST</label>
                          <div class="col-sm-7">
                                <span id="span_nomor_st" ></span>
                               
                          </div>
                        </div>';

                echo  '<div class="form-group">
                          <label for="username" class="col-sm-3 control-label" style="font-weight: 400;width:200px;">Tanggal ST</label>
                          <div class="col-sm-7">
                                <span id="span_tanggalr_st" ></span>
                          </div>
                        </div>';


                echo  '<div class="form-group">
                          <label for="username" class="col-sm-4 control-label" style="font-weight: 400;width:200px;">Kepala Perwakilan</label>
                          <div class="col-sm-7">

                                <table>
                                    <tr>
                                        <td>
                                            <select class="orm-control input-sm select2_modal" style="width:300px;" id="nipiKaPer_st" name="nipiKaPer_st">
                                                '.$opt.'
                                            </select>
                                        </td>
                                        <td> &nbsp &nbsp </td>
                                        <td>
                                            <select class="orm-control input-sm select2_modal" style="width:300px;" id="iKaPer_st" name="iKaPer_st">
                                                <option value="Kepala Perwakilan" >Kepala Perwakilan</option>
                                                <option value="Pelaksana Harian Kepala Perwakilan" >Plh Kepala Perwakilan</option>
                                                <option value="Pelaksana Tugas Kepala Perwakilan" >Plt Kepala Perwakilan</option>

                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                

                                
                          </div>
                        </div>';
               
            ?>
        </form>
    </div>
    <div  class="box-footer">
        <button type="button" class="btn btn-warning" onclick="batal_cetak_st()" >Cancel</button>
       
        <button type="button" onclick="proses_cetak_st()" class="btn btn-info pull-right">Print</button> &nbsp
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<iframe height="0" width="0" id="iframe_preview"></iframe>



<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->

<?php
$this->load->view('template/foot');
?>



<script type="text/javascript">
    
    $(document).ready(function() {
        $('#side_menu_utama').removeClass('active');
        $('#side_menu_st').addClass('active');

        refreshData();
        $('.detail_rkt_nValue').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
        var dateToday = new Date();
        $('#dTglSrtDasar').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            endDate: dateToday
        });

        $('#dMulai').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true
        });

        $('#dAkhir').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true
        });


        $('#nJangkaWaktu').autoNumeric('init', {vMin:'0', vMax:'99999'});
        
        $('#div_vUraianSumberDana').hide();
        $('#div_iDipaId').hide();
        $('#div_detail_rkt').hide();
        
        $('#iSumberDana').change(function() {
            if ($(this).val()==0){
                $('#div_vUraianSumberDana').hide();
                $('#div_iDipaId').hide();
                $('#div_detail_rkt').hide();
            }else if ($(this).val()==1){
                $('#div_vUraianSumberDana').hide();
                $('#div_iDipaId').show();
                $('#div_detail_rkt').show();
            }else{
                $('#div_vUraianSumberDana').show();
                $('#div_iDipaId').hide();
                $('#div_detail_rkt').hide();
            }
        });

        
        $( "#iBidangId" ).change(function() {
            
            var bidata = $('#iBidangId').select2('data')
                btext =  "KEGIATAN BIDANG "+bidata[0].text;
               
            $('#vJenisPenugasan').val('').trigger('change');
            $("#vJenisPenugasan").empty().trigger('change');

            $('#iSubBidangId').val('').trigger('change');
            $("#iSubBidangId").empty().trigger('change');

           if ($(this).val()==1){

                var arr_ = ["RAPAT KOORDINASI","KEGIATAN BAGIAN TATA USAHA","KEGIATAN SUB BAG KEUANGAN","KEGIATAN SUB BAG UMUM","KEGIATAN SUB BAG KEPEGAWAIAN"];


                arr_.forEach(function(entry) {
                   var data = {id: entry, text: entry };
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#vJenisPenugasan').append(newOption).trigger('change'); 
                });

                $('#div_iSubBidangId').show();

                var newOption = new Option('BAGIAN UMUM', '1', false, false);
                $('#iSubBidangId').append(newOption).trigger('change');

                var newOption = new Option('BAGIAN KEUANGAN', '2', false, false);
                $('#iSubBidangId').append(newOption).trigger('change');

                var newOption = new Option('BAGIAN KEPEGAWAIAN', '2', false, false);
                $('#iSubBidangId').append(newOption).trigger('change');
                

           }else{
                var data = {id: btext, text: btext };
                var newOption = new Option(data.text, data.id, false, false);
                $('#vJenisPenugasan').append(newOption).trigger('change'); 

                $('#div_iSubBidangId').hide();
            }

        });

        

    });



    function  searchDIPA() {
        var dMulai    = $('#dMulai').val();
        var iBidangId = $('#iBidangId').val();

       
        if (iBidangId==''){
            custom_alert('','Pilih Bidang Penugasan terlebih dahulu');
            return false;
        }

        if (dMulai==''){
            custom_alert('','Lengkapi Tanggal Mulai');
            return false;
        }


        $('.bs-example-modal-lg').modal({
            backdrop: 'static',
            keyboard: false
            })
        
        //$('#list_data_dipa').html('<center>Mohon tunggu, sedang menyiapkan data</center>')

        var list_data = getListDataDipa(dMulai,iBidangId);
        $('#list_data_dipa').html(list_data);
        $('#myLargeModalLabel').html('List DIPA');
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
         $('#btn_costSheet').hide();
         $('#btn_CetakST').hide();
        $('.title').html('Tambah <?php echo $caption; ?>');
        
        $('#iStId').val('0');
        $('#iBidangId').val('').trigger('change');
        $('#iJenisRkt').val('').trigger('change');
        $('#iJenisSt').val('').trigger('change');
        $('#vJenisPenugasan').val('');
        $('#vDasarPenugasan').val('');
        $('#cNoSrtDasar').val('');
        $('#dTglSrtDasar').val('');
        $('#cObyekPenugasan').val('');
        $('#vUraianPenugasan').val('');
        $('#dMulai').val('');
        $('#dAkhir').val('');
        $('#nJangkaWaktu').val('');
        $('#iSumberDana').val('').trigger('change');
        $('#iDipaId').val('');
        $('#vUraianSumberDana').val('');

        $('#div_vUraianSumberDana').hide();
        $('#div_iDipaId').hide();
        $('#div_detail_rkt').hide();

        $('#list_personal_team').hide();

        clear_tabel_content();

        $('#list_rkt_dipilih').val('');
        sum_value_anggaran();
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
        
        if ($('#iBidangId').val()==''){
            custom_alert('','Pilih Bidang Penugasan','info','iBidangId');
            return false;
        }

        if ($('#iJenisRkt').val()==''){
            custom_alert('','Pilih Jenis RKT','info');
            return false;
        }

        if ($('#iJenisSt').val()==''){
            custom_alert('','Pilih Jenis Surat Tugas','info');
            return false;
        }

        if ($('#vJenisPenugasan').val()==''){
            custom_alert('','Pilih Jenis Penugasan','info');
            return false;
        } 

        if ($('#vDasarPenugasan').val()==''){
            custom_alert('','Lengkapi Dasar Penugasan','info');
            return false;
        }

        if ($('#cNoSrtDasar').val()==''){
            custom_alert('','Lengkapi Nomor Dasar Penugasan','info');
            return false;
        }

        if ($('#dTglSrtDasar').val()==''){
            custom_alert('','Lengkapi Tanggal Surat Dasar Penugasan','info');
            return false;
        } 

        if ($('#cObyekPenugasan').val()==''){
            custom_alert('','Lengkapi Obyek Penugasan','info');
            return false;
        }

        if ($('#vUraianPenugasan').val()==''){
            custom_alert('','Lengkapi Uraian Penugasan','info');
            return false;
        }

        if ($('#dMulai').val()==''){
            custom_alert('','Lengkapi Tanggal Mulai','info');
            return false;
        } 

        if ($('#dAkhir').val()==''){
            custom_alert('','Lengkapi Tanggal Akhir','info');
            return false;
        } 

        if ($('#nJangkaWaktu').val()=='' || $('#nJangkaWaktu').val()==0){
            custom_alert('','Lengkapi Jangka Waktu','info');
            return false;
        }


        if ($('#iSumberDana').val()==''){
            custom_alert('','Pilih Sumber Dana','info');
            return false;
        }

        if ($('#iSumberDana').val()!='1' && $('#vUraianSumberDana').val()=='' ){
            custom_alert('','Lengkapi Uraian SUmber Dana','info');
            return false;
        }

        if ($('#iSumberDana').val()=='1' && $('#iDipaId').val()=='' ){
            custom_alert('','Pilih DIPA','info');
            return false;
        }

        var iStId   = $('#iStId').val();
        var tot_err = 0;
        if ($('#iSumberDana').val()=='1'){
            if ($('.detail_rkt_iRktId').val()==undefined){
                custom_alert('Opps..','Lengkapi data RKT');
                return false;
            }else{
                i=0;
                $('.detail_rkt_nValue').each(function() {
                    if ($('.detail_rkt_nValue').eq(i).val() == '') {                                                  
                            alert('Lengkapi Nilai Anggaran yang diajukan');
                            $('.detail_rkt_nValue').eq(i).focus();
                            tot_err++;              
                    }else{
                        var iRktId = $('.detail_rkt_iRktId').eq(i).val();
                        var nValue = $('.detail_rkt_nValue').eq(i).val();

                        //cek saldo mencukupi atau tidak,
                        ada = cekSaldoRKT(iRktId,nValue,iStId);
                        if (ada!=''){
                            x_ada = ada.split('|');
                            custom_alert(x_ada['0'],x_ada['1'],'error');
                            $('.detail_rkt_nValue').eq(i).focus();
                            tot_err++;    
                            return false;
                        }

                    }
                    i++;                                                                                
                });
        
                if (tot_err > 0) {
                    return false;
                }       
            }



        }
        //cek NIP sudah pernah ada apa belum

        
       

        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/simpanData'; ?>";
        var jwb = confirm("Simpan data ini ?");
        if (jwb==1){

            $.ajax({
                url: url,
                type: 'post',
                data: $('#form_data').serialize(),
                success: function(data) {
                    if (data > 0) {
                        
                        custom_alert('','Data berhasil disimpan','success');
                         $('#section_list').show();
                         $('#from_add').hide();
                        refreshData();
                        edit(data)
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
        clear_tabel_content();
        $('#section_list').hide();
        $('#from_add').show();
        $('#btn_costSheet').show();
        $('#btn_CetakST').show();
        var data = loadDataEdit(id);
        rowData  = JSON.parse(data);
        $('.title').html('Ubah <?php echo $caption; ?>');

        $('#<?php echo $dataFrom["primaryKey"]; ?>').val(rowData['<?php echo $dataFrom["primaryKey"]; ?>']);
        var arrFiled = JSON.parse('<?php echo $arryFildJs;?>');
        var arrayLength = arrFiled.length;
        for (var i = 0; i < arrayLength; i++) {

            $('#'+arrFiled[i]).val(rowData[arrFiled[i]]).trigger('change');
        }


        
       $('#iStId').val(rowData['iStId']);
       $('#iBidangId').val(rowData['iBidangId']).trigger('change');
       $('#iJenisRkt').val(rowData['iJenisRkt']).trigger('change');
       $('#iJenisSt').val(rowData['iJenisSt']).trigger('change');
       $('#vJenisPenugasan').val(rowData['vJenisPenugasan']);
       $('#vDasarPenugasan').val(rowData['vDasarPenugasan']);
       $('#cNoSrtDasar').val(rowData['cNoSrtDasar']);
       $('#dTglSrtDasar').val(rowData['dTglSrtDasar']);
       $('#cObyekPenugasan').val(rowData['cObyekPenugasan']);
       $('#vUraianPenugasan').val(rowData['vUraianPenugasan']);
       $('#dMulai').val(rowData['dMulai']);
       $('#dAkhir').val(rowData['dAkhir']);
       $('#nJangkaWaktu').val(rowData['nJangkaWaktu']);
       $('#iSumberDana').val(rowData['iSumberDana']).trigger('change');
       $('#iDipaId').val(rowData['iDipaId']);
       $('#vUraianSumberDana').val(rowData['vUraianSumberDana']);
        
        $('#span_nomor_st').html(rowData['cNomorST']);
        $('#span_tanggalr_st').html(rowData['dTglST']);

        var iSumberDana = rowData['iSumberDana'];
       if (iSumberDana==0){
            $('#div_vUraianSumberDana').hide();
            $('#div_iDipaId').hide();
            $('#div_detail_rkt').hide();
        }else if (iSumberDana==1){
            $('#div_vUraianSumberDana').hide();
            $('#div_iDipaId').show();
            $('#div_detail_rkt').show();


            //proses redraw detail
            var data_detail  = getDataDetailRKT(rowData['iStId']);
            ps = JSON.parse(data_detail);

           

            for(i=0;i<ps.length;i++) {            
                var list_rkt_dipilih = $('#list_rkt_dipilih').val();
                var row_content = '';
                row_content   = '<tr>';
                row_content  += '<td>'+ps[i].cNomorRkt
                row_content  += '<input type="hidden" readonly class="detail_rkt_iRktId" name="detail_rkt_iRktId[]" value="'+ps[i].iRktId+'" ></td>';
                row_content  += '<td>'+ps[i].cNamaItem+'</td>'
                row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="detail_rkt_nValue" name="detail_rkt_nValue[]" value="'+ps[i].nValue+'" data-a-dec="." data-a-sep="," onkeyup="sum_value_anggaran()" ></td>'
                row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';

                row_content  += '</tr>';
                jQuery("#tabel_detail_rkt tbody").append(row_content);

                 $('#list_rkt_dipilih').val(list_rkt_dipilih+ps[i].iRktId+',');

            }

           
            $('.detail_rkt_nValue').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
            sum_value_anggaran()


        }else{
            $('#div_vUraianSumberDana').show();
            $('#div_iDipaId').hide();
            $('#div_detail_rkt').hide();
        }



        $('#list_personal_team').show();
        //drawlistPersonal
        
        darw_list_team(rowData['iStId'])
        


       $('#text_iDipaId').val(rowData['text_iDipaId']);
    }


    function darw_list_team(iStId) {
        $("#tabel_detail_team > tbody").html("");
        var list_team = getListPersonalTeam(iStId);
        var pt = JSON.parse(list_team);
        no = 0;
        for(i=0;i<pt.length;i++) {
           no++;
            var row_content = '';
            row_content   = '<tr>';
            row_content  += '<td>'+no+'</td>'
            row_content  += '<td>'+pt[i].vNip+'</td>';
            row_content  += '<td>'+pt[i].vName+'</td>';
            row_content  += '<td>'+pt[i].peran+'</td>';
            row_content  += '<td>'+pt[i].vPeranst+'</td>';
            row_content  += '<td>'+pt[i].nJumlahHP+'</td>';
            row_content  += '<td style="text-align:center;"> <div class="btn-group">';
            row_content  +=     '<button style="padding: 2px 6px;" onclick="del_team('+pt[i].id+')" type="button" class="btn btn-warning"><i class="fa fa-fw fa-trash"></i></button>';
            row_content  +=     '<button style="padding: 2px 6px;" onclick="edit_team('+pt[i].id+')" type="button" class="btn btn-success"><i class="fa  fa-pencil-square"></i></button>';
           // row_content  +=     '<a href="javascript:;" onclick="del_row(this)"><i class="fa fa-fw fa-trash"></i></a>';
            row_content  += '</div></td>';

            row_content  += '</tr>';
            jQuery("#tabel_detail_team tbody").append(row_content);
        }
    }

    function  getListPersonalTeam(iStId) {
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/getListPersonalTeam'; ?>";
        return $.ajax({
            type: 'POST',
            data:'iStId='+iStId, 
            url: url,
            async:false
        }).responseText
    }



    function  getDataDetailRKT(iStId) {
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/getDataDetailRKT'; ?>";
        return $.ajax({
            type: 'POST',
            data:'iStId='+iStId, 
            url: url,
            async:false
        }).responseText
    }

    function cekSaldoRKT(iRktId,nValue,iStId) {
        var url = "<?php echo site_url().'/'.$dataFrom['controller'].'/cekSaldoRKT'; ?>";
        return $.ajax({
            type: 'POST',
            data:'iRktId='+iRktId+'&nValue='+nValue+'&iStId='+iStId, 
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
                    custom_alert('','Data berhasil dihapus','success');
                    refreshData();
                    return false;
                } else {
                   custom_alert('','Data gagal dihapus','error');
                   return false;
                }
                
            }); 
        }
    }
    function  select_row(id,cTahun,cKodeDipa,fJumlahAnggaran,vNamaItem) {
        clear_tabel_content()
       $('#text_iDipaId').val(cKodeDipa+' - '+vNamaItem);
       $('#iDipaId').val(id);
       $('#fJumlahAnggaran').val(fJumlahAnggaran);
       
       $('.bs-example-modal-lg').modal('hide')
    }


    function clear_tabel_content() {
        
        $("#tabel_detail_rkt > tbody").html("");
        $('#total_alokasi').html('');
        $('#list_rkt_dipilih').val('');
    }


    function showCostSheet() {

        var iStId = $('#iStId').val();
        


        $('.bs-example-modal-lg').modal({
            backdrop: 'static',
            keyboard: false
            })
        
        //$('#list_data_dipa').html('<center>Mohon tunggu, sedang menyiapkan data</center>')

        var list_data = getListCS(iStId);
        $('#list_data_dipa').html(list_data);
        $('#myLargeModalLabel').html('List Cost Sheet');
        $('#list_popup').DataTable({
            "bSort": false
        });



        $('.bs-example-modal-lg').modal('show');

    }

    function getListCS(iStId){
        var url = "<?php echo site_url().'/cost_sheet'; ?>";
        return $.ajax({
            type: 'POST', 
            url: url,
            data:'iStId='+iStId,
            async:false
        }).responseText
    }



    function cetakST() {
        $('.dialog_cetak_st').modal('show');
    }
    
    function batal_cetak_st() {
         $('.dialog_cetak_st').modal('hide');
    }

    function proses_cetak_st() {
        var iStId           = $('#iStId').val();
        var nipiKaPer_st    = $('#nipiKaPer_st').val();
        var iKaPer_st       = $('#iKaPer_st').val();
        var nJangkaWaktu       = $('#nJangkaWaktu').val();
        var url = "<?php echo site_url().'/st/cetakST2?iStId='; ?>"+iStId+'&nipiKaPer='+nipiKaPer_st+'&iKaPer='+iKaPer_st+'&nJangkaWaktu='+nJangkaWaktu;

        var jwb = confirm('Cetak Data ST ?');

        if (jwb==1){
            document.getElementById('iframe_preview').src = url;
        }
    }


</script>