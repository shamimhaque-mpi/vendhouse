<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.3.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );
</script>






<div class="container-fluid">
    <div class="row">
    <?php echo $confirmation;?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Slider</h1>
                </div>
            </div>

            <div class="panel-body">

             
                <div id="sortable" class="gallery image-gallery clearfix">
                <?php foreach ($slider_data as $key => $slider) { ?>
                    <figure id="<?php echo $key+1; ?>" data-mainid="<?php echo $slider->id; ?>" data-position="<?php echo $slider->position; ?>">
                        <img src="<?php echo site_url($slider->slider_path)?>" alt="">
                        <figcaption>
                            <a class="btn btn-danger" onclick="deleteAlert(window.location.href+`?delete_token=<?php echo $slider->id ?>&img_url=<?php echo $slider->slider_path;?>`);" href="">Delete</a>
                        </figcaption>
                    </figure>
                <?php }?>
                </div>
                
                
                <hr>

                <!-- horizontal form -->
                    
                <div class="col-xs-12 no-padding">
                    <?php
                    $attr=array(
                        'class'=>'form-horizontal'
                        );
                     echo form_open_multipart("",$attr); ?>
                     
                    <div class="form-group">
                        <label class="col-md-2 control-label">Slider Link</label>

                        <div class="col-md-5">
                            <input type="text" name="sliderUrl" class="form-control file" placeholder="Enter Slider Link">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image  <span class="req">*</span></label>

                        <div class="col-md-5">
                            <input id="input-test" type="file" name="slider_image" class="form-control file" data-show-preview="false" required data-show-upload="false" data-show-remove="false">
                            <small style="font-weight: bold; color: tomato;">Image size must be : 850px X 350px</small>
                        </div>
                    </div> 

                    <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" name="slider_Save" value="Save" class="btn btn-primary">
                    </div>
                    </div>

                <?php form_close(); ?>
                </div>
                
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>



   <script>
   $(document).ready(function(){
    $( function() {
    $("#sortable").disableSelection();
    (function($) {
        var sortObj = {};

        $('#sortable').sortable({
            cursor: "move",
            distance: 5,
            opacity: 0.8,
            stop: function(e, ui) {

              
                $.map($(this).find('figure'), function(el) {
                  var index = parseInt($(el).index()) + 1;
                  return $("#"+el.id).data('mainid') + ' : ' + index;
                });


                $.map($(this).find('figure'), function(el) {
                  var index = parseInt($(el).index()) + 1;
                  sortObj[$("#"+el.id).data('mainid')] = index;

                });

                //console.log(JSON.stringify(sortObj));
                var final_data=JSON.stringify(sortObj);
                //console.log(final_data);
                /*console.log($.map($(this).find('figure'),function(el){
                  var index = parseInt($(el).index()) + 1;
                  $("#" + el.id).attr("data-position", index);
                }));*/

                /*Sending Ajax Data Start here*/
             $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('slider/slider/ajax_slider_sort'); ?>",
                  data: {finaldata:final_data}
                }).done(function(response){
                  //console.log(response);
            });
                /*Sending Ajax Data End here*/
            }
        });
    })(jQuery);
  });

//===========================================================================
//==========================Add More start here==============================
//===========================================================================
  
$("#addmore_btn").on('click', function(event) {
  $("#dyn_form").after($("#dyn_form").html());
   event.preventDefault();
});
//===========================================================================
//===========================Add More end here===============================
//===========================================================================


   });

</script>