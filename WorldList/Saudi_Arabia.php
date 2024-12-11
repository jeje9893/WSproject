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
$sql = "SELECT year, value FROM country_saudi_arabia ORDER BY year ASC";
$result = mysqli_query($conn, $sql);

$chart_data = array();
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['year'] == 2019) {
        $row['annotation'] = '드론 테러 사건';
        $row['annotationText'] = 'https://www.bbc.com/korean/international-49705340';
    } else {
        $row['annotation'] = null;
        $row['annotationText'] = null;
    }
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
            <li style="border-right: 1px solid black">
                <a href="../WorldMain/" onclick="showMode(1)">세계지도</a>
            </li>
            <li style="border-right: 1px solid black">
                <a href="../wl/WorldList.php">국가목록</a>
            </li>
            <li style="border-right: 1px solid black">
                <a href="../phpPart/index.html">DB에 데이터 넣기</a>
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Year');
        data.addColumn('number', 'Saudi Arabia Population');
        data.addColumn({
            type: 'string',
            role: 'annotation'
        });
        data.addColumn({
            type: 'string',
            role: 'annotationtext',
            'p': {
                'html': true
            }
        });
        data.addRows([
            <?php foreach ($chart_data as $data): ?>['<?= $data['year'] ?>', <?= $data['value'] ?>, <?= $data['annotation'] ? "'" . $data['annotation'] . "'" : 'null' ?>, <?= $data['annotationText'] ? "'" . $data['annotationText'] . "'" : 'null' ?>],
            <?php endforeach; ?>
        ]);
        var options = {
            title: '사우디아라비아 인구 수',
            titleTextStyle: {
                fontSize: 20
            },
            curveType: 'function',
            focusTarget: 'category',
            legend: {
                position: 'top'
            },
            hAxis: {
                title: '연도',
                format: 'yyyy'
            },
            vAxis: {
                title: '인구 수',
                minValue: 0
            },
            tooltip: {
                isHtml: true
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        google.visualization.events.addListener(chart, 'select', function() {
            var selection = chart.getSelection();
            if (selection.length > 0) {
                var row = selection[0].row;
                var url = data.getValue(row, 3);
                if (url) {
                    window.open(url, '_blank');
                }
            }
        });
        chart.draw(data, options);
    }
</script>

<div id="chart_div" style="width: 900px; height: 500px;"></div>