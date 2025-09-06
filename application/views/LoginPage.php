<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
    <style>
        .btn-primary{
            background-color:#0276b1;
        }
    </style>
  </head>
  <body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
    <section class="" style="backgeound-color:#0275b1;">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo" style="padding:0px;">
        <center><h1 style="font-family: times;"><center><img src="<?=LOGO?>" width="25%" height="20.25%"></center></h1></center>
      </div>
      <div class="login-box" style="border-radius:25px;">
            <form   class="login-form" 
                    id="login" method="post" 
                    action="<?=base_url()?>AdminController/Verify" 
                    enctype="multipart/form-data" autocomplete="off">
               
                <div class="form-group">
                <label class="control-label">ROLE</label>
                <select class="form-control" placeholder="Role" name="role" autofocus>
                    <?php 
                     foreach ($designations as $designationth){ ?>
                        <option value="<?=$designationth->pos_id?>"><?=$designationth->pos_name.' ('.$designationth->dept_name.' Dept.)'?></option>
                    <?php }?>
                </select>
                </div>
                <div class="form-group">
                <label class="control-label">USERNAME</label>
                <input class="form-control" type="text" placeholder="Username" name="user_name" >
                </div>
                <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control" type="password" placeholder="Password" name="user_password">
                </div>
                 
                  <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
                  </div>
            </form>
                
            <form class="forget-form" action="index.html">
                  <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
                  <div class="form-group">
                    <label class="control-label">EMAIL</label>
                    <input class="form-control" type="text" placeholder="Email">
                  </div>
                  <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
                  </div>
                  <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
                  </div>
            </form>
      
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="<?=base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?=base_url();?>assets/js/popper.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?=base_url();?>assets/js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
      });
      
    
    </script>
  </body>
</html>