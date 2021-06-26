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
    <?php echo $confirmation; ?>
        <div class="panel panel-default ">

            <div class="panel-heading none">
                <div class="panal-header-title">
                    <h1 class="pull-left">View All Installment</h1>
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


                <hr style="border-bottom: 2px solid #ccc; margin: 5px 0 10px;">
                <!-- <h4 class="hide text-center" style="margin-top: -10px;">সকল প্রোডাক্ট</h4> -->

                <label>Date : 2016-11-12</label> <br>
                <label>Vouture Number : 25487946546</label> <br>
                <label style="margin-bottom: 10px;">Supplire Name : Imtiaz ahammed</label>

                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Godown Name</th>
                    </tr>
                    <tr>
                        <td style="width: 50px;">1</td>
                        <td >asdf</td>
                        <td class="wid-100">1</td>
                        <td class="wid-100">1</td>
                        <td class="wid-100">1</td>
                        <td class="wid-100">1</td>
                        <td style="width: 250px;">asdf</td>
                    </tr>
                    
                </table>

                <div class="text-right">
                    <label>Total : 1000  </label> <br>
                    <label>Total Discount : 100  </label> <br>
                    <label>Grand Total : 900  </label> <br>
                    <label>Payment : 500  </label> <br>
                    <label>Due : 400s  </label>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>