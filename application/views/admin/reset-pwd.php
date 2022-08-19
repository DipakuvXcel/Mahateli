<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Reset Password</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo theme_assets_path; ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo theme_assets_path; ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo theme_assets_path; ?>global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo theme_assets_path; ?>global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo theme_assets_path; ?>global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo theme_path; ?>css/login.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="<?php echo base_url('login'); ?>">
                <img src="<?= assets_path.'img/logosm.png'; ?>" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
        	
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="<?php echo base_url("admin/update_reset_password");?>" method="post">
                <h3 class="form-title font-dark">Reset Password</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter valid password </span>
                </div>
                
                <?php if($this->session->flashdata('error_message')!=''){?>
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> <?php echo $this->session->flashdata('error_message');?></span>
                </div>
                <?php }?>
                <?php if($this->session->flashdata('success_message')!=''){?>
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <span> <?php echo $this->session->flashdata('success_message');?></span>
                </div>
                <?php }?>
                <?php if(validation_errors()!=""){?>
				<div
					class="Metronic-alerts alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert"
						aria-hidden="true"></button>
					<i class="fa-lg fa fa-warning"></i>  <?php echo validation_errors();?>
				</div>
				<?php }?>
                
				<input type="hidden" name="user_id" value="<?= $id; ?>" />
				<input type="hidden" name="random_no" value="<?= $random_no; ?>" />
				
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">New Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off"
                     placeholder="New Password" name="new_password" value="<?php echo set_value('new_password');?>"/> 
                </div>
				<div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off"
                     placeholder="Confirm Password" name="confirm_password" value="<?php echo set_value('confirm_password');?>"/> 
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn font-green uppercase">Reset</button>
                </div>
                
            </form>
            
            
        </div>
        <!-- <div class="copyright"> Designed & Developed by <a href="http://www.angularminds.com" target="_blank">Angular Minds</a></div> -->
        <!--[if lt IE 9]>
<script src="<?php echo theme_assets_path; ?>global/plugins/respond.min.js"></script>
<script src="<?php echo theme_assets_path; ?>global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo theme_assets_path; ?>global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo theme_assets_path; ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo theme_assets_path; ?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo theme_assets_path; ?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo theme_assets_path; ?>global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo scripts_path; ?>login.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>