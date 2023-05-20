import Wallet from "./wallet.js";
import Transaction from "./transaction.js";

class User {
    constructor(id, name, password) {
        this.id = id;
        this.name = name;
        this.wallets = [];
        this.curr_wallet_idx = -1;
        this.password = password;
    }

    login(password) {
        return password === this.password;
    }

    createWallet(wallet_name, transactions = []) {
        // check if "new wallet"'s name is exists or not
        for (let i = 0; i < this.wallets.length; ++i) {
            if (this.wallets[i].name === wallet_name) {
                return false;
            }
        }
        // create new wallet
        let new_wallet = new Wallet(
            this.wallets.length,
            wallet_name,
            transactions);
        // store new wallet
        this.wallets.push(new_wallet);
        // switch to newest wallet (temporary)
        this.switchWallet(this.wallets.length - 1);
        return true;
    }

    // switch on-working wallet of user
    switchWallet(wallet_idx) {
        this.curr_wallet_idx = wallet_idx;
    }

    createTransaction(name, amount, category) {
        // only create new transaction if there is a wallet to store it
        if (this.curr_wallet_idx == -1) {
            return false;
        }
        // status == true: create successfully
        // else: some errors occur
        let status = this.wallets[this.curr_wallet_idx].addTransaction(
            new Transaction(name, amount, category)
        );
        return status;
    }

    _toString() {
        let str = "User '" + this.name + "'\n";
        for (let i = 0; i < this.wallets.transactions.length; ++i) {
            str += this.wallets[i]._toString() + "\n";
        }
        return str;
    }
}

export default User;