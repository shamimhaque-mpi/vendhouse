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
                

                <h4 class="hide text-center" style="margin-top: -10px;">প্রোডাকশন</h4>
                
		        <p><b>রগোল্ডঃ</b> গোল্ড 1 &nbsp; &nbsp; <b>পরিমানঃ</b> 15 গ্রাম</p>
		
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 35px;"> <?php echo caption('SL') ;?> </th>
                        <th>উপাদান</th>
                        <th>পরিমাণ</th>
                    </tr>  
                    <tr>
                        <td style="width: 35px;"> 1 </td>
                        <td>Gold 1</td>
                        <td>15</td>                                       
                    </tr>    
                    <tr>
                        <td style="width: 35px;"> 2 </td>
                        <td>Gold 2</td>
                        <td>15</td>                                       
                    </tr>                               
                </table>
                <dir-pagination-controls max-size="perPage" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls>
               </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

