<style>
.table-bordered>tbody>tr>td{
    vertical-align: middle;
}
/*.content p:last-child {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;  
    overflow: hidden;
}*/
</style>
<div class="container-fluid">
    <div class="row">
        <?php echo $this->session->flashdata("confirmation"); ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Ticket</h1>
                </div>
            </div>

            <div class="panel-body">
                <div class="none" style="margin-bottom:15px;">
                <table class="table table-bordered">
                    <tr>
                        <th width="45px"><?php echo caption('SL'); ?></th>
                        <th width="151px">Date</th>
                        <th>Page</th>
                        <th>Description</th>
                        <th width="120px"><?php echo caption('Action'); ?></th>
                    </tr>
                    <?php foreach ($info as $key => $row) {
                   	 $abc = $row->id;
                    ?>
                    <tr>
                        <td> <?php echo $key+1; ?> </td>
                        <td> <?php echo $row->date; ?> </td>
                        <td> <?php echo filter($row->page); ?> </td>
                        <td class="content"> <?php echo filter(crop($row->content,280)); ?> </td>
                        <td class="text-center">
                            <a title="Edit" class="btn btn-success" href="<?php echo site_url('page/edit/'.$row->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                           <a title="Delete" class="btn btn-danger" onclick="deleteAlert(`<?php echo site_url('page/delete/'.$abc); ?>`)" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
	  </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
