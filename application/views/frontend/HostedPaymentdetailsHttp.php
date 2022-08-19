<?php 
	$this->load->view('frontend/_includes/header');
	$this->load->helper('custom');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
	<head>
		<title>MyFuel</title>
	</head>
	<!--<LINK href="<%=request.getContextPath()%>/css/main.css" type=text/css rel=stylesheet>-->
	<body class="bg">
	<?php 
	$posted = array();
	if(!empty($_POST)) {
		//print_r($_POST);
	  foreach($_POST as $key => $value) {
		$posted[$key] = $value;
	  }
	}
	//print_r($posted);
	?>
	
		<center>
			<table width="100%" height="100%" cellpadding="1" cellspacing="1">
				<tr>
					<td>
						<form name="form1" ACTION="http://localhost/myfuel/phpbob/hostedhttp/HostedPaymentBuyHttp.php" METHOD="POST">
							<table width="50%" cellpadding="1" cellspacing="1" border="1" align="center">
								<tr>
								</tr>
							</table>
							<table width="50%" cellpadding="1" cellspacing="1" border="1" align="center">
								 
								<tr>
								
									<!--inner_content_div-->
									<section class="product_description_area p-t-10 p-b-60">
										<div class="container">
		 
											<!--<select  name="action" readonly>
												<option selected="selected" value="1">Purchase</option>
												<option value="4">Authorize</option>
											</select>-->
											<input type="hidden" name="action" value="1" /> 
											<input size="20" type="hidden" name="amount" value="<?php echo (empty($posted['total_amt'])) ? '' : $posted['total_amt'] ?>" readonly>
											<input size="20" type="hidden" name="udf1" value="udf 1" readonly>
											<input size="20" type="hidden" name="udf2" value="udf 2" readonly>
											<input size="20" type="hidden" name="udf3" value="udf 3" readonly>
											<input size="20" type="hidden" name="udf4" value="udf 4" readonly>
											<input size="20" type="hidden" name="udf5" value="udf 5" readonly>
											<input size="20" type="hidden" name="udf6" value="KIRAN PHARMACEUTICALS" readonly>
											<input size="20" type="hidden" name="udf7" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" readonly>
											<input size="20" type="hidden" name="udf8" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" readonly>
											<input size="20" type="hidden" name="udf9" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" readonly>
											<input size="20" type="hidden" name="udf10" value="<?php echo (empty($posted['address'])) ? '' : $posted['address']; ?>" readonly>
											<input size="20" type="hidden" name="udf11" value="<?php echo (empty($posted['total_amt'])) ? '' : $posted['total_amt'] ?>" readonly>
											<input size="20" type="hidden" name="udf12" value="MyFuel Products"readonly>
											<input size="20" type="hidden" name="udf13" value="<?php echo (empty($posted['user_id'])) ? '' : $posted['user_id']; ?>"readonly>
											<input size="20" type="hidden" name="udf14" value="<?php echo (empty($posted['coupon_code'])) ? '' : $posted['coupon_code']; ?>"readonly>
											<input size="20" type="hidden" name="udf15" value="<?php echo (empty($posted['coupon_discount'])) ? '' : $posted['coupon_discount']; ?>" readonly>
											<input size="20" type="hidden" name="udf16" value="<?php echo (empty($cust_addr_id)) ? '' : $cust_addr_id; ?>" readonly>
											<input size="20" type="hidden" name="udf17" value="<?php echo (empty($posted['user_flag'])) ? '' : $posted['user_flag']; ?>">
											<input size="20" type="hidden" name="udf18" value="udf 18">
											<input size="20" type="hidden" name="udf19" value="udf 19">
											<input size="20" type="hidden" name="udf20" value="udf 20">
											<input size="20" type="hidden" name="udf21" value="udf 21">
											<input size="20" type="hidden" name="udf22" value="udf 22">
											<input size="20" type="hidden" name="udf23" value="udf 23">
											<input size="20" type="hidden" name="udf24" value="udf 24">
											<input size="20" type="hidden" name="udf25" value="udf 25">
											<input size="20" type="hidden" name="udf26" value="udf 26">
											<input size="20" type="hidden" name="udf27" value="udf 27">
											<input size="20" type="hidden" name="udf28" value="udf 28">
											<input size="20" type="hidden" name="udf29" value="udf 29">
											<input size="20" type="hidden" name="udf30" value="udf 30">
											<input size="20" type="hidden" name="udf31" value="udf 31">
											<input size="20" type="hidden" name="udf32" value="udf 32">
									
											<div class="col-md-12">  
												<h2 class="m-b-20 text-center">
													Review Your Order & Complete Checkout
												</h2>

												<div class="m-b-20 text-center">
													<h3 class="m-b-20">Order Total = <span style="color:green;"> Rs. <i class="icon-inr" aria-hidden="true"></i>&nbsp;<?php echo (empty($posted['total_amt'])) ? '' : $posted['total_amt'] ?></span></h3>
												</div>
												<br>
												 
													<div class="row">
													<div class="col-md-4">
														<a type="button" href="<?php echo base_url('cart'); ?>" class="btn btn-default btn-lg" style="width:100%;">Cancel</a>
													</div>
													<div class="col-md-4">
													</div>
													<div class="col-md-4">
														<button type="submit" class="btn btn-success btn-lg" style="width:100%;">Continue</button>
													</div>
													</div>

												<!-- / PayUMoney Hidden Code-->
												<br/>
												<div style="text-align: left;"><br/>
													By submiting this order you are agreeing to our universal billing agreement, and terms of service.
													If you have any questions about our products or services please contact us
													before placing this order.
												</div>
											</div>
											
										</div>
									</section>

								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</center>
	</body>
</html>

<?php 
	$this->load->view('frontend/_includes/footer');
?>