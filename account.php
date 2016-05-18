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
		<li class="sign_up_in"><a href="account.php"><?php echo $_SESSION['name']; ?></a></li>
		<li class="sign_up_in"><a href="log_out.php">Log out</a></li>
<?php 
		} if($_SESSION ['status'] === 'Administrator'){
?>
		<!-- admin features -->
<?php } else if (!isset($_SESSION['email'])){ ?>
		<li class="sign_up_in"><a href="sign_in.php">Log in</a></li>
		<li class="sign_up_in"><a href="sign_up.php">Sign up</a></li>
<?php } ?>
</ul>


<h1 id="account_header"> My Account </h1>

<table id = "account_details_table">
	<tr>
	<th> Firstname </th>
	<th> Surname </th>
	<th> Email </th>
	<th> Age </th>
	<th> Account Type </th>
	</tr>
	<tr>

	<?php echo "<td>" . $_SESSION['firstname'] . "</td><td>" . $_SESSION['surname'] . "</td><td>" . $_SESSION['email'] . "</td><td>" . $_SESSION['age'] . "</td><td>" . $_SESSION['status'] . "</td></td>"?>
	</tr>
</table>

 <?php 
 	if($_SESSION['status'] === 'Administrator'){
		echo "<h1 id=\"account_header\"> Account features" . " (" . $_SESSION['status'] . ")</h1>";
?>
	<div id = "update_products">
		<strong><p class = "features_header"> Products </p></strong>
		<p class = "features_text"> Update the products here. </p>
		<div class = "buttons_in_features">
			<form action = "http://localhost/website/users.php"> <input type = "submit" name = "submit" id="submit" value = "Add"/> </form>
			<form action = "http://localhost/website/users.php"> <input type = "submit" name = "submit" id="submit" value = "Delete"/> </form>
		</div>
	</div>

	<div id = "update_account">
		<strong><p class = "features_header"> Account </p></strong>
		<p class = "features_text"> Update your account here. </p>
		<div class = "buttons_in_features">
			<form action = "http://localhost/website/users.php"> <input type = "submit" name = "submit" id="submit" value = "Edit"/> </form>
			<form action = "http://localhost/website/users.php"> <input type = "submit" name = "submit" id="submit" value = "Delete"/> </form>
		</div>
	</div>

	<div id = "update_account">
		<strong><p class = "features_header"> Users </p></strong>
		<p class = "features_text"> Update user accounts. </p>
		<div class = "buttons_in_features">
			<form action = "http://localhost/website/add_user.php"> <input type = "submit" name = "submit" id="submit" value = "Add"/> </form>
			<form action = "http://localhost/website/users.php"> <input type = "submit" name = "submit" id="submit" value = "View"/> </form>
			<form action = "http://localhost/website/delete_user.php"> <input type = "submit" name = "submit" id="submit" value = "Delete"/> </form>
		</div>
	</div>
<?php
 	} else if($_SESSION['status'] === 'User'){ 
		echo "<h1 id=\"account_header\"> Account features" . " (" . $_SESSION['status'] . ")</h1>";
 ?>
	<div id = "update_account_user">
		<strong><p class = "features_header"> Account </p></strong>
		<p class = "features_text"> Update your account here. </p>
	</div>

<?php } ?>
</body>
</html>
	</body>
</html>