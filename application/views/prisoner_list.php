<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;" dir="<?=$this->session->userdata('direction') ?>">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h3>
				&nbsp;<?= $this->lang->line('prisoners'); ?>&nbsp;
				<button class="btn btn-success pull-right" onclick="new_record()"><i class="glyphicon glyphicon-plus"></i> Add New Prisoner</button>
			</h3>
			
			<hr />
			<!-- <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%"> -->
			<table id="table" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
	                    <th><?= $this->lang->line('id'); ?></th>
	                    <th><?= $this->lang->line('name'); ?></th>
	                    <th><?= $this->lang->line('father_name'); ?></th>
	                    <th><?= $this->lang->line('grand_father_name'); ?></th>
	                    <th><?= $this->lang->line('age'); ?></th>
	                    <th><?= $this->lang->line('marital_status'); ?></th>
	                    <th><?= $this->lang->line('num_of_children'); ?></th>
	                    <th><?= $this->lang->line('criminal_history'); ?></th>
	                    <th><?= $this->lang->line('permanent_province'); ?></th>
	                    <th><?= $this->lang->line('permanent_district'); ?></th>
	                    <th><?= $this->lang->line('present_province'); ?></th>
	                    <th><?= $this->lang->line('present_district'); ?></th>
	                    <th><?= $this->lang->line('profile_pic'); ?></th>
	                    <th>Actions</th>
	                </tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		
		<link rel="stylesheet" href="<?php echo base_url("assets/datatables/media/css/dataTables.bootstrap.min.css"); ?>" />
		<script src="<?php echo base_url('assets/datatables/media/js/jquery.dataTables.min.js')?>"></script>
		<script src="<?php echo base_url('assets/datatables/media/js/dataTables.bootstrap.min.js')?>"></script>
		<script src="<?php echo base_url('assets/underscore-min.js')?>"></script>
		  
		<script type= 'text/javascript'>
			var save_method; //for save method string
		    var oTable;
		    var provincesList = <?= json_encode($provincesList) ?>;
		    var districtsList = <?= json_encode($districtsList) ?>;
		    var photos_directory = "<?= base_url('photos/') ?>";

            $(document).ready(function () {
            	$("li#prisoners", ".navbar-nav").addClass("active");
            	$("input[type='date']").datepicker({
            		dateFormat: "yy-mm-dd"
            	});
            	
                oTable = $('#table').DataTable({
                	"scrollX": true,
                    "processing": true,
                    "serverSide": true,
                    // "bJQueryUI": true,
                    "ajax": "<?php echo site_url('prisoner/prisoner_list')?>",
                    // "sDom": 'T<"clear">lfrtip'
					language: {
						search: "<?= $this->lang->line('search'); ?>"
					},
					columnDefs: [{
						"targets": 13,
						"searchable": false,
						"orderable": false,
						"width": "125px"
					}]
                });

                $('[name="permanentProvince"]', '#modal_form_edit').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="permanentDistrict"]', '#modal_form_edit'));
                });

                $('[name="presentProvince"]', '#modal_form_edit').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="presentDistrict"]', '#modal_form_edit'));
                });
            });

            function get_district_list(province_id)
            {
            	return _.where(districtsList, {"province_id": province_id});
            }

            function render_district_list(district_list, selectEl)
            {
            	$(selectEl).empty();
            	$('<option>').appendTo(selectEl);
            	$.each(district_list, function(index, value) {
					$('<option>').attr('value', value.id).html(value.name).appendTo(selectEl);
				});
            }

			function new_record()
			{
				save_method = 'new';
				$('#form', '#modal_form_edit')[0].reset(); // reset form on modals
				$('[name="permanentDistrict"]', '#modal_form_edit').empty();
				$('[name="presentDistrict"]', '#modal_form_edit').empty();

				// $.ajax({
				// 	url : "<?php echo site_url('prisoner/new_prisoner/')?>",
				// 	type: "GET",
				// 	dataType: "JSON",
				// 	success: function(data)
				// 	{
				// 		var groupsSelectEl = $('[name="group"]', '#modal_form_edit');
				// 		$.each(data, function(index, value) {
				// 			$('<option>').attr('value', value.id).html(value.group_name).appendTo(groupsSelectEl);
				// 		});

						$('#modal_form_edit').modal('show'); // show bootstrap modal when complete loaded
						$('.modal-title', '#modal_form_edit').text('Add New User'); // Set Title to Bootstrap modal title
				// 	},
				// 	error: function (jqXHR, textStatus, errorThrown)
				// 	{
				// 		alert('Error get data from ajax');
				// 	}
				// });
			}

            function view_record(id)
			{
				save_method = 'update';
				$('#form', '#modal_form_view')[0].reset(); // reset form on modals

				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('prisoner/view/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						if(data.success === true) {
							$('p#id', '#modal_form_view').html(data.result.id);
							$('p#name', '#modal_form_view').html(data.result.name);
							$('p#fatherName', '#modal_form_view').html(data.result.father_name);
							$('p#grandFatherName', '#modal_form_view').html(data.result.grand_father_name);
							$('p#age', '#modal_form_view').html(data.result.age);
							$('p#maritalStatus', '#modal_form_view').html(data.result.marital_status);
							$('p#numOfChildren', '#modal_form_view').html(data.result.num_of_children);
							$('p#criminalHistory', '#modal_form_view').html(data.result.criminal_history===1? 'Yes': 'No');
							$('p#permanentProvince', '#modal_form_view').html(data.result.permanent_province);
							$('p#permanentDistrict', '#modal_form_view').html(data.result.permanent_district);
							$('p#presentProvince', '#modal_form_view').html(data.result.present_province);
							$('p#presentDistrict', '#modal_form_view').html(data.result.present_district);
							
							if(data.result.profile_pic !== '' && data.result.profile_pic !== null)
							{
								$('img#profilePic', '#modal_form_view').attr("src", photos_directory + '/' + data.result.profile_pic);
								$('img#profilePic', '#modal_form_view').attr("alt", 'Failed to display the photo.');
							}
							else
							{
								$('img#profilePic', '#modal_form_view').attr("alt", 'Profile photo is not uploaded.');
							}

							$('#modal_form_view').modal('show'); // show bootstrap modal when complete loaded
						} else {
							alert(data.message);
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error get data from ajax');
					}
				});
			}

			function edit_record(id)
			{
				save_method = 'update';
				$('#form', '#modal_form_edit')[0].reset(); // reset form on modals
				$('p#id', '#modal_form_edit').empty();
				$('[name="permanentDistrict"]', '#modal_form_edit').empty();
				$('[name="presentDistrict"]', '#modal_form_edit').empty();

				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('prisoner/edit/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						if(data.success === true) {
							$('p#id', '#modal_form_edit').html(data.result.prisoner.id);
							$('[name="id"]', '#modal_form_edit').val(data.result.prisoner.id);
							$('[name="name"]', '#modal_form_edit').val(data.result.prisoner.name);
							$('[name="fatherName"]', '#modal_form_edit').val(data.result.prisoner.father_name);
							$('[name="grandFatherName"]', '#modal_form_edit').val(data.result.prisoner.grand_father_name);
							$('[name="age"]', '#modal_form_edit').val(data.result.prisoner.age);
							$('[name="maritalStatus"]', '#modal_form_edit').val(data.result.prisoner.marital_status_id);
							$('[name="numOfChildren"]', '#modal_form_edit').val(data.result.prisoner.num_of_children);
							$('[name="criminalHistory"]', '#modal_form_edit').prop('checked', (data.result.prisoner.criminal_history===1||data.result.prisoner.criminal_history==='1'? true: false));
							$('[name="permanentProvince"]', '#modal_form_edit').val(data.result.prisoner.permanent_province_id);

							var permanentDistrictsSelectEl = $('[name="permanentDistrict"]', '#modal_form_edit');
							render_district_list(data.result.permanentDistricts, permanentDistrictsSelectEl);

							$('[name="permanentDistrict"]', '#modal_form_edit').val(data.result.prisoner.permanent_district_id);
							$('[name="presentProvince"]', '#modal_form_edit').val(data.result.prisoner.present_province_id);

							var presentDistrictsSelectEl = $('[name="presentDistrict"]', '#modal_form_edit');
							render_district_list(data.result.presentDistricts, presentDistrictsSelectEl);

							$('[name="presentDistrict"]', '#modal_form_edit').val(data.result.prisoner.present_district_id);

							if(data.result.prisoner.profile_pic !== '' && data.result.prisoner.profile_pic !== null)
							{
								$('img#profilePicDisplay', '#modal_form_edit').attr("src", photos_directory + '/' + data.result.prisoner.profile_pic);
								$('img#profilePicDisplay', '#modal_form_edit').attr("alt", 'Failed to display the photo.');
							}
							else
							{
								$('img#profilePicDisplay', '#modal_form_edit').attr("alt", 'Profile photo is not uploaded.');
							}

							$('#modal_form_edit').modal('show'); // show bootstrap modal when complete loaded
							$('.modal-title', '#modal_form_edit').text('Edit User'); // Set Title to Bootstrap modal title
						} else {
							alert(data.message);
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error get data from ajax');
					}
				});
			}

			function delete_record(id)
			{
				if(confirm('Are you sure delete this data?'))
				{
					// ajax delete data to database
					$.ajax({
						url : "<?php echo site_url('prisoner/delete')?>/"+id,
						type: "POST",
						dataType: "JSON",
						success: function(data)
						{
							if(data.success === true) {
								//if success reload ajax table
								$('#modal_form_edit').modal('hide');
								reload_table();
							} else {
								alert(data.message);
							}
						},
						error: function (jqXHR, textStatus, errorThrown)
						{
							alert('Error adding / update data');
						}
					});

				}
			}

			function reload_table()
			{
				oTable.ajax.reload(null,false); //reload datatable ajax
			}

			function save_record()
			{
				var url;
				if(save_method == 'new')
				{
					url = "<?php echo site_url('prisoner/add')?>";
				}
				else
				{
					url = "<?php echo site_url('prisoner/update')?>";
				}

				var formData = new FormData($('#form', '#modal_form_edit')[0]);

				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: formData,
					mimeType: "multipart/form-data",
					contentType: false,
					cache: false,
					processData: false,
					success: function(data)
					{
						data = JSON.parse(data);
						if(data.success === true)
						{
							$('#modal_form_edit').modal('hide');
							reload_table();
						}
						else
						{
							alert(data.message);
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error adding / update data');
					}
				});

				// ajax adding data to database
				// $.ajax({
				// 	url : url,
				// 	type: "POST",
				// 	data: $('#form', '#modal_form_edit').serialize(),
				// 	dataType: "JSON",
				// 	success: function(data)
				// 	{
				// 		//if success close modal and reload ajax table
				// 		$('#modal_form_edit').modal('hide');
				// 		reload_table();
				// 	},
				// 	error: function (jqXHR, textStatus, errorThrown)
				// 	{
				// 		alert('Error adding / update data');
				// 	}
				// });
			}
        </script>

        <!-- Bootstrap modal View-->
		<div class="modal fade" id="modal_form_view" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title">View User</h3>
					</div>
					<div class="modal-body form">
						<form action="#" id="form" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('name'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="name"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('father_name'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="fatherName"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('grand_father_name'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="grandFatherName"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('age'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="age"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('marital_status'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="maritalStatus"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('num_of_children'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="numOfChildren"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('criminal_history'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="criminalHistory"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('permanent_province'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="permanentProvince"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('permanent_district'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="permanentDistrict"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('present_province'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="presentProvince"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('present_district'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="presentDistrict"></p>
								</div>
							</div>
							<div class="form-group">
								<!-- <label class="control-label col-sm-4">Profile Photo</label> -->
								<div class="col-sm-12">
									<div class="thumbnail">
										<img id="profilePic" alt="Profile Photo not exist" class="img-rounded">
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- End Bootstrap modal -->

		<!-- Bootstrap modal Edit-->
		<div class="modal fade" id="modal_form_edit" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title">Edit User</h3>
					</div>
					<div class="modal-body form">
						<form action="#" id="form" class="form-horizontal">
							<input type="hidden" value="" name="id"/>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('name'); ?></label>
								<div class="col-md-8">
									<input name="name" placeholder="Name" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('father_name'); ?></label>
								<div class="col-md-8">
									<input name="fatherName" placeholder="Father Name" class="form-control" type="text">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('grand_father_name'); ?></label>
								<div class="col-sm-8">
									<input name="grandFatherName" placeholder="Grand Father Name" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('age'); ?></label>
								<div class="col-sm-8">
									<input name="age" placeholder="Age" class="form-control" type="number">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('marital_status'); ?></label>
								<div class="col-sm-8">
									<select name="maritalStatus" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($maritalStatusList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->status . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('num_of_children'); ?></label>
								<div class="col-sm-8">
									<input name="numOfChildren" placeholder="Number of Children" class="form-control" type="number">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"></label>
								<div class="col-sm-8">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="criminalHistory"> <?= $this->lang->line('criminal_history'); ?>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('permanent_province'); ?></label>
								<div class="col-sm-8">
									<select name="permanentProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('permanent_district'); ?></label>
								<div class="col-sm-8">
									<select name="permanentDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('present_province'); ?></label>
								<div class="col-sm-8">
									<select name="presentProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('present_district'); ?></label>
								<div class="col-sm-8">
									<select name="presentDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('profile_pic'); ?></label>
								<div class="col-sm-8">
									<input name="profilePic" placeholder="Number of Children" class="form-control" type="file" size="20">
								</div>
							</div>
							<div class="form-group">
								<!-- <label class="control-label col-sm-4">Profile Photo</label> -->
								<div class="col-sm-12">
									<div class="thumbnail">
										<img id="profilePicDisplay" alt="Profile Photo" class="img-rounded">
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnSave" onclick="save_record()" class="btn btn-primary">Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- End Bootstrap modal -->
		<?php $this->load->view('footer'); ?>
	</body>
</html>