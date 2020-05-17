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
<section class="content" id="sec_rencana" >

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Data Rencana</h3>
            <div class="box-tools pull-right">
                
               
            </div>
        </div>
        <div class="box-body">
            <div >
                <form class="form-horizontal" id="form_data" name="form_data" autocomplete="off">

                

                <?php
                    
                    

                    echo '<div class="form-group" id="div_vNoSPPD">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Nomor SPD</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <input type="text" readonly id="vNoSPPD" class="form-control">
                                        <span class="input-group-btn">
                                          <button type="button" onclick="searchSPD()"  class="btn btn-info btn-flat" >Search</button>
                                        </span>
                                </div>
                                
                              </div>
                            </div>';

                    echo $this->lib_util->drawFiledText('Tanggal SPD','dTglSPPD','100px');
                    echo $this->lib_util->drawFiledText('Nama','vName','300px');
                    echo $this->lib_util->drawFiledText('NIP','vNip','200px');
                    echo $this->lib_util->drawFiledText('Golongan','cGolongan','50px');
                    echo $this->lib_util->drawFiledText('Jabatan','vJabatanName','300px');
                    echo $this->lib_util->drawFiledTextarea('Maksud SPD','vUraianPenugasan','300px');
                    echo $this->lib_util->drawFiledText('Kota Asal','vDari','300px');
                    echo $this->lib_util->drawFiledText('Kota Tujuan','vTujuan','300px');
                    echo $this->lib_util->drawFiledText('Angkutan','iAlatAngkut','300px');
                    echo $this->lib_util->drawFiledText('Lama Hari','nLama','50px');
                    echo $this->lib_util->drawFiledText('Tanggal Berangkat','dPerjalananStart','100px');
                    echo $this->lib_util->drawFiledText('Tanggal Kembali','dPerjalananEnd','100px');
                    echo $this->lib_util->drawFiledText('Beban Anggaran','iSumberDana');
                    
                    echo "<legend></legend>";
                    echo '<div class="form-group" id="div_cheklist">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Check List Kelengkapan SPJ</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <input type="checkbox" id="iCheckSuratTugas" class="iCheckSuratTugas" > Surat Tugas <br />
                                    <input type="checkbox" id="iChekSpd" class="iChekSpd" > SPD Yang Telat TTD Pejabat Pengesahan (Rampung) <br />
                                    <input type="checkbox" id="iChekPenginapan" class="iChekPenginapan" > Bukti Penginapan (Kuitansi Hotel / Penginapan Lainnya) <br />
                                    <input type="checkbox" id="iChekTransportasi" class="iChekTransportasi" > Bukti Transportasi (Tiket,Airpot Taxi,Boarding Pas, dll) <br />
                                    <input type="checkbox" id="iChekPengeluaran" class="iChekPengeluaran" > Daftar Pengeluaran Rill
                                </div>
                                
                              </div>
                            </div>';

                    echo $this->lib_util->drawFiledText('Tanggal Terima SPJ','dTerimaSpj','100px');
                    
                ?>
                

            </form>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer" >
            
            <button type="button" class="btn bg-navy "  onclick="simpanData()" >Simpan</button>
            <button type="button" class="btn btn-info pull-right "  onclick="nextKwitansi()" >Lanjut Ke Kuitansi <i class="fa  fa-forward"></i></button>
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->




<!-- Main content -->
<section class="content" id="sec_kwitansi" style="display: none;" >

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Kuitansi</h3>
            <div class="box-tools pull-right">
                
               
            </div>
        </div>
        <div class="box-body">
            <div >
                <form class="form-horizontal" id="form_data_kwitansi" name="form_data_kwitansi" autocomplete="off">

                

                <?php
                    
                   echo '<input type="hidden" readonly class="form-control input-sm" id="id" name="id" value="0">';

                    echo $this->lib_util->drawFiledText('Tahun DIPA','cTahun','100px');
                    echo $this->lib_util->drawFiledText('Kode DIPA','cKodeDipa','300px');
                    //echo $this->lib_util->drawFiledText('Nomor Kuitansi','vNomorKwitansi','200px');
                    echo '<div class="form-group" id="div_vNomorKwitansi">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Nomor Kuitansi</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                   <input type="text" readonly style="width:200px" class="form-control input-sm" id="vNomorKwitansi" name="vNomorKwitansi" >
                                </div>
                                
                              </div>
                            </div>';

                    echo $this->lib_util->drawFiledText('Tanggal Kuitansi','dTglKwitansi','200px');
                    echo $this->lib_util->drawFiledText('Sisa Pagu Awal','nSisaPaguAwal','200px');
                    echo $this->lib_util->drawFiledText('Kuitansi ini','nNilaiKwitansi','200px');
                    echo $this->lib_util->drawFiledText('Sisa Pagu Akhir','nSisaPaguAkhir','200px');


                   
                    
                    
                    echo '<div class="form-group" id="div_cheklist">
                              <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Lumpsum Harian</label>
                              <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                   <table>
                                        <tr>
                                            <td>
                                                 <input type="text" style="width:100px" class="form-control input-sm" id="dLumpsumpAwal" name="dLumpsumpAwal" >
                                                
                                            </td>

                                            <td>
                                                 s/d 
                                            </td>

                                            <td>
                                                 <input type="text" style="width:100px" class="form-control input-sm" id="dLumpsumpAkhir" name="dLumpsumpAkhir" >
                                            </td>
                                        </tr>
                                   </table>
                                </div>
                                
                              </div>
                            </div>';

                   
                  echo "<legend></legend>";
                  $this->load->view('view_kwitansi_penugasan');
                  $this->load->view('view_kwitansi_penginapan');
                  $this->load->view('view_kwitansi_repre');
                  $this->load->view('view_kwitansi_transport');
                  $this->load->view('view_dpr');

                  echo $this->lib_util->drawFiledText('Total','nNilaiKwitansi2','200px');
                  echo $this->lib_util->drawFiledText('Terbilang','terbilang');

                ?>
                

            </form>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer" >
            
            <button type="button" class="btn btn-info "  onclick="backToRencana()" ><i class="fa  fa-backward"></i> Kembali Ke Data Rencana</button>
            <button type="button" class="btn bg-navy pull-right"  onclick="simpanDataKwitansi()" >Simpan</button>
            <button type="button" class="btn bg-navy "  onclick="cetakKwitansi()" >Cetak Kuitansi</button>
           
            <button type="button" class="btn bg-navy "  onclick="cetakDpr()" >Cetak DPR</button> &nbsp
            <button type="button" class="btn bg-navy "  onclick="cetakRincianPerjadin()" >Cetak Rincian Biaya Perjadin</button> &nbsp

            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->



<!-- Main content -->
<section class="content" id="sec_dpr" style="display: none;"  >

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">DPR</h3>
            <div class="box-tools pull-right">
                
               
            </div>
        </div>
        <div class="box-body">
            <div >
                <form class="form-horizontal" id="form_data_dpr" name="form_data_dpr" autocomplete="off">
                <?php
                    
                    echo '<input type="hidden" readonly class="form-control input-sm" id="id_dpr" name="id_dpr" value="0">';

                    echo $this->lib_util->drawFiledText('Nomor Kuitansi','vNomorKwitansiDPR','200px');
                    echo $this->lib_util->drawFiledText('Tanggal Kuitansi','dTglKwitansiDPR','200px');
                   
                   
                    echo "<legend></legend>";
                    //$this->load->view('view_dpr');
                ?>
                

            </form>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer" >
            
            <button type="button" class="btn btn-info "  onclick="nextKwitansi()" ><i class="fa  fa-backward"></i> Kembali Ke Kuitansi</button>
            <button type="button" class="btn bg-navy "  onclick="simpanDataDpr()" >Simpan</button>
            <button type="button" class="btn bg-navy "  onclick="cetakDpr()" >Cetak DPR</button>
            <button type="button" class="btn bg-navy "  onclick="cetakRincianPerjadin()" >Cetak Rincian Biaya Perjadin</button>
            
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->


<!--  Modal content for the above example -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">List </h4>
        </div>
        <div class="modal-body" id="list_data_spd">
           
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->



<!--  Modal content for the above example -->
  <div class="modal fade modal_cetak_kwitansi combo_modal " tabindex="-1" role="dialog" aria-labelledby="label_modal_kwitansi">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="label_modal_kwitansi">Cetak Kuitansi </h4>
        </div>
        <div class="modal-body">
            <div>
                <form class="form-horizontal" id="form_data_dpr" name="form_data_dpr" autocomplete="off">
                    <?php
                        $datatmcs = array();
                        $sql = "select a.vNip,a.vName FROM cost.ms_pegawai as a  where a.iJabatanId in (5,1,2) and a.lDeleted=0 order by a.vName ASC ";
                        $query  = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                            foreach($query->result_array() as $row) {
                                $datatmcs[$row['vNip']."|".$row['vName']] = $row['vNip']." - ".$row['vName'];
                            }
                        }
                        echo $this->lib_util->drawcombo_onmodal('vPejabatKwitansi','Pilih Pejabat Pembuat Komitmen',$datatmcs,'500px');

                        
                        $sql = "select a.vNip,a.vName FROM cost.ms_pegawai as a  where a.iJabatanId in (22) and a.lDeleted=0 order by a.vName ASC ";
                        $query  = $this->db->query($sql);
                        $opt = '';
                        if ($query->num_rows() > 0) {
                            foreach($query->result_array() as $row) {
                               $opt .= '<option value="'.$row['vNip']."|".$row['vName'].'"  >'.$row['vNip']." - ".$row['vName'].'</option>';
                            }
                        }

                        echo  '<div class="form-group" id="div_vBendaharaKwitansi">
                                  <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Bendahara</label>
                                  <div class="col-sm-7">
                                        <select class="orm-control input-sm select2_modal" style="width:500px;" id="vBendaharaKwitansi" name="vBendaharaKwitansi">
                                            '.$opt.'
                                        </select>
                                  </div>
                                </div>';
                       
                        echo $this->lib_util->drawFiledText('Dibuat Di ','dibuatdiKwitansi','200px');
                        echo $this->lib_util->drawFiledText('Tanggal','tgl_dibuatKwitansi','200px');
                   ?>
                </form>
            </div>
           
        </div>
        <div class="box-footer" >
            <center>
            <button type="button" class="btn btn-info "  onclick="prosesCetakKwitansi()" ><i class="fa  fa-print"></i> Cetak</button>
           </center>
            
        </div><!-- /.box-footer-->

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->





<!--  Modal content cetak DPR -->
  <div class="modal fade modal_cetak_dpr "  role="dialog" aria-labelledby="label_modal_dpr" style="overflow:hidden;">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="label_modal_dpr">Cetak dpr </h4>
        </div>
        <div class="modal-body">
            <div>
                <form class="form-horizontal" id="form_data_dpr" name="form_data_dpr" autocomplete="off">
                    <?php
                        $datatmcs = array();
                         $sql = "select a.vNip,a.vName FROM cost.ms_pegawai as a  where a.iJabatanId in (5,1,2) and a.lDeleted=0 order by a.vName ASC ";
                        $query  = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                            foreach($query->result_array() as $row) {
                                $datatmcs[$row['vNip']."|".$row['vName']] = $row['vNip']." - ".$row['vName'];
                            }
                        }
                        echo $this->lib_util->drawcombo('vPejabatdpr','Pilih Pejabat Pembuat Komitmen',$datatmcs,'500px');
                      
                        echo $this->lib_util->drawFiledText('Dibuat Di ','dibuatdidpr','300px');
                        echo $this->lib_util->drawFiledText('Tanggal','tgl_dibuatdpr','200px');
                   ?>
                </form>
            </div>
           
        </div>
        <div class="box-footer" >
            <center>
            <button type="button" class="btn btn-info "  onclick="prosesCetakdpr()" ><i class="fa  fa-print"></i> Cetak</button>
           </center>
            
        </div><!-- /.box-footer-->

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->



<!--  Modal content for Cetak Perjadin -->
  <div class="modal fade modal_cetak_perjadin" tabindex="-1" role="dialog" aria-labelledby="label_modal_perjadin">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="label_modal_perjadin">Cetak Rincian Biaya Perjadin </h4>
        </div>
        <div class="modal-body">
            <div>
                <form class="form-horizontal" id="form_data_dpr" name="form_data_dpr" autocomplete="off">
                    <?php
                        $datatmcs = array();
                        $sql = "select a.vNip,a.vName FROM cost.ms_pegawai as a  where a.iJabatanId in (5,1,2) and a.lDeleted=0 order by a.vName ASC ";
                        $query  = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                            foreach($query->result_array() as $row) {
                                $datatmcs[$row['vNip']."|".$row['vName']] = $row['vNip']." - ".$row['vName'];
                            }
                        }
                        echo $this->lib_util->drawcombo('vPejabatperjadin','Pilih Pejabat Pembuat Komitmen',$datatmcs,'500px');
                       
                        $sql = "select a.vNip,a.vName FROM cost.ms_pegawai as a  where a.iJabatanId in (22) and a.lDeleted=0 order by a.vName ASC ";
                        $query  = $this->db->query($sql);
                        $opt = '';
                        if ($query->num_rows() > 0) {
                            foreach($query->result_array() as $row) {
                               $opt .= '<option value="'.$row['vNip']."|".$row['vName'].'"  >'.$row['vNip']." - ".$row['vName'].'</option>';
                            }
                        }

                        echo  '<div class="form-group" id="div_vBendaharaperjadin">
                                  <label for="username" class="col-sm-4 control-label" style="font-weight: 400;">Bendahara</label>
                                  <div class="col-sm-7">
                                        <select class="orm-control input-sm select2_modal" style="width:500px;" id="vBendaharaperjadin" name="vBendaharaperjadin">
                                            '.$opt.'
                                        </select>
                                  </div>
                                </div>';



                        echo $this->lib_util->drawFiledText('Dibuat Di ','dibuatdiperjadin','300px');
                        echo $this->lib_util->drawFiledText('Tanggal','tgl_dibuatperjadin','200px');
                   ?>
                </form>
            </div>
           
        </div>
        <div class="box-footer" >
            <center>
            <button type="button" class="btn btn-info "  onclick="prosesCetakperjadin()" ><i class="fa  fa-print"></i> Cetak</button>
           </center>
            
        </div><!-- /.box-footer-->

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<iframe height="0" width="0" id="iframe_preview"></iframe>

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
        
        $('#dibuatdidpr').val('Pekanbaru');
        $('#dibuatdiKwitansi').val('Pekanbaru');
        $('#dibuatdiperjadin').val('Pekanbaru');
        //$('#id').prop('disabled', true);
        $('#vNoSPPD').prop('disabled', true);
        $('#dTglSPPD').prop('disabled', true);
        $('#vName').prop('disabled', true);
        $('#vNip').prop('disabled', true);
        $('#cGolongan').prop('disabled', true);
        $('#vJabatanName').prop('disabled', true);
        $('#vUraianPenugasan').prop('disabled', true);
        $('#vDari').prop('disabled', true);
        $('#vTujuan').prop('disabled', true);
        $('#iAlatAngkut').prop('disabled', true);
        $('#nLama').prop('disabled', true);
        $('#dPerjalananStart').prop('disabled', true);
        $('#dPerjalananEnd').prop('disabled', true);
        $('#iSumberDana').prop('disabled', true);
        $('#cTahun').prop('disabled', true);
        $('#cKodeDipa').prop('disabled', true);
        $('#nNilaiKwitansi').prop('disabled', true);
        $('#nSisaPaguAwal').prop('disabled', true);
        $('#nSisaPaguAkhir').prop('disabled', true);
        $('#vNomorKwitansiDPR').prop('disabled', true);
        $('#dTglKwitansiDPR').prop('disabled', true);
        $('#nNilaiKwitansi2').prop('readonly', true);
        $('#terbilang').prop('readonly', true);




        

        
        $('#tgl_dibuatKwitansi').datepicker({
            format: 'dd MM yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });

        $('#tgl_dibuatdpr').datepicker({
            format: 'dd MM yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });

        $('#tgl_dibuatperjadin').datepicker({
            format: 'dd MM yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });


        $('#dTerimaSpj').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });

        $('#dTglKwitansi').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });

        $('#dLumpsumpAwal').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });

        $('#dLumpsumpAkhir').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });

        $('#tgl_dibuat').datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true,
            disableTouchKeyboard : true
        });
    });




    
    function nextKwitansi() {
        var id = $('#id').val();
        
        if (id=='' || id==0){
            custom_alert('','Pilih Data SPD terlebih dahulu');
            return false;
        }

        var iCheckSuratTugas    = document.querySelector('.iCheckSuratTugas').checked;
        var iChekSpd            = document.querySelector('.iChekSpd').checked;
        var iChekPenginapan     = document.querySelector('.iChekPenginapan').checked;
        var iChekTransportasi   = document.querySelector('.iChekTransportasi').checked;
        var iChekPengeluaran    = document.querySelector('.iChekPengeluaran').checked;
        var dTerimaSpj          = $('#dTerimaSpj').val();

        if (iCheckSuratTugas==true){
            val_iCheckSuratTugas = 1;
        }else{
            val_iCheckSuratTugas = 0;
            custom_alert('','Cheklist Surat Tugas Belum terpilih');
            return false;
        }

        if (iChekSpd==true){
            val_iChekSpd = 1;
        }else{
            val_iChekSpd = 0;
            custom_alert('','Cheklist  SPD Yang Telat TTD Pejabat Pengesahan (Rampung) Belum terpilih');
            return false;
        }

        if (iChekPenginapan==true){
            val_iChekPenginapan = 1;
        }else{
            val_iChekPenginapan = 0;
        }

        if (iChekTransportasi==true){
            val_iChekTransportasi = 1;
        }else{
            val_iChekTransportasi = 0;
        }

        if (iChekPengeluaran==true){
            val_iChekPengeluaran = 1;
        }else{
            val_iChekPengeluaran = 0;
        }

        if (dTerimaSpj==''){
            custom_alert('','Lengkapi Tanggal Terima SPJ');
            return false;
        }

        var url = "<?php echo site_url().'/rencana/simpanData'; ?>";
       $.ajax({
            url: url,
            type: 'post',
            data: 'id='+id+'&iCheckSuratTugas='+val_iCheckSuratTugas+'&iChekSpd='+val_iChekSpd+'&iChekPenginapan='+val_iChekPenginapan+'&iChekTransportasi='+val_iChekTransportasi+'&iChekPengeluaran='+iChekPengeluaran+'&dTerimaSpj='+dTerimaSpj,
            success: function(data) {
                if (data == 1) {
                    
                }else {
                   alert("Data Gagal disimpan");
                   return false;
                }
            }
        })

        $('#sec_rencana').hide(200);
        $('#sec_kwitansi').show(200);
        $('#sec_dpr').hide(200);

    }


    function backToRencana() {
        $('#sec_kwitansi').hide(200);
        $('#sec_rencana').show(200);
        $('#sec_dpr').hide(200);
    }

    function nextDpr() {
        $('#sec_rencana').hide(200);
        $('#sec_kwitansi').hide(200);
        $('#sec_dpr').show(200);
    }
    function cetakDataSPD() {
        var id = $('#id').val();
        var iHalaman = $('#iHalaman').val();
        var pejabatTTD = $('#pejabatTTD').val();
        var vNip_ppk = $('#vNip_ppk').val();
        var jabatan1 = $('#jabatan1').val();
        var jabatan2 = $('#jabatan2').val();
        var diKelurkandi = $('#diKelurkandi').val();
        var dKeluarkanTgl = $('#dKeluarkanTgl').val();

        var url = "<?php echo site_url();?>/spd/cetakspd?id="+id+"&pejabatTTD="+pejabatTTD+"&vNip_ppk="+vNip_ppk+"&jabatan1="+jabatan1+"&jabatan2="+jabatan2+"&diKelurkandi="+diKelurkandi+"&dKeluarkanTgl="+dKeluarkanTgl

        var jwb = confirm('Cetak Data Cost Sheet ?');

        if (jwb==1){
            document.getElementById('iframe_preview').src = url;
        }


    }
   
   function searchSPD() {
       $('.bs-example-modal-lg').modal({
            backdrop: 'static',
            keyboard: false
            })
        
        //$('#list_data_spd').html('<center>Mohon tunggu, sedang menyiapkan data</center>')

        var list_data = getListDataSpd();
        $('#list_data_spd').html(list_data);
        $('#myLargeModalLabel').html('List DIPA');
        $('#example1').DataTable();



        $('.bs-example-modal-lg').modal('show');

   }

   function getListDataSpd() {
       var url = "<?php echo site_url().'/rencana/getListDataSpd'; ?>";
        return $.ajax({
            type: 'POST', 
            url: url,
            async:false
        }).responseText
   }

   
    function select_row_spd(id, dTglSPPD, vNoSPPD, vNip, vName,cGolongan,
vJabatanName, vUraianPenugasan, alat_angkut, nLama, dPerjalananStart, dPerjalananEnd, iSumberDana,iCheckSuratTugas, iChekSpd, iChekPenginapan, iChekTransportasi, iChekPengeluaran, dTerimaSpj,vDari,vTujuan,cTahun, cKodeDipa, vNomorKwitansi, dTglKwitansi, nNilaiKwitansi, dLumpsumpAwal, dLumpsumpAkhir,fJumlahAnggaran,nSisaPaguAkhir) {
        $('#id').val(id);
        $('#vNoSPPD').val(vNoSPPD);
        $('#dTglSPPD').val(dTglSPPD);
        $('#vName').val(vName);
        $('#vNip').val(vNip);

        $('#cGolongan').val(cGolongan)
        $('#vJabatanName').val(vJabatanName)
        $('#vUraianPenugasan').val(vUraianPenugasan)
        $('#iAlatAngkut').val(alat_angkut)
        $('#nLama').val(nLama)
        $('#dPerjalananStart').val(dPerjalananStart)
        $('#dPerjalananEnd').val(dPerjalananEnd)
        $('#iSumberDana').val(iSumberDana)
        $('#cTahun').val(cTahun)
        $('#cKodeDipa').val(cKodeDipa)
        $('#vNomorKwitansi').val(vNomorKwitansi)
        $('#dTglKwitansi').val(dTglKwitansi)
        $('#nNilaiKwitansi').val(nNilaiKwitansi)
        $('#dLumpsumpAwal').val(dLumpsumpAwal)
        $('#dLumpsumpAkhir').val(dLumpsumpAkhir)
        $('#nSisaPaguAwal').val(fJumlahAnggaran)
        $('#nSisaPaguAkhir').val(nSisaPaguAkhir)


        if (iCheckSuratTugas==1){
            $('#iCheckSuratTugas').prop('checked', true);
        }

        if (iChekSpd==1){
            $('#iChekSpd').prop('checked', true);
        }

        if (iChekPenginapan==1){
            $('#iChekPenginapan').prop('checked', true);
        }

        if (iChekTransportasi==1){
            $('#iChekTransportasi').prop('checked', true);
        }

        if (iChekPengeluaran==1){
            $('#iChekPengeluaran').prop('checked', true);
        }
        
        $('#iChekSpd').val(iChekSpd)
        $('#iChekPenginapan').val(iChekPenginapan)
        $('#iChekTransportasi').val(iChekTransportasi)
        $('#iChekPengeluaran').val(iChekPengeluaran)
        $('#dTerimaSpj').val(dTerimaSpj)
        $('#vDari').val(vDari)
        $('#vTujuan').val(vTujuan)


        $('#id_dpr').val(id);
        $('#vNomorKwitansiDPR').val(vNomorKwitansi);
        $('#dTglKwitansiDPR').val(dTglKwitansi);


        $('.bs-example-modal-lg').modal('hide')

        drawTabelKwitansi(id);
        drawTabelDpr(id);

    }


    function drawTabelKwitansi(id) {
        $("#tabel_detail_penugasan > tbody").html("");
        $("#tabel_detail_penginapan > tbody").html("");
        $("#tabel_detail_repre > tbody").html("");
        var list_item = getListKwitansi(id);
        var pt = JSON.parse(list_item);
        no = 0;
        for(i=0;i<pt.length;i++) {
            no++;

            //penugasan
            if (pt[i].iJenis==1){
                var row_content = '';
                row_content   = '<tr>';
                row_content  += '<td><input type="hidden" readonly class="penugasan_iJenis" name="penugasan_iJenis[]" value="'+pt[i].iJenis+'" ><input style="width: 90%;text-align:right;" type="text" class="penugasan_nHari" name="penugasan_nHari[]" value="'+pt[i].nHari+'" data-a-dec="." data-a-sep=","  ></td>'

                row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="penugasan_nBiaya" name="penugasan_nBiaya[]" value="'+stripCharacters(pt[i].nBiaya)+'" data-a-dec="." data-a-sep="," ></td>'

                row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="penugasan_nJumlah" name="penugasan_nJumlah[]" value="'+stripCharacters(pt[i].nJumlah)+'" data-a-dec="." data-a-sep="," readonly ></td>'

                row_content += '<td><textarea style="width: 100%;" class="penugasan_vKeterangan" name="penugasan_vKeterangan[]" >'+pt[i].vKeterangan+'</textarea></td>';

                row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row_penugasan(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';

                row_content  += '</tr>';
                jQuery("#tabel_detail_penugasan tbody").append(row_content);
                $('.penugasan_nJumlah').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
                $('.penugasan_nBiaya').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
                sum_value_penugasan();
            }

            if (pt[i].iJenis==2){
                var row_content = '';
                row_content   = '<tr>';
                row_content  += '<td><input type="hidden" readonly class="penginapan_iJenis" name="penginapan_iJenis[]" value="'+pt[i].iJenis+'" ><input style="width: 90%;text-align:right;" type="text" class="penginapan_nHari" name="penginapan_nHari[]" value="'+pt[i].nHari+'" data-a-dec="." data-a-sep=","  ></td>'

                row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="penginapan_nBiaya" name="penginapan_nBiaya[]" value="'+stripCharacters(pt[i].nBiaya)+'" data-a-dec="." data-a-sep="," ></td>'

                row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="penginapan_nJumlah" name="penginapan_nJumlah[]" value="'+stripCharacters(pt[i].nJumlah)+'" data-a-dec="." data-a-sep="," readonly ></td>'

                row_content += '<td><textarea style="width: 100%;" class="penginapan_vKeterangan" name="penginapan_vKeterangan[]" >'+pt[i].vKeterangan+'</textarea></td>';

                row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row_penginapan(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';

                row_content  += '</tr>';
                jQuery("#tabel_detail_penginapan tbody").append(row_content);
                $('.penginapan_nJumlah').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
                $('.penginapan_nBiaya').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
                sum_value_penginapan();
            }

            if (pt[i].iJenis==3){
                var row_content = '';
                row_content   = '<tr>';
                row_content  += '<td><input type="hidden" readonly class="repre_iJenis" name="repre_iJenis[]" value="'+pt[i].iJenis+'" ><input style="width: 90%;text-align:right;" type="text" class="repre_nHari" name="repre_nHari[]" value="'+pt[i].nHari+'" data-a-dec="." data-a-sep=","  ></td>'

                row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="repre_nBiaya" name="repre_nBiaya[]" value="'+stripCharacters(pt[i].nBiaya)+'" data-a-dec="." data-a-sep="," ></td>'

                row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="repre_nJumlah" name="repre_nJumlah[]" value="'+stripCharacters(pt[i].nJumlah)+'" data-a-dec="." data-a-sep="," readonly ></td>'

                row_content += '<td><textarea style="width: 100%;" class="repre_vKeterangan" name="repre_vKeterangan[]" >'+pt[i].vKeterangan+'</textarea></td>';

                row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row_repre(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';

                row_content  += '</tr>';
                jQuery("#tabel_detail_repre tbody").append(row_content);
                $('.trans_nBiaya').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
                sum_value_repre();
            }

            if (pt[i].iJenis==4){
             /*   $('.vTransDari').val(pt[i].vTransDari);
                $('.vTransTujuan').val(pt[i].vTransTujuan);
                $('.trans_nBiaya').val(pt[i].nJumlah);
                $('.trans_vKeterangan').val(pt[i].vKeterangan);*/

                var row_content = '';

                row_content   = '<tr>';
              
                row_content  += '<td><input style="width: 90%;text-align:left;" type="text" class="vTransDari" name="vTransDari[]" value="'+pt[i].vTransDari+'" ></td>'

                row_content  += '<td><input style="width: 90%;text-align:left;" type="text" class="vTransTujuan" name="vTransTujuan[]" value="'+pt[i].vTransTujuan+'" ></td>'

                row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="trans_nBiaya" name="trans_nBiaya[]" value="'+pt[i].nJumlah+'" data-a-dec="." data-a-sep="," onkeyup="sum_nilaikwitansi()" ></td>'

                row_content += '<td><textarea style="width: 100%;" class="trans_vKeterangan" name="trans_vKeterangan[]">'+pt[i].vKeterangan+'</textarea></td>';

                row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row_transport(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';

                row_content  += '</tr>';
                
                jQuery("#tabel_detail_transport tbody").append(row_content);
                $('.trans_nBiaya').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
                sum_value_trans();
            }
        }
    }

    function  getListKwitansi(id) {
        var url = "<?php echo site_url().'/rencana/getListKwitansi'; ?>";
        return $.ajax({
            type: 'POST',
            data:'id='+id, 
            url: url,
            async:false
        }).responseText
    }

    function drawTabelDpr(id) {
        $("#tabel_detail_dpr > tbody").html("");
        var list_item = getListDpr(id);
        var pt = JSON.parse(list_item);
        no = 0;
        for(i=0;i<pt.length;i++) {
            no++;
            console.log(pt[i].nJumlah)
            var row_content = '';
            row_content   = '<tr>';
            row_content  += '<td><span class="tabel_detail_dpr_num">'+no+'</span></td>';

            row_content  += '<td><input style="width: 90%;text-align:left;" type="text" class="dpr_vPerincian" name="dpr_vPerincian[]" value="'+pt[i].vPerincian+'"  ></td>'
            row_content  += '<td><input style="width: 90%;text-align:right;" type="text" class="dpr_nJumlah" name="dpr_nJumlah[]" value="'+stripCharacters(pt[i].nJumlah)+'" data-a-dec="." data-a-sep=","  ></td>'
            row_content  += '<td style="text-align:center;"><a href="javascript:;" onclick="del_row_dpr(this)"><i class="fa fa-fw fa-trash"></i></a></span></td>';
            row_content  += '</tr>';
           
            jQuery("#tabel_detail_dpr tbody").append(row_content);
            $('.dpr_nJumlah').autoNumeric('init', {vMin:'0', vMax:'999999999999999999'});
             
        }
       
        sum_value_dpr();


    }

    function getListDpr(id) {
        var url = "<?php echo site_url().'/rencana/getListDpr'; ?>";
        return $.ajax({
            type: 'POST',
            data:'id='+id, 
            url: url,
            async:false
        }).responseText
    }

    function simpanData(){
        var id = $('#id').val();
        
        if (id=='' || id==0){
            custom_alert('','Pilih Data SPD terlebih dahulu');
            return false;
        }

        var iCheckSuratTugas    = document.querySelector('.iCheckSuratTugas').checked;
        var iChekSpd            = document.querySelector('.iChekSpd').checked;
        var iChekPenginapan     = document.querySelector('.iChekPenginapan').checked;
        var iChekTransportasi   = document.querySelector('.iChekTransportasi').checked;
        var iChekPengeluaran    = document.querySelector('.iChekPengeluaran').checked;
        var dTerimaSpj          = $('#dTerimaSpj').val();

        if (iCheckSuratTugas==true){
            val_iCheckSuratTugas = 1;
        }else{
            val_iCheckSuratTugas = 0;
            custom_alert('','Cheklist Surat Tugas Belum terpilih');
            return false;
        }

        if (iChekSpd==true){
            val_iChekSpd = 1;
        }else{
            val_iChekSpd = 0;
            custom_alert('','Cheklist  SPD Yang Telat TTD Pejabat Pengesahan (Rampung) Belum terpilih');
            return false;
        }

        if (iChekPenginapan==true){
            val_iChekPenginapan = 1;
        }else{
            val_iChekPenginapan = 0;
        }

        if (iChekTransportasi==true){
            val_iChekTransportasi = 1;
        }else{
            val_iChekTransportasi = 0;
        }

        if (iChekPengeluaran==true){
            val_iChekPengeluaran = 1;
        }else{
            val_iChekPengeluaran = 0;
        }

        if (dTerimaSpj==''){
            custom_alert('','Lengkapi Tanggal Terima SPJ');
            return false;
        }

        

        
        var url = "<?php echo site_url().'/rencana/simpanData'; ?>";
        var jwb = confirm("Simpan data ini ?");
        if (jwb==1){

            $.ajax({
                url: url,
                type: 'post',
                data: 'id='+id+'&iCheckSuratTugas='+val_iCheckSuratTugas+'&iChekSpd='+val_iChekSpd+'&iChekPenginapan='+val_iChekPenginapan+'&iChekTransportasi='+val_iChekTransportasi+'&iChekPengeluaran='+iChekPengeluaran+'&dTerimaSpj='+dTerimaSpj,
                success: function(data) {
                    if (data == 1) {
                        custom_alert('',"Data berhasil disimpan",'success');
                        return false;
                    }else {
                       alert("Data Gagal disimpan");
                       return false;
                    }
                }
            })
           
        }
    }




    function simpanDataKwitansi() {
        var vNomorKwitansi  = $('#vNomorKwitansi').val();
        var dTglKwitansi    = $('#dTglKwitansi').val();
        var dLumpsumpAwal   = $('#dLumpsumpAwal').val();
        var dLumpsumpAkhir  = $('#dLumpsumpAkhir').val();
        var nNilaiKwitansi  = $('#nNilaiKwitansi').val();

        if (vNomorKwitansi==''){
            //custom_alert('','Masukan Nomor Kuitansi');
            //return false;
        }

        if (dTglKwitansi==''){
            custom_alert('','Masukan Tanggal Kuitansi');
            return false;
        }



        if (dLumpsumpAwal=='' || dLumpsumpAkhir=='' ){
            custom_alert('','Lengkapi data Lumpsump');
            return false;
        }

         if (nNilaiKwitansi=='' || nNilaiKwitansi==0){
            custom_alert('','Nilai Kuitansi Masih 0');
            return false;
        }


        var url = "<?php echo site_url().'/rencana/simpanDataKwitansi'; ?>";
        var jwb = confirm("Simpan data ini ?");
        if (jwb==1){

            $.ajax({
                url: url,
                type: 'post',
                data: $('#form_data_kwitansi').serialize(),
                success: function(data) {
                    x_data = data.split('|');
                    if (x_data['0'] == 1) {
                        custom_alert('',"Data berhasil disimpan",'success');
                        $('#vNomorKwitansi').val(x_data['1']);
                        return false;
                    }else {
                       alert("Data Gagal disimpan");
                       return false;
                    }
                }
            })
           
        }

    }

    function simpanDataDpr() {

        if ($('#id_dpr').val()==0){
            custom_alert('Opps','Please select Data SPD');
            return false;
        }

        if ($('.dpr_vPerincian').val() == undefined) {
            custom_alert('','Tidak ada data untuk disimpan!');
            return false;
        }else{
            i=0;
            tot_err=0;

            $('.dpr_vPerincian').each(function() {
                if ($('.dpr_vPerincian').eq(i).val() == '') {                                                  
                        custom_alert('','Lengkapi Perincian Biaya');
                        $('.dpr_vPerincian').eq(i).focus();
                        tot_err++;              
                }
                i++;                                                                                
            });
    
            if (tot_err > 0) {
                return false;
            }

            i=0;
            $('.dpr_nJumlah').each(function() {
                if ($('.dpr_nJumlah').eq(i).val() == '' || $('.dpr_nJumlah').eq(i).val() == 0) {
                        custom_alert('','Lengkapi Jumlah');
                        $('.dpr_nJumlah').eq(i).focus();
                        tot_err++;              
                }
                i++;                                                                                
            });
    
            if (tot_err > 0) {
                return false;
            }


            var url = "<?php echo site_url().'/rencana/simpanDataDpr'; ?>";
            var jwb = confirm("Simpan data ini ?");
            if (jwb==1){

                $.ajax({
                    url: url,
                    type: 'post',
                    data: $('#form_data_dpr').serialize(),
                    success: function(data) {
                        if (data == 1) {
                            custom_alert('',"Data berhasil disimpan",'success');
                            return false;
                        }else {
                           alert("Data Gagal disimpan");
                           return false;
                        }
                    }
                })
               
            }
        }
    }


    function cetakKwitansi() {
        if ($('#cetakKwitansi').val()==''){
            //custom_alert('','Masukan Nomor Kuitansi');
            //$('#cetakKwitansi').focus();
            custom_alert('','Simpan data terlebih dahulu');
            return false;
        }
        $('.modal_cetak_kwitansi').modal('show');
    }

    function prosesCetakKwitansi() {
        var id = $('#id').val();
        var vNomorKwitansi    = $('#vNomorKwitansi').val();
        var vPejabatKwitansi    = $('#vPejabatKwitansi').val();
        var vBendaharaKwitansi  = $('#vBendaharaKwitansi').val();
        var dibuatdiKwitansi    = $('#dibuatdiKwitansi').val();
        var tgl_dibuatKwitansi  = $('#tgl_dibuatKwitansi').val();
        var terbilang  = $('#terbilang').val();

        if (vPejabatKwitansi == "" || vBendaharaKwitansi == "" || dibuatdiKwitansi == "" || tgl_dibuatKwitansi == ""){
            custom_alert('','Lengkapi data cetakan');
            return false();
        }

        var url = "<?php echo site_url();?>/rencana/cetakkwitansi?id="+id+"&vPejabatKwitansi="+vPejabatKwitansi+"&vBendaharaKwitansi="+vBendaharaKwitansi+"&dibuatdiKwitansi="+dibuatdiKwitansi+"&tgl_dibuatKwitansi="+tgl_dibuatKwitansi+'&terbilang='+terbilang+"&vNomorKwitansi="+vNomorKwitansi

        var jwb = confirm('Cetak Kuitansi ?');

        if (jwb==1){
            document.getElementById('iframe_preview').src = url;
        }
        
    }


    function cetakRincianPerjadin() {
        $('.modal_cetak_perjadin').modal('show');
    }

    function prosesCetakperjadin() {
        var id = $('#id').val();
        var vPejabatperjadin    = $('#vPejabatperjadin').val();
        var vBendaharaperjadin  = $('#vBendaharaperjadin').val();
        var dibuatdiperjadin    = $('#dibuatdiperjadin').val();
        var tgl_dibuatperjadin  = $('#tgl_dibuatperjadin').val();
        var terbilang  = $('#terbilang').val();

        if (vPejabatperjadin == "" || vBendaharaperjadin == "" || dibuatdiperjadin == "" || tgl_dibuatperjadin == ""){
            custom_alert('','Lengkapi data cetakan');
            return false();
        }
        
        var url = "<?php echo site_url();?>/rencana/cetakperjadin?id="+id+"&vPejabatperjadin="+vPejabatperjadin+"&vBendaharaperjadin="+vBendaharaperjadin+"&dibuatdiperjadin="+dibuatdiperjadin+"&tgl_dibuatperjadin="+tgl_dibuatperjadin+'&terbilang='+terbilang

        var jwb = confirm('Cetak Rincian Biaya Perjadin ?');

        if (jwb==1){
            document.getElementById('iframe_preview').src = url;
        }
    }


    function cetakDpr() {
         $('.modal_cetak_dpr').modal('show');
    }

    function prosesCetakdpr() {
        var id = $('#id').val();
        var vPejabatdpr    = $('#vPejabatdpr').val();
        var dibuatdidpr    = $('#dibuatdidpr').val();
        var tgl_dibuatdpr  = $('#tgl_dibuatdpr').val();
        
        if (vPejabatdpr == "" || dibuatdidpr == "" || tgl_dibuatdpr == ""){
            custom_alert('','Lengkapi data cetakan');
            return false();
        }
        var url = "<?php echo site_url();?>/rencana/cetakdpr?id="+id+"&vPejabatdpr="+vPejabatdpr+"&dibuatdidpr="+dibuatdidpr+"&tgl_dibuatdpr="+tgl_dibuatdpr

        var jwb = confirm('Cetak DPR ?');

        if (jwb==1){
            document.getElementById('iframe_preview').src = url;
        }
    }
    
</script>