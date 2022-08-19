<?php
/*************************************************
	* Author: dipakl@uvxcel.com	
	* Project : mahateli	
 ************************************************/
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	
	public function print_data($data,$query=''){
		if($query){
			echo $this->db->last_query();
		}
		echo "<pre>";
		print_r($data);
		exit;
	}

	function view_forum_reply($id){
				
		$data=array(
		'id' => $id
		);

		$this->load->view('admin/forum_reply_view.php', $data);
	}

	function check_login(){
		if($this->session->userdata('profile')==''){
			redirect(base_url('admin'));
		}else{
			return true;
		}
	}

	function set_flashdata($type, $message){
		if($type == 'success'){
			$this->session->set_flashdata('success_message', $message);
		}else{
			$this->session->set_flashdata('failed_message', $message);
		}
	}

	public function index(){
		if($this->session->userdata('profile')!=''){
			redirect(base_url('admin/dashboard'));
		}

		$this->load->view('admin/login');
	}

	public function do_login(){

		$this->form_validation->set_rules("email_id","Email","required|valid_email");
		$this->form_validation->set_rules("password","Password","required");

		if($this->form_validation->run()==false){
			$this->index();
		}else{
			echo $_POST['email_id'];
			echo $_POST['password'];
			$table = 'user';
			$where = array('email' => $_POST['email_id'], 'password' => md5($_POST['password']));
			$profile = $this->user_model->get_common($table, $where);
			
			if($profile == ''){
				$this->session->set_flashdata("error_message","Invalid username and password.");
				redirect(base_url('admin/index'));
			}else{
				$this->session->set_userdata('profile', $profile);
				redirect(base_url('admin/dashboard'));
			}
		}
	}

	function logout(){
		$this->session->set_userdata('profile','');
		redirect(base_url('admin'));
	}
	
	/*  Reset password */
	// forgost password view
	function forgot_password(){
		$this->load->view('admin/forgot-pwd');
	}
	
	// send reset password link on mail
	function send_password_recovery_link(){
		
		$this->form_validation->set_rules("email_id","Email","required|valid_email");

		if($this->form_validation->run()==false){
			$this->forgot_password();
		}else{
			$table = 'user';
			$where = array('email' => $_POST['email_id']);
			$profile = $this->user_model->get_common($table, $where);

			if($profile == ''){
				$this->session->set_flashdata("error_message","Email-id Not Registered!");
				redirect(base_url('admin/forgot_password'));
			}else{
				$random_no = uniqid().'-'.$profile->id;
				$startTime = date("Y-m-d H:i:s");
				$valid_time = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($startTime))); // the link is valid 1 hour, after that the user can not change his/her password
				$table = 'user';
				$where = array('id' => $profile->id);
				$updateData = array(
					'random_no' => $random_no,
					'valid_till' => $valid_time
					);
				$this->user_model->update_common($table, $where, $updateData);
				
				$reset_link=base_url('admin/reset_password/?random_no='.$random_no);
			
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
				
				$this->session->set_flashdata("success_message","We have sent the password reset link to your email. Please check and reset your password by clicking on link.");
				redirect(base_url('admin/forgot_password'));
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
				$this->load->view('admin/reset-pwd',$data);
			}else{
				$this->session->set_flashdata("error_message","Your change password time has expired! Please try again.");
				redirect(base_url('admin/forgot_password'));	 
			}
		}
	}
	
	// save reset password
	function update_reset_password(){

		$this->form_validation->set_rules("user_id","User Id","required");
		$this->form_validation->set_rules("new_password","New Password","required|matches[confirm_password]");
		$this->form_validation->set_rules("confirm_password","Confirm Password","required");

		if($this->form_validation->run()==false){

			//$this->reset_password();
			$this->session->set_flashdata("error_message","Enter New Password and Confirm Password Same!");
			redirect(base_url('admin/reset_password?random_no='.$_POST['random_no']));
			
		}else{
			$table = 'user';
			$where = array('id' => $_POST['user_id']);
			$updateData = array('password' => md5($_POST['confirm_password']));
			
			$this->user_model->update_common($table, $where, $updateData);

			$this->session->set_flashdata("success_message","Password Reset successfully.");
			redirect(base_url('admin/index'));
		}
	}
	/* End Reset password */
	
	function change_password(){
		$this->check_login();
		$data['active_menu'] = 'dashboard';
		$this->load->view('admin/change_password', $data);
	}

	function update_password(){

		$this->form_validation->set_rules("current_password","Current Password","required|callback_check_current_password");
		$this->form_validation->set_rules("new_password","New Password","required|matches[confirm_password]");
		$this->form_validation->set_rules("confirm_password","Confirm Password","required");

		if($this->form_validation->run()==false){

			$this->change_password();
		}else{
			$table = 'user';
			$where = array('id' => $_SESSION['profile']->id);
			$updateData = array('password' => md5($_POST['confirm_password']));
			
			$this->user_model->update_common($table, $where, $updateData);

			$this->session->set_flashdata("success_message","Password updated successfully.");
			redirect(base_url('admin/change_password'));
		}
	}

	function check_current_password($pwd){
		$where = array('id' => $_SESSION['profile']->id);
		$table="users";

		$profile = $this->user_model->get_common($table, $where);

		if($profile->password != md5($pwd)){
			$this->form_validation->set_message('check_current_password','The Current Password is incorrect.');
			return false;
		}else{
			return true;
		}
	}

	function profile(){
		
		$this->check_login();
		$table = 'user';
		$where = array('id'=>$_SESSION['profile']->id);
		$group_by = '';
		$order_by = 'id';
		$order1 = '';
		$data['profile'] = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);
		
		$this->load->view('admin/profile', $data);
	}
	
	function dashboard(){

		$this->check_login();
		
		$where = array('status_id !=' => 0,'flag !=' =>0);
		$where_b = array('status_id !=' => 0);
		$where_p = array('status!='=>0);
		 
		$data['active_menu'] = 'dashboard';
		$data['total_foundation'] = $this->user_model->get_common('foundation', $where_p, 'count(*) as total');
		$data['total_user'] = $this->user_model->get_common('user', $where, 'count(*) as total');
		$data['total_enquiry'] = $this->user_model->get_common('enquiry', $where_b, 'count(*) as total',1,'','','');
		$this->load->view('admin/dashboard', $data);
	}

	 
	function update_Web(){
	   @extract($_POST);
	    $this->form_validation->set_rules ( 'Web_number', 'Web Number', 'required' );
	    $this->form_validation->set_rules ( 'Web_name', 'Web Name', 'required|callback__alpha_dash_space' );
		$this->form_validation->set_rules ( 'Web_email', 'Email', 'trim|required|valid_email|xss_clean' );
		$this->form_validation->set_rules ( 'Web_contact', 'Contact', 'required|numeric' );
		//$this->form_validation->set_rules ( 'gst', 'GST No', 'required|max_length[15]' );
		//$this->form_validation->set_rules ( 'pan', 'PAN No', 'required|max_length[10]' );
	    $this->form_validation->set_rules ( 'Web_address', 'Address', 'required' );
		if($this->form_validation->run()==false){

			$this->dashboard();
		}else{

		if(!empty($_FILES['logo']['name'])){
				$temp = explode(".", $_FILES["logo"]["name"]);
				$newfilename = 'logo_'.round(microtime(true)).'.' . end($temp);
				$folder = "./assets/images/";
				move_uploaded_file($_FILES["logo"]["tmp_name"] , "$folder".$newfilename);	
				 
			}else{
				$newfilename="";
			}

			$Web_id=$_POST['Web_id'];
			$where = array('Web_id' => $Web_id);
			$updateData = array(
				'Web_number' =>	$_POST['Web_number'],
				'Web_name'	=>	$_POST['Web_name'],
				'owner_name'	=>	$_POST['owner_name'],
				'Web_contact'	=>	$_POST['Web_contact'],
				'Web_contact1'	=>	$_POST['Web_contact1'],
				'Web_email' =>	$_POST['Web_email'],
				'Web_email1' =>	$_POST['Web_email1'],
				'Web_address'	=>	$_POST['Web_address'],
				'Web_address1'	=>	$_POST['Web_address1'],
				'Web_gstno'	=>	$_POST['Web_gstno'],
				'Web_pan'	=>	$_POST['Web_pan'],
				'Web_van' =>	$_POST['Web_van'],
				'Web_website'	=>	$_POST['Web_website'],
				'print_flag'	=>	0,
				'Web_terms_conditions'	=>	$_POST['Web_terms_conditions'],
				'bank_name'	=>	$_POST['bank_name'],
				'account_name'	=>	$_POST['account_name'],
				'account_number'	=>	$_POST['account_number'],
				'ifsc_code'	=>	$_POST['ifsc_code']
			);
			
			if(!empty($_FILES['logo']['name'])){
			$updateData['logo'] = $newfilename;
			}else{
				$newfilename="";
			}
						
		    $uptabt = $this->user_model->update_common('about_shop_own', $where, $updateData);	    
			 
			if($uptabt){
				echo 1;
			}else{
				echo 0;
			}
		}
    }

	function subusers(){
		$this->check_login();

		$table = 'user';
		$where = array('main_admin' =>0,'status_id !=' => 0);
		$subusers = $this->user_model->get_common($table, $where,'*',2);

		$data = array('subusers' => $subusers);
		$data['active_menu'] = 'subusers';

		$this->load->view('admin/subusers', $data);
	}

	function save_subuser(){

    	$this->form_validation->set_rules ( 'name', 'Name', 'required|callback__alpha_dash_space' );
    	$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean' );
    	$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric' );
    	$this->form_validation->set_rules ( 'pwd', 'Password', 'required|min_length[6]|matches[cpassword]' );
		$this->form_validation->set_rules ( 'cpassword', 'Confirm Password', 'required' );
    	$this->form_validation->set_rules ( 'user_desc', 'Description', 'required' );
    	if($this->form_validation->run()==false){

    		$this->add_users();
    	}else{

    		$insert_data = array(
    						'name'	=>	$_POST['name'],
    						'email'	=>	$_POST['email'],
				            'phone'	=>	$_POST['contact'],
				            'password'	=>	md5($_POST['pwd']),
				            'main_admin'	=>	0,
    						'admin_level'	=>	2,
				            'about'	=>	$_POST['user_desc'],
    						'status_id'	=>	1
    					);

    		$table = 'user';

    		$this->user_model->save_common($table, $insert_data);

    		$this->session->set_flashdata("success_message","User added successfully.");
    		redirect(base_url('admin/subusers'));
    	}
    }

	function update_subusers($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('user', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Subuser deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/subusers'));
	}

	function subusers_details($id){
		$this->check_login();

		$table = 'user';
		$where = array('id' => $id);
		$subusers = $this->user_model->get_common($table, $where,'*');

		$data = array('subusers' => $subusers);
		$data['active_menu'] = 'subusers';

		$this->load->view('admin/subusers_details', $data);
	}
	
	function edit_subuser($id){

		$this->check_login();

		$table = 'user';
		$where = array('id' => $id);
		$subusers = $this->user_model->get_common($table, $where,'*');

		$data = array('subusers' => $subusers);
		$data['active_menu'] = 'subusers';

		$this->load->view('admin/edit_subuser', $data);
	}
	
	function update_subuser_details(){

		$this->form_validation->set_rules ( 'name', 'User Name', 'required' );
    	$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean' );
    	$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric' );
    	//$this->form_validation->set_rules ( 'pwd', 'Password', 'required' );
    	$this->form_validation->set_rules ( 'user_desc', 'Description', 'required' );
		
		if($this->form_validation->run()==false){

			$this->edit_subuser($_POST['id']);
		}else{
			
			$update_data = array(
    						'name'	=>	$_POST['name'],
    						'email'	=>	$_POST['email'],
				            'phone'	=>	$_POST['contact'],
				            'about'	=>	$_POST['user_desc']
    					);

			
			$table = 'user';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Sub-user updated successfully.");
			redirect(base_url('admin/subusers'));
		}
	}   

	
	public function order_edit(){
		//$de_id = $_SESSION['dealer_profile']->id;
		$order_id = $this->uri->segment(3);
		 
			/* $table = 'tbl_order';
			$where = array('id' => $order_id);
			$select = '*';
			$total_rec = 2;
			$limit_to = '';
			$group_by = '';
			//$order = 'DESC';
			$orders = $this->user_model->get_common($table, $where, $select, $total_rec, $limit_to, $group_by); */
			
			
			$this->db->select('*');
			$this->db->from('dealer');
			$this->db->join('tbl_order','tbl_order.user_id = dealer.id');
			$this->db->where_in('tbl_order.id', $order_id);

			$query = $this->db->get();
			$orders=$query->result();
			
			$this->db->select('*');
			$this->db->from('products');
			$this->db->join('tbl_order_item','tbl_order_item.product_id = products.product_id');
			$this->db->where_in('tbl_order_item.order_id', $order_id);

			$query = $this->db->get();
			$products=$query->result();
			
		$data = array(
					'page_title' => 'Edit-Order | My Fuel',
					'orders' => $orders,
					'products' => $products
				);
		$data['active_menu'] = 'order';		
		if($orders[0]->order_status==0)
		{
			$this->load->view('admin/order_edit', $data);
		}else{			
			//$this->load->view('admin/order_edit', $data);
			redirect(base_url('admin/order'));
		}
	}
	
	// interested_user status change
	function enquiries(){ //double
		$this->check_login();

		$table = 'enquiry';
		$where = array('status_id !=' => 0); // 0- deleted
		
		$enquiries = $this->user_model->get_common($table, $where,'*',2);

		$data = array('enquiries' => $enquiries);
		$data['active_menu'] = 'enquiries';

		$this->load->view('admin/enquiries', $data);
	}
	
	// enquiry_user status change
	function update_enquiry_status($status, $id){ //double
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('enquiry', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Enquiry deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}
		redirect(base_url('admin/enquiries'));
	}
	
	//get enquiry user list for send email
	function getenquiryuserMails(){
		$this->check_login();
		$id=$_POST['id'];
		if($id !=="0"){
			$where = array('status_id' => 1,'id'=>$id);
		}
		else{
		$where = array('status_id' => 1);
		}
		$table = 'enquiry';
		$user_list = $this->user_model->get_common($table, $where,'*',2,'','email');

		$data = array('user_list' => $user_list);
		$this->load->view('admin/get_users_lists', $data);
	}
	
	//get enquiry user mobile list for send text message
	public function getenquiryuserContacts(){
		$this->check_login();
		 $id=$_POST['all_users'];
         if( $id=="0"){
		   $where = array('status_id' => 1);
		 }
        else{
	       $where = array('status_id' => 1,'id'=>  $id);
	    }		 
		$table = 'enquiry';
		$user_list = $this->user_model->get_common($table, $where,'*',2,'','contact');

		$data = array('user_list' => $user_list);
		
		$this->load->view('admin/get_usermobile_list', $data);
	}
	
	// interested_user status change
	function offer_enquiries(){ //double
		$this->check_login();

		$table = 'offer_user';
		$where = array('status_id !=' => 0); // 0- deleted
		
		$enquiries = $this->user_model->get_common($table, $where,'*',2);

		$data = array('enquiries' => $enquiries);
		$data['active_menu'] = 'enquiries';

		$this->load->view('admin/offer_enquiries', $data);
	}
	
	// enquiry_user status change
	function update_offer_enquiry_status($status, $id){ //double
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('offer_user', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Offer enquiry deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}
		redirect(base_url('admin/offer_enquiries'));
	}
	
	//get enquiry user list for send email
	function getoffer_enquiryuserMails(){
		$this->check_login();
		$id=$_POST['id'];
		if($id !=="0"){
			$where = array('status_id' => 1,'id'=>$id);
		}
		else{
		$where = array('status_id' => 1);
		}
		$table = 'offer_user';
		$user_list = $this->user_model->get_common($table, $where,'*',2,'','email');

		$data = array('user_list' => $user_list);
		$this->load->view('admin/get_user_lists', $data);
	}
	
	//get enquiry user mobile list for send text message
	public function getoffer_enquiryuserContacts(){
		$this->check_login();
		 $id=$_POST['all_users'];
         if( $id=="0"){
		   $where = array('status_id' => 1);
		 }
        else{
	       $where = array('status_id' => 1,'id'=>  $id);
	    }		 
		$table = 'offer_user';
		$user_list = $this->user_model->get_common($table, $where,'*',2,'','contact');

		$data = array('user_list' => $user_list);
		
		$this->load->view('admin/get_usermobile_list', $data);
	}
	 
		/*
	*	33
	*	Function Name	:	user()
	* 	Descrption 		:	Loads user view
	*/
	function users()
	{
		$this->check_login();
		
		$table = 'user';
		$where = array('status_id !=' => 0,'flag !=' => 0);
		$user = $this->user_model->get_common($table, $where,'*',2);
		
		$data = array('user' => $user);
		$data['active_menu'] = 'users';
		$this->load->view('admin/users', $data);
	}

	function admin_user()
	{
		$this->check_login();
		
		$table = 'user';
		$where = array('status_id !=' => 0,'flag !=' => 3);
		$user = $this->user_model->get_common($table, $where,'*',2);
		
		$data = array('user' => $user);
		$data['active_menu'] = 'admin_user';
		$this->load->view('admin/admin_user', $data);
	}

	/*
	*	34
	*	Function Name	:	add_user()
	* 	Descrption 		:	Loads add user view
	*/
	function add_users()
	{
		$this->check_login();

		$data['active_menu'] = 'admin_user';
		$this->load->view('admin/add_users', $data);
	}

	function add_admin_user()
	{
		$this->check_login();
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
					'caste' => $caste);
					$data['active_menu'] = 'admin_user';
		$this->load->view('admin/add_admin_user', $data);
	}
	
	/*
	*	35
	*	Function Name	:	save_user()
	* 	Descrption 		:	Saves new user 
	*/
	function save_user()
	{
		//@extract($_POST);
		$this->form_validation->set_rules ( 'fname', 'First Name', 'required' );
		$this->form_validation->set_rules ( 'mname', 'Middle Name', 'required' );
		$this->form_validation->set_rules ( 'lname', 'Last Name', 'required' );
		$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric|min_length[10]|max_length[10]|is_unique[user.contact]' );
		$this->form_validation->set_rules ( 'country1', 'Country', 'xss_clean' );
		$this->form_validation->set_rules ( 'state1', 'State', 'required|xss_clean' );
		$this->form_validation->set_rules ( 'city1', 'City', 'required|xss_clean' );
		$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean|is_unique[user.email]' );
		$this->form_validation->set_rules ( 'pin1', 'Pincode', 'required|numeric|max_length[6]' );
		$this->form_validation->set_rules ( 'address1', 'Address', 'required' );
		$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[6]|matches[cpassword]' );
		$this->form_validation->set_rules ( 'cpassword', 'Confirm Password', 'required' );

		if ($_FILES ["image"] ["name"] == "") {
			$this->form_validation->set_rules ( "image", "Profile Image", "required" );
		}
		
		if($this->form_validation->run()==false)
		{

		$this->add_users();

		}
		else
		{ 
			$image_name="";
			if ($_FILES ["image"] ["name"] != "") {
				$target = "./site_data/uploads/profile/"; 
				$target1 =$target . @date(U)."_".( $_FILES['image']['name']);
				$image_name=@date(U)."_".( $_FILES['image']['name']);
				move_uploaded_file($_FILES['image']['tmp_name'], $target1);	
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = './site_data/uploads/product_profile/'.$image_name;
				$config['new_image'] = './site_data/uploads/profile/'.$image_name;
				//$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 250;
				$config['height']       = 250;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
			}
		$first_name=ucwords($_POST['fname']);
		$middle_name=ucwords($_POST['mname']);
		$last_name=ucwords($_POST['lname']);
		$user_mail=strtolower($_POST['email']);
		$user_contact=$_POST['contact'];
		$address1=$_POST['address1'];
		$address2=$_POST['address2'];
		$country1=ucwords($_POST['country1']);
		$country2=ucwords($_POST['country2']);
		$state1=ucwords($_POST['state1']);
		$state2=ucwords($_POST['state2']);
		$city1=ucwords($_POST['city1']);
		$city2=ucwords($_POST['city2']);
		$pin1=$_POST['pin1'];
		$pin2=$_POST['pin2'];
		$landmark2=$_POST['landmark2'];
		$district1=$_POST['district1'];
		$district2=$_POST['district2'];
		$mstatus=ucwords($_POST['mstatus']);
		$mlangu=ucwords($_POST['mlangu']);
		$religion=ucwords($_POST['religion']);
		$caste=ucwords($_POST['caste']);
		$sub_caste=ucwords($_POST['sub_caste']);
		$gender=ucwords($_POST['gender']);
		$birth=$_POST['birth'];

		$insert_data = array(
			'contact'	=>	$user_contact,
			'email'	=>	$user_mail,
			'password'	=> md5($_POST['password']),
			'image'	=>	$image_name,				
			'status_id'	=>	3
			);
	
			$table = 'user';
			$this->user_model->save_common($table, $insert_data);
			$user_id = $this->db->insert_id();
			$cur_time=date("Y-m-d H:i:s");

		$insert_data = array(
			'user_id' =>$user_id,
		'first'	=>	$first_name,
		'middle'	=>	$middle_name,
		'last'	=>	$last_name,
		'gender'	=>	$gender,
		'contact'	=>	$user_contact,
		'date_of_birth '	=>	$birth, 
		'religion'	=>	$religion,
		'language'	=>	$mlangu,
		'marital_status'  =>  $mstatus,
		'added_by' => $_SESSION['profile']->id,
		'added_date' => $cur_time,
		'status'	=>	1
		);

		$table = 'user_details';
		$this->user_model->save_common($table, $insert_data);

		$insert_data_add = array(
		'user_id'=> $user_id,
		'country'	=> $country1,
		'state'	=>	$state1, 
		'city '	=>	$city1, 
		'landmark'	=>	$_POST['landmark1'],
		'pincode'	=>	$_POST['pin1'],
		'address'	=>	$_POST['address1'],
		'status'	=>	1
		);

		$this->user_model->save_common('resident_address', $insert_data_add);
		$insert_data_add = array(
			'user_id'=> $user_id,
			'country'	=> $country2,
			'state'	=>	$state2, 
			'city '	=>	$city2, 
			'landmark'	=>	$_POST['landmark2'],
			'pincode'	=>	$_POST['pin2'],
			'address'	=>	$_POST['address1'],
			'status'	=>	1
			);
	
			$this->user_model->save_common('correspondence_address', $insert_data_add);
			$insert_data_add = array(
				'user_id'=> $user_id,
				'caste_name'	=> caste,
				'sub_caste_name'	=>	$sub_caste, 
				'status'	=>	1
				);
		
				$this->user_model->save_common('caste', $insert_data_add);
		//save notification
		$notisubject = 'New user Added';
		$notimessage = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
		font-size: 16px; font-weight: 300; color: #444'>
		<p>
		Dear Admin, follwing are the Details of new user: <br><br>

		User Name: ".$first_name.' '.$last_name."<br>
		User Email: ".$user_mail."<br>
		User Contact:".$user_contact."<br>
		Added at: ".date('Y-m-d H:i:s')."<br>
		</p>
		</div>";
		//$this->save_notifications(5, $notisubject, $notimessage, $user_id,$user_id);
		$this->save_notifications(5, $notisubject, $notimessage, $user_id, 0);

		$this->session->set_flashdata("success_message","user added successfully.");
		redirect(base_url('admin/users'));
		}
	}

	/*
	*	36
	*	Function Name	:	edit_users()
	* 	Descrption 		:	Loads edit user details view
	*/
	function edit_users($id){
		$this->check_login();
		
		$table = 'user';
		$where = array('id' => $id);
		$user = $this->user_model->get_common($table, $where);

		$table = 'user_details';
		$where = array('user_id' => $id);
		$user_details = $this->user_model->get_common($table, $where);

		$table = 'correspondence_address';
		$where = array('user_id' => $id);
		$corrs = $this->user_model->get_common($table, $where);

		$table = 'resident_address';
		$where = array('user_id' => $id);
		$reside = $this->user_model->get_common($table, $where);

		$table = 'caste';
		$where = array('user_id' => $id);
		$caste = $this->user_model->get_common($table, $where);

		$table = 'marital_status';
		$where = array('status !=' => 0);
		$marital_status = $this->user_model->get_common($table, $where,'*',2,'');
		
		$data = array('user' => $user,'corrs' => $corrs,'reside' => $reside,'caste' => $caste,'user_details' => $user_details,'marital_status' => $marital_status);
		$data['active_menu'] = 'users';

		$this->load->view('admin/edit_users', $data);		 
	} 

		/*
	*	36
	*	Function Name	:	edit_users()
	* 	Descrption 		:	Loads edit user details view
	*/
	function edit_family_users($id){
		$this->check_login();
		
		$table = 'user_family_details';
		$where = array('id' => $id);
		$user_details = $this->user_model->get_common($table, $where);

		$table = 'correspondence_address';
		$where = array('family_id' => $id);
		$corrs = $this->user_model->get_common($table, $where);

		$table = 'resident_address';
		$where = array('family_id' => $id);
		$reside = $this->user_model->get_common($table, $where);

		$table = 'caste';
		$where = array('family_id' => $id);
		$caste = $this->user_model->get_common($table, $where);

		$table = 'marital_status';
		$where = array('status !=' => 0);
		$marital_status = $this->user_model->get_common($table, $where,'*',2,'');
		
		$data = array('user_details' => $user_details,'corrs' => $corrs,'reside' => $reside,'caste' => $caste,'marital_status' => $marital_status);
		$data['active_menu'] = 'users';

		$this->load->view('admin/edit_family_users', $data);		 
	} 

	/*
	*	37
	*	Function Name	:	update_user()
	* 	Descrption 		:	Updates user details
	*/
	function update_user(){
		
		$this->form_validation->set_rules ( 'fname', 'First Name', 'required' );
		$this->form_validation->set_rules ( 'mname', 'Middle Name', 'required' );
		$this->form_validation->set_rules ( 'lname', 'Last Name', 'required' );
		$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric' );
		// $this->form_validation->set_rules ( 'country', 'Country', 'required|xss_clean' );
		// $this->form_validation->set_rules ( 'state', 'State', 'required|xss_clean' );
		// $this->form_validation->set_rules ( 'city', 'City', 'required|xss_clean' );
		// $this->form_validation->set_rules ( 'pin', 'Pincode', 'required|numeric|max_length[6]' );
		// $this->form_validation->set_rules ( 'address1', 'Address', 'required' );
		
        
		if($this->form_validation->run()==false)
		{

			$this->edit_users($_POST['id']);
			
		}else
		{
			
			$cur_date = date("Y-m-d h:i:s");
	
			 $update_data = array(
									'first'	=>	$_POST['fname'],
									'middle'	=>	$_POST['mname'],
									'last'	=>	$_POST['lname'],
						//			'email'	=>	$_POST['email'],
									'contact'	=>	$_POST['contact'],
									'date_of_birth '	=>	$_POST['birth'], 
									'marital_status'	=>	$_POST['marital_status'], 
									'language'	=> $_POST['language'],
									'religion'	=>	$_POST['religion'], 
									'gender'	=>	$_POST['gender'],
									'update_date' => $cur_date,
									'update_by' => $_SESSION['profile']->id,
								);
						 
			$table = 'user_details';
			$where = array('user_id' => $_POST['id']);

		$this->user_model->update_common($table, $where, $update_data);

		$update_data = array(
			// 'user_id'	=>	$_POST['id'],
			'caste_name'	=>	$_POST['caste'],
			'sub_caste_name'	=>	$_POST['sub_caste'],
			'update_date' => $cur_date,
			'update_by' => $_SESSION['profile']->id,
		);
 
		$table = 'caste';
		$where = array('user_id' => $_POST['id']);

		$this->user_model->update_common($table, $where, $update_data);
	
		$update_data = array(
			'address'	=>	$_POST['address1'],
			'landmark'	=>	$_POST['landmark1'],
			'country'	=>	$_POST['country1'],
			'state'	=>	$_POST['state1'],
			'city'	=>	$_POST['city1'],
			'district '	=>	$_POST['district1'], 
			'pincode'	=>	$_POST['pincode1'], 
			'update_date' => $cur_date,
			'update_by' => $_SESSION['profile']->id,
		);

		$table = 'resident_address';
		$where = array('user_id' => $_POST['id']);

		$this->user_model->update_common($table, $where, $update_data);

		$update_data = array(
			'address'	=>	$_POST['address2'],
			'landmark'	=>	$_POST['landmark2'],
			'country'	=>	$_POST['country2'],
			'state'	=>	$_POST['state2'],
			'city'	=>	$_POST['city2'],
			'district '	=>	$_POST['district2'], 
			'pincode'	=>	$_POST['pincode2'], 
			'update_date' => $cur_date,
			'update_by' => $_SESSION['profile']->id,
		);

		$table = 'correspondence_address';
		$where = array('user_id' => $_POST['id']);

		$this->user_model->update_common($table, $where, $update_data);

		$this->session->set_flashdata("success_message","user updated successfully.");
		redirect(base_url('admin/users'));
		
		}
	}
	
	function update_family_user(){
		
		$this->form_validation->set_rules ( 'fname', 'First Name', 'required' );
		$this->form_validation->set_rules ( 'mname', 'Middle Name', 'required' );
		$this->form_validation->set_rules ( 'lname', 'Last Name', 'required' );
		$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric' );
		// $this->form_validation->set_rules ( 'country', 'Country', 'required|xss_clean' );
		// $this->form_validation->set_rules ( 'state', 'State', 'required|xss_clean' );
		// $this->form_validation->set_rules ( 'city', 'City', 'required|xss_clean' );
		// $this->form_validation->set_rules ( 'pin', 'Pincode', 'required|numeric|max_length[6]' );
		// $this->form_validation->set_rules ( 'address1', 'Address', 'required' );
		
        
		if($this->form_validation->run()==false)
		{

			$this->edit_family_users($_POST['id']);
			
		}else
		{
			
			$cur_date = date("Y-m-d h:i:s");
	
			 $update_data = array(
									'first'	=>	$_POST['fname'],
									'middle'	=>	$_POST['mname'],
									'last'	=>	$_POST['lname'],
						//			'email'	=>	$_POST['email'],
									'contact'	=>	$_POST['contact'],
									'date_of_birth '	=>	$_POST['birth'], 
									'marital_status'	=>	$_POST['marital_status'], 
									'language'	=> $_POST['language'],
									'religion'	=>	$_POST['religion'], 
									'gender'	=>	$_POST['gender'],
									'update_date' => $cur_date,
									'update_by' => $_SESSION['profile']->id,
								);
						 
			$table = 'user_family_details';
			$where = array('user_id' => $_POST['id']);

		$this->user_model->update_common($table, $where, $update_data);

		$update_data = array(
			// 'user_id'	=>	$_POST['id'],
			'caste_name'	=>	$_POST['caste'],
			'sub_caste_name'	=>	$_POST['sub_caste'],
			'update_date' => $cur_date,
			'update_by' => $_SESSION['profile']->id,
		);
 
		$table = 'caste';
		$where = array('family_id' => $_POST['id']);

		$this->user_model->update_common($table, $where, $update_data);
	
		$update_data = array(
			'address'	=>	$_POST['address1'],
			'landmark'	=>	$_POST['landmark1'],
			'country'	=>	$_POST['country1'],
			'state'	=>	$_POST['state1'],
			'city'	=>	$_POST['city1'],
			'district '	=>	$_POST['district1'], 
			'pincode'	=>	$_POST['pincode1'], 
			'update_date' => $cur_date,
			'update_by' => $_SESSION['profile']->id,
		);

		$table = 'resident_address';
		$where = array('family_id' => $_POST['id']);

		$this->user_model->update_common($table, $where, $update_data);

		$update_data = array(
			'address'	=>	$_POST['address2'],
			'landmark'	=>	$_POST['landmark2'],
			'country'	=>	$_POST['country2'],
			'state'	=>	$_POST['state2'],
			'city'	=>	$_POST['city2'],
			'district '	=>	$_POST['district2'], 
			'pincode'	=>	$_POST['pincode2'], 
			'update_date' => $cur_date,
			'update_by' => $_SESSION['profile']->id,
		);

		$table = 'correspondence_address';
		$where = array('family_id' => $_POST['id']);

		$this->user_model->update_common($table, $where, $update_data);

		$this->session->set_flashdata("success_message","user updated successfully.");
		redirect(base_url('admin/users'));
		
		}
	}
	/*
	*	38
	*	Function Name	:	user_details()
	* 	Descrption 		:	Loads user details view
	*/
	function user_details($id)
	{
		$table = 'user';  
		$where = array('id' => $id);
		$user = $this->user_model->get_common($table, $where);
		
		$table = 'user_details';
		$where = array('user_id' => $id);
		$userdetails = $this->user_model->get_common($table, $where);

		$table = 'correspondence_address';
		$where = array('user_id' => $id);
		$corrs = $this->user_model->get_common($table, $where);

		$table = 'resident_address';
		$where = array('user_id' => $id);
		$reside = $this->user_model->get_common($table, $where);

		$table = 'caste';
		$where = array('user_id' => $id);
		$caste = $this->user_model->get_common($table, $where);
		$data = array('user' => $user,'userdetails' => $userdetails,'corrs' => $corrs,'reside' => $reside,'caste' => $caste);
	
		$data['active_menu'] = 'users';
	
		$this->load->view('admin/users_details', $data);		 
	}
	
	/*
	*	38
	*	Function Name	:	user_details()
	* 	Descrption 		:	Loads user details view
	*/
	function view_user_family_details($id)
	{	
		$table = 'user_family_details';
		$where = array('id' => $id);
		$userdetails = $this->user_model->get_common($table, $where);
		
		$table = 'correspondence_address';
		$where = array('family_id' => $id);
		$corrs = $this->user_model->get_common($table, $where);

		$table = 'resident_address';
		$where = array('family_id' => $id);
		$reside = $this->user_model->get_common($table, $where);

		$table = 'caste';
		$where = array('family_id' => $id);
		$caste = $this->user_model->get_common($table, $where);
		$data = array('userdetails' => $userdetails,'corrs' => $corrs,'reside' => $reside,'caste' => $caste);
	
		$data['active_menu'] = 'users';
	
		$this->load->view('admin/view_user_family_details', $data);		 
	}
	
	/*
	*	39
	*	Function Name	:	update_user_status()
	* 	Descrption 		:	Changes user status
	*/
	function update_user_status($status, $id)
	{
			
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('user', $where, $updateData);

	
			$this->set_flashdata('success_message', 'Status updated successfully.');
	
		redirect(base_url('admin/users'));		 
	}

		/*
	*	39
	*	Function Name	:	update_user_family_status()
	* 	Descrption 		:	Changes user family status
	*/
	function update_user_family_status($status, $id)
	{
			
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('user_family_details', $where, $updateData);

		$where = array('family_id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('caste', $where, $updateData);

		$where = array('family_id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('correspondence_address', $where, $updateData);

		$where = array('family_id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('resident_address', $where, $updateData);

	
			$this->set_flashdata('success_message', 'user family updated successfully.');
	
		redirect(base_url('admin/users'));		 
	}

	function user_family_details($id){
		$this->check_login();
		
		$table = 'user_family_details';
		$where = array('user_id' => $id);
		$table = 'user_family_details';
		$user_family = $this->user_model->get_common($table, $where,'*',2,'');
		
		$data = array('user_family' => $user_family,'id' =>$id);
		$data['active_menu'] = 'users';
		$this->load->view('admin/user_family_details', $data);		 
	}

	function user_report()
	{
		$this->check_login();
		$tablerp = 'user';
		$whererp = array('status_id !=' => 0);
		$group_byrp = '';
		$order_byrp = 'id';
		$orderrp = 'ASC';
		$user = $this->user_model->get_common($tablerp, $whererp,'*',2, '', $group_byrp, $order_byrp, $orderrp);

		$data = array('user' => $user);
		$data['active_menu'] = 'user_report';
		$this->load->view('admin/user_report', $data);
	}
	/*
	*	40
	*	Function Name	:	getuserList()
	* 	Descrption 		:	Gets user mail id
	*/
	public function getuserList()
	{
		$this->check_login();
		$where = array('status_id' => 1);
			 
		$table = 'user';
		$user_list = $this->user_model->get_common($table, $where,'*',2,'','email');
		$data = array('user_list' => $user_list);
		
		$this->load->view('admin/get_users_list', $data);
	}
	
	/*
	*	41
	*	Function Name	:	excel_all_user()
	* 	Descrption 		:	Excel user Report
	*/
	function excel_all_user()
	{
	    $where = array('status_id !=' => 0);
		$limit_to='';
		$group_by = '';
		$order_by='';
		$order='';
		$start='';
		$user_report= $this->user_model->get_common('user', $where,'*',2, $limit_to, $group_by, $order_by, $order, $start='');
		$data = array('user_report' => $user_report);
		$this->load->view('admin/excess/excel_all_users_exce', $data);
	}
	/*
	*	41
	*	Function Name	:	excel_all_user()
	* 	Descrption 		:	Excel user Report
	*/

	function excel_family_users_details($id)
	{
	    $where = array('id' => $id);
		$user= $this->user_model->get_common('user', $where,'*',1);
	
		$where = array('user_id' => $user->id);
		$limit_to='';
		$group_by = '';
		$order_by='';
		$order='';
		$start='';
		$user_report= $this->user_model->get_common('user_family_details', $where,'*',2, $limit_to, $group_by, $order_by, $order, $start='');
		//print_r($user_report);exit;
		$data = array('user_report' => $user_report,'user' => $user);
		$this->load->view('admin/excess/excel_family_users_details', $data);
	}
	/*
	*	42
	*	Function Name	:	pdf_all_user()
	* 	Descrption 		:	PDF user Report
	*/
	function pdf_all_user(){
		
		$wherec = array('status_id !=' => 0);
		$customer_report = $this->user_model->get_common('user', $wherec,'*',2);
		$challan_no_flag = "All_users_list"."-".date("Y-m-d");
		$data= array('customer_report' =>$customer_report);
		
		$this->load->view('admin/excess/pdf_all_users_exce', $data);
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
		
		// download pdf on local machine
		$this->dompdf->stream($challan_no_flag.".pdf", array("Attachment"=>1));
		// download pdf on server
		//file_put_contents("site_data/uploads/report/user_order/".$challan_no_flag.".pdf", $this->dompdf->output());
		
		//$pfd_file=upload_path.'report/user_order/'.$challan_no_flag.".pdf";
		//echo '<iframe src="$pfd_file" style="width:600px; height:500px;" frameborder="0"></iframe>';
		redirect(base_url('admin/users'));
		$this->session->set_flashdata("success_message","Report Generated Successfully!");		
	}
	
	function pdf_all_orders()
	{
		$wherec = array();
		$order = $this->user_model->get_common('tbl_order', $wherec,'*',2,'','','');
		
		$challan_no_flag = "All_Orders"."-".date("Y-m-d");
		$data= array('order' =>$order);
		
		$this->load->view('admin/excess/order_report_pdf', $data);
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
		
		// download pdf on local machine
		$this->dompdf->stream($challan_no_flag.".pdf", array("Attachment"=>1));
		// download pdf on server
		//file_put_contents("site_data/uploads/report/user_order/".$challan_no_flag.".pdf", $this->dompdf->output());
		
		$this->session->set_flashdata("success_message","Report Generated Successfully!");
		redirect(base_url('admin/order'));
	}

	function add_marital_status(){
		$this->check_login();
		$table = 'marital_status';
		$where = array('status !='=>0);
		$marital_status = $this->user_model->get_common($table, $where,'*',2, '');
		$data = array('marital_status' => $marital_status);
		$data['active_menu'] = 'marital_status';		
		$this->load->view('admin/add_marital_status', $data);
	}

	function save_marital_status(){

		$this->form_validation->set_rules ( 'marital_status', 'marital_status', 'required' );
		
		if($this->form_validation->run()==false){
			$this->add_marital_status();
		}else{
			
			$insert_data = array(
				'marital_status_name' => ucfirst($_POST['marital_status']),
				'status'	=>	1
			);

			$table = 'marital_status';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Marital Status added successfully.");
			redirect(base_url('admin/add_marital_status'));
		}
	}

	function update_marital_status($status, $id)
	{
			
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('marital_status', $where, $updateData);

	
			$this->set_flashdata('success_message', 'Status updated successfully.');
	
		redirect(base_url('admin/add_marital_status'));		 
	}

	function edit_marital_status($id){

		$table = 'marital_status';
		$where = array('id' => $id);
		$marital_status = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'marital_status';
		$data['marital_status'] = $marital_status;
        $this->load->view('admin/edit_marital_status', $data);
	}

	function update_edit_marital_status(){

		$this->form_validation->set_rules ( 'marital_status', 'Marital Status','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_marital_status($_POST['id']);
			
		}else{

			$update_data = array(
				'marital_status_name'	=>	ucfirst($_POST['marital_status'])
			);
			 
			$table = 'marital_status';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Marital Status updated successfully.");
			redirect(base_url('admin/add_marital_status'));
		}
	}

	/* Foundation Name */
	function add_foundation(){
		$this->check_login();
		$table = 'foundation';
		$where = array('status !='=>0);
		$foundation = $this->user_model->get_common($table, $where,'*',2, '');
		$data = array('foundation' => $foundation);
		$data['active_menu'] = 'foundation';		
		$this->load->view('admin/add_foundation', $data);
	}

	function save_foundation(){

		$this->form_validation->set_rules ( 'foundation', 'Foundation', 'required' );
		
		if($this->form_validation->run()==false){
			$this->add_foundation();
		}else{
			
			$insert_data = array(
				'foundation_name' => ucfirst($_POST['foundation']),
				'status'	=>	1
			);

			$table = 'foundation';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Foundation added successfully.");
			redirect(base_url('admin/add_foundation'));
		}
	}

	function update_foundation($status, $id)
	{
			
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('foundation', $where, $updateData);

	
			$this->set_flashdata('success_message', 'Status updated successfully.');
	
		redirect(base_url('admin/add_foundation'));		 
	}

	function edit_foundation($id){

		$table = 'foundation';
		$where = array('id' => $id);
		$foundation = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'foundation';
		$data['foundation'] = $foundation;
        $this->load->view('admin/edit_foundation', $data);
	}

	function update_edit_foundation(){

		$this->form_validation->set_rules ( 'foundation', 'Foundation','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_foundation($_POST['id']);
			
		}else{

			$update_data = array(
				'foundation_name'	=>	ucfirst($_POST['foundation'])
			);
			 
			$table = 'foundation';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Foundation updated successfully.");
			redirect(base_url('admin/add_foundation'));
		}
	}
	
	/* Language*/
	function add_language(){
		$this->check_login();
		$table = 'language';
		$where = array('status !='=>0);
		$language = $this->user_model->get_common($table, $where,'*',2, '');
		$data = array('language' => $language);
		$data['active_menu'] = 'language';		
		$this->load->view('admin/add_language', $data);
	}

	function save_language(){

		$this->form_validation->set_rules ( 'language', 'Language', 'required' );
		
		if($this->form_validation->run()==false){
			$this->add_language();
		}else{
			
			$insert_data = array(
				'language_name' => ucfirst($_POST['language']),
				'status'	=>	1
			);

			$table = 'language';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Marital Status added successfully.");
			redirect(base_url('admin/add_language'));
		}
	}

	function update_language($status, $id)
	{
			
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('language', $where, $updateData);

	
			$this->set_flashdata('success_message', 'Status updated successfully.');
	
		redirect(base_url('admin/add_language'));		 
	}

	function edit_language($id){

		$table = 'language';
		$where = array('id' => $id);
		$language = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'language';
		$data['language'] = $language;
        $this->load->view('admin/edit_language', $data);
	}

	function update_edit_language(){

		$this->form_validation->set_rules ( 'language_name', 'Language','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_language($_POST['id']);
			
		}else{

			$update_data = array(
				'language_name'	=>	ucfirst($_POST['language_name'])
			);
			 
			$table = 'language';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Mother Tounge updated successfully.");
			redirect(base_url('admin/add_language'));
		}
	}

	/* Religion*/
	function add_religion(){
		$this->check_login();
		$table = 'religion';
		$where = array('status !='=>0);
		$religion = $this->user_model->get_common($table, $where,'*',2, '');
		$data = array('religion' => $religion);
		$data['active_menu'] = 'religion';		
		$this->load->view('admin/add_religion', $data);
	}

	function save_religion(){

		$this->form_validation->set_rules ( 'religion', 'Religion', 'required' );
		
		if($this->form_validation->run()==false){
			$this->add_religion();
		}else{
			
			$insert_data = array(
				'religion' => ucfirst($_POST['religion']),
				'status'	=>	1
			);

			$table = 'religion';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Religion added successfully.");
			redirect(base_url('admin/add_religion'));
		}
	}

	function update_religion($status, $id)
	{
			
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('religion', $where, $updateData);

	
			$this->set_flashdata('success_message', 'Status updated successfully.');
	
		redirect(base_url('admin/add_religion'));		 
	}

	function edit_religion($id){

		$table = 'religion';
		$where = array('id' => $id);
		$religion = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'religion';
		$data['religion'] = $religion;
        $this->load->view('admin/edit_religion', $data);
	}

	function update_edit_religion(){

		$this->form_validation->set_rules ( 'religion', 'Religion','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_religion($_POST['id']);
			
		}else{

			$update_data = array(
				'religion'	=>	ucfirst($_POST['religion'])
			);
			 
			$table = 'religion';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Religion updated successfully.");
			redirect(base_url('admin/add_religion'));
		}
	}

	/* Caste*/
	function add_caste(){
		$this->check_login();
		$table = 'caste';
		$where = array('status !='=>0);
		$caste = $this->user_model->get_common($table, $where,'*',2, '');
		$data = array('caste' => $caste);
		$data['active_menu'] = 'caste';		
		$this->load->view('admin/add_caste', $data);
	}

	function save_caste(){

		$this->form_validation->set_rules ( 'caste', 'Caste', 'required' );
		
		if($this->form_validation->run()==false){
			$this->add_caste();
		}else{
			
			$insert_data = array(
				'caste_name' => ucfirst($_POST['caste']),
				'status'	=>	1
			);

			$table = 'caste';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","caste added successfully.");
			redirect(base_url('admin/add_caste'));
		}
	}

	function update_caste($status, $id)
	{
			
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('caste', $where, $updateData);

	
			$this->set_flashdata('success_message', 'Status updated successfully.');
	
		redirect(base_url('admin/add_caste'));		 
	}

	function edit_caste($id){

		$table = 'caste';
		$where = array('id' => $id);
		$caste = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'caste';
		$data['caste'] = $caste;
        $this->load->view('admin/edit_caste', $data);
	}

	function update_edit_caste(){

		$this->form_validation->set_rules ( 'caste', 'Caste','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_caste($_POST['id']);
			
		}else{

			$update_data = array(
				'caste_name'	=>	ucfirst($_POST['caste'])
			);
			 
			$table = 'caste';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Caste updated successfully.");
			redirect(base_url('admin/add_caste'));
		}
	}

	function view_notifi_details()
	{
		$this->check_login();
		$id=$_POST['id'];
		$table = 'notifications';
		$group_by = '';
		$order_by = 'id';
		$order2 = 'DESC';
		$where = array('id' => $id);
		$updateData = array('read_status' => 1, 'notify_for' => 0);

		$this->user_model->update_common($table, $where, $updateData);
		$notifi_detail = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order2);

		$data = array('notifi_detail'=>$notifi_detail);
		//$data['active_menu'] = 'order_details';
      
		$this->load->view('admin/view_notifi_details', $data);
	}
	
	function ajaxnotifications()
	{
		$this->check_login();
		//$id=$_POST['id'];
		$table = 'notifications';
		$group_by = '';
		$order_by = 'id';
		$order2 = 'DESC';
		$where = array('status_id' => 1, 'notify_for' => 0);
		$wherec = array('status_id' => 1,'read_status'=> 0, 'notify_for' => 0);
		
		$notifi = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order2);
		$notific = $this->user_model->get_common($table, $wherec,'*',2, '', $group_by, $order_by, $order2);
		$notifcnt=count($notific);
		$notifcntall=count($notifi);
		
		$data = array('notifi'=>$notifi,'notifcnt'=>$notifcnt,'notifcntall'=>$notifcntall);
      
		$this->load->view('admin/ajaxnotifications', $data);
	}
	
	function view_all_notifi()
	{
		$this->check_login();
		//$id=$_POST['id'];
		$table = 'notifications';
		$group_by = '';
		$order_by = 'id';
		$order2 = 'DESC';
		$where = array('status_id' => 1, 'notify_for' => 0);
		$wherec = array('status_id' => 1,'read_status'=> 0, 'notify_for' => 0);
		
		$notifi = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order2);
		$notific = $this->user_model->get_common($table, $wherec,'*',2, '', $group_by, $order_by, $order2);
		$notifcnt=count($notific);
		
		$data = array('notifi'=>$notifi,'notifcnt'=>$notifcnt);
	  
		$this->load->view('admin/notify', $data);
	}
	
	// read selected notifications
	function read_notification()
	{
		$table='notifications';
		$where= array();
		$ids=$_POST['array_read'];
		$where = array('status_id' => 1);
		$updateData = array('read_status' => 1);

		$this->db->where_in('id', $ids);
		$this->user_model->update_common($table, $where, $updateData);

		print(1);
	}

	function delete_notification()
	{
		$table='notifications';
		$where= array();
		$ids=$_POST['array_read'];
		
		$this->db->where_in('id', $ids);
		$this->user_model->delete_common($table, $where);
		
		print(1);
	}
	
	// Country, State, City, Area, Picode manage
	function country(){

		$table = 'country';
		$where = array('status_id !=' => 0);
		$country = $this->user_model->get_common($table, $where,'*',2);

		$data = array('country' => $country);
		$data['active_menu'] = 'location';
		$this->load->view('admin/country', $data);
	}

	function add_state(){

		$table = 'country';
		$where = array('status_id !=' => 0);
		$country = $this->user_model->get_common($table, $where,'*',2);
		
		$table = 'state';
		$where = array('status_id !=' => 0);
		$state = $this->user_model->get_common($table, $where,'*',2);
      
		$data = array('country' => $country,'state' => $state);
		$data['active_menu'] = 'location';
		$this->load->view('admin/add_state', $data);	
	}

	function add_city(){

		$table = 'country';
		$where = array('status_id !=' => 0);
		$country = $this->user_model->get_common($table, $where,'*',2);
		
		$table = 'state';
		$where = array('status_id !=' => 0);
		$state = $this->user_model->get_common($table, $where,'*',2);
		
		$table = 'city';
		$where = array('status_id !=' => 0);
		$city = $this->user_model->get_common($table, $where,'*',2);
      
		$data = array('country' => $country,'state' => $state,'city' => $city);
		
		$data['active_menu'] = 'location';
		$this->load->view('admin/add_city', $data);
	}
	
	function add_area(){

		$table = 'country';
		$where = array('status_id !=' => 0);
		$country = $this->user_model->get_common($table, $where,'*',2);
		
		$table = 'state';
		$where = array('status_id !=' => 0);
		$state = $this->user_model->get_common($table, $where,'*',2);
		
		$table = 'city';
		$where = array('status_id !=' => 0);
		$city = $this->user_model->get_common($table, $where,'*',2);
      
		$table = 'pincode';
		$where = array('status_id !=' => 0);
		$area = $this->user_model->get_common($table, $where,'*',2);
      
		$data = array('country' => $country,'state' => $state,'city' => $city,'area' => $area);
		
		$data['active_menu'] = 'location';
		$this->load->view('admin/add_area', $data);	
	}
	
	function save_country(){

		$this->form_validation->set_rules ( 'code', 'Code', 'required' );
		$this->form_validation->set_rules ( 'country', 'Country', 'required' );
		
		if($this->form_validation->run()==false){
			$this->country();
		}else{
			
			$insert_data = array(
				'country_code' => $_POST['code'],
				'country_name' => ucfirst($_POST['country']),
				'status_id'	=>	1
			);

			$table = 'country';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Country added successfully.");
			redirect(base_url('admin/country'));
		}
	}

	function save_state(){

		$this->form_validation->set_rules ( 'country', 'Country', 'required' );
		$this->form_validation->set_rules ( 'state', 'State', 'required' );
		
		if($this->form_validation->run()==false){
			$this->add_state();
		}else{
			
			$insert_data = array(
				'country_id' => $_POST['country'],
				'state_name' => ucfirst($_POST['state']),
				'status_id'	=>	1
			);

			$table = 'state';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","State added successfully.");
			redirect(base_url('admin/add_state'));
		}
	}
	
	function save_city(){

		$this->form_validation->set_rules ( 'country', 'Country', 'required' );
		$this->form_validation->set_rules ( 'state', 'State', 'required' );
		$this->form_validation->set_rules ( 'city', 'City', 'required' );
		
		if($this->form_validation->run()==false){
			$this->add_city();
		}else{
			
			$insert_data = array(
				'country_id' => $_POST['country'],
				'state_id' => $_POST['state'],
				'city_name' => ucfirst($_POST['city']),
				'status_id'	=>	1
			);

			$table = 'city';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","City added successfully.");
			redirect(base_url('admin/add_city'));
		}
	}
	
	function save_area(){

		$this->form_validation->set_rules ( 'country', 'Country', 'required' );
		$this->form_validation->set_rules ( 'state', 'State', 'required' );
		$this->form_validation->set_rules ( 'city', 'City', 'required' );
		$this->form_validation->set_rules ( 'area', 'Area', 'required' );
		$this->form_validation->set_rules ( 'pincode', 'Pincode', 'required|numeric|min_length[5]|max_length[6]' );
		
		if($this->form_validation->run()==false){
			$this->add_area();
		}else{
			
			$insert_data = array(
				'country_id' => $_POST['country'],
				'state_id' => $_POST['state'],
				'city_id' => $_POST['city'],
				'area_name' => ucfirst($_POST['area']),
				'pin_code' => $_POST['pincode'],
				'status_id'	=>	1
			);

			$table = 'pincode';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Area-Pincode added successfully.");
			redirect(base_url('admin/add_area'));
		}
	}
	
	function update_country_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('country', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Country deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/country'));
	}
	
	function update_state_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('state', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'State deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/add_state'));
	}
	
	function update_city_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('city', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'City deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/add_city'));
	}
	
	function update_area_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('pincode', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Area-Pincode deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/add_area'));
	}
	
	function edit_country($id){

		$table = 'country';
		$where = array('id' => $id);
		$country = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'location';
		$data['country'] = $country;
        $this->load->view('admin/edit_country', $data);
	}
	
	function edit_state($id){
		
		$table = 'state';
		$where = array('id' => $id);
		$state = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'location';
		$data['state'] = $state;
        $this->load->view('admin/edit_state', $data);
	}
	
	function edit_city($id){

		$table = 'city';
		$where = array('id' => $id);
		$city = $this->user_model->get_common($table, $where);

		$data['active_menu'] = 'location';
		$data['city'] = $city;
        $this->load->view('admin/edit_city', $data);
	}
	
	function edit_area($id){

		$table = 'pincode';
		$where = array('id' => $id);
		$area = $this->user_model->get_common($table, $where);

		$data['active_menu'] = 'location';
		$data['area'] = $area;
        $this->load->view('admin/edit_area', $data);
	}
	
	
	function update_edit_country(){

		$this->form_validation->set_rules ( 'code', 'Country Code','required' );
		$this->form_validation->set_rules ( 'country', 'Country Name','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_country($_POST['id']);
			
		}else{

			$update_data = array(
				'country_code'	=>	$_POST['code'],
				'country_name'	=>	ucfirst($_POST['country'])
			);
			 
			$table = 'country';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Country updated successfully.");
			redirect(base_url('admin/country'));
		}
	}
	
	function update_edit_state(){
		
		$this->form_validation->set_rules ( 'state', 'State Name','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_state($_POST['id']);
			
		}else{

			$update_data = array(
				'state_name'	=>	ucfirst($_POST['state'])
			);
			 
			$table = 'state';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","State updated successfully.");
			redirect(base_url('admin/add_state'));
		}
	}
	
	function save_series(){

		$this->form_validation->set_rules ( 'start_number', 'From Number', 'required|numeric|min_length[1]|max_length[6]' );
		$this->form_validation->set_rules ( 'end_number', 'To Number', 'required|numeric|min_length[1]|max_length[6]' );
		
		if($this->form_validation->run()==false){
			$this->product_series();
		}else{
			
			$insert_data = array(
				'start_number' => $_POST['start_number'],
				'end_number' => $_POST['end_number']
			);

			$table = 'authenticate';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Product Series added successfully.");
			redirect(base_url('admin/product_series'));
		}
	}
	
	function edit_series($id){

		$table = 'authenticate';
		$where = array('id' => $id);
		$series = $this->user_model->get_common($table, $where);

		$data['active_menu'] = 'product';
		$data['series'] = $series;
        $this->load->view('admin/edit_series', $data);
	}
	
	function update_edit_city(){
		
		$this->form_validation->set_rules ( 'city', 'City Name','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_city($_POST['id']);
			
		}else{

			$update_data = array(
				'city_name'	=>	ucfirst($_POST['city'])
			);
			 
			$table = 'city';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","City updated successfully.");
			redirect(base_url('admin/add_city'));
		}
	}
	
	function update_edit_area(){
		
		$this->form_validation->set_rules ( 'area', 'Area Name','required' );
		$this->form_validation->set_rules ( 'pincode', 'Pincode', 'required|numeric|min_length[5]|max_length[6]' );
		  
		if($this->form_validation->run()==false){

			$this->edit_area($_POST['id']);
			
		}else{

			$update_data = array(
				'pin_code'	=>	$_POST['pincode'],
				'area_name'	=>	ucfirst($_POST['area'])
			);
			 
			$table = 'pincode';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Area-Pincode updated successfully.");
			redirect(base_url('admin/add_area'));
		}
	}

	function bindState(){

		$where = array('status_id' => 1,'country' => $_POST['id']);
			
		$state = $this->user_model->get_common('state', $where,'*',2);
		$city = $this->user_model->get_common('city', $where,'*',2);
		$area = $this->user_model->get_common('pincode', $where,'*',2);
		$data = array('state' => $state,'city' => $city,'area' => $area);

		$this->load->view('admin/bindState', $data);
	} 
	
	function bindCity(){

		$where = array('status_id' => 1,'state' => $_POST['id']);
			
		//$state = $this->user_model->get_common('state', $where,'*',2);
		$city = $this->user_model->get_common('city', $where,'*',2);
		$area = $this->user_model->get_common('pincode', $where,'*',2);
		$data = array('city' => $city,'area' => $area);

		$this->load->view('admin/bindCity', $data);
	} 
	
		
	/* Common Functions */
	
	/* For save notification common */
	
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

	function send_sms($num,$msg)
	{
		$ms = rawurlencode($msg); //This for encode your message content 
		
		$url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.APIKEY.'&senderid='.SENDERID.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';

		//echo $url;
		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,"");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
		$data = curl_exec($ch);
		
		$data1 = json_decode($data);
		if($data1){	
			if($data1->ErrorMessage == 'Success'){
				$status_id = 1;
			}else{
				$status_id = 2;
			}
			$job_id = $data1->JobId;
			$message = $data1->MessageData[0]->Message;
			$total_users = count($data1->MessageData);
			
			$insert_data = array(
				'job_id'	=>	$job_id, 
				'total_users'	=>	$total_users, 
				'mail_sms'	=> 2,
				'message'	=>	$message,
				'added_by' => 1,
				'status_id'	=>	$status_id
			); 

			$table = 'history';
			$this->user_model->save_common($table, $insert_data);
			
			print $status_id;
		}else{
			print 2;
		}
	}
	
	function test_sms()
	{
		$num = 8830549672;
		//$msg = "Testing SMS Service";
		
		$view_reply_link = base_url('talk_with_experts');
		
		$msg = "Dear Prakash, \nYou can view admin/expert reply on your request, by clicking on given link: ".$view_reply_link.
		"\n\nThank You, \n".email_from_name;
		
		echo $this->send_sms($num, $msg);
	}
	
	//send multipple user for text message
	public function sendSMSToMultiple_users()
	{
		parse_str($_POST['user_data'],$user_data);

		$sms_body_content=trim($user_data['sms_body']);
		$counter=count($user_data['sms_to_user']); 
		
		$counter=count($user_data['sms_to_user']); 
		$users1= '';
		for($i=0;$i<$counter;$i++)
		{
			$users1.= $user_data['sms_to_user'][$i].',';
		} 
		$users1;
		$users = trim($users1,',');
		$check = $this->send_sms($users, $sms_body_content);
		print $check;
	}
	
	// Email
	public function sendEmailToMultiple_users()
	{
		parse_str($_POST['user_data'],$user_data);
		
		$subject=trim($user_data['subject']);
		$mail_body_content=trim($user_data['mail_body']);
		
		//echo $user_type = array_sum($user_data['user_status_type']);
		//$mail_to_user=(int)$user_data['mail_to_user'];
		
		$all_user=$user_data['specific_user_list'];
		$users = implode(', ', $all_user);
		
		if($users){
		$email = $users;
		$subject = $subject;
		$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
						font-size: 16px; font-weight: 300; color: #444'>
						Dear User,
						<p>
							$mail_body_content
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
		$this->my_send_email1($email, $subject, $message);
		print 1;
		}
	}
	
	/* send email to single user */
	function sendMailToSingleUser(){
		parse_str($_POST['user_data'],$user_data);
		//pr($user_data);exit;
		$subject=trim($user_data['sngl_subject']);
		$mail_from=trim($user_data['sngl_mail_from']);
		$mail_body_content=nl2br($user_data['sngl_mail_body']);
		$send_to=trim($user_data['send_to']);
		
		$email = $send_to;
		$subject = $subject;
		$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
						font-size: 16px; font-weight: 300; color: #444'>
						Dear User,
						<p>
							$mail_body_content
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
		print 1;
	}
	
	function my_send_email($email_to, $subject, $message) {
		
		$this->load->library('phpmailer_lib');
        
		$mail = $this->phpmailer_lib->load();
		
		if(site_mode=='localhost'){
		$mail->isSMTP();
		}
		
		//$mail->Host     = 'smtp.gmail.com';
		//$mail->SMTPAuth = true;
		//$mail->Username = email_username;
		//$mail->Password = email_password;
		//$mail->SMTPSecure = 'ssl';
		//$mail->Port     = 465;
        
		$mail->Host     = 'localhost';
        $mail->SMTPAuth = false;
		$mail->SMTPAutoTLS = false; 
        $mail->Username = email_username;
        $mail->Password = email_password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 25;
        
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
		// Send email
        //$mail->send();
        
		if(!$mail->send()){
            /* echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo; */
			
			$message = $message;
			$total_users = count($addresses);
			
			$insert_data = array(
				'job_id'	=>	0, 
				'total_users'	=>	$total_users, 
				'mail_sms'	=> 1,
				'message'	=>	$message,
				'added_by' => 1,
				'status_id'	=>	1
			); 

			$table = 'history';
			$this->user_model->save_common($table, $insert_data);
			
			print 1;

        }else{
            /* echo 'Message has been sent'; */
			
			$message = $message;
			$total_users = count($addresses);
			
			$insert_data = array(
				'job_id'	=>	0, 
				'total_users'	=>	$total_users, 
				'mail_sms'	=> 1,
				'message'	=>	$message,
				'added_by' => 1,
				'status_id'	=>	2
			); 

			$table = 'history';
			$this->user_model->save_common($table, $insert_data);
			
			print 2;
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
	
		//$mail->Host     = 'smtp.gmail.com';
		//$mail->SMTPAuth = true;
		//$mail->Username = email_username;
		//$mail->Password = email_password;
		//$mail->SMTPSecure = 'ssl';
		//$mail->Port     = 465;
        
		$mail->Host     = 'localhost';
        $mail->SMTPAuth = false;
		$mail->SMTPAutoTLS = false; 
        $mail->Username = email_username;
        $mail->Password = email_password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 25;
        
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
        //$mail->send();
        
		if(!$mail->send()){
            /* echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo; */
			
			$message = $message;
			$total_users = count($addresses);
			
			$insert_data = array(
				'job_id'	=>	0, 
				'total_users'	=>	$total_users, 
				'mail_sms'	=> 1,
				'message'	=>	$message,
				'added_by' => 1,
				'status_id'	=>	1
			); 

			$table = 'history';
			$this->user_model->save_common($table, $insert_data);
			
			print 1;

        }else{
            /* echo 'Message has been sent'; */
			
			$message = $message;
			$total_users = count($addresses);
			
			$insert_data = array(
				'job_id'	=>	0, 
				'total_users'	=>	$total_users, 
				'mail_sms'	=> 1,
				'message'	=>	$message,
				'added_by' => 1,
				'status_id'	=>	2
			); 

			$table = 'history';
			$this->user_model->save_common($table, $insert_data);
			
			print 2;
        }
    }
	
	function test_email() {
		// PHPMailer library load
		$email_to='dipakl@uvxcel.com';
		$subject='Testing Mail';
		$message='Testing Mail on server.';
		$this->load->library('phpmailer_lib');
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
		
		if(site_mode=='localhost'){
		$mail->isSMTP();
		}

		//$mail->Host     = 'smtp.gmail.com';
		//$mail->SMTPAuth = true;
		//$mail->Username = email_username;
		//$mail->Password = email_password;
		//$mail->SMTPSecure = 'ssl';
		//$mail->Port     = 465;
		
		$mail->Host     = 'localhost';
        $mail->SMTPAuth = false;
		$mail->SMTPAutoTLS = false; 
        $mail->Username = email_username;
        //$mail->Password = email_password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 25;
        
        $mail->setFrom(email_from, email_from_name);
        $mail->addReplyTo(email_from, email_from_name);
		
        // Add multiple recipients
		$addresses = explode(',', $email_to);
		
		$mail->addAddress($addresses[0]);
		
		foreach ($addresses as $address) {
			$mail->addCC($address);
		}
        // Email subject
        $mail->Subject = $subject;
        // Set email format to HTML
        $mail->isHTML(true);
        // Email body content
        $mailContent = $message;
        $mail->Body = $mailContent;
		// Send email
        //$mail->send();
		// Send email
        if(!$mail->send ()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }

}
