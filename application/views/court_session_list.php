<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;" dir="<?=$this->session->userdata('direction') ?>">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h3>
				&nbsp;<?= $this->lang->line('court_session_list'); ?>&nbsp;
				<button class="btn btn-success pull-right" onclick="new_record()"><i class="glyphicon glyphicon-plus"></i> <?= $this->lang->line('add_new'); ?></button>
			</h3>
			<hr />
			<!-- <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%"> -->
			<table id="table" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
	                    <th><?= $this->lang->line('id'); ?></th>
	                    <th><?= $this->lang->line('crime_id'); ?></th>
	                    <th><?= $this->lang->line('court_decision_type'); ?></th>
	                    <th><?= $this->lang->line('decision_date'); ?></th>
	                    <th><?= $this->lang->line('decision_date'); ?></th>
	                    <th><?= $this->lang->line('decision'); ?></th>
	                    <th><?= $this->lang->line('defence_lawyer_name'); ?></th>
	                    <th><?= $this->lang->line('defence_lawyer_certificate_id'); ?></th>
	                    <th><?= $this->lang->line('sentence_execution_date'); ?></th>
	                    <th><?= $this->lang->line('sentence_execution_date'); ?></th>
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

		<link rel="stylesheet" href="<?php echo base_url('assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css')?>" />
		<script src="<?php echo base_url('assets/datatables/extensions/Buttons/js/dataTables.buttons.min.js')?>"></script>
		<script src="<?php echo base_url('assets/datatables/extensions/Buttons/js/buttons.html5.min.js')?>"></script>
		<script src="<?php echo base_url('assets/Stuk-jszip/dist/jszip.min.js')?>"></script>
		<script src="<?php echo base_url('assets/pdfmake/build/pdfmake.min.js')?>"></script>
		<script src="<?php echo base_url('assets/pdfmake/build/vfs_fonts.js')?>"></script>
		  
		<script type= 'text/javascript'>
			var save_method; //for save method string
		    var oTable;
		    var courtDecisionTypeList = <?= json_encode($courtDecisionTypeList) ?>;

            $(document).ready(function () {
            	$("li#court_session", ".navbar-nav").addClass("active");
            	$("input[type='date']").datepicker({
            		dateFormat: "yy-mm-dd"
            	});
            	
                oTable = $('#table').DataTable({
                	"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                	"scrollX": true,
                    "processing": true,
                    "serverSide": true,
                    // "bJQueryUI": true,
                    "ajax": "<?php echo site_url('court_session/court_session_list')?>",
                    // "sDom": 'T<"clear">lfrtip'
                    language: {
						search: "<?= $this->lang->line('search'); ?>"
					},
					columnDefs: [{
						"targets": 6,
						"searchable": false,
						"orderable": false,
						"width": "125px"
					}],
					dom: 'Bfltip',
					buttons: [
						'copyHtml5',
						'excelHtml5',
						'csvHtml5',
						'pdfHtml5'
					]
                });

                // $('[name="crimeProvince"]', '#modal_form_edit').change(function(event) {
                // 	render_district_list(get_district_list(event.currentTarget.value), $('[name="crimeDistrict"]', '#modal_form_edit'));
                // });

                // $('[name="arrestProvince"]', '#modal_form_edit').change(function(event) {
                // 	render_district_list(get_district_list(event.currentTarget.value), $('[name="arrestDistrict"]', '#modal_form_edit'));
                // });
            });

    //         function get_district_list(province_id)
    //         {
    //         	return _.where(districtsList, {"province_id": province_id});
    //         }

    //         function render_district_list(district_list, selectEl)
    //         {
    //         	$(selectEl).empty();
    //         	$('<option>').appendTo(selectEl);
    //         	$.each(district_list, function(index, value) {
				// 	$('<option>').attr('value', value.id).html(value.name).appendTo(selectEl);
				// });
    //         }

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
					url : "<?php echo site_url('court_session/view/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						$('p#id', '#modal_form_view').html(data.id);
						$('p#crimeId', '#modal_form_view').html(data.crime_id);
						$('p#courtDecisionType', '#modal_form_view').html(data.court_decision_type);
						$('p#decisionDate', '#modal_form_view').html(data.decision_date);
						$('p#decision', '#modal_form_view').html(data.decision);
						$('p#defenceLawyerName', '#modal_form_view').html(data.defence_lawyer_name);
						$('p#defenceLawyerCertificateId', '#modal_form_view').html(data.defence_lawyer_certificate_id);
						$('p#sentenceExecutionDate', '#modal_form_view').html(data.sentence_execution_date);

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
					url : "<?php echo site_url('court_session/edit/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						$('p#id', '#modal_form_edit').html(data.courtSession.id);
						$('[name="id"]', '#modal_form_edit').val(data.courtSession.id);
						$('[name="crimeId"]', '#modal_form_edit').val(data.courtSession.crime_id);
						$('[name="courtDecisionType"]', '#modal_form_edit').val(data.courtSession.court_decision_type_id);
						$('[name="decisionDate"]', '#modal_form_edit').val(data.courtSession.decision_date);
						$('[name="decision"]', '#modal_form_edit').val(data.courtSession.decision);
						// var crimeDistrictsSelectEl = $('[name="crimeDistrict"]', '#modal_form_edit');
						// render_district_list(data.crimeDistricts, crimeDistrictsSelectEl);
						$('[name="defenceLawyerName"]', '#modal_form_edit').val(data.courtSession.defence_lawyer_name);
						$('[name="defenceLawyerCertificateId"]', '#modal_form_edit').val(data.courtSession.defence_lawyer_certificate_id);
						$('[name="sentenceExecutionDate"]', '#modal_form_edit').val(data.courtSession.sentence_execution_date);
						
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
						url : "<?php echo site_url('court_session/delete')?>/"+id,
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

			function lock_record(id)
			{
				if(confirm('Are you sure to lock this data?'))
				{
					// ajax delete data to database
					$.ajax({
						url : "<?php echo site_url('court_session/lock')?>/"+id,
						type: "GET",
						dataType: "JSON",
						success: function(data)
						{
							if(data.success === true) {
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

			function unlock_record(id)
			{
				if(confirm('Are you sure to unlock this data?'))
				{
					// ajax delete data to database
					$.ajax({
						url : "<?php echo site_url('court_session/unlock')?>/"+id,
						type: "GET",
						dataType: "JSON",
						success: function(data)
						{
							if(data.success === true) {
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
					url = "<?php echo site_url('court_session/add')?>";
				}
				else
				{
					url = "<?php echo site_url('court_session/update')?>";
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
								<label class="col-sm-4 control-label"><?= $this->lang->line('id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeId"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('court_decision_type'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="courtDecisionType"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('decision_date'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="decisionDate"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('decision'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="decision"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_name'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="defenceLawyerName"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_certificate_id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="defenceLawyerCertificateId"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('sentence_execution_date'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="sentenceExecutionDate"></p>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('cancel'); ?></button>
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
							<div class="form-group has-error">
								<label class="control-label col-md-4"><?= $this->lang->line('crime_id'); ?></label>
								<div class="col-md-8">
									<input name="crimeId" placeholder="Crime Id" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group has-error">
								<label class="control-label col-md-4"><?= $this->lang->line('court_decision_type'); ?></label>
								<div class="col-md-8">
									<select name="courtDecisionType" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($courtDecisionTypeList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->decision_type_name . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('decision_date'); ?></label>
								<div class="col-sm-8">
									<input name="decisionDate" placeholder="Decision Date" class="form-control" type="date">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('decision'); ?></label>
								<div class="col-sm-8">
									<input name="decision" placeholder="Decision" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_name'); ?></label>
								<div class="col-sm-8">
									<input name="defenceLawyerName" placeholder="defence Lawyer Name" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_certificate_id'); ?></label>
								<div class="col-sm-8">
									<input name="defenceLawyerCertificateId" placeholder="defence Lawyer Certificate Id" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('sentence_execution_date'); ?></label>
								<div class="col-sm-8">
									<input name="sentenceExecutionDate" placeholder="Sentence Execution Date" class="form-control" type="date">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnSave" onclick="save_record()" class="btn btn-primary"><?= $this->lang->line('save'); ?></button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('cancel'); ?></button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- End Bootstrap modal -->
		<?php $this->load->view('footer'); ?>
	</body>
</html>