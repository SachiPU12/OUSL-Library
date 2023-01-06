<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location: index.php");
  }

  include '../login/dbconnection.php';
  $sql = "SELECT * FROM resources";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Resource Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/resources.css">
</head>
<body>
  <header><?php include '../login/nav.php'?></header>
  <div class="container">
    <br>
    <a href="insert.php" class="btn btn-success" id="Butt">Add New Resource</a>
    <br><br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Resource Id</th>
          <th>Categary</th>
          <th>Name</th>
          <th>Subject</th>
          <th>Price</th>
          <th>ISBN</th>
          <th colspan="2"></th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
        ?>
              <tr>
                <td><?php echo $row['rId'];?></td>
                <td><?php echo $row['categary'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['subject'];?></td>
                <td><?php echo $row['price'];?></td>
                <td><?php echo $row['isbn'];?></td>
                <td><a href="edit.php?id=<?=$row['rId'];?>" class="btn btn-warning">Edit</a></td>
                <td><a href="delete.php?id=<?=$row['rId'];?>" class="btn btn-danger">Delete</a></td>
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
