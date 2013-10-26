<!-- Search page -->
<div>
    <h2 class="demoHeaders">Advanced Product Search</h2>
    <form method="POST" action="#AdvancedSearch">
        Keyword: <input name="autocomplete" id="autocomplete" title="type &quot;a&quot;">
        By Category: <select name="ddCategories">
            <option value="All">All</option>
        <?PHP
            $result = Shop::getCategories();
            while($record = mysql_fetch_array($result)){
                echo "<option value='" . $record['category'] . "'>" . $record['category'] . "</option>";
            }
        ?>
        </select>
        By Brand: <select name="ddBrands">
            <option value="All">All</option>
        <?PHP
            $result = Shop::getBrands();
            while($record = mysql_fetch_array($result)){
                echo "<option value='" . $record['Make'] . "'>" . $record['Make'] . "</option>";
            }
        ?>
        </select> 
        <button name="btnSearch" id="btnSearch">Search</button>
    </form>
    <?php
    // display search products function
    function displayProducts($result){
        echo '<table class="productstable">';
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
        echo '</table>';
    }
    // check buttons
    if (isset($_POST['btnSearch'])){
        if(isset($_POST['ddCategories']) && $_POST['ddCategories'] != "All"){
            $result = Shop::getCategoryProducts($_POST['ddCategories']);
            $count=mysql_num_rows($result);
            Utils::showMessage($count . ' Products found by Category');
        }else if(isset($_POST['ddBrands'])  && $_POST['ddBrands'] != "All"){
            $result = Shop::getBrandProducts($_POST['ddBrands']);
            $count=mysql_num_rows($result);
            Utils::showMessage($count . ' Products found by Brand');
        }
        
        displayProducts($result);
    }else{
        echo 'Search for products by Keyword, Category and Brand';
    }
    ?>
</div>
