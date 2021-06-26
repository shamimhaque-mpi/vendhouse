<style>
    .table2 tr td{
        padding: 0 !important;
    }
    .table2 tr td input{
        border: 1px solid transparent;
    }
</style>

<div class="container-fluid" ng-controller="CreditSaleEditCtrl">
    <div class="row" ng-init="vno='<?php echo $_GET["vno"];?>'">
        <?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Edit</h1>
                </div>
            </div>          

            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class"=>"form-horizontal");
                echo form_open_multipart('creditSale/editcreditSale?vno=' . $this->input->get('vno'), $attr);
                ?>

                <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group date" id="datetimepicker">
                                    <input type="text" name="date" ng-model="info.date" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo date(Y-m-d); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
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
                                <input type="text" name="voucher_number" readonly  ng-model="info.voucher" placeholder="Vouture Number" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>             
               

                <hr>


               <table ng-cloak class="table table-bordered table2">
                    <tr>
                        <th style="width: 40px;">SL</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th style="width: 50px;">Action</th>
                    </tr>

                    <tr ng-repeat="item in cart">
                        <td style="padding: 6px 8px !important;">{{ $index + 1 }}</td>
                        <input type="hidden" name="id[]" ng-value="item.id">

                        <td>
                            <input type="text" name="product[]" class="form-control" ng-model="item.product" readonly> 
                            <input type="hidden" name="category[]" value="{{ item.category }}">
                            <input type="hidden" name="subcategory[]" value="{{ item.subcategory }}">
                            <input type="hidden" name="godown[]" value="{{ item.godown }}">
                        </td>

                        <td>
                            <input type="number" name="price[]" class="form-control" min="0" ng-model="item.price" step="any">
                        </td>

                        <td>
                            <input type="number" name="newQuantity[]" class="form-control" min="1" ng-model="item.newQuantity" step="any">
                            <input type="hidden" name="oldQuantity[]" ng-value="item.oldQuantity">
                        </td>

                        <td>
                            <input type="text" name="subtotal[]" class="form-control" ng-value="setSubtotalFn($index)" readonly>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Grand Total  <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="number" name="total" class="form-control" ng-value="getTotalFn()" step="any" readonly required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Down Payment  <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="number" name="paid" class="form-control" ng-model="amount.paid" step="any" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Due <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="number" name="due"  class="form-control" ng-value="getTotalDueFn()" class="form-control" step="any" required>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label">Installment Quantity <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="number" name="installment_quantity" ng-keyup="getInstallmentTKFn()"  ng-model="installment_quantity" class="form-control">
                            </div>
                        </div>

                        
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Amount Quantity <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="number" name="amount_quantity" ng-model="amount_quantity" class="form-control" step="any">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Installment Type <span class="req">*</span></label>
                            <div class="col-md-8">
                                <label class="radio-inline">
                                    <input type="radio" name="installment_type" ng-model="type"  ng-click="installmentTypeFn()" value="weekly" > Weekly
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="installment_type" ng-model="type" ng-click="installmentTypeFn()" value="monthly" > Monthly
                                </label>
                            </div>
                        </div>

                        <div ng-hide="dateActive" ng-init="dateActive=true;" class="form-group">
                            <label class="col-md-4 control-label">Date <span class="req">*</span></label>
                            <div class="input-group date col-md-8">
                              <select name="installment_date"  ng-model="installment_date" class="form-control">
                                <?php for($i=1;$i<=31;$i++){ ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                 <?php } ?>
                              </select>                              
                            </div>
                        </div>
                       
                        <div ng-hide="dayActive" ng-init="dayActive=true;" class="form-group">
                            <label class="col-md-4 control-label">Installment Date <span class="req">*</span></label>
                            <div class="col-md-8">
                                <select name="installment_day" ng-model="installment_day" class="form-control" >
                                    <option value="">-- Select Installment Date --</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                </select>
                            </div>
                        </div>                      
                    </div>
                </div>             

                <div class="btn-group pull-right">
                    <input type="submit" name="edit_creditSales" value="Update" class="btn btn-primary">
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

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
