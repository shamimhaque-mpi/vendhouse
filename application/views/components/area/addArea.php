<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.22/sb-1.0.0/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.22/sb-1.0.0/datatables.min.js"></script>

<div class="container-fluid">
    <div class="row">
	<?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?=(isset($edit) ? 'Update Area' : 'Add Area')?></h1>
                </div>
            </div>

            <div class="panel-body">
                <form action="" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">District Name <span class="req">*</span></label>
                        <div class="col-md-4">
                            <select name="district_id" class="form-control">
                                <?php
                                    if($districts){
                                        foreach($districts as $district){
                                            echo "<option value='".$district->id."'".(isset($edit) ? ($edit->district_id ==$district->id ? 'selected' : '') : '').">$district->name</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Upazila Name <span class="req">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="name" value="<?=(isset($edit) ? $edit->name : '')?>" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Zip Code <span class="req">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="zip_code" value="<?=(isset($edit) ? $edit->zip_code : '')?>" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Service Charge <span class="req">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="shipping_charge" value="<?=(isset($edit) ? $edit->shipping_charge : '')?>" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox col-md-6 text-right">
                            <label style="font-weight: bold; user-select: none; margin-right: 15px;" for="check_update">
                                <span style="margin-right: 8px;">Update All Price Field</span> 
                                <input id="check_update" name="is_all" type="checkbox" style="margin-left: 0;">
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="btn-group pull-right">
                                <input type="submit" value="<?=(isset($edit) ? 'Update' : 'Save')?>" name="<?=(isset($edit) ? 'update' : 'save')?>" class="btn btn-primary">
                                <?php if(isset($edit)){ ?>
                                    <input type="hidden" name="id" value="<?=$edit->id?>">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <?php if(!isset($edit)){ ?>
                <div class="table-responsive">
                    <table class="table table-bordered datatable" id="myTable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Zip Code</th>
                            <th>Charge</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($upazilas)){ foreach($upazilas as $key=>$upazila){ ?>
                        <tr>
                            <td width="50"><?=(++$key)?></td>
                            <td><?=($upazila->name)?></td>
                            <td><?=($upazila->zip_code)?></td>
                            <td><?=($upazila->shipping_charge)?></td>
                            <td width="110">
                                <div class="btn-group">
                                    <a href="<?=(site_url('area/area/edit/'.$upazila->id))?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-danger" onclick="deleteAlert(`<?=(site_url('area/area/delete/'.$upazila->id))?>`)"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php }} ?>
                    </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
          "pageLength": 50
        });
    });
</script>
