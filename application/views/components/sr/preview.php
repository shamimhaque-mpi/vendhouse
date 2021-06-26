<style>
    @media print{
        aside{display: none !important;}
        nav{display: none;}
        .panel{border: 1px solid transparent;left: 0px;position: absolute;top: 0px;width: 100%;}
        .none{display: none;}
        .panel-heading{display: none;}
        .panel-footer{display: none;}
        .panel .hide{display: block !important;}
        .title{font-size: 25px;}
        table tr th,table tr td{font-size: 12px;}
    }
    .table tr th {width: 22%;}
</style>


<div class="container-fluid" >

  <!--pre><?php //print_r($partyInfo); ?></pre-->
    <div class="row">
    <?php  echo $this->session->flashdata('confirmation'); ?>
    <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class="pull-left">Profile</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
				</div>
            </div>

            <div class="panel-body" ng-cloak>
                <!-- Print banner -->
                
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

                <h4 class="text-center hide" style="margin-top: 0px;">Profile</h4>

                <table class="table table-bordered table-hover">
                    <tr>
                      <th>ID</th>
                       <td><?php echo $SrInfo[0]->code; ?></td>
                      <th>Date</th>
                      <td><?php echo $SrInfo[0]->date; ?></td>
                   	</tr>

                    <tr>
                       <th>SR Name</th>
                       <td><?php echo $SrInfo[0]->name; ?></td>
                       <th>Mobile Number</th>
                       <td><?php echo $SrInfo[0]->mobile; ?></td>
                    </tr>

                   	<tr>
                        <th>Field</th>
                        <td>
                          <?php echo $SrInfo[0]->field;  ?>    
                        </td>
                       	<!-- <th>Address</th>
                       	<td>
                          <?php echo $SrInfo[0]->address;  ?>    
                        </td> -->
                   </tr>
                </table>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
