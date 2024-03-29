<?php
session_start();
require "header.php";
require "connection.php";
    $sql ="SELECT * FROM category WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $category = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
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
<h2 style="color:red;text-weight:bold"><?= $_COOKIE['add'] ?? ''?></h2>
<h2 style="color:red;text-weight:bold"><?= $_COOKIE['edit'] ?? ''?></h2>
<h2 style="color:red;text-weight:bold"><?= $_COOKIE['delete'] ?? ''?></h2>
    <table class="table">
            <thead>
                <tr>
                <th scope="col">#ID</th>
                <th scope="col">Name</th>
                <th scope="col"><a href="index.php?act=add_category">Add</a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($category as $cate):?>
                <tr>
                    <th scope="row"><?= $cate['id']?></th>
                    <td><?= $cate['name']?></td>
                    <td>
                        <a onclick="return confirm('Do you want to Edit')" href="index.php?act=edit_category&id=<?= $cate['id']?>">Edit</a>
                        <a onclick="return confirm('Do you want to Delete')"href="index.php?act=delete_category&id=<?= $cate['id']?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
</table>
</body>
</html>