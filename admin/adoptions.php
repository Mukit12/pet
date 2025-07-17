<!DOCTYPE html>
<html lang="en">
<head>
    <?php $auth_check=true; require_once("shared/header.php") ?>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <div class="container-fluid" style="margin-top: 2rem;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-responsive table-hover" style="margin-top: 2rem;">
                        <?php
                            require_once("../shared/db.php");
                            $query = $conn->prepare("SELECT adopts.id, adopts.status, adopts.name, adopts.email, adopts.username, adopts.phn_num, adopts.address, adopts.age, adopts.proffession, adopts.have_prev_pets, adopts.budget, pets.name AS pet_name, pets.pic FROM adopts INNER JOIN pets ON adopts.pet_id=pets.id WHERE adopts.status=0; ");
                            $query->execute();
                            $query->setFetchMode(PDO::FETCH_ASSOC);
                            $res = $query->fetchAll();
                            $cnt = 0;
                        ?>

                        <tr>
                            <th>#</th>
                            <th>Pet name</th>
                            <th>Pet image</th>
                            <th>Info</th>
                            <th>Actions</th>
                        </tr>

                        <?php foreach($res as $r): ?>
                        <tr>
                            <td>
                                <strong class="wow fadeInDown"><p style="margin-top:25px;">No. <?php echo ++$cnt ?></p></strong>
                            </td>

                            <td><?php echo $r["pet_name"] ?></td>
                            <td>
                                <img src="../uploads/products/animals/<?php echo $r["pic"] ?>" style="width: 100px;">
                            </td>

                            <td>
                                <a href="#adoptModal<?php echo $r["id"] ?>" data-toggle="modal" data-target="#adoptModal<?php echo $r["id"] ?>">Click to view infos</a>
                            </td>

                            <td>
                                <center>
                                    <a class="btn btn-success" href="shared/requests.php?t=adc&id=<?php echo $r["id"] ?>">Confirm</a>
                                    <a class="btn btn-danger" href="shared/requests.php?t=adr&id=<?php echo $r["id"] ?>">Reject</a>
                                </center>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>

                    <!-- appontment modals -->
                    <?php foreach($res as $r): ?>
                        <div class="modal fade bs-example-modal-sm" id="adoptModal<?php echo $r["id"] ?>" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content wow fadeInDown">
                                    <div class="modal-header">
                                        <h4 class="wow fadeInDown">Adoption request info</h4>
                                    </div>

                                    <br />

                                    <form class="form-horizontal wow fadeInDown" method="POST" action="shared/requests.php">
                                        <input type="hidden" id="petId" name="pet_id">

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label wow fadeInDown">Name</label>
                                            
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control wow fadeInDown" disabled value="<?php echo $r["name"] ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label wow fadeInDown">Email</label>
                                            
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control wow fadeInDown"  disabled value="<?php echo $r["email"] ?>"  />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label wow fadeInDown">Contact number</label>
                                            
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control wow fadeInDown"  disabled value="<?php echo $r["phn_num"] ?>"  />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label wow fadeInDown">Address</label>
                                            
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control wow fadeInDown" disabled value="<?php echo $r["address"] ?>"  />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label wow fadeInDown">Your age</label>
                                            
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control wow fadeInDown" disabled value="<?php echo $r["age"] ?> years"  />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label wow fadeInDown">Profession</label>
                                            
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control wow fadeInDown" disabled value="<?php echo $r["proffession"] ?>"  />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label wow fadeInDown">Have any other animals?</label>
                                            
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control wow fadeInDown" disabled value="<?php echo $r["have_prev_pets"] ?>"  />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label wow fadeInDown">Budget for pet expenses</label>
                                            
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control wow fadeInDown" disabled value="<?php echo $r["budget"] ?> taka"  />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <style type="text/css">
                        table, tr, th, td{ border: 1px dashed #8c8b8b; }
                    </style>
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("shared/_js.php") ?>
</body>
</html>