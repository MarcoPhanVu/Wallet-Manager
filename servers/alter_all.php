<?php include "../components/header_server.php" ?>

<?php
    session_start();
    // echo $_SESSION["session_variable"];

    $field_query = "SELECT * FROM categories";
	$field_query_result = mysqli_query($connection, $field_query);
    // print_r($field_query_result);
	$field_list = mysqli_fetch_all($field_query_result, MYSQLI_ASSOC);
    // print_r($field_list);
?>

<section class="alter_info">

    <!-- Seclect db by using "SHOW TABLES"-->
    <!-- Let's just do it in the normal way -->    
    <div class="form-container">
        <div class="title">Creating Transactions</div>
        <form action="" method="POST" id="createTransactionForm">
            <!-- Select tag will be use later, now we use Radio for fast interaction  -->
            <fieldset>
                <legend>Choose your Wallets</legend>
                <!-- GET WALLETS FROM DB -->
                <?php 
                    $wallet_query = "SELECT * FROM wallets";
                    $wallet_query_result = mysqli_query($connection, $wallet_query);
                    $wallet_data_all = mysqli_fetch_all($wallet_query_result, MYSQLI_ASSOC);

                    // print_r($wallet_data_all);
                    // echo "<br>" . "heh";
                    // echo "wallet_data_type: " . gettype($wallet_data_all) . "<br>";

                    foreach (array_values($wallet_data_all) as $wallet_data) {
                        $walletID = $wallet_data["walletID"];
                        echo    "<label for='$walletID'>
                                    <input type='radio' name='$walletID'>
                                $walletID</label>" . "";
                    }
                ?>
            </fieldset>

            <fieldset>
                <legend>Choose your Category</legend>
                <!-- GET CATEGORIES FROM USER + WALLET -->
                <?php 
                    $category_query = "SELECT * FROM categories";
                    $category_query_result = mysqli_query($connection, $category_query);
                    $category_data_all = mysqli_fetch_all($category_query_result, MYSQLI_ASSOC);

                    foreach (array_values($category_data_all) as $category_data) {
                        $categoryID = $category_data["categoryID"];
                        echo    "<label for='$categoryID'>
                                    <input type='radio' name='$categoryID'>
                                $categoryID</label>" . "";
                    }
                ?>
            </fieldset>
            <fieldset class="ext-info">
                <legend>Additional Information</legend>
                <label>
                    Amount:
                    <input type="text" name="transAmount" placeholder="160">
                </label>

                <label>
                    Details: 
                    <textarea name="transDetails" placeholder="Describe transaction here..."></textarea>
                </label>

                <label>
                    Occured on:
                    <input type="date" name="transDate" placeholder="160">
                </label>

            </fieldset>
            
            <div class="bottom-right">
                <input class="btn" type="submit" name="createTransaction" value="Create">
            </div>
        </form>
    </div>
    
    <button id="show-display-num">Click me to show num</button>
    <button id="increase-num" onclick="">+1</button>
    <button id="decrease-num" onclick="">-1</button>

    <div id="display-num">1000002</div>

</section>
    
<?php include "../components/footer_server.php" ?>