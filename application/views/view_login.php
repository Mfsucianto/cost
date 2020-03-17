<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ASIK</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link rel="icon" href="<?=base_url()?>/images/logo_asik_only.png" type="image/gif">

        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/square/blue.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/animate.css') ?>" rel="stylesheet" type="text/css" />

      <!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
 -->
    </head>
     <style type="text/css">
            html{ height:100%; }
                body{ min-height:84%; padding:0; margin:0; position:relative; }
                header{ height:50px; background:lightcyan; }
                /*footer{ background:PapayaWhip; }*/

                /* Trick: */
                body {
                  position: relative;
                }

                body::after {
                  content: '';
                  display: block;
                  height: 75px; /* Set same as footer's height */
                }

                footer {
                  position: absolute;
                  bottom: 0;
                  width: 100%;
                  height: 70px;
                }
            .rcorners1 {
                border-radius: 54px;
                background: 
                #73AD21;
                padding: 20px;
                width: 350px;
                height: 222px;
            }
        </style>
    <body class="login-page" style="background-image: url('<?php echo base_url('images/bg_login.png') ?>')">
    
        <center>
          <center><img  src="<?php echo base_url('images/logo_asik.png') ?>" style='
width: 250px;
height: 100px;'></center>
        </center>
        <div class="login-box">
            <div class="login-logo">
                
            </div><!-- /.login-logo -->
                
                <!-- ============================================================ -->
                <center><img class="animated infinite pulse delay-2s" src="<?php echo base_url('images/login_logo.png') ?>" style='
width: 250px;
height: 100px;'></center>
                <div class="box box-info login-box-body animated  fadeInRight rcorners1" style="background-color: blue;">
                    <div class="box-header">
                      <center><span style="font-size: 20px;color:white;font-weight: bold;">Silahkan Login</span></center>
                        
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class=""  action="<?php echo site_url('auth/login') ?>" method="post" >
                        <center>
                      <div class="box-body ">
                        <div class="form-group">
                          
                          <div class="col-sm-8 input-group input-group-sm">
                            <input type="text" id='userid' name="userid" class="form-control" placeholder="User Id"/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          
                          <div class="col-sm-8 input-group input-group-sm">
                             <input type="password" id="password" name="password" class="form-control input-group.input-group-sm" placeholder="Password"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                          </div>
                        </div>
                        
                      </div>

                      <!-- /.box-body -->
                       <a style="margin-left: 137px;" onclick="checkLogin('<?php echo site_url(); ?>')" class="btn btn-danger  ">Login</a>
                       
                      <!-- /.box-footer -->
                    </form>
                  </div>

                

        </div><!-- /.login-box -->


        <script src="<?php echo base_url('assets/js/sweetalert2.min.js') ?>" type="text/javascript"></script>

        

        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
        
       
    </body>

    <footer style="">
        
             
    </footer>
</html>

<script>
    $(document).ready(function() {
        $("#password").on('keyup', function (e) {
            if (e.keyCode === 13) {
                var url = '<?php echo site_url(); ?>';
                checkLogin(url);
            }
        });
    });


    function checkLogin(url) {
        
        var userid = $('#userid').val();
        var password = $('#password').val();
        if (userid==''){
            Swal.fire({
              icon: 'error',
              title: 'Masukan User Id!',
              showClass: {
                popup: 'animated fadeInDown faster'
              },
              hideClass: {
                popup: 'animated fadeOutUp faster'
              }
            })
            $('#userid').focus();

          
            return false;
        }

        if (password==''){
            Swal.fire({
              icon: 'error',
              title: 'Masukan Password!',
              showClass: {
                popup: 'animated fadeInDown faster'
              },
              hideClass: {
                popup: 'animated fadeOutUp faster'
              }
            })
            $('#password').focus();
            return false;
        }

        login(url,userid,password);
    }

        function login(url,userid,password){
            $.post(url+"/Auth/login", {
                _userid:userid,_password:password}, function(data) {
                if (data > 0) {
                    location.reload();
                } else {
                   
                    Swal.fire({
                      icon: 'error',
                      title: 'User Id dan Password tidak cocok'
                    })
                   return false;
                }
                
            }); 
      }
</script>