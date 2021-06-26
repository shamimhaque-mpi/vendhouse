<style>
.table2 tr td{
    padding: 0 !important;
}
.table2 tr td input{
    border: 1px solid transparent;
}
.new-row-1 .col-md-4{
    margin-bottom: 8px;
}
</style>
<div class="container-fluid">
<div class="row">
    <?php echo $this->session->flashdata('confirmation'); ?>
    <div class="panel panel-default">
        <div class="panel-heading panal-header">
            <div class="panal-header-title pull-left">
                <h1>Edit Free Product</h1>
            </div>
        </div>
        <div class="panel-body">
            <!-- horizontal form -->
            <?php
             $attr = array("class" => "form-horizontal");
             echo form_open('', $attr);
            ?>
            <div class="row new-row-1">

                <div class="col-md-4">
                    <input type="text" name="product" value="<?php echo $result[0]->product; ?>" class="form-control" placeholder="Product Name" required readonly>
                </div>

                <div class="col-md-4">
                    <input type="number" class="form-control" name="quantity" value="<?php echo $result[0]->quantity; ?>"  placeholder="<?php echo caption('Quantity'); ?>" min="1"  required>
                </div>

                <div class="col-md-4">
                    <select name="relation" class="form-control" placeholder="Relation" required>
                        <option value="">Select Relation</option>
                        <?php foreach(config_item("relation") as $key => $value) { ?>
                            <option <?php if($key == $result[0]->relation) { echo "selected"; } ?> value="<?php echo $key; ?>"><?php echo filter($value); ?></option>
                        <?php } ?>
                    </select>  
                </div>

                <div class="col-md-4">
                  <input type="text" name="free_product" class="form-control" value="<?php echo $result[0]->free_product; ?>"  placeholder="Free Product Name" required readonly>
                </div>

                 <div class="col-md-4">
                    <input type="number" name="free_quantity" class="form-control" value="<?php echo $result[0]->free_quantity; ?>" placeholder="<?php echo caption('Quantity'); ?>" min="1"  required>
                 </div>
                <div class="col-md-2">
                    <div class="input-group date" id="datetimepickerFrom">
                        <input type="text" name="from_date" class="form-control" value="<?php echo $result[0]->from_date; ?>"  placeholder="<?php echo caption('Date'); ?>" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group date" id="datetimepickerTo">
                        <input type="text" name="to_date" class="form-control" value="<?php echo $result[0]->to_date; ?>"  placeholder="<?php echo caption('Date'); ?>" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="col-md-4" style="margin-top: 10px;">
                    <input type="submit" name="edit" value="Update" class="btn btn-success pull-right">
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="panel-footer">&nbsp;</div>
    </div>
</div>
</div>
<script>
// linking between two date
$('#datetimepickerFrom').datetimepicker({
format: 'YYYY-MM-DD',
useCurrent: false
});
$('#datetimepickerTo').datetimepicker({
format: 'YYYY-MM-DD',
useCurrent: false
});
</script>
