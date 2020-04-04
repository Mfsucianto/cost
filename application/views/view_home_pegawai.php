<?php 
$this->load->view('template/head');
 $this->load->library('lib_util');
?>

<?php
    $this->load->view('template/topbar');
    $this->load->view('template/sidebar');


?>




<!-- =============================STRAT DATA ST & Cost================================================= -->
<section  class="content" id="data_st_only" >
    
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
            <div class="small-box bg-maroon">
                 
                <div class="inner">
                  <h5>Buat ST</h5>

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
    </div>
</section>

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->

<?php
$this->load->view('template/foot');
?>
