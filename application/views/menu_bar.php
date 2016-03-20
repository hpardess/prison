<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= base_url() ?>index.php"><span class="glyphicon glyphicon-oil"></span> 
            Prison Database</a>
        </div>

        <ul class="nav navbar-nav">
            <li id="home"><a href="<?= base_url() ?>index.php/home">Home</a></li>
            <li id="prisoners"><a href="<?= base_url() ?>index.php/prisoner">Prisoners </a></li>
            <li id="criminal_cases"><a href="<?= base_url() ?>index.php/crime">Criminal Cases </a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li id="user_management"><a href="<?= base_url() ?>index.php/user">User Management</a></li>
                    <li role="separator" class="divider"></li>
                    <li id="group_management"><a href="<?= base_url() ?>index.php/group">Group Management</a></li>
                </ul>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php if($this->session->userdata('isAdmin')) { echo $this->session->userdata('name')." (admin)"; } else { echo $this->session->userdata('name'); } ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a onclick='view_profile("<?= $this->session->userdata('id') ?>")'>Profile</a></li>
                    <li><a data-toggle="modal" href="#changePasswordModel">Change Password</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= base_url() ?>index.php/login/logout_user">Logout</a></li>
                </ul>
            </li>
        </ul>
  </div>
</nav>

<script type= 'text/javascript'>
    function view_profile(id)
    {
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('user/view/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('p#id', '#myProfileModel').html(data.user.id);
                $('p#name', '#myProfileModel').html(data.user.firstname + ' ' + data.user.lastname);
                $('p#username', '#myProfileModel').html(data.user.username);
                $('p#email', '#myProfileModel').html(data.user.email);
                $('p#isAdmin', '#myProfileModel').html(data.user.isadmin===1? 'Yes': 'No');
                $('p#group', '#myProfileModel').html(data.group.group_name);

                $('#myProfileModel').modal('show'); // show bootstrap modal when complete loaded
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function change_password()
    {
        // ajax adding data to database
        $.ajax({
            url : "<?php echo site_url('user/change_password')?>",
            type: "POST",
            data: $('#form', '#changePasswordModel').serialize(),
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

<!-- ****************************************************************** -->
<!--                        USER Profile Modal Window                       -->
<!-- ****************************************************************** -->
<div class="modal fade" tabindex="-1" role="dialog" id="myProfileModel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Profile</h4>
            </div>
            <div class="modal-body">
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ****************************************************************** -->
<!--                        Change Password Modal Window                       -->
<!-- ****************************************************************** -->
<div class="modal fade" tabindex="-1" role="dialog" id="changePasswordModel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-horizontal">
                    <!-- <input type="hidden" value="<?=$this->session->userdata('username'); ?>" name="username"/> -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Current Password</label>
                        <div class="col-sm-8">
                            <input name="curPsw" placeholder="Current Password" class="form-control" type="password">
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        <label class="col-sm-4 control-label">New Password</label>
                        <div class="col-sm-8">
                            <input name="newPsw" placeholder="New Password" class="form-control" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Confirm New Password</label>
                        <div class="col-sm-8">
                            <input name="confNewPsw" placeholder="Confirm" class="form-control" type="password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="change_password()">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
