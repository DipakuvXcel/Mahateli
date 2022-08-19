<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
	public $shop_data;		
	
	public function index()
	{
		error_reporting(0);
		$where = array('status !='=>0);
		$table = 'marital_status';
		$marital_status = $this->user_model->get_common($table, $where,'*',2,'');
		//print_r($marital_status);exit;
		$tabled = 'language';
		$language = $this->user_model->get_common($tabled, $where,'*',2,'');
		$tabledi = 'religion';
		$religion = $this->user_model->get_common($tabledi, $where,'*',2,'');

		$tablep = 'caste';
		$caste = $this->user_model->get_common($tablep, $where,'*',2,'');

		$tablepa = 'foundation';
		$foundation = $this->user_model->get_common($tablepa, $where,'*',2,'');

		$data = array('marital_status' => $marital_status,
					'foundation' => $foundation,
					'language' => $language,
					'religion' => $religion,
					'caste' => $caste,
					'page_title'=>"Wedding | Registration", 
					'active'=>'Home' );
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
		log_message('debug', 'log in page fail in... ', false);
		
		$data = array('page_title'=>"Wedding | Login", 'active'=>'login' );

		$this->load->view('site/login',$data);
	}


	function registration(){
		$where = array('status !='=>0);
		$table = 'marital_status';
		$marital_status = $this->user_model->get_common($table, $where,'*',2,'');
		
		$tabled = 'language';
		$language = $this->user_model->get_common($tabled, $where,'*',2,'');

		$tabledi = 'religion';
		$religion = $this->user_model->get_common($tabledi, $where,'*',2,'');

		$tablep = 'caste';
		$caste = $this->user_model->get_common($tablep, $where,'*',2,'');

		$tablepa = 'foundation';
		$foundation = $this->user_model->get_common($tablepa, $where,'*',2,'');

		$data = array('marital_status' => $marital_status,
					'language' => $language,
					'foundation' => $foundation,
					'religion' => $religion,
					'caste' => $caste,
					'page_title'=>"Wedding | Registration", 
					'active'=>'registration' );

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
			$this->form_validation->set_rules ('mo_number', 'Mobile Number','required|numeric|min_length[10]|max_length[10]|is_unique[user.contact]' );
			$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[6]|matches[conf_password]' );
			$this->form_validation->set_rules ( 'conf_password', 'Re-type Password', 'required' );
		}    
		if(isset($_POST['email_id']) && $_POST['email_id']!=''){
			$this->form_validation->set_rules ('email_id', 'Email Id','trim|required|valid_email|xss_clean|is_unique[user.email]');
			$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[6]|matches[conf_password]' );
			$this->form_validation->set_rules ( 'conf_password', 'Re-type Password', 'required' );
		}    
		if ($_FILES ["image"] ["name"] == "") {
			$this->form_validation->set_rules ( "image", "Profile Image", "required" );
		}

		if($this->form_validation->run()==false ){
    		$this->registration();
    	}else{
			$image_name="";
			if ($_FILES ["image"] ["name"] != "") {
				$name=$_POST['fname'].''.$_POST['lname'];
				$target = "./uploads/profile/"; 
				$target1 =$target . $name."_".( $_FILES['image']['name']);
				$image_name=$name."_".( $_FILES['image']['name']);
				move_uploaded_file($_FILES['image']['tmp_name'], $target1);	
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/product_profile/'.$image_name;
				$config['new_image'] = './uploads/profile/'.$image_name;
				//$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 250;
				$config['height']       = 250;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
			}
	
			$name1 = trim($_POST['fname']);
			// $nm2 = trim($_POST['mname']);
			$name3 = trim($_POST['lname']);
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
				//'image'	=>	$uploaded_file_name,
				'image'	=> $image_name,
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
				'last'	=>	$name3,
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
			//$smsmessage = "Dear ".$name1.''.$name3.
			//",\nThank you for register with us. \n\nplease enter below otp to verify your account".
			//"\nYour OTP : ".$random_no.
			//"\n\nThank You, \n".email_from_name;
			//$this->send_sms($mobile, $smsmessage);
			
			//save notification
			$notisubject = 'New User Registered';
			$notimessage = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
			font-size: 16px; font-weight: 300; color: #444'>
			<p>
			Dear Admin, follwing are the Details of new Registered User: <br><br>
		
			User Name: ".$name1.''.$name3."<br>
			User Email: ".$email."<br>
			User Contact:".$mobile."<br>
			Registered at: ".date('Y-m-d H:i:s')."<br>
			</p>
			</div>";
			$this->save_notifications(5, $notisubject, $notimessage, $user_id, 0);
			$this->session->set_flashdata("success_message","User register successfully.");
			//exit;
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
					$this->load->view('site/login');
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
					//	$random_no = uniqid().'-'.$user_id;
						$this->db->where('id ', $user_id);
						$profile1 =$this->db->get('user');
						$profile = $profile1->row();
						$profilecnt = $profile1->result();
						$rec = count($profilecnt);
						if($rec > 0 ){
							$random_no = mt_rand(100000, 999999);
							$startTime = date("Y-m-d H:i:s");
							$valid_time = date('Y-m-d H:i:s',strtotime('+5 minute',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
						}
						$where = array('id' => $user_id);
						$updateData = array(
							'random_no' => $random_no,
							'valid_till' => $valid_time
							);
						$this->user_model->update_common($table, $where, $updateData);
						
						$subject = 'Verify your account using this OTP';
						$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
									font-size: 16px; font-weight: 300; color: #444'>
									Dear ".$name.",
									<p>
										Your account not verified, please enter below otp to verify your account: <br>
										Your OTP : ".$random_no."
									</p>
									<br>
									<p>Note: This OTP is valid only 5 Minute, after that the user can not verify his/her account using this otp.</p>
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
				$valid_time = date('Y-m-d H:i:s',strtotime('+5 minute',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
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
				
				$this->session->set_flashdata("success_message","Please check mail and reset your password by clicking on link.");
				$this->load->view('site/forgot-pwd');
				//redirect(base_url('login'));
			
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
		$where = array('user_id' => $_SESSION['user_profile']->id,'status!=' =>0);
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
	public function products(){
		$data['page_title']= 'Wedding | Products';
		$data['active']= 'shop';
		$this->load->view('site/coming',$data);
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
	
	public function services(){
	
		$data = array('page_title'=>"Wedding | Services", 'active'=>'services' );
		$this->load->view('site/coming',$data);
	}
	 
	public function profile(){
		$this->check_login();
		error_reporting(0);
		$table = 'user';
		$where = array('id'=>$_SESSION['user_profile']->id,'status_id!='=>0);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$user = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);

		$table = 'user_details';
		$where = array('user_id'=>$user->id,'status!='=>0);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$user_profile = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);

		$table = 'caste';
		$where = array('user_id'=>$_SESSION['user_profile']->id,'status!='=>0);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$caste = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);

		$table = 'foundation';
		$where = array('status!='=>0);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$user_foundation = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);
		
		$table = 'language';
		$where = array('id'=>$_SESSION['user_profile']->id);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$user_language = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);

		$table = 'religion';
		$where = array('id'=>$_SESSION['user_profile']->id);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$user_religion = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);

		$table = 'correspondence_address';
		$where = array('user_id'=>$user->id,'status!='=>0);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$correspondence_address = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);

		$table = 'resident_address';
		$where = array('user_id'=>$user->id,'status!='=>0);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$resident_address = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);
		$data = array('page_title'=>"Wedding | My Profile" , 
		'user_profile'=>$user_profile,
		'user'=>$user,
		'resident_address'=>$resident_address,
		'user_foundation'=>$user_foundation,
		'user_language'=>$user_language,
		'user_religion'=>$user_religion,
		'caste'=>$caste,
		'correspondence_address'=>$correspondence_address);
		$this->load->view('site/profile', $data);
	}
	
	function edit_user_profile(){
		$this->check_login();
		//error_reporting(0);
		
		$table = 'user';
		$where = array('id'=>$_SESSION['user_profile']->id,'status_id!='=>0);
		$group_by = '';
		$order_by = 'id';
		$user_profile = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);
		
		$tablec = 'resident_address';
		$wherec = array('user_id'=>$_SESSION['user_profile']->id,'status!='=>0);
		$resident_address = $this->user_model->get_common($tablec, $wherec);
		
		$tablec = 'correspondence_address';
		$wherec = array('user_id'=>$_SESSION['user_profile']->id,'status!='=>0);
		$correspond_address = $this->user_model->get_common($tablec, $wherec);
		
		$tablec = 'caste';
		$wherec = array('user_id'=>$_SESSION['user_profile']->id,'status!='=>0);
		$profilcaste = $this->user_model->get_common($tablec, $wherec);
		
		$tablec = 'user_details';
		$wherec = array('user_id'=>$_SESSION['user_profile']->id,'status!='=>0);
		$user_profiledtails = $this->user_model->get_common($tablec, $wherec);
	
		$table = 'marital_status';
		$where = array('status !=' => 0);
		$marital_status_details = $this->user_model->get_common($table, $where,'*',2,'');
		//print_r($marital_status_details);exit;

		$data = array( 
			'marital_status_details'=>$marital_status_details,
			'user_profile'=>$user_profile,
			'resident_address'=>$resident_address,
			'user_profiledtails'=>$user_profiledtails,
			'profilcaste'=>$profilcaste,
			'correspond_address'=>$correspond_address
				);
		$this->load->view('site/edit_user_profile', $data);
	}
	
	function update_user(){
		error_reporting(0);
		$this->check_login();
		$this->form_validation->set_rules ( 'first_name', ' First Name', 'required' );
		$this->form_validation->set_rules ( 'middle_name', ' Middle Name', 'required' );
		$this->form_validation->set_rules ( 'last_name', ' Last Name', 'required' );
	//	$this->form_validation->set_rules ('email_id', 'Email-Id','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules ( 'contact', 'Mobile', 'required|numeric|min_length[10]|max_length[10]');  
		if(isset($_POST['email_id']) && $_POST['email_id']!=''){
			$this->form_validation->set_rules ('email_id', 'Email Id','trim|required|valid_email|xss_clean');
		}    
		if ($_FILES ["image"] ["name"] == "") {
			$this->form_validation->set_rules ( "image", "Profile Image", "required" );
		}
		if($this->form_validation->run()==false){
    		$this->edit_user_profile();
    	}else{
			$image_name="";
			if ($_FILES ["image"] ["name"] != "") {
				$startTime = $_POST['first_name'].''.$_POST['last_name'];
				$target = "./upload_path/uploads/profile/"; 
				$target1 =$target . $startTime."_".( $_FILES['image']['name']);
				$image_name=$startTime."_".( $_FILES['image']['name']);
				move_uploaded_file($_FILES['image']['tmp_name'], $target1);	
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './upload_path/uploads/product_profile/'.$image_name;
				$config['new_image'] = './upload_path/uploads/profile/'.$image_name;
				//$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 250;
				$config['height']       = 250;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
			}
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

			$tabledi = 'language';
			$wheredi = array('language_name'=>trim($_POST['mother_tounge']),'status!='=>0);
			$mother_t = $this->user_model->get_common($tabledi, $wheredi);
			$mother_tounge=$mother_t->id;

			$date = trim($_POST['date']);
		
			$tabledip = 'religion';
			$wheredip = array('religion'=>trim($_POST['religions']),'status!='=>0);
			$religiond = $this->user_model->get_common($tabledip, $wheredip);
			$religion=$religiond->id;

			$caste = trim($_POST['caste']);
			$sub_caste = trim($_POST['sub_caste']);
			$foundation = trim($_POST['foundation']);			
			 
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
			$update_date=date("Y-m-d H:i:s");
			$status=0;
		
			$tabled = 'user_family_details';
			$whered = array('user_id'=>$_POST['id'],'status!='=>0);
			$user_family_details = $this->user_model->get_common($tabled, $whered);
			$user_family_id=$user_family_details->id;
			
			$update_datausers = array(
				'image'	=>	$image_name
			 );
			$tableusers = 'user';
			$whereusers = array('id'=>$_SESSION['user_profile']->id,'status_id!='=>0);
			$this->user_model->update_common($tableusers, $whereusers, $update_datausers);

			$update_datas = array(
				'update_by'	=>	$_SESSION['user_profile']->id,
				'update_date'	=>	$update_date,
				'status'	=>	$status
			 );
			$tables = 'user_details';
			$wheres = array('user_id'=>$_SESSION['user_profile']->id,'status!='=>0);
			$this->user_model->update_common($tables, $wheres, $update_datas);
			
			$insert_data = array(
				'user_id'=>$_SESSION['user_profile']->id,
				'foundation'	=>	$foundation,
				'first'	=>	$fname,
				'middle'	=>	$mname,
				'last'	=>	$lname,
				'gender'	=>	$gender,
				'marital_status'	=>	$marital_status,
				'language'	=>	$mother_tounge,
				'contact'	=>	$contact,
				'date_of_birth'	=>	$date,
				'religion'	=>	$religion,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'added_date'	=>	$update_date,
				'status'	=>	1
			 );

			$this->user_model->save_common($tables, $insert_data);
			
			$update_datares = array(
				'update_by'	=>	$_SESSION['user_profile']->id,
				'update_date'	=>	$update_date,
				'status'	=>	$status
			 );
			 $tableres = 'resident_address';
			 $whereres = array('user_id'=>$_SESSION['user_profile']->id,'status!='=>0);
			 $this->user_model->update_common($tableres, $whereres, $update_datares);
			
			 if($user_family_id=''){
			$insert_datares = array(
				'user_id' => $_SESSION['user_profile']->id,
				'address'	=>	$address_line1,
				'country'	=>	$res_country,
				'state'	=>	$res_state,
				'city'	=>	$res_state,
				'district'	=>	$res_district,
				'pincode'	=>	$res_pincode,
				'landmark'	=>	$res_landmark,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'added_date'	=>	$update_date,
				'status'	=>	1
			 );
			
			$this->user_model->save_common($tableres, $insert_datares);
			}else{
				$insert_datares = array(
					'user_id' => $_SESSION['user_profile']->id,
					'family_id' => $user_family_id,
					'address'	=>	$address_line1,
					'country'	=>	$res_country,
					'state'	=>	$res_state,
					'city'	=>	$res_state,
					'district'	=>	$res_district,
					'pincode'	=>	$res_pincode,
					'landmark'	=>	$res_landmark,
					'added_by'	=>	$_SESSION['user_profile']->id,
					'added_date'	=>	$update_date,
					'status'	=>	1
				 );
				
				$this->user_model->save_common($tableres, $insert_datares);
			}
			$update_datacaste = array(
				'update_by'	=>	$_SESSION['user_profile']->id,
				'update_date'	=>	$update_date,
				'status'	=>	$status
				 );

			$tablecaste = 'caste';
			$wherecaste = array('user_id'=>$_SESSION['user_profile']->id,'status!='=>0);
			$this->user_model->update_common($tablecaste, $wherecaste, $update_datacaste);	
		
			if($user_family_id=''){
			$insert_datacaste = array(
				'user_id'=>$_SESSION['user_profile']->id,
				'caste_name'	=>	$caste,
				'sub_caste_name'	=>	$sub_caste,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'added_date'	=>	$update_date,
				'status'	=>	1
			 );

			 $this->user_model->save_common($tablecaste, $insert_datacaste);
			}else{
				$insert_datacaste = array(
					'family_id' => $user_family_id,
					'user_id'=>$_SESSION['user_profile']->id,
					'caste_name'	=>	$caste,
					'sub_caste_name'	=>	$sub_caste,
					'added_by'	=>	$_SESSION['user_profile']->id,
					'added_date'	=>	$update_date,
					'status'	=>	1
				 );
	
				 $this->user_model->save_common($tablecaste, $insert_datacaste);
			}
			$update_datacorr = array(
				'update_by'	=>	$_SESSION['user_profile']->id,
				'update_date'	=>	$update_date,
				'status'	=>	$status
			 );

			$tablecorr = 'correspondence_address';
			$wherecorr = array('user_id'=>$_SESSION['user_profile']->id,'status!='=>0);
			$this->user_model->update_common($tablecorr, $wherecorr, $update_datacorr);
			
			if($user_family_id=''){
			$insert_datacorr = array(
				'user_id'=>$_SESSION['user_profile']->id,
				'address'	=>	$corr_address,
				'country'	=>	$corr_country,
				'state'	=>	$corr_state,
				'city'	=>	$corr_city,
				'district'	=>	$corr_district,
				'pincode'	=>	$corr_pincode,
				'landmark'	=>	$corr_landmark,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'added_date'	=>	$update_date,
				'status'	=>	1
			 );

			 $this->user_model->save_common($tablecorr, $insert_datacorr);
			}else{
				$insert_datacorr = array(
					'family_id' => $user_family_id,
					'user_id'=>$_SESSION['user_profile']->id,
					'address'	=>	$corr_address,
					'country'	=>	$corr_country,
					'state'	=>	$corr_state,
					'city'	=>	$corr_city,
					'district'	=>	$corr_district,
					'pincode'	=>	$corr_pincode,
					'landmark'	=>	$corr_landmark,
					'added_by'	=>	$_SESSION['user_profile']->id,
					'added_date'	=>	$update_date,
					'status'	=>	1
				 );
	
				 $this->user_model->save_common($tablecorr, $insert_datacorr);	
			}
			echo 1;
		
		}
	}

	function save_family_user(){
		error_reporting(0);
		$this->check_login();
		$this->form_validation->set_rules ( 'gender', 'Gender', 'required' );
		$this->form_validation->set_rules ( 'marital_status', 'Marital Status', 'required' );
		$this->form_validation->set_rules ( 'date', 'Date of Birth', 'required' );
		$this->form_validation->set_rules ( 'mother_tounge', 'Mother tongue', 'required' );
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
		$this->form_validation->set_rules ( 'first_name', ' First Name', 'required' );
		$this->form_validation->set_rules ( 'middle_name', ' Middle Name', 'required' );
		$this->form_validation->set_rules ( 'last_name', ' Last Name', 'required' );
		$this->form_validation->set_rules ( 'relation', 'Relation', 'required' );
		$this->form_validation->set_rules ('email_id', 'Email-Id','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules ( 'contact', 'Mobile', 'required|numeric|min_length[10]|max_length[10]');  
    	
		if ($_FILES ["image"] ["name"] == "") {
			$this->form_validation->set_rules ( "image", "Profile Image", "required" );
		}
		if($this->form_validation->run()==false){
    		$this->add_family_member();
    	}else{
			$image_name="";
			if ($_FILES ["image"] ["name"] != "") {
				$startTime = $_POST['first_name'].''.$_POST['last_name'];
				$target = "./uploads/profile/"; 
				$target1 =$target .$startTime."_".( $_FILES['image']['name']);
				$image_name=$startTime."_".( $_FILES['image']['name']);
				move_uploaded_file($_FILES['image']['tmp_name'], $target1);	
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/product_profile/'.$image_name;
				$config['new_image'] = './uploads/profile/'.$image_name;
				//$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 250;
				$config['height']       = 250;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
			}

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
			$update_date=date("Y-m-d H:i:s");

			$insert_data = array(
				'user_id'	=>	$_SESSION['user_profile']->id,
				'first'	=>	$fname,
				'middle'	=>	$mname,
				'last'	=>	$lname,
				'email'	=>	$email,
				'contact'	=>	$contact,
				'gender'	=>	$gender,
				'image'   =>  $image_name,
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
				'created_by'	=>	$_SESSION['user_profile']->id,
				'status'	=>	1
			 );

			$tableres = 'resident_address';
			$this->user_model->save_common($tableres, $insert_data);

			$insert_data = array(
				'family_id'	=>	$family_id,
				'caste_name'	=>	$caste,
				'sub_caste_name'	=>	$sub_caste,
				'created_by'	=>	$_SESSION['user_profile']->id,
				'created_date'	=>	$update_date,
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
				'created_by'	=>	$_SESSION['user_profile']->id,
				'status'	=>	1
			 );

			$tablecorr = 'correspondence_address';
			$this->user_model->save_common($tablecorr, $insert_data);
			//exit;
			echo 1;
		
		}
	}	
	
	public function view_order_details(){
		$this->check_login();
		$order_id=$_POST['id'];
		$table = 'user_family_details';
		$group_by = '';
		$order_by = 'id';
		$where = array('id' => $order_id,'status!='=>0);
		$order = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);

		$table = 'correspondence_address';
		$group_by = '';
		$order_by = 'id';
		$where = array('family_id' => $order_id,'status!='=>0);
		$corres = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);

		$table = 'resident_address';
		$group_by = '';
		$order_by = 'id';
		$where = array('family_id' => $order_id,'status!='=>0);
		$reside = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);

		$table = 'caste';
		$group_by = '';
		$order_by = 'id';
		$where = array('family_id' => $order_id,'status!='=>0);
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
		$where = array('user_id' => $order_id,'status!='=>0);
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

	function edit_family_member(){
		$this->check_login();
		//error_reporting(0);
		$order_id=$_POST['id'];
		$table = 'user';
		$where = array('id'=>$_SESSION['user_profile']->id,'status_id!='=>0);
		$group_by = '';
		$order_by = 'id';
		$user_profile = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by);
		
		$tablec = 'user_family_details';
		$wherec = array('id' => $order_id,'status!='=>0);
		$user_profiledtails = $this->user_model->get_common($tablec, $wherec);
	
		$tablec = 'resident_address';
		$wherec = array('family_id'=>$order_id,'status!='=>0);
		$resident_address = $this->user_model->get_common($tablec, $wherec);
		
		$tablec = 'correspondence_address';
		$wherec = array('family_id'=>$order_id,'status!='=>0);
		$correspond_address = $this->user_model->get_common($tablec, $wherec);
		
		$tablec = 'caste';
		$wherec = array('family_id'=>$order_id,'status!='=>0);
		$profilcaste = $this->user_model->get_common($tablec, $wherec);
		
		$tabled = 'family_relation';
		$whered = array('status !='=>0);
		$family_relations = $this->user_model->get_common($tabled, $whered,'*',2);
		
		$table = 'marital_status';
		$where = array('status !=' => 0);
		$marital_status_details = $this->user_model->get_common($table, $where,'*',2,'');
		//print_r($marital_status_details);exit;
		
		$data = array( 
			'marital_status_details'=>$marital_status_details,
			'family_relations'=>$family_relations,
			'user_profiledtails'=>$user_profiledtails,
			'user_profile'=>$user_profile,
			'profilcaste'=>$profilcaste,
			'resident_address'=>$resident_address,
			'correspond_address'=>$correspond_address
		);
		$this->load->view('site/edit_family_member', $data);
	}

	public function delete_family_details(){
	///	error_reporting(0);
		$id=$_POST['id'];
		$status=$_POST['status'];
		$update_date=date("Y-m-d H:i:s");

		$table = 'user_family_details';
		$where = array('id' => $id);
		$updateData = array('status' => $status,
		'update_by'	=>	$_SESSION['user_profile']->id,
		'update_date'	=>	$update_date
		);
	
		$upt=$this->user_model->update_common($table, $where, $updateData); 
		

		$tableca = 'caste';
		$whereca = array('family_id' => $id);
		$updateDataca = array('status' => $status,
							'update_by'	=>	$_SESSION['user_profile']->id,
							'update_date'	=>	$update_date
							);
	
		$upt=$this->user_model->update_common($tableca, $whereca, $updateDataca); 

		$tablecor = 'correspondence_address';
		$wherecor = array('family_id' => $id);
		$updateDatacor = array('status' => $status,
							'update_by'	=>	$_SESSION['user_profile']->id,
							'update_date'	=>	$update_date
							);
	
		$upt=$this->user_model->update_common($tablecor, $wherecor, $updateDatacor); 

		
		$tableres = 'resident_address';
		$whereres = array('family_id' => $id);
		$updateDatares = array('status' => $status,
							'update_by'	=>	$_SESSION['user_profile']->id,
							'update_date'	=>	$update_date
							);
	
		$upt=$this->user_model->update_common($tableres, $whereres, $updateDatares); 
		if($upt){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	function update_family_user(){
		error_reporting(0);
		$this->check_login();
		$this->form_validation->set_rules ( 'first_name', ' First Name', 'required' );
		$this->form_validation->set_rules ( 'middle_name', ' Middle Name', 'required' );
		$this->form_validation->set_rules ( 'last_name', ' Last Name', 'required' );
		$this->form_validation->set_rules ('email_id', 'Email-Id','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules ( 'contact', 'Mobile', 'required|numeric|min_length[10]|max_length[10]');  
    	
		if ($_FILES ["image"] ["name"] == "") {
			$this->form_validation->set_rules ( "image", "Profile Image", "required" );
		}
		if($this->form_validation->run()==false){
    		$this->edit_user_profile();
    	}else{
			$image_name="";
			if ($_FILES ["image"] ["name"] != "") {
				$startTime = $_POST['first_name'].''.$_POST['last_name'];
				$target = "./upload_path/uploads/profile/"; 
				$target1 =$target . $startTime."_".( $_FILES['image']['name']);
				$image_name=$startTime."_".( $_FILES['image']['name']);
				move_uploaded_file($_FILES['image']['tmp_name'], $target1);	
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './upload_path/uploads/product_profile/'.$image_name;
				$config['new_image'] = './upload_path/uploads/profile/'.$image_name;
				//$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 250;
				$config['height']       = 250;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
			}
		
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
			
			$id=$_POST['idd'];
			$status=0;
			$update_date=date("Y-m-d H:i:s");
	
			$table = 'user_family_details';
			$where = array('id' => $id);
			$updateData = array('status' => $status,
			'update_by'	=>	$_SESSION['user_profile']->id,
			'update_date'	=>	$update_date
			);
		
			$upt=$this->user_model->update_common($table, $where, $updateData); 
			
	
			$tableca = 'caste';
			$whereca = array('family_id' => $id);
			$updateDataca = array('status' => $status,
								'update_by'	=>	$_SESSION['user_profile']->id,
								'update_date'	=>	$update_date
								);
		
			$upt=$this->user_model->update_common($tableca, $whereca, $updateDataca); 
	
			$tablecor = 'correspondence_address';
			$wherecor = array('family_id' => $id);
			$updateDatacor = array('status' => $status,
								'update_by'	=>	$_SESSION['user_profile']->id,
								'update_date'	=>	$update_date
								);
		
			$upt=$this->user_model->update_common($tablecor, $wherecor, $updateDatacor); 
	
			
			$tableres = 'resident_address';
			$whereres = array('family_id' => $id);
			$updateDatares = array('status' => $status,
								'update_by'	=>	$_SESSION['user_profile']->id,
								'update_date'	=>	$update_date
								);
		
			$upt=$this->user_model->update_common($tableres, $whereres, $updateDatares); 

		
			$tables = 'user_family_details';
			$insert_data = array(
				'user_id'=>$_SESSION['user_profile']->id,
				'first'	=>	$fname,
				'middle'	=>	$mname,
				'last'	=>	$lname,
				'gender'	=>	$gender,
				'marital_status'	=>	$marital_status,
				'language'	=>	$mother_tounge,
				'date_of_birth'	=>	$date,
				'email'	=>	$email,
				'image'	=>	$image_name,				
				'contact'	=>	$contact,
				'religion'	=>	$religion,
				'relation_id'	=>	$relation,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'added_date'	=>	$update_date,
				'status'	=>	1
			 );

			$this->user_model->save_common($tables, $insert_data);
			$user_family_inid = $this->db->insert_id();

			
			$tableres = 'resident_address';
			
			$insert_datares = array(
				'family_id'=>$user_family_inid,
				'address'	=>	$address_line1,
				'country'	=>	$res_country,
				'state'	=>	$res_state,
				'city'	=>	$res_state,
				'district'	=>	$res_district,
				'pincode'	=>	$res_pincode,
				'landmark'	=>	$res_landmark,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'added_date'	=>	$update_date,
				'status'	=>	1
			 );
			$this->user_model->save_common($tableres, $insert_datares);
			
			
			$tablecaste = 'caste';
			
			$insert_datacaste = array(
				'family_id'=>$user_family_inid,
				'caste_name'	=>	$caste,
				'sub_caste_name'	=>	$sub_caste,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'added_date'	=>	$update_date,
				'status'	=>	1
			 );


			$this->user_model->save_common($tablecaste, $insert_datacaste);

			$tablecorr = 'correspondence_address';
			
			$insert_datacaste = array(
				'family_id'=>$user_family_inid,
				'address'	=>	$corr_address,
				'country'	=>	$corr_country,
				'state'	=>	$corr_state,
				'city'	=>	$corr_city,
				'district'	=>	$corr_district,
				'pincode'	=>	$corr_pincode,
				'landmark'	=>	$corr_landmark,
				'added_by'	=>	$_SESSION['user_profile']->id,
				'added_date'	=>	$update_date,
				'status'	=>	1
			 );
			$this->user_model->save_common($tablecorr, $insert_datacaste);
			if($upt){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	public function authenticate(){
	
		$data = array('page_title'=>"Wedding | Authenticate", 'active'=>'authenticate' );
		$this->load->view('site/authenticate',$data);
	}
	
	// contact us	
	public function save_enquiry(){
		error_reporting(0);
	   //$prevpage = $_SERVER['HTTP_REFERER'];
		$this->form_validation->set_rules ( 'name', 'Name', 'required' );
		$this->form_validation->set_rules ( 'email', 'Email Address', 'required|valid_email|xss_clean' );
		$this->form_validation->set_rules ( 'contact', 'Contact Number', 'required|numeric' );
		$this->form_validation->set_rules ( 'message', 'Message', 'required' );
		$this->form_validation->set_rules ( 'subject', 'Subject', 'required' );
		
		if($this->form_validation->run()==false ){
			$this->session->set_flashdata("error_message","Failed to save your Enquiry! try again.");
			redirect(base_url('site/contact_us'));
			$this->contact_us();
		}else{
		  
		    $e_name = trim($_POST['name']);
		    $email1 = $_POST['email'];
		    $e_contact = trim($_POST['contact']);
		    $string = preg_replace('/\s+/', '', $email1);
			$e_email1 = strtolower($string);
			$e_email = trim($e_email1);
			$e_subject = trim($_POST['subject']);
			$e_message = $_POST['message'];
			
				$insert_data = array(
					'name'	=>	  $e_name,
					'email'	=>	 $e_email,
					'contact'	=>  $e_contact,
					'subject' =>  $e_subject, 
					'message'	=> $e_message,
					'status_id' => 1
				);
				$table = 'enquiry';
				$noti_type = 1;
		
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
			$this->my_send_email($e_email, $subject, $message);
			// save notification to admin
			
			$this->save_notifications($noti_type,$subject, $message,0,0);
			
			$this->session->set_flashdata("success_message","Your Enquiry message send successfully.");
			redirect(base_url('contact-us'));
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
		//$mail->Host     = 'smtp.gmail.com';
		//$mail->SMTPAuth = true;
		//$mail->Username = email_username;
		//$mail->Password = email_password;
		//$mail->SMTPSecure = 'ssl';
		//$mail->Port     = 465;
		
        $mail->Host     = 'smtp.sendgrid.net';
        $mail->SMTPAuth = true;
        $mail->Username = email_username;
        $mail->Password = email_password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
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
    
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        } 
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
