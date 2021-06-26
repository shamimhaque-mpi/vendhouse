<link rel="stylesheet" href="<?= base_url('public/css/see_more.css'); ?>">

<section class="container" ng-controller="seeMoreCtrl" ng-cloak>
	<div class="row bg-body-color"  style="margin: 40px 0 20px 0;" ng-init="cat='<?php echo $this->input->get("cat"); ?>'">
		<div class="col-md-12">
			<div class="regular slider">
				<div>
					<div class="category_header clearfix">
						<h3 class="pull-left">
						{{ products[0].product_cat }}
						</h3>
					</div>
				</div>

				<div ng-repeat="product in products" class="col-sm-2 col-xs-12 content_item" style="height:300px;padding:5px;">

					<a class="contain_img" href="<?php echo site_url('{{ product.url }}');?>">
						<figure>
							<img class="img-responsive" ng-src="<?php echo base_url('/public/upload/product/thumbnail'); ?>/{{product.img_path}}" alt="Product Missing">
						</figure>
						<span>
							<p class="text-center product_name">{{product.product_name}}</p>
							<p ng-if="product.sale_price == 'null' || product.sale_price == 0" style="font-size: 15px;" class="price-weight text-center">
								{{ product.regular_price}}&nbsp;টাকা
							</p>
							<p ng-if="product.sale_price > 0" style="font-size: 15px;" class="price-weight text-center">
								<del ng-if="product.regular_price > 0" style='color:#dc3545'>{{ product.regular_price }}&nbsp;টাকা</del>
								&nbsp; {{ product.sale_price}}&nbsp;টাকা
							</p>
						</span>
					</a>



					<span class="border-button">
						<a
							class="btn btn-default btn-sm"
							ng-click="adjustItemFn(product.id)"
							data-toggle="modal" data-target=".product-pupup"
							>
							<i class="fa fa-shopping-bag" aria-hidden="true"></i>
							এখনই কিনুন
						</a>
					</span>

				</div>
			</div>
			<div ng-if="limit <= products.length" class="col-md-12" style="text-align: center;margin-top:20px;">
				<span class="btn btn-primary btn-yellow btn-blue" ng-click="seeMore(30)">আরো..</span>
				<img style="width: 50px; display: none;" id="loading" src="<?php echo site_url("public/img/spinner.gif"); ?>" alt="">
			</div>
		</div>
	</div>
</section>
