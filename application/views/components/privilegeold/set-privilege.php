<style>
    .delete{color: red;}
    .view{color: green;}
    .edit{color: #EC971F;}

    .checkbox-inline,
    .checkbox label,
    .radio label{
        padding-left: 0;
        font-weight: bold;
    }

    .checkbox label:after,
    .radio label:after {
        content: '';
        display: table;
        clear: both;
    }

    .checkbox .cr,
    .radio .cr {
        position: relative;
        display: inline-block;
        border: 1px solid #a9a9a9;
        border-radius: .25em;
        width: 1.3em;
        height: 1.3em;
        float: left;
    }

    .radio .cr {
        border-radius: 50%;
    }

    .checkbox .cr .cr-icon,
    .radio .cr .cr-icon {
        position: absolute;
        font-size: .8em;
        line-height: 0;
        top: 50%;
        left: 20%;
    }

    .radio .cr .cr-icon {
        margin-left: 0.04em;
    }

    .checkbox label input[type="checkbox"],
    .radio label input[type="radio"] {
        display: none;
    }

    .checkbox label input[type="checkbox"] + .cr > .cr-icon,
    .radio label input[type="radio"] + .cr > .cr-icon {
        transform: scale(3) rotateZ(-20deg);
        opacity: 0;
        transition: all .3s ease-in;
    }

    .checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
    .radio label input[type="radio"]:checked + .cr > .cr-icon {
        transform: scale(1) rotateZ(0deg);
        opacity: 1;
    }

    .checkbox label input[type="checkbox"]:disabled + .cr,
    .radio label input[type="radio"]:disabled + .cr {
        opacity: .5;
    }
    #progress{display: none ;}
</style>
<div class="container-fluid">
    <div class="row">
	<?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">Set Privilege</h1>
                    <img id="progress" class="pull-right" src="<?php echo site_url("private/images/loder.gif"); ?>" alt=""></span>
                </div>
            </div>

            <div class="panel-body">

                <form action="" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Privilege  <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="privilege" id="privilege" class="form-control" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($privileges as $privilege) { ?>
                                <option value="<?php echo $privilege->privilege; ?>"><?php echo filter($privilege->privilege); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">User Name<span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="user_id" id="user_id" class="form-control" required> </select>
                        </div>
                        <div class="col-md-12">
                            <hr style="margin-bottom: 0">
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr  class="active">
                            <th rowspan="2" class="text-center" style="vertical-align: middle;">Menu Item</th>
                            <th colspan="3" class="text-center">Actions</th>
                        </tr>
                        <tr  class="active">
                            <th class="text-center" >
								<div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" id="check_view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                            		<span style="margin-left: 10px;">View</span>
                                  </label>
                                </div>
                            </th>
                            <th class="text-center" >
                            	<div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" id="check_edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                            		<span style="margin-left: 10px;">Edit</span>
                                  </label>
                                </div>
                            </th>
                            <th class="text-center" >
                            	<div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" id="check_delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Delete</span>
                                  </label>
                                </div>

                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="dashboard">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Dashboard</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >-</td>
                            <td class="text-center" >-</td>
                            <td class="text-center" >-</td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu"  value="godown">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Godown</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >-</td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="godown" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="godown" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu"  value="order">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Order</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="order" data-item="action" value="view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >-</td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="order" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu"  value="customer">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Customer</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >- </td>
                            <td class="text-center" >-</td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="customer" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="category">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Category</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="category" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="category" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->
                        
                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="subcategory">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Sub Category</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="subcategory" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="subcategory" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="brand">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Brand</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="brand" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="brand" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="product">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Product</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="product" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="product" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="free_product">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Free Product</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="free_product" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="free_product" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="employee">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Employee</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="employee" data-item="action" value="view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="employee" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="employee" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="supplier">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Supplier</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="supplier" data-item="action" value="view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="supplier" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="supplier" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="supplier_transaction">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Supplier Transaction</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="supplier_transaction" data-item="action" value="view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="supplier_transaction" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="supplier_transaction" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="purchase">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">purchase</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="purchase" data-item="action" value="view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="purchase" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="purchase" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="purchase_transaction">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Purchase Transaction</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="purchase_transaction" data-item="action" value="view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="purchase_transaction" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="purchase_transaction" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="Stock">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Stock</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >-</td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="Stock" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >-</td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="salse">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Sales</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="salse" data-item="action" value="view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >-</td>
                            <td class="text-center" >-</td>
                        </tr>
                        <!-- Row End here -->

                         <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="salse_returns">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Sales Returns</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >-</td>
                            <td class="text-center" >-</td>
                            <td class="text-center" >-</td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="bank">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Bank</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >-</td>
                            <td class="text-center" >-</td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="bank" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="bank_transaction">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Bank Transaction</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >-</td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="bank_transaction" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="bank_transaction" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="cost">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Cost</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="report">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Report</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="profit_loss">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Profit / Loss</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="barcode">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Barcode</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="barcode" data-item="action" value="view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="barcode" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="barcode" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="leave_management">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Leave Management</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="leave_management" data-item="action" value="view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="leave_management" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="leave_management" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="mobile_sms">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Mobile SMS</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="mobile_sms" data-item="action" value="view">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="mobile_sms" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="mobile_sms" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="closing">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Closing</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="frontend_page">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Frontend Page</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="frontend_page" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="frontend_page" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="theme_ettings">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Theme Settings</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="set_privilege">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Set Privilege</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="data_backup">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Data Backup</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="data_backup" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="income">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Income</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline edit">
                                  <label>
                                    <input type="checkbox" data-menu="income" data-item="action" value="edit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center" >
                                <div class="checkbox checkbox-inline delete">
                                  <label>
                                    <input type="checkbox" data-menu="income" data-item="action" value="delete">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="balance_sheet">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Balance Sheet</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="payment_method">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Payment Method</span>
                                  </label>
                                </div>
                            </th>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                            <td class="text-center" > - </td>
                        </tr>
                        <!-- Row End here -->



                    </tbody>
                </table>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        // get all users
        $('select#privilege').on("change",function(){
            var data = [];
            var obj = { 'privilege' : $(this).val() };

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url("ajax/retrieveBy/users"); ?>",
                data : "condition=" + JSON.stringify(obj)
            }).done(function(response){
                var items = $.parseJSON(response);
                data.push('<option value="">-- Select --</option>');
                $.each(items,function(i,el){
                    data.push('<option value="'+ el.id+'">'+ el.username +'</option>');
                });

                $('select#user_id').html(data);

            });
        });

        $("#check_view").on('change', function(event) {
            if($(this).is(":checked")){
                $('input[type="checkbox"][value="view"]').prop({checked:true});
            }else{
                $('input[type="checkbox"][value="view"]').prop({checked:false});
            }
        });


        $("#check_edit").on('change', function(event) {
            if($(this).is(":checked")){
                $('input[type="checkbox"][value="edit"]').prop({checked:true});
            }else{
                $('input[type="checkbox"][value="edit"]').prop({checked:false});
            }
        });

        $("#check_delete").on('change', function(event) {
            if($(this).is(":checked")){
                $('input[type="checkbox"][value="delete"]').prop({checked:true});
            }else{
                $('input[type="checkbox"][value="delete"]').prop({checked:false});
            }
        });
        //Getting All Menu Name It's Just for use the data
        var input = $('input[type="checkbox"][data-item="menu"]');
        var list = [];
        $.each(input,function(index, el) {
            list.push($(el).val());
        });
        // console.log(list);

        //Set Privilege Data Start
        $('input[type="checkbox"]').on('change', function(event) {
            if($('select[name="privilege"]').val()!="" && $('select[name="user_id"]').val()!=""){
                $("#progress").fadeIn(300);
                //Collecting all data start here
                var access_item = {};

                var input = $('input[type="checkbox"]');

                $.each(input,function(index, el) {
                    if($(el).is(":checked")){
                        //access_item.push($(el).val());
                        if($(el).data("item")=="menu"){
                            //action data collection Start here
                            var ac_el = $('input[data-menu="'+$(el).val()+'"]');
                            var action_data = [];
                            $.each(ac_el,function(ac_i, ac_el) {
                                if($(ac_el).is(":checked")){
                                    action_data.push($(ac_el).val());
                                }
                            });
                            //action data collection End here
                            access_item[$(el).val()] = action_data;
                        }
                    }
                });
                //console.log(access_item);

                var access = JSON.stringify(access_item);
                //console.log(access);
                var privilege_name = $('select[name="privilege"]').val();
                var user_id = $('select[name="user_id"]').val();
                //Collecting All data end here


                //Sending Request Start here
                $.ajax({
                    url: '<?php echo site_url("privilege/privilege/set_privilege_ajax"); ?>',
                    type: 'POST',
                    data: {
                        privilege_name: privilege_name,
                        user_id : user_id ,
                        access : access
                    }
                })
                .done(function(response) {
                    //console.log(response);
                    $("#progress").fadeOut(300);
                });
                //Sending Request End here
            }else{
                alert("Please select a Privilege and User Name.");
                return false
            }
        });
        //Set Privilege Data End

        //Get Privilege Data Start
        $('select[name="user_id"]').on('change', function(event) {
            $('input[type="checkbox"]').prop({checked:false});
            //Sending Request Start here
            var user_id = $(this).val();
            var privilege_name = $('#privilege').val();
            $.ajax({
                url: '<?php echo site_url("privilege/privilege/get_privilege_ajax"); ?>',
                type: 'POST',
                data: {user_id : user_id , privilege_name:privilege_name}
            }).done(function(response) {
                if(response!="error"){
                    var data = $.parseJSON(response);
                    access = $.parseJSON(data.access);

                    //console.log(access);
                    $.each(access,function(access_index,access_val){
                        //console.log(access_index);
                        //data-item="menu" value="theme_ettings"
                        $('input[data-item="menu"][value="'+access_index+'"]').prop({checked: true});
                        $.each(access_val,function(action_in,action_val){
                            $('input[data-item="action"][data-menu="'+access_index+'"][value="'+action_val+'"]').prop({checked: true});
                        });
                        //$('input[name="'+el.module_name+'"][value="'+access_val+'"]').prop({checked: true});
                    });
                }
            });
            //Sending Request End here
        });
        //Get Privilege Data End
    });
</script>
