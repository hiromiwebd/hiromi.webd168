<!DOCTYPE html>
<html  lang="en">

<head>
    <title><?php if (isset($catname)) echo $catname;
    else {
      echo 'Love Dog Cart';
    }?></title>
    
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    @import url(style.css);
    .small_pic {
    max-height: 200px;
  }
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
    width: 70%;
    margin: auto;
  }
    </style>
</head>
    

    <body>

    <header>
        <p>FREE SHIPPING AN ORDER OF $75 OR MORE 📦&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <button class="help">HELP</button>
    </header>

    <div class="search-section">
        <a href="index.php"><img class="logo" src="img/logo.png" alt="dog love company logo"></a>
        <form action="search.php" method="get">
            <input class="search" type="text" name="qry" placeholder="search">
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
    </div>

    <div class="nav-wrap">
        <div class="nav">
            <a class="nav-main" href="#">Dog Size</a>
            <ul class="nav-detail">
                <li><a href="categories.php?catid=1" class="drop-menu-link">Small</a></li>
                <li><a href="categories.php?catid=2" class="drop-menu-link">Medium</a></li>
                <li><a href="categories.php?catid=3" class="drop-menu-link">Large</a></li>
            </ul>
        </div>

        <div class="nav">
            <a class="nav-main" href="#">Food Type</a>
            <ul class="nav-detail">
                <li><a href="categories.php?catid=4" class="drop-menu-link">Wet food</a></li>
                <li><a href="categories.php?catid=5" class="drop-menu-link">Dry food</a></li>
                <li><a href="categories.php?catid=6" class="drop-menu-link">Wet & Dry</a></li>
            </ul>

        </div>

        <div class="nav">
            <a class="nav-main" href="#">Snacks</a>
            <ul class="nav-detail">
                <li><a href="categories.php?catid=7" class="drop-menu-link">Bone</a></li>
                <li><a href="categories.php?catid=8" class="drop-menu-link">Cookie</a></li>
                <li><a href="categories.php?catid=9" class="drop-menu-link">Additive-free</a></li>
            </ul>

        </div>

        <div class="nav">
            <a class="nav-main" href="#">Special</a>
            <ul class="nav-detail">
                <li><a href="categories.php?catid=10" class="drop-menu-link">Cake</a></li>
                <li><a href="categories.php?catid=11" class="drop-menu-link">Ice cream</a></li>
                <li><a href="categories.php?catid=12" class="drop-menu-link">Custom item</a></li>
            </ul>
        </div>
    </div>

<!-- <?php
$sql = $dbh->prepare("select * from dog_categories");
$sql->execute();
while ($row = $sql->fetch()){
  $catid = $row['catid'];
  $catname = $row['catname'];
$nav .= '<li><a href="categories.php?catid='.$catid.'">'.strtoupper($catname).'</a></li>';
}
echo $nav;
?>  -->