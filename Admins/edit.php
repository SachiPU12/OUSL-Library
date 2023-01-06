<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location: index.php");
  }

  $alert = "";
  include '../login/dbconnection.php';
  $id=$_GET["id"];
  
  if (isset($id)) {
    $sqlQuery = "SELECT * FROM admins WHERE id = $id";
    $result =mysqli_query($conn, $sqlQuery);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  }

  if (isset($_POST["submit"])) {
    include '../login/dbconnection.php';

    $fname = $_POST ['fname'];
    $lname = $_POST ['lname'];
    $gender = $_POST ['gender'];
    $address = $_POST ['address'];
    $phone = $_POST ['phone'];
    $email = $_POST ['email'];
    $password = $_POST ['password'];

    $sql ="UPDATE admins SET fname = '$fname', lname = '$lname', gender = '$gender', address = '$address', phone = '$phone', email = '$email', password = '$password' WHERE id = '$id'";


    if ($conn->query($sql) === TRUE) {
        $alert = '<div class="alert alert-success">Update successfully</div>';
    }
    else {
        $alert = '<div class="alert alert-danger">Error: '.$sql .'<br>'.$conn->error.'</div>';
    }
    header("refresh:3;url=home.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/admins.css"></script>
</head>
<body>
  <header><?php include '../login/nav.php'?></header>
  <div class="container">
    <h1>Update Admin</h1>
    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10" id="cover">
      <form action="" method="post">
        <div class="form-group">
          <label for="id">Admin Id:</label>
          <input type="text" class="form-control" name="id" value="<?=$row["id"]?>" readonly>
        </div>
        <div class="form-group">
          <label for="fname">First Name:</label>
          <input type="text" class="form-control" name="fname" value="<?=$row["fname"]?>">
        </div>
        <div class="form-group">
          <label for="lname">Last Name:</label>
          <input type="text" class="form-control" name="lname" value="<?=$row["lname"]?>">
        </div>
        <div class="form-group">
          <label for="gender">Gender:</label>
          <input type="text" class="form-control" name="gender" value="<?=$row["gender"]?>">
        </div>
        <div class="form-group">
          <label for="address">Address:</label>
          <input type="text" class="form-control" name="address" value="<?=$row["address"]?>">
        </div>
        <div class="form-group">
          <label for="phone">Phone Number:</label>
          <input type="text" class="form-control" name="phone" value="<?=$row["phone"]?>">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" placeholder="Enter email" name="email" value="<?=$row["email"]?>">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="text" class="form-control" placeholder="Enter password" name="password" value="<?=$row["password"]?>">
        </div>
        <input type="submit" class="btn btn-warning" id="Butt" name="submit" value="Update"><br><br>
        <?php echo $alert; ?>
      </form>
    </div>
  </div>
</body>
</html>
