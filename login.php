<?php
session_start();
 if(isset($_POST["submit"]) ){
    $username=$_POST["username"];
    $password=$_POST["password"];
        if(empty($username)){
            $error['username'] = 'Vui lòng nhập username';
        }else{
            $error['username'] = '';
        }
        if(empty($password)){
            $error['password'] = 'Vui lòng nhập password';
        }else{
            $error['password'] = '';
        }
        if(!empty($error)){
            if($username == "admin" && $password=="admin"){
                $_SESSION['username'] = $username;
                    header("Location: header.php");
                    setcookie('username','Login Confirm',time()+5);
            }
        }else{
           $error['login']= 'Username and Password not invalid';    
        }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
 
</head>
<style>
    
</style>
<body>
    <div class="form-box">
        <form action="" method="POST">
            <h1>Login</h1>
            <div class="col-12">
                <label for="">Username</label>
                <input type="text" name="username" class="form-control" value="<?= $username ?? ''?>"> <span style="color:red"><?= $error['username'] ?? ''?></span>
            </div>
            <div class="col-12">
                <label for="">Password</label>
                <input type="text" name="password" class="form-control" value="<?= $password ?? ''?>">  <span style="color:red"><?= $error['password'] ?? ''?></span>
            </div>
            <br>
                <button type="submit" name="submit" class="btn btn-dark ">Submit</button>
        </form>
    </div>
</body>
</html>
