<!doctype html>
<html lang="en">
	<head>
	  	<meta charset="utf-8">
	  	<title>Daniel Sims</title>
	  	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
<ul>
		<li><a class="active" href="index.php">Home</a></li>
		<li><a href="order.php">Order</a></li>
<?php
	session_start();
	if(isset($_SESSION['email'])){ 
	?>
		<li class="sign_up_in"><a href="account.php">Account</a></li>
		<li class="sign_up_in"><a href="log_out.php">Log out</a></li>
<?php } else if (!isset($_SESSION['email'])){ ?>
		<li class="sign_up_in"><a href="sign_in.php">Log in</a></li>
		<li class="sign_up_in"><a href="sign_up.php">Sign up</a></li>
<?php } ?>
</ul>


<div class="center_container">
<h1 id="account_header"> Welcome <?php echo $_SESSION['name']; ?> </h1>

<div id = "account_details">
<p id = "details"> <?php 
	echo "First name - " . $_SESSION['firstname'] . "</br>"; 
	echo "Surname - " . $_SESSION['surname'] . "</br>"; 
	echo "Email - " . $_SESSION['email'] . "</br>"; 
	echo "Age - " . $_SESSION['age'] . "</br>"; 
	echo "Account type - " . $_SESSION['status'] . "</br>"; 
	?>
</p>



</div>

</div>

</body>
</html>
	</body>
</html>