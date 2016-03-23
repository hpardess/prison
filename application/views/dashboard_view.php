<html>
	<head>
		<?php $this->load->view('meta'); ?>
	</head>
	<body style="padding-top: 70px;">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
		    <h1 style="color: green", align="center">Dashboard</h1>
		</div>

		<script type= 'text/javascript'>
            $(document).ready(function () {
            	$("li#dashboard", ".navbar-nav").addClass("active");
            });
        </script>
		<?php $this->load->view('footer'); ?>
	</body>
</html>
