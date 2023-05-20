import Controller from "./scripts/controller.js"
// import CryptoJS from "./node_modules/crypto-js/crypto-js.js";

let controller = new Controller();
console.log(controller);
let sign_in = false;

const sign_in_btn = document.getElementById('sign-in-btn');
const sign_up_btn = document.getElementById('sign-up-btn');
const create_tx_btn = document.getElementById('create-tx-btn');
const create_wallet_btn = document.getElementById('create-wallet-btn');
const show_my_information = document.getElementById('show-all-in4');
const sign_in_name = document.getElementById('sign-in-name');
const sign_up_name = document.getElementById('sign-up-name');
const create_tx_name = document.getElementById('create-tx-name');
const create_wallet_name = document.getElementById('create-wallet-name');
const sign_in_pass = document.getElementById('sign-in-pass');
const sign_up_pass = document.getElementById('sign-up-pass');
const create_tx_amount = document.getElementById('create-tx-amount');
const categories_radio = document.getElementsByName('categories')
const err = document.getElementById('err');
const res = document.getElementById('res');
const log = document.getElementById('log');

sign_in_btn.addEventListener("click", () => {

    // console.log("SIGN-IN-CLICK");
    err.innerText = "";
    res.innerText = "";
    log.innerText = "";

    let name = sign_in_name.value;
    let pass = sign_in_pass.value;
    // console.log('name: ' + name);
    // console.log('pass: ' + pass);

    if (name == "" || pass == "") {
        sign_in = false;
        err.innerText = "incorrect input\n";
    }
    else {
        let status = controller.signIn(name, pass);//CryptoJS.SHA256(pass));
        if (status == false) {
            sign_in = false;
            err.innerText = "name or pass incorrect\n";
        }
        else {
            sign_in = true;
            res.innerText = "sign in successfully\n";
            // console.log('');
            controller._show_user_info();
        }
    }
})

sign_up_btn.addEventListener("click", () => {

    // console.log("SIGN-UP-CLICK");
    err.innerText = "";
    res.innerText = "";
    log.innerText = "";


    let name = sign_up_name.value;
    let pass = sign_up_pass.value;
    // console.log('name: ' + name);
    // console.log('pass: ' + pass);

    if (name == "" || pass == "") {
        err.innerText = "incorrect input\n";
    }
    else {
        let status = controller.signUp(name, pass);//, CryptoJS.SHA256(pass));
        if (status == false) {
            err.innerText = "user is existed\n";
        }
        else {
            res.innerText = "sign up successfully\n";
        }
    }
})

create_tx_btn.addEventListener("click", () => {
    console.log("CREATE-TX-CLICK");
    err.innerText = "";
    res.innerText = "";
    log.innerText = "";


    if (sign_in == false) {
        err.innerText = "sign in to create tx";
        return;
    }


    let name = create_tx_name.value;
    let amount = create_tx_amount.value;
    let category;
    if (categories_radio[0].checked == true) {
        category = "Expense";
    }
    else {
        category = "Income";
    }
    console.log("name: " + name);
    console.log("amount: " + amount);
    console.log("category: " + category);
    if (name == "") {
        err.innerText = "incorrect input\n";
    }
    else {
        let status = controller.createTransaction(name, amount, category);
        if (status == false) {
            err.innerText = "can not create tx\n";
        }
        else {
            res.innerText = "create tx successfully\n";
            log.innerText = controller._show_user_info();
        }
    }
})

create_wallet_btn.addEventListener("click", () => {
    console.log("CREATE-WALLET-CLICK");
    err.innerText = "";
    res.innerText = "";
    log.innerText = "";
    let name = create_wallet_name.value;
    if (name == "") {
        err.value = "incorrect input\n";
    }
    else {
        let status = controller.createWallet(name)
        if (status == false) {
            err.innerText = "can not create wallet\n";
        }
        else {
            res.innerText = "create wallet successfully\n";
            log.innerText = controller._show_user_info();
        }
    }
})

show_my_information.addEventListener("click", () => {
    console.log("SHOW-MY-INFORMATION");

    err.innerText = "";
    res.innerText = "";
    log.innerText = "";
    
    if (sign_in == false) {
        err.innerText = "anonymous user";
    }
    else {
        log.innerText = controller._show_user_info();
    }
})