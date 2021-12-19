<?php
session_start();
$accountSIN = $_SESSION['accountSin'];
$accountROLE = $_SESSION['accountRole'];
$con = mysqli_connect("localhost", "root", "root", "hospitalvolunteersystem");

if(!$con) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$query="SELECT * FROM person";
$result = mysqli_query($con, $query);

$fName = "";
$mInit = "";
$lName = "";
$gender = "";
$pronouns = "";
$bday = "";
$equip = "";
$startDate = 'N/A';
$trainingLevel = 'N/A';

$foundFlag = 0;
while($person=mysqli_fetch_assoc($result)) {
    if($person['SIN'] == $accountSIN) {
        $rolequery = "SELECT * FROM volunteer WHERE v_id = " . $accountSIN;
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
            $startDate = $row['start_date'];
            $trainingLevel = $row['training_year'];
        }
    }
}
// $company = 'N/A';
// $petName = 'N/A';
// $petType = 'N/A';
// $spirit = 'N/A';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Internal Volunteer Home Page</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
<h1>Volunteer Home Landing Page</h1>
<p>Please use this page to sign up for shifts, write reflections, and edit personal information</p>
<hr>

<section id="sign-up">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Your Shifts and Seminars!</h5>
            <p class="card-text">As a volunteer, you may view upcoming shifts or seminars and assign/register yourself to them.</p>
            <a href="takeshifts.php" class="btn btn-success">View Shifts and Sign Up</a>
            <a href="takeseminars.php" class="btn btn-success">View Seminars and Sign Up</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">View Patients for Visitations</h5>
            <p class="card-text">You may view patients and their rooms prior to attending visitations.</p>
            <a href="../patients.php" class="btn btn-success">View Patients</a>
          </div>
        </div>
      </div>
      <br>
      <form name="makeNewSem" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Personal Information</h5>
            <table class="table table-hover" <?php echo $styleSTR; ?> >
              <thead>
                <tr>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Name</th>
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
                  <td>ID: <?php echo $equip; ?></td>
                </tr>
                <tr>
                  <th scope="row">Volunteering Details</th>
                  <td> Start Date: <?php echo $startDate; ?>   ||   Training Level: <?php echo $trainingLevel; ?></td>
                </tr>
              </tbody>
            </table>
            <p class="card-text">You may edit your first name, gender, or pronouns using the form below:</p>
            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="First" name="fname" required>
            <label for="gender"><b>Gender</b></label>
            <input type="text" placeholder="N/A" name="gender" required>
            <label for="pronouns"><b>Pronouns</b></label>
            <input type="text" placeholder="they/them" name="pronouns" required>
            <input type="submit" name="info" value="Submit" class="btn btn-warning" >
          </div>
        </div>
    </form>
      <form name="makeNewSem" action="" method="post" class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage your Reflections!</h5>
            <p class="card-text">Submit a reflection below</p>
            <label for="reflection"><b>Reflection</b></label>
            <input type="text" style="width:0.8; height:0.8;" placeholder="Today, I learned that..." name="reflection" required>
            <br>
            <input type="submit" name="reflec" value="Submit" class="btn btn-warning" >
            <a href="reflections.php" class="btn btn-success">View Previous Reflections</a>
          </div>
        </div>
      </form>
      <br>
    </div>
    <br><br><br>
</section>

<?php
if(isset($_POST["reflec"])) {
   // Validate ID of seminar
   $reflect = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['reflection']);
   $date = date('Y/m/d');
   mysqli_query($con, "INSERT INTO reflections VALUES (NULL, '$accountSIN','$date','$reflect')")  or die ( mysql_error() );

}

if(isset($_POST["info"])){
    $newName = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['fname']);
    $newGen = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['gender']);
    $newPro = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['pronouns']);
    $newQuery = "UPDATE person SET FName = '$newName', Gender = '$newGen', Pronouns = '$newPro' WHERE SIN = " . $accountSIN;
    $result = mysqli_query($con, $newQuery);
}
?>

  <!-- Footer -->
    <footer class="white-section" id="footer">
        <br><br>
        <div class="container-fluid">
        <p>© Copyright 2021 Group 39 CPSC 471 </p>
        </div>
    </footer>


</body>
