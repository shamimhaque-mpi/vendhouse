<section class="container" ng-controller="userAccountCtrl">
    <div class="panel panel-default" style="margin-top: 30px;">
        <?php echo $this->session->flashdata('confirmation'); ?>
		<div class="panel-heading user_header">
			<h3>Update Password</h3>
		</div>
		
        <!-- Order Panel -->
		<div class="panel-body">
			<div class="row">
			    <?php
                    $this->load->view('frontend/include/user_aside', $this->data);
        	    ?>
				<div class="col-md-offset-1 col-md-7" style="margin-top: 15px;">
                    <?php echo form_open('subscriber/settings/updatePassword'); ?>
					<div class="form-group">
                        <label>New Password</label>
					    <input type="password" ng-model="password" name="password" required class="form-control">
					</div>
					<div class="form-group" >
                        <label>Confirm Password</label>
					     <input type="password" ng-model="cpassword" required ng-keyup="matchPassword()" class="form-control">
					     <span ng-model="warnning" style="color: #ff0000;display: {{none}};">Password is not match!</span>
					</div>
					<div class="form-group">
                        <input ng-if="disabledbtn == true;" type="submit" name="updatePassword" disabled  class="btn btn-success" value="Update">
				        <input ng-if="disabledbtn == false;" type="submit" name="updatePassword" class="btn btn-success" value="Update">
					</div>
                    <?php echo form_close(); ?>
				</div>
		    </div>
	    </div>
    </div>
</section>
