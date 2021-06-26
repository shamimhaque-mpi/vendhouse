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

<div class="container-fluid" ng-controller="FullSaleReturnCtrl" ng-cloak>
    <div class="row" ng-model="vno" ng-init="vno='<?php echo $_GET['vno'];?>'">
        <?php echo $confirmation; ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title custom-notice-cover">
                    <h1 class="pull-left">
                        Full Sale Return
                    </h1>
                </div>
            </div>
            <div class="panel-body" style="position: relative;">
                  <div class="col-md-8">
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="voucher_number" class="form-control" value="<?php echo $_GET['vno']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker">
                                            <input type="text" ng-model="cart[0].date"  readonly  class="form-control" placeholder="YYYY-MM-DD"  required>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>  



            <!-- horizontal form -->
            <?php
             $attribute = array(
                  'class' => 'form-horizontal',
                 'name'  => ''
            );
            echo form_open('', $attribute);
            ?>
            <div class="col-md-8 md15">
                <table class="table table-bordered table2">
                    <tr>
                        <th style="text-align:center; width: 30px;"><?php echo caption('SL'); ?></th>
                        <th width="200px"><?php echo caption('Product_Name'); ?></th>
                        <th width="80px">Sale <?php echo caption('Price'); ?></th>
                        <th width="30px">Sale QTY</th>
                        <th width="30px">Return QTY</th>
                        <th width="50px"><?php echo caption('Amount'); ?></th>
                    </tr>
                               
                    <tr ng-repeat="item in cart">
                        <td>
                            {{ $index+1 }}
                         </td>
                         
                        <td>
                            <input type="text" value="{{ item.productname | textBeautify }}" class="form-control" readonly>
                            <input type="hidden" name="product[]" value="{{ item.productname}}">
                        </td>
                        <td>
                            <!-- some heddin fields -->
                            <input type="hidden" name="code[]" value="{{ item.code}}">
                            <input type="hidden" name="category[]" value="{{ item.category }}">
                            <input type="hidden" name="subcategory[]" value="{{ item.subcategory }}">
                            <input type="hidden" name="godown[]" value="{{ item.godown}}">
                            <input type="number" tabindex="5" name="price[]" ng-model="item.price" readonly class="form-control" min="{{item.purchase_price}}"  step="any" <?php if($privilege == "user"){echo "readonly";} ?> required>
                        </td>

                        <td>
                            <input type="number"  ng-model="item.old_quantity"  readonly class="form-control"   step="any">
                            
                        </td>
                        
                         <td>
                             <input type="number" tabindex="6" name="quantity[]" ng-model="item.quantity"   max="{{ item.maxQuantity }}"  min="0" class="form-control"   step="any">
                         </td>
                      
                        <td>
                            <input type="number" name="subtotal[]" ng-model="item.subtotal" ng-value="setSubtotalFn($index)" class="form-control" readonly step="any">
                        </td>
                         <td style="display: none;">
                            <input type="number" name="vat_subtotal[]" ng-model="item.vat_subtotal" ng-value="setVatTotalFn($index)" class="form-control" readonly step="any">
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-md-4 custom-design">
                <div class="custom-design-height">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('Name'); ?> </label>
                        <div class="col-md-8">
                            <input type="text" tabindex="7" name="name" ng-value="cart[0].name" readonly  class="form-control" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Mobile No </label>
                        <div class="col-md-8">
                            <input type="text" tabindex="8" name="mobile" ng-value="cart[0].mobile" readonly class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Sale Type <span class="req">&nbsp;</span></label>
                        <div class="col-md-8">
                            <input name="sale_type"  tabindex="9" class="form-control" ng-value="cart[0].sale_type" readonly required>
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
                            <input type="number" tabindex="10" name="discount" ng-value="cart[0].discount" readonly class="form-control" step="any" min="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('Grand_Total'); ?></label>
                        <div class="col-md-8">
                            <input type="number" name="grand_total" ng-value="getGrandTotalFn()" class="form-control" step="any" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Paid (Tk) <span class="req">&nbsp;</span></label>
                        <div class="col-md-8">
                            <input type="number" name="received_amount" tabindex="11"  ng-model="cart[0].paid" readonly class="form-control" step="any">
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
                            <input type="number" name="due" ng-value="cart[0].due" class="form-control" step="any" readonly>
                        </div>
                    </div>
                    
                    <div class="btn-group pull-right">
                        <input type="submittt" tabindex="12" name="save" value="Return" class="btn btn-success">
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
