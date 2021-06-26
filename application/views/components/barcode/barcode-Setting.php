<style>
    .generatimg{
        width: 100%;
        display: block;
        background: #ccc;
        margin-bottom: 15px;
        padding: 15px;
    }
    #upload_msg{
        display: none;
        color: #fff;
        padding: 15px;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        background: #5CB85C;
        box-shadow: 0 0 8px #ccc;
    }
</style>

<div class="container-fluid">
    <div class="row">
      <?php  echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Barcode Setting</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                $attribute = array(
                    'name' => '',
                    'class' => 'form-horizontal'
                );
                echo form_open('', $attribute);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-center"><strong>Image Size</strong></p>
                        <hr style="margin-top: 0px; border-bottom: 1px solid #ccc;">

                        <div class="form-group">
                            <label class="control-label col-md-3">Width</label>
                            <div class="col-md-7">
                                <input type="number" value="<?php echo $bc_data[0]->img_width; ?>" class="form-control" name="im_width" id="im_width" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Height</label>
                            <div class="col-md-7">
                                <input type="number" value="<?php echo $bc_data[0]->img_height; ?>" class="form-control" name="im_height" id="im_height" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="pull-right">
                                    <a id="refresh" class="btn btn-primary">Refresh</a>
                                </div>
                            </div>
                        </div>

                       <p id="upload_msg"></p>
                    </div> 


                    <div class="col-md-6">
                        <p class="text-center"><strong>Barcode Option</strong></p>
                        <hr style="margin-top: 0px; border-bottom: 1px solid #ccc;">
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Height</label>
                            <div class="col-md-8">
                                <input type="number" value="<?php echo $bc_data[0]->code_height; ?>" class="form-control" name="b_height" id="b_height" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Position-X</label>
                            <div class="col-md-5">
                                <input type="range" min="0" max="1000" class="form-control" name="x_pos" id="x_pos" value="<?php echo $bc_data[0]->pos_x; ?>" required >
                            </div> 
                            <div class="col-md-3">
                                <input type="number" min="0" max="1000" class="form-control" id="xx_pos" value="<?php echo $bc_data[0]->pos_x; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Position-Y</label>
                            <div class="col-md-5">
                                <input type="range" min="0" max="1000" class="form-control" name="y_pos" id="y_pos" value="<?php echo $bc_data[0]->pos_y; ?>" required >
                            </div> 
                            <div class="col-md-3">
                                <input type="number" min="0" max="1000" class="form-control" id="yy_pos" value="<?php echo $bc_data[0]->pos_y; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Code Type</label>
                            <div class="col-md-8">
                                <select name="code_type" class="form-control" id="code_type">
                                    <option value="codabar" <?php  if($bc_data[0]->code_type=="codabar"){ echo "selected"; } ?> >Codabar</option>
                                    <option value="code11" <?php  if($bc_data[0]->code_type=="code11"){ echo "selected"; } ?> >Code11</option>
                                    <option value="code39" <?php  if($bc_data[0]->code_type=="code39"){ echo "selected"; } ?> >Code39</option>
                                    <option value="code93" <?php  if($bc_data[0]->code_type=="code93"){ echo "selected"; } ?> >Code93</option>
                                    <option value="code128" <?php  if($bc_data[0]->code_type=="code128"){ echo "selected"; } ?> >Code128</option>
                                    <option value="ean8" <?php  if($bc_data[0]->code_type=="ean8"){ echo "selected"; } ?> >Ean8</option>
                                    <option value="ean13" <?php  if($bc_data[0]->code_type=="ean13"){ echo "selected"; } ?> >Ean13</option>
                                    <option value="std25" <?php  if($bc_data[0]->code_type=="std25"){ echo "selected"; } ?> >Std25</option>
                                    <option value="int25" <?php  if($bc_data[0]->code_type=="int25"){ echo "selected"; } ?> >Int25</option>
                                    <option value="msi" <?php  if($bc_data[0]->code_type=="msi"){ echo "selected"; } ?> >MSI</option>
                                    <option value="datamatrix" <?php  if($bc_data[0]->code_type=="datamatrix"){ echo "selected"; } ?> >Datamatrix</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Data </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="test_data" id="test_data">
                            </div>
                        </div>
                    </div>   
                </div>
                
                    
                <label class="control-label">Demo </label>
                <div class="generatimg">
                    <img id="test_img" src="" style="display: inline-block;" alt="Please Insert your data">
                </div>


                <div class="pull-right">
                    <input type="submit" name="bc_setting" value="Save" class="btn btn-primary">
                    <a class="btn btn-success" id="upload_barcode">Upload Barcode</a>
                </div>
                
		<div class="row">
			<div class="col-md-12 clearfix">
				<button type="button" id="gen_barcode" class="btn btn-success" style="margin-bottom: 10px;">Generate All</button><br />
				
				<div class="clearfix">
					<div class="pull-left">
						<span id="now">0</span>/<span id="total"></span>
					</div>
					<div class="pull-right">
						<span id="percent">0%</span>
					</div>
				</div>
				
				<div class="progress" style="height: 10px; box-shadow: 1px 3px 2px 0px #cccccc94; margin-top: 10px;">
				<div id="progress" class="progress-bar progress-bar-striped" role="progressbar"></div>
				</div>
			</div>
		</div>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>   
    </div>
</div>

	<script>
        //Generate All Barcode Start here
		$(document).ready(function(){
			var product_codes = JSON.parse('<?php echo $product_codes; ?>');
			var len = product_codes.length;
			var now = 0;
			$("#total").html(len);
			
			$("#gen_barcode").on("click",function(){
			now = 0;
				$.each(product_codes,function(i,v){
					//console.log(v);
					//Sending Request Start
				$.ajax({
					url: '<?php echo site_url("barcode/barcodeSetting/ajax_barcode_gen");?>',
					type: 'POST',
					data: {code: v},
				})
				.done(function(response) {
					//console.log(response);
					now+=1;
					var complete=(now*100)/len;
						$("#progress").css("width",complete+"%");
						$("#percent").html(parseInt(complete)+"%");
						$("#now").html(now);
				});	
					//Sending Request End
				});
			});
		});
        //Generate All Barcode End here
    </script>

    <script type="text/javascript">

    $(document).ready(function(){


        //Calling function on event Start here
        $(document.body).on("change","#im_height",function(){
            gen_barcode();
        });        

        $(document.body).on("click","#refresh",function(){
            gen_barcode();
        });

        $(document.body).on("change","#im_width",function(){
            gen_barcode();
        });

        $(document.body).on("change","#b_height",function(){
            gen_barcode();
        });

        $(document.body).on("change","#x_pos",function(){
            gen_barcode();
            $("#xx_pos").val($(this).val());
        });

        $(document.body).on("change","#xx_pos",function(){
            gen_barcode();
            $("#x_pos").val($(this).val());
        });

        $(document.body).on("change","#y_pos",function(){
            gen_barcode();
            $("#yy_pos").val($(this).val());
        });

        $(document.body).on("change","#yy_pos",function(){
            gen_barcode();
            $("#y_pos").val($(this).val());
        });

        $(document.body).on("change","#code_type",function(){
            gen_barcode();
        });

        $(document.body).on("keyup","#test_data",function(){
            gen_barcode();
        });
        $("#upload_barcode").on('click', function() {
            upload_barcode();
        });



        //setInterval(gen_barcode(), 100);
       //Calling function on event End here        

        function gen_barcode(){
            var myobj={
                im_height: $("#im_height").val(),
                im_width: $("#im_width").val(),
                b_height: $("#b_height").val(),
                x_pos: $("#x_pos").val(),
                y_pos: $("#y_pos").val(),
                code_type: $("#code_type").val(),
                test_data: $("#test_data").val()
            };
            
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('barcode/barcodeSetting/mk_barcode'); ?>",
                data: "data=" + JSON.stringify(myobj)
                //data:{name:"Maruf hasan"}
            }).success(function(response){
                console.log("Barcode Image Created");
               var img_url='<?php echo base_url("public/barcode/"); ?>'+'/'+response;
               $("#test_img").attr("src",img_url);
               //$("#img_holder").append(response);

               //Deleting old image Start here
                $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('barcode/barcodeSetting/del_barcode'); ?>",
                        data:{path:response}
                }).success(function(confirm){
                        console.log("Barcode Image Deleted");
                    });
               //Deleting old image End here
            });
        }

        //Save and Upload Bar code start here
        function upload_barcode(){
            var myobj={
                im_height: $("#im_height").val(),
                im_width: $("#im_width").val(),
                b_height: $("#b_height").val(),
                x_pos: $("#x_pos").val(),
                y_pos: $("#y_pos").val(),
                code_type: $("#code_type").val(),
                test_data: $("#test_data").val()
            };
            
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('barcode/barcodeSetting/save_barcode'); ?>",
                data: "data=" + JSON.stringify(myobj)
                //data:{name:"Maruf hasan"}
            }).success(function(response){
                //console.log("Barcode Image Saved");
                $('#upload_msg').html("Barcode Image Successfully Uploaded");
                $('#upload_msg').fadeIn('slow',function(){
                    setTimeout(function(){$('#upload_msg').fadeOut('slow')},3000);

                });
               //$("#img_holder").append(response);
            });
        }
        //Save and Upload Bar code end here
    });

    </script> 

