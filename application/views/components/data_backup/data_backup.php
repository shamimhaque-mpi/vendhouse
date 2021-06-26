<style>
	.data-table th{
		background: #ccc;
	}
</style>
<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Export_Data'); ?></h1>
                </div>
            </div>

            <div class="panel-body">     		
               <div class="row">
               		<div class="col-md-2">
				<?php echo form_open(); ?>
                
		                    <div class="btn-group">
		                        <input style="margin-bottom: 15px;" name="export" class="btn btn-primary" type="submit" value="<?php echo caption('Export_all_Data'); ?>" class="btn btn-primary">
		                    </div>
		                    
		
		                <?php echo form_close(); ?>
               		</div>
               		
               		<div class="col-md-10 table-responsive">
               			<table class="table table-bordered data-table">
               				<tr>
               					<th><?php echo caption('SL'); ?></th>
               					<th><?php echo caption('Download'); ?></th>
               					<th><?php echo caption('Action'); ?></th>
               				</tr>
               				<?php foreach ($database_list as $key => $data_list) { ?>
               				<tr>
               					<td><?php echo $key+1; ?></td>
               					<td><a href="<?php echo base_url($data_list); ?>" download>Download <?php $name=explode("/", $data_list); echo $name[2]; ?></a></td>
               					<td style="width: 70px">
                        <?php if(ck_action("data_backup","delete")){ ?>
                          <a href="?delete_token=<?php echo $data_list; ?>" class="btn btn-danger" onclick="return confirm('Do you want to delete this Database? ');"><?php echo caption('Delete'); ?></a>
                        <?php } ?>                        
                        </td>
               				</tr>
               				<?php }?>
               			</table>
               		</div>
               </div>
                
                

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

