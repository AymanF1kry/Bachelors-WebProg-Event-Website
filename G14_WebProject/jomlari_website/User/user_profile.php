<?php
    @include '../Connection/config.php';

    session_start();
    
    $username = $_SESSION['user_name'];
    if(!isset($username)){
        header('location:./user_login.php');
    }else{
        $select = "SELECT * FROM `user` WHERE username = '$username'";
        $query = "SELECT * FROM `event`";
        $resultUser= mysqli_query($con, $select);
        $resultEvent=mysqli_query($con,$query);
        if(mysqli_num_rows($resultUser) > 0){
            $fetch = mysqli_fetch_assoc($resultUser);
        } 
    }


    if(isset($_POST['updateprofile'])){
        $oldfullname = $fetch['fullname'];
        $oldemail = $fetch['email'];
        $oldphonenum = $fetch['phonenum'];
        $oldcategory = $fetch['category'];
        $fullname=mysqli_real_escape_string($con, $_POST['fullname']);
        $email=mysqli_real_escape_string($con, $_POST['email']);
        $phonenum=mysqli_real_escape_string($con, $_POST['phonenum']);
        $category=mysqli_real_escape_string($con, $_POST['category']);
        $password=mysqli_real_escape_string($con, $_POST['password']);

        $sqlQuota = "SELECT * FROM `event` WHERE category = '$category'";
        $selectCategory = "SELECT * FROM `user` WHERE category = '$category'";
        $selectFullname = "SELECT * FROM user WHERE fullname = '$fullname' except SELECT * FROM user WHERE fullname = '$oldfullname' ";
        $selectEmail = "SELECT * FROM user WHERE email = '$email' except SELECT * FROM user WHERE email = '$oldemail'";
        $selectPhonenum = "SELECT * FROM user WHERE phonenum = '$phonenum' except SELECT * FROM user WHERE phonenum = '$oldphonenum' ";

        $checkFullname=mysqli_query($con,$selectFullname);
        $checkEmail=mysqli_query($con,$selectEmail);
        $checkPhonenum=mysqli_query($con,$selectPhonenum);
        $checkCategory = mysqli_query($con, $selectCategory);
        $checkQuota = mysqli_query($con, $sqlQuota);
        $fetchQuota = mysqli_fetch_assoc($checkQuota);

        if(mysqli_num_rows($checkCategory) == $fetchQuota['quota'] && $category != $oldcategory){
            $message[] = "The Category's Quota is full!";

        }elseif(mysqli_num_rows($checkFullname) > 0)
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
        }else{
            if(!preg_match('/^[a-zA-Z ]+$/',$fullname)){
                $message[] = 'Fullname can contain letters only!';
          
              }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $message[] = 'Email is invalid!';
          
              }elseif(!preg_match('/^[0-9]+$/',$phonenum)){
                $message[] = 'Phone number can contain numbers only!';
          
              }elseif(!preg_match('/^.{10,11}$/',$phonenum)){
                $message[] = 'Phone number must be between 10 to 11 numbers only!';
          
              }elseif(!preg_match('/^.{5,30}$/',$password)){
                $message[] = 'Passwords must be between 5 to 30 characters long!';

              }else{
                $update = "UPDATE `user` SET fullname = '$fullname', email = '$email', phonenum ='$phonenum', category = '$category', password = '$password' WHERE username = '$username'";
                mysqli_query($con, $update ) or die('Failed to update into database!');
                echo '<script> alert("Your profile has succesfully updated!"); window.location.assign("./user_profile.php");</script>';
              }
        }

        

    }


    if(isset($_POST['goback'])){
        header('location:./user_menu.php');
    }




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

    <h2>Your Profile Page</h2>

    <p class="text1">You can update any information in this page other than your username</p>

    <form id="registrationForm" method="post"> 
      <?php
      if(isset($message)){
        foreach($message as $message){
          echo '<span class="text-msg">'.$message.'</span>';
        };
      };
      ?>
      
      <label for="username">Username :</label>
      <input type="text" id="username" name="username" value="<?php echo $username?>" readonly><br>

      <label for="full-name">Full Name :</label>
      <input type="text" id="full-name" name="fullname" value="<?php echo $fetch['fullname']?>" ><br>
	  
      <label for="email">Email :</label>
      <input type="text" id="email" name="email" value="<?php echo $fetch['email']?>" ><br>

      <label for="phone-number">Phone Number :</label>
      <input type="text" id="phone-number" name="phonenum" value="<?php echo $fetch['phonenum']?>" ><br>

      <label for="event_category">Event Category :</label>
      <select name="category" class="dropdown-styling">
        <option value="<?php echo $fetch['category']?>"><?php echo $fetch['category']?></option>
        <?php while($row = mysqli_fetch_array($resultEvent)): 
           if($row['category']==$fetch['category']){continue;} ?>
        <option value="<?php echo $row['category'];?>"><?php echo $row['category'];?></option>
        <?php endwhile; ?>
      </select>

    
      <label for="password">Password :</label>
      <input type="password" id="password" name="password" value="<?php echo $fetch['password']?>" >
      <br>
        

      <div style="text-align:center">
        <button type="submit" name="goback">Go Back</button>
        <button type="submit" name="updateprofile">Update Profile</button>
      </div>


    </form>

  </div>
  
</body>
</html>