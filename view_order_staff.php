<?php session_start(); 
$o_id = $_REQUEST['o_id']; ?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("connect.php");
	 $q = "select * from user ";
        $result = $mysqli->query($q);
        if(!$result){
          echo "Select failed; ".$mysqli->error;
        }
        $row = $result->fetch_array(); 
	?>
	<title>View Order</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" type="text/css" href="template.css">
		<div class="header">
			<div class="Yentrex Watch">
				<a href="home3.php?userid=<?=$_SESSION['v_id']?>">Yentrex Watch</a>
			</div>
			<div class="top">
				<div id="toplink">
					<?php
						echo "Welcome";
					?>
					<br>
					<?php
						echo $_SESSION['userid'];
					?>
				</div>
				<div id="toplink">					
					<?php if ($_SESSION['v_userrole']==1){ ?>
						<a href="addproduct.php?userid=<?=$_SESSION['v_id']?>">Add Product</a>
					<?php } else { ?>
					<?php } ?>
				</div>
				<div id="toplink">		
					<a href="Product2.php?userid=<?=$_SESSION['v_id']?>">Product</a>
				</div>
				<div id="toplink">					
					<?php if ($_SESSION['v_userrole']==1){ ?>
						<a href="user.php?userid=<?=$_SESSION['v_id']?>">User Profile</a>
					<?php } else { ?>
						<a href="edit.php?userid=<?=$_SESSION['v_id']?>">Edit</a>
					<?php } ?>
				</div>
				<div id="toplink">
					<a href="logout.php">Logout</a>
				</div>
			</div>
		</div>
</head>
<?php
$strSQL = "SELECT * FROM order_head,delivery
WHERE order_head.o_id = $o_id AND order_head.D_ID = delivery.D_ID";
$objQuery = mysqli_query($mysqli,$strSQL)  or die("Error: " . mysqli_error($mysqli));
$objResult = mysqli_fetch_array($objQuery);
?>

 <table width="400" border="1" align="center">
    <tr>
      <td width="71">OrderID</td>
      <td width="217">
	  <?php echo $objResult["o_id"];?></td>
    </tr>
    <tr>
	 <tr>
      <td width="71">Order Date</td>
      <td width="217">
	  <?php echo $objResult["o_dttm"];?></td>
    </tr>
    <tr>
      <td width="71">Name</td>
      <td width="217">
	  <?php echo $objResult["o_name"];?></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><?php echo $objResult["o_addr"];?></td>
    </tr>
    <tr>
      <td>Tel</td>
      <td><?php echo $objResult["o_phone"];?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $objResult["o_email"];?></td>
    </tr>
	<tr>
      <td>Delivery</td>
      <td><?php echo $objResult["D_Name"];?></td>
    </tr>
  </table>

  <br>

<table width="800"  border="1" align="center">
  <tr>
    <td width="101">ProductID</td>
	<td width="101">Picture</td>
    <td width="82">ProductName</td>
    <td width="82">Price</td>
    <td width="79">Qty</td>
    <td width="79">Total</td>
  </tr>
<?php

$Total = 0;
$SumTotal = 0;

$strSQL2 = "SELECT * FROM order_detail WHERE o_id = '".$_GET["o_id"]."' ";
$objQuery2 = mysqli_query($mysqli,$strSQL2)  or die("Error: " . mysqli_error($mysqli));

while($objResult2 = mysqli_fetch_array($objQuery2))
{
		$strSQL3 = "SELECT * FROM product WHERE P_ID = '".$objResult2["p_id"]."' ";
		$objQuery3 = mysqli_query($mysqli,$strSQL3)  or die("Error: " . mysqli_error($mysqli));
		$objResult3 = mysqli_fetch_array($objQuery3);
		$Total = $objResult2["d_qty"] * $objResult3["P_Price"];
		$SumTotal = $SumTotal + $Total;
	  ?>
	  <tr>
		<td><?php echo $objResult2["p_id"];?></td>
		<td><?php echo '<img src="image/'.$objResult3["P_Pic"].'" width="100" height"100">';?></td>
		<td><?php echo $objResult3["P_Name"];?></td>
		<td><?php echo $objResult3["P_Price"];?></td>
		<td><?php echo $objResult2["d_qty"];?></td>
		<td><?php echo number_format($Total,2);?></td>
	  </tr>
	  <?php
 }
  ?>
</table>
Sum Total <?php echo number_format($SumTotal,2);?>

<?php
mysqli_close($mysqli);
?>
<p><center><a href="order_staff.php?userid=<?=$_SESSION['v_id']?>"><button type="button" class="btn btn-warning btn-sm">Back to Order</button></a></center>
</body>
</html>