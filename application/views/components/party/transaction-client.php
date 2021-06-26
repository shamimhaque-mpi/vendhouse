<div class="container-fluid">
    <div class="row">

        <?php echo $confirmation; ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Transaction </h1>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-md-8">
                    <?php
                    $attribute = array("class" => "form-horizontal");
                    echo form_open('', $attribute);
                    ?>

                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Clients
                            <span class="req">*</span>
                        </label>
                        
                        <div class="col-md-7">
                            <select name="client" class="form-control" required>
                                <option value="">&nbsp;</option>

                                <!-- loop -->
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Balance</label>
                        <div class="col-md-7">
                            <input type="number" name="balance" class="form-control" step="any" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Payment
                            <span class="req">*</span>
                        </label>
                        <div class="col-md-7">
                            <input type="number" name="payment" class="form-control" step="any" min="0" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Due</label>
                        <div class="col-md-7">
                            <input type="number" name="due" step="any" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="btn-group pull-right">
                            <input type="submit" name="save" value="<?php echo caption('Save'); ?>" class="btn btn-primary">
                        </div>
                    </div>
                        
                    <?php echo form_close(); ?>
                </div>

                <div class="col-md-4">
                    <ul>
                        <li>Name: Jayanta Biswas</li>
                        <li>Mobile: 01775219457</li>
                        <li>Address: Durgabari, Mymensingh, Bangladesh</li>
                    </ul>
                    <hr>

                     <ul>
                        <li>Name: Jayanta Biswas</li>
                        <li>Mobile: 01775219457</li>
                        <li>Address: Durgabari, Mymensingh, Bangladesh</li>
                    </ul>
                </div>

                
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>