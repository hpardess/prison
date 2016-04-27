<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= base_url() ?>index.php"><span class="glyphicon glyphicon-oil"></span> 
            <?= $this->lang->line('app_name'); ?></a>
        </div>

        <ul class="nav navbar-nav">
            <li id="home"><a href="<?= base_url() ?>index.php/home"><?= $this->lang->line('home'); ?></a></li>
            <li id="dashboard"><a href="<?= base_url() ?>index.php/dashboard"><?= $this->lang->line('dashboard'); ?></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->lang->line('general'); ?>  <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?= base_url() ?>index.php/general/new_case"><?= $this->lang->line('new_case'); ?> </a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= base_url() ?>index.php/general"><?= $this->lang->line('general_list'); ?> </a></li>
                    <li id="prisoners"><a href="<?= base_url() ?>index.php/prisoner"><?= $this->lang->line('prisoners_list'); ?> </a></li>
                    <li id="criminal_cases"><a href="<?= base_url() ?>index.php/crime"><?= $this->lang->line('criminal_cases_list'); ?> </a></li>
                    <li id="court_session"><a href="<?= base_url() ?>index.php/court_session"><?= $this->lang->line('court_session_list'); ?> </a></li>
                </ul>
            </li>
            
            <?php if($this->session->userdata('isAdmin')) { ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->lang->line('administration'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li id="user_management"><a href="<?= base_url() ?>index.php/user"><?= $this->lang->line('user_management'); ?></a></li>
                        <li role="separator" class="divider"></li>
                        <li id="group_management"><a href="<?= base_url() ?>index.php/group"><?= $this->lang->line('group_management'); ?></a></li>
                    </ul>
                </li>
            <?php } ?>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li style="padding-top: 15px;">
                <select id="language" onchange="change_language(event)">
                    <option value="english"><?= $this->lang->line('english'); ?></option>
                    <option value="pashto"><?= $this->lang->line('pashto'); ?></option>
                    <option value="dari"><?= $this->lang->line('dari'); ?></option>
                </select>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php if($this->session->userdata('isAdmin')) { echo $this->session->userdata('name')." (" . $this->lang->line('admin') . ")"; } else { echo $this->session->userdata('name'); } ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a onclick='view_profile("<?= $this->session->userdata('id') ?>")'><?= $this->lang->line('profile'); ?></a></li>
                    <li><a data-toggle="modal" href="#changePasswordModel"><?= $this->lang->line('change_password'); ?></a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= base_url() ?>index.php/login/logout_user"><?= $this->lang->line('logout'); ?></a></li>
                </ul>
            </li>
        </ul>
  </div>
</nav>

<script type= 'text/javascript'>
    $(document).ready(function () {
        $(".navbar-nav select#language").val("<?= $this->session->userdata('language') ?>");
    });

    function change_language(event)
    {
        $.ajax({
            url : "<?php echo site_url('user/switch_language/')?>/" + event.currentTarget.value,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if(data.success === true)
                    window.location.reload();
                else
                    alert('Falied to change the language.');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

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
                if(data.success === true) {
                    //if success close modal and reload ajax table
                    $('#changePasswordModel').modal('hide');
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
                        <label class="col-sm-3 control-label"><?= $this->lang->line('id'); ?></label>
                        <div class="col-sm-9">
                            <p class="form-control-static" id="id"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?= $this->lang->line('fullname'); ?></label>
                        <div class="col-sm-9">
                            <p class="form-control-static" id="name"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?= $this->lang->line('username'); ?></label>
                        <div class="col-sm-9">
                            <p class="form-control-static" id="username"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?= $this->lang->line('email'); ?></label>
                        <div class="col-sm-9">
                            <p class="form-control-static" id="email"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?= $this->lang->line('isadmin'); ?></label>
                        <div class="col-sm-9">
                            <p class="form-control-static" id="isAdmin"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?= $this->lang->line('group'); ?></label>
                        <div class="col-sm-9">
                            <p class="form-control-static" id="group"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('close'); ?></button>
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
                <h4 class="modal-title"><?= $this->lang->line('change_password'); ?></h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-horizontal">
                    <!-- <input type="hidden" value="<?=$this->session->userdata('username'); ?>" name="username"/> -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= $this->lang->line('current_password'); ?></label>
                        <div class="col-sm-8">
                            <input name="curPsw" placeholder="Current Password" class="form-control" type="password">
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= $this->lang->line('new_password'); ?></label>
                        <div class="col-sm-8">
                            <input name="newPsw" placeholder="New Password" class="form-control" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= $this->lang->line('confirm_new_password'); ?></label>
                        <div class="col-sm-8">
                            <input name="confNewPsw" placeholder="Confirm" class="form-control" type="password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="change_password()"><?= $this->lang->line('save'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('close'); ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
