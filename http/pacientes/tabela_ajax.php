<?php

$mysqlquery = mysql_query($select);
$array = mysql_fetch_assoc($mysqlquery);

echo "<table class='table table-striped'>";
echo "<thead><tr>";

foreach ($array as $key=>$value) echo "<th>".$key."</th>";

echo "</tr></thead>";

while( $row1 = mysql_fetch_assoc($mysqlquery)) {
    echo "<tr>";
    foreach ($row1 as $key=>$value) echo "<td>".$value."</td>";
    echo "</tr>";
}

echo "</table>";
?>
