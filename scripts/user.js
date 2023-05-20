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
        for (let i = 0; i < this.wallets.length; ++i) {
            if (this.wallets[i].name === wallet_name) {
                return false;
            }
        }
        let new_wallet = new Wallet(
            this.wallets.length,
            wallet_name,
            transactions);
        this.wallets.push(new_wallet);
        this.switchWallet(0);
        return true;
    }

    switchWallet(wallet_idx) {
        this.curr_wallet_idx = wallet_idx;
    }

    createTransaction(name, amount, category) {
        if (this.curr_wallet_idx == -1) {
            return false;
        }
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