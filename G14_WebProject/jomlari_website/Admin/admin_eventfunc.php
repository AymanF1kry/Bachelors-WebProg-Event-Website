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
    $query = "SELECT * FROM `event` WHERE CONCAT(`id`, `category`, `quota`)LIKE '%".$valueToSearch."%'";
    $result=mysqli_query($con,$query);
    $searchResult = $result;

    
}elseif(isset($_POST['back'])){
    header('location:./admin_menu.php');

}elseif(isset($_POST['add'])){
    header('location:./admin_addcategory.php');

}elseif(isset($_POST['refresh'])){
    header('location:./admin_eventfunc.php');

}
else
{
    $query = "SELECT * FROM `event`";
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
            <h2>Event Reports</h2>
            <!--<p class="text1">You can search any data or add an event category</p>-->
                <button type="submit" name="back">Go Back</button>
                <input type="text" name="valueToSearch" placeholder="Search....">
                <button type="submit" name="search">Search</button>
                <button type="submit" name="add">Add</button>
                <button type="submit" name="refresh">Refresh</button>
                
    
            <br>
            <table>
                <tr>
                    <th>Event ID</th>
                    <th>Category</th>
                    <th>Quota</th>
                </tr>
                <?php while($row = mysqli_fetch_array($searchResult)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['quota']; ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </form>
    </div>

</body>
</html>