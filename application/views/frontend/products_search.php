<style>
	.content_item {
	/*border: 0 !important;
	margin-left: 0 !important;
	margin-right: 0 !important;*/
	}
	.product_name{
		/*white-space: nowrap;
	    overflow: hidden;
	    text-overflow: ellipsis;*/
	    padding:0 8px;
	}

	figure {
		position: relative;
		overflow: hidden;
	}
	figure figcaption span.stock-alert {
		color: #fff;
		text-align: center;
		padding: 3px 0;
		position: absolute;
		top: 25px;
		right: -50px;
		width: 100%;
		max-width: 166px;
		transform: rotate(45deg);
		font-size: 10px;
	}

	#stock-out {
		background: #dc3545;
	}
	#stock-limit {
		background: #ffc107;
	}
	
	@media screen and (min-width: 992px) {
		.content_item {
		    margin-left: 7px;
		    margin-right: 0;
		    width: 16%;
		}
	}
	@media screen and (max-width: 768px) {
		.content_item > figure {
			display: block;
		}
	}
</style>
<section class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="regular slider">
				<div class="col-md-12">
					<div class="category_header clearfix">
						<h3 class="pull-left">
					          ফলাফল খুঁজুন
						</h3>
					</div>
				</div>
                <?php
                   if($product_info != NULL){
                   foreach ($product_info as $key => $value) { ?>
                       <div class="col-sm-2 col-xs-12 content_item">

						 <a class="contain_img" href="<?php echo site_url('frontend/home/products_details/'.$value->id); ?>">
	   						<figure>
	   							<img class="img-responsive man_lazy" src="<?php echo site_url('lazy_load.png'); ?>" data-src="<?php echo base_url('/public/upload/product/thumbnail/'.$value->img_path); ?>" alt="Product Missing">
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
							<a
								class="btn btn-default btn-sm"
								ng-click="adjustItemFn(<?php echo $value->id; ?>)"
								data-toggle="modal" data-target=".product-pupup">
								<i class="fa fa-shopping-bag" aria-hidden="true"></i>
								এখনই কিনুন
							</a>
       					</span>
       				</div>
                  <?php } } ?>
			</div>
		</div>
	</div>
</section>
