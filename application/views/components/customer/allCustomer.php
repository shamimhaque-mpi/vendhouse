<style>
    @media print{
        aside {display: none !important;}
        nav {display: none;}
        .panel {
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .none {display: none;}
        .panel-heading {display: none;}
        .panel-footer {display: none;}
        .panel .hide {display: block !important;}
        .title {font-size: 25px;}
        table tr th,
        table tr td {font-size: 12px;}
    }
    .user_box {
        background: rgba(0,0,0,.8);
        justify-content: center;
        padding: 45px 0 0 250px;
        align-items: center;
        position : fixed;
        display: flex;
        height: 100vh;
        width: 100%;
        left: 0;
        top: 0;
    }
    .user_box form {
        border-radius: 2px;
        background: #fff;
    }
    .user_box .user_header {position: relative;}
    .user_box .user_header button {
        border-radius: 50%;
        position: absolute;
        line-height: 21px;
        font-size: 19px;
        outline: none;
        border: none;
        top: 0px;
        right: 15px;
        width: 20px;
        padding: 0;
        height: 20px;
        text-align: center;
        background: #d9534f;
        color: #fff;
        transition: all .2s;
    }
    .user_box .user_header button:hover {background: #C9302C;}
    .user_box h4 {
        border-bottom: 1px solid #ddd;
        padding: 5px 15px 12px;
    }
    .user_box .user_form {
        padding: 5px 15px 15px;
        text-align: right;
    }
    .user_box .user_form .form-control {
        min-width: 245px;
        padding: 6px;
    }
    .user_box .user_form .btn {
        text-transform: uppercase;
        margin-top: 8px;
        font-size: 12px;
        padding-top: 8px;
    }
</style>
<div class="container-fluid" ng-controller="AllCustomerCtrl" ng-cloak>
    <div class="user_box" ng-show="is_form">
        <form action="" method="POST" >
            <div class="user_header">
                <h4>{{form_data.name}}</h4>
                <button type="button" ng-click="formCloseFn()">&times;</button>
            </div>
            <div class="user_form">
                <input type="hidden" name="id" ng-value="form_data.id">
                <select class="form-control" name="status" ng-model="form_data.status">
                    <option value="active">Active</option></option>
                    <option value="inactive">Deactive</option></option>
                </select>
                <input class="btn btn-success" type="submit" value="Submit">
            </div>
        </form>
    </div>
    <div class="row">
	    <?php echo $this->session->flashdata('confirmation'); ?>
	<div ng-bind-html="message"></div>
	
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo caption('All_Customer'); ?></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i><?php echo caption('Print'); ?></a>
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


                <hr class="hide" style="border-bottom: 1px solid #ccc; margin-top: 5px;">

                <h4 class="hide text-center" style="margin-top: -10px;"><?php echo caption('All_Customer'); ?></h4>

                <div class="table-responsive">
                <table class="table table-bordered">
                    <caption class="none">
                        <input type="text" ng-model="search" class="form-control" style="max-width: 400px;width: 100%;">
                    </caption>

                    <tr>
                        <th style="width: 35px;"><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Name'); ?></th>
                        <th><?php echo caption('Mobile'); ?></th>
                        <th><?php echo "Password"; ?></th>
                        <th><?php echo caption('Address'); ?></th>
                        <th><?php echo caption('Status'); ?></th>
                        <th class="none" width="130"><?php echo caption('Action'); ?></th>
                    </tr>

                    <tr dir-paginate="row in results|filter:search|itemsPerPage:30">
                        <td> {{ row.sl }} </td>
                        <td> {{ row.name }} </td>
                        <td> {{ row.mobile }} </td>
                        <td> {{ row.password }} </td>
                        <td> {{ row.address }} </td>
                        <td> {{ row.status == 'inactive' ? 'Deactive' : 'Active' }} </td>

                        <td class="none" style="width: 50px;">
                            <button class="btn btn-success" ng-click="userDeactiveFn($index)"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                            <?php if(ck_action("customer","delete")){ ?>
                                <a class="btn btn-danger" title="Delete"  href="" data-id="{{row.id}}" onclick="deleteAlert('customer/delete/'+this.dataset.id);" >
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            <?php } ?>
                            
                        </td>
                    </tr>
                </table>
                </div>

                <dir-pagination-controls max-size="30" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

