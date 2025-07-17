<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("shared/header.php") ?>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <div class="container-fluid">
        <br>

        <style type="text/css">
            .carousel{
                position: relative;
            }

            .carousel .item, .carousel .item img{
                width: 100%;
                height: 100vh;
                position: absolute;
                z-index: -10;
            }

            .carousel .item{
                transition: 0.5s;
                opacity: 0;
            }

            .carousel .active{
                opacity: 1;
            }

            .carousel-btn{
                position: absolute;
                width: 97%;
                height: 100vh;
                z-index: 0;
            }

            .carousel-btn .carousel-control{
                position: absolute;
                z-index: 10;
                background: #00000091;
                cursor: pointer;
            }
        </style>

        <div class="col-md-9 wow fadeInDown">
            <div class="carousel">
                <div class="item active">
                  <img src="assets/images/gggg.jpg">
                </div>

                <div class="item">
                  <img src="assets/images/Carousal1.jfif">
                </div>

                <div class="item">
                  <img src="assets/images/Carousal2.jfif">
                </div>

                <div class="item">
                  <img src="assets/images/Carousal3.jfif">
                </div>
            </div>

            <div class="carousel-btn">
                <p onclick="prevSlide()" class="carousel-control" style="border-radius: 0 43% 43% 0;box-shadow: 15px 0 25px 0 #00000091;">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </p>

                <p onclick="nextSlide()" class="right carousel-control" style="border-radius: 43% 0 0 43%;box-shadow: -15px 0 25px 0 #00000091;">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </p>
            </div>
        </div>

        <!-- script for carousel -->
        <script type="text/javascript">
            let i = 0;
            const imgs = document.querySelectorAll(".carousel .item");
            function prevSlide(){
                imgs.forEach(e=>e.classList.remove("active"));
                
                if(i == 0)
                    i = imgs.length - 1;
                else i--;

                imgs[i].classList.add("active");
            }
            function nextSlide(){
                imgs.forEach(e=>e.classList.remove("active"));
                
                if(i == (imgs.length - 1))
                    i = 0;
                else i++;

                imgs[i].classList.add("active");
            }
        </script>

        <div class="col-md-3" >
            <div class="panel panel-default wow fadeInDown">
            <div class="panel-heading wow fadeInDown" style="font-weight:bold; font-size:16px; color:#36648B;">
                    Welcome To Our PetCare shop<i class="glyphicon glyphicon-calendar"></i> <?php echo date('M d, Y');?>
                </div>

            </div>

            <div class="panel panel-default wow fadeInDown">
                <div class="panel-heading wow fadeInDown" style="font-weight:bold; font-size:16px; color:#36648B;">Petcare shop On Special Offer </div>

                <ul class="list-group">
                    <li class="list-group-item wow fadeInDown">Kitten Food - <span style="color:#8B8B00; font-weight:bold;">600(BDT)  </span> <span style="color:#EE5C42;" class="glyphicon glyphicon-ok pull-right"></span></li>
                    <li class="list-group-item wow fadeInDown">Adult cat food  - <span style="color:#8B8B00; font-weight:bold;"> 1300(BDT) </span> <span style="color:#EE5C42;" class="glyphicon glyphicon-ok pull-right"></span></li>
                    <li class="list-group-item wow fadeInDown">Dog food  - <span style="color:#8B8B00; font-weight:bold;">2000(BDT) </span> <span style="color:#EE5C42;" class="glyphicon glyphicon-ok pull-right"></span></li>

                    <li class="list-group-item wow fadeInDown">Cat shampoo - <span style="color:#8B8B00; font-weight:bold;">750(BDT) </span> <span style="color:#EE5C42;" class="glyphicon glyphicon-ok pull-right"></span></li>
                </ul>

                <div class="panel-heading wow fadeInDown"></div>

                <a href="#" class="btn btn-success btn-sm pull-right wow fadeInDown">Click here to View More</a>
            </div>
            
            <br>

            <div class="panel panel-default wow fadeInDown">
                <div class="panel-heading wow fadeInDown" style="font-size:16px; font-weight:bold; color: #36648B;">Our Location</div>

                <div class="recent-work-wrap wow fadeInDown">
                    <img class="img-responsive wow fadeInDown" src="assets/images/mapp.jfif" alt="">
                </div>
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