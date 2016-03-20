<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h3>Prisoners</h3>
			<br />
			<button class="btn btn-success" onclick="new_record()"><i class="glyphicon glyphicon-plus"></i> Add New Prisoner</button>
			<br />
			<br />
			<!-- <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%"> -->
			<table id="table" class="table table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
	                    <th>Id</th>
	                    <th>Name</th>
	                    <th>Father Name</th>
	                    <th>Grand Father Name</th>
	                    <th>Age</th>
	                    <th>Marital Status Id</th>
	                    <th>Num of Children</th>
	                    <th>Criminal History</th>
	                    <th>Permanent Province Id</th>
	                    <th>Permanent District Id</th>
	                    <th>Present Province Id</th>
	                    <th>Present District Id</th>
	                    <th>Profile Pic</th>
	                    <th>Actions</th>
	                </tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		
		<script src="<?php echo base_url('assets/datatables/media/js/jquery.dataTables.min.js')?>"></script>
		<script src="<?php echo base_url('assets/datatables/media/js/dataTables.bootstrap.js')?>"></script>
		<script src="<?php echo base_url('assets/underscore-min.js')?>"></script>
		  
		<script type= 'text/javascript'>
			var save_method; //for save method string
		    var oTable;
		    var provincesList = <?= json_encode($provincesList) ?>;
		    var districtsList = <?= json_encode($districtsList) ?>;

            $(document).ready(function () {
            	$("li#prisoners", ".navbar-nav").addClass("active");
            	
                oTable = $('#table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    // "bJQueryUI": true,
                    "ajax": "<?php echo site_url('prisoner/prisoner_list')?>",
                    // "sDom": 'T<"clear">lfrtip'
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
						$('p#id', '#modal_form_view').html(data.id);
						$('p#name', '#modal_form_view').html(data.name);
						$('p#fatherName', '#modal_form_view').html(data.father_name);
						$('p#grandFatherName', '#modal_form_view').html(data.grand_father_name);
						$('p#age', '#modal_form_view').html(data.age);
						$('p#maritalStatus', '#modal_form_view').html(data.marital_status_id);
						$('p#numOfChildren', '#modal_form_view').html(data.num_of_children);
						$('p#criminalHistory', '#modal_form_view').html(data.criminal_history===1? 'Yes': 'No');
						$('p#permanentProvince', '#modal_form_view').html(data.permanent_province_id);
						$('p#permanentDistrict', '#modal_form_view').html(data.permanent_district_id);
						$('p#presentProvince', '#modal_form_view').html(data.present_province_id);
						$('p#presentDistrict', '#modal_form_view').html(data.present_district_id);
						$('img#profilePic', '#modal_form_view').attr("src", data.profile_pic);

						$('#modal_form_view').modal('show'); // show bootstrap modal when complete loaded
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
						$('p#id', '#modal_form_edit').html(data.prisoner.id);
						$('[name="id"]', '#modal_form_edit').val(data.prisoner.id);
						$('[name="name"]', '#modal_form_edit').val(data.prisoner.name);
						$('[name="fatherName"]', '#modal_form_edit').val(data.prisoner.father_name);
						$('[name="grandFatherName"]', '#modal_form_edit').val(data.prisoner.grand_father_name);
						$('[name="age"]', '#modal_form_edit').val(data.prisoner.age);
						$('[name="maritalStatus"]', '#modal_form_edit').val(data.prisoner.marital_status_id);
						$('[name="numOfChildren"]', '#modal_form_edit').val(data.prisoner.num_of_children);
						$('[name="criminalHistory"]', '#modal_form_edit').prop('checked', (data.prisoner.criminal_history===1||data.prisoner.criminal_history==='1'? true: false));
						$('[name="permanentProvince"]', '#modal_form_edit').val(data.prisoner.permanent_province_id);

						var permanentDistrictsSelectEl = $('[name="permanentDistrict"]', '#modal_form_edit');
						render_district_list(data.permanentDistricts, permanentDistrictsSelectEl);
						// $.each(data.permanentDistricts, function(index, value) {
						// 	// if (data.prisoner.permanent_district_id === value.id) {
						// 	// 	$('<option>').attr('value', value.id).attr('selected', true).html(value.group_name).appendTo(permanentDistrictsSelectEl);
						// 	// } else {
						// 		$('<option>').attr('value', value.id).html(value.name).appendTo(permanentDistrictsSelectEl);
						// 	// }
						// });

						$('[name="permanentDistrict"]', '#modal_form_edit').val(data.prisoner.permanent_district_id);
						$('[name="presentProvince"]', '#modal_form_edit').val(data.prisoner.present_province_id);

						var presentDistrictsSelectEl = $('[name="presentDistrict"]', '#modal_form_edit');
						render_district_list(data.presentDistricts, presentDistrictsSelectEl);
						// $.each(data.presentDistricts, function(index, value) {
						// 	// if (data.prisoner.present_district_id === value.id) {
						// 	// 	$('<option>').attr('value', value.id).attr('selected', true).html(value.group_name).appendTo(presentDistrictsSelectEl);
						// 	// } else {
						// 		$('<option>').attr('value', value.id).html(value.name).appendTo(presentDistrictsSelectEl);
						// 	// }
						// });

						$('[name="presentDistrict"]', '#modal_form_edit').val(data.prisoner.present_district_id);
						$('[name="profilePic"]', '#modal_form_edit').attr("src", data.prisoner.profile_pic);

						$('#modal_form_edit').modal('show'); // show bootstrap modal when complete loaded
						$('.modal-title', '#modal_form_edit').text('Edit User'); // Set Title to Bootstrap modal title
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
							//if success reload ajax table
							$('#modal_form_edit').modal('hide');
							reload_table();
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

				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: $('#form', '#modal_form_edit').serialize(),
					dataType: "JSON",
					success: function(data)
					{
						//if success close modal and reload ajax table
						$('#modal_form_edit').modal('hide');
						reload_table();
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error adding / update data');
					}
				});
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
								<label class="col-sm-4 control-label">ID</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Name</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="name"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Father Name</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="fatherName"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Grand Father Name</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="grandFatherName"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Age</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="age"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Marital Status</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="maritalStatus"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"># of Children</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="numOfChildren"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Criminal History</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="criminalHistory"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Permanent Province</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="permanentProvince"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Permanent District</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="permanentDistrict"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Present Province</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="presentProvince"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Present District</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="presentDistrict"></p>
								</div>
							</div>
							<img id="profilePic" alt="Profile Photo" class="img-rounded">
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
								<label class="col-sm-4 control-label">ID</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Name</label>
								<div class="col-md-8">
									<input name="name" placeholder="Name" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Father Name</label>
								<div class="col-md-8">
									<input name="fatherName" placeholder="Father Name" class="form-control" type="text">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Grand Father Name</label>
								<div class="col-sm-8">
									<input name="grandFatherName" placeholder="Grand Father Name" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Age</label>
								<div class="col-sm-8">
									<input name="age" placeholder="Age" class="form-control" type="number">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Marial Status</label>
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
								<label class="col-sm-4 control-label">Num of Children</label>
								<div class="col-sm-8">
									<input name="numOfChildren" placeholder="Number of Children" class="form-control" type="number">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"></label>
								<div class="col-sm-8">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="criminalHistory"> Criminal History
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Permanent Province</label>
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
								<label class="control-label col-sm-4">Permanent District</label>
								<div class="col-sm-8">
									<select name="permanentDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Present Province</label>
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
								<label class="control-label col-sm-4">Present District</label>
								<div class="col-sm-8">
									<select name="presentDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Profile Photo</label>
								<div class="col-sm-8">
									<input name="profilePic" placeholder="Number of Children" class="form-control" type="file" size="20">
								</div>
							</div>
							<div class="form-group">
								<!-- <label class="control-label col-sm-4">Profile Photo</label> -->
								<div class="col-sm-12">
									<div class="thumbnail">
										<img name="profilePicc" src="<?php echo base_url('photos/profile_pic01.jpg')?>" alt="Profile Photo" class="img-rounded">
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