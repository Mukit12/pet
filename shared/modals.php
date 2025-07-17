<!-- login modal -->
<div class="modal fade bs-example-modal-sm" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content wow fadeInDown">
            <div class="modal-header">
                <h4 class="wow fadeInDown">Petshop Online Website</h4>
            </div>
            <br />

            <center style="margin-bottom: 0.5rem;"><i class="fa fa-user"></i> Welcome admin/user</center>

            <form class="form-horizontal wow fadeInDown" method="POST" action="shared/requests.php">
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label wow fadeInDown">Admin/user username</label>
                    
                    <div class="col-sm-6">
                        <input type="text" class="form-control wow fadeInDown" name="username" placeholder="Enter Username" onKeyPress="return isNotAlphanumeric(event)" required />
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label wow fadeInDown">Password</label>
                    
                    <div class="col-sm-6">
                        <input type="password" class="form-control wow fadeInDown" name="password" placeholder="Enter Password" onKeyPress="return isNotAlphanumeric(event)" required>
                    </div>
                </div>

                <div class="modal-footer wow fadeInDown" style="padding-right:110px;">
                    <button type="submit" name="login" class="btn btn-info wow fadeInDown"><span class="glyphicon glyphicon-log-in"></span> Login</button>
                    
                    <button id="loginModalClose" type="button" class="btn btn-danger wow fadeInDown" data-dismiss="modal">Close</button>
                </div>
            </form>

            <p class="text-center">
                New user? <a onclick="document.getElementById('loginModalClose').click();" href="#regModal" data-toggle="modal" data-target="#regModal">Register now</a>
            </p>
        </div>
    </div>
</div>




<!-- registration modal -->
<div class="modal fade bs-example-modal-sm" id="regModal" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content wow fadeInDown">
            <div class="modal-header">
                <h4 class="wow fadeInDown">Petshop Online Website</h4>
            </div>
            <br />

            <center style="margin-bottom: 0.5rem;"><i class="fa fa-user"></i> Welcome user</center>

            <form class="form-horizontal wow fadeInDown" method="POST" action="shared/requests.php">
                <div class="form-group">
                    <label class="col-sm-4 control-label wow fadeInDown">Name</label>
                    
                    <div class="col-sm-6">
                        <input type="text" class="form-control wow fadeInDown" name="name" placeholder="Enter your name" onKeyPress="return isNotAlphanumeric(event)" required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label wow fadeInDown">Username</label>
                    
                    <div class="col-sm-6">
                        <input type="text" class="form-control wow fadeInDown" name="username" placeholder="Enter username" onKeyPress="return isNotAlphanumeric(event)" required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label wow fadeInDown">Email</label>
                    
                    <div class="col-sm-6">
                        <input type="email" class="form-control wow fadeInDown" name="email" placeholder="Enter email" onKeyPress="return isNotAlphanumeric(event)" required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label wow fadeInDown">Password</label>
                    
                    <div class="col-sm-6">
                        <input type="password" class="form-control wow fadeInDown" name="password" placeholder="Enter Password" onKeyPress="return isNotAlphanumeric(event)" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label wow fadeInDown">Contact number</label>
                    
                    <div class="col-sm-6">
                        <input type="text" maxlength="11" class="form-control wow fadeInDown" name="phn_num" placeholder="Enter phone number" onKeyPress="return isNotAlphanumeric(event)" required />
                    </div>
                </div>

                <div class="modal-footer wow fadeInDown" style="padding-right:110px;">
                    <button type="submit" name="register" class="btn btn-info wow fadeInDown"><span class="glyphicon glyphicon-log-in"></span> Register</button>
                    
                    <button type="button" class="btn btn-danger wow fadeInDown" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>