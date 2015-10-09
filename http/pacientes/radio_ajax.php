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
	header("Content-type: text/html; charset=ISO-8859-1", true);
	if(!checklog()) {
		die($frase_log);
	}
	$strUpCase = "ALTERAÇÂO";
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$acao = '&acao=editar';
?>
<link href="../css/smile.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style4 {color: #FFFFFF}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="100%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="<?php echo $LANG['patients']['manage_patients']?>"> <span class="h3"><?php echo $LANG['patients']['manage_patients']?> [<?php echo $strLoCase?>] </span></td>
    </tr>
  </table>
<div class="conteudo" id="table dados">
<br />
<?phpinclude('submenu.php')?>
<br>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    
    <tr>
      <td height="26">&nbsp;<?php echo $LANG['patients']['radiograph']?></td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
        <br />
        <div align="center"><select name="modelo" class="forms" onchange="Ajax('pacientes/radio', 'conteudo', 'codigo=<?php echo $_GET['codigo']?>&acao=editar&modelo='%2Bthis.value)">
<?php
    $_GET['modelo'] = (($_GET['modelo'] != '')?$_GET['modelo']:'Panoramica');
    $valores = array('Panoramica' => $LANG['patients']['panoramic'], 'Oclusal' => $LANG['patients']['occlusal'], 'Periapical' => $LANG['patients']['periapical'], 'Interproximal' => $LANG['patients']['interproximal'], 'ATM' => $LANG['patients']['atm'], 'PA' => $LANG['patients']['posteroanterior'], 'AP' => $LANG['patients']['anteroposterior'], 'Lateral' => $LANG['patients']['lateral']);
    foreach($valores as $chave => $valor) {
        echo '          <option value="'.$chave.'" '.(($chave == $_GET['modelo'])?'selected':'').'>'.$valor.'</option>'."\n";
    }
?>
        </select></div>
        <br />
        <fieldset>
        <br />
          <table width="550" border="0" align="center">
            <tr>
<?php
	$i = 0;
	$query = mysql_query("SELECT * FROM radiografias WHERE modelo = '".$_GET['modelo']."' AND codigo_paciente = '".$_GET['codigo']."' ORDER BY data DESC, codigo DESC") or die(mysql_error());
	while($row = mysql_fetch_array($query)) {
		if($i % 2 === 0) {
			echo '</tr><tr>';
		}
?>
              <td width="50%" align="center" valign="top">
               <a href="javascript:Ajax('pacientes/radio_detalhe', 'conteudo', 'codigo=<?php echo $_GET['codigo']?>&acao=editar&codigo_foto=<?php echo $row['codigo']?>')">
               <img src="pacientes/verfoto_r.php?codigo=<?php echo $row['codigo']?>&tamanho=thumb" border="0"></a><BR>
               <font size="1"><?php echo $row['legenda']?><br /><?php echo converte_data($row['data'], 2)?></font><br><br>
               <?php echo ((verifica_nivel('pacientes', 'E'))?'<a href="pacientes/excluirfotos_r_ajax.php?codigo='.$_GET['codigo'].'&codigo_foto='.$row['codigo'].'&modelo='.$_GET['modelo'].'" onclick="return confirmLink(this)" target="iframe_upload">'.$LANG['patients']['delete_radiograph'].'</a>':'')?>
              </td>
<?php
		$i++;
	}
?>
           </tr>
        </table> 
        <br />
        </fieldset>
        <br />
        <iframe name="iframe_upload" width="1" height="1" frameborder="0" scrolling="No"></iframe>
          <form id="form2" name="form2" method="POST" action="pacientes/incluirfotos_r_ajax.php?codigo=<?php echo $_GET['codigo']?>" enctype="multipart/form-data" target="iframe_upload"> <?php/*onsubmit="Ajax('arquivos/daclinica/arquivos', 'conteudo', '');">*/?>
          <input type="hidden" name="modelo" value="<?php echo $_GET['modelo']?>" />
  		  <table width="310" border="0" align="center" cellpadding="0" cellspacing="0">
    		<tr align="center">
              <td width="70%"><?php echo $LANG['patients']['file']?> <br />
                <input type="file" size="20" name="arquivo" id="arquivo" class="forms" <?php echo $disable?>>
              </td>
            </tr>
    		<tr align="center">
              <td width="70%"><?php echo $LANG['patients']['legend']?> <br />
                <input type="text" size="33" name="legenda" id="legenda" class="forms" <?php echo $disable?>>
              </td>
            </tr>
    		<tr align="center">
              <td width="70%"><?php echo $LANG['patients']['date']?> <br />
                <input type="text" size="33" name="data" id="data" value="<?php echo date('d/m/Y')?>" class="forms" <?php echo $disable?>>
              </td>
            </tr>
            <tr align="center">
              <td width="30%"> <br />
                <input type="submit" name="Salvar" id="Salvar" value="<?php echo $LANG['patients']['save']?>" class="forms" <?php echo $disable?>>
              </td>
            </tr>
          </table>
          </form>
          <br />
      </td>
    </tr>
  </table>
