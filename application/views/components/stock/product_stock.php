<!-- Select Option 2 Stylesheet -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.22/sb-1.0.0/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.22/sb-1.0.0/datatables.min.js"></script>

<style>
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer{display: none !important;}
        .panel{border: 1px solid transparent;left: 0px;position: absolute;top: 0px;width: 100%;}
        .hide{display: block !important;}
    }
    .wid-100{width: 100px;}
    #loading{text-align: center;}
    #loading img{display: inline-block;}

</style>

<div class="container-fluid">
    <div class="row">
        <?php if(isset($edit)){ ?>
        <div class="panel panel-default none">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Stock Update</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php echo $this->session->flashdata('deleted'); ?>
                <form method="POST" action="" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-3">
                            <input type="text" class="form-control" value="<?=($edit[0]->product_name)?>" readonly>
                            <input type="hidden" value="<?=($edit[0]->id)?>" name="id">
                        </div>
                        
                        <div class="col-md-3">
                            <input type="number" name="stock_qty" class="form-control" value="<?=$edit[0]->stock_qty?>">
                        </div>
                        
                        <div class="btn-group">
                            <input type="submit" value="update" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>

         <?php if(!isset($edit)){ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class=" pull-left">Stock</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">
                <h4 class="hide text-center" style="margin-top: 0px;">Stock</h4>
                 <div class="table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 40px;">SL</th>
                                <th>product Name</th>
                                <th>Purchase Price</th>
                                <th>Sale Price</th>
                                <th>Stock Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $key=>$item){?>
                            <tr>
                                <td><?php echo ++$key;?></td>
                                <td><?=($item->product_name)?></td>
                                <td><?=($item->purchase_price)?> TK</td>
                                <td><?=($item->sale_price)?> TK</td>
                                <td><?=($item->stock_qty)?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?=site_url('stock/stock/product_stock/'.$item->id)?>" class="btn btn-info">Update</a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>
    </div>
</div>
<!-- Select Option 2 Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>