<?php
    @include '../Connection/config.php';

    session_start();
    
    $username = $_SESSION['user_name'];
    if(!isset($username)){
        header('location:./user_login.php');
    }

    if(isset($_POST['userprofile'])){
        header('location:./user_profile.php');

    }elseif(isset($_POST['Logout'])){
        header('location:../Logout/logout.php');
    }


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

    <h2> Hey there, <?php echo  $username; ?> !</h2>

    <p class="text1"> Welcome to the User Menu. Please select one of the options below:</p>
    

    <form id="registrationForm" method="post"> 

      <div style="text-align:center">
        <button type="submit" name="userprofile">User Profile</button>
      </div><br>

      <div style="text-align:center">
        <button type="submit" name="Logout">Log Out</button>
      </div>
     

    </form>

  </div>


</body>
</html>