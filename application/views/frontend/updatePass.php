<div class="container" style="padding: 50px;">
	<div class="row">
		<div class="col-sm-offset-4 col-sm-4">
                <?php
                	echo $this->session->flashdata('confirmation');
	                $attr=array('class'=>'form-horizontal');
	                echo form_open('frontend/home/updatePass',$attr);
                ?>

                <div class="panel panel-default">
                    <div class="panel-body">   

                        <div class="form-group " style="margin:10px 15px">
                            <h4 class="col-sm-12 " style="padding:0">আপনার মোবাইল নাম্বার লিখুন</h4>
                            <div class="input-group  col-sm-12" >
                                <input type="text" name="mobile"  class="form-control" placeholder="মোবাইল নাম্বার">
                            </div>
                        </div>

	                    <div class="col-md-12">
	                        <div class="btn-group pull-right" style="width: 100%;">
	                            <input type="submit" value="সেন্ড পাসওয়ার্ড" name="sendSms" class="form-control btn btn-primary btn-yellow btn-blue">
	                        </div>
	                    </div>
                    </div>
                </div>

			<?php echo form_close(); ?>
		</div>
	</div>
</div>