<?php

/*
 * Login Page
 */

/* Logout */
function logout(){
    // logout user
    if(isset($_SESSION['userId']))
    {
        unset($_SESSION['userId']);
    }
    // clear cart
    if(isset($_SESSION['cart']))
    {
        unset($_SESSION['cart']);
    }
    // or use
    // session_destroy();
    Utils::showMessage("You have now been logged out");
}

/* Display User information */
function displayUserInfo(){
    $record = Shop::getUserInfo($_SESSION['userId']);
    echo 'Hi ' . $record['Firstname'] . ' ' . $record['Surname'] . ', Happy Shopping';
    echo '<form method="POST"><button name="btnLogout" id="btnLogout">Logout</button></form>';
}

function displayGuestLogin(){
    // Guest, show login and register controls
    if(isset($_POST['txtEmail']))
    {
        // try login user
        // username and password sent from form, 
        // mysql_real_escape_string prevents SQL injection
        $userEmail=mysql_real_escape_string($_POST['txtEmail']);
        $userPassword=mysql_real_escape_string($_POST['txtPassword']);

        $sql="SELECT * FROM users WHERE Email='$userEmail' and password='$userPassword'";
        $result=mysql_query($sql);

        // see if logins matched any result
        $count=mysql_num_rows($result);

        if($count == 1)
        {
            $record = mysql_fetch_array($result);
            $_SESSION['userId'] = $record['id'];
            displayUserInfo();
            Utils::showMessage("You are now logged in");
        }
        else
        {
            Utils::showErrorMessage("Wrong username and or password");
            if(isset($_SESSION['userId']))
            {
                unset($_SESSION['userId']);
            }
            // display form
            echo 'Hi Guest Shopper, Welcome to our shop';
            echo '<form method="POST"><button name="btnRegister" id="btnRegister">Register</button></form>';
            echo '<form name="loginform" method="POST">';
            echo 'Email: <input type=email name="txtEmail" id="txtEmail" />';
            echo 'Password: <input type="password" name="txtPassword" id="txtPassword" />';
            echo '<button name="btnLogin" id="btnLogin">Login</button>';
            echo '</form>';
            
        }
    }
    else
    {
        // display form
        echo 'Hi Guest Shopper, Welcome to our shop';
        echo '<form method="POST"><button name="btnRegister" id="btnRegister">Register</button></form>';
        echo '<form name="loginform" method="POST">';
        echo 'Email: <input type=email name="txtEmail" id="txtEmail" />';
        echo 'Password: <input type="password" name="txtPassword" id="txtPassword" />';
        echo '<button name="btnLogin" id="btnLogin">Login</button>';
        echo '</form>';
        
    }
}

function displayCartStatus(){
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    // display cart count items
    echo 'You have ' . count($_SESSION['cart']) . ' items in your shopping cart';
}

// check if lout clicked
if(isset($_POST['btnLogout'])){
    logout();
}
// register button
if(isset($_POST['btnRegister'])){
    // Show registration popup form
    echo '<div id="registration" title="Registration Form">';
    echo '<form method="POST">';
    echo '<table><tr><td>Firstname:</td><td> <input type=text name="txtfn" value="" /></td></tr>';
    echo '<tr><td>Surname:</td><td> <input type=text name="txtsn" value="" /></td></tr>';
    echo '<tr><td>Phone:</td><td> <input type=text name="txtpn" value="" /></td></tr>';
    echo '<tr><td>Email:</td><td> <input type=text name="txtem" value="" /></td></tr>';
    echo '<tr><td>Password:</td><td> <input type="password" name="txtpass" value="" /></td></tr>';
    echo '<tr><td></td><td><button name="btnRegisterUser" class="buyButton">Register</button></td></tr></table></form>';
    echo '</div>';
}

if(isset($_POST['btnRegisterUser'])){
    if(Shop::addUser($_POST['txtfn'], $_POST['txtsn'], $_POST['txtem'], $_POST['txtpn'], $_POST['txtpass'])){
        Utils::showMessage("User was successsfully created, use your email and passsword to login");
    }else{
        Utils::showErrorMessage("The was a problem creating the user");
    }
}

/* if already logged in, Display user and logout button, else guest login form */
if(isset($_SESSION['userId'])){
    // there is a user logged in, show user details and logout
    displayUserInfo();
    displayCartStatus();
}
else
{
    // show Guest login and login controls
    displayGuestLogin();
    displayCartStatus();
}

?>
