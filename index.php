<?php

if(isset($_GET['act'])){
    $act=$_GET['act'];
    switch ($act) {
        case 'category':
            require 'category/list.php';
            break;
        case 'product':
            require 'products/list.php';
            break;
        case 'add_category':
            require 'category/add.php';
            break;
        case 'add_product':
            require 'products/add.php';
            break;
        case 'edit_product':
                require 'products/edit.php';

            break;
        case 'edit_category':
            require 'category/edit.php';
            break;
        case 'edit_product':
            require 'products/edit.php';
            break;
        case 'delete_category':
            require 'category/delete.php';
            break;
        case 'delete_product':
            require 'products/delete.php';
            break;
        default:
         require 'header.php';
         break;
    }
}
else{
    require 'header.php';
}

?>