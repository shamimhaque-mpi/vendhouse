<div class="container-fluid">
    <div class="row">
        <?php echo $confirmation; 
            $logo=json_decode($theme_data[0]->logo,true);
            $menu_icon=json_decode($theme_data[0]->menu_icon,true);
		?>
        <!-- ================================================================================ -->
        <!-- =============================Change Logo start here============================= -->
        <!-- ================================================================================ -->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Change_Logo');?></h1>
                </div>
            </div>

            <div class="panel-body">
            
	        	<div class="row">
	        		<div class="col-xs-12">
	        			<div class="col-md-4">
			        		<figure>
			        			<img src="<?php echo site_url($logo['logo']); ?>" alt="Image not found!" style="width: 150px; height: 150px; display: block; margin: 0 auto;">
			        			<figcaption></figcaption>
			        		</figure>
			        	</div>


			        	<div class="col-md-6">

	        		<?php
		        		$attr=array(
							"class"=>"form-horizontal"
		        		);
		        		echo form_open_multipart('', $attr);
	        		?>
	        					<input type="hidden" value="<?php echo $logo['faveicon']; ?>" name="faveicon" />
	        					<input type="hidden" value="<?php echo $logo['logo']; ?>" name="old_logo" />
	        					<input type="hidden" value="<?php echo $theme_data[0]->id; ?>" name="theme_id" />
			            		<div class="form-group">
								    <label class=" control-label" style="line-height: 4;"><?php echo caption('Logo');?></label>
								    <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="false" data-show-upload="false" required data-show-remove="false">
								</div>
			                   
			        <?php
                        $value=caption('Save');
                        $name="submit_logo";
                        $class="btn-primary";

                        if (count($theme_data)>0) {
                            $value= caption('Update');
                            $name="update_logo";
                            $class="btn-success";
                        }
                    ?>
                    <div class="row">
	                    <div class="btn-group pull-right">
	                        <input type="submit" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="btn <?php echo $class; ?>">
	                    </div>
                    </div>
                <?php echo form_close(); ?>
			        	</div>
	        		</div>
	        	</div>
	                  
	        </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <!-- ================================================================================ -->
        <!-- =============================Change Logo start here============================= -->
        <!-- ================================================================================ -->

        <!-- ================================================================================ -->
        <!-- ===========================Change Faveicon start here=========================== -->
        <!-- ================================================================================ -->

        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Change_Faveicon');?></h1>
                </div>
            </div>

            <div class="panel-body">
            
	        	<div class="row">
	        		<div class="col-xs-12">
	        			<div class="col-md-4">
			        		<figure>
			        			<img src="<?php echo site_url($logo['faveicon']); ?>" alt="Image not found!" style="width: 150px; height: 150px; display: block; margin: 0 auto;">
			        			<figcaption></figcaption>
			        		</figure>
			        	</div>


			        	<div class="col-md-6">

	        		<?php
		        		$attr=array(
							"class"=>"form-horizontal"
		        		);
		        		echo form_open_multipart('', $attr);
	        		?>
	        					<input type="hidden" value="<?php echo $logo['logo']; ?>" name="logo" />
	        					<input type="hidden" value="<?php echo $logo['faveicon']; ?>" name="old_faveicon" />
	        					<input type="hidden" value="<?php echo $theme_data[0]->id; ?>" name="theme_id" />
			            		<div class="form-group">
								    <label class=" control-label" style="line-height: 4;"><?php echo caption('Faveicon');?></label>
								    <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="false" data-show-upload="false" required data-show-remove="false">
								</div>
			                   
			        <?php
                        $value=caption('Save');
                        $name="submit_fevicon";
                        $class="btn-primary";

                        if (count($theme_data)>0) {
                            $value=caption('Update');
                            $name="update_fevicon";
                            $class="btn-success";
                        }
                    ?>
                    <div class="row">
	                    <div class="btn-group pull-right">
	                        <input type="submit" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="btn <?php echo $class; ?>">
	                    </div>
                    </div>
                <?php echo form_close(); ?>
			        	</div>
	        		</div>
	        	</div>
	                  
	        </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <!-- ================================================================================ -->
        <!-- ===========================Change Faveicon end here============================= -->
        <!-- ================================================================================ -->

        <!-- ================================================================================ -->
        <!-- ==========================Change Menu Icon start here=========================== -->
        <!-- ================================================================================ -->
	    <?php
	        $value=caption('Save');
	        $name="submit_menu_icon";
	        $class="btn-primary";

	        if (count($theme_data)>0) {
	            $value=caption('Update');
	            $name="update_menu_icon";
	            $class="btn-success";
	        }
	    ?>
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Menu_Icon');?></h1>
                </div>
            </div>

            <div class="panel-body">
            
	        	<div class="row">
        			<?php
		        		$attr=array(
							"class"=>"form-horizontal"
		        		);
		        		echo form_open_multipart('', $attr);
	        		?>
	        		<div class="col-xs-12">
			        	<div class="col-md-6">
							<input type="hidden" value="<?php echo $theme_data[0]->id; ?>" name="theme_id" />
		                    <div class="form-group">
		                        <label class=" col-md-4 control-label"><?php echo caption('A_Side_Menu');?> <span class="req"><i class="<?php echo $menu_icon['aside_menu'];?>"></i></span></label>
		                        <div class="col-md-8">
		                            <input type="text" value="<?php echo $menu_icon['aside_menu'];?>" placeholder="Only Fontawesome Class name here" name="aside_menu" class="form-control">
		                        </div>
		                    </div>
			        	</div>
			        	<div class="col-md-6">
		                    <div class="form-group">
		                        <label class=" col-md-4 control-label"><?php echo caption('Footer_Menu');?> <span class="req"><i class="<?php echo $menu_icon['footer_menu'];?>"></i></span></label>
		                        <div class="col-md-8">
		                            <input type="text" value="<?php echo $menu_icon['footer_menu'];?>" placeholder="Only Fontawesome Class name here" name="footer_menu" class="form-control">
		                        </div>
		                    </div>
				                   
		                    <div class="btn-group pull-right">
		                        <input type="submit" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="btn <?php echo $class; ?>">
		                    </div>
			        	</div>
	        		</div>
	        		<?php echo form_close(); ?>
	        	</div>
	                  
	        </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <!-- ================================================================================ -->
        <!-- ==========================Change Menu Icon end here============================= -->
        <!-- ================================================================================ -->
    </div>
</div>