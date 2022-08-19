<?php 
	$this->load->helper('custom');
?>

	<?php 
	if($this->session->userdata('user_profile') !='')
	{
		$this->db->where('user_id', $_SESSION['user_profile']->id);
	}else if(isset($_SESSION['session_id'])){
		$this->db->where('session_id', $_SESSION['session_id']);
	}else{
		$this->db->where('session_id', 0);
	}
		$tbl_cart_list = $this->db->get('tbl_cart'); 
		$tbl_cart_list1 = $tbl_cart_list->result();
	?>
		<input type="hidden" id="hidden_cart_cnt" value="<?= count($tbl_cart_list1) ?>" />
			<ul class="header-cart-wrapitem">
			<?php 
			$total_price_head=0;
			for($k=0;$k<count($tbl_cart_list1);$k++){
				$total_price_head+=$tbl_cart_list1[$k]->price*$tbl_cart_list1[$k]->quantity;
			?>
				<li class="header-cart-item">
					<div class="p-r-20">
						<a href="<?php echo base_url('product-details/'.$tbl_cart_list1[$k]->product_id); ?>" > <img style="height: 70px; width: 80px;" src="<?= upload_path.'product_profile/'.$tbl_cart_list1[$k]->image?>" alt="IMG"> </a>
					</div>

					<div class="header-cart-item-txt">
						<a href="<?php echo base_url('product-details/'.$tbl_cart_list1[$k]->product_id); ?>" class="header-cart-item-name">
							<?=$tbl_cart_list1[$k]->product_name?>
						</a>

						<span class="header-cart-item-info">
							<?=$tbl_cart_list1[$k]->price?> x <?=$tbl_cart_list1[$k]->quantity?>
						</span>
					</div>
				</li>
			<?php } ?>

				 </ul>

			<div class="header-cart-total">
				Total: <?=$total_price_head?>
			</div>

			<div class="header-cart-buttons">
				<div class="header-cart-wrapbtn">
					<!-- Button -->
					<a href="<?php echo base_url('cart'); ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
						View Cart
					</a>
				</div>

				<div class="header-cart-wrapbtn">
					<!-- Button -->
					<a href="<?php echo base_url('checkout'); ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
						Check Out
					</a>
				</div>
			</div>
		 
