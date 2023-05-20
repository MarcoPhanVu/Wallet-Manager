class Transaction {
    constructor(name, amount, category) {
        this.name = name;
        this.amount = amount;
        this.category = category;
    }

    _toString() {
        var str = "[" + this.category + "] " + this.name + " ";
        str += this.amount.toString();
        return str;
    }
}

export default Transaction;