<div class="container-fluid">
    <div class="row">
    <?php echo $this->session->flashdata("confirmation");?>

        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Upload Advertisement</h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->

                <div class="col-xs-12 no-padding">
                    <?php
                    $attr=array(
                        'class'=>'form-horizontal'
                        );
                     echo form_open_multipart("",$attr); ?>
                    <div class="form-group">
                        <label class="col-md-2 control-label"> Page<span class="req">*</span></label>

                        <div class="col-md-5">
                           <select name="page" id="adsPage" class="form-control" required>
                               <option value="home">Home</option>
                               <option value="single_page">Single Page</option>
                           </select>
                        </div>
                    </div>

                    <div class="form-group" id="urlBox">
                        <label class="col-md-2 control-label">Url  <span class="req">*</span></label>

                        <div class="col-md-5">
                            <input  id="url" type="text" name="url" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image <span id="imgSize"></span> <span class="req">*</span></label>

                        <div class="col-md-5">
                            <input id="input-test" type="file" name="ads_image" class="form-control file" data-show-preview="true" required data-show-upload="false" data-show-remove="false">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('From'); ?> </label>
                        <div class="input-group date col-md-5" id="datetimepickerFrom">
                            <input type="text" name="from" value="<?php echo date("Y:m:d") ?>" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('To'); ?> </label>
                        <div class="input-group date col-md-5" id="datetimepickerTo">
                            <input type="text" name="to" value="<?php echo date("Y:m:d") ?>" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                       
                    <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" name="ads_Save" value="Save" class="btn btn-primary">
                    </div>
                    </div>

                <?php form_close(); ?>
                </div>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Advertisement</h1>
                </div>
            </div>

            <div class="panel-body">
            <?php if ($ads_data != null) {?>

                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Photo</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Page</th>
                        <th width="80">Action</th>
                    </tr>

                    <?php foreach ($ads_data as $key => $row) { ?>

                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td>
                            <img style="height: 100px;width: 100px" src="<?php echo site_url($row->path)?>" alt="">
                        </td>
                        <td><?php echo $row->from_date; ?></td>
                        <td><?php echo $row->to_date; ?></td>
                        <td><?php echo ucwords(str_replace("_"," ",$row->page)); ?></td>
                        <td>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this Data?');" href="?delete_token=<?php echo $row->id ?>&img_url=<?php echo $row->path;?>"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            <?php }else{
                    echo "<h4 style='text-align:center;color:#d00;'>No Advertisement Found!</h4>";
                } ?>
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
    $("#datetimepickerSMSFrom").on("dp.change", function (e) {
        $('#datetimepickerSMSTo').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepickerSMSTo").on("dp.change", function (e) {
        $('#datetimepickerSMSFrom').data("DateTimePicker").maxDate(e.date);
    });
</script>


<script>
    $(document).ready(function() {
        $('#imgSize').html("('<mark>W: 450px H: 300px</mark>')");
        $("#urlBox").css('display', 'none');
        $("#adsPage").on("change",function() {
            var currentval = $(this).val();
           if (currentval != "home"){
                $("#urlBox").css('display', 'block');
                $("#url").attr('required', 'required');
                $('#imgSize').html("('<mark>W: 160px H: 600px</mark>')");
           }else{
                $("#urlBox").css('display', 'none');
                $('#imgSize').html("('<mark>W: 450px H: 300px</mark>')");
           } 
        });
    });
</script>