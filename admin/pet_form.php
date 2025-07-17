<?php
    if(isset($_GET["id"])){
        require_once("../shared/db.php");
        $query = $conn->prepare("SELECT * FROM `pets` WHERE `id`=:id; ");
        $query->bindParam(":id", $_GET["id"]);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $res = $query->fetchAll();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("shared/header.php") ?>
</head>
<body>
    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <br>

    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col-12">
                <h1 style="text-align: center; color: black;"><i class="fa fa-user"></i> Pet form</h1>

                <form class="form-horizontal wow fadeInDown" method="POST" action="shared/requests.php" enctype="multipart/form-data" style="width: 800px; margin: auto;">
                    <?php if(isset($_GET["id"])): ?>
                        <input type="hidden" name="pet_id" value="<?php echo $res[0]["id"] ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Name</label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" name="name" placeholder="Enter pet name" value="<?php echo isset($_GET["id"]) ? $res[0]["name"] : "" ?>" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Age</label>
                        
                        <div class="col-sm-6">
                            <input type="number" class="form-control wow fadeInDown" name="age" placeholder="Enter pet age" value="<?php echo isset($_GET["id"]) ? $res[0]["age"] : "" ?>" min="0" required step="0.1"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Image</label>
                        
                        <div class="col-sm-6">
                            <input type="file" class="form-control wow fadeInDown" name="pic" value="<?php echo isset($_GET["id"]) ? $res[0]["pic"] : "" ?>"  <?php echo isset($_GET["id"]) ? "" : "required" ?> />
                        </div>
                    </div>

                    <div class="wow fadeInDown" style="padding-right: 110px; display: flex; justify-content: center;">
                        <button type="submit" name="<?php echo isset($_GET["id"]) ? "update_pet" : "add_pet" ?>" class="btn btn-info wow fadeInDown"><span class="glyphicon glyphicon-log-in"></span> <?php echo isset($_GET["id"]) ? "Update" : "Add" ?> pet</button>
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