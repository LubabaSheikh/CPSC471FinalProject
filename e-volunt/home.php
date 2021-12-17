<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>External Volunteer Home Page</title>
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
            <a href="#" class="btn btn-success">View Shifts</a>
            <a href="#" class="btn btn-success">View Seminars</a>
            <a href="#" class="btn btn-warning">Sign Up For A Shift</a>
            <a href="#" class="btn btn-warning">Sign Up For A Seminar</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Personal Information</h5>
            <p class="card-text">You may edit your first name, gender, or pronouns using the form below:</p>
            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="First" name="fname" required>
            <label for="gender"><b>Gender</b></label>
            <input type="text" placeholder="N/A" name="gender" required>
            <label for="pronouns"><b>Pronouns</b></label>
            <input type="text" placeholder="they/them" name="pronouns" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
    </div>
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
