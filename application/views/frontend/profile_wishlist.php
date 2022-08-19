<?php 	 
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
		.table-shopping-cart {
    
    min-width: 0px;
}
</style>
 
	 
 <div id="card_id_refresh">
    <section class="cart bgwhite p-t-10 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="row m-b-20">
				<div class="col-md-8">
					<h4 class="p-b-11 m-text24">
						My WishList
					</h4>
				</div>
				<div class="col-md-4">
					 <a  href="<?php echo base_url('products'); ?>" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" style="border-radius: 12px;width: 210px;">
							  Continue Shopping
						</a>
				</div>
			</div>
			 
			<hr> 
			<?php if(count($tbl_wishlist)){ ?>
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
				    
					
					<table class="table-shopping-cart">
					    <tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
							<!--<th class="column-5" >Gst</th>-->
						 	<th>Move To Cart</th>
						 	<th>Remove</th>
						</tr>
						<?php 
							$total_price_head=0;
							for($k=0;$k<count($tbl_wishlist);$k++){
								$where = array('product_id' =>$tbl_wishlist[$k]->product_id);
								$pro_details = $this->user_model->get_common('products', $where,'*',2,'','','','');
								$category=$pro_details[0]->main_category;
								$sub_category=$pro_details[0]->sub_category;
								$flavour=$pro_details[0]->flavour;
								$weight=$pro_details[0]->weight;
								//$gst=$tbl_wishlist[$k]->price*($tbl_wishlist[$k]->gst/100);
							?>
						<tr class="table-row item-row">
						   
						   <input type="hidden" class="product_id" id="product_id" name="product_id" value="<?= $pro_details[0]->product_id; ?>">
				           <input type="hidden" class="category" id="category" name="category" value="<?= $category; ?>">
				           <input type="hidden" class="product_price1" id="product_price1" name="product_price1" value="<?= $pro_details[0]->price; ?>">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="<?=base_url();?>/site_data/uploads/product_profile/<?=$pro_details[0]->image;?>"  width="50" height ="90"alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2"><?=$pro_details[0]->product_name; ?><br><b><?php echo get_subcat_name($sub_category);?>&nbsp<?php echo get_cat_name($category);?> </b><?php echo "(".get_flavour_name($flavour).", ".$weight.")";?> </td>
							<td class="column-3"><?php if($pro_details[0]->offer_price && $pro_details[0]->offer_price < $pro_details[0]->price)
									{ ?> 				
									<span class="block2-oldprice m-text7">Rs. <?=$pro_details[0]->price; ?></span>&nbsp; <span class="block2-newprice m-text8">Rs. <?=$pro_details[0]->offer_price; ?></span>
								<?php } else{ ?> 
									<span class="block2-newprice m-text8" >Rs. <?=$pro_details[0]->price; ?> </span> 
								<?php } ?></td>
							<!--<td class="column-3">RS. <?=round($gst)?></td>-->
							 
							<td class="column-3">
							<button class="btnRemoveAction btn btn-success" onclick="add_to_card('<?=$pro_details[0]->product_id?>','<?=$pro_details[0]->product_name; ?>','add','1')" title="Move to Cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Move To Cart
							</button>
							</td>
							<td class="column-3">
							<button class="btnRemoveAction btn btn-danger" onclick="remove_to_wishlist('<?=$tbl_wishlist[$k]->id?>')" title="Remove Item"><i class="fa fa-trash" aria-hidden="true"></i> Remove
							</button>
							</td>
						</tr>
							<?php }?>
					</table>
				</div>
			</div>
			
	      
			 
			<?php } 
			 else 
			 {
				echo "WishList is Empty..!! ";
			 } 
			?>
		</div>
	</section>
</div>
 
<script>
 

function remove_to_wishlist(wishlist_id){
        
		
			var url="<?php echo base_url("frontend/remove_to_wishlist"); ?>";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: {"wishlist_id":wishlist_id},
			  cache: false,
			  success: function(res){
				if(res==1){
					
					swal(name, "is remove to WishList !", "success");
					 profile_wishlist();
						
				}else{
					alert("Failed to remove cart.");
				}
			  }
			});
			
	}
		
 
</script>