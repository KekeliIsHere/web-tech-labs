<?php
/*
 * Lesson 14 Lab - Functions
 * Name: Kekeli Yao Agblobi
 */

/*
 * Step 1 Comment - Scope differences:
 * - Local variables: Declared inside a function, accessible only within that function, and destroyed once execution completes.
 * - Global variables: Declared outside functions, accessible across the global script or inside functions using the 'global' keyword or $GLOBALS array.
 * - Static variables: Declared locally inside a function using 'static', accessible only within that function, but retain their values across multiple function calls.
 */

// Step 1: lineCost
function lineCost($price, $qty) {
    return $price * $qty;
}

// Step 1: orderLines
function orderLines($order) {
    $lines = [];
    foreach ($order as $item) {
        $name = $item[0];
        $price = $item[1];
        $qty = $item[2];
        $cost = lineCost($price, $qty);
        $lines[] = "{$qty} x {$name} - GHS {$cost}";
    }
    return $lines;
}

// Step 1: addServiceCharge
function addServiceCharge(&$subtotal) {
    $subtotal += 5;
}

// Step 1: showBarName using global keyword
function showBarName() {
    global $barName;
    echo $barName;
}