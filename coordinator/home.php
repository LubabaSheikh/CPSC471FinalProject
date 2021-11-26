<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Prospective Volunteer Home Page</title>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
<h1>Coordinator Home Landing Page</h1>
<p>Please use the following utilities to manage volunteers and seminars.</p>
<hr>

<section id="coor-home">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Search Volunteer</h5>
            <p class="card-text">Please search a volunteer by their SIN. You will be redirected to their information page
                through which you can confirm their training level, give rewards, change equipment, update covid status, or assign parking.</p>
            <label for="sin"><b>SIN Number</b></label>
            <input type="text" placeholder="123-123-123" name="sin" required>
            <a href="voluntInfo.php" class="btn btn-warning">Find Volunteer</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Your Shifts!</h5>
            <p class="card-text">As a coordinator, you may view upcoming shifts and assign volunteers to them.</p>
            <a href="#" class="btn btn-success">View Shifts</a>
            <a href="#" class="btn btn-warning">Assign Shifts to a Volunteer</a>
        </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Your Seminars!</h5>
            <p class="card-text">Here, you may view your seminars and edit them as well.</p>
            <a href="#" class="btn btn-success">View Seminars</a>
            <br>
            <label for="editSem"><b>Seminar ID To Edit</b></label>
            <input type="text" placeholder="012345" name="editSem" required>
            <a href="seminarInfo.php" class="btn btn-warning">Find Seminar & Edit</a>
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
