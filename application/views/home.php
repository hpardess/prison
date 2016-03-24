<html>
	<head>
		<?php $this->load->view('meta'); ?>
	</head>
	<body style="padding-top: 70px;" dir="<?=$this->session->userdata('direction') ?>">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
		    <h1 style="color: green", align="center">Welcome to Badam Bagh Prison Database</h1>
		</div>

		<script type= 'text/javascript'>
            $(document).ready(function () {
            	$("li#home", ".navbar-nav").addClass("active");
            });
        </script>
		<?php $this->load->view('footer'); ?>
	</body>
</html>
