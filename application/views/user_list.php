<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h3>User Management</h3>
			<br />
			<button class="btn btn-success" onclick="new_record()"><i class="glyphicon glyphicon-plus"></i> Add New User</button>
			<br />
			<br />
			<!-- <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%"> -->
			<table id="table" class="table table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
	                    <th>Id</th>
	                    <th>Fist Name</th>
	                    <th>Last Name</th>
	                    <th>Username</th>
	                    <th>Email</th>
	                    <th>IsAdmin</th>
	                    <th>Group Id</th>
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
            	$("li#user_management", ".navbar-nav").addClass("active");

                oTable = $('#table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    // "bJQueryUI": true,
                    "ajax": "<?php echo site_url('user/user_list')?>",
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
				$('#form', '#modal_form_view')[0].reset(); // reset form on modals

				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('user/view/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						$('p#id', '#modal_form_view').html(data.user.id);
						$('p#name', '#modal_form_view').html(data.user.firstname + ' ' + data.user.lastname);
						$('p#username', '#modal_form_view').html(data.user.username);
						$('p#email', '#modal_form_view').html(data.user.email);
						$('p#isAdmin', '#modal_form_view').html(data.user.isadmin===1? 'Yes': 'No');
						$('p#group', '#modal_form_view').html(data.group.group_name);

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
					url : "<?php echo site_url('user/edit/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						$('p#id', '#modal_form_edit').html(data.user.id);
						$('[name="id"]', '#modal_form_edit').val(data.user.id);
						$('[name="firstName"]', '#modal_form_edit').val(data.user.firstname);
						$('[name="lastName"]', '#modal_form_edit').val(data.user.lastname);
						$('[name="username"]', '#modal_form_edit').val(data.user.username);
						$('[name="email"]', '#modal_form_edit').val(data.user.email);
						$('[name="isAdmin"]', '#modal_form_edit').prop('checked', (data.user.isadmin===1||data.user.isadmin==='1'? true: false));
						var groupsSelectEl = $('[name="group"]', '#modal_form_edit');
						$.each(data.groups, function(index, value) {
							if (data.user.groups_id === value.id) {
								$('<option>').attr('value', value.id).attr('selected', true).html(value.group_name).appendTo(groupsSelectEl);
							} else {
								$('<option>').attr('value', value.id).html(value.group_name).appendTo(groupsSelectEl);
							}
						});

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
						url : "<?php echo site_url('user/delete')?>/"+id,
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
					url = "<?php echo site_url('user/add')?>";
				}
				else
				{
					url = "<?php echo site_url('user/update')?>";
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
								<label class="col-sm-3 control-label">ID</label>
								<div class="col-sm-9">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Full Name</label>
								<div class="col-sm-9">
									<p class="form-control-static" id="name"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Username</label>
								<div class="col-sm-9">
									<p class="form-control-static" id="username"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<p class="form-control-static" id="email"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">isAdmin</label>
								<div class="col-sm-9">
									<p class="form-control-static" id="isAdmin"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Group</label>
								<div class="col-sm-9">
									<p class="form-control-static" id="group"></p>
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
								<label class="col-sm-3 control-label">ID</label>
								<div class="col-sm-9">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">First Name</label>
								<div class="col-md-9">
									<input name="firstName" placeholder="First Name" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Last Name</label>
								<div class="col-md-9">
									<input name="lastName" placeholder="Last Name" class="form-control" type="text">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Username</label>
								<div class="col-sm-9">
									<input name="username" placeholder="Username" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input name="email" placeholder="Email" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"></label>
								<div class="col-sm-9">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="isAdmin"> isAdmin
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Group</label>
								<div class="col-sm-9">
									<select name="group" class="form-control" class="form-control">
									</select>
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