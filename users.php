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
session_start();
if(!isset($_SESSION['email'])){
echo "<p class=\"error_message\">Please log in in a user with sufficient privileges to view this page. </p>";
} else if ($_SESSION['status'] != "Administrator"){
echo "<p class=\"error_message\"> You don't have the right privileges to view this page. </p>";
} else {
include ("db_connect.php");
$records = $dbh->prepare('SELECT * FROM users');
$records->execute();
?>
    <h1 id="account_header"> Users 
    </h1>
    <table id = "account_details_table">
      <tr>
        <th> Firstname 
        </th>
        <th> Surname 
        </th>
        <th> Email 
        </th>
        <th> Age 
        </th>
        <th> Account Type 
        </th>
      </tr>
      <?php
while($results = $records->fetch(PDO::FETCH_ASSOC)){  
echo "<tr><td>" . $results['firstname'] . "</td><td>" . $results['surname'] . "</td><td>" . $results['email'] . "</td><td>" . $results['age'] . "</td><td>" . $results['status'] . "</td></tr>"; 
}
?>
    </table>
    <?php } ?>
  </body>
</html>
</html>
