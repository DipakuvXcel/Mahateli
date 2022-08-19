<?php 
	$this->load->view('site/_includes/header');
?>
<style>
.clearfix:after {
  content: "";
  display: block;
  clear: both;
  visibility: hidden;
  height: 0;
}

.form_wrapper {
  background: #D3E9B6;
  width: 700px;
  max-width: 100%;
  box-sizing: border-box;
  padding: 25px;
  margin: 8% auto 0;
  margin-top: 0% !important;
  position: relative;
  /* z-index: 1; */
  border-top: 5px solid #f5ba1a;
  -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
  box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
  -webkit-transform-origin: 50% 0%;
  transform-origin: 50% 0%;
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  -webkit-transition: none;
  transition: none;
  -webkit-animation: expand 0.8s 0.6s ease-out forwards;
  animation: expand 0.8s 0.6s ease-out forwards;
  opacity: 0;
}
.form_wrapper h2 {
  font-size: 1.5em;
  line-height: 1.5em;
  margin: 0;
  text-transform: capitalize;
}
.form_wrapper .title_container {
  text-align: center;
  padding-bottom: 15px;
}
.form_wrapper h3 {
  font-size: 1.1em;
  font-weight: normal;
  line-height: 1.5em;
  margin: 0;
}
.form_wrapper label {
  font-size: 16px;
  padding-right: 20px;
  padding-left: 8px;
}
}
.form_wrapper .row {
  margin: 10px -15px;
}
.form_wrapper .row > div {
  padding: 0 15px;
  box-sizing: border-box;
}
.form_wrapper .col_half {
  width: 50%;
  float: left;
}
.details {
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
  color: #000;
}
.form_wrapper .input_field {
  position: relative;
  margin-bottom: 20px;
  -webkit-animation: bounce 0.6s ease-out;
  animation: bounce 0.6s ease-out;
}
.form_wrapper .input_field > span {
  position: absolute;
  left: 0;
  top: 0;
  color: #333;
  height: 100%;
  border-right: 1px solid #cccccc;
  text-align: center;
  width: 50px;
}
.form_wrapper .input_field > span > i {
  padding-top: 10px;
}
.form_wrapper .textarea_field > span > i {
  padding-top: 10px;
}
.input {
  width: 100%;
  padding: 8px 10px 9px 8px;
  height: 38px;
  border: 1px solid #cccccc;
  box-sizing: border-box;
  outline: none;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.text-l,.form_wrapper input[type=text],.form_wrapper input[type=date], .form_wrapper input[type=number], .form_wrapper input[type=email], .form_wrapper input[type=password] {
  width: 100%;
  padding: 8px 10px 9px 55px;
  height: 38px;
  border: 1px solid #cccccc;
  box-sizing: border-box;
  outline: none;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.text-l {
  -webkit-appearance: none;
}
.form_wrapper input[type=text]:hover, .form_wrapper input[type=email]:hover, .form_wrapper input[type=password]:hover {
  background: #fafafa;
}
.form_wrapper input[type=text]:focus, .form_wrapper input[type=email]:focus, .form_wrapper input[type=password]:focus {
  -webkit-box-shadow: 0 0 2px 1px rgba(255, 169, 0, 0.5);
  -moz-box-shadow: 0 0 2px 1px rgba(255, 169, 0, 0.5);
  box-shadow: 0 0 2px 1px rgba(255, 169, 0, 0.5);
  border: 1px solid #f5ba1a;
  background: #fafafa;
}
.form_wrapper input[type=submit] {
  background: #9EB649;
  height: 40px;
  line-height: 35px;
  width: 200px;
  border: none;
  border-radius: 100px;
  outline: none;
  cursor: pointer;
  color: #fff;
  font-size: 1.1em;
  margin-bottom: 10px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.inputbutton {
  display: flex;
    width: 100%;
    justify-content: center;
}
.form_wrapper input[type=submit]:hover {
  background: #e1a70a;
}
.form_wrapper input[type=submit]:focus {
  background: #e1a70a;
}
.form_wrapper input[type=checkbox], .form_wrapper input[type=radio] {
  border: 0;
  clip: rect(0 0 0 0);
  height: 15px;
  margin: -1px;
  overflow: hidden;
  padding: 0 12px;
  /* position: absolute; */
  width: 15px;
}

.form_container .row .col_half.last {
  border-left: 1px solid #cccccc;
}

.checkbox_option label {
  margin-right: 1em;
  position: relative;
}
.select_option {
  position: relative;
  width: 100%;
}
.select_option select {
  display: inline-block;
  width: 100%;
  height: 35px;
  padding: 0px 15px;
  cursor: pointer;
  color: #7b7b7b;
  border: 1px solid #cccccc;
  border-radius: 0;
  background: #fff;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  transition: all 0.2s ease;
}
.select_option select::-ms-expand {
  display: none;
}
.select_option select:hover, .select_option select:focus {
  color: #000000;
  background: #fafafa;
  border-color: #000000;
  outline: none;
}

.select_arrow {
  position: absolute;
  top: calc(50% - 4px);
  right: 15px;
  width: 0;
  height: 0;
  pointer-events: none;
  border-width: 8px 5px 0 5px;
  border-style: solid;
  border-color: #7b7b7b transparent transparent transparent;
}

.select_option select:hover + .select_arrow, .select_option select:focus + .select_arrow {
  border-top-color: #000000;
}

.credit {
  position: relative;
  z-index: 1;
  text-align: center;
  padding: 15px;
  color: #f5ba1a;
}
.credit a {
  color: #e1a70a;
}

@-webkit-keyframes check {
  0% {
    height: 0;
    width: 0;
  }
  25% {
    height: 0;
    width: 7px;
  }
  50% {
    height: 20px;
    width: 7px;
  }
}
@keyframes check {
  0% {
    height: 0;
    width: 0;
  }
  25% {
    height: 0;
    width: 7px;
  }
  50% {
    height: 20px;
    width: 7px;
  }
}
@-webkit-keyframes expand {
  0% {
    -webkit-transform: scale3d(1, 0, 1);
    opacity: 0;
  }
  25% {
    -webkit-transform: scale3d(1, 1.2, 1);
  }
  50% {
    -webkit-transform: scale3d(1, 0.85, 1);
  }
  75% {
    -webkit-transform: scale3d(1, 1.05, 1);
  }
  100% {
    -webkit-transform: scale3d(1, 1, 1);
    opacity: 1;
  }
}
@keyframes expand {
  0% {
    -webkit-transform: scale3d(1, 0, 1);
    transform: scale3d(1, 0, 1);
    opacity: 0;
  }
  25% {
    -webkit-transform: scale3d(1, 1.2, 1);
    transform: scale3d(1, 1.2, 1);
  }
  50% {
    -webkit-transform: scale3d(1, 0.85, 1);
    transform: scale3d(1, 0.85, 1);
  }
  75% {
    -webkit-transform: scale3d(1, 1.05, 1);
    transform: scale3d(1, 1.05, 1);
  }
  100% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
    opacity: 1;
  }
}
@-webkit-keyframes bounce {
  0% {
    -webkit-transform: translate3d(0, -25px, 0);
    opacity: 0;
  }
  25% {
    -webkit-transform: translate3d(0, 10px, 0);
  }
  50% {
    -webkit-transform: translate3d(0, -6px, 0);
  }
  75% {
    -webkit-transform: translate3d(0, 2px, 0);
  }
  100% {
    -webkit-transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
@keyframes bounce {
  0% {
    -webkit-transform: translate3d(0, -25px, 0);
    transform: translate3d(0, -25px, 0);
    opacity: 0;
  }
  25% {
    -webkit-transform: translate3d(0, 10px, 0);
    transform: translate3d(0, 10px, 0);
  }
  50% {
    -webkit-transform: translate3d(0, -6px, 0);
    transform: translate3d(0, -6px, 0);
  }
  75% {
    -webkit-transform: translate3d(0, 2px, 0);
    transform: translate3d(0, 2px, 0);
  }
  100% {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
@media (max-width: 600px) {
  .form_wrapper .col_half {
    width: 100%;
    float: none;
  }

  .bottom_row .col_half {
    width: 50%;
    float: left;
  }

  .form_container .row .col_half.last {
    border-left: none;
  }

  .remember_me {
    padding-bottom: 20px;
  }
}
.padding_layout_1_small{
	padding-top: 0px !important;
}
.address-title {
  font-size: 20px;
  font-weight: 500;
}
/* radio button */
form .gender-details .gender-title {
  font-size: 20px;
  font-weight: 500;
  color: #000;
}

form .gender-details .category {
  display: flex;
  width: 45%;
  justify-content: space-between;
  margin: 14px 0;
}

.gender-details .category label {
  display: flex;
  align-items: center;
  color: #000;
}

.gender-details .category .dot {
  height: 18px;
  width: 18px;
  background: #f2f2f2;
  border-radius: 50%;
  margin-right: 10px;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}
@media (max-width: 584px) {
  form .gender-details .category {
    width: 100%;
  }
}
#dot-1:checked ~ .category label .one,
#dot-2:checked ~ .category label .two,
#dot-3:checked ~ .category label .three {
  border-color: #a8a7a7;
  background: #000;
}
form input[type="radio"] {
  display: none;
}
/* radio button */
/* user radio */
.show_user{
  display: flex;
  width: 100%;
  justify-content: flex-start;
}
.container_display {
  display: block;
  position: relative;
  padding-left: 40px!important;
  margin-bottom: 12px!important;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container_display input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: -4px;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container_display:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container_display input:checked ~ .checkmark {
  background-color: #000;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container_display input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container_display .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
.hide {
  display: none;
}
#error {
  display: block;
  color: red;
  margin: 5px 0 0 0;
}
[type="file"] {
/* Style the color of the message that says 'No file chosen' */
  color: #878787;
}
[type="file"]::-webkit-file-upload-button {
  background: #e1a70a;
  border: 2px solid #ED1C1B;
  border-radius: 4px;
  color: #fff;
  cursor: pointer;
  font-size: 12px;
  outline: none;
  padding: 10px 25px;
  text-transform: uppercase;
  transition: all 1s ease;
}

[type="file"]::-webkit-file-upload-button:hover {
  background: #fff;
  border: 2px solid #535353;
  color: #000;
}

</style>
<div class="section padding_layout_1_small" style="padding-top: 20px !important;">
    <div class="row">
		<div class="form_wrapper">
		<div class="form_container">
			<div class="title_container">
			<h2> Registration Form</h2>
			</div>
      <form id="registration_form" action="<?php echo base_url('site/save_registration');?>"  method="post" autocomplete="off" enctype="multipart/form-data" >
							<?php if($this->session->flashdata("error_message")!=""){?>
							 <div class="Metronic-alerts alert swal alert-danger">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i> <?php echo $this->session->flashdata("error_message");?>
			                </div>
							<?php }?>
			              
							<?php if(validation_errors()!=""){?>
			                <div
								class="Metronic-alerts alert swal alert-danger">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  <?php echo validation_errors();?>
			                </div>
							<?php }?>
			              
							<?php if( $this->upload->display_errors()!=""){?>
			                <div
								class="Metronic-alerts alert swal alert-danger">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  <?php echo  $this->upload->display_errors();?>
			                </div>
							<?php }?>
        <div class="title_container">
         <span class="details">Foundation Name :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-briefcase"></i></span> 
          <select name="foundation" class="text-l" id="foundation" required>
          <?php for($i=0;$i<count($foundation);$i++){ ?>
            <option value="<?= $foundation[$i]->id ?>" > <?php echo $foundation[$i]->foundation_name; ?></option>
          <?php } ?>  
          </select>
           <div class="select_arrow"></div>
					</div>
        </div>
				<div class="row clearfix">
					<div class="col_half">
          <span class="details">First Name :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
          <input type="text" id="fname" name="fname"   maxlength="25"alt="Only 25 Character Allowed" placeholder="First Name" value="<?= set_value('fname'); ?>"  required />
					</div>
					</div>
					<div class="col_half">
          <span class="details">Middle Name :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
          <input type="text" id="mname" name="mname"  maxlength="25"alt="Only 25 Character Allowed"  placeholder="Middle Name" value="<?= set_value('mname'); ?>" required />
					</div>
					</div>
					<div class="col_half">
          <span class="details">Last Name :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
          <input type="text" id="lname" name="lname"  maxlength="25"alt="Only 25 Character Allowed"  placeholder="Last Name" value="<?= set_value('lname'); ?>" required />
					</div>
					</div>
          <div class="col_half">
          <span class="details">Contact Number :</span>
          <div class="input_field"> <span>
                <select name="contcode" style="width:50px;height:100%;">
                  <option value="1">+ 91</option>
                  <option value="2">+ 1</option>
                  <option value="3">+ 2</option>
                  <option value="4">+ 3</option>
                  <option value="5">+ 4</option>
                  <option value="6">+ 5</option>
                  <option value="7">+ 6</option>
                  <option value="8">+ 7</option>
                  <option value="9">+ 8</option>
                  <option value="10">+ 9</option>
                  <option value="11">+ 10</option>
                  <option value="12">+ 11</option>
                </select>
                </span>
                <input  type="number" id="contact" name="contact"  placeholder="Contact Number" value="<?= set_value('contact'); ?>" required  ng-model="number" onKeyPress="if(this.value.length==10) return false;" min="0">
                </div>
              </div>
              <div class="col_half">
              <span class="details">Date of Birth :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-calendar"></i></span>
          <input type="date" name="date" class="form-control" id="Date" placeholder="DD-MM-YYYY" value="<?= set_value('date'); ?>" required>
					</div>
					</div>
          <div class="col_half">
          <span class="details">Marital Status :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
          <select name="marital_status" class="text-l" required>
          <option value="" selected="selected">-Marital Status-</option>
          <?php for($j=0;$j<count($marital_status);$j++){ ?>
            <option value="<?= $marital_status[$j]->id ?>" > <?php echo $marital_status[$j]->marital_status_name; ?></option>
          <?php } ?>
          </select>
          	<div class="select_arrow"></div>
					</div>
					</div>
          <div class="col_half">
          <span class="details">Mother tongue :</span>
					<div class="input_field"><span><i aria-hidden="true" class="fa fa-language"></i></span>
          <select name="language" class="text-l" id="language" required>
          <?php for($k=0;$k<count($language);$k++){ ?>
            <option value="<?= $language[$k]->id ?>" > <?php echo $language[$k]->language_name; ?></option>
          <?php } ?>
          </select>
          <div class="select_arrow"></div>
				</div>              
				</div>  
        <div class="col_half">
        <span class="details">Religion :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
          <select name="religion" class="text-l" id="religion" required>
          <?php for($l=0;$l<count($religion);$l++){ ?>
            <option value="<?= $religion[$l]->id ?>" > <?php echo $religion[$l]->religion; ?></option>
          <?php } ?>          
          </select>
          <div class="select_arrow"></div>
					</div>
					</div>
          <div class="col_half">
          <span class="details">Caste :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
          <select name="caste" class="text-l" id="caste" required>
            <option value="Teli" > Teli</option>    
                </select>
                <div class="select_arrow"></div>
					</div>
					</div>    
          <div class="col_half">
          <span class="details">Sub Caste :</span>
            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
             <input type="text" id="sub_caste" name="sub_caste"  maxlength="25"alt="Only 25 Character Allowed" placeholder="Sub Caste" value="<?= set_value('sub_caste'); ?>" required>        
            </div>  
				  </div>  
				</div>  
        <div class="gender-details">
        <span class="gender-title">Gender</span>
          <input type="radio" name="gender" id="dot-1"  value="male">
          <input type="radio" name="gender" id="dot-2"  value="female">
          <input type="radio" name="gender" id="dot-3"  value="transgender">
           <div class="category">
              <label for="dot-1">
                <span class="dot one"></span>
                <span class="gender">Male</span>
              </label>
              <label for="dot-2">
                <span class="dot two"></span>
                <span class="gender">Female</span>
              </label>
              <label for="dot-3">
                <!-- <span class="dot three"></span> -->
                <span class="gender"></span>
              </label>
            </div>
        </div><br>
        <h2 class="address-title">Permanent / Residential Address : </h2>
        <br>
        <span class="details">Address :</span>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-map-marker"></i></span>
					<input type="text" id="res_address" name="res_address"  placeholder="Address" value="<?= set_value('res_address'); ?>" required>
				</div>
        <div class="row clearfix">
					<div class="col_half">
          <span class="details">Landmark :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-building-o"></i></span>
					<input class="form-control text-l" type="text"  maxlength="25"alt="Only 25 Character Allowed" id="res_landmark" name="res_landmark"  placeholder="Landmark" value="<?= set_value('res_landmark'); ?>" required>
					</div>
					</div>
          <div class="col_half">
          <span class="details">City :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-map-marker"></i></span>
          <input class="form-control text-l" type="text"  maxlength="25"alt="Only 25 Character Allowed" id="res_city" name="res_city"  placeholder="City" value="<?= set_value('res_city'); ?>" required>
					</div>
					</div>
          <div class="col_half">
          <span class="details">District :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-map-marker"></i></span>
          <input class="form-control text-l" type="text"  maxlength="25"alt="Only 25 Character Allowed" id="res_district" name="res_district"  placeholder="District" value="<?= set_value('res_district'); ?>" required>
					</div>
					</div>
          <div class="col_half">
          <span class="details">Pincode :</span>
					<div class="input_field"> <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
          <input class="form-control text-l" type="number"  id="res_pincode" name="res_pincode"  placeholder="Pincode" value="<?= set_value('res_pincode'); ?>" onKeyPress="if(this.value.length==6) return false;" min="0" required>
					</div>
					</div>
					<div class="col_half">
          <span class="details">State :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-map-marker"></i></span>
          <input class="form-control text-l" type="text"  maxlength="25"alt="Only 25 Character Allowed" id="res_state" name="res_state"  placeholder="State" value="<?= set_value('res_state'); ?>" required>
					</div>
					</div>
          <div class="col_half">
          <span class="details">Country :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-flag"></i></span>
					<input class="form-control text-l" type="text"  maxlength="25"alt="Only 25 Character Allowed" id="res_country" name="res_country"  placeholder="Country" value="<?= set_value('res_country'); ?>" required>
					</div>
					</div>
          </div>
          <div class="row clearfix"style="margin-left: 2px;">
          <h5 style="text-transform: capitalize;">Same as Permanent / Residential Address</h5> &nbsp;&nbsp;&nbsp;<input type="checkbox" value="" style="height:20px;" name="filltoo" id="filltoo" onclick="filladd()" /> <br/>
              </div>
              <br>
        <h2 class="address-title">Address for correspondence:</h2>
        <br>
        <span class="details">Address :</span>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-map-marker"></i></span>
          <input type="text" id="corr_address" name="corr_address"  placeholder="Address" value="<?= set_value('corr_address'); ?>">
				</div>
        <div class="row clearfix">
        <div class="col_half">
          <span class="details">Landmark :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-building-o"></i></span>
					<input class="form-control text-l" type="text"  maxlength="25"alt="Only 25 Character Allowed" id="corr_landmark" name="corr_landmark"  placeholder="Landmark" value="<?= set_value('corr_landmark'); ?>">
					</div>
					</div>
          <div class="col_half">
          <span class="details">City :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-map-marker"></i></span>
          <input class="form-control text-l" type="text"  maxlength="25"alt="Only 25 Character Allowed" id="corr_city" name="corr_city"  placeholder="City" value="<?= set_value('corr_city'); ?>">
					</div>
					</div>
          <div class="col_half">
          <span class="details">District :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-map-marker"></i></span>
          <input class="form-control text-l" type="text"  maxlength="25"alt="Only 25 Character Allowed" id="corr_district" name="corr_district"  placeholder="District" value="<?= set_value('corr_district'); ?>">
					</div>
					</div>
          <div class="col_half">
          <span class="details">Pincode :</span>
					<div class="input_field"> <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
          <input class="form-control text-l" type="number"  id="corr_pincode" name="corr_pincode"  placeholder="Pincode" value="<?= set_value('corr_pincode'); ?>" onKeyPress="if(this.value.length==6) return false;" min="0">
					</div>
					</div>
          <div class="col_half">
          <span class="details">State :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-map-marker"></i></span>
          <input class="form-control text-l" type="text"  maxlength="25"alt="Only 25 Character Allowed" id="corr_state" name="corr_state"  placeholder="State" value="<?= set_value('corr_state'); ?>">
					</div>
					</div>
					<div class="col_half">
          <span class="details">Country :</span>
					<div class="input_field"> <span><i aria-hidden="true" class="fa fa-flag"></i></span>
					<input type="text" style="color:gray;" class="form-control text-l" maxlength="25"alt="Only 25 Character Allowed" id="corr_country" name="corr_country"  placeholder="Country" value="<?= set_value('corr_country'); ?>">
					</div>
					</div>
          </div>
          <br>
        <h2 class="address-title">Open New Account : </h2>
        <br>
        <div class="show_user">
          <label class="container_display">Email Id 
            <input type="radio" name="radio" onclick="show1();">
            <span class="checkmark"></span>
          </label>
          <label class="container_display">Mobile Number
            <input type="radio" name="radio" onclick="show2();">
            <span class="checkmark"></span>
          </label>
        </div>
        <div id="mobile" class="hide">
          <span class="details">Mobile Number :</span>
				<div class="input_field"><span>
                <select name="contcode" style="width:50px;height:38px;">
                  <option value="1">+ 91</option>
                  <option value="2">+ 1</option>
                  <option value="3">+ 2</option>
                  <option value="4">+ 3</option>
                  <option value="5">+ 4</option>
                  <option value="6">+ 5</option>
                  <option value="7">+ 6</option>
                  <option value="8">+ 7</option>
                  <option value="9">+ 8</option>
                  <option value="10">+ 9</option>
                  <option value="11">+ 10</option>
                  <option value="12">+ 11</option>
                </select>
                </span>
          <input type="number" id="mo_number" name="mo_number"  placeholder="Mobile Number" value="<?= set_value('mo_number'); ?>" ng-model="number" onKeyPress="if(this.value.length==10) return false;" min="0">
          <span style="color:gray;display: contents;" class="input_field">Mobile Number is considered as Username</span>
				</div>
        </div>
        <div id="email" class="hide">
          <span class="details">Email Id :</span>
				<div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
          <input type="email" id="email_id" name="email_id"  placeholder="Email Id" value="<?= set_value('email_id'); ?>" >
          <span style="color:gray;display: contents;" class="input_field">Email Id is considered as Username</span>
				</div>
       	</div>
        <div id="password" class="hide">
        <div class="row clearfix">
					<div class="col_half">
          <span class="details">Password :</span>
				<div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
					<input type="Password"  placeholder="Password" id="password" name="password" value="<?= set_value('password'); ?>">
          <span style="color:gray;display: contents;"  >Password should contain minimum 6 Characters</span>
				</div>
				</div>
					<div class="col_half">
          <span class="details">Re-type Password :</span>
				<div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
          <input type="Password"   placeholder="Re-type Password" id="conf_password" name="conf_password" value="<?= set_value('conf_password'); ?>">
          <span style="color:gray;display: contents;"  >Password should contain minimum 6 Characters</span>
				</div>
				</div>
				</div>
				</div>
			
        <div class="gender-details" style="margin-top:3%;">
        <div class="form-group">
          <label class="control-label"><b>Profile Image</b></label><span style="color:red">*</span><br>
          <div class="fileinput fileinput-new"
            data-provides="fileinput">
            <img id="blah" src="#" style="display:none;" alt="your image" />
            <div class="input-group input-large">
              <span class="input-group-addon btn default btn-file"> 
                <span class="fileinput-new"> Select file </span> 
                <input type="file" name="image" onchange="readURL(this);" accept="image/*">
              </span> 
              
              <a href="javascript:;" class="input-group-addon red fileinput-exists" style="margin: 16px -1px;" data-dismiss="fileinput" onclick="removeSingleImg()">X</a>
                
            </div>
          </div>
          <span class="help-block"> Allowed file types .jpg, .png</span>
        </div>

          </div>
        <br>
					<div class="input_field checkbox_option">
						<input type="checkbox" id="cb1" required>
						<label for="cb1"><a href="<?php echo base_url('terms_conditions'); ?>" target="_blank" class="s-text13 ablue">I agree with Terms & Conditions</a></label>
					</div>
          <div class="inputbutton">
				    <input class="button" id="idOfButton" type="submit" value="Sign Up" />
           </div>
				</form>
			</div>
			</div>
		</div>
		</div>
		</div>
    <script>
    //   document.getElementById("idOfButton").onclick = function() {
    // //disable
    // this.disabled = true;

    //do some validation stuff
}
	//CKEDITOR.replace( 'editor1' );
	//CKEDITOR.replace( 'editor2' );
	$(".my-datepicker").datepicker({ 
        minDate: 0,
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "-20:+0"
    });
    </script>
    
<script>
  function show1() {
document.getElementById("email").style.display = "block";
document.getElementById("password").style.display = "block";
document.getElementById("mobile").style.display = "none";
}
function show2() {
  document.getElementById("mobile").style.display = "block";
  document.getElementById("password").style.display = "block";
  document.getElementById("email").style.display = "none";
}

function filladd()
{
	 if(filltoo.checked == true) 
     {
            var add =document.getElementById("res_address").value;
            var land =document.getElementById("res_landmark").value;
            var city =document.getElementById("res_city").value;
            var disti =document.getElementById("res_district").value;
            var pincd =document.getElementById("res_pincode").value;
            var state =document.getElementById("res_state").value;
            var count =document.getElementById("res_country").value;

            var copyadd =add ;
            var copyland =land ;
            var copycity =city ;
            var copydisti =disti ;
            var copypincs =pincd ;
            var copystate =state ;
            var copycount =count ;

            
            document.getElementById("corr_address").value = copyadd;
            document.getElementById("corr_landmark").value = copyland;
            document.getElementById("corr_city").value = copycity;
            document.getElementById("corr_district").value = copydisti;
            document.getElementById("corr_pincode").value = copypincs;
            document.getElementById("corr_state").value = copystate;
            document.getElementById("corr_country").value = copycount;
	 }
	 else if(filltoo.checked == false)
	 {
		 document.getElementById("corr_address").value='';
		 document.getElementById("corr_landmark").value='';
		 document.getElementById("corr_city").value='';
		 document.getElementById("corr_district").value='';
		 document.getElementById("corr_pincode").value='';
		 document.getElementById("corr_state").value='';
		 document.getElementById("corr_country").value='';
	 }
}

function readURL(input) {
		
    if (input.files && input.files[0]) {
  $('#blah').show();
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(98)
                .height(90);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
function removeSingleImg(){
		$('#blah').hide();
	}
</script>
    <?php 
	$this->load->view('site/_includes/footer');
?>