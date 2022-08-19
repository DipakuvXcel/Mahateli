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
	/* $posted = array();
	if(!empty($_POST)) {
		//print_r($_POST);
	  foreach($_POST as $key => $value) {
		$posted[$key] = $value;
	  }
	} */
	$payment_mode = $payment_data->payment_mode;
	if($payment_mode=='Credit Card'){
		$payment_by = 'C';
	}else{
		$payment_by = 'D';
	}
	$track_id = $payment_data->track_id;
	$total_amt = $payment_data->payment_amount;
	$order_id = $order_data->id;
	?>
	
		<center>
			<table width="100%" height="100%" cellpadding="1" cellspacing="1">
				<tr>
					<td>
						<form name="form1" ACTION="http://localhost/myfuel/phpbob/tranportaltcpip/TranPipeBuy.php" METHOD="POST">
							<table width="50%" cellpadding="1" cellspacing="1" border="1" align="center">
								<tr>
								</tr>
							</table>
							<table width="50%" cellpadding="1" cellspacing="1" border="1" align="center">
								 
								<tr>
								
									<!--inner_content_div-->
									<section class="product_description_area p-t-10 p-b-60">
										<div class="container">

											<input type="hidden" name="action" value="2" /> 
											<input size="20" type="hidden" name="comment" value="<?php echo (empty($track_id)) ? '' : $track_id; ?>" /> 
											<input size="20" type="hidden" name="AMOUNT" value="<?php echo (empty($total_amt)) ? '' : $total_amt ?>" readonly>
											<input size="20" type="hidden" name="udf1" value="udf 1" readonly>
											<input size="20" type="hidden" name="udf2" value="udf 2" readonly>
											<input size="20" type="hidden" name="udf3" value="udf 3" readonly>
											<input size="20" type="hidden" name="udf4" value="udf 4" readonly>
											<input size="20" type="hidden" name="udf5" value="TrackID" readonly>
											<input size="20" type="hidden" name="trckId" value="<?php echo substr(number_format(time() * rand(),0,'',''),0,10);?>"> 
											<input type="hidden" name="transacType" value="<?php echo (empty($payment_by)) ? '' : $payment_by; ?>" /> 
									
											<div class="col-md-12">  
												<h2 class="m-b-20 text-center">
													Review Your Cancel Order & Continue
												</h2>

												<div class="m-b-20 text-center">
													<h5 class="m-b-20">Order Id = <span style="color:green;"> #<?php echo (empty($order_id)) ? '' : $order_id ?></span></h5>
													<h5 class="m-b-20">Order Total = <span style="color:green;"> Rs. <i class="icon-inr" aria-hidden="true"></i>&nbsp;<?php echo (empty($total_amt)) ? '' : $total_amt ?></span></h5>
												</div>
												<br>
												 
													<div class="row">
													<div class="col-md-4">
														<a type="button" href="<?php echo base_url('my-orders'); ?>" class="btn btn-default btn-lg" style="width:100%;">Cancel</a>
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
													If you have any questions about our products or services please contact us before placing this order.
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