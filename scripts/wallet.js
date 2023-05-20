
class Wallet {
    constructor(id, name, transactions = []) {
        this.id = id;
        this.name = name;
        this.amount = 0;
        this.transactions = transactions
    }

    addTransaction(transaction) {
        for (let i = 0; i < this.transactions.length; ++i) {
            if (this.transactions[i].name == transaction.name) {
                return false;
            }
        }
        this.transactions.push(transaction);
        return true;
    }

    _toString() {
        var str = "wallet " + this.id.toString() + "\n";
        for (let i = 0; i < this.transactions.length; ++i) {
            str += "\t" + this.transactions[i]._toString() + "\n";
        }
        return str;
    }
}

export default Wallet;