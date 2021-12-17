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
        <p>here are all of the upcoming seminars that you may edit:</p>
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

                  // mysqli_close($con);
                  ?>

              </tbody>
            </table>
    </div>

    <section id="sign-up">
            <form name="assignShiftForm" action="" method="post" class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Edit A Seminar:</h5>
                    <p class="card-text">Enter the seminar ID number as well as a new name, date and time.</p>
                    <label for="semID"><b>Seminar ID</b></label>
                    <input type="text" placeholder="10" name="semID" required>
                    <label for="newName"><b>New Name</b></label>
                    <input type="text" placeholder="Patient Care" name="newName" required>
                    <label for="newDate"><b>New Date</b></label>
                    <input type="text" placeholder="MM/DD/YYYY" name="newDate" required>
                    <form method="post">
                        <fieldset>
                            <p>select a time from the two options</p>
                            <input type="radio" name="newtime" value="am">10:00:00 (10 am)<br>
                            <input type="radio" name="newtime" value="pm">17:00:00 (5 pm)<br>
                            <br>
                        </fieldset>
                    </form>
                    <input type="submit" name="editBTN" value="Edit Seminar" class="btn btn-warning" >
                </div>
               </div>
            </form>
             <br>
             <form name="makeNewSem" action="" method="post" class="col-sm-12">
                 <div class="card">
                   <div class="card-body">
                     <h5 class="card-title">Submit A New Seminar:</h5>
                     <p class="card-text">Enter the name, date, and time of this new seminar.</p>
                     <label for="semName"><b>Name</b></label>
                     <input type="text" placeholder="Leading spiritual healing during devastating times" name="semName" required>
                     <label for="semDate"><b>Date</b></label>
                     <input type="text" placeholder="MM/DD/YYYY" name="semDate" required>
                     <form method="post">
                         <fieldset>
                             <p>select a time from the two options</p>
                             <input type="radio" name="time" value="am">10:00:00 (10 am)<br>
                             <input type="radio" name="time" value="pm">17:00:00 (5 pm)<br>
                             <br>
                         </fieldset>
                     </form>
                     <input type="submit" name="newSemBTN" value="Create New Seminar" class="btn btn-warning" >
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
 if(isset($_POST["editBTN"])) {
    // Validate ID of seminar
    if(is_numeric($_POST['semID'])){
        //unset($error);
        $newSemID = $_POST['semID'];
        $findSemquery = "SELECT * FROM seminar WHERE seminar_id = " . $newSemID;
        $findSemResult = mysqli_query($con, $findSemquery);

        $semNotFound = true;
        while ($found = mysqli_fetch_assoc($findSemResult)) {
            $semNotFound = false;
            $semName = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['newName']);
            $semdate = date('Y-m-d',strtotime($_POST['newDate']));
             if($_POST['newtime'] == 'am'){
                 $semquery = "UPDATE seminar SET name = '$semName', date = '$semdate', time = '10:00:00' WHERE seminar_id = $accountSIN" . $newSemID;
                 $semResult = mysqli_query($con, $semquery);
             }
             else if($_POST['newtime'] == 'pm'){
                 $semquery = "UPDATE seminar SET name = '$semName', date = '$semdate', time = '17:00:00' WHERE seminar_id = $accountSIN" . $newSemID;
                 $semResult = mysqli_query($con, $semquery);
             }
        }
        if($semNotFound){
            echo '<script>alert("This seminar does not exist in the system. Please try again.")</script>';
        }
    }
    else{
        echo '<script>alert("Please enter numbers only for seminar ID.")</script>';
    }
}

 if(isset($_POST["newSemBTN"])) {
     $name = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['semName']);
     $idQuery = "SELECT MAX(seminar_id) FROM seminar";
     $result = mysqli_query($con, $idQuery);
     $lastID = 0;
     $semdate = date('Y-m-d',strtotime($_POST['semDate']));

     while($row = mysqli_fetch_array($result)){
        $lastID =  $row['MAX(seminar_id)'] + 1;
     }

     if($_POST['time'] == 'am'){
         $findExisting = "SELECT * FROM seminar WHERE date = '$semdate' and time = '10:00:00'";
         $checkExisting = mysqli_prepare($con,$findExisting);
         mysqli_stmt_execute($checkExisting);
         $getExisting = mysqli_stmt_get_result($checkExisting);
         $enter = true;
         while ($find = mysqli_fetch_assoc($getExisting)) {
             $enter = false;
             echo '<script>alert("Another seminar is already set at this time.")</script>';
         }
         if($enter == true){
             mysqli_query($con, "INSERT INTO seminar VALUES ('$lastID','$name','$semdate','10:00:00','$accountSIN')")  or die ( mysql_error() );
         }
     }
     else if($_POST['time'] == 'pm'){
         $findExisting = "SELECT * FROM seminar WHERE date = '$semdate' and time = '17:00:00' and place = '$place'";
         $checkExisting = mysqli_prepare($con,$findExisting);
         mysqli_stmt_execute($checkExisting);
         $getExisting = mysqli_stmt_get_result($checkExisting);
         $enter = true;
         while ($find = mysqli_fetch_assoc($getExisting)) {
             $enter = false;
             echo '<script>alert("Another seminar is already set at this time.")</script>';
         }
         if($enter == true){
             mysqli_query($con, "INSERT INTO seminar VALUES ('$lastID','$name','$semdate','17:00:00','$accountSIN')")  or die ( mysql_error() );
         }
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
