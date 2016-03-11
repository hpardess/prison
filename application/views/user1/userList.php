<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h1>Simple CRUD Application</h1>
	        <div class="paging"><?php echo $pagination; ?></div>
	        <div class="data"><?php echo $table; ?></div>
	        <br />
	        <?php echo anchor('user1/add/','add new data',array('class'=>'add')); ?>
		</div>
		<?php $this->load->view('footer'); ?>
	</body>
</html>