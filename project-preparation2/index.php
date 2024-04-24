<?php
error_reporting(E_ALL);
//Setting session start
session_start();
//var_dump($_SESSION);
$total=0;

//Database connection, replace with your connection string.. Used PDO
$dbh = new PDO("mysql:host=localhost;dbname=webd173", "root", "12345");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//get action string
$action = isset($_GET['action'])?$_GET['action']:"";

//Add to cart
if($action=='addcart' && $_SERVER['REQUEST_METHOD']=='POST') {
	
	//Finding the product by code
	$query = "SELECT * FROM products WHERE sku=:sku";
	$stmt = $dbh->prepare($query);
	$stmt->bindParam('sku', $_POST['sku']);
	$stmt->execute();
	$product = $stmt->fetch();
	
	$currentQty = $_SESSION['products'][$_POST['sku']]['qty']+1; //Incrementing the product qty in cart
	$_SESSION['products'][$_POST['sku']] =array('qty'=>$currentQty,'name'=>$product['name'],'image'=>$product['image'],'price'=>$product['price']);
	$product='';
	header("Location:index.php");
}

//Empty All
if($action=='emptyall') {
	$_SESSION['products'] =array();
	header("Location:index.php");	
}

//Empty one by one
if($action=='empty') {
	$sku = $_GET['sku'];
	$products = $_SESSION['products'];
	unset($products[$sku]);
	$_SESSION['products']= $products;
	header("Location:index.php");	
}


 
 
 //Get all Products
$query = "SELECT * FROM dog_products";
$stmt = $dbh->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>LOVE DOG</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://kit.fontawesome.com/81e38cdf17.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- <header>
        <p>FREE SHIPPING AN ORDER OF $75 OR MORE 📦&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <button class="help">HELP</button>
    </header>

    <div class="search-section">
        <img class="logo" src="img/logo.png" alt="dog love company logo">
        <form action="#" method="get">
            <input class="search" type="search" name="search" placeholder="search">
            <button class="search-btn"><i class="fa-solid fa-magnifying-glass" style="font-size:15px;"></i></button>
        </form>
        <div class="icons">
            <a href="#" class="user"><i class="fa-solid fa-user user"></i></a>
            <a href="#" class="like"><i class="fa-solid fa-heart like"></i></a>
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="paypal">
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="display" value="1">
                <input type="hidden" name="business" value="sb-n7m3x29560936@business.example.com">
                <input class="cart" type="image" name="submit" src="img/cart.png">
            </form>
        </div>
    </div> -->

    <?php include 'includes/header.php'; ?>


    <!-- <div class="nav-wrap">
        <div class="nav">
            <a class="nav-main" href="#">Dog Size</a>
            <ul class="nav-detail">
                <li><a href="#" class="drop-menu-link">Small</a></li>
                <li><a href="#" class="drop-menu-link">Medium</a></li>
                <li><a href="#" class="drop-menu-link">Large</a></li>
            </ul>
        </div>

        <div class="nav">
            <a class="nav-main" href="#">Food Type</a>
            <ul class="nav-detail">
                <li><a href="#" class="drop-menu-link">Wet food</a></li>
                <li><a href="#" class="drop-menu-link">Dry food</a></li>
                <li><a href="#" class="drop-menu-link">Wet & Dry</a></li>
            </ul>

        </div>

        <div class="nav">
            <a class="nav-main" href="#">Snacks</a>
            <ul class="nav-detail">
                <li><a href="#" class="drop-menu-link">Bone</a></li>
                <li><a href="#" class="drop-menu-link">Cookie</a></li>
                <li><a href="#" class="drop-menu-link">Additive-free</a></li>
            </ul>

        </div>

        <div class="nav">
            <a class="nav-main" href="#">Special</a>
            <ul class="nav-detail">
                <li><a href="#" class="drop-menu-link">Cake</a></li>
                <li><a href="#" class="drop-menu-link">Ice cream</a></li>
                <li><a href="#" class="drop-menu-link">Custom item</a></li>
            </ul>
        </div>
    </div> -->

    <div class="main-logo">
        <img class="main-pic" src="img/main.jpg" alt="company value">
    </div>

    <div class="popular-section">
        <p class="section-title">Popular Products</p>

        <div class="product">

            <div class="genius">
                <img class="products-pics" src="img/dryfood.png" alt="">
                <p class="product-title">Genius Chicken $25</p>
                <div class="btn">
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="paypal">
                        <input type="hidden" name="add" value="1">
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="item_name" value="Genius Chicken">
                        <input type="hidden" name="amount" value="25">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="business" value="sb-n7m3x29560936@business.example.com">
                        <input type="hidden" name="no_shipping" value="2">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="bn" value="PP-ShopCartBF" />
                        <input class="add-cart" type="image" name="submit" src="img/add.png">
                    </form>
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="paypal">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="item_name" value="Genius Chicken">
                        <input type="hidden" name="amount" value="25">
                        <input type="hidden" name="quantity_1" value="1">
                        <input type="hidden" name="business" value="sb-n7m3x29560936@business.example.com">
                        <input type="hidden" name="no_shipping" value="2">
                        <input type="hidden" name="currency_code" value="USD">
                        <input class="buy-now" type="image" name="submit" src="img/buy.png">
                    </form>
                </div>
            </div>

            <div class="steak">
                <img class="products-pics" src="img/dryandwet.png" alt="">
                <p class="product-title">Steak Lover $30</p>
                <div class="btn">
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="paypal">
                        <input type="hidden" name="add" value="1">
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="item_name" value="Steak Lover">
                        <input type="hidden" name="amount" value="30">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="business" value="sb-n7m3x29560936@business.example.com">
                        <input type="hidden" name="no_shipping" value="2">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="bn" value="PP-ShopCartBF" />
                        <input class="add-cart" type="image" name="submit" src="img/add.png">
                    </form>
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="paypal">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="item_name" value="Steak Lover">
                        <input type="hidden" name="amount" value="30">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="business" value="sb-n7m3x29560936@business.example.com">
                        <input type="hidden" name="no_shipping" value="2">
                        <input type="hidden" name="currency_code" value="USD">
                        <input class="buy-now" type="image" name="submit" src="img/buy.png">
                    </form>
                </div>
            </div>
        </div>

        <div class="product">
            <div class="nature">
                <img class="products-pics" src="img/wet.png" alt="">
                <p class="product-title">Nature World $45</p>
                <div class="btn">
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="paypal">
                        <input type="hidden" name="add" value="1">
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="item_name" value="Nature World">
                        <input type="hidden" name="amount" value="45">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="business" value="sb-n7m3x29560936@business.example.com">
                        <input type="hidden" name="no_shipping" value="2">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="bn" value="PP-ShopCartBF" />
                        <input class="add-cart" type="image" name="submit" src="img/add.png">
                    </form>
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="paypal">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="item_name" value="Nature World">
                        <input type="hidden" name="amount" value="45">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="business" value="sb-n7m3x29560936@business.example.com">
                        <input type="hidden" name="no_shipping" value="2">
                        <input type="hidden" name="currency_code" value="USD">
                        <input class="buy-now" type="image" name="submit" src="img/buy.png">
                    </form>
                </div>
            </div>

            <div class="sweetie">
                <img class="products-pics" src="img/cake.png" alt="">
                <p class="product-title">Dear My Sweetie $35</p>
                <div class="btn">
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="paypal">
                        <input type="hidden" name="add" value="1">
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="item_name" value="Dear My Sweetie">
                        <input type="hidden" name="amount" value="35">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="business" value="sb-n7m3x29560936@business.example.com">
                        <input type="hidden" name="no_shipping" value="2">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="bn" value="PP-ShopCartBF" />
                        <input class="add-cart" type="image" name="submit" src="img/add.png">
                    </form>
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="paypal">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="item_name" value="Dear My Sweetie">
                        <input type="hidden" name="amount" value="35">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="business" value="sb-n7m3x29560936@business.example.com">
                        <input type="hidden" name="no_shipping" value="2">
                        <input type="hidden" name="currency_code" value="USD">
                        <input class="buy-now" type="image" name="submit" src="img/buy.png">
                    </form>
                </div>
            </div>
        </div>

        <hr>

        <div class="review-section">
            <p class="section-title">Reviews From Customers</p>

            <div class="review">
                <p class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </p>
                <p class="review-detail">I have a corgi and bought a cake for her birthday. She loves it and ate so
                    fast! Because they use
                    natural ingredients, I
                    decided to buy here. If you give your dog special time, I recommend it.</p>
                <p class="name">~Luna Evergreen from CA</p>
            </div>

            <div class="review">
                <p class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </p>
                <p class="review-detail">Impressed with LOVE DOG food! My dog's health and energy levels have soared
                    since the switch. Quality
                    ingredients, no
                    fillers. Highly recommended for happy, healthy pups!</p>
                <p class="name">~Max Sterling from TX</p>
            </div>

            <div class="review">
                <p class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </p>
                <p class="review-detail">Switched to dog food recently and couldn't be happier. My dog loves it, and
                    I've noticed improvements
                    in his health and
                    energy. The quality ingredients and absence of fillers make it a top choice.</p>
                <p class="name">~Jasmine Rivers from NY</p>
            </div>
        </div>

        <!-- <footer>
            <div class="footer-top">
                <p class="footer-follow">FOLLOW US ON</p>
                <div class="sns-icons">
                    <a href="#"><img class="facebook" src="img/Facebook_Logo_Primary.png" alt=""></a>
                    <a href="#"><img class="instagram" src="img/Instagram_Glyph_Gradient.png" alt=""></a>
                    <a href="#"><img class="x" src="img/logo-white.png" alt=""></a>
                    <a href="#"><img class="youtube" src="img/3721679-youtube_108064.png" alt=""></a>
                </div>
            </div>
            <div class="footer-btn">
                <div class="footer-contact">
                    <button class="contact">About Us</button>
                    <button class="contact">Contact Us</button>
                </div>
                <form>
                    <p>SUBSCRIBE NOW</p>
                    <input class="subscribe" type="text" placeholder="&nbsp;&nbsp;email">
                    <button class="send">SEND</button>
                </form>
            </div>
        </footer> -->

        <?php include 'includes/footer.php'; ?>
</body>

</html>