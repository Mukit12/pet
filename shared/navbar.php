<nav class="navbar navbar-inverse" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="index.php"><h4 class="wow fadeInDown" style="margin-top:20px; color:#FFF;">Online Pet care center Management System</h4></a>
        </div>

        <div class="collapse navbar-collapse navbar-right wow fadeInDown">
            <ul class="nav navbar-nav">
               <li class="active"><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
               <li><a href="products.php">Pet Products</a></li>
                <li><a href="set_adopt.php">Pet adoption</a></li>
                <li><a href="set_appointment.php">Vet appoinments</a></li>
               
               <?php if(isset($_SESSION["user"])): ?>
                    <li><a href="orders.php">My orders</a></li>
               <?php endif; ?>

               <li ><a href="cart.php">Cart</a></li>
               <li ><a href="about.php">About Us</a></li>
               <li><a href="contact.php">Contacts</a></li>        
            </ul>
        </div>
    </div>
</nav>