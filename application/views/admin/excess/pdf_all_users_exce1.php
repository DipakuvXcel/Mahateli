 
<?php
$this->load->helper('custom');
?>
	<div id="printableArea">
	 <table width="100%" >
		<h4 class="myheading" style="text-align:center;"><b>All user List</b></h4>
	</table>
	<div  id="invoice-template" class="card-body">
	
		<!-- Invoice Company Details -->
	<div style="border:1px solid black; font-size: 12px;">

		         
		<!-- user Details -->
		 <table  border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" width="100%">
				<thead>
				<tr>
					<th class="text-center" style="border:1px solid black;">Sr.No</th>
					<!-- <th style="border:1px solid black;" class="text-center">Name</th> -->
					<th style="border:1px solid black;" class="text-center">Email-id</th>
					<th style="border:1px solid black;" class="text-center">Contact</th>
					<!-- <th style="border:1px solid black;" class="text-center">Address-1</th>
					<th style="border:1px solid black;" class="text-center">Address-2</th>
					<th style="border:1px solid black;" class="text-center">City</th>
					<th style="border:1px solid black;" class="text-center">State</th>
					<th style="border:1px solid black;" class="text-center">Country</th>
					<th style="border:1px solid black;" class="text-center">Pincode</th>
					<th style="border:1px solid black;" class="text-center">Birthday</th>
					<th style="border:1px solid black;" class="text-center">Anniverssary</th> -->
					<th style="border:1px solid black;" class="text-center">State</th>
				</tr>
			</thead>
				
				<tbody>
				<?php
				   
				  $counter = 0;
				  //print_r($user);
                  for($i=0;$i<count($user_report);$i++)
                  {
					//$cust_name= $user_report[$i]->first;
					$cust_contact= $user_report[$i]->contact;
					$cust_email= $user_report[$i]->email;
					// $cust_address1= $user_report[$i]->address1;
					// $cust_address2= $user_report[$i]->address2;
					// $cust_city= $user_report[$i]->city;
					// $cust_state=$user_report[$i]->state;
					// $cust_country=$user_report[$i]->country;
					// $cust_pincode= $user_report[$i]->pincode;
					// $birth= $user_report[$i]->birth;
					// $ani= $user_report[$i]->ani;
					//$balance= $user_report[$i]->balance;
					$status_id= $user_report[$i]->status_id;
					if($status_id==1){
						$status='Active';
					}else if($status_id==2){
						$status='Deactive';
					}else if($status_id==3){
						$status='Not Verified';
					}else{
						$status='Deleted';
					} 
				  ?>
				<tr>
					<td style="text-align:center; border:1px solid black;">
					   <?php echo ++$counter ;?>
					</td>
					
				    <!-- <td style="text-align:center; border:1px solid black;">
					   <?php echo  $cust_name; ?>  
					</td>  -->

					<td style="text-align:center; border:1px solid black;">
					  <?php echo $cust_email;?>  
					</td>
					
					<td style="text-align:center; border:1px solid black;">
					  <?php echo $cust_contact;?>
					</td>

                    <!-- <td style="text-align:center; border:1px solid black;">
					  <?php echo $cust_address1;?>
					</td>
					
                    <td style="text-align:center; border:1px solid black;">
					  <?php echo $cust_address2;?>
					</td>
					
                    <td style="text-align:center; border:1px solid black;">
					  <?php echo $cust_city;?>
					</td>
					
                    <td style="text-align:center; border:1px solid black;">
					  <?php echo $cust_state;?>
					</td>
					
                    <td style="text-align:center; border:1px solid black;">
					  <?php echo $cust_country;?>
					</td>

                    <td style="text-align:center; border:1px solid black;">
					  <?php echo $cust_pincode;?>
					</td>

                    <td style="text-align:center; border:1px solid black;">
					  <?php echo $birth;?>
					</td>

                    <td style="text-align:center; border:1px solid black;">
					  <?php echo $ani;?>
					</td>
					 -->
					<td style="text-align:center; border:1px solid black;">
					  <?php echo $status;?>
					</td>

				</tr> 
				<?php }  ?> 
						 
				      
				 
			   </tbody>     
			</table>
	
	</div>
   </div>
	<p style="text-align:center;margin-bottom: 0rem;font-size:12px;">This is computer generated Report </p>
	</div>

