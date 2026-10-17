<?php
/*
 * Name: Kekeli Yao Agblobi
 * Course: CS341 - Web Technologies
 * Lesson 13 Lab
 */

// ==========================================
// Step 1: Literals, variables and booleans
// ==========================================
$barName = "Kekeli's Chop Bar";
$jollofPrice = 35;
$soboloPrice = 10;
$isOpen = true;
$paymentMethod = "momo"; // Can be changed to "cash", "card", or other to test switch

// 2D Array: [name, price, qty]
$order = [
    ["Jollof Rice", $jollofPrice, 2],
    ["Sobolo", $soboloPrice, 3]
];

// Comment for Step 1:
// When echo true is executed, PHP coerces the boolean to string "1".
// When echo false is executed, PHP coerces it to an empty string "", rendering nothing on the screen.

// ==========================================
// Step 2: Operators
// ==========================================
// Customer adds one more Sobolo using ++
$order[1][2]++; // Qty increases from 3 to 4

// Calculate subtotal
$subtotal = ($order[0][1] * $order[0][2]) + ($order[1][1] * $order[1][2]); // (35 * 2) + (10 * 4) = 110

// Add GHS 5 service charge with +=
$subtotalWithFee = $subtotal;
$subtotalWithFee += 5; // 115

// Build receipt line with string concatenation (.)
$receiptLine = $order[0][0] . " (" . $order[0][2] . ") + " . $order[1][0] . " (" . $order[1][2] . ") = GHS " . $subtotalWithFee;

// Array union (+)
$menu = ["jollof" => 35, "waakye" => 30];
$specials = ["waakye" => 25, "kelewele" => 15];
$combined = $menu + $specials;

// Comment for Step 2:
// The array union operator (+) keeps elements from the left operand ($menu).
// Since the key "waakye" already exists in $menu with value 30, the matching key in $specials is ignored.

// Bitwise XOR: 12 ^ 9
// 12 is 1100 in binary, 9 is 1001. 1100 ^ 1001 = 0101 (5 in decimal).
$bitwiseResult = 12 ^ 9;

// ==========================================
// Step 3: Precedence and associativity
// ==========================================
$calc1 = 2 + 3 * 4;     // Multiplication has higher precedence than addition: 2 + 12 = 14
$calc2 = (2 + 3) * 4;   // Parentheses force addition first: 5 * 4 = 20
$calc3 = 20 - 5 - 3;    // Subtraction is left-associative: (20 - 5) - 3 = 15 - 3 = 12

// Comment for Step 3:
// In 2 + 3 * 4, * has higher precedence than +, so 3 * 4 executes first.
// In (2 + 3) * 4, grouping parentheses override default precedence, forcing 2 + 3 first.
// In 20 - 5 - 3, subtraction is left-associative, evaluating left-to-right: (20 - 5) then - 3.

// ==========================================
// Step 6 Setup: Add item with qty 0
// ==========================================
$order[] = ["Waakye", 30, 0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $barName; ?> - Order System</title>
</head>
<body>
  <h1><?php echo $barName; ?></h1>

  <section>
    <h2>Step 1: Booleans</h2>
    <p>Echo true: [<strong><?php echo true; ?></strong>]</p>
    <p>Echo false: [<strong><?php echo false; ?></strong>] (outputs empty string)</p>
  </section>

  <hr>

  <section>
    <h2>Step 2: Operators</h2>
    <p>Receipt line: <?php echo $receiptLine; ?></p>
    <p>Combined Menu (Array Union):</p>
    <ul>
      <?php foreach ($combined as $dish => $price): ?>
        <li><?php echo ucfirst($dish) . ": GHS " . $price; ?></li>
      <?php endforeach; ?>
    </ul>
    <p>Bitwise 12 ^ 9 = <strong><?php echo $bitwiseResult; ?></strong></p>
  </section>

  <hr>

  <section>
    <h2>Step 3: Precedence & Associativity</h2>
    <p>2 + 3 * 4 = <strong><?php echo $calc1; ?></strong></p>
    <p>(2 + 3) * 4 = <strong><?php echo $calc2; ?></strong></p>
    <p>20 - 5 - 3 = <strong><?php echo $calc3; ?></strong></p>
  </section>

  <hr>

  <section>
    <h2>Step 4: Relational Operators & Conditionals</h2>
    <p>"10" == 10: <strong><?php echo ("10" == 10) ? "Yes" : "No"; ?></strong></p>
    <p>"10" === 10: <strong><?php echo ("10" === 10) ? "Yes" : "No"; ?></strong></p>
    <p>$subtotal != 100: <strong><?php echo ($subtotal != 100) ? "Yes" : "No"; ?></strong></p>

    <p>Order Message: 
      <strong>
        <?php
        if ($subtotal >= 150) {
            echo "Big order! Free drink on us.";
        } elseif ($subtotal >= 50) {
            echo "Thanks for your order!";
        } else {
            echo "Small chop, still sweet!";
        }
        ?>
      </strong>
    </p>

    <p>Shop Status: <strong><?php echo $isOpen ? "Open" : "Closed"; ?></strong></p>
  </section>

  <hr>

  <section>
    <h2>Step 5: Switch Statement</h2>
    <p>Payment Method (<?php echo $paymentMethod; ?>): 
      <strong>
        <?php
        switch ($paymentMethod) {
            case "cash":
                echo "Please hand cash to the cashier at the counter.";
                break;
            case "momo":
                echo "Prompt sent to your phone. Approve the MoMo transaction.";
                break;
            case "card":
                echo "Please insert or tap your card on the POS terminal.";
                break;
            default:
                echo "Invalid payment method selected. Please choose cash, momo, or card.";
                break;
        }
        ?>
      </strong>
    </p>
  </section>

  <hr>

  <section>
    <h2>Step 6: Loops</h2>
    <p><strong>1. For loop with continue (skipping qty 0):</strong></p>
    <ul>
      <?php
      for ($i = 0; $i < count($order); $i++) {
          if ($order[$i][2] === 0) {
              continue;
          }
          $lineTotal = $order[$i][1] * $order[$i][2];
          echo "<li>{$order[$i][2]} x {$order[$i][0]} - GHS {$lineTotal}</li>";
      }
      ?>
    </ul>

    <p><strong>2. While loop countdown:</strong></p>
    <p>
      <?php
      $countdown = 3;
      while ($countdown >= 1) {
          echo $countdown . "... ";
          $countdown--;
      }
      echo "Order ready!";
      ?>
    </p>

    <p><strong>3. Do...While loop (starts at 5, condition &lt; 3):</strong></p>
    <p>
      <?php
      $num = 5;
      do {
          echo "Executed once with value: " . $num;
          $num++;
      } while ($num < 3);
      ?>
    </p>

    <p><strong>4. For loop with break on Sobolo:</strong></p>
    <ul>
      <?php
      for ($i = 0; $i < count($order); $i++) {
          if ($order[$i][0] === "Sobolo") {
              break;
          }
          echo "<li>" . $order[$i][0] . "</li>";
      }
      ?>
    </ul>
  </section>

  <hr>

  <section>
    <h2>Step 7: Implicit & Explicit Casting</h2>
    <!-- Comment for Step 7:
         Implicit casting (type coercion) occurs automatically when PHP converts data types during an operation (e.g. string "5" into an integer when adding).
         Explicit casting happens when the developer manually casts a variable type using syntax like (int), (float), or (bool).
    -->
    <p>Implicit Casting ("5" + 5): <strong><?php echo "5" + 5; ?></strong></p>
    <p>Explicit (int) "12 plates": <strong><?php echo (int) "12 plates"; ?></strong></p>
    <p>Explicit (float) "35.50": <strong><?php echo (float) "35.50"; ?></strong></p>
    <p>Explicit (string) 70 . " cedis": <strong><?php echo (string) 70 . " cedis"; ?></strong></p>
    <p>(bool) 0: <strong><?php echo ((bool) 0) ? "true" : "false"; ?></strong></p>
    <p>(bool) "Sobolo": <strong><?php echo ((bool) "Sobolo") ? "true" : "false"; ?></strong></p>
  </section>
</body>
</html>