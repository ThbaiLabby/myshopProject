<!doctype html>
<html lang="us">
<head>
	<meta charset="utf-8">
	<title>My Shop Admin Site</title>
        <!-- USING JQUERY UI - Include file for Jquery UI library, blitzer theme -->
	<link href="css/blitzer/jquery-ui-1.10.3.custom.css" rel="stylesheet">
        <link href="css/customstyle.css" rel="stylesheet">
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
	<script src="js/components.js"></script>
        <?php 
            // include database file
            require_once('preheader.php');
            require_once('Utils.php');
            // and the class
            include ('ajaxCRUD.class.php');
        ?>
</head>
<body>
<?PHP
    /*Prepare session */
    session_start();
    // check buttons
    if(isset($_POST['btnLogin'])){
        if($_POST['txtUsername'] == "admin" && $_POST['txtPassword'] = "admin"){
            // logged in
            $_SESSION['adminlogin'] = 1;
            Utils::showMessage("You are now logged in as Super user");
        } else {
            Utils::showErrorMessage("Wrong Username or password");
        }
    }
    
    if(isset($_POST['btnLogout'])){
        unset($_SESSION['adminlogin']);
        Utils::showMessage("You have now been loged out");
    }
?>
</script>
<!-- page - container div -->
<div id="page">
    <!-- Header -->
    <div id="header">
        <div id="logo"><h1 class="demoHeaders">My Shop Admin site</h1></div>
    </div>
    <!-- Admin Main Menu Tabs -->
    <div id="mainmenu">
        <ul id="adminmenu">
            <li><a href="index.php">Home</a></li>
            <li><a href="users.php">Users Accounts</a></li>
            <li><a href="orders.php">Process Orders</a></li>  
            <li><a href="products.php">Manage Products</a></li>
            <li><a href="categories.php">Edit Categories</a></li>
        </ul>
    </div>
    <div id="content">
        <?PHP
            if(isset($_SESSION['adminlogin'])){
                echo 'You are logged in as Super User<br />';
                ?>
                <form method="POST">
                    <button id="btnLogout" name="btnLogout">Logout</button>
                </form>
                <?PHP
            }  else {
                //display login form
                ?>
                <form method="POST">
                    <h3>Please Login</h3>
                    Username: <input type="text" name="txtUsername" /><br />
                    Password: <input type="password" name="txtPassword"/> <br />
                    <button id="btnLogin" name="btnLogin">Login</button>
                </form>
                <?PHP
            }
            
        ?>
    </div>
</div>
   <!-- Footer -->
    <div id="footer">
        <p>Copyright &copy; 2013</p>
    </div>
</body>
</html>
