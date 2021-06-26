<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<style type="text/css">
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer{display: none !important;}
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .hide{display: block !important;}
    }
    .table-title{
        font-size: 20px;
        color: #333;
        background: #f5f5f5;
        text-align:center;
        border-left: 1px solid #ddd;
        border-top: 1px solid #ddd;
        border-right: 1px solid #ddd;
    }
    .select2-product_code-ji-container {height: 35px !important; }
    .select2-selection__arrow, .select2-selection--single {height: 36px !important;}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default none">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>View Item Wise Purchase</h1>
                </div>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('deleted');
                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>
                <div class="form-group">
                    <label class="col-md-2 control-label">Product</label>
                    <div class="col-md-4">
                        <select name="product_code" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" reaquired>
                            <option value="">--Select--</option>
                            <?php if($allProducts != null){ foreach($allProducts as $key => $row){ ?>
                            <option value="<?php echo $row->product_code; ?>">
                                <?php echo filter($row->product_name); ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group">
                            <input type="submit" name="show" value="Show" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php  if($result != null){ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">Show Result</h1>&nbsp;&nbsp;<small>(<?php echo filter($rawname[0]->product_name); ?>)</small>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
            <div class="panel-body">
                <!-- Print banner -->
                <!--<img class="img-responsive print-banner hide" src="<?php echo site_url($banner_info[0]->path); ?>">-->
                
                <h4 class="text-center hide" style="margin-top: 0px;">Itemwise Purchase</h4>
                <h5 class="text-center hide" style="margin-top: 5px;">Product : <?php echo filter($rawname[0]->product_name); ?></h5>
                <table class="table table-bordered table2">
                    <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Voucher No</th>
                        <th>Quantity</th>
                        <th width="60" class="none">Action</th>
                    </tr>
                    <?php
                    $total = 0;
                    foreach($result as $key => $val){
                        $total += $val->quantity;
                        ?>
                        <tr>
                            <td style="width: 40px;"><?php echo $key+1; ?></td>
                            <td ><?php echo $val->sap_at; ?></td>
                            <td ><?php echo $val->voucher_no; ?></td>
                            <td><?php echo $val->quantity; ?></td>
                            <td class="none">
                                <a title="View" class="btn btn-primary" href="<?php echo site_url('purchase/purchase/view?vno=' . $val->voucher_no); ?>">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="3" style="text-align: right; "> Total </th>
                            <td colspan="2"> <?php echo $total."&nbsp;".$result[0]->unit; ?> </td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">&nbsp;</div>
            </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>