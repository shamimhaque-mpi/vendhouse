            <div class="container-fluid">
                <div class="row">

                <!-- horizontal form -->
                <?php
                echo $confirmation;
                $attribute = array(
                    'name' => '',
                    'class' => 'form-horizontal',
                    'id' => ''
                );
                echo form_open_multipart('', $attribute);
                ?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panal-header-title pull-left">
                                <h1><?php echo caption('Create_An_Account'); ?></h1>
                            </div>
                        </div>

                        <div class="panel-body no-padding">

                        
                        <div class="no-title">&nbsp;</div>

                            <!-- left side -->
                            <aside class="col-md-3">
                                <!--div class="border-top">&nbsp;</div-->
                                
                                
                                <figure class="profile-pic">
                                    <img src="<?php echo site_url("private/images/pic-male.png"); ?>" alt="Photo not found!" class="img-responsive">
                                </figure>

                                <div class="profile-upload">    
                                    <label class="btn btn-primary" style="display: block;" for="image"><i class="fa fa-cloud-upload"></i> <?php echo caption('Upload'); ?></label>
                                    <input type="file" name="image" id="image" style="display: none;">
                                </div> <br/>

                                <!--table class="table table-status">
                                    <tbody>
                                        <tr>
                                            <td style="width: 60%"><?php echo caption('Status'); ?></td>
                                            <td><span class="status"><?php echo caption('Active'); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 60%"><?php echo caption('User_Rating'); ?></td>
                                            <td>
                                                <i class="fa fa-star co-yellow"></i>
                                                <i class="fa fa-star co-yellow"></i>
                                                <i class="fa fa-star co-yellow"></i>
                                                <i class="fa fa-star co-yellow"></i>
                                                <i class="fa fa-star co-yellow"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 60%"><?php echo caption('Member_Since'); ?></td>
                                            <td>June 07, 2016 </td>
                                        </tr>
                                    </tbody>
                                </table-->
                            </aside>


                            <div class="col-md-9">

                                <div class="form-group">
                                    <label for="" class="col-md-3 control-label"><?php echo caption('Name'); ?></label>
                                    <div class="col-md-7">
                                         <input class="form-control" type="text" name="f_name" placeholder="<?php echo caption('Full_Name'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-md-3 control-label"><?php echo caption('Mobile'); ?></label>
                                    <div class="col-md-7">
                                        <input type="text" name="mobile" class="form-control" placeholder="<?php echo caption('Mobile'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-md-3 control-label"><?php echo caption('Email'); ?></label>
                                    <div class="col-md-7">
                                        <input type="email" name="email" class="form-control" placeholder="email@yourcompany.com">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-md-3 control-label"><?php echo caption('Username'); ?></label>
                                    <div class="col-md-7">
                                        <input type="text" name="username" class="form-control" placeholder="<?php echo caption('Username'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-md-3 control-label"><?php echo caption('Password'); ?></label>
                                    <div class="col-md-7">
                                        <input class="form-control" type="password" name="password" placeholder="<?php echo caption('Password'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-md-3 control-label"><?php echo caption('Confirm_Password'); ?></label>
                                    <div class="col-md-7">
                                        <input class="form-control" type="password" name="confirmPassword" placeholder="<?php echo caption('Confirm_Password'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-md-3 control-label"><?php echo caption('Privilege'); ?></label>
                                    <div class="col-md-7">
                                        <select name="privilege" class="form-control">
                                            <option disabled selected >-- <?php echo caption('Select'); ?> --</option>
                                            <option value="super">Super</option>
                                           <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!--<div class="form-group">
                                    <label for="" class="col-md-3 control-label">SR</label>
                                    <div class="col-md-7">
                                        <select name="sr" class="form-control">
                                            <option disabled selected >-- <?php echo caption('Select'); ?> --</option>
                                            <?php foreach($allSR as $key => $value){ ?>
                                                <option value="<?php echo $value->code; ?>"><?php echo filter($value->name); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>-->

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-7">
                                        <div class="btn-group pull-right">
                                            <input class="btn btn-primary" type="submit" name="createProfileBtn" value="<?php echo caption('Save'); ?>">
                                            <input class="btn btn-danger" type="reset" value="<?php echo caption('Reset'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">&nbsp;</div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>

