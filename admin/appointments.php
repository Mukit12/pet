<!DOCTYPE html>
<html lang="en">
<head>
    <?php $auth_check=true; require_once("shared/header.php") ?>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <div class="container-fluid" style="margin-top: 2rem; height: auto;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-responsive table-hover" style="margin-top: 2rem;">
                        <?php
                            require_once("../shared/db.php");
                            $query = $conn->prepare("SELECT appointments.id as appointment_id, appointments.status, appointments.name, appointments.email, appointments.username, appointments.phn_num, appointments.address, appointments.pet_name, appointments.pet_breed, appointments.pet_species, appointments.pet_age, appointments.appointment_date, appointments.appointment_time, appointments.vet_id, vets.id, vets.name AS vet_name FROM appointments INNER JOIN vets ON appointments.vet_id=vets.id WHERE (appointments.status=0 OR appointments.status=3); ");
                            $query->execute();
                            $query->setFetchMode(PDO::FETCH_ASSOC);
                            $res = $query->fetchAll();
                            $cnt = 0;
                        ?>

                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact no.</th>
                            <th>Address</th>
                            <th>Pet name</th>
                            <th>Pet breed</th>
                            <th>Pet species</th>
                            <th>Pet age</th>
                            <th>Vet name</th>
                            <th>Appointment date</th>
                            <th>Appointment time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                        <?php foreach($res as $r): ?>
                        <tr>
                            <td>
                                <strong class="wow fadeInDown"><p style="margin-top:25px;">No. <?php echo ++$cnt ?></p></strong>
                            </td>

                            <td><?php echo $r["name"] ?></td>
                            <td><?php echo $r["email"] ?></td>
                            <td><?php echo $r["phn_num"] ?></td>
                            <td><?php echo $r["address"] ?></td>
                            <td><?php echo $r["pet_name"] ?></td>
                            <td><?php echo $r["pet_breed"] ?></td>
                            <td><?php echo $r["pet_species"] ?></td>
                            <td><?php echo $r["pet_age"] ?></td>
                            <td>Dr. <?php echo $r["vet_name"] ?></td>
                            <td><?php echo $r["appointment_date"] ?></td>
                            <td><?php echo $r["appointment_time"] ?></td>
                            <td>
                                <?php
                                    if($r["status"] == 0) echo "Pending";
                                    else if($r["status"] == 3) echo "Rejected by User";
                                ?>
                            </td>
                            <td>
                                <?php if($r["status"] == 0): ?>
                                    <center>
                                        <a class="btn btn-success" href="shared/requests.php?t=ac&id=<?php echo $r["appointment_id"] ?>">Confirm</a>
                                        <a class="btn btn-danger" href="shared/requests.php?t=ar&id=<?php echo $r["appointment_id"] ?>">Reject</a>
                                    </center>
                                <?php endif ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>

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