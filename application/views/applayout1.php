<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Mystatus solutionportal">
    <meta name="keywords" content="rules, change password, mystatus, blacklist, invite friends, unsubscribe ">
    <meta name="author" content="HollaTags">
    <!-- <base href="/"> -->

    <title>Mystatus</title>

    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo base_url();?>fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>fonts/font-awesome/css/font-awesome.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="<?php echo base_url();?>styles/plugins/waves.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/plugins/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/plugins/select2.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/plugins/bootstrap-colorpicker.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/plugins/bootstrap-slider.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/plugins/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/plugins/summernote.css">

    <!-- Css/Less Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url();?>styles/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/main.min.css">



    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>

    <!-- Match Media polyfill for IE9 -->
    <!--[if IE 9]> <script src="<?php echo base_url();?>scripts/ie/matchMedia.js"></script>  <![endif]-->


</head>
<body id="app" class="app off-canvas">

<!-- header -->
<header class="site-head" id="site-head">
    <ul class="list-unstyled left-elems">
        <!-- nav trigger/collapse -->
        <li>
            <a href="javascript:;" class="nav-trigger ion ion-drag"></a>
        </li>
        <!-- #end nav-trigger -->

        <!-- Search box --
        <li>
            <div class="form-search hidden-xs">
                <form id="site-search" action="javascript:;">
                    <input type="search" class="form-control" placeholder="Type here for search...">
                    <button type="submit" class="ion ion-ios-search-strong"></button>
                </form>
            </div>
        </li>	 #end search-box -->

        <!-- site-logo for mobile nav -->
        <li>
            <div class="site-logo visible-xs">
                <a href="home" class="text-uppercase h3">
                    <span class="text">My status</span>
                </a>
            </div>
        </li> <!-- #end site-logo -->

        <!-- fullscreen -->
        <li class="fullscreen hidden-xs">
            <a href="javascript:;"><i class="ion ion-qr-scanner"></i></a>

        </li>	<!-- #end fullscreen -->

    </ul>

    <ul class="list-unstyled right-elems">
        <!-- profile drop -->
        <li class="profile-drop hidden-xs dropdown">
            <a href="javascript:;" data-toggle="dropdown">
                <img src="<?php echo base_url();?>images/admin.png" alt="admin-pic">
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="<?php echo base_url();?>mystatus/user_profile"><span class="ion ion-person">&nbsp;&nbsp;</span>Profile</a></li>
                <li><a href="<?php echo base_url();?>mystatus/rules"><span class="ion ion-settings">&nbsp;&nbsp;</span>Time Settings</a></li>
                <li class="divider"></li>
                <!--<li><a href="javascript:;"><span class="ion ion-lock-combination">&nbsp;&nbsp;</span>Lock Screen</a></li>-->
                <li><a href="<?php echo base_url();?>mystatus/logout"><span class="ion ion-power">&nbsp;&nbsp;</span>Logout</a></li>
            </ul>
        </li>
        <!-- #end profile-drop -->

        <!-- sidebar contact -->



    </ul>

</header>
<!-- #end header -->


<!-- main-container -->
<div class="main-container clearfix">
    <!-- main-navigation -->
    <aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
        <div class="nav-head">
            <!-- site logo -->
            <a href="home" class="site-logo text-uppercase">
                <i class="ion ion-disc"></i>
                <span class="text">My Status</span>
            </a>
        </div>

        <!-- Site nav (vertical) -->

        <nav class="site-nav clearfix" role="navigation">
            <div class="profile clearfix mb15">
                <img src="<?php echo base_url();?>images/admin.png" alt="admin">
                <div class="group">
                    <h5 class="name"><?php echo $p_name ;?></h5>
                    <small class="design text-uppercase"><?php echo $number ;?></small>
                </div>
            </div>

            <!-- navigation -->
            <ul class="list-unstyled clearfix nav-list mb15">

                <li>
                    <a href="<?php echo base_url();?>mystatus/home">
                        <i class="ion ion-ios-person"></i>
                        <span class="text">MyStatus</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url();?>mystatus/contact_mgt">
                        <i class="ion ion-clipboard"></i>
                        <span class="text">Contact Management</span>
                    </a>
                </li>

                <!-- <li>
                     <a href="index.html">
                         <i class="ion ion-monitor"></i>
                         <span class="text">Rules</span>
                     </a>
                 </li>-->

                <li>
                    <a href="<?php echo base_url();?>mystatus/change_password">
                        <i class="ion ion-asterisk"></i>
                        <span class="text">Change password</span>
                    </a>

                </li>

                <!--class="open"-->
                <li>
                    <a href="<?php echo base_url();?>mystatus/black_list">
                        <i class="ion ion-document-text"></i>
                        <span class="text">Blacklist</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>mystatus/invite_friends">
                        <i class="ion ion-ios-personadd"></i>
                        <span class="text">Invite friends</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url();?>mystatus/unsubscribe">
                        <i class="ion ion-android-hand"></i>
                        <span class="text">Unsubscribe</span></a>
                </li>
            </ul> <!-- #end navigation -->
        </nav>

        <!-- nav-foot -->
        <footer class="nav-foot">
            <p>2016 &copy; <span>hollatags.com</span></p>
        </footer>

    </aside>
    <!-- #end main-navigation -->

    <!-- content-here -->
    <div class="content-container" id="content">

        <!-- content-here -->
