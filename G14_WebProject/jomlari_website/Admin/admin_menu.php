<?php

@include '../Connection/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
  header('location:./admin_login.php');
}
 
if(isset($_POST['logout'])){
  header('location:../Logout/logout.php');
}
elseif(isset($_POST['userreport'])){
  header('location:./admin_userfunc.php');

}elseif(isset($_POST['eventreport'])){
  header('location:./admin_eventfunc.php');
}

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
    <form action="" method="post">
      <h2>Hey there, <?php echo $admin_id; ?> !</h2>
      

      <p class="text1"> Welcome to the Admin Menu. Please select one of the options below:</p>
	
      
      <div style="text-align:center">
        <button type="submit" name="userreport">User Reports</button>
      </div><br>

      <div style="text-align:center">
        <button type="submit" name="eventreport">Event Reports</button>
      </div><br>

      <div style="text-align:center">
        <button type="submit" name="logout">Log Out</button>
      </div><br>

    </form>
  </div>

</body>
</html>