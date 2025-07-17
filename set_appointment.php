<!DOCTYPE html>
<html lang="en">
<head>
    <?php $auth_check=true; require_once("shared/header.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <div class="container-fluid" style="margin-top: 2rem;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-responsive table-hover">
                        <?php
                            require_once("shared/db.php");
                            $query = $conn->prepare("SELECT * FROM `vets`; ");
                            $query->execute();
                            $query->setFetchMode(PDO::FETCH_ASSOC);
                            $res = $query->fetchAll();
                            $cnt = 0;
                        ?>

                        <?php foreach($res as $r): ?>
                        <tr>
                            <td>
                                <center><strong class="wow fadeInDown"><p style="margin-top:25px;">No. <?php echo ++$cnt ?></p></strong></center>
                            </td>

                            <td><center><img src="uploads/vets_profile_pics/<?php echo $r["profile_pic"] ?>" width="120px;" class="img-responsive img-rounded wow fadeInDown"></center></td>

                            <td> 
                                <dl class="dl-horizontal wow fadeInDown" style="text-align:left">
                                    <dt>Name:</dt> &nbsp;Dr. <?php echo $r["name"] ?><dd></dd>
                                    <dt>Email:</dt> &nbsp;<?php echo $r["email"] ?><dd></dd>
                                    <dt>Time:</dt> &nbsp;<?php echo date("h:i A", strtotime($r["service_start"])) ?> ~ <?php echo date("h:i A", strtotime($r["service_end"])) ?><dd></dd>
                                    <dt>Fee:</dt> &nbsp;<?php echo $r["fee"] ?> Taka<dd></dd>
                                    <dt>Address:</dt> &nbsp;<?php echo $r["address"] ?><dd></dd>
                                </dl>
                            </td>

                            <td>
                                <a href="#appointmentModal" data-toggle="modal" data-target="#appointmentModal" onclick="setAppointment(<?php echo $r["id"] ?>, '<?php echo date("H:i:s", strtotime($r["service_start"])) ?>', '<?php echo date("H:i:s", strtotime($r["service_end"])) ?>')" class="btn btn-primary">Select this vet</a>
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
    </div>

    <br><br>

    <!-- appontment modal -->
    <div class="modal fade bs-example-modal-sm" id="appointmentModal" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content wow fadeInDown">
                <div class="modal-header">
                    <h4 class="wow fadeInDown">Online Pet care center Management System</h4>
                </div>
                <br />

                <center style="margin-bottom: 0.5rem;"><i class="fa fa-user"></i> Appointment form</center>

                <form class="form-horizontal wow fadeInDown" method="POST" action="shared/requests.php">
                    <input type="hidden" id="vetId" name="vet_id">

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
                        <label class="col-sm-4 control-label wow fadeInDown">Pet name</label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" name="pet_name" placeholder="Enter your pet name" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Pet breed</label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" name="pet_breed" placeholder="Enter your pet breed" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Pet species</label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" name="pet_species" placeholder="Enter your pet species" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Pet age</label>
                        
                        <div class="col-sm-6">
                            <input type="number" min="0"step="0.1" class="form-control wow fadeInDown" name="pet_age" placeholder="Enter your pet age" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Appointment date</label>
                        
                        <div class="col-sm-6">
                            <input type="date" class="form-control wow fadeInDown" name="appointment_date" placeholder="Enter your appointment date" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Appointment time</label>
                        
                        <div class="col-sm-6">
                            <select id="appointmentSchedules" class="form-control wow fadeInDown" name="appointment_time" required></select>
                        </div>
                    </div>

                    <div class="modal-footer wow fadeInDown" style="padding-right:110px;">
                        <button type="submit" name="set_appointment" class="btn btn-info wow fadeInDown"><span class="glyphicon glyphicon-log-in"></span> Set appointment</button>
                        
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

    <script type="text/javascript">
        function setAppointment(id, service_start, service_end){
            $("#appointmentSchedules").html("");
            $('#vetId').val(id);
            let todayDate = moment().format("YYYY-MM-DD ");
            service_start = moment(todayDate + service_start);
            service_end = moment(todayDate + service_end);

            while(1){
                let schedule = service_start.add("1", "m").format("hh:mm A") + " ~ " + service_start.subtract('1', 'm').add('30', 'm').format("hh:mm A");
                let scheduleOptionTag = `<option value='${schedule}'>${schedule}</option>`
                $("#appointmentSchedules").html($("#appointmentSchedules").html() + scheduleOptionTag);

                if(service_start.isSameOrAfter(service_end)) break;
            }
        }
    </script>
</body>
</html>