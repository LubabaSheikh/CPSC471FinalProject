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
        <p>here are all of the seminars that you may attend:</p>
        <hr>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Seminar ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                  <th scope="col">Status</th>
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
                     <?php
                         $findVols = mysqli_query($con,"SELECT * FROM attends WHERE sem_id = " . $row['seminar_id']);
                         $attending = false;
                         while($vols = mysqli_fetch_array($findVols)){
                             if($accountSIN == $vols['vol_id']){
                                 $attending = true;
                             }
                        }
                        if($attending){
                            ?>
                            <td><?php echo "attending!"; ?> </td>
                        <?php
                        }
                        else{
                            ?>
                            <td><?php echo "not signed up for this seminar"; ?> </td>
                        <?php
                        }
                        ?>
                     </tr>
                  <?php
                  }

                  // mysqli_close($con);
                  ?>

              </tbody>
            </table>
    </div>

    <section id="sign-up">
            <form name="registerForm" action="" method="post" class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Register for a Seminar:</h5>
                    <p class="card-text">Enter the seminar ID that you would like to attend</p>
                    <label for="signSem"><b>Seminar ID</b></label>
                    <input type="text" placeholder="10" name="signSem" required>
                    <input type="submit" name="signupSem" value="Register" class="btn btn-warning" >
                </div>
               </div>
            </form>
            <br>
             <form name="deregisterForm" action="" method="post" class="col-sm-6">
                 <div class="card">
                   <div class="card-body">
                     <h5 class="card-title">De-Register for a Seminar:</h5>
                     <p class="card-text">Enter the seminar ID that you do not wish to attend.</p>
                     <label for="deSem"><b>Seminar ID</b></label>
                     <input type="text" placeholder="10" name="deSem" required>
                     <input type="submit" name="deRegSem" value="De-Register" class="btn btn-warning" >
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
 if(isset($_POST["signupSem"])) {
    // Validate ID of seminar
    if(is_numeric($_POST['signSem'])){
        //unset($error);
        $newSemID = $_POST['signSem'];
        $findSemquery = "SELECT * FROM seminar WHERE seminar_id = " . $newSemID;
        $findSemResult = mysqli_query($con, $findSemquery);

        $semNotFound = true;
        while ($found = mysqli_fetch_assoc($findSemResult)) {
            $semNotFound = false;
            mysqli_query($con, "INSERT INTO attends VALUES ('$newSemID', '$accountSIN')")  or die ( mysql_error() );
        }
        if($semNotFound){
            echo '<script>alert("This seminar does not exist in the system. Please try again.")</script>';
        }
    }
    else{
        echo '<script>alert("Please enter numbers only for seminar ID.")</script>';
    }
}

if(isset($_POST["deRegSem"])) {
   // Validate ID of seminar
   if(is_numeric($_POST['deSem'])){
       //unset($error);
       $newSemID = $_POST['deSem'];
       $findSemquery = "SELECT * FROM seminar WHERE seminar_id = " . $newSemID;
       $findSemResult = mysqli_query($con, $findSemquery);

       $semNotFound = true;
       while ($found = mysqli_fetch_assoc($findSemResult)) {
           $semNotFound = false;
           $semquery = "DELETE FROM attends WHERE sem_id = '$newSemID', vol_id = '$accountSIN'";
           $semResult = mysqli_query($con, $semquery);
       }
       if($semNotFound){
           echo '<script>alert("This seminar does not exist in the system. Please try again.")</script>';
       }
   }
   else{
       echo '<script>alert("Please enter numbers only for seminar ID.")</script>';
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
