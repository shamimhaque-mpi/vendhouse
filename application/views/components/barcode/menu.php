<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
		<a href="<?php echo site_url('barcode/barcodeGenerate'); ?>" class="btn btn-default" id="barcodegen">
			Barcode Print
		</a>
		
	<?php /*	<a href="<?php echo site_url('barcode/barcodeGenerate/rangeBarcode'); ?>" class="btn btn-default" id="range">
			Barcode Print Serially
		</a> */ ?>
			
		<a href="<?php echo site_url('barcode/barcodeSetting'); ?>" class="btn btn-default" id="setting">
			Barcode Generate
		</a>
		
    </div>
</div>