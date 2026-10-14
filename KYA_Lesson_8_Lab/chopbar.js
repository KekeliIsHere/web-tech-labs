/*
 * Name: Kekeli Yao Agblobi
 * Date: October 4, 2026
 * Description: Lesson 8 Lab - Chop Bar Bill Calculator
 */


console.log("Page Loading...");


const BAR_NAME = "Kekeli's Chop Bar";
const TAX_RATE = 0.15;
let isMember = true;


console.log("Type of BAR_NAME:", typeof BAR_NAME);
console.log("Type of TAX_RATE:", typeof TAX_RATE);
console.log("Type of isMember:", typeof isMember);


function lineCost(price, qty) {
  return price * qty;
}

function calculateTotal(subtotal) {
  let tax = subtotal * TAX_RATE;
  return subtotal + tax;
}


const items = ["Jollof Rice", "Sobolo"];
const prices = [35, 10];
const quantities = [2, 3];

const jollofCost = lineCost(prices[0], quantities[0]); 
const soboloCost = lineCost(prices[1], quantities[1]); 
const subtotal = jollofCost + soboloCost;           


const hasDiscount = isMember && (subtotal >= 100);
console.log("Eligible for discount:", hasDiscount);

const barNameHeading = document.getElementById("bar-name");
barNameHeading.textContent = BAR_NAME;

const totalCost = calculateTotal(subtotal);
const billParagraph = document.getElementById("bill");
billParagraph.textContent = `Total: GHS ${totalCost.toFixed(2)}`;


const receiptDiv = document.getElementById("receipt");
receiptDiv.textContent = 
  `${items[0]} (x${quantities[0]}): GHS ${jollofCost.toFixed(2)} | ` +
  `${items[1]} (x${quantities[1]}): GHS ${soboloCost.toFixed(2)} | ` +
  `Subtotal: GHS ${subtotal.toFixed(2)}`;