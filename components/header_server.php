<?php 
    session_start();
    $_SESSION["currentUserID"] = "devGau";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>This is a webpage</title>
    <link rel="stylesheet" href="../styles/server.css">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

</head>
<body>
    <?php include "../servers/connection.php" ?>
    <?php
        // COMMON FUNCTIONS
    ?>
    <header class="admin-header">
        <a href="../index.php">Back to Home page</a>
        <a href="./alter-all.php">Alter Database</a>
        <a href="./display-all.php">Show Database</a>
    </header>