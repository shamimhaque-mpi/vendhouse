<style>
	.themeColor input[type="color"]{
		padding:  0 !important;
		border: 0;
		width: 50px;
		cursor: pointer;
	}
	iframe{
		width: 100%;
		height: 300px;
	}
</style>

<div class="container-fluid">
    <div class="row">
        <?php echo $confirmation; ?>
        <!--===================================================================================================-->
        <!--===============================Theme color Section Start here======================================-->
        <!--===================================================================================================-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Theme_Color');?></h1>
                </div>
            </div>

            <div class="panel-body themeColor">
			        	
        		<?php
	        		$attr=array(
						"class"=>"form-horizontal"
	        		);
	        		echo form_open('', $attr);
        		 ?>
        		 	<input type="hidden" name="theme_id" value="<?php echo custom_fetch($theme_data,'id')?>">

            		<div class="row">
            			<div class="form-group col-xs-3">
						    <label class="control-label col-xs-9"><?php echo caption('Theme_Color');?></label>
						    <input type="color" name="themeColor" value="<?php echo custom_fetch($theme_data,'theme_color')?>" class="form-control color"/>
						</div>

						<!--div class="form-group col-xs-3">
						    <label class="control-label col-xs-9">Submenu Bg</label>
						    <input type="color" name="" value="" class="form-control" style="width: 50px;">
						</div>

						<div class="form-group col-xs-3">
						    <label class="control-label col-xs-9">Submenu Hover</label>
						    <input type="color" name="" value="" class="form-control" style="width: 50px;">
						</div>

						<div class="form-group col-xs-3">
						    <label class="control-label col-xs-9">Menu Text Color</label>
						    <input type="color" name="" value="" class="form-control" style="width: 50px;">
						</div-->
            		</div>

            		<hr>

                    <?php
                        $value=caption('Save');
                        $name="submit";
                        $class="btn-primary";

                        if (count($theme_data)>0) {
                            $value=caption('Update');
                            $name="update";
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
        <!--===============================Theme color Section End here======================================-->
        <!--===================================================================================================-->

		<!--===================================================================================================-->
        <!--===============================Theme Bakground Section Start here======================================-->
        <!--===================================================================================================-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Theme_Background');?></h1>
                </div>
            </div>

            <div class="panel-body themeColor">
			        	
        		<?php
	        		$attr=array(
						"class"=>"form-horizontal"
	        		);
	        		echo form_open_multipart('', $attr);
        		 ?>
        		 	<input type="hidden" name="theme_id" value="<?php echo custom_fetch($theme_data,'id')?>">
        		 	<input type="hidden" name="old_image" value="<?php echo custom_fetch($theme_data,'background_pattern')?>">

                        <div class="form-group ">
                            <div class="col-md-12" style="height: 200px; background: url('<?php echo site_url(custom_fetch($theme_data,'background_pattern')); ?>"></div>
                        </div>

                        <div class="form-group ">
                            <label class="col-md-3 control-label"><?php echo caption('Background_Pattern');?> <span class="req">*</span></label>
                            <div class="col-md-5">
                                <input id="input-test" required type="file"  name="attachFile" class="form-control file" data-show-preview="true" data-show-upload="false" required data-show-remove="false">
                            </div>
                        </div>

            		<hr>

                    <?php
                        $value=caption('Save');
                        $name="submit_bg";
                        $class="btn-primary";

                        if (count($theme_data)>0) {
                            $value=caption('Update');
                            $name="update_bg";
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
        <!--===============================Theme Background Section End here======================================-->
        <!--===================================================================================================-->

		<!--===================================================================================================-->
        <!--===============================Login Bakground Section Start here======================================-->
        <!--===================================================================================================-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Login_Page_Background');?></h1>
                </div>
            </div>

            <div class="panel-body themeColor">
			        	
        		<?php
	        		$attr=array(
						"class"=>"form-horizontal"
	        		);
	        		echo form_open_multipart('', $attr);
        		 ?>
        		 	<input type="hidden" name="theme_id" value="<?php echo custom_fetch($theme_data,'id')?>">
        		 	<input type="hidden" name="old_image" value="<?php echo custom_fetch($theme_data,'login_background')?>">

                        <div class="form-group ">
                            <img class="img-thumbnail" src="<?php echo site_url(custom_fetch($theme_data,'login_background')); ?>" style="height: 200px;"/>
                        </div>

                        <div class="form-group ">
                            <label class="col-md-3 control-label"><?php echo caption('Background_Pattern');?> <span class="req">*</span></label>
                            <div class="col-md-5">
                                <input id="input-test" required type="file"  name="attachFile" class="form-control file" data-show-preview="true" data-show-upload="false" required data-show-remove="false">
                            </div>
                        </div>

            		<hr>

                    <?php
                        $value=caption('Save');
                        $name="submit_login_bg";
                        $class="btn-primary";

                        if (count($theme_data)>0) {
                            $value=caption('Update');
                            $name="update_login_bg";
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
        <!--===============================Login Background Section End here===================================-->
        <!--===================================================================================================-->

		<!--===================================================================================================-->
        <!--===============================Google Map Section Start here=======================================-->
        <!--===================================================================================================-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Google_Map');?></h1>
                </div>
            </div>

            <div class="panel-body themeColor">
			        	
        		<?php
	        		$attr=array(
						"class"=>"form-horizontal"
	        		);
	        		echo form_open('', $attr);
        		 ?>
        		 	<input type="hidden" name="theme_id" value="<?php echo custom_fetch($theme_data,'id')?>">
					<div class="form-group">
                        <div class="col-md-12">
                        	<?php echo custom_fetch($theme_data,'google_map')?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-3 control-label"><?php echo caption('Google_Map');?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input required type="text" placeholder="<?php echo caption('Enter_Embedded_Here');?>" name="gmap" class="form-control" />
                        </div>
                    </div>

            		<hr>

                    <?php
                        $value=caption('Save');
                        $name="submit_map";
                        $class="btn-primary";

                        if (count($theme_data)>0) {
                            $value=caption('Update');
                            $name="update_map";
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
        <!--===============================Google Map Section End here=========================================-->
        <!--===================================================================================================-->
    </div>
        
</div>