<!doctype html>
<html lang="en">
	<head>
	  	<meta charset="utf-8">
	  	<title>Daniel Sims</title>
	  	<link rel="stylesheet" type="text/css" href="style.css">
	</head>

<ul>
		<li><a class="active" href="index.php">Home</a></li>
		<li><a href="order.php">Order</a></li>
<?php
	session_start();
	if(isset($_SESSION['email'])){ 
	?>
		<li class="sign_up_in"><a href="account.php"><?php echo $_SESSION['name']; ?></a></li>
		<li class="sign_up_in"><a href="log_out.php">Log out</a></li>
<?php } else if (!isset($_SESSION['email'])){ ?>
		<li class="sign_up_in"><a href="sign_in.php">Log in</a></li>
		<li class="sign_up_in"><a href="sign_up.php">Sign up</a></li>
<?php } ?>
</ul>

<?php

if (isset($_POST['submit'])){
	$firstname =  $_POST['firstname'];
	$surname =  $_POST['surname'];
	$age =  $_POST['age'];
	$email =  $_POST['email'];
	$password =  $_POST['password'];
	$confirmpassword =  $_POST['confirmpassword'];	

	validateFields($firstname, $surname, $age, $email, $password, $confirmpassword);
}

function validateFields($firstname, $surname, $age, $email, $password, $confirmpassword){
	$invalid = false;

	if (isset($firstname) && trim($firstname) == ""){
		$invalid = true;
	} else if (isset($surname) && trim($surname) == ""){
		$invalid = true;
	} else if (isset($age) && trim($age) == ""){
		$invalid = true;
	} else if (isset($email) && trim($email) == ""){
		$invalid = true;
	} else if (isset($password) && trim($password) == ""){
		$invalid = true;
	} else if (isset($confirmpassword) && trim($confirmpassword) == ""){
		$invalid = true;
	}

	if($invalid == true){
		echo "<p  class=\"issues_text\"> Please fill in all options!. </p>";
	} else {
		validateInput($firstname, $surname, $age, $email, $password, $confirmpassword);
	}

}

function validateInput($firstname, $surname, $age, $email, $password, $confirmpassword){
	$issue = "";
	$issueState = false;

	if($password != $confirmpassword){
		$issue = $issue . " " . "<p class=\"issues_text\"> The passwords don't match!<br/> </p>";
		$issueState = true;
	}

	if (strlen($password) <= 8 || strlen($confirmpassword) <= 8){
		$issue = $issue . " " . "<p class=\"issues_text\"> The passwords must be more than 8 characters! <br/> </p>";
		$issueState = true;
	}


	if($age < 12 || $age > 130 || !is_numeric($age)){
		$issue = $issue . " " . "<p class=\"issues_text\"> The age is invalid! <br/> </p>";
		$issuestate = true;
	}

	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  		$issue = $issue . " " . "<p class=\"issues_text\"> Email addres isn't valid! <br/> </p>";
  		$issuestate = true;
	} 


	if ($issuestate == true){
		echo $issue;
	} else {
		addUser();
		after_Signup();
	}

}

function addUser(){
	include ("db_connect.php");
	$defaultStatus = "User";

	$sql = "INSERT INTO users (firstname, surname, age, email, password, status) 
			VALUES (:firstname, :surname, :age, :email, :password, :status)";

	$dbh->prepare($sql)->execute([
	'firstname' => $_POST['firstname'],
	'surname' => $_POST['surname'],
	'age' => $_POST['age'],
	'email' => $_POST['email'],
	'password' => $_POST['password'],
	'status' => $defaultStatus,
	]);

	session_start();
	$records = $dbh->prepare('SELECT email, password, firstname, surname, age, status FROM users WHERE email = :email');
	$records->bindParam(':email', $email);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$_SESSION['name'] = $results ['firstname'] . " " . $results['surname'];
	$_SESSION['email'] = $results['email'];
	$_SESSION['firstname'] = $results ['firstname'];
	$_SESSION['surname'] = $results ['surname'];
	$_SESSION['age'] = $results ['age'];
	$_SESSION['status'] = $results ['status'];


	header('Location: http://localhost/website/index.php');
}

?>
	<body>
	<div class="sign_up_and_in_container">
	    <form action="sign_up.php" method="post">
	    	<h1> Sign up! </h1>
	    	<p> First name </p>
	        <input type="text" name = "firstname" id="firstname" placeholder = "Firstname" value="<?php echo $_POST['firstname']; ?>"/> <br/> 
	        <p> Surname </p>
	        <input type="text" name = "surname" id="surname" placeholder = "Surname" value="<?php echo $_POST['surname']; ?>"/> <br />
	        <p> Age (between 12 and 130) </p>
	        <input type="text" name = "age" id="age" placeholder = "Age" value="<?php echo $_POST['age']; ?>"/> <br />
	        <p> Email address </p>
	        <input type="text" name = "email" id="email" placeholder = "Email address" value="<?php echo $_POST['email']; ?>"/>  <br />
	        <p> Password (at least 8 characters) </p>
	        <input type="password" name = "password" id="password" placeholder = "Password" value="<?php echo $_POST['password']; ?>"/> 
	        <p> Confirm password </p>
	        <input type="password" name = "confirmpassword" id="Confirm password" placeholder = "Confirm password" value="<?php echo $_POST['confirmpassword']; ?>"/> 
	        <br /> <br />
	        <input type = "submit" name = "submit" id="submit" value = "Join!"/><br />
	    </form>
	</div>
	</body>
</html>