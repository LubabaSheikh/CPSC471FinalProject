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
    <title>Upcoming Shifts</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

<section id="sign-up">
    <div class="container-fluid">
        <h1>Volunteering Shifts at the Hospital</h1>
        <p>here are all of the shifts at the hospital:</p>
        <hr>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Shift ID</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                  <th scope="col">Place</th>
                  <th scope="col">Volunteers Assigned</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $result = mysqli_query($con,"SELECT * FROM shift");

                   while($row = mysqli_fetch_array($result)){

                       ?>
                       <tr>
                         <th scope="row">Shift</th>
                         <td><?php echo $row['shift_id']; ?> </td>
                         <td><?php echo $row['date']; ?> </td>
                         <td><?php echo $row['time']; ?> </td>
                         <td><?php echo $row['place']; ?> </td>
                         <td>
                           <?php
                           $findVols = mysqli_query($con,"SELECT * FROM assign WHERE s_id = " . $row['shift_id']);
                           while($vols = mysqli_fetch_array($findVols)){
                           ?>

                           <pre><?php echo $vols['volunteer_id']; ?> </pre>

                           <?php
                           }
                           ?>
                         </td>
                       </tr>

                   <?php
                   }

                  ?>

              </tbody>
            </table>
<section id="sign-up">
        <form name="assignShiftForm" action="" method="post" class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Assign a volunteer to a shift!</h5>
                <p class="card-text">Enter the volunteer's SIN number and the shift ID.</p>
                <label for="volsin"><b>Volunteer SIN Number</b></label>
                <input type="text" placeholder="123123123" name="volsin" required>
                <label for="shiftID"><b>Shift ID</b></label>
                <input type="text" placeholder="1001" name="shiftID" required>
                <input type="submit" name="assignBTN" value="Assign" class="btn btn-warning" >
            </div>
           </div>
        </form>
         <br>
         <form name="makeNewShift" action="" method="post" class="col-sm-12">
             <div class="card">
               <div class="card-body">
                 <h5 class="card-title">Create a new shift!</h5>
                 <p class="card-text">Enter the date, time, place, and number of volunteers requested.</p>
                 <label for="shiftDate"><b>Date</b></label>
                 <input type="text" placeholder="MM/DD/YYYY" name="shiftDate" required>
                 <label for="shiftPlace"><b>Place</b></label>
                 <input type="text" placeholder="Emergency" name="shiftPlace" required>
                 <label for="shiftNum"><b>Number Requested</b></label>
                 <input type="text" placeholder="3" name="shiftNum" required>
                 <form method="post">
                     <fieldset>
                         <p>select a time from the two options</p>
                         <input type="radio" name="time" value="am">10:00:00 (10 am)<br>
                         <input type="radio" name="time" value="pm">17:00:00 (5 pm)<br>
                         <br>
                     </fieldset>
                 </form>
                 <input type="submit" name="newShiftBTN" value="Create New Shift" class="btn btn-warning" >
               </div>
             </div>
         </form>
         <br>
    <form name="holdBack" action="" method="post" class="col-sm-8">
        <a href="home.php" class="btn btn-success btn-lg" role="button"> </i> Back </a>
    </form>

</section>


    <br><br><br>
</section>


<?php
//
// Processing form data when form is submitted
 if(isset($_POST["assignBTN"])) {
    // Validate SIN of volunteer
    if(is_numeric($_POST['volsin']) && is_numeric($_POST['shiftID'])){
        //unset($error);
        $assignVolSIN = $_POST['volsin'];
        $assignShiftID = $_POST['shiftID'];
        $findVolquery = "SELECT * FROM volunteer WHERE v_id = " . $assignVolSIN;
        $findVolResult = mysqli_query($con, $findVolquery);

        $voluntNotFound = true;
        while ($found = mysqli_fetch_assoc($findVolResult)) {
            // check shift ID
            $voluntNotFound = false;
            $shiftquery = "SELECT * FROM shift WHERE shift_id = " . $assignShiftID;
            $checkShift = mysqli_prepare($con,$shiftquery);
            mysqli_stmt_execute($checkShift);
            $getShiftResult = mysqli_stmt_get_result($checkShift);
            if (mysqli_num_rows($getShiftResult) !=0) {
                while ($enter = mysqli_fetch_assoc($getShiftResult)) {
                    // if it doesnt already exist
                    $findPrevious = "SELECT * FROM assign WHERE s_id = " . $assignShiftID ." and volunteer_id = ". $assignVolSIN;
                    $checkPrevious = mysqli_prepare($con,$findPrevious);
                    mysqli_stmt_execute($checkPrevious);
                    $previousResult = mysqli_stmt_get_result($checkPrevious);
                    if(mysqli_num_rows($previousResult) ==0){
                        mysqli_query($con, "INSERT INTO assign VALUES ('$assignShiftID', '$assignVolSIN', '$accountSIN', NULL)")  or die ( mysql_error() );
                    }
                    else{
                        echo '<script>alert("This volunteer has already been assigned to this shift.")</script>';
                    }
                }
             }
             else {
                echo '<script>alert("This shift does not exist. Please try again.")</script>';
             }
        }
        if($voluntNotFound){
            echo '<script>alert("This volunteer does not exist or they are not internal. Please try again.")</script>';
        }
    }
    else{
        echo '<script>alert("Please enter numbers only for shift and volunteer ID.")</script>';
    }
}

 if(isset($_POST["newShiftBTN"])) {
     $place = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['shiftPlace']);
     $idQuery = "SELECT MAX(shift_id) FROM shift";
     $result = mysqli_query($con, $idQuery);
     $lastID = 0;
     $shiftdate = date('Y-m-d',strtotime($_POST['shiftDate']));

     while($row = mysqli_fetch_array($result)){
        $lastID =  $row['MAX(shift_id)'] + 1;
     }

     if(is_numeric($_POST['shiftNum'])){
         $shiftnum = $_POST['shiftNum'];
         if($_POST['time'] == 'am'){
             $findExisting = "SELECT * FROM shift WHERE date = '$shiftdate' and time = '10:00:00' and place = '$place'";
             $checkExisting = mysqli_prepare($con,$findExisting);
             mysqli_stmt_execute($checkExisting);
             $getExisting = mysqli_stmt_get_result($checkExisting);
             $enter = true;
             while ($find = mysqli_fetch_assoc($getExisting)) {
                 $enter = false;
                 echo '<script>alert("This shift already exists in our system")</script>';
             }
             if($enter == true){
                 mysqli_query($con, "INSERT INTO shift VALUES ('$lastID', '$shiftdate', '10:00:00', '$place', '$shiftnum')")  or die ( mysql_error() );
             }
         }
         else if($_POST['time'] == 'pm'){
             $findExisting = "SELECT * FROM shift WHERE date = '$shiftdate' and time = '17:00:00' and place = '$place'";
             $checkExisting = mysqli_prepare($con,$findExisting);
             mysqli_stmt_execute($checkExisting);
             $getExisting = mysqli_stmt_get_result($checkExisting);
             $enter = true;
             while ($find = mysqli_fetch_assoc($getExisting)) {
                 $enter = false;
                 echo '<script>alert("This shift already exists in our system")</script>';
             }
             if($enter == true){
                 mysqli_query($con, "INSERT INTO shift VALUES ('$lastID', '$shiftdate', '17:00:00', '$place', '$shiftnum')")  or die ( mysql_error() );
             }
         }
     }
     else{
         echo '<script>alert("Number of requested volunteers must be numeric.")</script>';
     }

 }



 // mysqli_close($con);
?>


  <!-- Footer -->
    <footer class="white-section" id="footer">
        <br><br>
        <div class="container-fluid">
        <p>© Copyright 2021 Group 39 CPSC 471 </p>
        </div>
    </footer>


</body>
