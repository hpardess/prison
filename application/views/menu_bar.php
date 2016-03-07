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
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php if($this->session->userdata('isAdmin')) { echo $this->session->userdata('name')." (admin)"; } else { echo $this->session->userdata('name'); } ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a data-toggle="modal" href="#myProfile">Profile</a></li>
                    <li><a href="#">Change Password</a></li>
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
<div class="modal hide" id="myProfile">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h3>New User Details</h3>
    </div>
    <div class="modal-body">
        <!-- <p><input type="text" class="span4" name="first_name" id="first_name" placeholder="First Name"></p>
        <p><input type="text" class="span4" name="last_name" id="last_name" placeholder="Last Name"></p>
        <p><input type="text" class="span4" name="email" id="email" placeholder="Email"></p>
        <p>
        <select class="span4" name="teamId" id="teamId">
        <option value="">Team Number...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        </select>
        </p>
        <p>
        <label class="checkbox span4">
        <input type="checkbox" id="isAdmin" name="isAdmin"> Is an admin?
        </label>
        </p>
        <p><input type="password" class="span4" name="password" id="password" placeholder="Password"></p>
        <p><input type="password" class="span4" name="password2" id="password2" placeholder="Confirm Password"></p> -->
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-warning" data-dismiss="modal">Cancel</a>
        <a href="#" id="btnModalSubmit" class="btn btn-primary">Create</a>
    </div>
</div>
