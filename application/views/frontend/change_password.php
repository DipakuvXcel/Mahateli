<?php 
error_reporting(0);
//$this->load->view('frontend/_includes/header');?>
<style>
input{
	border: 1px solid #989898 !important;
}
.fade {
    opacity: 1;
}
</style>

	 
	 
	<section class="bgwhite p-b-65">
		<div class="container">
			<div class="row">

				<div class="col-sm-12 col-md-12 col-lg-12 ">
					<h4 class="p-b-11 m-text24 ">
						Change Password
					</h4>
					<hr> </hr>

						<form class="form-horizontal form-row-seperated" onsubmit="return change_password()"  autocomplete="off" action="javascript:void(0);" method="post" id="change_password_form"  >
						    <div class="row" >
						    <div class="col-md-3 col-lg-3" >
							</div>
						    <div class="col-md-6 col-lg-6" >
								
								<?php if($this->session->flashdata("success_message")!=""){?>
								<div class="Metronic-alerts alert alert-info fade in">
									<button type="button" class="close" data-dismiss="alert"
										aria-hidden="true"></button>
									<i class="fa-lg fa fa-check"></i>  <?php echo $this->session->flashdata("success_message");?>
								</div>
								<?php }?>
								
								<?php if($this->session->flashdata("error_message")!=""){?>
								<div class="Metronic-alerts alert alert-danger fade in">
									<button type="button" class="close" data-dismiss="alert"
										aria-hidden="true"></button>
									<i class="fa-lg fa fa-warning"></i>  <?php echo $this->session->flashdata("error_message");?>
								</div>
								<?php }?>
								
								<?php if(validation_errors()!=""){?>
								<div class="Metronic-alerts alert alert-danger fade in">
									<button type="button" class="close" data-dismiss="alert"
										aria-hidden="true"></button>
									<i class="fa-lg fa fa-warning"></i>  <?php echo validation_errors();?>
								</div>
								<?php }?>
							  
						        <div class="form-group">
						            <label class="control-label">Current Password: </label> <span style="color:red; ">*</span>
						          
						            <input type="password"   class="form-control" name="current_password" id="current_password" value="<?= set_value('current_password'); ?>">
						        </div>
						        <div class="form-group">
						            <label class="control-label">New Password: </label><span style="color:red; ">*</span>
						            
						                <input type="password"   class="form-control" name="new_password" id="new_password">
						        </div>
						        <div class="form-group">
						            <label class="control-label">Confirm Password:  </label><span style="color:red; ">*</span>
						           
						                <input type="password"   class="form-control" name="confirm_password" id="confirm_password">
						        </div>
						    
						        <div class="form-group">
						            <div class="text-center">
									<div class="row">
										<div class="w-size2 p-t-20 col-lg-6 col-md-6 col-sm-6 col-xs-12" >
											<button type="submit" class="flex-c-m size2 bg44 bo-rad-23 hov1 m-text3 trans-0-4" > Update </button>
										</div> 
										
										<div class="w-size2 p-t-20 col-lg-6 col-md-6 col-sm-6 col-xs-12" >
											<button type="reset" class="flex-c-m size2 bg1-overlay bo-rad-23   m-text3 trans-0-4" > Reset </button>
										</div> 
									</div>  
						            </div>
						        </div>
						    </div>
							
							<div class="col-md-4 col-lg-4" >
							</div>
							
						</div>
						</form>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
</section>
<!-- END CONTENT -->
<?php
//$this->load->view ( 'frontend/_includes/footer', $data );
?>