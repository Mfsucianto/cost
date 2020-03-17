<?php 
$this->load->view('template/head');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');


?>


<!-- Main content -->
<section class="content">

   <div class="box box-info box-solid">
    <div class="box-header with-border" style="padding: 5px;">
      <h3 class="box-title">Search</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="">
        <div class="input-group input-group-sm">
            <input type="text" class="form-control">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-info btn-flat">Go!</button>
                </span>
        </div>
    </div>
    <!-- /.box-body -->
  </div>

  <div class="box box-warning box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Collapsable</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
              The body of the box
            </div>
            <!-- /.box-body -->
          </div>

</section><!-- /.content -->






<?php 
$this->load->view('template/js');
$this->load->view('template/foot');
?>


