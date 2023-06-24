<?php
    include "../connection.php";

    $recordID = $_GET["recordID"];
    $fromPage = $_GET["fromPage"];
    
    // print_r($_GET);
    
    $delete_sql_statement = 'DELETE FROM transactions WHERE transactionID = "' . $recordID . '"';
    echo $delete_sql_statement . "<br>";
    
    $result = mysqli_query($connection, $delete_sql_statement);

    if ($result) {
        echo "Successfully deleted transaction.";
        $_SESSION["transactionDeleted"] = "$recordID";
        if ($fromPage == "display") {
            header("Location:" . SITEURL . "servers/display-all.php");
        } elseif ($fromPage == "alter") {
            header("Location:" . SITEURL . "servers/alter-all.php");
        }
    } else {
        echo "Failed to delete transaction: " . $recordID;
    }
?>