<div class="container-fluid" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("backup_menu","add-new")){ ?>
		<a href="<?php echo site_url('data_backup'); ?>" class="btn btn-default" id="add-new">
			<?php echo caption('Export'); ?>
		</a>
        <?php } ?>

        <?php if(ck_action("backup_menu","all")){ ?>
		<a href="<?php echo site_url('data_backup/import_data'); ?>" class="btn btn-default" id="all">
			<?php echo caption('Import'); ?>
		</a>
        <?php } ?>

        <?php /*if(ck_action("backup_menu","import")){ ?>
        <a href="<?php echo site_url('csv_import'); ?>" class="btn btn-default" id="import">
            CSV <?php echo caption('Import'); ?>
        </a>
        <?php }*/ ?>
    </div>
</div>
