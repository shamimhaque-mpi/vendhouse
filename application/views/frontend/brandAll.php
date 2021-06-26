<style>
	.content_item {
    	/*border: 0 !important;
    	margin-left: 0 !important;
    	margin-right: 0 !important;*/
	}
	.product_name{
		white-space: nowrap;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    padding:0 8px;
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
	.brandList{}
	.brandList a{
		display: block;
		cursor: pointer;
		padding: 5px 0;
		box-sizing: border-box;
	}
</style>
<section class="container" ng-controller="allbrandCtrl" ng-cloak>
	<div class="row">
		<div class="col-md-12">
			<div class="regular slider" >
				<div class="col-md-12">
					<div class="category_header clearfix">
						<h3 class="pull-left">
						সকল ব্র্যান্ডস
						</h3>
					</div>
				</div>
				<div class="col-sm-12" style="margin-bottom: 50px;">
					<div class="brandList col-sm-3" ng-repeat="row in allBrand">
						<a href="<?php echo site_url('frontend/home/singlePage?brand={{ row.subcategory }}&type=subcategory');?>"><i class="fa fa-tags"></i> {{row.subcategory | textBeautify }} ({{ row.total }})</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
