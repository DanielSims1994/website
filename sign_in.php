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
	  <li class="sign_up_in"><a href="sign_in.php">Log in!</a></li>
	  <li class="sign_up_in"><a href="sign_up.php">Sign up!</a></li>
	</ul>


<?php
	include ("db_connect.php"); 

	
	session_start();
	if(isset($_POST['submit'])){
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);

		if($email == ''){
			$errMsg .= 'You must enter your Username<br>';
		}
		
		if($password == ''){
			$errMsg .= 'You must enter your Password<br>';
		}


		if($errMsg == ''){
			$records = $dbh->prepare('SELECT email, password FROM users WHERE email = :email');
			$records->bindParam(':email', $email);
			$records->execute();
			$results = $records->fetch(PDO::FETCH_ASSOC);

			var_dump($results);

			if($results ['password'] == $password){
				$_SESSION['email'] = $results['email'];
				echo "it works!";
				exit;
			}else{
				$errMsg .= '<p class="issues_text"> Username and Password are not found<br> </p>';
			}
		}
		echo $errMsg;
	}


?>




	<div class="sign_up_and_in_container">
	<form method = "POST" action = "sign_in.php">
		<p> Email </p>
	     <input type="text" name = "email" id="email" placeholder = "Email" value="<?php echo $_POST['email_login']; ?>"/> <br/> 
	     <p> Password </p>
	     <input type="password" name = "password" id="password" placeholder = "Password" value="<?php echo $_POST['password_login']; ?>"/> <br /><br />
	     <input id="button_login" type="submit" name="submit" value="Log-In">			
	</form>
	</div>
</body>
</html>
	</body>
</html>