<?php
session_start();
// 데이터베이스 연결 설정
$conn = mysqli_connect('localhost', 'root', '1128');
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

// 데이터베이스 선택
if (!mysqli_select_db($conn, 'worldpopulationdb')) {
    die('Can\'t use worldpopulationdb : ' . mysqli_error($conn));
}

// 데이터 가져오기
$sql = "SELECT year, value FROM country_france ORDER BY year ASC";
$result = mysqli_query($conn, $sql);

$chart_data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $chart_data[] = $row;
}

// 데이터베이스 연결 닫기
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="ko">
    <meta charset="UTF-8">
    <link rel="StyleSheet" href="../table.css" type="text/css" />

<div>
    <nav>
        <ul>
            <li style="border-right: 1px solid black;"><a href="../WorldMain/index.php">세계지도</a></li>
            <li style="border-right: 1px solid black;"><a href="../wl/WorldList.php">국가목록</a></li>
            <li style="float: right;"><a href="login.html">Log in</a></li>
            <li style="float: right;"><a href="sign_up.html">Sign up</a></li>
        </ul>
    </nav>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Year');
        data.addColumn('number', 'Australia Population');
        data.addRows([
            <?php foreach ($chart_data as $data): ?>
                ['<?= $data['year'] ?>', <?= $data['value'] ?>],
            <?php endforeach; ?>
        ]);
        var options = {
            title: '프랑스 인구 수',
            titleTextStyle: {
                fontSize: 20
            },
            curveType: 'function',
            focusTarget: 'category',
            legend: { position: 'top' },
            hAxis: { title: '연도', format: 'yyyy' },
            vAxis: { title: '인구 수', minValue: 0 }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<div id="chart_div" style="width: 900px; height: 500px;"></div>