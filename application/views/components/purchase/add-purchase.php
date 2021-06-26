<style>
    .table2 tr td{
        padding: 0 !important;
    }
    .table2 tr td input{
        border: 1px solid transparent;
    }
    .new-row-1 .col-md-4{
        margin-bottom: 8px;
    }
    .custom-notice-cover {
        overflow: auto;
        width: 100%;
    }
    .custom-notice {
        color: red !important;
        float: right;
        margin-top: 6px;
        font-size: 16px !important;
    }
    .mb {margin-bottom: 5px;}
</style>

<div class="container-fluid" ng-controller="PurchaseEntry" ng-cloak>
    <div class="row">
        <?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left custom-notice-cover">
                    <h1><?php echo caption('Add_Purchase'); ?> <span class="custom-notice">{{ warning }}</span></h1>
                </div>
            </div>

            <div class="panel-body">

                <div class="row new-row-1">

                    <div class="col-sm-4">
                        <input type="text" ng-init="voucher_number='<?php echo unique_voucher_id("purchase", 6); ?>';" ng-model="voucher_number" readonly class="form-control mb" required>
                    </div>
                    
                    
                    <div class="col-sm-4">
                        <div class="input-group date mb" id="datetimepicker">
                            <input type="text" class="form-control" ng-model="date" ng-init="date='<?php echo date('Y-m-d');?>';" placeholder="<?php echo caption('Date'); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('#datetimepicker').datetimepicker({
                                    format: 'YYYY-MM-DD'
                                });
                            });
                        </script>
                    </div>
                    
                    <div class="col-sm-4">
                        <select ng-model="supplier"  tabindex="4" class="form-control mb" required>
                            <option selected value="" disabled>-- <?php echo caption('Supplier_Name'); ?> --</option>
                            <?php if($allVendors != null){ foreach($allVendors as $key => $row){ ?>
                            <option value="<?php echo $row->code; ?>">
                                <?php echo filter($row->name); ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>
                    
                    <div class="col-sm-4">
                        <input type="text" name="product" ng-model="product" class="form-control mb" readonly placeholder="Product Name">
                    </div>
                    
                    <div class="col-sm-4">
                        <input type="text" name="category" ng-model="category" class="form-control mb" placeholder="Category" readonly>
                    </div>

                    <div class="col-sm-2">
                        <input type="number" class="form-control mb" ng-model="price" tabindex="3" placeholder="Purchase Price">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control mb" ng-model="sale_price" tabindex="3" placeholder="Sale Price">
                    </div>
                    
                    
                    <div class="col-sm-4">
                        <input
                            type="text"
                            name="product_code"
                            ng-model="pcode"
                            ng-keyup="setProductFn()"
                            ng-change="setProductFn()"
                            ng-paste="setProductFn()"
                            placeholder="Product Code"
                            list="product-list"
                            class="form-control mb"
                            id="firstInput"
                            required autofocus tabindex="1">

                        <datalist id="product-list">
                            <?php foreach($products as $key => $product){ ?>
                            <option value="<?php echo $product->bar_code; ?>">
                                <?php echo filter($product->product_name); ?>
                            </option>
                            <?php } ?>
                        </datalist>
                    </div>
                    
                    

                    <div class="col-sm-4">
                        <input type="text" name="subcategory" ng-model="subcategory" class="form-control mb" readonly placeholder="Subcategory">
                    </div>

                    
                    <div class="col-sm-3">
                        <input type="number" tabindex="2" class="form-control mb" ng-model="quantity" ng-init="quantity=1" placeholder="Quantity">
                    </div>
                    

                    <div class="col-sm-1">
                        <a class="btn btn-success pull-right" ng-click="addNewProductFn()">
                            <i class="fa fa-plus fa-lg" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <hr>

            <!-- horizontal form -->
              <?php
                $attr = array("class" => "form-horizontal");
                echo form_open('', $attr);
                ?>

                <div ng-hide="active">
                    <table class="table table-bordered table2" ng-cloak>
                        <tr>
                            <th style="width: 5%;"><?php echo caption('SL'); ?></th>
                            <th style="width: 25%;"><?php echo caption('Product_Name'); ?></th>
                            <th style="width: 10%;"><?php echo caption('Price'); ?></th>
                            <th style="width: 10%;"><?php echo caption('Quantity'); ?></th>

                            <th style="width: 10%;"><?php echo caption('Discount'); ?></th>
                            <th style="width: 10%;"><?php echo caption('Total'); ?></th>
                            <th style="width: 25%;"><?php echo caption('Godwon_Name'); ?></th>
                            <th style="width: 5%"><?php echo caption('Action'); ?></th>
                        </tr>

                        <tr ng-repeat="item in cart">
                            <td style="padding: 6px 8px !important;">{{ $index + 1 }}</td>

                            <td>
                                <input type="text" name="product[]" class="form-control" ng-model="item.product" readonly>
                                <input type="hidden" name="product_code[]" value="{{ item.productCode }}">
                                <input type="hidden" name="category[]" value="{{ item.category }}">
                                <input type="hidden" name="subcategory[]" value="{{ item.subcategory }}">
                                <input type="hidden" name="date" value="{{ date }}">
                                <input type="hidden" name="voucher_number" value="{{ voucher_number }}">
                                <input type="hidden" name="supplier" value="{{ item.supplier }}">
                            </td>

                            <td style="width: 125px;">
                                <input type="number" name="price[]" class="form-control" min="0" ng-model="item.price" step="any">
                                <input type="hidden" name="sale_price[]" class="form-control" min="0" ng-value="item.sale_price" step="any">
                            </td>

                            <td style="width: 125px;">
                                <input type="number" name="quantity[]" class="form-control" min="1" ng-model="item.quantity">
                            </td>

                            <td style="width: 125px;">
                                <input type="number" name="discount[]" class="form-control" min="0" ng-model="item.discount" step="any">
                            </td>

                            <td style="width: 125px;">
                                <input type="text" name="subtotal[]" class="form-control" ng-model="item.subtotal" ng-value="setSubtotalFn($index)" readonly>
                            </td>

                            <td style="padding: 6px 12px !important;">
                                <input type="hidden" name="godowns[]" ng-value="item.godown">
                                {{ item.godown | textBeautify }}
                            </td>

                            <td class="text-center">
                                <a title="Delete" class="btn btn-danger" ng-click="deleteItemFn($index)">
                                    <i class="fa fa-times fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
                    <hr>

                    <div class="row">
                        <div class="col-md-offset-6 col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><?php echo caption('Total'); ?> </label>
                                <div class="col-md-8">
                                    <input type="number" name="total" class="form-control" ng-value="getTotalFn()" step="any">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><?php echo caption('Total_Discount'); ?> </label>
                                <div class="col-md-8">
                                    <input type="number" readonly name="total_discount" ng-value="getTotalDiscountFn()" class="form-control" step="any">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><?php echo caption('Grand_Total'); ?> </label>
                                <div class="col-md-8">
                                    <input type="number" name="grand_total" ng-value="getGrandTotalFn()" class="form-control" step="any">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><?php echo caption('Payment'); ?> </label>
                                <div class="col-md-8">
                                    <input type="number" name="paid" ng-model="amount.paid" class="form-control" step="any">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><?php echo caption('Due'); ?> </label>
                                <div class="col-md-8">
                                    <input type="number" name="due" ng-value="getTotalDueFn()" class="form-control" step="any">
                                </div>
                            </div>

                            <div class="btn-group pull-right">
                                <input type="submit" name="save" value="<?php echo caption('Save'); ?>" class="btn btn-primary">
                            </div>

                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
