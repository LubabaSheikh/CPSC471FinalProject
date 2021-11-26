<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Volunteer Search Result</title>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
<h1>Volunteer Search Result</h1>
<p>here is the volunteer you are looking for:</p>
<hr>

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Volunteer</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">First Name</th>
          <td>Lauryn</td>
        </tr>
        <tr>
          <th scope="row">Middle Name</th>
          <td>P</td>
        </tr>
        <tr>
          <th scope="row">Last Name</th>
          <td>Whitnen</td>
        </tr>
        <tr>
          <th scope="row">SIN</th>
          <td>400-500-600</td>
        </tr>
        <tr>
          <th scope="row">Gender</th>
          <td>gender nonconforming </td>
        </tr>
        <tr>
          <th scope="row">Pronouns</th>
          <td>any pronouns</td>
        </tr>
        <tr>
          <th scope="row">Birth Date</th>
          <td>10/20/1988</td>
        </tr>
        <tr>
          <th scope="row">Equipment</th>
          <td>Mask, Key Card</td>
        </tr>
        <tr>
          <th scope="row">Covid Status</th>
          <td>2 Doses Moderna</td>
        </tr>
        <tr>
          <th scope="row">External Type</th>
          <td>N/A</td>
        </tr>
        <tr>
          <th scope="row">Faith</th>
          <td>N/A</td>
        </tr>
        <tr>
          <th scope="row">Pet Name</th>
          <td>N/A</td>
        </tr>
        <tr>
          <th scope="row">Pet Type</th>
          <td>N/A</td>
        </tr>
      </tbody>
    </table>

<br> <br>
<h1>Change Volunteer Information</h1>
<hr>

<section id="sign-up">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Confirm Training Level</h5>
            <p class="card-text">Update the volunteer's training level:</p>
            <label for="training"><b>Training Level</b></label>
            <input type="text" placeholder="highest level" name="training" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Give Reward</h5>
            <p class="card-text">Enter a reward for this volunteer:</p>
            <label for="reward"><b>Reward</b></label>
            <input type="text" placeholder="brithday gift" name="reward" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Change Volunteer Equipment</h5>
            <p class="card-text">Update the volunteer's equipment:</p>
            <label for="equip"><b>Equipment</b></label>
            <input type="text" placeholder="mask" name="equip" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update Covid Status</h5>
            <p class="card-text">If the volunteer has taken their covid vaccines, please update here</p>
            <label for="covid"><b>Covid Status</b></label>
            <input type="text" placeholder="2 doses" name="covid" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Confirm Parking</h5>
            <p class="card-text">Update the volunteer's parking spot:</p>
            <label for="park"><b>Parking Spot</b></label>
            <input type="text" placeholder="B04" name="park" required>
            <a href="#" class="btn btn-warning">Submit</a>
          </div>
        </div>
      </div>
      <br>

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
