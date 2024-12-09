<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko">

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
          <a href="#" onclick="showMode(1)">세계지도</a>
        </li>
        <li style="border-right: 1px solid black">
          <a href="../wl/WorldList.php">국가목록</a>
        </li>
        <li style="border-right: 1px solid black">
          <a href="../phpPart/index.html">DB에 데이터 넣기</a>
        </li>
        <?php if (isset($_SESSION['username'])): ?>
          <li style="float: right"><a href="#"><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
          <li style="float: right"><a href="../Login/logout.php">Log out</a></li>
        <?php else: ?>
          <li style="float: right"><a href="../Login/login.php">Log in</a></li>
          <li style="float: right"><a href="../Login/sign_up.php">Sign up</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>

  <div class="modeContainer">
    <div class="selectMode">
      <div style="display: table-row">
        <div class="mode" data-mode="1" onclick="showMode(1)">모드1</div>
        <div class="mode" data-mode="2" onclick="showMode(2)">모드2</div>
        <div class="mode" data-mode="3" onclick="showMode(3)">모드3</div>
      </div>
    </div>
    <div class="window" id="modeWindow"></div>
  </div>
  <div id="chart_div" style="width: 900px; height: 600px; display: none"></div>

  <script>
    showMode(1);
  </script>
</body>

</html>