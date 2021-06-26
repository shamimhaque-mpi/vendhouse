<style>
    .message{
        border: 1px solid #ddd;
        border-radius: 10px;
        display: none;
        background: #E99126;
        color: #fff;
        padding: 15px;

    }
</style>
<div class="container-fluid">
    <div class="row">
    <?php //echo "<pre>"; print_r($profile_info); echo "</pre>"; ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('User_Profile'); ?></h1>
                   <!--  <span>Form for user profile </span> -->
                </div>
            </div>

            <div class="panel-body no-padding">

                <h2 style="padding: 0 15px; margin: 15px 0;">
                    <?php echo caption('Profile'); ?>: <strong><?php echo $profile_info[0]->name." ".$profile_info[0]->l_name ?></strong>
                </h2>
                <br>


                <!--div class="no-title">&nbsp;</div-->

                <!-- left side -->
                <aside class="col-md-3">
                    <div class="border-top">&nbsp;</div>
                    <figure class="profile-pic">
                        <img style="margin-bottom: 0;" src="<?php echo site_url($profile_info[0]->image)?>" alt="Photo not found!" class="img-responsive">
                    </figure>
                    <br/>

                    <!--table class="table table-status">
                        <tbody>
                            <tr>
                                <th style="width: 60%"><?php echo caption('Status'); ?></th>
                                <td><span class="status"><?php echo caption('Active'); ?></span></td>
                            </tr>
                            <tr>
                                <th style="width: 60%"><?php echo caption('Privilege'); ?></th>
                                <td>
                                    <?php echo ucwords($this->session->userdata('holder')); ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 60%"><?php echo caption('Branch'); ?></th>
                                <td>
                                    <?php echo $branch; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 60%"><?php echo caption('Member_Since'); ?></th>
                                <td>June 07, 2016 </td>
                            </tr>
                        </tbody>
                    </table-->
                </aside>


                <div class="col-md-9">

                      <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php echo caption('Profile'); ?></a></li>
                        <!--li role="presentation"><a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">Projects</a></li>
                        <li role="presentation"><a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">Photos</a></li>
                        <li role="presentation"><a href="#friends" aria-controls="friends" role="tab" data-toggle="tab">Friends</a></li>
                        <li role="presentation"><a href="#groups" aria-controls="groups" role="tab" data-toggle="tab">Groups</a></li-->
                    </ul>

                  <!-- Tab panes -->

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="profile">
                            <div class="col-xs-12 profile-title no-padding">
                                <div class="col-xs-6">
                                    <h3 class="pull-left" style="margin-bottom: 20px;"><i class="glyphicon glyphicon-user" style="font-size: 30px;"></i> &nbsp; <?php echo caption('About'); ?></h3>
                                </div>

                                <div class="col-xs-6">
                                    <a class="pull-right" data-toggle="modal" data-target=".bs-example-modal-lg" style="min-width: 115px;padding:0 5px;" href="#"><i class="fa fa-pencil"></i>&nbsp; <?php echo caption('Edit_Password'); ?></a>
                                </div>
                            </div>



                            <!-- Pop Up Edit Password -->
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo caption('Edit_Password'); ?></h4>
                                    </div>

                                    <div class="model-body" style="margin-top: 20px;">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <form action="" id="edit_form" class="form-horizontal">

                                                    <div class="form-group">
                                                        <label class="control-label col-md-4"><?php echo caption('Old_Password'); ?><span class="req">*</span></label>
                                                        <div class="col-md-6">
                                                            <input type="password" name="current_pass" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-md-4"><?php echo caption('New_Password'); ?> <span class="req">*</span></label>
                                                        <div class="col-md-6">
                                                            <input type="password" name="new_pass" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-md-4"><?php echo caption('Confirm_Password'); ?> <span class="req">*</span></label>
                                                        <div class="col-md-6">
                                                            <input type="password" name="conf_pass" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="pull-right">
                                                                <input class="btn btn-primary" type="submit" value="<?php echo caption('Save'); ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="col-md-3 message"></div>
                                        </div>
                                    </div>

                                    <div class="model-footer">&nbsp;</div>
                                </div>
                              </div>
                            </div>
                            <!-- End Edit Password-->




                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <label class="control-label col-xs-5"><?php echo caption('Name'); ?></label>
                                    <div class="col-xs-7">
                                        <p><?php echo $profile_info[0]->name; ?></p>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <label class="control-label col-xs-5"><?php echo caption('Username'); ?></label>
                                    <div class="col-xs-7">
                                        <p><?php echo $profile_info[0]->username; ?></p>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <label class="control-label col-xs-5"><?php echo caption('Mobile'); ?></label>
                                    <div class="col-xs-7">
                                        <p><?php echo $profile_info[0]->mobile; ?></p>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <label class="control-label col-xs-5"><?php echo caption('Email'); ?></label>
                                    <div class="col-xs-7">
                                        <p><?php echo $profile_info[0]->email; ?></p>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <label class="control-label col-xs-5"><?php echo caption('Privilege'); ?></label>
                                    <div class="col-xs-7">
                                        <p><?php echo $profile_info[0]->privilege; ?></p>
                                    </div>
                                </div>
                                
                                <!--<div class="col-sm-6 col-xs-12">
                                    <label class="control-label col-xs-5">SR</label>
                                    <div class="col-xs-7">
                                        <p><?php echo isset($profile_info[0]->sr) ? $profile_info[0]->sr : ''; ?></p>
                                    </div>
                                </div>-->
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="projects">2</div>

                        <div role="tabpanel" class="tab-pane" id="photos">
                            <div>
                              <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-3.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-3.jpg" alt=""/></a>
                              <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-4.jpg" data-lightbox="example-set" data-title="Or press the right arrow on your keyboard."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-4.jpg" alt="" /></a>
                              <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-5.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-5.jpg" alt="" /></a>
                              <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-6.jpg" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-6.jpg" alt="" /></a>
                            </div>
                        </div>

                  </div>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('submit','#edit_form', function(ev){
            var New_pass=$('input[name="new_pass"]').val();
            var conf_pass=$('input[name="conf_pass"]').val();
            var Current_pass=$('input[name="current_pass"]').val();
            $.ajax({
                url: '<?php echo base_url("settings/profile/edit_password"); ?>',
                type: 'POST',
                data: {new_pass: New_pass,conf_pass: conf_pass,current_pass: Current_pass}
            })
            .done(function(response){
                $(".message").fadeIn();
                $(".message").html(response);
                $('input[name="new_pass"]').val("");
                $('input[name="conf_pass"]').val("");
                $('input[name="current_pass"]').val("");
                //console.log(response);

            });
             ev.preventDefault();
        });


        });


</script>
