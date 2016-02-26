<?php

$mysqlquery_t = mysql_query($select);
$array_t = mysql_fetch_assoc($mysqlquery_t);

echo "<table class='table table-striped'>";
$first_t = true;
while( $row_t = mysql_fetch_assoc($mysqlquery_t)) {
    
    if($first_t){
        echo "<thead><tr>";
        foreach ($row_t as $key=>$value) echo "<th>".$key."</th>";
        echo "</tr></thead>";
        $first_t=false;
    }
    
    echo "<tr>";
    foreach ($row_t as $key=>$value) echo "<td>".$value."</td>";
    echo "</tr>";
}

echo "</table>";
?>
