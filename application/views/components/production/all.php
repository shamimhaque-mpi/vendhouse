
<div class="container-fluid">
    <div class="row">
	<?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            
            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">প্রোডাকশন</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print') ;?></a>
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

                <h4 class="hide text-center" style="margin-top: -10px;"><?php echo caption('All_Product') ;?></h4>

                <table class="table table-bordered">
                    <tr>
                        <th style="width: 35px;"> <?php echo caption('SL') ;?> </th>
                        <th>উপাদান</th>
                        <th>পরিমাণ</th>
                        <th class="none"> <?php echo caption('Action') ;?> </th>
                    </tr>  
                    <tr>
                    	<td>1</td>
                    	<td>Gold 1</td>
                    	<td>15 গ্রাম</td>
                    	<td class="none" style="width: 170px;">
                    	    <a title="View" class="btn btn-primary" href="<?php echo site_url('production/view'); ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a title="Edit" class="btn btn-warning" href="<?php echo site_url('production/edit'); ?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this Product?');" href="?id={{product.id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>                                   
                </table>
                <dir-pagination-controls max-size="perPage" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls>
               </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

