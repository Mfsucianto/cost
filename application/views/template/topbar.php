</head>

<?php
    $user_login = 'N10893';
    $vUserName  = "MF SUCIANTO";
    $vImage     = '';
    if ($vImage==''){
        $vImage = 'logo.png';
    }
   
?>
<body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">

            <a href="#" class="logo">
                <span class="logo-lg"><b >BPKP</b></span>
            </a>

            
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>


                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                        <a href="<?php echo site_url('auth/logout') ?>" >
                          <i class="fa fa-sign-out"></i> Keluar
                          
                        </a></li>


                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->