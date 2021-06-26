<style>
    @media print{
        aside{
            display: none !important;
        }
        nav{
            display: none;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .none{
            display: none;
        }
        .panel-heading{
            display: none;
        }

        .panel-footer{
            display: none;
        }
        .panel .hide{
            display: block !important;
        }
        .title{
            font-size: 25px;
        }
    }

    table tr.custom-row {}
    table tr.custom-row td {padding: 0;}
    table tr.custom-row td input{
    	width: 100%;
    	height: 34px;
    	border: none;
    	padding: 0 8px;
    }
    table tr.custom-submit-row td{
    	padding: 0;
    }
</style>

<div class="container-fluid" ng-controller="PrintBarcodeCtrl" ng-cloak>
    <div class="row">
        <?php  echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default none">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1>Print Barcode </h1>
                </div>
            </div>

            <div class="panel-body">
            	<!-- pre><?php print_r($proInfo); ?></pre -->

                <?php
                $attribute = array(
                    'name' => '',
                    'class' => 'form-horizontal'
                );
                echo form_open('', $attribute);
                ?>

        <div class="table-responsive">
		<table class="table table-bordered">
			<tr>
				<th>Product's Code</th>
				<th>Number of Barcode</th>
				<th>Sale Price</th>
				<th>Action</th>
			</tr>

			<tr class="custom-row" ng-repeat="row in codes">
				<td><input type="text" name="code[]" ng-model="row.code" placeholder="Code" required></td>
				<td><input type="number" name="quantity[]" ng-model="row.quantity" placeholder="Quantity" required></td>
				<td><input type="number" name="sale_price[]" ng-model="row.sale_price" placeholder="Sale Price" required></td>
				<td><a href="#" ng-click="removeRowFn($index)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
			</tr>

			<tr><td colspan="4">&nbsp;</td></tr>

			<tr class="custom-submit-row">
				<td colspan="3" class="text-right"><input type="submit" name="generateForm" value="Show" class="btn btn-primary"></td>
				<td><a href="#" class="btn btn-info" ng-click="addCodeFn()"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
			</tr>
		</table>
    </div>


                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>


        <?php if($products != null){ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class="pull-left">Barcode</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">
            	<!--pre><?php //print_r($products); ?></pre-->

            	<?php foreach($products as $key => $product){ ?>
            	<div class="table-responsive">
	        	<span class="none"><?php echo "Quantity : " . "<strong>". $product['quantity'] ."</stront>". " &nbsp;&nbsp;" ?></span>

	                <table class="table table-bar">
	                    <?php
	                    $count = 0;
	                    for($i=0;$i<$product['row'];$i++){
	                    ?>
	                    <tr>
	                        <?php
	                        for($j=0;$j<$product['column'];$j++){
	                            if($count < $product['quantity']) {
	                        ?>
	                        <td style="position: relative; text-align: center; font-weight: normal;">
	                            <span style="width: 100%; display: block; text-align: center; position: absolute; top: 0; font-size: 9px;"><b>Grand Bazaar &nbsp; &nbsp;</b></span>
	                            <?php if($product['productInfo'] != null) { ?>
			                    <span style="display: block; text-align: center; margin-top: 5px; margin-bottom: -13px; font-size: 9px; position: relative;"><?php echo $product['productInfo']['product_name']; ?></span>
			            <?php } ?>
	                            <img class="barcode img-responsive" src="<?php echo $product['img']; ?>" style="max-width: 164px; margin: 6px auto 0; height: 30px;">
	                            <div style="margin-top: 0; font-size: 11px;">
	                            	<?php if($product['productInfo'] != null) { ?>
			                    <span style="display: block; text-align: center;"><?php echo $product['productInfo']['bar_code']; ?></span>
			                    <span style="display: block; text-align: center; position: relative; margin-top: -5px; margin-bottom: -5px; font-size: 10px;"><?php echo $product['productInfo']['subcategory']; ?></span>
			                    <?php if($product['sale_price'] > 0) { ?>
                                     <span style="display: block; text-align: center; font-size: 12px;"><b>TK-<?php echo $product['sale_price']; ?></b></span>
                                <?php } ?>
			                <?php } ?>
	                            </div>

	                            <span style="margin-bottom: 5px;"></span>

	                            <!-- ?php // echo $count; ? -->

	                        </td>
	                        <?php } else { ?>
	                        <td>&nbsp;<?php // echo $count; ?></td>
	                        <?php
	                            }
	                            $count ++;
	                        }
	                        ?>
	                    </tr>
	                    <?php } ?>
	                </table>
                </div>
                <?php } ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>
    </div>
</div>
