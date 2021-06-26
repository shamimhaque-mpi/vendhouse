            <?php
                $footer_info=json_decode($meta->footer,true);
                $menu_icon=json_decode($meta->menu_icon,true);
                $social_icon=json_decode($meta->social_icon,true);
               // print_r($social_icon);
             ?>
            <style>
                .bg-body-color {background-color: #fff;}
                img.img-fluid {
            	    border: 1px solid #ddd;
            	    padding: 5px;
            	    border-radius: 1px;
            	    height: 35px !important;
            	}
            	.single-navigation-section i {padding-right: 10px;}
            	@media (max-width: 992px){
            	    .contact-summery, .single-contact {text-align: center;}
            	}
            	@media only screen and (max-width: 512px){
                    .d-flex {display: block !important;}
                    .copyright-section p {line-height: 40px;}
                    .copyright-section img.img-fluid {height: 32px !important;}
                }
            </style>
            <!--=======  social contact section  =======-->
    		<div class="social-contact-section pt-50 pb-50" style="webkit-box-shadow: none; box-shadow: none;margin-top: 20px; background: #333333;">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-12 order-1 order-md-1 order-sm-1 order-lg-2  mb-sm-50 mb-xs-50">
    						<!--=======  contact summery  =======-->
    						
    						<div class="contact-summery">
    							<h2>যোগাযোগ করুন</h2>
    
    							<!--=======  contact segments  =======-->
    							
    							<div class="contact-segments d-flex justify-content-between flex-wrap flex-lg-nowrap"> 
    								<!--=======  single contact  =======-->
    							
    								<div class="single-contact d-flex mb-xs-20">
    									<div class="icon">
    										<span class="icon_pin_alt" style="margin: 0px 0 0 -4px;"></span>
    									</div>
    									<div class="contact-info">
    										<p><span style="font-size: 1.1em; color: #fff; font-weight: bold;">ঠিকানা: </span> <span><?php echo $footer_info['addr_address']; ?></span></p>
    									</div>
    								</div>
    								
    								<!--=======  End of single contact  =======-->
    								<!--=======  single contact  =======-->
    							
    								<div class="single-contact d-flex mb-xs-20">
    									<div class="icon">
    										<span class="icon_mobile" style="margin-top: 5px;"></span>
    									</div>
    									<div class="contact-info">
    										<p><span style="font-size: 1.1em; color: #fff; font-weight: bold;">ফোন:  </span><span><?php echo $footer_info['addr_moblile']; ?></span></p>
    									</div>
    								</div>
    								
    								<!--=======  End of single contact  =======-->
    								<!--=======  single contact  =======-->
    							
    								<div class="single-contact d-flex">
    									<div class="icon">
    									    <span class="icon_mail_alt" style="margin-top: -5px;"></span>
    									</div>
    									<div class="contact-info">
    										<p><span style="font-size: 1.1em; color: #fff; font-weight: bold;">ইমেইল:  </span><span><?php echo $footer_info['addr_email']; ?> &nbsp; </span></p>
    									</div>
    								</div>
    
    								<div class="single-contact d-flex">
    									<div class="icon">
    									    <span class="ion-social-facebook-outline" style="margin-top: -7px;"></span>
    									</div>
    									<div class="contact-info">
    										<p><span style="font-size: 1.1em; color: #fff; font-weight: bold;">ফেইসবুক পেজ:  </span><span> <a  style="color: #aaa;" target="_blank" style="display: inline-block;" href="<?php echo $social_icon['s_facebook']; ?>">   vendhouse.facebook</a></span></p>
    									</div>
    								</div>
    								
    								<!--=======  End of single contact  =======-->
    							</div>
    							
    							<!--=======  End of contact segments  =======-->
    
    							
    							
    						</div>
    						
    						<!--=======  End of contact summery  =======-->
    						
    					</div>
    				</div>
    			</div>
    		</div>
    		<!--=======  End of social contact section  =======-->
    
    		<!--=======  footer navigation  =======-->
    		<div class="footer-navigation-section pt-40 pb-50" style="webkit-box-shadow: none; box-shadow: none; background: #333333;">
    			<div class="container">
    				<div class="row">
    					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-xs-30">
    						<!--=======  single navigation section  =======-->
    						
    						<div class="single-navigation-section">
    							<h3 class="nav-section-title">তথ্য সর্ম্পকিত</h3>
    							<ul>
    								<li><i class="fa fa-arrow-down" aria-hidden="true"></i> <a href="<?php echo site_url("about"); ?>">আমাদের সম্পর্কে</a></li>
    								<li><i class="fa fa-truck" aria-hidden="true"></i> <a href="<?php echo site_url("delivery"); ?>">ডেলিভারি তথ্য</a></li>
    								<li><i class="fa fa-user-secret" aria-hidden="true"></i> <a href="<?php echo site_url("frontend/home/pages/privacy_policy"); ?>">গোপনীয়তা নীতি</a></li>
    								<li><i class="fa fa-registered" aria-hidden="true"></i> <a href="<?php echo site_url("frontend/home/pages/terms_condition"); ?>">নিয়ম এবং শর্তাবলী</a></li>
    							</ul>
    						</div>
    						
    						<!--=======  End of single navigation section  =======-->
    					</div>
    					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-xs-30">
    						<!--=======  single navigation section  =======-->
    						
    						<div class="single-navigation-section">
    							<h3 class="nav-section-title">আমার অ্যাকাউন্ট</h3>
    							<ul>
    								<li><i class="fa fa-server" aria-hidden="true"></i> <a href="#">আমার অ্যাকাউন্ট</a></li>
    								<li><i class="fa fa-list" aria-hidden="true"></i> <a href="#">উইশলিস্ট</a></li>
    								<li><i class="fa fa-shopping-cart" aria-hidden="true"></i> <a href="#">কার্ট</a></li>
    								<li><i class="fa fa-newspaper-o" aria-hidden="true"></i> <a href="#">নিউজলেটার</a></li>
    							</ul>
    						</div>
    						
    						<!--=======  End of single navigation section  =======-->
    					</div>
    					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-xs-30">
    						<!--=======  single navigation section  =======-->
    						
    						<div class="single-navigation-section">
    							<h3 class="nav-section-title">গ্রাহক সেবা</h3>
    							<ul>
    								<li><i class="fa fa-connectdevelop" aria-hidden="true"></i> <a href="<?php echo site_url('frontend/home/contact'); ?>">যোগাযোগ</a></li>
    								<li><i class="fa fa-folder-open" aria-hidden="true"></i> <a href="<?php echo site_url('frontend/home/pages/our_service'); ?>">আমাদের সেবা</a></li>
    								<li><i class="fa fa-retweet" aria-hidden="true"></i> <a href="<?php echo site_url('frontend/home/returns'); ?>">ফেরতসমূহ</a></li>
    								<li><i class="fa fa-sitemap" aria-hidden="true"></i> <a href="<?php echo site_url('frontend/home/pages/site_map'); ?>">সাইট ম্যাপ</a></li>
    							</ul>
    						</div>
    						
    						<!--=======  End of single navigation section  =======-->
    					</div>
    					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
    						<!--=======  single navigation section  =======-->
    						
    						<div class="single-navigation-section">
    							<h3 class="nav-section-title">অন্যান্য</h3>
    							<ul>
    								<li><i class="fa fa-adjust" aria-hidden="true"></i> <a href="#">ব্র্যান্ডস</a></li>
    								<li><i class="fa fa-gift" aria-hidden="true"></i> <a href="#">উপহার ভাউচার</a></li>
    								<li><i class="fa fa-puzzle-piece" aria-hidden="true"></i> <a href="#">শাখা</a></li>
    								<li><i class="fa fa-sign-language" aria-hidden="true"></i> <a href="#">বিশেষত্ব</a></li>
    							</ul>
    						</div>
    						
    						<!--=======  End of single navigation section  =======-->
    					</div>
    				</div>
    			</div>
    		</div>
    		<!--=======  End of footer navigation  =======-->
    
    
    		<!--=======  copyright section  =======-->
    		<div class="copyright-section pt-35 pb-35" style="background: #2f2f2f;">
    			<div class="container">
    				<div class="row align-items-md-center align-items-sm-center">
    					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-md-left">
    						<!--=======  copyright text	  =======-->
    						
    						<div class="copyright-segment">							
    							<p class="copyright-text">&copy; ২০২০ <a href="<?php echo site_url(); ?>">ভেন্ড হাউজ</a> সর্বস্বত্ব সংরক্ষিত</p>
    						</div>
    						
    						<!--=======  End of copyright text	  =======-->
    						
    					</div>
    					<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
    						<!--=======  payment info  =======-->
    						
    						<div class="payment-info text-center text-md-right">
    							<p style="text-align: right;">মূল্যপরিশোধ পদ্ধতি 
    							    <img style="height: 30px; margin-left: 15px;" src="<?php echo site_url('public/img/B.png'); ?>" class="img-fluid bg_white" alt="">
    							    <img style="height: 30px" src="<?php echo site_url('public/img/D.png'); ?>" class="img-fluid bg_white" alt="">
    							    <img style="height: 30px" src="<?php echo site_url('public/img/s.png'); ?>" class="img-fluid bg_white" alt="">
    							 </p>
    						</div>
    						
    						<!--=======  End of payment info  =======-->
    						
    					</div>
    				</div>
    			</div>
    		</div>
    		<!--=======  End of copyright section  =======-->
    		
    		
    		<script>
    		    /*man lazy loader start____________________________________________________________*/
                let content = document.querySelectorAll('.man_lazy');
                  content.forEach((img) => {
                    let src = img.dataset.src;
                    if(img.getBoundingClientRect().top<window.innerHeight){
                      let image = new Image();
                      image.src = src;
                      
                      img.removeAttribute('data-src');
                      img.classList.remove('man_lazy');
                      
                      image.onload = function(){
                        img.setAttribute('src',src);
                      }
                    }
                  });
                
                window.onscroll = function(){
                  let content2 = document.querySelectorAll('.man_lazy');
                  content2.forEach((img) => {
                    let src = img.dataset.src;
                    if(img.scrollTop<window.innerHeight){
                      img.classList.remove('man_lazy');
                      let image = new Image();
                      image.src = src;
                      image.onload = function(){
                        img.removeAttribute('data-src');
                        img.setAttribute('src',src);
                      }
                    }
                  });
                }
                
                function loadImage(img,src){
                  img.setAttribute('src',src);
                }
                /*man lazy loader end____________________________________________________________*/
    		</script>
    		<script src="<?= base_url('private/js/wishList.js'); ?>"></script>
        	<script>
        	    var wish_list = new wishList(<?php echo $this->session->userdata('user_id')?>);
        	</script>
    	</footer>
	</body>
</html>