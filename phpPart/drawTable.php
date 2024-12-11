<?php
$conn = mysqli_connect('localhost', 'root', '1128');
if (!$conn) die('Could not connect: ' . mysqli_error($conn));
if (!mysqli_select_db($conn, 'worldpopulationdb')) die('Can\'t use foo : ' . mysqli_error($conn));

$sql = "select * from country_australia";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    echo $row['year'] . " ";
    echo $row['value'] . "<br>";
}

mysqli_close($conn);
