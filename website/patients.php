<?php
session_start();
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
    <link rel="stylesheet" href="css/styles.css">
    <title>Patients</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

<section id="sign-up">
    <div class="container-fluid">
        <h1>Patients Visitations</h1>
        <p>here are all the patients that have signed up for visitations:</p>
        <hr>
            <table class="table table-hover" style="background-color:#f5ffdc">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Full Name</th>
                  <th scope="col">Gender and Pronouns</th>
                  <th scope="col">Floor and Room</th>
                  <th scope="col">Birth Date</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $result = mysqli_query($con,"SELECT * FROM patient");

                   while($row = mysqli_fetch_array($result))
                    {

                   ?>
                   <tr>
                     <th scope="row">Patient</th>
                     <td><?php echo $row['Fname']; ?> <?php echo $row['Lname']; ?></td>
                     <td><?php echo $row['gender']; ?> || <?php echo $row['pronouns']; ?></td>
                     <td><?php echo $row['floor']; ?> || <?php echo $row['room_number']; ?> </td>
                     <td><?php echo $row['BDate']; ?> </td>
                   </tr>
                  <?php
                  }

                   mysqli_close($con);
                  ?>

              </tbody>
            </table>
    </div>
    <br>
    <form name="holdBack" action="" method="post" class="col-sm-8">
        <a href="javascript:history.back()" class="btn btn-success btn-lg" role="button"> </i> Back </a>
    </form>
</section>

  <!-- Footer -->
    <footer class="white-section" id="footer">
        <br><br>
        <div class="container-fluid">
        <p>© Copyright 2021 Group 39 CPSC 471 </p>
        </div>
    </footer>


</body>
