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
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">Profile</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">
               
                <div class="row">
                    <div class="view-profile">
                        <div class="col-xs-2">
                            <figure class="pull-left">
                                <img class="img-responsive" src="<?php echo site_url('private/images/logo.png'); ?>" style="width: 100px; height: 100px;" alt="">
                            </figure>
                        </div>

                        <div class="col-xs-8">
                            <div class="institute">
                                <?php $heading = config_item('heading'); ?>
                                <h2 class="text-center title" style="margin-top: 10; font-weight: bold;"><?php echo $heading['title']; ?></h2>
                                <h3 class="text-center" style="margin: 0;"><?php echo $heading['place']; ?></h3>
                            </div>
                        </div>
                                
                        <div class="col-xs-2">
                            <figure class="pull-right">
                                <img class="img-responsive" src="<?php echo site_url($member[0]->member_photo); ?>" style="width: 100px; height: 100px;" alt="Photo not found!" class="img-responsive">
                            </figure>
                        </div>
                    </div>
                </div>

                <hr style="border-bottom: 1px solid #ccc; margin-top: 0;">

                <div class="row">

                     <h4 class="text-center" style="margin-top: -10px;">Member Information</h4>
            
                    <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">Member ID</label>
                        <div class="col-xs-6">
                            <p><?php echo $member[0]->member_id; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">Name</label>
                        <div class="col-xs-6">
                            <p><?php echo $member[0]->member_full_name; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">Profession</label>
                        <div class="col-xs-6">
                            <p><?php echo $member[0]->member_profession; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">Father Name</label>
                        <div class="col-xs-6">
                            <p><?php echo $member[0]->member_father_name; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">Thorp</label>
                        <div class="col-xs-6">
                            <p><?php echo $member[0]->member_thorp; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">Village</label>
                        <div class="col-xs-6">
                            <p><?php echo $member[0]->member_village; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">Upazila</label>
                        <div class="col-xs-6">
                            <p><?php echo $member[0]->member_police_station; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">District</label>
                        <div class="col-xs-6">
                            <p><?php echo $member[0]->member_district; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">Mobile Number</label>
                        <div class="col-xs-6">
                            <p><?php echo $member[0]->member_mobile_number; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">Signature</label>
                        <div class="col-xs-6">
                            <img src="<?php echo site_url($member[0]->member_sign); ?>" alt="Photo not found..!" width="100px" height="40px">
                        </div>
                    </div>
                     <div class="col-md-6 no-padding">
                        <label class="control-label col-xs-6">Employee</label>
                        <div class="col-xs-6">
                            <?php 
                              $where=array('emp_id'=>$member[0]->employee_id); 
                              $info=$this->action->read('employee',$where);
                              if($info != NULL){ echo $info[0]->name;}
                             ?>
                        </div>
                    </div>  
                </div>

            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

