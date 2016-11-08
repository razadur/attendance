<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/28/16
 * Time: 2:56 PM
 */
//$base_url = 'localhost/azad/attendance/';
$user = $this->session->userdata('user');
$base_url = base_url();
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from minetheme.com/Endless1.5.1/form_element.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 21 Sep 2014 20:30:47 GMT -->
<head>
    <meta charset="utf-8">
    <title>Endless Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Bootstrap core CSS -->
    <link href="<?php echo $base_url;?>asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo $base_url;?>asset/css/font-awesome.min.css" rel="stylesheet">

    <!-- Pace -->
    <link href="<?php echo $base_url;?>asset/css/pace.css" rel="stylesheet">

    <!-- Chosen -->
    <link href="<?php echo $base_url;?>asset/css/chosen/chosen.min.css" rel="stylesheet"/>

    <!-- Datepicker -->
    <link href="<?php echo $base_url;?>asset/css/datepicker.css" rel="stylesheet"/>

    <!-- Timepicker -->
    <link href="<?php echo $base_url;?>asset/css/bootstrap-timepicker.css" rel="stylesheet"/>

    <!-- Slider -->
    <link href="<?php echo $base_url;?>asset/css/slider.css" rel="stylesheet"/>

    <!-- Tag input -->
    <link href="<?php echo $base_url;?>asset/css/jquery.tagsinput.css" rel="stylesheet"/>

    <!-- WYSIHTML5 -->
    <link href="<?php echo $base_url;?>asset/css/bootstrap-wysihtml5.css" rel="stylesheet"/>

    <!-- Dropzone -->
    <link href='<?php echo $base_url;?>asset/css/dropzone/dropzone.css' rel="stylesheet"/>

    <!-- Endless -->
    <link href="<?php echo $base_url;?>asset/css/endless.min.css" rel="stylesheet">
    <link href="<?php echo $base_url;?>asset/css/endless-skin.css" rel="stylesheet">
</head>

<body class="overflow-hidden">

<div id="wrapper" class="preload">
    <div id="top-nav" class="skin-6 fixed">
    <div class="brand">Attendance System</div><!-- /brand -->
    <button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <ul class="nav-notification clearfix">
        <li class="profile dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <strong><?php echo $user?></strong>
                <span><i class="fa fa-chevron-down"></i></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="clearfix" href="#">
                        <img src="<?php echo $base_url;?>asset/img/user.png" alt="User Avatar">
                        <div class="detail">
                            <strong><?php echo $user?></strong>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/logout')?>" tabindex="-1" data-popup-ordinal="0">
                        <i class="fa fa-lock fa-lg"></i>
                        Log out
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    </div><!-- /top-nav-->

    <aside class="fixed skin-6">
        <div class="sidebar-inner scrollable-sidebar">
            <div class="main-menu">
                <ul style="min-height: 87%">
                    <li class="openable">
                        <a href="#">
                            <span class="menu-icon">
                                <i class="fa fa-tasks fa-lg"></i>
                            </span>
                            <span class="text">
                                Form
                            </span>
                            <span class="menu-hover"></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo site_url('Welcome/empAdd')?>"><span class="submenu-label">Staff Entry</span></a></li>
                        </ul>
                    </li>
					<li class="openable">
                        <a href="#">
                            <span class="menu-icon">
                                <i class="fa fa-tasks fa-lg"></i>
                            </span>
                            <span class="text">
                                Report
                            </span>
                            <span class="menu-hover"></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo site_url('Welcome/empAtt')?>"><span class="submenu-label">Staff Attendance</span></a></li>
                            <li><a href="<?php echo site_url('Welcome/empDetail')?>"><span class="submenu-label">Staff Details</span></a></li>
                        </ul>
                    </li>
                </ul>
                <div class="alert alert-info" style="font-size:10px">
                    Copyright © 2016<br>
                    <strong>
                    ANWER KHAN MODERN MEDICAL COLLEGE HOSPITAL<br>
                    </strong>
                    ALL Rights Reserved.
                </div>
            </div><!-- /main-menu -->
        </div><!-- /sidebar-inner scrollable-sidebar -->
    </aside>
    <div id="main-container">
        <div class="padding-sm" >