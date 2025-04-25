<?php

@include '../Connection/config.php';

session_start();

if(isset($_POST['login'])){
  $admin_id=mysqli_real_escape_string($con, $_POST['admin_id']);
  $password=mysqli_real_escape_string($con, $_POST['password']);

  $select = "SELECT * FROM admin WHERE admin_id = '$admin_id' && password = '$password' ";

  $result=mysqli_query($con,$select);

  if(mysqli_num_rows($result) > 0){

    $row=mysqli_fetch_array($result);

    $_SESSION['admin_id']=$row['admin_id'];
   
    echo '<script> alert("Login Successful!"); window.location.assign("./admin_menu.php");</script>';
    
  }elseif(empty($admin_id))
  {
    $message[] = 'Admin ID must not be empty!';
  }elseif(empty($password))
  {
    $message[] = 'Password must not be empty!';
  }else{
    $message[] = "Invalid Admin ID or Password!";
  }

};
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Jom Lari 2024 </title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap">

  <!-- Link to adminstyling.css file -->
  <link rel="stylesheet" href="../Style/admin_style.css">
  
</head>
<body>

  <div class="login-container">
    <h2>Admin Login Page</h2>
	<p class="text1">Log in your account with the authorized admin credentials</p>
    <form action="" method="post">
      <div>
      <?php
      if(isset($message)){
        foreach($message as $message){
          echo '<span class="text-msg">'.$message.'</span>';
        };
      };
      ?>
      </div>
      <label for="admin-id">Admin ID :</label>
      <input type="text" id="admin-id" name="admin_id" placeholder="Enter Admin ID" ><br>

      <label for="password">Password :</label>
      <input type="password" id="password" name="password" placeholder="Enter Password" ><br>
      
      <div style="text-align:center">
        <button type="submit" name="login">Log In</button>
      </div>

      <div class="create-account-link" style="text-align:center">
        <a href="../User/user_login.php">Click here</a>  if you are a user.
      </div>

    </form>
  </div>

</body>
</html>