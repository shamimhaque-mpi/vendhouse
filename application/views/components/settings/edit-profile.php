            <div class="container-fluid">
                <div class="row">
                <?php //echo "<pre>"; print_r($profile); echo "</pre>"; ?>
                <!-- horizontal form -->
                <?php
                echo $confirmation;
                $attribute = array(
                    'name' => '',
                    'class' => 'form-horizontal',
                    'id' => ''
                );
                echo form_open_multipart('settings/editProfile?id='.$this->input->get('id'), $attribute);
                ?>
                    <input type="hidden" name="img_url" value="<?php echo $profile[0]->image; ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading panal-header">
                            <div class="panal-header-title pull-left">
                                <h1><?php echo caption('Edit_Profile'); ?></h1>
                            </div>
                        </div>

                        <div class="panel-body">

                        <h2 style="padding: 0 15px; margin: 15px 0;">
                            <?php echo caption('Profile'); ?>: <strong><?php echo $profile[0]->name." ".$profile[0]->l_name; ?></strong>
                        </h2>
                        <br>

                        
                        <!--div class="no-title">&nbsp;</div-->

                            <!-- left side -->
                            <aside class="col-md-3">
                                <!--div class="border-top">&nbsp;</div-->
                                
                                
                                <figure class="profile-pic">
                                    <img src="<?php echo site_url($profile[0]->image); ?>" alt="Photo not found!" class="img-responsive">
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
                                            <td><?php echo $profile[0]->opening; ?></td>
                                        </tr>
                                    </tbody>
                                </table-->
                            </aside>


                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 col-xs-12 control-label"><?php echo caption('Name'); ?></label>
                                    <div class="col-sm-7 col-xs-10">
                                        <input class="form-control" type="text" value="<?php echo $profile[0]->name; ?>" name="f_name" placeholder="<?php echo caption('First_Name'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-3 col-xs-12 control-label"><?php echo caption('Mobile'); ?></label>
                                    <div class="col-sm-7 col-xs-10">
                                        <input type="text" name="mobile" value="<?php echo $profile[0]->mobile; ?>" class="form-control" placeholder="<?php echo caption('Mobile'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-3 col-xs-12 control-label"><?php echo caption('Email'); ?></label>
                                    <div class="col-sm-7 col-xs-10">
                                        <input type="email" name="email" value="<?php echo $profile[0]->email; ?>" class="form-control" placeholder="email@yourcompany.com">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-3 col-xs-12 control-label"><?php echo caption('Username'); ?></label>
                                    <div class="col-sm-7 col-xs-10">
                                        <input type="text" name="username" value="<?php echo $profile[0]->username; ?>" class="form-control" placeholder="<?php echo caption('Username'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-md-3 control-label"><?php echo caption('Privilege'); ?></label>
                                    <div class="col-md-7">
                                        <select name="privilege" class="form-control">
                                            <option readonly disabled >-- <?php echo caption('Select'); ?> --</option>
                                            <option value="super" <?php if($profile[0]->privilege=='super'){echo "selected"; } ?> >Super</option>
                                          <option value="admin" <?php if($profile[0]->privilege=='admin'){echo "selected"; } ?> >Admin</option>
                                            <option value="user" <?php if($profile[0]->privilege=='user'){echo "selected"; } ?> >User</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!--<div class="form-group">
                                    <label for="" class="col-md-3 control-label">SR</label>
                                    <div class="col-md-7">
                                        <select name="sr" class="form-control">
                                            <option disabled selected >-- <?php echo caption('Select'); ?> --</option>
                                            <?php foreach($allSR as $key => $value){ ?>
                                                <option <?php if($profile[0]->sr == $value->code){echo 'selected';} ?> value="<?php echo $value->code; ?>"><?php echo filter($value->name); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>-->
                                
                                <div class="form-group">
                                    <label class="col-sm-3 col-xs-12 control-label"></label>
                                    <div class="col-sm-7 col-xs-10">
                                        <div class="btn-group pull-right">
                                            <input class="btn btn-success" type="submit" name="profileEditBtn" value="<?php echo caption('Update'); ?>">
                                            <!--input class="btn btn-danger" type="reset" value="Clear"-->
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-xs-2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">&nbsp;</div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
