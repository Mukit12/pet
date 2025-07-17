<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("shared/header.php") ?>
</head>
<body>
    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <br>

    <div class="container wow fadeInDown">
        <div class="row" style="display: flex; justify-content: center;">
            <div class="col-md-6" style="border: solid #CFCFCF 2px; border-radius: 10px;">
                <div class="alert alert-success" id="infomsg" style="text-align: center"></div>
                
                <center><img src="profile_pic/ad.jfif" class="img-responsive wow fadeInDown" style="height:200px;" /></center>

                <div>
                    <h3 style="text-align:center; font-weight:bold;" class="wow fadeInDown">Admin Account Information</h3>
                    
                    <hr>

                    <dl class="dl-horizontal wow fadeInDown" style="text-align:left">
                        <dt>Admin Name</dt><dd> Mukit Uchhas</dd>
                        <dt>Phone#</dt><dd>01921580838</dd>
                        <dt>Email </dt><dd>mukituchchash@gmail.com</dd>
                        <dt>Username</dt><dd>admin</dd>
                    </dl>
                    <hr>
                </div>

                <button style="margin: 0 auto 1rem auto; display: block;" class="btn btn-success" onclick="document.getElementById('adminInfoUpdateForm').style.display='block';window.scrollTo(0, 300);this.remove();">Update info</button>

                <form class="form-horizontal" method="POST" id="adminInfoUpdateForm" action="shared/requests.php" style="margin-top: 20px; display: none;" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="pic" class="col-sm-4 control-label wow fadeInDown">Profile Avatar</label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control wow fadeInDown" name="profile_pic" value="house.png" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label wow fadeInDown">Admin Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" id="name" name="name" value="Tanjina Islam Proma" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label wow fadeInDown">Phone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" id="Phone" name="contact" value="01859385952" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label wow fadeInDown">Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control wow fadeInDown" id="email" name="email" value="islamtanjina645@gmail.com" required>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label wow fadeInDown">Username</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" id="username" name="username" value="admin" placeholder="Enter Username" required>
                        </div>
                    </div>
                    
                        <!-- <div class="form-group">
                            <label for="npassword" class="col-sm-4 control-label wow fadeInDown">Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control wow fadeInDown" id="npassword" name="npword" placeholder="Enter Password" required>
                            </div>
                        </div> -->

                        <hr>

                        <em style="color:red;" class="wow fadeInDOwn"> Note Fill up the fields before hitting save changes button</em>

                        <div class="form-group" style="margin-top: 1.5rem;">
                            <center><input type="submit" class="btn btn-success wow fadeInDown" name="update_admininfo" value="Save Changes"></center>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

        <br><br><br>

    <!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("shared/_js.php") ?>

    <script>
        $("#page").removeClass();
        $("#messages").removeClass();
        $("#admin").addClass("active");

        $("#infomsg").hide();

        $('#submit').click( function() {
          $.post( $("#adminacc").attr("action"),
             $("#adminacc :input").serializeArray(),
             function(info) { 
                $("#infomsg").show();
                $("#infomsg").empty();
                $("#infomsg").html(info);
            });    
          
          $("#adminacc").submit( function() {
            return false;    
        });
      });
  </script>
</body>
</html>