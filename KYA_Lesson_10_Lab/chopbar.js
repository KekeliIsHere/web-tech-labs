const foods = ["Jollof Rice", "Waakye", "Kelewele"];
const drinks = ["Sobolo", "Asaana"];

foods.push("Red Red");
console.log("After push:", foods);
const removedFood = foods.pop();
console.log("Popped item:", removedFood);

const menu = foods.concat(drinks).sort().reverse();
console.log("Sorted & reversed menu:", menu);


const menuElement = document.getElementById("menu");
menuElement.textContent = `Menu: ${menu.join(", ")}`;

const soboloIndex = menu.indexOf("Sobolo");
console.log(`Index of 'Sobolo' in menu: ${soboloIndex}`);


console.log("All menu items:");
menu.forEach((item, index) => {
  console.log(`${index + 1}. ${item}`);
});

const stock = {};
stock["Jollof Rice"] = 15;
stock["Waakye"] = 8;
stock["Kelewele"] = 20;
stock["Sobolo"] = 30;
stock["Asaana"] = 12;

// Format and display stock in #stock
const stockStrings = Object.entries(stock).map(
  ([dish, plates]) => `${dish}: ${plates} plates`
);
const stockElement = document.getElementById("stock");
stockElement.textContent = `Stock: ${stockStrings.join(" | ")}`;

const order = [
  ["Jollof Rice", 35, 2],
  ["Sobolo", 10, 3]
];

console.log("Price of second line (Sobolo): GHS", order[1][1]);

// Check if any line has quantity > 2 using some()
const hasLargeQty = order.some((line) => line[2] > 2);
console.log("Any item quantity > 2?:", hasLargeQty);

function lineCost(price, qty) {
  return price * qty;
}

function orderLines(orderArray) {
  return orderArray.map((line) => {
    const [name, price, qty] = line;
    const cost = lineCost(price, qty);
    return `${qty} x ${name} - GHS ${cost}`;
  });
}

const lines = orderLines(order);
const orderListElement = document.getElementById("order");

lines.forEach((lineText) => {
  const li = document.createElement("li");
  li.textContent = lineText;
  orderListElement.appendChild(li);
});

function Dish(name, price) {
  this.name = name;
  this.price = price;
}


Dish.prototype.describe = function () {
  return `${this.name} - GHS ${this.price}`;
};

const jollof = new Dish("Jollof Rice", 35);
const sobolo = new Dish("Sobolo", 10);

console.log(jollof.describe());
console.log(sobolo.describe());


class Order {
  constructor() {
    this.lines = [];
  }

  add(dish, qty) {
    this.lines.push({ dish, qty });
    return this;
  }

  total() {
    return this.lines.reduce((sum, currentLine) => {
      return sum + lineCost(currentLine.dish.price, currentLine.qty);
    }, 0);
  }
}

// Method chaining in a single statement
const chainedOrder = new Order().add(jollof, 2).add(sobolo, 3);
const finalTotal = chainedOrder.total();

const totalElement = document.getElementById("total");
totalElement.textContent = `Total: GHS ${finalTotal.toFixed(2)}`;