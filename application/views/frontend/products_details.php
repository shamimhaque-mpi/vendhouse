<!-- owl carousel -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo site_url('public/easyzoom-master/css/easyzoom.css'); ?>" />
<link rel="stylesheet" href="<?php echo site_url('public/easyzoom-master/css/products_details.css'); ?>" />
<style>
    .easyzoom img,
    .easyzoom {width: 100%;}
    .single_page_custom_grid {
        padding-right: 7px;
        padding-left: 13px;
    }
    .single_page_custom_grid > [class*="col-"] {
        padding-right: 0;
        padding-left: 0;
    }
    .product_title_info h3 {
        font-weight: 800;
        font-size: 28px;
    }
    .product_title_info p {margin: 15px 0;}
    .product_images {
        border: 1px solid #fff;
        background: #fff;
        text-align: center;
        overflow: hidden;
    }
    .product_images img {
        max-height: 420px;
        min-height: 220px;
        width: 100%;
        object-fit: cover;
    }
</style>
<script>
	var _gaq=[['_setAccount','UA-2508361-9'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>

<!-- single page -->
<div class="container">
    <?=($this->session->flashdata('confirmation'))?>
    <div class="product_details">
        <div class="row">
    	    <?php if($product_info != NULL) { ?>
    	    <div class="col-md-4">
    	        <?php if($product_info[0]->gallery_images != NULL) { ?>
    	        <div class="product_images">
                    <img id="img_01" src="<?php echo site_url('/public/upload/product/large/'.$product_info[0]->img_path); ?>" data-zoom-image="<?php echo site_url('/public/upload/product/large/'.$product_info[0]->img_path); ?>" alt="">
                </div>
                <?php } ?>
                
                <div class="owl-carousel tabs_product" id="gal1">
                    <?php  $images_ = json_decode($product_info[0]->gallery_images);
                    if($images_) foreach ($images_ as $key => $value) { ?>
                        <?php if($value != NULL){ ?>
                            <a href="<?php echo site_url('/public/upload/product/large/'.$value); ?>" data-standard="<?php echo site_url('/public/upload/product/medium_large/'.$value); ?>">
                            <img class="man_lazy" src="<?php echo site_url('public/lazy_load.png'); ?>" data-src="<?php echo site_url('/public/upload/product/medium/'.$value); ?>" style="border: 1px solid #ccc; padding: 4px; height: 68px;" alt="" />
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
    	    <div class="col-md-5 product_title_info">
    	    	<h3 class="header"><?php echo filter($product_info[0]->product_name); ?></h3>
    	    	<p><strong>প্রোডাক্ট কোড</strong> : <?php echo filter($product_info[0]->product_code);?></p>
    	    	<?php if($product_info[0]->product_cat != "") {?>
    	    	    <p><strong>ক্যাটাগরি</strong> : <?php echo filter($product_info[0]->product_cat);?></p>
    	    	<?php } ?>
    	    	<p><strong>স্টক </strong> : <?php echo filter(($product_info[0]->stock_qty > 0 ? "স্টকে আছে":"স্টকে নেই"));?></p>
    	    	<!--<p class="text-justify"><?php echo $product_info[0]->description; ?></p>-->
    	    	<p class="price"><strong>মূল্য</strong> :
    	    		<?php
    					if($product_info[0]->sale_price==null || $product_info[0]->sale_price==0){
    						echo $product_info[0]->regular_price." টাকা";
    					}else{
    						echo ($product_info[0]->regular_price > 0) ? "<del style='color:#dc3545'>".$product_info[0]->regular_price."টাকা</del>" : "";
    						echo "&nbsp;".$product_info[0]->sale_price." টাকা";
    					}
    				?>
    	    	</p>
    	    	<p class="price"><strong>ছাড়</strong> :
    	    		<?php echo $product_info[0]->discount;?> টাকা
    	    	</p>
    	    	<?php if($product_info[0]->brand != "") {?>
    	    	    <p><strong>ব্র্যান্ড</strong> : <?php echo filter($product_info[0]->brand);?></p>
    	    	<?php } ?>
    	    	<?php if($product_info[0]->color != NULL) { ?>
    	    	<strong>
    	    	    Color : <?php echo filter($product_info[0]->color) ;?>
    	    	</strong>
    	    	<br>
    	    	<?php } ?>
    	    	<?php if($product_info[0]->size != NULL) { ?>
    	    	<strong>
    	    	    Size : <?php echo ($product_info[0]->size) ;?>
    	    	</strong><br><br>
    	    	<?php } ?>
    	    	<?php if($product_info[0]->stock_qty > 0) { ?>
    	    	<span class="border-button">
    				<a class=""  ng-click="adjustItemFn(<?php echo $id; ?>)" data-toggle="modal" data-target=".product-pupup">
    					এখনই কিনুন 
    				</a>
    			</span>
    			<?php } ?>
    			<div class="sharethis-inline-share-buttons" style="margin-top: 10px; margin-bottom: 8px;"></div>
            </div>
    	    <div class="col-md-3 add-sm-none text-right">
    		   <?php if($adsInfo != NULL){ ?>
    			    <a href="<?php echo $adsInfo[0]->url; ?>" target="_blank">
    					<img src="<?php echo site_url($adsInfo[0]->path); ?>"  style="width:160; height:400;">
    				</a>
    		   <?php } else { ?>
    	        	<img src="http://via.placeholder.com/160x400" class="img-responsive img-thumbnail" style="width:160; height:400;"> 
    		   <?php } ?>
            </div>
            
            <div class="col-md-9">
                <div class="description_text">
                    <p><?php echo $product_info[0]->description; ?></p>
                </div>
            </div>
    	</div>
    </div>
    
    <div class="review_section">
        <?php if($this->session->userdata('subscriberLoggedin') != 1){ ?>
        <div class="col-md-12" style="margin-top: 3rem;">
    		<h3>পণ্য পর্যালোচনা এবং রেটিং</h3>
    		<hr>
    	</div>
    	<div class="col-md-12">
            <div class="user-info">
                <h4>প্রথমে আপনার অ্যাকাউন্টে পর্যালোচনার জন্য লগইন করুন</h4>
                <a href="<?=site_url('login')?>">লগইন করুন</a> 
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-6">
                <div class="review_area">
                    <?php if($this->session->userdata('subscriberLoggedin') == 1){ ?>
                    <form action="<?=site_url('frontend/home/review')?>" method="POST">
                        <div class="review">
                            <h3 class="name"><?=ucfirst($this->session->userdata('name'))?></h3>
                            <div class="form-group">
                                <textarea name="review" class="form-control" rows="4" placeholder="Write Your Review Here"></textarea>
                                <input type="hidden" name="user_id" value="<?=($this->session->userdata('user_id'))?>">
                                <input type="hidden" name="product_id" value="<?=($product_info[0]->id)?>">
                            </div>
                            <div class="form-group text-right">
                                <div class="btn-group">
                                    <input type="submit" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                    <div class="all-review">
                        <?php $all_review = getReview($product_info[0]->id);
                            if($all_review) foreach($all_review as $review){ 
                        ?>
                        <div class="user_review">
                            <img src="https://www.holmaninsures.com/wp-content/uploads/2017/11/demo-sm-men-pic.jpg" height="50">
                            <div class="review_article">
                                <h4 class="name"><?=($review->name)?></h4>
                                <small><?=($review->date)?></small>
                                <p><?=($review->review)?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
	<div class="more_products">
	    <?php
		if($product_info != NULL){
			$where = array(
				"product_cat"  => $product_info[0]->product_cat,
				"status"=>1
			);
			  
			$moreProducts = $this->action->read_limit_rand("products",$where,"rand()",12);
		   }
		?>
		<?php if($moreProducts != NULL) { ?>

    	<div class="col-md-12" style="margin-top: 3rem;">
    		<h3>সম্পর্কিত পণ্য</h3>
    		<hr>
    	</div>
	    <div class="col-md-12 single_page_custom_grid">
            <?php
		        foreach ($moreProducts as $key => $value) {	 
		    ?>
		    <div class="col-lg-2 col-md-3 col-sm-4 product_width">
				<div class="responsive_<?php echo $key+1;?> slider" style="height: 340px; width: 100%">

					<div class="content_item">
						<a class="contain_img" href="<?php echo site_url('frontend/home/products_details/'.$value->id);?>">
							<figure>
							    <button class="add_wishlist active_<?php echo $value->id?>" onclick="wish_list.addToWishList(<?php echo $value->id?>)"><i class="fa fa-heart" aria-hidden="true"></i></button>
								<img class="img-responsive man_lazy" src="<?php echo site_url('public/lazy_load.png'); ?>" data-src="<?php echo base_url('/public/upload/product/medium/'.$value->img_path); ?>" alt="Product Missing">
							</figure>
							<span>
								<p class="text-center product_name"><?php echo $value->product_name; ?></p>
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
							<a class="btn btn-default btn-sm" ng-click="adjustItemFn(<?php echo $value->id; ?>)" data-toggle="modal" data-target=".product-pupup" >
								<i class="fa fa-shopping-bag" aria-hidden="true"></i>
								এখনই কিনুন 
							</a>
							<?php } ?>
						</span>
					</div>
				</div>
			</div>
		    <?php  } } ?>
		</div>
	</div>
	<?php } else { ?>
		 <h4 class="alert alert-danger text-center">দুঃখিত,কোন পণ্য নেই! অনুগ্রহ করে আবার চেষ্টা করুন।</h4>
	<?php } ?>
</div>


<!-- carousel js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="<?php echo site_url('public/easyzoom-master/src/jquery.ez-plus.js'); ?>"></script>
<script src="<?php echo site_url('public/easyzoom-master/src/web.js'); ?>"></script>
<script>
    /* tabs product */
    $('.tabs_product').owlCarousel({
        autoplay:true,
        loop:true,
        nav:false,
        dots:false,
        autoplayTimeout:5000,
        margin: 5,
        responsive:{
            1200:{items:4},
            991:{items:3},
            768:{items:3},
            576:{items:3},
            0:{items:3}
        }
    });
	// Instantiate EasyZoom instances
	var $easyzoom = $('.easyzoom').easyZoom();

	// Setup thumbnails example
	var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

	$('.thumbnails').on('click', 'a', function(e) {
		var $this = $(this);
		e.preventDefault();
		// Use EasyZoom's `swap` method
		api1.swap($this.data('standard'), $this.attr('href'));
	});
</script>
