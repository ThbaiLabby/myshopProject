
<div id="categories">
    <h3 class="demoHeaders">Shop by category</h3>
    <ul id="categorymenu">
        <li><a href="?category=All">All</a></li>
    <?php
    /* Get categories from database and list on menu */
    //$url = strtok($url, '?');
    $result = Shop::getCategories();
    while($record = mysql_fetch_array($result))
    {
        echo '<li><a href="?category=' . $record['category'] . '">' . $record['category'] . '</a></li>';
    }
    ?>
    </ul>
    <div id="datepicker"></div>
</div>
<div id="shop">
    <table class="productstable">
    <?php
    /* List Shop items category */
    if(isset($_GET['category']) && $_GET['category'] != "All"){
        $result = Shop::getCategoryProducts($_GET['category']);
    }else{
        $result = Shop::getAllProducts();
    }
    
    while($record = mysql_fetch_array($result))
    {
        echo '<tr>';
        echo '<td><img src="images/' . $record['Image'] . '.jpeg"/></td>';
        echo '<td>' . $record['Make'] . '<br />' . $record['Description'] . '<br />' . $record['Model'] . '</td>';
        echo '<td> Our Price <br />' . $record['Price'] . '</td>';
        if(in_array($record['id'], $_SESSION['cart'])){
            echo '<td> <form method="POST"><input type=hidden name="product" value="' . $record['id'] . '" />'
            . '<button name="btnRemove" id="btnRemove" class="buyButton">Remove from Cart</button></form></td>';
        }else{
            echo '<td> <form method="POST"><input type=hidden name="product" value="' . $record['id'] . '" />'
            . '<button name="btnBuy" id="btnBuy" class="buyButton">Buy Now</button></form></td>';
        }
        echo '</tr>';
    }
    
    ?>
    </table>
</div>

<?PHP
    function buyProduct($productId){
        $_SESSION['cart'][] = $productId;
        $record = Shop::getProduct($productId);
        Utils::showMessage($record['Make'] .' ' . $record['Description'] . ' added to cart');
        // refresh :-(
        header("Location: #ViewCart");
    }
    
    function removeProduct($productId){
        $pos = array_search($productId, $_SESSION['cart']);
        unset($_SESSION['cart'][$pos]);
        $record = Shop::getProduct($productId);
        Utils::showMessage($record['Make'] .' ' . $record['Description'] . ' removed from cart');
        // refresh :-(
        header("Location: #ViewCart");
    }
    
    if(isset($_POST['btnBuy'])){
        if(in_array($_POST['product'], $_SESSION['cart'])){
            // product already in basket
            Utils::showMessage('You have already baught this product');
        }else{
            // buy product
            buyProduct($_POST['product']);
        }
    }
    
    if(isset($_POST['btnRemove'])){
        removeProduct($_POST['product']);
    }
?>

