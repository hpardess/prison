<html>
	<head>
		<?php $this->load->view('meta'); ?>
	</head>
	<body style="padding-top: 70px;" dir="<?=$this->session->userdata('direction') ?>">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
		    <h1 style="color: green", align="center">Dashboard</h1>
		    <div class="row">
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Summary</h3>
						</div>
						<div class="panel-body">
							<ul class="list-group">
								<li class="list-group-item">
									<span class="badge"><?php echo $total_prisoners; ?></span>
									Total Registered Prisoners
								</li>
								<li class="list-group-item">
									<span class="badge"><?php echo $total_crimes; ?></span>
									Total Registered Criminal Cases
								</li>
								<li class="list-group-item">
									<span class="badge"><?php echo $total_court_sessions; ?></span>
									Total Registered Court Sessions
									<hr />
									<span class="badge"><?php echo $total_court_sessions_primary; ?></span>
									Total Primary Decision
									<br />
									<span class="badge"><?php echo $total_court_sessions_appellate; ?></span>
									Total Appellate Decision
									<br />
									<span class="badge"><?php echo $total_court_sessions_supreme; ?></span>
									Total Supreme Decision
								</li>
							</ul>
							<ul class="list-group">
								<li class="list-group-item">
									<span class="badge"><?php echo $total_users; ?></span>
									Total Registered Users
								</li>
								<li class="list-group-item">
									<span class="badge"><?php echo $total_groups; ?></span>
									Total User Groups
								</li>
							</ul>
						</div>
					</div>
				</div>

				<!--  -->
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Prisoners Status</h3>
						</div>
						<div class="panel-body">
							<div id="container" style="min-width: 100%; height: 350px; margin: 0 auto;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="<?php echo base_url('assets/Highcharts/js/highcharts.src.js')?>"></script>
		<script src="<?php echo base_url('assets/Highcharts/js/modules/exporting.src.js')?>"></script>

		<script type= 'text/javascript'>
            $(document).ready(function () {
            	$("li#dashboard", ".navbar-nav").addClass("active");

            	$('#container').highcharts({
			        chart: {
			            plotBackgroundColor: null,
			            plotBorderWidth: 0,
			            plotShadow: false
			        },
			        title: {
			            text: 'Prisoners<br>Status',
			            align: 'center',
			            verticalAlign: 'middle',
			            y: 40
			        },
			        tooltip: {
			            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			        },
			        plotOptions: {
			            pie: {
			                dataLabels: {
			                    enabled: true,
			                    distance: -50,
			                    style: {
			                        fontWeight: 'bold',
			                        color: 'white',
			                        textShadow: '0px 1px 2px black'
			                    }
			                },
			                startAngle: -90,
			                endAngle: 90,
			                center: ['50%', '75%']
			            }
			        },
			        series: [{
			            type: 'pie',
			            name: 'Status Count',
			            innerSize: '50%',
			            data: [
			                ['Single',   10.38],
			                ['Married',       56.33],
			                ['Widow', 24.03],
			                ['Engaged',    4.77],
			                {
			                    name: 'Proprietary or Undetectable',
			                    y: 0.2,
			                    dataLabels: {
			                        enabled: false
			                    }
			                }
			            ]
			        }]
			    });



				// var options = {
				// 	chart: {
				// 		renderTo: 'container',
				// 		type: 'line',
				// 		marginRight: 130,
				// 		marginBottom: 25
				// 	},
				// 	title: {
				// 		text: 'Project Requests',
				// 		x: -20 //center
				// 	},
				// 	subtitle: {
				// 		text: '',
				// 		x: -20
				// 	},
				// 	xAxis: {
				// 		categories: []
				// 	},
				// 	yAxis: {
				// 		title: {
				// 		text: 'Requests'
				// 	},
				// 	plotLines: [{
				// 		value: 0,
				// 		width: 1,
				// 		color: '#808080'
				// 		}]
				// 	},
				// 	tooltip: {
				// 		formatter: function() {
				// 			return '<b>'+ this.series.name +'</b>'+ this.x +': '+ this.y;
				// 		}
				// 	},
				// 	legend: {
				// 		layout: 'vertical',
				// 		align: 'right',
				// 		verticalAlign: 'top',
				// 		x: -10,
				// 		y: 100,
				// 		borderWidth: 0
				// 	},

				// 	series: []
				// }

				// $.getJSON("data", function(json) {
				// 	options.xAxis.categories = json[0]['data'];
				// 	options.series[0] = json[1];
				// 	options.series[1] = json[2];
				// 	options.series[2] = json[3];
				// 	chart = new Highcharts.Chart(options);
				// });
            });
        </script>
		<?php $this->load->view('footer'); ?>
	</body>
</html>
