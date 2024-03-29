<?php
require "connection.php";
require "header.php";
$sql = "SELECT * FROM category WHERE 1";
$stmt = $conn -> prepare($sql);
$stmt -> execute();
$category = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(isset($_GET['id'])){
$sql = "SELECT * FROM products WHERE id = ".$_GET['id'];
$stmt = $conn -> prepare($sql); 
$stmt -> execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $file = $_FILES['image'];
    $description = $_POST['description'];
    $id_category = $_POST['id_category'];
    $image= $file['name'];
    $image_destination = 'img/'.$image;  
    move_uploaded_file($file['tmp_name'], $image_destination); 
    if(empty($name)){
        $error['name'] = 'Vui lòng nhập name';
    }else{
        $error['name'] = '';
    }
    if(empty($price)){
        $error['price'] = 'Vui lòng nhập price';
    }else{
        $error['price'] = '';
    }
    
    if(empty($description)){
        $error['description'] = 'Vui lòng nhập description';
    }else{
        $error['description'] = '';
    }
    $sql = "UPDATE products SET name=?, price=?, image=?, description=?, id_category=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $price, $image, $description, $id_category, $_GET['id']]);
    setcookie('edit','Edit confirm',time()+1);
    header('location:index.php?act=product');
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
    a{
        color: black;
       text-decoration:none;
    }
</style>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-edit">
        <h1>Edit</h1>
        <div class="col-12 mb-2">
            <label for="">Danh mục</label>
            <select name="id_category" id="">
            <?php foreach ($category as $cate) :?>
                <option value="<?= $cate['id']?>"> <?= $cate['name']?></option>
                <?php endforeach;?>
            </select>  <span style="color:red"><?= $error['id_category'] ?? ''?></span>
        </div>
        <div class="col-12 mb-2">
            <label for="">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" value="<?= $product['name'] ?? ''?>"> <span style="color:red"><?= $error['name'] ?? ''?></span>
        </div>
        <div class="col-12 mb-2">
            <label for="">Giá</label>
            <input type="text" name="price" class="form-control" value="<?= $product['price'] ?? ''?>">  <span style="color:red"><?= $error['price'] ?? ''?></span>
        </div>
        <div class="col-12 mb-">
            <label for="">Hình ảnh</label>
            <img src="img/<?= $product['image'] ?? ''?>" alt="" width="100"> <br> <br>
            <input type="file" name="image" >  <span style="color:red"><?= $error['image'] ?? ''?></span>
        </div>
        <div class="col-12 mb-2">
            <label for="">Description</label>
            <input type="text" name="description" class="form-control" value="<?= $product['description'] ?? ''?>">  <span style="color:red"><?= $error['description'] ?? ''?></span>
        </div>
        <div class="col-12 mb-2">
            <input type="hidden" name="id" class="form-control" value="<?= $product['id'] ?? ''?>">  
        </div>
        <br>
       
            <button type="submit" name="submit" class="btn btn-dark ">Submit</button>
           <button type="submit" name="submit" class="btn btn-success " ><a href="index.php?act=product" style="color:black,text-decoration:none">List</a></button>
    </div>
    </form>
</body>
</html>