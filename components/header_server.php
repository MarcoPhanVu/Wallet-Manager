<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>This is a webpage</title>
    <link rel="stylesheet" href="../styles/server.css">
</head>
<body>
    <?php include "../servers/connection.php" ?>
    <header class="admin-header">
        <a href="../index.php">Back to Home page</a>
        <a href="./alter_all.php">Alter Database</a>
        <a href="./display_all.php">Show Database</a>
    </header>