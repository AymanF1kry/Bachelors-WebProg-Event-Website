<?php

@include '../Connection/config.php';

session_start();

if(isset($_POST['Login'])){
  $username=mysqli_real_escape_string($con, $_POST['username']);
  $password=mysqli_real_escape_string($con, $_POST['password']);

  $select = "SELECT * FROM user WHERE username = '$username' && password = '$password' ";

  $result=mysqli_query($con,$select);

  if(mysqli_num_rows($result) > 0){
    $row=mysqli_fetch_array($result);

    $_SESSION['user_name']=$row['username'];
    echo '<script> alert("Login Successful!"); window.location.assign("./user_menu.php");</script>';

  }elseif(empty($username))
  {
    $message[] = 'Username must not be empty!';
  }elseif(empty($password))
  {
    $message[] = 'Password must not be empty!';
  }else{
    $message[] = "Invalid Username or Password!";
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
  <link rel="stylesheet" href="../Style/user_style.css"> <!-- Link to style.css file -->
</head>

<body>

  <div class="login-container"> 

    <h2>User Login Page</h2>

	<p class="text1">Log in to your account to view and update your profile</p>

    <form id="registrationForm" method="post"> 

      <?php
      if(isset($message)){
        foreach($message as $message){
          echo '<span class="text-msg">'.$message.'</span>';
        };
      };
      ?>
      <label for="username">Username :</label>
      <input type="text" id="username" name="username" placeholder="Example: Azfarnaz03"><br>

      <label for="password">Password :</label>
      <input type="password" id="password" name="password" placeholder="Example: Batman1234"><br>

	  <div class="forgot-password-link">
		<a href="???">Forgot password?</a>
	  </div>

      <div style="text-align:center">
        <button type="submit" name="Login">Log In</button>
      </div>
      
      <div class="create-account-link">
		Don't have an account? <a href="./user_signup.php">Create one here</a>.
	  </div>

	  <div class="create-account-link">
		<a href="../Admin/admin_login.php">Click here</a>  if you are an admin.
	  </div>

    </form>

  </div>


</body>
</html>


