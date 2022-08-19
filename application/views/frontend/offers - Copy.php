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
    <!--================End Category Product Area =================-->


<script src="<?php echo assets_path; ?>vendor/noui/nouislider.min.js"></script>
	
<script type="text/javascript">
		/*[ No ui ]
	    ===========================================================*/
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 500, 10000 ],
	        connect: true,
	        range: {
	            'min': 500,
	            'max': 10000
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];
		//alert($('#value-upper').val());
	    filterBar.noUiSlider.on('update', function( values, handle ) {
			//alert(Math.round(values[handle]));
			//if($("#price_low").val()<Math.round(values[handle])){
			//$("#price_low").val(Math.round(values[handle]));}
			//$("#price_high").val(Math.round(values[handle]));
	        skipValues[handle].innerHTML = Math.round(values[handle]) ;
	    });
		
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
	 
		
	</script>

<?php 
	$this->load->view('frontend/_includes/footer');
?>
  