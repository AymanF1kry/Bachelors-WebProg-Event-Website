<?php

@include '../Connection/config.php';


$query = "SELECT * FROM `event`";
$resultEvent=mysqli_query($con,$query);


if(isset($_POST['signup'])){
  $username=mysqli_real_escape_string($con, $_POST['username']);
  $fullname=mysqli_real_escape_string($con, $_POST['fullname']);
  $email=mysqli_real_escape_string($con, $_POST['email']);
  $phonenum=mysqli_real_escape_string($con, $_POST['phonenum']);
  $category=mysqli_real_escape_string($con, $_POST['category']);
  $password=mysqli_real_escape_string($con, $_POST['password']);
  $confirmpass=mysqli_real_escape_string($con, $_POST['confirmpass']);

  $selectUsername = "SELECT * FROM user WHERE username = '$username'";
  $selectFullname = "SELECT * FROM user WHERE fullname = '$fullname'";
  $selectEmail = "SELECT * FROM user WHERE email = '$email'";
  $selectPhonenum = "SELECT * FROM user WHERE phonenum = '$phonenum' ";
  $selectCategory = "SELECT * FROM user WHERE category = '$category' ";
  $sqlQuota = "SELECT * FROM `event` WHERE category = '$category'";


  $checkUsername=mysqli_query($con,$selectUsername);
  $checkFullname=mysqli_query($con,$selectFullname);
  $checkEmail=mysqli_query($con,$selectEmail);
  $checkPhonenum=mysqli_query($con,$selectPhonenum);
  $checkCategory=mysqli_query($con,$selectCategory);
  $checkQuota = mysqli_query($con, $sqlQuota);
  $fetchQuota = mysqli_fetch_assoc($checkQuota);

  if(mysqli_num_rows($checkUsername) > 0){
    $message[] = 'Username is already taken!';
  }
  elseif(mysqli_num_rows($checkFullname) > 0)
  {
    $message[] = 'Fullname is already taken!';
  }
  elseif(mysqli_num_rows($checkEmail) > 0)
  {
    $message[] = 'Email is already taken!';
  }
  elseif(mysqli_num_rows($checkPhonenum) > 0)
  {
    $message[] = 'Phone number is already taken!';
  }
  elseif(empty($username))
  {
    $message[] = 'Username must not be empty!';
  }elseif(empty($fullname))
  {
    $message[] = 'Fullname must not be empty!';
  }elseif(empty($email))
  {
    $message[] = 'Email must not be empty!';
  }elseif(empty($phonenum))
  {
    $message[] = 'Phone number must not be empty!';
  }elseif(empty($password))
  {
    $message[] = 'Password must not be empty!';
  }elseif(empty($confirmpass))
  {
    $message[] = 'Confirm password must not be empty!';
    
  }elseif(mysqli_num_rows($checkCategory) == $fetchQuota['quota']){
    $message[] = "The Category's Quota is full!";

  }else
  {
    
    if(!preg_match('/^.{5,30}$/',$username)){
      $message[] = 'Username must be between 5 to 30 characters long!';
    
    }elseif(!preg_match('/^[a-zA-Z0-9]+$/',$username)){
      $message[] = 'Username can contain letters and numbers only!';

    }elseif(!preg_match('/^[a-zA-Z ]+$/',$fullname)){
      $message[] = 'Fullname can contain letters only!';

    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $message[] = 'Email is invalid!';

    }elseif(!preg_match('/^[0-9]+$/',$phonenum)){
      $message[] = 'Phone number can contain numbers only!';

    }elseif(!preg_match('/^.{10,11}$/',$phonenum)){
      $message[] = 'Phone number must be between 10 to 11 numbers only!';

    }elseif(!preg_match('/^.{5,30}$/',$password)){
      $message[] = 'Passwords must be between 5 to 30 characters long!';
    }elseif($password != $confirmpass){
      $message[] = 'Passwords do not match!';
    
    }else{
      $insert = "INSERT INTO user(username,fullname,email,phonenum,category,password) VALUES('$username','$fullname','$email','$phonenum','$category','$password')";
      mysqli_query($con,$insert) or die("Failed to insert into database!");
      echo '<script> alert("Sign Up Complete!"); window.location.assign("./user_login.php");</script>';
    }
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
  <link rel="stylesheet" href="../Style/user_style.css"> 
</head>

<body>

  <div class="login-container"> 

    <h2>User Signup Page</h2>

    <p class="text1">Sign up to join our exclusive events</p>

    <form id="registrationForm" method="post"> 
      <?php
      if(isset($message)){
        foreach($message as $message){
          echo '<span class="text-msg">'.$message.'</span>';
        };
      };
      ?>
      
      <label for="username">Username :</label>
      <input type="text" id="username" name="username" placeholder="Example: Azfarnaz03" ><br>

      <label for="full-name">Full Name :</label>
      <input type="text" id="full-name" name="fullname" placeholder="Example: Azfar Nazrin Bin Affandi" ><br>
	  
      <label for="email">Email :</label>
      <input type="text" id="email" name="email" placeholder="Example: Azfarnaz03@gmail.com" ><br>

      <label for="phone-number">Phone Number :</label>
      <input type="text" id="phone-number" name="phonenum" placeholder="Example: 0123456789" ><br>

      <label for="event_category">Event Category :</label>
      <select name="category" class="dropdown-styling">
        <?php while($row = mysqli_fetch_array($resultEvent)):?>
        <option value="<?php echo $row['category'];?>"><?php echo $row['category'];?></option>
        <?php endwhile; ?>
      </select>

      <label for="password">Password :</label>
      <input type="password" id="password" name="password" placeholder="Example: Batman1234" ><br>
	  
      <label for="confirm-password">Confirm Password :</label>
      <input type="password" id="confirm-password" name="confirmpass" placeholder="Example: Batman1234" ><br>

      <div style="text-align:center">
        <button type="submit" name="signup">Sign Up</button>
      </div>
      
      <div class="create-account-link">
        Already have an account? <a href="./user_login.php">Log in here</a>
      </div>

    </form>

  </div>

</body>
</html>