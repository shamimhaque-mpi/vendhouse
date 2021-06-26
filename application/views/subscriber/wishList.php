<link rel="stylesheet" href="<?php echo site_url('public/css/wishlist.css')?>">
<script src="<?= base_url('private/js/wishListController.js'); ?>"></script>
<section class="container">
    <div class="panel panel-default" style="margin-top: 30px;">
        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel-heading user_header">
            <h3>WishList</h3>
        </div>
        <!-- Order Panel -->
        <div class="panel-body" ng-controller="wishListCtrl">
            <div class="row">
                <?php
                    $this->load->view('frontend/include/user_aside', $this->data);
        	    ?>
    
	            <div class="col-md-9" ng-model="user_id" ng-init="user_id='<?php echo $this->session->userdata('user_id')?>'">
                    <div class="wishlist_box">
                        <div class="clear_div">
                            <!--<a href="" class="clear_history">Clear all history</a>-->
                        </div>
                        
                        <div class="collection_file" ng-repeat="item in items">
                            <img class="file_preview" src="<?= site_url('public/upload/product/medium') ?>/{{item.img_path}}" alt="">
                            <div class="collection_title">
                                <div class="file_type">
                                    <h5>{{item.product_name}}</h5>
                                    <h6>Price : {{item.sale_price}} Tk</h6>
                                </div>
                                <div class="collection_action">
                                    <a href="<?=site_url('frontend/home/products_details')?>/{{item.id}}" class="view"><i class="fa fa-eye" aria-hidden="true"></i> <span>View Product</span></a>
                                    <a href="javascript:void(0)" ng-click="remove(item.id)" class="remove"><i class="fa fa-trash" aria-hidden="true"></i> <span>Remove</span></a>
                                </div>
                            </div>
                        </div>

                        <!-- pagination -->
                        <!--<ul class="pagination">
                            <li><a href=""><i class="icon ion-ios-arrow-back"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li class="active"><a href="">3</a></li>
                            <li class="d-sm-inline-block d-none"><a href="">4</a></li>
                            <li><a href="">....</a></li>
                            <li><a href="">7</a></li>
                            <li><a href=""><i class="icon ion-ios-arrow-forward"></i></a></li>
                        </ul>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url('private/js/wishList.js'); ?>"></script>
<script>
    new wishList(<?php echo $this->session->userdata('user_id')?>);
</script>