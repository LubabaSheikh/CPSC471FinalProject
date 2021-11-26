<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <title>Internal Volunteer Sign Up Page</title>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>


<section id="sign-in">
    <div class="container-fluid">
        <form action="action_page.php" method="post">
            <h1>Sign In</h1>
            <p>Please enter your account details as specified below:</p>
            <hr>
            <div class="imgcontainer">
            </div>

            <div class="container">
            <label for="uname"><b>SIN Number</b></label>
            <input type="text" placeholder="Enter SIN Number" name="uname" required>

            <label for="psw"><b>Enter Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button onclick="location.href='../CPSC471FinalProject/i-volunt/home.php'" type="submit">Volunteer Login</button>
            <button onclick="location.href='../CPSC471FinalProject/coordinator/home.php'" type="submit">Coordinator Login</button>
            <button onclick="location.href='../CPSC471FinalProject/p-volunt/home.php'" type="submit">Potential Volunteer Login</button>
            </div>
        </form>
    </div>

</section>


  <!-- Footer -->
    <footer class="white-section" id="footer">
        <br><br>
        <div class="container-fluid">
        <p>© Copyright 2021 Group 39 CPSC 471 </p>
        </div>
    </footer>


</body>
