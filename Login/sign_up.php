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
          <a href="../WorldMain/" onclick="showMode(1)">세계지도</a>
        </li>
        <li style="border-right: 1px solid black">
          <a href="../wl/WorldList.php">국가목록</a>
        </li>
        <?php if (isset($_SESSION['username'])): ?>
          <li style="float: right"><?php echo htmlspecialchars($_SESSION['username']); ?></li>
          <li style="float: right"><a href="logout.php">Log out</a></li>
        <?php else: ?>
          <li style="float: right"><a href="login.php">Log in</a></li>
          <li style="float: right"><a href="sign_up.php">Sign up</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>

  <div class="IDcontainer">
    <div style="margin-top: 20px;">
      <p style="font-weight: bold; font-size: 20px;">회원가입</p>
    </div>
    <form action="signup.php" method="POST">
      <div class="formRow"><label for="username">ID : </label>
        <input type="text" id="username" name="username" required />
      </div>
      <!-- 사용자 이름 입력 필드 -->
      <br />
      <div class="formRow"><label for="password">pw : </label>
        <input type="password" id="password" name="password" required />
      </div>
      <!-- 비밀번호 입력 필드 -->
      <br />
      <div class="formRow"><label for="confirm_password">비밀번호 확인 : </label>
        <input type="password" id="confirm_password" name="confirm_password" required />
      </div>
      <br />
      <!-- 회원가입 제출 버튼 -->
      <div class="formRow">
        <button type="submit" class="formButton">가입</button>
      </div>
    </form>
  </div>
  <div id="chart_div" style="width: 900px; height: 600px; display: none"></div>

  <script>
    showMode(1);
  </script>
</body>

</html>