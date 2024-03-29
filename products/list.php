<?php
session_start();
require "header.php";
require "connection.php";
    $sql ="SELECT * FROM products WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products= $stmt->fetchAll(PDO::FETCH_ASSOC);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIST PRODUCT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<style>

</style>
<body>
    <h1>Welcome '<?= $_SESSION['username'];?>' </h1>
    <h2><?= $_COOKIE['username'] ?? ''?></h2>
    <table class="table">
            <thead>
                <tr>
                <th scope="col">#ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col"><a href="index.php?act=add_product">Add</a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product):?>
                <tr>
                    <th scope="row"><?= $product['id']?></th>
                    <td><?= $product['name']?></td>
                    <td><?= $product['price']?></td>
                    <td>
                        <img src="img/<?= $product['image']?>" width="100"alt="">
                    </td>
                    <td><?= $product['description']?></td>
                    <td>
                        <a onclick="return confirm('Do you want to Edit')" href="index.php?act=edit_product&id=<?= $product['id']?>">Edit</a>
                        <a onclick="return confirm('Do you want to Delete')"href="index.php?act=delete_product&id=<?= $product['id']?>">Delete</a>
                    </td>   
                </tr>
                <?php endforeach;?>
            </tbody>
</table>
</body>
</html>