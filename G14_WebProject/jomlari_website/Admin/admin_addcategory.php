<?php

@include '../Connection/config.php';

session_start();


$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
  header('location:./admin_login.php');
}

if(isset($_POST['confirm'])){
  $evtcategory=mysqli_real_escape_string($con, $_POST['event-category']);
  $quota=mysqli_real_escape_string($con, $_POST['quota']);

  $selectEvtCategory = "SELECT * FROM `event` WHERE category = '$evtcategory'";

  $checkEvtCategory=mysqli_query($con,$selectEvtCategory);

  if(mysqli_num_rows($checkEvtCategory) > 0){
    $message[] = 'Event Category already existed!';
  }elseif(empty($evtcategory))
  {
    $message[] = 'Event Category must not be empty!';
  }elseif(empty($quota))
  {
    $message[] = 'Quota must not empty!';
  }else
  {
    if(!preg_match('/^[0-9]+$/',$quota)){
      $message[] = 'Quota can contain numbers only!';

    }elseif(!preg_match('/^.{5,50}$/',$evtcategory)){
      $message[] = 'Event Category must be between 5 to 50 characters long!';
    
    }else{
      $insert = "INSERT INTO event(category, quota) VALUES('$evtcategory','$quota')";
      mysqli_query($con,$insert) or die("Failed to insert into database!");
      echo '<script> alert("Event Category successfully added!"); window.location.assign("./admin_eventfunc.php");</script>';
    }
    }
  }

if(isset($_POST['cancel'])){
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

  
  <link rel="stylesheet" href="../Style/admin_style.css">
  
</head>
<body>

  <div class="login-container">
    <h2>Add an Event Category</h2>
	<p class="text1">Fill in the required event details to add an event category</p>
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
      <label for="event-category">Event Category :</label>
      <input type="text" id="event-category" name="event-category" placeholder="Enter an Event Category" ><br>

      <label for="quota">Quota :</label>
      <input type="text" id="quota" name="quota" placeholder="Set a quota limit" ><br>
      
      <div style="text-align:center">
        <button type="submit" name="cancel">Cancel</button>
        <button type="submit" name="confirm">Confirm</button>
      </div>

      

    </form>
  </div>

</body>
</html>