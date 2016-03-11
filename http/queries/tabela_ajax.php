<?php

	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php'; 

$query_select = "select * from queries where id = ".$_GET["query"] ;
$mysqlquery = mysql_query($query_select);

$row0 = mysql_fetch_assoc($mysqlquery);
$select = $row0['query'];
$name = $row0['nome'];

$mysqlquery = mysql_query($select);

echo "<h1>".$name."</h1>";
echo "<div class='table-responsive'>";
echo "<table class='table table-striped'>";

$first = true;

while( $row1 = mysql_fetch_assoc($mysqlquery)) {
    
	if($first){
        echo "<thead><tr>";
        foreach ($row1 as $key=>$value) echo "<th>".$key."</th>";
        echo "</tr></thead>";
        $first=false;
    }
    
    echo "<tr>";
    foreach ($row1 as $key=>$value) echo "<td>".$value."</td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";
?>
