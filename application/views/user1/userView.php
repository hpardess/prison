<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h1><?php echo $title; ?></h1>
	        <div class="data">
	        <table>
	            <tr>
	                <td width="30%">ID</td>
	                <td><?php echo $person->id; ?></td>
	            </tr>
	            <tr>
	                <td valign="top">First Name</td>
	                <td><?php echo $person->firstname; ?></td>
	            </tr>
	            <tr>
	                <td valign="top">Last Name</td>
	                <td><?php echo $person->lastname; ?></td>
	            </tr>
	            <tr>
	                <td valign="top">Username</td>
	                <td><?php echo $person->username; ?></td>
	            </tr>
	            <tr>
	                <td valign="top">isAdmin</td>
	                <td><?php echo $person->isadmin; ?></td>
	            </tr>
	            <tr>
	                <td valign="top">Email</td>
	                <td><?php echo $person->email; ?></td>
	            </tr>
	        </table>
	        </div>
	        <br />
	        <?php echo $link_back; ?>
		</div>
		<?php $this->load->view('footer'); ?>
	</body>
</html>