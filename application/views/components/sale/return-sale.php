<style>
    .table2 tr td{
        padding: 0 !important;
    }
    .table2 tr td input{
        border: 1px solid transparent;
    }
</style>

<div class="container-fluid" ng-controller="ReturnSaleEntryCtrl">
    <div class="row">
        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Return_Sale'); ?></h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array('class' => 'form-horizontal');
                echo form_open('sale/return_sale?vno=' . $this->input->get('vno'), $attr);
                ?>

                <span ng-init="vno='<?php echo $this->input->get('vno'); ?>'"></span>

                <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group date" id="datetimepicker">
                                    <input type="text" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                <h5 class="text-right"><b><?php echo caption('Voucher_number'); ?> : <?php echo $this->input->get('vno'); ?></b></h5>
                                <input type="hidden" name="voucher_no" value="<?php echo $this->input->get('vno'); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table2">
                    <tr>
                        <th style="width: 40px;"><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Product_Name'); ?></th>
                        <th><?php echo "Product Code"; ?></th>
                        <th><?php echo caption('Price'); ?></th>
                        <th><?php echo caption('Quantity'); ?></th>
                        <th><?php echo 'Return'; ?></th>
                        <th><?php echo caption('Amount'); ?></th>
                        <th><?php echo caption('Godown'); ?></th>
                    </tr>

                    <tr ng-repeat="item in cart">
                        <td style="padding: 6px 8px !important;">
                            {{ item.sl }}
                            <input type="hidden" name="id[]" value="{{ item.id }}">
                        </td>

                        <td>
                            <input type="text" name="product[]" ng-model="item.product" class="form-control" readonly> 

                            <!-- some hidden fields -->
                            <input type="hidden" name="code[]" value="{{ item.code}}">
                            <input type="hidden" name="category[]" value="{{ item.category }}">
                            <input type="hidden" name="subcategory[]" value="{{ item.subcategory }}">
                        </td>
                        
                        <td>
                        	<input type="text" value="{{ item.code}}" class="form-control" readonly>
                        </td>

                        <td>
                            <input type="number" name="price[]" ng-model="item.price" class="form-control" min="0" step="any" readonly>
                        </td>

                        <td>
                            <input type="number" name="oldQuantity[]" ng-model="item.oldQuantity" class="form-control" min="1" step="any" readonly>
                            <!-- input type="number" name="newQuantity[]" ng-model="item.newQuantity" class="form-control" min="1" step="any" -->
                        </td>
                        
                        <td>
                            <input type="number" name="returnQuantity[]" ng-model="item.returnQuantity" class="form-control" min="0" max="{{item.oldQuantity}}" step="any" ng-value="0">
                        </td>

                        <td>
                            <input type="text" name="subtotal[]" ng-value="getSubtotalFn($index)" class="form-control" readonly>
                        </td>

                        <td>
                            <input type="text" name="godown[]" value="{{ item.godown }}" class="form-control" readonly>
                        </td>
                    </tr>
                </table>

                <div class="form-group">
                    <label class="col-md-offset-6 col-md-2 control-label"><?php echo caption('Total'); ?> </label>
                    <div class="col-md-4">
                        <input type="number" ng-value="getTotalFn()" name="total" class="form-control" step="any" readonly>                       
                    </div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-offset-6 col-md-2 control-label"><?php echo caption('Discount'); ?> </label>
                    <div class="col-md-4">
                        <input type="number" ng-value="amount.totalDiscount"  class="form-control" step="any" readonly>                       
                    </div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-offset-6 col-md-2 control-label"><?php echo caption('Grand_Total'); ?> </label>
                    <div class="col-md-4">
                        <input type="number" name="grand_total" ng-value="grandTotalFn()" class="form-control" step="any" readonly>                       
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-offset-6 col-md-2 control-label"><?php echo caption('Paid'); ?> </label>
                    <div class="col-md-4">
                        <input type="number" name="paid" ng-model="amount.paid" class="form-control" step="any" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-offset-6 col-md-2 control-label"><?php echo 'Return'; ?> </label>
                    <div class="col-md-4">
                        <input type="number" name="returnAmount" ng-model="amount.return_amount" class="form-control" max="{{ amount.paid }}" step="any">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-offset-6 col-md-2 control-label"><?php echo caption('Due'); ?> </label>
                    <div class="col-md-4">
                        <input type="number" name="due" ng-value="getTotalDueFn()" class="form-control" step="any" readonly>
                    </div>
                </div>
                
                <div class="btn-group pull-right">
                    <input type="submit" name="save" value="<?php echo caption('Return'); ?>" class="btn btn-primary">
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>