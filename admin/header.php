<?php
include "config.php";
session_start();

if (!isset($_SESSION["username"])) {
    header("location: {$localhost}/admin/");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="stylesheet" href="css/edit-css.css">
    <title>login</title>
</head>

<body>
    <div class="container">
        <div class="contant">
            <div class="header">
                <h1>Admin Dashboard</h1>
            </div>
        </div>
        <div class="logout-cont">
            <a href="logout.php">Hello , <?php echo $_SESSION["username"] . " "; ?></a>
        </div>