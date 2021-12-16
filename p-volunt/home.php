<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Prospective Volunteer Home Page</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
<h1>Prospective Volunteer Home Landing Page</h1>
<p>Please finish your application using the following utilities. In application, you are required to submit at least 2 references and a background check.</p>
<hr>

<section id="sign-up">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add New Reference</h5>
            <p class="card-text">Please add the full name and email your referee.</p>
            <label for="fullname"><b>Full Name</b></label>
            <input type="text" placeholder="Referee" name="fullname" required>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="@email.com" name="email" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Remove A Previously-Submitted Reference</h5>
            <p class="card-text">Enter the email of the referee you are choosing to remove from your applciation.</p>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="@email.com" name="email" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add A Background Check Status</h5>
            <p class="card-text">As an applicant, you are responsible for acquiring your own background check.
                You must bring this document with you at your first interview.
                Please only change the status once you have received a completed background check.</p>
            <label for="bcStatus"><b>Background Check Status</b></label>
            <input type="text" placeholder="in progress" name="bcStatus" required>
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
