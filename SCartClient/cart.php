<!-- Shopping Cart page -->
<div>
    <h2 class="demoHeaders">Shopping Cart</h2>
    <?php
    // put your code here
    
    function displayCart(){
        $totalPrice = 0.0;
        echo '<table class="carttable">';
        echo '<tr><th>Product</th><th>Item</th><th>Price</th><th>Actions</th></tr>';
        foreach ($_SESSION['cart'] as $item)
        {
            $record = Shop::getProduct($item);
            $totalPrice += $record['Price'];
            echo '<tr>';
            echo '<td><img src="images/' . $record['Image'] . '.jpeg"/></td>';
            echo '<td>' . $record['Make'] . '<br />' . $record['Description'] . '<br />' . $record['Model'] . '</td>';
            echo '<td>' . $record['Price'] . '</td>';
            echo '<td> <form method="POST"><input type=hidden name="product" value="' . $record['id'] . '" />'
                . '<button name="btnRemove" id="btnRemove" class="buyButton">Remove from Cart</button></form></td>';
            
            echo '</tr>';
        }
        echo '<tr><th>TOTALS</th><th>' . count($_SESSION['cart']) . ' Items</th>'
                . '<th>R ' . $totalPrice . '</th>'
                . '<th><form method="POST"><button name="btnCheckout" class="buyButton">Checkout</button>'
                . 'OR <button name="btnContinue" class="buyButton">Continue Shopping</button></form></th></tr>';
        echo '</table>';
    }
    
    function displayUserInCart(){
        if(isset($_SESSION['userId']))
        {
            $user = Shop::getUserInfo($_SESSION['userId']);
            echo '<h4>' . $user['Firstname'] . ' ' . $user['Surname'] . '</h4>';
            echo 'Email: ' . $user['Email'];
            echo '<br>Phone ' .$user['Phone'];
        }else{
            echo '<h4>Guest Shopper</h4>';
        }
    }
    
    // check cart and display
    if(count($_SESSION['cart']) > 0){
        displayUserInCart();
        displayCart();
    }else{
        displayUserInCart();
        echo '<p>Your Cart is currently empty, please browse around our Shop to buy our product</p>';
    }
    // check buttons
    if(isset($_POST['btnCheckout'])){
        // checkout and restart
        if(Shop::placeOrder()){
             echo '<div id="checkoutDialog" title="Order Succesful">'
            . '<p>Your order has been succesfully placed, you item will be delivered within 2 working days</p>'
                     . '<p>An Order has been Succesfully placed, you can track by using order number: '
                    . Shop::getLastOrderNumber() . ' or see your email for instructions</p></div>';
            // clear cart
            unset($_SESSION['cart']);
            echo '<script>location.reload();</script>';
        }else{
            Utils::showErrorMessage('Order Could not be placed, Please Register or make sure you are logged in');
        }
    }
    
    if(isset($_POST['btnContinue'])){
        echo '<script>location.reload(true);</script>';
    }
    ?>
</div>
