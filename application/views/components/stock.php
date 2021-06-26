<style>
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
    }
    .wid-100{
        width: 100px;
    }
</style>

<div class="container-fluid" ng-controller="showAllStockProductCtrl" ng-cloak>
    <?php if($confirmation != NULL){ ?>
        <script type="text/javascript">
            alert('<?php echo $confirmation; ?>');
        </script>
    <?php }  ?>    


    <div id="loading">
           <img src="<?php echo site_url('private/images/loading-bar.gif');?>" alt="Image Not found"/>
    </div>

    <div class="row loader-hide" id="data">
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class=" pull-left"><?php echo caption('Stock') ;?></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i><?php echo caption('Print') ;?> </a>
                </div>
            </div>

            <div class="panel-body">
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

                <h4 class="text-center hide" style="margin-top: -8px;">Date : <?php echo date("Y-m-d");?></h4>



                <div ng-cloak class="row none" style="margin-bottom:15px;">
                     <div class="col-md-4">
                          <input ng-model="search" class="form-control" placeholder="<?php echo 'Search Here'; ?>" style="margin-bottom: 15px;" type="text">
                    </div>
                    <div class="col-md-offset-3 col-md-5">
                        <div>
                             <span style="margin-left: 105px;line-height: 2.4;font-weight: bold;"><?php echo caption('Godwon_Name') ;?>:</span>
                             <select ng-model="search" class="form-control" style="width:192px;float:right;">
                                 <option value="" disabled selected>&nbsp;</option>
                                 <?php foreach ($godowns as $key => $value) { ?>
                                   <option value="<?php echo $value->place;?>"><?php echo $value->place;?></option>
                                 <?php } ?>
                             </select>
                         </div>
                    </div>

                    <!--div class="col-md-3">
                        <div>
                             <select ng-model="perPage" class="form-control" style="width:92px;float:right;">
                             <option value="">All</option>
                             <option value="50">50</option>
                             <option value="100">100</option>
                             <option value="200">200</option>
                             <option value="300">300</option>
                             <option value="500">500</option>
                             </select>
                         </div>
                    </div-->
                </div>

                <div class="table-responsive">
                <table ng-cloak class="table table-bordered">
                    <tr>
                        <th style="width: 40px;"><?php echo caption('SL') ;?></th>
                        <th style="cursor:pointer;"  ng-click="sortField='product_name'; reverse = !reverse;">Name</th>
                        <th style="min-width: 95px;" style="cursor:pointer;"  ng-click="sortField='product_code'; reverse = !reverse;">Code</th>
                        <th style="min-width: 125px;" style="cursor:pointer;"  ng-click="sortField='godown'; reverse = !reverse;"><?php echo caption('Godown') ;?></th>
                        <th style="cursor:pointer;"  ng-click="sortField='quantity'; reverse = !reverse;"><?php echo caption('Quantity') ;?></th>
                        <th style="cursor:pointer;"  ng-click="sortField='purchase_price'; reverse = !reverse;"><?php echo 'Purchase Price'; ?></th>
                        <th style="min-width: 90px;"><?php echo "Total Purchase "; ?></th>
                        <th style="cursor:pointer;"  ng-click="sortField='sell_price'; reverse = !reverse;"><?php echo caption('Sale_Price') ;?></th>
                        <th style="min-width: 90px;">Total Sale </th>
                        <th style="min-width: 90px;">Sold Quantity</th>
                        <th class="none" style="min-width: 90px;">Action</th>
                    </tr>

                    <tr ng-repeat="(index,product) in allStockProducts|filter:search|orderBy:sortField:reverse">
                        <td>{{product.sl}}</td>
                        <td>{{product.product_name}}</td>
                        <td>{{product.code}}</td>
                        <td>{{product.godown | textBeautify}}</td>
                        <td class="wid-100">{{ product.quantity }} {{ product.unit }}</td>
                        <td class="wid-100">{{product.purchase_price}}</td>
                        <td class="wid-100">{{product.getPurchaseTotal}}</td>
                        <td class="wid-100">{{product.sell_price}}</td>
                        <td>{{ product.subTotal }}</td>
                        <td>{{ product.sold_quantity}} {{ product.unit }} </td>
                        <td class="none">
                            <?php if(ck_action("Stock","edit")){ ?>
                            <button  class="btn btn-primary" data-toggle="modal" ng-click="getProductInfo(product.code);" data-target="#myModal"><i class="fa fa-edit"></i></button>
                            <?php } ?>                        
                        </td>
                    </tr>

                    <tr>
                        <th colspan="4" class="text-right"><?php echo caption('Grand_Total'); ?></th>
                        <th>{{ getTotalQuantityFn() }}</th>
                        <th>{{ getPurchasePriceFn() }}</th>
                        <th>{{ totalPurchase }}</th>
                        <th>{{ getTotalSalePriceFn() }}</th>
                        <th>{{ getGrandTotalFn() }}</th>
                        <th>{{ totalSoldQuantityFn() }}</th>
                        <th></th>
                    </tr>
                </table>
                </div>
                <!--dir-pagination-controls max-size="perPage" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls-->

            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Stock</h4>
                  </div>
                    <div class="modal-body">
                        <div class="row">
                        <?php
                            $attr = array('class' => 'form-horizontal');
                            echo form_open('', $attr);
                        ?>
                            <input type="hidden" name="code" value="{{productInfo.code}}">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Old Quantity <span class="req"> *</span></label>
                                <div class="col-md-7">
                                    <input type="text" name="quantity" class="form-control" ng-value="productInfo.quantity" readonly required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">New Quantity <span class="req"> *</span></label>
                                <div class="col-md-7">
                                    <input type="text" name="new_quantity" class="form-control" value="0" required>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Type<span class="req"> *</span></label>
                                <div class="col-md-7">
                                    <select name="type" class="form-control">
                                         <option value="">Select Type</option>
                                         <option value="plus">Plus</option>
                                         <option value="minus">Minus</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Unit <span class="req">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" name="unit" class="form-control" ng-value="productInfo.unit" readonly required>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="btn-group pull-right">
                                    <input type="submit" value="Update" name="qtyUpdate" class="btn btn-info">
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>

              </div>
            </div>

            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>

    </div>
</div>

<script>
    // linking between two date
    $('#datetimepickerFrom').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $('#datetimepickerTo').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $("#datetimepickerSMSFrom").on("dp.change", function (e) {
        $('#datetimepickerSMSTo').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepickerSMSTo").on("dp.change", function (e) {
        $('#datetimepickerSMSFrom').data("DateTimePicker").maxDate(e.date);
    });
</script>
