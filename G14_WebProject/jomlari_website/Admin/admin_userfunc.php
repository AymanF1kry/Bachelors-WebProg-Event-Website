<?php

@include '../Connection/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
  header('location:./admin_login.php');
}

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM `user` WHERE CONCAT(`id`, `username`, `fullname`, `email`, `phonenum`, `category`, `password`)LIKE '%".$valueToSearch."%'";
    $result=mysqli_query($con,$query);
    $searchResult = $result;


}elseif(isset($_POST['back'])){
    header('location:./admin_menu.php');

}elseif(isset($_POST['refresh'])){
    header('location:./admin_userfunc.php');

}elseif(isset($_POST['delete'])){
    $user_id = $_POST['user_id'];
    $delete = "DELETE FROM user WHERE id='$user_id'";
    $result = mysqli_query($con, $delete);
    if($result){
        echo '<script> alert("User successfully deleted!"); window.location.assign("./admin_userfunc.php");</script>';
    }
}
else
{
    $query = "SELECT * FROM `user`";
    $result=mysqli_query($con,$query);
    $searchResult = $result;
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
    
    <div class="table-container">
        <form action="" method="post">
            <h2>User Reports</h2>
            <!--<p class="text1">You can view, search any data or delete a registered participant</p>-->
                <button type="submit" name="back">Go Back</button>
                <input type="text" name="valueToSearch" placeholder="Search....">
                <button type="submit" name="search">Search</button>
                <button type="submit" name="refresh">Refresh</button>
                
    
            <br>
            <table>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
                <?php while($row = mysqli_fetch_array($searchResult)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phonenum']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <td><button type="submit" name="delete">Delete</button></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </form>
    </div>

</body>
</html>