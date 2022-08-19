<?php error_reporting(0); ?> 

	<div id="printableArea">
	 <table width="100%" >
		<h4 class="myheading" style="text-align:center;"><b>Order Receipt</b></h4>
	</table>
	<div  id="invoice-template" class="card-body">
	
		<!-- Invoice Company Details -->
	<div style="border:1px solid black; font-size: 12px;">
		<table width="100%" >
		 <tbody style="line-height: 15px;">
			<tr style="border-bottom: 1px solid black;">
				<td style="border-right: 1px solid black; border-bottom: 1px solid black;padding: 15px; width: 20%;">
				<img src="<?= assets_path.'images/kiran-pharma.png'; ?>" width="120px" height="50px" style="padding-bottom: 10px;"><br>
				<img src="<?= assets_path.'images/'.$about_shop->logo; ?>" width="80px" height="50px" style="padding-bottom: 10px;">
				</td>
				<td style="border-right: 1px solid black; border-bottom: 1px solid black;padding: 15px; width: 45%;">
				<?php echo "<b>".$about_shop->shop_name."</b><br>".$about_shop->shop_number.",".$about_shop->shop_address;?><br>
				  Contact No: <?php echo $about_shop->shop_contact;?><br>
				  Email: <?php echo $about_shop->shop_email;?><br>
				  GST No: <?php echo $about_shop->shop_gstno; ?><br>
				  PAN No: <?php echo $about_shop->shop_pan; ?>
				</td>
				
				<td style=" border-bottom: 1px solid black; padding: 15px;width: 35%;" >
					Receipt Number: <b> #<?php echo $order_no;?></b><br>
					Date: <b> <?php echo date('d-m-Y');?></b>
				</td>
				   
			</tr> 
		<!--/ Invoice Company Details -->

		<!-- Invoice user Details -->
		 <tr>
			<td style="padding: 15px; width: 40%;">
				<b>user Info: </b><br>
				Name : <?php  echo $print_user['cust_name']; ?><br>
				Mobile No: <?php  echo $print_user['cust_contact'];?>
			</td>
			<td style="padding: 15px; width: 60%;">
				Email-Id: <?php  echo $print_user['cust_email'];?><br>
				Address:  <?php  echo $print_user['cust_address'];?><br>
				<?php if($print_user['cust_gst']){ ?>GST No: <?php  echo $print_user['cust_gst'];} ?><br> 
			</td>
            <!--<td style="padding: 15px; width: 20%;">
			   <br>
				Delivered By :  <?php  //echo $print_user['employee_name'];?> 
			</td>-->                    
			</tr> 
		 </tbody>  
		 </table>      
		<!--/ Invoice user Details -->

		<!-- Invoice Items Details -->
		 <table  border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" width="100%">
				<thead>
				<tr>
					<th class="text-center" style="border:1px solid black;">Sr.No</th>
					<th style="border:1px solid black;" class="text-center">Product Name</th>
					<th style="border:1px solid black;" class="text-center">Qty</th>
					<th style="border:1px solid black;" class="text-center">Rate</th>
					<th style="border:1px solid black;" class="text-center">Discount</th>	
					<!--<th style="border:1px solid black;" class="text-center">Price</th>-->	
					<th style="border:1px solid black;" class="text-center">GST (%)</th>					
					<th style="border:1px solid black;" class="text-center">Amount</th>
				</tr>
				</thead>
				
				<tbody>
					<?php
					$offer_id = $order_total['offer_id'];
					//$product_id = $order_total['product_id'];
					//$launch_offer = $order_total['launch_offer'];
					//$get_delivery = $order_total['get_delivery'];
					$total_qty = $order_total['total_qty'];
					$total_amount = $order_total['total_amount'];
					$total_gst_amount = $order_total['total_gst_amount'];
					$total_disc_amount = $order_total['total_disc_amount'];
					$coupon_discount_amt = $order_total['coupon_discount_amt'];
					$coupon_discount_per = $order_total['coupon_discount_per'];
					$coupon_code = $order_total['coupon_code'];
					$final_total_amount = $order_total['final_total_amount'];
					
					$counter=0;	
					$quantity=0;	
					$actual_price=0;	
					$price=0;	
					$total=0;	
					$gst_amount=0;	
					$mrp_total_t =0;
					$mrp_total_amount =0;
					$sell_total_amount =0;
					 
					//print_r($print_product);
					foreach ($print_product as $temp_product){
						  
						$product_id = $temp_product['product_id'];
						$product_name = $temp_product['product_name'];
						$product_image = $temp_product['product_image'];
						$quantity = $temp_product['quantity'];
						$actual_price = $temp_product['actual_price'];
						$price = $temp_product['price'];
						$unit_cost = $temp_product['unit_cost'];
						$gst = $temp_product['gst'];
						$gst_amount = $temp_product['gst_amount']; 
						$disc_amount = $temp_product['disc_amount']; 
						$total = $temp_product['total'];
						
						$mrp_total_t = $quantity * $actual_price;
						$mrp_total_amount = $mrp_total_amount + $mrp_total_t;
						$sell_total_amount = $sell_total_amount + $price;
						
						if($product_id1==27 || $product_id1==28){
							$quantity = 10;
							$total_qty = 10;
						}else if($product_id1==29 || $product_id1==30){
							$quantity = 20;
							$total_qty = 20;
						}
					  ?>
					<tr>
						<td style="text-align:center; border:1px solid black;">
						   <?php echo ++$counter ;?>
						</td>
						
						<td style="text-align:center; border:1px solid black;">
						 <p><?php echo $product_name; ?></p>
						</td>

						<td style="text-align:center; border:1px solid black;">
						  <?php echo $quantity;?>  
						</td>
						
						<td style="text-align:center; border:1px solid black;">
						  <?php echo $actual_price; ?>
						</td>
						
						<td style="text-align:center; border:1px solid black;">
						  <?php echo $disc_amount; ?>
						</td>
						
						<td style="text-align:center; border:1px solid black;">
						  <?php echo $gst_amount.' ('.$gst.'%)'; ?>
						</td>
						
						<!--<td style="text-align:center; border:1px solid black;">
						  <?php echo $price; ?>
						</td>-->
						
						<td style="text-align:center; border:1px solid black;">
						  <?php echo $total; ?>
						</td>
						
						 		
					</tr> 
				<?php } ?> 
						 
					<tr style="height:<?php if($counter==1){ echo '80px';}else if($counter==2){ echo '70px';}else if($counter==3){ echo '60px';}else if($counter==4){ echo '50px';}else if($counter==5){ echo '40px';}else if($counter==6){ echo '30px';}else{ echo '20px';} ?>" >                                            
						<td style="text-align:center;border:none;"></td> 
					    <td style="text-align:center;border:1px solid black;">
					      	<p><b>Total</b></p>
					    </td>
						<td style="text-align:center; border:1px solid black;"><b><?php echo $total_qty; ?></b></td>
					    <td style="text-align:center; border:1px solid black;"><b><?php echo $mrp_total_amount; ?></b></td>
					    <td style="text-align:center;border:1px solid black;"><b><?php echo $total_disc_amount;?> </b></td>
						<td style="text-align:center;border:1px solid black;"><b><?php echo $total_gst_amount;?> </b></td>
						<!--<td style="text-align:center;border:1px solid black;"><b><?php echo $sell_total_amount;?> </b></td>-->
					    <td style="text-align:center; border:1px solid black;"><b><?php echo $total_amount; ?></b></td>   
					</tr> 
 
			   </tbody>     
			</table>
		   <br>
   
			<table width="100%">
				<tbody style="line-height: 15px;" >    
					<tr>
					<?php if($launch_offer==1){ ?>
						<td style="padding: 10px;">
						  <?php if($product_id1==27 || $product_id1==28){ ?>
						  <b>FREE 1 Year Premium GYM Membership </b>(for 1 person)  
						  <?php }if($product_id1==29 || $product_id1==30){  ?>	    
						  <b>FREE 1 Year Premium GYM Membership for Couple </b>(or 2 persons)  
						  <?php } ?>	
						</td>
						 
					<?php } ?>	<td style="padding: 10px;"></td>					
					</tr>				
					<tr>
						<td style="padding: 10px;">
						 Amount Chargeable &nbsp;(in words):<br>
						<b><?php echo ucfirst(convertNumber($final_total_amount));?>  Rupees only</b>       
						</td>
						 
						<td style="text-align: end; padding: 10px;">
						<?php if($coupon_discount_amt > 0){ ?>
							Coupon Discount : <b><?php echo $coupon_discount_amt.' ('.$coupon_discount_per.' %)'; ?> </b>
						<?php } ?>
                            <br>
						   Grand Total : <b><?php echo $final_total_amount; ?><?php if(($launch_offer==1) && ($product_id1==27 || $product_id1==28|| $product_id1==29|| $product_id1==30)){ echo ' (including all taxes)'; }?></b>
						</td>   
					</tr>
				   
				   <?php if($launch_offer==1){ ?>
					<tr>
						<td style="padding: 10px;">
						   	
						</td>
						 
						<td style="text-align: end; padding: 10px;"><b>GET Delivery On : </b>
							<?php 
							if($get_delivery==1) { 
							echo $get_delivery = 'Monthly';
							}else if($get_delivery==2) {
							echo $get_delivery = 'Quarterly';
							}else if($get_delivery==3) {	
							echo $get_delivery = 'One Time Delivery';
							}
							?>
						</td>
					</tr>
					<?php } ?>						
					
					<tr>
						<td style="padding: 15px;">
							<b>Terms & Conditions: </b><br>
							<p><?php $data1=nl2br($about_shop->shop_terms_conditions); echo $data1;?><p>
						</td>
					</tr> 
				</tbody>          
			</table>
		 <br>
		<br>
		
		<table width="100%">
			 <tr>
				<td style="border-top: 1px solid black; border-right: 1px solid black;" width="50%">
				 <p style="margin-top: 7%; font-size:12px; text-align: center;">user Signature</p>
				</td>
				
				<td style="border-top: 1px solid black;">
				  <p style="margin-top: 7%;  font-size:12px; text-align: center;" >For <?php echo strtoupper($about_shop->shop_name);?> -&nbsp; Authorized Signature</p> 
				</td>   
			</tr>   
		</table>

	</div>
   </div>
	<p style="text-align:center;margin-bottom: 0rem;font-size:12px;">This is computer generated Order Receipt </p>
	</div>
		
	
        
	
        
 <?php
function convertNumber($number) {
  $no = round($number);
  $decimal = round($number - ($no = floor($number)), 2) * 100;   
  $digits_length = strlen($no);    
  $i = 0;
  $str = array();
  $words = array(
   0 => '',
   1 => 'One',
   2 => 'Two',
   3 => 'Three',
   4 => 'Four',
   5 => 'Five',
   6 => 'Six',
   7 => 'Seven',
   8 => 'Eight',
   9 => 'Nine',
   10 => 'Ten',
   11 => 'Eleven',
   12 => 'Twelve',
   13 => 'Thirteen',
   14 => 'Fourteen',
   15 => 'Fifteen',
   16 => 'Sixteen',
   17 => 'Seventeen',
   18 => 'Eighteen',
   19 => 'Nineteen',
   20 => 'Twenty',
   30 => 'Thirty',
   40 => 'Forty',
   50 => 'Fifty',
   60 => 'Sixty',
   70 => 'Seventy',
   80 => 'Eighty',
   90 => 'Ninety');
  $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
  while ($i < $digits_length) {
   $divider = ($i == 2) ? 10 : 100;
   $number = floor($no % $divider);
   $no = floor($no / $divider);
   $i += $divider == 10 ? 1 : 2;
   if ($number) {
    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
    $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
   } else {
    $str [] = null;
   }  
  }
  
  
  $Rupees = implode(' ', array_reverse($str));
  if($decimal>0){
	  $first_dec = substr($decimal, 0, 1);
	  $second_dec = substr($decimal, 1, 1);
	  
	  $paise = ($decimal < 20) ? "And " . ($words[$decimal - $decimal%1]) ." " .($words[$decimal%1])  : "And " . ($words[$decimal - $decimal%10]) ." " .($words[$second_dec]);
	}
  //return ($Rupees ? 'Rupees ' . $Rupees : '') . $paise . " Paise Only";
  return ($Rupees ? $Rupees : '');
 }
?>