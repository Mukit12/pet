<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("shared/header.php") ?>
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
                <style type="text/css">
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
                </style>

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
                </style>

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
                                            <button class="btn" style="background: rosybrown; color: white; outline: none;" onclick="addCart(this)" product-id="<?php echo $r["id"] ?>">Add to cart</button>
                                        <?php endif; ?>
                                    </div>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <script type="text/javascript">
                        function addCart(e){
                            const [productId, isInCart] = [e.getAttribute("product-id"), e.getAttribute("in-cart")];
                            const cart = localStorage.getItem("cart");

                            if((cart == null) || (cart == "")){
                                localStorage.setItem("cart", `${productId}`);
                                alert("Added to the cart successfully");
                            }
                            else{
                                let cartItems = cart.split(",");

                                if(cartItems.indexOf(productId) != -1){
                                    alert("Already added to the cart");
                                }
                                else{
                                    localStorage.setItem("cart", `${cart},${productId}`);
                                    alert("Added to the cart successfully");
                                }
                            }
                        }
                    </script>
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