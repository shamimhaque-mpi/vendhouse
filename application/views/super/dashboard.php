    <style>
        .dashboard_box_wrapper_new {
            display: block;
            grid-column-gap: inherit;
            grid-template-columns: inherit;
        }
        .dashboard_box_wrapper_new > .row,
        .custom_des_grid {
            margin-right: -8px;
            margin-left: -8px;
        }
        .dashboard_box_wrapper_new > .row > [class*="col-"],
        .custom_des_grid [class*="col-"] {
            padding-right: 7px;
            padding-left: 7px;
        }
        .custom_des_grid .panal-header-title h1 {
            font-weight: 500;
            color: #333;
            font-size: 23px;
            line-height: 25px;
            margin-top: 5px;
        }
    </style>
    
    <link href="https://fonts.googleapis.com/css?family=Cookie|Josefin+Sans|Satisfy&display=swap" rel="stylesheet">
    <!--panel header start here-->
    <div class="container-fluid">
        <div class="row">
            <div class="dashboard_header_wrapper">
                <h1 class="title" style="margin: 8px 0 0;">ড্যাশবোর্ড</h1>
            </div>
        </div>
    </div>
    
    
    <!--panel header end here-->
    <div class="container-fluid">
        <div class="row">
       	    <?php echo $this->session->flashdata('error'); ?>
       	    <div class="dashboard_box_wrapper_new">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="dash-box dash-box-1">
                            <span>Total Order</span>
                            <h1><?php if(isset($total_order)){ echo $total_order;}?></h1>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dash-box dash-box-2">
                            <span>Total Pending Order</span>
                            <h1><?php if(isset($total_pending_order)){ echo $total_pending_order;}?></h1>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dash-box dash-box-3">
                            <span>Total Approved Order</span>
                            <h1><?php if(isset($total_approved_order)){ echo $total_approved_order;}?></h1>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dash-box dash-box-4">
                            <span>Today's Order Amount</span>
                            <h1><?php echo isset($today_order_amount[0]->amount) ? $today_order_amount[0]->amount.' TK' : '0 TK'; ?></h1>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dash-box dash-box-5">
                            <span>Today's Order</span>
                            <h1><?php echo (isset($today_order) ? $today_order : ''); ?></h1>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dash-box dash-box-6">
                             <span>Today's Cost</span>
                            <h1><?php echo isset($today_cost_amount[0]->amount) ? $today_cost_amount[0]->amount.' TK' : '0 TK'; ?></h1>
                        </div>
                    </div>
                    <!--div class="col-md-3 col-sm-6">
                        <div class="dash-box dash-box-7">
                            <span>Today's Order</span>
                            <h1><?php echo (isset($today_order) ? $today_order : ''); ?></h1>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dash-box dash-box-8">
                             <span>Today's Cost</span>
                            <h1><?php echo isset($today_cost_amount[0]->amount) ? $today_cost_amount[0]->amount.' TK' : '0 TK'; ?></h1>
                        </div>
                    </div-->
                </div>
            </div>
        </div>
        <!--panel header end here-->
    </div>
    <div class="row custom_des_grid">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading panal-header">
                        <div class="panal-header-title pull-left">
                            <h1>পাই চার্ট ০১</h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <html>
                          <head>
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">
                              google.charts.load("current", {packages:["corechart"]});
                              google.charts.setOnLoadCallback(drawChart);
                              function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                  ['Task', 'Hours per Day'],
                                  ['Chrome',     20],
                                  ['EDGE/IE',      5],
                                  ['Firefox',  10],
                                  ['Opera', 4],
                                  ['Others',    2]
                                ]);
                        
                                var options = {
                                  title: '',
                                  is3D: true,
                                  legend: 'none',
                                  'height': 500
                                };
                        
                                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                                chart.draw(data, options);
                              }
                            </script>
                          </head>
                          <body>
                            <div id="piechart_3d" style="width: 100%;"></div>
                          </body>
                        </html>
                    </div>
                    <div class="panel-footer">&nbsp;</div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading panal-header">
                        <div class="panal-header-title pull-left">
                            <h1>পাই চার্ট ০২</h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <html>
                          <head>
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">
                              google.charts.load("current", {packages:["corechart"]});
                              google.charts.setOnLoadCallback(drawChart);
                              function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                  ['Task', 'Hours per Day'],
                                  ['Computer',     11],
                                  ['Tablet',      1],
                                  ['Mobile',  6],
                                  ['Others', 2]
                                ]);
                        
                                var options = {
                                  title: '',
                                  is3D: true,
                                  legend: 'none',
                                  'height': 500
                                };
                        
                                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
                                chart.draw(data, options);
                              }
                            </script>
                          </head>
                          <body>
                            <div id="piechart_3d2"></div>
                          </body>
                        </html>
                    </div>
                    <div class="panel-footer">&nbsp;</div>
                </div>
            </div>
        </div>
    
