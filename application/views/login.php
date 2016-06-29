<html>

    <head>
        <?php $this->load->view('meta'); ?>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3><small>Login here!!!</small></h3><hr/>

                            <?php echo form_open('login'); ?>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <?php echo form_close(); ?>
                            <div style="color: red; font-size: 12px;">
                                <?php echo validation_errors(); ?>
                            </div>
                            <hr/>
                            <div style="font-size: 12px;">
                                <p>Demo Login (Admin):<br>username: hpardess<br>password: admin</p>
                                <p>Demo Login:<br>username: demo<br>password: demo</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <?php $this->load->view('footer'); ?>
    </body>
</html>


