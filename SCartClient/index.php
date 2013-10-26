<!doctype html>
<html lang="us">
<head>
	<meta charset="utf-8">
	<title>My Shop</title>
        <!-- USING JQUERY UI - Include file for Jquery UI library, blitzer theme -->
	<link href="css/blitzer/jquery-ui-1.10.3.custom.css" rel="stylesheet">
        <link href="css/customstyle.css" rel="stylesheet">
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
	<script src="js/components.js"></script>
        <?php include 'Utils.php'; ?>
        <?php include 'Shop.php'; ?>
</head>
<body>
<?PHP
    /* connect to db The shop object */
    Shop::dbConnect();
    
    /*Prepare session */
    session_start();
    // prepare cart if not done yet
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
?>
<!-- page - container div -->
<div id="page">
    <!-- Header -->
    <div id="header">
        <div id="logo"><h1 class="demoHeaders">My Shop</h1></div>
        <div id="loginbox"><?php include 'login.php'; ?> </div>
    </div>
    <!-- Main Menu Tabs -->
    <div id="tabs">
            <ul>
                    <li><a href="#Home">Home</a></li>
                    <li><a href="#AdvancedSearch">Advanced Search</a></li>
                    <li><a href="#ViewCart">View Cart</a></li>
                    <li><a href="#MyAccount">My Account</a></li>
                    <li><a href="#ContactUs">Contact Us</a></li>
            </ul>
            <div id="Home"><?PHP include 'products.php';?></div>
            <div id="AdvancedSearch"><?PHP include 'search.php';?></div>
            <div id="ViewCart"><?PHP include 'cart.php';?></div>
            <div id="MyAccount"><?PHP include 'account.php';?></div>
            <div id="ContactUs"><?PHP include 'contact.php';?></div>
    </div>
    
</div>
   <!-- Footer -->
    <div id="footer">
        <p>Copyright &copy; Malapela MM 2013</p>
    </div>
</body>
</html>
