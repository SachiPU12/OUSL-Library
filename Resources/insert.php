<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location: index.php");
  }

  $alert = "";
  if (isset($_POST["submit"])) {
    include '../login/dbconnection.php';
   
    $sql = "INSERT INTO resources (rId, categary, name, subject, price, isbn) VALUES ('".$_POST["rId"]."','".$_POST["categary"]."','".$_POST["name"]."','".$_POST["subject"]."','".$_POST["price"]."','".$_POST["isbn"]."')";

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
  <title>Insert Resource</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/resources.css"></script>
</head>

<body>
  <header><?php include '../login/nav.php'?></header>
  <div class="container">
    <h1>Insert Resource</h1><br>
    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10" id="cover">
      <form action="" method="post">
        <div class="form-group">
          <label for="id">Resource Id:</label>
          <input type="id" class="form-control" placeholder="Enter Resource Id" name="rId" required>
        </div>
        <div class="form-group">
          <label for="categary">Categary:</label>
          <select class="form-control" name="categary" id="sel1">
            <option></option>
            <option>Books</option>
            <option>Journals</option>
            <option>Course materials</option>
          </select>
        </div>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" placeholder="Enter Name" name="name">
        </div>
        <div class="form-group">
          <label for="subject">Subject:</label>
          <input type="text" class="form-control" placeholder="Enter Subject" name="subject">
        </div>
        <div class="form-group">
          <label for="price">Price:</label>
          <input type="text" class="form-control" placeholder="Enter Price" name="price">
        </div>
        <div class="form-group">
          <label for="isbn">ISBN Number:</label>
          <input type="text" class="form-control" placeholder="Enter ISBN Number" name="isbn">
        </div>

        <input id="Butt" type="submit" class="btn btn-primary" name="submit" value="Submit"><br><br>
        <?php echo $alert; ?>
      </form>
    </div>
  </div>
</body>
</html>
