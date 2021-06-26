<style>
    .table2 tr td{
        padding: 0 !important;
    }
    .table2 tr td input{
        border: 1px solid transparent;
    }
</style>

<div class="container-fluid" ng-controller="PurchaseEntry">
    <div class="row">
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
                echo form_open_multipart('', $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label">Date</label>
                    <div class="input-group date col-md-4" id="datetimepicker">
                        <input type="text" name="date" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo date(Y-m-d); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#datetimepicker').datetimepicker({
                            format: 'YYYY-MM-DD'
                        });
                    });
                </script>

                <div class="form-group">
                    <label class="col-md-2 control-label">
                        Vouture Number
                    </label>

                    <div class="col-md-4">
                        <input type="text" name="voucher_number" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">
                        Supplier Name 
                    </label>

                    <div class="col-md-4">
                        <input type="text" name="" readonly class="form-control">
                    </div>
                </div>

                <table class="table table-bordered table2">
                    <tr>
                        <th style="width: 40px;">SL</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Godown Name</th>
                    </tr>

                    <tr>
                        <td style="padding: 6px 8px !important;">1</td>
                        <td><input type="text" class="form-control"> </td>
                        <td style="width: 125px;"><input type="number" class="form-control" min="0" step="any"></td>
                        <td style="width: 125px;"><input type="number" class="form-control" min="0" step="any"></td>
                        <td style="width: 125px;"><input type="number" class="form-control" min="0" step="any"></td>
                        <td style="width: 125px;"><input type="number" class="form-control" min="0" step="any"></td>
                        <td><input type="text" class="form-control"></td>
                    </tr>
                </table>
                <hr>

                <div class="row">
                    <div class="col-md-offset-6 col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Total </label>
                            <div class="col-md-8">
                                <input 
                                    type="number" 
                                    name="sub_total" 
                                    class="form-control" 
                                    step="any">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Total Discount </label>
                            <div class="col-md-8">
                                <input type="number" name="discount" class="form-control" step="any">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Grand Total </label>
                            <div class="col-md-8">
                                <input type="number" name="gran_total" class="form-control" step="any">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Payment </label>
                            <div class="col-md-8">
                                <input type="number" name="pade" class="form-control" step="any">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Due </label>
                            <div class="col-md-8">
                                <input type="number" name="deu" class="form-control" step="any">
                            </div>
                        </div>

                        
                        <div class="btn-group pull-right">
                            <input type="submit" name="add_emp" value="Save" class="btn btn-primary">
                        </div>
                        
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
 