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

<div class="container-fluid" ng-controller="showbrandCtrl" ng-cloak>

  <div id="loading">
           <img src="<?php echo site_url('private/images/loading-bar.gif');?>" alt="Image Not found"/>
    </div>
    <div class="row loader-hide" id="data"> 
    <?php  echo $this->session->flashdata('confirmation'); ?>
    <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo caption('allBrand') ; ?>  <br>  <small><?php echo $total_brand; ?> <?php echo caption('Item_Found'); ?> </small></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>                
                </div>
            </div>

            <div ng-cloak class="panel-body" ng-hide="active" ng-init="active=true;">

                
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

                <div class="row none" style="margin-bottom:15px;">
                     <div class="col-md-4">
                         <input type="text" ng-model="search" placeholder="<?php echo caption('Search') ?>...." class="form-control">
                    </div>
                    <div class="col-md-5">&nbsp;</div>
                    <div class="col-md-3">
                        <div>
                             <span style="margin-left: 55px;line-height: 2.4;font-weight: bold;"><?php echo caption('Per_Page'); ?>&nbsp;:&nbsp;</span>
                             <select ng-model="perPage" class="form-control" style="width:92px;float:right;">
                             <option value="2">2</option>
                             <option value="3">3</option>
                             <option value="10">10</option>
                             <option value="20">20</option>
                             <option value="30">30</option>
                             <option value="50">50</option>
                             <option value="100">100</option>
                             </select>
                         </div>
                    </div>
                </div>
                
                <span ng-model="privilege" ng-init="privilege='<?php echo $this->data['privilege'];?>';"></span>
                <span ng-model="user_id" ng-init="user_id='<?php echo $this->data['user_id'];?>';"></span>

                <div class="table-responsive">
                <table class="table table-bordered" ng-cloak>
                    <tr>
                        <th style="width: 50px;"><?php echo caption('SL'); ?></th>
                        <!-- <th style="cursor:pointer;" ng-click="sortField='category'; reverse = !reverse;"><?php echo caption('Category'); ?> &nbsp;<span><i class="fa fa-sort pull-right none" aria-hidden="true"></i></span></th> -->
                        <th><?php echo caption('Brand'); ?></th>
                        <th class="none"><?php echo caption('Action'); ?></th>
                    </tr>                                         
                    <tr dir-paginate="brand in brands|filter:search|itemsPerPage:perPage|orderBy:sortField:reverse">
                        <td>{{brand.sl}}</td>
                        <!-- <td>{{subcategory.category | textBeautify}}</td> -->
                        <td>{{brand.brand | textBeautify}}</td>
                        <td class="none" style="width: 110px;">
                            <?php if(ck_action("brand","edit")){ ?>
                            <a title="Edit" class="btn btn-warning" href="<?php echo site_url('brand/brand/edit?id={{brand.id}}');?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php } ?>

                            <?php if(ck_action("brand","delete")){ ?>
                            <a title="Delete" class="btn btn-danger" data-id="{{brand.id}}" onclick="deleteAlert(`<?php echo site_url('brand/brand/delete'); ?>/`+this.dataset.id);" href=""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <?php } ?>
                        </td>
                    </tr>                                    
                </table>
                </div>
                <dir-pagination-controls max-size="perPage" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>       
    </div>
</div>

