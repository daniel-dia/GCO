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
	if(($_GET['codigo'] != '' && !verifica_nivel('patrimonio', 'E')) || ($_GET['codigo'] == '' && !verifica_nivel('patrimonio', 'I'))) {
        $disable = 'disabled';
    }
	$patrimonio = new TPatrimonios();
	if(isset($_POST[Salvar])) {	
		$obrigatorios[1] = 'codigo';
		$obrigatorios[] = 'descricao';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
				$r[$i] = '<font color="#FF0000">';
			    $j++;
			}
		}
		if($j == 0) {
			if($_GET[acao] == "editar") {
				$patrimonio->LoadPatrimonio($_GET[codigo]);
				$strScrp = "Ajax('patrimonio/gerenciar', 'conteudo', '');";
			}
			$patrimonio->SetDados('codigo', $_POST[codigo]);
			$patrimonio->SetDados('setor', $_POST[setor]);
			$patrimonio->SetDados('descricao', $_POST[descricao]);
			$patrimonio->SetDados('valor', $_POST[valor]);
			$patrimonio->SetDados('dataaquisicao', $_POST[dataaquisicao]);
			$patrimonio->SetDados('tempogarantia', $_POST[tempogarantia]);
			$patrimonio->SetDados('cor', $_POST[cor]);
			$patrimonio->SetDados('quantidade', $_POST[quantidade]);
			$patrimonio->SetDados('fornecedor', $_POST[fornecedor]);
			$patrimonio->SetDados('numeronotafiscal', $_POST[numeronotafiscal]);
			$patrimonio->SetDados('dimensoes', $_POST[dimensoes]);
			$patrimonio->SetDados('observacoes', $_POST[observacoes]);
			if($_GET[acao] != "editar") {
				$patrimonio->SalvarNovo();
				$strScrp = "Ajax('patrimonio/gerenciar', 'conteudo', '');";
			}
			$patrimonio->Salvar();
		}
	}
	if($_GET[acao] == "editar") {
		$strLoCase = $LANG['patrimony']['editing'];
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$patrimonio->LoadPatrimonio($_GET[codigo]);
		$row = $patrimonio->RetornaTodosDados();
	} else {
		$strLoCase = $LANG['patrimony']['including'];
		$row = $_POST;
		$row[nome] = $_POST[nom];
		if(!isset($_POST[codigo]) || $j == 0) {
			$row = "";
			$row[codigo] = next_autoindex('patrimonio');
		} else {
			$row[codigo] = $_POST[codigo];
		}
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="patrimonio/img/patrimonio.png" alt="<?php echo $LANG['patrimony']['manage_patrimony']?>"> <span class="h3"><?php echo $LANG['parimony']['manage_patrimony']?> [<?php echo $strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?php echo $strLoCase?></td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="patrimonio/incluir_ajax.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1"><?php echo $LANG['patrimony']['patrimony_information']?></span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo $r[1]?>* <?php echo $LANG['patrimony']['code']?><br />
              <input name="codigo" value="<?php echo $row[codigo]?>" type="text" class="forms" <?php echo $disable?> id="codigo" /></td>
            <td><?php echo $LANG['patrimony']['sector']?><br />
              <input name="setor" value="<?php echo $row[setor]?>" type="text" class="forms" <?php echo $disable?> id="setor" /></td>
          </tr>
          <tr>
            <td width="287"><?php echo $r[3]?>* <?php echo $LANG['patrimony']['description']?><br />
                <label>
                  <input name="descricao" value="<?php echo $row[descricao]?>" type="text" class="forms" <?php echo $disable?> id="descricao" size="45" maxlength="150" />
                </label>
                <label></label></td>
            <td width="210"><?php echo $LANG['patrimony']['value']?><br />
              <input name="valor" type="text" class="forms" <?php echo $disable?> id="valor" value="<?php echo $row[valor]?>" onKeypress="return Ajusta_Valor(this, event);" /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['patrimony']['acquisition_date']?> <br />
              <input name="dataaquisicao" value="<?php echo $row[dataaquisicao]?>" type="text" class="forms" <?php echo $disable?> id="dataaquisicao" maxlength="150" onKeypress="return Ajusta_Data(this, event);" /></td>
            <td><?php echo $LANG['patrimony']['warranty_time']?><br />
              <input name="tempogarantia" type="text" class="forms" <?php echo $disable?> id="tempogarantia" value="<?php echo $row[tempogarantia]?>" /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['patrimony']['color']?><br />
                <input name="cor" value="<?php echo $row[cor]?>" type="text" class="forms" <?php echo $disable?> id="cor" size="15" maxlength="50" /></td>
            <td><?php echo $LANG['patrimony']['quantity']?><br />
                <input name="quantidade" value="<?php echo $row[quantidade]?>" type="text" class="forms" <?php echo $disable?> id="quantidade" /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['patrimony']['supplier']?><br />
                <input name="fornecedor" value="<?php echo $row[fornecedor]?>" type="text" class="forms" <?php echo $disable?> id="fornecedor" size="30" maxlength="50" />
              <br /></td>
            <td><?php echo $LANG['patrimony']['legal_document']?> <br />
              <input name="numeronotafiscal" value="<?php echo $row[numeronotafiscal]?>" type="text" class="forms" <?php echo $disable?> id="numeronotafiscal" /></td>
          </tr>
          <tr>
            <td valign="top"><?php echo $LANG['patrimony']['dimensions']?><br />
              <input name="dimensoes" value="<?php echo $row[dimensoes]?>" type="text" class="forms" <?php echo $disable?> id="dimensoes" /></td>
            <td><?php echo $LANG['patrimony']['comments']?><br />
              <textarea name="observacoes" cols="25" rows="5" class="forms" <?php echo $disable?> id="observacoes"><?php echo $row[observacoes]?></textarea></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
		<br />
        <div align="center"><br />
          <input name="Salvar" type="submit" class="forms" <?php echo $disable?> id="Salvar" value="<?php echo $LANG['patrimony']['save']?>" />
        </div>
      </form>      </td>
    </tr>
  </table>
</div>
