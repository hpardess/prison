<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h3>Crimes</h3>
			<br />
			<button class="btn btn-success" onclick="new_record()"><i class="glyphicon glyphicon-plus"></i> Register New Crime</button>
			<br />
			<br />
			<!-- <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%"> -->
			<table id="table" class="table table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
	                    <th>Id</th>
	                    <th>Crime Date</th>
	                    <th>Police Custody</th>
	                    <th>Crime Location</th>
	                    <th>Crime District Id</th>
	                    <th>Crime Province Id</th>
	                    <th>Arrest Location</th>
	                    <th>Arrest District Id</th>
	                    <th>Arrest Province Id</th>
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
            	$("li#criminal_cases", ".navbar-nav").addClass("active");
            	
                oTable = $('#table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    // "bJQueryUI": true,
                    "ajax": "<?php echo site_url('crime/crime_list')?>",
                    // "sDom": 'T<"clear">lfrtip'
                });

                $('[name="crimeProvince"]', '#modal_form_edit').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="crimeDistrict"]', '#modal_form_edit'));
                });

                $('[name="arrestProvince"]', '#modal_form_edit').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="arrestDistrict"]', '#modal_form_edit'));
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
				$('[name="crimeDistrict"]', '#modal_form_edit').empty();
				$('[name="arrestDistrict"]', '#modal_form_edit').empty();

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
					url : "<?php echo site_url('crime/view/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						$('p#id', '#modal_form_view').html(data.id);
						$('p#crimeDate', '#modal_form_view').html(data.crime_date);
						$('p#policeCustody', '#modal_form_view').html(data.police_custody);
						$('p#crimeProvince', '#modal_form_view').html(data.crime_province_id);
						$('p#crimeDistrict', '#modal_form_view').html(data.crime_district_id);
						$('p#crimeLocation', '#modal_form_view').html(data.crime_location);
						$('p#arrestProvince', '#modal_form_view').html(data.arrest_province_id);
						$('p#arrestDistrict', '#modal_form_view').html(data.arrest_district_id);
						$('p#arrestLocation', '#modal_form_view').html(data.arrest_location);

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
				$('[name="crimeDistrict"]', '#modal_form_edit').empty();
				$('[name="arrestDistrict"]', '#modal_form_edit').empty();

				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('crime/edit/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						$('p#id', '#modal_form_edit').html(data.crime.id);
						$('[name="id"]', '#modal_form_edit').val(data.crime.id);
						$('[name="crimeDate"]', '#modal_form_edit').val(data.crime.crime_date);
						$('[name="policeCustody"]', '#modal_form_edit').val(data.crime.police_custody);
						$('[name="crimeProvince"]', '#modal_form_edit').val(data.crime.crime_province_id);
						var crimeDistrictsSelectEl = $('[name="crimeDistrict"]', '#modal_form_edit');
						render_district_list(data.crimeDistricts, crimeDistrictsSelectEl);
						$('[name="crimeDistrict"]', '#modal_form_edit').val(data.crime.crime_district_id);
						$('[name="crimeLocation"]', '#modal_form_edit').val(data.crime.crime_location);
						$('[name="arrestProvince"]', '#modal_form_edit').val(data.crime.arrest_province_id);
						var arrestDistrictsSelectEl = $('[name="arrestDistrict"]', '#modal_form_edit');
						render_district_list(data.arrestDistricts, arrestDistrictsSelectEl);
						$('[name="arrestDistrict"]', '#modal_form_edit').val(data.crime.arrest_district_id);
						$('[name="arrestLocation"]', '#modal_form_edit').val(data.crime.arrest_location);

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
						url : "<?php echo site_url('crime/delete')?>/"+id,
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
					url = "<?php echo site_url('crime/add')?>";
				}
				else
				{
					url = "<?php echo site_url('crime/update')?>";
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
								<label class="col-sm-4 control-label">Crime Date</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeDate"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Police Custody</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="policeCustody"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Crime Province</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeProvince"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Crime District</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeDistrict"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Crime Location</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeLocation"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Arrest Province</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="arrestProvince"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Arrest District</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="arrestDistrict"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Arrest Location</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="arrestLocation"></p>
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
								<label class="col-sm-4 control-label">ID</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Crime Date</label>
								<div class="col-md-8">
									<input name="crimeDate" placeholder="Crime Date" class="form-control" type="date">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Police Custody</label>
								<div class="col-md-8">
									<input name="policeCustody" placeholder="Police Custody" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Crime Province</label>
								<div class="col-sm-8">
									<select name="crimeProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Crime District</label>
								<div class="col-sm-8">
									<select name="crimeDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Crime Location</label>
								<div class="col-sm-8">
									<input name="crimeLocation" placeholder="Crime Location" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Arrest Province</label>
								<div class="col-sm-8">
									<select name="arrestProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Arrest District</label>
								<div class="col-sm-8">
									<select name="arrestDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Arrest Location</label>
								<div class="col-sm-8">
									<input name="arrestLocation" placeholder="Arrest Location" class="form-control" type="text">
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