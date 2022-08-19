<?php
error_reporting(0);

		$filename1 = "report_user_excel.csv";
		$exists = file_exists('report_user_excel.csv');
			if($exists)
			{
				unlink($filename1);
			}
 
		$filename1 = "report_user_excel_".date('Y-m-d').".csv";
		
		$fp = fopen($filename1, "wb");
			
		$insert_rows.= 'Id' . "\t".'First Name' . "\t".'Middle Name' . "\t".'Last Name' . "\t" . 'Contact' . "\t" . 'Email ' . "\t" . 'Date Of Birth' . "\t" . 'Marital Status' . "\t" . 'Mother tongue' ."\t". 'Religion'."\t".'Caste' ."\t" . 'Sub Caste'. "\t" . 'Gender' . "\t" . 'Relation' . "\t" .'Address' . "\t".'Landmark' . "\t".'City' . "\t".'District' . "\t".'Pincode' . "\t".'State' . "\t".'Country' . "\t".'Address' . "\t".'Landmark' . "\t".'City' . "\t".'District' . "\t".'Pincode' . "\t".'State' . "\t".'Country' . "\t" .'Status' ."\n\n";
		   fwrite($fp, $insert_rows);
			
		   /* Insert Data */
		   $counter=1;
		 
		   for($i=0;$i<count($user_report);$i++){
			
			$table = 'user_details';
			$where = array('user_id' => $user_report[$i]->id);
			$userdetails = $this->user_model->get_common($table, $where);
	
			$table = 'correspondence_address';
			$where = array('user_id' => $user_report[$i]->id);
			$corrs = $this->user_model->get_common($table, $where);
	
			$table = 'resident_address';
			$where = array('user_id' => $user_report[$i]->id);
			$reside = $this->user_model->get_common($table, $where);
	
			$table = 'caste';
			$where = array('user_id' => $user_report[$i]->id);
			$caste = $this->user_model->get_common($table, $where);
			
			
				$user_first_name= $userdetails->first;
				$user_middle_name= $userdetails->middle;
				$user_last_name= $userdetails->last;
				$birth= $userdetails->date_of_birth;
				$gender= $userdetails->gender;
				$religion= $userdetails->religion;
				$language= $userdetails->language;
				$caste_name= $caste->caste_name;
				$sub_caste_name= $caste->sub_caste_name;
				$marital_status= $userdetails->marital_status;
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
				$cor_landmark= $corrs->landmark;
				$cor_state=$corrs->state;
				$cor_country=$corrs->country;
				$cor_pincode= $corrs->pincode;

				$res_address= $reside->address;
				$res_district= $reside->district;
				$res_city= $reside->city;
				$res_landmark= $reside->landmark;
				$res_state=$reside->state;
				$res_country=$reside->country;
				$res_pincode= $reside->pincode;
				
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
				$relat='Register User';
				$insertb = $counter. "\t". $user_first_name. "\t". $user_middle_name. "\t". $user_last_name. "\t" .$cust_contact. "\t" .$cust_email. "\t" .$birth. "\t" .$mstatus. "\t" .$language. "\t".$religion."\t".$caste_name."\t".$sub_caste_name. "\t" .$gender. "\t" .$relat. "\t" .$res_address."\t" .$res_landmark."\t" .$res_city."\t" .$res_district."\t" .$res_pincode."\t" .$res_state."\t" .$res_country. "\t" .$cor_address."\t" .$cor_landmark."\t" .$cor_city."\t" .$cor_district."\t" .$cor_pincode."\t" .$cor_state."\t" .$cor_country. "\t".$status."\n";
				   
				fwrite($fp, $insertb);
				 
		$tablerp = 'user_family_details';
		$whererp = array('user_id ' => $user_report[$i]->id,'status !=' => 0);
		$group_byrp = '';
		$order_byrp = 'id';
		$orderrp = 'ASC';
		$user_family = $this->user_model->get_common($tablerp, $whererp,'*',2, '', $group_byrp, $order_byrp, $orderrp);

	
		for($j=0;$j<count($user_family);$j++)
		{ 
			$table = 'family_relation';
			$where = array('id' => $user_family[$j]->relation_id,'status !=' => 0);
			$family_relation = $this->user_model->get_common($table, $where);
	
			$tables = 'correspondence_address';
			$wheres = array('family_id' => $user_family[$j]->id);
			$corrsd = $this->user_model->get_common($tables, $wheres);
	
			$tabled = 'resident_address';
			$whered = array('family_id' => $user_family[$j]->id);
			$resided = $this->user_model->get_common($tabled, $whered);
	
			$tablec = 'caste';
			$wherec = array('family_id' => $user_family[$j]->id);
			$casted = $this->user_model->get_common($tablec, $wherec);
			
			 
			$user_first_name= $user_family[$j]->first;
			$user_middle_name= $user_family[$j]->middle;
			$user_last_name= $user_family[$j]->last;
			$birth= $user_family[$j]->date_of_birth;
			$gender= $user_family[$j]->gender;
			$religion= $user_family[$j]->religion;
			$language= $user_family[$j]->language;
			$caste_name= $casted->caste_name;
			$sub_caste_name= $casted->sub_caste_name;
			$family_relationnm=$family_relation->family_relation_name;
			$marital_status= $user_family[$j]->marital_status;
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

			$cust_contact= $user_family[$j]->contact;
			$cust_email= $user_family[$j]->email;

			$corr_address= $corrsd->address;
			$corr_district= $corrsd->district;
			$corr_city= $corrsd->city;
			$corr_landmark= $corrsd->landmark;
			$corr_state=$corrsd->state;
			$corr_country=$corrsd->country;
			$corr_pincode= $corrsd->pincode;

			$ress_address= $resided->address;
			$ress_district= $resided->district;
			$ress_city= $resided->city;
			$ress_landmark= $resided->landmark;
			$ress_state=$resided->state;
			$ress_country=$resided->country;
			$ress_pincode= $resided->pincode;
			
			$status_id= $user_family[$j]->status;
			if($status_id==1){
				$status='Active';
			}else if($status_id==2){
				$status='Deactive';
			}else if($status_id==3){
				$status='Not Verified';
			}else{
				$status='Deleted';
			}
			
			$insertb = $counter. "\t". $user_first_name. "\t". $user_middle_name. "\t". $user_last_name. "\t" .$cust_contact. "\t" .$cust_email. "\t" .$birth. "\t" .$mstatus. "\t" .$language. "\t".$religion."\t".$caste_name."\t".$sub_caste_name. "\t" .$gender. "\t".$family_relationnm. "\t"  .$ress_address."\t" .$ress_landmark."\t" .$ress_city."\t" .$ress_district."\t" .$ress_pincode."\t" .$ress_state."\t" .$ress_country. "\t" .$corr_address."\t" .$corr_landmark."\t" .$corr_city."\t" .$corr_district."\t" .$corr_pincode."\t" .$corr_state."\t" .$corr_country. "\t".$status."\n";
			   
			fwrite($fp, $insertb);
			
		}
		++$counter;
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