            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Bootstrap Core JavaScript -->
        <script type="text/javaScript" src="<?php echo site_url('private/js/ngScript.js'); ?>"></script>
        <script type="text/javaScript" src="<?php echo site_url('private/js/bootstrap.min.js'); ?>"></script>

        <!-- All plugins -->
        <script type="text/javaScript" src="<?php echo site_url('private/plugins/bootstrap-fileinput-master/js/fileinput.min.js') ;?>"></script>
        <script type="text/javaScript" src="<?php echo site_url('private/plugins/peity/jquery.peity.min.js')?>"></script>

	<!-- Nice Scroll -->
	<script src="<?php echo site_url('private/js/jquery.nicescroll.min.js'); ?>"></script>

        <!-- custom Core JavaScript -->
        <script src="<?php echo site_url('private/js/script.js'); ?>"></script>


        <!-- Menu Toggle Script -->
        <script type="text/javaScript">
            $('.dropdown-toggle').dropdown();

            $("#menu-toggle").click(function(e) {
            e.preventDefault();
                $("#wrapper").toggleClass("toggled");
                $(this).toggleClass("icon-change");
            });

            $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: 'YYYY-MM-DD'
                });

                // charte

                var updatingChart = $(".bar").peity("bar", {
                width: 200,
                height: 100
            });
            setInterval(function() {
                var random = Math.round(Math.random() * 10);
                var values = updatingChart.text().split(",");
                values.shift();
                values.push(random);

                updatingChart.text(values.join(",")).change();
            }, 1000);

                $(".bar1").peity("bar");

                $("span.pie").peity("pie");

                $(".data-attributes span").peity("donut")


                // linking between two date
                $('#datetimepickerFrom').datetimepicker();
                $('#datetimepickerTo').datetimepicker({
                    useCurrent: false
                });
                $("#datetimepickerFrom").on("dp.change", function (e) {
                    $('#datetimepickerTo').data("DateTimePicker").minDate(e.date);
                });
                $("#datetimepickerTo").on("dp.change", function (e) {
                    $('#datetimepickerFrom').data("DateTimePicker").maxDate(e.date);
                });
            });

            // file upload with plugin options
            $("input#input").fileinput({
                browseLabel: "Pick Image",
                previewFileType: "text",
                allowedFileExtensions: ["jpg", "jpeg", "png"],
            });




        </script>

        <script>
        $(document).on('ready', function() {
            $("#input-4").fileinput({showCaption: false});
        });
        </script>


        <!-- PIE CHART -->
         <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Product', 'Sell'],
              ['Borac',     562],
              ['Cocchop',      466],
              ['Dmm Cocchop',      392],
              ['New Borac',      350],
              ['Newborac Magnet',      312],
              ['Battery ( Global 180 Ah)',      268],
              ['Battery (Atl 140 Ah)',      221],
              ['Carbon Pata Motor',      189],
              ['Agro 8 Auto Charger',      132],
              ['Luke Kata Charger',      82]
            ]);

            var options = {
              title: '',
              is3D: true,
              'width': 450,
              'height': 400,
              'chartArea': {'width': '100%', 'height': '80%'},
              'legend': {'position': 'bottom'}
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

            chart.draw(data, options);
          }
        </script>


        <!-- PIE CHART -->
         <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Date', 'Amount'],
              ['01-02-2017',     5620],
              ['02-02-2017',      4660],
              ['03-02-2017',      3920],
              ['04-02-2017',      3500],
              ['05-02-2017',      3120],
              ['06-02-2017',      2680]
            ]);

            var options = {
              title: '',
              is3D: true,
              'width': 450,
              'height': 400,
              'chartArea': {'width': '100%', 'height': '80%'},
              'legend': {'position': 'bottom'},
               'pieSliceText': 'value'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));

            chart.draw(data, options);
          }
        </script>


        <!-- PIE CHART -->
         <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Date', 'Amount'],
              ['01-02-2017',     6584],
              ['02-02-2017',      3564],
              ['03-02-2017',      6842],
              ['04-02-2017',      2354],
              ['05-02-2017',      6853],
              ['06-02-2017',      4256]
            ]);

            var options = {
              title: '',
              is3D: true,
              'width': 450,
              'height': 400,
              'chartArea': {'width': '100%', 'height': '80%'},
              'legend': {'position': 'bottom'},
               'pieSliceText': 'value'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d3'));

            chart.draw(data, options);
          }
        </script>


        <!-- PIE CHART -->
         <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Date', 'Amount'],
              ['01-02-2017',     265],
              ['02-02-2017',      352],
              ['03-02-2017',      254],
              ['04-02-2017',      165],
              ['05-02-2017',      468],
              ['06-02-2017',      258]
            ]);

            var options = {
              title: '',
              is3D: true,
              'width': 450,
              'height': 400,
              'chartArea': {'width': '100%', 'height': '80%'},
              'legend': {'position': 'bottom'},
               'pieSliceText': 'value'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d4'));

            chart.draw(data, options);
          }
        </script>

        <!-- PIE CHART -->
         <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Name', 'Amount'],
              ['Rony Debnath',     22565],
              ['Jayanta Biswas',      36852],
              ['Imtiaz Ahmed',      25464]
            ]);

            var options = {
              title: '',
              is3D: true,
              'width': 450,
              'height': 400,
              'chartArea': {'width': '100%', 'height': '80%'},
              'legend': {'position': 'bottom'},
               'pieSliceText': 'value'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d5'));

            chart.draw(data, options);
          }
        </script>

        <!-- PIE CHART -->
         <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Name', 'Amount'],
              ['Rony Debnath',     2255],
              ['Jayanta Biswas',      3852],
              ['Imtiaz Ahmed',      2364],
              ['Maruf Hassan',      2564],
              ['Abdullah Al Ahsan',      2264]
            ]);

            var options = {
              title: '',
              is3D: true,
              'width': 450,
              'height': 400,
              'chartArea': {'width': '100%', 'height': '80%'},
              'legend': {'position': 'bottom'},
               'pieSliceText': 'value'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d6'));

            chart.draw(data, options);
          }
        </script>
        
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            function deleteAlert(url, title=null){
                swal({
                    title: "Are you sure?",
                    text:  "",
                    icon:  "warning",
                    buttons: {
                        cancel: "Cancel",
                        defeat: 'Ok',
                    },
                })
                .then((value) => {
                    if(value=='defeat'){
                        window.location.href = url; 
                    }
                });
            }
        </script>

    </body>
</html>
