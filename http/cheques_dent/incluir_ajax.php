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

	if(($_GET['codigo'] != '' && !verifica_nivel('cheques', 'E')) || ($_GET['codigo'] == '' && !verifica_nivel('cheques', 'I'))) {
        $disabled = 'disabled';
    }
	$cheque = new TCheques('dentista');
	if(isset($_POST[Salvar])) {
		$obrigatorios[1] = 'recebidode';
		$obrigatorios[] = 'valor';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
			    $j++;
				$r[$i] = '<font color="#FF0000">';
			}
		}
		if($j == 0) {
			if($_GET[acao] == "editar") {
				$cheque->LoadCheque($_GET[codigo]);
			}
			$cheque->SetDados('codigo_dentista', $_SESSION[codigo]);
			$cheque->SetDados('nometitular', $_POST[nometitular]);
			$cheque->SetDados('valor', $_POST[valor]);
			$cheque->SetDados('numero', $_POST[numero]);
            $cheque->SetDados('banco', $_POST[banco]);
            $cheque->SetDados('agencia', $_POST[agencia]);
			$cheque->SetDados('recebidode', $_POST[recebidode]);
			$cheque->SetDados('encaminhadopara', $_POST[encaminhadopara]);
			$cheque->SetDados('compensacao', converte_data($_POST[compensacao], 1));
			if($_GET[acao] != "editar") {
				$cheque->SalvarNovo();
			}
			$cheque->Salvar();
			echo "<script>Ajax('cheques_dent/gerenciar', 'conteudo', '')</script>";
		}
	}
	if($_GET[acao] == "editar") {
		$strLoCase = $LANG['check_control']['editing'];
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$cheque->LoadCheque($_GET[codigo]);
		$row = $cheque->RetornaTodosDados();
		$row[senha_dentista] = $_REQUEST[senha_dentista];
	} else {
		if($j == 0) {
			$row = "";
		} else {
			$row = $_POST;
		}
		$row[codigo_dentista] = $_REQUEST[codigo_dentista];
		$row[senha_dentista] = $_REQUEST[senha_dentista];
		$strLoCase = $LANG['check_control']['including'];
		$senha = mysql_fetch_array(mysql_query("SELECT * FROM `dentistas` WHERE `codigo` = '".$_REQUEST[codigo_dentista]."'"));

	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="cheques_dent/img/cheques.png" alt="<?php echo $LANG['check_control']['professional_check_control']?>"> <span class="h3"><?php echo $LANG['check_control']['professional_check_control']?> [<?php echo $strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?php echo $strLoCase?> <?php echo $LANG['check_control']['check']?> </td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="cheques_dent/incluir_ajax.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1"><?php echo $LANG['check_control']['check_information']?> </span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287" height="40"><?php echo $LANG['check_control']['holder']?> <br />
                <label>
                  <input name="nometitular" value="<?php echo $row[nometitular]?>" <?php echo $disabled?> type="text" class="forms" id="nometitular" size="50" maxlength="80" />
                </label>
                <br />
              <label></label></td>
            <td width="210"><?php echo $r[2]?>* <?php echo $LANG['check_control']['value']?><br />
              <input name="valor" value="<?php echo $row[valor]?>" <?php echo $disabled?> type="text" class="forms" id="valor" onKeypress="return Ajusta_Valor(this, event);" /></td>
          </tr>
          <tr>
            <td height="40"><?php echo $LANG['check_control']['check_number']?><br />
              <input name="numero" value="<?php echo $row[numero]?>" <?php echo $disabled?> type="text" class="forms" id="numero" size="20" maxlength="150" /></td>
            <td><?php echo $LANG['check_control']['bank']?><br />
              <input name="banco" value="<?php echo $row[banco]?>" <?php echo $disabled?> type="text" class="forms" id="banco" /></td>
          </tr>
          <tr>
            <td height="40"><?php echo $LANG['check_control']['agency_number']?>:<br />
                <input name="agencia" value="<?php echo converte_data($row[agencia], 2)?>" <?php echo $disabled?> type="text" class="forms" id="agencia" size="20" maxlength="20" />
              <br /></td>
            <td><?php echo $LANG['check_control']['compensation_date']?>:<br />
                <input name="compensacao" value="<?php echo converte_data($row[compensacao], 2)?>" <?php echo $disabled?> type="text" class="forms" id="compensacao" size="14" maxlength="50" onKeypress="return Ajusta_Data(this, event);" />
              <br /></td>
          </tr>
          <tr>
            <td height="40"><?php echo $r[5]?>* <?php echo $LANG['check_control']['received_from']?>:<br />
                <input name="recebidode" value="<?php echo $row[recebidode]?>" <?php echo $disabled?> type="text" class="forms" id="recebidode" size="40" maxlength="50" />
              <br /></td>
            <td><?php echo $LANG['check_control']['forwarded_to']?>:<br />
                <input name="encaminhadopara" value="<?php echo $row[encaminhadopara]?>" <?php echo $disabled?> type="text" class="forms" id="encaminhadopara" size="40" maxlength="50" />
                <input name="codigo_dentista" value="<?php echo $row[codigo_dentista]?>" type="hidden">
                <input name="senha_dentista" value="<?php echo $row[senha_dentista]?>" type="hidden"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
		<br />
        <div align="center"><br />
          <input name="Salvar" type="submit" class="forms" id="Salvar" value="<?php echo $LANG['check_control']['save']?>" <?php echo $disabled?> />
        </div>
      </form>      </td>
    </tr>
  </table>
</div>
