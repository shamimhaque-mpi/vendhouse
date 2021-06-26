<div class="container-fluid">
    <div class="row">
        <?php
            echo $confirmation;
            $language = $header_info = $footer_info = $social_icon = null;

            if (isset($meta->language)) {
                $language = $meta->language;
            }

            if (isset($meta->header)) {
                $header_info = json_decode($meta->header,true);
            }

            if (isset($meta->footer)) {
                $footer_info = json_decode($meta->footer,true);
            }

            if (isset($meta->social_icon)) {
                $social_icon = json_decode($meta->social_icon,true);
            }
       ?>
<pre>
<?php
    //$footer_info=json_decode($meta->footer,true);
    //$menu_icon=json_decode($meta->menu_icon,true);
    //$social_icon=json_decode($meta->social_icon,true);
    //print_r($footer_info);
 ?>
</pre>
        <!--===================================================================================================-->
        <!--===============================Language Change Section Start here==================================-->
        <!--===================================================================================================-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Change_Language');?></h1>
                </div>
            </div>

            <div class="panel-body">
                 <?php
                    $attr=array(
                        "class"=>"form-horizontal"
                    );
                    echo form_open('', $attr);
                 ?>

                    <div class="form-group">
                        <label class=" col-md-2 control-label"><?php echo caption('Language');?></label>
                        <div class="col-md-5">
                            <select class="form-control" name="language" id="">
                                <option <?php if($language=="en"){echo "selected";}?> value="en">English</option>
                                <option <?php if($language=="bn"){echo "selected";}?> value="bn">বাংলা</option>
                            </select>
                        </div>
                    </div>
                   
                    
                    <?php
                        $value=caption('Save');
                        $name="submit_language";
                        $class="btn-primary";

                        if ($language != null) {
                            $value=caption('Update');
                            $name="update_language";
                            $class="btn-success";
                        }
                    ?>
                    
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="btn <?php echo $class; ?>">
                    </div>
                <?php echo form_close(); ?>
                      
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <!--===================================================================================================-->
        <!--=================================Language Change Section End here==================================-->
        <!--===================================================================================================-->

        <!--===================================================================================================-->
        <!--===============================Header Information Section Start here===============================-->
        <!--===================================================================================================-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Header_Setting');?></h1>
                </div>
            </div>

            <div class="panel-body">
                 <?php
                    $attr=array(
                        "class"=>"form-horizontal"
                    );
                    echo form_open('', $attr);
                 ?>

                    <div class="form-group">
                        <label class=" col-md-2 control-label"><?php echo caption('Site_Name');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $header_info['site_name']; ?>" name="site_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-2 control-label"><?php echo caption('Place');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $header_info['place_name']; ?>" name="place_name" class="form-control">
                        </div>
                    </div>
                   
                    
                    <?php
                        $value=caption('Save');
                        $name="submit_header";
                        $class="btn-primary";

                        if ($header_info != null) {
                            $value=caption('Update');
                            $name="update_header";
                            $class="btn-success";
                        }
                    ?>
                    
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="btn <?php echo $class; ?>">
                    </div>
                <?php echo form_close(); ?>
                      
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <!--===================================================================================================-->
        <!--===============================Header Information Section End here=================================-->
        <!--===================================================================================================-->

        <!--===================================================================================================-->
        <!--======================================Footer Section Start here======================================-->
        <!--===================================================================================================-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Footer_Setting');?></h1>
                </div>
            </div>

            <div class="panel-body">
        		 <?php
                    $attr=array(
                        "class"=>"form-horizontal"
                    );
                    echo form_open_multipart('', $attr);
                 ?>

                    <input type="hidden" name="footer_img" >
                    <!-- <input type="hidden" name="old_foot_img" value="<?php// echo $footer_info['footer_img']; ?>"   "> -->
                    <div class="form-group">
                        <div class="col-md-7" >
                            <img src="<?php echo site_url($footer_info['footer_img']); ?>" alt="Image not found!" style="float: right; width: 100px; background: rgba(0,0,0,.5); padding: 5px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Footer_Setting');?></label>
                        <div class="col-md-5" >
                            <input id="input-test" type="file" name="fImage" class="form-control file" data-show-preview="false" data-show-upload="false" data-show-remove="false">    
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-2 control-label"><?php echo caption('Last_Footer_Text');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $footer_info['l_footer_text']; ?>" name="l_footer_text" class="form-control">
                        </div>
                    </div>
                    <fieldset>
                    <legend><?php echo caption('Footer_Address');?></legend>
                        <div class="form-group">
                            <label class=" col-md-2 control-label"><?php echo caption('Mobile');?></label>
                            <div class="col-md-5">
                                <input type="text" value="<?php echo $footer_info['addr_moblile']; ?>" name="addr_moblile" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-md-2 control-label"><?php echo caption('Email');?></label>
                            <div class="col-md-5">
                                <input type="text" value="<?php echo $footer_info['addr_email']; ?>" name="addr_email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-md-2 control-label"><?php echo caption('Address');?></label>
                            <div class="col-md-5">
                                <input type="text" value="<?php echo $footer_info['addr_address']; ?>" name="addr_address" class="form-control">
                            </div>
                        </div>
                    </fieldset>
                   
	                
                    <?php
                        $value=caption('Save');
                        $name="submit_footer";
                        $class="btn-primary";

                        if ($footer_info != null) {
                            $value=caption('Update');
                            $name="update_footer";
                            $class="btn-success";
                        }
                    ?>
                    
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="btn <?php echo $class; ?>">
                    </div>
                <?php echo form_close(); ?>
	                  
	        </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <!--===================================================================================================-->
        <!--====================================Footer Section end here========================================-->
        <!--===================================================================================================-->


        <!--===================================================================================================-->
        <!--===================================Social Icon Section Start here==================================-->
        <!--===================================================================================================-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Social_Icon');?></h1>
                </div>
            </div>

            <div class="panel-body">
                 <?php
                    $attr=array(
                        "class"=>"form-horizontal"
                    );
                    echo form_open_multipart('', $attr);
                 ?>
                    
                    <div class="form-group">
                        <label class=" col-md-2 control-label"><?php echo caption('Facebook');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $social_icon['s_facebook']; ?>" name="s_facebook" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-2 control-label"><?php echo caption('Twitter');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $social_icon['s_twitter']; ?>" name="s_twitter" class="form-control">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class=" col-md-2 control-label"><?php echo caption('Google_Plus');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $social_icon['s_gplus']; ?>" name="s_gplus" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-2 control-label"><?php echo caption('Pinterest');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $social_icon['s_pinterest']; ?>" name="s_pinterest" class="form-control">
                        </div>
                    </div>
                    
                    <?php
                        $value=caption('Save');;
                        $name="submit_social";
                        $class="btn-primary";

                        if ($social_icon != null) {
                            $value=caption('Update');
                            $name="update_social";
                            $class="btn-success";
                        }
                    ?>
                    
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="btn <?php echo $class; ?>">
                    </div>
                <?php echo form_close(); ?>
                      
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <!--===================================================================================================-->
        <!--===============================Social Icon Section End here========================================-->
        <!--===================================================================================================-->

    </div>
</div>