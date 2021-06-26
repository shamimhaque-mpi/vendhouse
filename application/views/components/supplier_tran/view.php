<style>
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer{
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .hide{
            display: block !important;
        }
    }
    .wid-100{
        width: 100px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default ">
            <div class="panel-heading none">
                <div class="panal-header-title">
                    <h1 class="pull-left">View Supplier Transation</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">

               
                
                <div class="row hide">
                    <div class="view-profile">

                        <div class="institute">
                            <h2 class="text-center title" style="margin-top: 10px; font-weight: bold;">
                                <?php $print_header = config_item('heading');echo $print_header['title']; ?>
                            </h2>
                            <h4 class="text-center" style="margin: 0;">
                                <?php $print_header = config_item('heading');echo $print_header['place']; ?>
                            </h4>
                            <h4 class="text-center" style="margin: 0;">
                              Mobile: <?php $print_header = config_item('heading');echo $print_header['mobile']; ?>
                            </h4>
                        </div>                          
                      
                    </div>
                </div>
                
                

                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">

                <div class="row">
                    <div class="col-md-12 view-profile">
                        <!-- Print Banner -->



                <label>Voucher Number : <?php echo $info[0]->voucher_number; ?></label>
                  &nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;
                 <label>Date: <?php echo $info[0]->date; ?></label>
                <?php
                  $suppInfo = $this->action->read("vendor",array("id" => $info[0]->supplier_name));
                  $name = ($suppInfo) ? filter($suppInfo[0]->vendor_name) : "";
                  $company = ($suppInfo) ? filter($suppInfo[0]->company) : "";
                  $mobile = ($suppInfo) ? $suppInfo[0]->vendor_mobile : "";
                  $address = ($suppInfo) ? $suppInfo[0]->vendor_address : "";
                ?>

                <table class="table table-hover">
                    <tr>
                        <th>Supplier Name</th>
                        <td><?php echo $name; ?></td>
                        <th>Company Name</th>
                        <td><?php echo $company; ?></td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td><?php echo $mobile; ?></td>
                        <th>Address</th>
                        <td><?php echo $address; ?></td>
                    </tr>
                    <tr>
                        <th>Previous Due</th>
                        <td><?php echo $info[0]->balance; ?></td>
                        <th>Payment</th>
                        <td><?php echo $info[0]->payment; ?></td>
                    </tr>
                    <tr>
                        <th>Payment Type</th>
                        <td><?php echo filter($info[0]->payment_type); ?></td>
                        <th>Present Due</th>
                        <td><?php echo $info[0]->net_balance; ?></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <th></th>
                        <td></td>
                    </tr>
                </table>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
