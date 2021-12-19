<?php
session_start();

$accountSIN = $_SESSION['accountSin'];
$con = mysqli_connect("localhost", "root", "root", "hospitalvolunteersystem");

if(!$con) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Previous Reflections</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

<section id="sign-up">
    <div class="container-fluid">
        <h1>Previously-Submitted Reflections</h1>
        <p>here are all of the things you have learned as a volunteer at the hospital:</p>
        <hr>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Entry</th>
                  <th scope="col">Date</th>
                  <th scope="col">Comments</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $result = mysqli_query($con,"SELECT * FROM reflections WHERE volun_id = $accountSIN");

                   while($row = mysqli_fetch_array($result))
                    {

                   ?>
                   <tr>
                     <th scope="row"></th>
                     <td><?php echo $row['entry']; ?> </td>
                     <td><?php echo $row['date']; ?> </td>
                     <td><?php echo $row['comments']; ?> </td>
                   </tr>
                  <?php
                  }

                   mysqli_close($con);
                  ?>

              </tbody>
            </table>
            <br>
            <form name="holdBack" action="" method="post" class="col-sm-8">
                <a href="home.php" class="btn btn-success btn-lg" role="button"> </i> Back </a>
            </form>
    </div>

  <!-- Footer -->
    <footer class="white-section" id="footer">
        <br><br>
        <div class="container-fluid">
        <p>© Copyright 2021 Group 39 CPSC 471 </p>
        </div>
    </footer>


</body>
