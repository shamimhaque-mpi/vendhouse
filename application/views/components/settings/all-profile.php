            <div class="container-fluid">
                <div class="row">
                <?php echo $confirmation; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panal-header-title pull-left">
                                <h1><?php echo caption('All_Profile'); ?></h1>
                            </div>
                        </div>

                        <div class="panel-body">
                            <?php
                            if ($profiles != NULL) {
                            ?>

                            <table class="table table-bordered" style="margin-bottom: 0;">
                                <tr>
                                    <th style="width: 40px;"><?php echo caption('SL'); ?></th>
                                    <th style="width: 60px;"><?php echo caption('Image'); ?></th>
                                    <th><?php echo caption('Name'); ?></th>
                                    <th><?php echo caption('Username'); ?></th>
                                    <th><?php echo caption('Privilege'); ?></th>
                                    <!--<th>SR</th>-->
                                    <th class="text-right"><?php echo caption('Action'); ?></th>
                                </tr>

                                <?php 
                                foreach ($profiles as $key => $value) { 
                                    //$srInfo = $this->action->read('sr', array('code' => $value->sr));
                                ?>
                                <tr>
                                    <td><?php echo($key + 1); ?></td>
                                    <td><img src="<?php echo site_url($value->image); ?>" alt="" style="width: 40px; height: 35px; object-fit: cover;"></td>
                                    <td><?php echo filter($value->name); ?></td>
                                    <td><?php echo $value->username; ?></td>
                                    <td><?php echo ucwords($value->privilege); ?></td>
                                    <!--<td><?php echo isset($srInfo[0]->name) ? filter($srInfo[0]->name) : ''; ?></td>-->
                                    <td style="width: 160px; text-align: right;">
                                        <a class="btn btn-primary" href="<?php echo site_url("settings/showProfile?id=" . $value->id); ?>">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <?php if($privilege=='super'|| $value->username==$username){ ?>
                                        <a class="btn btn-warning" href="<?php echo site_url("settings/editProfile?id=" . $value->id); ?>">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <?php } 
                                        if($value->privilege!=$privilege && $value->username!=$username && $privilege=='super' || $privilege=='super'){ 
                                            if($value->privilege != "super"){
                                        ?>
                                        <a onclick="return confirm('This Data will delete permanently')" class="btn btn-danger" href="<?php echo site_url("settings/allProfile?img_url=".$value->image."&id=" . $value->id); ?>">
                                           <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                        <?php }} ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </table>

                            <?php
                            } else {
                                echo "<h3 style='text-align:center;'>No Accounts Available !</h3>";
                            }
                            ?>

                        </div>

                        <div class="panel-footer">&nbsp;</div>
                    </div>
                </div>
            </div>


