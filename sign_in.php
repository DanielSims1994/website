<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>Daniel Sims
    </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <ul>
        <li> <a class="active" href="index.php">Home </a></li>
        <li><a href="order.php">Order</a></li>
        <?php
        session_start();
        if(isset($_SESSION['email'])){
        ?>
            <li class="sign_up_in"> <a href="account.php"><?php echo $_SESSION['name']; ?></a></li>
            <li class="sign_up_in"><a href="log_out.php">Log out</a></li>
        <?php 
        } if($_SESSION ['status'] === 'Administrator') {
        ?>
            <!-- admin features -->
        <?php 
        } else if (!isset($_SESSION['email'])){ 
        ?>
            <li class="sign_up_in"><a href="sign_in.php">Log in </a></li>
            <li class="sign_up_in"> <a href="sign_up.php">Sign up </a></li>
        <?php 
        }
        ?>
    </ul>


    
    <?php
include ("db_connect.php"); 
if(isset($_SESSION['email'])){
header('Location: http://localhost/website/index.php');		
} else {
?>
    <div class="sign_up_and_in_container">
      <form method = "POST" action = "sign_in.php">
        <Fieldset class = "field_wrapper">
          <h1 id="account_header"> Log in 
          </h1>
          <input type="text" name = "email" id="email" placeholder = "Email" value="<?php echo $_POST['email_login']; ?>"/> 
          <br/> 
          <p> Password 
          </p>
          <input type="password" name = "password" id="password" placeholder = "Password" value="<?php echo $_POST['password_login']; ?>"/> 
          <br />
          <br />
          <input id="button_login" type="submit" name="submit" value="Log-In">	
        </Fieldset>
      </form>
    </div>
    <?php
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
$records = $dbh->prepare('SELECT email, password, firstname, surname, age, status FROM users WHERE email = :email');
$records->bindParam(':email', $email);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);
if($results ["password"] === $password){
$_SESSION['name'] = $results ['firstname'] . " " . $results['surname'];
$_SESSION['email'] = $results['email'];
$_SESSION['firstname'] = $results ['firstname'];
$_SESSION['surname'] = $results ['surname'];
$_SESSION['age'] = $results ['age'];
$_SESSION['status'] = $results ['status'];
header('Location: http://localhost/website/index.php');
exit;
}else{
$errMsg .= '<p class="issues_text"> Username and Password are not found<br> </p>';
}
}
echo $errMsg;
}
}
?>
  </body>
</html>
</body>
</html>
