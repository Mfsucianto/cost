<?php 
$this->load->view('template/head');
 $this->load->library('lib_util');
?>

<?php
    $this->load->view('template/topbar');
    $this->load->view('template/sidebar');

    if (isset($_GET['id'])){
        $menuid = $_GET['id'];
    }else{
       $menuid = 1;
    }

?>

<section class="content-header">
  <h1>
    Data Utama
    <small></small>
  </h1>
 
</section>


<!-- =============================STRAT DATA UTAMA================================================= -->
<section  class="content" id="data_utama">
    
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
             
            <div class="inner">
              <h3>Data</h3>

              <p>Pegawai</p>
            </div>
            <a href="<?php echo site_url('pegawai') ?>">
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            </a>
            <a href="<?php echo site_url('pegawai') ?>" class="small-box-footer">View list <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>DIPA</h3>

              <p>DIPA</p>
            </div>
            <a href="<?php echo site_url('dipa') ?>">
            <div class="icon">
              <i class="fa fa-bank"></i>
            </div>
            </a>
            <a href="<?php echo site_url('dipa') ?>" class="small-box-footer">View List <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>RKT</h3>

              <p>RKT</p>
            </div>
            <a href="<?php echo site_url('rkt') ?>">
                <div class="icon">
                    <i class="fa fa-file-archive-o"></i>
                </div>
            </a>
            <a href="<?php echo site_url('rkt') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
</section>


<!-- =============================STRAT DATA ST & Cost================================================= -->
<section  class="content" id="data_st" style="display: none;">
    
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
             
            <div class="inner">
              <h3>ST</h3>

              <p>Dan Cost Sheet</p>
            </div>
            <a href="<?php echo site_url('st') ?>">
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            </a>
            <a href="<?php echo site_url('st') ?>" class="small-box-footer">View list ST <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-lime">
            <div class="inner">
              <h3>Penugasan</h3>

              <p>-</p>
            </div>
            <a href="<?php echo site_url('penugasan') ?>">
            <div class="icon">
              <i class="fa fa-bank"></i>
            </div>
            </a>
            <a href="<?php echo site_url('penugasan') ?>" class="small-box-footer">View List Penugasan <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-fuchsia">
            <div class="inner">
              <h3>View SPD</h3>

              <p>-</p>
            </div>
            <a href="<?php echo site_url('vspd') ?>">
            <div class="icon">
              <i class="fa fa-file-archive-o"></i>
            </div>
            </a>
            <a href="<?php echo site_url('vspd') ?>" class="small-box-footer">View List SPD <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
</section>



<!-- =============================STRAT DATA ST & Cost================================================= -->
<section  class="content" id="data_spj" style="display: none;">
    
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
             
            <div class="inner">
              <h4>Data Rencana</h4>

              <p>-</p>
            </div>
            <a href="<?php echo site_url('rencana') ?>">
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            </a>
            <a href="<?php echo site_url('rencana') ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-lime">
            <div class="inner">
              <h4>Minitoring</h4>

              <p>Realisasi SPJ</p>
            </div>
            <a href="<?php echo site_url('monitoring_spj') ?>">
            <div class="icon">
              <i class="fa fa-bank"></i>
            </div>
            </a>
            <a href="<?php echo site_url('monitoring_spj') ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
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
       var menuid = '<?php echo $menuid; ?>';
      if (menuid==1){
        open_menu_utama();
      }else if (menuid==2){
        open_menu_st();
      }else if (menuid==4){
        open_menu_spj();
      }

    });


    function open_menu_utama() {
        
        $('#data_utama').show(200);
        $('#data_st').hide(200);
        $('#data_spj').hide(200);

        $('#side_menu_utama').addClass('active');
        $('#side_menu_st').removeClass('active');
        $('#side_menu_spj').removeClass('active');
    }

    function  open_menu_st() {
        
        $('#data_utama').hide(200);
        $('#data_spj').hide(200);
        $('#data_st').show(200);

        $('#side_menu_utama').removeClass('active');
        $('#side_menu_spj').removeClass('active');
        $('#side_menu_st').addClass('active');
    }

    function  open_menu_spj() {
        
        $('#data_utama').hide(200);
        $('#data_st').hide(200);
        $('#data_spj').show(200);

        $('#side_menu_utama').removeClass('active');
        $('#side_menu_st').removeClass('active');
        $('#side_menu_spj').addClass('active');
    }

</script>