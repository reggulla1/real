<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<?php
	 require_once('connect.php');
	 $q = "select * from user ";
        $result = $mysqli->query($q);
        if(!$result){
          echo "Select failed; ".$mysqli->error;
        }
        $row = $result->fetch_array();
	?>
	<title>Edit</title>
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
		<div class="content"><!--line 133 width:80%-->
			<!--**************************************************************	-->
		<?php 
        require_once('connect.php');
        $id = $_GET['userid'];
        $q = "select * from user where USER_ID=$id";
        $result = $mysqli->query($q);
        if(!$result){
          echo "Select failed; ".$mysqli->error;
        }
        $row = $result->fetch_array(); 

        ?>
			<form action="update_user.php" method="post">
				<input type="hidden" name="USER_ID" value="<?=$id?>">
				<label>Username</label>
				<input value="<?=$row['USER_Username']?>" type="text" required name="USER_Username">
				<br>
				<label>Password</label>
				<input value="<?=$row['USER_Password']?>" type="password" required name="USER_Password">
				<br>
				<label>First Name</label>
				<input value="<?=$row['USER_FName']?>" type="text" required name="USER_FName">
				<br>
				<label>Last Name</label>
				<input value="<?=$row['USER_LName']?>" type="text" required name="USER_LName">
				<br>
				<label>Gender</label>
				<select value="<?=$row['USER_GenderID']?>" class="select" name="USER_GenderID" input type='number'>
				<option>1 Male</option>
				<option>2 Female</option>
				</select>
				<br>
				<label>Address</label>
				<input value="<?=$row['USER_Address']?>" type="text" required name="USER_Address">
				<br>
				<label>Date Of Birth</label>
				<input value="<?=$row['USER_DOB']?>" type="date" required max="2018-11-30" name="USER_DOB">
				<br>
				<label>Email</label>
				<input value="<?=$row['USER_Email']?>" type="text" required name="USER_Email">
				<br>
				<label>PhoneNo</label>
				<input value="<?=$row['USER_PhoneNo']?>" type="text" required name="USER_PhoneNo">
				<br>
				<input type="submit" name = "u_edit" value="Submit">	
			</form>
			<?php if ($_SESSION['v_userrole']==1){ ?>
				<a href="user.php?userid=<?=$_SESSION['v_id']?>"><button>Back</button></a>
			<?php } else { ?>
				<a href="home2.php?userid=<?=$_SESSION['v_id']?>"><button>Back</button></a>
			<?php } ?>
		</div><!--end content -->
		<div id="div_right">
		</div>
</body>
<footer class="foot">
	<div id="div_left"></div>
	Made by YENTREX Club since 2018
	<div id="div_right"></div>
</footer>
	</div> <!-- end div_main-->
</html>
