<?php 
	$this->load->view('frontend/_includes/header');
	$this->load->helper('custom');
?>
 
<!-- PayUMoney Code-->

<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "7sS1RmAi";//test=rjQUPktU

// Merchant Salt as provided by Payu
$SALT = "qyz5FOxLJm";//test=e5iIg1jwi8

// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://secure.payu.in";//test=https://test.payu.in
$PAYU_BASE_URL = "https://test.payu.in";

$success_url= base_url('success');
$failure_url= base_url('failure');

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {
    $posted[$key] = $value;
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
print_r($posted);
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])

  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
//echo $action;
//echo 'adsfsd';
?>
<!-- End PayUMoney Code-->

<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
	  document.getElementById("loadingdiv").style.display='block';
    }
	
  </script>
 
<body onload="submitPayuForm()">
    
	  <?php if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
 <!-- PayUMoney Hidden Code-->
<form id="payuForm" action="<?php echo $action;?>" method="post" name="payuForm">
  <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
  <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
  <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
  
  <input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" />
  <input type="hidden" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" />
  <input type="hidden" name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" />
  <input type="hidden" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
  <input type="hidden" name="productinfo" value="<?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?>"/>
  <input type="hidden" name="surl" value="<?php echo $success_url;?>" size="64" />
  <input type="hidden" name="furl" value="<?php echo $failure_url;?>" size="64" />
  <input type="hidden" type="hidden" name="service_provider" value="payu_paisa" size="64" />
  <!--Optional -->
  <input type="hidden" name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" />
  <input type="hidden" name="curl" value="" />
  <input type="hidden" name="address" value="<?php echo (empty($posted['address'])) ? '' : $posted['address']; ?>" />
  <input type="hidden" name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" />
  <input type="hidden" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" />
  <input type="hidden" name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" />
  <input type="hidden" name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" />
  <input type="hidden" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" />
  <input type="hidden" name="udf1" value="<?php echo (empty($posted['user_id'])) ? '' : $posted['user_id']; ?>" />
  <input type="hidden" name="udf2" value="<?php echo (empty($posted['coupon_code'])) ? '' : $posted['coupon_code']; ?>" />
  <input type="hidden" name="udf3" value="<?php echo (empty($posted['coupon_discount'])) ? '' : $posted['coupon_discount']; ?>" />
  <input type="hidden" name="udf4" value="PayUMoney" />
  <input type="hidden" name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" />
  <input type="hidden" name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /><br>
  



<!--inner_content_div-->
  
	<section class="product_description_area p-t-10 p-b-60">
		<div class="container">
			<div class="col-md-12">
                <form class="form-horizontal" role="form" action="" method="post" id="payment-form">   
				<h2 class="m-b-20 text-center">
					Review Your Order & Complete Checkout
				</h2>

				<div class="m-b-20 text-center">
					<h3 class="m-b-20">Order Total = <span style="color:green;"> Rs. <i class="icon-inr" aria-hidden="true"></i>&nbsp;<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?></span></h3>
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
				 
				</form>
			
				<!-- / PayUMoney Hidden Code-->
				<br/>
				<div style="text-align: left;"><br/>
					By submiting this order you are agreeing to our <a href="/legal/billing/">universal
						billing agreement</a>, and <a href="/legal/terms/">terms of service</a>.
					If you have any questions about our products or services please contact us
					before placing this order.
				</div>
                                
                            
			</div>
			
		</div>
	</section>
</form>
<div class="clear"></div>

<?php 
	$this->load->view('frontend/_includes/footer');
?>