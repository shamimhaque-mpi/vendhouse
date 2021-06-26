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
</style>

<div class="container-fluid">
    <div class="row">
    <?php //echo "<pre>"; print_r($vendor); echo "</pre>"; ?>
    <?php echo $confirmation; ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left"><?php echo caption('All_Supplier'); ?><br>  <small><?php echo count($vendor)?> <?php echo caption('Item_Found'); ?></small></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>

            <div class="panel-body">

                <!-- Print Banner -->
              
                
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

                <h4 class="text-center hide" style="margin-top: -10px;">All Supplier </h4>
                
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Company_Name'); ?></th>
                        <th><?php echo caption('Contact_Person'); ?></th>
                        <th><?php echo caption('Mobile_Number'); ?></th>
                        <th><?php echo caption('Address'); ?></th>                      
                        <th class="none"><?php echo caption('Action'); ?></th>
                    </tr>
                    <?php foreach ($vendor as $key => $vendor_info) { ?>
                    <tr>
                        <td style="width: 50px;"> <?php echo $key+1; ?> </td>
                        <td> <?php echo $vendor_info->company; ?></td>
                        <td> <?php echo $vendor_info->vendor_name; ?></td>
                        <td> <?php echo $vendor_info->vendor_mobile; ?> </td>
                        <td> <?php echo $vendor_info->vendor_address; ?></td>                        
                        <td class="none" style="width: 110px;">
                            <a title="Edit" class="btn btn-warning" href="<?php echo site_url('vendor/vendor/edit_vendor?id='.$vendor_info->id) ;?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this Data?');" href="<?php echo site_url('vendor/vendor/delete?id='.$vendor_info->id) ;?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

