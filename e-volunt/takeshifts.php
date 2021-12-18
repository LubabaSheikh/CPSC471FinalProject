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
        <h1>Shifts at the Hospital For External Volunteers</h1>
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
                  <th scope="col">Assigned</th>
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
                           <?php
                           $findVols = mysqli_query($con,"SELECT * FROM assign WHERE s_id = " . $row['shift_id']);
                           $assigned = false;
                           while($vols = mysqli_fetch_array($findVols)){
                               if($accountSIN == $vols['volunteer_id']){
                                   $assigned = true;
                               }
                          }
                          if($assigned){
                              ?>
                              <td><?php echo "Assigned!"; ?> </td>
                          <?php
                          }
                          else{
                              ?>
                              <td><?php echo "not assigned to this shift"; ?> </td>
                          <?php
                          }
                          ?>
                       </tr>

                   <?php
                   }
                   ?>

              </tbody>
            </table>
<section id="sign-up">
        <form name="takeShiftForm" action="" method="post" class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Pick up a shift!</h5>
                <p class="card-text">Enter the shift ID you want to take.</p>
                <label for="shiftID"><b>Shift ID</b></label>
                <input type="text" placeholder="1001" name="shiftID" required>
                <input type="submit" name="takeBTN" value="Sign Up" class="btn btn-warning" >
            </div>
           </div>
        </form>
         <br>
         <form name="deRegShiftForm" action="" method="post" class="col-sm-6">
             <div class="card">
               <div class="card-body">
                 <h5 class="card-title">De-register for a shift</h5>
                 <p class="card-text">Enter the shift ID are unable to attend. Be sure to notify your coordinator about this change as there may be consequences.</p>
                 <label for="deShift"><b>Shift ID</b></label>
                 <input type="text" placeholder="1001" name="deShift" required>
                 <input type="submit" name="deRegBTN" value="De-Register" class="btn btn-warning" >
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
 if(isset($_POST["takeBTN"])) {
    // Validate SIN of volunteer
    if(is_numeric($_POST['shiftID'])){
        //unset($error);
        // check shift ID
        $assignShiftID = $_POST['shiftID'];
        $shiftquery = "SELECT * FROM shift WHERE shift_id = " . $assignShiftID;
        $checkShift = mysqli_prepare($con,$shiftquery);
        mysqli_stmt_execute($checkShift);
        $getShiftResult = mysqli_stmt_get_result($checkShift);
        if (mysqli_num_rows($getShiftResult) !=0) {
            while ($enter = mysqli_fetch_assoc($getShiftResult)) {
                // if it doesnt already exist
                $findPrevious = "SELECT * FROM assign WHERE s_id = " . $assignShiftID ." and volunteer_id = ". $accountSIN;
                $checkPrevious = mysqli_prepare($con,$findPrevious);
                mysqli_stmt_execute($checkPrevious);
                $previousResult = mysqli_stmt_get_result($checkPrevious);
                if(mysqli_num_rows($previousResult) ==0){
                    mysqli_query($con, "INSERT INTO assign VALUES ('$assignShiftID', '$accountSIN', '123123123', NULL)")  or die ( mysql_error() );
                }
                else{
                    echo '<script>alert("You have already been assigned to this shift.")</script>';
                }
            }
         }
         else {
            echo '<script>alert("This shift does not exist. Please try again.")</script>';
         }
    }
    else{
        echo '<script>alert("Please enter numbers only for shift ID.")</script>';
    }
}

if(isset($_POST["deRegBTN"])) {
   // Validate SIN of volunteer
   if(is_numeric($_POST['deShift'])){
       //unset($error);
       // check shift ID
       $deShiftID = $_POST['deShift'];
       $shiftquery = "SELECT * FROM shift WHERE shift_id = " . $deShiftID;
       $checkShift = mysqli_prepare($con,$shiftquery);
       mysqli_stmt_execute($checkShift);
       $getShiftResult = mysqli_stmt_get_result($checkShift);
       if (mysqli_num_rows($getShiftResult) !=0) {
           while ($enter = mysqli_fetch_assoc($getShiftResult)) {
               // if it doesnt already exist
               $findPrevious = "SELECT * FROM assign WHERE s_id = " . $deShiftID ." and volunteer_id = ". $accountSIN;
               $checkPrevious = mysqli_prepare($con,$findPrevious);
               mysqli_stmt_execute($checkPrevious);
               $previousResult = mysqli_stmt_get_result($checkPrevious);
               if(mysqli_num_rows($previousResult) ==0){
                   echo '<script>alert("You have not been assigned to this shift.")</script>';
               }
               else{
                   $semquery = "DELETE FROM assign WHERE s_id =" .$deShiftID ." and volunteer_id = " . $accountSIN;
                   $semResult = mysqli_query($con, $semquery);
               }
           }
        }
        else {
           echo '<script>alert("This shift does not exist. Please try again.")</script>';
        }
   }
   else{
       echo '<script>alert("Please enter numbers only for shift ID.")</script>';
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
