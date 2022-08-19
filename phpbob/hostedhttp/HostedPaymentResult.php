<HTML>
<HEAD>
<META name="GENERATOR" content="IBM WebSphere Studio">
<LINK href="css/main.css" type=text/css rel=stylesheet>
<TITLE>Canon - Hosted</TITLE>
</HEAD>
<BODY class="bg">
<br>
<TABLE align=center border=1  bordercolor=black>
	<tr>
		<td>
			<TABLE align=center border=0  bordercolor=black>
				<TR>
					<TD colspan="2" align="center">
						<FONT size="4"><B>Transaction Details   </B></FONT>
					</TD>
				</TR>
				<?php 

		try {
			require('../libfiles/iPay24Pipe.php');
			$ini_array = parse_ini_file("hostedhttp.ini");
			$resourcePath = $ini_array['resourcePath'];
			$aliasName = $ini_array['aliasName'];
			$myObj =new iPay24Pipe();
			$myObj->setResourcePath(trim($resourcePath));
			$myObj->setKeystorePath(trim($resourcePath));
			$myObj->setAlias(trim($aliasName));			
			
			if(!empty(($_SERVER["QUERY_STRING"])))
			{
				parse_str($_SERVER["QUERY_STRING"]);	 
			}
			else 
			{
				$trandata =  isset($_GET["trandata"]) ? $_GET["trandata"] : isset($_POST["trandata"]) ? $_POST["trandata"] : "";
			}
			
			//$paymentid =  isset($_GET["paymentid"]) ? $_GET["paymentid"] : isset($_POST["paymentid"]) ? $_POST["paymentid"] : "";
			$errorText=isset($_GET["ErrorText"]) ? $_GET["ErrorText"] : isset($_POST["ErrorText"]) ? $_POST["ErrorText"] : null;
		//	echo $errorText;
			
				
		} catch(Exception $e) {
			echo 'Message: ' .$e->getFile();
	  		echo 'Message1 : ' .$e->getCode();
		}
	
	
	
			if(isset($trandata) && trim($myObj->parseEncryptedRequest(trim($trandata))) != 0) {
			
				echo '<TR>';
					echo '<TD>';
						echo 'Error';
					echo '</TD>';
					echo '<TD>';
					echo '	&nbsp;&nbsp;';
							echo $myObj->getError();
							echo '</b>';
					echo '</TD>';
				echo '</TR>';
			} else {
			
			
		
			
				if($errorText==null) { 
				
				$user_id = $myObj->getUdf13();
				$payment_amount = $myObj->getAmt();
				$payment_status = $myObj->getResult();
				$txt_id = $myObj->getTransId();
				$track_id = $myObj->getTrackId();
				$payment_id = $myObj->getPaymentId();
				$payment_type = $myObj->getTypes();
				$payment_mode = $myObj->getPmntmode();
				$coupon_code = $myObj->getUdf14() ? : '';
				$referee_code = $myObj->getUdf15() ? : '';
				$cust_addr_id = $myObj->getUdf16() ? : 0;
				$user_flag = $myObj->getUdf17();
				
				$ref_user_id = $myObj->getUdf7();
				$ref_order_id = $myObj->getUdf8();
				$ref_status = $myObj->getUdf9();
				
				/* $user_id = 1;
				$payment_amount = 100;
				$payment_status = 'CAPTURED';
				$txt_id = '1242444353536';
				$track_id = '5651242353665765';
				$payment_id = '22312454423536';
				$payment_mode = 'Card';
				$coupon_code = ''; */
				 
				header("Location: http://vigopa.com/myfuel/frontend/success/$user_id/$payment_amount/$payment_status/$txt_id/$track_id/$payment_id/$user_flag/$cust_addr_id/$payment_type/$coupon_code/$referee_code");
				 
				//print_r($myObj);
				//exit;
				?>
						<TR>
							<TD> Transaction Status </TD>
							<TD> &nbsp;&nbsp; <b><font size="2" color="red"><?php echo $myObj->getResult();?></font> </b></TD>
						</TR>
						<TR>
							<TD> Post Date </TD>
							<TD> &nbsp;&nbsp;<?php echo $myObj->getDates();?></TD> 
						</TR>
						<TR>
							<TD> Transaction Reference ID </TD>
							<TD> &nbsp;&nbsp;<?php echo $myObj->getRef();?></TD>
						</TR>
						<TR>
							<TD>Mrch Track ID</TD>
							<TD>&nbsp;&nbsp;<?php echo $myObj->getTrackId();?></TD>
						</TR>
						<TR>
							<TD><b>Transaction ID</b></TD>
							<TD>&nbsp;&nbsp;<?php echo $myObj->getTransId();?></TD>
						</TR>
						<TR>
							<TD>Transaction Amount</TD>
							<TD>&nbsp;&nbsp;<?php echo $myObj->getAmt();?></TD>
						</TR>
						<TR>
							<TD> UDF5 </TD>
							<TD> &nbsp;&nbsp;<?php echo $myObj->getUdf5();?></TD>
						</TR>
						<TR>
							<TD> Payment ID </TD>
							<TD> &nbsp;&nbsp;<?php echo $myObj->getPaymentId();?></TD>
						</TR>
					<?php } else {

							header("Location: http://localhost/myfuel/frontend/failure");
						?>
						<TR>
							<TD> ErrorText </TD>
							<TD> &nbsp;&nbsp;<?php echo $errorText;?></TD>
						</TR>
						<TR>
							<TD>Mrch Track ID</TD>
							<TD>&nbsp;&nbsp;<?php echo isset($_GET["trackid"]) ? $_GET["trackid"] : isset($_POST["trackid"]) ? $_POST["trackid"] : ""?></TD>
						</TR>
						<TR>
							<TD><b>Transaction ID</b></TD>
							<TD>&nbsp;&nbsp;<?php echo isset($_GET["tranid"]) ? $_GET["tranid"] : isset($_POST["tranid"]) ? $_POST["tranid"] : ""?></TD>
						</TR>
						<TR>
							<TD> Payment ID </TD>
							<TD> &nbsp;&nbsp;<?php echo isset($_GET["paymentid"]) ? $_GET["paymentid"] : isset($_POST["paymentid"]) ? $_POST["paymentid"] : ""?></TD>
						</TR>
					<?php
					}
				} ?>
			</table>
		</td>
	</tr>
</table>
<br>
<TABLE align=center>
	<tr>
		<td> <FONT size=2 color="BLUE"><A href="http://myfuel.co.in/">Home Page</A> </FONT> </td>
	</tr>
</table>
	</BODY>
</HTML>
				