<?php
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
    <title>Coordinator Sign Up Page</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>


<section id="sign-up">
    <div class="container-fluid">
        <form name="Signup" action="" method="post">
          <div class="container">
            <h1>Coordinator Sign Up Page</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="First" name="fname" required>
            <br>
            <label for="minit"><b>Middle Initial</b></label>
            <input type="text" placeholder="N/A" name="minit" required>
            <br>
            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="Last" name="lname" required>
            <br>
            <label for="sinNum"><b>SIN</b></label>
            <input type="text" placeholder="Enter SIN" name="sinNum" required>
            <br>
            <label for="gender"><b>Gender</b></label>
            <input type="text" placeholder="N/A" name="gender" required>
            <br>
            <label for="pronouns"><b>Pronouns</b></label>
            <input type="text" placeholder="they/them" name="pronouns" required>
            <br>
            <label for="Bday"><b>Birth Date</b></label>
            <input type="text" placeholder="MM/DD/YY" name="Bday" required>
            <br>
            <label for="Salary"><b>Salary</b></label>
            <input type="text" placeholder="" name="Salary" required>
            <br>

            <label for="psw"><b>Enter your password</b></label>
            <input type="password" placeholder="Password" name="psw" required>

            <div class="clearfix">
              <a href="../index.php" class="btn btn-warning btn-sm" role="button"> </i> Back </a>
              <input type="submit" name="signupbtn" value="Sign up">
            </div>
          </div>
        </form>
    </div>
    <br><br><br>
</section>

<?php
//
// Processing form data when form is submitted
 if(isset($_POST["signupbtn"])) {
    // Validate username

    //unset($error);
    $username = $_POST["sinNum"];
    $password = $_POST["psw"];
    $fName = $_POST["fname"];
    $mInit = $_POST["minit"];
    $lName = $_POST["lname"];
    $gender = $_POST["gender"];
    $pronouns = $_POST["pronouns"];
    $salary = $_POST["Salary"];
    $bday = date('Y-m-d',strtotime($_POST['Bday']));

    $query = "SELECT * FROM person WHERE SIN = " . $username;
    $checkSIN = mysqli_prepare($con,$query);
    mysqli_stmt_execute($checkSIN);
    $getResult = mysqli_stmt_get_result($checkSIN);

    while ($row = mysqli_fetch_assoc($getResult)) {
        echo '<script>alert("This SIN already exists in our system")</script>';
    }


    if(empty($username_err) && empty($password_err)){
        mysqli_query($con, "INSERT INTO person VALUES ('$username', '$password', '$fName', '$mInit', '$lName', '$bday', '$gender', '$pronouns', '0', '0')")  or die ( mysql_error() );
        mysqli_query($con, "INSERT INTO coordinator VALUES ('$username', '$salary')")  or die ( mysql_error() );
    }
    mysqli_close($con);
    header('Location: ../signin.php');

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
