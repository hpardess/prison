<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h3>Group Management</h3>
			<br />
			<button class="btn btn-success" onclick="new_record()"><i class="glyphicon glyphicon-plus"></i> Add New Group</button>
			<br />
			<br />
			<!-- <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%"> -->
			<table id="table" class="table table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
	                    <th>Id</th>
	                    <th>Group Name</th>
	                    <th>Prisoner New</th>
	                    <th>Prisoner View</th>
	                    <th>Prisoner Edit</th>
	                    <th>Prisoner Delete</th>
	                    <th>Prisoner Unlock</th>
	                    <th>Crime New</th>
	                    <th>Crime View</th>
	                    <th>Crime Edit</th>
	                    <th>Crime Delete</th>
	                    <th>Crime Unlock</th>
	                    <th>Actions</th>
	                </tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		
		<script src="<?php echo base_url('assets/datatables/media/js/jquery.dataTables.min.js')?>"></script>
		<script src="<?php echo base_url('assets/datatables/media/js/dataTables.bootstrap.js')?>"></script>
		  
		<script type= 'text/javascript'>
			var save_method; //for save method string
		    var oTable;

            $(document).ready(function () {
            	$("li#group_management", ".navbar-nav").addClass("active");

                oTable = $('#table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    // "bJQueryUI": true,
                    "ajax": "<?php echo site_url('group/group_list')?>",
                    // "sDom": 'T<"clear">lfrtip'
                });
            });

			function new_record()
			{
				save_method = 'new';
				$('#form', '#modal_form_edit')[0].reset(); // reset form on modals
				$('[name="group"]', '#modal_form_edit').empty();

				$.ajax({
					url : "<?php echo site_url('user/new_user/')?>",
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						var groupsSelectEl = $('[name="group"]', '#modal_form_edit');
						$.each(data, function(index, value) {
							$('<option>').attr('value', value.id).html(value.group_name).appendTo(groupsSelectEl);
						});

						$('#modal_form_edit').modal('show'); // show bootstrap modal when complete loaded
						$('.modal-title', '#modal_form_edit').text('Add New User'); // Set Title to Bootstrap modal title
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error get data from ajax');
					}
				});
			}

            function view_record(id)
			{
				save_method = 'update';
				$('i.glyphicon', '#modal_form_view').removeClass('glyphicon-ok glyphicon-remove');

				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('group/view/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						$('p#id', '#modal_form_view').html(data.id);
						$('p#name', '#modal_form_view').html(data.group_name);
						$('i#crime_new', '#modal_form_view').addClass(data.crime_new===1||data.crime_new==='1'? 'glyphicon-ok': 'glyphicon-remove');
						$('i#crime_view', '#modal_form_view').addClass(data.crime_view===1||data.crime_view==='1'? 'glyphicon-ok': 'glyphicon-remove');
						$('i#crime_edit', '#modal_form_view').addClass(data.crime_edit===1||data.crime_edit==='1'? 'glyphicon-ok': 'glyphicon-remove');
						$('i#crime_delete', '#modal_form_view').addClass(data.crime_delete===1||data.crime_delete==='1'? 'glyphicon-ok': 'glyphicon-remove');
						$('i#crime_unlock', '#modal_form_view').addClass(data.crime_unlock===1||data.crime_unlock==='1'? 'glyphicon-ok': 'glyphicon-remove');
						$('i#prisoner_new', '#modal_form_view').addClass(data.prisoner_new===1||data.prisoner_new==='1'? 'glyphicon-ok': 'glyphicon-remove');
						$('i#prisoner_view', '#modal_form_view').addClass(data.prisoner_view===1||data.prisoner_view==='1'? 'glyphicon-ok': 'glyphicon-remove');
						$('i#prisoner_edit', '#modal_form_view').addClass(data.prisoner_edit===1||data.prisoner_edit==='1'? 'glyphicon-ok': 'glyphicon-remove');
						$('i#prisoner_delete', '#modal_form_view').addClass(data.prisoner_delete===1||data.prisoner_delete==='1'? 'glyphicon-ok': 'glyphicon-remove');
						$('i#prisoner_unlock', '#modal_form_view').addClass(data.prisoner_unlock===1||data.prisoner_unlock==='1'? 'glyphicon-ok': 'glyphicon-remove');

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
				$('[name="group"]', '#modal_form_edit').empty();

				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('group/edit/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						$('p#id', '#modal_form_edit').html(data.id);
						$('[name="id"]', '#modal_form_edit').val(data.id);
						$('[name="groupName"]', '#modal_form_edit').val(data.group_name);

						$('[name="crime_new"]', '#modal_form_edit').prop('checked', (data.crime_new===1||data.crime_new==='1'? true: false));
						$('[name="crime_view"]', '#modal_form_edit').prop('checked', (data.crime_view===1||data.crime_view==='1'? true: false));
						$('[name="crime_edit"]', '#modal_form_edit').prop('checked', (data.crime_edit===1||data.crime_edit==='1'? true: false));
						$('[name="crime_delete"]', '#modal_form_edit').prop('checked', (data.crime_delete===1||data.crime_delete==='1'? true: false));
						$('[name="crime_unlock"]', '#modal_form_edit').prop('checked', (data.crime_unlock===1||data.crime_unlock==='1'? true: false));
						$('[name="prisoner_new"]', '#modal_form_edit').prop('checked', (data.prisoner_new===1||data.prisoner_new==='1'? true: false));
						$('[name="prisoner_view"]', '#modal_form_edit').prop('checked', (data.prisoner_view===1||data.prisoner_view==='1'? true: false));
						$('[name="prisoner_edit"]', '#modal_form_edit').prop('checked', (data.prisoner_edit===1||data.prisoner_edit==='1'? true: false));
						$('[name="prisoner_delete"]', '#modal_form_edit').prop('checked', (data.prisoner_delete===1||data.prisoner_delete==='1'? true: false));
						$('[name="prisoner_unlock"]', '#modal_form_edit').prop('checked', (data.prisoner_unlock===1||data.prisoner_unlock==='1'? true: false));

						$('#modal_form_edit').modal('show'); // show bootstrap modal when complete loaded
						$('.modal-title', '#modal_form_edit').text('Edit Group'); // Set Title to Bootstrap modal title
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
						url : "<?php echo site_url('group/delete')?>/"+id,
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
					url = "<?php echo site_url('group/add')?>";
				}
				else
				{
					url = "<?php echo site_url('group/update')?>";
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
						<h3 class="modal-title">View Group</h3>
					</div>
					<div class="modal-body form">
						<form action="#" id="form" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label">ID</label>
								<div class="col-sm-9">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Group Name</label>
								<div class="col-sm-9">
									<p class="form-control-static" id="name"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Prisoner</label>
								<div class="col-md-9">
									<label class="checkbox-inline">
										<i class="glyphicon" id="prisoner_new"></i> New
									</label>
									<label class="checkbox-inline">
										<i class="glyphicon" id="prisoner_view"></i> View
									</label>
									<label class="checkbox-inline">
										<i class="glyphicon" id="prisoner_edit"></i> Edit
									</label>
									<label class="checkbox-inline">
										<i class="glyphicon" id="prisoner_delete"></i> Delete
									</label>
									<label class="checkbox-inline">
										<i class="glyphicon" id="prisoner_unlock"></i> Unlock
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Crime</label>
								<div class="col-md-9">
									<label class="checkbox-inline">
										<i class="glyphicon" id="crime_new"></i> New
									</label>
									<label class="checkbox-inline">
										<i class="glyphicon" id="crime_view"></i> View
									</label>
									<label class="checkbox-inline">
										<i class="glyphicon" id="crime_edit"></i> Edit
									</label>
									<label class="checkbox-inline">
										<i class="glyphicon" id="crime_delete"></i> Delete
									</label>
									<label class="checkbox-inline">
										<i class="glyphicon" id="crime_unlock"></i> Unlock
									</label>
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
						<h3 class="modal-title">Edit Group</h3>
					</div>
					<div class="modal-body form">
						<form action="#" id="form" class="form-horizontal">
							<input type="hidden" value="" name="id"/>
							<div class="form-group">
								<label class="col-sm-3 control-label">ID</label>
								<div class="col-sm-9">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Group Name</label>
								<div class="col-md-9">
									<input name="groupName" placeholder="Group Name" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Prisoner</label>
								<div class="col-md-9">
									<label class="checkbox-inline">
										<input type="checkbox" name="prisoner_new"> New
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="prisoner_view"> View
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="prisoner_edit"> Edit
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="prisoner_delete"> Delete
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="prisoner_unlock"> Unlock
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Crime</label>
								<div class="col-md-9">
									<label class="checkbox-inline">
										<input type="checkbox" name="crime_new"> New
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="crime_view"> View
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="crime_edit"> Edit
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="crime_delete"> Delete
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="crime_unlock"> Unlock
									</label>
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