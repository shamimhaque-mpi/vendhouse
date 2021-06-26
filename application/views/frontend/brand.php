<style>
.content_item {
    /*border: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;*/
}
.product_name{
	/*white-space: nowrap;
    overflow: hidden;*/
   /*  text-overflow: ellipsis; */
    padding:0 8px;
}
figure {
	position: relative;
	overflow: hidden;
}

figure .stock_status span.stock-alert {
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
    background: red;
}

.stock-out {
	background: #dc3545 !important;
}
.stock-limit {
	background: #ffc107 !important;
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
<section class="container" ng-controller="seeBrandCtrl" ng-cloak>
	<div class="row" ng-init="cat='<?php echo $this->input->get("cat"); ?>'; subcat='<?php echo $this->input->get("subcat"); ?>'">
		<div class="col-md-12">
			<div class="regular slider single_page_bg slider">
				<div class="col-md-12">
					<div class="category_header clearfix">
						<h3 class="pull-left">
						{{ products[0].product_cat }}
						</h3>
					</div>
				</div>
                <div class="single_item_box">
				    <div ng-repeat="product in products" class="col-sm-2 col-xs-12 content_item">
					<a class="contain_img" href="<?php echo site_url('{{ product.url }}');?>">
						<figure>
						    <button class="add_wishlist active_{{product.id}}" data-row="{{product.id}}"><i class="fa fa-heart" aria-hidden="true"></i></button>
							<img class="img-responsive" ng-src="<?php echo base_url('public/upload/product/medium/'); ?>/{{product.img_path}}" alt="Product Missing">
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
							data-toggle="modal" data-target=".product-pupup">
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
