<?php

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||'.$service_provider.'|'.$plan_id.'|'.$user_id.'|'.$active_id_prev.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
                  }
	else {

        $retHashSeq = $salt.'|'.$status.'|||||||'.$service_provider.'|'.$plan_id.'|'.$user_id.'|'.$active_id_prev.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
		 
          echo "<img src='https://www.yeoffer.com/webroot/img/payment/success.png' height='100px' width='100px'>";
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your Plan Activated Successfully.</h4><br>";
          echo "<a class='btn btn-success' href='https://www.yeoffer.com/User/userProfile/'>Go to Profile</a>";
           
		   }         
?>	