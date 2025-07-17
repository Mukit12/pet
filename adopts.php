<div class="container-fluid" style="margin-top: 5rem; height: auto;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="my-5 text-center" style="color: rosybrown;">Adoption requests</h1>

                <table class="table table-responsive table-hover" style="margin-top: 2rem;">
                    <?php
                        require_once("shared/db.php");
                        $query = $conn->prepare("SELECT adopts.id as adopt_id, adopts.status, adopts.name, adopts.email, adopts.username, adopts.phn_num, adopts.address, adopts.age, adopts.proffession, adopts.have_prev_pets, adopts.budget, pets.id AS pet_id, pets.name AS pet_name, pets.pic FROM adopts INNER JOIN pets ON adopts.username=? AND adopts.pet_id=pets.id; ");
                        $query->execute([$_SESSION["user"]]);
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                        $res = $query->fetchAll();
                    ?>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Contact no.</th>
                        <th>Address</th>
                        <th>Pet ID</th>
                        <th>Pet name</th>
                        <th>Pet image</th>
                        <th>Have previouss pets?</th>
                        <th>pet expense budget</th>
                        <th>Status</th>
                        <th>Invoice</th>
                    </tr>

                    <?php foreach($res as $r): ?>
                    <tr>
                        <td>
                            <strong class="wow fadeInDown"><p style="margin-top:25px;"><?php echo $r["adopt_id"] ?></p></strong>
                        </td>

                        <td><?php echo $r["name"] ?></td>
                        <td><?php echo $r["email"] ?></td>
                        <td><?php echo $r["age"] ?> yrs</td>
                        <td><?php echo $r["phn_num"] ?></td>
                        <td><?php echo $r["address"] ?></td>
                        <th><?php echo $r["pet_id"] ?></th>
                        <td><?php echo $r["pet_name"] ?></td>
                        <td>
                            <img src="uploads/products/animals/<?php echo $r["pic"] ?>" style="width: 100px;">
                        </td>
                        <td><?php echo $r["have_prev_pets"] ?></td>
                        <td><?php echo $r["budget"] ?> Taka</td>
                        <td>
                            <?php
                            if($r["status"] == 0) echo "Pending";
                            elseif($r["status"] == 1) echo "Confirmed";
                            if($r["status"] == 2) echo "Rejected";
                            ?>
                        </td>
                        <td>
                            <a href="invoice.php?type=Adoption&id=<?php echo $r["adopt_id"] ?>">Click here</a>
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