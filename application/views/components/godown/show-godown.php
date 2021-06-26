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
        .panel .hide{
            display: block !important;
        }
    }
</style>

<div class="container-fluid" ng-controller="ShowGodownCtrl" ng-cloak>

    <div id="loading">
           <img src="<?php echo site_url('private/images/loading-bar.gif');?>" alt="Image Not found"/>
    </div>

    <div class="row loader-hide" id="data">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left"><?php echo caption('All_Godown'); ?></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()">
                        <i class="fa fa-print"></i> 
                        <?php echo caption('Print'); ?>
                    </a>
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

                <h4 class="text-center hide" style="margin-top: -10px;"><?php echo caption('All_Godown'); ?></h4>
                
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Place'); ?></th>
                        <th><?php echo caption('Supervisor'); ?></th>
                        <th><?php echo caption('Contact_Number'); ?></th>
                        <th><?php echo caption('Address'); ?></th>
                        <th class="none"><?php echo caption('Action'); ?></th>
                    </tr>
               
                    <tr dir-paginate="row in result|itemsPerPage:20">
                        <td> {{ row.sl }} </td>
                        <td> {{ row.place }} </td>
                        <td> {{ row.supervisor }} </td>
                        <td> {{ row.contact_no }} </td>
                        <td> {{ row.address }} </td>
                        <td class="none" style="width: 110px;">
                            <?php if(ck_action("godown","edit")){ ?>
                            <a title="Edit" class="btn btn-warning" href="<?php echo site_url('godown/godown/edit_godown?id='); ?>{{ row.id }}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php } ?>
                            <?php if(ck_action("godown","delete")){ ?>
                            <a title="Delete" class="btn btn-danger" href="#" ng-click="deleteGodownFn(row.id)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                </table>

                <dir-pagination-controls max-size="20" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

