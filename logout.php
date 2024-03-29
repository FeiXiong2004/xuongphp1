<?php
session_unset();
header('Location: login.php');
setcookie('logout','Log out confirm',time()+1);
?>