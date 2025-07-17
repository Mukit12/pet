<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("shared/header.php") ?>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <div class="container">
        <div class="row">
            <div class="col-9">
                <div style="background: rosybrown; border-radius: 15px; padding-top: 1rem; margin: 5rem auto;">
                    <h1 class="text-uppercase text-white font-weight-bold text-center">About Us</h1>

                    <hr class="divider my-4" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-9">
                <section class="page-section">
                    <div class="container">
                        <p style="font-size: 1.5rem;">
                            Online Doctors Appointment Management System is a smart web application that offers online appointments for patients as well as a login form for admin and doctors. Administrators and physicians can sign up by providing their username and password, among other information. The admin and doctor can log in using their username and password upon successful registration. After logging in successfully, they will see two distinct interfaces. The patient&#39;s appointment schedule, which is taken online, is viewable by the admin and doctor. Patient appointment and billing information is editable by admin and admin can also delete this information. Doctor has access to patient data and can print the report following an examination. A fully completed online appointment request form is required from the patients. A massage that says &quot;Appointment successfully taken&quot; is given to the patient if they successfully complete the form. According to service categories and the kind of issue the patient is having, the patient can select their doctor. Finding and displaying the patient history is made possible by the search results. Any patient can be located by the admin by looking for their ID. Any patient history can be printed with the use of the print option. A PDF of any patient history can be viewed by the administrator and doctor using the PDF option. The patient will receive an email stating that the appointment has been confirmed and can view the status in the status tab. Both the patient&#39;s financial information and appointment details can be stored in this system.
                        </p>        
                    </div>
                </section>
            </div>
        </div>
    </div>

    <br><br>

    <!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("shared/_js.php") ?>

    <!----modals----->
    <?php require_once("shared/modals.php") ?>
</body>
</html>