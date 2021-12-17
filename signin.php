<?php

session_start();
$_SESSION['accountSin'] = (int)$_POST['uname'];

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
    <title>Internal Volunteer Sign Up Page</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>


<section id="sign-in">
    <div class="container-fluid">
        <form name="LoginForm" action="" method="post">
            <h1>Sign In</h1>
            <p>Please enter your account details as specified below:</p>
            <hr>
            <div class="imgcontainer">
            </div>

            <div class="container">
            <label for="uname"><b>SIN Number</b></label>
            <input type="text" placeholder="Enter SIN Number" name="uname" required>

            <label for="psw"><b> Enter Password </b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <label for="roles"> Sign in as:</label>
                <select id="role" name="role">
                  <option value="none" selected disabled hidden>Select a Role</option>
                  <option value="volunteer">Internal Volunteer</option>
                  <option value="potentialvolunteer">Prospective Volunteer</option>
                  <option value="externalvolunteer">External Volunteer</option>
                  <option value="coordinator">Coordinator</option>
                </select>
            <input type="submit" name="btnSubmit" value="Log in">
            </div>
        </form>
    </div>

</section>


    <?php


     $checkType = 0;
     /* checkType flag corresponds to:
     0 - no one
     1 - coordinator
     2 - external volunteer
     3 - internal volunteer
     4 - potential volunteer
     */
     $query="SELECT * FROM person";
     $result = mysqli_query($con, $query);
     $idName = '';
     $tableName = '';


     if(isset($_POST["btnSubmit"])) {
       $checkInPerson = True;
       if($_POST['role'] != ''){
           if($_POST['role'] == 'volunteer'){
               $idName = 'v_id';
               $tableName = 'volunteer';
           }
           if($_POST['role'] == 'coordinator'){
               $idName = 'c_id';
               $tableName = 'coordinator';
           }
           if($_POST['role'] == 'potentialvolunteer'){
               $idName = 'pv_id';
               $tableName = 'potentialvolunteer';
           }
           if($_POST['role'] == 'externalvolunteer'){
               $idName = 'ev_id';
               $tableName = 'externalvolunteer';
           }
       }
       while($person=mysqli_fetch_assoc($result)) {
         if($person['SIN'] == $_POST['uname'] && $person['password'] == $_POST['psw']) {
           $rolequery = "SELECT * FROM " . $tableName . " WHERE " . $idName . " = " . $person['SIN'];
           $checkInPerson == False;
           $roleResult = mysqli_query($con, $rolequery);
               while ($row = mysqli_fetch_assoc($roleResult)) {
                   $checkInPerson == False;
                   if($_POST['role'] == 'volunteer'){
                       header('Location: i-volunt/home.php');
                       exit();
                   }
                   if($_POST['role'] == 'coordinator'){
                       header('Location: coordinator/home.php');
                       exit();
                   }
                   if($_POST['role'] == 'potentialvolunteer'){
                       header('Location: p-volunt/home.php');
                       exit();
                   }
                   if($_POST['role'] == 'externalvolunteer'){
                       header('Location: e-volunt/home.php');
                       exit();
                   }
               }
         }
      }

     echo '<script>alert("Account was not found, try again")</script>';

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
<html>
