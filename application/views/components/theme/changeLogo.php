<div class="container-fluid">
    <div class="row">
        <?php
        	//echo $confirmation;
        	$logo = null;
        	$menu_icon = null;
            if (isset($meta->logo)) {
            	$logo=json_decode($meta->logo,true);
            }
            if (isset($meta->menu_icon)) {
            	$menu_icon=json_decode($meta->menu_icon,true);
            }
		?>


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


        <!-- ================================================================================ -->
        <!-- ===========================Change Faveicon start here=========================== -->
        <!-- ================================================================================ -->

        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Change_Favicon');?></h1>
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
			            		<div class="form-group">
								    <label class=" control-label" style="line-height: 4;"><?php echo caption('Favicon');?></label>
								    <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="false" data-show-upload="false" required data-show-remove="false">
								</div>

			        <?php
                        $value=caption('Save');
                        $name="submit_fevicon";
                        $class="btn-primary";

                        if ($logo!=null) {
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
        <!-- ==============================    App Upload    ================================ -->
        <!-- ================================================================================ -->

        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>App Upload</h1>
                </div>
            </div>

            <div class="panel-body">

	        	<div class="row">
	        		<div class="col-xs-12">
	        		    <div class="col-md-4"></div>
			        	<div class="col-md-6">
        	        	    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        	        	        <!--isset($meta->app)-->
        	            		<div class="form-group">
        	            		    <a href="<?=site_url(isset($meta->app) ? $meta->app : '')?>"><?=site_url(isset($meta->app) ? $meta->app : '')?></a>
        	            		    <br>
        						    <label class=" control-label" style="line-height: 4;">Application</label>
        						    <input  type="file" name="application" class="form-control file" data-show-preview="false" data-show-upload="false" required data-show-remove="false">
        						</div>
    
                                <div class="row">
            	                    <div class="btn-group pull-right">
            	                        <input type="submit" value="App Load" name="app" class="btn <?php echo $class; ?>">
            	                    </div>
                                </div>
                                
                            </form>
			        	</div>
	        		</div>
	        	</div>

	        </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <!-- ================================================================================ -->
        <!-- ===========================Change Faveicon end here============================= -->
        <!-- ================================================================================ -->



        <!--===================================================================================================-->
        <!--======================================Footer Section Start here======================================-->
        <!--===================================================================================================-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Logo_Footer_Setting');?></h1>
                </div>
            </div>

            <div class="panel-body">
        		 <?php
                    $attr=array(
                        "class"=>"form-horizontal"
                    );
                    echo form_open_multipart('', $attr);
                 ?>

                    <input type="hidden" name="footer_img"  value="<?php echo $footer_info['footer_img']; ?>" >
                    <!-- <input type="hidden" name="old_foot_img" value="<?php // echo $footer_info['footer_img']; ?>"   "> -->
                    <div class="form-group">
                        <div class="col-md-12">&nbsp;</div>
                        <div class="col-md-6" >
                            <img src="<?php echo site_url($footer_info['footer_img']); ?>" alt="Image not found!" style="float: right; width: 200px; height: 200px; background: rgba(0,0,0,.5); padding: 5px; margin: 0px 35px;">
                        </div>
                        <div class="col-md-12">&nbsp;</div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo caption('Logo');?></label>
                        <div class="col-md-5" >
                            <input id="input-test" type="file" name="fImage" class="form-control file" data-show-preview="false" data-show-upload="false" data-show-remove="false">
                        </div>
                    </div>

                    <div class="form-group hide">
                        <label class=" col-md-3 control-label"><?php echo caption('Header_Text');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $footer_info['header_txt']; ?>" name="header_txt" class="form-control">
                        </div>
                    </div>

                    <div class="form-group hide">
                        <label class=" col-md-3 control-label"><?php echo caption('Last_Footer_Text');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $footer_info['l_footer_text']; ?>" name="l_footer_text" class="form-control">
                        </div>
                        <div class="col-md-12">&nbsp;</div>
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <fieldset>
                    <div class="col-md-12">&nbsp;</div>
                    <legend><?php echo caption('Footer_Address');?></legend>
                        <div class="form-group">
                            <label class=" col-md-3 control-label"><?php echo caption('Mobile');?></label>
                            <div class="col-md-5">
                                <input type="text" value="<?php echo $footer_info['addr_moblile']; ?>" name="addr_moblile" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-md-3 control-label">Admin Mobile</label>
                            <div class="col-md-5">
                                <input type="text" value="<?php echo $footer_info['admin_mobile']; ?>" name="admin_mobile" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-md-3 control-label"><?php echo caption('Email');?></label>
                            <div class="col-md-5">
                                <input type="text" value="<?php echo $footer_info['addr_email']; ?>" name="addr_email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-md-3 control-label"><?php echo caption('Address');?></label>
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
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-12">&nbsp;</div>


            <div class="panel-body">
                 <?php
                    $attr=array(
                        "class"=>"form-horizontal"
                    );
                    echo form_open_multipart('', $attr);
                 ?>

                    <div class="form-group">
                        <label class=" col-md-3 control-label"><?php echo caption('Facebook');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $social_icon['s_facebook']; ?>" name="s_facebook" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-3 control-label"><?php echo caption('Twitter');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $social_icon['s_twitter']; ?>" name="s_twitter" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-3 control-label"><?php echo caption('Google_Plus');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo $social_icon['s_gplus']; ?>" name="s_gplus" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-3 control-label"><?php echo caption('Pinterest');?></label>
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

        <!--========================Social Icon Section End here=========================-->





        <!-- ===================== Voucher Header Secition Start Here ================== -->

        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Voucher_Header');?></h1>
                </div>
            </div>
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-12">&nbsp;</div>

            <div class="panel-body">
                 <?php
                    $attr=array(
                        "class"=>"form-horizontal"
                    );
                    echo form_open('theme/themeSetting/editVheader/', $attr);
                    //print_r($records);
                 ?>
                    <input type="hidden" name="id" value="<?php echo ($vheaderInfo !=null)?$vheaderInfo[0]->id:"0"; ?> ">
                    <div class="form-group">
                        <label class=" col-md-3 control-label"><?php echo caption('Name');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo($vheaderInfo != null)? $vheaderInfo[0]->name:" "; ?>" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-3 control-label"><?php echo caption('Mobile');?></label>
                        <div class="col-md-5">
                            <input type="text" value="<?php echo ($vheaderInfo !=null)? $vheaderInfo[0]->mobile:" "; ?>" name="mobile" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-3 control-label"><?php echo caption('Address');?></label>
                        <div class="col-md-5">
                            <textarea  rows="5" name="address" class="form-control"><?php echo ($vheaderInfo != null)? $vheaderInfo[0]->address:" "; ?></textarea>
                        </div>
                    </div>

                    <div class="btn-group pull-right">
                        <input type="submit" value="Update" name="update_vo_header" class="btn btn-success">
                    </div>
                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

        <!-- ===================== Voucher Header Secition End Here ================== -->



        <!-- ===================== Voucher Footer Secition Start Here ================== -->

        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Voucher_Footer');?></h1>
                </div>
            </div>
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-12">&nbsp;</div>

            <div class="panel-body">
                 <?php
                    $attr=array(
                        "class"=>"form-horizontal"
                    );
                    echo form_open('theme/themeSetting/editVfooter/', $attr);
                 ?>

                   <input type="hidden" name="id" value="<?php echo ($vfooterInfo !=null)?$vfooterInfo[0]->id:"0"; ?>">

                    <div class="form-group">
                        <label class=" col-md-3 control-label"><?php echo caption('Messages');?></label>
                        <div class="col-md-5">
                            <textarea value="" rows="4" name="message" class="form-control"><?php echo ($vfooterInfo != null)? $vfooterInfo[0]->message:" "; ?></textarea>
                        </div>
                    </div>

                    <div class="btn-group pull-right">
                        <input type="submit" value="Update" name="update_vo_footer" class="btn btn-success">
                    </div>
                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

        <!-- ===================== Voucher Footer Secition End Here ================== -->
