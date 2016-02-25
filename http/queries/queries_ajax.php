<?php
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php'; 



$select = "select * from queries" ;

$mysqlquery = mysql_query($select);
?>

<h1>Consultas Personalizadas</h1>
<table class='table table-striped'>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Consulta SQL</th>
        </tr>
    </thead>
    <tbody>
        <?php while( $row1 = mysql_fetch_assoc($mysqlquery)) { ?>
        <tr>
            <td><?php echo $row1['nome'] ?></td>
            <td><?php echo $row1['query'] ?></td>
            <td>
                <a href="javascript:Ajax('queries/tabela','conteudo','query=<?php echo urlencode($row1['id']) ?>')" class="btn btn-primary">Ver</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
