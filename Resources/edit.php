<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location: index.php");
  }

  $alert = "";
  include '../login/dbconnection.php';
  $id=$_GET["id"];
  
  if (isset($id)) {
    $sqlQuery = "SELECT * FROM resources WHERE rId = $id";
    $result =mysqli_query($conn, $sqlQuery);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  }

  if (isset($_POST["submit"])) {
    include '../login/dbconnection.php';

    $categary = $_POST ['categary'];
    $name = $_POST ['name'];
    $subject = $_POST ['subject'];
    $price = $_POST ['price'];
    $isbn = $_POST ['isbn'];

    $sql ="UPDATE resources SET categary = '$categary', name = '$name', subject = '$subject', price = '$price', isbn = '$isbn' WHERE rId = '$id'";


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
  <title>Update Resource</title>
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
    <h1>Update Resource</h1>
    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10" id="cover">
      <form action="" method="post">
        <div class="form-group">
          <label for="categary">Categary:</label>
          <select class="form-control" name="categary" value="<?=$row["categary"]?>" id="sel1">
            <option></option>
            <option>Books</option>
            <option>Journals</option>
            <option>Course materials</option>
          </select>
        </div>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" value="<?=$row["name"]?>">
        </div>
        <div class="form-group">
          <label for="subject">Subject:</label>
          <input type="text" class="form-control" name="subject" value="<?=$row["subject"]?>">
        </div>
        <div class="form-group">
          <label for="price">Price:</label>
          <input type="text" class="form-control" name="price" value="<?=$row["price"]?>">
        </div>
        <div class="form-group">
          <label for="isbn">ISBN Number:</label>
          <input type="text" class="form-control" name="isbn" value="<?=$row["price"]?>">
        </div>
        
        <input type="submit" class="btn btn-warning" id="Butt" name="submit" value="Update"><br><br>
        <?php echo $alert; ?>
      </form>
    </div>
  </div>
</body>
</html>
