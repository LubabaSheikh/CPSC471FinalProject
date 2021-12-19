<?php

session_start();

$volSIN = $_SESSION['volsin'];
$role = $_SESSION['role'];
$accountSIN = $_SESSION['accountSin'];
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

$styleStr = "";

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

  $foundFlag = 0;
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
          $foundFlag = 1;
          if($role == 'volunteer'){
              $startDate = $row['start_date'];
              $trainingLevel = $row['training_level'];
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
      $covidquery = "SELECT * FROM covidstatus WHERE person_id = " . $volSIN;
      $covidResult = mysqli_query($con, $covidquery);
      while ($vac = mysqli_fetch_assoc($covidResult)) {
          $covidstat = $vac['vaccine_status'];
          $vaccName = $vac['vaccine_name'];
          $vaccDate = $vac['date'];
      }
      $equipquery = "SELECT * FROM equipment WHERE e_id = " . $equip;
      $equipResult = mysqli_query($con, $equipquery);
      while ($equipRow = mysqli_fetch_assoc($equipResult)) {
          $vest = (int)$equipRow['vest'];
          $mask = (int)$equipRow['mask'];
          $card = (int)$equipRow['keycard'];
      }
    }
 }
 if($foundFlag == 0){
     $styleSTR = 'style="background-color:#d9534f"';
     echo '<script>alert("No volunteer found, please go back and try again.")</script>';
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

    <table class="table table-hover" <?php echo $styleSTR; ?> >
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
      <form name="changeTrain" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Change Training Level</h5>
            <p class="card-text">Update the volunteer's training level:</p>
            <label for="training"><b>Training Level</b></label>
            <input type="text" placeholder="highest level" name="training" required>
            <input type="submit" name="trainBTN" value="Submit"  class="btn btn-warning" >
          </div>
        </div>
    </form>
      <br>
      <form name="giveReward" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Give Reward</h5>
            <p class="card-text">Enter a reward for this volunteer:</p>
            <label for="reward"><b>Reward</b></label>
            <input type="text" placeholder="brithday gift" name="reward" required>
            <input type="submit" name="rewardBTN" value="Submit"  class="btn btn-warning" >
          </div>
        </div>
    </form>
      <br>
      <form name="changeEquip" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Change Volunteer Equipment</h5>
            <p class="card-text">Please select which equipment this volunteer currently owns:</p>
            <fieldset>
                <input type="checkbox" name="maskBTN" id="track" value="Mask" /><label for="Mask"> A Mask</label><br/>
                <input type="checkbox" name="vestBTN" id="event" value="Vest"  /><label for="Vest"> A Vest</label><br/>
                <input type="checkbox" name="cardBTN" id="message" value="Key Card" /><label for="Key Card"> A Key Card</label><br/>
            </fieldset>
            <input type="submit" name="equipBTN" value="Submit"  class="btn btn-warning" >
          </div>
        </div>
    </form>
      <br>
      <form name="udpateCovid" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update Covid Status</h5>
            <p class="card-text">If the volunteer has taken their covid vaccines, please update here</p>
            <label for="covid"><b>Covid Vaccine Name</b></label>
            <input type="text" placeholder="pfizer" name="covid" required>
            <input type="submit" name="covidBTN" value="Submit"  class="btn btn-warning" >
          </div>
        </div>
    </form>
      <br>
      <form name="changePark" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Change Parking</h5>
            <p class="card-text">Give a volunteer, who does not have parking, a spot OR update their existing parking spot:</p>
            <label for="parkNum"><b>Spot #</b></label>
            <input type="text" placeholder="104" name="parkNum" required>
            <label for="parkLoc"><b>Location</b></label>
            <input type="text" placeholder="Women's Clinic" name="parkLoc" required>
            <input type="submit" name="parkBTN" value="Submit" class="btn btn-warning" >
          </div>
        </div>
    </form>
      <br>
    <form name="changePark" action="" method="post" class="col-sm-6">
        <a href="home.php" class="btn btn-success btn-lg" role="button"> </i> Back </a>
    </form>

    <br><br><br>
</section>



<?php

 if(isset($_POST["trainBTN"])) {
     if($role == 'volunteer'){
         if(is_numeric($_POST['training'])){
             $tquery = "UPDATE volunteer SET training_level = ". $_POST['training'] . " WHERE v_id = " . $sin;
             $tResult = mysqli_query($con, $tquery);
         }
         else{
             echo '<script>alert("Enter training level as a number")</script>';
         }
     }
     else if(!($role == 'volunteer')){
         echo '<script>alert("This volunteer has not been trained by the hospital, try updating an internal volunteer.")</script>';
     }
 }

 if(isset($_POST["rewardBTN"])) {
     if(!($role == 'volunteer')){
         echo '<script>alert("This volunteer cannot receive a reward because they are not an internal volunteer.")</script>';
     }
     if($_POST['reward'] != ''){
         $date = date('Y/m/d');
         $comment = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['reward']);
         mysqli_query($con, "INSERT INTO rewards VALUES (NULL, '$volSIN', '$accountSIN', '$comment', 5, '$date', '')")  or die ( mysql_error() );
     }
     else{
         echo '<script>alert("Enter a reward message.")</script>';
     }
 }

 if(isset($_POST["equipBTN"])) {
     if(isset($_POST['maskBTN']) and isset($_POST['vestBTN']) and isset($_POST['cardBTN'])){
         $equery = "UPDATE equipment SET mask = 1, vest = 1, keycard = 1 WHERE e_id = " . $equip;
         $eResult = mysqli_query($con, $equery);
     }
     if(!isset($_POST['maskBTN']) and !isset($_POST['vestBTN']) and !isset($_POST['cardBTN'])){
         $equery = "UPDATE equipment SET mask = 0, vest = 0, keycard = 0 WHERE e_id = " . $equip;
         $eResult = mysqli_query($con, $equery);
     }
     if(!isset($_POST['maskBTN']) and isset($_POST['vestBTN']) and isset($_POST['cardBTN'])){
         $equery = "UPDATE equipment SET mask = 0, vest = 1, keycard = 1 WHERE e_id = " . $equip;
         $eResult = mysqli_query($con, $equery);
     }
     if(isset($_POST['maskBTN']) and !isset($_POST['vestBTN']) and isset($_POST['cardBTN'])){
         $equery = "UPDATE equipment SET mask = 1, vest = 0, keycard = 1 WHERE e_id = " . $equip;
         $eResult = mysqli_query($con, $equery);
     }
     if(isset($_POST['maskBTN']) and isset($_POST['vestBTN']) and !isset($_POST['cardBTN'])){
         $equery = "UPDATE equipment SET mask = 1, vest = 1, keycard = 0 WHERE e_id = " . $equip;
         $eResult = mysqli_query($con, $equery);
     }
     if(!isset($_POST['maskBTN']) and !isset($_POST['vestBTN']) and isset($_POST['cardBTN'])){
         $equery = "UPDATE equipment SET mask = 0, vest = 0, keycard = 1 WHERE e_id = " . $equip;
         $eResult = mysqli_query($con, $equery);
     }
     if(isset($_POST['maskBTN']) and !isset($_POST['vestBTN']) and !isset($_POST['cardBTN'])){
         $equery = "UPDATE equipment SET mask = 1, vest = 0, keycard = 0 WHERE e_id = " . $equip;
         $eResult = mysqli_query($con, $equery);
     }
     if(!isset($_POST['maskBTN']) and isset($_POST['vestBTN']) and !isset($_POST['cardBTN'])){
         $equery = "UPDATE equipment SET mask = 0, vest = 1, keycard = 0 WHERE e_id = " . $equip;
         $eResult = mysqli_query($con, $equery);
     }
 }

 if(isset($_POST["parkBTN"])) {
     if($_POST['parkLoc'] != ''){
         $query = "SELECT * FROM parking WHERE p_id = " . $sin;
         $checkExisting= mysqli_prepare($con,$query);
         mysqli_stmt_execute($checkExisting);
         $result = mysqli_stmt_get_result($checkExisting);
         if (mysqli_num_rows($result)==0){
             if(is_numeric($_POST['parkNum'])){
                 $date = date('Y/m/d');
                 $parkingNumber = $_POST['parkNum'];
                 $loc = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['parkLoc']);
                 mysqli_query($con, "INSERT INTO parking VALUES ('$volSIN', '$parkingNumber', NULL, '$loc', '$date')")  or die ( mysql_error() );
             }
             else{
                 echo '<script>alert("Parking spot must be a number.")</script>';
             }
         }
         else{
             if(is_numeric($_POST['parkNum'])){
                 $loc = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST["parkLoc"]);
                 $pquery = "UPDATE parking SET location_id = ". $_POST['parkNum'] . ", building = '$loc' WHERE p_id = " . $sin;
                 $pResult = mysqli_query($con, ptquery);
             }
             else{
                 echo '<script>alert("Parking spot must be a number.")</script>';
             }
         }
     }
     else{
         echo '<script>alert("Parking location must be provided.")</script>';
     }
 }

 if(isset($_POST["covidBTN"])) {
     $query = "SELECT * FROM covidstatus WHERE person_id = " . $sin;
     $checkExisting= mysqli_prepare($con,$query);
     mysqli_stmt_execute($checkExisting);
     $result = mysqli_stmt_get_result($checkExisting);
     if (mysqli_num_rows($result)==0){
         $date = date('Y/m/d');
         $comment = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['covid']);
         mysqli_query($con, "INSERT INTO covidstatus VALUES ('$volSIN', '$comment', 1, '$date')")  or die ( mysql_error() );
     }
     else{
         $vacdate = date('Y/m/d');
         $comment = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['covid']);
         $tquery = "UPDATE covidstatus SET vaccine_name = '$comment', date = '$vacdate' WHERE person_id = " . $sin;
         $tResult = mysqli_query($con, $tquery);
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
