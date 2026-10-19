<?php
/*
 * Lesson 14 Lab - Classes
 * Name: Kekeli Yao Agblobi
 */

// Step 3, 5, 6: Dish Class
class Dish {
    // Step 3: Constant
    const CURRENCY = "GHS";

    // Step 3: Properties
    public $name;
    protected $price;

    // Step 6: Static property tracking instances
    public static $count = 0;

    // Step 3 & 6: Constructor
    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
        self::$count++;
    }

    // Step 3: describe method
    public function describe() {
        return "{$this->name} - " . self::CURRENCY . " {$this->price}";
    }

    // Step 5: Getter method for protected $price
    public function getPrice() {
        return $this->price;
    }

    // Step 6: Static method
    public static function getCount() {
        return self::$count;
    }

    // Step 3: Destructor
    public function __destruct() {
        echo "<p><em>Removing {$this->name}</em></p>";
    }
}

// Step 7: Inheritance - Drink class extending Dish
class Drink extends Dish {
    public $size;

    public function __construct($name, $price, $size) {
        parent::__construct($name, $price);
        $this->size = $size;
    }

    // Overriding describe() to include size
    public function describe() {
        return parent::describe() . " ({$this->size})";
    }
}