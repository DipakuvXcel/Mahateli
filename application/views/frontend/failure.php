<?php
If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
       $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||'.$service_provider.'|'.$plan_id.'|'.$user_id.'|'.$active_id_prev.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
    }
	else
	{
       $retHashSeq = $salt.'|'.$status.'|||||||'.$service_provider.'|'.$plan_id.'|'.$user_id.'|'.$active_id_prev.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
  
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
		 
		 echo "<img src='https://www.yeoffer.com/webroot/img/payment/failure.png' height='100px' width=''>";
         echo "<h3>Your order status is ". $status .".</h3>";
         echo "<h4>Your transaction id for this transaction is ".$txnid.". You may try making the payment by clicking the link below.</h4>";
         echo "<a class='btn btn-success' href='https://www.yeoffer.com/User/userProfile/'>Go to Profile</a>";
		 } 
?>
<!--Please enter your website homepagge URL -->
<!--<p><a href=http://localhost/PayUMoney_Demo/PayUMoney_form.php> Try Again</a></p>-->
