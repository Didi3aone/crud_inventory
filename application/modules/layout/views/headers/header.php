<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
        <title> Admin || <?php echo isset($title) ? $title : "" ?></title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Basic Styles -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/smartadmin-production.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/smartadmin-skins.min.css">
        <!-- SmartAdmin RTL Support  -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/smartadmin-rtl.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">

        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/pejuangsubuh.jpg" type="image/x-icon">
        <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/sweetalert2.css">
        <!-- Specifying a Webpage Icon for Web Clip
             Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
        <link rel="apple-touch-icon" href="img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>assets/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url() ?>assets/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url() ?>assets/img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="<?php echo base_url() ?>assets/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?php echo base_url() ?>assets/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?php echo base_url() ?>assets/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
        <?php
        if(isset($css)) {
            foreach($css as $value) {
                echo '<link href="'.base_url($value).'" rel="stylesheet">';
                }
            }
        ?>

    </head>
    <body class="smart-style-1">
        <!-- HEADER -->
        <header id="header">
            <div id="logo-group">
                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo"><p style="color: white;"> <b>SYSTEM PENJUALAN </b></p></span>
                <!-- END LOGO PLACEHOLDER -->
            </div>
            <!-- end projects dropdown -->

            <!-- pulled right: nav area -->
            <div class="pull-right">
                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->
                <!-- #MOBILE -->
                <!-- Top menu profile link : this shows only when top menu is active -->
                <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                    <li class="">
                        <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
                            <img src="/crud_inventory/assets/img/1.png" alt="John Doe" class="online" />  
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- end logout button -->

                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->
            </div>
        <!-- end pulled right: nav area -->
    </header>
	<!-- END HEADER -->

    <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
    <aside id="left-panel">
        <!-- User info -->
        <div class="login-info">
            <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
                <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                    <img src="<?= base_url() ?>assets/img/1.png" alt="me" class="online" /> 
                    <span>
                        <?= $this->session->userdata('username') ?> 
                    </span>
                    <i class="fa fa-angle-down"></i>
                </a> 
            </span>
        </div>
        <!-- end user info -->

        <!-- NAVIGATION : This navigation is also responsive-->
        <nav>
            <ul>
                <li class="active">
                    <a href="<?= site_url('manager/dashboard'); ?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-cubes"></i> <span class="menu-item-parent">Master Item</span></a>
                    <ul>
                        <li class="">
                            <a href="<?= site_url('produk') ?>">List Data Produk</a>
                        </li>
                        <li class="">
                            <a href="<?= site_url('kategori') ?>">List Data Kategori</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Customer</span></a>
                    <ul>
                        <li class="">
                            <a href="<?= site_url('customer') ?>">List Data</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-file-o"></i> <span class="menu-item-parent">Master Transaksi</span></a>
                    <ul>
                        <li class="">
                            <a href="<?= site_url('transaksi') ?>"> List Data Transaksi</a>
                        </li>
                        <li class="">
                            <a href="<?= site_url('transaksi/create') ?>"> Create Transaksi</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Master Report</span></a>
                    <ul>
                        <li class="">
                            <a href="<?= site_url("report/list_pengeluaran") ?>">Report Data Pengeluaran</a>
                        </li>
                        <li class="">
                            <a href="<?= site_url("report/list_pemasukan") ?>">Report Data Pemasukan</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <span class="minifyme" data-action="minifyMenu"> 
            <i class="fa fa-arrow-circle-left hit"></i> 
        </span>
    </aside>
        <!-- END NAVIGATION -->

    <div id="main" role="main">
        <!-- RIBBON -->
        <div id="ribbon">
            <span class="ribbon-button-alignment"> 
                <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                    <i class="fa fa-refresh"></i>
                </span> 
            </span>
            <!-- breadcrumb -->
            <ol class="breadcrumb">
               <?= isset($breadcrumb) ? $breadcrumb : null ?>
            </ol>
            <!-- end breadcrumb -->
        </div>
    <!-- END RIBBON -->
    <!-- load content CMS -->
<!-- END MAIN PANEL -->