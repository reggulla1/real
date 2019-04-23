<?php session_start();
 ?><!DOCTYPE html>
<html>
<head>
	<?php 
        require_once('connect.php');
    ?>

	<title>User Profile</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" type="text/css" href="template.css">
		<div class="header">
			<div class="Yentrex Watch">
				<a href="home2.php?userid=<?=$_SESSION['v_id']?>">Yentrex Watch</a>
			</div>
			<div class="top">
					<?php
						echo "<div id=\"toplink\"> Welcome"
							."<br>"
							. $_SESSION['userid']
							. "</div>";
					?>

				<div id="toplink">
					<?php if ($_SESSION['v_userrole']==1){ ?>
						<img src="image/order.png">
						<br>
						<a href="order_staff.php?userid=<?=$_SESSION['v_id']?>">Order</a>
					<?php } else { ?>
					<?php } ?>
				</div>
				<div id="toplink">
					<?php if ($_SESSION['v_userrole']==1){ ?>
						<img src="image/add.png">
						<br>
						<a href="addproduct.php?userid=<?=$_SESSION['v_id']?>">Add Product</a>
					<?php } else { ?>
						<img src="image/order.png">
						<br>
						<a href="order.php?userid=<?=$_SESSION['v_id']?>">Order</a>
					<?php } ?>
				</div>
				<div id="toplink">
					<img src="image/product.png">
					<br>
					<a href="Product2.php?userid=<?=$_SESSION['v_id']?>">Product</a>
				</div>
				<div id="toplink">
					<?php if ($_SESSION['v_userrole']==1){ ?>
						<img src="image/profile.png">
						<br>
						<a href="user.php?userid=<?=$_SESSION['v_id']?>">User Profile</a>
					<?php } else { ?>
						<img src="image/edit.png">
						<br>
						<a href="edit.php?userid=<?=$_SESSION['v_id']?>">Edit</a>
					<?php } ?>
				</div>
				<div id="toplink">
					<img src="image/login.png">
					<br>
					<a href="logout.php">Logout</a>
				</div>
			</div>
		</div>
</head>

	<body><!-- onload="alert('Welcome!!! Pop up text at home.html line 15')" -->
	<div id="div_main">

			<!-- start of the content -->
		<div id="div_content" >
			<!--%%%%% Main block %%%%-->
			<h2>User Profile</h2>
			<table width="900" border="1" align="center" >
				
				<tr>
					<td width="91" align="center" bgcolor="#CCCCCC"><strong>#</strong></td>
					<td width="200" align="center" bgcolor="#CCCCCC"><strong>Name</strong></td>
					<td width="50" align="center" bgcolor="#CCCCCC"><strong>Address</strong></td>
					<td width="50" align="center" bgcolor="#CCCCCC"><strong>Birthday</strong></td>
					<td width="100" align="center" bgcolor="#CCCCCC"><strong>Email</strong></td>
					<td width="91" align="center" bgcolor="#CCCCCC"><strong>PhoneNo</strong></td>
					<td width="200" align="center" bgcolor="#CCCCCC"><strong>Username</strong></td>
					<td width="50" align="center" bgcolor="#CCCCCC"><strong>Password</strong></td>
					<td width="50" align="center" bgcolor="#CCCCCC"><strong>Group</strong></td>
					<td width="100" align="center" bgcolor="#CCCCCC"><strong>Edit</strong></td>
					<td width="100" align="center" bgcolor="#CCCCCC"><strong>Delete</strong></td>
					
				</tr>
					<?php 
						$q="select * from user,usergroup,usergender 
						where user.USERGROUP_ID = usergroup.USERGROUP_ID AND user.USER_GenderID = usergender.USER_GenderID";
						$result=$mysqli->query($q);
						while(!$result){
							echo "Select failed. Error: ".$mysqli->error ;
							break;
						}
						while($row=$result->fetch_array()){ ?>
							<tr>
								<td><?=$row['USER_ID']?></td>
								<td><?=$row['USER_FName']?>  <?=$row['USER_LName']?>(<?=$row['USER_Gender']?>)</td>
								<td><?=$row['USER_Address']?></td>
								<td><?=$row['USER_DOB']?></td>
								<td><?=$row['USER_Email']?></td>
								<td><?=$row['USER_PhoneNo']?></td>
								<td> <?=$row['USER_Username']?></td>
								<td> <?=$row['USER_Password']?></td>
								<td><?=$row['USERGROUP_NAME']?></td>
								<td><a href="edit.php?userid=<?=$row['USER_ID']?>"><button type="button" class="btn btn-warning btn-sm" 
								<?php
								if ($_SESSION['v_userrole']==1) {
									echo " ";
									}
								else{
									if ($row['USER_ID']!=$_SESSION['v_id']){
										echo "disabled";
										;
										}
									else{
										echo " ";
										}
									}
								 ?>>EDIT</button></a></td>
								<td><a href='del_user.php?userid=<?=$row['USER_ID']?>'><button type="button" class="btn btn-danger btn-sm" 
								<?php 
								if ($_SESSION['v_userrole']==1) {
									echo " ";
									}
								else{
									if ($row['USER_ID']!=$_SESSION['v_id']) {
										echo "disabled";
										;
										}
									else{
										echo " ";
										}		
									}
								 ?>>DELETE</button></a></td>
							</tr>                               
						<?php } ?>
					<?php $count=$result->num_rows;
					  echo "<tr><td colspan=11 align=right>Total $count records</td><td colspan=12 align=right> </td></tr>";
					  $result->free();
					?>
			</table>
		</div>
	</body>
<footer class="foot">
	<div id="div_left"></div>
	Made by YENTREX Club since 2018
	<div id="div_right"></div>
</footer>
	</div> <!-- end div_main-->
</html>
