<style>
    .table2 tr td{
        padding: 0 !important;
    }
    .table2 tr td input{
        border: 1px solid transparent;
    }
</style>

<div class="container-fluid" ng-controller="EditSaleEntryCtrl">
    <div class="row">
        <?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Edit'); ?></h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array('class' => 'form-horizontal');
                echo form_open('sale/editSale?vno=' . $this->input->get('vno'), $attr);
                ?>

                <span ng-init="vno='<?php echo $this->input->get('vno'); ?>'"></span>

                <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group date" id="datetimepicker">
                                    <input type="text" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?>  required>
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
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table2">
                    <tr>
                        <th style="width: 40px;"><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Product_Name'); ?></th>
                        <th><?php echo caption('Price'); ?></th>
                        <th><?php echo caption('Quantity'); ?></th>
                        <th><?php echo caption('Amount'); ?></th>
                        <th><?php echo caption('Godown'); ?></th>
                    </tr>

                    <tr ng-repeat="item in cart">
                        <td style="padding: 6px 8px !important;">
                            {{ item.sl }}
                            <input type="hidden" name="id[]" value="{{ item.id }}">
                        </td>

                        <td>
                            <!-- input type="text" name="product[]" ng-model="item.product" class="form-control" readonly --> 
                            
                            <input type="text" value="{{ item.product }} - {{ item.code }}" class="form-control" readonly>
                            <input type="hidden" name="product[]" value="{{ item.product }}">
                            <input type="hidden" name="code[]" value="{{ item.code}}">

                            <!-- some hidden fields -->
                            <input type="hidden" name="category[]" value="{{ item.category }}">
                            <input type="hidden" name="subcategory[]" value="{{ item.subcategory }}">
                        </td>

                        <td>
                            <input type="number" name="price[]" ng-model="item.price" class="form-control" min="0" step="any" readonly>
                        </td>

                        <td>
                            <input type="hidden" name="oldQuantity[]" value="{{ item.oldQuantity }}">
                            <input type="number" name="newQuantity[]" ng-model="item.newQuantity" class="form-control" min="1" step="any">
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
                        <input type="number" name="grand_total"  ng-value="grandTotalFn()"  class="form-control" step="any" readonly>                       
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-offset-6 col-md-2 control-label"><?php echo caption('Payment'); ?> </label>
                    <div class="col-md-4">
                        <input type="number" name="paid"  ng-model="amount.paid" class="form-control" step="any" require>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-offset-6 col-md-2 control-label"><?php echo caption('Due'); ?> </label>
                    <div class="col-md-4">
                        <input type="number" name="due" ng-value="getTotalDueFn()" class="form-control" step="any" readonly>
                    </div>
                </div>
                
                <div class="btn-group pull-right">
                    <input type="submit" name="save" value="<?php echo caption('Update'); ?>" class="btn btn-primary">
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