<?php
error_reporting(0);
session_start();
$sessid = session_id();
$dbh = new PDO("mysql:host=localhost;dbname=webd173", "root", "12345");
// $admin = 'mesa_admin';
$categories = 'dog_categories';
$products = 'dog_products';
$cartitems = 'dog_cartitems';

?>