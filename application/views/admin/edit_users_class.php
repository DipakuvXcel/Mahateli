<?php 
	$this->load->view('admin/_includes/header');
	$this->load->helper('custom');
?>
<link href="<?php echo theme_assets_path; ?>multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo theme_assets_path; ?>global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
<style>
	.multiselect-container{
		height: 300px;
	    overflow: auto;
	    width: 320px;
	}
</style>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">
		Edit user Class
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/add_user_class'); ?>">user Class</a>
					<i class="fa fa-angle-right"></i></li>
				<li><span> Edit user Class</span>	
			</ul>
		</div>
		<!-- END PAGE HEADER-->

		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet light ">
					<div class="portlet-title">
						<div class="caption font-dark">
							<i class="icon-settings font-dark"></i> <span
								class="caption-subject bold uppercase"> Edit user Class</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/add_user_class');?>" class="btn btn-circle default"> Back</a>
						</div> 
					</div>
					<div class="portlet-body">
					
						<?php if($this->session->flashdata("success_message")!=""){?>
						<div class="Metronic-alerts alert alert-info fade in">
							<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true"></button>
							<i class="fa-lg fa fa-check"></i>  <?php echo $this->session->flashdata("success_message");?>
						</div>
					  <?php }?>
					  <?php if($this->session->flashdata("error_message")!=""){?>
						<div
							class="Metronic-alerts alert alert-danger fade in">
							<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true"></button>
							<i class="fa-lg fa fa-warning"></i>  <?php echo $this->session->flashdata("error_message");?>
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
			              
					  <?php if( $this->upload->display_errors()!=""){?>
						<div
							class="Metronic-alerts alert alert-danger fade in">
							<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true"></button>
							<i class="fa-lg fa fa-warning"></i>  <?php echo  $this->upload->display_errors();?>
						</div>
					  <?php }?>
		
						<form id="add_student_form" class="horizontal-form" action="<?php echo base_url('admin/update_edit_user_class');?>"
							method="post" enctype="multipart/form-data">
							<div class="form-body">
								<input type="hidden" id="id" name="id" value="<?php echo $coupon->id;?>">
								<div class="row">
									<div class="col-md-6 col-md-push-1">
										<div class="form-group">
											<label class="control-label">Class Name</label><span style="color:red">*</span>
											<input id="class_name" name="class_name" class="form-control" autocomplete="off" type="text" value="<?= set_value('class_name',$coupon->class_name); ?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 col-md-push-1">
										<label class="control-label">Discount On</label><span style="color:red">*</span>
									</div>	
									<div class="col-md-4">
										<label class="radio-inline"> 
											<input type="radio" name="discount_on" onclick="handleClick(this);" value="<?= set_value('discount_on',1); ?>" <?php if($coupon->discount_on==1){ echo "checked"; }?>> Whole Order
										</label>
									 
										<label class="radio-inline"> 
											<input type="radio" name="discount_on" onclick="handleClick(this);" value="<?= set_value('discount_on',2); ?>" <?php if($coupon->discount_on==2){ echo "checked"; }?>> Particular Products
										</label>
									</div>
									<br><br>
								</div>

								<?php 
								$referee_pid = array();
								foreach ($referee_product as $value) {
									array_push($referee_pid, $value->product_id);
								}
								?>
								<div class="row" id="discount_on_div" style="<?php if($coupon->discount_on==1){ echo "display:none"; }?>">
									<div class="col-md-12">
									<div class="col-md-4 col-md-push-4">
										<div class="form-group">
											<label class="control-label">Select Product</label><span style="color:red">  </span>
											<select id="product" name="product[]" class="multiselect-ui form-control" multiple="multiple" onchange="selectProduct(this.value)" value="<?= set_value('product'); ?>"  >
											<!--<option value="">Select Product</option>-->
											<?php 
											for($i=0;$i<count($products);$i++){
											?>
											 <option value="<?=$products[$i]->product_id?>" <?php if(in_array($products[$i]->product_id,$referee_pid)){ echo 'selected'; } ?> title="<?=$products[$i]->product_name?>" ><?=$products[$i]->product_name?></option>
											<?php } ?>
											</select>
										</div>
									</div>
									</div>

									<div class="col-md-12">
									<div class="col-md-12 selectproductdiv" id="selectproductdiv">
									<div class="col-md-12 table table-responsive">
										<table class="table table-responsive table-striped table-bordered">
										<thead>
											<tr>
												<td><strong>Sr No.</strong></td>
												<td style="width:50%"><strong>Product Name</strong></td>
												<!--<td><strong>MRP Price</strong></td>-->
												<td><strong>Discount In</strong></td>
												<td><strong>Discount</strong></td>
												<td><strong>Remove</strong></td>
											</tr>
										</thead>
										</table>
									</div>
					 				</div>
									</div>
								</div>	

								<div class="row" id="discount_in_div" style="<?php if($coupon->discount_on==2){ echo "display:none"; }?>">
									<div class="col-md-3 col-md-push-1">
										<label class="control-label">Discount In</label><span style="color:red">*</span>
									</div>	
									<div class="col-md-3">
										<label class="radio-inline"> 
											<input type="radio" name="discount_in" onclick="handleClick1(this);" value="<?= set_value('discount_in',1); ?>" <?php if($coupon->discount_in==1 || $coupon->discount_in==0){ echo "checked"; }?>> Percent(%)
										</label>

										<label class="radio-inline"> 
											<input type="radio" name="discount_in" onclick="handleClick1(this);" value="<?= set_value('discount_in',2); ?>" <?php if($coupon->discount_in==2){ echo "checked"; }?>> Rupees
										</label>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Discount</label><span style="color:red">*</span>
											<input id="price" name="udist" class="form-control" type="number" min="0" step="0.01" value="<?= set_value('udist',$coupon->discount); ?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-10 col-md-push-1">
										<div class="form-group">
											<label class="control-label">Note</label>
											<textarea id="note" name="note" class="editor1 form-control" rows="6"><?=set_value('note',$coupon->note)?></textarea>
										</div>
									</div>
								</div>
			
								<div class="form-actions text-center" >
									<button type="submit" class="btn blue">
										<i class="fa fa-share-square-o"></i> Submit
									</button>
									<a type="button" class="btn default" href="<?php echo base_url('admin/add_user_class');?>">Cancel</a>
								</div>
							
							</div>
						</form>

					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>

	</div>
	<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<?php
$this->load->view ( 'admin/_includes/footer', $data );
?>

<script src="<?php echo theme_assets_path; ?>multi-select.js" type="text/javascript"></script>
<script src="<?php echo theme_assets_path; ?>global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>

<script>
	$(document).ready(function(){
        $('.editor1').wysihtml5();
        selectProduct();
    }); 

	function selectProduct(id){ 
 
		var values = $('#product').val();
		var class_id = $('#id').val();
		var url="<?php echo base_url('admin/selectClassProductPrice_edit'); ?>";
		$.post(url,{"id":values,"class_id":class_id},function(res){
				// alert(res);
			  $("#selectproductdiv").html(res);
		});  
	}
	
	$(function () { 
		$("body").on("click", ".remove", function () {
			$(this).closest("tr").remove();	 
		});
	});	

	function handleClick(myRadio) {
		currentValue = myRadio.value;
		if(currentValue==1){
			document.getElementById('discount_in_div').style.display = "block";
			document.getElementById('discount_on_div').style.display = "none";
		}else if(currentValue==2){
			document.getElementById('discount_on_div').style.display = "block";
			document.getElementById('discount_in_div').style.display = "none";
		}
	}	
	
</script>