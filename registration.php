<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./style/login.css">
  <link rel="stylesheet" href="./style/style.css">
  <title>Casino Royale - Registration</title>
</head>
<?php
include "./server/conn.php";

$message = "";
if (isset($_GET['message'])) {
  $message = $_GET['message'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  $password_confirm = $_POST["confirm_password"];
  $pfp = $_POST["pfp"];

  if ($password_confirm == $password) {
    $sql = "SELECT * FROM ".$dbname.".".$table." WHERE UserName like '" . $user . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      header('Location: ./registration.php?message="<p class="login_error">This username is already exist!</p>"');
    } else {
      $sql = "INSERT INTO ".$dbname.".".$table." (UserName, Password, Balance, Email, PFP)
        VALUES ('" . $user . "', '" . password_hash($password, PASSWORD_DEFAULT) . "', 500, '" . $email . "','".$pfp."')";
      if ($conn->query($sql) === TRUE) {
        header('Location: ./registration.php?message="<p class="login_success">You registered successfully!</p>"');
      } else {
        header('Location: ./registration.php?message="<p class="login_error">Error: ' . $sql . '<br>' . $conn->error.'</p>"');
      }
    }
  } else {
    header('Location: ./registration.php?message="<p class="login_error">Passwords does\'t match!</p>"');
  }
}

?>

<body>
  <nav id="navbar" class="navbar navbar-expand-md navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Casino <span style="color: #FFA800;">Royale</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="collapseNavbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="" data-bs-target="#myModal">
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="" data-bs-target="#myModal">
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="games">
    <div class="games-pops">
      <img src="assets/img/icons/homepage.png" alt="homepage" title="homepage">
    </div>
    <div class="games-pops">
      <img src="assets/img/icons/cards.png" alt="black jack" title="black jack">
    </div>
    <div class="games-pops">
      <img src="assets/img/icons/tower.png" alt="tower" title="tower">
    </div>
    <div class="games-pops">
      <img src="assets/img/icons/coin.png" alt="coinflipp" title="coinflipp">
    </div>
  </div>
  <div class="align">
    <h1><a class="brand" href="#">Casino <span style="color: #FFA800;">Royale</span></a></h1>
    <?= $message ?>
    <div class="grid">
      <form action="#" method="POST" class="form login">
        <div class="form_field">
          <label for="login_username"><svg class="icon">
              <use xlink:href="#icon-user"></use>
            </svg><span class="hidden">Username</span></label>
          <input autocomplete="username" id="login_username" type="text" name="username" class="form_input"
            placeholder="Username" required>
        </div>
        <div class="form_field">
          <label for="login_username"><svg class="icon">
              <use xlink:href="#icon-user"></use>
            </svg><span class="hidden">Email</span></label>
          <input autocomplete="username" id="login_email" type="email" name="email" class="form_input"
            placeholder="Email" required>
        </div>
        <div class="form_field">
          <label for="login_password"><svg class="icon">
              <use xlink:href="#icon-lock"></use>
            </svg><span class="hidden">Password</span></label>
          <input id="login_password" type="password" name="password" class="form_input" placeholder="Password" required>
        </div>
        <div class="form_field">
          <label for="login_confirm_password"><svg class="icon">
              <use xlink:href="#icon-lock"></use>
            </svg><span class="hidden">Confirm Password</span></label>
          <input id="login_confirm_password" type="password" name="confirm_password" class="form_input"
            placeholder="Confirm Password" required>
        </div>
        <div>
          <label class="pfp-label">
            <input type="radio" name="pfp" value="cat" checked>
            <img src="./assets/img/profiles/cat.png" alt="Pfp Option 1">
          </label>
          <label class="pfp-label">
            <input type="radio" name="pfp" value="panda">
            <img src="./assets/img/profiles/panda.png" alt="Pfp Option 2">
          </label>
          <label class="pfp-label">
            <input type="radio" name="pfp" value="siba">
            <img src="./assets/img/profiles/siba.png" alt="Pfp Option 3">
          </label>
          <label class="pfp-label">
            <input type="radio" name="pfp" value="sloth">
            <img src="./assets/img/profiles/sloth.png" alt="Pfp Option 4">
          </label>
        </div>
        <div class="form_field">
          <input type="submit" value="Register">
        </div>
      </form>
      <p class="text-center">You have an account? <a href="./login.php">Login now!</a> <svg class="icon">
          <use xlink:href="#icon-arrow-right"></use>
        </svg></p>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" class="icons">
      <symbol id="icon-arrow-right" viewBox="0 0 1792 1792">
        <path
          d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z" />
      </symbol>
      <symbol id="icon-lock" viewBox="0 0 1792 1792">
        <path
          d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z" />
      </symbol>
      <symbol id="icon-user" viewBox="0 0 1792 1792">
        <path
          d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z" />
      </symbol>
    </svg>
  </div>
</body>
<script>

</script>

</html>