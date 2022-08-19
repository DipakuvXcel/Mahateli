<?php
/*************************************************
	* Author: dipakl@uvxcel.com	
	* Project : wedding portal	
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
		
		$where = array('status_id !=' => 0);
		$where_b = array('status_id !=' => 3);
		$where_p = array('status!='=>0);
		 
		$data['active_menu'] = 'dashboard';
		
		$data['total_user'] = $this->user_model->get_common('user', $where, 'count(*) as total');
		$data['total_enquiry'] = $this->user_model->get_common('enquiry', $where, 'count(*) as total',1,'','','');
		$this->load->view('admin/dashboard', $data);
	}

	function testimonial(){
		$this->check_login();

		$table = 'testimonial';
		$where = array('status_id !=' => 0);
		$testimonial = $this->user_model->get_common($table, $where,'*',2);

		$data = array('testimonial' => $testimonial);
		$data['active_menu'] = 'testimonial';

		$this->load->view('admin/testimonial', $data);
	}

	function update_testimonial($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('testimonial', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Testimonial deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/testimonial'));
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

	// Experts
	function experts(){
		$this->check_login();

		$table = 'user';
		$where = array('flag' =>2,'status_id !=' => 0);
		$experts = $this->user_model->get_common($table, $where,'*',2);

		$data = array('experts' => $experts);
		$data['active_menu'] = 'appointment';
		$this->load->view('admin/experts', $data);
	}
	
	function add_experts(){

		$this->check_login();
		$data['active_menu'] = 'appointment';
		$this->load->view('admin/add_experts', $data);
		
	}

	function save_experts(){

    	$this->form_validation->set_rules ( 'name', 'Name', 'required|callback__alpha_dash_space' );
    	$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean' );
    	$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric' );
    	$this->form_validation->set_rules ( 'expertise', 'Expertise', 'required' );
    	$this->form_validation->set_rules ( 'state', 'State', 'required' );
    	$this->form_validation->set_rules ( 'city', 'City', 'required' );
    	$this->form_validation->set_rules ( 'address1', 'Address', 'required' );
    	//$this->form_validation->set_rules ( 'pwd', 'Password', 'required|min_length[6]|matches[cpassword]' );
		//$this->form_validation->set_rules ( 'cpassword', 'Confirm Password', 'required' );
    	//$this->form_validation->set_rules ( 'user_desc', 'Description', 'required' );
    	if($this->form_validation->run()==false){

    		$this->add_experts();
    	}else{

    		$insert_data = array(
				'name'	=>	$_POST['name'],
				'email'	=>	$_POST['email'],
				'contact'	=>	$_POST['contact'],
				'expertise'	=>	$_POST['expertise'],
				'state'	=>	$_POST['state'],
				'city'	=>	$_POST['city'],
				'address1'	=>	$_POST['address1'],
				'password'	=>	md5($_POST['contact']),
				'flag'	=>	2,
				'status_id'	=>	1
			);

    		$table = 'user';
    		$this->user_model->save_common($table, $insert_data);

    		$this->session->set_flashdata("success_message","Expert added successfully.");
    		redirect(base_url('admin/experts'));
    	}
    }

	function update_experts_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('user', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Expert deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Expert updated successfully.');
		}

		redirect(base_url('admin/experts'));
	}

	function experts_details($id){
		$this->check_login();

		$table = 'user';
		$where = array('id' => $id);
		$experts = $this->user_model->get_common($table, $where,'*');

		$data = array('experts' => $experts);
		$data['active_menu'] = 'appointment';

		$this->load->view('admin/experts_details', $data);
	}
	
	function edit_experts($id){

		$this->check_login();

		$table = 'user';
		$where = array('id' => $id);
		$experts = $this->user_model->get_common($table, $where,'*');

		$data = array('experts' => $experts);
		$data['active_menu'] = 'appointment';

		$this->load->view('admin/edit_experts', $data);
	}
	
	function update_experts_details(){

		$this->form_validation->set_rules ( 'name', 'User Name', 'required' );
    	$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean' );
    	$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric' );
    	$this->form_validation->set_rules ( 'expertise', 'Expertise', 'required' );
    	$this->form_validation->set_rules ( 'state', 'State', 'required' );
    	$this->form_validation->set_rules ( 'city', 'City', 'required' );
    	$this->form_validation->set_rules ( 'address1', 'Address', 'required' );
		
		if($this->form_validation->run()==false){

			$this->edit_experts($_POST['id']);
		}else{
			
			$update_data = array(
    			'name'	=>	$_POST['name'],
				'email'	=>	$_POST['email'],
				'contact'	=>	$_POST['contact'],
				'expertise'	=>	$_POST['expertise'],
				'state'	=>	$_POST['state'],
				'city'	=>	$_POST['city'],
				'address1'	=>	$_POST['address1'],
    		);

			
			$table = 'user';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Experts updated successfully.");
			redirect(base_url('admin/experts'));
		}
	}   

	function edit_product_offer($id){

			$this->check_login();

			$table = 'offers';
		$where = array('status !=' => 0);
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		 
		$offers = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order);
		$combo_product = $this->user_model->get_common('combo_product', $where,'*',2, '', $group_by, $order_by, $order);

		$data = array('offers' => $offers,'combo_product' => $combo_product);
		$data['active_menu'] = 'product_offer';

			$this->load->view('admin/edit_product_offer', $data);
		}
	function product_offer(){
		$this->check_login();

		$table = 'offers';
		$where = array('status !=' => 0);
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		 
		$offers = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order);
		$combo_product = $this->user_model->get_common('combo_product', $where,'*',2, '', $group_by, $order_by, $order);
		$products = $this->user_model->get_common('products', $where,'*',2, '', $group_by, $order_by, $order);

		$data = array('offers' => $offers,'products' => $products,'combo_product' => $combo_product);
		$data['active_menu'] = 'product_offer';

		$this->load->view('admin/product_offer', $data);
	}
	
	function product_combo(){
		$this->check_login();

		$table = 'offers';
		$where = array('status !=' => 0);
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		 
		$offers = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order);
		$combo_product = $this->user_model->get_common('combo_product', $where,'*',2, '', $group_by, $order_by, $order);

		$data = array('offers' => $offers,'combo_product' => $combo_product);
		$data['active_menu'] = 'product_offer';

		$this->load->view('admin/product_combo', $data);
	}
	
	function save_product_combo(){
		
		$this->form_validation->set_rules ( 'product_name', 'Product Name', 'required' );
		//$this->form_validation->set_rules ( 'combo_product_id', 'combo_product', 'required' );
		 
		if($this->form_validation->run()==false ){

			$this->product_combo();
		}else{
		     
			$product_name = $_POST['product_name'];
			$price = $_POST['price'];
			$combo_group = $_POST['combo_group'];
			$description = $_POST['description'];
			 $image_name="";
		  if ($_FILES ["image"] ["name"] != "") {
			$target = "./site_data/uploads/product_profile/"; 
			$target1 =$target . @date(U)."_".( $_FILES['image']['name']);
			$image_name=@date(U)."_".( $_FILES['image']['name']);
			move_uploaded_file($_FILES['image']['tmp_name'], $target1);	
			}
			$note = $_POST['note'];
			$insert_data = array(
				'product_name'	=>	$product_name,
				'image'	=>	$image_name,
				'price'	=>	$price,
				'description'	=>	$description,
				'group_id'	=>	$combo_group,
				 'status'=>1
			);

			$table = 'combo_product';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Record added successfully.");
			redirect(base_url('admin/product_combo'));
		}
	}
	
	 
	
	function update_product_combo($status, $id){
		
		$table = 'combo_product';
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common($table, $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'product deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/product_combo'));
	}
	
	
	function update_product_offer($status, $id){
		
		$table = 'offers';
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common($table, $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'product deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/product_offer'));
	}
	
	
	
	function save_product_offer(){
		
		$this->form_validation->set_rules ( 'name', 'Name', 'required' );
		$this->form_validation->set_rules ( 'offer_type', 'offer type', 'required' );
		//$this->form_validation->set_rules ( 'combo_product_id', 'combo_product', 'required' );
		 
		if($this->form_validation->run()==false ){

			$this->product_offer();
		}else{
		     
			$name = $_POST['name'];
			$discount = $_POST['discount'];
			$description = $_POST['description'];
			$combo_id1="";
			if(isset($_POST['combo_product_id'])){
			$combo_product_id = $_POST['combo_product_id'];
			 foreach($combo_product_id as $val){
				$combo_id1.=$val.",";
			}
			}
			$combo_id=substr($combo_id1, 0, -1);
			
		  $product_id1="";
			if(isset($_POST['product_id'])){
			$combo_product_id = $_POST['product_id'];
			 foreach($combo_product_id as $val){
				$product_id1.=$val.",";
			}
			}
		  $product_id=substr($product_id1, 0, -1);
		  
			$note = $_POST['note'];
			$offer_type = $_POST['offer_type'];
			$insert_data = array(
				'name'	=>	$name,
				'discount_per'	=>	$discount,
				'description'	=>	$description,
				'combo_id'	=>	$combo_id,
				'product_id'	=>	$product_id,
				'type'	=>	$offer_type,
				'note'	=>	$note,
				'status'=>1
			);

			$table = 'offers';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Offer added successfully.");
			redirect(base_url('admin/product_offer'));
		}
	}
	
	function update_product_offer_details(){
		
		$this->form_validation->set_rules ( 'name', 'Name', 'required' );
		$this->form_validation->set_rules ( 'offer_type', 'offer type', 'required' );
		//$this->form_validation->set_rules ( 'combo_product_id', 'combo_product', 'required' );
		 
		if($this->form_validation->run()==false ){

			$this->product_offer();
		}else{
		     
			$id = $_POST['id'];
			$name = $_POST['name'];
			$discount = $_POST['discount'];
			$description = $_POST['description'];
			$combo_id="";
			if(isset($_POST['combo_product_id'])){
			$combo_product_id = $_POST['combo_product_id'];
			 foreach($combo_product_id as $val){
				$combo_id.=$val;
			}
			}
		  
			$note = $_POST['note'];
			$offer_type = $_POST['offer_type'];
			$updated_data = array(
				'name'	=>	$name,
				'discount_per'	=>	$discount,
				'description'	=>	$description,
				'combo_id'	=>	$combo_id,
				'type'	=>	$offer_type,
				'note'	=>	$note,
				'status'=>1
			);

			$table = 'offers';
			$where = array('id' => $id);
		 

			$this->user_model->update_common($table, $where, $updated_data);
			 
			$this->session->set_flashdata("success_message","Offer Updated successfully.");
			redirect(base_url('admin/product_offer'));
		}
	}
	
	function product(){
		$this->check_login();

		$table = 'products';
		$where = array('status !=' => 0);
		$group_by = '';
		$order_by = 'position';
		$order = 'DESC';
		 
		$product = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order);

		$data = array('product' => $product);
		$data['active_menu'] = 'product';

		$this->load->view('admin/product', $data);
	}
	
	function order(){
		$this->check_login();

		$table = 'tbl_order';
		$where = array();
		$group_by = '';
		$order_by = 'id';
		$order1 = 'DESC';
		$order = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);

		$data = array('order' => $order);
		$data['active_menu'] = 'order';

		$this->load->view('admin/order', $data);
	}
	
	function coupon_applied_orders($coupon_code){
		$this->check_login();

		$table = 'tbl_order';
		$where = array('coupon_code' => $coupon_code);
		$group_by = '';
		$order_by = 'id';
		$order1 = 'DESC';
		$order = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);

		$data = array('order' => $order);
		$data['active_menu'] = 'discount';

		$this->load->view('admin/coupon_applied_orders', $data);
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
	
	function discount(){
		$this->check_login();

		$table = 'coupon'; 
		$where = array('status !='=> 0, 'flag'=> 1);
		$group_by = '';
		$order_by = 'id';
		$order1 = 'DESC';
		$dist = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);

		$data = array('discount' => $dist);
		$data['active_menu'] = 'discount';

		$this->load->view('admin/discount', $data);
	}
	
	function save_discount(){
		
		$this->form_validation->set_rules ( 'coupon_code', 'Coupon Code', 'required|min_length[6]|max_length[8]|xss_clean|is_unique[coupon.coupon_code]' );
		$this->form_validation->set_rules ( 'udist', 'Discount Pecentage', 'required|numeric|max_length[2]' );
		$this->form_validation->set_rules ( 'start_date', 'select start date', 'required' );
		$this->form_validation->set_rules ( 'end_date', 'select end date', 'required' );

		if($this->form_validation->run()==false ){

			$this->discount();
		}else{
		     
			$sdate = $_POST['start_date'];
			$edate = $_POST['end_date'];
			$insert_data = array(
				'start_dt'	=>	$sdate,
				'end_dt'	=>	$edate,
				'discount'	=>	trim($_POST['udist']),
				'coupon_code'	=>	trim($_POST['coupon_code']),
				'status'	=>	1,
				'flag'	=>	1
			);

			$table = 'coupon';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Discount Coupon added successfully.");
			redirect(base_url('admin/discount'));
		}
	}
	
	function save_refree_coupon(){
		
		$this->form_validation->set_rules ( 'coupon_code', 'Coupon Code', 'required|min_length[6]|max_length[8]|xss_clean|is_unique[coupon.coupon_code]' );
		$this->form_validation->set_rules ( 'udist', 'Discount Pecentage', 'required|numeric|max_length[2]' );
		$this->form_validation->set_rules ( 'referee_name', 'Referee Name', 'required' );
		$this->form_validation->set_rules ( 'referee_contact', 'Referee Contact', 'required|numeric|min_length[10]|max_length[10]' );

		if($this->form_validation->run()==false ){

			$this->add_refree_coupon();
		}else{

			$insert_data = array(
				'referee_name'	=>	trim($_POST['referee_name']),
				'referee_contact'	=>	trim($_POST['referee_contact']),
				'discount'	=>	trim($_POST['udist']),
				'coupon_code'	=>	trim($_POST['coupon_code']),
				'status'	=>	1,
				'flag'	=>	2
			);

			$table = 'coupon';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Referee Discount Coupon added successfully.");
			redirect(base_url('admin/add_refree_coupon'));
		}
	}
	
	function edit_discount($id){

		$table = 'coupon';
		$where = array('id' => $id);

		$discount = $this->user_model->get_common($table, $where);
		$data['active_menu'] = 'discount';
		$data['discount'] = $discount;
		$this->load->view('admin/edit_discount', $data);
	}
	
	function update_edit_discount(){
		
		$this->form_validation->set_rules ( 'coupon_code', 'Coupon Code', 'required|min_length[6]|max_length[8]' );
		$this->form_validation->set_rules ( 'udist', 'Discount', 'required|numeric|max_length[2]' );
		$this->form_validation->set_rules ( 'start_date', 'Start Date', 'required' );
		$this->form_validation->set_rules ( 'end_date', ' End date', 'required' );

		if($this->form_validation->run()==false ){
			$this->edit_discount($_POST['id']);
		}else{
		 
			$sdate = $_POST['start_date'];
			$edate = $_POST['end_date'];
			$update_data = array(
				'coupon_code'	=>	trim($_POST['coupon_code']),
				'discount'	=>	trim($_POST['udist']),
				'start_dt'	=>	$sdate,
				'end_dt'	=>	$edate
			);
			
            $table = 'coupon';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

            $this->session->set_flashdata("success_message","Discount Coupon updated successfully.");
			redirect(base_url('admin/discount'));
		}	
	}
	
	function edit_refree_coupon($id){

		$table = 'coupon';
		$where = array('id' => $id);

		$discount = $this->user_model->get_common($table, $where);
		$data['active_menu'] = 'discount';
		$data['discount'] = $discount;
		$this->load->view('admin/edit_refree_coupon', $data);
	}
	
	function update_edit_refree_coupon(){
		
		$this->form_validation->set_rules ( 'coupon_code', 'Coupon Code', 'required|min_length[6]|max_length[8]' );
		$this->form_validation->set_rules ( 'udist', 'Discount', 'required|numeric|max_length[2]' );
		$this->form_validation->set_rules ( 'referee_name', 'Referee Name', 'required' );
		$this->form_validation->set_rules ( 'referee_contact', 'Referee Contact', 'required|numeric|min_length[10]|max_length[10]' );

		if($this->form_validation->run()==false ){
			$this->edit_discount($_POST['id']);
		}else{
		 
			$sdate = $_POST['start_date'];
			$edate = $_POST['end_date'];
			$update_data = array(
				'coupon_code'	=>	trim($_POST['coupon_code']),
				'discount'	=>	trim($_POST['udist']),
				'referee_name'	=>	trim($_POST['referee_name']),
				'referee_contact'	=>	trim($_POST['referee_contact'])
			);
			
            $table = 'coupon';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

            $this->session->set_flashdata("success_message","Referee Discount Coupon updated successfully.");
			redirect(base_url('admin/add_refree_coupon'));
		}	
	}
	
	function update_discount($status,$id){
	
	    $where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('coupon', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Discount Coupon deleted successfully.');
		}
		else if($status == 1){

			/* $where = array('id !=' => $id);
			$updateData = array('status' => 2); //make other discount inactive
			$this->user_model->update_common('coupon', $where, $updateData); */

			$this->set_flashdata('success', 'Status updated successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/discount'));

	}
	
	function update_refree_coupon($status,$id){
	
	    $where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('coupon', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Refree Discount Coupon deleted successfully.');
		}
		else if($status == 1){

			/* $where = array('id !=' => $id);
			$updateData = array('status' => 2); //make other discount inactive
			$this->user_model->update_common('coupon', $where, $updateData); */

			$this->set_flashdata('success', 'Status updated successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/add_refree_coupon'));
	}
	
	function order_details($id)
	{
		$this->check_login();

		$table = 'tbl_order_item';
		$group_by = '';
		$order_by = 'id';
		$order2 = 'DESC';
		$where = array('order_id' => $id);
		$order_detail = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order2);
		
		$table = 'tbl_order';
		$group_by = '';
		$order_by = 'id';
		$order2 = 'DESC';
		$where = array('id' => $id);
		$order = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order2);
		
       
		$data = array('order' => $order,'order_detail'=>$order_detail);
		//$data['active_menu'] = 'order_details';
      
		$this->load->view('admin/order_details', $data);
	}
	
	function statistics(){
		$this->check_login();

		$table = 'statistics';
		$where = array('status_id !=' => 0);
		$group_by = 'lables';
		$statistics = $this->user_model->get_common($table, $where,'*',2, '', $group_by);

		$data = array('statistics' => $statistics);
		$data['active_menu'] = 'statistics';

		$this->load->view('admin/statistics', $data);
	}

	function update_gallery($status, $id){
		
		$table = 'gallery';
		$where = array('id' => $id);
		
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('gallery', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Gallery deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/gallery'));
	}
	
	function update_e_brochure($status, $id){
		
		$table = 'e_brochure';
		$where = array('ebook_id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('e_brochure', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'E-brochure deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/e_brochure'));
	}
	
	function update_product($status, $id){
		
		$table = 'products';
		$where = array('product_id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common($table, $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'product deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/product'));
	}
	
	public function update_order(){
	// error_reporting(0);

		
		$tol_unit_cost_amt= $_POST['tol_tax_val'];
		$tol_gst= $_POST['tot_gst'];
		$tot_gst_amt=$_POST['tot_gst_amt'];
		$dealer_discount=$_POST['only_discount'];
		$discount= $_POST['discount'];
		$final_value= $_POST['final_value'];
		$total_quntity=$_POST['total_quntity'];
		
		$order_id= $_POST['order_id'];
		$product_id= $_POST['hid_product_id'];
		$product_name= $_POST['product_name'];
		$product_qty= $_POST['product_qty'];
		$product_price= $_POST['product_price'];
		$rem_qty= $_POST['rem_qty'];
		//$product_gst= $_POST['product_gst'];
		$total= $_POST['total'];
		//echo $total_quntity;
		//exit;

		$table = 'tbl_order';
		$group_by = '';
		$order_by = 'id';
		$order2 = 'DESC';
		$where = array('id' => $order_id);
		$order = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order2);
		$order[0]->total_qty;
		
		//for find remaining qty product id find
		$this->db->select('*');
		$this->db->from('tbl_order_item');
		$this->db->where_in('order_id', $order_id);
		$query = $this->db->get();
		$order_products=$query->result();
		
		$new_order_product_array = array();
		$new_remain_product_qty_array = array();
		
		for($p=0;$p<count($order_products);$p++) { 
			$require_qty = $order_products[$p]->quantity;
			$this->db->select('*');
			$this->db->from('products');
			$this->db->where_in('product_id', $order_products[$p]->product_id);
			$query = $this->db->get();
			$products=$query->result();
			$avlqty = $products[0]->quantity;
			$remain = $require_qty - $avlqty;
			if($remain > 0)
			{		 
				array_push($new_order_product_array, $products[0]->product_id);
				array_push($new_remain_product_qty_array, $remain);
			}
		}
		//for find remaining qty product id find
		
		
		if (! empty($_POST["final_value"])) {
	
			$update_data = array(
			                'total_qty' =>$total_quntity,
			                'total_unit_cost' =>$tol_unit_cost_amt,
			                'total_amt' => $tol_gst, 
			                'total_gst_amt' => $tot_gst_amt,
			               // 'discount_per'	=>	$dealer_discount,
			                'discount_amt'	=>	$discount,
                            'final_amt'	=>	$final_value,
				            //'order_status' => 1,
			                //'order_by'=> $cust_id,
						);

			$table = 'tbl_order';
			$where = array('id' => $order_id);
           $this->user_model->update_common($table, $where, $update_data);
			
		}
			$i=0;	
			foreach ($product_name as $value) {
			$value = trim($value);
				if(empty($value)){
					
				} else {
						$update_data = array(
						   // 'order_id'	=>	$order_id,
							//'product_id'	=>	$product_id[$i],
							//'price'	=>	$product_price[$i],
				           // 'gst'	=> $product_gst[$i],
			                'final_price' => $total[$i],
				            'quantity' => $product_qty[$i],
						);

			     $table = 'tbl_order_item';
			     $where = array('order_id' => $order_id,'product_id'=>$product_id[$i]);
                $ins= $this->user_model->update_common($table, $where, $update_data);
				}
                $i++;
			}
	
			/* if($ins){
				echo 1;
			 }
			else{
				  echo 0;
			  }   */
			  
			  
			 

		////////////for remaining order place//////////////////////
		if (!empty($new_order_product_array)) {
			
		$cust_name= $_POST['cust_name'];
		$cust_email= $_POST['cust_email'];
		$cust_contact= $_POST['cust_contact'];
		$cust_id= $_POST['cust_id'];
		
		
		//echo "new";
		$tol_gst_amt=0;
		$tol_unit_cost=0;
		$tol_amt = 0; 
		$unit_cost = 0; 
		$qty_sum = 0; 
		$dealer_dist = 0; 
		$dealer_discount=0;
		//$totdist_final_amt1 = 0; 
		for($k=0;$k<count($new_order_product_array);$k++)
		{
			$pqty = $new_remain_product_qty_array[$k]; 
				$this->db->select('*');
				$this->db->from('products');
				$this->db->where_in('product_id', $new_order_product_array[$k]);
				$query = $this->db->get();
				$products=$query->result();
				 
					$avlqty = $products[0]->quantity;
					$unit_cost=$products[0]->price;
					$taxable_value=$products[0]->price*$pqty;
					$gstamt=$taxable_value * ($products[0]->gst/100);
					$total=$gstamt + $taxable_value;
					
					$tol_unit_cost+= $taxable_value;
					$tol_gst_amt+= $gstamt;
					//$tol_amt+= $tol_unit_cost;
					  
					$qty_sum+=$pqty;
					

					 
			 
			}
		
		
		  $date= date('Y-m-d'); 
		  $wheredeal = array('id' => $cust_id);
		  $whered = array('status' => 1);
		  $dis_guser = $this->user_model->get_common('coupon', $whered,'*',2);
		  $dis_dealer = $this->user_model->get_common('dealer_discount', $whered,'*',2);
		  $dealer = $this->user_model->get_common('dealer', $wheredeal,'*',2);
		  if($dealer[0]->id){
			   if(count($dis_dealer)>0){
				  if(($dis_dealer[0]->start_dt<=$date) && ($dis_dealer[0]->end_dt>=$date)){ 
					  $dealer_discount=$dis_dealer[0]->dist; 
				  } 
				   else {
					  $dealer_discount=0;
				  }
			  }
		  }
	
		  
		  if($dealer[0]->discount!=0){
			  $discount = $dealer[0]->discount;
		  }
		  elseif(($dis_guser[0]->start_dt<=$date) &&($dis_guser[0]->end_dt>=$date)){ 
			 $discount=$dis_guser[0]->dist; 
		  } 
		  else { 
			$discount=0;
		  }
		  
		  $tol_unit_cost_amt= number_format($tol_unit_cost, 2, '.', '');echo "<br>";
		  $tot_gst_amt=number_format($tol_gst_amt, 2, '.', '');echo "<br>";
		  $tol_amt= $tol_unit_cost_amt+$tot_gst_amt;
		  $tol_amt= number_format($tol_amt, 2, '.', '');echo "<br>";
	
		  $dist=($tol_amt)*($discount/100);
		  $final_amt=$tol_amt-$dist;
	
		  $dealer_dist=($final_amt)*($dealer_discount/100);
		  $totol_dist= ($dist)+($dealer_dist);echo "<br>";
		  $totdist_final_amt=($tol_amt)-($totol_dist);
		  $totdist_final_amt1=round($totdist_final_amt);
		  
		$final_value= number_format($totdist_final_amt1, 2, '.', '');
		$total_quntity=$qty_sum;
		
		$discount_per=$dealer_discount+$discount;
		
		
		 
		if (! empty($final_value)) {
		$insert_data = array(
						    'user_id'	=>	$cust_id,
							'name'	=>	$cust_name,
				            'mobile'	=> $cust_contact,
			                'email' => $cust_email,
			                'total_qty' =>$total_quntity,
			                'total_unit_cost' =>$tol_unit_cost_amt,
			                'total_amt' => $tol_amt, 
			                'total_gst_amt' => $tot_gst_amt,
			                'discount_per'	=>	$discount_per,
			                'discount_amt'	=>	$totol_dist,
                            'final_amt'	=>	$final_value,
				            'order_status' => 0,
			                'order_by'=> $_SESSION['profile']->id
						);

			$table = 'tbl_order';
			$this->user_model->save_common($table, $insert_data);
		    $order_id = $this->db->insert_id();
			
			$table = 'tbl_order';
			$where = array('id' => $order_id);
			$update_data = array('invoice'=> 'purchase_order_'.$order_id.".pdf");
            $this->user_model->update_common($table, $where, $update_data);
		}
	   
	  
	   
			$i=0;	
			foreach ($new_order_product_array as $value) {
			$value = trim($value);
				if(empty($value)){
					
				} else {
					
			  $table = 'products';
			  $where = array('product_id'=>$new_order_product_array[$i]);
			  //$this->db->where_in('product_id', $product_color[$i]);
			  $group_by = '';
			  $order_by = 'product_id';
			  $order = 'DESC';
			  $orders_id = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);
			  $order_color=$orders_id[0]->product_color;
			  $quantity=$new_remain_product_qty_array[$i];
			  
			   $unit_cost=$orders_id[0]->price;
			  $gst=$orders_id[0]->gst;
		   	  $taxable_value=$orders_id[0]->price*$quantity;
			  $gstamt=$taxable_value * ($orders_id[0]->gst/100);
			  $total=$gstamt + $taxable_value;
			
			
				$insert_data = array(
						    'order_id'	=>	$order_id,
							'product_id'	=>	$new_order_product_array[$i],
					        'product_color'	=>	$order_color,
					        'price'	=>	$unit_cost,
				            'gst'	=> $gst,
			                'final_price' => $total,
				            'quantity' => $quantity,
						);

				 $table = 'tbl_order_item';
				 $ins=$this->user_model->save_common($table, $insert_data);	
				}
                  $i++;
			}
			
			
			$notisubject = 'New Order Placed by dealer';
			$notimessage = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
							    <p>
							        New Order Placed by dealer, follwing are the order details: <br><br>
									Dealer Name: ".$cust_name."<br>
									Dealer Email: ".$cust_email."<br>
									Dealer Contact: ".$cust_contact."<br>
									Total Amount: ".$final_value."<br><br>
									Order at: ".date('Y-m-d H:i:s')."<br>
							    </p>

							</div>";
			//$this->save_notifications(1, $notisubject, $notimessage, $order_id);
            
	   
	        $table = 'coupon';
			$where = array('status' => 1);
			$dis_guser = $this->user_model->get_common($table, $where,'*',2);
	 
	        $table = 'dealer_discount';
			$where = array('status' => 1);
			$dis_dealer = $this->user_model->get_common($table, $where,'*',2);
			$data= array(
						//'page_title' => 'Place Order| Aaron',
						//'order_product' => $order_product,
						'print_product' =>$_POST,
						'dis_guser'=>$dis_guser,
				        'dis_dealer' =>$dis_dealer,
						);

            $this->load->view('admin/bill_print', $data);
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
			file_put_contents("site_data/uploads/order_document/purchase_order_".$order_id.".pdf", $this->dompdf->output());
			
			$pfd_file=upload_path.'order_document/purchase_order_'.$order_id.".pdf";
			
	        $email=$cust_email;
			$subject = 'Thank you for Order.';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
							    Dear ".$cust_name.",
								<p>
							        Thank you for new Order, follwing are the order details: <br><br>
									Order Total Amount: ".$final_value."<br><br>
									Order at: ".date('Y-m-d H:i:s')."<br>
									download PDF : ".$pfd_file."<br>
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
			//$this->my_send_email($email, $subject, $message,$pfd_file);
			
	        $this->session->set_userdata('geust_user','');
		    
			if($ins){
				echo 1;
			 }
			else{
				  echo 0;
			  }
		
		
		
		////////for remaining order place/////////////
		
		}
			  
		   
			  
	}
	
	
	
	
   function update_statistics($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('statistics', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'statistics deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/statistics'));
	}
	
	function update_gallery_image($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('gallery', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Gallery image deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/gallery_details/'.$id));
	}

	function brands(){
		$this->check_login();

		$table = 'brands';
		$where = array('status_id !=' => 0);
		$group_by = '';
		$brands = $this->user_model->get_common($table, $where,'*',2, '', $group_by);

		$data = array('brands' => $brands);
		$data['active_menu'] = 'brands';
		$this->load->view('admin/brands', $data);
	}
	
	function brand_details($id){
		$this->check_login();

		$table = 'brands';
		$where = array('id' => $id);
		$brands = $this->user_model->get_common($table, $where);

		$data = array('brands' => $brands);
		$data['active_menu'] = 'project';

		$this->load->view('admin/brand_details', $data);
	}	
	
	function add_brand(){
		$this->check_login();
		$table = 'brands';
		$where = array('status_id !=' => 0);
		$group_by = '';
		$brands = $this->user_model->get_common($table, $where,'*',2, '', $group_by);

		$data = array('brands' => $brands);
		$data['active_menu'] = 'category';
		$this->load->view('admin/add_brand', $data);
	}
	
	function save_brand(){
		error_reporting(0);

		$this->form_validation->set_rules ( 'name', 'Brand Name', 'required' );

		if ($_FILES ["image"] ["name"] == "") {
			$this->form_validation->set_rules ( "image", "Upload  Brand Image", "required" );
		}

		$config ['upload_path'] = './site_data/uploads/brands/';
		$config ['allowed_types'] = 'jpeg|jpg|png';
		//$config ['max_size'] = 2048;
		$config ['file_name'] = uniqid ( "brand_" );
		$this->upload->initialize ( $config );
		
		if($this->form_validation->run()==false || $this->upload->do_upload('image') == FALSE){
			$this->add_brand();
		}else{
			$upload_data = $this->upload->data ();
			$uploaded_file_name=$upload_data['file_name'];

			$insert_data = array(
				'name'	=>	$_POST['name'],
				'image'	=>	$uploaded_file_name,
				'created_by'	=>	$_SESSION['profile']->id,
			);

			$table = 'brands';
			$this->user_model->save_common($table, $insert_data);

			$this->session->set_flashdata("success_message","Image uploaded successfully.");
			redirect(base_url('admin/add_brand'));
		}	
	}
	
	function update_brand_status($status, $id){
		
		$table = 'brands';
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common($table, $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Brand deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/add_brand'));
	}
	
	function edit_brand($id){

		$table = 'brands';
		$where = array('id' => $id);
        $brands = $this->user_model->get_common($table, $where);

		$data['active_menu'] = 'category';
		$data['brands'] = $brands;
		$this->load->view('admin/edit_brand', $data);
	}

	function update_brand_details(){

		$this->form_validation->set_rules ( 'name', 'Brand Name', 'required' );
		
		if ($_FILES ["image"] ["name"] != "") {
			
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/brands/';
			$config ['allowed_types'] = 'jpeg|jpg|png';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "project_" );
			$this->upload->initialize ( $config );
		}

		if($_FILES ["image"] ["name"] != ""){
			if($this->upload->do_upload('image') == FALSE){
				$this->edit_brand($_POST['id']);
			}
		}
		if($this->form_validation->run()==false){

			$this->edit_brand($_POST['id']);
		}else{
			if($_FILES ["image"] ["name"] != ""){
				$upload_data = $this->upload->data();
				$uploaded_file_name=$upload_data['file_name'];
			}

			$update_data = array(
				'name'	=>	$_POST['name']
			);
			if($_FILES ["image"] ["name"] != ""){
				$update_data['image'] = $uploaded_file_name;
			}
			$table = 'brands';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Brand updated successfully.");
			redirect(base_url('admin/add_brand'));
		}
	}
	
	function add_discount(){
		$this->check_login();
		$data['active_menu'] = 'discount';
		$this->load->view('admin/add_discount', $data);
	}
	
	function add_refree_coupon(){
		$this->check_login();
		
		$table = 'coupon'; 
		$where = array('status !='=> 0, 'flag'=> 2 );
		$group_by = '';
		$order_by = 'id';
		$order1 = 'DESC';
		$dist = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);

		$data = array('discount' => $dist);
		$data['active_menu'] = 'discount';
		$this->load->view('admin/add_refree_coupon', $data);
	}
	
	function add_dealer_discount(){
		$this->check_login();
		$data['active_menu'] = 'dealer_discount';
		$this->load->view('admin/add_dealer_discount', $data);
	}
    
	function add_product(){
		$this->check_login();
		$group_by = '';
		$order_by = 'id';
		$order = 'ASC';
		
		$table = 'product_category';
		$where = array('status_id' => 1);
		$category = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		
		$table = 'product_subcategory';
		$where = array('status_id' => 1);
		$sub_category = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		      
		$table = 'flavour';
		$where = array('status_id' => 1);
		$flavour = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		      
		$table = 'goals';
		$where = array('status_id' => 1);
		$goals = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);

		$table = 'brands';
		$where = array('status_id' => 1);
		$brand = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		$order_by = 'product_id';
		$table = 'products';
		$where = array('status' => 1);
		$products = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		
		$data = array('products' => $products,'goals' => $goals,'flavour' => $flavour,'category' => $category,'sub_category' => $sub_category,'brand' =>$brand);
		$data['active_menu'] = 'product';
		$this->load->view('admin/add_product', $data);
	}
	
	function add_product_cat(){
		$this->check_login();

		$data['active_menu'] = 'product';
		$this->load->view('admin/add_product_cat', $data);
	}
	
	function add_gallery(){
		
		$this->check_login();
		$table = 'product_category';
		$where = array('status_id !=' => 0);
		$project_category = $this->user_model->get_common($table, $where,'*',2);
		$data = array('project_category'=> $project_category);
		$data['active_menu'] = 'gallery';
		$this->load->view('admin/add_gallery', $data);
	}
	
	function place_order(){
		$this->check_login();
		error_reporting(0);
		$table = 'products';
		$order_by='product_id';
		
		$wherebr = array('sub_category' => 1,'status' => 1);
		$group_bybr='child_category';
		$bracket_products = $this->user_model->get_common($table, $wherebr,'*',2,'',$group_bybr,$order_by);
		
		$wherebc = array('sub_category' => 6,'status' => 1);
		$group_bybc='child_category, product_type';
		$bracket_cover_products = $this->user_model->get_common($table, $wherebc,'*',2,'',$group_bybc,$order_by);
		
		$whereh = array('sub_category' => 2,'status' => 1);
		$group_byh='';
		$handril_products = $this->user_model->get_common($table, $whereh,'*',2,'',$group_byh,$order_by);
		
		$whereac = array('sub_category' => 3,'status' => 1);
		$group_byac='';
		$accessories_products = $this->user_model->get_common($table, $whereac,'*',2,'',$group_byac,$order_by);
		
		$wherest = array('sub_category' => 4,'status' => 1);
		$group_byst='';
		$steel_products = $this->user_model->get_common($table, $wherest,'*',2,'',$group_byst,$order_by);
		
		$wheregr = array('sub_category' => 5,'status' => 1);
		$group_bygr='';
		$glass_products = $this->user_model->get_common($table, $wheregr,'*',2,'',$group_bygr,$order_by);
		
		$table = 'product_category';
		$where = array('status_id' => 1);
		$category = $this->user_model->get_common($table, $where,'*',2);
      
		$table = 'product_childcategory';
		$where = array('status_id' => 1);
		$child_category = $this->user_model->get_common($table, $where,'*',2);
		
		$table = 'product_subcategory';
		$where = array('status_id' => 1);
		$sub_category = $this->user_model->get_common($table, $where,'*',2);
      
		$data = array('category' => $category,
					  'sub_category' => $sub_category,
					  'child_category' => $child_category,
					  'products' => $products,
					  'bracket_products' => $bracket_products,
					  'bracket_cover_products' => $bracket_cover_products,
					  'handril_products' => $handril_products,
					  'accessories_products' => $accessories_products,
					  'steel_products' => $steel_products,
					  'glass_products' => $glass_products,
					  'active_menu' => $orders
					 );
		$data['active_menu'] = 'order';			 
		$this->load->view('admin/place_order', $data);
	}

	function edit_ebrochure($id){

		$table = 'e_brochure';
		$where = array('ebook_id' => $id);
		$group_by = '';
		$order_by = 'ebook_id';
		$order = 'DESC';
		$e_brochure = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);

		$data['active_menu'] = 'e_brochure';
		$data['e_brochure'] = $e_brochure;
	
		$this->load->view('admin/edit_ebrochure', $data);
	}

	function edit_product($id){

		$table = 'products';
		$where = array('product_id' => $id);
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		$product = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);
        
		$group_byc = '';
		$order_byc = 'id';
		$orderc = 'ASC';
		$table = 'product_category';
		$where = array('status_id' => 1);
		$category = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);
      		
		$table = 'product_subcategory';
		$where = array('status_id' => 1,'product_cat_id'=>$product[0]->main_category);
		$sub_category = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);
		
		$table = 'flavour';
		$where = array('status_id' => 1);
		$flavour = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);
       
		$table = 'goals';
		$where = array('status_id' => 1);
		$goals = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);
        
		$table = 'product_images';
		$where = array('status' => 1,'product_id' => $id);
		$product_image = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);
        
		$table = 'brands';
		$where = array('status_id' => 1);
		$brand = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);

		$order_by = 'product_id';
		$table = 'products';
		$where = array('status' => 1);
		$products = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		
		$table = 'product_images';
		$where = array('status' => 1,'product_id' => $id);
		$product_image = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);
		
		$data = array('products' => $products,'goals' => $goals,'flavour' => $flavour,'category' => $category,'sub_category' => $sub_category,'brand' =>$brand,'product_image' =>$product_image);
		$data['active_menu'] = 'product';
		$data['product'] = $product;
	
		$this->load->view('admin/edit_product', $data);
	}
	
	function both_together($id){

		$table = 'products';
		$table1 = 'product_both_together';
		$where = array('product_id' => $id);


		$where1 = array('status !=' =>0,'main_product_id' => $id);
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		$product_both = $this->user_model->get_common($table1, $where1, '*', 2, '', $group_by, $order_by, $order);
		$product = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);
		$where = array('status !=' => 0);
		$products = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);
		$where = array('status !=' => 0,'free_flag'=>1);
		$products_free= $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);


		$data = array('products' => $products,'products_free' => $products_free);
		$data['active_menu'] = 'product';
		$data['product_both'] = $product_both;
		$data['product'] = $product;

		$this->load->view('admin/both_together', $data);
	}
	
	function update_product_both_together(){
		//$this->form_validation->set_rules ( 'product_id', 'product_id', 'required' );
		$this->form_validation->set_rules ( 'price', 'price', 'required' );
		$this->form_validation->set_rules ( 'offer_name', 'Offer Name', 'required' );
		// echo $product_id=$_POST['product_id'];print_r($product_id);exit;
		if($this->form_validation->run()==false ){

		$this->both_together($_POST['id']);
		}else{
		$id=$_POST['id'];
		$product_id=$_POST['product_id'];
		$offer_name=$_POST['offer_name'];
		$price=$_POST['price'];
		$free_product_id=$_POST['free_product_id'];
		$product_id1="";
		foreach ($product_id as $value) {
		$product_id1.=$value.",";
		}
		$product_id=rtrim($product_id1,',');

		$insert_data = array(
		'main_product_id'	=>$id,
		'product_id'	=>	$product_id,
		'name'	=>	$offer_name,
		'free_product_id'	=>	$free_product_id,
		'price'	=>	$price,
		'status'	=>	1
		);

		$table='product_both_together';
		$this->user_model->save_common($table, $insert_data);


		redirect(base_url('admin/both_together/'.$_POST['id']));
		}
	}
	
	// update both_together status
	function update_both_together_status($status, $id,$p_id){

		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('product_both_together', $where, $updateData);

		if($status == 0){
		$this->set_flashdata('success', 'Record deleted successfully.');
		}else{
		$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/both_together/'.$p_id));
	}
	
	//select both product
	function selectbothproduct(){
		
		$group_by = '';
		$order_by = '';
		$order = '';
		$where = array('status' => 1);
		$this->db->where_in('product_id', $_POST['id']);
		$product = $this->user_model->get_common('products', $where,'*',2, '', '', '');
		
		$data = array('product' => $product);
		$this->load->view('admin/selectbothproduct', $data);
	}
	
	 // selectbothproductremove
	function selectbothproductremove(){
		//echo $_POST['id'];
		$group_by = '';
		$order_by = '';
		$order = '';
		$where = array('status' => 1);
		$this->db->where_in('id', $_POST['id']);
		 $product = $this->user_model->delete_common('product_both_together', $where,'*',2, '', '', '');
		 
		 echo 1;
	}
	 
	function product_details(){
		$id=$_REQUEST['id'];
		$table = 'products';
		$where = array('product_id' => $id);
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		$product = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);
        
		$group_byc = '';
		$order_byc = 'id';
		$orderc = 'ASC';
		$table = 'product_category';
		$where = array('status_id' => 1);
		$category = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);
      		
		$table = 'product_subcategory';
		$where = array('status_id' => 1,'product_cat_id'=>$product[0]->main_category);
		$sub_category = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);
		
		$table = 'flavour';
		$where = array('status_id' => 1);
		$flavour = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);
        
		$table = 'product_images';
		$where = array('status' => 1,'product_id' => $id);
		$product_image = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);
        
		$table = 'brands';
		$where = array('status_id' => 1);
		$brand = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);

		$data = array('products' => $product,'product_image' => $product_image,'category' => $category,'sub_category' => $sub_category,'flavour' => $flavour,'brand' =>$brand);
		 
		$this->load->view('admin/product_details', $data);
	}

	function product_review($id){

		$this->check_login();

		$data['active_menu'] = 'product';
		$data['product_review'] = $this->user_model->get_common('rating', array('product_id' => $id, 'status !=' => 0),'*', 2);

		$this->load->view('admin/product_review', $data);
		
	}
	
	function update_review_status($status, $id, $product_id){
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('rating', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Product Review & Rating deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/product_review/'.$product_id));
	}
	
	function edit_gallery($id){

		$table = 'gallery';
		$where = array('id' => $id);
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		$gallery = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);
        
		$table = 'product_category';
		$where = array('status_id' => 1);
		$project_category = $this->user_model->get_common($table, $where,'*',2);
		
		$data['active_menu'] = 'gallery';
		$data['gallery'] = $gallery;
	    $data['project_category'] = $project_category;
		$this->load->view('admin/edit_gallery', $data);
	}
	
	function edit_statistics($id){

		$table = 'statistics';
		$where = array('id' => $id);

		$statistics = $this->user_model->get_common($table, $where);

		$data['active_menu'] = 'statistics';
		$data['statistics'] = $statistics;

		$this->load->view('admin/edit_statistics', $data);
	}
	
	function update_edit_dealer_discount(){

		$this->form_validation->set_rules ( 'start_date', 'Start Date', 'required' );
		$this->form_validation->set_rules ( 'end_date', ' End date', 'required' );
		$this->form_validation->set_rules ( 'udist', 'User Discount', 'required|numeric|max_length[2]' );
		//$this->form_validation->set_rules ( 'image_type', 'Make Cover Image', 'required' );
		//$this->form_validation->set_rules ( 'random_click', 'Display Gallary in Random Click', 'required' );
		
		if($this->form_validation->run()==false ){

			$this->edit_dealer_discount($_POST['id']);
		}else{
		 
			$sdate = explode('/', $_POST['start_date']);
			$sdate = $sdate[2].'-'.$sdate[0].'-'.$sdate[1];
			$edate = explode('/', $_POST['end_date']);
			$edate = $edate[2].'-'.$edate[0].'-'.$edate[1];
			 $update_data = array(
							//'product_number'	=>	$_POST['product_number'],
							'start_dt'	=>	$sdate,
							'end_dt'	=>	$edate,
							'dist'	=>	$_POST['udist'],
				            //'status'	=>	2,
						);
            $table = 'dealer_discount';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

            $this->session->set_flashdata("success_message","Dealer Discount update successfully.");
			redirect(base_url('admin/dealer_discount'));
			}	
		}
	
	function update_edit_ebrochure(){
		$this->form_validation->set_rules ( 'ebook_number', 'E-Book Number', 'required' );
		$this->form_validation->set_rules ( 'ebook_name', 'E-Book Name', 'required' );
		//$this->form_validation->set_rules ( 'ebook_qty', 'Quantity', 'required' );
		//$this->form_validation->set_rules ( 'price', 'price', 'required' );
		//$this->form_validation->set_rules ( 'offer_price', 'Offer price', 'required' );
		//$this->form_validation->set_rules ( 'ebook_desc', 'Description', 'required' );
		
		
		if ($_FILES ["image"] ["name"] != "") {
			
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/e_brochure/';
			$config ['allowed_types'] = 'jpeg|jpg|png';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "e_brochure_)" );
			$this->upload->initialize ( $config );
		}

		if ($_FILES ["pfd"] ["name"] != "") {
			
			/* upload config */
			$config1 ['upload_path'] = './site_data/uploads/e_brochure/';
			$config1 ['allowed_types'] = 'pdf';
			//$config ['max_size'] = 2048;
			$config1 ['file_name'] = uniqid ( "e_brochure_pdf_" );
			$this->upload->initialize ( $config1 );
		}

		if($_FILES ["image"] ["name"] != ""){
			if($this->upload->do_upload('image') == FALSE){
				$this->edit_ebrochure($_POST['id']);
			}
		}
		
		if($_FILES ["pfd"] ["name"] != ""){
			if($this->upload->do_upload('pfd') == FALSE){
				$this->edit_ebrochure($_POST['id']);
			}
		}
		
		if($this->form_validation->run()==false){

			$this->edit_ebrochure($_POST['id']);
		}else{
			if($_FILES ["image"] ["name"] != ""){
				$upload_data = $this->upload->data();
				$uploaded_file_name=$upload_data['file_name'];
			}
		        $where = array('id' => $id);
		//$updateData = array('status' => $status);

		//$this->user_model->update_common('e_brochure', $where, $updateData);

		//if($status == 0){
			$this->set_flashdata('success', 'statistics deleted successfully.');
		//}else{
		//	$this->set_flashdata('success', 'Status updated successfully.');
		//}

	//	redirect(base_url('admin/statistics'));	
			
			
			if($_FILES ["pfd"] ["name"] != ""){
				$upload_data1 = $this->upload->data();
				$uploaded_file_name1=$upload_data1['file_name'];
			}
			
           // date_default_timezone_set('Asia/Kolkata');
		    //$date=date('Y-m-d H:i:s'); 
			$update_data = array(
							'ebook_number'	=>	$_POST['ebook_number'],
							'ebook_name'	=>	$_POST['ebook_name'],
							//'quantity'	=>	$_POST['ebook_qty'],
							//'price'	=>	$_POST['price'],
							//'offer_price'	=>	$_POST['offer_price'],
						//	'description'	=>	$_POST['ebook_desc'],
						//	'updated_date'=>$date,
						);
			if($_FILES ["image"] ["name"] != ""){
				$update_data['image'] = $uploaded_file_name;
			}
			
			if($_FILES ["pfd"] ["name"] != ""){
				$update_data['ebook_file'] = $uploaded_file_name1;
			}
			
			$table = 'e_brochure';

			$where = array('ebook_id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","E-Brochure updated successfully.");
			redirect(base_url('admin/e_brochure'));
		}
		
	}
	
	function update_product_details()
	{
		//$this->form_validation->set_rules ('product_code', 'Product Code', 'required' );
		$this->form_validation->set_rules ( 'product_name', 'Product Name', 'required' );
		//$this->form_validation->set_rules ( 'product_desc', 'Product Remart', 'required' );
		$this->form_validation->set_rules ( 'price', 'Unit cost', 'required' );
		$this->form_validation->set_rules ( 'weight', 'weight', 'required' );
		//$this->form_validation->set_rules ( 'product_qty', 'Quantity', 'required|numeric' );
		//$this->form_validation->set_rules ( 'product_minqty', 'Min Quantity', 'required|numeric' );
		// $this->form_validation->set_rules ( 'gst', 'GST', 'required|max_length[15]' );
		$this->form_validation->set_rules ( 'main_category', 'Main Category', 'required' );
		//$this->form_validation->set_rules ( 'sub_category', 'Sub Category', 'required' );
		//$this->form_validation->set_rules ( 'child_category','Child Category', 'required' );
		$product_id = $_POST['id'];
		if ($_FILES ["image"] ["name"] != "") {
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/product/';
			$config ['allowed_types'] = 'jpeg|jpg|png';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "product" );
			$this->upload->initialize ( $config );
		}

		if($_FILES ["image"] ["name"] != ""){
			if($this->upload->do_upload('image') == FALSE){
				$this->edit_product($_POST['id']);
			}
		}

		if($this->form_validation->run()==false){
			$this->edit_product($_POST['id']);
		}else{

			$goals_id=0;
			if ($_POST['goals_id'] != "") {
				$goals_id=$_POST['goals_id'];
			}
			
			$free=0;
			if ($_POST['free'] != "") {
				$free=$_POST['free'];
			}

			date_default_timezone_set('Asia/Kolkata');
			$date=date('Y-m-d H:i:s'); 

			$related_product_id1="";
			foreach($_POST['related_product_id'] as $val){
				$related_product_id1.=$val.",";
			}
			$related_product_id=rtrim($related_product_id1,',');
			
			$update_data = array(
				'product_code'	=>	$_POST['product_code'],
				'product_name'	=>	$_POST['product_name'],
				'description'	=>	$_POST['product_desc'],
				'price'	=>	$_POST['price'],
				'offer_price'	=>	$_POST['offer_price'],
				'weight'	=>	$_POST['weight'],
				'goals_id'	=>	$goals_id,
				'key_highlights'	=>	$_POST['key_highlights'],
				'quantity'=> $_POST['product_qty'],
				'min_quantity'=> $_POST['product_minqty'],
				'gst'	=>	$_POST['gst'],
				'main_category'	=> $_POST['main_category'],
				'sub_category'	=>	$_POST['sub_category'],
				'brand_id' => $_POST['brand_category'],
				'flavour' => $_POST['flavour_id'],
				'description' => $_POST['product_desc'],
				'how_to_use' => $_POST['how_to_use'],
				'servings'=> $_POST['servings'],
				'size'=> $_POST['size'],
				'benefits'=> $_POST['benefits'],
				//'stack_with'=> $_POST['stack_with'],
				'stack_with'=> $related_product_id,
				'updated_date'=>$date,
				'free_flag'	=>	$free
				//'position'	=> time()
			);

			if($_FILES ["image"] ["name"] != "")
			{
				$target = "./site_data/uploads/product_profile/". @date(U)."_".( $_FILES['image']['name']); 
				//$targetp = "./site_data/uploads/product/". @date(U)."_".( $_FILES['image']['name']); 
				$image_name=@date(U)."_".( $_FILES['image']['name']);
				move_uploaded_file($_FILES['image']['tmp_name'], $target);	
				//copy($target, $targetp);

				$update_data['image'] = $image_name;
			}

			if($_FILES ["ingredients_image"] ["name"] != "")
			{
				$targetp = "./site_data/uploads/product/". @date(U)."_".( $_FILES['ingredients_image']['name']); 
				$ingredients_image=@date(U)."_".( $_FILES['ingredients_image']['name']);
				move_uploaded_file($_FILES['ingredients_image']['tmp_name'], $targetp);	
				$update_data['ingredients_image'] = $ingredients_image;
			}

			if($_FILES ["description_image"] ["name"] != "")
			{
				$targetp = "./site_data/uploads/product/". @date(U)."_".( $_FILES['description_image']['name']); 
				$description_image=@date(U)."_".( $_FILES['description_image']['name']);
				move_uploaded_file($_FILES['description_image']['tmp_name'], $targetp);	
				$update_data['description_image'] = $description_image;
			}

			if($_FILES ["benefits_image"] ["name"] != "")
			{
				$targetp = "./site_data/uploads/product/". @date(U)."_".( $_FILES['benefits_image']['name']); 
				$benefits_image=@date(U)."_".( $_FILES['benefits_image']['name']);
				move_uploaded_file($_FILES['benefits_image']['tmp_name'], $targetp);	
				$update_data['benefits_image'] = $benefits_image;
			}

			if($_FILES ["how_to_use_image"] ["name"] != "")
			{
				$targetp = "./site_data/uploads/product/". @date(U)."_".( $_FILES['how_to_use_image']['name']); 
				$how_to_use_image=@date(U)."_".( $_FILES['how_to_use_image']['name']);
				move_uploaded_file($_FILES['how_to_use_image']['tmp_name'], $targetp);	
				$update_data['how_to_use_image'] = $how_to_use_image;
			}

			$cnt = count($_FILES['pfd']['name']);
			if($_FILES ["pfd"] ["name"] != "" && $cnt > 1)
			{
				$table1 = 'product_images';
				$where = array('product_id' => $product_id);
				$this->user_model->delete_common($table1, $where);

				$cnt = count($_FILES['pfd']['name']);
				if($cnt<5)
				{
					$fcnt = count($_FILES['pfd']['name']);
				}else{
					$fcnt = 5;
				}

				for($i=0;$i<$fcnt;$i++)
				{
					$target_pfd = "./site_data/uploads/product/"; 
					$target_pfd1 =$target_pfd . @date(U)."_".( $_FILES['pfd']['name'][$i]);
					$pdf_name=@date(U)."_".( $_FILES['pfd']['name'][$i]);
					move_uploaded_file($_FILES['pfd']['tmp_name'][$i], $target_pfd1);	

					$insert_data1 = array(
						'product_id'=>	$product_id,
						'image_name'=>$pdf_name,
						'status'=>1
					);

					$this->user_model->save_common($table1, $insert_data1);	
				}
			}

			$table = 'products';
			$where = array('product_id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Product updated successfully.");
			redirect(base_url('admin/product'));
		}
	}
	
	function update_edit_gallery(){
		//$this->form_validation->set_rules ( 'product_number', 'Product Number', 'required' );
		$this->form_validation->set_rules ( 'product_name', 'Product Name', 'required' );
		$this->form_validation->set_rules ( 'category', 'Category', 'required' );
		//$this->form_validation->set_rules ( 'product_qty', 'Quantity', 'required' );
		//$this->form_validation->set_rules ( 'price', 'price', 'required' );
		//$this->form_validation->set_rules ( 'offer_price', 'Offer price', 'required' );
		//$this->form_validation->set_rules ( 'product_desc', 'Description', 'required' );
		
		
		if ($_FILES ["image"] ["name"] != "") {
			
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/gallery/';
			$config ['allowed_types'] = 'jpeg|jpg|png';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "gallery_" );
			$this->upload->initialize ( $config );
		}

		
		if($_FILES ["image"] ["name"] != ""){
			if($this->upload->do_upload('image') == FALSE){
				$this->edit_gallery($_POST['id']);
			}
		}
		
		
		
		if($this->form_validation->run()==false){

			$this->edit_gallery($_POST['id']);
		}else{
			if($_FILES ["image"] ["name"] != ""){
				$upload_data = $this->upload->data();
				$uploaded_file_name=$upload_data['file_name'];
			}
			
			
           // date_default_timezone_set('Asia/Kolkata');
		   // $date=date('Y-m-d H:i:s'); 
			$update_data = array(
							//'product_number'	=>	$_POST['product_number'],
							'title'	=>	$_POST['product_name'],
				            'category'	=>	$_POST['category'],
							//'quantity'	=>	$_POST['product_qty'],
							//'price'	=>	$_POST['price'],
							//'offer_price'	=>	$_POST['offer_price'],
							//'description'	=>	$_POST['product_desc'],
							//'updated_date'=>$date,
						);
			if($_FILES ["image"] ["name"] != ""){
				$update_data['image'] = $uploaded_file_name;
			}
			
			
			$table = 'gallery';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Gallery updated successfully.");
			redirect(base_url('admin/gallery'));
		}
		
	}
	
	function update_statistics_details(){

		 $this->form_validation->set_rules('lables','Labels','required');
		 $this->form_validation->set_rules('counts','Counts','required');
		
	
		if($this->form_validation->run()==false){

			$this->edit_statistics($_POST['id']);
		}else{
			
			$update_data = array(
							'lables'	=>	$_POST['lables'],
							'counts'	=>	$_POST['counts'],
						);
			
			$table = 'statistics';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Statistics updated successfully.");
			redirect(base_url('admin/statistics'));
		}
	}
	
	function services(){
		$this->check_login();

		$table = 'services';
		$where = array('status_id !=' => 0);
		$group_by = '';
		$order_by = '';
		$order = '';
		 
		$services = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order);

		$data = array('services' => $services);
		$data['active_menu'] = 'services';

		$this->load->view('admin/services', $data);
	}
	
	function add_services(){
		$this->check_login();
		$group_by = '';
		$order_by = 'id';
		$order = 'ASC';
		
		$table = 'product_category';
		$where = array('status_id' => 1);
		$category = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		
		$table = 'product_subcategory';
		$where = array('status_id' => 1);
		$sub_category = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		      
		$table = 'product_childcategory';
		$where = array('status_id' => 1);
		$child_category = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		
		$table = 'brands';
		$where = array('status_id' => 1);
		$brand = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		
		$data = array('category' => $category,'sub_category' => $sub_category,'child_category' => $child_category,'brand' =>$brand);
		
		$data['active_menu'] = 'services';
		$this->load->view('admin/add_services', $data);
	}
	
	function save_services(){
		error_reporting(0);
		$this->form_validation->set_rules ( 'product_name', 'Services Name', 'required' );
		$this->form_validation->set_rules ( 'main_category', 'Main Category', 'required' );
		
		if ($_FILES ["image"] ["name"] == "") {
			$this->form_validation->set_rules ( "image", "Service Image", "required");
		} 

	    /* upload config */
		$config ['upload_path'] = './site_data/uploads/services/';
		$config ['allowed_types'] = 'jpeg|jpg|png';
		//$config ['max_size'] = 2048;
		$config ['file_name'] = uniqid ( "product_" );
		$this->upload->initialize ( $config );
		
		if($this->form_validation->run()==false || $this->upload->do_upload('image') == FALSE){
			$this->add_services();
		}else{
			$upload_data = $this->upload->data();
			$uploaded_file_name=$upload_data['file_name'];

			$insert_data = array(
				'name'	=>	$_POST['product_name'],
				'description'	=>	$_POST['product_desc'],
				'image'	=> $uploaded_file_name,
				'main_category'	=> $_POST['main_category'],
				'sub_category'	=>	$_POST['sub_category'],
				'child_category'	=> '',
				'brand_id'=> '',
				'position'	=> '',
				'added_by'	=>	$_SESSION['profile']->id,
				'status_id'	=>	1,
			);

			$table = 'services';
			
			$this->user_model->save_common($table, $insert_data);
			
			$this->session->set_flashdata("success_message","Services uploaded successfully.");
			redirect(base_url('admin/services'));

		}
	}
	
	function edit_service($id){

		$table = 'services';
		$where = array('id' => $id);
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		$services = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);
        
		$group_byc = '';
		$order_byc = 'id';
		$orderc = 'ASC';
		$table = 'product_category';
		$where = array('status_id' => 1);
		$category = $this->user_model->get_common($table, $where,'*',2, '', $group_byc, $order_byc, $orderc);

		$data = array('category' => $category);
		$data['active_menu'] = 'services';
		$data['services'] = $services;
	
		$this->load->view('admin/edit_services', $data);
	}
	
	function update_service(){
		$this->form_validation->set_rules ( 'product_name', 'Service Name', 'required' );
		$this->form_validation->set_rules ( 'main_category', 'Main Category', 'required' );
		
		if ($_FILES ["image"] ["name"] != "") {
			
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/services/';
			$config ['allowed_types'] = 'jpeg|jpg|png';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "services" );
			$this->upload->initialize ( $config );
		}

		if($_FILES ["image"] ["name"] != ""){
			if($this->upload->do_upload('image') == FALSE){
				$this->edit_product($_POST['id']);
			}
		}

		if($this->form_validation->run()==false){

			$this->edit_product($_POST['id']);
		}else{
			if($_FILES ["image"] ["name"] != ""){
				$upload_data = $this->upload->data();
				$uploaded_file_name=$upload_data['file_name'];
			}

            date_default_timezone_set('Asia/Kolkata');
		    $date=date('Y-m-d H:i:s'); 
				$update_data = array(
					'name'	=>	$_POST['product_name'],
					'description'	=>	$_POST['product_desc'],
					'main_category'	=> $_POST['main_category'],
					'sub_category'	=>	$_POST['sub_category'],
					'updated_date'=>$date,
				);
				if($_FILES ["image"] ["name"] != ""){
					$update_data['image'] = $uploaded_file_name;
				}

			$table = 'services';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Service updated successfully.");
			redirect(base_url('admin/services'));
		}	
	}
	
	function update_service_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('services', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Service deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/services'));
	}
	
	function product_position($position, $id){
		
		$table = 'products';
		$where = array('product_id' => $id);
		$updateData = array('position' => $position);

		$this->user_model->update_common($table, $where, $updateData);

		if($position == 0){
			$this->set_flashdata('success', 'product Not Sale.');
		}else{
			$this->set_flashdata('success', 'Product On Sale');
		}

		redirect(base_url('admin/product'));
	}
	
	function save_product(){
			//error_reporting(0);
			$this->form_validation->set_rules ( 'product_name', 'Product Name', 'required' );
			//$this->form_validation->set_rules ( 'product_code', 'Product Code', 'required' );
			//$this->form_validation->set_rules ( 'product_desc', 'Product Remark', 'required' );
			$this->form_validation->set_rules ( 'price', 'Unit Cost', 'required|numeric' );
			//$this->form_validation->set_rules ( 'offer_price', 'Offer_Price', 'required' );
			//$this->form_validation->set_rules ( 'product_minqty', 'Min Quantity', 'required|numeric' );
			$this->form_validation->set_rules ( 'gst', 'GST', 'required' );
			$this->form_validation->set_rules ( 'main_category', 'Main Category', 'required' );
			$this->form_validation->set_rules ( 'brand_category', 'Brand Category', 'required' );
			$this->form_validation->set_rules ( 'product_qty', 'Product Quantity', 'required' );
			//$this->form_validation->set_rules ( 'child_category','Child Category', 'required' );

			if ($_FILES ["image"] ["name"] == "") {
			$this->form_validation->set_rules ( "image", "Upload Image", "required" );
			} 

			/* upload config */
			$config ['upload_path'] = './site_data/uploads/product/';
			$config ['allowed_types'] = 'jpeg|jpg|png';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "product_" );
			$this->upload->initialize ( $config );

			if($this->form_validation->run()==false || $this->upload->do_upload('image') == FALSE){

			$this->add_product();

			}else{

			$image_name="";
			$goals_id=0;
			if ($_POST['goals_id'] != "") {
			$goals_id=$_POST['goals_id'];
			}
			$free=0;
			if ($_POST['free'] != "") {
			$free=$_POST['free'];
			}
			if ($_FILES ["image"] ["name"] != "") {
			$target = "./site_data/uploads/product_profile/"; 
			$target1 =$target . @date(U)."_".( $_FILES['image']['name']);
			$image_name=@date(U)."_".( $_FILES['image']['name']);
			move_uploaded_file($_FILES['image']['tmp_name'], $target1);	
			}

			$ingredients_image="";
			if ($_FILES ["ingredients_image"] ["name"] != "") {
			$target = "./site_data/uploads/product/"; 
			$target1 =$target . @date(U)."_".( $_FILES['ingredients_image']['name']);
			$ingredients_image=@date(U)."_".( $_FILES['ingredients_image']['name']);
			move_uploaded_file($_FILES['ingredients_image']['tmp_name'], $target1);	
			}
			
			$description_image="";
			if ($_FILES ["description_image"] ["name"] != "") {
			$target = "./site_data/uploads/product/"; 
			$target1 =$target . @date(U)."_".( $_FILES['description_image']['name']);
			$description_image=@date(U)."_".( $_FILES['description_image']['name']);
			move_uploaded_file($_FILES['description_image']['tmp_name'], $target1);	
			}
			
			$how_to_use_image="";
			if ($_FILES ["how_to_use_image"] ["name"] != "") {
			$target = "./site_data/uploads/product/"; 
			$target1 =$target . @date(U)."_".( $_FILES['how_to_use_image']['name']);
			$how_to_use_image=@date(U)."_".( $_FILES['how_to_use_image']['name']);
			move_uploaded_file($_FILES['how_to_use_image']['tmp_name'], $target1);	
			}
			
			$benefits_image="";
			if ($_FILES ["benefits_image"] ["name"] != "") {
			$target = "./site_data/uploads/product/"; 
			$target1 =$target . @date(U)."_".( $_FILES['benefits_image']['name']);
			$benefits_image=@date(U)."_".( $_FILES['benefits_image']['name']);
			move_uploaded_file($_FILES['benefits_image']['tmp_name'], $target1);	
			}


			$related_product_id1="";
			foreach($_POST['related_product_id'] as $val){
				$related_product_id1.=$val.",";
			}
			 
			$related_product_id=rtrim($related_product_id1,',');

			$insert_data = array(
			'product_code'	=>	$_POST['product_code'],
			'product_name'	=>	$_POST['product_name'],
			'description'	=>	$_POST['product_desc'],
			'how_to_use'	=>	$_POST['how_to_use'],
			'key_highlights'	=>	$_POST['key_highlights'],
			'weight'	=>	$_POST['weight'],
			'goals_id'	=>	$goals_id,
			'price'	=>	$_POST['price'],
			'offer_price'	=>	$_POST['offer_price'],
			'image'	=> $image_name,
			'ingredients_image'	=> $ingredients_image,
			'description_image'	=> $description_image,
			'benefits_image'	=> $benefits_image,
			'how_to_use_image'	=> $how_to_use_image,
			'gst'	=>	$_POST['gst'],
			'main_category'	=> $_POST['main_category'],
			'sub_category'	=>	$_POST['sub_category'],
			'flavour'	=> $_POST['flavour_id'],
			'brand_id'=> $_POST['brand_category'],
			'quantity'=> $_POST['product_qty'],
			'min_quantity'=> $_POST['product_minqty'],
			'servings'=> $_POST['servings'],
			'size'=> $_POST['size'],
			'benefits'=> $_POST['benefits'],
			//'stack_with'=> $_POST['stack_with'],
			'stack_with'=> $related_product_id,
			'product_type'	=> '',
			'position'	=> 0,
			'added_by'	=>	$_SESSION['profile']->id,
			'status'	=>	1,
			'free_flag'	=>	$free
			);

			$table = 'products';
			$this->user_model->save_common($table, $insert_data);
			$last_product_id = $this->db->insert_id();
			$product_id = $this->db->insert_id();

			if ($_FILES ["productimages"] ["name"] != "") {
			$cnt = count($_FILES['productimages']['name']);
			if($cnt<5)
			{
			$fcnt = count($_FILES['productimages']['name']);
			}else{
			$fcnt = 5;
			}
			for($i=0;$i<$fcnt;$i++)
			{
			if($_FILES['productimages']['name'][$i]){
			$target_pfd = "./site_data/uploads/product/"; 
			$target_pfd1 =$target_pfd . @date(U)."_".( $_FILES['productimages']['name'][$i]);
			$pdf_name=@date(U)."_".( $_FILES['productimages']['name'][$i]);
			move_uploaded_file($_FILES['productimages']['tmp_name'][$i], $target_pfd1);	

			$insert_data1 = array(
			'product_id'=>	$product_id,
			'image_name'=>$pdf_name,
			'status'=>1
			);

			$table1 = 'product_images';
			$this->user_model->save_common($table1, $insert_data1);
			}
			}
			}

			$this->session->set_flashdata("success_message","Product uploaded successfully.");
			redirect(base_url('admin/product'));

			}
	 }
	
	function save_gallery(){
		
		$this->form_validation->set_rules ( 'product_name', 'Image Name', 'required' );
	    $this->form_validation->set_rules ( 'category', 'Category', 'required' );
		$this->form_validation->set_rules ( "image", "Gallary Image", "required" );
		
		if ($_FILES ["image"] ["name"] == "") {
			$this->form_validation->set_rules ( "image", "Upload Image", "required" );
		}

		for($i=0;$i<count($_FILES['image']['name']);$i++)

		{
		$target = "./site_data/uploads/gallery/"; 
		$target1 =$target . @date(U)."_".( $_FILES['image']['name'][$i]);
		$image_name=@date(U)."_".( $_FILES['image']['name'][$i]);
		move_uploaded_file($_FILES['image']['tmp_name'][$i], $target1);	
		
        
		if($this->form_validation->run()==false){

			$this->add_gallery();
		}else{
			// $upload_data = $this->upload->data();
			 //$uploaded_file_name=$upload_data['file_name'];
		    //date_default_timezone_scouponet('Asia/Kolkata');
		    //$date=date('Y-m-d H:i:s'); 
			 $insert_data = array(
							
							'title'	=>	$_POST['product_name'],
							'image'	=>	$image_name,
				            'category' => $_POST['category'],
							'created_by'	=>	$_SESSION['profile']->id,
							'status_id'	=>	1,
						);

			$table = 'gallery';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Gallery uploaded successfully.");
			redirect(base_url('admin/gallery'));
		}
		}
	}
	
		
	function save_dealer_discount(){
		
		//$this->form_validation->set_rules ( 'product_number', 'Product Name', 'required' );
		$this->form_validation->set_rules ( 'start_date', 'select start date', 'required' );
		$this->form_validation->set_rules ( 'end_date', 'select end date', 'required' );
		$this->form_validation->set_rules ( 'udist', 'user discount', 'required|numeric|max_length[2]' );
		//$this->form_validation->set_rules ( 'offer_price', 'Offer_Price', 'required' );
		//$this->form_validation->set_rules ( 'product_qty', 'Quantity', 'required' );
		
		if($this->form_validation->run()==false ){

			$this->add_discount();
		}else{
			$sdate = explode('/', $_POST['start_date']);
			$sdate = $sdate[2].'-'.$sdate[0].'-'.$sdate[1];
			$edate = explode('/', $_POST['end_date']);
			$edate = $edate[2].'-'.$edate[0].'-'.$edate[1];
			$insert_data = array(
				//'product_number'	=>	$_POST['product_number'],
				'start_dt'	=>	$sdate,
				'end_dt'	=>	$edate,
				'dist'	=>	$_POST['udist'],
				'status'	=>	2,
			);

			$table = 'dealer_discount';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Dealer Discount added successfully.");
			redirect(base_url('admin/dealer_discount'));
		}
	}
		
    
  
  function update_dealer_discount($status,$id){
	
	    $where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('dealer_discount', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Discount deleted successfully.');
		}
		else if($status == 1){

			$where = array('id !=' => $id);
			$updateData = array('status' => 2); //make other discount inactive
			$this->user_model->update_common('dealer_discount', $where, $updateData);

			$this->set_flashdata('success', 'Status updated successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/dealer_discount'));

  }
	
	function edit_dealer_discount($id){

		$table = 'dealer_discount';
		$where = array('id' => $id);

		$discount = $this->user_model->get_common($table, $where);

		$data['active_menu'] = 'dealer_discount';
		$data['discount'] = $discount;

		$this->load->view('admin/edit_dealer_discount', $data);
	}
	
	
	function blogs(){
		$this->check_login();

		$table = 'blogs';
		$where = array('status_id !=' => 3); // 3- deleted
		
		$blogs = $this->user_model->get_common($table, $where,'*',2);

		$data = array('blogs' => $blogs);
		$data['active_menu'] = 'blogs';

		$this->load->view('admin/blogs', $data);
	}

	function add_blogs(){

		$this->check_login();
		
		$table = 'blog_category';
		$where = array('status_id !=' => 0);
		$category = $this->user_model->get_common($table, $where,'*',2);
       // print_r($category);
		$data = array('category' => $category);

		$data['active_menu'] = 'blogs';

		$this->load->view('admin/add_blogs', $data);
		
	}
	
	function add_keyword(){

		$this->check_login();
		
		$table = 'keyword';
		$where = array('status_id !=' => 0);
		$keyword = $this->user_model->get_common($table, $where,'*',2);
       // print_r($category);
		$data = array('keyword' => $keyword);

		$data['active_menu'] = 'blogs';

		$this->load->view('admin/add_keyword', $data);
		
	}
	
	function add_testimonial(){

		$this->check_login();

		$data['active_menu'] = 'testimonial';

		$this->load->view('admin/add_testimonial', $data);
		
	}
	
	
	function save_keyword(){

		$this->form_validation->set_rules ( 'keyword', 'Keyword', 'required' );
		$date = date("Y-m-d");  
		
		if($this->form_validation->run()==false){
			$this->keyword();
			
		}else{
			$insert_data = array(
							'keyword'	=>	ucfirst($_POST['keyword']),
							'status_id'	=>	1,
							'created_date'	=>	$date,
							'created_by'	=>	$_SESSION['profile']->id,
						);

			$table = 'keyword';

			$this->user_model->save_common($table, $insert_data);
 
			$this->session->set_flashdata("success_message","Keyword added successfully.");
			redirect(base_url('admin/keyword'));
		}
	}
	
	function keyword(){

		$table = 'keyword';
		$where = array('status_id !=' => 0);
		$keywords = $this->user_model->get_common($table, $where,'*',2);

		$data = array('keywords' => $keywords);
		$data['active_menu'] = 'stories';
		$this->load->view('admin/keyword', $data);
		
	}
	
	function gallery(){

		$table = 'gallery';
		$where = array('status_id !=' => 0);
		$gallery = $this->user_model->get_common($table, $where,'*',2);

		$data = array('gallery' => $gallery);
		$data['active_menu'] = 'gallery';
		$this->load->view('admin/gallery', $data);
		
	}
	
	function update_keyword_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('keyword', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Story deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/keyword'));
	}
	
	function delete_keyword($id){
		$this->db->query("delete from keyword where id='$id'");
		redirect(base_url('admin/keyword'));
	}
	
	
	function edit_keyword($id){

		$table = 'keyword';
		$where = array('id' => $id);

		$keyword = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'keyword';
		$data['keyword'] = $keyword;

		$this->load->view('admin/edit_keyword', $data);
	}

   function edit_blog_category($id){

		$table = 'blog_category';
		$where = array('id' => $id);

		$category = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'blogs';
		$data['category'] = $category;

		$this->load->view('admin/edit_blog_category', $data);
	}
	
  function edit_blog_keyword($id){

		$table = 'keyword';
		$where = array('id' => $id);

		$keyword = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'blogs';
		$data['keyword'] = $keyword;

		$this->load->view('admin/edit_blog_keyword', $data);
	}
   
	function update_keyword(){

		$this->form_validation->set_rules ( 'keyword', 'Keyword', 'required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_keyword($_POST['id']);
		}else{
			 
			$date = date("Y-m-d");

			$update_data = array(
							'keyword'	=>	$_POST['keyword'],
							'updated_date'	=>	$date,
							'updated_by'	=>	$_SESSION['profile']->id,
						);
			 
			$table = 'keyword';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Keyword updated successfully.");
			redirect(base_url('admin/keyword'));
		}
	}

	function blogs_details($id){

		$this->check_login();

		$data['active_menu'] = 'blogs';
		$data['blogs_details'] = $this->user_model->get_common('blogs', array('id' => $id));

		$this->load->view('admin/blogs_details', $data);
		
	}

	function view_comments($id){

		$this->check_login();

		$data['active_menu'] = 'blogs';
		$data['blog_comments'] = $this->user_model->get_common('blog_comments', array('blog_id' => $id, 'status_id !=' => 0),'*', 2);

		$this->load->view('admin/blog_comments', $data);	
	}
	
	//appointment / Tal to an experts list
	function appointment(){
		$this->check_login();

		$table = 'book_appointment';
		$where = array('status_id !=' => 0);
		$appointment = $this->user_model->get_common($table, $where,'*',2);

		$data = array('appointment' => $appointment);
		$data['active_menu'] = 'appointment';

		$this->load->view('admin/appointment', $data);
	}	
	
	//assign_expert
	function assign_expert($id=''){
		$this->check_login();

		$table = 'book_appointment';
		$where = array('status_id !=' => 0,'id' =>$id);
		$appointment = $this->user_model->get_common($table, $where,'*',2);
		$table = 'user';
		$where = array('flag' =>2);
		$expert = $this->user_model->get_common($table, $where,'*',2);

		$data = array('appointment' => $appointment,'expert' => $expert);
		$data['active_menu'] = 'appointment';

		$this->load->view('admin/assign_expert', $data);
	}
	
	//submit_assign_expert
	function submit_assign_expert(){
		
		$this->form_validation->set_rules ( 'expert_id', 'Expert', 'required' );
	    //$this->form_validation->set_rules ( 'name', 'name', 'required' );
		
		if($this->form_validation->run()==false){
			$this->assign_expert($_POST['id']);
		}else{
			
			$updateData = array( 'expert_id' =>	$_POST['expert_id'] );
			$where = array('id' => $_POST['id']); 
			$this->user_model->update_common('book_appointment', $where, $updateData);
		
			$this->session->set_flashdata("success_message","Expert assigned successfully.");
			redirect(base_url('admin/appointment'));
		}
	}	
		
	// update Appointment status
	function update_appoinment_status($status, $id){
		
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('book_appointment', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Talk with expert topic deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/appointment'));
	}
			
	// update Appointment status
	function close_chat_cust($id){
		
		$where = array('id' => $id);
		$updateData = array('status_id' => 2);

		$this->user_model->update_common('book_appointment', $where, $updateData);
		$this->set_flashdata('success', 'Talk with expert topic closed successfully.');
		redirect(base_url('admin/dashboard'));
	}
		
	// update Appointment status
	public function start_chat_cust($id=''){
		
		$this->check_login();
		$table = 'book_appointment';
		$where = array('id'=>$id);
		$group_by = '';
		$order_by = 'id';
		$order1 = 'DESC';
		$guest_user = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order1);
		$topic_id = $guest_user[0]->id; 
		//$wherec = array('msg_to'=>$_SESSION['guest_user']->contact);
		$wherec = array('topic_id'=>$topic_id);
		$whereu = array();
		$order_byc = 'id';
		$orderc = 'ASC';
		
		$chat = $this->user_model->get_common('chat', $wherec,'*',2, '', $group_by, $order_byc, $orderc);
		$user_list = $this->user_model->get_common('user', $whereu,'*',2, '','','','');
		$users_ids=array();
		
		for($i=0;$i<count($user_list);$i++){
			array_push($users_ids,$user_list[$i]->id);	
		}

		$data = array('guest_user'=>$guest_user, 'chat'=>$chat, 'users_ids'=>$users_ids);

		$data['active_menu'] = 'dashboard';
		$this->load->view('admin/start_chat_cust', $data);
	}
	
	// refresh chat
	public function chat_refresh(){
		$group_by = '';
		$topic_id = $_POST['id'];
		//$wherec = array('msg_to'=>$_SESSION['guest_user']->contact);
		$wherec = array('topic_id'=>$topic_id);
		$whereu = array();
		$order_byc = 'id';
		$orderc = 'ASC';
		
		$chat = $this->user_model->get_common('chat', $wherec,'*',2, '', $group_by, $order_byc, $orderc);
		$user_list = $this->user_model->get_common('user', $whereu,'*',2, '','','','');
		$users_ids=array();
		
		for($i=0;$i<count($user_list);$i++){
			array_push($users_ids,$user_list[$i]->id);			
		}
		
		$data = array('chat'=>$chat, 'users_ids'=>$users_ids);
		$this->load->view('admin/chat_refresh', $data);
	}
	
	// send reply on talk to an expert request
	public function send_message(){
		
		$this->load->helper('custom');
    	$this->form_validation->set_rules ( 'message', 'Message', 'required');
	
    	if($this->form_validation->run()==false){
			
			$this->start_chat_cust($_POST['topic_id']);
			
    	}else{

			$topic_id = $_POST['topic_id'];
			$message = trim($_POST['message']);
			 
			$table = 'book_appointment';
			$where = array('id'=>$topic_id);
			$group_by = '';
			$order_by = 'id';
			$order1 = 'DESC';
			$guest_user = $this->user_model->get_common($table, $where,'*',1, '', $group_by, $order_by, $order1);
			
			if(count($guest_user)>0){
				
				$topic_id = $guest_user->id;
				$msg_to = $guest_user->contact;
				$to_name = $guest_user->name;
				$email = $guest_user->email;

				$from_name = get_experts_name($_SESSION['profile']->id);
				
				// msg count for check admin/expert replied or not
				$wherec = array('topic_id'=>$topic_id, 'msg_to' => $msg_to);
				$order_byc = 'id';
				$orderc = 'ASC';
				$chat = $this->user_model->get_common('chat', $wherec,'*',2, '', $group_by, $order_byc, $orderc);
				if(count($chat)>0){
					
				}else{
					
					$view_reply_link = base_url('talk_with_experts');
					
					$smsmessage = "Dear ".$to_name.
					",\n\nYou can view admin/expert reply on your request, by clicking on given link: ".$view_reply_link.
					"\n\nThank You, \n".email_from_name;					
					$this->send_sms($msg_to, $smsmessage);
						
					$subject = 'Admin/Expert replied on your request';
					$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px;font-size: 16px; font-weight: 300; color: #444'>
						Dear ".$to_name.",
						<p>
							Admin/Expert replied on your talk to an expert request.<br><br>
							You can view admin/expert reply on your request, by clicking on following link: <br>
							<a href=".$view_reply_link.">".$view_reply_link.".pdf</a><br>
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

				$insert_data = array(
					'topic_id' => $topic_id,
					'assign_id' => $topic_id,
					'msg_from' => $_SESSION['profile']->id,
					'from_name' => $from_name,
					'msg_to' => $msg_to,
					'to_name' => $to_name,
					'message' => $message
				);
				$tablec = 'chat';
				$this->user_model->save_common($tablec, $insert_data);
				
				echo 1;
		 
			}else{
				//$this->session->set_flashdata("error_message","There is no any previous chat record!<br> Start a new chat.");
				//redirect(base_url('admin/start_chat_cust/'.$topic_id));
			 
			}
    	}
	}
	
    //get Appointment user list for send email
	function getappointmentuserMails(){
		$this->check_login();
		$id=$_POST['id'];
		if($id !=="0"){
			$where = array('status_id' => 1,'id'=>$id);
		}
		else{
		$where = array('status_id' => 1);
		}
		$table = 'book_appointment';
		$user_list = $this->user_model->get_common($table, $where,'*',2,'','email');

		$data = array('user_list' => $user_list);
		
		$this->load->view('admin/get_user_lists', $data);
	}
	
	//get Appointment user mobile list for send text message
	public function getappointmentuserContacts(){
		$this->check_login();
		 $id=$_POST['all_users'];
         if( $id=="0"){
		   $where = array('status_id' => 1);
		 }
        else{
	       $where = array('status_id' => 1,'id'=>  $id);
	    }		 
		$table = 'book_appointment';
		$user_list = $this->user_model->get_common($table, $where,'*',2,'','contact');

		$data = array('user_list' => $user_list);
		
		$this->load->view('admin/get_usermobile_list', $data);
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
	 
	function save_blogs(){

		//$this->form_validation->set_rules ( 'category', 'Category', 'required' );
		$this->form_validation->set_rules ( 'story_by', 'Blog By', 'required' );
		$this->form_validation->set_rules ( 'category', 'Category', 'required' );
		$this->form_validation->set_rules ( 'title', 'Title', 'required' );
		//$this->form_validation->set_rules ( 'summary', 'Summary', 'required' );
		$this->form_validation->set_rules ( 'date', 'Date', 'required' );
		$this->form_validation->set_rules ( 'story', 'story', 'required' );
        if (empty($_FILES['image']['name']) && empty($_FILES['video']['name']))
		{
			$this->form_validation->set_rules('image', 'Upload Image', 'required');
		}
		if ($_FILES ["image"] ["name"] != "") {
			
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/blogs/';
			$config ['allowed_types'] = 'jpeg|jpg|jfif|exif|tiff|bmp|png|bgp|mp4|3gp|wmv|ogg|webm|flv|avi|hdv|mpeg|wav|vob|ogv|gif|gifv|mng|mkv|drc|MTS|M2TS|mov|qt|yuv|rm|rmvb|asf|amv|m4p|m4v|mpg|mp2|mpe|mpv|m2v|svi|3g2|mxf|roq|nsv|f4v|f4p|f4a|f4b';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "blog_" );
			$this->upload->initialize ( $config );
		}else if ($_FILES ["video"] ["name"] != "") {
			
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/blogs/';
			$config ['allowed_types'] = 'jpeg|jpg|jfif|exif|tiff|bmp|png|bgp|mp4|3gp|wmv|ogg|webm|flv|avi|hdv|mpeg|wav|vob|ogv|gif|gifv|mng|mkv|drc|MTS|M2TS|mov|qt|yuv|rm|rmvb|asf|amv|m4p|m4v|mpg|mp2|mpe|mpv|m2v|svi|3g2|mxf|roq|nsv|f4v|f4p|f4a|f4b';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "blog_" );
			$this->upload->initialize ( $config );
		}


		if($_FILES ["image"] ["name"] != ""){
			if($this->upload->do_upload('image') == FALSE){
				$this->add_blogs();
			}
		}else if($_FILES ["video"] ["name"] != ""){
			if($this->upload->do_upload('video') == FALSE){
				$this->add_blogs();
			}
		}
		if($this->form_validation->run()==false){

			$this->add_blogs();
		}else{
			if($_FILES ["image"] ["name"] != ""){
				$upload_data = $this->upload->data();
				$uploaded_file_name=$upload_data['file_name'];
			}else if($_FILES ["video"] ["name"] != ""){
				$upload_data = $this->upload->data();
				$uploaded_file_name=$upload_data['file_name'];
			}

			//$upload_data = $this->upload->data();
			//$uploaded_file_name=$upload_data['file_name'];
			$summary = substr($_POST['story'], 0, 500);
			/* $date = explode('/', $_POST['date']);
			$date = $date[2].'-'.$date[0].'-'.$date[1]; */

			$insert_data = array(
				'category'	=>	$_POST['category'],
				'story_by'	=>	$_POST['story_by'],
				'title'	=>	$_POST['title'],
				'summary'	=>	$summary,
				'date'	=>	$_POST['date'],
				'image'	=>	$uploaded_file_name,
				'story'	=>	$_POST['story'],
				//'story'	=>	$_POST['story'],
				//'weather'	=>	$_POST['weather'],
				'created_by'	=>	$_SESSION['profile']->id,
			);

			$table = 'blogs';

			$this->user_model->save_common($table, $insert_data);
			$blog_id = $this->db->insert_id();
			$blog_link = base_url.'blog_details/'.$blog_id;

			//send email notifications
				$users = $this->user_model->get_common('subscribers', array('status_id' => 1),'*',2,'','email');
				$a=array();
				$string = '';
				$emailids = '';
				for($i=0;$i<count($users);$i++){
				if($users[$i]->email != ''){
					$string1 = preg_replace('/\s+/', '', $users[$i]->email);
					$string = trim($string1);
					$emailids = strtolower($string);
					array_push($a,$emailids);
					}
				}
				$subscribers = implode(', ',$a);
		
				$email = $subscribers;
				$subject = 'New post in MyFuel';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
								Dear User,
								<p>
									New blog added on MyFuel for you. Check it out!!
								</p>
								<p>Click on link to read blog <a href='".$blog_link."'>
									Click here </a>
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

			$this->session->set_flashdata("success_message","Blog added successfully.");
			redirect(base_url('admin/blogs'));
		}
	}

	
	function blog_category(){

		$table = 'blog_category';
		$where = array('status_id !=' => 0);
		$category = $this->user_model->get_common($table, $where,'*',2);
       // print_r($category);
		$data = array('category' => $category);
		$data['active_menu'] = 'blogs';
		$this->load->view('admin/add_blog_cat', $data);
		
	}
	
	function category(){

		$table = 'product_category';
		$where = array('status_id !=' => 0);
		$category = $this->user_model->get_common($table, $where,'*',2);
       // print_r($category);
		$data = array('category' => $category);
		$data['active_menu'] = 'category';
		$this->load->view('admin/category', $data);
		
	}

	function add_subcategory(){

		$table = 'product_category';
		$where = array('status_id !=' => 0);
		$category = $this->user_model->get_common($table, $where,'*',2);
		
		$table = 'product_subcategory';
		$where = array('status_id !=' => 0);
		$sub_category = $this->user_model->get_common($table, $where,'*',2);
      
		$data = array('category' => $category,'sub_category' => $sub_category);
		$data['active_menu'] = 'category';
		$this->load->view('admin/add_subcategory', $data);
		
	}

	function add_childcategory(){

		$table = 'product_category';
		$where = array('status_id !=' => 0);
		$category = $this->user_model->get_common($table, $where,'*',2);
      
		$table = 'product_childcategory';
		$where = array('status_id !=' => 0);
		$child_category = $this->user_model->get_common($table, $where,'*',2);
		
		$table = 'product_subcategory';
		$where = array('status_id !=' => 0);
		$sub_category = $this->user_model->get_common($table, $where,'*',2);
      
		$data = array('category' => $category,'sub_category' => $sub_category,'child_category' => $child_category);
		//$data = array('category' => $category);
		$data['active_menu'] = 'category';
		$this->load->view('admin/add_childcategory', $data);
		
	}
	
	function add_flavour(){
		
		$table = 'flavour';
		$where = array('status_id !=' => 0);
		$flavour = $this->user_model->get_common($table, $where,'*',2);
		$data = array('flavour' => $flavour);
		$data['active_menu'] = 'category';
		$this->load->view('admin/add_flavour', $data);
		
	}
	
	function add_goal(){
		
		$table = 'goals';
		$where = array('status_id !=' => 0);
		$goals = $this->user_model->get_common($table, $where,'*',2);
		$data = array('goals' => $goals);
		$data['active_menu'] = 'category';
		$this->load->view('admin/add_goal', $data);
		
	}
	
	function save_blog_category(){

		$this->form_validation->set_rules ( 'category', 'Blog Category', 'required' );
		$date = date("Y-m-d");  
		
		if($this->form_validation->run()==false){
			$this->blog_category();
			
		}else{
			$insert_data = array(
							'name'	=>	ucfirst($_POST['category']),
							'status_id'	=>	1,
							'created_date'	=>	$date,
							//'created_by'	=>	$_SESSION['profile']->id,
						);

			$table = 'blog_category';

			$this->user_model->save_common($table, $insert_data);
 
			$this->session->set_flashdata("success_message","Child Category added successfully.");
			redirect(base_url('admin/blog_category'));
		}
	}
	
	function save_blog_keyword(){

		$this->form_validation->set_rules ( 'keyword', 'Keyword', 'required' );
		$date = date("Y-m-d");  
		
		if($this->form_validation->run()==false){
			$this->add_keyword();
			
		}else{
			$insert_data = array(
							'keyword'	=>	ucfirst($_POST['keyword']),
							'status_id'	=>	1,
							'created_date'	=>	$date,
							//'created_by'	=>	$_SESSION['profile']->id,
						);

			$table = 'keyword';

			$this->user_model->save_common($table, $insert_data);
 
			$this->session->set_flashdata("success_message","Keyword added successfully.");
			redirect(base_url('admin/add_keyword'));
		}
	}

	function save_category(){
        //$this->lang->load('lang');
		$this->form_validation->set_rules ( 'category', 'Main Category Name', 'required' );
		$date = date("Y-m-d");  
		
		/* if ($_FILES ["image"] ["name"] == "") 
		{
			$this->form_validation->set_rules ( "image", "Category Image", "required" );
		}  */
		if($this->form_validation->run()==false){
			$this->category();
			
		}else{
			if ($_FILES ["image"] ["name"] != "") 
			{
			 
			$target = "./site_data/uploads/category/". @date(U)."_".( $_FILES['image']['name']);
			$image_name=@date(U)."_".( $_FILES['image']['name']);
			move_uploaded_file($_FILES['image']['tmp_name'], $target);	
			}else{
				$image_name = '';
			}
			$insert_data = array(
				'name'	=>	ucfirst($_POST['category']),
				'image'	=>	$image_name,
				'status_id'	=>	1,
				'created_date'	=>	$date,
				//'created_by'	=>	$_SESSION['profile']->id,
			);

			$table = 'product_category';
			$this->user_model->save_common($table, $insert_data);
 
			$this->session->set_flashdata("success_message","Category added successfully.");
			redirect(base_url('admin/category'));
		}
	}

	function save_sub_category(){

		$this->form_validation->set_rules ( 'main_category', 'Main Category', 'required' );
		$this->form_validation->set_rules ( 'category', 'Sub-Category Name', 'required' );
		$date = date("Y-m-d");  
		
		if($this->form_validation->run()==false){
			$this->add_subcategory();
			
		}else{
			$insert_data = array(
							'name'	=>	ucfirst($_POST['category']),
				            'product_cat_id'=> $_POST['main_category'],
							'status_id'	=>	1,
							'created_date'	=>	$date,
							//'created_by'	=>	$_SESSION['profile']->id,
						);

			$table = 'product_subcategory';

			$this->user_model->save_common($table, $insert_data);
 
			$this->session->set_flashdata("success_message","Sub Category added successfully.");
			redirect(base_url('admin/add_subcategory'));
		}
	}

	function save_child_category(){

		$this->form_validation->set_rules ( 'main_category', 'Main Category', 'required' );
		$this->form_validation->set_rules ( 'sub_category', 'Sub Category', 'required' );
		$this->form_validation->set_rules ( 'child_category', 'Child Category Name', 'required' );
		$date = date("Y-m-d");  
		
		if($this->form_validation->run()==false){
			$this->add_childcategory();
			
		}else{
			$insert_data = array(
							'name'	=>	ucfirst($_POST['child_category']),
				            'product_cat_id'=> $_POST['main_category'],
				            'product_subcat_id'=> $_POST['sub_category'],
							'status_id'	=>	1,
							'created_date'	=>	$date,
							//'created_by'	=>	$_SESSION['profile']->id,
						);

			$table = 'product_childcategory';

			$this->user_model->save_common($table, $insert_data);
 
			$this->session->set_flashdata("success_message","Sub Category added successfully.");
			redirect(base_url('admin/add_childcategory'));
		}
	}
	
	function save_flavour(){

		$this->form_validation->set_rules ( 'name', 'Flavour', 'required' );
		
		if($this->form_validation->run()==false){
			$this->add_flavour();
		}else{
			
			$insert_data = array(
				'name' => ucfirst($_POST['name']),
				'status_id'	=>	1
			);

			$table = 'flavour';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Flavour added successfully.");
			redirect(base_url('admin/add_flavour'));
		}
	}
	
	function save_goal(){

		$this->form_validation->set_rules ( 'name', 'Goal', 'required' );
		
		if($this->form_validation->run()==false){
			$this->add_flavour();
		}else{
			
			$insert_data = array(
				'name' => ucfirst($_POST['name']),
				'status_id'	=>	1
			);

			$table = 'goals';
			$this->user_model->save_common($table, $insert_data);
			$this->session->set_flashdata("success_message","Goal added successfully.");
			redirect(base_url('admin/add_goal'));
		}
	}
	
	function update_category_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('product_category', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Category deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/category'));
	}
	
	function update_subcategory_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('product_subcategory', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Sub Category deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/add_subcategory'));
	}
	
	function update_childcategory_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('product_childcategory', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Child Category deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/add_childcategory'));
	}
	
	function update_flavour_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('flavour', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Flavour deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/add_flavour'));
	}
	
	function update_goal_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('goals', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Goal deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/add_goal'));
	}
	
	function update_blog_category_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('blog_category', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Category deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/blog_category'));
	}
	
	function update_blog_keyword_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('keyword', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Keyword deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/add_keyword'));
	}
	
	function edit_category($id){
		
		$this->check_login();

		$table = 'product_category';
		$where = array('id' => $id);

		$category = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'category';
		$data['category'] = $category;
        $this->load->view('admin/edit_category', $data);
	}
	
	function edit_subcategory($id){
		
		$this->check_login();

		$table = 'product_subcategory';
		$where = array('id' => $id);

		$sub_category = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'category';
		$data['sub_category'] = $sub_category;
        $this->load->view('admin/edit_subcategory', $data);
		
		
	}
	
	function edit_childcategory($id){
		
		$this->check_login();

		$table = 'product_childcategory';
		$where = array('id' => $id);

		$child_category = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'category';
		$data['child_category'] = $child_category;
        $this->load->view('admin/edit_childcategory', $data);
	}
	
	function edit_flavour($id){
		
		$this->check_login();

		$table = 'flavour';
		$where = array('id' => $id);

		$flavour = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'category';
		$data['flavour'] = $flavour;
        $this->load->view('admin/edit_flavour', $data);
	}
	
	function edit_goal($id){
		
		$this->check_login();

		$table = 'goals';
		$where = array('id' => $id);

		$goal = $this->user_model->get_common($table, $where);
 
		$data['active_menu'] = 'category';
		$data['goal'] = $goal;
        $this->load->view('admin/edit_goal', $data);
	}
	
	function update_edit_blogcategory(){

		$this->form_validation->set_rules ( 'category', 'Category','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_blog_category($_POST['id']);
		}else{
			 
			$date = date("Y-m-d");

			$update_data = array(
							'name'	=>	$_POST['category'],
							'updated_date'	=>	$date,
							//'updated_by'	=>	$_SESSION['profile']->id,
						);
			 
			$table = 'blog_category';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Category updated successfully.");
			redirect(base_url('admin/blog_category'));
		}
	}
	
	function update_edit_blogkeyword(){

		$this->form_validation->set_rules ( 'keyword', 'Keyword','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_blog_keyword($_POST['id']);
		}else{
			 
			$date = date("Y-m-d");

			$update_data = array(
							'keyword'	=>	$_POST['keyword'],
							'updated_date'	=>	$date,
							//'updated_by'	=>	$_SESSION['profile']->id,
						);
			 
			$table = 'keyword';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Keyword updated successfully.");
			redirect(base_url('admin/add_keyword'));
		}
	}
	
	function update_edit_category(){

		$this->form_validation->set_rules ( 'category', 'Category','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_category($_POST['id']);
		}else{
			 
			$date = date("Y-m-d");

			$update_data = array(
				'name'	=>	$_POST['category'],
				'updated_date'	=>	$date,
			);
			
			if($_FILES ["image"] ["name"] != "")
			{
				
				$target = "./site_data/uploads/category/". @date(U)."_".( $_FILES['image']['name']);
				$image_name=@date(U)."_".( $_FILES['image']['name']);
				move_uploaded_file($_FILES['image']['tmp_name'], $target);	
				//copy($target, $targetp);
			
				$update_data['image'] = $image_name;
			}
			 
			$table = 'product_category';
			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Category updated successfully.");
			redirect(base_url('admin/category'));
		}
	}
	
	function update_edit_subcategory(){

		$this->form_validation->set_rules ( 'category', 'Category','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_subcategory($_POST['id']);
		}else{
			 
			$date = date("Y-m-d");

			$update_data = array(
							'name'	=>	$_POST['category'],
							'updated_date'	=>	$date,
							//'updated_by'	=>	$_SESSION['profile']->id,
						);
			 
			$table = 'product_subcategory';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Sub Category updated successfully.");
			redirect(base_url('admin/add_subcategory'));
		}
	}

	function update_edit_childcategory(){

		$this->form_validation->set_rules ( 'category', 'Category','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_childcategory($_POST['id']);
		}else{
			 
			$date = date("Y-m-d");

			$update_data = array(
							'name'	=>	$_POST['category'],
							'updated_date'	=>	$date,
							//'updated_by'	=>	$_SESSION['profile']->id,
						);
			 
			$table = 'product_childcategory';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Child Category updated successfully.");
			redirect(base_url('admin/add_childcategory'));
		}
	}
	
	function update_edit_flavour(){

		$this->form_validation->set_rules ( 'name', 'Flavour','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_flavour($_POST['id']);
			
		}else{

			$update_data = array(
				'name'	=>	$_POST['name']
			);
			 
			$table = 'flavour';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Flavour updated successfully.");
			redirect(base_url('admin/add_flavour'));
		}
	}
	
	function update_edit_goal(){

		$this->form_validation->set_rules ( 'name', 'Goal','required' );
		  
		if($this->form_validation->run()==false){

			$this->edit_flavour($_POST['id']);
			
		}else{

			$update_data = array(
				'name'	=>	$_POST['name']
			);
			 
			$table = 'goals';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Goal updated successfully.");
			redirect(base_url('admin/add_goal'));
		}
	}
	
	function update_blogs_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('blogs', $where, $updateData);

		if($status == 3){
			$this->set_flashdata('success', 'Blog deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/blogs'));
	}

	function update_reply_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('forum_queries_reply', $where, $updateData);

		if($status == 3){
			$this->set_flashdata('success', 'Story deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/forum_queries'));
	}


	function del_reply_status(){
		@extract($_POST);
		$this->db->query("delete from forum_queries_reply where id='$id'");
		redirect(base_url('admin/forum_queries'));
	}

	function update_story_comment_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('blog_comments', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Story comment deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/blogs'));
	}

	function edit_blogs($id){

		$table = 'blogs';
		$where = array('id' => $id);

		$blogs = $this->user_model->get_common($table, $where);

		/* $date = explode('-', $blogs->date);
		$date = $date[1].'/'.$date[2].'/'.$date[0];
		$blogs->date = $date; */
		
        $table = 'blog_category';
		$where = array('status_id !=' => 0);
		$category = $this->user_model->get_common($table, $where,'*',2);
		
		$data['active_menu'] = 'blogs';
		$data['blogs'] = $blogs;
        $data['category'] = $category;
		$this->load->view('admin/edit_blogs', $data);
	}
	
	function edit_testimonial($id){

		$table = 'testimonial';
		
		$where = array('id' => $id);

		$testimonial = $this->user_model->get_common($table, $where);

		/* $date = explode('-', $story->date);
		$date = $date[1].'/'.$date[2].'/'.$date[0];
		$story->date = $date; */

		$data['active_menu'] = 'testimonial';
		$data['testimonial'] = $testimonial;

		$this->load->view('admin/edit_testimonial', $data);
	}
	
	function update_blogs(){

		//$this->form_validation->set_rules ( 'category', 'Category', 'required' );
		$this->form_validation->set_rules ( 'story_by', 'Blog By', 'required' );
		$this->form_validation->set_rules ( 'category', 'Category', 'required' );
		$this->form_validation->set_rules ( 'title', 'Title', 'required' );
		//$this->form_validation->set_rules ( 'summary', 'Summary', 'required' );
		$this->form_validation->set_rules ( 'date', 'Date', 'required' );
		$this->form_validation->set_rules ( 'story', 'Story', 'required' );

		if ($_FILES ["image"] ["name"] != "") {
			
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/blogs/';
			$config ['allowed_types'] = 'jpeg|jpg|jfif|exif|tiff|bmp|png|bgp|mp4|3gp|wmv|ogg|webm|flv|avi|hdv|mpeg|wav|vob|ogv|gif|gifv|mng|mkv|drc|MTS|M2TS|mov|qt|yuv|rm|rmvb|asf|amv|m4p|m4v|mpg|mp2|mpe|mpv|m2v|svi|3g2|mxf|roq|nsv|f4v|f4p|f4a|f4b';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "blog_" );
			$this->upload->initialize ( $config );
		}else if ($_FILES ["video"] ["name"] != "") {
			
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/blogs/';
			$config ['allowed_types'] = 'jpeg|jpg|jfif|exif|tiff|bmp|png|bgp|mp4|3gp|wmv|ogg|webm|flv|avi|hdv|mpeg|wav|vob|ogv|gif|gifv|mng|mkv|drc|MTS|M2TS|mov|qt|yuv|rm|rmvb|asf|amv|m4p|m4v|mpg|mp2|mpe|mpv|m2v|svi|3g2|mxf|roq|nsv|f4v|f4p|f4a|f4b';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "blog_" );
			$this->upload->initialize ( $config );
		}

		if($_FILES ["image"] ["name"] != ""){
			if($this->upload->do_upload('image') == FALSE){
				$this->edit_blogs($_POST['id']);
			}
		}else if($_FILES ["video"] ["name"] != ""){
			if($this->upload->do_upload('video') == FALSE){
				$this->edit_blogs($_POST['id']);
			}
		}
		if($this->form_validation->run()==false){

			$this->edit_blogs($_POST['id']);
		}else{
			if($_FILES ["image"] ["name"] != ""){
				$upload_data = $this->upload->data();
				$uploaded_file_name=$upload_data['file_name'];
			}else if($_FILES ["video"] ["name"] != ""){
				$upload_data = $this->upload->data();
				$uploaded_file_name=$upload_data['file_name'];
			}

			/* $date = explode('/', $_POST['date']);
			$date = $date[2].'-'.$date[0].'-'.$date[1]; */
			$summary = substr($_POST['story'], 0, 500);

			$update_data = array(
							'category'	=>	$_POST['category'],
							'story_by'	=>	$_POST['story_by'],
							'title'	=>	$_POST['title'],
							'summary'	=>	$summary,
							'date'	=>	$_POST['date'],
							'story'	=>	$_POST['story'],
							'story'	=>	$_POST['story'],
							'created_by'	=>	$_SESSION['profile']->id,
						);
			if($_FILES ["image"] ["name"] != ""){
				$update_data['image'] = $uploaded_file_name;
			}else if($_FILES ["video"] ["name"] != ""){
				$update_data['image'] = $uploaded_file_name;
			}
			$table = 'blogs';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Blog updated successfully.");
			redirect(base_url('admin/blogs'));
		}
	}
	
	function update_edit_testimonial(){

		//$this->form_validation->set_rules ( 'category', 'Category', 'required' );
		$this->form_validation->set_rules ( 'story_by', 'Name', 'required' );
		$this->form_validation->set_rules ( 'designation', 'Desgination', 'required'  );
		//$this->form_validation->set_rules ( 'summary', 'Summary', 'required' );
		//$this->form_validation->set_rules ( 'date', 'Date', 'required' );
		$this->form_validation->set_rules ( 'story', 'Message', 'required' );

		if ($_FILES ["image"] ["name"] != "") {
			
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/testimonial/';
			$config ['allowed_types'] = 'jpeg|jpg|png';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "testimonial_" );
			$this->upload->initialize ( $config );
		}

		
		if($_FILES ["image"] ["name"] != ""){
			if($this->upload->do_upload('image') == FALSE){
				$this->edit_testimonial($_POST['id']);
			}
		}
		if($this->form_validation->run()==false){

			$this->edit_testimonial($_POST['id']);
		}else{
			if($_FILES ["image"] ["name"] != ""){
				$upload_data = $this->upload->data();
				$uploaded_file_name=$upload_data['file_name'];
			}


			//$date = explode('/', $_POST['date']);
		//	$date = $date[2].'-'.$date[0].'-'.$date[1];

			$update_data = array(
							//'category'	=>	$_POST['category'],
							'name'	=>	$_POST['story_by'],
							'desgination'	=>	$_POST['designation'],
							//'summary'	=>	$_POST['summary'],
							//'weather'	=>	$_POST['weather'],
							//'date'	=>	$date,
							'message'	=>	$_POST['story'],
							//'story'	=>	$_POST['story'],
							//'created_by'	=>	$_SESSION['profile']->id,
						);
			if($_FILES ["image"] ["name"] != ""){
				$update_data['image'] = $uploaded_file_name;
			}
			$table = 'testimonial';

			$where = array('id' => $_POST['id']);

			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Testimonial updated successfully.");
			redirect(base_url('admin/testimonial'));
		}
	}
	
	function save_testimonial(){
	  //$this->form_validation->set_rules ( 'category', 'Category', 'required' );
		$this->form_validation->set_rules ( 'story_by', 'Name', 'required' );
		$this->form_validation->set_rules ( 'designation', 'Designation', 'required' );
		//$this->form_validation->set_rules ( 'summary', 'Summary', 'required' );
		//$this->form_validation->set_rules ( 'date', 'Date', 'required' );
		$this->form_validation->set_rules ( 'story', 'Message', 'required' );
		//$this->form_validation->set_rules ( "image", "Upload Image", "required" );
		
		if ($_FILES ["image"] ["name"] == "") {
			$this->form_validation->set_rules ( "image", "Upload Image", "required" );
		}
			 
		
		echo $config ['upload_path'] = './site_data/uploads/testimonial/';
		
		$config ['allowed_types'] = 'jpeg|jpg|png';
		//$config ['max_size'] = 2048;
		$config ['file_name'] = uniqid ( "testimonial_" );
		$this->upload->initialize ( $config );
		
		if($this->form_validation->run()==false || $this->upload->do_upload('image') == FALSE){

			$this->add_testimonial();
		}else{
			$upload_data = $this->upload->data ();
			$uploaded_file_name=$upload_data['file_name'];
			//$date = explode('/', $_POST['date']);
			//$date = $date[2].'-'.$date[0].'-'.$date[1];

			$insert_data = array(
							//'category'	=>	$_POST['category'],
							'name'	=>	$_POST['story_by'],
							'desgination'	=>	$_POST['designation'],
							//'summary'	=>	$_POST['summary'],
							//'weather'	=>	$_POST['weather'],
							//'date'	=>	$date,
							'message'	=>	$_POST['story'],
							'image'	=>	$uploaded_file_name,
							//'created_by'	=>	$_SESSION['profile']->id,
						);
			
			$table = 'testimonial';

			$this->user_model->save_common($table, $insert_data);
		
			$this->session->set_flashdata("success_message","Testimonial Save successfully.");
			redirect(base_url('admin/testimonial'));
		}
	}
	
	// video
	function video(){

		$table = 'video';
		$where = array('status_id !=' => 0);
		$video = $this->user_model->get_common($table, $where,'*',2);

		$data = array('video' => $video);
		$data['active_menu'] = 'video';
		$this->load->view('admin/video', $data);
	}
	
	// add video link
	function add_video(){
		
		$this->check_login();
		$table = 'product_category';
		$where = array('status_id !=' => 0);
		$project_category = $this->user_model->get_common($table, $where,'*',2);
		$data = array('project_category'=> $project_category);
		$data['active_menu'] = 'video';
		$this->load->view('admin/add_video', $data);
	}
	
	// save video
	function save_video(){

	    $this->form_validation->set_rules ( 'video_link', 'Video Id', 'required' );
	    $this->form_validation->set_rules ( 'video_title', 'Video Title', 'required' );
		
		/* if (empty($_FILES['video']['name']))
		{
			$this->form_validation->set_rules('video', 'Video File', 'required');
		}
		
		if ($_FILES ["video"] ["name"] != "") {
			
			$config ['upload_path'] = './site_data/uploads/videos/';
			$config ['allowed_types'] = 'jpeg|jpg|jfif|exif|tiff|bmp|png|bgp|mp4|3gp|wmv|ogg|webm|flv|avi|hdv|mpeg|wav|vob|ogv|gif|gifv|mng|mkv|drc|MTS|M2TS|mov|qt|yuv|rm|rmvb|asf|amv|m4p|m4v|mpg|mp2|mpe|mpv|m2v|svi|3g2|mxf|roq|nsv|f4v|f4p|f4a|f4b';
			$config ['file_name'] = uniqid ( "video_" );
			$this->upload->initialize ( $config );
		}
			
		if($_FILES ["video"] ["name"] != ""){
			if($this->upload->do_upload('video') == FALSE){
				$this->add_video();
			}
		}
		
		if($_FILES ["video"] ["name"] != ""){
			$upload_data = $this->upload->data();
			$uploaded_file_name=$upload_data['file_name'];
		}
		*/
 
		if($this->form_validation->run()==false){
			$this->add_video();
		}else{

			$insert_data = array(
				'video_link'	=>	$_POST['video_link'],
				'slogan' => $_POST['video_title'],
				'created_by'	=>	$_SESSION['profile']->id,
				'status_id'	=>	1
			);

			$table = 'video';
			$this->user_model->save_common($table, $insert_data);
		
		$this->session->set_flashdata("success_message","Video uploaded successfully.");
		redirect(base_url('admin/video'));
		}
	}
	
	// edit video link
	function edit_video($id){

		$table = 'video';
		$where = array('id' => $id);
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		$video = $this->user_model->get_common($table, $where, '*', 1, '', $group_by, $order_by, $order);
		
		$data['active_menu'] = 'video';
		$data['video'] = $video;
		$this->load->view('admin/edit_video', $data);
	}
	
	// update video details
	function update_video_details(){
		
		$this->form_validation->set_rules ( 'video_link', 'Video Id', 'required' );
		$this->form_validation->set_rules ( 'video_title', 'Video Title', 'required' );
		
		/* if ($_FILES ["video"] ["name"] != "") {
			$config ['upload_path'] = './site_data/uploads/videos/';
			$config ['allowed_types'] = 'jpeg|jpg|jfif|exif|tiff|bmp|png|bgp|mp4|3gp|wmv|ogg|webm|flv|avi|hdv|mpeg|wav|vob|ogv|gif|gifv|mng|mkv|drc|MTS|M2TS|mov|qt|yuv|rm|rmvb|asf|amv|m4p|m4v|mpg|mp2|mpe|mpv|m2v|svi|3g2|mxf|roq|nsv|f4v|f4p|f4a|f4b';
			$config ['file_name'] = uniqid ( "video_" );
			$this->upload->initialize ( $config );
		}
			
		if($_FILES ["video"] ["name"] != ""){
			if($this->upload->do_upload('video') == FALSE){
				$this->add_video();
			}
		}
		
		if($_FILES ["video"] ["name"] != ""){
			$upload_data = $this->upload->data();
			$uploaded_file_name=$upload_data['file_name'];
		} */
		
		$id = $_POST['id'];

		if($this->form_validation->run()==false){
			$this->edit_video($id);
		}else{

			$update_data = array(
				'video_link' => $_POST['video_link'],
				'slogan' => $_POST['video_title'],
				'updated_by'	=>	$_SESSION['profile']->id,
				'status_id'	=>	1
			);
			
			/* if($_FILES ["video"] ["name"] != ""){
				$update_data['video_link'] = $uploaded_file_name;
			} */

			$table = 'video';
			$where = array('id' => $id);
			$this->user_model->update_common($table, $where, $update_data);
		
		$this->session->set_flashdata("success_message","Video updated successfully.");
		redirect(base_url('admin/video'));
		}
	}
	
	// update video status
	function update_video($status, $id){
		
		$table = 'video';
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('video', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Video deleted successfully.');
		}else if($status == 1){

			/* $where = array('id !=' => $id);
			$updateData = array('status_id' => 2); //make other discount inactive
			$this->user_model->update_common('video', $where, $updateData); */

			$this->set_flashdata('success', 'Status Activate successfully.');
		}else if($status == 2){
			
			/* $where = array('id !=' => $id);
			$updateData = array('status_id' => 1); //make other discount inactive
			$this->user_model->update_common('video', $where, $updateData); */
			
			$this->set_flashdata('success', 'Status Inactive successfully.');
		}

		redirect(base_url('admin/video'));
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
		$where = array('status_id !=' => 0);
		$user = $this->user_model->get_common($table, $where,'*',2);
		$data = array('user' => $user);
		$data['active_menu'] = 'users';
		$this->load->view('admin/users', $data);
	}

	/*
	*	34
	*	Function Name	:	add_user()
	* 	Descrption 		:	Loads add user view
	*/
	function add_users()
	{
		$this->check_login();

		$data['active_menu'] = 'user';
		$this->load->view('admin/add_users', $data);
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

		if($this->form_validation->run()==false)
		{

		$this->add_users();

		}
		else
		{ 
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
		$landmark1=$_POST['landmark1'];
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
		$data['active_menu'] = 'users';
		$data['user'] = $user;

		$this->load->view('admin/edit_users', $data);		 
	} 
	
	/*
	*	37
	*	Function Name	:	update_user()
	* 	Descrption 		:	Updates user details
	*/
	function update_user(){
		
		$this->form_validation->set_rules ( 'name', 'Name', 'required' );
		$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric' );
		$this->form_validation->set_rules ( 'country', 'Country', 'required|xss_clean' );
		$this->form_validation->set_rules ( 'state', 'State', 'required|xss_clean' );
		$this->form_validation->set_rules ( 'city', 'City', 'required|xss_clean' );
		$this->form_validation->set_rules ( 'pin', 'Pincode', 'required|numeric|max_length[6]' );
		$this->form_validation->set_rules ( 'address1', 'Address', 'required' );
		
        
		if($this->form_validation->run()==false)
		{

			$this->edit_dealer($_POST['id']);
			
		}else
		{
			
			$cur_date = date("Y-m-d h:i:s");
	
			if(isset($_POST['notify_email']))
			{
				$notify_email=1;
			}
			else
			{
				$notify_email=0;
			}
 
			 $update_data = array(
									'name'	=>	$_POST['name'],
									'email'	=>	$_POST['email'],
									'contact'	=>	$_POST['contact'],
									'birth '	=>	$_POST['birth'], 
									'ani'	=>	$_POST['ani'], 
									'country'	=> $_POST['country'],
									'state'	=>	$_POST['state'], 
									'city '	=>	$_POST['city'], 
									'pincode'	=>	$_POST['pin'],
									'address1'	=>	$_POST['address1'],
									//'address2'	=>	$_POST['address2'],
									'notify_sms'	=>	$notify_sms,
									'notify_email'	=>	$notify_email,
									'updated_date' => $cur_date,
									'updated_by' => $_SESSION['profile']->id,
								);
						 
			$table = 'user';
			$where = array('id' => $_POST['id']);

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

	function user_family_details($id){
		$this->check_login();
		
		$table = 'user_family_details';
		$where = array('user_id' => $id);
		$table = 'user_family_details';
		$user_family = $this->user_model->get_common($table, $where,'*',2,'');
		
		//print_r($user_family);exit;
		$data['active_menu'] = 'users';
		$data = array('user_family' => $user_family);
		$this->load->view('admin/user_family_details', $data);		 
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
	*	42
	*	Function Name	:	pdf_all_user()
	* 	Descrption 		:	PDF user Report
	*/
	function pdf_all_user(){
		
		$wherec = array('status_id !=' => 0);
		$user_report = $this->user_model->get_common('user', $wherec,'*',2);
		$challan_no_flag = "All_users_list"."-".date("Y-m-d");
		$data= array('user_report' =>$user_report);
		
		$this->load->view('admin/excess/pdf_all_users_exce', $data);
		$html = $this->output->get_output();
		$html = preg_replace('/(\>)\s*(\<)/m', '$1$2', $html);
		// Load pdf library
		$this->load->library('pdf1');
		// Load HTML content
		$this->dompdf->load_html($html);
		// (Optional) Setup the paper size and orientation
		$this->dompdf->set_paper('A3', 'portrait');
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
	
	// dealer list
	function dealer(){
		$this->check_login();

		$table = 'stores';
		$where = array('status_id !=' => 0); // 0- deleted
		
		$dealer = $this->user_model->get_common($table, $where,'*',2);
       
		$data = array('dealer' => $dealer);
		$data['active_menu'] = 'dealer';

		$this->load->view('admin/dealer', $data);
	}

	// add new dealer
	function add_dealer(){
		$this->check_login();
		
 		$data['active_menu'] = 'dealer';
		$this->load->view('admin/add_dealer', $data);	
	}
	
	// save new dealer
	function save_dealer(){
		error_reporting(0);
        //@extract($_POST);
        $this->form_validation->set_rules ( 'name', 'Owner Name', 'required|callback__alpha_dash_space' );
        $this->form_validation->set_rules ( 'Web_name', 'Web Name', 'required|callback__alpha_dash_space' );
		$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean|is_unique[stores.Web_email]' );
		$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric|min_length[10]|max_length[10]|is_unique[stores.Web_contact]' );
	 	$this->form_validation->set_rules ( 'city', 'City', 'required' );
	 	$this->form_validation->set_rules ( 'area', 'Area / Location', 'required' );
	 	$this->form_validation->set_rules ( 'pincode', 'Pincode', 'required' );
	 	$this->form_validation->set_rules ( 'address1', 'Address', 'required' );
		//$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[6]|matches[cpassword]' );
		//$this->form_validation->set_rules ( 'cpassword', 'Confirm Password', 'required' );
		
		if(isset($_POST['pan']) && $_POST['pan']!=''){
			$this->form_validation->set_rules ( 'pan', 'PAN Number', 'xss_clean|callback_PANcheck' );
		}
		if(isset($_POST['gst']) && $_POST['gst']!=''){
			$this->form_validation->set_rules ( 'gst', 'GST Number', 'xss_clean|callback_GSTcheck' );
		}
		
		if ($_FILES ["image"] ["name"] == "") {
			//$this->form_validation->set_rules ( "image", "Upload Image", "required" );
		}
		 	
		/* upload config */
		$config ['upload_path'] = './site_data/uploads/dealer/';
		$config ['allowed_types'] = 'jpeg|jpg|png';
		//$config ['max_size'] = 2048;
		$config ['file_name'] = uniqid ( "dealer_" );
		$this->upload->initialize ( $config );
		if($this->form_validation->run()==false  ){

			$this->add_dealer();
		}else{
            
			$upload_data = $this->upload->data();
			$uploaded_file_name=$upload_data['file_name'];
			 
			$insert_data = array(
				'owner_name'	=>	$_POST['name'],
				'Web_name'	=>	$_POST['Web_name'],
				'Web_email'	=>	$_POST['email'],
				'Web_contact'	=>	$_POST['contact'],
				'logo'	=>	$uploaded_file_name,   
				'Web_gstno'	=>	$_POST['gst'],
				'Web_pan'	=>	$_POST['pan'], 
				'Web_address'	=>	$_POST['address1'],
				'Web_address1'	=>	$_POST['address2'],
				'birth'	=>	$_POST['birth'],
				'ani'	=>	$_POST['ani'],
				'Web_city'	=>	$_POST['city'],
				'Web_area'	=>	$_POST['area'],
				'Web_pincode'	=>	$_POST['pincode'],
				'password'	=>  md5($_POST['contact']),
				'status_id'	=>	1
			);

			$table = 'stores';
			
			$this->user_model->save_common($table, $insert_data);
			$dealer_id = $this->db->insert_id();
	
			$this->session->set_flashdata("success_message","Dealer added successfully.");
			redirect(base_url('admin/dealer'));
		}
	}
	
	// edit dealer details
	function edit_dealer($id){
		$this->check_login();

		$table = 'stores';
		$where = array('id' => $id);

		$dealer = $this->user_model->get_common($table, $where);

		$data['active_menu'] = 'dealer';
		$data['dealer'] = $dealer;

		$this->load->view('admin/edit_dealer', $data);
	}
	
	// update dealer details
	function update_dealer(){
		error_reporting(0);
		$this->form_validation->set_rules ( 'name', 'Owner Name', 'required' );
		$this->form_validation->set_rules ( 'Web_name', 'Web Name', 'required' );
		$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email|xss_clean' );
		$this->form_validation->set_rules ( 'contact', 'Contact', 'required|numeric|min_length[10]|max_length[10]' );
		$this->form_validation->set_rules ( 'city', 'City', 'required' );
	 	$this->form_validation->set_rules ( 'area', 'Area / Location', 'required' );
	 	$this->form_validation->set_rules ( 'pincode', 'Pincode', 'required' );
		$this->form_validation->set_rules ( 'address1', 'Address', 'required' );
		
		if(isset($_POST['pan']) && $_POST['pan']!=''){
			$this->form_validation->set_rules ( 'pan', 'PAN Number', 'xss_clean|callback_PANcheck' );
		}
		if(isset($_POST['gst']) && $_POST['gst']!=''){
			$this->form_validation->set_rules ( 'gst', 'GST Number', 'xss_clean|callback_GSTcheck' );
		}
		//$this->form_validation->set_rules ( 'discount', 'Discount', 'required' );

        if ($_FILES ["image"] ["name"] != "") {
			
			/* upload config */
			$config ['upload_path'] = './site_data/uploads/dealer/';
			$config ['allowed_types'] = 'jpeg|jpg|png';
			//$config ['max_size'] = 2048;
			$config ['file_name'] = uniqid ( "dealer_" );
			$this->upload->initialize ( $config );
		}

		if($_FILES ["image"] ["name"] != ""){
			if($this->upload->do_upload('image') == FALSE){
				$this->edit_dealer($_POST['id']);
			}
		}
		if($this->form_validation->run()==false){


			$this->edit_dealer($_POST['id']);
		}else{
			if($_FILES ["image"] ["name"] != ""){
				$upload_data = $this->upload->data();
				$uploaded_file_name=$upload_data['file_name'];
			}

			$update_data = array(
			                'owner_name'	=>	$_POST['name'],
			                'Web_name'	=>	$_POST['Web_name'],
				            'Web_email'	=>	$_POST['email'],
				            'Web_contact'	=>	$_POST['contact'],
				          	'Web_gstno'	=>	$_POST['gst'],
				         	'Web_pan'	=>	$_POST['pan'], 
				            'Web_address'	=>	$_POST['address1'],
				            'Web_address1'	=>	$_POST['address2'],
							'Web_city'	=>	$_POST['city'],
							'Web_area'	=>	$_POST['area'],
							'Web_pincode'	=>	$_POST['pincode'],
				            'birth'	=>	$_POST['birth'],
				            'ani'	=>	$_POST['ani'],
				            );
				if($_FILES ["image"] ["name"] != ""){
					$update_data['image'] = $uploaded_file_name;
				}
			
			$table = 'stores';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

		$this->session->set_flashdata("success_message","Dealer updated successfully.");
		redirect(base_url('admin/dealer'));
		
		}
	}
	
	// change dealer status
	function update_dealer_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('stores', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success_message', 'Dealer deleted successfully.');
		}else{
			$this->set_flashdata('success_message', 'Dealer updated successfully.');
		}

		redirect(base_url('admin/dealer'));
	}
	
	// view delaer details
	function view_dealer($id){
		$this->check_login();

		$table = 'stores';
		$where = array('id' => $id);
		$dealer = $this->user_model->get_common($table, $where);

		$data['active_menu'] = 'dealer';
		$data['dealer'] = $dealer;
		$this->load->view('admin/view_dealer', $data);
	}

	// dealer password cahange view
	function dealer_pwd($id){
		$this->check_login();

		$table = 'stores';
		$where = array('id' => $id);

		$dealer = $this->user_model->get_common($table, $where);

		$data['active_menu'] = 'dealer';
		$data['dealer'] = $dealer;

		$this->load->view('admin/dealer_pwd', $data);
	}
	
	// update dealer password
	function dealer_update_password(){

		$this->form_validation->set_rules("new_password","New Password","required|matches[confirm_password]");
		$this->form_validation->set_rules("confirm_password","Confirm Password","required");

		if($this->form_validation->run()==false){

			$this->dealer_pwd($_POST['id']);
		}else{
			$table = 'stores';
			$where = array('id' => $_POST['id']);
			$updateData = array('password' =>  md5($_POST['confirm_password']));
			
			$this->user_model->update_common($table, $where, $updateData);

			$this->session->set_flashdata("success_message","Password updated successfully.");
			redirect(base_url('admin/dealer'));
		}
	}

	// subscribers list
	function subscribers(){
		$this->check_login();

		$table = 'subscribers';
		$where = array('status_id !=' => 0); // 0- deleted
		
		$subscribers = $this->user_model->get_common($table, $where,'*',2);

		$data = array('interested_user' => $subscribers);
		$data['active_menu'] = 'subscribers';

		$this->load->view('admin/subscribers', $data);
	}
	 
	// interested_user status change
	function update_subscribers($status, $id){
		$where = array('id' => $id);
		$updateData = array('status_id' => $status);

		$this->user_model->update_common('subscribers', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Subscriber deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}
		redirect(base_url('admin/subscribers'));
	}
	
	//
	public function getSubscriber()
	{
		$status = $_POST['status'];
		$where = array();
		$table = 'subscribers';
		$subscribers_list = $this->user_model->get_common($table, $where,'*',2,'','email');

		$data = array('subscribers_list' => $subscribers_list);
		
		$this->load->view('admin/get_subcriber_list', $data);
	}
	
	function change_order_status(){
		
		$id=$_POST['id'];
		$status=$_POST['status'];
		$user_id=$_POST['user_id'];
		$table = 'tbl_order';
		$where = array('id' => $id);
		$updateData = array('order_status' => $status);

		$upt=$this->user_model->update_common($table, $where, $updateData);
		$order = $this->user_model->get_common($table, $where,'*',2);

		// for find user details
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
		
		if($status==1){
			$order_status="Pending";
		}else if($status==2){
			
			//when order dispatch change stock qty
			
			$where_order_items = array('order_id' => $id);
			$order_items = $this->user_model->get_common("tbl_order_item", $where_order_items,'*',2);
			for($i=0;$i<count($order_items);$i++){ 			
				$order_qty = $order_items[$i]->quantity;
			 
			  $table = 'products';
			  $where = array('product_id'=>$order_items[$i]->product_id);
			  $group_by = '';
			  $order_by = 'product_id';
			  $order1 = 'DESC';
			  $orders_id = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order1);
			  $order_color=$orders_id[0]->product_color;
			  $quantity=$orders_id[0]->quantity;
		  
				$reqty=$quantity-$order_qty;
				$wherepupt = array('product_id' => $order_items[$i]->product_id);
				$update_datapupt = array('quantity'=> $reqty);
				//$this->user_model->update_common('products', $wherepupt, $update_datapupt);
			}
			//end function
			
			$order_status="Dispatch";
				
				$subject = 'Your Order #'.$id.' is Dispatched';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
								Dear ".$user_name.",
								<p>
									Your MyFuel Order #".$id." is Dispatched at: ".date('Y-m-d H:i:s')." 
								</p><br>
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
					",\nYour MyFuel Order ".$id." is Dispatched at: ".date('Y-m-d H:i:s').
					"\n\nThank You, \n".email_from_name;
										
					$this->send_sms($user_contact, $smsmessage);
				}
				
		}else if($status==3){
			$order_status="Deliver";
	
				$subject = 'Your Order #'.$id.' is Delivered successfully';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
								Dear ".$user_name.",
								<p>
									Your MyFuel Order #".$id." is Delivered at: ".date('Y-m-d H:i:s')." 
								</p><br>
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
					",\nYour MyFuel Order #".$id." is Delivered at: ".date('Y-m-d H:i:s').
					"\n\nThank You, \n".email_from_name;
										
					$this->send_sms($user_contact, $smsmessage);
				}
				
		}else if($status==4){
			$order_status="Cancelled by Admin";
	
				$subject = 'Your MyFuel Order #'.$id.' is Cancelled by Admin';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
								Dear ".$user_name.",
								<p>
									Your MyFuel Order #".$id." is Cancelled at: ".date('Y-m-d H:i:s')." 
								</p><br>
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
					",\nYour MyFuel Order ".$id." is Cancelled by Admin at: ".date('Y-m-d H:i:s').
					"\n\nThank You, \n".email_from_name;
										
					$this->send_sms($user_contact, $smsmessage);
				}
		}else if($status==5){
			$order_status="Cancelled by user";
		
				$subject = 'Your MyFuel Order #'.$id.' is Cancelled by You';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
								Dear ".$user_name.",
								<p>
									Your MyFuel Order #".$id." is Cancelled at: ".date('Y-m-d H:i:s')." 
								</p><br>
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
					",\nYour MyFuel order ".$id." is Cancelled by You at: ".date('Y-m-d H:i:s').
					"\n\nThank You, \n".email_from_name;
										
					$this->send_sms($user_contact, $smsmessage);
				}
		}

		if($upt){
			echo 1;
		}else{
			echo 0;
		}
		//redirect(base_url('admin/online_poll'));
	}
	
	function cancel_delete_order(){
		error_reporting(0);
		$id=$_POST['id'];
		$status=$_POST['status'];
		$dealer_id=$_POST['dealer_id'];
		$table = 'tbl_order';
		$where = array('id' => $id);
		$updateData = array('order_status' => $status);

		$upt=$this->user_model->update_common($table, $where, $updateData);
		$order = $this->user_model->get_common($table, $where,'*',2);
		
		$tablec = 'user';
		$wherec = array('id' => $order[0]->user_id);
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
		}else if($status==4){
				$order_status="Cancelled by Admin";
				$subject = 'Your MyFuel Order #'.$id.' is Cancelled';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Dear ".$user_name.",
					<p>
						Your MyFuel Order #".$id." is Cancelled at: ".date('Y-m-d H:i:s')." 
					</p><br>
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
					",\nYour MyFuel Order #".$id." is Cancelled at: ".date('Y-m-d H:i:s').
					"\n\nThank You, \n".email_from_name;
										
					$this->send_sms($user_contact, $smsmessage);
				}
				
				$admin_email = admin_email;			
				$admin_subject = 'user Order #'.$id.' is Cancelled';
				$admin_message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
								Hello Admin,
								<p>
									user Order #".$id." is Cancelled at: ".date('Y-m-d H:i:s').".
								</p><br>
								</p>Support Team,</p>
								<p>".email_from_name."</p>
								<br>
								<a href='mailto:".admin_email."'>
									".admin_email."
								</a> /
								".admin_contact."
							</div>";
				$this->my_send_email($admin_email, $admin_subject, $admin_message);
				
		}else if($status==6){
			$order_status="Deleted by Admin";
				$subject = 'Your MyFuel Order #'.$id.' is Deleted by Admin';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
							font-size: 16px; font-weight: 300; color: #444'>
							Dear ".$user_name.",
							<p>
								Your MyFuel Order #".$id." is Deleted by Admin at: ".date('Y-m-d H:i:s')." 
							</p><br>
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
					",\nYour MyFuel Order #".$id." is Deleted by Admin at: ".date('Y-m-d H:i:s').
					"\n\nThank You, \n".email_from_name;
										
					$this->send_sms($user_contact, $smsmessage);
				}
							
				$admin_email = admin_email;			
				$admin_subject = 'MyFuel Order #'.$id.' is Deleted by Admin';
				$admin_message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
								Hello Admin,
								<p>
									MyFuel Order #".$id." is Deleted by the Admin at: ".date('Y-m-d H:i:s').".
								</p><br>
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
	
		// Enquiry
	public function order_payment_enquiry(){
		$id=$_REQUEST['id'];
		
		$table = 'tbl_order';
		$where = array('id' => $id);
		$order_data = $this->user_model->get_common($table, $where);
		
		$user_id = $order_data->user_id;
		
		$tablep = 'tbl_payment';
		$wherep = array('order_id' => $id, 'user_id' => $user_id);
		$payment_data = $this->user_model->get_common($tablep, $wherep);
		
		if(count($payment_data)>0){
			$data = array('page_title'=>"MyFuel | Enquiry", 'active'=>'Refund','order_data'=>$order_data,'payment_data'=>$payment_data);
			$this->load->view('admin/HostedPaymentEnquiry',$data);
		}else{
			$this->session->set_flashdata("error_message","There is no any payment made for this order! try again.");
			redirect(base_url('admin/order'));
		}
		
	}
	
	// retrun refund
	public function cancel_delete_order_refund(){
		$id=$_REQUEST['id'];
		//$status=$_REQUEST['st'];
		
		$table = 'tbl_order';
		$where = array('id' => $id);
		$order_data = $this->user_model->get_common($table, $where);
		
		$user_id = $order_data->user_id;
		
		$tablep = 'tbl_payment';
		$wherep = array('order_id' => $id, 'user_id' => $user_id);
		$payment_data = $this->user_model->get_common($tablep, $wherep);

		if(count($payment_data)>0){
			$data = array('page_title'=>"MyFuel | Refund", 'active'=>'Refund','order_data'=>$order_data,'payment_data'=>$payment_data);
			$this->load->view('admin/HostedPaymentRefund',$data);
		}else{
			$this->session->set_flashdata("error_message","Order cancel request not placed! try again.");
			redirect(base_url('admin/order'));
		}
		
	}
	
	// retrun refund
	public function refund_success(){
		error_reporting(0);
		$this->load->helper('custom');
		$payment_status = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$txt_id = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$track_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : '';
		$status = 4;
		echo $payment_status;
		exit;
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
			}else if($status==4){
				
				$this->session->set_flashdata("success_message","Order Cancelled Suuessfully!.");
				
				$order_status="Cancelled by Admin";
				$subject = 'Your MyFuel Order #'.$id.' is Cancelled by Admin';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
					font-size: 16px; font-weight: 300; color: #444'>
					Dear ".$user_name.",
					<p>
						Your MyFuel Order #".$id." is Cancelled at: ".date('Y-m-d H:i:s')." 
					</p><br>
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
					",\nYour MyFuel Order #".$id." is Cancelled at: ".date('Y-m-d H:i:s').
					"\n\nThank You, \n".email_from_name;
										
					$this->send_sms($user_contact, $smsmessage);
				}
				
				$admin_email = admin_email;			
				$admin_subject = 'user Order #'.$id.' is Cancelled by Admin';
				$admin_message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
								Hello Admin,
								<p>
									user Order #".$id." is Cancelled by the Admin at: ".date('Y-m-d H:i:s').".
								</p><br>
								</p>Support Team,</p>
								<p>".email_from_name."</p>
								<br>
								<a href='mailto:".admin_email."'>
									".admin_email."
								</a> /
								".admin_contact."
							</div>";
				$this->my_send_email($admin_email, $admin_subject, $admin_message);
					
			}else if($status==6){
				$order_status="Deleted by user";
				
				$this->session->set_flashdata("success_message","Order Deleted Suuessfully!.");
				
					$order_status="Deleted by Admin";
				$subject = 'Your MyFuel Order #'.$id.' is Deleted by Admin';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
							font-size: 16px; font-weight: 300; color: #444'>
							Dear ".$user_name.",
							<p>
								Your MyFuel Order #".$id." is Deleted by Admin at: ".date('Y-m-d H:i:s')." 
							</p><br>
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
					",\nYour MyFuel Order #".$id." is Deleted by Admin at: ".date('Y-m-d H:i:s').
					"\n\nThank You, \n".email_from_name;
										
					$this->send_sms($user_contact, $smsmessage);
				}
							
				$admin_email = admin_email;			
				$admin_subject = 'MyFuel Order #'.$id.' is Deleted by Admin';
				$admin_message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
								Hello Admin,
								<p>
									MyFuel Order #".$id." is Deleted by the Admin at: ".date('Y-m-d H:i:s').".
								</p><br>
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
			$this->session->set_flashdata("error_message","Order cancel request not placed! try again.");
		}
		redirect(base_url('admin/order'));
	}
		
	function upload_order_document()
	{
		if(isset($_POST) == true){
		//generate unique file name
		$fileName = time().'_'.basename($_FILES["file"]["name"]);
		
		$id=$_POST['order_id'];
		$table = 'tbl_order';
		$where = array('id' => $id);
		$updateData = array('order_invoice' => $fileName);

		$upt=$this->user_model->update_common($table, $where, $updateData);
		//file upload path
		$targetDir = "./site_data/uploads/order_invoice/";
		$targetFilePath = $targetDir . $fileName;
		
		//allow certain file formats
		/* $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
		$allowTypes = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv'); */
		
		/* if(in_array($fileType, $allowTypes)){ */
			//upload file to server
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
				//insert file data into the database if needed
				//........
				$response['status'] = 'ok';
			}else{
				$response['status'] = 'err';
			}
		/* }else{
			$response['status'] = 'type_err';
		} */
		
		//render response data in JSON format
		echo json_encode($response);
		}
	}

	function getSubcat(){
		//print $_REQUEST['category_id'];
		$cat_id=(int)$_POST['category_id'];
		$group_by = '';
		$order_by = 'id';
		$order = 'ASC';
		
		$table = 'product_subcategory';
		$where = array('status_id' => 1,'product_cat_id'=>$cat_id);
		$subcat = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);
		
		if(count($subcat) && is_array($subcat)){
			foreach($subcat AS $k => $v){
				 $subcat_list[$v->id]=$v->name;
			}
			$list='<option value="">-- Sub-category --</option>';
			foreach($subcat_list AS $key=>$val){
					if(count($val) && is_array($val)){
						foreach($val AS $k => $v){
							$list.="<option value=".$k.">$v</option>";
						}
					}else{
						$list.="<option value=".$key.">$val</option>";
					}
			}
			print $list;
		}else{
			print "Subcategory not present";
		}
   }
   
   function getChildcat(){
		$subcat_id=(int)$_POST['subcategory_id'];
		$group_by = '';
		$order_by = 'id';
		$order = 'ASC';
		
		$table = 'product_childcategory';
		$where = array('status_id' => 1,'product_subcat_id'=>$subcat_id);
		$subcat = $this->user_model->get_common($table, $where,'*',2,'',$group_by,$order_by,$order);

		if(count($subcat) && is_array($subcat)){
			foreach($subcat AS $k => $v){
				 $subcat_list[$v->id]=$v->name;
			}
			$list='<option value="">-- Sub-category --</option>';
			foreach($subcat_list AS $key=>$val){
					if(count($val) && is_array($val)){
						foreach($val AS $k => $v){
							$list.="<option value=".$k.">$v</option>";
						}
					}else{
						$list.="<option value=".$key.">$val</option>";
					}
			}
			print $list;
		}else{
			print "Childcategory not present";
		}
	}
   
	public function select_order_product(){
	  error_reporting(0);
	  $id=$_POST['id'];
	  
	  $cust_id=$_POST['cust_id'];
	  $cust_name=$_POST['cust_name'];
	  $cust_email=$_POST['email'];
	  $cust_contact=$_POST['contact'];
	  
	  $table = 'products';
	  $where = array();
	  $this->db->where_in('product_id', $id);
	  $group_by = '';
	  $order_by = 'product_id';
	  $order = 'DESC';
	  $order_product = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);
	  
	  $whered = array('status' => 1);
	  $dis_guser = $this->user_model->get_common('coupon', $whered,'*',2);
	  $dis_dealer = $this->user_model->get_common('dealer_discount', $whered,'*',2);
		
	 $table = 'dealer_discount';
     $where = array('status' => 1);
     $dis_dealer = $this->user_model->get_common($table, $where,'*',2);	
		
	 $table = 'tbl_order';
		$where = array();
		$select = '*';
		$total_rec = 2;
		$limit_to = '';
		$group_by = '';
		$order_by = 'id';
		$order = 'DESC';
		$orders = $this->user_model->get_common($table, $where, $select, $total_rec, $limit_to, $group_by, $order_by, $order);
		
	    if($orders){
		$order_id=$orders[0]->id + 1;
		}else{
		 $order_id=1;
		}	
	   //Web deatils
	   $table = 'about_shop_own';
	   $where = array('status!=' => 0);
	   $about_Web = $this->user_model->get_common($table, $where,'*',2,'','','Web_id');
	
	  $data= array(
				'order_product' => $order_product,
			   'dis_guser' =>$dis_guser,
		       'dis_dealer' =>$dis_dealer,
			   'dis_dealer' =>$dis_dealer,
			   'cust_id'=> $cust_id,
			   'cust_name' =>$cust_name,
			   'email'=> $cust_email,
			   'contact'=> $cust_contact,
		       'order_id'=> $order_id,
		       'about_Web' =>$about_Web
			   );
	 
	  $this->load->view('admin/order_product', $data);
  
	}
	
	public function select_order_product_edit(){
	  error_reporting(0);
	  $id=$_POST['id'];
	  
	  $cust_id=$_POST['cust_id'];
	  $cust_name=$_POST['cust_name'];
	  $cust_email=$_POST['email'];
	  $cust_contact=$_POST['contact'];
	  $order_id=$_POST['order_id'];

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
			
	 /*  $table = 'products';
	  $where = array();
	  $this->db->where_in('product_id', $id);
	  $group_by = '';
	  $order_by = 'product_id';
	  $order = 'DESC';
	  $order_product = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order); */
	  
	  $whered = array('status' => 1);
	  $wheredeal = array('id' => $cust_id);
	  $dis_guser = $this->user_model->get_common('coupon', $whered,'*',2);
	  $dis_dealer = $this->user_model->get_common('dealer_discount', $whered,'*',2);
	  $dealer = $this->user_model->get_common('dealer', $wheredeal,'*',2);
		
	/* 	 $table = 'dealer_discount';
     $where = array('status' => 1);
     $dis_dealer = $this->user_model->get_common($table, $where,'*',2);	 */
		
	 $table = 'tbl_order';
		$where = array();
		$select = '*';
		$total_rec = 2;
		$limit_to = '';
		$group_by = '';
		$order_by = 'id';
		$order = 'DESC';
		$orders = $this->user_model->get_common($table, $where, $select, $total_rec, $limit_to, $group_by, $order_by, $order);
		
	   /*  if($orders){
		$order_id=$orders[0]->id + 1;
		}else{
		 $order_id=1;
		} */	
	   //Web deatils
	   $table = 'about_shop_own';
	   $where = array('status!=' => 0);
	   $about_Web = $this->user_model->get_common($table, $where,'*',2,'','','Web_id');
	
	  $data= array(
			   'dis_guser' =>$dis_guser,
		       'dis_dealer' =>$dis_dealer,
			   'cust_id'=> $cust_id,
			   'cust_name' =>$cust_name,
			   'email'=> $cust_email,
			   'contact'=> $cust_contact,
		       'order_id'=> $order_id,
		       'dealer'=> $dealer,
		       'about_Web' =>$about_Web,
		       'orders' =>$orders,
		       'order_product' =>$products
			   );
	 
	  $this->load->view('admin/order_product_edit', $data);
  
	}
	
	public function check_qty(){
	
		$product_id=$_POST['product_id'];
		$product_qty=$_POST['qty'];
		 
		$table = 'products';
		$where = array('product_id'=> $product_id);
		$group_by = '';
		$order_by = 'product_id';
		$order = 'DESC';
		$order_qty = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);
		$order_quntity=$order_qty[0]->quantity;
		if($order_quntity>$product_qty){
		 echo $product_qty;
		}
		else{
		echo $order_quntity;
		}	
	}
	
	public function bill_print(){

	    $cust_name= $_POST['cust_name'];
		$cust_email= $_POST['cust_email'];
		$cust_contact= $_POST['cust_contact'];
		$cust_id= $_POST['cust_id'];
		//echo $cust_email;
	
		$tol_unit_cost_amt= $_POST['tol_tax_val'];
		$tol_gst= $_POST['tot_gst'];
		$tot_gst_amt=$_POST['tot_gst_amt'];
		$only_discount=$_POST['only_discount'];
	    $only_dealer_discount=$_POST['only_dealer_discount'];
		$discount= $_POST['discount'];
		$final_value= $_POST['final_value'];
		$total_quntity=$_POST['total_quntity'];
		
		$product_id= $_POST['hid_product_id'];
		$product_name= $_POST['product_name'];
		$product_qty= $_POST['product_qty'];
		$product_price= $_POST['product_price'];
		$product_gst= $_POST['product_gst'];
		$total= $_POST['total'];
		$invoice_no=$_POST['invoice_no'];
		
		
		$table = 'tbl_order';
		$where = array();
		$select = '*';
		$total_rec = 2;
		$limit_to = '';
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		$orders = $this->user_model->get_common($table, $where, $select, $total_rec, $limit_to, $group_by, $order_by, $order);
		$order_id=$orders[0]->id;
		$table = 'coupon';
		$where = array('status' => 1);
		$dis_guser = $this->user_model->get_common($table, $where,'*',2);
		$data= array(
					//'page_title' => 'Place Order| Aaron',
					//'order_product' => $order_product,
			        'print_product' =>$_POST,
			        'dis_guser'=>$dis_guser,
			        'order_id'=>$order_id
			        );
	
		$this->load->view('admin/bill_print', $data);
	}
	
	public function bill_print_edit(){

	    $cust_name= $_POST['cust_name'];
		$cust_email= $_POST['cust_email'];
		$cust_contact= $_POST['cust_contact'];
		$cust_id= $_POST['cust_id'];
		//echo $cust_email;
	
		$tol_unit_cost_amt= $_POST['tol_tax_val'];
		$tol_gst= $_POST['tot_gst'];
		$tot_gst_amt=$_POST['tot_gst_amt'];
		$only_discount=$_POST['only_discount'];
	    $only_dealer_discount=$_POST['only_dealer_discount'];
		$discount= $_POST['discount'];
		$final_value= $_POST['final_value'];
		$total_quntity=$_POST['total_quntity'];
		
		$product_id= $_POST['hid_product_id'];
		$product_name= $_POST['product_name'];
		$product_qty= $_POST['product_qty'];
		$product_price= $_POST['product_price'];
		$product_gst= $_POST['product_gst'];
		$total= $_POST['total'];
		$invoice_no=$_POST['invoice_no'];
		
		
		$table = 'tbl_order';
		$where = array();
		$select = '*';
		$total_rec = 2;
		$limit_to = '';
		$group_by = '';
		$order_by = '';
		$order = 'DESC';
		$orders = $this->user_model->get_common($table, $where, $select, $total_rec, $limit_to, $group_by, $order_by, $order);
		$order_id=$orders[0]->id;
		$table = 'coupon';
		$where = array('status' => 1);
		$dis_guser = $this->user_model->get_common($table, $where,'*',2);
		$data= array(
					//'page_title' => 'Place Order| Aaron',
					//'order_product' => $order_product,
			        'print_product' =>$_POST,
			        'dis_guser'=>$dis_guser,
			        'order_id'=>$order_id
			        );
	
		$this->load->view('admin/bill_print_edit', $data);
	}	
   
	public function save_order(){
	 error_reporting(0);
		
		$cust_name= $_POST['cust_name'];
		$cust_email= $_POST['cust_email'];
		$cust_contact= $_POST['cust_contact'];
		$cust_id= $_POST['cust_id'];
		
		$tol_unit_cost_amt= $_POST['tol_tax_val'];
		$tol_gst= $_POST['tot_gst'];
		$tot_gst_amt=$_POST['tot_gst_amt'];
		$dealer_discount=$_POST['only_discount'];
		$discount= $_POST['discount'];
		$final_value= $_POST['final_value'];
		$total_quntity=$_POST['total_quntity'];
		
		$product_id= $_POST['hid_product_id'];
		$product_name= $_POST['product_name'];
	    $product_color= $_POST['product_color'];
		$product_qty= $_POST['product_qty'];
		$product_price= $_POST['product_price'];
		$product_gst= $_POST['product_gst'];
		$total= $_POST['total'];
	    $invoice_no=$_POST['invoice_no'];
		//echo $total_quntity;
		//exit;
		if (! empty($_POST["final_value"])) {
		$insert_data = array(
						    'user_id'	=>	$cust_id,
							'name'	=>	$cust_name,
				            'mobile'	=> $cust_contact,
			                'email' => $cust_email,
			                'total_qty' =>$total_quntity,
			                'total_unit_cost' =>$tol_unit_cost_amt,
			                'total_amt' => $tol_gst, 
			                'total_gst_amt' => $tot_gst_amt,
			                'discount_per'	=>	$dealer_discount,
			                'discount_amt'	=>	$discount,
                            'final_amt'	=>	$final_value,
				            'order_status' => 1,
			                'order_by'=> $_SESSION['profile']->id
						);

			$table = 'tbl_order';
			$this->user_model->save_common($table, $insert_data);
		    $order_id = $this->db->insert_id();
			
			$table = 'tbl_order';
			$where = array('id' => $order_id);
			$update_data = array('invoice'=> 'purchase_order_'.$order_id.".pdf");
            $this->user_model->update_common($table, $where, $update_data);
		}
	   
	  
	   
			$i=0;	
			foreach ($product_name as $value) {
			$value = trim($value);
				if(empty($value)){
					
				} else {
					
			$table = 'products';
			  $where = array('product_id'=>$product_color[$i]);
			  //$this->db->where_in('product_id', $product_color[$i]);
			  $group_by = '';
			  $order_by = 'product_id';
			  $order = 'DESC';
			  $orders_id = $this->user_model->get_common($table, $where, '*', 2, '', $group_by, $order_by, $order);
			  $order_color=$orders_id[0]->product_color;
			  $quantity=$orders_id[0]->quantity;
		  
				$reqty=$quantity-$product_qty[$i];
				$wherepupt = array('product_id' => $product_id[$i]);
				$update_datapupt = array('quantity'=> $reqty);
				//$this->user_model->update_common($table, $wherepupt, $update_datapupt);
	  
				$insert_data = array(
						    'order_id'	=>	$order_id,
							'product_id'	=>	$product_id[$i],
					        'product_color'	=>	$order_color,
					        'price'	=>	$product_price[$i],
				            'gst'	=> $product_gst[$i],
			                'final_price' => $total[$i],
				            'quantity' => $product_qty[$i],
						);

				 $table = 'tbl_order_item';
				 $ins=$this->user_model->save_common($table, $insert_data);	
				}
                  $i++;
			}
			$notisubject = 'New Order Placed by dealer';
			$notimessage = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
							    <p>
							        New Order Placed by dealer, follwing are the order details: <br><br>
									Dealer Name: ".$cust_name."<br>
									Dealer Email: ".$cust_email."<br>
									Dealer Contact: ".$cust_contact."<br>
									Total Amount: ".$final_value."<br><br>
									Order at: ".date('Y-m-d H:i:s')."<br>
							    </p>

							</div>";
			//$this->save_notifications(1, $notisubject, $notimessage, $order_id);
            
	   
	        $table = 'coupon';
			$where = array('status' => 1);
			$dis_guser = $this->user_model->get_common($table, $where,'*',2);
	 
	        $table = 'dealer_discount';
			$where = array('status' => 1);
			$dis_dealer = $this->user_model->get_common($table, $where,'*',2);
			$data= array(
						//'page_title' => 'Place Order| Aaron',
						//'order_product' => $order_product,
						'print_product' =>$_POST,
						'dis_guser'=>$dis_guser,
				        'dis_dealer' =>$dis_dealer,
						);

            $this->load->view('admin/bill_print', $data);
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
			file_put_contents("site_data/uploads/order_document/purchase_order_".$order_id.".pdf", $this->dompdf->output());
			
			$pfd_file=upload_path.'order_document/purchase_order_'.$order_id.".pdf";
			
	        $email=$cust_email;
			$subject = 'Thank you for Order.';
				$message = "<div style='padding: 30px; font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; line-height: 25px; 
								font-size: 16px; font-weight: 300; color: #444'>
							    Dear ".$cust_name.",
								<p>
							        Thank you for new Order, follwing are the order details: <br><br>
									Order Total Amount: ".$final_value."<br><br>
									Order at: ".date('Y-m-d H:i:s')."<br>
									download PDF : ".$pfd_file."<br>
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
			$this->my_send_email($email, $subject, $message,$pfd_file);
			
	        $this->session->set_userdata('geust_user','');
		    
			if($ins){
				echo 1;
			 }
			else{
				  echo 0;
			  }  
	}
	
	public function getSubcriberList()
	{
		//$this->check_login();
		$status = $_POST['status'];
		/* if($status==0)
		{
			$where = array();
		}
		else{
			$where = array('status_id' => $status);
		} */
		$where = array();
		$table = 'ebrochure_user';
		 // 0- deleted
		
		$subscribers_list = $this->user_model->get_common($table, $where,'*',2,'','email');

		$data = array('subscribers_list' => $subscribers_list);
		
		$this->load->view('admin/get_subcriber_list', $data);
	}

	public function getorderList()
	{
		error_reporting(0);
		//$this->check_login();
		$status = $_POST['status'];
		$where = array();
		$table = 'tbl_order';
		$order_list_pro = $this->user_model->get_common($table, $where,'*',2,'','user_id');
			foreach($order_list_pro as $order_list){
				$wherec = array('id' => $order_list->user_id);
				$user_email = $this->user_model->get_common('user', $wherec,'*',1,'','email');
				$order_list->email = $user_email->email;
				$user_list[] = $order_list;
			}
 
		$data = array('user_list' => $user_list);
		
		$this->load->view('admin/get_user_list', $data);
	}


	public function getdealerList()
	{
		//$this->check_login();
		$status = $_POST['status'];
		/* if($status==0)
		{
			$where = array();
		}
		else{
			$where = array('status_id' => $status);
		} */
		$where = array();
		
		$table = 'dealer';
		 // 0- deleted
		
		$dealer_list = $this->user_model->get_common($table, $where,'*',2);

		$data = array('dealer_list' => $dealer_list);
		
		$this->load->view('admin/get_dealer_list', $data);
	}
	
	public function getcommentuserList()
	{
		//$this->check_login();
		$status = $_POST['status'];
		$blog_id = $_POST['blog_id'];
		
		/* if($status==0)
		{
			$where = array();
		}
		else{
			$where = array('status_id' => $status,'blog_id' => $blog_id);
		} */
		$where = array('blog_id' => $blog_id);
		
		$table = 'blog_comments';
		 // 0- deleted
		
		$commentuser_list = $this->user_model->get_common($table, $where,'*',2,'','email');

		$data = array('commentuser_list' => $commentuser_list);
		
		$this->load->view('admin/get_commentuser_list', $data);
	}

	function get_dealer(){
		$dealer_name=$_REQUEST['term'];
		
		$table = 'dealer';
		$where = array('status_id' => 1);
		$dealer_arr = $this->user_model->get_common($table, $where,'*',2);

		if(count($dealer_arr) && is_array($dealer_arr)){
			foreach($dealer_arr AS $key => $val){
				$json[]=array(
                    'value'=> $val->name,
                    'label'=>$val->name,
					'id'=>$val->id,
					'email'=>$val->email,
					'contact'=>$val->contact
                        );
			}
		}
		print json_encode($json);
		exit;
   }
   
   function change_product_position(){
		error_reporting(0);
		$product_id=$_POST['product_id'];
		$position=$_POST['position'];
		$sub_category=$_POST['sub_category'];
		$child_category=$_POST['child_category'];
		
		if($child_category){
							
			$olp = $this->db->query('SELECT position FROM products WHERE product_id='.$product_id.' AND sub_category='.$sub_category.' AND child_category='.$child_category.' AND status !=0');
			$old_pos= $olp->result(); 
			$old_position = $old_pos[0]->position;
			
			$np = $this->db->query('SELECT * FROM products WHERE position='.$position.' AND sub_category='.$sub_category.' AND child_category='.$child_category.' AND status !=0');
			$new_pro= $np->result(); 
			$new_product = $new_pro[0]->product_id;
			$new_product_pos = $new_pro[0]->position;
			
			$table = 'products';
			$where = array('product_id' => $product_id,'sub_category'=>$sub_category,'child_category'=>$child_category);
			$updateData = array('position' => $position);
			$upt=$this->user_model->update_common($table, $where, $updateData);
		
		}else{
			
			$olp = $this->db->query('SELECT position FROM products WHERE product_id='.$product_id.' AND sub_category='.$sub_category.' AND status !=0');
			$old_pos= $olp->result(); 
			$old_position = $old_pos[0]->position;
			
			$np = $this->db->query('SELECT * FROM products WHERE position='.$position.' AND sub_category='.$sub_category.' AND status !=0');
			$new_pro= $np->result(); 
			$new_product = $new_pro[0]->product_id;
			$new_product_pos = $new_pro[0]->position;
			
			$table = 'products';
			$where = array('product_id' => $product_id,'sub_category'=>$sub_category);
			$updateData = array('position' => $position);
			$upt=$this->user_model->update_common($table, $where, $updateData);
			
		}	
		
		$tableo = 'products';
		$whereo = array('product_id'=>$new_product);
		$updateDatao = array('position' => $old_position);
		$upt=$this->user_model->update_common($tableo, $whereo, $updateDatao);
		
		
		$table = 'products';
		$where = array('status !=' => 0);
		$group_by = '';
		$order_by = '';
		$order = '';
		$this->db->order_by("sub_category","");
		$this->db->order_by("child_category","");
		$this->db->order_by("position","");
		$product = $this->user_model->get_common($table, $where,'*',2, '', $group_by, $order_by, $order);

		$data = array('product' => $product);
		$data['active_menu'] = 'product';

		$this->load->view('admin/bind_product_data', $data);
		/* if($upt){
			echo 1;
		}else{ 
			echo 0; 
		} */
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
	
		
	function product_series(){

		$table = 'authenticate';
		$where = array('status !=' => 0);
		$series = $this->user_model->get_common($table, $where,'*',2);
       // print_r($category);
		$data = array('series' => $series);
		$data['active_menu'] = 'product';
		$this->load->view('admin/series', $data);
		
	}
	
	function update_edit_series(){

		$this->form_validation->set_rules ( 'start_number', 'From Number', 'required|numeric|min_length[1]|max_length[6]' );
		$this->form_validation->set_rules ( 'end_number', 'To Number', 'required|numeric|min_length[1]|max_length[6]' );
		  
		if($this->form_validation->run()==false){

			$this->edit_series($_POST['id']);
			
		}else{

			$update_data = array(
				'start_number'	=>	$_POST['start_number'],
				'end_number'	=>	$_POST['end_number']
			);
			 
			$table = 'authenticate';
			$where = array('id' => $_POST['id']);
			$this->user_model->update_common($table, $where, $update_data);

			$this->session->set_flashdata("success_message","Product Series updated successfully.");
			redirect(base_url('admin/product_series'));
		}
	}
	
	function update_series_status($status, $id){
		$where = array('id' => $id);
		$updateData = array('status' => $status);

		$this->user_model->update_common('authenticate', $where, $updateData);

		if($status == 0){
			$this->set_flashdata('success', 'Product Series deleted successfully.');
		}else{
			$this->set_flashdata('success', 'Status updated successfully.');
		}

		redirect(base_url('admin/product_series'));
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
