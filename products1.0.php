<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("shared/header.php") ?>
    <style type="text/css">
        .products-display{
            margin: 2rem auto;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 25px;
        }

        .product{
            display: flex;
            gap: 20px;
            width: 500px;
            padding: 0.8rem;
            background: white;
            border: 2px solid transparent;
            border-radius: 15px;
            transition: 0.4s;
        }

        .product:hover{
            border-color: rosybrown;
        }

        .product .product-img, .product .product-details{
            width: 50%;
        }
                    
        .filter-form{
            margin: 2rem auto;
            background: white;
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            width: 60%;
            justify-content: space-between;
        }

        .product-info{
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 2px solid rosybrown;
            width: 80%;
            margin: 0 auto 1rem auto;
            border-radius: 6px;
            padding: 6px;
        }

        .product-info img{
            width: 80px;
        }
    </style>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <div class="container" style="margin-top: 5rem;">
        <div class="row">
            <div class="col-12">
                <h1 class="text-uppercase font-weight-bold text-center" style="color: rosybrown;">All products</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form class="form-horizontal filter-form" method="GET" action="">
                    <div>
                        <label for="prodType">Product type: </label>
                        <input id="prodType" type="text" name="prod_type" placeholder="toy/food/wearing" value="<?php echo isset($_GET["prod_type"]) ? $_GET["prod_type"] : "" ?>">
                    </div>

                    <div>
                        <label for="petType">Pet type: </label>
                        <input id="petType" type="text" name="pet_type" placeholder="cat/dog/bird" value="<?php echo isset($_GET["pet_type"]) ? $_GET["pet_type"] : "" ?>">
                    </div>

                    <div>
                        <button class="btn btn-info" type="submit">Filter</button>
                        <a href="products.php" class="btn btn-danger">Clear</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="products-display">
                    <?php
                        require_once("shared/db.php");
                        $sql = "SELECT accessories.id, accessories.name, accessories.image, accessories.description, accessories.type, accessories.pet_type, accessories.prize, accessories.qty, vendors.name as vend_name FROM `accessories` INNER JOIN `vendors` ON accessories.vendor_id=vendors.id ";
                        if((isset($_GET["prod_type"]) && $_GET["prod_type"]!="") && (isset($_GET["pet_type"]) && $_GET["pet_type"]!=""))
                            $sql .= "WHERE accessories.type LIKE '%".$_GET["prod_type"]."%' OR accessories.pet_type LIKE '%".$_GET["pet_type"]."%' ";
                        else{
                            if(isset($_GET["prod_type"]) && $_GET["prod_type"]!="")
                                $sql .= "WHERE accessories.type LIKE '%".$_GET["prod_type"]."%' ";
                            if(isset($_GET["pet_type"]) && $_GET["pet_type"]!="")
                                $sql .= "WHERE accessories.pet_type LIKE '%".$_GET["pet_type"]."%' ";
                        }

                        $query = $conn->prepare($sql);
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                        $res = $query->fetchAll();
                        $cnt = 0;
                    ?>

                    <?php foreach($res as $r): ?>
                        <div class="product">
                            <div class="product-img">
                                <img src="assets/images/products/<?php echo $r["image"] ?>">
                            </div>

                            <div class="product-details">
                                <h1 style="color: rosybrown;"><?php echo $r["name"] ?></h1>
                                <h5 style="color: gray; margin-top: -10px"><?php echo $r["vend_name"] ?></h5>

                                <br>

                                <p style="font-size: 1.5rem;">
                                    Product-type: <i><?php echo $r["type"] ?></i> <br>
                                    Pet-type: <i><?php echo $r["pet_type"] ?></i> <br>
                                    Available products: <i><?php echo $r["qty"] ?></i> <br>
                                    
                                    <br><br>

                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span style="color: rosybrown; font-size: 2.5rem; font-weight: 800;"><?php echo $r["prize"] ?>/=</span>

                                        <?php if($r["qty"] != 0): ?>
                                            <?php if(isset($_SESSION["user"])): ?>
                                                <a
                                                    data-toggle="modal"
                                                    data-target="#qtyModal"
                                                    href="#qtyModal"
                                                    class="btn"
                                                    style="background: rosybrown; color: white;"
                                                    onclick="qtyModalInfo(<?php echo $r["id"] ?>, '<?php echo $r["name"] ?>', '<?php echo $r["vend_name"] ?>', '<?php echo $r["image"] ?>', <?php echo $r["prize"] ?>, <?php echo $r["qty"] ?>)"
                                                >Purchase</a>
                                            <?php else: ?>
                                                <a
                                                    data-toggle="modal"
                                                    data-target="#loginModal"
                                                    href="#loginModal"
                                                    class="btn"
                                                    style="background: rosybrown; color: white;"
                                                >Purchase</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <script type="text/javascript">
                    var Price;
                    function qtyModalInfo(id, name, vend_name, image, price, qty){
                        $("#id").val(id);
                        $("#name").html(name);
                        $("#vendName").html(vend_name);
                        $("#productImg").attr("src", `assets/images/products/${image}`);

                        Price = price;
                        $("#price").html(`${price}/=`);
                        $("#amount").html(`${Price}/=`);
                        $("#qty").val(1);

                        if(qty < 5)
                            $("#qty").attr("max", qty);
                        else
                            $("#qty").attr("max", 5);
                    }
                </script>

                <!-- quantity modal -->
                <div class="modal fade bs-example-modal-sm" id="qtyModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content wow fadeInDown">
                            <div class="modal-header">
                                <h4 class="wow fadeInDown">Purchase form</h4>
                            </div>

                            <br />

                            <div class="product-info">
                                <div style="display: flex; gap: 10px;">
                                    <img id="productImg" src="">

                                    <div>
                                        <h2 id="name" style="color: rosybrown;"></h2>
                                        <span id="vendName" style="color: gray; margin-top: -10px"></span>
                                    </div>
                                </div>

                                <span id="price" style="color: rosybrown; font-size: 2rem; font-weight: 800;">0/=</span>
                            </div>

                            <form class="form-horizontal wow fadeInDown" method="POST" action="checkout/checkout.php">
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label wow fadeInDown">Select quantity</label>
                                    
                                    <div class="col-sm-6">
                                        <input id="qty" type="number" class="form-control wow fadeInDown" name="qty" min="1" max="5" value="1" required onchange="$('#amount').html(`${this.value*Price}/=`)">
                                    </div>
                                </div>

                                <input type="hidden" name="id" id="id">

                                <p class="text-center text-bold">
                                    Total amount: <span id="amount" style="font-size: 5rem; color: rosybrown;">0/=</span>
                                </p>

                                <div class="modal-footer wow fadeInDown" style="padding-right:110px;">
                                    <button type="submit" name="purchase" class="btn wow fadeInDown" style="background: rosybrown; color: white;">Purchase</button>
                                    
                                    <button id="loginModalClose" type="button" class="btn btn-danger wow fadeInDown" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
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