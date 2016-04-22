<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;" dir="<?=$this->session->userdata('direction') ?>">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h3>
				&nbsp;<?= $this->lang->line('general_list'); ?>&nbsp;
				<a class="btn btn-success pull-right" href="<?= base_url() ?>index.php/general/new_case"><i class="glyphicon glyphicon-plus"></i> <?= $this->lang->line('add_new'); ?></a>
			</h3>
			<hr />
			<!-- <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%"> -->
			<table id="table" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?= $this->lang->line('prisoner_id'); ?></th>
						<th><?= $this->lang->line('name'); ?></th>
						<th><?= $this->lang->line('father_name'); ?></th>
						<th><?= $this->lang->line('grand_father_name'); ?></th>
						<th><?= $this->lang->line('age'); ?></th>
						<th><?= $this->lang->line('criminal_history'); ?></th>
						<th><?= $this->lang->line('marital_status'); ?></th>
						<th><?= $this->lang->line('num_of_children'); ?></th>
						<th><?= $this->lang->line('present_province'); ?></th>
						<th><?= $this->lang->line('present_district'); ?></th>
						<th><?= $this->lang->line('permanent_province'); ?></th>
						<th><?= $this->lang->line('permanent_district'); ?></th>
						<th><?= $this->lang->line('profile_pic'); ?></th>

	                    <th><?= $this->lang->line('crime_id'); ?></th>
	                    <th><?= $this->lang->line('case_number'); ?></th>
	                    <th><?= $this->lang->line('crime_date'); ?></th>
	                    <th><?= $this->lang->line('crime_location'); ?></th>
	                    <th><?= $this->lang->line('arrest_location'); ?></th>
	                    <th><?= $this->lang->line('police_custody'); ?></th>
	                    <th><?= $this->lang->line('crime_province'); ?></th>
	                    <th><?= $this->lang->line('crime_district'); ?></th>
	                    <th><?= $this->lang->line('arrest_province'); ?></th>
	                    <th><?= $this->lang->line('arrest_district'); ?></th>
	                    <th><?= $this->lang->line('time_spent_in_prison'); ?></th>
	                    <th><?= $this->lang->line('remaining_jail_term'); ?></th>
	                    <th><?= $this->lang->line('use_benefit_forgiveness_presidential'); ?></th>
	                    <th><?= $this->lang->line('command_issue_date'); ?></th>
	                    <th><?= $this->lang->line('commission_proposal'); ?></th>
	                    <th><?= $this->lang->line('prisoner_request'); ?></th>
	                    <th><?= $this->lang->line('commission_member'); ?></th>

	                    <th><?= $this->lang->line('actions'); ?></th>
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
            	$("li#general", ".navbar-nav").addClass("active");
            	$("input[type='date']").datepicker({
            		dateFormat: "yy-mm-dd"
            	});
            	
                oTable = $('#table').DataTable({
                	"scrollX": true,
                    "processing": true,
                    "serverSide": true,
                    "sServerMethod": "POST",
                    // "bJQueryUI": true,
                    "ajax": "<?php echo site_url('general/general_list')?>",
                    // "sDom": 'T<"clear">lfrtip'
                    language: {
						search: "<?= $this->lang->line('search'); ?>"
					},
					columnDefs: [{
						"targets": 30,
						"searchable": false,
						"orderable": false,
						"width": "125px"
					}]
                });

                // $('[name="permanentProvince"]', '#modal_form_edit').change(function(event) {
                // 	render_district_list(get_district_list(event.currentTarget.value), $('[name="permanentDistrict"]', '#modal_form_edit'));
                // });

                // $('[name="presentProvince"]', '#modal_form_edit').change(function(event) {
                // 	render_district_list(get_district_list(event.currentTarget.value), $('[name="presentDistrict"]', '#modal_form_edit'));
                // });

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
				$('[name="permanentDistrict"]', '#modal_form_edit').empty();
				$('[name="presentDistrict"]', '#modal_form_edit').empty();
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
					url : "<?php echo site_url('general/view/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						$('p#id', '#modal_form_view').html(data.id);
						$('p#caseNumber', '#modal_form_view').html(data.case_number);
						$('p#crimeDate', '#modal_form_view').html(data.crime_date);
						$('p#policeCustody', '#modal_form_view').html(data.police_custody);
						$('p#crimeProvince', '#modal_form_view').html(data.crime_province);
						$('p#crimeDistrict', '#modal_form_view').html(data.crime_district);
						$('p#crimeLocation', '#modal_form_view').html(data.crime_location);
						$('p#arrestProvince', '#modal_form_view').html(data.arrest_province);
						$('p#arrestDistrict', '#modal_form_view').html(data.arrest_district);
						$('p#arrestLocation', '#modal_form_view').html(data.arrest_location);

						$('p#timeSpentInPrison', '#modal_form_view').html(data.time_spent_in_prison);
						$('p#remainingJailTerm', '#modal_form_view').html(data.remaining_jail_term);
						$('p#useBenefitForgivenessPresidential', '#modal_form_view').html(data.use_benefit_forgiveness_presidential);
						$('p#commandIssueDate', '#modal_form_view').html(data.command_issue_date);
						$('p#commissionProposal', '#modal_form_view').html(data.commission_proposal);
						$('p#prisonerRequest', '#modal_form_view').html(data.prisoner_request);
						$('p#commissionMember', '#modal_form_view').html(data.commission_member);

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
					url : "<?php echo site_url('general/edit/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						$('p#id', '#modal_form_edit').html(data.crime.id);
						$('[name="id"]', '#modal_form_edit').val(data.crime.id);
						$('[name="caseNumber"]', '#modal_form_edit').val(data.crime.case_number);
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

						$('[name="timeSpentInPrison"]', '#modal_form_edit').val(data.crime.time_spent_in_prison);
						$('[name="remainingJailTerm"]', '#modal_form_edit').val(data.crime.remaining_jail_term);
						$('[name="useBenefitForgivenessPresidential"]', '#modal_form_edit').val(data.crime.use_benefit_forgiveness_presidential);
						$('[name="commandIssueDate"]', '#modal_form_edit').val(data.crime.command_issue_date);
						$('[name="commissionProposal"]', '#modal_form_edit').val(data.crime.commission_proposal);
						$('[name="prisonerRequest"]', '#modal_form_edit').val(data.crime.prisoner_request);
						$('[name="commissionMember"]', '#modal_form_edit').val(data.crime.commission_member);

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
						url : "<?php echo site_url('general/delete')?>/"+id,
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
					url = "<?php echo site_url('general/add')?>";
				}
				else
				{
					url = "<?php echo site_url('general/update')?>";
				}

				var formData = new FormData($('#form', '#modal_form_edit')[0]);

				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: $('#form', '#modal_form_edit').serialize(),
					dataType: "JSON",
					success: function(data)
					{
						if(data.success === true)
						{
							// $('#modal_form_edit').modal('hide');
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
								<label class="col-sm-4 control-label"><?= $this->lang->line('case_number'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="caseNumber"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_date'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeDate"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('police_custody'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="policeCustody"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_province'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeProvince"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_district'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeDistrict"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_location'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeLocation"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_province'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="arrestProvince"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_district'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="arrestDistrict"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_location'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="arrestLocation"></p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('time_spent_in_prison'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="timeSpentInPrison"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('remaining_jail_term'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="remainingJailTerm"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('use_benefit_forgiveness_presidential'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="useBenefitForgivenessPresidential"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('command_issue_date'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="commandIssueDate"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('commission_proposal'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="commissionProposal"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('prisoner_request'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="prisonerRequest"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('commission_member'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="commissionMember"></p>
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
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('case_number'); ?></label>
								<div class="col-md-8">
									<input name="caseNumber" placeholder="Case Number" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('crime_date'); ?></label>
								<div class="col-md-8">
									<input name="crimeDate" placeholder="Crime Date" class="form-control" type="date">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('police_custody'); ?></label>
								<div class="col-md-8">
									<input name="policeCustody" placeholder="Police Custody" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_province'); ?></label>
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
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_district'); ?></label>
								<div class="col-sm-8">
									<select name="crimeDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_location'); ?></label>
								<div class="col-sm-8">
									<input name="crimeLocation" placeholder="Crime Location" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_province'); ?></label>
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
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_district'); ?></label>
								<div class="col-sm-8">
									<select name="arrestDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_location'); ?></label>
								<div class="col-sm-8">
									<input name="arrestLocation" placeholder="Arrest Location" class="form-control" type="text">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('time_spent_in_prison'); ?></label>
								<div class="col-sm-8">
									<input name="timeSpentInPrison" placeholder="Time Spent_in Prison" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('remaining_jail_term'); ?></label>
								<div class="col-sm-8">
									<input name="remainingJailTerm" placeholder="Remaining Jail Term" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('use_benefit_forgiveness_presidential'); ?></label>
								<div class="col-sm-8">
									<input name="useBenefitForgivenessPresidential" placeholder="Use Benefit Forgiveness Presidential" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('command_issue_date'); ?></label>
								<div class="col-sm-8">
									<input name="commandIssueDate" placeholder="Command Issue Date" class="form-control" type="date">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('commission_proposal'); ?></label>
								<div class="col-sm-8">
									<input name="commissionProposal" placeholder="Commission Proposal" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('prisoner_request'); ?></label>
								<div class="col-sm-8">
									<input name="prisonerRequest" placeholder="Prisoner Request" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('commission_member'); ?></label>
								<div class="col-sm-8">
									<input name="commissionMember" placeholder="Commission Member" class="form-control" type="text">
								</div>
							</div>

<!-- Iteration of Court Types -->
							<?php foreach ($courtDecisionTypeList as $key => $value) { ?>
							
							<fieldset>
								<legend><?= $value->decision_type_name; ?></legend>

								<!-- <div class="form-group">
									<label class="control-label col-md-12"><?= $value->decision_type_name; ?></label>
								</div> -->

								<input type="hidden" value="<?= $value->id ?>" name="courtDecisionType[]"/>
								<!-- <div class="form-group">
									<label class="control-label col-md-4"><?= $this->lang->line('crime_id'); ?></label>
									<div class="col-md-8">
										<input name="crimeId[]" placeholder="Crime Id" class="form-control" type="text">
									</div>
								</div> -->
								<!-- <div class="form-group">
									<label class="control-label col-md-4"><?= $this->lang->line('court_decision_type'); ?></label>
									<div class="col-md-8">
										<select name="courtDecisionType[]" class="form-control" class="form-control">
											<option></option>
											<?php foreach ($courtDecisionTypeList as $key => $value) {
												echo "<option value='" . $value->id . "'>" . $value->decision_type_name . "</option>";
											} ?>
										</select>
									</div>
								</div> -->
								<div class="form-group">
									<label class="col-sm-4 control-label"><?= $this->lang->line('decision_date'); ?></label>
									<div class="col-sm-8">
										<input name="decisionDate[]" placeholder="Decision Date" class="form-control" type="date">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label"><?= $this->lang->line('decision'); ?></label>
									<div class="col-sm-8">
										<input name="decision[]" placeholder="Decision" class="form-control" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_name'); ?></label>
									<div class="col-sm-8">
										<input name="defenceLawyerName[]" placeholder="defence Lawyer Name" class="form-control" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_certificate_id'); ?></label>
									<div class="col-sm-8">
										<input name="defenceLawyerCertificateId[]" placeholder="defence Lawyer Certificate Id" class="form-control" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label"><?= $this->lang->line('sentence_execution_date'); ?></label>
									<div class="col-sm-8">
										<input name="sentenceExecutionDate[]" placeholder="Sentence Execution Date" class="form-control" type="date">
									</div>
								</div>

							</fieldset>
							

							<?php } ?>
<!-- END of Iteration of Court Types -->

							

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