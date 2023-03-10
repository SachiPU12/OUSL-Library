<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location: index.php");
  }

  $alert = "";
  include '../login/dbconnection.php';
  $id = $_GET["id"];

  if (isset($id)) {
    $sqlQuery = "SELECT * FROM staff WHERE staffId = $id";
    $result = mysqli_query($conn, $sqlQuery);
    $row = mysqli_fetch_array($result);
  }

  if (isset($_POST["submit"])) {
    include '../login/dbconnection.php';

    $sql = "DELETE FROM staff WHERE staffId = '$id'";
    if ($conn->query($sql) === TRUE) {
        $alert = '<div class="alert alert-success">Record Delete Successfully</div>';
    }
    else {
        $alert = '<div class="alert alert-danger">Error: '.$sql.'<br>'.$conn->error.'</div>';
    }
    header("refresh:3;url=home.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delete Staff Member</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/staff.css"></script>
</head>

<body>
  <header><?php include '../login/nav.php'?></header>
  <div class="container">
    <h1>Delete Staff Member</h1>
    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10" id="cover">
      <form action="" method="post">
        <div class="form-group">
          <label for="staffId">Staff Id:</label>
          <input type="text" class="form-control" name="staffId" value="<?=$row["staffId"]?>">
        </div>
        <div class="form-group">
          <label for="firstname">First Name:</label>
          <input type="text" class="form-control" name="fname" value="<?=$row["fname"]?>">
        </div>
        <div class="form-group">
          <label for="lastname">Last Name:</label>
          <input type="text" class="form-control" name="lname" value="<?=$row["lname"]?>">
        </div>
        <div class="form-group">
          <label for="gender">Gender:</label>
          <input type="text" class="form-control" name="gender" value="<?=$row["gender"]?>">
        </div>
        <div class="form-group">
          <label for="address">Address:</label>
          <input type="text" class="form-control" name="address" value="<?=$row["address"]?>"></input>
        </div>
        <div class="form-group">
          <label for="depart">Department:</label>
          <input type="text" class="form-control" name="depart" value="<?=$row["depart"]?>"></input>
        </div>
        <div class="form-group">
          <label for="phone">Phone Number:</label>
          <input type="number" class="form-control" name="phone" value="<?=$row["phone"]?>"></input>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" placeholder="Delete email" name="email" value="<?=$row["email"]?>">
        </div>
        
        <input type="submit" class="btn btn-danger" id="Butt" name="submit" value="Delete"><br><br>
        <?php echo $alert; ?>
      </form>
    </div>
  </div>
</body>
</html>
