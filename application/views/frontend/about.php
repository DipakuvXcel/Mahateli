<?php 
	$this->load->view('frontend/_includes/header');
?>
<style>
.para-about{
	margin-left: 5%;
margin-right: 5%;
text-indent: 5%;
color:#000;
 

}

.para-about2{
	margin-left: 5%;
margin-right: 5%;
text-indent: 5%;
}

.list-about{
	font-family: Arial;
	font-size: 17px;
	line-height: 1.7;
	color: #000;
	 
	margin-left: 15%;
	margin-right: 5%;
	margin-bottom:28px;
}

.about-author{
	margin-left: 5%;
text-indent: 5%;
margin-right: 5%;
margin-top: 2%;
margin-bottom: 2%;
}
.content{
	 
  bottom: 0;
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
}
.about-us-background{
	background-image: url(<?php echo assets_path."img/logo.png"; ?>);
	background-size: 95%;
	position: relative; 
}
 
.about-us-background2{
	background: linear-gradient(0deg,rgba(15, 15, 15, 0.6),rgba(32, 30, 31, 0.3)),url(<?php echo assets_path."img/slider1.jpeg"; ?>);
	background-size: 200%;
}
.abt-bck{background: #3e7ce00f;}

* {
  box-sizing: border-box;
}

p {
  font-family: Arial;
  font-size: 17px;
}

.container {
  position: relative;
  padding-right: 0px; 
   padding-left: 0px;
}

.container img {vertical-align: middle;}

.container .content {
  position: relative;
  bottom: 0;
  background: transparent; 
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
}
@media (max-width:420px ) {
  .img-res {
    display:none;
}
.container .content {
  position: inherit;
}
}

 
</style>

    <!--================Header Menu Area =================-->

   <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelO2.png);">
		<!--<h2 class="l-text2 t-center">
			About
		</h2>-->
	</section>
	
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
		About Us
		</span>
	</div>
	
	
	<div class="container">
	<h2 class="m-text5 t-center">
		About Us
	</h2><hr>
	</div>
	<!-- content page -->
	<section class="bgwhite p-t-30 abt-bck " >
		<div class="container about-us-background">
		 <!--<img src="<?php echo assets_path."img/slider1.jpeg"; ?>" alt="Notebook"class="img-res" style="opacity: 0.1;width:95%;">-->
			<div class="content bo13">
					<h3  class="text-center m-text5" style=" margin-top:3%;">
						Our story
						<hr>
					</h3>

					<p class="p-b-28 para-about">
					<font style="">Kiran Pharmaceutical&#174;</font>&nbsp; is the parent company with two divisions i.e. Pharmaceutical and Sports Nutrition with the brand name of <font color="#308ae4" style="">MYFUEL&#174;&nbsp;</font>. 
					The logo of <font style="">Kiran Pharmaceutical&#174;</font>  with the shape a torch held up symbolizes life, truth and the regenerative power of flame. 
					</p>

					<p class="p-b-20 para-about">
					<font color="#308ae4" style="">MYFUEL&#174;</font>, logo symbolizes power, strength and speed. 
					</p>
					
					<p class="p-b-20 para-about">
					The same has been delivered through our <font color="#308ae4" style="">MYFUEL&#174;</font> series of products. 
					<font style="">Kiran Pharmaceutical&#174;</font>&#174; Established in the year 2006, is an ambitious company started with a view to launch high quality, research based innovative products in the field of Paediatrics, Orthopaedics, Gynaecology, Dermatology and Sports Nutrition. 
					</p>

					<p class="p-b-20 para-about">
					<font style="">Kiran Pharmaceutical&#174;</font> , in the year 2016, has started with its own ISO & GMP APPROVED FOOD MANUFACTURING UNIT in Pune, Maharashtra <bold style="font-weight: 700;"> (A MAKE IN INDIA INITIATIVE)</bold>. 
					<font style="">Kiran Pharmaceutical&#174;</font> , displayed its ability to come with new research based unique product with the launch of Two First Time in India Products i.e. LACEASE DROP AND JODVARDHAK OIL, in the segments of Paediatrics and Pain Management.
					</p>
					
					<p class="p-b-20 para-about">
					<font style="">Kiran Pharmaceutical&#174;</font>  having buckled up its athletic spirit, has launched a new division in the fitness and Sports Nutrition world, with the brand name <font color="#308ae4" style="">MYFUEL&#174;</font>. 
					It attempts to bring a paradigm shift in the sports industry by moving the focus from mere aesthetics, to function and performance. 
					<font style="">Kiran Pharmaceutical&#174;</font> , displayed its ability to once again come with new research based unique product with the launch of <font color="#308ae4" style="">MYFUEL&#174;</font> series of products containing a unique imported ingredient to control muscle degeneration and support in the growth of muscles.
					This range of Whey Protein launched under the brand name of <font color="#308ae4" style="">MYFUEL&#174;</font> is First Time India Products, which are approved by the <font color="#538fcc">FSSAI</font>.  
					All the <font color="#308ae4" style="">MYFUEL&#174;</font> brands are manufactured with world class key ingredients like Whey Protein being sourced from Glanbia, the worldwide leader in manufacturing of raw whey protein. 
					<font style="">Kiran Pharmaceutical&#174;</font>  is awarded with the stringent <font color="#538fcc">FSSAI, GMP</font> and <font color="#538fcc">ISO</font> certifications. 
					Therefore, proactive steps are taken to ensure that <font color="#308ae4" style="">MYFUEL&#174;</font> brands are safe, pure and effective.
					</p>
					
					<p class="p-b-20 para-about">
						All products manufactured are independently tested with <font color="#538fcc">FSSAI</font> accredited Laboratory on regular basis to ensure all <font color="#308ae4" style="">MYFUEL&#174;</font> brands are meeting the label requirements. 
						As a part of this procedure, all the <font color="#308ae4" style="">MYFUEL&#174;</font> brands are:
						<ul class="list-about">
							<li> Complying with suppliers Certificate of Analysis. </li>

							<li>  Are pure and free from contaminants.</li>

							<li> All products are Athletes Tested. (Comply Standards)</li>
						</ul>
					</p>
					
					<p class="p-b-20 para-about">
					WE HAVE PASSIONATELY FORMULATED HIGH QUALITY WORLD CLASS HEALTH AND NUTRITIONAL SUPPLEMENTS WITH THE BRAND NAME OF <font color="#308ae4" style="">MYFUEL&#174;</font>, TO CATER THE NEED OF DOMESTIC AND INTERNATIONAL MARKET.
					</p>
					
					<p class="p-b-20 para-about">
					AT <font color="#308ae4" style="">MYFUEL&#174;</font>, WE BELIEVE IN THE POWER OF COMMITTMENT TOWARDS POSITIVE AND PURE NUTRITION. 
					</p>
					<p class="p-b-20 para-about">
					We do third party manufacturing for number of other brands which are marketed in India and Internationally. 
					</p>
					
					<span class="s-text3  "  >
					<font style="font-weight: 900; font-size:20px;color:#000;float: right;" >-Mr. Chirag Bipinchandra Shah </font>
					
					</span>
 						
					</div>
					</div>
	 
	</section>
	
	<section class="bgwhite p-t-60 p-b-60 abt-bck">
		<div class="container about-us-background">
		 
			<!--<img src="<?php echo assets_path."img/slider1.jpeg"; ?>" alt="Notebook" class="img-res" style="opacity: 0.1;width:25%;margin-left: 80%;">-->
		
			 <div class="bo13 p-l-29  p-b-10 content" style="">
						<h6 class="text-center m-text5" >About Author  </h6>
						<hr>
						<p class="p-b-11 p-t-15 para-about">
						Mr. Chirag B Shah is the founder member of the Company. 
						He is young, brilliant & dynamic professional leader with a varied experience in pharmaceutical industry, nationally and internationally. 
						A Pharmacy graduate from Pune University, have two decade experience in Distribution, Sales and Marketing in the field of pharmacy. 
						As the Chairman and Managing Director, he has been instrumental in the growth of <font style="">Kiran Pharmaceutical&#174;</font> .
						He focuses on <font style="">Kiran Pharmaceutical&#174;</font> 's to emerge it as one of the benchmarked companies in healthcare industry. 
						Mr. Chirag B Shah goes akin with current market trends and latest technologies in the world of pharmacy. 
						Mr. Chirag B Shah is associated with various industry bodies and associations. 
						He is a member of <font color="#538fcc">Pharmexcil</font>,<font color="#538fcc"> Maharashtra Chamber of Commerce</font> and <font color="#538fcc">Indian Pharmaceutical Association</font>.
						</p>

						<!--span class="s-text7">
							- Steve Job’s
						</span-->
					</div>
				</div>
	 
	</section>

	<section class="bgwhite p-t-60 p-b-30 abt-bck">
		<div class="container about-us-background">
			 
			<!--<img src="<?php echo assets_path."img/slider1.jpeg"; ?>" alt="Notebook" class="img-res" style="opacity: 0.1;width:25%;">-->
		
			<div class="bo13 p-l-29  p-b-10 content"  >
			
					<h3  class="text-center m-text5" > Mission </h3>
					<hr>
					<p class="p-b-20 para-about">
					·        Through our high quality sports nutrition products and solutions we will motivate and help all kind of people from across the world to help manifest their inner athlete.
					</p>
					<p class="p-b-20 para-about">
					·        To be amongst the top sports nutrition and healthcare companies in the world.
					</p>
					<p class="p-b-20 para-about">
					·        To ensure high quality of life for masses by providing the best products in sports nutrition and healthcare. Hence the punch line YOUR HEALTHCARE PARTNER.
					</p>
					<p class="p-b-20 para-about">
					·        To provide the purest and high quality world class supplement with best results.
					</p>
					<br>
				</div>
			</div>
		</div>
	
	</section>

	<section class="bgwhite p-t-60 p-b-60 abt-bck">
		<div class="container about-us-background">
		 
			<!--<img src="<?php echo assets_path."img/slider1.jpeg"; ?>" alt="Notebook" class="img-res" style="opacity: 0.1;width:25%;margin-left: 80%;">-->
		
			<div class="bo13 p-l-29  p-b-10 content" >
				<h3  class="text-center m-text5" > Vision </h3>
					<hr>
					 
					<p class="p-b-20 para-about">
					·        To help people from all walks of the life to actualize their athletic abilities and change the paradigm of fitness. 
					</p>
					<p class="p-b-20 para-about">
					·        Our Vision is to Emerge as a company which will be recognised as a quality marketer, producer, innovator, competitive and committed member of global health-care industry.
					</p>
					<p class="p-b-20 para-about">
					·        Commit to user service, user satisfaction and social responsibility.
					</p>
					<p class="p-b-20 para-about">
					·        Emerge as one of the benchmarked companies in the sports nutrition healthcare industry.
					</p>
					<br>
				</div>
			</div>
		</div>
	
	</section>


<?php 
	$this->load->view('frontend/_includes/footer');
?>