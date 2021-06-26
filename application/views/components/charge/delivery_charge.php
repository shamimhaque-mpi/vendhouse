<style>
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer{
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .hide{
            display: block !important;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">

    <?php echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default none">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Add Delivery Charge</h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label">Amount</label>
                    <div class="col-md-4">
                        <input type="number" name="amount" min="0" step="any" class="form-control" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <input type="submit" name="save" value="Save" class="btn btn-primary">
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>


        <?php if($result != null){ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">All Delivery Charge</h1>
                </div>
            </div>

            <div class="panel-body">


                <div class="row hide">
                    <div class="view-profile">

                    </div>
                </div>

                <div class="table-responsive">
                <table class="table table-bordered table2">
                    <tr>
                        <th style="width: 50px;"><?php echo caption('SL'); ?></th>
                        <th width="150px"><?php echo caption('Date'); ?></th>
                        <th>Delivery Charge</th>
                    </tr>

                    <?php foreach($result as $key => $row){ ?>
                    <tr>
                        <td> <?php echo ($key + 1); ?> </td>
                        <td> <?php echo $row->date; ?> </td>
                        <td> <?php echo $row->amount; ?> </td>
                    </tr>
                    <?php } ?>
                </table>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>
    </div>
</div>
