<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("shared/header.php") ?>
    <style type="text/css">
        table, tr, th, td{ border: 1px dashed #8c8b8b; }

        #form{
            width: 300px;
            margin: auto;
            margin-top: 2rem;
            border: 2px solid rosybrown;
            border-radius: 8px;
            padding: 15px;
        }
    </style>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>
    
    <div class="container-fluid" style="margin-top: 2rem; height: auto;">
        <div class="container">
            <form method="POST" action="checkout/checkout.php">
                <div class="row">
                    <div class="col-12">
                        <h1 class="my-5 text-center" style="color: rosybrown;">Cart</h1>

                        <table class="table table-responsive table-hover" style="margin-top: 2rem;" id="dataTable">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Product name</th>
                                <th>Vendor</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total amount</th>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div id="form">
                            <div class="form-group">
                                <label for="address" class="control-lebel">Delivery address</label>

                                <input id="address" class="form-control" type="text" name="address" required placeholder="Product pickup place">
                            </div>

                            <div class="form-group">
                                <input id="cod" class="" type="radio" name="pay_type" value="cod" required>

                                <label for="cod" class="control-lebel"> Cash on delivery</label>

                                <input id="online_pay" class="" type="radio" name="pay_type" value="online_pay" required checked>

                                <label for="online_pay" class="control-lebel"> Pay online</label>
                            </div>

                            <input type="hidden" name="ids">

                            <div class="form-group" style="display: flex; justify-content: center;">
                                <button class="btn btn-success" type="submit">Purchase</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <br><br>

    <!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("shared/_js.php") ?>

    <script type="text/javascript">
        let totalPrice = 0;
        let prices = {};

        $("input[name=ids]").val(localStorage.getItem('cart'));

        $.ajax({
            method: "POST",
            url: "cartItems.php",
            data: {cart: localStorage.getItem("cart")},
            success: res=>{
                const {data} = JSON.parse(res);
                let table = $("#dataTable").html();
                data.forEach((e, index)=>{
                    totalPrice += parseInt(e.price);
                    prices[e.id] = {price: e.price, qty: 1};

                    table += `
                        <tr>
                            <td>${index+1}</td>
                            <td>
                                <img style="width: 100px;" src="assets/images/products/${e.image}">
                            </td>
                            <td>${e.name}</td>
                            <td>${e.vend_name}</td>
                            <td>${e.price}/=</td>
                            <td>
                                <input name="${e.id}_qty" type="number" class="form-control wow fadeInDown" name="qty" min="1" max="${e.qty>5 ? 5 : e.qty}" value="1" required onchange="changeAmount(this, ${e.id})">
                            </td>
                            <td>
                                <span class="price" id="${e.id}_price" style="color: rosybrown; font-size: 2rem; font-weight: 800;">${e.price}/=</span>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="removeCartItem(${e.id})">Remove from cart</button>
                            </td>
                        </tr>
                    `;
                });

                table += `
                    <tr>
                        <td colspan="6" style="text-align: right; font-weight: bold; font-size: 20px">Total</td>
                        <td colspan="2">
                            <span id="totalPrice" style="color: rosybrown; font-size: 2rem; font-weight: 800;">${totalPrice}/=</span>
                        </td>
                    </tr>
                `;
                $("#dataTable").html(table);
            },
            err: err=>console.log(err)
        });

        function formDisplay(){
            const cart = localStorage.getItem("cart");
            if((cart == null) || (cart == ""))
                $("#form").css("display", "none");
            else
                $("#form").css("display", "block");
        }
        formDisplay();

        function removeCartItem(productId){
            let cartItems = localStorage.getItem("cart").split(",");
            cartItems.splice(cartItems.indexOf(`${productId}`), 1);
            localStorage.setItem("cart", cartItems.join(","));
            window.location.reload();
        }

        function changeAmount(e, productId){
            prices[productId].qty = e.value;
            $(`#${productId}_price`).html(`${prices[productId].qty * prices[productId].price}/=`);
            changeTotalAmount();
        }

        function changeTotalAmount(){
            let cartItems = localStorage.getItem("cart").split(",");
            
            totalPrice = 0;
            cartItems.forEach(e => {
                totalPrice += (prices[parseInt(e)].qty * prices[parseInt(e)].price);
            });

            $("#totalPrice").html(`${totalPrice}/=`);
        }
    </script>
</body>
</html>