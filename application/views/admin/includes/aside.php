<style>
    ul li a span.icon{
        float: right;
        margin-right: 20px;
    }
</style>
<!-- Sidebar -->
<aside id="sidebar-wrapper">
    <div class="sidebar-nav">
        <h3 class="sidebar-brand">
            <a href="#"><?php echo caption('Admin'); ?>
                <span><?php echo caption('Panel'); ?></span>
            </a>
        </h3>
    </div>

    <nav>
        <ul class="sidebar-nav">
            <?php if(ck_menu("dashboard")){ ?>
            <li id="dashboard">
                <a href="<?php echo site_url('admin/dashboard'); ?>">
                    <i class="fa fa-home"></i>
                    &nbsp;<?php echo caption('Dashboard');?>
                </a>
            </li>
            <?php } ?>


            <?php if(ck_menu("slider_menu")){ ?>
            <li id="slider_menu">
                <a href="<?php echo site_url('slider/slider');?>">
                    <i class="fa fa-file-image-o"></i>&nbsp;
                    Slider
                </a>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("sr_menu")){ ?>
            <li id="sr_menu">
                <a href="#sr_" data-toggle="collapse">
                   <i class="fa fa-user"></i>
                       SR
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="sr_" class="sidebar-nav collapse">
                    <?php if(ck_action("sr_menu","field")){ ?>
                    <li>
                        <a href="<?php echo site_url('sr/sr/field'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Add Field
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("sr_menu","add")){ ?>
                    <li>
                        <a href="<?php echo site_url('sr/sr'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Add SR
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("sr_menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('sr/sr/view_all');?>">
                            <i class="fa fa-angle-right"></i>
                                View All
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("category_menu")){ ?>
            <li id="category_menu">
                <a href="#category_" data-toggle="collapse">
                   <i class="fa fa-tags"></i>
                       Category
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="category_" class="sidebar-nav collapse">
                    <?php if(ck_action("category_menu","add-new")){ ?>
                    <li>
                        <a href="<?php echo site_url('category/category');?>">
                            <i class="fa fa-angle-right"></i>
                                Add Category
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("category_menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('category/category/allCategory'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All Category
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("category_menu","align")){ ?>
                    <li>
                        <a href="<?php echo site_url('category/category/alignCategory'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Align Category
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("subCategory_menu")){ ?>
            <li id="subCategory_menu">
                <a href="#scategory_" data-toggle="collapse">
                   <i class="fa fa-cubes"></i>
                       Subcategory
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="scategory_" class="sidebar-nav collapse">
                    <?php if(ck_action("subCategory_menu","add-new")){ ?>
                    <li>
                        <a href="<?php echo site_url('subCategory/subCategory');?>">
                            <i class="fa fa-angle-right"></i>
                                Add Subcategory
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("subCategory_menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('subCategory/subCategory/allsubCategory'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All Subcategory
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("brand_menu")){ ?>
            <li id="brand_menu">
                <a href="#brand_" data-toggle="collapse">
                   <i class="fa fa-cubes"></i>
                       Brand
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="brand_" class="sidebar-nav collapse">
                    <?php if(ck_action("brand_menu","add-new")){ ?>
                    <li>
                        <a href="<?php echo site_url('brand/brand');?>">
                            <i class="fa fa-angle-right"></i>
                                Add New
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("brand_menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('brand/brand/all'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All Brand
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("product_menu")){ ?>
            <li id="product_menu">
                <a href="#product_" data-toggle="collapse">
                   <i class="fa fa-product-hunt"></i>
                       Product
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="product_" class="sidebar-nav collapse">
                    <?php if(ck_action("product_menu","add-new")){ ?>
                    <li>
                        <a href="<?php echo site_url('product/product');?>">
                            <i class="fa fa-angle-right"></i>
                                Add New
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("product_menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('product/product/allProduct'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All Product
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("user_supplier_menu")){ ?>
            <!--<li id="user_supplier_menu">
                <a href="<?php echo site_url('user_supplier/user_supplier');?>">
                    <i class="fa fa-users"></i>
                    &nbsp;Suppliers
                </a>
            </li>-->
            <?php } ?>
            
            <!-- For later use in this project start -->
            <?php if(ck_menu("supplier-menu")){ ?> 
            <!--<li id="supplier-menu">
                <a href="#company" data-toggle="collapse">
                    <i class="fa fa-building-o"></i>
                    &nbsp;Supplier
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="company" class="sidebar-nav collapse">
                    <?php if(ck_action("supplier-menu","add")){ ?>
                    <li>
                        <a href="<?php echo site_url('supplier/supplier');?>">
                            <i class="fa fa-angle-right"></i>
                            Add Supplier
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("supplier-menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('supplier/supplier/view_all'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Supplier
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("supplier-menu","transaction")){ ?>
                    <li>
                        <a href="<?php echo site_url('supplier/transaction/'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Transaction
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("supplier-menu","all-transaction")){ ?>
                    <li>
                        <a href="<?php echo site_url('supplier/all_transaction'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Transaction
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>-->
            <?php } ?>
            
            <?php if(ck_menu("purchase_menu")){ ?> 
            <!--<li id="purchase_menu">
                <a href="#purchase" data-toggle="collapse">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    &nbsp;Purchase
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="purchase" class="sidebar-nav collapse">
                    <?php if(ck_action("purchase_menu","add-new")){ ?>
                    <li>
                        <a href="<?php echo site_url('purchase/purchase'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Purchase
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(ck_action("purchase_menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('purchase/purchase/show_purchase'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Purchase
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("purchase_menu","wise")){ ?>
                    <li>
                        <a href="<?php echo site_url('purchase/purchase/itemWise'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Item Wise
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("purchase_menu","return")){ ?>
                    <li>
                        <a href="<?php echo site_url('purchase/productReturn'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Purchase Return
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("purchase_menu","all_return")){ ?>
                    <li>
                        <a href="<?php echo site_url('purchase/productReturn/allReturn'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Purchase Return
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>-->
            <?php } ?>
            
            <?php if(ck_menu("raw_stock_menu")){ ?> 
            <!--<li id="raw_stock_menu">
                <a href="<?php echo site_url('stock/stock'); ?>">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i> &nbsp;Stock
                </a>
            </li>-->
            <?php } ?>
            <!-- For later use in this project end -->
            
            
            <?php if(ck_menu("area_menu")){ ?>
            <li id="area_menu">
                <a href="<?php echo site_url('area/area'); ?>">
                    <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                    Add Area
                </a>
            </li>
            <?php } ?>
            
            
            <?php if(ck_menu("page_menu")){ ?>
            <li id="page_menu">
                <a href="#page_" data-toggle="collapse">
                   <i class="fa fa-ticket"></i>
                       Frontend Page 
                       <?php ck_action("page_menu","add-new");?> 

                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="page_" class="sidebar-nav collapse">
                    <?php if(ck_action("page_menu","add-new")){ ?>
                    <li>
                        <a href="<?php echo site_url('page');?>">
                            <i class="fa fa-angle-right"></i>
                                Add New
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("page_menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('page/all'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>


            <?php if(ck_menu("customer_menu")){ ?>
            <li id="customer_menu">
                <a href="<?php echo site_url('customer/customer'); ?>">
                    <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                    Customer
                </a>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("ads_menu")){ ?>
            <li id="ads_menu">
                <a href="<?php echo site_url('ads/ads'); ?>">
                     <i class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp;
                    Advertisement
                </a>
            </li> 
            <?php } ?>
            
            
            <?php 
                $new_order = count($this->action->read('orders', array('status'=>'pending')));
            ?>
            <?php if(ck_menu("order_menu")){ ?>
            <li id="order_menu">
                <a href="#order_" data-toggle="collapse">
                   <i class="fa fa-shopping-cart"></i>
                       Order <span style="color:green;font-weight:bold;"><?php if(isset($new_order)){echo "(".$new_order.")";}else{echo "(0)";} ?></span>
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="order_" class="sidebar-nav collapse">
                    <?php if(ck_action("order_menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('order/order');?>">
                            <i class="fa fa-angle-right"></i>
                                All Order
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("order_menu","sr")){ ?>
                    <!--<li>
                        <a href="<?php echo site_url('order/order/srOrder'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                SR Order
                        </a>
                    </li>-->
                    <?php } ?>
                    
                    <?php if(ck_action("order_menu","search")){ ?>
                    <li>
                        <a href="<?php echo site_url('order/order/searchOrder'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Search Order
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("cost_menu")){ ?>
            <li id="cost_menu">
                <a href="#cost_" data-toggle="collapse">
                   <i class="fa fa-money"></i>
                       Cost 
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="cost_" class="sidebar-nav collapse">
                    <?php if(ck_action("cost_menu","field")){ ?>
                    <li>
                        <a href="<?php echo site_url('cost/cost');?>">
                            <i class="fa fa-angle-right"></i>
                                Field Of Cost
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("cost_menu","new")){ ?>
                    <li>
                        <a href="<?php echo site_url('cost/cost/newcost'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                New Cost
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("cost_menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('cost/cost/allcost'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All Cost
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("report_menu")){ ?>
            <!--<li id="report_menu">
                <a href="#report_" data-toggle="collapse">
                   <i class="fa fa-sitemap"></i>
                      &nbsp; <?php echo caption('Report');?> 
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="report_" class="sidebar-nav collapse">
                    <?php if(ck_action("report_menu","supplier_report")){ ?>
                    <li>
                        <a href="<?php //echo site_url('report/supplier_report');?>">
                            <i class="fa fa-angle-right"></i>
                                Supplier Report
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("report_menu","sr_report")){ ?>
                    <li>
                        <a href="<?php echo site_url('report/sr_report'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                SR Report
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>-->
            <?php } ?>
            
            <?php if(ck_menu("paymentmethod_menu")){ ?>
            <li id="paymentmethod_menu">
                <a href="<?php echo site_url('paymentmethod/paymentmethod');?>">
                    <i class="fa fa-mobile"></i>
                    Payment Method
                </a>
            </li>
            <?php } ?>
              
            <?php if(ck_menu("sms_menu")){ ?>
            <li id="sms_menu">
                <a href="#sms_" data-toggle="collapse">
                   <i class="fa fa-envelope-o"></i>
                      &nbsp; <?php echo caption('Mobile_SMS');?> 
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="sms_" class="sidebar-nav collapse">
                    <?php if(ck_action("sms_menu","send-sms")){ ?>
                    <li>
                        <a href="<?php echo site_url('sms/sendSms');?>">
                            <i class="fa fa-angle-right"></i>
                                Send SMS
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("sms_menu","custom-sms")){ ?>
                    <li>
                        <a href="<?php echo site_url('sms/sendSms/send_custom_sms'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Custom SMS
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("sms_menu","sms-report")){ ?>
                    <li>
                        <a href="<?php echo site_url('sms/sendSms/sms_report'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                SMS Report
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("privilege-menu")){ ?>
            <li id="privilege-menu">
                <a href="<?php echo site_url('privilege/privilege');?>">
                    <i class="fa fa-user-plus"></i>&nbsp;
                    Set Privilege
                </a>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("theme_menu")){ ?>
            <li id="theme_menu">
                <a href="#theme_" data-toggle="collapse">
                   <i class="fa fa-cogs"></i>
                      &nbsp; <?php  echo caption('Theme_Settings'); ?> 
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="theme_" class="sidebar-nav collapse">
                    <?php if(ck_action("theme_menu","basic")){ ?>
                    <li>
                        <a href="<?php echo site_url('theme/themeSetting');?>">
                            <i class="fa fa-angle-right"></i>
                                Basic Settings
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("theme_menu","amount")){ ?>
                    <li>
                        <a href="<?php echo site_url('theme/delivery_charge/delivery_charge'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Amount Settings
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("theme_menu","limit")){ ?>
                    <li>
                        <a href="<?php echo site_url('theme/limit'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Purchase Limitation
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if(ck_menu("backup_menu")){ ?>
            <li id="backup_menu">
                <a href="#backup_" data-toggle="collapse">
                   <i class="fa fa-database"></i>
                      &nbsp;<?php echo caption('Data_Backup');?>
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="backup_" class="sidebar-nav collapse">
                    <?php if(ck_action("backup_menu","add-new")){ ?>
                    <li>
                        <a href="<?php echo site_url('data_backup');?>">
                            <i class="fa fa-angle-right"></i>
                                Export
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(ck_action("backup_menu","all")){ ?>
                    <li>
                        <a href="<?php echo site_url('data_backup/import_data'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Import
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php /*if(ck_action("backup_menu","import")){ ?>
                    <li>
                        <a href="<?php echo site_url('csv_import'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                CSV import
                        </a>
                    </li>
                    <?php }*/ ?>
                </ul>
            </li>
            <?php } ?>
            
        </ul>
    </nav>
</aside>
<!-- /#sidebar-wrapper -->
