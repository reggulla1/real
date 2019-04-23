<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Details</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" type="text/css" href="template.css">
		<div class="header">
			<div class="Yentrex Watch">
				<a href="home.php">Yentrex Watch</a>
			</div>
			<div class="top">
				<div id="toplink">
				</div>
				<div class="top">
					<div id="toplink">
						<img src="image/product.png">
						<br>
						<a href="Product.php">Product</a>
					</div>
					<div id="toplink">
						<img src="image/login.png">
						<br>
						<a href="login.php">Login</a>
					</div>
					<div id="toplink">
						<img src="image/id-card.png">
						<br>
						<a href="register.php">Register</a>
					</div>
				</div>
			</div>
		</div>
</head
	<body>
		<table width="900" border="0" align="center" class="square">
		  <tr><td colspan="3" bgcolor="#CCCCCC"><b>Product</b></td></tr>
		  
			<?php
			//connect db
				include("connect.php");
				$id = $_GET['pid']; 
				
				$sql = "select * from product where P_ID=$id";  
				$result = mysqli_query($mysqli, $sql);
				$row = mysqli_fetch_array($result);
				//Show details
			echo "<tr>";
				echo "<td width='85' valign='top'><b>Title</b></td>";
				echo "<td width='279'>" . $row["P_Name"] . "</td>";
				echo "<td width='70' rowspan='4'><img src='image/".$row["P_Pic"]." ' width='100'></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td valign='top'><b>Detail</b></td>";
				echo "<td>" . $row["P_Details"] . "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td valign='top'><b>Price</b></td>";
				echo "<td>" .number_format($row["P_Price"],2) . "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td valign='top'><b>Company</b></td>";
				echo "<td width='279'>" . $row["P_Company"] . "</td>";
				echo "</tr>"; 				
				echo "<tr>";
			?>
				<td colspan='2' align='center'><a href='login.php'><button type="button" class="btn btn-warning btn-sm">Add to Cart</button></a></td>
			<?php	
				echo "</tr>";
			?>
		</table>
		<p><center><a href="product.php"><button type="button" class="btn btn-warning btn-sm">Back to Product</button></a></center>
	</body>
</html>