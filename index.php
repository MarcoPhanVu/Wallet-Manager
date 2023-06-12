<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="#">
    <title>Document</title>
</head>
<body>
    <?php include "./servers/connection.php"?>
    <a href="./servers/display_all.php">To display</a>
    <h1>Welcome to HAM TRU AN</h1>
    <div style="width: 100vw;">
        <div style="width: 50%; float: left">
            <div>
                <h2>Sign up Area</h2>
                <label for="sign-up-name">name: </label>
                <input type="text" id="sign-up-name">
                <label for="sign-up-pass">pass: </label>
                <input type="text" id="sign-up-pass">
                <button id="sign-up-btn">Submit</button>
            </div>
            
            <div>
                <h2>Sign in Area</h2>
                <label for="sign-in-name">name: </label>
                <input type="text" id="sign-in-name">
                <label for="sign-in-pass">pass: </label>
                <input type="text" id="sign-in-pass">
                <button id="sign-in-btn">Submit</button>
            </div>

            <div>
                <h2>Create Wallet</h2>
                <div>
                    <label for="create-wallet-name"></label>
                    <input id="create-wallet-name" type="text">
                </div>
                <button id="create-wallet-btn">Create wallet</button>
            </div>
        
            <div>
                <h2>Create Tx</h2>
                <div style="width: 100%;">
                    <label for="create-tx-name">name:</label>
                    <input type="text" id ="create-tx-name">
                </div>
                <div style="width: 100%;">
                    <label for="create-tx-amount">amount:</label>
                    <input type="text" id="create-tx-amount">
                </div>
                <div style="width: 100%;">
                    <input id="cate-expense" type="radio" name="categories" value="Expense">
                    <label for="cate-expense">Expense</label>
                    <input id="cate-income" type="radio" name="categories" value="Income">
                    <label for="cate-income">Income</label>
                </div>
                <button id="create-tx-btn">Create Tx</button>
            </div>

            <div>
                <h2>Show</h2>
                <label for="show-all-in4"></label>
                <button id="show-all-in4">Show my information</button>
            </div>
        </div>
    
        <div style="width: 50%; float: right">
            <h2>Log</h2>
            <p id="err" style="color: red;"></p>
            <p id="res" style="color: green;"></p>
            <p id="log"></p>
        </div>
    </div>

    <script type="module" src="index.js"></script>
</body>
</html>