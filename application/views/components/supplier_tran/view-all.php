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

<div class="container-fluid" ng-controller="showAllSupplierTransactionCtrl" ng-cloak>

    <div id="loading">
           <img src="<?php echo site_url('private/images/loading-bar.gif');?>" alt="Image Not found"/>
    </div>

    <div class="row loader-hide" id="data">
    <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left"><?php echo caption('All_Supplier_Transaction'); ?></h1>

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


                <h4 class="text-center hide" style="margin-top: -10px;"><?php echo caption('All_Supplier_Transaction'); ?></h4>

                 <div class="row none" style="margin-bottom:15px;">
                     <div class="col-md-4">
                         <input type="text" ng-model="search" placeholder="<?php echo caption('Search'); ?>" class="form-control">
                    </div>
                    <div class="col-md-5">&nbsp;</div>
                    <div class="col-md-3">
                        <div>
                             <span style="margin-left: 55px;line-height: 2.4;font-weight: bold;"><?php echo caption('Per_Page'); ?>&nbsp;:&nbsp;</span>
                             <select ng-model="perPage" class="form-control" style="width:92px;float:right;">
                                 <option value="10">10</option>
                                 <option value="20">20</option>
                                 <option value="30">30</option>
                                 <option value="50">50</option>
                                 <option value="100">100</option>
                             </select>
                         </div>
                    </div>
                </div>
                <table class="table table-bordered" ng-cloak>
                    <tr>
                        <th><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Date'); ?></th>
                        <th><?php echo caption('Supplier_Name'); ?></th>
                        <th><?php echo caption('Company_Name'); ?></th>
                        <th><?php echo caption('Mobile'); ?></th>
                        <th>Previous Due</th>
                        <th><?php echo caption('Payment'); ?></th>
                        <th><?php echo caption('Type_of_Payment'); ?></th>
                        <th>Present Due</th>
                        <th class="none"><?php echo caption('Action'); ?></th>
                    </tr>
                    <tr dir-paginate="transaction in allTransactions|filter:search|itemsPerPage:perPage|orderBy:sortField:reverse">
                        <td style="width: 50px;"> {{$index+1}} </td>
                        <td> {{transaction.date}} </td>
                        <td> {{transaction.vendor_name}} </td>
                        <td> {{transaction.company_name}} </td>
                        <td> {{transaction.vendor_mobile}} </td>
                        <td> {{transaction.balance}} </td>
                        <td> {{transaction.payment}} </td>
                        <td> {{transaction.payment_type}} </td>
                        <td> {{transaction.net_balance}} </td>
                        <td class="none" style="width: 160px;">
                            <a target="_blank" title="View" class="btn btn-info" href="<?php echo site_url('supplier_tran/supplier_tran/view_supplier_tran/{{transaction.id}}') ;?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a title="Edit" class="btn btn-warning" href="<?php echo site_url('supplier_tran/supplier_tran/edit_supplier_tran/{{transaction.id}}') ;?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this Data?');" href="<?php echo site_url('supplier_tran/supplier_tran/delete/{{transaction.id}}') ;?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>

                    </tr>
                    <tr>
                        <th colspan="6" class="text-right">Total</th>
                        <th>{{ getGrandTotalFn(); }}</th>
                        <td>&nbsp;</td>
                        <th>{{ getTotalNetBalanceFn(); }}</th>
                        <td colspan="1"></td>
                    </tr>
                </table>
                <dir-pagination-controls max-size="perPage" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls>
             </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
