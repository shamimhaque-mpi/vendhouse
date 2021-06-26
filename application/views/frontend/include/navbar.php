<link rel="stylesheet" href="<?php echo base_url('public/css/nav.css');?>">
<?php
    $footer_info=json_decode($meta->footer,true);
    $menu_icon=json_decode($meta->menu_icon,true);
    $social_icon=json_decode($meta->social_icon,true);
    // dd($this->session->userdata);
?>
<style>
    .search_relative {position: relative;}
    .reference-category {
        position: absolute;
        top: 1px;
        right: 60px;
        width: 150px;
        border: none;
        border-left: 1px solid #ddd;
        border-radius: 0;
        outline: nonebox;
        height: 33px;
        box-shadow: none;
    }
    .new-logo .logo {min-width: 15px;}
    .new-logo {
        align-items: flex-end;
        margin-top: -6px;
        display: flex;
    }
    .new-logo .suddo {
        display: inline-block;
        margin-left: 7%;
        max-width: 60px;
        width: 100%;
        margin-bottom: 7px;
        min-width: 52px;
    }
    @media screen and (max-width: 1200px){
        .new-logo {margin-top: 7px;}
    }
    @media screen and (max-width: 576px){
        .new-logo>a {margin: 0 auto;}
    }
</style>
<section class="container-fluid nev-bg nav-fix" style="padding: 0;">
	<div class="top-contact">
		<div class="container">
			<div class="">
				<ul>
					<li><i class="fa fa-phone-square"></i>  <?php echo $footer_info['addr_moblile']; ?></li>
					<li><i class="fa fa-envelope-o"> &nbsp;</i><?php echo $footer_info['addr_email']; ?></li>
				    <?php
				        $coupon = $this->action->read('coupon')[0];
				        if(!empty($coupon) && (int)$coupon->coupon_discount > 0) {
				    ?>
					<li> | <strong style="color: #fd6a02;"><i class="fa fa-ticket">&nbsp;</i><?= $coupon->coupon_no.' - '.$coupon->coupon_discount ?></strong></li>
				    <?php } ?>
				</ul>
				<ul>
					<li><a href="<?php echo $social_icon['s_facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<li><a href="<?php echo $social_icon['s_pinterest']; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row menu_height">
			<div class="col-md-3 col-sm-4 new-logo">
				<a href="<?php echo site_url(); ?>" style="display:block;width:100%;max-width: 190px;">
					<img class="logo" src="<?php echo site_url($footer_info['footer_img']); ?>" class="img-responsive" alt="Size 200x60">
					<span class="header_title only-sm"><?php echo $footer_info['header_txt']; ?></span>
				</a>
				<a href="<?php echo site_url(); ?>" class="suddo">
				    <img src="<?php echo site_url('public/images/suddo.png'); ?>" class="img-responsive" alt="">
				</a>
			</div>

			<div class="col-md-6 col-sm-8">
			    <div class="search_relative">
					<?php
					 $attr = array("class" => "search-custom");
					 echo form_open("frontend/home/search/",$attr);
					?>
						<input type="text" id="search_box"  name="search" ng-model="search_item" ng-change="getProductInfoFn(); showHideFn();" required>
                        <select class="reference-category form-control" ng-model="category">
                            <option value="">Select Category</option>
                            <?php
                                $categories = $this->action->read('category');
                                foreach($categories as $key=>$category){
                                    echo "<option value='$category->category'> ".filter($category->category)." </option>";
                                }
                            ?>
                        </select>
						<button><i class="fa fa-search"></i></button>
					<?php echo form_close(); ?>
					
			
					<!-- data list view for search start -->
					<div class="Search_item_cover">
    					<div ng-if="allSearchProductsInfo.length > 0"  class="Search_item" ng-show="active">
    						<ul>
    							<li ng-repeat="item in allSearchProductsInfo" class="clearfix">
    								<a class="clearfix" href="<?php echo site_url('frontend/home/products_details/{{ item.id}}'); ?>" target="_blank">
    									<div class="col-sm-2 sug_img">
    										<img ng-src="<?php echo site_url('public/upload/product/thumbnail/{{ item.img_path}}');?>" alt="Missing">
    									</div>
    
    									<div class="col-sm-7 col-xs-8">
    										<b style="font-size: 14px; font-weight: normal;">{{ item.product_name | textBeautify }}</b> <br />
    										<span style="font-size: 14px; color: #aaa;">{{ item.product_cat | textBeautify }}</span>
    									</div>
    									<div class="col-sm-3 col-xs-4">
    										<del ng-show="item.regular_price > 0"> {{ item.regular_price }}টাকা</del>
    										<span> {{ item.sale_price }}টাকা</span>
    									</div>
    								</a>
    							</li>
    						</ul>
    					</div>
					</div>
					<!-- data list view for search end -->
				</div>
			</div>



			<div class="col-md-3 col-sm-12">
				<ul class="loginmenu">
				    <li>
						<a href="#" class="btn btn-menu-custom" data-action="toggle" data-side="left">&#9776;</a>
					</li>
					<li>
						<a href="<?=site_url('subscriber/wishList')?>" class="btn-cart btn-wishlist">
							<i class="fa fa-heart" aria-hidden="true"></i>
							<span class="badge badge-success" id="count">0</span>
						</a>
					</li>
					
					<li>
						<a class="btn-cart" data-toggle="modal" data-target=".order-popup" ng-click="loadValueFromLocalStorage();">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							<span class="badge badge-success" >{{ productInCart ? productInCart : 0 }}</span>
						</a>
					</li>

					<li>
						<a href="<?php echo site_url(isset($meta->app) ? $meta->app : ''); ?>" class="btn-cart download_btn" data-toggle="tooltip" id="bottom" download>
							<i class="fa fa-android" aria-hidden="true"></i>
						</a>
					</li>

					<?php if($this->session->userdata('subscriberLoggedin') == 1){ ?>
						<li class="dropdown li-badge">
						  <button class="btn btn-default btn-act" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true">
						    <i class="fa fa-user"></i>
							<?php if($this->session->userdata('point') > 0) { ?>
								<!-- <span title="Your Balance Point" class="badge badge-messages"><?php  echo $this->session->userdata('point'); ?></span> -->
							<?php } ?>
						  </button>
							<ul class="dropdown-menu dropdown-menu-right">
		                        <!-- <li class="dropdown-menu-description"><a>&nbsp;</a></li> -->
		                        <li><a href="<?php echo site_url('subscriber/currentOrder');?>">বর্তমান অর্ডার</a></li>
		                        <li><a href="<?php echo site_url('subscriber/wishList');?>">উইশলিস্ট</a></li>
		                        <li><a href="<?php echo site_url('subscriber/allOrder');?>">সকল অর্ডার</a></li>
		                        <li><a href="<?php echo site_url('subscriber/settings');?>">ব্যাক্তিগত তথ্য</a></li>
		                        <li><a href="<?php echo site_url('subscriber/settings/updatePassword');?>">সেটিংস</a></li>
		                        <li><a href="<?php echo site_url("access/subscriber/logout"); ?>">সাইন আউট</a></li>
		                    </ul>
						</li>

					<?php }elseif($this->session->userdata('srLoggedin') == 1){ ?>
						<li class="dropdown li-badge">
						  <button class="btn btn-default btn-act" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true">
						    <i class="fa fa-user"></i>
						  </button>
							<ul class="dropdown-menu dropdown-menu-right">
		                        <li><a href="<?php //echo site_url('sr/currentOrder');?>">বর্তমান অর্ডার</a></li>
		                        <li><a href="<?php //echo site_url('sr/allOrder');?>">সকল অর্ডার</a></li>
		                        <li><a href="<?php //echo site_url('sr/settings');?>">ব্যাক্তিগত তথ্য</a></li>
		                        <li><a href="<?php //echo site_url('sr/settings/updatePassword');?>">সেটিংস</a></li>
		                        <li class="divider"></li>
		                        <li><a href="<?php echo site_url("access/sr/logout"); ?>">সাইন আউট</a></li>
		                    </ul>
						</li>
					<?php }else{ ?>
						<li class="d-flex"><a href="<?=site_url('login')?>" class="btn btn-primary"><strong>সাইন ইন</strong></a> &nbsp;</li>
				    <?php } ?>
				</ul>

			</div>
		</div>
	</div>
  </section>

<link rel="stylesheet" href="<?php echo base_url('public/css/nav_bottom.css');?>">

<section class="container-fluid" style="background: #f4f8ef;">
	<div class="menu-container">
		<div class="container">
			<div class="row">
				<div class="menu menu-new-custom">
				   
				    <style>
				        .all-category {
				            position: relative;
				        }
				        .dropdown-menu-custom {
				            /*display: block;*/
				        }
				        .new-custom-submenu a, .new-custom-submenu ul li a {
				            color: #000 !important;
				        }
				    </style>
			  		<!--<div class="dropdown all-category">
						<a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">All Categories &nbsp;</a>
				        <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenu1">
						    <?php //if($categories != NULL){ foreach ($categories as $key => $value) {
						    //$subcategories = $this->action->read("subcategory",array("category" => $value->category)); ?>
						    	<li class="new-custom-submenu">
						    		<a href="<?php //echo site_url("frontend/home/singlePage?brand=".$value->category."&type=category"); ?>">
						    		    <strong><?php //echo filter($value->category); ?></strong></a>
						    		    <ul>
            								<?php //if($subcategories != NULL) { foreach ($subcategories as $val) { ?>
            									<li>
            									    <a style="display:inline-block;padding-left:3px;" href="<?php //echo site_url('frontend/home/brand?cat='.$value->category.'&subcat='.$val->subcategory); ?>">
            									        <i class="fa fa-angle-right"></i>
            									        <?php //echo filter($val->subcategory); ?>
            									    </a>
            									</li>
            								<?php //} } ?>
            							</ul>
						    	</li>
				    	    <?php //}  } ?>
					    </ul>
					</div>-->
					<a href="<?php echo site_url(); ?>" class="dropdown-toggle">হোম</a>
				    <a href="<?php echo site_url("order"); ?>" class="dropdown-toggle">কিভাবে অর্ডার করবো</a>
				    <a href="<?php echo site_url("faq"); ?>" class="dropdown-toggle">জিজ্ঞাসা</a>
				    <a href="<?php echo site_url("about"); ?>" class="dropdown-toggle">আমাদের সম্পর্কে</a>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
.download_btn {
    margin-left: 15px;
}
.sidebar.left {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 270px;
    background: #f6f6f6;
}
.sidebars > .sidebar {
    position: absolute;
    padding: 10px;
    z-index: 999;
    margin-top: 143px;
    overflow-y: scroll;
}
.ui-state-active, .ui-state-active:active {
	border: 1px solid #c5c5c5 !important;
	outline: none !important;
	background: #ddd;
	color: #454545;
}
.ui-accordion .ui-accordion-content {
	padding: 5px 10px;
}
.ui-state-active .ui-icon {
	    background-image: url(http://code.jquery.com/ui/1.12.1/themes/base/images/ui-icons_444444_256x240.png);
}
.ui-accordion-content {height: auto !important;}
#accordion div a { line-height : 20px !important;}
#accordion div a {display: block;}
@media screen and (max-width: 768px) {
	.menu {display: none;}
	.content_item figure img {
        width: 100%;
        height: 150px;
    }
}
.ui-accordion-content a {border-bottom: 1px solid rgba(0,0,0,0.1); margin-bottom: 3px;}
.ui-accordion-content a:last-child {border-bottom: none;}
</style>

<div class="sidebars">
    <div class="sidebar left">
		<div id="accordion">
        ======================================================================
		  <?php
		      if($categories != NULL){ foreach ($categories as $key => $value) {
		      $subcategories = $this->action->read("subcategory",array("category" => $value->category));
		      
		      if(!empty($subcategories)){ ?>
    	            <h3> <?php echo filter($value->category); ?> </h3>
    	            <div>
        				 <?php if($subcategories != NULL) { foreach ($subcategories as $val) { ?>
        					 <a href="<?php echo site_url('frontend/home/brand?cat='.$value->category.'&subcat='.$val->subcategory); ?>"><?php echo filter($val->subcategory); ?></a>
        				 <?php } } ?>
        
        			 </div>
		      <?php } else { ?>
		          <h3> <?php echo filter($value->category); ?> </h3>
		          <div>
		              <a href="<?php echo site_url('frontend/home/brand?cat='.$value->category); ?>"> <?php echo filter($value->category); ?></a>
		          </div>
		     <?php  } } } ?>
		</div>
    </div>
</div>

<script>
	$( function() {
		$( "#accordion" ).accordion({
			active: false,
			collapsible: true
		});
	} );
	$(function(){
        $("#bottom").tooltip({
            placement: "bottom",
            title: "download"
        });
    });
</script>
