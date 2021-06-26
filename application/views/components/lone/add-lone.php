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

        <div class="panel panel-default none">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Take Installment</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label">Member ID <span class="req">*</span></label>

                    <div class="col-md-4">
                        <input type="text" name="search[member_id]" class="form-control" required>
                    </div>

                    <div class="col-md-2">
                        <div class="btn-group">
                            <input type="submit" name="show" value="Show" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                    
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>






        <?php if($result != null){ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">Result</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">
                <!-- pre><?php print_r($result); ?></pre -->

                <div class="row hide">
                    <div class="view-profile">
                        <div class="col-xs-2">
                            <figure class="pull-left">
                              <img src="<?php echo site_url('private/images/logo.png'); ?>" alt="" width="100px" height="100px">
                            </figure>
                        </div>

                        <div class="col-xs-8">
                            <div class="institute">
                                <?php $heading = config_item('heading'); ?>
                                <h2 class="text-center title" style="margin-top: 10; font-weight: bold;"><?php echo $heading['title']; ?></h2>
                                <h3 class="text-center" style="margin: 0;"><?php echo $heading['place']; ?></h3>
                            </div>
                        </div> 

                        <!-- <div class="col-xs-2">
                            <figure class="pull-left">
                              <img src="<?php //echo site_url('public/img/pic-male.png'); ?>" alt="" width="100px" height="100px">
                            </figure>
                        </div>   -->                             
                       
                    </div>
                </div>

                <hr class="hide" style="border-bottom: 1px solid #ccc; margin-top: 5px;" >
                <h4 class="text-center hide" style="margin-top: -10px;">All Installment</h4>
                
                <table class="table table-bordered table2">
                    <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Vouture Number</th>
                        <th>Due</th>
                        <th>Status</th>
                        <th style="width: 60px;">Action</th>
                    </tr>
                
                    <?php foreach($result as $key => $row){ ?>
                    <tr>
                        <td style="width: 50px;"><?php echo ($key + 1); ?></td>
                        <td style="width: 100px;"><?php echo $row->date; ?></td>
                        <td><?php echo $row->voucher_number; ?></td>
                         <td><?php echo $row->due; ?></td>
                        <td><?php echo ucwords($row->status); ?></td>
                        <td>
                            <a href="<?php echo site_url('lone/takeInstallment?lid=' . $row->id); ?>" class="btn btn-primary">Take Installment </a>
                        </td>
                    </tr>
                    <?php } ?>
                
                </table>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>

    </div>
</div>