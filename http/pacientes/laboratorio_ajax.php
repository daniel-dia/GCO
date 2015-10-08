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
	if($_GET['confirm_del'] == 'delete') {
        mysql_query("DELETE FROM laboratorios_procedimentos_status WHERE codigo_procedimento = ".$_GET['codigo_procedimento']);
        mysql_query("DELETE FROm laboratorios_procedimentos WHERE codigo = ".$_GET['codigo_procedimento']);
	}
	$r = '';
	if(isset($_POST['Salvar'])) {
        if($_POST['procedimento'] != '') {
            mysql_query("INSERT INTO laboratorios_procedimentos (codigo_paciente, codigo_dentista, codigo_laboratorio, procedimento, datahora) VALUES (".$_GET['codigo'].", ".$_SESSION['codigo'].", ".$_POST['codigo_laboratorio'].", '".utf8_decode ( htmlspecialchars( utf8_encode($_POST['procedimento']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') )."', NOW())");
            $strScrp = 'Ajax("pacientes/laboratorio", "conteudo", "codigo='.$_GET['codigo'].'&acao=editar&codigo_procedimento='.mysql_insert_id().'")';
        } else {
            $r = '<font color="#FF0000">';
        }
	}
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$acao = '&acao=editar';
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<link href="../css/smile.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style4 {color: #FFFFFF}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="100%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="<?php echo $LANG['patients']['manage_patients']?>"> <span class="h3"><?php echo $LANG['patients']['manage_patients']?> &nbsp;[<?php echo $strLoCase?>] </span></td>
    </tr>
  </table>
<div class="conteudo" id="table dados">
<br />
<?phpinclude('submenu.php')?>
<br>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    
    <tr>
      <td height="26">&nbsp;<?php echo $LANG['patients']['laboratory_materials']?></td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
        <form id="form2" name="form2" method="POST" action="pacientes/laboratorio_ajax.php?acao=editar&codigo=<?php echo $_GET['codigo']?>" onsubmit="formSender(this, 'conteudo'); return false;">
          <fieldset>
            <legend><?php echo $LANG['patients']['procedure']?></legend>
            <table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="3%"></td>
                <td width="94%">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="85%"><?php echo $LANG['patients']['laboratory']?>:<br />
                      <select class="forms" name="codigo_laboratorio" id="codigo_laboratorio">
<?php
    $query = mysql_query("SELECT * FROM laboratorios ORDER BY nomefantasia");
    while($row = mysql_fetch_assoc($query)) {
        echo '                        <option value="'.$row['codigo'].'" '.(($row['codigo'] == $_POST['codigo_laboratorio'])?'selected':'').'>'.$row['nomefantasia'].'</option>'."\n";
    }
?>
                      </select></td>
                      <td width="15%" valign="bottom">
                      </td>
                    </tr>
                    <tr>
                      <td width="85%"><?php echo $r?> *<?php echo $LANG['patients']['procedure']?>:<br />
                      <input type="text" class="forms" size="80" name="procedimento" id="procedimento" /></td>
                      <td width="15%" valign="bottom"><input type="submit" name="Salvar" value="<?php echo $LANG['patients']['save']?>" class="forms" />
                      </td>
                    </tr>
                  </table>
                </td>
                <td width="3%"></td>
              </tr>
            </table>
          </fieldset><br />
          <table width="98%" border="0" cellpadding="2" cellspacing="0" align="center">
            <tr bgcolor="#009BE6">
              <td width="40%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
              <td width="10%">&nbsp;</td>
              <td width="10%">&nbsp;</td>
            </tr>
            <tr class="tabela_titulo" height="23">
              <td><?php echo $LANG['patients']['procedure']?></td>
              <td><?php echo $LANG['patients']['professional']?></td>
              <td><?php echo $LANG['patients']['laboratory']?></td>
              <td><?php echo $LANG['patients']['view']?></td>
              <td><?php echo $LANG['patients']['delete']?></td>
            </tr>
<?php
    $query = mysql_query("SELECT tlp.*, td.nome dentista, tl.nomefantasia FROM laboratorios_procedimentos tlp INNER JOIN dentistas td ON tlp.codigo_dentista = td.codigo INNER JOIN laboratorios tl ON tlp.codigo_laboratorio = tl.codigo ORDER BY datahora DESC");
    echo mysql_error();
    while($row = mysql_fetch_assoc($query)) {
        if($_SESSION['codigo'] == $row['codigo_dentista']) {
            $delete = '<a href="javascript:Ajax(\'pacientes/laboratorio\', \'conteudo\', \'codigo='.$_GET['codigo'].'&acao=editar&codigo_procedimento='.$row['codigo'].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" border="0"></a>';
        }
?>
            <tr>
              <td><input type="text" class="forms" size="40" name="procedimento_novo[]" value="<?php echo $row['procedimento']?>" id="procedimento_novo[]" onblur="Ajax('pacientes/atualiza_procedimento', 'lab_atualiza', 'codigo=<?php echo $row['codigo']?>&procedimento='%2Bthis.value)"></td>
              <td><?php echo $row['dentista']?></td>
              <td><?php echo $row['nomefantasia']?></td>
              <td align="center"><a href="javascript:Ajax('pacientes/laboratorio_status', 'conteudo', 'codigo=<?php echo $_GET['codigo']?>&acao=editar&codigo_procedimento=<?php echo $row['codigo']?>');"><img src="imagens/icones/editar.gif" border="0" /></a></td>
              <td align="center"><?php echo $delete?></td>
            </tr>
<?php
    }
?>
          </table><br />
      </form>
      </td>
    </tr>
  </table>
  <div id="lab_atualiza">&nbsp;</div>
