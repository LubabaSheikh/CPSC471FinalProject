<?php
session_start();

$_SESSION['volsin'] = (int)$_POST['volsin'];
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
    <title>Coordinator Home Page</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
<h1>    Coordinator Home Landing Page</h1>
<p>     Please use the following utilities to manage volunteers and seminars.</p>
<hr>

<section id="coor-home">
    <div class="row">
      <form name="findVoluntForm" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Search for a Volunteer :</h5>
            <p class="card-text">Please search a volunteer by their SIN. You will be redirected to their information page
                through which you can confirm their training level, give rewards, change equipment, update covid status, or assign parking.</p>
            <label for="sin"><b>SIN Number</b></label>
            <input type="text" placeholder="123123123" name="volsin" required>
            <label for="roles"> Role: </label>
                <select id="role" name="role">
                  <option value="none" selected disabled hidden>Select a Role</option>
                  <option value="volunteer">Internal Volunteer</option>
                  <option value="potentialvolunteer">Prospective Volunteer</option>
                  <option value="externalvolunteer">External Volunteer</option>
                </select>
            <input type="submit" name="findVolBTN" value="Find Volunteer"  class="btn btn-warning" >
          </div>
        </div>
    </form>
      <br>
      <form name="manageShiftForm" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Your Shifts!</h5>
            <p class="card-text">As a coordinator, you may view upcoming shifts and assign volunteers to them.</p>
            <a href="../shifts.php" class="btn btn-success">View Shifts</a>
            <a href="#" class="btn btn-warning">Assign Shifts to a Volunteer</a>
        </div>
    </form>
      </div>
      <br>
      <form name="manageSemForm" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Your Seminars!</h5>
            <p class="card-text">Here, you may view your seminars and edit them as well.</p>
            <a href="../seminars.php" class="btn btn-success">View Seminars</a>
            <br>
            <label for="editSem"><b>Seminar ID To Edit</b></label>
            <input type="text" placeholder="012345" name="editSem" required>
            <a href="seminarInfo.php" class="btn btn-warning">Find Seminar & Edit</a>
        </div>
    </form>
      </div>
    </div>
    <br><br><br>
</section>

<?php

 if(isset($_POST["findVolBTN"])) {
      //$volSIN = $_POST['volsin'];
      header('Location: voluntInfo.php');
      exit();
 }

 mysqli_close($link);
 ?>

  <!-- Footer -->
    <footer class="white-section" id="footer">
        <br><br>
        <div class="container-fluid">
        <p>© Copyright 2021 Group 39 CPSC 471 </p>
        </div>
    </footer>


</body>
