<footer id="footer" class="midnight-blue wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 wow fadeInDown">
             &copy; 2025 <a target="_blank" href="#" title="#">
                Petshop Online Website</a>. All Rights Reserved (Mukit Uchhas).
            </div>

            <div class="col-sm-6">
                <ul class="pull-right wow fadeInDown">
                    <li class="wow fadeInDown"><a href="index.php"><i class="fa fa-home"></i> Home</a></li>

                    <li class="wow fadeInDown"><a href="#"><i class="fa fa-phone"></i> Contacts</a></li>
                    
                    <li class="wow fadeInDown">
                        <?php if(isset($_SESSION["user"])): ?>
                            <a href="#">@<?php echo $_SESSION["user"]; ?></a>
                            &nbsp;
                            <a href="logout.php"><i class="fa fa-lock"></i> Log-out</a>
                        <?php else: ?>
                            <a href="#loginModal" data-toggle="modal" data-target="#loginModal"><i class="fa fa-lock"></i> Log-in</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>