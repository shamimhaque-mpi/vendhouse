<style>
    .show-in-print {
        display: none;
    }
    @media print{
         aside, nav, .none, .panel-heading, .panel-footer{
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .hide{
            display: block !important;
        }
        .title{
            font-size: 25px;
        }
        .hide-in-print {
            display: none;
        }
        .show-in-print {
            display: block;
        }
    }
</style>

<div class="container-fluid" ng-controller="showAllProductCtrl" ng-cloak ng-model="privilege" ng-init="privilege='<?php echo $privilege; ?>';">
<p ng-model="user_id" ng-init="user_id='<?php echo $this->data['user_id']; ?>';"></p>
    <div id="loading">
           <img src="<?php echo site_url('private/images/loading-bar.gif');?>" alt="Image Not found"/>
    </div>

    <div class="row loader-hide" id="data">
	<?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo caption('All_Product') ;?>  <br>  <small><?php echo $total_product; ?> <?php echo caption('Item_Found') ;?></small></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print') ;?></a>
                </div>
            </div>

            <div ng-cloak class="panel-body" ng-hide="active" ng-init="active=true;">

               <!-- Print Banner -->

                <div class="row hide">
                    <div class="view-profile">

                        <div class="institute">
                            <h2 class="text-center title" style="margin-top: 10px; font-weight: bold;">
                                <?php $print_header = config_item('heading');echo $print_header['title']; ?>
                            </h2>
                            <h4 class="text-center" style="margin: 0;">
                                <?php $print_header = config_item('heading');echo $print_header['place']; ?>
                            </h4>
                            <h4 class="text-center" style="margin: 0;">
                              Mobile: <?php $print_header = config_item('heading');echo $print_header['mobile']; ?>
                            </h4>
                        </div>

                    </div>
                </div>


                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">

                 <div class="row none" style="margin-bottom:15px;">
                    <div class="col-md-4">
                         <input type="text" ng-model="search" placeholder="<?php echo caption('Search') ;?>" class="form-control">
                    </div>


                    <div class="col-md-5">&nbsp;</div>
                    <div class="col-md-3">
                        <div>
                             <span style="margin-left: 55px;line-height: 2.4;font-weight: bold;"><?php echo caption('Per_Page') ;?>&nbsp;&nbsp;</span>
                             <select ng-model="perPage" class="form-control" style="width:92px;float:right;">
                             <option value="">All</option>
                             <option value="2">2</option>
                             <option value="3">3</option>
                             <option value="10">10</option>
                             <option value="20">20</option>
                             <option value="30">30</option>
                             <option value="50">50</option>
                             <option value="100">100</option>
                             </select>
                         </div>
                    </div>
                </div>

                <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 35px;"> <?php echo caption('SL') ;?> </th>
                        <th style="width: 20%;"><?php echo caption('Product_Name') ;?></th>
                        <th><?php echo caption('user') ;?></th>
                        <th><?php echo caption('Product_Code') ;?></th>
                        <th><?php echo caption('Category') ;?></th>
                        <th><?php echo caption('Brand') ;?></th>
                        <th><?php echo caption('Product') ;?></th>
                        <th><?php echo caption('Purchase_price') ;?></th>
                        <th><?php echo caption('Sale_Price') ;?></th>
                        <th>VAT (%)</th>
                        <th><?php echo caption('Status') ;?></th>
                        <th class="none"> <?php echo caption('Action') ;?> </th>
                    </tr>
                     <tr dir-paginate="product in products|filter:search|itemsPerPage:perPage|orderBy:sortField:reverse">
                        <td>{{product.sl}}</td>
                        <td>{{product.product_name | ucwords }}</td>
                        <td>{{product.user_name}}</td>
                        <td>{{product.bar_code }}</td>
                        <td>{{product.product_cat | textBeautify}}</td>
                        <td>{{product.subcategory | textBeautify}}</td>
                        <td class="hide-in-print">
                            <a href="<?php echo site_url('{{product.img_path}}'); ?>" class="example-image-link" data-lightbox="example-set">
                                <img style="width: 80px" src="<?php echo site_url('{{product.img_path}}'); ?>" alt=" Pic Not Found !" />
                            </a>
                        </td>
                        <td class="show-in-print"><img style="width: 80px" src="<?php echo site_url('{{product.img_path}}'); ?>" alt=" Pic Not Found !" /></td>
                        <td>{{product.purchase_price}}</td>
                        <td>{{product.sale_price}}</td>
                        <td>{{product.vat}}</td>
                        <td>{{product.status | showStatus}}</td>
                        <td class="none" style="width: 110px;">
                            <?php if(ck_action("product","edit")){ ?>
                            <a title="Edit" class="btn btn-warning" href="<?php echo site_url('product/product/editProduct/{{product.id}}') ;?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php } ?>
                            <?php if(ck_action("product","delete")){ ?>
                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this Product?');" href="?id={{product.id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                </div>
                <dir-pagination-controls max-size="perPage" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls>
               </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
