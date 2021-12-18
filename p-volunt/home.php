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
    <title>Prospective Volunteer Home Page</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
<h1>Prospective Volunteer Home Landing Page</h1>
<p>Please finish your application using the following utilities. In application, you are required to submit one reference email and a background check.</p>
<hr>

<section id="sign-up">
    <div class="row">
      <form name="reference" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add or Update a Reference</h5>
            <p class="card-text">Please submit the email of your referee to our system. You may edit the email after submission.</p>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="abc@email.com" name="email" required>
            <input type="submit" name="referenceBTN" value="Update" class="btn btn-warning" >
          </div>
        </div>
      </form>
      <br>
      <form name="bcheck" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add A Background Check Status</h5>
            <p class="card-text">As an applicant, you are responsible for acquiring your own background check.
                You must bring this document with you at your first interview.
                Please only change the status once you have received a completed background check.</p>
            <label for="bcStatus"><b>Background Check: </b></label>
                <select id="backStatus" name="role">
                  <option value="none" selected disabled hidden>select a status</option>
                  <option value="inProgress">In Progress</option>
                  <option value="comP">Completed</option>
                </select>
            <input type="submit" name="bcheckBTN" value="Update" class="btn btn-success" >
          </div>
        </div>
      </form>
    </div>
    <br><br><br>
</section>

<?php

 if(isset($_POST["referenceBTN"])) {
     $rquery = "UPDATE potentialvolunteer SET referral = ". $_POST['email'] . " WHERE v_id = " . $accountSIN;
     $rResult = mysqli_query($con, $rquery);
 }

 if(isset($_POST["bcheckBTN"])) {
     if($_POST['role'] == 'inProgress'){
         $rquery = "UPDATE potentialvolunteer SET backgroundCheckStatus = 0 WHERE pv_id = " . $accountSIN;
         $rResult = mysqli_query($con, $rquery);
     }
     else{
         $rquery = "UPDATE potentialvolunteer SET backgroundCheckStatus = 1 WHERE pv_id = " . $accountSIN;
         $rResult = mysqli_query($con, $rquery);
     }
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
