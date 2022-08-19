<?php 
	$this->load->view('frontend/_includes/header');
	$this->load->helper('custom');
?>
<style>

.persent{
background: #8e8e8e;
padding: 3px 7px 3px 10px;
z-index: 100;
font-family: Montserrat-Regular;
font-size: 12px;
color: #fff;
font-weight: 600;

justify-content: center;
align-items: center;
width: 50px;
height: 22px;
border-radius: 11px;

top: 12px;
left: 12px;

}
.persent1{
background: #f1a831b8;
z-index: 100;
font-family: Montserrat-Regular;
font-size: 12px;
color: #fff;
font-weight: 600;
display: -webkit-box;
display: -webkit-flex;
display: -moz-box;
display: -ms-flexbox;
display: flex;
justify-content: center;
align-items: center;
width: 50px;
height: 22px;

position: absolute;
top: 12px;
left: 12px;

}

.persent2{
	background: #dc615fb8;
	z-index: 100;
	font-family: Montserrat-Regular;
	font-size: 12px;
	color: #fff;
	font-weight: 600;
	display: -webkit-box;
	display: -webkit-flex;
	display: -moz-box;
	display: -ms-flexbox;
	display: flex;
	justify-content: center;
	align-items: center;
	width: 105px;
	border-radius:5px;
	padding: 0px 0px 0px 4px;
	height: 25px;
	position: absolute;
	top: 0px;
	right: 0px;

}
.color0{
	font-weight:600;
}

.plusicon{
	 margin-top: 44px;
	 font-size: 20px;
    font-weight: 600;
	}
	 
@media (max-width: 420px) {
 
	.plusicon{
		margin-left: 30%;
		margin-top: 0px;
	}
	 
}
.bo1:hover{
	box-shadow: 0px 0px 4px 0px #dbdbdb;
	background-color:#dbdbdb24;
}


.hidden {
  display: none;
}

form > .row {
  margin-bottom: 20px;
}

form > .row:last-child {
  margin-bottom: 0;
}

form input.invalid {
  border-color: #dc3545;
}

form .invalid-feedback {
  color: #dc3545;
  font-size: 14px;
  line-height: 21px;
  margin-top: 4px;
  text-align: left;
}

</style>

	<link rel="stylesheet" type="text/css" href="<?php echo assets_path; ?>vendor/noui/nouislider.min.css">
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
		   <div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
			<a href="<?php echo base_url(''); ?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
			</a>
			<span class="s-text17">
			Offers
			</span>
			</div>
	
	
	 
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-1 col-md-1 col-lg-1 p-b-50">
			 
				</div>

				<div class="col-sm-9 col-md-10 col-lg-10 p-b-50">
				
				<div class="row">
				
					<?php 
					for($i=0;$i<count($products);$i++){ ?>
				<div class="col-md-12 bo1 m-b-30">
					<?php
						   
					 ?>
					<p><label class="control-label color0  p-t-10  p-b-10" style="background: #ef9b12; padding: 1%1%;">Launching Offers</label></p>
						<div class="row p-l-30">
	 
							 <div class="col-md-6">
								<!--<span> <img style="width: 41%;" src="<?= assets_path.'img/offer2.png'; ?>"> </span>-->
								<span> <img style="width: 100%;" src="<?=upload_path.'product_profile/'.$products[$i]->image;?>"> </span>
							</div> <div class="col-md-6">
							<p><label class="control-label color0  p-t-10  p-b-10" ><?=substr($products[$i]->product_name,0,18);?><br>
							<?php if($products[$i]->product_id==28){  ?>Pay Rs. 43000/- & get 750 Serving (10 jars) of 'MYFUEL Whey Isolated' with FREE 1 Year Premium GYM Membership.
							<?php } if($products[$i]->product_id==30){ ?>
								Pay Rs. 81000/- & get 1500 Serving (20 jars) of 'MYFUEL Whey Isolated' with FREE 1 Year Premium GYM Membership.
							<?php }?>
							</label>
							</p>
						
						</div>
						</div>
						
						<div class="float-right btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10 ">
							<!--<button onclick="add_to_card_mult('<?=$products->product_id?>','<?=$products->product_name?>','<?=$both_together[$i]->price?>','<?=$both_together[$i]->id?>','<?=$both_together[$i]->free_product_id?>')" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							--><button onclick="view_offer_model('<?=$products[$i]->product_id?>','<?=$products[$i]->product_name?>','<?=$both_together[$i]->price?>','<?=$both_together[$i]->id?>','<?=$products[$i]->free_flag?>')" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Add to Cart
							</button>
						</div>
						</div>
				<?php } ?>
				
				
				
				
					<?php 
					for($i=0;$i<count($both_together);$i++){ ?>
					<div class="col-md-12 bo1 m-b-30">
					<?php
					 
						
						 $total_price+=$both_together[$i]->price;
							    $product_a=$both_together[$i]->main_product_id.",".$both_together[$i]->product_id;
								$product_arr= explode(",",$product_a);
								if($both_together[$i]->product_id!=""){
									
								if($both_together[$i]->free_product_id!=0){
							    $product_a1=$both_together[$i]->main_product_id.",".$both_together[$i]->product_id.",".$both_together[$i]->free_product_id;
								}else{
									  $product_a1=$both_together[$i]->main_product_id.",".$both_together[$i]->product_id;
								array_unshift($product_arr,$both_together[$i]->free_product_id);
								}
								
							   // $product_a1=$products->product_id.",".$both_together[$i]->product_id.",".$both_together[$i]->free_product_id;
								}else{
									if($both_together[$i]->free_product_id!=0){ 
							    $product_a1=$both_together[$i]->main_product_id.",".$both_together[$i]->free_product_id;
								}else{
									  $product_a1=$both_together[$i]->main_product_id.",".$both_together[$i]->product_id;
								array_unshift($product_arr,$both_together[$i]->free_product_id);
								}
									
									   
								}
								
								$product_arr=array();
							 
							 $product_arr1= explode(",",$product_a1);
							
							    //print_r($product_arr1);
							   $product_aa= implode(",",$product_arr1);
							  //echo count($product_arr1);
						
						
						
						
					 ?>
					<p><label class="control-label color0  p-t-10  p-b-10" ><?=$both_together[$i]->name?></label></p>
						<div class="row p-l-30">
						<?php
							$k=0;
							foreach($product_arr1 as $val){ 
							 
							?>
							<div class="col-md-3">
								<span> <img style="width: 100px;" src="<?=upload_path.'product_profile/'.get_product_profile_image($val);?>"> </span>
								 <a href="<?php echo base_url('product-details/'.$val); ?>" class="block2-name dis-block s-text3 p-b-5">
								<p> <?php echo substr(get_product_name($val),0,20)?></p>
								</a>
							</div>
								 
						<?php if(count($product_arr1)>1 && $k < count($product_arr1)-1 ){  ?>
						<span class="plusicon  m-text8">+</span>
						<?php }  $k++;  }    ?><hr>  
							 
						
							<span class="plusicon  m-text8">= &nbsp;   </span>
		
							<span class="block2-newprice plusicon m-text555">Rs. <?php echo $both_together[$i]->price; ?></span>
						</div>
						
						<div class="float-right btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10 ">
							<button onclick="add_to_card_mult('<?=$product_aa?>','<?=$products->product_name?>','<?=$both_together[$i]->price?>','<?=$both_together[$i]->id?>','<?=$both_together[$i]->free_product_id?>')" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Add to Cart
							</button>
						</div>
						</div>
						<br>
						<br>
						<br>
						<hr>
					<?php } ?>
				
				</div>
		</div>

	
	 
		</section>
		
		
<div class="modal fade" id="interestedModal" tabindex="-1" role="dialog" aria-labelledby="interestedModal" aria-hidden="true">
  	<div class="modal-dialog  modal-xs modal-dialog-centered" role="document">
    	<div class="modal-content" style="margin-top: 15%;  position: fixed;">
		 <div class="modal-body" style="box-shadow: 0px 0px 6px 0px #b1b1b1;background-color: #f1f1f1d4;" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         			<span aria-hidden="true">&times;</span>
        	 </button>
				<div style="padding:30px 30px 0px 30px;">
				<input type="hidden" name="name" id="name">
				<input type="hidden" name="p_id" id="p_id">
				<input type="hidden" name="price" id="price">
				<div class="form-group">
				</div>
				<div class="form-group">
				<label for="exampleInputPassword17" style="float: left;">Flavour </label><span style="color:red;float: left;">*</span>
				<select  class="form-control" id="flavour"  name="flavour"   value="<?= set_value('flavour'); ?>" >
				<option value="">Select flavour</option>
				  <option value="1" <?php if(set_value('flavour')==1) echo 'selected'; ?>> Chocolate  </option>
				  <option value="2" <?php if(set_value('flavour')==2) echo 'selected'; ?>>Cafe Mocha </option>
					
				</select>
				</div>
     			<div class="form-group">
					<label for="exampleInputPassword17" style="float: left;">Get Delivery ON</label><span style="color:red;float: left;">*</span>
					<select  class="form-control" id="get_delivery"  name="get_delivery"   value="<?= set_value('get_delivery'); ?>" >
					<option value="">Select </option>
					<option value="1" <?php if(set_value('get_delivery')==1) echo 'selected'; ?>>Monthly </option>
					<option value="2" <?php if(set_value('get_delivery')==2) echo 'selected'; ?>>Quarterly </option>
					<option value="3" <?php if(set_value('get_delivery')==3) echo 'selected'; ?>>One Time Delivery </option>
					 
					</select>
					<label id="errorlabel" style="float: left;color:red;display:none;">Please fill the details </label>
				</div>
				 <div class="row">
				 <div class="col-lg-12 " >
					<button type="reset" class="btn  bg44" onclick="add_to_card_offer()" style="float:right;color:#fff;" > OK </button>
				</div> 
				</div> 
				</div> 
     			 	
			</div>
  		</div>
	</div>
</div>
    <!--================End Category Product Area =================-->


 	
<script type="text/javascript">
		/*[ No ui ]
	    ===========================================================*/
	    
		function add_to_card_mult(product_id,name,price,offer_id,free_product_id){
	// alert(free_product_id);
	// alert(product_id);
			 
				//var quantity_val=$('#quantity').val();
			 
		var url="<?php echo base_url('frontend/add_to_card_mult'); ?>";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: {"product_id":product_id,"action":'add',"price":price,"quantity":1,"offer_id":offer_id,"free_product_id":free_product_id},
			  cache: false,
			  success: function(res){
				   //alert(res);
				if(res==1){
					//alert('Quantity not available!');
					 swal(name, "Quantity not available!", "error");
				}
				else if(res){
					swal(name, "is added to cart !", "success");
					$('#head_cart_refresh').html('');
					$('#head_cart_refresh').html(res);
					$('#head_cart_refresh_mob').html('');
					$('#head_cart_refresh_mob').html(res);
					var cnt = $('#hidden_cart_cnt').val();
					$('#head_cart_cnt').html('');
					$('#head_cart_cnt').html(cnt);
					$('#head_cart_cnt_mob').html('');
					$('#head_cart_cnt_mob').html(cnt);
				}
				else{
					//alert("Failed to add cart.");
					swal(name, "is Failed to add cart!", "error");
				}
			  }
			});
		 
		}
		
		function add_to_card_offer(){
			var product_id =$("#p_id").val();
			var price =$("#price").val();
			var flavour =$("#flavour").val();
			var get_delivery =$("#get_delivery").val();
			
			 if(flavour=="" || flavour==null  ){
			  $("#flavour").focus(); 
			  $("#errorlabel").show(); 
			  
			 }else if(get_delivery=="" || get_delivery==null){
				 $("#get_delivery").focus(); $("#errorlabel").show(); 
			 }else{
			var url="<?php echo base_url('frontend/add_to_card_offer'); ?>";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: {"product_id":product_id,"flavour":flavour,"get_delivery":get_delivery},
			  cache: false,
			  success: function(res){
				  //alert(res);
				if(res){
					 
					swal(name, "is added to cart !", "success");
					$('#interestedModal').hide();
					$('#head_cart_refresh').html('');
					$('#head_cart_refresh').html(res);
					$('#head_cart_refresh_mob').html('');
					$('#head_cart_refresh_mob').html(res);
					var cnt = $('#hidden_cart_cnt').val();
					$('#head_cart_cnt').html('');
					$('#head_cart_cnt').html(cnt);
					$('#head_cart_cnt_mob').html('');
					$('#head_cart_cnt_mob').html(cnt);
				}
				else{
					//alert("Failed to add cart.");
					swal(name, "is Failed to add cart!", "error");
				}
			  }
			});
			 }
		}
	 
		function view_offer_model(product_id,name,price){
			//alert("hi");
			
			$('#p_id').val(product_id); 
			$('#price').val(price); 
			$('#name').val(name); 
			$('#interestedModal').modal(); 

		}
		
		
 
		
	</script>

<?php 
	$this->load->view('frontend/_includes/footer');
?>
  