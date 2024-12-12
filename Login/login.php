<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <link rel="StyleSheet" href="../table.css" type="text/css" />
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="./main.js"></script>
  <title>모드 선택</title>
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

  <div class="IDcontainer">
    <div style="margin-top: 20px;">
      <p style="font-weight: bold; font-size: 20px;">로그인</p>
    </div>
    <form action="index.php" method="POST">
      <div class="formRow">
        <label for="username">ID :</label>
        <input type="text" id="username" name="username" required />
      </div>
      <br>
      <!-- 사용자 이름 입력 필드 -->
      <div class="formRow">
        <label for="password">pw :</label>
        <input type="password" id="password" name="password" required />
      </div>
      <!-- 비밀번호 입력 필드 -->
      <!-- 로그인 제출 버튼 -->
      <div class="formRow">
        <button type="submit" class="formButton">로그인</button>
      </div>
    </form>
  </div>
  <div id="chart_div" style="width: 900px; height: 600px; display: none"></div>

  <script>
    showMode(1);
  </script>
</body>

</html>