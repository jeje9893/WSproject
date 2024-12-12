<?php
session_start();
// 필요한 PHP 코드가 있다면 여기에 추가하세요.
?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>국가별 인구수</title>
  <link rel="stylesheet" href="worldlt.css">
  <link rel="StyleSheet" href="../table.css" type="text/css" />
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="./main.js"></script>
  <script defer src="./worldlt.js"></script>
</head>

<div>
    <nav>
      <ul>
        <li style="border-right: 1px solid black;"><a href="../WorldMain/index.php" onclick="showMode(1)">세계지도</a></li>
        <li style="border-right: 1px solid black;"><a href="WorldList.php">국가목록</a></li>
        <?php if (isset($_SESSION['username'])): ?>
          <li style="float: right;"><a href="#"><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
          <li style="float: right;"><a href="../Login/logout.php">Log out</a></li>
        <?php else: ?>
          <li style="float: right;"><a href="../Login/login.php">Log in</a></li>
          <li style="float: right;"><a href="../Login/sign_up.php">Sign up</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>

<body>
  <table>
    <thead>
      <tr>
        <th>국기</th>
        <th>국가명</th>
        <th>인구 수</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><a href="../WorldList/India.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg" alt="India Flag"></a></td>
        <td>인도 (India)</td>
        <td class="population">1,441,711,852명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/China.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Flag_of_the_People%27s_Republic_of_China.svg" alt="China Flag"></a></td>
        <td>중국 (China)</td>
        <td class="population">1,425,176,357명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/USA.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Flag_of_the_United_States_%28DoS_ECA_Color_Standard%29.svg" alt="USA Flag"></a></td>
        <td>미국 (USA)</td>
        <td class="population">341,814,420명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Indonesia.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg" alt="Indonesia Flag"></a></td>
        <td>인도네시아 (Indonesia)</td>
        <td class="population">279,798,049명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Brazil.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/0/05/Flag_of_Brazil.svg" alt="Brazil Flag"></a></td>
        <td>브라질 (Brazil)</td>
        <td class="population">217,637,297명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Russia.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/2/2d/Russia_flag.jpg" alt="Russia Flag"></a></td>
        <td>러시아 (Russia)</td>
        <td class="population">144,820,423명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Mexico.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/f/fc/Flag_of_Mexico.svg" alt="Mexico Flag"></a></td>
        <td>멕시코 (Mexico)</td>
        <td class="population">129,388,467명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Japan.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Flag_of_Japan.svg" alt="Japan Flag"></a></td>
        <td>일본 (Japan)</td>
        <td class="population">122,631,432명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Turkey.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/b/b4/Flag_of_Turkey.svg" alt="Turkey Flag"></a></td>
        <td>튀르키예 (Turkey)</td>
        <td class="population">86,260,417명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Germany.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Flag_of_Germany.svg" alt="Germany Flag"></a></td>
        <td>독일 (Germany)</td>
        <td class="population">83,252,474명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/UK.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Flag_of_the_United_Kingdom_%281-2%29.svg" alt="UK Flag"></a></td>
        <td>영국 (UK)</td>
        <td class="population">67,961,439명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/France.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/c/c3/Flag_of_France.svg" alt="France Flag"></a></td>
        <td>프랑스 (France)</td>
        <td class="population">67,400,000명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Italy.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/0/03/Flag_of_Italy.svg" alt="Italy Flag"></a></td>
        <td>이탈리아 (Italy)</td>
        <td class="population">58,697,744명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/South_Korea.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/0/09/Flag_of_South_Korea.svg" alt="Korea Flag"></a></td>
        <td>대한민국 (Korea)</td>
        <td class="population">51,271,480명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Spain.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/8/89/Bandera_de_Espa%C3%B1a.svg" alt="Spain Flag"></a></td>
        <td>스페인 (Spain)</td>
        <td class="population">48,692,804명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Canada.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/c/cf/Flag_of_Canada.svg" alt="Canada Flag"></a></td>
        <td>캐나다 (Canada)</td>
        <td class="population">39,107,046명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Saudi_Arabia.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/0/0d/Flag_of_Saudi_Arabia.svg" alt="Saudi Arabia Flag"></a></td>
        <td>사우디 아라비아(Saudi Arabia)</td>
        <td class="population">37,473,929명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Australia.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/8/88/Flag_of_Australia_%28converted%29.svg" alt="Australia Flag"></a></td>
        <td>호주 (Australia)</td>
        <td class="population">26,699,482명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Netherlands.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/2/20/Flag_of_the_Netherlands.svg" alt="Netherlands Flag"></a></td>
        <td>네덜란드 (Netherlands)</td>
        <td class="population">17,671,125명</td>
      </tr>
      <tr>
        <td><a href="../WorldList/Switzerland.php"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/f/f2/Civil_Ensign_of_Switzerland.svg" alt="Switzerland Flag"></a></td>
        <td>스위스 (Switzerland)</td>
        <td class="population">8,851,431명</td>
      </tr>
    </tbody>
  </table>
</body>

</html>
