<section class="container">
    <div class="panel panel-default" style="margin-top: 30px;">
        <?php echo $this->session->flashdata('confirmation'); ?>
		<div class="panel-heading user_header">
			<h3>Update Account Information</h3>
		</div>
        
        <!--Information panel-->
		<div class="panel-body" ng-controller="userAccountCtrl">
			<div class="row">
			    <?php
                    $this->load->view('frontend/include/user_aside', $this->data);
                    $user = read('registration', ['id'=>$this->session->userdata('id')]);
        	    ?>
				<div class="col-md-9">
                    <?php echo form_open('subscriber/settings'); ?>
                    <div class="row" style="margin: 10px 0 !important">
                        <div class="col-md-6">
                             <div class="form-group">
							    <label>Name </label>
							    <input type="text" name="name" class="form-control" value="<?php echo $this->session->userdata('name'); ?>">
							 </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
							    <label>Mobile</label>
							    <input type="text" name="mobile" class="form-control" value="<?php echo $this->session->userdata('mobile'); ?>" readonly>
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
							    <label>Zilla</label>
							    <?php
								    $districts = read('districts');
								?>
								<select name="district_id" class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith" ng-model="district_id" ng-init="district_id='<?php echo $user[0]->district_id;?>'" ng-change="getUpazilaFn(district_id)">
								    <option value="">-- Select A Zilla --</option>
								    <?php
								        if($districts){
    							            foreach($districts as $district){
    							                echo "<option value='$district->id'>$district->name</option>";
    							            }
								        }
								    ?>
								</select>
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
							    <label>Upazilla</label>
							    <select name="upazilla_id" class="form-control" ng-model="upazila_id" ng-init="upazila_id='<?php echo $user[0]->upazilla_id;?>'">
								    <option value="">-- Select A Upazilla --</option>
									<option ng-repeat="row in areas" value="{{ row.id }}">{{ row.name | textBeautify }},  ({{ row.zip_code }})</option>
								</select>
							</div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
      						    <label>Address</label>
      							<textarea name="address" class="form-control" rows="3"><?php echo $this->session->userdata('address'); ?></textarea>
      						</div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
    						    <input type="submit" name="updateInfo"  class="btn btn-success pull-right" value="Update">
    						</div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
