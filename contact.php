<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("shared/header.php") ?>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <div class="container">
        <div class="row" style="display: flex; gap: 1rem;">
            <div style="width: 50%;">
                <div style="margin: 5rem auto;">
                    <h1 class="text-uppercase font-weight-bold" style="color: rosybrown;">Get in touch</h1>

                    <div style="background: rosybrown; width: 70%; height: 8px;"></div>

                    <p style="margin-top: 1rem; font-size: 1.5rem;">
                        Online Pet care center Management System <br>
                        Dhaka-1230, Bangladesh <br><br>

                        <u>Our branches: </u> Uttara, Mirpur <br><br>

                        Email: <a href="mailto:a@b.c">mukituchchash@gmail.com</a> <br>
                        Contact no: <a href="tel:+8801921580838">+8801921580838</a>
                    </p>
                </div>
            </div>

            <div style="width: 50%;">
                <form class="form-horizontal wow fadeInDown" method="POST" action="shared/requests.php" style="margin: 5rem auto;">
                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Name</label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" name="name" placeholder="Enter your name" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Email</label>
                        
                        <div class="col-sm-6">
                            <input type="email" class="form-control wow fadeInDown" name="email" placeholder="Enter email" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Opinion</label>
                        
                        <div class="col-sm-6">
                            <textarea class="form-control wow fadeInDown" name="thoughts" placeholder="Enter your thoughts" required></textarea>
                        </div>
                    </div>

                    <div class="form-group" style="display: flex; justify-content: center;">
                        <button type="submit" name="opinion" class="btn wow fadeInDown" style="background: rosybrown; color: white;">Send us a message</button>
                    </div>
                </form>
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