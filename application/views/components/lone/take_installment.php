<style>
    .table2 tr td{
        padding: 0 !important;
    }
    .table2 tr td input{
        border: 1px solid transparent;
    }
</style>

<div class="container-fluid" ng-controller="InstallmentCtrl">
    <div class="row">
        <?php echo $confirmation; ?>

        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Take Installment</h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open('lone/takeInstallment?lid=' . $this->input->get('lid'), $attr);
                ?>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="control-label col-md-5">Member ID :</label>
                            <div class="col-md-7">
                                <label class="control-label"><?php echo $memberInfo[0]->member_id; ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5">Name :</label>
                            <div class="col-md-7">
                                <label class="control-label"><?php echo $memberInfo[0]->member_full_name; ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5">Address :</label>
                            <div class="col-md-7">
                                <label class="control-label" style="text-align: left;">
                                    Village: <?php echo $memberInfo[0]->member_village; ?>, Police Station: <?php echo $memberInfo[0]->member_police_station; ?>, District: <?php echo $memberInfo[0]->member_district; ?>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5">Mobile Number :</label>
                            <div class="col-md-7">
                                <label class="control-label"><?php echo $memberInfo[0]->member_mobile_number; ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-md-6">Installment Type:</label>   
                            <div class="col-md-6">
                                <label class="control-label"><?php echo $loanRecord[0]->installment_type; ?> </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-6">Total Installment Quantity :</label>
                            <div class="col-md-6">
                                <label class="control-label"><?php echo $loanRecord[0]->installment_no; ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-6">Amount Per Installment :</label>
                            <div class="col-md-6">
                                <label class="control-label"><?php echo $loanRecord[0]->amount_per_installment; ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <figure class="text-right" style="margin-bottom: 15px;">
                            <img src="<?php echo site_url($memberInfo[0]->member_photo); ?>" alt="" width="150px" height="150px">
                        </figure>
                    </div>
                </div>

                <hr>


                <table class="table table-bordered table2">
                    <tr>
                        <th colspan="4">
                            Vouture Number: <?php echo $loanRecord[0]->voucher_number; ?> 
                            <input type="hidden" name="voucherNumber" value="<?php echo $loanRecord[0]->voucher_number; ?>">
                            <span class="pull-right">Date: <?php echo $loanRecord[0]->date; ?></span>
                        </th>
                        
                    </tr>
                    <tr>
                        <th style="width: 40px;">SL</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <!-- <th>ডাউন পেমেন্ট</th> -->
                    </tr>

                    <?php foreach($saleRecord as $key => $row){ ?>
                    <tr>
                        <td style="padding: 6px 8px !important;"><?php echo ($key + 1); ?></td>
                        <td><input type="text" class="form-control" value="<?php echo $row->product; ?>" readonly></td>
                        <td><input type="text" class="form-control" value="<?php echo $row->quantity; ?>" readonly></td>
                        <td><input type="text" class="form-control" value="<?php echo $row->price; ?>" readonly></td>
                    </tr>
                    <?php } ?>
                </table>

                <hr style="margin-bottom: 5px;">
                
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="control-label">Grand Total</label>
                        <input type="text" name="total" class="form-control" value="<?php echo $loanRecord[0]->amount; ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="control-label">Down Payment </label>
                        <input type="text" name="pade" class="form-control" value="<?php echo ($loanRecord[0]->amount - $loanRecord[0]->due); ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="control-label">Due</label>
                        <input type="text" name="due" class="form-control" value="<?php echo $loanRecord[0]->due; ?>" readonly>
                    </div>
                   
                </div>

                <hr style="margin-bottom: 5px;">

                <div class="form-group">
                    <div class="col-md-4">
                        <label class="control-label">Date <span class="req">*</span></label>
                        <div class="input-group date" id="datetimepicker">
                            <input type="text" name="date" value="<?php echo date("Y-m-d");?>" class="form-control" placeholder="YYYY-MM-DD" required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="control-label">Installment Quantity <span class="req">*</span></label>
                        <input type="number" name="installment" ng-model="installment" class="form-control" min="1" max="<?php echo $loanRecord[0]->installment_no; ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="control-label">
                            Amount <span class="req">*</span>
                        </label>

                        <input type="text" class="form-control" 
                            ng-init="amount=<?php echo $loanRecord[0]->amount_per_installment; ?>"
                            ng-value="totalAmountFn(amount)" readonly>

                        <input type="hidden" name="amount" value="<?php echo $loanRecord[0]->amount_per_installment; ?>">
                    </div>
                </div>

                <div class="btn-group pull-right">
                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#datetimepicker').datetimepicker({format: 'YYYY-MM-DD'});
    });
</script>
