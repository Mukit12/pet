<!DOCTYPE html>
<html lang="en">
<head>
    <?php $auth_check=true; require_once("shared/header.php") ?>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col-12">
                <table class="table table-responsive table-hover">
                    <?php
                        require_once("shared/db.php");
                        $query = $conn->prepare("SELECT * FROM `pets` WHERE `status`=1; ");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                        $res = $query->fetchAll();
                        $cnt = 0;
                    ?>

                    <tr>
                        <th>#</th>
                        <th>Pet image</th>
                        <th>Pet name</th>
                        <th>Pet age</th>
                    </tr>

                    <?php foreach($res as $r): ?>
                    <tr>
                        <td>
                            <center><strong class="wow fadeInDown"><p style="margin-top:25px;">No. <?php echo ++$cnt ?></p></strong></center>
                        </td>

                        <td><center><img src="uploads/products/animals/<?php echo $r["pic"] ?>" width="120px;" class="img-responsive img-rounded wow fadeInDown"></center></td>

                        <td><?php echo $r["name"] ?></td>
                        <td>
                            <?php
                                $age = explode('.', (string)$r["age"]);
                                echo intval($age[0])." years ";
                                if(isset($age[1]) and intval($age[1]) != 0) echo intval($age[1])." months";
                            ?>
                        </td>

                        <td>
                            <a href="#adoptModal" data-toggle="modal" data-target="#adoptModal" onclick="$('#petId').val(<?php echo $r["id"] ?>)" class="btn btn-primary">Request for this pet</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

                <style type="text/css">
                    table, tr, td{ border: 1px dashed #8c8b8b; }
                </style>
            </div>
        </div>
    </div>

    <br><br>

    <!-- appontment modal -->
    <div class="modal fade bs-example-modal-sm" id="adoptModal" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content wow fadeInDown">
                <div class="modal-header">
                    <h4 class="wow fadeInDown">Online Pet care center Management System</h4>
                </div>
                <br />

                <center style="margin-bottom: 0.5rem;"><i class="fa fa-user"></i> Adoption form</center>

                <form class="form-horizontal wow fadeInDown" method="POST" action="shared/requests.php">
                    <input type="hidden" id="petId" name="pet_id">

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Name</label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" name="name" placeholder="Enter your name" onKeyPress="return isNotAlphanumeric(event)" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Email</label>
                        
                        <div class="col-sm-6">
                            <input type="email" class="form-control wow fadeInDown" name="email" placeholder="Enter email" onKeyPress="return isNotAlphanumeric(event)" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Contact number</label>
                        
                        <div class="col-sm-6">
                            <input type="text" maxlength="11" class="form-control wow fadeInDown" name="phn_num" placeholder="Enter phone number" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Address</label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" name="address" placeholder="Enter address" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Your age</label>
                        
                        <div class="col-sm-6">
                            <input type="number" min="0"step= "0.1" class="form-control wow fadeInDown" name="age" placeholder="Enter your age" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Profession</label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" name="proffession" placeholder="Enter your Profession" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Have any other animals?</label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" name="have_prev_pets" placeholder="Yes or No" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Budget for pet expenses</label>
                        
                        <div class="col-sm-6">
                            <input type="number" class="form-control wow fadeInDown" name="budget" placeholder="Amount in taka(minimum 500 taka)" min="500" required />
                        </div>
                    </div>

                    <div class="modal-footer wow fadeInDown" style="padding-right:110px;">
                        <button type="submit" name="req_adopt" class="btn btn-info wow fadeInDown"><span class="glyphicon glyphicon-log-in"></span> Request adoption</button>
                        
                        <button type="button" class="btn btn-danger wow fadeInDown" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("shared/_js.php") ?>
</body>
</html>