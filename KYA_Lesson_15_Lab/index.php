<!DOCTYPE html>
<html>
<head>
    <title>Lesson 15 Lab</title>
</head>
<body>

    <h1>Lesson 15 Lab - Chop Bar</h1>

    <!-- Step 1: Numerically indexed arrays -->
    <h2>Step 1</h2>
    <?php
    $dishes = array("Jollof Rice", "Waakye", "Kelewele");

    $drinks = [];
    $drinks[] = "Sobolo";
    $drinks[] = "Asaana";

    echo "<p>Second dish: " . $dishes[1] . "</p>";
    echo "<p>Dishes count: " . count($dishes) . "</p>";

    echo "<p>Is \$drinks an array? " . (is_array($drinks) ? "Yes" : "No") . "</p>";
    echo "<p>Is 'Chop Bar' an array? " . (is_array("Chop Bar") ? "Yes" : "No") . "</p>";
    ?>

    <!-- Step 2: Associative arrays -->
    <h2>Step 2</h2>
    <?php
    $prices = array(
        "Jollof Rice" => 35,
        "Waakye" => 30,
        "Sobolo" => 10,
        "Kelewele" => 25
    );

    echo "<p>Price of Waakye: " . $prices["Waakye"] . "</p>";
    ?>

    <!-- Step 3: The foreach...as loop -->
    <h2>Step 3</h2>
    <?php
    foreach ($dishes as $dish) {
        echo "<p>" . $dish . "</p>";
    }

    foreach ($prices as $dish => $price) {
        echo "<p>" . $dish . " - GHS " . $price . "</p>";
    }
    ?>

    <!-- Step 4: Multidimensional arrays -->
    <h2>Step 4</h2>
    <?php
    $order = [
        ["Jollof Rice", 35, 2],
        ["Sobolo", 10, 3]
    ];

    $subtotal = 0;

    foreach ($order as $item) {
        $name = $item[0];
        $price = $item[1];
        $qty = $item[2];
        $lineTotal = $price * $qty;
        $subtotal += $lineTotal;

        echo "<p>" . $qty . " x " . $name . " - GHS " . $lineTotal . "</p>";
    }

    echo "<p>Subtotal: GHS " . $subtotal . "</p>";
    ?>

    <!-- Step 5: Sorting and position -->
    <h2>Step 5</h2>
    <?php
    sort($dishes);
    foreach ($dishes as $dish) {
        echo "<p>" . $dish . "</p>";
    }

    shuffle($dishes);
    echo "<p>Today's first dish: " . reset($dishes) . "</p>";
    echo "<p>Todays last dish: " . end($dishes) . "</p>";
    ?>

    <!-- Step 6: Converting arrays -->
    <h2>Step 6</h2>
    <?php
    $dishArray = explode(",", "Jollof Rice,Waakye,Kelewele");
    echo "<p>Item count: " . count($dishArray) . "</p>";
    echo "<p>Last item: " . end($dishArray) . "</p>";

    $customer = "Ama";
    $table = 4;
    $info = compact("customer", "table");
    echo "<p>Customer: " . $info["customer"] . "</p>";

    extract(array("waiter" => "Kojo", "tip" => 5));
    echo "<p>Waiter: " . $waiter . "</p>";
    echo "<p>Tip: " . $tip . "</p>";

    /*
     * compact() takes existing standalone variable names as string arguments
     * and bundles them into an associative array (variable name becomes the key).
     *
     * extract() does the direct opposite: it takes an associative array and imports
     * its keys directly as variable names into the current symbol table.
     */
    ?>

</body>
</html>