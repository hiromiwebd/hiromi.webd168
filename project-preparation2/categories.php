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
<?php
include 'connect.php';
// include 'cartfunctions.php';

$catid = $_GET['catid'];
$catsql = $dbh->prepare("select catname from dog_categories where catid = '$catid'");
$catsql->execute();
$catrow = $catsql->fetch();
$seocatname = $catrow[0];
//get the catname and populate

include 'includes/header.php';
?>

<div style="text-align: center; margin-top: 70px;">

<?php

echo '<h1 style="padding-bottom: 30px;">'.$seocatname.'</h1>';
$catid = $_GET['catid'];
// $sql = $dbh->prepare("select * from dog_products where catid = '$catid'");
$sql = $dbh->prepare("select * from dog_products where catid = '$catid'");
$sql->execute();
while ($row = $sql->fetch()){
	$prodid = $row['prodid'];
	$prodname = $row['prodname'];
	$proddesc = $row['proddesc'];
	$prodprice = $row['prodprice'];
	$prodlink = $row['link'];

	// echo '<a href="'.$link.'" title="'.$prodname.'"><img src = "img/'.$catid.'.jpg" height="200" width="300" alt="'.$prodname.'"></a><br><br>';

	echo '<br><br><img src = "img/'.$catid.'.jpg" height="200" width="300" alt="'.$prodname.'"></a><br><br><br>';
	echo '<a href="'.$link.'" title="'.$prodname.'">'.$prodname.' ...Read more</a><br>';
	echo '<p>$ '.$prodprice.'</p><br><hr>';

}
?>

</div>
<?php

include 'includes/footer.php';

?>
</body>