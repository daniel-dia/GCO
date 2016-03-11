<?php
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php'; 



$select = "select * from queries order by nome";
 
 
$mysqlquery = mysql_query($select);
?>

<h1>Consultas Personalizadas</h1>
<hr>
<ul>
<?php while( $row1 = mysql_fetch_assoc($mysqlquery)) { ?>
    <li><a href="javascript:Ajax('queries/tabela','conteudo','query=<?php echo urlencode($row1['id']) ?>')" class="btn btn-link"><?php echo $row1['nome'] ?></a></li>
<?php } ?>
</ul>
</table>
