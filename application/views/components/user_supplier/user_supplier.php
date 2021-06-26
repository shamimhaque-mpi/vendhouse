<style>
    @media print{
        aside{
            display: none !important;
        }
        nav{
            display: none;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .none{
            display: none;
        }
        .panel-heading{
            display: none;
        }
        
        .panel-footer{
            display: none;
        }
        .panel .hide{
            display: block !important;
        }
        .title{
            font-size: 25px;
        }
        table tr th,table tr td{
            font-size: 12px;
        }
    }
</style>

<div class="container-fluid" ng-controller="AllCustomerCtrl" ng-cloak>
    <div class="row">
	<?php echo $confirmation; ?>
	<div ng-bind-html="message"></div>
	
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">All Suppliers</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i><?php echo caption('Print'); ?></a>
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


                <hr class="hide" style="border-bottom: 1px solid #ccc; margin-top: 5px;">

                <h4 class="hide text-center" style="margin-top: -10px;">All Suppliers</h4>

                <div class="table-responsive">
                <table class="table table-bordered">

                    <tr>
                        <th style="width: 35px;"><?php echo caption('SL'); ?></th>
                        <th width="80">Photo</th>
                        <th><?php echo caption('Name'); ?></th>
                        <th><?php echo caption('Mobile'); ?></th>
                        <th><?php echo caption('Email'); ?></th>
                        <th>SR</th>
                    </tr>
                    
                    <?php 
                    foreach($allSupplier as $key => $value){ 
                        $where = array('code' => $value->sr);
                        $info = $this->action->read('sr', $where);
                    ?>
                    <tr>
                        <td> <?php echo $key+1; ?> </td>
                        <td> <img width="70" src="<?php echo site_url($value->image); ?>" > </td>
                        <td> <?php echo $value->name; ?> </td>
                        <td> <?php echo $value->mobile; ?> </td>
                        <td> <?php echo $value->email; ?> </td>
                        <td> <?php if(isset($info[0])){ echo filter($info[0]->name); } ?> </td>
                    </tr>
                    <?php } ?>
                </table>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

