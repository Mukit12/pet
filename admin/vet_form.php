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
            <form class="form-horizontal" method="POST" action="shared/requests.php" style="margin-top: 20px;" enctype="multipart/form-data">
                <?php
                    if(isset($_GET["id"])){
                        require_once("../shared/db.php");
                        $query = $conn->prepare("SELECT * FROM `vets` WHERE `id` = " . $_GET["id"]);
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                        $res = $query->fetchAll();
                    }
                ?>

                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label wow fadeInDown">Vet name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control wow fadeInDown" id="name" name="name" value="<?php echo isset($res) ? $res[0]["name"] : "" ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label wow fadeInDown">Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control wow fadeInDown" id="email" name="email" value="<?php echo isset($res) ? $res[0]["email"] : "" ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="col-sm-4 control-label wow fadeInDown">Address</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control wow fadeInDown" id="address" name="address" value="<?php echo isset($res) ? $res[0]["address"] : "" ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pic" class="col-sm-4 control-label wow fadeInDown">Profile pic</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control wow fadeInDown" id="pic" name="profile_pic" value="<?php echo isset($res) ? $res[0]["profile_pic"] : "" ?>" <?php echo isset($res) ? "" : "required" ?>>
                    </div>
                </div>

                <div class="form-group">
                    <label for="serviceStart" class="col-sm-4 control-label wow fadeInDown">Service start</label>
                    <div class="col-sm-6">
                        <input type="time" class="form-control wow fadeInDown" id="serviceStart" name="service_start" value="<?php echo isset($res) ? $res[0]["service_start"] : "" ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="serviceEnd" class="col-sm-4 control-label wow fadeInDown">Service end</label>
                    <div class="col-sm-6">
                        <input type="time" class="form-control wow fadeInDown" id="serviceEnd" name="service_end" value="<?php echo isset($res) ? $res[0]["service_end"] : "" ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="fee" class="col-sm-4 control-label wow fadeInDown">Fee</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control wow fadeInDown" id="fee" name="fee" value="<?php echo isset($res) ? $res[0]["fee"] : "" ?>" required min="0">
                    </div>
                </div>

                <?php if(isset($res)): ?>
                    <input type="hidden" name="id" value="<?php echo $res[0]["id"] ?>">
                <?php endif; ?>

                <hr>

                <em style="color:red;" class="wow fadeInDOwn"> Note Fill up the fields before hitting save changes button</em>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <center><input type="submit" class="btn btn-success wow fadeInDown" name="<?php echo isset($res) ? "update_vet" : "add_vet" ?>"></center>
                </div>
            </form>
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