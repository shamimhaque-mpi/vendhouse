<link rel="stylesheet" href="<?= base_url('public/css/bcWiseProduct.css'); ?>">

<section class="container" ng-controller="barnd_categoryCtrl" ng-cloak>
	<div class="row" ng-init="brand='<?php echo $brand; ?>'; type='<?php echo $type;?>'">

		<div class="col-md-12">
			<div class="regular single_page_bg slider">
				<div class="col-md-12">
					<div class="category_header clearfix">
						<h3 class="pull-left">
						{{ product_catTitle }}
						</h3>
					</div>
				</div>

				<div class="single_item_box">
				    <div ng-repeat="product in allProducts" class="col-md-2 col-sm-3 content_item">
    					<a class="contain_img" href="<?php echo site_url('{{ product.url }}');?>">
    						<figure>
    						    <button class="add_wishlist active_{{product.id}}" data-row="{{product.id}}"><i class="fa fa-heart" aria-hidden="true"></i></button>
    							<img class="img-responsive" ng-src="<?php echo base_url('/public/upload/product/thumbnail/'); ?>/{{product.img_path}}" alt="Product Missing">
    						</figure>
    						<span>
    							<p class="text-center product_name">{{product.product_name}}</p>
    							<p ng-if="product.sale_price == 'null' || product.sale_price == 0" style="font-size: 15px;" class="price-weight text-center">
    								{{ product.regular_price}}&nbsp;টাকা
    							</p>
    							<p ng-if="product.sale_price > 0" style="font-size: 15px;" class="price-weight text-center">
    								<del ng-if="product.regular_price > 0" style='color:#dc3545'>{{ product.regular_price }}&nbsp;TK</del>
    								&nbsp; {{ product.sale_price}}&nbsp;টাকা
    							</p>
    						</span>
    					</a>
    					<span class="border-button">
    						<a class="btn btn-default btn-sm" ng-click="adjustItemFn(product.id)" data-toggle="modal" data-target=".product-pupup">
    							<i class="fa fa-shopping-bag" aria-hidden="true"></i>
    							এখনই কিনুন
    						</a>
    					</span>
    				</div>
				</div>
			</div>
			<div ng-if="limit <= products.length" class="col-md-12" style="text-align: center;margin-top:20px;">
				<span class="btn btn-primary btn-yellow btn-blue" ng-click="seeMore(18)">আরো..</span>
				<img style="width: 50px; display: none;" id="loading" src="<?php echo site_url("public/img/spinner.gif"); ?>" alt="">
			</div>
		</div>
	</div>
</section>

<script src="<?= base_url('private/js/wishList.js'); ?>"></script>
<script>
window.addEventListener('load', ()=>{
    var wish_list = new wishList(<?php echo $this->session->userdata('user_id')?>);
    var add_btn   = document.querySelectorAll('.add_wishlist');
    if(add_btn){
        (Object.values(add_btn)).forEach((value)=>{
            value.addEventListener('click', (event)=>{
                event.preventDefault();
                wish_list.addToWishList(value.dataset.row);
            });
        });
    }
});
    
</script>
