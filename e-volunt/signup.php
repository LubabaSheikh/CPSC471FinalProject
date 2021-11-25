<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>External Volunteer Sign Up Page</title>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>


<section id="sign-up">
    <form action="signUP.php" style="border:1px solid #ccc">
      <div class="container">
        <h1>Sign Up</h1>
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
        <label for="affilComp"><b>Affiliated Company</b></label>
        <input type="text" placeholder="Church of Bingus" name="affilComp" required>
        <br>
        <label for="Flag"><b>Pet Visitation or Spirituality</b></label>
        <input type="text" placeholder="Pet or Spirit???" name="Flag" required>
        <br>
        <label for="petName"><b>Pet Name</b></label>
        <input type="text" placeholder="N/A" name="petName" required>
        <br>
        <label for="petType"><b>Pet Type</b></label>
        <input type="text" placeholder="Dog" name="petType" required>
        <br>
        <label for="spirituality"><b>Your Faith</b></label>
        <input type="text" placeholder="N/A" name="spirituality" required>
        <br>

        <label for="psw"><b>Enter your password</b></label>
        <input type="password" placeholder="Password" name="psw" required>

        <div class="clearfix">
          <button href="../index.php" type="button" class="homeBTN">Back</button>
          <button type="submit" class="signupbtn">Sign Up</button>
        </div>
      </div>
    </form>

</section>


  <!-- Footer -->
    <footer class="white-section" id="footer">
        <br><br>
        <div class="container-fluid">
        <p>© Copyright 2021 Group 39 CPSC 471 </p>
        </div>
    </footer>


</body>
