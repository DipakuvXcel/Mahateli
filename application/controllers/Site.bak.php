<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
	public $shop_data;		
	
	public function index()
	{
		error_reporting(0);
		$data = array(
			'page_title'=>"Wedding | Home", 
			'active'=>'home', 
		);
		$this->load->view('site/registration',$data);
	}
	
	
	public function _alpha_dash_space($str_in = '')
	{
		//if (! preg_match("/^([-a-z0-9_ ])+$/i", $str_in))	
		if (! preg_match("/^([-a-z_ ])+$/i", $str_in))
		{
			$this->form_validation->set_message('_alpha_dash_space', 'The %s field may only contain alpha characters, spaces.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	public function login(){
		
		$data = array('page_title'=>"Wedding | Login", 'active'=>'login' );

		$this->load->view('site/login',$data);
	}


	public function registration(){
		
		$data = array('page_title'=>"Wedding | Registration", 'active'=>'registration' );

		$this->load->view('site/registration',$data);
	}


	 
	function save_registration(){
		//error_reporting(0);
		$this->form_validation->set_rules ( 'fname', 'First Name', 'required' );
		$this->form_validation->set_rules ( 'mname', 'Middle Name', 'required' );
		$this->form_validation->set_rules ( 'lname', 'Last Name', 'required' );
		$this->form_validation->set_rules ( 'gender', 'Gender', 'required' );
		$this->form_validation->set_rules ( 'contcode', 'Contact Number', 'required' );
		$this->form_validation->set_rules ( 'contact', 'Contact Number', 'required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules ( 'marital_status', 'Marital Status', 'required' );
		$this->form_validation->set_rules ( 'date', 'Date of Birth', 'required' );
		$this->form_validation->set_rules ( 'language', 'Mother tongue', 'required' );
		$this->form_validation->set_rules ( 'religion', 'Religion', 'required' );
		$this->form_validation->set_rules ( 'caste', 'Caste', 'required' );
		$this->form_validation->set_rules ( 'sub_caste', 'Sub Caste', 'required' );
		$this->form_validation->set_rules ( 'res_address', 'Address', 'required' );
    	$this->form_validation->set_rules ( 'res_city', 'City', 'required' );
    	$this->form_validation->set_rules ( 'res_country', 'Country', 'required' );
    	$this->form_validation->set_rules ( 'res_state', 'State', 'required' );
    	$this->form_validation->set_rules ( 'res_district', 'District', 'required' );
		$this->form_validation->set_rules ( 'res_pincode', 'Pincode', 'required|numeric|min_length[6]|max_length[6]');
    	$this->form_validation->set_rules ( 'corr_address', 'Address', 'required' );
    	$this->form_validation->set_rules ( 'corr_city', 'City', 'required' );
    	$this->form_validation->set_rules ( 'corr_country', 'Country', 'required' );
    	$this->form_validation->set_rules ( 'corr_state', 'State', 'required' );
    	$this->form_validation->set_rules ( 'corr_district', 'District', 'required' );
		$this->form_validation->set_rules ( 'corr_pincode', 'Pincode', 'required|numeric|min_length[6]|max_length[6]');
		if(isset($_POST['mo_number']) && $_POST['mo_number']!=''){
			$this->form_validation->set_rules ('mo_number', 'Mobile Number','required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[6]|matches[conf_password]' );
			$this->form_validation->set_rules ( 'conf_password', 'Re-type Password', 'required' );
		}    
		if(isset($_POST['email_id']) && $_POST['email_id']!=''){
			$this->form_validation->set_rules ('email_id', 'Email Id','trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[6]|matches[conf_password]' );
			$this->form_validation->set_rules ( 'conf_password', 'Re-type Password', 'required' );
		}    	
		if($this->form_validation->run()==false){
    		$this->registration();
    	}else{
			$name1 = trim($_POST['fname']);
			// $nm2 = trim($_POST['mname']);
			// $nm3 = trim($_POST['lname']);
			$gend = trim($_POST['gender']);
			$contcode = trim($_POST['contcode']);
			$maritalstatus = trim($_POST['marital_status']);
			$dateobirth = trim($_POST['date']);
			$molanguage = trim($_POST['language']);
			$religiond = trim($_POST['religion']);
			$caste_re = trim($_POST['caste']);
			$subcaste = trim($_POST['sub_caste']);
			$foundation = trim($_POST['foundation']);

			$email1 = trim($_POST['email_id']);
			$string = preg_replace('/\s+/', '', $email1);
			$email = strtolower($string);

			$mobile = trim($_POST['contact']);
			$password = trim($_POST['password']);
			
			$address_line1 =  trim($_POST['res_address']);
			$address_line2 =  trim($_POST['corr_address']);
			$city1 = trim($_POST['res_city']);
			$city2 = trim($_POST['corr_city']);
			$district1 = trim($_POST['res_district']);
			$district2 = trim($_POST['corr_district']);
			$state1 = trim($_POST['res_state']);
			$state2 = trim($_POST['corr_state']);
			$country1 = trim($_POST['res_country']);
			$country2 = trim($_POST['corr_country']);
			$pincode1 = trim($_POST['res_pincode']);
			$pincode2 = trim($_POST['corr_pincode']);
			$landmark1 = trim($_POST['res_landmark']);
			$landmark2 = trim($_POST['corr_landmark']);
			
			$insert_data = array(
				'email'	=>	$email,
				'password'	=> md5($password),
				'contact'	=>	$mobile,
				'flag'	=>	3,
				'status_id'	=> 3
			);

			$table = 'user';
			$this->user_model->save_common($table, $insert_data);
			$user_id = $this->db->insert_id();
		
			$insert_dataed = array(
				'user_id'	=>	$user_id,
				'foundation'	=>	$foundation,
				'first'	=>	$name1,
				'middle'	=>	$_POST['mname'],
				'last'	=>	$_POST['lname'],
				'gender'	=>	$gend,
				'contry_code'	=>	$contcode,
				'contact'	=>	$mobile,
				'religion'=> $religiond,
				'date_of_birth'	=>	$dateobirth,
				'language'	=>	$molanguage,
				'marital_status'	=> $maritalstatus,
				'status'	=> 1
			);

			$this->user_model->save_common('user_details', $insert_dataed);

				$insert_datay = array(
					'user_id'=> $user_id,
					'address' =>$address_line1,
					'landmark' =>$landmark1,
					'country' =>$country1,
					'state' =>$state1,
					'city'=>$city1,
					'district'=> $district1,
					'pincode'=> $pincode1,
					'status' => 1 
				); 
				$this->user_model->save_common('resident_address', $insert_datay);

				$insert_data_corr = array(
					'user_id'=> $user_id,
					'address' =>$address_line2,
					'landmark' =>$landmark2,
					'country' =>$country2,
					'state' =>$state2,
					'city'=>$city2,
					'district'=> $district2,
					'pincode'=> $pincode2,
					'status' => 1 
				); 
				$this->user_model->save_common('correspondence_address', $insert_data_corr);

				$insert_data_cast = array(
					'user_id'=> $user_id,
					'caste_name'	=>	$caste_re,
					'sub_caste_name'	=>	$subcaste,
					'status'	=> 1
				);
	
				$this->user_model->save_common('caste', $insert_data_cast);
		
				$random_no = mt_rand(100000, 999999);
				$startTime = date("Y-m-d H:i:s");
				$valid_time = date('Y-m-d H:i:s',strtotime('+10 minute',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
				$where = array('id' => $user_id);
				$updateData = array(
					'random_no' => $random_no,
					'valid_till' => $valid_time
					);
				$this->user_model->update_common($table, $where, $updateData);
				//$reset_link=base_url('admin/reset_password/?random_no='.$random_no);

			//$email=$profile->email;
			$subject = 'Thank you for registering with us';
			$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
				font-size: 16px; font-weight: 300; color: #444'>
				Dear ".$name1.''.$name3.",
				<p>
					Welcome&nbsp;!<br> Thank you for registering with us.<br>
					You are just one step away from becoming member of Wedding.com.  We're glad that you found us.<br><br>
					Please enter below OTP to verify your account:<br>
					Your OTP : ".$random_no."
				</p>
				<br>
				<p>Note: This OTP is valid only 10 minutes, after that the user can not verify his/her account using this otp.</p>
				</p>Support Team,</p>
				<p>".email_from_name."</p>
				<br>
				<a href='mailto:".admin_email."'>
					".admin_email."
				</a> /
				".admin_contact."
			</div>";	
			$this->my_send_email($email, $subject, $message);
			
			// send sms
			$smsmessage = "Dear ".$name1.''.$name3.
			",\nThank you for register with us. \n\nplease enter below otp to verify your account".
			"\nYour OTP : ".$random_no.
			"\n\nThank You, \n".email_from_name;
			$this->send_sms($contact, $smsmessage);
			
			//save notification
			$notisubject = 'New User Registered';
			$notimessage = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
			font-size: 16px; font-weight: 300; color: #444'>
			<p>
			Dear Admin, follwing are the Details of new Registered User: <br><br>
		
			User Name: ".$name1.''.$name3."<br>
			User Email: ".$email."<br>
			User Contact:".$contact."<br>
			Registered at: ".date('Y-m-d H:i:s')."<br>
			</p>
			</div>";
			$this->save_notifications(5, $notisubject, $notimessage, $user_id, 0);
			
			$this->session->set_flashdata("success_message","User register successfully.");
			redirect(base_url('verify_account'));
		}
	}
	
	public function verify_account()
	{
		$data = array('page_title'=>"Wedding | Verify Account", 'active'=>'profile' );
		$this->load->view('site/verify_account',$data);
	}
	
	// verify otp
	function otp_verify(){
		$this->form_validation->set_rules ( 'otp', 'OTP', 'required');
    	
		if($this->form_validation->run()==false){
    		$this->verify_account();
    	}else{
			$random_no = $_POST['otp'];
			$cur_time=date("Y-m-d H:i:s");

			$where = array('random_no' => $random_no);
			$reco = $this->user_model->get_common('user', $where, 'count(*) as rec');
			 
			if($reco->rec > 0){
				$this->db->where('random_no ', $random_no);
				$this->db->where('valid_till >=', $cur_time);
				$profile1 =$this->db->get('user');
				$profile = $profile1->row();
				$profilecnt = $profile1->result();
				$rec = count($profilecnt);
				if($rec > 0 ){
					// chnage user status
					$where = array('id' => $profile->id);
					$updateData = array(
						'status_id' => 1
					);
					$this->user_model->update_common('user', $where, $updateData);
					
					$this->session->set_flashdata("success_message","Your Account verified successfully, You can access it now.");
					redirect(base_url('login'));
				}else{
					$this->session->set_flashdata("error_message","OTP verify time has expired! try again.");
					redirect(base_url('verify_account'));	 
				}
			}else{
				$this->session->set_flashdata("error_message","OTP not match! try again.");
				redirect(base_url('verify_account'));	 
			}
		}
	}
	
	// user login
	public function do_login(){
		error_reporting(0);
		$this->form_validation->set_rules("email_id","Email-Id / Mobile Number","required");
		$this->form_validation->set_rules("password","Password","required");

		if($this->form_validation->run()==false){
			$this->login();
		}else{
			$session_id = $_REQUEST['session_id'];
			$userid = $_REQUEST['email_id'];
			$pass =$_REQUEST['password'];
			
			$table = 'user';
			$wheree = array('email' => $userid);
			$rece = $this->user_model->get_common($table, $wheree, 'count(email) as rec');
			
			if($rece->rec > 0){
				$where = array('email' => $userid, 'password' => md5($pass));
				$whereac = array('status_id' => 1, 'email' => $userid, 'password' => md5($pass));
			}else{
				$where = array('contact' => $userid, 'password' => md5($pass));
				$whereac = array('status_id' => 1, 'contact' => $userid, 'password' => md5($pass));
			}
			
			$rec = $this->user_model->get_common($table, $where, 'count(*) as rec');
			 
			if($rec->rec > 0){

				$reca = $this->user_model->get_common($table, $whereac, 'count(*) as reca');
				
				if($reca->reca > 0){
					 $profile = $this->user_model->get_common($table, $whereac);
					 $user_id = $profile->id;
					
					$tablet = 'tbl_cart';
					$wheretp = array('session_id' => $_SESSION['session_id']);
					$update_data = array(
						'customer_id' => $user_id,
						'session_id' => $user_id
					);
					$this->user_model->update_common($tablet, $wheretp, $update_data);

					$this->session->set_userdata('user_profile', $profile);
					//change session id to user id
					$_SESSION['session_id'] = $user_id;
	
					$this->session->set_flashdata("success_message","Login successfully.");
					redirect(base_url('profile'));
				 
				}else{
					$profile = $this->user_model->get_common($table, $where);
					if($profile->status_id == 3){
						$user_id = $profile->id;
						$name = $profile->name;
						$email = $profile->email;
						$user_contact = $profile->contact;
						//$random_no = uniqid().'-'.$user_id;
						$this->db->where('id ', $user_id);
						$profile1 =$this->db->get('user');
						$profile = $profile1->row();
						$profilecnt = $profile1->result();
						$rec = count($profilecnt);
						if($rec > 0 ){
							$random_no = $profile->random_no;
							$startTime = date("Y-m-d H:i:s");
							$valid_time = date('Y-m-d H:i:s',strtotime('+10 minute',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
						}else{
							$random_no = mt_rand(100000, 999999);
							$startTime = date("Y-m-d H:i:s");
							$valid_time = date('Y-m-d H:i:s',strtotime('+10 minute',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
						}
						$where = array('id' => $user_id);
						$updateData = array(
							'random_no' => $random_no,
							'valid_till' => $valid_time
							);
						$this->user_model->update_common($table, $where, $updateData);
						
						//$reset_link=base_url('admin/reset_password/?random_no='.$random_no);
					
						//$email=$profile->email;
						$subject = 'Verify your account using this OTP';
						$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
									font-size: 16px; font-weight: 300; color: #444'>
									Dear ".$name.",
									<p>
										Your account not verified, please enter below otp to verify your account: <br>
										Your OTP : ".$random_no."
									</p>
									<br>
									<p>Note: This OTP is valid only 10 Minute, after that the user can not verify his/her account using this otp.</p>
									</p>Support Team,</p>
									<p>".email_from_name."</p>
									<br>
									<a href='mailto:".admin_email."'>
										".admin_email."
									</a> /
									".admin_contact."
								</div>";	
							$this->my_send_email($email, $subject, $message);
							
							// send sms
							$smsmessage = "Dear ".$name.
							",\nYour account is not verified, please enter below otp to verify your account".
							"\nYour OTP : ".$random_no.
							"\n\nThank You, \n".email_from_name;

							$this->send_sms($user_contact, $smsmessage);
						
						$this->session->set_flashdata("error_message","Your account is not verified! please verify your account using otp that sends on your registered mobile number & mail-id.");
						redirect(base_url('verify_account'));

					}else{
						$this->session->set_flashdata("error_message","Your account not activated! please contact to admin.");
						redirect(base_url('login'));			
					}
				}
			}else{
				$this->session->set_flashdata("error_message","Invalid Username or Password! try again.");
				redirect(base_url('login'));
			}
		}	
	}
	
	// user login checkout
	public function do_login_checkout(){
		error_reporting(0);
		$this->form_validation->set_rules("email_id","Email-Id / Mobile Number","required");
		$this->form_validation->set_rules("password","Password","required");

		if($this->form_validation->run()==false){
			$this->login();
		}else{
			$session_id = $_REQUEST['session_id'];
			$userid = $_REQUEST['email_id'];
			$pass =$_REQUEST['password'];
			
			$table = 'user';
			$wheree = array('email' => $userid);
			$rece = $this->user_model->get_common($table, $wheree, 'count(email) as rec');
			
			if($rece->rec > 0){
				$where = array('email' => $userid, 'password' => md5($pass));
				$whereac = array('status_id' => 1, 'email' => $userid, 'password' => md5($pass));
			}else{
				$where = array('contact' => $userid, 'password' => md5($pass));
				$whereac = array('status_id' => 1, 'contact' => $userid, 'password' => md5($pass));
			}
			
			$rec = $this->user_model->get_common($table, $where, 'count(*) as rec');
			 
			if($rec->rec > 0){

				$reca = $this->user_model->get_common($table, $whereac, 'count(*) as reca');
				
				if($reca->reca > 0){
					$profile = $this->user_model->get_common($table, $whereac);
					$user_id = $profile->id;
					$this->session->set_userdata('user_profile', $profile);
					//change session id to user id
					$_SESSION['session_id'] = $user_id;
	
					$this->session->set_flashdata("success_message","Login successfully.");
					redirect(base_url('profile'));
				 
				}else{
					$profile = $this->user_model->get_common($table, $where);
					if($profile->status_id == 3){
						$user_id = $profile->id;
						$name = $profile->name;
						$email = $profile->email;
						$user_contact = $profile->contact;
						$this->db->where('id ', $user_id);
						$profile1 =$this->db->get('user');
						$profile = $profile1->row();
						$profilecnt = $profile1->result();
						$rec = count($profilecnt);
						if($rec > 0 ){
							$random_no = $profile->random_no;
							$startTime = date("Y-m-d H:i:s");
							$valid_time = date('Y-m-d H:i:s',strtotime('+10 minute',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
						}else{
							$random_no = mt_rand(100000, 999999);
							$startTime = date("Y-m-d H:i:s");
							$valid_time = date('Y-m-d H:i:s',strtotime('+10 minute',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
						}
						$where = array('id' => $user_id);
						$updateData = array(
							'random_no' => $random_no,
							'valid_till' => $valid_time
							);
						$this->user_model->update_common($table, $where, $updateData);
						
						//$reset_link=base_url('admin/reset_password/?random_no='.$random_no);
					
						//$email=$profile->email;
						$subject = 'Verify your account using this OTP';
						$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
									font-size: 16px; font-weight: 300; color: #444'>
									Dear ".$name.",
									<p>
										Your account not verified, please enter below otp to verify your account: <br>
										Your OTP : ".$random_no."
									</p>
									<br>
									<p>Note: This OTP is valid only 10 Minute, after that the user can not verify his/her account using this otp.</p>
									</p>Support Team,</p>
									<p>".email_from_name."</p>
									<br>
									<a href='mailto:".admin_email."'>
										".admin_email."
									</a> /
									".admin_contact."
								</div>";	
							$this->my_send_email($email, $subject, $message);
							
							// send sms
							$smsmessage = "Dear ".$name.
							",\nYour account is not verified, please enter below otp to verify your account".
							"\nYour OTP : ".$random_no.
							"\n\nThank You, \n".email_from_name;

							$this->send_sms($user_contact, $smsmessage);
						
						$this->session->set_flashdata("error_message","Your account is not verified! please verify your account using otp that sends on your registered mobile number & mail-id.");
						redirect(base_url('verify_account'));

					}else{
						$this->session->set_flashdata("error_message","Your account not activated! please contact to admin.");
						redirect(base_url('checkout'));			
					}
				}
			}else{
				$this->session->set_flashdata("error_message","Invalid Username or Password! try again.");
				redirect(base_url('checkout'));
			}
		}	
	}
	
		/*  Reset password */
	// forgost password view
	function forgot_password(){
		$this->load->view('site/forgot-pwd');
	}
	
	// send reset password link on mail
	function send_password_recovery_link(){
		error_reporting(0);
		$this->form_validation->set_rules("email_id","Email","required|valid_email");

		if($this->form_validation->run()==false){
			$this->forgot_password();
		}else{
			$table = 'user';
			$where = array('email' => $_POST['email_id']);
			$profile = $this->user_model->get_common($table, $where);

			if($profile == ''){
				$this->session->set_flashdata("error_message","Email-id Not Registered!");
				redirect(base_url('site/forgot_password'));
			}else{
				$random_no = uniqid().'-'.$profile->id;
				$startTime = date("Y-m-d H:i:s");
				$valid_time = date('Y-m-d H:i:s',strtotime('+10 minute',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
				$table = 'user';
				$where = array('id' => $profile->id);
				$updateData = array(
					'random_no' => $random_no,
					'valid_till' => $valid_time
					);
				$this->user_model->update_common($table, $where, $updateData);
				
				$reset_link=base_url('site/reset_password/?random_no='.$random_no);
				
				$email=$profile->email;
				$subject = 'Password Reset Link';
					$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
									font-size: 16px; font-weight: 300; color: #444'>
									Dear ".$profile->name.",
									<p>
										To reset your password, please click on reset password link as given below: <br><br>
										Reset Password : <a href='".$reset_link."' >Click here...</a><br>
									</p>
									<br>
									</p>Support Team,</p>
									<p>".admin_email."</p>
									<br>
									<a href='mailto:".admin_email."'>
										".admin_email."
									</a> /
									".admin_contact."
								</div>";	
				$this->my_send_email($email, $subject, $message, $pfd_file='');
				
				$this->session->set_flashdata("success_message","We have sent the password reset link to your registered mail-id. Please check and reset your password by clicking on link.");
				redirect(base_url(''));
			
			}
		}
	}
	
	// Reset password,, sent new password
	function reset_password(){
		error_reporting(0);
		if(!empty($_REQUEST['random_no'])){
			
			$random_no=$_REQUEST['random_no'];
			$uid_arr=explode('-',$random_no);
			$user_id=(int)$uid_arr[1];
			$cur_time=date("Y-m-d H:i:s");

			$this->db->where('id ', $user_id);
			$this->db->where('random_no ', $random_no);
			$this->db->where('valid_till >=', $cur_time);
			$profile1 =$this->db->get('user');
			$profile = $profile1->row();
			
			$rec = count($profile);
			if($rec > 0 ){
				/* $this->session->set_flashdata("success_message","We have sent the password reset link to your email. Please check and reset your password by clicking on link."); */
				$data=array('id' => $user_id, 'random_no' => $random_no);
				$this->load->view('site/reset-pwd',$data);
			}else{
				$this->session->set_flashdata("error_message","Your change password time has expired! Please try again.");
				redirect(base_url('forgot_password'));	 
			}
		}
	}
	
	// save reset password
	function update_reset_password(){
		error_reporting(0);
		$this->form_validation->set_rules("user_id","User Id","required");
		$this->form_validation->set_rules("new_password","New Password","required|matches[confirm_password]");
		$this->form_validation->set_rules("confirm_password","Confirm Password","required");

		if($this->form_validation->run()==false){

			//$this->reset_password();
			$this->session->set_flashdata("error_message","Enter New Password and Confirm Password Same!");
			redirect(base_url('site/reset_password?random_no='.$_POST['random_no']));
			
		}else{
			$table = 'user';
			$where = array('id' => $_POST['user_id']);
			$updateData = array('password' => md5($_POST['confirm_password']));
			
			$this->user_model->update_common($table, $where, $updateData);

			$this->session->set_flashdata("success_message","Password Reset successfully.");
			redirect(base_url('login'));
		}
	}
	/* End Reset password */
	
	function change_password(){
		$this->check_login();
		$data['active_menu'] = 'dashboard';
		$this->load->view('site/change_password', $data);
	}

	function update_password(){

		$this->form_validation->set_rules("current_password","Current Password","required");
		$this->form_validation->set_rules("new_password","New Password","required");
		$this->form_validation->set_rules("confirm_password","Confirm Password","required|matches[new_password]");

		if($this->form_validation->run()==false){

			$this->change_password();
		}else{
			 $table = 'user';
			 $where = array('id' => $_SESSION['user_profile']->id);
			 //$where1 = array('id' => $_SESSION['user_profile']->id,'password'=> md5($_POST['current_password']));
			$profile = $this->user_model->get_common($table, $where);
	
			if($profile->password == md5($_POST['current_password'])){
			$updateData = array('password' => md5($_POST['confirm_password']));
			 $this->user_model->update_common($table, $where, $updateData);
			 echo 1;
			}else{
			  echo 2;
			}
			
			//$this->session->set_flashdata("success_message","Password updated successfully.");
			//redirect(base_url('change_password'));
		}
	}

	public function check_current_password($pwd){
		$where = array('id' => $_SESSION['user_profile']->id);
		$table="user";

		$profile = $this->user_model->get_common($table, $where);

		if($profile->password != md5($pwd)){
			$this->form_validation->set_message('check_current_password','The Current Password is incorrect.');
			return false;
		}else{
			return true;
		}
	}

	// about us
	public function about_us()
	{
		$data = array('page_title'=>"Wedding | About", 'active'=>'about' );
		$this->load->view('site/coming',$data);
	}

	public function contact_us(){
		$data = array('page_title'=>"Wedding | Contact Us", 'active'=>'contact' );

		$this->load->view('site/contact',$data);
	}
	
	public function privacy_policy()
	{
		$data = array('page_title'=>"Wedding | Privacy Policy", 'active'=>'home' );
		$this->load->view('site/privacy-policy',$data);
	}
	
	public function terms_conditions()
	{
		$data = array('page_title'=>"Wedding | Terms & Conditions", 'active'=>'' );
		$this->load->view('site/term_condition',$data);
	}
	
	public function sitemap(){
		$data = array('page_title'=>"Wedding | Sitemap", 'active'=>'home' );

		$this->load->view('site/sitemap',$data);
	}
	
	public function help(){
		$data = array('page_title'=>"Wedding | Help", 'active'=>'home' );

		$this->load->view('site/help',$data);
	}
	
	public function family_profile(){
		$this->check_login();
		$table = 'user_family_details';
		$where = array('user_id' => $_SESSION['user_profile']->id);
		$group_by = '';
		$order_by = 'id';
		$order1 = 'DESC';
		$orders = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);

		$data = array('page_title'=>"Wedding | Family Details", 'active'=>'myorder', 'order'=> $orders);
		$this->load->view('site/my_family',$data);
	}
	public function city_name(){
		
		  $key=$_GET['key'];
		  $state=$_GET['state'];
   
			 $array = array();
			$wherestate = array('state_name' => $state);
			$state_c = $this->user_model->get_common('state', $wherestate,'*',2,'','','','');
			$state=$state_c[0]->id;
			$this->db->like('city_name', $key);
			$this->db->where('state', $state);
			$query = $this->db->get('city');
			foreach ($query->result() as $row)
				{
					$array[]= $row->city_name;
				}
	   echo json_encode($array);
	//$json = json_encode($array);  
    //print_r($json);
	}
	public function state_name(){
		
		  $key=$_GET['key'];
		//$state=$_GET['state'];
		//$city=$_GET['city'];
			 $array1 = array();
			
			$this->db->like('state_name', $key);
			$query = $this->db->get('state');
			//$this->db->where('state', $state);
			//$this->db->where('city', $city);
			foreach ($query->result() as $row)
				{
					$array1[]= $row->state_name;
				}
	   echo json_encode($array1);
	//$json = json_encode($array);  
    //print_r($json);
	}
	public function pincode(){
		
		  $key=$_GET['key'];
   
			 $array1 = array();
			
			$this->db->like('pin_code', $key);
			$query = $this->db->get('pincode');
			foreach ($query->result() as $row)
				{
					$array1[]= $row->pin_code;
				}
	   echo json_encode($array1);
	//$json = json_encode($array);  
    //print_r($json);
	}
	
	public function blogs()
	{
		error_reporting(0);
		$table1 = 'blogs';
		$where1 = array('status_id' => 1); // 
		//$blogs = $this->user_model->get_common($table1, $where1,'*',2);
		$blogs2 = $this->user_model->get_common($table1, $where1,'*',2,4);
		
		$category='';

		$table2 = 'blog_category';
		$blogs_cat=$this->user_model->get_common($table2,$where1,'*',2);

		$table3 = 'keyword';
		$blog_keywords=$this->user_model->get_common($table3,$where1,'*',2);

		$config = array();
        $config["base_url"] = base_url() . "site/blogs";
        $config["total_rows"] = $this->user_model->record_count($table1,$where1);
        $config["per_page"] = 8;
        $config["uri_segment"] = 3;
		$config['num_tag_open'] = '<li class="item-pagination flex-c-m trans-0-4">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a class="item-pagination flex-c-m trans-0-4 active-pagination" href="javascript:avoid(0);">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li class="page-item ">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item ">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item ">';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="ti ti-arrow-left"></i>';
		$config['next_link'] = '<i class="ti ti-arrow-right"></i>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

        $this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$blogs = $this->user_model->get_common($table1, $where1,'*',2, $config["per_page"], '', 'id', 'DESC', $page);

		$str_links = $this->pagination->create_links();
		$links= explode('&nbsp;',$str_links );
		
		$data = array(
			'page_title'=>"Wedding | Blogs", 
			'active'=>'blogs', 
			'blogs'=>$blogs, 
			'blogs_cat'=> $blogs_cat,
			'links' => $links,
			'category'=>$category,
			'blog_keywords'=>$blog_keywords,
			'blogs2'=>$blogs2
		);
		$this->load->view('site/blogs',$data);
	}
	
	// blog filters	
	function filter_blogs(){
		error_reporting(0);
		$category = $_POST['category'];
		$search = $_POST['search'];
		$keyword1 = $_POST['keyword'];
		$keyword = explode(",",$keyword1);
		
		if($category=='')
		{
			$where = array('status_id' => 1);
		}else{
			$where = array('status_id' => 1,'category' => $category);
		}
		
		if(is_array($keyword))
		{
			if(count($keyword)>1){
				$this->db->like('story', $keyword[0]);
				$i=1;
				for($i=1;$i<count($keyword);$i++){
				$this->db->or_like('story', $keyword[$i]);
				$i++;
				}
			}else{
				$this->db->like('story', $keyword[0]);
			}
		}	
		//$where['story like'] = implode(" OR ", $sql);
		
		$table = 'blogs';
		//$where = array('status_id' => 1);
		$select = '*';
		$total_rec = 2;
		//$limit_to = '5';
		$order_by = 'id';
		$order = 'DESC';
		$group_by = '';
		
		$config = array();
		$config["base_url"] = base_url() . "site/blogs";
		$config["total_rows"] = $this->user_model->record_count($table,$where);
		$config["per_page"] = 8;
		$config["uri_segment"] = 3;
		$config['num_tag_open'] = '<li class="item-pagination flex-c-m trans-0-4">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a class="item-pagination flex-c-m trans-0-4 active-pagination" href="javascript:avoid(0);">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li class="page-item ">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item ">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item ">';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="ti ti-arrow-left"></i>';
		$config['next_link'] = '<i class="ti ti-arrow-right"></i>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if(is_array($keyword))
		{
			if(count($keyword)>1){
				$this->db->like('story', $keyword[0]);
				$i=1;
				for($i=1;$i<count($keyword);$i++){
				$this->db->or_like('story', $keyword[$i]);
				$i++;
				}
			}else{
				$this->db->like('story', $keyword[0]);
			}
		}
		
		if($search=='')
		{
			//$where = array('status_id' => 1);
		}else{
			$this->db->like('title', $search);
		}
		
		$blogs = $this->user_model->get_common($table, $where, $select, $total_rec, $config["per_page"], $group_by, $order_by, $order, $page);
		
		$table1 = 'blog_category';
		$where1 = array('status_id' => 1);
		$select = '*';
		$total_rec = 2;
		$limit_to = '';
		$order_by = 'id';
		//$order = 'DESC';
		$blog_category = $this->user_model->get_common($table1, $where1, $select, $total_rec, $limit_to, $order_by);
		
		// for all keyword
		$keyword_where = array('status_id' => 1);
		$limit_tok = '';
		$group_byk = '';
		$order_byk = 'id';
		$orderk = 'DESC';
		$total_reck = '';
		$keyword_data = $this->user_model->get_common('keyword', $keyword_where, '*', $total_reck, $limit_tok,$group_byk, $order_byk, $orderk);
		// end for all keyword
		
		$where3 = array('status_id' => 1);
		$blogs2=$this->user_model->get_common($table, $where3,'*',2,4);

		$table3 = 'keyword';
		$blog_keywords=$this->user_model->get_common($table3,$where1,'*',2); 
		
		$str_links = $this->pagination->create_links();
		$links= explode('&nbsp;',$str_links );

		$data = array(
			'page_title' => 'Wedding | Blogs ',
			'active'=>'blogs',
			'blogs'	=>	$blogs,
			//'filter'	=>	$filter,
			'keyword'	=>	$keyword,
			'keyword_data' => $keyword_data,
			'category' => $category,
			'blogs_cat' => $blog_category,
			'links' => $links,
			'blogs2'=> $blogs2,
			'blog_keywords'=>$blog_keywords
		);
		$this->load->view('site/blogs', $data);
	}
	
	public function blog_details($id=0)
	{
		
		$table1 = 'blogs';
		$where1 = array('status_id' => 1, 'id'=> $id); // 
		$blogs = $this->user_model->get_common($table1, $where1,'*',2);

		$table2= 'blog_comments';
		$where2 = array('status_id' => 1, 'blog_id'=>$id); // 
		$blog_comments = $this->user_model->get_common($table2, $where2,'*',2);

		$where3 = array('status_id' => 1);
		$blogs2=$this->user_model->get_common($table1, $where3,'*',2,4);

		$table3 = 'keyword';
		$blog_keywords=$this->user_model->get_common($table3,$where3,'*',2);

		$blogs_cat=$this->user_model->get_common('blog_category', $where3,'*',2);

		$category='';

		$data = array('page_title'=>"Wedding | Blogs", 
			'active'=>'blogs',
			'blogs'=>$blogs,
			'blog_comments'=>$blog_comments,
			'id'=>$id,
			'blogs2'=>$blogs2,
			'blogs_cat'=>$blogs_cat,
			'category'=>$category,
			'blog_keywords'=>$blog_keywords
		);

		//print_r($data);
		//print_r($blog_comments);
		//exit();
		$this->load->view('site/blog_details',$data);
	}

	public function shop_category(){

		$data['page_title']="Wedding | Shop";
		$data['active']= 'shop';
		$this->load->view('site/shop_category',$data);
	}

	public function shop_curtain(){

		$data['page_title']="Wedding | Cutrains";
		$data['active']= 'shop';
		$this->load->view('site/shop_category_curtains',$data);
	}
	public function shop_wallpaper(){

		$data['page_title']="Wedding | Wallpaper";
		$data['active']= 'shop';
		$this->load->view('site/shop_category_wallpaper',$data);
	}
	public function shop_flooring(){

		$data['page_title']="Wedding | Flooring";
		$data['active']= 'shop';
		$this->load->view('site/shop_category_flooring',$data);
	}
	public function shop_cushions(){

		$data['page_title']="Wedding | Cushions";
		$data['active']= 'shop';
		$this->load->view('site/shop_category_cushions',$data);
	}
	public function shop_mattress(){

		$data['page_title']="Wedding | Mattress";
		$data['active']= 'shop';
		$this->load->view('site/shop_category_mattress',$data);
	}
	public function shop_carpets(){

		$data['page_title']="Wedding | Carpet";
		$data['active']= 'shop';
		$this->load->view('site/shop_category_carpet',$data);
	}
	
	public function shop_bed_linen(){

		$data['page_title']="Wedding | Bed Linen";
		$data['active']= 'shop';
		$this->load->view('site/shop_category_bed_linen',$data);
	}
	public function shop_bathroom_linen(){

		$data['page_title']="Wedding | Batroom Linen";
		$data['active']= 'shop';
		$this->load->view('site/shop_category_bathroom_linen',$data);
	}

	public function shop_blinds(){

		$data['page_title']="Wedding | Blind";
		$data['active']= 'shop';
		$this->load->view('site/shop_category_blinds',$data);
	}


	public function shop_grass(){

		$data['page_title']="Wedding | Artificial Garden and Grass";
		$data['active']= 'shop';
		$this->load->view('site/shop_category_grass',$data);
	}

	public function products(){
		$data['page_title']= 'Wedding | Products';
		$data['active']= 'shop';
		$this->load->view('site/coming',$data);
	}
	
	public function filter_products($cat_id='',$sub_cat='',$fev_id='',$page_id=''){
       error_reporting(0);
	  
		$table = 'products';
		if($cat_id=="" || $cat_id==1){
		$where = array('status' => 1, 'free_flag' => 0);
		}
		else{
			if($fev_id ==0){
			  //$where = array('status' => 1 ,'main_category' =>$cat_id,'sub_category'=>$sub_cat);
			  $where = array('status' => 1, 'main_category' =>$cat_id, 'sub_category' => $sub_cat, 'free_flag' => 0);
			}
			else
			{
				//echo "hi";
			// $where = array('status' => 1 ,'main_category' =>$cat_id,'brand_id'=>$brand_id,'sub_category'=>$sub_cat);
			 $where = array('status' => 1, 'main_category' =>$cat_id, 'flavour'=>$fev_id, 'sub_category' => $sub_cat, 'free_flag' => 0);
			}
		}
		$group_by = '';
		$order_by = 'position';
		$order = 'DESC';
	    $product = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order);

		$config = array();
        $config["base_url"] = base_url() . "site/filter_products/".$cat_id.'/'.$brand_id.'/'.$sub_cat;
        $config["total_rows"] = $this->user_model->record_count($table,$where);
        $config["per_page"] = 9;
        $config["uri_segment"] = 6;
		$config['num_tag_open'] = '<li class="item-pagination flex-c-m trans-0-4">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a class="item-pagination flex-c-m trans-0-4 active-pagination" href="javascript:avoid(0);">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li class="page-item ">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item ">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item ">';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="ti ti-arrow-left"></i>';
		$config['next_link'] = '<i class="ti ti-arrow-right"></i>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

        $this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		$product_page = $this->user_model->get_common($table, $where,'*',2, $config["per_page"], '', 'position', 'DESC', $page);
		/* 
		$sub_cate=array();
	    for($i=0;$i<count($product);$i++){ 
			array_push($sub_cate,$product[$i]->sub_category);
		 }
	      array_unique($sub_cate);
		  foreach($sub_cate as $id){
		  $bid.=$id.',';
		}
	    $brid="";
	    $brid=trim($bid,',');
		
		$this->db->select('*');
        $this->db->where('product_cat_id', $cat_id);
        $sub_cat = $this->db->get('product_subcategory');
		$sub_cat1 = $sub_cat->result(); */
	  
        /* $tableb = 'brands';
		$whereb = array('status_id' => 1);
		$group_by = '';
		$brands = $this->user_model->get_common($tableb, $whereb,'*',2);
		 */
		$table = 'product_category';
		$where = array('status_id' => 1);
		$category = $this->user_model->get_common($table, $where,'*',2,'','','','');
		
		$table = 'flavour';
		$where = array('status_id' => 1);
		$flavour = $this->user_model->get_common($table, $where,'*',2,'','','','');
		
		$tablecn = 'product_category';
		$wherecn = array('status_id' => 1,'id'=>$cat_id);
		$single_category = $this->user_model->get_common($tablecn, $wherecn,'*',2);
		$single_category1=$single_category[0]->name;
		
		/* $arrTID=array();
		for($i=0;$i<count($product);$i++){
			array_push($arrTID,$product[$i]->brand_id);
		}
		array_unique($arrTID);
		
		foreach($arrTID as $id){
		  $bid.=$id.',';
		}
	    $brid="";
	    $brid=trim($bid,',');
		
		$this->db->select('*');
        $this->db->where_in('id', explode(',',$brid));
        $brand_image = $this->db->get('brands');
		$brand_image1 = $brand_image->result(); // as array*/
		
		$str_links = $this->pagination->create_links();
		$links= explode('&nbsp;',$str_links );
		$brands=$brand_image1; 
		
		$data = array(
			//'active' => 'shop',
			'product' => $product_page,
			//'brands' => $brands,
			'flavour' => $flavour,
			'category' => $category,
			//'sub_cat1'=>$sub_cat1,
			//'brand_image1'=>$brand_image1,
			'links'=>$links
		);
		$data['page_title']= 'Wedding | Products';
		$data['active']= 'shop';
		$this->load->view('site/products',$data);
	}

	public function product_details($id=''){
		error_reporting(0);
		//echo $this->uri->segment(2);
		$product_id = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		$table = 'products';
		$group_by = '';
		$order_by = '';
		$order = '';
		
		$where = array('status' => 1 ,'product_id' =>$product_id);
	    $products = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order);
		
		$wherer = array('status' => 1,'product_id !=' =>$product_id,'free_flag' => 0);
		$rel_product = $this->user_model->get_common($table, $wherer,'*',2, '', $group_by, $order_by, $order);
		
		$category = $products->main_category;
		$subcategory = $products->sub_category;
		$brand = $products->brand_id;
		$flavour = $products->flavour;
		
		if($category && $subcategory && $brand)
		{
			$wheref = array('status' => 1, 'main_category' =>$category,'sub_category' =>$subcategory,'brand_id' =>$brand, 'free_flag' => 0);
		}else if($subcategory && $brand=='')
		{
			$wheref = array('status' => 1, 'main_category' =>$category,'sub_category' =>$subcategory);
		}else if($subcategory ==''&& $brand)
		{
			$wheref = array('status' => 1, 'main_category' =>$category,'brand_id' =>$brand, 'free_flag' => 0);
		}else{
			$wheref = array('status' => 1,'main_category' =>$category, 'free_flag' => 0);
		}
		$group_byf = 'flavour';
		$order_byf = '';
		$orderf = '';
	    $flavour_product = $this->user_model->get_common($table, $wheref,'*',2, '', $group_byf, $order_byf, $orderf);
		
		$this->db->select('*');
		$this->db->where('status', 1);
		$this->db->where('free_flag', 0);
		if($category)
		{
			$this->db->where('main_category', $category);
		}
		if($subcategory)
		{
			$this->db->where('sub_category', $subcategory);
		}
		if($brand)
		{
			$this->db->where('brand_id', $brand);
		}
		if($flavour)
		{
			$this->db->where('flavour', $flavour);
		}
        $weight_product1 = $this->db->get('products');
		$weight_product = $weight_product1->result();
		
		/* print_r($weight_product);
		exit; */
		
		$table = 'product_images';
		$where = array('status' => 1,'product_id' => $product_id);
		$product_image = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order);
       
		$data = array('active'=>'shop','weight_product'=>$weight_product, 'flavour_product'=>$flavour_product,'rel_product'=>$rel_product,'products'=>$products,'product_image'=>$product_image,'page_title'=>$products->product_name);
		
		$this->load->view('site/product_detail',$data);
	}
	
	// save_rating
	public function save_rating(){
		error_reporting(0);	

		$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric|min_length[10]|max_length[10]');

		if($this->form_validation->run()==false){
		echo 2;
		}else{


		$e_name = ucfirst(trim($_POST['name']));
		$product_id = $_POST['product_id'];
		$email1 = $_POST['email'];
		$contact = $_POST['contact'];
		$description = $_POST['description'];
		$rating = $_POST['rating'];

		$string = preg_replace('/\s+/', '', $email1);
		$e_email1 = strtolower($string);
		$e_email = trim($e_email1);

		$insert_data = array(
			'name'	=>	$e_name,
			'email'	=>	$e_email,
			'contact'	=>	$_POST['contact'],
			'description'	=>	$_POST['description'],
			'rating'	=>	$_POST['rating'],
			'product_id'	=>	$_POST['product_id'],
			'status'	=>	2
		);

		$table = 'rating';
		$this->user_model->save_common($table, $insert_data);

		$subject = 'Review & Rating on Product';
		$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
		font-size: 16px; font-weight: 300; color: #444'>
		Dear User,
		<p>
		New Product Review & Rating on Product: <br><br>
		Name: ".$e_name."<br>
		Contact: ".$contact."<br>
		Email-Id: ".$e_email."<br>
		Review: ".$description."<br>
		Rating: ".$rating."<br>
		</p>
		<br>
		</p>Support Team,</p>
		<p>".email_from_name."</p>
		<br>
		<a href='mailto:".admin_email."'>
		".admin_email."
		</a> /
		".admin_contact."
		</div>";
		if($email1!=''){	
		// send email to admin
		$this->my_send_email($shop_email, $subject, $message);
		}
		// save notification to admin
		$this->save_notifications(7, $subject, $message, $product_id, 0);
		echo 1;
		}
	}

	public function product_category(){

		$data['page_title']="Wedding | Product Category";
		$table = 'product_category';
		$where = array('status_id' => 1);
		$category = $this->user_model->get_common($table, $where,'*',2);

		$data['category']= $category ;
		$data['active']= 'shop';
		$this->load->view('site/product_category',$data);
	}
	
	public function view_product_details(){
		$product_id=$_POST['id'];
		$table = 'products';
		    $where = array('status' => 1 ,'product_id' =>$product_id);
		
			$group_by = '';
			$order_by = '';
			$order = '';
			$product = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order);
			$data = array('product' => $product,"dfd"=>"dff");
			
		$data['active']= 'shop';
		$this->load->view('site/view_product_details',$data);
	}
	
	public function view_product_details1(){
		$product_id=$_POST['id'];

		$table = 'services';
		$where = array('status_id' => 1 ,'id' =>$product_id);
		$group_by = '';
		$order_by = '';
		$order = '';
		$services = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order);
		$data = array('services' => $services );

		$this->load->view('site/view_product_details1',$data);
	}
	
	function check_login(){
		if($this->session->userdata('user_profile')==''){
			redirect(base_url('login'));
		}else{
			return true;
		}
	}
	
	function logout(){
		$this->session->set_userdata('user_profile','');
		unset($_SESSION['session_id']);
		redirect(base_url('login'));
	}
	
	public function tracking(){
		$data = array('page_title'=>"Wedding | Tracking", 'active'=>'track' );
		$this->load->view('site/add_track',$data);
	}
	
	public function track(){
		
		$data = array('page_title'=>"Wedding | Tracking", 'active'=>'track' );

		$this->load->view('site/tracking',$data);
	}

	public function cart(){
		error_reporting(0);
		$table = 'tbl_cart';
		if($this->session->userdata('user_profile') !='')
		{
			$where = array('customer_id' =>$_SESSION['user_profile']->id);
		}else{
			$where = array('session_id' =>$_SESSION['session_id']);
		}
		$tbl_cart = $this->user_model->get_common($table, $where,'*',2);
		 
		$data = array('page_title'=>"Wedding | My Cart", 'active'=>'cart', 'tbl_cart'=>$tbl_cart );

		$this->load->view('site/cart',$data);
	}

	public function profile_cart(){
		error_reporting(0);
		
		$this->check_login();
		$table = 'tbl_cart';
		$where = array('user_id' =>$_SESSION['user_profile']->id);
		$tbl_cart = $this->user_model->get_common($table, $where,'*',2);
		 
		$data = array('page_title'=>"Wedding | My Cart", 'active'=>'cart', 'tbl_cart'=>$tbl_cart );

		$this->load->view('site/profile_cart',$data);
	}

	public function profile_wishlist(){
		error_reporting(0);
		$this->check_login();
		$table = 'tbl_wishlist';
		 
		 $where = array('user_id' =>$_SESSION['user_profile']->id);
		 
		$tbl_wishlist = $this->user_model->get_common($table, $where,'*',2);
		 
		$data = array('page_title'=>"Wedding | My Cart", 'active'=>'cart', 'tbl_wishlist'=>$tbl_wishlist );

		$this->load->view('site/profile_wishlist',$data);
	}
	
	
	public function remove_to_wishlist(){
		  error_reporting(0);
		$this->check_login();
		$id = $_POST["wishlist_id"];
		$where = array('id'=>$id);
		$this->user_model->delete_common('tbl_wishlist', $where);
 
		print 1;
	}
	
	public function services(){
	
		$data = array('page_title'=>"Wedding | Services", 'active'=>'services' );
		$this->load->view('site/coming',$data);
	}
	 
	// video
	function videos(){

		$table = 'video';
		$where = array('status_id !=' => 0);
		$video = $this->user_model->get_common($table, $where,'*',2);

		$data = array('video' => $video);
		$data['page_title']= 'Wedding | Videos';
		$data['active'] = 'video';
		$this->load->view('site/video', $data);
	}
	
	public function profile(){
		$this->check_login();
		error_reporting(0);
		$table = 'user';
		$where = array('id'=>$_SESSION['user_profile']->id);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$user = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);

		$table = 'user_details';
		$where = array('user_id'=>$user->id);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$user_profile = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);

		$table = 'caste';
		$where = array('user_id'=>$user->id);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$caste = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);

		$table = 'correspondence_address';
		$where = array('user_id'=>$user->id);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$correspondence_address = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);

		$table = 'resident_address';
		$where = array('user_id'=>$user->id);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$resident_address = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);
		$data = array('page_title'=>"Wedding | My Profile" , 
		'user_profile'=>$user_profile,
		'user'=>$user,
		'resident_address'=>$resident_address,
		'caste'=>$caste,
		'correspondence_address'=>$correspondence_address);
		$this->load->view('site/profile', $data);
	}
	
	function edit_user_profile(){
		$this->check_login();
		//error_reporting(0);
		
		$table = 'user';
		$where = array('id'=>$_SESSION['user_profile']->id);
		$group_by = '';
		$order_by = 'id';
		$user_profile = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);
		
		$tablec = 'resident_address';
		$wherec = array('user_id'=>$_SESSION['user_profile']->id);
		$resident_address = $this->user_model->get_common($tablec, $wherec);
		$res_address=$resident_address->address;
		$res_country=$resident_address->country;
		$res_state=$resident_address->state;
		$res_city=$resident_address->city;
		$res_landmark=$resident_address->landmark;
		$res_district=$resident_address->district;
		$res_pincode=$resident_address->pincode;

		$tablec = 'correspondence_address';
		$wherec = array('user_id'=>$_SESSION['user_profile']->id);
		$resident_address = $this->user_model->get_common($tablec, $wherec);
		$corr_address=$resident_address->address;
		$corr_country=$resident_address->country;
		$corr_state=$resident_address->state;
		$corr_city=$resident_address->city;
		$corr_landmark=$resident_address->landmark;
		$corr_district=$resident_address->district;
		$corr_pincode=$resident_address->pincode;

		$tablec = 'caste';
		$wherec = array('user_id'=>$_SESSION['user_profile']->id);
		$profilcaste = $this->user_model->get_common($tablec, $wherec);
		$castenm=$profilcaste->caste_name;
		$subcastenm=$profilcaste->sub_caste_name;

		$tablec = 'user_details';
		$wherec = array('user_id'=>$_SESSION['user_profile']->id);
		$user_profiledtails = $this->user_model->get_common($tablec, $wherec);
		//print_r($user_profiledtails);exit;
		$fname=$user_profiledtails->first;
		$mname=$user_profiledtails->middle;
		$lname=$user_profiledtails->last;
		$img=$user_profiledtails->image;
		$genders=$user_profiledtails->gender;
		$contcd=$user_profiledtails->contry_code;
		$phone=$user_profiledtails->contact;
		$dob=$user_profiledtails->date_of_birth;
		$rel=$user_profiledtails->religion;
		$lan=$user_profiledtails->language;
		$msta=$user_profiledtails->marital_status;
		$data = array( 
			'user_profile'=>$user_profile,
			'res_address'=>$res_address,
			'res_country'=>$res_country,
			'res_state'=>$res_state,
			'res_city'=>$res_city,
			'res_district'=>$res_district,
			'res_pincode'=>$res_pincode,
			'res_landmark'=>$res_landmark,
			'corr_address'=>$corr_address,
			'corr_country'=>$corr_country,
			'corr_state'=>$corr_state,
			'corr_city'=>$corr_city,
			'corr_district'=>$corr_district,
			'corr_pincode'=>$corr_pincode,
			'corr_landmark'=>$corr_landmark,
			'fname'=>$fname,
			'mname'=>$mname,
			'lname'=>$lname,
			'img'=>$img,
			'genders'=>$genders,
			'contcd'=>$contcd,
			'phone'=>$phone,
			'dob'=>$dob,
			'rel'=>$rel,
			'lan'=>$lan,
			'castenm'=>$castenm,
			'subcastenm'=>$subcastenm,
			'msta'=>$msta
		);
		$this->load->view('site/edit_user_profile', $data);
	}
	
	function update_user(){
		error_reporting(0);
		$this->check_login();
		$this->form_validation->set_rules ( 'first_name', ' First Name', 'required' );
		$this->form_validation->set_rules ( 'middle_name', ' Middle Name', 'required' );
		$this->form_validation->set_rules ( 'last_name', ' Last Name', 'required' );
		$this->form_validation->set_rules ('email_id', 'Email-Id','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules ( 'contact', 'Mobile', 'required|numeric|min_length[10]|max_length[10]');  
    	if($this->form_validation->run()==false){
    		$this->edit_user_profile();
    	}else{
			$name1 = $_POST['first_name'];
			$fname = trim($name1);
			$name2 = $_POST['middle_name'];
			$mname = trim($name2);
			$name3 = $_POST['last_name'];
			$lname = trim($name3);
			$email1 = trim($_POST['email_id']);
			$string = preg_replace('/\s+/', '', $email1);
			$email = strtolower($string);
			$contact = trim($_POST['contact']);
			$gender = trim($_POST['gender']);
			$marital_status = trim($_POST['marital_status']);
			$mother_tounge = trim($_POST['mother_tounge']);
			$date = trim($_POST['date']);
			$religion = trim($_POST['religion']);
			$caste = trim($_POST['caste']);
			$sub_caste = trim($_POST['sub_caste']);
			 
			$address_line1 =  trim($_POST['res_address']);
			$res_country = trim($_POST['res_country']);
			$res_state = trim($_POST['res_state']);
			$res_city = trim($_POST['res_city']);
			$res_pincode = trim($_POST['res_pincode']);
			$res_district = trim($_POST['res_district']);
			$res_landmark = trim($_POST['res_landmark']);
			
			$corr_address =  trim($_POST['corr_address']);
			$corr_country = trim($_POST['corr_country']);
			$corr_state = trim($_POST['corr_state']);
			$corr_district = trim($_POST['corr_district']);
			$corr_city = trim($_POST['corr_city']);
			$corr_pincode = trim($_POST['corr_pincode']);
			$corr_landmark = trim($_POST['corr_landmark']);
			$update_date=date('Y-m-d');

			$update_datas = array(
				'first'	=>	$fname,
				'middle'	=>	$mname,
				'last'	=>	$lname,
				'gender'	=>	$gender,
				'marital_status'	=>	$marital_status,
				'language'	=>	$mother_tounge,
				'date_of_birth'	=>	$date,
				'religion'	=>	$religion,
				'update_by'	=>	$_SESSION['user_profile']->id,
				'update_date'	=>	$update_date,
				'status'	=>	1
			 );

			$tables = 'user_details';
			$wheres = array('user_id'=>$_SESSION['user_profile']->id);
			$this->user_model->update_common($tables, $wheres, $update_datas);

			$update_datares = array(
				'address'	=>	$address_line1,
				'country'	=>	$res_country,
				'state'	=>	$res_state,
				'city'	=>	$res_state,
				'district'	=>	$res_district,
				'pincode'	=>	$res_pincode,
				'landmark'	=>	$res_landmark,
				'update_by'	=>	$_SESSION['user_profile']->id,
				'update_date'	=>	$update_date,
				'status'	=>	1
			 );

			$tableres = 'resident_address';
			$whereres = array('user_id'=>$_SESSION['user_profile']->id);
			$this->user_model->update_common($tableres, $whereres, $update_datares);

			$update_datacaste = array(
				'caste_name'	=>	$caste,
				'sub_caste_name'	=>	$sub_caste,
				'updated_by'	=>	$_SESSION['user_profile']->id,
				'updated_date'	=>	$update_date,
				'status'	=>	1
			 );

			$tablecaste = 'caste';
			$wherecaste = array('user_id'=>$_SESSION['user_profile']->id);
			$this->user_model->update_common($tablecaste, $wherecaste, $update_datacaste);

			$update_datacorr = array(
				'address'	=>	$corr_address,
				'country'	=>	$corr_country,
				'state'	=>	$corr_state,
				'city'	=>	$corr_city,
				'district'	=>	$corr_district,
				'pincode'	=>	$corr_pincode,
				'landmark'	=>	$corr_landmark,
				'update_by'	=>	$_SESSION['user_profile']->id,
				'update_date'	=>	$update_date,
				'status'	=>	1
			 );

			$tablecorr = 'correspondence_address';
			$wherecorr = array('user_id'=>$_SESSION['user_profile']->id);
			$this->user_model->update_common($tablecorr, $wherecorr, $update_datacorr);
			
			$update_data = array(
				'email'	=>	$email,
				'contact'	=>	$contact,
				'status_id'	=>	1
			 );

			$table = 'user';
			$where = array('id'=>$_SESSION['user_profile']->id);
			$this->user_model->update_common($table, $where, $update_data);
			echo 1;
		
		}
	}

	function save_user(){
		error_reporting(0);
		$this->check_login();
		$this->form_validation->set_rules ( 'first_name', ' First Name', 'required' );
		$this->form_validation->set_rules ( 'middle_name', ' Middle Name', 'required' );
		$this->form_validation->set_rules ( 'last_name', ' Last Name', 'required' );
		$this->form_validation->set_rules ( 'relation', 'Relation', 'required' );
		$this->form_validation->set_rules ('email_id', 'Email-Id','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules ( 'contact', 'Mobile', 'required|numeric|min_length[10]|max_length[10]');  
    	if($this->form_validation->run()==false){
    		$this->add_family_member();
    	}else{
			$name1 = $_POST['first_name'];
			$fname = trim($name1);
			$name2 = $_POST['middle_name'];
			$mname = trim($name2);
			$name3 = $_POST['last_name'];
			$lname = trim($name3);
			$email1 = trim($_POST['email_id']);
			$string = preg_replace('/\s+/', '', $email1);
			$email = strtolower($string);
			$contact = trim($_POST['contact']);
			$gender = trim($_POST['gender']);
			$marital_status = trim($_POST['marital_status']);
			$mother_tounge = trim($_POST['mother_tounge']);
			$date = trim($_POST['date']);
			$religion = trim($_POST['religion']);
			$caste = trim($_POST['caste']);
			$sub_caste = trim($_POST['sub_caste']);
			$relation = trim($_POST['relation']);
			
			$address_line1 =  trim($_POST['res_address']);
			$res_country = trim($_POST['res_country']);
			$res_state = trim($_POST['res_state']);
			$res_city = trim($_POST['res_city']);
			$res_pincode = trim($_POST['res_pincode']);
			$res_district = trim($_POST['res_district']);
			$res_landmark = trim($_POST['res_landmark']);

			$corr_address =  trim($_POST['corr_address']);
			$corr_country = trim($_POST['corr_country']);
			$corr_state = trim($_POST['corr_state']);
			$corr_district = trim($_POST['corr_district']);
			$corr_city = trim($_POST['corr_city']);
			$corr_pincode = trim($_POST['corr_pincode']);
			$corr_landmark = trim($_POST['corr_landmark']);
			$update_date=date('Y-m-d');

			$insert_data = array(
				'user_id'	=>	$_SESSION['user_profile']->id,
				'first'	=>	$fname,
				'middle'	=>	$mname,
				'last'	=>	$lname,
				'email'	=>	$email,
				'contact'	=>	$contact,
				'gender'	=>	$gender,
				'marital_status'	=>	$marital_status,
				'language'	=>	$mother_tounge,
				'date_of_birth'	=>	$date,
				'relation_id'	=>	$relation,
				'religion'	=>	$religion,
				'created_by'	=>	$_SESSION['user_profile']->id,
				'created_date'	=>	$update_date,
				'status'	=>	1
			 );

			$tables = 'user_family_details';
			$this->user_model->save_common($tables, $insert_data);
			$family_id = $this->db->insert_id();

			$insert_data = array(
				'family_id'	=>	$family_id,
				'address'	=>	$address_line1,
				'country'	=>	$res_country,
				'state'	=>	$res_state,
				'city'	=>	$res_state,
				'district'	=>	$res_district,
				'landmark'	=>	$corr_landmark,
				'pincode'	=>	$res_pincode,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'status'	=>	1
			 );

			$tableres = 'resident_address';
			$this->user_model->save_common($tableres, $insert_data);

			$insert_data = array(
				'family_id'	=>	$family_id,
				'caste_name'	=>	$caste,
				'sub_caste_name'	=>	$sub_caste,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'added_date'	=>	$update_date,
				'status'	=>	1
			 );

			$tablecaste = 'caste';
			$this->user_model->save_common($tablecaste, $insert_data);

			$insert_data = array(
				'family_id'	=>	$family_id,
				'address'	=>	$corr_address,
				'country'	=>	$corr_country,
				'state'	=>	$corr_state,
				'city'	=>	$corr_city,
				'district'	=>	$corr_district,
				'pincode'	=>	$corr_pincode,
				'landmark'	=>	$corr_landmark,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'status'	=>	1
			 );

			$tablecorr = 'correspondence_address';
			$this->user_model->save_common($tablecorr, $insert_data);
			echo 1;
		
		}
	}
	
	// my orders
	public function my_orders(){
		$this->check_login();
		$table = 'tbl_order';
		$where = array('user_id' => $_SESSION['user_profile']->id);
		$group_by = '';
		$order_by = 'id';
		$order1 = 'DESC';
		$orders = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);

		$data = array('page_title'=>"Wedding | Authenticate", 'active'=>'authenticate', 'order'=> $orders);
		$this->load->view('site/orders',$data);
	}
	
	
	public function view_order_details(){
		$this->check_login();
		$order_id=$_POST['id'];
		$table = 'user_family_details';
		$group_by = '';
		$order_by = 'id';
		$where = array('id' => $order_id);
		$order = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);

		$table = 'correspondence_address';
		$group_by = '';
		$order_by = 'id';
		$where = array('family_id' => $order_id);
		$corres = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);

		$table = 'resident_address';
		$group_by = '';
		$order_by = 'id';
		$where = array('family_id' => $order_id);
		$reside = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);

		$table = 'caste';
		$group_by = '';
		$order_by = 'id';
		$where = array('family_id' => $order_id);
		$caste = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);
		$data = array(
			'page_title' => 'Order Details | Wedding',
			'order' => $order,
			'corres' => $corres,
			'reside' => $reside,
			'caste' => $caste
		);
		
		$this->load->view('site/view_order_details', $data);
	}
	
	public function add_family_member(){
		$this->check_login();
		$order_id=$_POST['id'];

		$table = 'user_details';
		$group_by = '';
		$order_by = 'id';
		$where = array('user_id' => $order_id);
		$order = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);
		
		$table = 'family_relation';
		$where = array('status !=' => 0);
		$relation = $this->user_model->get_common($table, $where,'*',2, '');
		$data = array(
			'page_title' => 'Order Details | Wedding',
			'order' => $order,
			'relation' => $relation
		);
		
		$this->load->view('site/add_family_member', $data);
	}
	// Enquiry
	public function order_payment_enquiry(){
		$id=$_REQUEST['id'];
		
		$table = 'tbl_order';
		$where = array('id' => $id);
		$order_data = $this->user_model->get_common($table, $where);
		
		$user_id = $_SESSION['user_profile']->id;
		
		$tablep = 'tbl_payment';
		$wherep = array('order_id' => $id, 'user_id' => $user_id);
		$payment_data = $this->user_model->get_common($tablep, $wherep);
		
		if(count($payment_data)>0){
			$data = array('page_title'=>"Wedding | Enquiry", 'active'=>'Refund','order_data'=>$order_data,'payment_data'=>$payment_data);
			$this->load->view('site/HostedPaymentEnquiry',$data);
		}else{
			$this->session->set_flashdata("error_message","There is no any payment made for this order! try again.");
			redirect(base_url('my-orders'));
		}
		
	}
	
	// retrun refund
	public function cancel_delete_order_refund(){
		$id=$_REQUEST['id'];
		//$status=$_REQUEST['st'];
		
		$table = 'tbl_order';
		$where = array('id' => $id);
		$order_data = $this->user_model->get_common($table, $where);
		
		$user_id = $_SESSION['user_profile']->id;
		
		$tablep = 'tbl_payment';
		$wherep = array('order_id' => $id, 'user_id' => $user_id);
		$payment_data = $this->user_model->get_common($tablep, $wherep);

		if(count($payment_data)>0){
			$data = array('page_title'=>"Wedding | Refund", 'active'=>'Refund','order_data'=>$order_data,'payment_data'=>$payment_data);
			$this->load->view('site/HostedPaymentRefund',$data);
		}else{
			$this->session->set_flashdata("error_message","Your Order cancel request not placed! try again.");
			redirect(base_url('my-orders'));
		}
		
	}
	
	// retrun refund
	public function refund_success(){
		error_reporting(0);
		$this->load->helper('custom');
		$payment_status = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$txt_id = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$track_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : '';
		$status = 5;
		//echo $payment_status;
		//exit;
		if($payment_status == 'CAPTURED' || $payment_status == 'APPROVED' || $payment_status == 'VOIDED' || $payment_status == 'SUCCESS')
		{
			$tablep = 'tbl_payment';
			$wherep = array('txt_id' => $txt_id);
			$updateDatap = array('status_id' => 2);
			$upt=$this->user_model->update_common($tablep, $wherep, $updateDatap);
			$payment = $this->user_model->get_common($tablep, $wherep,'*',1);
			$id = $payment->order_id;
			$payment_amount = $payment->payment_amount;
			$payment_currency = $payment->payment_currency;
			$payment_mode = $payment->payment_mode;
			$payment_from = $payment->payment_from;
			
			$table = 'tbl_order';
			$where = array('id' => $id);
			$updateData = array('order_status' => $status);
			$upt=$this->user_model->update_common($table, $where, $updateData);	
			$order = $this->user_model->get_common($table, $where,'*',1);		
			$user_id = $order->user_id;
			
			$tablec = 'user';
			$wherec = array('id' => $user_id);
			$user_data = $this->user_model->get_common($tablec, $wherec);
			$user_name = $user_data->name;
			$user_contact = $user_data->contact;
			$user_email = $user_data->email;
			$country = $user_data->country;
			$state = $user_data->state;
			$city = $user_data->city;
			$pincode = $user_data->pincode;
			$address = $user_data->address1;
			$user_address = $country.', '.$state.', '.$city.', '.$address.'-'.$pincode;
			
			$email = $user_email;
			
			// save refund payment data
			$insert_datap = array(
				'txt_id'	=>	$txt_id,
				'track_id'	=>	$track_id,
				'payment_id'	=>	0,
				'order_id'	=>	$id,
				'user_id'	=>	$user_id,
				'payment_amount'	=>	$payment_amount,
				'payment_currency'	=>	$payment_currency,
				'payment_mode'	=>	$payment_mode,
				'payment_from'	=>	$payment_from,
				'payment_status'	=>	$payment_status,
				'status_id'	=>	2
			);

			$tablep = 'tbl_payment';
			$this->user_model->save_common($tablep, $insert_datap);
			
			$table = 'tbl_order_item';
			$group_by = '';
			$order_by = 'id';
			$order2 = 'DESC';
			$where = array('order_id' => $id);
			$order_detail = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order2);
			
			for($i=0;$i<count($order_detail);$i++){ 
								
			$order_qty = $order_detail[$i]->quantity;
			 
			 $table='products';
			 $where = array('product_id'=>$order_detail[$i]->product_id);
			 $group_by = '';
			 $order_by = 'product_id';
			 $order2 = 'DESC';
			 $product_name = $this->user_model->get_common($table, $where,'*',2, '',$group_by, $order_by, $order2);
			 $prod_id =$product_name[0]->product_id;
			 $quantity =$product_name[0]->quantity;
			 
			 $total_qty =$quantity+$order_qty;
			 $update_datapupt = array('quantity'=> $total_qty);
			 $this->user_model->update_common($table, $where, $update_datapupt);
			 
			}

			if($status==1){
				$order_status="Pending";
			}else if($status==5){
				
				$this->session->set_flashdata("success_message","Your Order Cancelled Suuessfully!.");
				
				$order_status="Cancelled by user";
					$subject = 'Your Order #'.$id.' is Cancelled by You';
					$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
						font-size: 16px; font-weight: 300; color: #444'>
						Dear ".$user_name.",
						<p>
							Your Order #".$id." is Cancelled at: ".date('Y-m-d H:i:s')." 
						</p><br>
						<p> Thanks & Regards,</p>
						<br>
						<br>
						</p>Support Team,</p>
						<p>".email_from_name."</p>
						<br>
						<a href='mailto:".admin_email."'>
							".admin_email."
						</a> /
						".admin_contact."
					</div>";						
					$this->my_send_email($email, $subject, $message);
					
					// send sms notification  
					$notify_sms=$user_data->notify_sms;
					if($notify_sms==1){ 
						$smsmessage = "Dear ".$user_name.
						",\nYour order ".$id." is Cancelled by you at: ".date('Y-m-d H:i:s').
						"\n\nThank You, \n".email_from_name;
											
						$this->send_sms($user_contact, $smsmessage);
					}
					
					$admin_email = admin_email;			
					$admin_subject = 'Order #'.$id.' is Cancelled by user';
					$admin_message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
									font-size: 16px; font-weight: 300; color: #444'>
									Hello Admin,
									<p>
										Order #".$id." is Cancelled by the user".$order[0]->name."at: ".date('Y-m-d H:i:s').".
									</p><br>
									<p> Thanks & Regards,</p>
									<br>
									</p>Support Team,</p>
									<p>".email_from_name."</p>
									<br>
									<a href='mailto:".admin_email."'>
										".admin_email."
									</a> /
									".admin_contact."
								</div>";
					$this->my_send_email($admin_email, $admin_subject, $admin_message);
					
			}else if($status==7){
				$order_status="Deleted by user";
				
				$this->session->set_flashdata("success_message","Your Order Deleted Suuessfully!.");
				
					$subject = 'Your Order #'.$id.' is Deleted by Dealer';
					$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
						font-size: 16px; font-weight: 300; color: #444'>
						Dear ".$user_name.",
						<p>
							Your Order #".$id." is Deleted at: ".date('Y-m-d H:i:s')." 
						</p><br>
						<p> Thanks & Regards,</p>
						<br>
						</p>Support Team,</p>
						<p>".email_from_name."</p>
						<br>
						<a href='mailto:".admin_email."'>
							".admin_email."
						</a> /
						".admin_contact."
					</div>";
					$this->my_send_email($email, $subject, $message);
					
					// send sms notification  
					$notify_sms=$user_data->notify_sms;
					if($notify_sms==1){ 
						$smsmessage = "Dear ".$user_name.
						",\nYour order ".$id." is Deleted by you at: ".date('Y-m-d H:i:s').
						"\n\nThank You, \n".email_from_name;
											
						$this->send_sms($user_contact, $smsmessage);
					}		
								
					$admin_email = admin_email;			
					$admin_subject = 'Order #'.$id.' is Deleted by Dealer';
					$admin_message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
						font-size: 16px; font-weight: 300; color: #444'>
						Hello Admin,
						<p>
							Order #".$id." is Deleted by the dealer".$order[0]->name."at: ".date('Y-m-d H:i:s').".
						</p><br>
						<p> Thanks & Regards,</p>
						<br>
						</p>Support Team,</p>
						<p>".email_from_name."</p>
						<br>
						<a href='mailto:".admin_email."'>
							".admin_email."
						</a> /
						".admin_contact."
					</div>";
					$this->my_send_email($admin_email, $admin_subject, $admin_message);
			}

		}else{
			$this->session->set_flashdata("error_message","Your Order cancel request not placed! try again.");
		}
		redirect(base_url('my-orders'));
	}
	
	function cancel_delete_order(){
		error_reporting(0);
		$id=$_POST['id'];
		$status=$_POST['status'];
		$user_id=$_POST['user_id'];
		
		$table = 'tbl_order';
		$where = array('id' => $id);
		$updateData = array('order_status' => $status);

		$tablec = 'user';
		$wherec = array('id' => $user_id);
		$user_data = $this->user_model->get_common($tablec, $wherec);
		$user_name = $user_data->name;
		$user_contact = $user_data->contact;
		$user_email = $user_data->email;
		$country = $user_data->country;
		$state = $user_data->state;
		$city = $user_data->city;
		$pincode = $user_data->pincode;
		$address = $user_data->address1;
		$user_address = $country.', '.$state.', '.$city.', '.$address.'-'.$pincode;
		
		$email = $user_email;
		
		$upt=$this->user_model->update_common($table, $where, $updateData);
		$order = $this->user_model->get_common($table, $where,'*',2);
		
		$table = 'tbl_order_item';
		$group_by = '';
		$order_by = 'id';
		$order2 = 'DESC';
		$where = array('order_id' => $id);
		$order_detail = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order2);
		
		for($i=0;$i<count($order_detail);$i++){ 
							
		$order_qty = $order_detail[$i]->quantity;
		 
		 $table='products';
		 $where = array('product_id'=>$order_detail[$i]->product_id);
		 $group_by = '';
		 $order_by = 'product_id';
		 $order2 = 'DESC';
		 $product_name = $this->user_model->get_common($table, $where,'*',2, '',$group_by, $order_by, $order2);
		 $prod_id =$product_name[0]->product_id;
		 $quantity =$product_name[0]->quantity;
		 
		 $total_qty =$quantity+$order_qty;
		 $update_datapupt = array('quantity'=> $total_qty);
		 $this->user_model->update_common($table, $where, $update_datapupt);
		 
		}

		if($status==1){
			$order_status="Pending";
		}else if($status==5){
			$order_status="Cancelled by user";
				$subject = 'Your Order #'.$id.' is Cancelled by You';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Dear ".$user_name.",
					<p>
						Your Order #".$id." is Cancelled at: ".date('Y-m-d H:i:s')." 
					</p><br>
					<p> Thanks & Regards,</p>
					<br>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
						".admin_email."
					</a> /
					".admin_contact."
				</div>";						
				$this->my_send_email($email, $subject, $message);
				
				// send sms notification  
				$notify_sms=$user_data->notify_sms;
				if($notify_sms==1){ 
					$smsmessage = "Dear ".$user_name.
					",\nYour order ".$id." is Cancelled by you at: ".date('Y-m-d H:i:s').
					"\n\nThank You, \n".email_from_name;
										
					$this->send_sms($user_contact, $smsmessage);
				}
				
				$admin_email = admin_email;			
				$admin_subject = 'Order #'.$id.' is Cancelled by user';
				$admin_message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
								Hello Admin,
								<p>
									Order #".$id." is Cancelled by the user".$order[0]->name."at: ".date('Y-m-d H:i:s').".
								</p><br>
								<p> Thanks & Regards,</p>
								<br>
								</p>Support Team,</p>
								<p>".email_from_name."</p>
								<br>
								<a href='mailto:".admin_email."'>
									".admin_email."
								</a> /
								".admin_contact."
							</div>";
				$this->my_send_email($admin_email, $admin_subject, $admin_message);
				
		}else if($status==7){
			$order_status="Deleted by user";
				$subject = 'Your Order #'.$id.' is Deleted by Dealer';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Dear ".$user_name.",
					<p>
						Your Order #".$id." is Deleted at: ".date('Y-m-d H:i:s')." 
					</p><br>
					<p> Thanks & Regards,</p>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
						".admin_email."
					</a> /
					".admin_contact."
				</div>";
				$this->my_send_email($email, $subject, $message);
				
				// send sms notification  
				$notify_sms=$user_data->notify_sms;
				if($notify_sms==1){ 
					$smsmessage = "Dear ".$user_name.
					",\nYour order ".$id." is Deleted by you at: ".date('Y-m-d H:i:s').
					"\n\nThank You, \n".email_from_name;
										
					$this->send_sms($user_contact, $smsmessage);
				}		
							
				$admin_email = admin_email;			
				$admin_subject = 'Order #'.$id.' is Deleted by Dealer';
				$admin_message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Hello Admin,
					<p>
						Order #".$id." is Deleted by the dealer".$order[0]->name."at: ".date('Y-m-d H:i:s').".
					</p><br>
					<p> Thanks & Regards,</p>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
						".admin_email."
					</a> /
					".admin_contact."
				</div>";
				$this->my_send_email($admin_email, $admin_subject, $admin_message);
		}

		if($upt){
			echo 1;
		}else{
			echo 0;
		}
		//redirect(base_url('admin/online_poll'));
	}

	public function authenticate(){
	
		$data = array('page_title'=>"Wedding | Authenticate", 'active'=>'authenticate' );
		$this->load->view('site/authenticate',$data);
	}
	
	function check_product_qty(){
		$product_id = $this->input->post('product_id');
		$qty = $this->input->post('qty');
		$category = $this->input->post('category');
			
			$session_id = $_SESSION['session_id'];
			$wherec = array('product_id' =>$product_id,'session_id' =>$session_id);
			$tablec = 'tbl_cart';
			$getCartItemByProduct = $this->user_model->get_common($tablec, $wherec,'*',2,'','',''); 

			$session_id = $_SESSION['session_id'];
			$wherecart = array('product_id' =>$product_id,'session_id' =>$session_id);

			$tablep = 'products';
			$wherep = array('product_id'=>$product_id);
			$products = $this->user_model->get_common($tablep, $wherep,'*',1,'','',''); 
			$image = $products->image;
			$product_name = $products->product_name;
            $actual_price=$products->price;
            $offer_price=$products->offer_price;
			$gst = $products->gst;
			$aval_quantity = $products->quantity;
			
			if($offer_price > 0  && $offer_price < $actual_price){
				$price=$products->offer_price;
			}else{
				$price=$products->price;
			}
			
			$upt_quntity = $qty;
			if($upt_quntity <= $aval_quantity){
				echo 0;
				
				$total = $price * $upt_quntity;
				$gst_amount = $total * ($gst/100);
				$disc_amount1 = $actual_price - $price;
				$disc_amount = $disc_amount1 * $upt_quntity;
			
				$updateData = array(
					'quantity' => $upt_quntity,
					'gst_amount' => $gst_amount,
					'disc_amt' => $disc_amount,
					'actual_price'	=>	$actual_price,
					'price'	=>	$price,
					'total_amount' =>$total
				);
						
				//$updateData = array('quantity' => quantity + $qty);
				$this->user_model->update_common('tbl_cart', $wherec, $updateData);
			}
			else{
				echo $aval_quantity;
			}
	
	}

	// save subscribers
	public function subscribe(){
		error_reporting(0);
		$prevpage = $_SERVER['HTTP_REFERER'];
		
		$email1 = $_POST['subemail'];
		//$blog_id = $_POST['blog_id'];
		$string = preg_replace('/\s+/', '', $email1);
		$e_email1 = strtolower($string);
		$e_email = trim($e_email1);
		
		$this->form_validation->set_rules ('subemail', 'You have already subscribed or there is a problem to subscribe! try again.','trim|required|valid_email|xss_clean|is_unique[subscribers.email]');
		
		if($this->form_validation->run()==false ){
			$this->session->set_flashdata("error_message","You have already subscribed or there is a problem to subscribe! try again.");
			redirect($prevpage);
		}else{
		  
			$insert_data = array(
				'email'	=>	$e_email
			);

			$table = 'subscribers';
			$this->user_model->save_common($table, $insert_data);

			$table = 'about_shop_own';
			$where = array('status!=' => 0, 'admin'=>1);
			$about_shop = $this->user_model->get_common($table, $where,'*',1,'','','shop_id');
			$shop_email = $about_shop->shop_email;
			$shop_contact = $about_shop->shop_contact;
			
			// email to subscriber
			$subjects = 'Thank you for Subscribe';
			$messages = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
							font-size: 16px; font-weight: 300; color: #444'>
							Dear User,
							<p>
								Thank you for subscribing to the weekly Newsletter of Myfule! You will receive updates straight to your inbox.  <br><br>
								You can always email or text us if you need anything , we are here to help.<br>
							</p>
							<br>
							<br>
							</p>Support Team,</p>
							<p>".email_from_name."</p>
							<br>
							<a href='mailto:".admin_email."'>
								".admin_email."
							</a> /
							".admin_contact."
						</div>";
			
			// send email to admin
			$this->my_send_email($e_email, $subjects, $messages);

			$subject = 'New Subscriber';
			$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
							font-size: 16px; font-weight: 300; color: #444'>
							Dear User,
							<p>
								New Subscriber: <br><br>
								Email-Id: ".$e_email."<br>
							</p>
							<br>
							</p>Support Team,</p>
							<p>".email_from_name."</p>
							<br>
							<a href='mailto:".admin_email."'>
								".admin_email."
							</a> /
							".admin_contact."
						</div>";
				
			// send email to admin
			$this->my_send_email($shop_email, $subject, $message);
			// save notification to admin
			$this->save_notifications(3, $subject, $message, 0, 0);
			
			// send sms notification
			$smsmessage = "Dear Admin,".
			"\nNew Subscriber subscribe at: ".date('Y-m-d H:i:s').
			"\nEmail-id : ".$e_email.
			"\n\nThank You, \n".email_from_name;
			// send sms to admin
			$this->send_sms($shop_contact, $smsmessage);

			$this->session->set_flashdata("success_message","Thank you for Subscribing us.");
			redirect($prevpage);
		}
	}
	
	// save blog comment
	public function save_comment(){
		error_reporting(0);	
    	$this->form_validation->set_rules ( 'name', 'Name', 'required' );
    	$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean' );
    	//$this->form_validation->set_rules ( 'website', 'Website', 'required');
		$this->form_validation->set_rules ( 'comment', 'Comment', 'required');
	
    	if($this->form_validation->run()==false){
			//$this->session->set_flashdata("error_message","Comment made Successfully.");
			//redirect(base_url('blog_details/'.$_POST['id']));
			$this->blog_details($_POST['id']);
    	}else{
			
			$blog_id = $_POST['id'];
			$e_name =  trim($_POST['name']);
			$email1 = $_POST['email'];
			$e_comment = $_POST['comment'];
			
			$string = preg_replace('/\s+/', '', $email1);
			$e_email1 = strtolower($string);
			$e_email = trim($e_email1);
			
    		$insert_data = array(
				'name'		=>	$e_name,
				'email'		=>	$e_email,
				//'contact'	=>	$_POST['contact'],
				'comment'	=>	$_POST['comment'],
				'website'	=>	$_POST['website'],
				'status_id'	=>	1,
				'blog_id' 	=> $_POST['id'],
			);

    		$table = 'blog_comments';
    		$this->user_model->save_common($table, $insert_data);
			
			$table = 'about_shop_own';
			$where = array('status!=' => 0, 'admin'=>1);
			$about_shop = $this->user_model->get_common($table, $where,'*',1,'','','shop_id');
			$shop_email = $about_shop->shop_email;
			$shop_contact = $about_shop->shop_contact;
			
			$subject = 'Comment on Blog';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
							    Dear User,
							    <p>
							        New Comment on Blog: <br><br>
									Name: ".$e_name."<br>
									Email-Id: ".$e_email."<br>
									Comment: ".$e_comment."<br>
							    </p>
								<br>
								</p>Support Team,</p>
								<p>".email_from_name."</p>
								<br>
							    <a href='mailto:".admin_email."'>
							        ".admin_email."
							    </a> /
							    ".admin_contact."
							</div>";
				
			// send email to admin
			$this->my_send_email($shop_email, $subject, $message);
			// save notification to admin
			$this->save_notifications(4, $subject, $message, $blog_id, 0);
			
			// send sms notification
			$smsmessage = "Dear Admin,".
			"\nNew Comment on blog: ".date('Y-m-d H:i:s').
			"\nFrom Name : ".$e_name.
			"\nEmail-id : ".$e_email.
			"\nComment : ".$e_comment.
			"\n\nThank You, \n".email_from_name;
			// send sms to admin
			$this->send_sms($shop_contact, $smsmessage);

			$this->session->set_flashdata("success_message","Comment made Successfully.");
			redirect(base_url('site/blog_details/'.$_POST['id']));
    	}
	}
	
	// save appointment / Talk to an Expert
	public function save_appointment(){
		error_reporting(0);
		$prevpage = $_SERVER['HTTP_REFERER'];
			
    	$this->form_validation->set_rules ( 'name', 'Name', 'required|callback__alpha_dash_space' );
    	$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean' );
    	$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules ( 'message', 'message', 'required' );
	
    	if($this->form_validation->run()==false){
			$this->session->set_flashdata("error_message","Please try again with proper data.");
			redirect($prevpage);
    	}else{
			$e_name = trim($_POST['name']);
			$email1 = trim($_POST['email']);
			$e_contact = trim($_POST['contact']);
			$e_message = $_POST['message'];
			
			$string = preg_replace('/\s+/', '', $email1);
			$e_email = strtolower($string);
			
			$random_no = mt_rand(100000, 999999);
			$startTime = date("Y-m-d H:i:s");
			$valid_time = date('Y-m-d H:i:s',strtotime('+10 minute',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
				
    		$insert_data = array(
				'name'		=>	$e_name,
				'email'		=>	$e_email,
				'contact'	=>	$e_contact,
				'message'	=>	$e_message,
				'random_no' => $random_no,
				'valid_till' => $valid_time,
				'status_id'	=>	3
			);

    		$table = 'book_appointment';
    		$this->user_model->save_common($table, $insert_data);
			
			//$this->session->set_flashdata("success_message","Talk to an expert request send successfully.<br> Our expert will contact you soon, Thank you!");
			$this->session->set_flashdata("success_message","Talk to an expert request send successfully.<br> verify your request using otp send on your mobile number and mail-id.");

			//$email=$profile->email;
			$subject = 'Talk to an expert request';
			$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
				font-size: 16px; font-weight: 300; color: #444'>
				Dear ".$e_name.",
				<p>
					Thank for talk to an expert request.<br>
					You are just one step away from talk wit expert.<br><br>
					Please enter below OTP to verify your request:<br>
					Your OTP : ".$random_no."
				</p>
				<br>
				<p>Note: This OTP is valid only 1 hour, after that the user can not verify his/her request using this otp.</p>
				</p>Support Team,</p>
				<p>".email_from_name."</p>
				<br>
				<a href='mailto:".admin_email."'>
					".admin_email."
				</a> /
				".admin_contact."
			</div>";	
			$this->my_send_email($e_email, $subject, $message);
			
			// send sms
			$smsmessage = "Dear ".$e_name.
			",\nThank you for talk to an expert request. \n\nplease enter below otp to verify your request".
			"\nYour OTP : ".$random_no.
			"\n\nThank You, \n".email_from_name;
			$this->send_sms($e_contact, $smsmessage);
			
			$table = 'about_shop_own';
			$where = array('status!=' => 0, 'admin'=>1);
			$about_shop = $this->user_model->get_common($table, $where,'*',1,'','','shop_id');
			$shop_email = $about_shop->shop_email;
			$shop_contact = $about_shop->shop_contact;
			
			$subject = 'New Appointmnet Request';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
							    Dear User,
							    <p>
							        New Appointmnet Request: <br><br>
									Name: ".$e_name."<br>
									Email-Id: ".$e_email."<br>
									Contact-no: ".$e_contact."<br>
									Message: ".$e_message."<br>
							    </p>
								<br>
								</p>Support Team,</p>
								<p>".email_from_name."</p>
								<br>
							    <a href='mailto:".admin_email."'>
							        ".admin_email."
							    </a> /
							    ".admin_contact."
							</div>";
				
			// send email to admin
			$this->my_send_email($shop_email, $subject, $message);
			// save notification to admin
			$this->save_notifications(2, $subject, $message, 0, 0);
			
			// send sms notification
			$smsmessage = "Dear Admin,".
			"\nNew Appointmnet Request: ".date('Y-m-d H:i:s').
			"\nFrom Name : ".$e_name.
			"\nEmail-id : ".$e_email.
			"\nContact-no : ".$e_contact.
			"\n\nThank You, \n".email_from_name;
			// send sms to admin
			$this->send_sms($shop_contact, $smsmessage);

			//redirect($prevpage);
			redirect(base_url('verify_request'));
    	}
	}
	
	// verify appointment / Talk to an Expert
	public function verify_appointment(){
		error_reporting(0);
    	$this->form_validation->set_rules ( 'vcontact', 'Mobile Number', 'required|numeric|min_length[10]|max_length[10]');
	
    	if($this->form_validation->run()==false){
			//$this->session->set_flashdata("error_message","Please try again with proper data.");
			$this->talk_with_experts();
    	}else{

			$e_contact = trim($_POST['vcontact']);
			
			$random_no = mt_rand(100000, 999999);
			$startTime = date("Y-m-d H:i:s");
			$valid_time = date('Y-m-d H:i:s',strtotime('+10 minute',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
			
			$table = 'book_appointment';
			$where = array('contact'=>$e_contact);
			$group_by = '';
			$order_by = 'id';
			$order1 = 'DESC';
			$guest_user = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);
			
			if(count($guest_user)>0){
				
			$topic_id = $guest_user->id;
			$e_name = $guest_user->name;
			$e_email = $guest_user->email;

			$whereup = array('id'=>$topic_id);	
    		$updateData = array(
				'random_no' => $random_no,
				'valid_till' => $valid_time
			);

    		$this->user_model->update_common($table, $whereup, $updateData);

			$this->session->set_flashdata("success_message","OTP send successfully.<br> verify your request using otp send on your mobile number and mail-id.");
			//redirect($prevpage);
			
			//$email=$profile->email;
			$subject = 'Talk to an expert request verify';
			$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
				font-size: 16px; font-weight: 300; color: #444'>
				Dear ".$e_name.",
				<p>
					Thank for talk to an expert request verify.<br>
					You are just one step away from talk wit expert.<br><br>
					Please enter below OTP to verify your request:<br>
					Your OTP : ".$random_no."
				</p>
				<br>
				<p>Note: This OTP is valid only 1 hour, after that the user can not verify his/her request using this otp.</p>
				</p>Support Team,</p>
				<p>".email_from_name."</p>
				<br>
				<a href='mailto:".admin_email."'>
					".admin_email."
				</a> /
				".admin_contact."
			</div>";	
			$this->my_send_email($e_email, $subject, $message);
			
			// send sms
			$smsmessage = "Dear ".$e_name.
			",\nThank you for talk to an expert request verify. \n\nplease enter below otp to verify your request".
			"\nYour OTP : ".$random_no.
			"\n\nThank You, \n".email_from_name;
			$this->send_sms($e_contact, $smsmessage);
			
			redirect(base_url('verify_request'));
			}else{
				$this->session->set_flashdata("error_message","There is no any previous chat record!<br> Start a new chat.");
				redirect(base_url('talk_with_experts'));
			}
    	}
	}
	
	public function verify_request()
	{
		$data = array('page_title'=>"Wedding | Verify Request", 'active'=>'profile' );
		$this->load->view('site/verify_request',$data);
	}
	
	// verify otp
	function request_otp_verify(){
		error_reporting(0);
		$this->form_validation->set_rules ( 'otp', 'OTP', 'required');
    	
		if($this->form_validation->run()==false){
    		$this->verify_account();
    	}else{
			$random_no = $_POST['otp'];
			$cur_time=date("Y-m-d H:i:s");

			$where = array('random_no' => $random_no);
			$reco = $this->user_model->get_common('book_appointment', $where, 'count(*) as rec');
			 
			if($reco->rec > 0){
				$this->db->where('random_no ', $random_no);
				$this->db->where('valid_till >=', $cur_time);
				$profile1 =$this->db->get('book_appointment');
				$profile = $profile1->row();
				$profilecnt = $profile1->result();
				$rec = count($profilecnt);
				if($rec > 0 ){
					// chnage user status
					$where = array('id' => $profile->id);
					$updateData = array(
						'status_id' => 1
					);
					$this->user_model->update_common('book_appointment', $where, $updateData);
					
					$this->session->set_userdata('guest_user', $profile);
	
					$this->session->set_flashdata("success_message","Your request verified successfully, Our expert will contact you soon, Thank you!");
					redirect(base_url('talk_with_experts'));
				}else{
					$this->session->set_flashdata("error_message","OTP verify time has expired! try again.");
					redirect(base_url('verify_request'));	 
				}
			}else{
				$this->session->set_flashdata("error_message","OTP not match! try again.");
				redirect(base_url('verify_request'));	 
			}
		}
	}
	
	public function talk_with_experts(){
		//$this->check_login();
		error_reporting(0);
		if($_SESSION['guest_user']){
			$table = 'book_appointment';
			$where = array('contact'=>$_SESSION['guest_user']->contact);
			$group_by = '';
			$order_by = 'id';
			$order1 = 'DESC';
			$guest_user = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);
			$topic_id = $guest_user[0]->id;
			//$wherec = array('msg_to'=>$_SESSION['guest_user']->contact);
			$wherec = array('topic_id'=>$topic_id);
			$order_byc = 'id';
			$orderc = 'ASC';
			
			$chat = $this->user_model->get_common('chat', $wherec,'*',2, '', $group_by, $order_byc, $orderc);

			$data = array('page_title'=>"Wedding | Talk to an Expert", 'guest_user'=>$guest_user, 'chat'=>$chat);
		}else{
			$data = array('page_title'=>"Wedding | Talk to an Expert");
		}
		
		$this->load->view('site/talk_with_experts', $data);
	}

	public function show_topic(){
		//$this->check_login();
		error_reporting(0);
		$topic_id = $_POST['id'];
		if($_SESSION['guest_user']){
			$table = 'book_appointment';
			$where = array('id'=>$topic_id);
			$group_by = '';
			$order_by = 'id';
			$order1 = 'DESC';
			$guest_user = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);

			$wherec = array('topic_id'=>$topic_id);
			$order_byc = 'id';
			$orderc = 'ASC';
			$chat = $this->user_model->get_common('chat', $wherec,'*',2, '', $group_by, $order_byc, $orderc);

			$data = array('page_title'=>"Wedding | Talk to an Expert", 'guest_user'=>$guest_user, 'chat'=>$chat);
		}else{
			$data = array('page_title'=>"Wedding | Talk to an Expert");
		}
		
		$this->load->view('site/previous_conversation', $data);
	}
	
		
	public function send_message(){
		error_reporting(0);
		$this->load->helper('custom');
    	$this->form_validation->set_rules ( 'message', 'Message', 'required');
	
    	if($this->form_validation->run()==false){
			$this->talk_with_experts();
    	}else{

			$topic_id = $_POST['topic_id'];
			$message = trim($_POST['message']);
			$contact = $_SESSION['guest_user']->contact;
			
			$table = 'book_appointment';
			$where = array('id'=>$topic_id,'contact'=>$contact);
			$group_by = '';
			$order_by = 'id';
			$order1 = 'DESC';
			$guest_user = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);
			
			if(count($guest_user)>0){
				
			$topic_id = $guest_user->id;
			$msg_from = $guest_user->contact;
			$from_name = $guest_user->name;
			$e_email = $guest_user->email;
			$msg_to = $guest_user->expert_id ? : 1;
			$to_name = get_experts_name($msg_to);

    		$insert_data = array(
				'topic_id' => $topic_id,
				'assign_id' => $topic_id,
				'msg_from' => $msg_from,
				'from_name' => $from_name,
				'msg_to' => $msg_to,
				'to_name' => $to_name,
				'message' => $message
			);
			$tablec = 'chat';
    		$this->user_model->save_common($tablec, $insert_data);

			/* $table = 'book_appointment';
			$where = array('id'=>$topic_id);
			$group_by = '';
			$order_by = 'id';
			$order1 = 'DESC';
			$guest_user = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);
			*/
			$wherec = array('topic_id'=>$topic_id);
			$order_byc = 'id';
			$orderc = 'ASC';
			$chat = $this->user_model->get_common('chat', $wherec,'*',2, '', $group_by, $order_byc, $orderc);

			$data = array('page_title'=>"Wedding | Talk to an Experts", 'guest_user'=>$guest_user, 'chat'=>$chat);
			$this->load->view('site/previous_conversation', $data);
			
			}else{
				$this->session->set_flashdata("error_message","There is no any previous chat record!<br> Start a new chat.");
				redirect(base_url('talk_with_experts'));
			}
    	}
	}
	
	public function ajaxsend_message(){
		error_reporting(0);
		 
		$topic_id = $_POST['topic_id'];
		$contact = $_SESSION['guest_user']->contact;
		
		$table = 'book_appointment';
		$where = array('id'=>$topic_id,'contact'=>$contact);
		$group_by = '';
		$order_by = 'id';
		$order1 = 'DESC';
		$guest_user = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);
		
		if(count($guest_user)>0){
		 
		$wherec = array('topic_id'=>$topic_id);
		$order_byc = 'id';
		$orderc = 'ASC';
		$chat = $this->user_model->get_common('chat', $wherec,'*',2, '', $group_by, $order_byc, $orderc);

		$data = array('page_title'=>"Wedding | Talk to an Experts", 'guest_user'=>$guest_user, 'chat'=>$chat);
		$this->load->view('site/ajaxsend_message', $data);
		
		}else{
			$this->session->set_flashdata("error_message","There is no any previous chat record!<br> Start a new chat.");
			redirect(base_url('talk_with_experts'));
		}
	}

	// contact us	
	public function save_enquiry(){
		error_reporting(0);
	   //$prevpage = $_SERVER['HTTP_REFERER'];
		$this->form_validation->set_rules ( 'name', 'Name', 'required' );
		$this->form_validation->set_rules ( 'email', 'Email Address', 'required|valid_email|xss_clean' );
		$this->form_validation->set_rules ( 'contact', 'Contact Number', 'required|numeric' );
		$this->form_validation->set_rules ( 'message', 'Message', 'required' );
		//$this->form_validation->set_rules ( 'subject', 'Subject', 'required' );
		
		if($this->form_validation->run()==false ){
			//$this->session->set_flashdata("error_message","Failed to save your Enquiry! try again.");
			//redirect(base_url('site/contact_us'));
			$this->contact_us();
		}else{
		  
		    $e_name = trim($_POST['name']);
		    $email1 = $_POST['email'];
		    $e_contact = trim($_POST['contact']);
		    $string = preg_replace('/\s+/', '', $email1);
			$e_email1 = strtolower($string);
			$e_email = trim($e_email1);
		//	$e_subject = trim($_POST['subject']);
			$e_message = $_POST['message'];
			
			if($e_subject == 'Talk to an Expert')
			{
				$this->save_appointment();
			}else{
				$insert_data = array(
					'name'	=>	  $e_name,
					'email'	=>	 $e_email,
					'contact'	=>  $e_contact,
		//			'subject' =>  $e_subject, 
					'message'	=> $e_message,
					'status_id' => 1
				);
				$table = 'enquiry';
				$noti_type = 1;
			}

			$this->user_model->save_common($table, $insert_data);
			
			$table = 'about_shop_own';
			$where = array('status!=' => 0, 'admin'=>1);
			$about_shop = $this->user_model->get_common($table, $where,'*',1,'','','website_id');
			$website_email = $about_shop->website_email;
			$website_contact = $about_shop->website_contact;
			
				$subject = "New Enquiry Message for ".$e_subject;
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Dear User,
					<p>
						New Enquiry Message details: <br><br>
						Name: ".$e_name."<br>
						Email-Id: ".$e_email."<br>
						Contact-no: ".$e_contact."<br>
						Subject: ".$e_subject."<br>
						Message: ".$e_message."<br>
					</p>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
						".admin_email."
					</a> /
					".admin_contact."
				</div>";
				
			// send email to admin
			$this->my_send_email($website_email, $subject, $message);
			// save notification to admin
			
			$this->save_notifications($noti_type,$subject, $message,0,0);
			
			$this->session->set_flashdata("success_message","Your Enquiry message send successfully.");
			redirect(base_url('contact-us'));
		}
	}
	
	// Become a partner
	public function save_request(){
		error_reporting(0);
		$prevpage = $_SERVER['HTTP_REFERER'];
			
    	$this->form_validation->set_rules ( 'name', 'Name', 'required|callback__alpha_dash_space' );
		$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric|min_length[10]|max_length[10]');
    	$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean' );
		//$this->form_validation->set_rules ( 'address', 'Address', 'required' );
	
    	if($this->form_validation->run()==false){
			//$this->session->set_flashdata("error_message","Please try again with Proper data.");
			//redirect($prevpage);
			$this->index();
    	}else{
			$e_name = trim($_POST['name']);
			$email1 = $_POST['email'];
			$e_contact = trim($_POST['contact']);
			$e_subject = 'Become a Partner';
			$e_message = 'Request for become a partner with us.';
			
		    $string = preg_replace('/\s+/', '', $email1);
			$e_email1 = strtolower($string);
			$e_email = trim($e_email1);
			
			$insert_data = array(
				'name'	=>	 $e_name,
				'email'	=>	 $e_email,
				'contact'	=>  $e_contact,
				'subject' =>  $e_subject, 
				'message'	=> $e_message,
				'status_id' => 1
			);

			$table = 'enquiry';
			$this->user_model->save_common($table, $insert_data);
			
			$table = 'about_shop_own';
			$where = array('status!=' => 0, 'admin'=>1);
			$about_shop = $this->user_model->get_common($table, $where,'*',1,'','','shop_id');
			$shop_email = $about_shop->shop_email;
			$shop_contact = $about_shop->shop_contact;
			
				$subject = "New Enquiry Message for ".$e_subject;
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Dear User,
					<p>
						New Enquiry Message details: <br><br>
						Name: ".$e_name."<br>
						Contact-no: ".$e_contact."<br>
						Email-Id: ".$e_email."<br>
					</p>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
						".admin_email."
					</a> /
					".admin_contact."
				</div>";
				
			// send email to admin
			$this->my_send_email($shop_email, $subject, $message);
			// save notification to admin
			$this->save_notifications(1, $subject, $message, 0, 0);
			
			$this->session->set_flashdata("success_message","Your Become a Partner request send successfully.");
			redirect($prevpage);
		}
	}
	
	// Check Product Authentication
	public function check_authentication(){
		error_reporting(0);	
    	$this->form_validation->set_rules ( 'product_code', 'Product Code', 'required' );
		$this->form_validation->set_rules ( 'contact', 'Mobile Number', 'required|numeric|min_length[10]|max_length[10]');
    	//$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean' );
		//$this->form_validation->set_rules ( 'address', 'Address', 'required' );
	
    	if($this->form_validation->run()==false){
			//$this->session->set_flashdata("error_message","Please try again with Proper data.");
			$this->authenticate();
    	}else{
			//$e_name = trim($_POST['name']);
			$product_code = trim($_POST['product_code']);
			$email1 = trim($_POST['email']);
			$e_contact = trim($_POST['contact']);
			 
		    $string = preg_replace('/\s+/', '', $email1);
			$e_email = strtolower($string);
			
			$this->db->where('status', 1);
			$this->db->where('start_number <=', $product_code);
			$this->db->where('end_number >=', $product_code);
			$authenticate =$this->db->get('authenticate');
			$product = $authenticate->result();
			//echo count($product);
			//exit;
			/* $table = 'products';
			$where = array('product_code' => $product_code);
			$group_by = '';
			$order_by = '';
			$order = 'DESC';
			$product = $this->user_model->get_common($table, $where, '*', 1, '', $group_by, $order_by, $order);
			*/
			if(count($product) > 0){
				
				$this->session->set_flashdata("success_message","Your Product is Authenticate.");
				
				// email to user
				$subjects = 'Your My Fuel Product is Authenticate';
				$messages = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Dear User,
					<p>
						Product Code : ".$product_code."<br><br>
						Your My Fuel Product is Authenticate.<br>
					</p>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
						".admin_email."
					</a> /
					".admin_contact."
				</div>";
				$this->my_send_email($e_email, $subjects, $messages);
				
				// send sms user
				$smsmessage = "Dear User,".
				"\n\nProduct Code: ".$product_code.
				"\n\nYour My Fuel Product is Authenticate.".
				"\n\nThank You, \n".email_from_name;
				$this->send_sms($e_contact, $smsmessage);
					
				$table = 'about_shop_own';
				$where = array('status!=' => 0, 'admin'=>1);
				$about_shop = $this->user_model->get_common($table, $where,'*',1,'','','shop_id');
				$shop_email = $about_shop->shop_email;
				$shop_contact = $about_shop->shop_contact;
				
				$subject = "Check Product Authentication";
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Dear User,
					<p>
						New Check Product Authentication Request: <br><br>
						Product Code: ".$code."<br><br>
						Contact-no: ".$e_contact."<br><br>
						Email-Id: ".$e_email."<br>
					</p>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
						".admin_email."
					</a> /
					".admin_contact."
				</div>";
					
				// send email to admin
				//$this->my_send_email($shop_email, $subject, $message);
				// save notification to admin
				//$this->save_notifications(5,'', $message,0);

			}else{
				
				$this->session->set_flashdata("error_message","Your Product is Not Authenticate!");

				// email to user
				$subjects = 'Your Product is Not Authenticate!';
				$messages = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Dear User,
					<p>
						Product Code : ".$product_code."<br><br>
						Your Product is Not Authenticate!<br>
					</p>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
						".admin_email."
					</a> /
					".admin_contact."
				</div>";
				$this->my_send_email($e_email, $subjects, $messages);
				
				// send sms notification
				$smsmessage = "Dear User,".
				"\n\nProduct Code: ".$product_code.
				"\n\nYour Product is Not Authenticate.".
				"\n\nThank You, \n".email_from_name;
				// send sms to admin
				$this->send_sms($e_contact, $smsmessage);
				
			}	 
			
			// subscribe user
			if(isset($_POST['subscribe'])){
				
				$insert_data = array(
					'email'	=>	$e_email,
					'contact'	=>	$e_contact
				);
				$table = 'subscribers';
				$this->user_model->save_common($table, $insert_data);
				
				// email to subscriber
				$subjects = 'Thank you for Subscribe';
				$messages = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Dear User,
					<p>
						Thank you for Subscribing us: <br><br>
						Your Email-Id: ".$e_email."<br>
					</p>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
						".admin_email."
					</a> /
					".admin_contact."
				</div>";
				$this->my_send_email($e_email, $subjects, $messages);
			}
				
			redirect(base_url('authenticate'));	

		}
	}
	
	// Save product to wishlist
	function save_wishlist() {
		error_reporting(0);
		$action = $_POST['action'];
		$product_id = $_POST['product_id'];
		
		if($this->session->userdata('user_profile')==''){
			$whishlistarr = $_SESSION['whishlistarr'];
			if($this->session->userdata('whishlistarr')=='')
			{
				$whishlistarr = array();
			}
			if($action=='add'){
				//array('product_id' =>$product_id,'qty'=> $qty);
				array_push($whishlistarr,$product_id);
				$this->session->set_userdata('whishlistarr', $whishlistarr);
			}else{
				$whishlistarr = array_diff($whishlistarr, array($product_id));
				$this->session->set_userdata('whishlistarr', $whishlistarr);
			}

		}else{	
			$user_id = $_SESSION['user_profile']->id;
			
			$where = array('user_id' => $user_id, 'product_id' => $product_id);
			if($action=='add'){
				$reccnt = $this->user_model->record_count('tbl_wishlist', $where);
				if($reccnt >= 1){
					
				}else{
					$inputData = array(
						'user_id'	=>	$user_id,
						//'session_id'	=>	$session_id,
						'product_id'	=>	$product_id,
						'added_by'	=>	$user_id
					);
					$this->user_model->save_common('tbl_wishlist', $inputData);
				} 
			}else{
				$this->user_model->delete_common('tbl_wishlist', $where);
			}
			
		}
	}
	
	// add to cart
	public function add_to_card(){
		error_reporting(0);
		//echo $product_id=$_POST['product_id'];
		$user_id=0;

		$id = $_POST["product_id"];
		
		if($this->session->userdata('user_profile') !='')
		{ 
			$user_id = $_SESSION['user_profile']->id;
			$session_id = $_SESSION['session_id'] = $_SESSION['user_profile']->id;
		}else if(isset($_SESSION['session_id'])){
			$session_id = $_SESSION['session_id'];
		}else{	
			$session_id = $_SESSION['session_id']= mt_rand(100000, 999999);
		}
			$where = array('product_id'=>$id,'session_id'=>$session_id);
			$table = 'tbl_cart';
			$getCartItemByProduct = $this->user_model->get_common($table, $where,'*',2,'','',''); 

			$tablep = 'products';
			$wherep = array('product_id'=>$id);
			$products = $this->user_model->get_common($tablep, $wherep,'*',1,'','',''); 
			$image = $products->image;
			$product_name = $products->product_name;
            $actual_price=$products->price;
            $offer_price=$products->offer_price;
			$gst = $products->gst;
			$aval_quantity = $products->quantity;
			
			if($offer_price > 0  && $offer_price < $actual_price){
				$price=$products->offer_price;
			}else{
				$price=$products->price;
			}
			
		if (! empty($_POST["action"])) {

		switch ($_POST["action"]) {
			case "add":
			$quantity = $_POST["quantity"];
			if ($quantity > 0) {

				if(count($getCartItemByProduct)==0)
				{	
					if($quantity <= $aval_quantity){
						
						$total = $price * $quantity;
						$gst_amount = $total * ($gst/100);
						$disc_amount1 = $actual_price - $price;
						$disc_amount = $disc_amount1 * $quantity;
				
						$insert_data = array(
							'product_id' =>	$id,
							'customer_id' =>$user_id,
							'product_name' => $product_name,
							'quantity'	=>	$quantity,
							'actual_price'	=>	$actual_price,
							'price'	=>	$price,
							'image'	=>	$image,
							'gst'	=>	$gst,
							'gst_amount' => $gst_amount,
							'disc_amt' => $disc_amount,
							'total_amount' =>$total,
							'session_id'	=>	$session_id
						);

						$table = 'tbl_cart';
						$this->user_model->save_common($table, $insert_data);
					} else{
						print 1;
						exit;
					}		
				}else{
					if($quantity > 1){
						$upt_quntity = $quantity;
					}else{
						$upt_quntity = $getCartItemByProduct[0]->quantity + $quantity;
					}
					
					if($upt_quntity <= $aval_quantity){
						
						$total = $price * $upt_quntity;
						$gst_amount = $total * ($gst/100);
						$disc_amount1 = $actual_price - $price;
						$disc_amount = $disc_amount1 * $upt_quntity;
					
						$updateData = array(
							'quantity' => $upt_quntity,
							'gst_amount' => $gst_amount,
							'disc_amt' => $disc_amount,
							'actual_price' => $actual_price,
							'price' => $price,
							'total_amount' =>$total
						);
						$this->user_model->update_common('tbl_cart', $where, $updateData);
					
					} else{
						print 1;
						exit;
					}					
	
				}
			}

			break;

			case "remove":
			// Delete single entry from the cart
			$Ebook_delete=$this->user_model->delete_common('tbl_cart', $where);

			break;
			case "empty":
			// Empty cart

			$this->db->query("delete from tbl_cart where session_id='$session_id'");
			break;
			}
		}

		$table = 'tbl_cart';
		$where = array('session_id'=>$session_id);
		//$getCartItem = $this->user_model->get_common($table, $where,'*','2','','','');	
        $tbl_cart = $this->user_model->get_common($table, $where,'*',2);
        
		$data = array('page_title'=>"Wedding | My Cart", 'active'=>'cart', 'tbl_cart'=>$tbl_cart );

		$this->load->view('site/update_header_cart',$data);
	}
	
	// add to cart
	public function add_to_card_mult(){
		error_reporting(0);
		//echo $product_id=$_POST['product_id'];
		$user_id=0;

		$id1 = $_POST["product_id"];
		 $product_id=explode(",",$id1);
		if($this->session->userdata('user_profile') !='')
		{ 
			$user_id = $_SESSION['user_profile']->id;
			$session_id = $_SESSION['session_id'] = $_SESSION['user_profile']->id;
		}else if(isset($_SESSION['session_id'])){
			$session_id = $_SESSION['session_id'];
		}else{	
			$session_id = $_SESSION['session_id']= mt_rand(100000, 999999);
		}
		
		foreach ($product_id as $id) {
			$where = array('product_id'=>$id,'session_id'=>$session_id);
			$table = 'tbl_cart';
			$getCartItemByProduct = $this->user_model->get_common($table, $where,'*',2,'','',''); 

			$tablep = 'products';
			$wherep = array('product_id'=>$id);
			$products = $this->user_model->get_common($tablep, $wherep,'*',1,'','',''); 
			$image = $products->image;
			$product_name = $products->product_name;
            $actual_price=$products->price;
            $offer_price=$products->offer_price;
			$gst = $products->gst;
			$aval_quantity = $products->quantity;
			
			if($offer_price > 0  && $offer_price < $actual_price){
				$price=$products->offer_price;
			}else{
				$price=$products->price;
			}
			
		
		if (! empty($_POST["action"])) {

		 
			$quantity = $_POST["quantity"];
			if ($quantity > 0) {

				if(count($getCartItemByProduct)==0)
				{	
					if($quantity <= $aval_quantity){
						
						$total = $price * $quantity;
						$gst_amount = $total * ($gst/100);
						$disc_amount1 = $actual_price - $price;
						$disc_amount = $disc_amount1 * $quantity;
				
						$insert_data = array(
							'product_id' =>	$id,
							'customer_id' =>$user_id,
							'product_name' => $product_name,
							'quantity'	=>	$quantity,
							'actual_price'	=>	$actual_price,
							'price'	=>	$price,
							'image'	=>	$image,
							'gst'	=>	$gst,
							'gst_amount' => $gst_amount,
							'disc_amt' => $disc_amount,
							'total_amount' =>$total,
							'session_id'	=>	$session_id
						);

						$table = 'tbl_cart';
						$this->user_model->save_common($table, $insert_data);
					} else{
						print 1;
						exit;
					}		
				}else{
					/* if($quantity > 1){
						$upt_quntity = $quantity;
					}else{
						$upt_quntity = $getCartItemByProduct[0]->quantity + $quantity;
					}
					
					if($upt_quntity <= $aval_quantity){
						
						$total = $price * $upt_quntity;
						$gst_amount = $total * ($gst/100);
						$disc_amount1 = $actual_price - $price;
						$disc_amount = $disc_amount1 * $upt_quntity;
					
						$updateData = array(
							'quantity' => $upt_quntity,
							'gst_amount' => $gst_amount,
							'disc_amt' => $disc_amount,
							'actual_price' => $actual_price,
							'price' => $price,
							'total_amount' =>$total
						);
						$this->user_model->update_common('tbl_cart', $where, $updateData);
					
					} else{
						print 1;
						exit;
					}					
	 */
				}
			}

		 
		}
		}

		$table = 'tbl_cart';
		$where = array('session_id'=>$session_id);
		//$getCartItem = $this->user_model->get_common($table, $where,'*','2','','','');	
        $tbl_cart = $this->user_model->get_common($table, $where,'*',2);
        
		$data = array('page_title'=>"Wedding | My Cart", 'active'=>'cart', 'tbl_cart'=>$tbl_cart );

		$this->load->view('site/update_header_cart',$data);
	}
	
	public function remove_from_card(){
		error_reporting(0);
		//echo $product_id=$_POST['product_id'];
		$user_id=0;

		$id = $_POST["product_id"];
		if($this->session->userdata('user_profile') !='')
		{ 
			$user_id = $_SESSION['user_profile']->id;
			$session_id = $_SESSION['session_id'] = $_SESSION['user_profile']->id;
		}else if(isset($_SESSION['session_id'])){
			$session_id = $_SESSION['session_id'];
		}else{	
			$session_id = $_SESSION['session_id']= mt_rand(100000, 999999);
		}
			$where = array('product_id'=>$id,'session_id'=>$session_id);
			$table = 'tbl_cart';
			$getCartItemByProduct = $this->user_model->get_common($table, $where,'*',2,'','',''); 

			$tablep = 'products';
			$wherep = array('product_id'=>$id);
			$products = $this->user_model->get_common($tablep, $wherep,'*',1,'','',''); 
			$image = $products->image;
			$product_name = $products->product_name;
            $actual_price=$products->price;
            $offer_price=$products->offer_price;
			$gst = $products->gst;
			$aval_quantity = $products->quantity;
			
			if($offer_price > 0  && $offer_price < $actual_price){
				$price=$products->offer_price;
			}else{
				$price=$products->price;
			}
			
		if (! empty($_POST["action"])) {

		switch ($_POST["action"]) {
			case "add":
			$quantity = $_POST["quantity"];
			if ($quantity > 0) {

				if(count($getCartItemByProduct)==0)
				{	
					if($quantity <= $aval_quantity){
						
						$total = $price * $quantity;
						$gst_amount = $total * ($gst/100);
						$disc_amount1 = $actual_price - $price;
						$disc_amount = $disc_amount1 * $quantity;
				
						$insert_data = array(
							'product_id' =>	$id,
							'customer_id' =>$user_id,
							'product_name' => $product_name,
							'quantity'	=>	$quantity,
							'actual_price'	=>	$actual_price,
							'price'	=>	$price,
							'image'	=>	$image,
							'gst'	=>	$gst,
							'gst_amount' => $gst_amount,
							'disc_amt' => $disc_amount,
							'total_amount' =>$total,
							'session_id'	=>	$session_id
						);

						$table = 'tbl_cart';
						$this->user_model->save_common($table, $insert_data);
					} else{
						print 1;
						exit;
					}		
				}else{
					
					$upt_quntity = $getCartItemByProduct[0]->quantity + $quantity;
					
					if($upt_quntity <= $aval_quantity){
						
						$total = $price * $upt_quntity;
						$gst_amount = $total * ($gst/100);
						$disc_amount1 = $actual_price - $price;
						$disc_amount = $disc_amount1 * $upt_quntity;
					
						$updateData = array(
							'quantity' => $upt_quntity,
							'gst_amount' => $gst_amount,
							'disc_amt' => $disc_amount,
							'actual_price'	=>	$actual_price,
							'price'	=>	$price,
							'total_amount' =>$total
						);
						$this->user_model->update_common('tbl_cart', $where, $updateData);
					
					} else{
						print 1;
						exit;
					}					
	
				}
			}

			break;

			case "remove":
			// Delete single entry from the cart
			$Ebook_delete=$this->user_model->delete_common('tbl_cart', $where);

			break;
			case "empty":
			// Empty cart

			$this->db->query("delete from tbl_cart where session_id='$session_id'");
			break;
			}
		}

		$table = 'tbl_cart';
		$where = array('session_id'=>$session_id);
		//$getCartItem = $this->user_model->get_common($table, $where,'*','2','','','');	
        $tbl_cart = $this->user_model->get_common($table, $where,'*',2);
        
		$data = array('page_title'=>"Wedding | My Cart", 'active'=>'cart', 'tbl_cart'=>$tbl_cart );

		$this->load->view('site/update_cart',$data);
	}
	
	// apply coupon
	public function apply_coupon(){
		error_reporting(0);
		$code = $_POST['couple_code'];
		$date=date('Y-m-d');
	
		$this->db->where('status', 1);
		$this->db->where('coupon_code', $code);
		$this->db->where('start_dt <=', $date);
		$this->db->where('end_dt >=', $date);
	   
	   $q = $this->db->get('coupon');
	   $code1 = $q->result_array();
	   if(count($code1)>0){
		$coupon_code = $code1[0]['coupon_code'];
		$coupon_discount = $code1[0]['discount'];
		$session_id = $_SESSION['session_id'];
		$table = 'tbl_cart';
		$where = array('session_id'=>$session_id);	
        $tbl_cart = $this->user_model->get_common($table, $where,'*',2);
        
		$data = array('page_title'=>"Wedding | My Cart", 'active'=>'cart', 'tbl_cart'=>$tbl_cart, 'coupon_code'=>$coupon_code, 'coupon_discount'=>$coupon_discount );
		$this->load->view('site/update_cart',$data);  
		
		//echo $code1[0]['discount'];
	   }else{
		  echo "0";
	   }	
	}
	
	// apply coupon checkout
	public function apply_coupon_checkout(){
		error_reporting(0);
		$code = $_POST['couple_code'];
		$date=date('Y-m-d');
	
		$this->db->where('status', 1);
		$this->db->where('coupon_code', $code);
		$this->db->where('start_dt <=', $date);
		$this->db->where('end_dt >=', $date);
	   
	   $q = $this->db->get('coupon');
	   $code1 = $q->result_array();
	   if(count($code1)>0){
		$coupon_code = $code1[0]['coupon_code'];
		$coupon_discount = $code1[0]['discount'];
		$session_id = $_SESSION['session_id'];
		$table = 'tbl_cart';
		$where = array('session_id'=>$session_id);	
        $tbl_cart = $this->user_model->get_common($table, $where,'*',2);
        
		$data = array('page_title'=>"Wedding | My Cart", 'active'=>'cart', 'tbl_cart'=>$tbl_cart, 'coupon_code'=>$coupon_code, 'coupon_discount'=>$coupon_discount );
		$this->load->view('site/update_checkout',$data);  
		
		//echo $code1[0]['discount'];
	   }else{
		  echo "0";
	   }	
	}
	
	// Checkout
	public function checkout(){
		error_reporting(0);
		$coupon_code=$_POST['hidden_coupon_code'];
		$date=date('Y-m-d');
	
		$this->db->where('status', 1);
		$this->db->where('coupon_code', $coupon_code);
		$this->db->where('start_dt <=', $date);
		$this->db->where('end_dt >=', $date);
	   
		$q = $this->db->get('coupon');
		$code1 = $q->result_array();
		if(count($code1)>0){
			$coupon_discount = $code1[0]['discount'];
		}else{
			$coupon_discount = 0;
		}
        $table = 'tbl_cart';
		if($this->session->userdata('user_profile') !='')
		{
			$where = array('customer_id' =>$_SESSION['user_profile']->id);
			
		}else{
			$where = array('session_id' =>$_SESSION['session_id']);
		}
		$tbl_cart = $this->user_model->get_common($table, $where,'*',2);
		 
		$data = array('page_title'=>"Wedding | Check Out", 'active'=>'Check Out','coupon_code'=>$coupon_code,'coupon_discount'=>$coupon_discount,'tbl_cart'=>$tbl_cart );
        $this->load->view('site/checkout',$data);
	}
	
	// Checkout
	public function payu_checkout($cust_addr_id){
		ob_start();
		$data = array('page_title'=>"Wedding | Check Out", 'active'=>'Check Out','cust_addr_id'=>$cust_addr_id);
		$this->load->view('site/HostedPaymentdetailsHttp',$data);
	}
	
	public function process_order(){
		error_reporting(0);
		/* if($this->session->userdata('user_profile') !='')
		{
		$member_id=$_SESSION['user_profile']->id;
		}
		else{
		$member_id = $_SESSION['session_id'];
		} */
		// echo $_POST['del_name']."--------------";
		$this->load->helper('custom');
		
		if($_POST['del_name']=='yes'){
		 
			$this->form_validation->set_rules('user_id','user Id',"required");
			$this->form_validation->set_rules('del_firstname','Name',"required");
			$this->form_validation->set_rules ( 'del_phone', 'Mobile', 'required' );
			$this->form_validation->set_rules ( 'del_address', 'Address', 'required' );
			$this->form_validation->set_rules ( 'del_city', 'City', 'required' );
			$this->form_validation->set_rules ( 'del_state', 'State', 'required' );
			//$this->form_validation->set_rules ( 'country', 'Country', 'required' );
			$this->form_validation->set_rules ( 'del_zipcode', 'Pincode', 'required' );
		}else{
			$this->form_validation->set_rules('user_id','user Id',"required");
		}
		if($this->form_validation->run()==false){
			
			$this->checkout();
			
		}else{
			$order_date= date('Y-m-d');	
			$user_id= $_POST['user_id'];
			$payment_type= $_POST['payment_type'];
			$user_flag= $_POST['user_flag'];
		
			if($_POST['coupon_code'] && $_POST['coupon_code']!=''){
				$coupon_code = $_POST['coupon_code'];	
				$this->db->where('status', 1);
				$this->db->where('coupon_code', $coupon_code);
				$this->db->where('start_dt <=', $order_date);
				$this->db->where('end_dt >=', $order_date);
			   
				$q = $this->db->get('coupon');
				$code1 = $q->result_array();
				if(count($code1)> 0){
					$coupon_discount_per = $code1[0]['discount'];
				}else{
					$coupon_discount_per = 0;
				}	
			}else{
				$coupon_code = '';
				$coupon_discount_per = 0;
			}	
		
		$user_addr_id= $_POST['del_name'];
		if($_POST['del_name']=='yes'){ 
			$wheret = array('user_id' => $user_id);
			$table = 'cust_address';
			$cust_address = $this->user_model->get_common($table, $wheret,'*',2,'','','','');

			$insert_data_add = array(
				'user_id'=> $user_id,
				'name' =>$_POST['del_firstname'],
				'contact' =>$_POST['del_phone'],
				'contact2' =>$_POST['del_alternet_phone'],
				'address' =>$_POST['del_address'],
				'city'=>$_POST['del_city'],
				'state'=> $_POST['del_state'],
				'pin_code' =>$_POST['del_zipcode'] 
			);
			
			$this->user_model->save_common($table, $insert_data_add);
			$user_addr_id = $this->db->insert_id();
		}

		if($payment_type == 'online')
		{
			//redirect(base_url('payu_checkout'));
			$this->payu_checkout($user_addr_id);
			//$data = array('page_title'=>"Wedding | Check Out", 'active'=>'Check Out');
			//$data['menu'] = $this->load->view('site/checkout', NULL, TRUE);
			//$this->load->view('site/payu_checkout',$data); 
			
		}else{
			
			$payment_status ='cod';
			
			// for find user details
			if($user_flag==1){
				$tablec = 'user';
			}else{
				$tablec = 'guest_user';
				$user_addr_id = 0;
			}
			$wherec = array('id' => $user_id);
			$user_data = $this->user_model->get_common($tablec, $wherec);
			$user_name = $user_data->name;
			$user_contact = $user_data->contact;
			$user_email = $user_data->email;
			$country = $user_data->country;
			$state = $user_data->state;
			$city = $user_data->city;
			$pincode = $user_data->pincode;
			$address = $user_data->address1;
			$cust_gst = $user_data->gst;
			$user_address = $country.', '.$state.', '.$city.', '.$address.'-'.$pincode;
			

			// for find last order id
			$this->db->select('id');
			$this->db->where('status', 0);
			$res1 = $this->db->get('tbl_order');
			$c_id = $res1->num_rows();
			if($c_id > 0)
			{
				$ch_id = $c_id + 1;
				$challan_no1 = str_pad($ch_id, 6, '0', STR_PAD_LEFT);	
				$challan_no = $challan_no1;	
			}else{
				$ch_id = 1;
				$challan_no1 = str_pad($ch_id, 6, '0', STR_PAD_LEFT);
				$challan_no = $challan_no1;
			}
		  	
		
			$wheret = array('customer_id' => $user_id);
			$tablet = 'tbl_cart';
			$temp_order = $this->user_model->get_common($tablet, $wheret,'*',2,'','','');
			
			if(count($temp_order) >0 ){
				
				$product_id = 0;
				$quantity = 0;
				$total_qty = 0;
				$total_actual_price = 0;
				$total_price = 0;
				$total_gst_amount = 0;
				$total_amount = 0;
				$total_unit_amount = 0;
				$total_disc_amount = 0;
				$coupon_discount_amt = 0;
				$final_total_amount = 0;
				foreach ($temp_order as $temp_product){
					
					$product_id = $temp_product->product_id;
					$product_name = $temp_product->product_name;
					$quantity = $temp_product->quantity;
					$product_image = $temp_product->image;
					$actual_price = $temp_product->actual_price;
					$price = $temp_product->price;
					$gst = $temp_product->gst;
					$gst_amount = $temp_product->gst_amount; 
					$disc_amount = $temp_product->disc_amt; 
					$total = $temp_product->total_amount;
					
					$total_qty = $total_qty + $quantity;
					$total_price = $total_price + $price;
					//$total_actual_price = $total_actual_price + $actual_price;
					$total_amount = $total_amount + $total;
					$total_gst_amount = $total_gst_amount + $gst_amount; 
					$total_disc_amount = $total_disc_amount + $disc_amount; 	
				}
			
				$total_unit_amount = $final_total_amount - $total_gst_amount;
				if($coupon_discount_per > 0){
					$coupon_discount_amt = round($total_amount *($coupon_discount_per/100));
					$final_total_amount = $total_amount - $coupon_discount_amt;
				}else{
					$coupon_discount_amt = 0;
					$final_total_amount = $total_amount;
				}
				 
	
				$insert_data = array(
					'user_id'=> $user_id,
					'amount' =>$total_amount,
					'gst_amt' =>$total_gst_amount,
					'coupon_discount_amt' =>$coupon_discount_amt,
					'discount_amt' =>$total_disc_amount,
					'total_amt'=>$final_total_amount,
					'total_qty'=> $total_qty,
					'coupon_code' =>$coupon_code,
					'discount_per' => $coupon_discount_per,
					'payment_type'	=>	$payment_type,
					'order_status'=>1,
					'address_flag'=>$user_addr_id,
					'user_flag'=>$user_flag,
					'order_date' => $order_date,
					'order_no' => $challan_no,
					'document'	=>	$challan_no.'.pdf',
					'added_by'	=>	$user_id
				);

				$table = 'tbl_order';
				$this->user_model->save_common($table, $insert_data);
				$order_id = $this->db->insert_id();
			}
		
			$quantity=0;	
			$price=0;	
			$total=0;	
			$gst_amount=0;	
			$final_amount = 0;
			foreach ($temp_order as $temp_product){
				
				// for find particular user balance qty of individual product
				$product_id = $temp_product->product_id;
				$product_name = $temp_product->product_name;
				$product_image = $temp_product->image;
				$quantity = $temp_product->quantity;
				$actual_price = $temp_product->actual_price;
				$price = $temp_product->price;
				$gst = $temp_product->gst;
				$gst_amount = $temp_product->gst_amount; 
				$disc_amount = $temp_product->disc_amt; 
				$total = $temp_product->total_amount;
				
				$gst_amt = $price * ($gst/100);
				$unit_cost = $price - $gst_amt;
				
				$tablep = 'products';
				$wherep = array('product_id'=>$product_id);
				$products = $this->user_model->get_common($tablep, $wherep,'*',1,'','',''); 
				$product_name = $products->product_name;
				$product_cat = get_cat_name($products->main_category);
				$product_flavour = get_flavour_name($products->flavour);
				$product_weight = $products->weight;
				if($product_flavour !='' && $product_weight !=''){
					$product_name = $product_name.' - '.$product_cat.' ('.$product_flavour.') '.' ('.$product_weight.')';
				}else if($product_flavour !='' && $product_weight ==''){
					$product_name = $product_name.' - '.$product_cat.' ('.$product_flavour.')';
				}else if($product_flavour =='' && $product_weight !=''){
					$product_name = $product_name.' - '.$product_cat.' ('.$product_weight.')';
				}else{
					$product_name = $product_name.' - '.$product_cat;
				}
				
				$oproduct=array('product_id'=>$product_id,'product_name'=>$product_name,'product_image'=>$product_image,'quantity'=>$quantity,'actual_price'=>$actual_price,'price'=>$price,'unit_cost'=>$unit_cost,'gst'=>$gst,'gst_amount'=>$gst_amount,'disc_amount'=>$disc_amount,'total'=>$total);
				$print_product[]=$oproduct;
	 
				$insert_data = array(
					'order_id'	=>	$order_id,
					'product_id'	=>	$product_id,
					'product_name'	=>	$product_name,
					'image'	=>	$product_image,
					'actual_price'	=>	$actual_price,
					'price'	=>	$price,
					'unit_cost'	=>	$unit_cost,
					'quantity'	=>	$quantity,
					'gst'	=>	$gst,
					'disc_amt'	=>	$disc_amount,
					'gst_amt'	=>	$gst_amount,
					'total_amt'	=>	$total
				);

				$tableci = 'tbl_order_item';
				$ins=$this->user_model->save_common($tableci, $insert_data);	
			}
			
			$this->session->set_flashdata("success_message","Your Order Placed Suuessfully!.");
			
				// delete form temp cart table data
				$wheret = array('customer_id' => $user_id);
				$tablet = 'tbl_cart';
				$temp_order = $this->user_model->delete_common($tablet, $wheret);

				$table = 'about_shop_own';
				$where = array('admin'=> 1);
				$about_shop = $this->user_model->get_common($table, $where,'*',1,'','','shop_id');
				/* print_r($about_shop);
				exit; */
				
				$print_user = array('cust_name'=>$user_name,'cust_email'=>$user_email,'cust_contact'=>$user_contact,'cust_address'=>$user_address,'cust_gst'=>$cust_gst);
				
				$order_total = array('total_qty'=>$total_qty,'total_amount'=>$total_amount,'total_gst_amount'=>$total_gst_amount,'total_disc_amount'=>$total_disc_amount,'coupon_discount_amt'=>$coupon_discount_amt,'coupon_discount_per'=>$coupon_discount_per,'coupon_code'=>$coupon_code,'final_total_amount'=>$final_total_amount);

				$data= array(
					'print_user' =>$print_user,
					'print_product' =>$print_product,
					'about_shop' =>$about_shop,
					'order_no' =>$challan_no,
					'order_total' =>$order_total
					);
						
				$this->load->view('site/order_receipt', $data);
				 
					$html = $this->output->get_output();
					$html = preg_replace('/(\>)\s*(\<)/m', '$1$2', $html);
					 // Load pdf library
					$this->load->library('pdf1');
					 // Load HTML content
					$this->dompdf->load_html($html);
					 // (Optional) Setup the paper size and orientation
					$this->dompdf->set_paper('A4', 'portrait');
					 // Render the HTML as PDF
					$this->dompdf->render();
					 //$this->dompdf->stream("welcome.pdf", array("Attachment"=>1));
					file_put_contents("site_data/uploads/order_document/".$challan_no.".pdf", $this->dompdf->output());
					
					$pfd_file=upload_path.'order_document/'.$challan_no.".pdf";
					//echo '<iframe src="$pfd_file" style="width:600px; height:500px;" frameborder="0"></iframe>';
					
					// save notification for user
					$notisubject = 'Your order successfully placed.';
					$notimessage = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
									font-size: 16px; font-weight: 300; color: #444'>
									<p>
										Thank you for order, follwing are the order details: <br><br>
										user Name: ".$user_name."<br>
										user Email: ".$user_email."<br>
										user Contact: ".$user_contact."<br>
										Total Quantity: ".$total_qty."<br>
										Total Amount: ".$final_total_amount."<br><br>
										Order at: ".date('Y-m-d H:i:s')."<br>
									</p>

								</div>";
					$this->save_notifications(6, $notisubject, $notimessage, $order_id, $user_id);
					
					// notification for Admin
					$notisubjecta = 'New order placed by user';
					$notimessagea = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
									font-size: 16px; font-weight: 300; color: #444'>
									<p>
										New order placed by user, follwing are the order details: <br><br>
										user Name: ".$user_name."<br>
										user Email: ".$user_email."<br>
										user Contact: ".$user_contact."<br>
										Total Quantity: ".$total_qty."<br>
										Total Amount: ".$final_total_amount."<br><br>
										Order at: ".date('Y-m-d H:i:s')."<br>
									</p>

								</div>";
					$this->save_notifications(6, $notisubjecta, $notimessagea, $order_id, 0);
					
					// send sms notification  
					$notify_sms=$user_data->notify_sms;
					if($notify_sms==1){ 
						$smsmessage = "Dear ".$user_name.
						",\n\nCongratulations! Your Order is placed Successfully. \n\nOnce it dispatched, our Support Team will contact you soon.\n\nHere are the details of your order:
						\n\nTotal Quantity: ".$total_qty.
						"\nTotal Amount: ".$final_total_amount.
						"\nOrder Placed at: ".date('Y-m-d H:i:s').
						"\n\nThank You, \n".email_from_name;
											
						$this->send_sms($user_contact, $smsmessage);
					}
					
					// send email notification
					$notify_email=$user_data->notify_email;
					if($notify_email==1){ 
						$email=$user_email;
						$subject = 'Thank you for order.';
						$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
										font-size: 16px; font-weight: 300; color: #444'>
										Dear ".$user_name.",
										<p>
											Congratulations! Your Order is placed Successfully.<br><br>
											Once it dispatched, our Support Team will contact you soon.<br><br>
											Here are the details of your order:<br><br>
											Total Quantity: ".$total_qty."<br>
											Total Amount: ".$final_total_amount."<br>
											Order Placed at: ".date('Y-m-d H:i:s')."<br>
											Download PDF Receipt : <a href=".$pfd_file.">".$challan_no.".pdf</a><br>
										</p>
										<br>
										</p>Support Team,</p>
										<p>".email_from_name."</p>
										<br>
										<a href='mailto:".admin_email."'>
											".admin_email."
										</a> /
										".admin_contact."
									</div>";	
						$this->my_send_email($email, $subject, $message);
					}
					
				// send sms notification to Dealer
				$shop_contact = $about_shop->shop_contact;
					$smsmessaged = "Order of ".$user_name.
					",\nPlaced at: ".date('Y-m-d H:i:s').
					"\nBy :".$employee_name.
					"\nTotal Quantity: ".$total_qty.
					"\nTotal Amount: ".$final_total_amount.
					"\n\nThank You, \n".email_from_name;

					$this->send_sms($shop_contact, $smsmessaged);
					
				// send email notification to Dealer
				$shop_email = $about_shop->shop_email;
					$emaild=$shop_email;
					$subjectd = 'user Order Placed';
					$messaged = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Order placed by ".$user_name.",
					<p>
					New order placed by user, follwing are the order details: <br><br>
					user Name : ".$user_name."<br><br>
					Total Quantity: ".$total_qty."<br><br>
					Total Amount: ".$final_total_amount."<br><br>
					Order at: ".date('Y-m-d H:i:s')."<br>
					Download PDF Receipt : <a href=".$pfd_file.">".$challan_no.".pdf</a><br>
					</p>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
					".admin_email."
					</a> /
					".admin_contact."
					</div>";	
					
					$this->my_send_email($emaild, $subjectd, $messaged);

		unset($_SESSION['session_id']);
		
		//$this->load->view('site/home', $data);
		redirect(base_url());
		}	
		}
	}
	
	// payment success
	function success(){
		error_reporting(0);
		$this->load->helper('custom');
		$user_id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$payment_amount = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$payment_status = ($this->uri->segment(5)) ? $this->uri->segment(5) : '';
		$txt_id = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		$track_id = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
		$payment_id = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
		$payment_mode = ($this->uri->segment(9)) ? $this->uri->segment(9) : '';
		$coupon_code = ($this->uri->segment(10)) ? $this->uri->segment(10) : '';
		$user_addr_id = ($this->uri->segment(11)) ? $this->uri->segment(11) : '';
		$user_flag = ($this->uri->segment(12)) ? $this->uri->segment(12) : '';
		$payment_from = 'BOB';
		$payment_currency = 'INR'; 
		$order_date= date('Y-m-d');	
		$payment_type= 'online';
		
		if($payment_status == 'CAPTURED' || $payment_status == 'APPROVED' || $payment_status == 'VOIDED' || $payment_status == 'SUCCESS')
		{
			$payment_status = 'Success';
		}else{
			$payment_status = 'Failed';
		}
		$payment_amount = $payment_amount + 0;
		echo $payment_status;
		//exit;
		
			if($coupon_code && $coupon_code!=''){
				$this->db->where('status', 1);
				$this->db->where('coupon_code', $coupon_code);
				$this->db->where('start_dt <=', $order_date);
				$this->db->where('end_dt >=', $order_date);
			   
				$q = $this->db->get('coupon');
				$code1 = $q->result_array();
				if(count($code1)> 0){
					$coupon_discount_per = $code1[0]['discount'];
				}else{
					$coupon_discount_per = 0;
				}	
			}else{
				$coupon_code = '';
				$coupon_discount_per = 0;
			}	
			
			// for find user details
			if($user_flag==1){
				$tablec = 'user';
			}else{
				$tablec = 'guest_user';
				$user_addr_id = 0;
			}

			$wherec = array('id' => $user_id);
			$user_data = $this->user_model->get_common($tablec, $wherec);
			$user_name = $user_data->name;
			$user_contact = $user_data->contact;
			$user_email = $user_data->email;
			$country = $user_data->country;
			$state = $user_data->state;
			$city = $user_data->city;
			$pincode = $user_data->pincode;
			$address = $user_data->address1;
			$user_address = $country.', '.$state.', '.$city.', '.$address.'-'.$pincode;

			// for find last order id
			$this->db->select('id');
			$this->db->where('status', 0);
			$res1 = $this->db->get('tbl_order');
			$c_id = $res1->num_rows();
			if($c_id > 0)
			{
				$ch_id = $c_id + 1;
				$challan_no1 = str_pad($ch_id, 6, '0', STR_PAD_LEFT);	
				$challan_no = $challan_no1;	
			}else{
				$ch_id = 1;
				$challan_no1 = str_pad($ch_id, 6, '0', STR_PAD_LEFT);
				$challan_no = $challan_no1;
			}
		  	
		
			$wheret = array('customer_id' => $user_id);
			$tablet = 'tbl_cart';
			$temp_order = $this->user_model->get_common($tablet, $wheret, '*' ,2,'','','');
		 
			$product_id = 0;
			$quantity = 0;
			$total_qty = 0;
			$total_actual_price = 0;
			$total_price = 0;
			$total_gst_amount = 0;
			$total_amount = 0;
			$total_unit_amount = 0;
			$total_disc_amount = 0;
			$coupon_discount_amt = 0;
			$final_total_amount = 0;

			foreach ($temp_order as $temp_product){
				
				$product_id = $temp_product->product_id;
				$product_name = $temp_product->product_name;
				$quantity = $temp_product->quantity;
				$product_image = $temp_product->image;
				$actual_price = $temp_product->actual_price;
				$price = $temp_product->price;
				$gst = $temp_product->gst;
				$gst_amount = $temp_product->gst_amount; 
				$disc_amount = $temp_product->disc_amt; 
				$total = $temp_product->total_amount;
				
				$total_qty = $total_qty + $quantity;
				$total_price = $total_price + $price;
				//$total_actual_price = $total_actual_price + $actual_price;
				$total_amount = $total_amount + $total;
				$total_gst_amount = $total_gst_amount + $gst_amount; 
				$total_disc_amount = $total_disc_amount + $disc_amount; 	
			}
		
			$total_unit_amount = $final_total_amount - $total_gst_amount;
			if($coupon_discount_per > 0){
				$coupon_discount_amt = round($total_amount *($coupon_discount_per/100));
				$final_total_amount = $total_amount - $coupon_discount_amt;
			}else{
				$coupon_discount_amt = 0;
				$final_total_amount = $total_amount;
			}
		
		if($payment_amount == $final_total_amount && $payment_amount!=0 && $payment_status=='Success')
		{
	
			$insert_data = array(
				'user_id'=> $user_id,
				'amount' =>$total_amount,
				'gst_amt' =>$total_gst_amount,
				'coupon_discount_amt' =>$coupon_discount_amt,
				'discount_amt' =>$total_disc_amount,
				'total_amt'=>$final_total_amount,
				'total_qty'=> $total_qty,
				'coupon_code' =>$coupon_code,
				'discount_per' => $coupon_discount_per,
				'payment_type'	=>	$payment_type,
				'order_status'=>1,
				'address_flag'=>$user_addr_id,
				'user_flag'=>$user_flag,
				'order_date' => $order_date,
				'order_no' => $challan_no,
				'document'	=>	$challan_no.'.pdf',
				'added_by'	=>	$user_id
			);

			$table = 'tbl_order';
			$this->user_model->save_common($table, $insert_data);
			$order_id = $this->db->insert_id();
 
			// save payment data
			$insert_datap = array(
				'txt_id'	=>	$txt_id,
				'track_id'	=>	$track_id,
				'payment_id'	=>	$payment_id,
				'order_id'	=>	$order_id,
				'user_id'	=>	$user_id,
				'payment_amount'	=>	$payment_amount,
				'payment_currency'	=>	$payment_currency,
				'payment_mode'	=>	$payment_mode,
				'payment_from'	=>	$payment_from,
				'payment_status'	=>	$payment_status
			);

			$tablep = 'tbl_payment';
			$this->user_model->save_common($tablep, $insert_datap);	
		
			$quantity=0;	
			$price=0;	
			$total=0;	
			$gst_amount=0;	
			$final_amount = 0;
			foreach ($temp_order as $temp_product){
				
				// for find particular user balance qty of individual product
				$product_id = $temp_product->product_id;
				$product_name = $temp_product->product_name;
				$product_image = $temp_product->image;
				$quantity = $temp_product->quantity;
				$actual_price = $temp_product->actual_price;
				$price = $temp_product->price;
				$gst = $temp_product->gst;
				$gst_amount = $temp_product->gst_amount; 
				$disc_amount = $temp_product->disc_amt; 
				$total = $temp_product->total_amount;
				
				$gst_amt = $price * ($gst/100);
				$unit_cost = $price - $gst_amt;
				
				$tablep = 'products';
				$wherep = array('product_id'=>$product_id);
				$products = $this->user_model->get_common($tablep, $wherep,'*',1,'','',''); 
				$product_name = $products->product_name;
				$product_cat = get_cat_name($products->main_category);
				$product_flavour = get_flavour_name($products->flavour);
				$product_weight = $products->weight;
				if($product_flavour !='' && $product_weight !=''){
					$product_name = $product_name.' - '.$product_cat.' ('.$product_flavour.') '.' ('.$product_weight.')';
				}else if($product_flavour !='' && $product_weight ==''){
					$product_name = $product_name.' - '.$product_cat.' ('.$product_flavour.')';
				}else if($product_flavour =='' && $product_weight !=''){
					$product_name = $product_name.' - '.$product_cat.' ('.$product_weight.')';
				}else{
					$product_name = $product_name.' - '.$product_cat;
				}
				
				$oproduct=array('product_id'=>$product_id,'product_name'=>$product_name,'product_image'=>$product_image,'quantity'=>$quantity,'actual_price'=>$actual_price,'price'=>$price,'unit_cost'=>$unit_cost,'gst'=>$gst,'gst_amount'=>$gst_amount,'disc_amount'=>$disc_amount,'total'=>$total);
				$print_product[]=$oproduct;
	 
				$insert_data = array(
					'order_id'	=>	$order_id,
					'product_id'	=>	$product_id,
					'product_name'	=>	$product_name,
					'image'	=>	$product_image,
					'actual_price'	=>	$actual_price,
					'price'	=>	$price,
					'unit_cost'	=>	$unit_cost,
					'quantity'	=>	$quantity,
					'gst'	=>	$gst,
					'disc_amt'	=>	$disc_amount,
					'gst_amt'	=>	$gst_amount,
					'total_amt'	=>	$total
				);

				$tableci = 'tbl_order_item';
				$ins=$this->user_model->save_common($tableci, $insert_data);	
			}
			
			$this->session->set_flashdata("success_message","Your Order Placed Suuessfully!.");
			
				// delete form temp cart table data
				$wheret = array('customer_id' => $user_id);
				$tablet = 'tbl_cart';
				$temp_order = $this->user_model->delete_common($tablet, $wheret);

				$table = 'about_shop_own';
				$where = array('admin'=> 1);
				$about_shop = $this->user_model->get_common($table, $where,'*',1,'','','shop_id');
				/* print_r($about_shop);
				exit; */
				
				$print_user = array('cust_name'=>$user_name,'cust_email'=>$user_email,'cust_contact'=>$user_contact,'cust_address'=>$user_address);
				
				$order_total = array('total_qty'=>$total_qty,'total_amount'=>$total_amount,'total_gst_amount'=>$total_gst_amount,'total_disc_amount'=>$total_disc_amount,'coupon_discount_amt'=>$coupon_discount_amt,'coupon_discount_per'=>$coupon_discount_per,'coupon_code'=>$coupon_code,'final_total_amount'=>$final_total_amount);

				$data= array(
					'print_user' =>$print_user,
					'print_product' =>$print_product,
					'about_shop' =>$about_shop,
					'order_no' =>$challan_no,
					'order_total' =>$order_total
					);
						
				$this->load->view('site/order_receipt', $data);
				 
					$html = $this->output->get_output();
					$html = preg_replace('/(\>)\s*(\<)/m', '$1$2', $html);
					 // Load pdf library
					$this->load->library('pdf1');
					 // Load HTML content
					$this->dompdf->load_html($html);
					 // (Optional) Setup the paper size and orientation
					$this->dompdf->set_paper('A4', 'portrait');
					 // Render the HTML as PDF
					$this->dompdf->render();
					 //$this->dompdf->stream("welcome.pdf", array("Attachment"=>1));
					file_put_contents("site_data/uploads/order_document/".$challan_no.".pdf", $this->dompdf->output());
					
					$pfd_file=upload_path.'order_document/'.$challan_no.".pdf";
					//echo '<iframe src="$pfd_file" style="width:600px; height:500px;" frameborder="0"></iframe>';
					
					// save notification for user
					$notisubject = 'Your order successfully placed.';
					$notimessage = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
									font-size: 16px; font-weight: 300; color: #444'>
									<p>
										Thank you for order, follwing are the order details: <br><br>
										user Name: ".$user_name."<br>
										user Email: ".$user_email."<br>
										user Contact: ".$user_contact."<br>
										Total Quantity: ".$total_qty."<br>
										Total Amount: ".$final_total_amount."<br><br>
										Order at: ".date('Y-m-d H:i:s')."<br>
									</p>

								</div>";
					$this->save_notifications(6, $notisubject, $notimessage, $order_id, $user_id);
					
					// notification for Admin
					$notisubjecta = 'New order placed by user';
					$notimessagea = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
									font-size: 16px; font-weight: 300; color: #444'>
									<p>
										New order placed by user, follwing are the order details: <br><br>
										user Name: ".$user_name."<br>
										user Email: ".$user_email."<br>
										user Contact: ".$user_contact."<br>
										Total Quantity: ".$total_qty."<br>
										Total Amount: ".$final_total_amount."<br><br>
										Order at: ".date('Y-m-d H:i:s')."<br>
									</p>

								</div>";
					$this->save_notifications(6, $notisubjecta, $notimessagea, $order_id, 0);
					
					// send sms notification  
					$notify_sms=$user_data->notify_sms;
					if($notify_sms==1){ 
						$smsmessage = "Dear ".$user_name.
						",\nYour order is placed at: ".date('Y-m-d H:i:s').
						"\nTotal Quantity: ".$total_qty.
						"\nTotal Amount: ".$final_total_amount.
						"\n\nThank You, \n".email_from_name;
											
						$this->send_sms($user_contact, $smsmessage);
					}
					
					// send email notification
					$notify_email=$user_data->notify_email;
					if($notify_email==1){ 
						$email=$user_email;
						$subject = 'Thank you for order.';
						$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
										font-size: 16px; font-weight: 300; color: #444'>
										Dear ".$user_name.",
										<p>
											Your new order placed successfully, follwing are the order details: <br><br>
											Total Quantity: ".$total_qty."<br><br>
											Total Amount: ".$final_total_amount."<br><br>
											Order at: ".date('Y-m-d H:i:s')."<br>
											Download PDF Receipt : <a href=".$pfd_file.">".$challan_no.".pdf</a><br>
										</p>
										<br>
										</p>Support Team,</p>
										<p>".email_from_name."</p>
										<br>
										<a href='mailto:".admin_email."'>
											".admin_email."
										</a> /
										".admin_contact."
									</div>";	
						$this->my_send_email($email, $subject, $message);
					}
					
				// send sms notification to Dealer
				$shop_contact = $about_shop->shop_contact;
					$smsmessaged = "Order of ".$user_name.
					",\nPlaced at: ".date('Y-m-d H:i:s').
					"\nBy :".$employee_name.
					"\nTotal Quantity: ".$total_qty.
					"\nTotal Amount: ".$final_total_amount.
					"\n\nThank You, \n".email_from_name;

					$this->send_sms($shop_contact, $smsmessaged);
					
				// send email notification to Dealer
				$shop_email = $about_shop->shop_email;
					$emaild=$shop_email;
					$subjectd = 'user Order Placed';
					$messaged = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Order placed by ".$user_name.",
					<p>
					New order placed by user, follwing are the order details: <br><br>
					user Name : ".$user_name."<br><br>
					Total Quantity: ".$total_qty."<br><br>
					Total Amount: ".$final_total_amount."<br><br>
					Order at: ".date('Y-m-d H:i:s')."<br>
					Download PDF Receipt : <a href=".$pfd_file.">".$challan_no.".pdf</a><br>
					</p>
					<br>
					</p>Support Team,</p>
					<p>".email_from_name."</p>
					<br>
					<a href='mailto:".admin_email."'>
					".admin_email."
					</a> /
					".admin_contact."
					</div>";	
					
					$this->my_send_email($emaild, $subjectd, $messaged);

			unset($_SESSION['session_id']);
			
			//$this->load->view('site/home', $data);
			redirect(base_url());

		}else{
			$this->session->set_flashdata("error_message","Your Order Not Placed! try again.");
			redirect(base_url());
		}

	} 
		
	function failure(){
		error_reporting(0);
		//$status=$_POST["status"];
		$this->session->set_flashdata("error_message","Your Order Not Placed! try again.");
		redirect(base_url());
	}
	
	public function guest_user(){
		
		$data = array('page_title'=>"Wedding | Guest User", 'active'=>'guest_user' );
		$this->load->view('site/guest_user',$data);
		
	}

	// save guest user
	function save_guest_user(){
		
		error_reporting(0);
		$this->form_validation->set_rules ( 'first_name', 'First Name', 'required' );
		$this->form_validation->set_rules ( 'last_name', 'Last Name', 'required' );
		$this->form_validation->set_rules ('email_id', 'Email-Id','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules ( 'contact', 'Mobile', 'required|numeric|min_length[10]|max_length[10]');
		//$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[6]|matches[conf_password]' );
		//$this->form_validation->set_rules ( 'conf_password', 'Confirm Password', 'required' );
		$this->form_validation->set_rules ( 'address_line1', 'Address Line 1', 'required' );
		$this->form_validation->set_rules ( 'city', 'City', 'required' );
		$this->form_validation->set_rules ( 'state', 'State', 'required' );
		$this->form_validation->set_rules ( 'pincode', 'Pincode', 'required|numeric|min_length[6]|max_length[6]|is_unique[user.contact]');
		if(isset($_POST['gst']) && $_POST['gst']!=''){
			$this->form_validation->set_rules ( 'gst', 'GST Number', 'xss_clean|callback_GSTcheck' );
		}
		
		if($this->form_validation->run()==false){
			$this->guest_user();
		}else{
			$name1 = $_POST['first_name']." ".$_POST['last_name'];
			$name = trim($name1);
			$email1 = trim($_POST['email_id']);
			$string = preg_replace('/\s+/', '', $email1);
			$email = strtolower($string);
			$contact = trim($_POST['contact']);
			//$password = trim($_POST['password']);
			$address_line1 = trim($_POST['address_line1']);
			$address_line2 = trim($_POST['address_line2']);
			$city = trim($_POST['city']);
			$state = trim($_POST['state']);
			$pincode = trim($_POST['pincode']);
			$gst = trim($_POST['gst']);

			$wherestate = array('state_name' => $state);
			$state_c = $this->user_model->get_common('state', $wherestate,'*',2,'','','','');
			$state=$state_c[0]->id; 
			if(count($state_c)<=0){
			$state_data = array('state_name'	=>	$state,'country'	=>110);
			$this->user_model->save_common('state', $state_data);
			$state = $this->db->insert_id();
			}

			$wherecity = array('city_name' => $city,'id'=>$state);
			$city_c = $this->user_model->get_common('city', $wherecity,'*',2,'','','','');
			$city=$state_c[0]->id; 
			if(count($city_c)<=0){
			$city_data = array('city_name'	=>	$city,'country'	=>110,'state'=>$state);
			$this->user_model->save_common('city', $city_data);
			$city = $this->db->insert_id();
			}


			$wherepin = array('pin_code' => $pincode,'state'=>$state,'city'=>$city);
			$pin_code_c = $this->user_model->get_common('pincode', $wherepin,'*',2,'','','','');
			if(count($pin_code_c)<=0){
			$pin_data = array('pin_code'=>	$pincode,'country'	=>110,'state'=>$state,'city'=>$city);
			$this->user_model->save_common('pincode', $pin_data);
			} 

			$insert_data = array(
			'name'	=>	$name,
			'email'	=>	$email,
			'contact'	=>	$contact,
			'gst'	=>	$gst,
			'address1'	=>	$address_line1,
			'address2'	=>	$address_line2,
			'city'	=>	$city,
			'state'	=>	$state,
			'pincode'	=>	$pincode,
			//'password'	=> md5($password),
			'status_id'	=> 1
			);

			$table = 'guest_user';
			$this->user_model->save_common($table, $insert_data);
			$guest_id = $this->db->insert_id();
			$where = array('id' => $guest_id);
			$guest_profile = $this->user_model->get_common($table, $where);
			$this->session->set_userdata('guest_user_profile', $guest_profile);
			$this->session->set_flashdata("success_message","Guest User register successfully.");
			redirect(base_url('checkout'));
		}
	}

	/* Common Functions*/

	/* For save notification common */
	function save_notifications($type, $subject, $message, $id=1, $notify_for=0) {

		$inputData = array(
		'type'	=>	$type,
		'subject'	=>	$subject,
		'message'	=>	$message,
		'read_status'	=>	0,
		'order_id'	=>	$id,
		'notify_for'	=>	$notify_for,
		'created_date' => date('Y-m-d H:i:s')
		);

		$this->user_model->save_common('notifications', $inputData);
	}
	
	/* For send mail commaon fuction */
	function my_send_email($email_to, $subject, $message){
		// PHPMailer library load
		$this->load->library('phpmailer_lib');
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
		// check site is live or on localhost for smtp setting
		if(site_mode=='localhost'){
		$mail->isSMTP();
		}
		$mail->Host     = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = email_username;
		$mail->Password = email_password;
		$mail->SMTPSecure = 'ssl';
		$mail->Port     = 465;
		
        // $mail->Host     = 'smtp.sendgrid.net';
        // $mail->SMTPAuth = true;
        // $mail->Username = email_username;
        // $mail->Password = email_password;
        // $mail->SMTPSecure = 'ssl';
        // $mail->Port     = 465;
        
        $mail->setFrom(email_from, email_from_name);
        $mail->addReplyTo(email_from, email_from_name);
		
        // Add multiple recipients
		$addresses = explode(',', $email_to);
		foreach ($addresses as $address) {
			$mail->addAddress($address);
		}
        // Email subject
        $mail->Subject = $subject;
        // Set email format to HTML
        $mail->isHTML(true);
        // Email body content
        $mailContent = $message;
        $mail->Body = $mailContent;
        $mail->Attachment = $mailContent;
		// Send email
        $mail->send();
        
       /*  if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        } */
    }
	
	function my_send_email1($email_to, $subject, $message) {
		// PHPMailer library load
		$this->load->library('phpmailer_lib');
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
		
		if(site_mode=='localhost'){
		$mail->isSMTP();
		}
		
		$mail->Host     = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = email_username;
		$mail->Password = email_password;
		$mail->SMTPSecure = 'ssl';
		$mail->Port     = 465;
		
		// $mail->Host     = 'smtp.sendgrid.net';
        // $mail->SMTPAuth = true;
        // $mail->Username = email_username;
        // $mail->Password = email_password;
        // $mail->SMTPSecure = 'ssl';
        // $mail->Port     = 465;
        
        $mail->setFrom(email_from, email_from_name);
        $mail->addReplyTo(email_from, email_from_name);
		
        // Add multiple recipients
		$addresses = explode(',', $email_to);
		
		$mail->addAddress(admin_email);
		
		foreach ($addresses as $address) {
			$mail->addBCC($address);
		}
        // Email subject
        $mail->Subject = $subject;
        // Set email format to HTML
        $mail->isHTML(true);
        // Email body content
        $mailContent = $message;
        $mail->Body = $mailContent;
		// Send email
        $mail->send();
        
         if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        } 
    }
	
	// send sms common
	function send_sms($num,$msg){

		$ms = rawurlencode($msg); //This for encode your message content 
		
		$url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.APIKEY.'&senderid='.SENDERID.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';

		//echo $url;
		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,"");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
		$data = curl_exec($ch);
	}
	
	// GST number validation
	public function GSTcheck($str)
    {
		if ( !preg_match('/^([0][1-9]|[1-2][0-9]|[3][0-5])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$/i',$str) )
		{
			$this->form_validation->set_message('GSTcheck', 'The GST field must contain a valid gst number.');
			return FALSE;
		}else
		{
			return TRUE;
		}
	}
	
	// PAN number validation
	public function PANcheck($str)
    {
		if ( !preg_match('/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/i',$str) )
		{
			$this->form_validation->set_message('PANcheck', 'The PAN field must contain a valid pan number.');
			return FALSE;
		}else
		{
			return TRUE;
		}
	}
}
