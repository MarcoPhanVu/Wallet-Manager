import User from "./user.js";
import Wallet from "./wallet.js";
import Transaction from "./transaction.js";
import db from "../databases/db.json" assert {type: 'json'}

class Controller {
    constructor() {
        this.path = "db.json";
        this.users = [];
        this.current_user = -1;
        this.readData();
    }

    createTransaction(name, amount, category) {
        // only accept creating process if any user signs in
        if (this.current_user == -1) {
            return false;
        }
        // return status of creating new transaction
        return this.users[this.current_user].createTransaction(name, amount, category);
    }

    createWallet(name) {
        // only create wallet if any user signs in
        if (this.current_user == -1) {
            return false;
        }
        // return status of creating new wallet
        return this.users[this.current_user].createWallet(name);
    }

    signIn(name, pass) {
        // check password if exist user in database having the same name
        for (let i = 0; i < this.users.length; ++i) {
            if (this.users[i].name == name && this.users[i].login(pass)) {
                this.current_user = i;
                return true;
            }
        }
        // if user's name does not exist in db, sign in fail
        return false;
    }

    signUp(name, pass) {
        // sign up if no user with the same name in db
        for (let i = 0; i < this.users.length; ++i) {
            if (this.users[i].name == name) {
                return false;
            }
        }

        this.users.push(
            new User(this.users.length, name, pass)
        );
        return true;
    }

    // read data (users) in db
    readData() {
        console.log(db);
        console.log("Read successfully");
        for (let i = 0; i < db.length; ++i) {
            let user = new User(db[i].id, db[i].name, db[i].password);
            for (let j = 0; j < db[i].wallets.length; ++j) {
                let TXs = []
                for (let k = 0; k < db[i].wallets[j].transactions.length; ++k) {
                    TXs.push(
                        new Transaction(
                            db[i].wallets[j].transactions[k].name,
                            db[i].wallets[j].transactions[k].amount,
                            db[i].wallets[j].transactions[k].category)
                    )
                }
                user.wallets.push(
                    new Wallet(db[i].wallets[j].id, db[i].wallets[j].name, TXs)
                );
            }
            this.users.push(user);
        }
    }

    // write new data into db
    write_data() {
        console.log("call write_data()");
    }

    _show_user_info() {
        let str = "";
        str += "# " + this.users[this.current_user].name + "\n";
        for (let j = 0; j < this.users[this.current_user].wallets.length; ++j) {
            str += "\t+ " + this.users[this.current_user].wallets[j].name + "\n";
            for (let k = 0; k < this.users[this.current_user].wallets[j].transactions.length; ++k) {
                str += "\t  - [" +
                    this.users[this.current_user].wallets[j].transactions[k].category + "] " +
                    this.users[this.current_user].wallets[j].transactions[k].name + " - " +
                    this.users[this.current_user].wallets[j].transactions[k].amount + "\n";
            }
        }
        return str;
    }
}

export default Controller;