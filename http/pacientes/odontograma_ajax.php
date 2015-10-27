<?php
   /**
    * Gerenciador Clínico Odontológico
    * Copyright (C) 2006 - 2009
    * Autores: Ivis Silva Andrade - Engenharia e Design(ivis@expandweb.com)
    *          Pedro Henrique Braga Moreira - Engenharia e Programação(ikkinet@gmail.com)
    *
    * Este arquivo é parte do programa Gerenciador Clínico Odontológico
    *
    * Gerenciador Clínico Odontológico é um software livre; você pode
    * redistribuí-lo e/ou modificá-lo dentro dos termos da Licença
    * Pública Geral GNU como publicada pela Fundação do Software Livre
    * (FSF); na versão 2 da Licença invariavelmente.
    *
    * Este programa é distribuído na esperança que possa ser útil,
    * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÂO
    * a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
    * Licença Pública Geral GNU para maiores detalhes.
    *
    * Você recebeu uma cópia da Licença Pública Geral GNU,
    * que está localizada na raíz do programa no arquivo COPYING ou COPYING.TXT
    * junto com este programa. Se não, visite o endereço para maiores informações:
    * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html (Inglês)
    * http://www.magnux.org/doc/GPL-pt_BR.txt (Português - Brasil)
    *
    * Em caso de dúvidas quanto ao software ou quanto à licença, visite o
    * endereço eletrônico ou envie-nos um e-mail:
    *
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endereço:
    *
    * Smile Odontolóogia
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    *
    */
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) {
		die($frase_log);
	}
	$acao = '&acao=editar';
	$paciente = new TPacientes();
    $query = mysql_query("SELECT * FROM odontograma WHERE codigo_paciente = ".$_GET['codigo']) or die('Line 39: '.mysql_error());
    while($row = mysql_fetch_assoc($query)) {
        $dente[$row['dente']] = $row['descricao'];
    }
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
?>
<link href="../css/smile.css" rel="stylesheet" type="text/css" />
 
<div class="conteudo" id="table dados">
<h3><?php echo $LANG['patients']['odontogram']?></h3>
<table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
  <tr>
    <td>
      <form id="form2" name="form2" method="POST" action="pacientes/incluir_ajax.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background: url('pacientes/img/odontograma.png') center center no-repeat;">
        <tr>
          <td width="35%" align="right">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
    for($i = 18; $i != 49; $i++) {
?>
              <tr>
                <td width="100%" align="right" style="height: 25px" valign="middle">
                  <input type="text" name="dente[<?php echo $i?>]" value="<?php echo $dente[$i]?>" class="forms" <?php echo $disable?>
                  onblur="Ajax('pacientes/atualiza', 'pacientes_atualiza', 'descricao='%2Bthis.value%2B'&codigo_paciente=<?php echo $_GET['codigo']?>&dente=<?php echo $i?>');" />
                </td>
              </tr>
<?php
        if($i == 11) {
            $i = 40;
        }
        if($i < 40) {
            $i -= 2;
        }
    }
?>
            </table>
          </td>
          <td width="30%" align="center">

          </td>
          <td width="35%" align="center">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
    for($i = 28; $i != 39; $i++) {
?>
              <tr>
                <td width="100%" align="left" style="height: 25px" valign="middle">
                  <input type="text" name="dente[<?php echo $i?>]" value="<?php echo $dente[$i]?>" class="forms" <?php echo $disable?>
                  onblur="Ajax('pacientes/atualiza', 'pacientes_atualiza', 'descricao='%2Bthis.value%2B'&codigo_paciente=<?php echo $_GET['codigo']?>&dente=<?php echo $i?>');" />
                </td>
              </tr>
<?php
        if($i == 21) {
            $i = 30;
        }
        if($i < 30) {
            $i -= 2;
        }
    }
?>
            </table>
          </td>
        </tr>
      </table>
    </form>
    </td>
  </tr>
    <tr>
      <td align="right"> <br />
        <img src="../imagens/icones/imprimir.png"> <a href="relatorios/odontograma.php?codigo=<?php echo $_GET['codigo']?>" target="_blank"><?php echo $LANG['patients']['print_odontogram']?></a>&nbsp;
      </td>
    </tr>
</table>
<div id="pacientes_atualiza"></div>
