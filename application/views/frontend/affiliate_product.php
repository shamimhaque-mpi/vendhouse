<style>
    .affiliate_product img {
        width: 100%;
    }
</style>

<div class="container">
	<div class="row affiliate_product" style="padding: 50px 0;">
	    <?php 
	      if($affiliate_product != NULL) {
	          foreach($affiliate_product as $key=>$value) { ?>
	            <div class="col-sm-3">
        		  <?php echo $value->embed_code; ?>
        	    </div>
    	<?php } }?>
	</div>
</div>
