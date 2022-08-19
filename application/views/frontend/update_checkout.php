<?php 
	$this->load->helper('custom');
?>

			 
			
			<?php if(count($tbl_cart)){ ?>
			<div class="container-table-cart pos-relative" >
			 <div class="p-t-20 p-b-20 p-r-20  p-l-20 " style="box-shadow: 0px 0px 4px #969191;">
	
					<div class="row">
					<div style="float: right;margin-left: 90%;">
				 <span class="price m-b-20" style="float: right;color:black"><i class="fa fa-shopping-cart"></i> <b><?=count($tbl_cart)?></b></span> 
					</div>
					</div>
				<div class="wrap-table-shopping-cart bgwhite">
				    
					
					<table class="table    table-responsive  table-hover">
					    <tr class="table-head">
						<th style="width:10%;">Product</th>
						<th style="width:18%;">Name</th>
						<th style="width:8%;">Price (RS) </th>
						<th style="width:8%;">Qty</th>
					
						<th style="width:8%;">Total (RS) </th>
							 
						</tr>
						<?php 
							$total_price_head=0;
							for($k=0;$k<count($tbl_cart);$k++){
								
								$total_price_head+=$tbl_cart[$k]->total_amount;
								
								$where = array('product_id' =>$tbl_cart[$k]->product_id);
								$pro_details = $this->user_model->get_common('products', $where,'*',2,'','','','');
								$category=$pro_details[0]->main_category;
								$sub_category=$pro_details[0]->sub_category;
								//$gst=$tbl_cart[$k]->price*($tbl_cart[$k]->gst/100);
							?>
						<tr class="table-row item-row">
						   <input type="hidden" class="product_id" id="product_id" name="product_id" value="<?= $tbl_cart[$k]->product_id; ?>">
				           <input type="hidden" class="category" id="category" name="category" value="<?= $category; ?>">
				           <input type="hidden" class="product_price1" id="product_price1" name="product_price1" value="<?= $tbl_cart[$k]->price; ?>">
							<td class="odd gradeX">
								<a href="<?php echo base_url('product-details/'.$tbl_cart[$k]->product_id); ?>" > <img src="<?=base_url();?>/site_data/uploads/product_profile/<?=$tbl_cart[$k]->image;?>" width="40" height ="40" alt="IMG-PRODUCT"> </a>
							</td>
							<td class=""><a href="<?php echo base_url('product-details/'.$tbl_cart[$k]->product_id); ?>" > <?=$tbl_cart[$k]->product_name?><br><b><?php echo get_subcat_name($sub_category);?></b>&nbsp<?php echo "(".get_cat_name($category).")";?> </a></td>
							<td class="column-3"><?=$tbl_cart[$k]->price?></td>
							<!--<td class="column-3">RS. <?=round($gst)?></td>-->
							<td class="column-3"><?=$tbl_cart[$k]->quantity?></td>
							<td class="column-4 total_amt"><?=$tbl_cart[$k]->price*$tbl_cart[$k]->quantity?></td>
							<!--<td class="column-3">
						
							<button
							class="btnRemoveAction" onclick="remove_to_card('<?=$tbl_cart[$k]->product_id?>','<?=$tbl_cart[$k]->product_name?>','remove')" title="Remove Item"><i class="fa fa-trash" aria-hidden="true"></i>
							</button>
							</td>-->
						</tr>
							<?php }?>
							
							<tr class="odd gradeX">
								<td></td>
								
								<td>Sub Total</td>
								<td></td>
								<td></td>
								<td>RS. <?php echo $total_price_head;?></td>
							</tr>
							<?php if($coupon_discount && $coupon_discount > 0){ ?>
							<tr class="odd gradeX">
								<td></td>
								<td></td>
								<td colspan="2">Code - <?=$coupon_code?></br>
								<span style="color:#0ac30a;">Coupon applied successfully!</span><br>
								<button class="btnRemoveAction" onclick="remove_coupon();" title="Remove Item" style="color: red;">Remove Coupon <i class="fa fa-trash" aria-hidden="true" ></i>
								</button>
								</td>
					
								<?php 
								$discount_amt = round($total_price_head *($coupon_discount/100));
								$tot_amt=$total_price_head - $discount_amt;	
								?>
								<td><?php echo"Rs. -".$discount_amt." (".$coupon_discount."%)<br><b> RS. ".$tot_amt."</b>";?></td>
							</tr>
							<?php }?>
					</table>
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
				</div>
				
                 
				<!--<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button 
						<a href="#" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 btn_outline" style="text-align: center; border-radius: 12px;">
							Update All
						</a>
				</div>-->
				<div class="row">
				<!--<div class="col-lg-6 col-md-6 col-sm-6 ">
					<a class="color0" href="<?= base_url('products') ?>">Continue Shopping</a>
				</div>-->
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
					<a class="color0 hov1 btn" href="<?= base_url('cart') ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> Go To Cart</a></h3>		
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6  col-xs-6 textr">
					<a class="color0 hov1 btn" href="<?= base_url('products') ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> Continue Shopping</a></h3>		
				</div> 
			</div>
			 
			</div>
			</div>
			 
			<?php } 
			 else 
			 {
				echo "Cart is empty!";
			 } 
			?>
		