<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta charset="UTF-8" />
  <link rel="StyleSheet" href="../table.css" type="text/css" />
  <style>
    .custom-button {
      background-color: black;
      color: white;
      font-size: 20px;
      padding: 15px 30px;
      border: none;
      cursor: pointer;
    }

    .custom-button:hover {
      background-color: #333333;
      color: #ffffff;
    }
  </style>
</head>

<body>
  <div>
    <nav>
      <ul>
        <li style="border-right: 1px solid black">
          <a href="../WorldMain/" onclick="showMode(1)">
            <img src="../img/worldMap_icon.png" alt="세계지도" style="height: 35px; vertical-align: middle;">
          </a>
        </li>
        <li style="border-right: 1px solid black">
          <a href="../wl/WorldList.php">국가목록</a>
        </li>
        <li style="border-right: 1px solid black">
          <a href="../phpPart/index.php">DB에 데이터 넣기</a>
        </li>
        <?php if (isset($_SESSION['username'])): ?>
          <li style="float: right; border-left: 1px solid white"><a href="../Login/logout.php">Log out</a></li>
          <li style="float: right"><a href="#"><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
        <?php else: ?>
          <li style="float: right; border-left: 1px solid white"><a href="../Login/login.php">Log in</a></li>
          <li style="float: right"><a href="../Login/sign_up.php">Sign up</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>

  <div style="text-align: center; margin-top: 200px;">
    <a href="test.php">
      <button type="button" class="custom-button">DB에 데이터 넣기</button>
    </a>
  </div>
</body>

</html>