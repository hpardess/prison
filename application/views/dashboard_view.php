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
			</div>
		</div>

		<script type= 'text/javascript'>
            $(document).ready(function () {
            	$("li#dashboard", ".navbar-nav").addClass("active");
            });
        </script>
		<?php $this->load->view('footer'); ?>
	</body>
</html>
