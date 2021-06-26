<style>
    ul li a span.icon{
        float: right;
        margin-right: 20px;
    }
</style>
<!-- Sidebar -->
<aside id="sidebar-wrapper">
    <div class="sidebar-nav">
        <h3 class="sidebar-brand"><a href="#"><?php echo caption('Admin'); ?> <span><?php echo caption('Panel'); ?></a></h3>
    </div>

    <nav>
        <ul class="sidebar-nav">
            
            <!--Dashboard Menu Start-->
            <li id="dashboard">
                <a href="<?php echo site_url('super/dashboard'); ?>">
                    <i class="fa fa-home"></i>
                    &nbsp;<?php echo caption('Dashboard');?>
                </a>
            </li>
            <!--Dahsboard Menu End-->
            
            
            <?php /* <li id="sale_menu">
                <a href="<?php echo site_url('sale/sale'); ?>">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <?php echo caption('Sales');?>
                </a>
            </li>

             <li id="purchase_menu">
                <a href="<?php echo site_url('purchase/purchase');?>">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    &nbsp;<?php echo caption('Purchase');?>
                </a>
            </li>

            <li id="stock">
                <a href="<?php echo site_url('stock'); ?>">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    &nbsp;<?php echo caption('Stock');?>
                </a>
            </li> */ ?>


            <!--Slider Menu Start-->
            <li id="slider_menu">
                <a href="<?php echo site_url('slider/slider');?>">
                    <i class="fa fa-file-image-o"></i>
                    &nbsp;Slider
                </a>
            </li>
            <!--Slider Menu End-->
            
            <!--Sr Menu Start-->
            <!--<li id="sr_menu">
                <a href="#sr_" data-toggle="collapse">
                   <i class="fa fa-user"></i>
                       &nbsp;SR
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="sr_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('sr/sr/field'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Add Field
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sr/sr'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Add SR
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sr/sr/view_all');?>">
                            <i class="fa fa-angle-right"></i>
                                View All
                        </a>
                    </li>
                </ul>
            </li>-->
            <!--SR Menu End-->
            
            
            <!--Order Menu Start-->
            <?php 
                $new_order = count($this->action->read('orders', array('status'=>'pending')));
            ?>
            
            <li id="order_menu">
                <a href="#order_" data-toggle="collapse">
                   <i class="fa fa-shopping-cart"></i>
                       &nbsp;Order <span style="color:green;font-weight:bold;"><?php if(isset($new_order)){echo "(".$new_order.")";}else{echo "(0)";} ?></span>
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="order_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('order/order');?>">
                            <i class="fa fa-angle-right"></i>
                                All Order
                        </a>
                    </li>
                    
                    <!--<li>
                        <a href="<?php echo site_url('order/order/srOrder'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                SR Order
                        </a>
                    </li>-->
                    
                    <li>
                        <a href="<?php echo site_url('order/order/searchOrder'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Search Order
                        </a>
                    </li>
                </ul>
            </li>
            <!--Order Menu End-->
            
            
            <!--Category Menu Start-->
            <li id="category_menu">
                <a href="#category_" data-toggle="collapse">
                   <i class="fa fa-tags"></i>
                       &nbsp;Category
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="category_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('category/category');?>">
                            <i class="fa fa-angle-right"></i>
                                Add Category
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('category/category/allCategory'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All Category
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('category/category/alignCategory'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Align Category
                        </a>
                    </li>
                </ul>
            </li>
            <!--Category Menu End-->
            
            
            <!--Subcategory Menu Start-->
            <li id="subCategory_menu">
                <a href="#scategory_" data-toggle="collapse">
                   <i class="fa fa-cubes"></i>
                       &nbsp;Subcategory
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="scategory_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('subCategory/subCategory');?>">
                            <i class="fa fa-angle-right"></i>
                                Add Subcategory
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('subCategory/subCategory/allsubCategory'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All Subcategory
                        </a>
                    </li>
                </ul>
            </li>
            <!--Subcategory Menu End-->
            
            
            <!--Brand Menu start-->
            <li id="brand_menu">
                <a href="#brand_" data-toggle="collapse">
                   <i class="fa fa-cubes"></i>
                       &nbsp;Brand
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="brand_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('brand/brand');?>">
                            <i class="fa fa-angle-right"></i>
                                Add New
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('brand/brand/all'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All Brand
                        </a>
                    </li>
                </ul>
            </li>
            <!--Brand Menu End-->
            
            
            <!--Product Menu Start-->
            <li id="product_menu">
                <a href="#product_" data-toggle="collapse">
                   <i class="fa fa-product-hunt"></i>
                       &nbsp;Product
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="product_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('product/product');?>">
                            <i class="fa fa-angle-right"></i>
                                Add New
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('product/product/allProduct'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All Product
                        </a>
                    </li>
                </ul>
            </li>
            <!--Product Menu End-->
            
            <!--Stock Menu Start-->
            <li id="stock_menu">
                <a href="<?php echo site_url('stock/stock/product_stock'); ?>">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    &nbsp;Stock
                </a>
            </li>
            <!--Stock Menu End-->
            
            <!--li id="free_product_menu">
                <a href="<?php echo site_url('free_product/free_product'); ?>">
                    <i class="fa fa-product-hunt" aria-hidden="true" style="font-size: 15px;"></i>
                   <?php echo caption('Free_Product');?>
                </a>
            </li-->
            

            <!--Supplier Menu Start-->
            <!--<li id="user_supplier_menu">
                <a href="<?php echo site_url('user_supplier/user_supplier');?>">
                    <i class="fa fa-users"></i>
                    &nbsp;Suppliers
                </a>
            </li>-->
            
            
            
            <!-- For later use in this project start -->
            <!--<li id="supplier-menu">
                <a href="#company" data-toggle="collapse">
                    <i class="fa fa-building-o"></i>
                    &nbsp;Supplier
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="company" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('supplier/supplier');?>">
                            <i class="fa fa-angle-right"></i>
                            Add Supplier
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('supplier/supplier/view_all'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Supplier
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('supplier/transaction/'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Transaction
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('supplier/all_transaction'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Transaction
                        </a>
                    </li>
                </ul>
            </li>
            
            <li id="purchase_menu">
                <a href="#purchase" data-toggle="collapse">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    &nbsp;Purchase
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="purchase" class="sidebar-nav collapse">

                    <li>
                        <a href="<?php echo site_url('purchase/purchase'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Purchase
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('purchase/purchase/show_purchase'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Purchase
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('purchase/purchase/itemWise'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Item Wise
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('purchase/productReturn'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Purchase Return
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('purchase/productReturn/allReturn'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Purchase Return
                        </a>
                    </li>
                </ul>
            </li>
            
            <li id="raw_stock_menu">
                <a href="<?php echo site_url('stock/stock'); ?>">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i> &nbsp;Stock
                </a>
            </li>-->
            <!-- For later use in this project end -->
            
            <!--Customer Menu Start-->
            <li id="customer_menu">
                <a href="<?php echo site_url('customer/customer'); ?>">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    &nbsp;Customer
                </a>
            </li>
            <!--Customer Menu End-->
            
            
            <!--Frontend Page Start-->
            <li id="page_menu">
                <a href="#page_" data-toggle="collapse">
                   <i class="fa fa-ticket"></i>
                       &nbsp;Frontend Page
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="page_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('page');?>">
                            <i class="fa fa-angle-right"></i>
                                Add New
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('page/all'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All
                        </a>
                    </li>
                </ul>
            </li>
            <!--Frontend Page End-->
            
            
            <!--Districts Menu Start-->
            <li id="district_menu">
                <a href="<?php echo site_url('district/district'); ?>">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                    &nbsp;Districts
                </a>
            </li>
            <!--Districts Menu End-->
            

            <!--Upazila Menu Start-->
            <li id="upazila_menu">
                <a href="<?php echo site_url('area/area'); ?>">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                    &nbsp;Upazilas
                </a>
            </li>
            <!--Upazila Menu End-->
            

            <!--Ad Menu Start-->
            <li id="ads_menu">
                <a href="<?php echo site_url('ads/ads'); ?>">
                     <i class="fa fa-file-image-o" aria-hidden="true"></i>
                     &nbsp;Advertisement
                </a>
            </li> 
            <!--Ad Menu End-->
            
            
            <!--li id="affiliate">
                <a href="<?php echo site_url('ads/affiliate'); ?>">
                     <i class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp;
                    Affiliate Product
                </a>
            </li-->
            

            <!--li id="employee_menu">
                <a href="<?php echo site_url('employee/employee');?>">
                    <i class="fa fa-male"></i>
                    <?php echo caption('Employee');?>
                </a>
            </li>


            <li id="bank_menu">
                <a href="<?php echo site_url('bank/bankInfo'); ?>">
                    <i class="fa fa-university"></i>
                    &nbsp;<?php echo caption('Bank');?>
                </a>
            </li-->
            
            
            <!--Cost Menu Start-->
            <li id="cost_menu">
                <a href="#cost_" data-toggle="collapse">
                   <i class="fa fa-money"></i>
                       &nbsp;Cost 
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="cost_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('cost/cost');?>">
                            <i class="fa fa-angle-right"></i>
                                Field Of Cost
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('cost/cost/newcost'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                New Cost
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('cost/cost/allcost'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                All Cost
                        </a>
                    </li>
                </ul>
            </li>
            <!--Cost Menu End-->
            
            
            <!--Report Menu Start-->
            <!--<li id="report_menu">
                <a href="#report_" data-toggle="collapse">
                   <i class="fa fa-sitemap"></i>
                      &nbsp;<?php echo caption('Report');?> 
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="report_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php //echo site_url('report/supplier_report');?>">
                            <i class="fa fa-angle-right"></i>
                                Supplier Report
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/sr_report'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                SR Report
                        </a>
                    </li>
                </ul>
            </li>-->
            <!--Report Menu End-->


            <!--<li id="report_menu">
                <a href="<?php echo site_url("report/supplier_report") ?>" data-toggle="collapse">
                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                    &nbsp;<?php echo caption('Report');?>
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="report" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url("report/supplier_report") ?>">
                            <i class="fa fa-angle-right"></i>
                            Supplier Report
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url("report/sr_report") ?>">
                            <i class="fa fa-angle-right"></i>
                            Sr Report
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url("balance/balance") ?>">
                            <i class="fa fa-angle-right"></i>
                            <?php echo caption('Balance_Sheet');?>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('purchase/purchase/show_Purchase'); ?>">
                            <i class="fa fa-angle-right"></i>
                            <?php echo caption('Purchase');?>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sale/saleToday'); ?>">
                            <i class="fa fa-angle-right"></i>
                             <?php echo caption('Sales');?>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('due/due'); ?>">
                            <i class="fa fa-angle-right"></i>
                             <?php echo 'Due';?>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/salary_statement/'); ?>">
                            <i class="fa fa-angle-right"></i>
                            <?php echo caption('Salary_Staement');?>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('bank/bankInfo/allTransaction'); ?>">
                            <i class="fa fa-angle-right"></i>
                            <?php echo caption('Bank');?>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/cost'); ?>">
                            <i class="fa fa-angle-right"></i>
                           <?php echo caption('Cost');?>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/cost_report');?>">
                            <i class="fa fa-angle-right"></i>
                            Cost Report
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/daily_report'); ?>">
                            <i class="fa fa-angle-right"></i>
                           Daily Report
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/product_history'); ?>">
                            <i class="fa fa-angle-right"></i>
                           Product History
                        </a>
                    </li>
                </ul>
            </li>-->


            <!--li id="barcode_menu">
                <a href="<?php echo site_url('barcode/barcodeGenerate');?>">
                    <i class="fa fa-barcode"></i>
                    Barcode
                </a>
            </li>


            <li id="leave_menu">
                <a href="<?php echo site_url('leave_management/leaveView');?>">
                    <i class="fa fa-paper-plane"></i>
                    <?php echo caption('leave_management'); ?>
                </a>
            </li-->
            

            <!--Payment Method Menu Start-->
            <li id="paymentmethod_menu">
                <a href="<?php echo site_url('paymentmethod/paymentmethod');?>">
                    <i class="fa fa-mobile"></i>
                    &nbsp;Payment Method
                </a>
            </li>
            <!--Payment Method Menu end-->
            
           
           <!--Sms Menu Start -->
           <li id="sms_menu">
                <a href="#sms_" data-toggle="collapse">
                   <i class="fa fa-envelope-o"></i>
                      &nbsp;<?php echo caption('Mobile_SMS');?> 
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="sms_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('sms/sendSms');?>">
                            <i class="fa fa-angle-right"></i>
                                Send SMS
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sms/sendSms/send_custom_sms'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Custom SMS
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sms/sendSms/sms_report'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                SMS Report
                        </a>
                    </li>
                </ul>
            </li>
            <!--SMS Menu End-->
            

            <!--li id="closing-menu">
                <a href="<?php echo site_url('closing/closing');?>">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <?php echo caption('Closing');?>
                </a>
            </li-->


            <!--li id="balance">
                <a href="<?php echo site_url('balance/balance');?>">
                    <i class="fa fa-balance-scale" aria-hidden="true"></i>
                    Balance Sheet
                </a>
            </li-->


            <!--li id="income_menu">
                <a href="<?php echo site_url('income/income'); ?>">
                    <i class="fa fa-money"></i>
                    Income
                </a>
            </li-->
            <!--Theme Menu Start -->
            
            
            <li id="theme_menu">
                <a href="#theme_" data-toggle="collapse">
                   <i class="fa fa-cogs"></i>
                      &nbsp;<?php  echo caption('Theme_Settings'); ?> 
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="theme_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('theme/themeSetting');?>">
                            <i class="fa fa-angle-right"></i>
                                Basic Settings
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('theme/delivery_charge/delivery_charge'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Amount Settings
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('theme/limit'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Purchase Limitation
                        </a>
                    </li>
                </ul>
            </li>
            <!--Theme Menu End Here-->
            
            
            <!--Privilege Menu Start -->
            <li id="privilege-menu">
                <a href="<?php echo site_url('privilege/privilege');?>">
                    <i class="fa fa-user-plus"></i>
                    &nbsp;Set Privilege
                </a>
            </li>
            <!--Privilege Menu End-->
            
            
            <!--Backup Menu Start-->
            <li id="backup_menu">
                <a href="#backup_" data-toggle="collapse">
                   <i class="fa fa-database"></i>
                      &nbsp;<?php echo caption('Data_Backup');?>
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>

                <ul id="backup_" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('data_backup');?>">
                            <i class="fa fa-angle-right"></i>
                                Export
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('data_backup/import_data'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                Import
                        </a>
                    </li>
                    
                    <!--li>
                        <a href="<?php echo site_url('csv_import'); ?>">
                            <i class="fa fa-angle-right"></i> 
                                CSV import
                        </a>
                    </li-->
                </ul>
            </li>
            <!--Backup Menu End-->

        </ul>
    </nav>
</aside>
<!-- /#sidebar-wrapper -->
