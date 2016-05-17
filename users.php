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
		<li class="sign_up_in"><a href="users.php">Users</a></li>
<?php } else if (!isset($_SESSION['email'])){ ?>
		<li class="sign_up_in"><a href="sign_in.php">Log in</a></li>
		<li class="sign_up_in"><a href="sign_up.php">Sign up</a></li>
<?php } ?>
</ul>

<?php
	include ("db_connect.php");
	$records = $dbh->prepare('SELECT * FROM users');
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);


?>
<h1 id="account_header"> Users </h1>
<table id = "account_details_table">
<tr>
<th> Firstname </th>
<th> Surname </th>
<th> Email </th>
<th> Age </th>
<th> Account Type </th>
</tr>
<?php
	while($row = mysql_fetch_array($result)){  
		echo "<tr><td>" . $row['firstname'] . "</td><td>" . $row['surname'] . "</td></tr>"; 
	}
?>
</table>

</body>
</html>
</html>