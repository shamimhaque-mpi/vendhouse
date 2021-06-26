<div class="container-fluid">
    <div class="row">
	<?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Add_Return_Sale'); ?></h1>
                </div>
            </div>

            <div class="panel-body" ng-controller="saleReturnCtrl">

                <?php $attr = array(
                    'class' =>'form-horizontal'
                    );
	            echo form_open('sale_return/sale_return',$attr); ?>
					<div class="row">
						<div class="form-group">
							<label class="col-md-3 control-label">Product Code <span class="req">*</span></label>
							
							<div class="col-md-5">
								<input type="text" name="product_code" ng-keyup="getInfo()" ng-model="product_code" placeholder="" class="form-control" required>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
							<label class="col-md-3 control-label">Product Name <span class="req">&nbsp;</span></label>
							
							<div class="col-md-5">
								<input type="text" name="product_name" placeholder="" ng-model="product_name" class="form-control" readonly>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
							<label class="col-md-3 control-label">Category <span class="req">&nbsp;</span></label>
							
							<div class="col-md-5">
								<input type="text" name="category" placeholder="" ng-model="product_cat" class="form-control" readonly>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
							<label class="col-md-3 control-label">Brand<span class="req">&nbsp;</span></label>
							
							<div class="col-md-5">
								<input type="text" name="subcategory" placeholder="" ng-model="subcategory" class="form-control" readonly>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
							<label class="col-md-3 control-label">Sale Price <span class="req">&nbsp;</span></label>
							
							<div class="col-md-5">
								<input type="number" placeholder="" ng-model="sale_price" class="form-control" readonly>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
							<label class="col-md-3 control-label">Return Quantity<span class="req">*</span></label>
							
							<div class="col-md-5">
								<input type="number" name="quantity" placeholder="" ng-value="0" ng-model="return_qty" min="0" class="form-control" required>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
							<label class="col-md-3 control-label">Return Amount<span class="req">&nbsp;</span></label>
							
							<div class="col-md-5">
								<input type="text" name="return_amount" placeholder="" ng-value="return_qty*sale_price" class="form-control" readonly>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-8">
							<div class="btn-group pull-right">
								<input type="submit" value="<?php echo caption('Save');?>" name="submit" class="btn btn-primary">
							</div>
						</div>
					</div>

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

