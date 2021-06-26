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
    <?php // echo "<pre>"; print_r($emp_info); echo "</pre>"; ?>
    <?php echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left"><?php echo caption('All_Employee') ;?>  <br>  <small><?php echo count($emp_info)?> <?php echo caption('Item_Found') ;?></small></h1>
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

                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">

                <div class="">
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo caption('SL') ;?></th>
                        <th><?php echo caption('Joining_Date') ;?></th>
                        <th><?php echo caption('Image') ;?></th>
                        <th><?php echo caption('Name') ;?></th>
                        <th><?php echo caption('Designation') ;?></th>
                        <th><?php echo caption('Mobile_Number') ;?></th>
                        <th class="none"><?php echo caption('Action') ;?></th>
                    </tr>
                    <?php foreach ($emp_info as $key => $emp) { ?>

                    <tr>
                        <td> <?php echo $key+1; ?> </td>
                        <td style="width: 130px;"> <?php echo $emp->joining_date; ?> </td>
                        <td style="width: 50px;"> <img src="<?php echo site_url($emp->path); ?>" width="50px" height="50px" alt=""></td>
                        <td> <?php echo filter($emp->name); ?> </td>
                        <td> <?php echo filter(str_replace("_"," ", $emp->designation)); ?></td>
                        <td> <?php echo $emp->mobile; ?></td>
                        <td class="none" style="width: 70px;">
                            <div class="dropdown pull-right">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cog"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right ulbordertop">
                                    <li></li>

                                    <?php if(ck_action("employee","view")){ ?>
                                    <li>
                                        <a href="<?php echo site_url('employee/employee/profile?id='.$emp->id);?>"><?php echo caption('View') ;?> </a>
                                    </li>
                                    <?php } ?>
                                    

                                    <?php if(ck_action("employee","edit")){ ?>
                                    <li>
                                        <a href="<?php echo site_url('employee/employee/edit_employee?id='.$emp->id) ;?>"><?php echo caption('Edit') ;?></a>
                                    </li>
                                    <?php } ?>                                    

                                    <li>
                                        <a href="<?php echo site_url('employee/employee/salary/'.$emp->id) ;?>"><?php echo caption('Salary') ;?></a>
                                    </li>

                                    <li>
                                        <a href="<?php echo site_url('employee/employee/ad_salary/'.$emp->id) ;?>"><?php echo caption('Advance') ;?></a>
                                    </li>

                                    <li>
                                        <a href="<?php echo site_url('employee/employee/salary_history/'.$emp->id) ;?>"> <?php echo caption('History') ;?></a>
                                    </li>

                                    <?php if(ck_action("employee","delete")){ ?>
                                    <li>
                                        <a onclick="return confirm('Are you sure to delete this data?');" href="<?php echo site_url('/employee/employee/delete/'.$emp->id) ;?>"> <?php echo caption('Delete') ;?></a>
                                    </li>
                                    <?php } ?>                                    
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                </div>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
