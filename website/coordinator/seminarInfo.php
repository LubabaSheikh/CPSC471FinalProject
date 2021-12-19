<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Volunteer Search Result</title>
    <!-- font -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
<h1>Seminar Search Result</h1>
<p>here is the seminar you are looking for:</p>
<hr>

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Seminar</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Name</th>
          <td>Puppies Supporting Families Through Devastating Times</td>
        </tr>
        <tr>
          <th scope="row">Date</th>
          <td> 01/31/2022 </td>
        </tr>
        <tr>
          <th scope="row">Time</th>
          <td> 8:00 PM </td>
        </tr>
        <tr>
          <th scope="row">Volunteers Registered</th>
          <td>400-500-600</td>
        </tr>
      </tbody>
    </table>

<br> <br>
<h1>Change Seminar Information</h1>
<hr>

<section id="seminar-change">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update Seminar Name</h5>
            <label for="semName"><b>New Seminar Name:</b></label>
            <input type="text" placeholder="Fundamentals of Laparoscopic Surgery" name="semName" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Update Seminar Date/Time</h5>
          <label for="semDate"><b>New Seminar Date:</b></label>
          <input type="text" placeholder="MM/DD/YYYY" name="semDate" required>
          <label for="semTime"><b>New Seminar Time:</b></label>
          <input type="text" placeholder="00:00 AM or PM" name="semTime" required>
          <a href="#" class="btn btn-warning">Submit</a>
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
