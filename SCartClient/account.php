<!-- User Account page -->
<div>
    <h2 class="demoHeaders">User Account</h2>
    <?php
    /* if user logged in show user details and history */
    if(isset($_SESSION['userId'])){
        displayUserInfoForm();
        displayUserHistory();
    }else{
        echo '<p>Please Login or register for your account information</p>';
    }
    
    // check buttons
    if(isset($_POST['btnUpdateUser'])){
        Shop::UpdateUser($_SESSION['userId'], $_POST['txtFirstname'], $_POST['txtSurname'], $_POST['txtEmail'], $_POST['txtPhone']);
        Utils::showMessage("User Info Succesfully changed");
    }
    
    function displayUserInfoForm(){
        $record = Shop::getUserInfo($_SESSION['userId']);
        echo '<div id="userform"><form method="POST">';
        echo '<table><tr><th>User ID: </th><th>' . $record['id'] . '</th></tr>';
        echo '<tr><td>Firstname:</td><td> <input type=text name="txtFirstname" value="'. $record['Firstname'] . '" /></td></tr>';
        echo '<tr><td>Surname:</td><td> <input type=text name="txtSurname" value="'. $record['Surname'] . '" /></td></tr>';
        echo '<tr><td>Phone:</td><td> <input type=text name="txtPhone" value="'. $record['Phone'] . '" /></td></tr>';
        echo '<tr><td>Email:</td><td> <input type=text name="txtEmail" value="'. $record['Email'] . '" /></td></tr>';
        echo '<tr><td>Password:</td><td> <input type="password" name="txtPassword" value="" /></td></tr>';
        echo '<tr><td><button name="btnUpdateUser" class="buyButton">Update</button></td></tr></table></form></div>';
    }
    
    function displayUserHistory(){
        $userOders = Shop::getUserOrders($_SESSION["userId"]);
        
        echo '<div id="accordion">';
        while($record = mysql_fetch_array($userOders)){
            echo '<h3>Order Number: ' . $record['id'];
            if($record['processed'] == 0){
                echo ' (Pending)';
            } else{
                echo ' (Processed)';
            }
            echo '</h3>';
            echo '<div>Order Details';
            displayOrderDetails($record['id']);
            echo '</div>';
        }
        echo '</div>';
    }
    
    function displayOrderDetails($oderNumber){
        $totalPrice = 0.0;
        $orderProducts = Shop::getOrderProducts($oderNumber);
        echo '<table class="ordertable">';
        echo '<tr><th>Item</th><th>Cost</th></tr>';
        while ($orderProduct = mysql_fetch_array($orderProducts))
        {
            $record = Shop::getProduct($orderProduct['product']);
            $totalPrice += $record['Price'];
            echo '<tr>';
            echo '<td>' . $record['Make'] . ' ' . $record['Description'] . ' ' . $record['Model'] . '</td>';
            echo '<td>' . $record['Price'] . '</td>';
            echo '</tr>';
        }
        echo '<tr><th>TOTAL: ' . count($_SESSION['cart']) . ' Items</th>'
                . '<th>R ' . $totalPrice . '</th></tr>';
        echo '</table>';
    }
    ?>
</div>
