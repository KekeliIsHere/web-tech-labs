<?php
/*
 * Name: Kekeli Yao Agblobi
 * Date: 16 October 2026
 * Course: CS341 - Web Technologies
 * Lesson 12 Lab
 */

// Step 1 Comment: The static HTML file sends fixed, pre-written text, whereas index.php is processed by the PHP engine on the server upon every request, generating dynamic output (like current server time) before streaming HTML to the client.


// Step 2: Variables and Constants

$barName = "Kekeli's Chop Bar";
$jollofPrice = 35;
$soboloPrice = 10;

$isMember = true;
$hasCoupon = false;
$isOpen = true;

// 2D Array: [name, price, qty]
// Starter info: 2 Jollof Rice and 3 Sobolo
$order = [
    ["Jollof Rice", $jollofPrice, 2],
    ["Sobolo", $soboloPrice, 3]
];

define("TAX_RATE", 0.15);

// Step 3: Operators
// Customer adds one more Sobolo using ++
$order[1][2]++; // Qty increases from 3 to 4

// Calculate subtotal
$subtotal = ($order[0][1] * $order[0][2]) + ($order[1][1] * $order[1][2]);

// Calculate total with += GHS 5 service charge and tax
$total = $subtotal;
$total += 5; // Service charge
$total += ($total * TAX_RATE); // Tax

// Build receipt string with .=
$receipt = "";
$receipt .= $order[0][0] . " x " . $order[0][2] . " = GHS " . ($order[0][1] * $order[0][2]) . "\n";
$receipt .= $order[1][0] . " x " . $order[1][2] . " = GHS " . ($order[1][1] * $order[1][2]) . "\n";

// Step 5: Functions and Scope
function lineCost($price, $qty) {
    return $price * $qty;
}

// Recalculate subtotal using lineCost()
$subtotalRecalc = lineCost($order[0][1], $order[0][2]) + lineCost($order[1][1], $order[1][2]);

// global keyword brings variables from global scope into function scope
function showName() {
    global $barName;
    echo $barName;
}

// static variables retain their values across multiple function calls
function countOrders() {
    static $count = 0;
    $count++;
    echo "Order count: " . $count . "<br>";
}

// Step 6 Helper function using $GLOBALS
function printBarNameGlobal() {
    echo $GLOBALS['barName'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chop Bar Menu - Dynamic</title>
</head>
<body>
  <h1>Chop Bar Menu</h1>
  <ul>
    <li>Jollof Rice - GHS 35</li>
    <li>Waakye - GHS 30</li>
    <li>Sobolo - GHS 10</li>
  </ul>

  <!-- Step 1: PHP Date and Time -->
  <p>Today's date: <?php echo date("l, d F Y") . " " . date("H:i:s"); ?></p>

  <hr>

  <!-- Step 2: Array access and type coercion -->
  <h3>Step 2: Variables & Coercion</h3>
  <p>Second dish in order: <strong><?php echo $order[1][0]; ?></strong></p>
  <p>PHP Type Coercion ("3" + 2): <strong><?php echo "3" + 2; ?></strong></p>

  <hr>

  <!-- Step 3: Comparisons & Ternary -->
  <h3>Step 3: Operators & Logic</h3>
  <p>Is subtotal > 100? <?php echo $subtotal > 100 ? "Yes" : "No"; ?></p>
  <p>isMember && hasCoupon: <?php echo ($isMember && $hasCoupon) ? "Yes" : "No"; ?></p>
  <p>isMember || hasCoupon: <?php echo ($isMember || $hasCoupon) ? "Yes" : "No"; ?></p>
  <p>!isMember: <?php echo (!$isMember) ? "Yes" : "No"; ?></p>
  <p>isMember xor hasCoupon: <?php echo ($isMember xor $hasCoupon) ? "Yes" : "No"; ?></p>

  <hr>

  <!-- Step 4: Strings, Escaping, and Heredoc -->
  <h3>Step 4: Strings</h3>
  <p>Single quotes: <?php echo '$barName'; ?></p>
  <p>Double quotes: <?php echo "$barName"; ?></p>
  <?php // Difference: Single quotes output literal text; double quotes evaluate/interpolate variables. ?>
  
  <p>Escaped string: <?php echo 'Kofi\'s Corner'; ?></p>

  <h4>Heredoc Receipt:</h4>
  <pre><?php
echo <<<_END
--- RECEIPT ---
$receipt
Subtotal: GHS $subtotal
Total (incl. GHS 5 fee + 15% tax): GHS $total
_END;
  ?></pre>

  <hr>

  <!-- Step 5: Functions & Scope -->
  <h3>Step 5: Functions & Scope</h3>
  <p>Subtotal recalculated with lineCost(): GHS <?php echo $subtotalRecalc; ?></p>
  <p>Bar name via showName() [global]: <?php showName(); ?></p>
  <p><?php countOrders(); countOrders(); countOrders(); ?></p>

  <hr>

  <!-- Step 6: Printing and Superglobals -->
  <h3>Step 6: Printing & Superglobals</h3>
  <p>Status: <?php $isOpen ? print "Open" : print "Closed"; ?></p>
  <?php
  // Print works in a ternary because it is an expression that returns 1. Echo is a language construct with no return value and causes a syntax error if evaluated inside expressions.
  // Superglobals must be sanitized because they consume untrusted external user input (headers, query params, form data), leaving apps vulnerable to XSS and injection attacks.
  ?>
  <p>Current Line: <?php echo __LINE__; ?></p>
  <p>Current File: <?php echo __FILE__; ?></p>
  <p>Server Name: <?php echo htmlspecialchars($_SERVER['SERVER_NAME'] ?? 'localhost'); ?></p>
  <p>Bar Name via $GLOBALS: <?php printBarNameGlobal(); ?></p>

</body>
</html>