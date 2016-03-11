<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h1><?php echo $title; ?></h1>
	        <?php echo $message; ?>
	        <form method="post" action="<?php echo $action; ?>">
	        <div class="data">
	        <table>
	            <tr>
	                <td width="30%">ID</td>
	                <td><input type="text" name="id" disabled="disable" class="text" value="<?php echo $this->validation->id; ?>"/></td>
	                <input type="hidden" name="id" value="<?php echo $this->validation->id; ?>"/>
	            </tr>
	            <tr>
	                <td valign="top">Name<span style="color:red;">*</span></td>
	                <td><input type="text" name="name" class="text" value="<?php echo $this->validation->name; ?>"/>
	                <?php echo $this->validation->name_error; ?></td>
	            </tr>
	            <tr>
	                <td valign="top">Gender<span style="color:red;">*</span></td>
	                <td><input type="radio" name="gender" value="M" <?php echo $this->validation->set_radio('gender', 'M'); ?>/> M
	                    <input type="radio" name="gender" value="F" <?php echo $this->validation->set_radio('gender', 'F'); ?>/> F
	                    <?php echo $this->validation->gender_error; ?></td>
	            </tr>
	            <tr>
	                <td valign="top">Date of birth (dd-mm-yyyy)<span style="color:red;">*</span></td>
	                <td><input type="text" name="dob" onclick="displayDatePicker('dob');" class="text" value="<?php echo $this->validation->dob; ?>"/>
	                <a href="javascript:void(0);" onclick="displayDatePicker('dob');"><img src="<?php echo base_url(); ?>style/images/calendar.png" alt="calendar" border="0"></a>
	                <?php echo $this->validation->dob_error; ?></td>
	            </tr>
	            <tr>
	                <td>&nbsp;</td>
	                <td><input type="submit" value="Save"/></td>
	            </tr>
	        </table>
	        </div>
	        </form>
	        <br />
	        <?php echo $link_back; ?>
		</div>
		<?php $this->load->view('footer'); ?>
	</body>
</html>