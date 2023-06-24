<?php
    $transWallet_Data = $transCategory_Data = $transAmount_Data = $transDetails_Data = $transDate_Data = "";
    $transWallet_ErrMsg = $transCategory_ErrMsg = $transAmount_ErrMsg = $transDetails_ErrMsg = $transDate_ErrMsg = "";


    if (isset($_POST["transactionCreated"])) {
        echo "Transaction created heheheeh"; 

        if (empty($_POST["transWallet"])) {
            $transWallet_ErrMsg = "<p class='warning'>Please choose a wallet.</p>";
        } else {
            $transWallet_Data = $_POST["transWallet"];
        }

        if (empty($_POST["transCategory"])) {
            $transCategory_ErrMsg = "<p class='warning'>Please choose a category.</p>";
        } else {
            $transCategory_Data = $_POST["transCategory"];
        }

        if (empty($_POST["transAmount"])) {
            $transAmount_ErrMsg = "<p class='warning'>Please fill in transaction amount.</p>";
        } else {
            // $transAmount_Data = $_POST["transAmount"];
            $transAmount_Data = filter_input(INPUT_POST, "transAmount", FILTER_SANITIZE_NUMBER_FLOAT);
        }

        if (empty($_POST["transDetails"])) {
            $transDetails_ErrMsg = "<p class='warning'>Please fill in transaction description.</p>";
        } else {
            // $transDetails_Data = $_POST["transDetails"];
            $transDetails_Data = filter_input(INPUT_POST, "transDetails", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        if (empty($_POST["transDate"])) {
            $transDate_ErrMsg = "<p class='warning'>Please choose a date.</p>";
        } else {
            // $transeDate_Data = $_POST["transDate"];
            $transDate_Data = filter_input(INPUT_POST, "transDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }


        // Submit data
        if (empty($transWallet_ErrMsg) && empty($transCategory_ErrMsg) && empty($transAmount_ErrMsg) && empty($transDetails_ErrMsg) && empty($transDate_ErrMsg)) { // Submitted + No Error Message => proceed
            
            // CHECKING IF traqnsactionID exists
                $IDCount = 0; // Will be incremented if a transactionID existed

                $getCurrentUser = mysqli_query($connection, 
                "SELECT w.userID FROM wallet_category AS wc 
                INNER JOIN wallets AS w 
                ON w.walletID = wc.walletID 
                WHERE w.walletID = '$transWallet_Data';");

                $currentUser = mysqli_fetch_array($getCurrentUser); //
                $processedDate = implode(explode("-", $transDate_Data)); // convert date from yyyy-mm-dd to yyyymmdd
                $transactionID = $currentUser['userID'] . $processedDate . $IDCount; // Generating unique transactionID

                $checkTransactionIDExisted = mysqli_query($connection, "SELECT transactionID FROM transactions WHERE transactionID = '$transactionID'");

                while (mysqli_num_rows($checkTransactionIDExisted)) { // not 0 = true
                    $IDCount += 1;
                    $transactionID = $currentUser['userID'] . $processedDate . $IDCount;
                    $checkTransactionIDExisted = mysqli_query($connection, "SELECT transactionID FROM transactions WHERE transactionID = '$transactionID'");
                    echo "Incrementing transID to " . $IDCount . "<br>";
                }

            // Continue inserting
            $sql_statement = "INSERT INTO transactions (transactionID, walletID, categoryID, amount, description, date) VALUES ('$transactionID', '$transWallet_Data', '$transCategory_Data', '$transAmount_Data', '$transDetails_Data', '$transDate_Data')";
            echo "transSQLInsert here: " . $sql_statement . "<br>";

            if (mysqli_query($connection, $sql_statement)) {
                header($_SERVER["PHP_SELF"]);
            } else {
                echo $transWallet_Data . "<br>";
                echo "Error: " . mysqli_error($connection);
            }
        }
    } // Không báo gì cả vì form chưa được submit
?>

<section class="alter_info half-pane" id="info_wallet">
	<!-- Let's just do it in the normal way -->    
	<div class="form-container">
		<div class="title">Creating Wallets</div>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="createTransactionForm">
			<!-- Select tag will be use later, now we use Radio for fast interaction  -->
			<fieldset>
				<legend>Choose your Wallets</legend>
				<?php echo $transWallet_ErrMsg; ?>
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
									<input type='radio' name='transWallet' value='$walletID'>
								$walletID</label>" . "";
					}
				?>
			</fieldset>

			<fieldset>
				<legend>Choose your Category</legend>
				<!-- GET CATEGORIES FROM USER + WALLET -->
				<?php echo $transCategory_ErrMsg; ?>

				<?php 
					$category_query = "SELECT * FROM categories";
					$category_query_result = mysqli_query($connection, $category_query);
					$category_data_all = mysqli_fetch_all($category_query_result, MYSQLI_ASSOC);
					
					foreach (array_values($category_data_all) as $category_data) {
						$categoryID = $category_data["categoryID"];
						echo    "<label for='$categoryID'>
									<input type='radio' name='transCategory' value='$categoryID'>
								$categoryID</label>" . "";
					}
				?>
			</fieldset>

			<fieldset class="ext-info">
				<legend>Additional Information</legend>

				<?php echo $transAmount_ErrMsg; ?>
				<label>
					Amount:
					<input type="number" name="transAmount" step="0.01" placeholder="160.00">
				</label>

				<?php echo $transDetails_ErrMsg; ?>
				<label>
					Details: 
					<textarea name="transDetails" placeholder="Describe transaction here..."></textarea>
				</label>

				<?php echo $transDate_ErrMsg; ?>
				<label>
					Occured on:
					<input type="date" name="transDate" id="transaction-date">
				</label>

			</fieldset>
			
			<!-- <p id="test-ele">Test value</p> -->

			<div class="bottom-right">
				<input class="btn" type="submit" name="transactionCreated" value="Create">
			</div>
		</form>
	</div>

	<?php
		echo '<div class="">';
		$target_table = "wallets";
		include "./display/display-data.php";
		echo '</div>';
	?>

</section>

<section class="alter_info half-pane" id="info_category">
	<!-- Let's just do it in the normal way -->    
	<div class="form-container">
		<div class="title">Creating Category</div>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="createTransactionForm">
			<!-- Select tag will be use later, now we use Radio for fast interaction  -->
			<fieldset>
				<legend>Choose your Wallets</legend>
				<?php echo $transWallet_ErrMsg; ?>
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
									<input type='radio' name='transWallet' value='$walletID'>
								$walletID</label>" . "";
					}
				?>
			</fieldset>

			<fieldset>
				<legend>Choose your Category</legend>
				<!-- GET CATEGORIES FROM USER + WALLET -->
				<?php echo $transCategory_ErrMsg; ?>

				<?php 
					$category_query = "SELECT * FROM categories";
					$category_query_result = mysqli_query($connection, $category_query);
					$category_data_all = mysqli_fetch_all($category_query_result, MYSQLI_ASSOC);
					
					foreach (array_values($category_data_all) as $category_data) {
						$categoryID = $category_data["categoryID"];
						echo    "<label for='$categoryID'>
									<input type='radio' name='transCategory' value='$categoryID'>
								$categoryID</label>" . "";
					}
				?>
			</fieldset>
			<fieldset class="ext-info">
				<legend>Additional Information</legend>

				<?php echo $transAmount_ErrMsg; ?>
				<label>
					Amount:
					<input type="number" name="transAmount" step="0.01" placeholder="160.00">
				</label>

				<?php echo $transDetails_ErrMsg; ?>
				<label>
					Details: 
					<textarea name="transDetails" placeholder="Describe transaction here..."></textarea>
				</label>

				<?php echo $transDate_ErrMsg; ?>
				<label>
					Occured on:
					<input type="date" name="transDate" id="transaction-date">
				</label>

			</fieldset>
			
			<!-- <p id="test-ele">Test value</p> -->

			<div class="bottom-right">
				<input class="btn" type="submit" name="transactionCreated" value="Create">
			</div>
		</form>
	</div>

	<?php
		echo '<div class="">';
		$target_table = "categories";
		include "./display/display-data.php";
		echo '</div>';
	?>

</section>