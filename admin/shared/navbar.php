<nav class="navbar navbar-inverse" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

           <a href="index.php"><h4 class="wow fadeInDown" style="margin-top:20px; color:#FFF;"><img src="../assets/images/logo.jpg" width="10% "/> Petshop Online</h4></a>
        </div>

        <div class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown"><a class="dropdown-toggle wow fadeInDown" data-toggle="dropdown" href="product.php"><span class="glyphicon glyphicon-th"></span> Product <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="products.php"> View products </a></li>
                      <li><a href="product_form.php"> Add product </a></li>
                    </ul>
                </li>

                <li><a class="wow fadeInDown" href="order.php"><span class="glyphicon glyphicon-th"></span> Orders</a>
                </li>

                <li class="dropdown"><a class="dropdown-toggle wow fadeInDown" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-th"></span> Vet list <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="appointments.php"> Pending appointments </a></li>
                      <li><a href="vet_form.php"> Add vet </a></li>
                      <li><a href="vets.php"> Update vet </a></li>
                    </ul>
                </li>

                <li class="dropdown"><a class="dropdown-toggle wow fadeInDown" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-th"></span> Adoptions<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="adoptions.php"> Pending requests </a></li>
                      <li><a href="pet_form.php"> Add pets </a></li>
                      <li><a href="update_pets.php"> Update pets </a></li>
                    </ul>
                </li>

                <li class="dropdown"><a class="dropdown-toggle wow fadeInDown" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-th"></span> Vendor list <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="vendor_form.php"> Add vendor </a></li>
                      <li><a href="vendors.php"> Update vendor </a></li>
                    </ul>
                </li>

                <li id="reservation" class="wow fadeInDown"><a href="sales.php"><span class="glyphicon glyphicon-calendar"></span> Sales report</a></li>
                
                <!-- <li id="admin" class="active wow fadeInDown"><a href="adminacc.php"><span class="glyphicon glyphicon-user"></span> Admin Accounts</a></li> -->
                
                <li id="logout" class="wow fadeInDown"><a id="logoutbtn" href='../logout.php'><span class="glyphicon glyphicon-share"></span> Logout</a></li>                  
            </ul>
        </div>
    </div>
</nav>