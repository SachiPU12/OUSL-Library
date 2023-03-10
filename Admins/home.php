<?php
  include '../login/dbconnection.php';

  session_start();
  if(!isset($_SESSION['username'])){
    header("Location: index.php");
  }

  $sql = "SELECT * FROM admins";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admins Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/admins.css">
</head>
<body>
  <header><?php include '../login/nav.php'?></header>
  <div class="container"><br>
    <a href="insert.php" class="btn btn-success" id="Butt">Add New Admin</a><br><br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Id</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Gender</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Password</th>
          <th colspan="2"></th>  
        </tr>
      </thead>
      <tbody>
        <?php
          if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
        ?>
              <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['fname'];?></td>
                <td><?php echo $row['lname'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $row['address'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['password'];?></td>
                <td><a href="edit.php?id=<?=$row['id'];?>" class="btn btn-warning">Edit</a></td>
                <td><a href="delete.php?id=<?=$row['id'];?>" class="btn btn-danger">Delete</a></td>
              </tr>
              <?php
            }
          }
          else{
            echo "0 results";
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
