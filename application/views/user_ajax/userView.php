<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
		    <h3>Ajax CRUD with Bootstrap modals and Datatables</h3>
		 
		    <h3>User Data</h3>
		    <br />
		    <button class="btn btn-success" onclick="add_user()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
		    <br />
		    <br />
		    <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
		      <thead>
		        <tr>
		          <th>First Name</th>
		          <th>Last Name</th>
		          <th>Gender</th>
		          <th>Address</th>
		          <th>Date of Birth</th>
		          <th style="width:170px;">Action</th>
		        </tr>
		      </thead>
		      <tbody>
		      </tbody>
		 
		      <!-- <tfoot>
		        <tr>
		          <th>First Name</th>
		          <th>Last Name</th>
		          <th>Gender</th>
		          <th>Address</th>
		          <th>Date of Birth</th>
		          <th>Action</th>
		        </tr>
		      </tfoot> -->
		    </table>
		  </div>
		 
		  <!-- <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
		  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script> -->
		  <script src="<?php echo base_url('assets/datatables/media/js/jquery.dataTables.min.js')?>"></script>
		  <script src="<?php echo base_url('assets/datatables/media/js/dataTables.bootstrap.js')?>"></script>
		 
		  <script type="text/javascript">
		 
		    var save_method; //for save method string
		    var table;
		    $(document).ready(function() {
		      table = $('#table').DataTable({
		        "processing": true, //Feature control the processing indicator.
		        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 
		        // Load data for the table's content from an Ajax source
		        "ajax": {
		            "url": "<?php echo site_url('user2/ajax_list')?>",
		            "type": "POST"
		        },
		 
		        //Set column definition initialisation properties.
		        "columnDefs": [
		        {
		          "targets": [ -1 ], //last column
		          "orderable": false, //set not orderable
		        },
		        ],
		 
		      });
		    });
		 
		    function add_user()
		    {
		      save_method = 'add';
		      $('#form')[0].reset(); // reset form on modals
		      $('#modal_form').modal('show'); // show bootstrap modal
		      $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
		    }
		 	
		 	function view_user(id)
		    {
		      // TODO
		    }

		    function edit_user(id)
		    {
		      save_method = 'update';
		      $('#form')[0].reset(); // reset form on modals
		 
		      //Ajax Load data from ajax
		      $.ajax({
		        url : "<?php echo site_url('user2/ajax_edit/')?>/" + id,
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
		        {
		 
		            $('[name="id"]').val(data.id);
		            $('[name="firstName"]').val(data.firstName);
		            $('[name="lastName"]').val(data.lastName);
		            $('[name="gender"]').val(data.gender);
		            $('[name="address"]').val(data.address);
		            $('[name="dob"]').val(data.dob);
		 
		            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
		            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title
		 
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error get data from ajax');
		        }
		    });
		    }
		 
		    function reload_table()
		    {
		      table.ajax.reload(null,false); //reload datatable ajax
		    }
		 
		    function save()
		    {
		      var url;
		      if(save_method == 'add')
		      {
		          url = "<?php echo site_url('user2/ajax_add')?>";
		      }
		      else
		      {
		        url = "<?php echo site_url('user2/ajax_update')?>";
		      }
		 
		       // ajax adding data to database
		          $.ajax({
		            url : url,
		            type: "POST",
		            data: $('#form').serialize(),
		            dataType: "JSON",
		            success: function(data)
		            {
		               //if success close modal and reload ajax table
		               $('#modal_form').modal('hide');
		               reload_table();
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                alert('Error adding / update data');
		            }
		        });
		    }
		 
		    function delete_user(id)
		    {
		      if(confirm('Are you sure delete this data?'))
		      {
		        // ajax delete data to database
		          $.ajax({
		            url : "<?php echo site_url('user2/ajax_delete')?>/"+id,
		            type: "POST",
		            dataType: "JSON",
		            success: function(data)
		            {
		               //if success reload ajax table
		               $('#modal_form').modal('hide');
		               reload_table();
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                alert('Error adding / update data');
		            }
		        });
		 
		      }
		    }
		 
		  </script>
		 
		  <!-- Bootstrap modal -->
		  <div class="modal fade" id="modal_form" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title">Person Form</h3>
		      </div>
		      <div class="modal-body form">
		        <form action="#" id="form" class="form-horizontal">
		          <input type="hidden" value="" name="id"/>
		          <div class="form-body">
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
		              <label class="control-label col-md-3">Gender</label>
		              <div class="col-md-9">
		                <select name="gender" class="form-control">
		                  <option value="male">Male</option>
		                  <option value="female">Female</option>
		                </select>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-md-3">Address</label>
		              <div class="col-md-9">
		                <textarea name="address" placeholder="Address"class="form-control"></textarea>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-md-3">Date of Birth</label>
		              <div class="col-md-9">
		                <input name="dob" placeholder="yyyy-mm-dd" class="form-control" type="text">
		              </div>
		            </div>
		          </div>
		        </form>
		          </div>
		          <div class="modal-footer">
		            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
		            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		          </div>
		        </div><!-- /.modal-content -->
		      </div><!-- /.modal-dialog -->
		    </div><!-- /.modal -->
		  <!-- End Bootstrap modal -->
		<?php $this->load->view('footer'); ?>
	</body>
</html>