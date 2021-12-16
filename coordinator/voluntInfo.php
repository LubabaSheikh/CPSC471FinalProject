<?php

session_start();

$volSIN = $_SESSION['volsin'];
$role = $_SESSION['role'];
$con = mysqli_connect("localhost", "root", "root", "hospitalvolunteersystem");
if(!$con) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query="SELECT * FROM person";
$result = mysqli_query($con, $query);
$idName = '';
$tableName = '';
$fName = "";
$mInit = "";
$lName = "";
$sin = "";
$gender = "";
$pronouns = "";
$bday = "";
$equip = "";
$mask = "";
$vest = "";
$card = "";
$covidstat = "";
$vaccName = "";
$vaccDate = "";
$company = 'N/A';
$petName = 'N/A';
$petType = 'N/A';
$spirit = 'N/A';
$referal = 'N/A';
$startDate = 'N/A';
$trainingLevel = 'N/A';

if($role != ''){
  if($role == 'volunteer'){
      $idName = 'v_id';
      $tableName = 'volunteer';
  }
  if($role == 'potentialvolunteer'){
      $idName = 'pv_id';
      $tableName = 'potentialvolunteer';
  }
  if($role == 'externalvolunteer'){
      $idName = 'ev_id';
      $tableName = 'externalvolunteer';
  }

  while($person=mysqli_fetch_assoc($result)) {
    if($person['SIN'] == $volSIN) {
      $rolequery = "SELECT * FROM " . $tableName . " WHERE " . $idName . " = " . $person['SIN'];
      $fName = $person['FName'];
      $mInit = $person['Minit'];
      $lName = $person['LName'];
      $sin = $person['SIN'];
      $gender = $person['Gender'];
      $pronouns = $person['Pronouns'];
      $bday = $person['BDate'];
      $equip = $person['Equipment'];
      $roleResult = mysqli_query($con, $rolequery);
          while ($row = mysqli_fetch_assoc($roleResult)) {
              if($role == 'volunteer'){
                  $startDate = $row['start_date'];
                  $trainingLevel = $row['training_year'];
              }
              if($role == 'potentialvolunteer'){
                  $referal = $row['referral'];
              }
              if($role == 'externalvolunteer'){
                  $company = $row['affiliated_company'] . " : " . $row['specialty']; // type plus company?
                  if($row['pet_visit_flag'] == 1){
                      $petName = $row['pet_name'];
                      $petType = $row['pet_type'];
                  }
                  if($row['spirit_flag'] == 1){
                      $spirit = $row['faith'];
                  }
              }
          }
      $covidquery = "SELECT * FROM covidstatus WHERE person_id = " . $person['SIN'];
      $covidResult = mysqli_query($con, $covidquery);
          while ($vac = mysqli_fetch_assoc($covidResult)) {
              $covidstat = $vac['vaccine_status'];
              $vaccName = $vac['vaccine_name'];
              $vaccDate = $vac['date'];
          }
      $equipquery = "SELECT * FROM equipment WHERE e_id = " . $person['equipment'];
      $equipResult = mysqli_query($con, $equipquery);
          while ($equip = mysqli_fetch_assoc($equipResult)) {
              $vest = $equip['vest'];
              $mask = $equip['mask'];
              $card = $equip['keycard'];
          }
    }
 }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Volunteer Search Result</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
<h1>Volunteer Search Result</h1>
<p>here is the volunteer you are looking for:</p>
<hr>

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Volunteer</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">First Name</th>
          <td><?php echo $fName; ?> <?php echo $mInit; ?> <?php echo $lName; ?></td>
        </tr>
        <tr>
          <th scope="row">SIN</th>
          <td><?php echo $sin; ?></td>
        </tr>
        <tr>
          <th scope="row">Personal Information</th>
          <td> gender: <?php echo $gender; ?>   ||   pronouns: <?php echo $pronouns; ?></td>
        </tr>
        <tr>
          <th scope="row">Birth Date</th>
          <td><?php echo $bday; ?></td>
        </tr>
        <tr>
          <th scope="row">Equipment</th>
          <td>ID: <?php echo $equip; ?>   ||   Vest: <?php echo $vest; ?>   ||   Mask: <?php echo $mask; ?>   ||   Key Card: <?php echo $card; ?></td>
        </tr>
        <tr>
          <th scope="row">Covid Status</th>
          <td>Status: <?php echo $covidstat; ?>   ||   Vaccine Name: <?php echo $vaccName; ?>   ||   Vaccine Date: <?php echo $vaccDate; ?></td>
        </tr>
        <tr>
          <th scope="row">Internal Details</th>
          <td> Start Date: <?php echo $startDate; ?>   ||   Training Level: <?php echo $trainingLevel; ?></td>
        </tr>
        <tr>
          <th scope="row">External Details</th>
          <td> Company: <?php echo $company; ?>   ||   Faith: <?php echo $spirit; ?></td>
        </tr>
        <tr>
          <th scope="row">Pet</th>
          <td> Pet Name: <?php echo $petName; ?>   ||   Pet Type: <?php echo $petType; ?></td>
        </tr>
        <tr>
          <th scope="row">Referal Email</th>
          <td> <?php echo $referal; ?></td>
        </tr>
      </tbody>
    </table>

<br> <br>
<h1>Change Volunteer Information</h1>
<hr>

<section id="sign-up">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Change Training Level</h5>
            <p class="card-text">Update the volunteer's training level:</p>
            <label for="training"><b>Training Level</b></label>
            <input type="text" placeholder="highest level" name="training" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Give Reward</h5>
            <p class="card-text">Enter a reward for this volunteer:</p>
            <label for="reward"><b>Reward</b></label>
            <input type="text" placeholder="brithday gift" name="reward" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Change Volunteer Equipment</h5>
            <p class="card-text">Update the volunteer's equipment:</p>
            <label for="equip"><b>Equipment</b></label>
            <input type="text" placeholder="mask" name="equip" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update Covid Status</h5>
            <p class="card-text">If the volunteer has taken their covid vaccines, please update here</p>
            <label for="covid"><b>Covid Status</b></label>
            <input type="text" placeholder="2 doses" name="covid" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Change Parking</h5>
            <p class="card-text">Update the volunteer's parking spot:</p>
            <label for="park"><b>Parking Spot</b></label>
            <input type="text" placeholder="B04" name="park" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>

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
