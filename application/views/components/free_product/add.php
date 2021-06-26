<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
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
</style>
<div class="container-fluid" ng-controller="freeProductCtrl" ng-cloak>
    <div class="row">
        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add Free Product</h1>
                </div>
            </div>
            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open('', $attr);
                ?>
                <div class="row new-row-1">

                    <div class="col-md-4">
                        <select ng-model="product"  class="selectpicker form-control" data-show-subtext="true" data-live-search="true" required>
            				<option value="" selected disabled>-- Select Product --</option>
            				<?php if($products != null){ foreach($products as $key => $row){ ?>
            				<option value="<?php echo $row->bar_code; ?>">
            					<?php echo filter($row->product_name); ?>
            				</option>
            				<?php }} ?>
            			</select>
                    </div>

                    <div class="col-md-4">
                        <input type="number" class="form-control" ng-model="quantity"  placeholder="Quantity" min="1"  required>
                    </div>

                    <div class="col-md-4">
                        <select ng-model="relation" class="form-control" placeholder="Relation" required>
                            <option value="">Select Relation</option>
                            <?php foreach(config_item("relation") as $key => $value) { ?>
                                <option value="<?php echo $key; ?>"><?php echo filter($value); ?></option>
                            <?php } ?>
                        </select>  
                        
                    </div>

                    <div class="col-md-4">
                        <select ng-model="free_product"  class="selectpicker form-control" data-show-subtext="true" data-live-search="true" required>
            				<option value="" selected disabled>-- Select Free Product --</option>
            				<?php if($products != null){ foreach($products as $key => $row){ ?>
            				<option value="<?php echo $row->bar_code; ?>">
            					<?php echo filter($row->product_name); ?>
            				</option>
            				<?php }} ?>
            			</select>
                    </div>



                    <div class="col-md-4">
                        <input type="number" ng-model="free_quantity" class="form-control" placeholder="Free Quantity" min="1"  required>
                    </div>

                    <div class="col-md-2">
                        <div class="input-group date" id="datetimepickerFrom">
                            <input type="text" name="from_date" class="form-control" required value="<?php echo date('Y-m-d');?>" placeholder="From Date" required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="input-group date" id="datetimepickerTo">
                            <input type="text" name="to_date" required class="form-control" value="<?php echo date('Y-m-d');?>" placeholder="To Date" required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>


                    <div class="col-md-4" style="margin-top: 10px;">
                        <a class="btn btn-success pull-right" ng-click="addNewProductFn();">
                            <i class="fa fa-plus fa-lg" aria-hidden="true"></i>
                        </a>
                    </div>


                    <div class="panel-body" ng-show="active" ng-init="active=false;">
                        <table class="table table-bordered table2">
                            <tr>
                                <th style="text-align:center; width: 20px;"><?php echo caption('SL'); ?></th>
                                <th style="width: 60px;"><?php echo caption('Product'); ?></th>
                                <th width="40px"><?php echo caption('Quantity'); ?></th>
                                <th width="40px">Relation</th>
                                <th width="80px">Free Product</th>
                                <th width="100px">Free Quantity</th>
                                <th style="width: 50px;"><?php echo caption('Action'); ?></th>
                            </tr>
                            <tr ng-repeat="item in cart">
                                <td style="text-align:center;">{{ $index +1 }}</td>
                                <td>
                                    {{ item.product_name | textBeautify }}
                                    <input type="hidden" name="product[]" ng-value="item.product_name" class="form-control" required>
                                    <input type="hidden" name="product_code[]" ng-value="item.product_code" class="form-control" required>
                                </td>
                                <td>
                                    <input type="number" name="quantity[]"  ng-model="item.quantity" class="form-control" required>
                                </td>
                                <td style="text-align:center;">
                                    {{ item.relation | relation}}
                                    <input type="hidden" name="relation[]" ng-value="item.relation" class="form-control" required>
                                </td>
                                <td>
                                    {{ item.free_product_name | textBeautify }}
                                  <input type="hidden" name="free_product[]" ng-value="item.free_product_name" class="form-control" required>
                                  <input type="hidden" name="free_product_code[]" ng-value="item.free_product_code" class="form-control" required>
                                </td>

                                <td>
                                    <input type="number" name="free_quantity[]" ng-model="item.free_quantity" class="form-control" required>
                                </td>
                                <td class="text-center">
                                    <a title="Delete" class="btn btn-danger" ng-click="deleteRow($index);">
                                        <i class="fa fa-times fa-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                      <div class="btn-group pull-right">
                        <input type="submit" name="save" value="Save" class="btn btn-primary">
                    </div>
                 </div>
                </div>
             <?php echo form_close(); ?>
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
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
