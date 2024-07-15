<?php

require_once "Product.php";
require_once "Cart.php";
require_once "CartItem.php";
// todo add new product 
$product1 = new Product(1, "snake plant", 2500, 100);
$product2 = new Product(2, "marry gold", 400, 90);
$product3 = new Product(3, "alovela", 300, 70);
//todo your cart
$cart = new Cart();
$cartItem1 = $cart->addProduct($product1, 1);
$cartItem2 = $product2->addToCart($cart, 1);

echo "Number of items in cart: ".PHP_EOL ;
echo $cart->getTotalQuantity().PHP_EOL; echo"<br>";

echo "Total price of items in cart: ".PHP_EOL;
echo $cart->getTotalSum().PHP_EOL; echo"<br>";

// echo"<pre>";
// var_dump($cart->getItems());
// echo"</pre>";

$cartItem2->increaseQuantity();
$cartItem2->decreaseQuantity();

echo "Number of items in cart: ".PHP_EOL;
echo $cart->getTotalQuantity().PHP_EOL; 

echo "Total price of items in cart: ".PHP_EOL;
echo $cart->getTotalSum().PHP_EOL; 

$cart->removeProduct($product1);

echo "Number of items in cart: ".PHP_EOL;
echo $cart->getTotalQuantity().PHP_EOL; 

