<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= base_url() ?>index.php"><span class="glyphicon glyphicon-oil"></span> 
            Prison Database</a>
        </div>

        <ul class="nav navbar-nav">
            <li class="active"><a href="<?= base_url() ?>index.php">Home</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Case <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?= base_url() ?>index.php/ccase/new_case">New Case</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">List All Cases</a></li>
                </ul>
            </li>
            <li><a href="#">Reports </a></li>
            <li><a href="<?= base_url() ?>index.php/user1">Users(1) </a></li>
            <li><a href="<?= base_url() ?>index.php/user2">Users(2) </a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?= base_url() ?>index.php/users/">Users</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= base_url() ?>index.php/groups">Groups</a></li>
                </ul>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php if($this->session->userdata('isAdmin')) { echo $this->session->userdata('name')." (admin)"; } else { echo $this->session->userdata('name'); } ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a data-toggle="modal" href="#myProfile">Profile</a></li>
                    <li><a data-toggle="modal" href="#changePassword">Change Password</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= base_url() ?>index.php/login/logout_user">Logout</a></li>
                </ul>
            </li>
        </ul>
  </div>
</nav>

<!-- ****************************************************************** -->
<!--                        USER Profile Modal Window                       -->
<!-- ****************************************************************** -->
<div class="modal fade" tabindex="-1" role="dialog" id="myProfile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Profile</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ****************************************************************** -->
<!--                        Change Password Modal Window                       -->
<!-- ****************************************************************** -->
<div class="modal fade" tabindex="-1" role="dialog" id="changePassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
