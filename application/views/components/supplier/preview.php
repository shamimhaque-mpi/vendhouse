<style>
  @media print{
    aside{display: none !important;}
    nav{display: none;}
    .panel{border: 1px solid transparent;left: 0px;position: absolute;top: 0px;width: 100%;}
    .none{display: none;}
    .panel-heading{display: none;}
    .panel-footer{display: none;}
    .panel .hide{display: block !important;}
    .title{font-size: 25px;}
    table tr th,table tr td{font-size: 12px;}
  }
</style>
<div class="container-fluid" >
  <div class="row">
    <?php  echo $this->session->flashdata('confirmation'); ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panal-header-title">
          <h1 class="pull-left">Profile</h1>
          <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
      <div class="panel-body" ng-cloak>
        <!-- Print banner -->
        <!--<img class="img-responsive print-banner hide" src="<?php echo site_url($banner_info[0]->path); ?>">-->
        
        <h4 class="text-center hide" style="margin-top: 0px;">Profile</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <th>Date</th>
            <td><?php echo $partyInfo[0]->opening; ?></td>
          </tr>
          <!--tr>
            <th width="40%">ID</th>
            <td><?php echo $partyInfo[0]->code; ?></td>
          </tr-->
          <tr>
            <th>Name</th>
            <td><?php echo filter($partyInfo[0]->name); ?></td>
          </tr>
          <tr>
            <th>Mobile Number</th>
            <td><?php echo $partyInfo[0]->mobile; ?></td>
          </tr>
          <tr>
            <th>Address</th>
            <td><?php echo $partyInfo[0]->address; ?></td>
          </tr>
          <tr>
            <th>Initial Balance </th>
            <td>
              <?php
              $init_balance = $partyInfo[0]->initial_balance;
              $status = ($init_balance < 0) ? " Payable" : " Receivable";
              echo abs($init_balance) . ' TK &nbsp; [' . $status . '&nbsp;]';
              ?>
            </td>
          </tr>
          <tr>
            <th>Current Balance </th>
            <td>
              <?php
              // Calculate Balance from partytrasaction table.
              // Final balance = total_debit - total_credit + initial_balance.
              // Final Balance (+ve) = Receivable and (-ve) = Payable
              $where = array(
                'party_code' => $partyInfo[0]->code,
                'trash' => 0
              );
              $transactionRec = $this->retrieve->read('partytransaction',$where);
              $total_credit = $total_debit = 0.0;
              if ($transactionRec != null) {
                foreach ($transactionRec as $key => $row) {
                  $total_credit += $row->credit;
                  $total_debit += $row->debit;
                }
                $balance = $total_debit -  $total_credit + $partyInfo[0]->initial_balance;
              }else{
                $balance = $partyInfo[0]->initial_balance;
              }
              $status = ($balance < 0) ? " Payable" : " Receivable";
              echo abs($balance) . ' TK &nbsp; [' . $status . '&nbsp;]';
              ?>
            </td>
          </tr>
          <tr>
            <th>Status</th>
            <td><?php echo filter($partyInfo[0]->status); ?></td>
          </tr>
        </table>
      </div>
      <div class="panel-footer">&nbsp;</div>
    </div>
  </div>
</div>