<?php
require "header.php";
require "connection.php";
$error=[];
if(isset($_POST['submit'])){
    $name = $_POST['name_cate'];
    if(empty($name)){
        $error['name_cate'] = 'Vui lòng nhập name';
       
    }else{
        $error['name_cate'] = '';
    }     
            $sql = "INSERT INTO category VALUES(null,'$name')";
            $stmt = $conn->prepare($sql);
            $stmt -> execute();
            setcookie('add','Add confirm',time()+1);
            header('location: index.php?act=category');
           
    } 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href=".../css/style.css">
</head>
<body>
<form action="" method="POST">
            <h1>Add </h1>
            <div class="col-12">
                <label for="">Tên danh mục</label>
                <input type="text" name="name_cate" class="form-control"> <span style="color:red"><?= $error['name_cate'] ?? ''?></span>
            </div>
            <br>
                <button type="submit" name="submit" class="btn btn-dark ">Submit</button>
                <button type="submit" name="submit" class="btn btn-success "><a href="index.php?act=category" style="color:black;text-decoration:none">List</a></button>
</form>
</body>
</html>