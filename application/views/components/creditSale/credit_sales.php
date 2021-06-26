<style>
    .table2 tr td{
        padding: 0 !important;
    }
    .table2 tr td input{
        border: 1px solid transparent;
    }
</style>

<div class="container-fluid" ng-controller="CreditSaleEntryCtrl">
    <div class="row">
        <?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add Credit Sales</h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array('class' => 'form-horizontal');
                echo form_open('', $attr);
                ?>

                <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group date" id="datetimepicker">
                                    <input type="text" name="date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="YYYY-MM-DD" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
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
                                <input type="text" name="voucher_number" placeholder="Vouture Number" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                           <div class="col-md-12">
                                <select class="form-control" ng-model="category" 
                                    ng-change="setAllSubcategory()" required>
                                    <option value="" selected disabled>
                                        -- Select Category --
                                    </option>
                                    <?php 
                                    if($allCategory != null){ 
                                        foreach($allCategory as $key => $row){ 
                                    ?>
                                    <option value="<?php echo $row->category; ?>">
                                        <?php echo str_replace('_', ' ', $row->category); ?>
                                    </option>
                                    <?php }} ?>
                                </select>
                           </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                <select class="form-control" ng-model="subcategory" 
                                    ng-change="setAllProducts()" required>
                                    <option value="" selected disabled>
                                        -- Select Subcategory --
                                    </option>
                                    <option ng-repeat="row in allSubcategory" value="{{ row.subcategory }}">
                                        {{ row.subcategory | removeUnderScore }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                <select class="form-control" ng-model="product" ng-change="setAllGodownsFn()" required>
                                    <option value="" selected disabled>-- Product --</option>
                                    <option ng-repeat="row in allProducts" value="{{ row.product_name }}">
                                        {{ row.product_name | removeUnderScore }}
                                    </option>
                                </select>
                            </div>
                         </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                <select class="form-control" ng-model="godown" required>
                                    <option value="" selected disabled>-- Godown Name --</option>
                                    <option ng-repeat="row in allGodown" value="{{ row.godown }}">
                                        {{ row.godown | removeUnderScore }}
                                    </option>
                                </select>
                            </div>
                         </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <a class="btn btn-success" ng-click="addNewProductFn()">
                                <i class="fa fa-plus fa-lg" aria-hidden="true"></i>
                            </a>
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
                            <input type="number" name="quantity[]" class="form-control" min="1" max="{{ item.maxQuantity }}" ng-model="item.quantity" step="any">
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
                            <label class="col-md-4 control-label">Grand Total <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="number" name="total" class="form-control" ng-value="getTotalFn()" step="any" readonly required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Down Payment <span class="req">*</span></label>
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
                                    <input type="radio" name="installment_type" ng-model="type" ng-click="installmentTypeFn()" value="weekly" > Weekly
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="installment_type" ng-model="type" ng-click="installmentTypeFn()" value="monthly" > Monthly
                                </label>
                            </div>
                        </div>

                        <div ng-hide="dateActive" ng-init="dateActive=true;" class="form-group">
                            <label class="col-md-4 control-label">Date <span class="req">*</span></label>
                            <div class="input-group date col-md-8">
                              <select name="installment_date" class="form-control">
                                 <option value="">-- Select Date --</option>>
                                 <?php for($i=1;$i<=31;$i++){ ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                 <?php } ?>
                              </select>                               
                            </div>
                        </div>
                       
                        <div ng-hide="dayActive" ng-init="dayActive=true;" class="form-group">
                            <label class="col-md-4 control-label">Installment Date <span class="req">*</span></label>
                            <div class="col-md-8">
                                <select name="installment_day" class="form-control" >
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

                        <div class="form-group">
                            <label class="col-md-4 control-label">Member ID <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="member_No" ng-model="memberID" ng-keyup="findMemberFn()" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Name </label>
                            <div class="col-md-8">
                                 <input type="text" name="name" class="form-control" ng-model="memberInfo.member" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Address </label>
                            <div class="col-md-8">
                               <textarea name="address" rows="3" class="form-control" ng-model="memberInfo.address" readonly></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Mobile Number </label>
                            <div class="col-md-8">
                                 <input type="text" name="mobile_number" class="form-control" ng-model="memberInfo.mobile" readonly>
                            </div>
                        </div>
                    </div>

                    <?php $pic = site_url('public/members/default.jpg'); ?>
                    <div class="col-md-6" ng-init="memberInfo.photo='<?php echo $pic; ?>'">
                        <figure class="text-right" style="margin-bottom: 15px;">
                            <img ng-src="{{ memberInfo.photo }}" alt="" width="150px" height="150px">
                        </figure>
                    </div>
                </div>

                <div class="btn-group pull-right">
                    <input type="submit" name="add_creditSales" value="Save" class="btn btn-primary">
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
