<!-- Left side column. contains the sidebar -->
<?php
    $cUserId    = $this->session->userdata('cUserId');
    $vUserName  = $this->session->userdata('vUserName');
    $iPeran      = $this->session->userdata('iPeran');
    $vUnitName     = $this->session->userdata('vUnitName');
    $nama_akses     = $this->session->userdata('nama_akses');
    $vImage     = $this->session->userdata('vImage');
    if ($vImage==''){
        $vImage = 'logo.png';
    }
    
  
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image" style="padding-left: 25px;">
              <img src="<?php echo base_url("images/user/".$vImage) ?>" class="img-circle" alt="" style='width: 150px;height: 150px;' >
            </div>
            <div class="info">
                <center>
                    <span style="font-size: 19px;"><?php echo $this->session->userdata('vUserName') ?></span>
                    <br>

              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $nama_akses; ?> <i class="fa fa-fw fa-pencil-square"></i></a>
               </center>
            </div>
            <legend></legend>
        </div>
        <!-- search form -->
       
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"></li>
             

            <?php
                //$peran = array(0=>'',1=>'Admin',2=>'Pegawai',3=>'Kepala Bagian',4=>'Sub Bagian',5=>'Skretaris Bidang',6=>'Kepala Perwakilan',7=>'Admin SPD');


                if ($iPeran==1){ //Admin
                    ?>

                    <li  id='side_menu_utama'>
                         <a href="<?php echo site_url('?id=1') ?>" > <i><span class="glyphicon glyphicon-folder-open"></span></i> <span>Data Utama</span> <span class="pull-right-container"> </span> </a> 
                    </li>

                    <li id="side_menu_st">
                         <a href="<?php echo site_url('?id=2') ?>"  > <i><span class="glyphicon glyphicon-duplicate"></span></i> <span>ST & Cost Sheet</span> <span class="pull-right-container"> </span> </a> 
                    </li> 

                    <li>
                         <a href="<?php echo site_url('/spd') ?>"> <i><span class="glyphicon glyphicon-file"></span></i> <span>SPD</span> <span class="pull-right-container"> </span> </a> 
                    </li>

                    <li  id="side_menu_spj">
                         <a href="<?php echo site_url('?id=4') ?>"> <i><span class="glyphicon glyphicon-file"></span></i> <span>SPJ</span> <span class="pull-right-container"> </span> </a> 
                    </li>

                    <li>
                         <a href="<?php echo site_url('/monitoring_anggaran') ?>"> <i><span class="glyphicon glyphicon-search"></span></i> <span>Monitoring</span> <span class="pull-right-container"> </span> </a> 
                    </li>




                    <?php
                }else if ($iPeran==7){ //Admin SPD
                    ?>

                   

                    <li id="side_menu_st">
                         <a href="<?php echo site_url('?id=2') ?>"  > <i><span class="glyphicon glyphicon-duplicate"></span></i> <span>ST & Cost Sheet</span> <span class="pull-right-container"> </span> </a> 
                    </li> 

                    <li>
                         <a href="<?php echo site_url('/spd') ?>"> <i><span class="glyphicon glyphicon-file"></span></i> <span>SPD</span> <span class="pull-right-container"> </span> </a> 
                    </li>

                   


                    <?php
                }else if ($iPeran < 99){
                    ?>
                        <li >
                             <a href="<?php echo site_url('/home') ?>"  > <i><span class="glyphicon glyphicon-duplicate"></span></i> <span>ST & Cost Sheet</span> <span class="pull-right-container"> </span> </a> 
                        </li>

                        <li >
                             <a href="<?php echo site_url('penugasan') ?>"  > <i><span class="glyphicon glyphicon-duplicate"></span></i> <span>Penugasan</span> <span class="pull-right-container"> </span> </a> 
                        </li>

                        <li >
                             <a href="<?php echo site_url('vspd') ?>"  > <i><span class="glyphicon glyphicon-duplicate"></span></i> <span>View SPD</span> <span class="pull-right-container"> </span> </a> 
                        </li>

                        <?php 
                            if ($iPeran!=2){
                                ?>
                                     <li >
                                         <a href="<?php echo site_url('monitoring_anggaran') ?>"  > <i><span class="glyphicon glyphicon-duplicate"></span></i> <span>Monitoring</span> <span class="pull-right-container"> </span> </a> 
                                    </li>

                                <?php
                            }
                        ?>
                       

                    <?php
                }

            ?>
             


             <?php
                if ($iPeran==99){
                    ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    
                    <li><a href="<?php echo site_url('jabatan') ?>"><i class="fa fa-circle-o"></i> Data Jabatan</a></li>
                    <li><a href="<?php echo site_url('bidang') ?>"><i class="fa fa-circle-o"></i> Data Bidang</a></li>
                    <li><a href="<?php echo site_url('pegawai') ?>"><i class="fa fa-circle-o"></i> Data Pegawai</a></li>
                </ul>
            </li> 

                    <?php
                }

            ?>



          


             
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

