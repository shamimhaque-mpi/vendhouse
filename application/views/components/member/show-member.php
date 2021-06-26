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

<div class="container-fluid" ng-controller="showAllMembersCtrl">
    <div class="row">
      <?php echo $this->session->flashdata('confirmation'); ?>
      <div ng-cloak class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">All Member</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>
            <div class="panel-body">

              <div class="row none" style="margin-bottom:15px;">                      
                <div class="col-md-3">
                   <div style="display: inline-flex; width: 100%;">
                         <label style="width: 108px; margin-top: 6px;">Per Page</label>
                         <select ng-model="perPage" class="form-control" >
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
                <div class="col-md-3">
                   <div style="display: inline-flex; width: 100%;">
                       <label style="width: 116px; margin-top: 6px;">Employee</label>
                       <select  ng-model="search" class="form-control">
                          <option value="" disabled selected>&nbsp;</option>
                          <?php foreach ($employee as $key => $value) { ?>
                             <option value="<?php echo $value->emp_id;?>"><?php echo $value->name;?></option>
                          <?php } ?>                                
                       </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div style="display: inline-flex; width: 100%;">
                         <label style="width: 90px; margin-top: 6px;">Upazila</label>
                         <select  ng-model="search" class="form-control">
                            <option value="" disabled selected>&nbsp;</option>
                            <?php foreach ($upazilla as $key => $value) { ?>
                               <option value="<?php echo $value->member_police_station;?>"><?php echo $value->member_police_station;?></option>
                            <?php } ?> 
                         </select>
                     </div>
                </div>
                <div class="col-md-3">
                    <div style="display: inline-flex; width: 100%;">
                         <label style="width: 85px; margin-top: 6px;">District</label>
                         <select ng-model="search" class="form-control">
                            <option value="" disabled selected>&nbsp;</option>
                            <?php foreach ($zilla as $key => $value) { ?>
                               <option value="<?php echo $value->member_district;?>"><?php echo $value->member_district;?></option>
                            <?php } ?> 
                         </select>
                     </div>
                </div>

            </div>

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


                <hr class="hide" style="border-bottom: 1px solid #ccc; margin-top: 0;">
                <h4 class="text-center hide" style="margin-top: -10px;">All Members</h4>
                
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>                        
                        <th>Photo</th>
                        <th>Name</th>
                        <th style="cursor:pointer;" ng-click="sortField=member_id; reverse=!reverse;">Member ID &nbsp;<span><i class="fa fa-sort pull-right none" aria-hidden="true"></i></span></th>
                        <th>Mobile Number</th>
                        <th class="none">Action</th>
                    </tr>                    
                    <tr dir-paginate="member in members|filter:search|orderBy:sortField:reverse|itemsPerPage:perPage">
                        <td style="width: 50px;"> {{member.sl}}</td>                        
                        <td style="width: 50px;"> <img ng-src="<?php echo site_url('{{member.member_photo}}');?>" width="50px" height="50px" alt=""></td>
                        <td>{{ member.member_full_name}}</td>
                        <td>{{ member.member_id}}</td>
                        <td> <a ng-href="tel:<?php echo '+88';?> {{member.member_mobile_number}}">{{member.member_mobile_number}}</a> </td>
                        <td class="none" style="width: 160px;">
                            <a class="btn btn-primary" href="<?php echo site_url('member/member/profile?id={{member.id}}');?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a class="btn btn-warning" href="<?php echo site_url('member/member/edit_member?id={{member.id}}') ;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this data?');" href="<?php echo site_url("/member/member/delete/{{member.id}}");?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>                    
                </table>
                <dir-pagination-controls max-size="perPage" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls>
               </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

