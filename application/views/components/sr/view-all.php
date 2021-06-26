<style>
    @media print{
        aside, .panel-heading, .panel-footer, nav, .none{display: none !important;}
        .panel{border: 1px solid transparent;left: 0px;position: absolute;top: 0px;width: 100%;}
        .hide{display: block !important;}
        table tr th,table tr td{font-size: 12px;}
    }
    .action-btn a{
        margin-right: 0;
        margin: 3px 0;
    }
</style>

<div class="container-fluid" ng-controller="allSrCtrl" ng-cloak>
    <div class="row">
    	<?php  echo $this->session->flashdata('confirmation'); ?>

        <div id="loading">
            <img src="<?php echo site_url("private/images/loading-bar.gif"); ?>" alt="Image Not found"/>
        </div>

    	<div class="panel panel-default loader-hide" id="data">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class="pull-left">View All SR</h1>
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

                <h4 class="text-center hide" style="margin-top: 0px;">All SR</h4>

                <div class="row none">
                    <div class="col-md-3" style="margin-bottom:15px;">
                        <input type="text" ng-model="search" placeholder="Search...." class="form-control">
                    </div>
                    <div class="col-md-offset-6 col-md-3">
                        <select ng-model="perPage" class="form-control pull-right" style="width:100px;">
                            <option value="">All</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="500">500</option>
                        </select>
                    </div>
                </div>

                <hr class="none" style="border-bottom:2px solid #00A8FF; margin-top: 0;" />
                
                <table class="table table-bordered table-hover">
                    <tr>
                        <th width="50">SL</th>
                        <th>SR ID</th>
                        <th>SR Name</th>
                        <th width="140">Mobile</th>
                        <th>Field</th>
                        <!-- <th>Address</th> -->
                        <th>Target / <small>Month</small></th>
                        <th class="none" style="width: 110px;">Action</th>
                    </tr>

                    <tr dir-paginate="row in allSr|filter:search|filter:searchItem|orderBy:sortField:reverse|itemsPerPage:perPage">
                        <input type="hidden" ng-value="row.showroom_id">
                        <td>{{ row.sl }}</td>
                        <td>{{ row.code}} </td>
                        <td>{{ row.name | textBeautify}} </td>
                        <td>{{ row.mobile }}</td>
                        <td>{{ row.field | textBeautify}} </td>
                        <!-- <td>{{ row.address | textBeautify}} </td> -->
                        <td>{{ row.target}} </td>
                        <td class="none action-btn">


                            <?php if (ck_action('sr_menu','view')) { ?>   
                            <!-- <a
                                class="btn btn-info"
                                title="Preview"
                                href="<?php// echo site_url('sr/sr/preview?id={{row.id}}'); ?>">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a> -->
                            <?php }  ?>

                            <?php if (ck_action('sr_menu','edit')) { ?>
                            <a class="btn btn-warning" title="Edit" href="<?php echo site_url('sr/sr/edit?id={{row.id}}');?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                            <?php }  ?>


                            <?php if (ck_action('sr_menu','delete')) { ?>
                            <a
                                onclick="return confirm('Do you want to delete this SR?');" class="btn btn-danger"
                                title="Delete"
                                href="<?php echo site_url('sr/sr/delete/{{row.id}}'); ?>">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                            <?php }  ?>



                        </td>
                    </tr>
                </table>
                <dir-pagination-controls max-size="perPage" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
