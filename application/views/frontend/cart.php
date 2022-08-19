<?php 
	$this->load->view('frontend/_includes/header');
	$this->load->helper('custom');
?>
<style>
 .btn_outline { 
	text-align: center;
    border-radius: 12px;
    border-style: solid;
    border-color: #e6e6e6;
    text-align: black;
    color: black;
    background-color: white;
	}
	
	.btn_outline:hover{
	 background-color: #843b62;
	}
</style>
<!--================Home Banner Area =================-->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelO1.png);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>
<!--================End Home Banner Area =================-->

	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
		Cart
		</span>
	</div>
 <div >
    <section class="cart bgwhite p-t-10 p-b-100">
		<div class="container" id="card_id_refresh">
			<!-- Cart item -->
			
			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm" style="border: none;">
				<div class="flex-w flex-m w-full-sm">
                    <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button --->
						<a  href="<?php echo base_url('products'); ?>" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" style="border-radius: 12px;width: 210px;">
							<span class="fa fa-cart-plus"></span>&nbsp; Continue Shopping
						</a>
					</div>
				</div>
				
			</div>
			
			<?php if(count($tbl_cart)){ ?>
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
				    
					
					<table class="table-shopping-cart">
					    <tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
							<!--<th class="column-5" >Gst</th>-->
							<th class="column-5" >Quantity</th>
							<th class="column-5">Total</th>
							<th>Remove</th>
						</tr>
						<?php  
							$total_price_head=0;
							for($k=0;$k<count($tbl_cart);$k++){
								//echo $launch_offer=$tbl_cart[$k]->launch_offer;
								$total_price_head1=$tbl_cart[$k]->price*$tbl_cart[$k]->quantity;
								$total_price_head+=$total_price_head1;
								$where = array('product_id' =>$tbl_cart[$k]->product_id);
								$pro_details = $this->user_model->get_common('products', $where,'*',2,'','','','');
								$category=$pro_details[0]->main_category;
								$sub_category=$pro_details[0]->sub_category;
								$flavour=$pro_details[0]->flavour;
								$weight=$pro_details[0]->weight;
								
								//$gst=$tbl_cart[$k]->price*($tbl_cart[$k]->gst/100);
							?>
						<tr class="table-row item-row">
						   
							<input type="hidden" class="product_id" id="product_id" name="product_id" value="<?= $tbl_cart[$k]->product_id; ?>">
							<input type="hidden" class="category" id="category" name="category" value="<?= $category; ?>">
							<input type="hidden" class="product_price1" id="product_price1" name="product_price1" value="<?= $tbl_cart[$k]->price; ?>">
							<input type="hidden" class="total_amt1" id="total_amt1" name="total_amt1"  value="<?=$tbl_cart[$k]->price*$tbl_cart[$k]->quantity?>">
						
							<td class="column-1">
								<a href="<?php echo base_url('product-details/'.$tbl_cart[$k]->product_id); ?>" > <img src="<?=base_url();?>/site_data/uploads/product_profile/<?=$tbl_cart[$k]->image;?>"  width="100" height ="90" alt="IMG-PRODUCT"> </a>
							</td>
							<td class="column-2">
							<?php if($tbl_cart[$k]->launch_offer==1){ ?>
								<a href="javascript:void(0);" ><b> <?=$tbl_cart[$k]->product_name?><br></b><?php echo get_subcat_name($sub_category);?>&nbsp<?php echo get_cat_name($category);?>   </a>
								<?php } else{ ?>
								<a href="<?php echo base_url('product-details/'.$tbl_cart[$k]->product_id); ?>" ><b> <?=$tbl_cart[$k]->product_name?><br></b><?php echo get_subcat_name($sub_category);?>&nbsp<?php echo get_cat_name($category);?>   </a>
								<?php } ?>	
							</td>
							
							<td class="column-3">
							<?php if($tbl_cart[$k]->price && $tbl_cart[$k]->price < $tbl_cart[$k]->actual_price)
							{ ?> 				
							<span class="block2-newprice m-text8">Rs. <?=$tbl_cart[$k]->price; ?></span></br>  <span class="block2-oldprice m-text7">Rs. <?=$tbl_cart[$k]->actual_price; ?></span> 
							<?php } else{ ?>  
							<span class="block2-newprice m-text8" >Rs. <?=$tbl_cart[$k]->actual_price; ?> </span> 
							<?php } ?>	
							 </td>
							<!--<td class="column-3">RS. <?=round($gst)?></td>-->
							<?php  if($tbl_cart[$k]->launch_offer==1){   ?>
							<td class="column-3">
							<?php
							if($tbl_cart[$k]->product_id==27 || $tbl_cart[$k]->product_id==28){ echo "10";}
							if($tbl_cart[$k]->product_id==29 || $tbl_cart[$k]->product_id==30){ echo "20";}
							?>
							 
							</td>
							<?php } else  if($tbl_cart[$k]->offer_id!=0){ ?>
							<td class="column-3">
							<?=$tbl_cart[$k]->quantity?>
							</td>
							<?php } else{  ?>
							<td class="column-3">
								<div class="flex-w bo5 of-hidden" style="width: 98%;">
									<button class="btn-num-product-down color0 flex-c-m size7 bg8 eff2 product_qty1">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>
									<input class="size8 m-text18 t-center num-product product_qty" type="number" min="1" step="1" name="product_qty" id="product_qty<?php echo $tbl_cart[$k]->product_id;?>" value="<?=$tbl_cart[$k]->quantity?>" readonly>

									<button class="btn-num-product-up color0 flex-c-m size7 bg8 eff2 product_qty1" >
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<?php } ?>
							<td class="column-5 " style="width: 11%;">RS. <span class="total_amt"> <?=$tbl_cart[$k]->price*$tbl_cart[$k]->quantity?> </span>
							</td>
							
							<td class="column-3">
								<button class="btnRemoveAction" onclick="remove_to_card('<?=$tbl_cart[$k]->product_id?>','<?=$tbl_cart[$k]->product_name?>','remove','<?=$tbl_cart[$k]->offer_id?>')" title="Remove Item"><i class="fa fa-trash" aria-hidden="true"></i>
								</button>
							</td>
						</tr>
							<?php }?>
							
							<tr class="odd gradeX">
								<td></td>
								<td></td>
								<td></td>
								<td>Sub Total</td>
								<td>RS. <span class="total_amount"><?php echo $total_price_head;?><span></td>
							</tr>
							<?php if($coupon_discount){ ?>
							<tr class="odd gradeX">
								<td colspan="4">Code - <?=$coupon_code?><br>
								<span style="color:#0ac30a;">Coupon applied successfully!</span>
								</td>
					
								<?php 
								$discount_amt = round($total_price_head *($coupon_discount/100));
								$tot_amt=$total_price_head - $discount_amt;	
								?>
								<td><?php echo"-".$discount_amt."<br><b> RS. ".$tot_amt."</b>";?></td>
							</tr>
							<?php }?>
					</table>
				</div>
			</div>
			
	     
			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm" style="border-bottom: none; padding-bottom: 0px;">
				<div class="flex-w flex-m w-full-sm">
					<?php if($coupon_discount > 0 && $coupon_code){ ?> 
					 
					<?php } else { ?>
					
						<div class="size11 bo4 m-r-10">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="coupon_code" name="coupon_code" placeholder="Coupon Code" >
						</div>

						<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
							<!-- Button -->
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" onclick="apply_coupon();" href="javascript:void(0);" style="border-radius: 12px;">
								Apply coupon
							</button>
						</div>
				
					<?php } ?>
				</div>
				
                 
				<!--<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button 
						<a href="#" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 btn_outline" style="text-align: center; border-radius: 12px;">
							Update All
						</a>
				</div>-->
				<form name="frm_user_detail"  action="<?php echo base_url('frontend/checkout'); ?>" method="POST">
					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="hidden" id="hidden_coupon_code1" name="hidden_coupon_code1" placeholder="Coupon Code" >
						<input type="hidden" class="coupon_discount1" id="coupon_discount1" name="coupon_discount">
						<button type="submit" class="flex-c-m sizefull bg44 bo-rad-23 hov1 s-text1 trans-0-4" style="text-align: center; width: 110%; border-radius: 12px;">
							Proceed to Checkout   
						</button>
					</div>
				</form>
			</div>
			 
			<?php } 
			 else 
			 {
				echo "Cart is empty!";
			 } 
			?>
		</div>
	</section>
</div>
<?php 
	$this->load->view('frontend/_includes/footer');
?>
<script>
	function apply_coupon(){
		
		var couple_code=document.getElementById("coupon_code").value; 
		var couple_code1=couple_code;
		if(couple_code){
			
		var url="<?php echo base_url('frontend/apply_coupon'); ?>";
				$.ajax({
				  type: "POST",
				  url: url,
				  data: {"couple_code":couple_code},
				  cache: false,
				  success: function(res){
					 if(res==0){
						swal(couple_code+ " is Invalid", "please enter the valid coupon Code", "error");
						$("#coupon_code").val('');
					 }
					 else if(res){
						//alert(res);
						$("#card_id_refresh").html(res);
						swal(couple_code, "is coupon applied successfully!", "success");
						//$("#coupon_discount").val(res);
						//$("#hidden_coupon_code").val(couple_code1);
							
					}
					
				  }
				});
		
				}
				else{
				swal("Coupon Code iS Empty!", "please enter the coupon Code", "error");
				
				}
	   }

	function remove_coupon(){
		location.reload();
    }    
		function remove_to_card(product_id,name,flag,offer_id){
        
		//alert(offer_id);
			var url="<?php echo base_url('frontend/remove_from_card'); ?>";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: {"product_id":product_id,"action":flag,"offer_id":offer_id},
			  cache: false,
			  success: function(res){
				if(res){
					
					swal(name, "is remove to cart !", "success");
					$("#card_id_refresh").html(res);
					location.reload();
					//setInterval(function(){ 
					//window.location.href = '<?php echo base_url("cart"); ?>';
                    //}, 2500);
					//$("#card_id_refresh").load(location.href + "#card_id_refresh");
						
				}else{
					alert("Failed to remove cart.");
				}
			  }
			});
			
			add_to_card(product_id,name,flag,0);
			
	}
		
		

		
$(function () {	
$(document).on("focus", "[class*='item-row']", function() {
    //alert("dsds")	;
	/* $('.product_qty1').on("keyup", function(){
		var row = $(this).parents('.item-row');
		var product_id = row.find('.ebook_id').val();
		var category = row.find('.category').val();
		var qty = row.find('.product_qty').val();
		var price = row.find('.product_price1').val();
		$.ajax({
			url:'<?= base_url("frontend/check_product_qty/"); ?>',
			type:'POST',
			data:{'qty':qty,'product_id':product_id,'category':category},
			success: function(data)
			{
				var pqty=parseInt(data);
				//alert(pqty);
				 if(pqty!=0)
				 {
					alert('Quantity not available!');
					row.find('.product_qty').val(pqty);
					var total=price*pqty;
					//var total=roundNumber(total,2);
					isNaN(total) ? row.find('.total_amt').html("N/A") : row.find('.total_amt').html(total); 
				 }else{
					var total=price*qty;
					//var total=roundNumber(total,2);
					isNaN(total) ? row.find('.total_amt').html("N/A") : row.find('.total_amt').html(total); 
				 }
				
			}
			});
	}); */
	$('.product_qty1').on("click", function(){
		
		var row = $(this).parents('.item-row');
		var product_id = row.find('.product_id').val();
		var category = row.find('.category').val();
		var qty = row.find('.product_qty').val();
		var price = row.find('.product_price1').val();
		 
			$.ajax({
			url:'<?= base_url("frontend/check_product_qty/"); ?>',
			type:'POST',
			data:{'qty':qty,'product_id':product_id,'category':category},
			success: function(data)
			{
				var pqty=parseInt(data);
				// alert(pqty);
				 if(pqty!=0)
				 {
					//alert('Quantity not available!');
					 swal("Quantity Error..", "Quantity not available!", "error");
					row.find('.product_qty').val(pqty);
					var total=price*pqty;
					//var total=roundNumber(total,2);
					isNaN(total) ? row.find('.total_amt').html("N/A") : row.find('.total_amt').html(total);
					//isNaN(total) ? row.find('.total_amt1').val("N/A") : row.find('.total_amt1').val(total);
					 
						 
						var sum = 0;
							$('.total_amt').each(function() {
						  sum += Number($(this).html()) || 0;
						});	
					 
						 $('.total_amount').html(sum);		
				 }else{
					var total=price*qty;
					//var total=roundNumber(total,2);
					isNaN(total) ? row.find('.total_amt').html("N/A") : row.find('.total_amt').html(total); 
						
						var sum = 0;
							$('.total_amt').each(function() {
						  sum += Number($(this).html()) || 0;
						});	
						 
						$('.total_amount').html(sum);	

				}
				
			}
			});
		
	
	
	
	});
	});

});
</script>