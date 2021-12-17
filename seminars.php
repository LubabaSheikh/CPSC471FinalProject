<?php
session_start();

$_SESSION['kind'] = (int)$_POST['volsin'];
$_SESSION['role'] = (string)$_POST['role'];
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
    <title>Upcoming Seminars</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

<section id="sign-up">
    <div class="container-fluid">
        <h1>Seminars Held at the Hospital</h1>
        <p>here are all of the upcoming seminars that you may attend:</p>
        <hr>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Seminar ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $result = mysqli_query($con,"SELECT * FROM seminar");

                   while($row = mysqli_fetch_array($result))
                    {

                   ?>
                   <tr>
                     <th scope="row">Seminar</th>
                     <td><?php echo $row['seminar_id']; ?> </td>
                     <td><?php echo $row['name']; ?> </td>
                     <td><?php echo $row['date']; ?> </td>
                     <td><?php echo $row['time']; ?> </td>
                   </tr>
                  <?php
                  }

                  mysqli_close($con);
                  ?>

              </tbody>
            </table>

    <a href="javascript:history.back()" class="btn btn-success btn-lg" role="button"> </i> Back </a>
    </div>

    <br><br><br>
</section>

  <!-- Footer -->
    <footer class="white-section" id="footer">
        <br><br>
        <div class="container-fluid">
        <p>© Copyright 2021 Group 39 CPSC 471 </p>
        </div>
    </footer>


</body>
