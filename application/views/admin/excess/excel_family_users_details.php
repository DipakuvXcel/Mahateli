<?php
error_reporting(0);

		$filename1 = "report_user_family_excel.csv";
		$exists = file_exists('report_user_family_excel.csv');
			if($exists)
			{
				unlink($filename1);
			}
 
		$filename1 = "report_user_family_excel_".date('Y-m-d').".csv";
		
		$fp = fopen($filename1, "wb");
		$insert_rows1.= 'Id' . "\t".'First Name' . "\t".'Middle Name' . "\t".'Last Name' . "\t" . 'Contact' . "\t" . 'Email ' . "\t" . 'Date Of Birth' . "\t" . 'Marital Status' . "\t" . 'Mother tongue' ."\t". 'Religion'."\t".'Caste' ."\t" . 'Sub Caste'. "\t" . 'Gender' . "\t" .'Address' . "\t".'Landmark' . "\t".'City' . "\t".'District' . "\t".'Pincode' . "\t".'State' . "\t".'Country' . "\t".'Address' . "\t".'Landmark' . "\t".'City' . "\t".'District' . "\t".'Pincode' . "\t".'State' . "\t".'Country' . "\t" .'Status' ."\n";
		   fwrite($fp, $insert_rows1);
			
		   /* Insert Data */
		   $cnt=1;			
			$tabled = 'user_details';
			$whered = array('user_id' => $user->id);
			$user_details = $this->user_model->get_common($tabled, $whered);
		
			$table = 'correspondence_address';
			$where = array('user_id' => $user->id);
			$corrs = $this->user_model->get_common($table, $where);
	
			$table = 'resident_address';
			$where = array('user_id' => $user->id);
			$reside = $this->user_model->get_common($table, $where);
	
			$table = 'caste';
			$where = array('user_id' => $user->id);
			$caste = $this->user_model->get_common($table, $where);
			
			
				$user_first_name= $user_details->first;
				$user_middle_name= $user_details->middle;
				$user_last_name= $user_details->last;
				$birth= $user_details->date_of_birth;
				$gender= $user_details->gender;
				$religion= $user_details->religion;
				$language= $user_details->language;
				$caste_name= $caste->caste_name;
				$sub_caste_name= $caste->sub_caste_name;
				$marital_status= $user_details->marital_status;
				if($marital_status==1){
					$mstatus='Separated';
				}else if($marital_status==2){
					$mstatus='Divorcee';
				}else if($marital_status==3){
					$mstatus='Widow/Widower';
				}else if($marital_status==4){
					$mstatus='Unmarried';
				}else if($marital_status==5){
					$mstatus='Married';
				}else{
					$mstatus='NA';
				}

				$cust_contact= $user->contact;
				$cust_email= $user->email;

				$cor_address= $corrs->address;
				$cor_district= $corrs->district;
				$cor_city= $corrs->city;
				$cor_state=$corrs->state;
				$cor_country=$corrs->country;
				$cor_pincode= $corrs->pincode;

				$res_address= $reside->address;
				$res_district= $reside->district;
				$res_city= $reside->city;
				$res_state=$reside->state;
				$res_country=$reside->country;
				$res_pincode= $reside->pincode;
				
				$status_id= $user_details->status;
				if($status_id==1){
					$status='Active';
				}else if($status_id==2){
					$status='Deactive';
				}else if($status_id==3){
					$status='Not Verified';
				}else{
					$status='Deleted';
				}
				
				$insertb1 =$cnt++. "\t". $user_first_name. "\t". $user_middle_name. "\t". $user_last_name. "\t" .$cust_contact. "\t" .$cust_email. "\t" .$birth. "\t" .$mstatus. "\t" .$language. "\t".$religion."\t".$caste_name."\t".$sub_caste_name. "\t" .$gender. "\t" .$res_address."\t" .$res_landmark."\t" .$res_city."\t" .$res_district."\t" .$res_pincode."\t" .$res_state."\t" .$res_country. "\t" .$cor_address."\t" .$cor_landmark."\t" .$cor_city."\t" .$cor_district."\t" .$cor_pincode."\t" .$cor_state."\t" .$cor_country. "\t".$status."\n\n";
				   
				fwrite($fp, $insertb1);
			
		/* details family */
		$insert_rows.= 'Id' . "\t".'First Name' . "\t".'Middle Name' . "\t".'Last Name' . "\t" . 'Contact' . "\t" . 'Email ' . "\t" . 'Date Of Birth' . "\t" . 'Marital Status' . "\t" . 'Mother tongue' ."\t". 'Religion'."\t".'Caste' ."\t" . 'Sub Caste'. "\t" . 'Gender' . "\t" .'Address' . "\t".'Landmark' . "\t".'City' . "\t".'District' . "\t".'Pincode' . "\t".'State' . "\t".'Country' . "\t".'Address' . "\t".'Landmark' . "\t".'City' . "\t".'District' . "\t".'Pincode' . "\t".'State' . "\t".'Country' . "\t" .'Status' ."\n";
		   fwrite($fp, $insert_rows);
			
		   /* Insert Data */
		   $cnt=1;
		 
		   for($i=0;$i<count($user_report);$i++){
			
		
			$table = 'correspondence_address';
			$where = array('user_id' => $user_report[$i]->id);
			$corrs = $this->user_model->get_common($table, $where);
	
			$table = 'resident_address';
			$where = array('user_id' => $user_report[$i]->id);
			$reside = $this->user_model->get_common($table, $where);
	
			$table = 'caste';
			$where = array('user_id' => $user_report[$i]->id);
			$caste = $this->user_model->get_common($table, $where);
			
			
				$user_first_name= $user_report[$i]->first;
				$user_middle_name= $user_report[$i]->middle;
				$user_last_name= $user_report[$i]->last;
				$birth= $user_report[$i]->date_of_birth;
				$gender= $user_report[$i]->gender;
				$religion= $user_report[$i]->religion;
				$language= $user_report[$i]->language;
				$caste_name= $caste->caste_name;
				$sub_caste_name= $caste->sub_caste_name;
				$marital_status= $user_report[$i]->marital_status;
				if($marital_status==1){
					$mstatus='Separated';
				}else if($marital_status==2){
					$mstatus='Divorcee';
				}else if($marital_status==3){
					$mstatus='Widow/Widower';
				}else if($marital_status==4){
					$mstatus='Unmarried';
				}else if($marital_status==5){
					$mstatus='Married';
				}else{
					$mstatus='NA';
				}

				$cust_contact= $user_report[$i]->contact;
				$cust_email= $user_report[$i]->email;

				$cor_address= $corrs->address;
				$cor_district= $corrs->district;
				$cor_city= $corrs->city;
				$cor_state=$corrs->state;
				$cor_country=$corrs->country;
				$cor_pincode= $corrs->pincode;

				$res_address= $reside->address;
				$res_district= $reside->district;
				$res_city= $reside->city;
				$res_state=$reside->state;
				$res_country=$reside->country;
				$res_pincode= $reside->pincode;
				
				$status_id= $user_report[$i]->status;
				if($status_id==1){
					$status='Active';
				}else if($status_id==2){
					$status='Deactive';
				}else if($status_id==3){
					$status='Not Verified';
				}else{
					$status='Deleted';
				}
				
				$insertb =$cnt++. "\t". $user_first_name. "\t". $user_middle_name. "\t". $user_last_name. "\t" .$cust_contact. "\t" .$cust_email. "\t" .$birth. "\t" .$mstatus. "\t" .$language. "\t".$religion."\t".$caste_name."\t".$sub_caste_name. "\t" .$gender. "\t" .$res_address."\t" .$res_landmark."\t" .$res_city."\t" .$res_district."\t" .$res_pincode."\t" .$res_state."\t" .$res_country. "\t" .$cor_address."\t" .$cor_landmark."\t" .$cor_city."\t" .$cor_district."\t" .$cor_pincode."\t" .$cor_state."\t" .$cor_country. "\t".$status."\n";
				   
				fwrite($fp, $insertb);
				 
		}
			 
		 
		   if (!is_resource($fp))
		   {
					 echo "cannot open excel file";
		   }
		   //echo "success full export";
		   fclose($fp);
		   
	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=\"" . basename($filename1) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename1));
    ob_clean();
    flush();
    readfile($filename1); //showing the path to the server where the file is to be download
    exit;


?>