<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>LOVE DOG</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://kit.fontawesome.com/81e38cdf17.js" crossorigin="anonymous"></script>
</head>

<?php
include 'connect.php';
include 'cartfunctions.php';
?>

<!-- <form action ="search.php" method="get">
<input type="text" name="qry">
<button>Search</button>
</form>	 -->
<?php
require 'connect.php';
include 'includes/header.php';

if ($_GET['qry']  == ''){
	$qry = ' ';
}
else {
  $qry = $_GET['qry'];
}

	//how to write difficult queries
	
   //get the number of results....
if (!empty($qry) && $qry != ' '){
?>
<script>
    var current = localStorage.getItem('recent');
    localStorage.setItem('recent',current + ',<?php echo $qry;?>');
  </script>  

<div style="text-align:center; margin-top: 50px;">
<?php
}
	$num = $dbh->prepare("select  count(dog_products.prodid) as numres
       from dog_categories, dog_products
       where (dog_categories.catname like '%$qry%' or 
       dog_products.prodname like '%$qry%' or dog_products.proddesc like '%$qry%') and dog_categories.catid = dog_products.catid");


	$num->execute();
	$row = $num->fetch();
		echo " Your search for ".$qry." generated ".$row['numres']." results<br>";

    

	//get what you want how you want....
   $sql = $dbh->prepare("select dog_categories.catid, dog_categories.catname, dog_products.prodid, dog_products.prodname, dog_products.proddesc,dog_products.prodprice
       from dog_categories, dog_products
       where (dog_categories.catname like '%$qry%' or 
       dog_products.prodname like '%$qry%' or dog_products.proddesc like '%$qry%') and dog_categories.catid = dog_products.catid");


  
   $sql->execute();


   while ($row = $sql->fetch()){
   	$catid = $row['catid'];
   	$catname = $row['catname'];
   	$prodid = $row['prodid'];
   	$prodname = $row['prodname'];
   	$proddesc = $row['proddesc'];
   	$prodprice = $row['prodprice'];
   	echo '<h3 style="margin-top: 50px;">'.$prodname.'</h3>
   	<p><a href="products.php?prodid='.$prodid.'" title="click to see more"><img src = "prodimages/'.$prodid.'.jpg" height="200"></a></p>
   	<p>'.$proddesc.'</p>
   	//check text here
 	<br><br><hr>';
   	
   }


include 'includes/footer.php';


?>
</div>

