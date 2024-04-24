<?php
// function numcartitems($sessid){
function numcartitems(){
	global $dbh;
//    $sql = $dbh->prepare("select count(productid) from dog_cartitems where sessionid = '$sessid'");
   $sql = $dbh->prepare("select count(productid) from dog_cartitems");
   $sql->execute();	 
   $row = $sql->fetch();
   $num = $row[0];
   return $num;
}



function addtocart($pid,$qty){
	// $sessid = session_id();
	global $dbh;
	// $checksql = $dbh->prepare("select productid from mesa_cartitems where productid = ? and sessionid = '$sessid'");
	$checksql = $dbh->prepare("select productid from mesa_cartitems where productid = ?");
	$checksql->bindValue(1,$pid);
	$checksql->execute();
	$checkpid = $checksql->fetch();
	$existingpid = $checkpid[0];
	if (is_numeric($existingpid)){
		// $sql = $dbh->prepare("update dog_cartitems set qty = ? where productid = '$pid' and sessionid = '$sessid'");
		$sql = $dbh->prepare("update dog_cartitems set qty = ? where productid = '$pid'");
		$sql->bindValue(1,$qty);
		$sql->execute();
		   echo '<script>alert("Quantity updated!");</script>';
	}
	else {
	// $sql = $dbh->prepare("insert into dog_cartitems (productid,qty,sessionid) values (?,?,?)");
	$sql = $dbh->prepare("insert into dog_cartitems (productid,qty) values (?,?)");
	$sql->bindValue(1,$pid);
	$sql->bindValue(2,$qty);
	// $sql->bindValue(3,$sessid);
	$sql->execute();
	print_r($sql->errorInfo());
    echo '<script>alert("Added to Cart!");</script>';
  }
}
?>