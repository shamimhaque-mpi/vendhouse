<style>
.table2 tr td{
    padding: 0 !important;
}
.table2 tr td input{
    border: 1px solid transparent;
}
.table-bordered tr td:nth-child(1){
    text-align: center;
    line-height: 34px;
}
.panel-body {
    position: relative;
    min-height: 600px;
    height: 100%;
}
.custom-design {
    position: absolute;
    right: 0;
    display: block;
    height: 100%;
}
.md15 {
    margin: 15px 0 0;
}

/* custom code */
@media screen and (max-width: 980px){
.custom-design{position: static;}
}
.custom-notice-cover h1 {
        overflow: auto;
        width: 100%;
    }
    .custom-notice {
        color: red !important;
        float: right;
        margin-top: 6px;
        font-size: 16px !important;
    }
</style>

<div class="container-fluid" ng-controller="SaleEntryCtrl" ng-cloak>
    <div class="row">
        <?php echo $confirmation; ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title custom-notice-cover">
                    <h1 class="pull-left">
                        <?php echo caption('Add_Sales');?>
                        <span style="font-weight:bold;font-size:24px; color:red; float: right; margin-top: 6px;" ng-if="getTotalQty() > 0">
                           Total Quantity : {{ getTotalQty() }}
                        </span>
                    </h1>
                </div>
            </div>
            <div class="panel-body" style="position: relative;">
                  <div class="col-md-8">
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" ng-model="product_category" ng-change="getAllProductFN();">
                                            <option value="" selected>&nbsp;</option>
                                            <?php if($allCategory != NULL) { foreach ($allCategory as $key => $value) { ?>
                                               <option value="<?php echo $value->category; ?>"><?php echo filter($value->category); ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker">
                                            <input type="text" ng-model="date"  <?php if($privilege == "user"){echo "disabled";} ?> ng-init="date='<?php echo date('Y-m-d'); ?>'" class="form-control" placeholder="YYYY-MM-DD"  required>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" ng-model="code" id="firstInput" tabindex="1" list="product-code" class="form-control" placeholder="Product Code" ng-change="getProductNameFn();" autofocus required>
                                        <datalist id="product-code" tabindex="1">
                                          <option  ng-repeat="row in allProducts" ng-value="row.code">{{ row.product_name | textBeautify }}</option>
                                        </datalist>
                                    </div>
                                </div>
                            <form ng-submit="getProductFn(sale_price,sale_quantity)">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="number" tabindex="2" ng-model="sale_price" <?php if($privilege == "user"){echo "readonly";} ?> value="{{ sale_price }}" placeholder="Sale Price" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="number"  tabindex="3" ng-model="sale_quantity" ng-init ="sale_quantity=1" placeholder="Sale Quantity" class="form-control"  required>
                                    </div>
                                </div>
                                
                                
                                <div class="btn-group col-md-1">
                                    <button tabindex="4" class="btn btn-success">Add</button>
                                </div>
                                

                                <div ng-if="stock_quantity > 0" class="col-md-12">
                                    <p style="margin-top : 10px;">
                                      <strong>Name</strong> : {{ product_name }}&nbsp;&nbsp;
                                      <?php if($privilege != "user") { ?>
                                         <strong>Purchase Price</strong> : {{ product_purchase_price }}&nbsp;&nbsp;
                                      <?php } ?>
                                      <strong>Sale Price</strong> : {{ product_sale_price }}&nbsp;&nbsp;
                                      <strong>Quantity</strong> : {{ stock_quantity }}
                                      <br><b style="color:red;">{{ warning }}</b>
                                    </p>
                                </div>
                        </div>
                    </div>
                    <input type="submit" style="display:none;">
                </form>



                <!-- horizontal form -->
                <?php
                $attribute = array(
                'class' => 'form-horizontal',
                'name'  => ''
                );
                echo form_open('', $attribute);
                ?>
                        <div class="col-md-8 md15">
                            <input type="hidden" name="date"  value="{{ sale_date }}">
                            <table class="table table-bordered table2">
                                <tr>
                                    <th style="text-align:center; width: 50px;"><?php echo caption('SL'); ?></th>
                                    <th width="200px"><?php echo caption('Product_Name'); ?></th>
                                    <th width="80px">Sale <?php echo caption('Price'); ?></th>
                                    <th width="30px">QTY</th>
                                    <th width="50px"><?php echo caption('Amount'); ?></th>
                                    <!-- <th width="70px">VAT</th> -->
                                    <th style="width: 50px;"><?php echo caption('Action'); ?></th>
                                </tr>
                               
                                <tr ng-repeat="item in cart">
                                    <td>
                                        <input type="checkbox" name="virtual[]"  value="{{ item.code }}" style="margin: 2px !important;">
                                        {{ $index+1 }}
                                     </td>
                                     
                                    <td>
                                        <input type="text" value="{{ item.productname }} - {{ item.code }}" class="form-control" readonly>
                                        <input type="hidden" name="product[]" value="{{ item.productname}}">
                                    </td>
                                    <td>
                                        <!-- some heddin fields -->
                                        <input type="hidden" name="code[]" value="{{ item.code}}">
                                        <input type="hidden" name="category[]" value="{{ item.category }}">
                                        <input type="hidden" name="subcategory[]" value="{{ item.subcategory }}">
                                        <input type="hidden" name="godown[]" value="{{ item.godown}}">
                                        <input type="number" tabindex="5" name="price[]" ng-model="item.price" class="form-control" min="{{item.purchase_price}}"  step="any" <?php if($privilege == "user"){echo "readonly";} ?> required>
                                        <input type="hidden" name="purchase_price[]" value="{{ item.purchase_price }}" >
                                    </td>

                                    <td>

                                        <input type="number" tabindex="6" name="quantity[]" ng-model="item.quantity"  ng-change="getFreeProduct(item.code, sale_date, item.quantity,item.category,item.godown,item.subcategory);" ng-readonly="(item.free == 'yes') ? true : false"  max="{{ item.maxQuantity }}" min="0" class="form-control"   step="any">
                                        <input type="hidden"  name="free[]" ng-value ="(item.free == 'yes') ? 'free' : ''">
                                    </td>
                                  
                                    <td>
                                        <input type="number" name="subtotal[]" ng-model="item.subtotal" ng-value="setSubtotalFn($index)" class="form-control" readonly step="any">
                                    </td>
                                     <td style="display: none;">
                                        <input type="number" name="vat_subtotal[]" ng-model="item.vat_subtotal" ng-value="setVatTotalFn($index)" class="form-control" readonly step="any">
                                    </td>
                                    <td class="text-center">
                                        <a title="Delete" ng-click="deleteItemFn($index)" class="btn btn-danger">
                                            <i class="fa fa-times fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-4 custom-design">
                            <div class="custom-design-height">
                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo caption('Name'); ?> </label>
                                    <div class="col-md-8">
                                        <input type="text" tabindex="7" name="name" class="form-control" required >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Mobile No </label>
                                    <div class="col-md-8">
                                        <input type="text" tabindex="8" name="mobile" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Sale Type <span class="req">*</span></label>
                                    <div class="col-md-8">
                                        <select  name="sale_type"  tabindex="9" class="form-control" required>
                                            <option value="">Select Sale Type</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Credit">Credit</option>
                                            <option value="Card">Card</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Total QTY</label>
                                    <div class="col-md-8">
                                        <input type="text"   readonly  ng-value="getTotalQty()" class="form-control" style="color:green;" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo caption('Total'); ?> </label>
                                    <div class="col-md-8">
                                        <input type="number" name="total" ng-value="getTotalFn()" class="form-control" step="any" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Total VAT</label>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="number" name="vat_amount" ng-value = "totalVatCalculationFn()" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Discount</label>
                                    <div class="col-md-8">
                                        <input type="number" tabindex="10" name="discount" ng-model="amount.totalDiscount" class="form-control" step="any" min="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo caption('Grand_Total'); ?></label>
                                    <div class="col-md-8">
                                        <input type="number" name="grand_total" ng-value="getGrandTotalFn()" class="form-control" step="any" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Paid (Tk) <span class="req">*</span></label>
                                    <div class="col-md-8">
                                        <input type="number" name="received_amount" tabindex="11"  ng-model="amount.paid" class="form-control" step="any">
                                        <input type="hidden"  name="paid" ng-value="getRealPaid();" class="form-control" step="any">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Return (Tk) <span class="req"></span></label>
                                    <div class="col-md-8">
                                        <input type="number"  name="return_amount" ng-value="getReturn();" class="form-control" step="any" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Due (Tk)</label>
                                    <div class="col-md-8">
                                        <input type="number" name="due" ng-value="getTotalDueFn()" class="form-control" step="any" readonly>
                                    </div>
                                </div>
                                <div class="btn-group pull-right">
                                    <input type="submit" tabindex="12" name="save" value="<?php echo caption('Sales'); ?>" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
    <!-- javascript include -->
    <script type="text/javascript">
    $(document).ready(function(){
        $('#datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD'
        });
    });
    </script>
