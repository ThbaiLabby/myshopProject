<?php

/**
 * The Shop class is responsible for database functions of the application
 *
 * @author Mashadi
 */
class Shop {
    //put your code here
    
    public static function dbConnect(){
        /* DB Variables */
        $host="localhost";      // Host name
        $username="root";       // username
        $password="";   // password
        $db_name="shopdb";      // Database name
        /* Connect to DB */
        mysql_connect("$host", "$username", "$password");
        mysql_select_db("$db_name");
    }
    
    public static function dbClose(){
        mysql_close();
    }
    
    public static function addUser($firstname, $surname, $email, $phone, $password){
        $sql = "INSERT INTO users(Firstname, Surname, Email, Phone, password) "
                . "values('$firstname', '$surname', '$email', '$phone', '$password')";
        $result = mysql_query($sql);
        
        return $result;
    }

    public static function getBrands(){
    $sql = "SELECT DISTINCT Make FROM products";
    $result = mysql_query($sql);

    return $result;
    }
    
    public static function getCategories(){
    $sql = "SELECT * FROM categories";
    $result = mysql_query($sql);

    return $result;
    }
    
    public static function getAllProducts(){
        $sql = "SELECT * FROM products";
        $result = mysql_query($sql);

        return $result;
    }
    
    public static function getCategoryProducts($category){
        $sql = "SELECT * FROM products WHERE category = '$category'";
        $result = mysql_query($sql);

        return $result;
    }
    
    public static function getProduct($productId){
        $sql = "SELECT * FROM products WHERE id = '$productId'";
        $result = mysql_query($sql);
        
        $record = mysql_fetch_array($result);
        return $record;
    }
    
    public static function getBrandProducts($brand){
        $sql = "SELECT * FROM products WHERE Make = '$brand'";
        $result = mysql_query($sql);

        return $result;
    }
    
    public static function getKeywordProducts($keyword){
        $sql = "SELECT * FROM products WHERE Make like %'$keyword'%";
        //        . "OR Model like %'$keyword'%"
        //        . "OR Description like %'$keyword'%";
        $result = mysql_query($sql);
        return $result;
    }
    
    public static function getUserInfo($userId){
        $sql = "SELECT * FROM users WHERE id = '$userId'";
        $result = mysql_query($sql);
        
        $record = mysql_fetch_array($result);
        return $record;
    }
    
    public static function UpdateUser($userId, $firstname, $surname, $email, $phone){
        // TODO
    }
    
    public static function placeOrder(){
        // insert order
        $sql = "INSERT INTO oders(user, processed) values('" . $_SESSION['userId'] . "', '0')";
        $result = mysql_query($sql);
        // then order products
        $newid = mysql_result(mysql_query("SELECT MAX(id) FROM oders"), 0);
        
        if($result == true){
            // add order products
            foreach ($_SESSION['cart'] as $item) {
                $sql = "INSERT INTO orderproduct(orderNumber, product) values($newid, $item)";
                $result = mysql_query($sql) ;
            }
        }
        return $result;
    }
    
    public static function getLastOrderNumber(){
        $orderNumber = mysql_result(mysql_query("SELECT MAX(id) FROM oders"), 0);
        return $orderNumber;
    }
    
    public static function getOrder($orderId){
        $sql = "SELECT * FROM oders WHERE id = '$orderId'";
        $result = mysql_query($sql);
        
        $record = mysql_fetch_array($result);
        return $record;
    }
    
    public static function getUserOrders($UserId){
        $sql = "SELECT * FROM oders WHERE user = '$UserId'";
        $result = mysql_query($sql);
        
        return $result;
    }
    
    public static function getOrderProducts($orderId){
        $sql = "SELECT * FROM orderproduct WHERE orderNumber = '$orderId'";
        $result = mysql_query($sql);
        
        return $result;
    }
}

?>