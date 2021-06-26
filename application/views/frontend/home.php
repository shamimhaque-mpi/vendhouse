    <link rel="stylesheet" href="<?= base_url('public/css/home.css'); ?>">
	<?php if ($adsInfo != null) { ?>
	<div class="modal fade" id="autoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      <img src="<?php echo site_url('public/lazy_load.png'); ?>" data-src="<?php echo $adsInfo[0]->path; ?>" class="img-responsive man_lazy">
	    </div>
	  </div>
	</div>
	<?php } ?>

	<div class="container jumbotron-custom-cover">
		<div class="col-md-12">
		    <div class="row">
    		    <div class="col-md-3 col-sm-7 mobile_hide">
    		        <div class="wraping">
    		            <span class="more_cat">+</span>
        		        <ul class="aside-menu">
                        <?php if($categories != NULL){ foreach ($categories as $key => $value) {
                        $subcategories = $this->action->read("subcategory", array("category" => $value->category)); ?>
                        	<li class="new-custom-submenu">
                        		<a href="<?php echo site_url("frontend/home/singlePage?brand=".$value->category."&type=category"); ?>"><b><?php echo filter($value->category); ?></b></a>
                        	    <ul>
                        		<?php if($subcategories != NULL) { foreach ($subcategories as $val) { ?>
                        			<li>
                        			    <a style="display:inline-block;padding-left:3px;" href="<?php echo site_url('frontend/home/brand?cat='.$value->category.'&subcat='.$val->subcategory); ?>">
                        			        <i class="fa fa-angle-right"></i>&nbsp;&nbsp;<?php echo filter($val->subcategory); ?>
                        			    </a>
                        			</li>
                        		<?php } } ?>
                        		</ul>
                        	</li>
                        <?php }  } ?>
                        </ul>
                    </div>
    		    </div>
    			<div class="col-md-9">
    				<div class="row">
    				<!-- Start WOWSlider.com BODY section -->
    
    				<div id="wowslider-container1">
    					<div class="ws_images">
    						<ul>
    							<?php foreach ($slider as $key => $value) { ?>
    								<li><img class="man_lazy" src="<?php echo site_url('public/lazy_load.png'); ?>" data-src="<?php echo site_url($value->slider_path); ?>" alt="<?php //echo $value->slider_title; ?>" title="<?php //echo $value->slider_title; ?>"/></li>
    							<?php } ?>
    						</ul>
    					</div>
    				</div>
    				<script src="<?php echo site_url("public/slider/engine1/wowslider.js"); ?>"></script>
    				<script src="<?php echo site_url("public/slider/engine1/script.js"); ?>"></script>
    				<!-- End WOWSlider.com BODY section -->
    
    				</div>
    			</div>
    		</div>
		</div>
	</div>

    <!-- Start Category wise Product -->
	<?php
	  if(!empty($products)) {
	      
	  foreach ($products as $key => $product) {
	      if($product != NULL){
	?>
	<section class="container-fluid" id="category<?php echo $key+1; ?>">
		<div class="row" style="margin: 20px 0;">
			<div class="container">
				<div class="col-md-12">
				    <div class="row bg-body-color">
    					<div class="category_header clearfix">
    						<h3 class="pull-left">
    							<?php
    								if($product != NULL){
    									echo filter($product[0]->product_cat);
    								}
    							?>
    						</h3>
    
    						<div class="pull-right slider-array">
    						    <a style="background: transparent; color: #111;" href="<?php echo isset($product[0]) ? site_url("frontend/home/see_more?cat=".urlencode($product[0]->product_cat)) : ''; ?>">সবগুলো দেখুন</a>
    							<a class="prev_<?php echo $key+1; ?>" href=""><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    							<a class="next_<?php echo $key+1; ?>" href=""><i class="fa fa-angle-right" aria-hidden="true"></i></a>
    						</div>
    					</div>
    			    </div>
    				<div class="row bg-body-color">
    					<div class="responsive_<?php echo $key+1;?> slider">
    
    						<?php
    						if(!empty($product)){
    							foreach ($product as $key => $value) {	    
    						?>
    						<div class="content_item">
    							<a class="contain_img" href="<?php echo site_url('frontend/home/products_details/'.$value->id); ?>">
    							    <figure>
    								    <button class="add_wishlist active_<?php echo $value->id?>" onclick="wish_list.addToWishList(<?php echo $value->id?>)"><i class="fa fa-heart" aria-hidden="true"></i></button>
    									<img class="img-responsive man_lazy" src="<?php echo site_url('public/lazy_load.png'); ?>" data-src="<?php echo base_url('/public/upload/product/medium/'.$value->img_path); ?>" alt="Product Missing">
    								</figure>
    								<span>
    									<p class="text-center product_name"><?php echo $value->product_name ; ?></p>
    									<p style="font-size: 15px;" class="price-weight text-center">
    									<?php
    										if($value->sale_price==null || $value->sale_price==0){
    											echo $value->regular_price." টাকা";
    										}else{
    											echo ($value->regular_price > 0) ? "<del style='color:#dc3545'>".$value->regular_price."টাকা</del>" : "";
    											echo " &nbsp;".$value->sale_price." টাকা";
    										}
    									?>
    									</p>
    								</span>
    							</a>
    
    							<span class="border-button">
    							    <?php if($value->stock_qty > 0){ ?>
    								<a class="btn btn-default btn-sm" ng-click="adjustItemFn(<?php echo $value->id; ?>)" data-toggle="modal" data-target=".product-pupup">
    									<i class="fa fa-shopping-bag" aria-hidden="true"></i>
    									এখনই কিনুন
    								</a>
                                    <?php } ?>
    							</span>
    
    						</div>
    						<?php } } ?>
    						
    						
    					</div>
    				</div>
				</div>
			</div>
			</div>
		</div>
	</section>
	<?php }}} ?>
	<!-- End Categorywise Product -->
	
	
	<?php if($latest_products){ ?>
	    <section class="container-fluid">
		<div class="row" style="margin: 20px 0;">
			<div class="container">
				<div class="col-md-12">
				    <div class="row bg-body-color">
    					<div class="category_header clearfix">
    						<h3 class="pull-left">লেটেস্ট পণ্যসমূহ</h3>
    
    						<div class="pull-right slider-array">
    						    <a style="background: transparent; color: #111;" href="#">সবগুলো দেখুন</a>
    							<a class="prev_latest" href=""><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    							<a class="next_latest" href=""><i class="fa fa-angle-right" aria-hidden="true"></i></a>
    						</div>
    					</div>
    			    </div>
    				<div class="row bg-body-color">
    					<div class="responsive_latest slider">
    
    						<?php
    						if(!empty($latest_products)){
    							foreach ($latest_products as $key => $value) {	    
    						?>
    						<div class="content_item">
    							<a class="contain_img" href="<?php echo site_url('frontend/home/products_details/'.$value->id); ?>">
    							    <figure>
    								    <button class="add_wishlist active_<?php echo $value->id?>" onclick="wish_list.addToWishList(<?php echo $value->id?>)"><i class="fa fa-heart" aria-hidden="true"></i></button>
    									<img class="img-responsive man_lazy" src="<?php echo site_url('public/lazy_load.png'); ?>" data-src="<?php echo base_url('/public/upload/product/medium/'.$value->img_path); ?>" alt="Product Missing">
    								</figure>
    								<span>
    									<p class="text-center product_name"><?php echo $value->product_name ; ?></p>
    									<p style="font-size: 15px;" class="price-weight text-center">
    									<?php
    										if($value->sale_price==null || $value->sale_price==0){
    											echo $value->regular_price." টাকা";
    										}else{
    											echo ($value->regular_price > 0) ? "<del style='color:#dc3545'>".$value->regular_price."টাকা</del>" : "";
    											echo " &nbsp;".$value->sale_price." টাকা";
    										}
    									?>
    									</p>
    								</span>
    							</a>
    
    							<span class="border-button">
    							    <?php if($value->stock_qty > 0){ ?>
    								<a class="btn btn-default btn-sm" ng-click="adjustItemFn(<?php echo $value->id; ?>)" data-toggle="modal" data-target=".product-pupup">
    									<i class="fa fa-shopping-bag" aria-hidden="true"></i>
    									এখনই কিনুন
    								</a>
                                    <?php } ?>
    							</span>
    
    						</div>
    						<?php } } ?>
    						
    						
    					</div>
    				</div>
				</div>
			</div>
			</div>
		</div>
	</section>
	<?php } ?>
	
	<?php if($popular_products){ ?>
	    <section class="container-fluid">
		<div class="row" style="margin: 20px 0;">
			<div class="container">
				<div class="col-md-12">
				    <div class="row bg-body-color">
    					<div class="category_header clearfix">
    						<h3 class="pull-left">ফেভারিট পণ্যসমূহ</h3>
    
    						<div class="pull-right slider-array">
    						    <a style="background: transparent; color: #111;" href="#">সবগুলো দেখুন</a>
    							<a class="prev_popular" href=""><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    							<a class="next_popular" href=""><i class="fa fa-angle-right" aria-hidden="true"></i></a>
    						</div>
    					</div>
    			    </div>
    				<div class="row bg-body-color">
    					<div class="responsive_popular slider">
    
    						<?php
    						if(!empty($popular_products)){
    							foreach ($popular_products as $key => $value) {	    
    						?>
    						<div class="content_item">
    							<a class="contain_img" href="<?php echo site_url('frontend/home/products_details/'.$value->id); ?>">
    							    <figure>
    								    <button class="add_wishlist active_<?php echo $value->id?>" onclick="wish_list.addToWishList(<?php echo $value->id?>)"><i class="fa fa-heart" aria-hidden="true"></i></button>
    									<img class="img-responsive man_lazy" src="<?php echo site_url('public/lazy_load.png'); ?>" data-src="<?php echo base_url('/public/upload/product/medium/'.$value->img_path); ?>" alt="Product Missing">
    								</figure>
    								<span>
    									<p class="text-center product_name"><?php echo $value->product_name ; ?></p>
    									<p style="font-size: 15px;" class="price-weight text-center">
    									<?php
    										if($value->sale_price==null || $value->sale_price==0){
    											echo $value->regular_price." টাকা";
    										}else{
    											echo ($value->regular_price > 0) ? "<del style='color:#dc3545'>".$value->regular_price."টাকা</del>" : "";
    											echo " &nbsp;".$value->sale_price." টাকা";
    										}
    									?>
    									</p>
    								</span>
    							</a>
    
    							<span class="border-button">
    							    <?php if($value->stock_qty > 0){ ?>
    								<a class="btn btn-default btn-sm" ng-click="adjustItemFn(<?php echo $value->id; ?>)" data-toggle="modal" data-target=".product-pupup">
    									<i class="fa fa-shopping-bag" aria-hidden="true"></i>
    									এখনই কিনুন
    								</a>
                                    <?php } ?>
    							</span>
    
    						</div>
    						<?php } } ?>
    						
    						
    					</div>
    				</div>
				</div>
			</div>
			</div>
		</div>
	</section>
	<?php } ?>
	
	
	
	<script>
	$(document).on('ready', function() {
		$('#myModal').modal({
		  keyboard: false
		});

		$(window).on('load',function(){
	        $('#autoModal').modal('show');
	    });

     <?php
	   if($products != NULL){
	   foreach ($products as $key => $value) {
	  ?>

	  $(".responsive_<?php echo $key+1;?>").slick({
	    prevArrow: '.category_header .slider-array .prev_<?php echo $key+1; ?>',
		nextArrow: '.category_header .slider-array .next_<?php echo $key+1; ?>',
		dots: false,
		infinite: false,
		autoplay: false,
		slidesToShow: 6,
		slidesToScroll: 6,
		accessibility: true,
		responsive: [{
		  dots: false,
		  breakpoint: 1024,
		  settings: {
		  slidesToShow: 6,
		  slidesToScroll: 2,
		  infinite: false
		}

	  }, {

		breakpoint: 700,
		settings: {
		  slidesToShow: 3,
		  slidesToScroll: 2,
		  dots: false
		}

	  },{

		dots: false,
		breakpoint: 550,
		settings: {
		  slidesToShow: 2,
		  slidesToScroll: 1
		}
	  }]
	  });

	 <?php } } ?>
	 
	 
	 
	 
	  $(".responsive_latest").slick({
	    prevArrow: '.category_header .slider-array .prev_latest',
		nextArrow: '.category_header .slider-array .next_latest',
		dots: false,
		infinite: false,
		autoplay: false,
		slidesToShow: 6,
		slidesToScroll: 6,
		accessibility: true,
		responsive: [{
		  dots: false,
		  breakpoint: 1024,
		  settings: {
		  slidesToShow: 6,
		  slidesToScroll: 2,
		  infinite: false
		}

	  }, {

		breakpoint: 700,
		settings: {
		  slidesToShow: 3,
		  slidesToScroll: 2,
		  dots: false
		}

	  },{

		dots: false,
		breakpoint: 550,
		settings: {
		  slidesToShow: 2,
		  slidesToScroll: 1
		}
	  }]
	  });
	 
	 
	  $(".responsive_popular").slick({
	    prevArrow: '.category_header .slider-array .prev_popular',
		nextArrow: '.category_header .slider-array .next_popular',
		dots: false,
		infinite: false,
		autoplay: false,
		slidesToShow: 6,
		slidesToScroll: 6,
		accessibility: true,
		responsive: [{
		  dots: false,
		  breakpoint: 1024,
		  settings: {
		  slidesToShow: 6,
		  slidesToScroll: 2,
		  infinite: false
		}

	  }, {

		breakpoint: 700,
		settings: {
		  slidesToShow: 3,
		  slidesToScroll: 2,
		  dots: false
		}

	  },{

		dots: false,
		breakpoint: 550,
		settings: {
		  slidesToShow: 2,
		  slidesToScroll: 1
		}
	  }]
	  });
	 
	 
	 

	   // date piker
	    $('#datetimepicker1').datetimepicker({
	        format: 'YYYY-MM-DD'
	    });
    });
</script>



<script>
    var more_cat   = document.querySelector('.more_cat'),
        aside_menu = document.querySelector('.aside-menu');
        
    more_cat.addEventListener('click', function(){
        aside_menu.scrollIntoView(false);
    });
</script>
