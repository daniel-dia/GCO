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
	include "../../lib/config.inc.php";
	include "../../lib/func.inc.php";
	include "../../lib/classes.inc.php";
	require_once '../../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=ISO-8859-1", true);
	if(!checklog()) {
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
	if(!verifica_nivel('agenda', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `arquivos` WHERE `nome` = '".$_GET[codigo]."'") or die(mysql_error());
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="35%">&nbsp;&nbsp;&nbsp;<img src="arquivos/img/arquivos.png" alt="Arquivos da Clínica"> <span class="h3"><?php echo $LANG['clinic_files']['clinic_files']?></span></td>
      <td width="63%" colspan="2" valign="bottom" align="center"></td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table><br />
<?php
    if(verifica_nivel('arquivos_clinica', 'I')) {
?>
  <form id="form2" name="form2" method="POST" action="arquivos/daclinica/incluir_ajax.php" enctype="multipart/form-data" target="iframe_upload"> <?php/*onsubmit="Ajax('arquivos/daclinica/arquivos', 'conteudo', '');">*/?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="4%">
      </td>
      <td width="37%"><?php echo $LANG['clinic_files']['file']?> <br />
        <input type="file" size="20" name="arquivo" id="arquivo" class="forms" onchange="getElementById('filename').value=this.value">
        <input type="hidden" value="" name="filename" id="filename">
      </td>
      <td width="43%"><?php echo $LANG['clinic_files']['description']?> <br />
        <input type="text" size="50" name="descricao" id="descricao" class="forms">
      </td>
      <td width="10%"> <br />
        <input type="submit" name="Salvar" id="Salvar" value="<?php echo $LANG['clinic_files']['save']?>" class="forms">
      </td>
      <td width="3%">
      </td>
    </tr>
  </table>
  </form>
  <iframe name="iframe_upload" width="1" height="1" frameborder="0" scrolling="No"></iframe>
<?php
    }
?>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6" colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td width="52%" height="23" align="left"><?php echo $LANG['clinic_files']['description']?></td>
      <td width="11%" align="center"><?php echo $LANG['clinic_files']['type']?></td>
      <td width="13%" align="center"><?php echo $LANG['clinic_files']['size']?></td>
      <td width="13%" align="center"><?php echo $LANG['clinic_files']['view']?></td>
      <td width="11%" align="center"><?php echo $LANG['clinic_files']['delete']?></td>
    </tr>
  </table>  
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
	$query = mysql_query("SELECT * FROM `arquivos` ORDER BY `descricao` ASC");
	$i = 0;
	$par = "F0F0F0";
	$impar = "F8F8F8";
	while($row = mysql_fetch_array($query)) {
		if($i % 2 == 0) {
			$odev = $par;
		} else {
			$odev = $impar;
		}
?>
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="52%" height="23" align="left"><?php echo $row[descricao]?></td>
      <td width="11%" align="center"><?php echo pega_tipo($row[nome])?></td>
      <td width="13%" align="center"><?php echo format_size($row[tamanho])?></td>
      <td width="13%" align="center"><?php echo ((verifica_nivel('arquivos_clinica', 'V'))?'<a href="arquivos/daclinica/files/'.$row[nome].'" target="_blank"><img src="imagens/icones/visualizar.gif" alt="Ver arquivo" width="16" height="20" border="0" /></a>':'')?></td>
      <td width="11%" align="center"><?php echo ((verifica_nivel('arquivos_clinica', 'E'))?'<a href="javascript:Ajax(\'arquivos/daclinica/arquivos\', \'conteudo\', \'codigo='.$row[nome].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a>':'')?></td>
    </tr>
<?php
		$i++;
	}
?>
  </table>
  <div id="pesquisa"></div>
</div>
