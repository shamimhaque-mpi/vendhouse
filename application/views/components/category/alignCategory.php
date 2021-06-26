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
        .panel .hide{
            display: block !important;
        }
        .title{
            font-size: 25px;
        }
    }
</style>

<div class="container-fluid" ng-cloak>
    <div class="row" id="data">
    <?php  echo $this->session->flashdata('confirmation'); ?>
    <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo caption('Align_Category');?><br></h1>

                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print');?></a>
                </div>
            </div>

            <div class="panel-body">

                <div class="row hide">
                    <div class="view-profile">

                        <div class="institute">
                            <h2 class="text-center title" style="margin-top: 10px; font-weight: bold;">
                                <?php $print_header = config_item('heading');echo $print_header['title']; ?>
                            </h2>
                            <h4 class="text-center" style="margin: 0;">
                                <?php $print_header = config_item('heading');echo $print_header['place']; ?>
                            </h4>
                            <h4 class="text-center" style="margin: 0;">
                              Mobile: <?php $print_header = config_item('heading');echo $print_header['mobile']; ?>
                            </h4>
                        </div>

                    </div>
                </div>


                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">

               	<div id="sortable" class="col-sm-6 col-sm-offset-3">
                    <?php foreach ($categories as $key => $cat) { ?>
                    <div id="id<?php echo $key+1; ?>" data-mainid="<?php echo $cat->id; ?>" data-position="<?php echo $cat->position; ?>" class="btn btn-default col-sm-12"><?php echo filter($cat->category); ?></div>
                   <?php } ?>
               	</div>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script>

    $(function() {
    $("#sortable").disableSelection();

    (function($) {
        var sortObj = {};
        $('#sortable').sortable({
            revert:true,
            cursor: "move",
            distance: 5,
            opacity: 0.8,
            stop: function(e, ui) {

                $.map($(this).find('div'), function(el) {
                  var index = parseInt($(el).index()) + 1;
                  sortObj[$("#"+el.id).data('mainid')] = index;
                });

                //console.log(JSON.stringify(sortObj));
                var final_data = JSON.stringify(sortObj);

              $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('category/category/ajax_category_sort'); ?>",
                  data: {finaldata:final_data}
                }).done(function(response){
                 //  console.log(response);
            });
                //Sending Ajax Data End here
            }
        });
    })(jQuery);
  });

</script>
