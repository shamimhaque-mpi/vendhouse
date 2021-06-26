<section class="container">
	<div class="row">
	    <?php
            $this->load->view('frontend/include/user_aside', $this->data);
	    ?>
	    
        <!-- Order Panel -->
        <div class="col-md-9">
		    <div class="panel panel-default" style="margin-top: 30px;">
            <?php echo $this->session->flashdata('confirmation'); ?>
			<div class="panel-heading">
				<h3>আমার একাউন্ট</h3>
			</div>

			<div class="panel-body" ng-controller="userAccountCtrl" style="border-left: 2px solid #f5f5f5; border-right: 2px solid #f5f5f5; border-bottom: 2px solid #f5f5f5;">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal" action="#" method="post">
							<div class="row">
								<div class="col-md-12">
                                    <div>

                                      <!-- Nav tabs -->
                                      <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">সাম্প্রতিক অর্ডার</a></li>
                                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">সকল অর্ডার</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">ব্যক্তিগত তথ্য</a></li>
                                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">সেটিং</a></li>
                                      </ul>

                                      <!-- Tab panes -->
                                      <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="home">
                                           <?php if($currentOrder != null ){ ?>
                                            <table class="table table-striped table-bordered" style="margin-bottom: 0;">
                                                <tr>
                                                    <th width="40">ক্রঃনঃ</th>
                                                    <th width="200">তারিখ</th>
													<th>সময়</th>
                                                    <th>অর্ডার নং</th>
                                                    <th>মোট মূল্য</th>
													<th>অবস্থা</th>
                                                    <th width="40">একশন</th>
                                                </tr>

                                                <?php
                                                    $total = 0;
                                                    foreach ($currentOrder as $key => $value) {
                                                    $total +=$value->grand_total;
                                                ?>

                                                <tr>
                                                    <td><?php echo $key+1; ?></td>
                                                    <td><?php echo $value->order_date; ?></td>
                                                    <td><?php echo $value->time; ?></td>
                                                    <td><?php echo $value->order_no; ?></td>
                                                    <td><?php echo $value->grand_total; ?></td>
                                                    <td><?php echo filter($value->status); ?></td>
                                                    <td>
                                                        <a class="btn btn-warning" href="<?php echo site_url('subscriber/dashboard/productView?order_no='.$value->order_no) ;?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                <?php } ?>

												<tr>
                                                    <th colspan="3">&nbsp;</th>
                                                    <th class="text-right">মোট</th>
                                                    <th><?php echo $total; ?> টাকা</th>
													<th colspan="2">&nbsp;</th>
                                                </tr>
                                            </table>
                                            <?php } else{?>
                                            <h3 style="background: rgb(219, 44, 15);padding: 10px;color: #fff;font-size: 16px; text-align: center;" >অর্ডার ০ টি</h3>
                                            <?php } ?>

                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="messages">
                                         <?php if($allOrder != null ){ ?>
                                            <table class="table table-striped table-bordered" style="margin-bottom: 0;">
                                                <tr>
                                                    <th>ক্রঃনঃ</th>
                                                    <th>তারিখ</th>
                                                    <th>সময়</th>
                                                    <th>অর্ডার নং</th>
                                                    <th>মোট মূল্য</th>
													<th>অবস্থা</th>
                                                    <th width="40">একশন</th>
                                                </tr>

                                                <?php
                                                    $total = 0;
                                                    foreach ($allOrder as $key => $value) {
                                                    $total +=$value->grand_total;
                                                ?>

                                                <tr>
                                                    <td><?php echo $key+1; ?></td>
                                                    <td><?php echo $value->order_date; ?></td>
                                                    <td><?php echo $value->time; ?></td>
                                                    <td><?php echo $value->order_no; ?></td>
                                                    <td><?php echo $value->grand_total; ?></td>
													<td><?php echo filter($value->status); ?></td>
                                                    <td>
                                                        <a class="btn btn-warning" href="<?php echo site_url('subscriber/dashboard/productView?order_no='.$value->order_no) ;?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                <?php } ?>

                                                <tr>
                                                    <th colspan="3">&nbsp;</th>
                                                    <th class="text-right">মোট</th>
                                                    <th><?php echo $total; ?> টাকা</th>
													<th colspan="2">&nbsp;</th>
                                                </tr>
                                            </table>
                                            <?php } else{?>
                                            <h3 style="background: rgb(219, 44, 15);padding: 10px;color: #fff;font-size: 16px; text-align: center;" >অর্ডার ০ টি</h3>
                                            <?php } ?>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="profile" style="background: transparent !important;">
                                            <span>&nbsp;</span>
                                            <?php echo form_open('subscriber/dashboard'); ?>
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-4">
                                                    <div class="form-group">
                									    <label class="col-sm-3 control-label">নাম </label>
                									    <div class="col-sm-9">
                									      <input type="text" name="name"  class="form-control" value="<?php echo $this->session->userdata('name'); ?>">
                									    </div>
                									 </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                									    <label class="col-sm-3 control-label">মোবাইল</label>
                									    <div class="col-sm-9">
                									      <input type="number" name="mobile"   class="form-control" value="<?php echo $this->session->userdata('mobile'); ?>" readonly>
                									    </div>
                									</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                  									    <label class="col-sm-3 control-label">ঠিকানা</label>
                  									    <div class="col-sm-7">
                  											<textarea name="address" style="width: 100%;padding: 10px;" rows="3"><?php echo $this->session->userdata('address'); ?></textarea>
                  									    </div>
                  									  </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-8">
                                                    <div class="form-group">
                									    <div class="row">
                									      <input type="submit" name="updateInfo"  class="btn btn-success pull-right" style="margin-right: 4%;" value="পরিবর্তন করুন">
                									    </div>
                									</div>
                                                </div>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="settings" style="background: transparent !important;">
                                            <span>&nbsp;</span>
                                            <div class="row">
                								<div class="col-md-offset-3 col-md-6">
                                                    <?php echo form_open('subscriber/dashboard'); ?>
                									<div class="form-group">
                                                        <label class="col-sm-4 control-label">নতুন পাসওয়ার্ড</label>
                									    <div class="col-sm-8">
                									      <input type="password" ng-model="password" name="password" required class="form-control" placeholder="আপনার পাসওয়ার্ডটি লিখুন">
                									    </div>
                									  </div>
                									  <div class="form-group">
                                                          <label class="col-sm-4 control-label">কনফার্ম পাসওয়ার্ড</label>
                  									    <div class="col-sm-8">
                  									      <input type="password" ng-model="cpassword" required ng-keyup="matchPassword()" class="form-control" placeholder="অনুগ্রহ করে আরেকবার পাসওয়ার্ডটি লিখুন">
                  									      <span ng-model="warnning" style="color: #ff0000;display: {{none}};">Password is not match!</span>
                                                        </div>
                									  </div>
                									  <div class="form-group">
                									    <div class="col-sm-offset-4 col-sm-8">

                                                          <input ng-if="disabledbtn == true;" type="submit" name="updatePassword" disabled  class="btn btn-success" value="পরিবর্তন করুন">
                									      <input ng-if="disabledbtn == false;" type="submit" name="updatePassword" class="btn btn-success" value="পরিবর্তন করুন">
                									    </div>
                									  </div>
                                                    <?php echo form_close(); ?>
                								</div>
                							</div>
                                        </div>
                                      </div>
                                    </div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	    </div>
	</div>
</section>
