<?php
/*
 * Lesson 14 Lab - Main Page
 * Name: Kekeli Yao Agblobi
 */

/*
 * Step 2 Comment - File Inclusion Differences:
 * - include vs require: If an included file is missing, include produces an E_WARNING and execution continues. If a required file is missing, require throws a fatal E_COMPILE_ERROR and halts execution immediately.
 * - Why _once is useful: include_once and require_once prevent re-declaring functions, classes, or constants if the same file is loaded multiple times, which would otherwise throw a fatal redeclaration error.
 *
 * Step 5 Comment - Visibility / Scope Differences:
 * - public: Properties/methods can be accessed from anywhere (inside or outside the class).
 * - protected: Properties/methods can only be accessed within the class itself and its child classes (inheritance).
 * - private: Properties/methods can only be accessed strictly within the class that declared them.
 */

// Step 2: Global variables
$barName = "Kekeli's Chop Bar";
$order = [
    ["Jollof Rice", 35, 2],
    ["Sobolo", 10, 3]
];

// Step 2: Inclusion using include_once and require_once
include_once "functions.php";
require_once "dish.php";

// Calculate initial subtotal
$subtotal = 0;
foreach ($order as $item) {
    $subtotal += lineCost($item[1], $item[2]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php showBarName(); ?> - Lesson 14</title>
</head>
<body>
  <h1><?php showBarName(); ?></h1>

  <section>
    <h2>Step 1 & 2: Order Summary & Pass-by-Reference</h2>
    <ul>
      <?php
      $lines = orderLines($order);
      foreach ($lines as $line) {
          echo "<li>{$line}</li>";
      }
      ?>
    </ul>
    <p>Subtotal before service charge: GHS <?php echo $subtotal; ?></p>
    <?php
    addServiceCharge($subtotal);
    ?>
    <p>Subtotal after service charge (+ GHS 5): GHS <?php echo $subtotal; ?></p>
  </section>

  <hr>

  <section>
    <h2>Step 4 & 5: Objects, Cloning & Visibility</h2>
    <?php
    // Step 4: Create objects
    $jollof = new Dish("Jollof Rice", 35);
    $sobolo = new Dish("Sobolo", 10);

    echo "<p>" . $jollof->describe() . "</p>";
    echo "<p>" . $sobolo->describe() . "</p>";

    // Access public property
    echo "<p>Public property access: {$jollof->name}</p>";

    // Step 4: Attempting to access protected property directly:
    // echo $jollof->price; // Fatal Error: Cannot access protected property Dish::$price

    // Step 5: Access protected property via getter
    echo "<p>Protected property access via getPrice(): GHS {$jollof->getPrice()}</p>";

    // Step 4: Cloning
    $jollofLarge = clone $jollof;
    $jollofLarge->name = "Jollof Rice (Large)";

    echo "<p>Original dish name: {$jollof->name}</p>";
    echo "<p>Cloned dish name: {$jollofLarge->name}</p>";
    ?>
  </section>

  <hr>

  <section>
    <h2>Step 6 & 7: Static Members & Inheritance</h2>
    <?php
    echo "<p>Total Dish count after 2 dishes created: " . Dish::getCount() . "</p>";

    // Step 7: Create Drink object
    $soboloSpecial = new Drink("Sobolo", 10, "500ml");
    echo "<p>Drink describe(): " . $soboloSpecial->describe() . "</p>";

    echo "<p>Total Dish count after Drink created: " . Dish::getCount() . "</p>";
    ?>
  </section>

  <hr>
  <h2>Destructor Clean-up Output:</h2>
</body>
</html>