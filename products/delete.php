<?php
require "header.php";
require "connection.php";
if(isset($_GET['id'])){
    $sql="DELETE FROM products WHERE id = ".$_GET['id'];
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    header('location: index.php?act=product');
    
}