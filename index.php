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
      <li>
        <a class="active" href="index.php">Home
        </a>
      </li>
      <li>
        <a href="order.php">Order
        </a>
      </li>
      <?php
session_start();
if(isset($_SESSION['email'])){ 
?>
      <li class="sign_up_in">
        <a href="account.php">
          <?php echo $_SESSION['name']; ?>
        </a>
      </li>
      <li class="sign_up_in">
        <a href="log_out.php">Log out
        </a>
      </li>
      <?php 
} if($_SESSION ['status'] === 'Administrator'){
?>
      <!-- admin features -->
      <?php } else if (!isset($_SESSION['email'])){ ?>
      <li class="sign_up_in">
        <a href="sign_in.php">Log in
        </a>
      </li>
      <li class="sign_up_in">
        <a href="sign_up.php">Sign up
        </a>
      </li>
      <?php } ?>
    </ul>
  </body>
</html>
</body>
</html>
