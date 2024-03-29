<?php
require "connection.php";
require "header.php";

if (!isset($_POST['submit'])) {
    $sql = "SELECT * FROM category WHERE id = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->execute([$_GET['id']]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    if(empty($name)){
        $error['name'] = 'Vui lòng nhập tên';
    } else {
        $error['name'] = '';
    }
    
    // Update category name
    if(empty($error['name'])) {
        $sql = "UPDATE category SET name=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $_GET['id']]);
        setcookie('edit','Edit confirm',time()+1);
        header('location:index.php?act=category');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD PRODUCT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href=".../css/style.css">
</head>
<style>

</style>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-edit">
        <h1>Edit</h1>
       
        <div class="col-12 mb-2">
            <label for="">Tên Danh Mục</label>
            <input type="text" name="name" class="form-control" value="<?= $category['name'] ?? ''?>"> <span style="color:red"><?= $error['name'] ?? ''?></span>
        </div>
        <div class="col-12 mb-2">
           <input type="hidden" name="id" class="form-control" value="<?= $category['id'] ?? ''?>">
        </div>
        <br>
            <button type="submit" name="submit" class="btn btn-dark ">Submit</button>
           <button type="submit" name="submit" class="btn btn-success "><a href="index.php?act=category" style="color:black;text-decoration:none">List</a></button>
    </div>
    </form>
</body>
</html>