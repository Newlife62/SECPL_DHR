<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('role')==''){
    echo "<script>window.location='".  base_url()."Login';</script>";
}
?> <!DOCTYPE html>
<html lang="en">
  <head>
    <!--<meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">-->
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title><?=TITTLE?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>var baseurl='<?=base_url()?>';</script>
    <style>
        @media only screen and (min-device-width: 480px){
            #modal-dialog{
                width:100%;
            }
        }
         @media only screen and (min-device-width: 768px){
            #modal-dialog{
                width:60%;
            }
        }
        
        .btn-primary{
            background-color:#0276b1;
        }
    </style>
    
  </head>
  <body class="app sidebar-mini rtl"  onselectstart="return true" ondragstart="return false">
    <!-- Navbar  oncontextmenu="return false"-->
    <header class="app-header" style="background-color:#0278b5"><a class="app-header__logo" href="<?php echo base_url();?>AdminController" style="font-family: times;background-color:white;"><img src="<?=LOGO?>" width="60%" height="35px;"></a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li hidden class="app-search" >
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!--Notification Menu-->
        <li hidden class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">You have 4 new notifications.</li>
            <div class="app-notification__content">
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Lisa sent you a mail</p>
                    <p class="app-notification__meta">2 min ago</p>
                  </div></a></li>
              
            </div>
            <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
          </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><img class="app-sidebar__user-avatar" src="<?=base_url($this->session->userdata('user_photo'))?>" style="height:15%;width:15%;margin-left:85%" alt="User Image"></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <!--<li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li>-->
            <li><a class="dropdown-item" href="<?= base_url()?>AdminController/Logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?=base_url($this->session->userdata('user_photo'))?>" style="height:15%;width:15%;" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?=ucwords($this->session->userdata('user'));?></p>
          <p class="app-sidebar__user-designation"><?=ucwords($this->session->userdata('role'));?></p>
        </div>
      </div>
      <ul class="app-menu">
          <li><a class="app-menu__item active" href="<?= base_url()?>AdminController"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dash board</span></a></li>
          <li <?=$this->session->userdata('role')=='ADMINISTRATOR'?'':'hidden'?>><a class="app-menu__item active" href="<?= base_url()?>AdminController/AddBOMItems"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Add BOM Items</span></a></li>
           <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Stages</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li ><a class="treeview-item" href="<?=base_url()?>AdminController/StageOneOrdersList" style="background-color:#ffff66;color:black;border-radius:12px;"><i class="icon fa fa-circle-o"></i> Stage-1</a></li>
            <li ><a class="treeview-item" href="<?=base_url()?>AdminController/StageTwoOrdersList" style="background-color:#bee8c2;color:black;border-radius:12px;"><i class="icon fa fa-circle-o"></i> Stage-2</a></li>
            <li ><a class="treeview-item" href="<?=base_url()?>AdminController/StageThreeOrdersList" style="background-color:#ff9999;color:black;border-radius:12px;"><i class="icon fa fa-circle-o"></i> Stage-3</a></li>
            <li ><a class="treeview-item" href="<?=base_url()?>AdminController/StageFourOrdersList" style="background-color:#bddde9;color:black;border-radius:12px;"><i class="icon fa fa-circle-o"></i> Stage-4</a></li>
          </ul>
        </li>
        <li <?=in_array($this->session->userdata('role'),array('ADMINISTRATOR','EXECUTIVE','MANAGER'))?'':'hidden'?>><a class="app-menu__item " href="<?= base_url()?>AdminController/COAList"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">COA</span></a></li>
        <li <?=$this->session->userdata('role')=='ADMINISTRATOR'?'':'hidden'?>><a class="app-menu__item " href="<?= base_url()?>AdminController/AddSchools"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Add Company</span></a></li>

        <li <?=$this->session->userdata('role')=='ADMINISTRATOR'?'':'hidden'?>><a class="app-menu__item " href="<?= base_url('staff_list/ALL')?>"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Add Staff</span></a></li>

        <li hidden ><a class="app-menu__item " href="<?= base_url()?>AdminController/AddExpense"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Add Expense</span></a></li>

        
        
       <li  class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Reports</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?=base_url()?>AdminController/DHR_Report"><i class="icon fa fa-circle-o"></i> DHR PROD Report</a></li>
             <li><a class="treeview-item" href="<?=base_url()?>AdminController/DHR_Store_Report"><i class="icon fa fa-circle-o"></i> DHR Store Report</a></li>
            <li><a class="treeview-item" href="<?=base_url()?>AdminController/QCReport"><i class="icon fa fa-circle-o"></i> DHR QC Report</a></li>
            <li><a class="treeview-item" href="<?=base_url()?>AdminController/QAReport"><i class="icon fa fa-circle-o"></i> DHR QA Report</a></li>
            <li><a class="treeview-item" href="<?=base_url()?>AdminController/COAReport"><i class="icon fa fa-circle-o"></i> COA Report</a></li>
           <!--<li><a class="treeview-item" href="<?=base_url()?>AdminController/LoanInterestChart"><i class="icon fa fa-circle-o"></i> Loan Interest Chart</a></li>-->
           <!--  <li><a class="treeview-item" href="<?=base_url()?>AdminController/GivenDateCollected"><i class="icon fa fa-circle-o"></i> Given Date Share&Loan</a></li>-->
          </ul>
        </li>      

       </ul>
    </aside>