<style>
    .about h3{color: initial;}
</style>
<div class="container-fluid">
	<div class="row about">
		<div class="col-md-offset-2 col-md-8">
		<?php if(!empty($page_data)){ ?>
			<h3><?php echo filter($page_data[0]->page);?></h3>
			<hr style="margin-bottom: 0;">
			<p><?php echo $page_data[0]->content;?></p>
		<?php } ?>
		</div>
	</div>
</div>
