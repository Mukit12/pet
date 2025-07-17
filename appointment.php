
<div class="container-fluid" style="margin-top: 2rem; height: auto;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="my-5 text-center" style="color: rosybrown;">Appointments</h1>

                <table class="table table-responsive table-hover" style="margin-top: 2rem;">
                    <?php
                        require_once("shared/db.php");
                        $query = $conn->prepare("SELECT appointments.id, appointments.status, appointments.name, appointments.email, appointments.username, appointments.phn_num, appointments.address, appointments.pet_name, appointments.pet_breed, appointments.pet_species, appointments.pet_age, appointments.appointment_date, appointments.appointment_time, vets.id as vets_id, vets.name AS vet_name FROM appointments INNER JOIN vets ON appointments.username=? AND appointments.vet_id=vets.id; ");
                        $query->execute([$_SESSION["user"]]);
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                        $res = $query->fetchAll();
                    ?>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact no.</th>
                        <th>Address</th>
                        <th>Pet name</th>
                        <th>Pet breed</th>
                        <th>Pet species</th>
                        <th>Pet age</th>
                        <th>Vet ID</th>
                        <th>Vet name</th>
                        <th>Appointment date</th>
                        <th>Appointment time</th>
                        <th>Status</th>
                        <th>Invoice</th>
                        <th>Action</th>
                    </tr>

                    <?php foreach($res as $r): ?>
                    <tr>
                        <td>
                            <strong class="wow fadeInDown"><p style="margin-top:25px;"><?php echo $r["id"] ?></p></strong>
                        </td>

                        <td><?php echo $r["name"] ?></td>
                        <td><?php echo $r["email"] ?></td>
                        <td><?php echo $r["phn_num"] ?></td>
                        <td><?php echo $r["address"] ?></td>
                        <td><?php echo $r["pet_name"] ?></td>
                        <td><?php echo $r["pet_breed"] ?></td>
                        <td><?php echo $r["pet_species"] ?></td>
                        <td><?php echo $r["pet_age"] ?></td>
                        <th><?php echo $r["vets_id"] ?></th>
                        <td>Dr. <?php echo $r["vet_name"] ?></td>
                        <td><?php echo $r["appointment_date"] ?></td>
                        <td><?php echo $r["appointment_time"] ?></td>
                        <td>
                            <?php
                            if($r["status"] == 0) echo "Pending";
                            else if($r["status"] == 1) echo "Confirmed";
                            else if($r["status"] == 2) echo "Rejected by Admin";
                            else if($r["status"] == 3) echo "Rejected by User";
                            ?>
                        </td>
                        <td>
                            <a href="invoice.php?type=Appointment&id=<?php echo $r["id"] ?>">Click here</a>
                        </td>
                        <td>
                            <?php if($r["status"] == 0): ?>
                                <a class="btn btn-danger" href="shared/requests.php?a=cancel_appointment&id=<?php echo $r["id"] ?>">Cancel</a>
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