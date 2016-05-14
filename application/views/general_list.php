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

			<div>

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#quickTable" aria-controls="quickTable" role="tab" data-toggle="tab"><?= $this->lang->line('quick_view'); ?></a></li>
					<li role="presentation"><a href="#detailTable" aria-controls="detailTable" role="tab" data-toggle="tab"><?= $this->lang->line('detail_view'); ?></a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content" style="padding-top: 10px;">
					<div role="tabpanel" class="tab-pane active" id="quickTable">
						<table class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?= $this->lang->line('prisoner_id'); ?></th>
									<th><?= $this->lang->line('name'); ?></th>
									<th><?= $this->lang->line('father_name'); ?></th>
									<th><?= $this->lang->line('grand_father_name'); ?></th>
									<th><?= $this->lang->line('age'); ?></th>
									<th><?= $this->lang->line('criminal_history'); ?></th>
									<th><?= $this->lang->line('marital_status'); ?></th>
									<th><?= $this->lang->line('permanent_province'); ?></th>
									<th><?= $this->lang->line('permanent_district'); ?></th>

				                    <th><?= $this->lang->line('crime_id'); ?></th>
				                    <th><?= $this->lang->line('case_number'); ?></th>
				                    <th><?= $this->lang->line('crime_date'); ?></th>
				                    <th><?= $this->lang->line('crime_date'); ?></th>
				                    <th><?= $this->lang->line('arrest_date'); ?></th>
				                    <th><?= $this->lang->line('arrest_date'); ?></th>
				                    <th><?= $this->lang->line('police_custody'); ?></th>
				                    <th><?= $this->lang->line('time_spent_in_prison'); ?></th>
				                    <th><?= $this->lang->line('remaining_jail_term'); ?></th>

				                    <th><?= $this->lang->line('actions'); ?></th>
				                </tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>

					<div role="tabpanel" class="tab-pane" id="detailTable">
						<table class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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
				                    <th><?= $this->lang->line('crime_date'); ?></th>
				                    <th><?= $this->lang->line('arrest_date'); ?></th>
				                    <th><?= $this->lang->line('arrest_date'); ?></th>
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
				</div>

			</div>
			
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
		    var oQuickTable, oDetailTable;
		    var photos_directory = "<?= base_url('photos/') ?>";

            $(document).ready(function () {
            	$("li#general", ".navbar-nav").addClass("active");
            	$("input[type='date']").datepicker({
            		dateFormat: "yy-mm-dd"
            	});

				$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
					if ($(e.currentTarget).attr("href") == "#detailTable" && !$(e.currentTarget).hasClass("loaded")) {
						$(e.currentTarget).addClass("loaded");

						oDetailTable = $('.table', '#detailTable').DataTable({
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
								"targets": 34,
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
					}
				});

            	
                oQuickTable = $('.table', '#quickTable').DataTable({
                	"scrollX": true,
                    "processing": true,
                    "serverSide": true,
                    "sServerMethod": "POST",
                    // "bJQueryUI": true,
                    "ajax": "<?php echo site_url('general/general_quick_list')?>",
                    // "sDom": 'T<"clear">lfrtip'
                    language: {
						search: "<?= $this->lang->line('search'); ?>"
					},
					columnDefs: [{
						"targets": 18,
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
            });

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
				oQuickTable.ajax.reload(null,false); //reload datatable ajax
				oDetailTable.ajax.reload(null,false); //reload datatable ajax
			}
        </script>
		<?php $this->load->view('footer'); ?>
	</body>
</html>