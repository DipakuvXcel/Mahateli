<?php 
	$this->load->helper('custom');
?>

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
							<td class="column-1">
								<a href="<?php echo base_url('product-details/'.$tbl_cart[$k]->product_id); ?>" > <img src="<?=base_url();?>/site_data/uploads/product_profile/<?=$tbl_cart[$k]->image;?>"  width="100" height ="90"alt="IMG-PRODUCT"> </a>
							</td>
							<td class="column-2"><a href="<?php echo base_url('product-details/'.$tbl_cart[$k]->product_id); ?>" > <?=$tbl_cart[$k]->product_name?><br><b><?php echo get_subcat_name($sub_category);?></b>&nbsp<?php echo "(".get_cat_name($category).")";?> </a></td>
							<td class="column-3">RS. <?=$tbl_cart[$k]->price?></td>
							<!--<td class="column-3">RS. <?=round($gst)?></td>-->
							<td class="column-5">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2 product_qty1">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="size8 m-text18 t-center product_qty" type="number" min="1" step="1" name="product_qty" id="product_qty<?php echo $tbl_cart[$k]->product_id;?>" value="<?=$tbl_cart[$k]->quantity?>" readonly>

									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2 product_qty1" >
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<td class="column-5 total_amt">RS. <?=$tbl_cart[$k]->price*$tbl_cart[$k]->quantity?></td>
							<td class="column-3">
						
							<button
							class="btnRemoveAction" onclick="remove_to_card('<?=$tbl_cart[$k]->product_id?>','<?=$tbl_cart[$k]->product_name?>','remove')" title="Remove Item"><i class="fa fa-trash" aria-hidden="true"></i>
							</button>
							</td>
						</tr>
							<?php }?>
							
							<tr class="odd gradeX">
								<td></td>
								<td></td>
								<td></td>
								<td>Sub Total</td>
								<td>RS. <?php echo $total_price_head;?></td>
							</tr>
							<?php if($coupon_discount && $coupon_discount > 0){ ?>
							<tr class="odd gradeX">
								<td></td>
								<td></td>
								<td colspan="2">Code - <?=$coupon_code?><br>
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
						<input class="sizefull s-text7 p-l-22 p-r-22" type="hidden" id="hidden_coupon_code" name="hidden_coupon_code" placeholder="Coupon Code" value="<?= $coupon_code; ?>" >
						<input type="hidden" class="coupon_discount" id="coupon_discount" name="coupon_discount" value="<?= $coupon_discount; ?>">
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
		