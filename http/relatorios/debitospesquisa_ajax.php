<?php

include "../lib/config.inc.php";
include "../lib/func.inc.php";
include "../lib/classes.inc.php";
require_once '../lang/'.$idioma.'.php';

$data_inicial = "'2012-1-1'";
$data_final = "now()";
$pago ="'Não'";


if($_GET["data_inicial"]!="") $data_inicial = "'".converte_data($_GET["data_inicial"],1)."'";
if($_GET["data_final"]!="") $data_final = "'".converte_data( $_GET["data_final"],1)."'";
if($_GET["pago"]) $pago = "'".$_GET["pago"]."'";
 
$query3 = "
select 
pacientes.codigo as codigo, 
pacientes.nome, 
pacientes.observacoes, 
pacientes.telefone1,  
pacientes.telefone2, 
pacientes.celular,  
parcelas_orcamento.valor, 
parcelas_orcamento.datavencimento,
parcelas_orcamento.codigo as orcamento, 
pacientes.email,
parcelas_orcamento.pago,
orcamento.baixa

from parcelas_orcamento 
INNER JOIN orcamento on orcamento.codigo          = parcelas_orcamento.codigo_orcamento
inner join pacientes on orcamento.codigo_paciente = pacientes.codigo
 
where


orcamento.baixa='Não' and
parcelas_orcamento.datavencimento > ".$data_inicial ." and
parcelas_orcamento.datavencimento < ".$data_final ." and
parcelas_orcamento.pago= ".$pago ." 
limit 1000";

 

$query = (mysql_query($query3)); 
$codAtual = null;?>
<table class="table table-hover">
    <tr>
    <th>Nome</th>
    <th>Contato</th> 
    <th width="230px">Orçamento</th>
     
    </tr>
    
<?php while($row = mysql_fetch_array($query)) { ?>

<?php if($codAtual != $row["codigo"] and isset($codAtual)){ ?> 
    </td> </tr> 
<?php }?>

<?php if($codAtual != $row["codigo"]){ ?>    
<tr onclick="Ajax('pacientes/incluir', 'conteudo', 'codigo=<?php echo $row["codigo"] ?>&acao=editar')" class="<?php echo $row[debito] == 1 ? 'danger':'' ?> <?php echo $row[falecido] == 1 ? 'warning':'' ?>" >

<td>
    <!--<img class="photosmall img-circle" height="30" src="pacientes/verfoto.php?size=30&codigo=<?php echo $row['codigo']?> "> -->
    <?php echo $row[nome]?>
    <?php if($row['observacoes']!="") echo '<small><br><br>'.$row['observacoes'].'</small>' ?>
</td>
<td>
  
    <?php if($row['celular']!="") echo $row['celular'].'<br>' ?>  
    <?php if($row['telefone1']!="") echo $row['telefone1'].'<br>' ?>  
    <?php if($row['telefone2']!="") echo $row['telefone2'].'<br>' ?>  
    <small><small><?php if($row['email']!="") echo $row['email'] ?></small></small>
    
</td>
 
<td>
    <?php }?>
         <div>
             <?php echo "<b>".$row['orcamento']."</b>" ?> 
             <?php echo " - ".$row['datavencimento'] ?> 
             <?php echo ' - R$ '.$row['valor'] ?> 
             
             <?php if($row['pago'] == "Sim" ) echo '<b>PAGO</b>' ?>  
       </div>
   
<?php
  $codAtual = $row['codigo'];
} ?>

</td> </tr>    
</table> 