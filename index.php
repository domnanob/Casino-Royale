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
  <link rel="stylesheet" href="./style/style.css">
  <title>Casino Royale</title>
</head>
<?php
session_start();
if (isset($_SESSION["username"])) {
  $user = "<a class='nav-link' href='' data-bs-target='#myModal'>" . $_SESSION["username"] . "</a>";
  $balance = "<a id='profile-balance' class='nav-link' href='' data-bs-target='#myModal'>" . "Bank: " . $_SESSION["balance"] . "$" . "</a>";
  $pfp = "<img class='pfp' src='./assets/img/profiles/" . $_SESSION["pfp"] . ".png'>";
  $logout = "<a class='nav-link' href='./server/logout.php' data-bs-target='#myModal'>Logout</a>";
} else {
  $user = "<a class='nav-link' href='./login.php' data-bs-target='#myModal'>Login</a>";
  $balance = "<a class='nav-link' href='./registration.php' data-bs-target='#myModal'>Register</a>";
  $pfp = "";
  $logout = "";
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
            <?php echo $logout ?>
          </li>
          <li class="nav-item">
            <?php echo $balance ?>
          </li>
          <li class="nav-item">
            <?php echo $user; ?>
          </li>
          <li class="nav-item">
            <?php echo $pfp; ?>
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
  <div class="game-field">
    <div class="top-wrap d-flex justify-content-between">
      <div class="dealer-field d-flex justify-content-start">
        <div class="card-outer-wrap">
          <div class="card-inner-wrap" id="dealer-card-1">
          </div>
        </div>
        <div class="card-outer-wrap">
          <div class="card-inner-wrap" id="dealer-card-2">
          </div>
        </div>
        <div class="card-outer-wrap">
          <div class="card-inner-wrap" id="dealer-card-3">
          </div>
        </div>
        <div class="card-outer-wrap">
          <div class="card-inner-wrap" id="dealer-card-4">
          </div>
        </div>
        <div class="card-outer-wrap">
          <div class="card-inner-wrap" id="dealer-card-5">
          </div>
        </div>
      </div>
      <div class="deck-field">
        <img class="deck-card" src="./assets/img/back.png" alt="" id="deck-card">
      </div>
    </div>
    <div class="bottom-wrap d-flex flex-container">
      <div class="bet-panel">
        <div class="bet-field">
          <input type="number" class="bet-input" id="bet-input" placeholder="Place a bet!">
        </div>
        <div class="input-btn-group">
          <div class="input-btn" id="input-3">3</div>
          <div class="input-btn" id="input-5">5</div>
          <div class="input-btn" id="input-10">10</div>
          <div class="input-btn" id="input-15">15</div>
          <div class="input-btn" id="input-20">20</div>
          <div class="input-btn" id="input-25">25</div>
          <div class="input-btn" id="input-50">50</div>
        </div>
        <div class="game-btn-group">
          <div class="game-hit-btn" id="hit-btn" disabled="true">Hit</div>
          <div class="game-stand-btn" id="stand-btn">Stand</div>
        </div>
        <div class="game-play-btn" id="play-btn">Play</div>
      </div>
      <div class="player-field d-flex justify-content-start">
        <div class="card-outer-wrap">
          <div class="card-inner-wrap" id="player-card-1">
          </div>
        </div>
        <div class="card-outer-wrap">
          <div class="card-inner-wrap" id="player-card-2">
          </div>
        </div>
        <div class="card-outer-wrap">
          <div class="card-inner-wrap" id="player-card-3">
          </div>
        </div>
        <div class="card-outer-wrap">
          <div class="card-inner-wrap" id="player-card-4">
          </div>
        </div>
        <div class="card-outer-wrap">
          <div class="card-inner-wrap" id="player-card-5">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="game-result d-none" id="game-result">
  </div>
  <script src="./script/script.js"></script>
</body>

</html>