<!DOCTYPE html>

<html lang="en">

<?php error_reporting(0); ?>
<head>
<meta charset="utf-8" />
<title>Admin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<link rel="shortcut icon" type="image/x-icon" href="<?= assets_path.'img/logo.png'; ?>">
<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link
	href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/font-awesome/css/font-awesome.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/simple-line-icons/simple-line-icons.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/bootstrap/css/bootstrap.min.css"
	rel="stylesheet" type="text/css" />
<!--<link
	href="<?php echo theme_assets_path; ?>global/plugins/uniform/css/uniform.default.css"
	rel="stylesheet" type="text/css" />-->
<link
	href="<?php echo theme_assets_path; ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
	rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- for autocomplete -->
<link rel="stylesheet"
	href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link
	href="<?php echo theme_assets_path; ?>global/plugins/bootstrap-daterangepicker/daterangepicker.min.css"
	rel="stylesheet" type="text/css" />
<link href="<?php echo theme_assets_path; ?>global/plugins/morris/morris.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/fullcalendar/fullcalendar.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/jqvmap/jqvmap/jqvmap.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/datatables/datatables.min.css"
	rel="stylesheet" type="text/css" />
<!--<link
	href="<?php echo theme_assets_path; ?>global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
	rel="stylesheet" type="text/css" />-->
<link
	href="<?php echo theme_assets_path; ?>global/plugins/bootstrap-daterangepicker/daterangepicker.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/bootstrap-summernote/summernote.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/select2/css/select2.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>global/plugins/select2/css/select2-bootstrap.min.css"
	rel="stylesheet" type="text/css" />
	<link href="<?php echo theme_assets_path; ?>global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
<!-- MY CSS -->
<link href="<?php echo theme_path; ?>css/style.css" rel="stylesheet"
	type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo theme_assets_path; ?>global/css/components.min.css"
	rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo theme_assets_path; ?>global/css/plugins.min.css"
	rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link
	href="<?php echo theme_assets_path; ?>layouts/layout2/css/layout.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo theme_assets_path; ?>layouts/layout2/css/themes/blue.min.css"
	rel="stylesheet" type="text/css" id="style_color" />
<link
	href="<?php echo theme_assets_path; ?>layouts/layout2/css/custom.min.css"
	rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<style>
.my-toggle:hover{
	padding-bottom:0px!important;
	
}

</style>
	<?php 	
		$queryeb = $this->db->query('SELECT * FROM notifications WHERE status_id=1 AND notify_for=0 ORDER By id DESC');
		$queryebc = $this->db->query('SELECT * FROM notifications WHERE status_id=1 AND notify_for=0 AND read_status=0 ORDER By id DESC');
		$notifcnt= $queryebc->num_rows();
		$notifcntall= $queryeb->num_rows();
		$notifi= $queryeb->result();
	?>
<body
	class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
	<script> 
    	var base_url = '<?php echo base_url();?>';
   	</script>

	<!-- BEGIN HEADER -->
	<div class="page-header navbar navbar-fixed-top">
		<!-- BEGIN HEADER INNER -->
		<div class="page-header-inner ">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
					<a
					href="<?php echo base_url('admin'); ?>">
					 <img
					src="<?php echo theme_assets_path; ?>layouts/layout2/img/nav-logo.png"
					alt="logo" class="logo-default" />
				</a>
				<div class="menu-toggler sidebar-toggler">
					<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
				</div>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler responsive-toggler"
				data-toggle="collapse" data-target=".navbar-collapse"> </a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<div class="page-actions">
					<!-- <a href="<?php base_url('admin'); ?>">
					<img
					src="<?php echo theme_assets_path; ?>layouts/layout2/img/">
									</a> -->
			</div>
			<!-- BEGIN PAGE TOP -->
			<div class="page-top">

				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<form name="workspace_form"
						action="<?php echo base_url('login/change_current_academic_year');?>"
						method="post" style="display: inline;">
						<ul class="nav navbar-nav pull-right">


							<!-- BEGIN USER LOGIN DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            
                            <!--start user notification bar-->
							<?php if($_SESSION['profile']->flag == 0){ ?>
							<li class="dropdown dropdown-user">
								<a href="javascript:;"
								class="dropdown-toggle my-toggle" data-toggle="dropdown"
								data-hover="dropdown" data-close-others="true"> <img alt="" class="img-circle" src="<?php echo theme_assets_path; ?>layouts/layout2/img/notification.png" />
								<span class="username username-hide-on-mobile"> <?php echo $this->session->userdata('first_name');?> </span>
								<span class="badge label-danger" id="notifcnt"><?= $notifcnt; ?></span>
								</a>
								
								<ul class="dropdown-menu dropdown-menu-default" style="height:140px; overflow:auto;" >
								
								<div id="ajaxnotifications" class="first-note">
								<?php 
								if($notifcntall>0)
									{
									if($notifcntall>4)
									{
										$counter=4;
									}else{
										$counter=$notifcntall;
									}
									for($i=0;$i<$counter;$i++){ 
										if($notifi[$i]->type==1){
											$note="<i class='icon-plus'></i> New Enquiry Message";
										}else if($notifi[$i]->type==2){
											$note="<i class='icon-cloud-download'></i> Appointment Request";
										}else if($notifi[$i]->type==3){
											$note="<i class='icon-envelope'></i> New Subscriber";
										}else if($notifi[$i]->type==4){
											$note="<i class='icon-users'></i> New Blogs Comment";
										}else if($notifi[$i]->type==5){
											$note="<i class='icon-users'></i> New User Registered";
										}else if($notifi[$i]->type==6){
											$note="<i class='fa fa-cart-plus'></i> New Orders Placed";
										}else if($notifi[$i]->type==7){
											$note="<i class='fa fa-cart-plus'></i> New Review & Rating on product";
										}
									?>
									<li style="padding:8px 5px; <?php if($notifi[$i]->read_status==0){ ?> background: antiquewhite; <?php } ?>" >
										<a style="padding-left: 7px;" href="javascript:void(0);" onclick="view_notifi(<?= $notifi[$i]->id ?>)" > <?= $note; ?> </a>
									</li>
									
								<?php } } else { echo '<li style="padding:8px 5px;background: antiquewhite;text-align:center; "> No Notifications </li>'; }?>	
								</div>
								
								<?php 
								if($notifcntall>0) { ?>									
								<div class="sec-note ">
									<button type="button" class="btn btn-danger center-block "><a  href="<?= base_url('admin/view_all_notifi'); ?>" ><strong>View All</strong></a></button>
								</div>					
								<?php } ?>
								</ul>	
							</li>
							<?php } ?>
							<li class="dropdown dropdown-user"><a href="javascript:;"
								class="dropdown-toggle" data-toggle="dropdown"
								data-hover="dropdown" data-close-others="true"> <img alt=""
									class="img-circle"
									src="<?php echo theme_assets_path; ?>layouts/layout2/img/avatar.png" />
									<span class="username username-hide-on-mobile"> <?php echo $this->session->userdata('first_name');?> </span>
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-default">

									<!-- <li class="divider"> </li> -->
									<li><a href="<?= base_url('admin/profile'); ?>" >
											<i class="icon-user"></i> Profile
									</a></li>
									
									<li><a href="<?= base_url('admin/change_password'); ?>" >
											<i class="icon-lock"></i> Change Password
									</a></li>
									<!-- <li>
                                        <a href="page_user_lock_1.html">
                                            <i class="icon-lock"></i> Lock Screen </a>
                                    </li> -->
									<li><a href="<?php echo base_url('admin/logout');?>"> <i
											class="icon-key"></i> Log Out
									</a></li>
								</ul>
							</li>
							<!-- END USER LOGIN DROPDOWN -->
							
						</ul>
					</form>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
			<!-- END PAGE TOP -->
		</div>
		<!-- END HEADER INNER -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN HEADER & CONTENT DIVIDER -->
	<div class="clearfix"></div>
	<!-- END HEADER & CONTENT DIVIDER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<!-- END SIDEBAR -->
			<div class="page-sidebar navbar-collapse collapse">

				<ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="nav-item <?= $active_menu=='dashboard'?'active':''; ?>">
                    	<a href="<?php echo base_url('admin/dashboard');?>" class="nav-link nav-toggle"> <i class="icon-home"></i> 
                    		<span class="title">Dashboard</span> <span class="arrow"></span>
						</a>
					</li>
					<?php  if($_SESSION['profile']->flag == 0||$_SESSION['profile']->flag == 1||$_SESSION['profile']->flag == 2){ ?>	
					
					<li class="nav-item <?= $active_menu=='users'?'active':''; ?>">
						<a href="<?php echo base_url('admin/users');?>" class="nav-link nav-toggle"> <i class="icon-users"></i> 
							<span class="title">Users</span> <span class="arrow"></span>
						</a>
					</li>
					<li class="nav-item <?= $active_menu=='enquiries'?'active':''; ?>">
						<a href="<?php echo base_url('admin/enquiries');?>" class="nav-link nav-toggle"> <i class="fa fa-phone"></i> 
							<span class="title">Enquiry Messages</span> <span class="arrow"></span>
						</a>
					</li>
					<li class="nav-item <?= $active_menu=='location'?'active':''; ?>">
						<a href="<?php echo base_url('admin/country');?>" class="nav-link nav-toggle"> <i class="fa fa-map-marker"></i> 
							<span class="title">Country / State / City / Area-Pincode</span> <span class="arrow"></span>
						</a>
					</li>
					<li class="nav-item <?= $active_menu=='user_report'?'active':''; ?>">
						<a href="<?php echo base_url('admin/user_report');?>" class="nav-link nav-toggle"> <i class="icon-note"></i> 
							<span class="title">User Report</span> <span class="arrow"></span>
						</a>
					</li>
				 	
    			<?php } if($_SESSION['profile']->flag == 0){ ?>	
					<!-- <li class="nav-item <?= $active_menu=='admin_user'?'active':''; ?>">
						<a href="<?php echo base_url('admin/admin_user');?>" class="nav-link nav-toggle"> <i class="icon-users"></i> 
							<span class="title">Admin</span> <span class="arrow"></span>
						</a>
					</li> -->
					
					<li class="nav-item <?= $active_menu=='foundation'?'active':''; ?>">
						<a href="<?php echo base_url('admin/add_foundation');?>" class="nav-link nav-toggle"> <i class="glyphicon glyphicon-briefcase"></i> 
							<span class="title">Foundation</span> <span class="arrow"></span>
						</a>
					</li>
					
					<li class="nav-item <?= $active_menu=='marital_status'?'active':''; ?>">
						<a href="<?php echo base_url('admin/add_marital_status');?>" class="nav-link nav-toggle"> <i class="glyphicon glyphicon-list-alt"></i> 
							<span class="title">Marital Status </span> <span class="arrow"></span>
						</a>
					</li>
					
					<li class="nav-item <?= $active_menu=='language'?'active':''; ?>">
						<a href="<?php echo base_url('admin/add_language');?>" class="nav-link nav-toggle"> <i class="glyphicon glyphicon-text-background"></i> 
							<span class="title">Language</span> <span class="arrow"></span>
						</a>
					</li>
					
					<li class="nav-item <?= $active_menu=='religion'?'active':''; ?>">
						<a href="<?php echo base_url('admin/add_religion');?>" class="nav-link nav-toggle"> <i class="icon-user"></i> 
							<span class="title">Religion</span> <span class="arrow"></span>
						</a>
					</li>

					<li class="nav-item <?= $active_menu=='caste'?'active':''; ?>">
						<a href="<?php echo base_url('admin/add_caste');?>" class="nav-link nav-toggle"> <i class="icon-users"></i> 
							<span class="title">Caste</span> <span class="arrow"></span>
						</a>
					</li>

				<?php } ?>	
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
			<!-- END SIDEBAR -->
		</div>
		<!-- END SIDEBAR -->