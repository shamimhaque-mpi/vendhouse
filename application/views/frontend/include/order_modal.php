<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<style>
	.table-inner {width: 100%;}
	.table-inner tr {}
	.table-inner tr td {width: 25%;padding: 8px !important;border-right: 1px solid #ddd;}
	.table-inner tr td:nth-of-type(4){border-right: none;}
	.table-inner input{border: 1px solid #ddd;padding: 5px;border-radius: 4px;width: 87%;}
	.req {color: red;}
	.modal.order-popup {
	    
	}
</style>
<div class="wrapper clearfix">
    <!-- Order Form -->
    <div class="modal fade order-popup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      	<div class="modal-dialog modal-lg" role="document" style="max-width:1000px; padding-bottom: 45px;">
        	<div class="modal-content">
          		<div class="modal-header">
    		        <button type="button" class="close"
    		        	data-dismiss="modal" aria-label="Close">
    		        	<span aria-hidden="true">&times;</span>
    		        </button>
    	        	<h4 class="modal-title" id="gridSystemModalLabel">অর্ডারের তালিকা</h4>
                </div>
                
    			<?php
    			/*
    				$attr = array("class" => "form-horizontal order-form", "id" => "order-form");
    				echo form_open("frontend/home/add_order",$attr);
    			*/
    			?>
    			
    			<form class="form-horizontal order-form" id="order-form" data-socket="<?php echo base64_encode(site_url('frontend/home/add_order'));?>">
    				<div class="modal-body clearfix">
                        <!--div class="pull-left">
                            <b style="color:red;"> {{ warning_message }}</b>
                        </div-->
                        <!-- <label class="control-label" style="width: 100%;text-align: center;color: #3B62E5;font-weight: 800;font-size: 20px;margin: 0 0 20px 0;">ডেলিভারি চার্জ ২০ টাকা, ৩০০ টাকার বেশি  অর্ডার দিলে  ডেলিভারি চার্জ ফ্রি । </label> -->
    
    				 	<div class="pull-right" style="width: 300px;margin-bottom: 15px;">
    		        		<label class="control-label" style="width: 152px;float:left;text-align:left;padding-left: 0;">অর্ডারের তারিখ : </label>
    		        		 <div class="input-group date" id="datetimepicker" style="width: 147px;">
    	                        <input type="text" readonly name="order_date" value="<?php echo date("Y-m-d"); ?>" class="form-control" placeholder="YYYY-MM-DD">
    
    	                        <span class="input-group-addon">
    	                            <span class="glyphicon glyphicon-calendar" disable></span>
    	                        </span>
    	                    </div>
    		        	</div>
    
        				<div class="tableResponsive clearfix">
        		        	<table class="table table-bordered order_table">
        		        		<tr>
        		        			<th>ক্র.নং</th>
        		        			<th width="380">পণ্য</th>
        		        			<th width="100">কোড</th>
        		        			<th>মূল্য</th>
        		        			<th>ছাড়</th>
        		        			<th>পরিমাণ</th>
        		        			<th>একক </th>
        		        			<th width="100">মোট</th>
        		        			<th class="none" style="width: 50px;">একশন</th>
        		        		</tr>
        		        	
        		        		<tr ng-repeat="item in productInfoInCart">
        		        			<td style="padding: 6px 8px !important">{{ $index + 1 }}</td>
        
        		        			<td>
        		        				<input type="text" name="product_name[]"
        		        					class="form-control"
        		        					value="{{item.product_name}}" readonly>
        		        			</td>
        
                                    <td>
        		        				<input type="text" name="product_code[]"
        		        					class="form-control"
        		        					value="{{item.product_code}}" readonly
        		        				>
        	        					<input type="hidden" name="color[]" ng-value="item.product_color">
        	        					<input type="hidden" name="size[]" ng-value="item.product_size">
        		        			</td>
        
        		        			<td style="width: 150px;">
        		        				<input type="text" name="price[]"
        		        					ng-model="item.sale_price"
        		        					class="form-control" readonly>
        		        			</td>
        
        		        			<td style="width: 150px;">
        		        				<input type="text" name="discount_product_wise[]"
        		        					ng-model="item.discount"
        		        					class="form-control" readonly>
        		        			</td>
        
        		        			<td>
        		        				<input type="number" step="any"
        		        					ng-model="item.quantity"
        		        					name="quantity[]" class="form-control"
        		        					min='0' required>
        		        			</td>
        
        		        			<td>
        		        				<input type="text" name="unit[]"
        		        					value="{{item.unit}}"
        		        					class="form-control" readonly>
        		        				</td>
        
        		        			<td>
        		        				<input type="number" name="sub_total[]"
        		        					ng-value="getSubtotal($index)"
        		        					class="form-control" readonly>
        		        			</td>
        
        		        			<td class="text-center">
        		        				<a class="btn btn-danger" ng-click="deleteItemFromCartFn($index)" title="ডিলিট" href="#">
        		        					<i class="fa fa-trash-o" aria-hidden="true"></i>
        		        				</a>
        		        			</td>
        		        		</tr>
        		        		<tr>
        		        			<td style="padding: 8px !important" colspan="7" class="text-right">
        		        				<strong>মোট</strong>
        		        			</td>
        
        		        			<td style="padding: 8px !important" colspan="2">
        		        			   <strong>{{ grandTotal() }}</strong>
        		        			   <input type="hidden" name="total_amount" value="{{ grandTotal() }}"> টাকা
        		        			</td>
        		        		</tr>
        						<?php if($coupon != NULL && $coupon[0]->coupon_discount > 0) { ?>
        			        		<tr>
        			        			<td colspan="4" style="border-right: none;"></td>
        			        			<th class="text-right" style="border-left:none; width:111px;">কুপন কোড</th>
        			        			<td colspan="2"><input type="text" name="coupon" ng-model="coupon" ng-change="calculateDiscount();" class="form-control" placeholder="কুপন কোড"></td>
        			        			<td colspan="2" style="padding: 8px !important;">
        									<b>{{ discount }} </b>টাকা
        									 <input type="hidden" name="discount" value="{{ discount }}">
        								</td>
        			        		</tr>
        					   <?php } ?>
        		        		<tr>
        		        			<td style="padding: 8px !important;" colspan="7" class="text-right">
        		        				<strong>ডেলিভারি চার্জ</strong>
        		        			</td>
        
        		        			<td style="padding: 8px !important;" colspan="2">
        		        			   <strong >{{ deliveryCharge() }}</strong>
        		        			    টাকা
                                        <input type="hidden" name="delivery_charge" value="{{ deliveryCharge() }}">
                                        <!--<input type="hidden" name="delivery_charge" ng-value="delivery_charge">-->
        		        			</td>
        		        		</tr>
        		        		<tr>
        		        			<td style="padding: 8px !important;" colspan="7" class="text-right">
        		        				<strong>সর্বমোট</strong>
        		        			</td>
        
        		        			<td style="padding: 8px !important;" colspan="2">
        		        			   <strong>{{ GetgrandTotal() }}</strong>
        		        			   <input type="hidden" name="grand_total" value="{{ GetgrandTotal() }}"> টাকা
        		        			</td>
        		        		</tr>
        		        	</table>
        		        </div>
        				<div class="col-md-12">
        					<div class="row">
        						<div class="col-md-6">
        							<div class="row">
        		                        <div class="form-group">
        		                            <label class="control-label col-md-4">মোবাইল <span class="req">*</span></label>
        		                            <div class="col-md-7">
        		                                <?php if($this->session->userdata('subscriberLoggedin') == 1){ ?>
        		                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">+88</span>
                                                       	<input type="text" name="mobile"  id="mobile_no"  aria-describedby="basic-addon1"  placeholder="ইংরেজীতে মোবাইল নাম্বার লিখুন"  class="form-control" value="<?php echo $this->session->userdata('mobile'); ?>" required readonly>
                                                    </div>
        		                                <?php }else{ ?>
        		                                   
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">+88</span>
                                                        <input type="text" name="mobile" id="mobile_no" ng-model="mobile" aria-describedby="basic-addon1" ng-keyup="getCustomer()" placeholder="ইংরেজীতে মোবাইল নাম্বার লিখুন"  class="form-control" required>
                                                    </div>		                                
        		                                <?php } ?>
        		                                
        		                            </div>
        		                        </div>
        		                    </div>
        		                    <div class="row">
        								<div class="form-group">
        									<label class="control-label col-md-4">নাম <span class="req">*</span></label>
        									<div class="col-md-7">
        										<?php if($this->session->userdata('subscriberLoggedin') == 1){ ?>
        										   <input type="text" name="name" class="form-control" value="<?php echo $this->session->userdata('name'); ?>" required readonly>
        										<?php }else{ ?>
        										  <input type="text" name="name" class="form-control" ng-value="customerInfo.name" required>
        										<?php } ?>
        									</div>
        								</div>
        							</div>
        							<div class="row">
        					        	<div class="form-group">
        					        		<label class="control-label col-md-4">ঠিকানা <span class="req">*</span></label>
        					        		<div class="col-md-7">
        		                                <?php if($this->session->userdata('subscriberLoggedin') == 1){ ?>
        		                                  <textarea id="address" name="address" rows="3" class="form-control" required readonly><?php echo $this->session->userdata('address'); ?></textarea>
        		                                <?php }else{ ?>
        		                                  <textarea id="address" name="address" rows="3" class="form-control" required>{{ customerInfo.address }}</textarea>
        		                                <?php } ?>
        					        		</div>
        					        	</div>
        					        </div>
        							<div class="row">
        					        	<div class="form-group">
        								    <label class="control-label col-md-4">মূল্যপরিশোধ পদ্ধতি <span class="req">*</span></label>
        								    <div class="col-md-7">
        								    	<select class="form-control" ng-model="payment_method" ng-init="payment_method = ''" ng-change="paymentmethod(payment_method);changeDeliveryChargeFn()" name="method" required>
        									    	<option value="">--পদ্ধতি নির্বাচন করুন--</option>
        									    	<option value="bKash">বিকাশ</option>
        									    	<option value="nagad">নগদ</option>
        									    	<option value="Rocket">রকেট</option>
        									    	<option value="office_collection">অফিস কালেকশন</option>
        									    	<option ng-hide="POS_Card_Status" value="POS_Card">পজ কার্ড</option>
        									    	<!--<option ng-hide="global_category" value="Cash_on_Delivery">ক্যাশ অন ডেলিভারি</option>-->
        									    </select>
        									</div>
        								</div>
        					        </div>
        					        <div class="row" ng-if="payment_method=='bKash' || payment_method=='Rocket' || payment_method=='nagad'">
        					            <div class="form-group">
                                            <label class="control-label col-md-4">ট্রানজেকশান নম্বর <span class="req">*</span></label>
                                            <div class="col-md-7">
                                                <input type="text" name="transition_mobile" placeholder="ট্রানজেকশান মোবাইল নম্বর" class="form-control" required>
                                            </div>
                                        </div>
        					        </div>
        					        <div class="row" ng-if="payment_method=='bKash' || payment_method=='Rocket' || payment_method=='nagad'">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">ট্রানজেকশান আইডি <span class="req">*</span></label>
                                            <div class="col-md-7">
                                                <input type="text" name="account" class="form-control" required>
                                            </div>
                                            <div class="col-sm-11">
                                                <p style="text-align:right; color: #078593; font-weight: 600; font-size: 13px; margin: 5px 0 0;">আপনার বকেয়া {{ method_name }} নাম্বারে প্রদান করুন </p>
                                                <p style="text-align:right; color: #078593; font-weight: 600; font-size: 13px;"><span style="display: block;" ng-repeat="payment in paymentMethods">{{ payment.number }} ({{ payment.type }})</span></p>
                                            </div>
                                        </div>
                                    </div>
        						</div>
        						
        						<div class="col-md-6">
        						    <div class="row">
        						        <div class="form-group">
            							    <label class="control-label col-md-4">ডেলিভারি টাইম</label>
            							    <div class="col-md-8">
                							    <div class="input-group date" id="datetimepicker2">
                                                    <input type="text" name="delivary_time" class="form-control" placeholder="">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                            </div>
            							</div>
        						    </div>
        							<script>
        							    $('#datetimepicker').datetimepicker({
                                            format: 'YYYY-MM-DD'
                                        });
                                            
                                        $('#datetimepicker2').datetimepicker({
                                            format: 'LT'
                                        });
        					        </script>
        					        
        							<div class="row">
        								<div class="form-group">
        									<label class="control-label col-md-4">জেলা <span class="req">*</span></label>
        									<div class="col-md-8">
        										<?php
        										    $districts = read('districts');
        										    $user = read('registration', ['id'=>$this->session->userdata('id')]);
        										?>
        										<select name="district" class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith" ng-model="district_id"  ng-init="district_id='<?php echo ($user ? $user[0]->district_id : '')?>'">
        										    <option value="">-- জেলা নির্বাচন করুন --</option>
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
        								<div class="form-group">
        									<label class="control-label col-md-4">শহর <span class="req">*</span></label>
        									<div class="col-md-8">
        										<!--<select class="form-control" ng-model="city" name="city" ng-change="getUpazilla();" required>-->
        										<select name="city" class="form-control" ng-model="upazila_id" ng-init="upazila_id='<?php echo ($user ? $user[0]->upazilla_id : '')?>'" ng-change="changeDeliveryChargeFn(upazila_id)">
        										    <option value="">-- উপজেলা নির্বাচন করুন --</option>
        											<option ng-repeat="row in areas" value="{{ row.id }}">{{ row.name | textBeautify }},  ({{ row.zip_code }})</option>
        										</select>
        									</div>
        								</div>
        							</div>
        
        					        <div class="row">
        					        	<div class="form-group">
        					        		<label style="font-size: 13px;" class="control-label col-md-4">
        					        		    পাঠানোর ঠিকানা
        					        		    <span class="req">*</span>
        					        		    <span>ঠিকানা হিসাবে একই&nbsp; <input id="same" type="checkbox"></span>
        					        		</label>
        					        		<div class="col-md-8">
        		                                <?php if($this->session->userdata('subscriberLoggedin') == 1){ ?>
        		                                  <textarea id="sopping" name="shipping_address" rows="3" class="form-control" required><?php echo $this->session->userdata('address'); ?></textarea>
        		                                <?php }else{ ?>
        		                                  <textarea id="sopping" name="shipping_address" rows="3" class="form-control" required>{{ customerInfo.address }}</textarea>
        		                                <?php } ?>
        					        		</div>
        					        	</div>
        					        	<?php
            					        	function add($x, $y) { return $x + $y; }
                                            function subtract($x, $y) { return $x - $y; }
                                            function multiply($x, $y) { return $x * $y; }
                                            
                                            $operators      = array('add', 'subtract', 'multiply');
                                            $operators_sym  = ['add' => '+', 'subtract' => '-', 'multiply' => '&times;'];
                                            
                                            $operator = $operators[array_rand($operators)];
                                            
                                            $x = rand(0, 9);
                                            $y = rand(0, 9);
                                            
                                            $result = call_user_func_array($operator, array($x, $y));
                                            
        					        	?>
        					        	<!--<div class="form-group">
        					        		<label style="font-size: 13px;" class="control-label col-md-4">
        					        		    <?= $x ?> <?= $operators_sym[$operator] ?> <?= $y ?> = ?
        					        		</label>
        					        		<div class="col-md-8">
        					        		    <input id="result_input" data-blum="<?= base64_encode($result) ?>" class="form-control" required>
        					        		</div>
        					        	</div>-->
        					        </div>
        
                                   <?php if($this->session->userdata('srLoggedin') == 1){ ?>
        							<div class="row">
        							 <div class="form-group">
        								 <label style="font-size: 13px;" class="control-label col-md-4">এস আর  এর নাম <span class="req">*</span></label>
        								 <div class="col-md-8">
        									   <input type="text" name="sr_name" class="form-control" value="<?php echo $this->session->userdata('name'); ?>" readonly>
        									   <input type="hidden" name="sr_code" class="form-control" value="<?php echo $this->session->userdata('code'); ?>">
        								</div>
        							 </div>
        						   </div>
        						 <?php } ?>
        						</div>
        					</div>
        				</div>
    				</div>
    			    <div class="modal-footer">
    			       	<!--<button type="submit" class="btn btn-success" id="submit_btn" ng-click="clearLocalStorageFn();">অর্ডার</button>-->
    			       	<button type="submit" class="btn btn-success" id="submit_btn" ng-disabled="isDisabled" ng-init="isDisabled=false">অর্ডার</button>
    			       	<button type="reset" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
    			    </div>
                </form>
      		    <?php /* echo form_close(); */ ?>
    	    </div>
    	</div>
    </div>
	<!-- End Order Form -->



	<!-- Order Quantity -->
	<div class="modal fade product-pupup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        	<span aria-hidden="true">&times;</span>
		        </button>
		        <h4 class="modal-title" id="gridSystemModalLabel">{{ productInfo.product_name }}</h4>
		        <p style="text-align:center; font-weight:bold;" ng-if="productInfo.unit == 'কেজি'">Get half Kg <strong>Write</strong> 0.50 and 250g <strong>Write</strong> 0.25 .</p>
		    </div>

		    <?php
		    $attr = array('class' => 'form-horizontal');
		    echo form_open('', $attr);
		    ?>
		    <div class="modal-body">
		    	<div class="form-group">
		    		<label class="control-label col-md-4">পরিমাণ ({{ productInfo.unit }} )*</label>
		    		<div class="col-md-7">
		    			<input type="number" name="quantity" ng-model="productInfo.quantity" ng-change="checkQtyFn(productInfo.quantity)" class="form-control" step="any" required min="0">
		    		</div>
		    	</div>

		    	<div class="form-group">
		    		<label class="control-label col-md-4">দাম &nbsp;</label>
		    		<div class="col-md-7">
		    			<input type="text" name="price"
		    				class="form-control"
		    				ng-model="productInfo.sale_price"
		    				readonly>
		    		</div>
		    	</div>
		    	
		    	<div ng-if="productInfo.color.length > 0 && productInfo.color !='' ">
                    <div class="form-group">
    		    		<label class="control-label col-md-4">Color &nbsp;</label>
    		    		<div class="col-md-7">
    		    		    <select class="form-control" name="color" ng-model="productInfo.product_color">
    		    		       <option ng-repeat="color in productInfo.color" value="{{ color }}">{{ color | textBeautify }}
                                </option> 
    		    		    </select>
    		    		</div>
    		    	</div>
		    	</div>
		    	
		    
		    	<div ng-if="productInfo.allSize.length > 0 && productInfo.allSize !='' ">
                    <div class="form-group">
    		    		<label class="control-label col-md-4">Size &nbsp;</label>
    		    		<div class="col-md-7">
    		    		    <select class="form-control" name="size" ng-model="productInfo.product_size">
    		    		       <option ng-repeat="size in productInfo.allSize" value="{{ size }}">{{ size | textBeautify }} </option> 
    		    		    </select>
    		    		</div>
    		    	</div>
		    	</div>
		    	
		    	<div class="form-group">
		    		<label class="control-label col-md-4">মোট &nbsp;</label>
		    		<div class="col-md-7">
		    			<input type="text" name="total" class="form-control" value="{{ productInfo.quantity * productInfo.sale_price }}"
		    				readonly>
		    		</div>
		    	</div>
		    </div>

		    <div class="modal-footer">
		        <button
		            ng-show="checkoutbtn"
		        	type="button" class="btn btn-default" style="background: #3B62E5; color:#FFFFFF;"
		        	ng-click="addToCartFn()"
		        	data-dismiss="modal">যোগ করুন</button>
		        	
		        <button
		            ng-show="!checkoutbtn"
		        	type="button" class="btn btn-default" style="background: #e54b3b; color:#FFFFFF;"
		        	>পরিমাণ চেক করুন (>0)</button>
		    </div>
		    <?php echo form_close(); ?>
	    </div>
	  </div>
	</div>
	<!-- End Order Quantity -->
    
    <span style="display:name" id="or_con"></span>

    


    <?php if($this->session->flashdata('complete') != NULL){ ?>
      <span id="order_check" data-con="<?php echo $this->session->flashdata('complete'); ?>"></span>
    <?php } ?>
    
    <?php if($this->session->flashdata('confirmation') != NULL){ ?>
      <script type="text/javascript">
        alert("<?php echo $this->session->flashdata('confirmation'); ?>");
      </script>
    <?php } ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    

    <script type="module" src="<?php echo site_url('private/js/validation/cartValidation.js')?>"></script>
