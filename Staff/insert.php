<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location: index.php");
  }

  $alert = "";
  if (isset($_POST["submit"])) {
    include '../login/dbconnection.php';
   
    $sql = "INSERT INTO staff (staffId, fname, lname, gender, address, depart, phone, email) VALUES ('".$_POST["staffId"]."','".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["gender"]."','".$_POST["address"]."','".$_POST["depart"]."','".$_POST["phone"]."','".$_POST["email"]."')";

    if ($conn->query($sql) === TRUE) {
        $alert = '<div class="alert alert-success">New record created successfully</div>';
    }
    else {
        $alert = '<div class="alert alert-success">Error: '.$sql.'<br>'.$conn->error.'</div>';
    }
    header("refresh:3;url=home.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Insert Staff Member</title>
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
    <h1>Insert Staff Member</h1><br>
    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10" id="cover">
      <form action="" method="post">
        <div class="form-group">
          <label for="id">Staff Id:</label>
          <input type="id" class="form-control" placeholder="Enter Id" name="staffId" required>
        </div>
        <div class="form-group">
          <label for="firstname">First Name:</label>
          <input type="text" class="form-control" placeholder="Enter First Name" name="firstname">
        </div>
        <div class="form-group">
          <label for="lastname">Last Name:</label>
          <input type="text" class="form-control" placeholder="Enter Last Name" name="lastname">
        </div>
        <div class="form-group">
          <label for="gender">Gender:</label>
          <input type="text" class="form-control" placeholder="Enter Gender" name="gender">
        </div>
        <div class="form-group">
          <label for="address">Address:</label>
          <textarea type="text" class="form-control" placeholder="Enter Address" name="address"></textarea>
        </div>
        <div class="form-group">
          <label for="depart">Department:</label>
          <input type="text" class="form-control" placeholder="Enter Department" name="depart"></input>
        </div>
        <div class="form-group">
          <label for="phone">Phone Number:</label>
          <input type="number" class="form-control" placeholder="Enter Phone Number" name="phone"></input>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" placeholder="Enter email" name="email">
        </div>

        <input id="Butt" type="submit" class="btn btn-primary" name="submit" value="Submit"><br><br>
        <?php echo $alert; ?>
      </form>
    </div>
  </div>
</body>
</html>
