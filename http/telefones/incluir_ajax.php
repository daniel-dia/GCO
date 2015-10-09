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
	if(($_GET['codigo'] != '' && !verifica_nivel('contatos', 'E')) || ($_GET['codigo'] == '' && !verifica_nivel('contatos', 'I'))) {
        $disable = 'disabled';
    }
	$telefones = new TTelefones();
	if(isset($_POST[Salvar])) { 
		$obrigatorios[1] = 'nom';
		$obrigatorios[] = 'telefone1';
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
				$telefones->LoadTelefones($_GET[codigo]);
			}
			$telefones->SetDados('nome', utf8_decode ( htmlspecialchars( utf8_encode($_POST['nom']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$telefones->SetDados('endereco', utf8_decode ( htmlspecialchars( utf8_encode($_POST['endereco']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$telefones->SetDados('bairro', utf8_decode ( htmlspecialchars( utf8_encode($_POST['bairro']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$telefones->SetDados('cidade', utf8_decode ( htmlspecialchars( utf8_encode($_POST['cidade']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$telefones->SetDados('estado', $_POST[estado]);
			$telefones->SetDados('pais', utf8_decode ( htmlspecialchars( utf8_encode($_POST['pais']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$telefones->SetDados('cep', $_POST[cep]);
			$telefones->SetDados('celular', $_POST[celular]);
			$telefones->SetDados('telefone1', $_POST[telefone1]);
			$telefones->SetDados('telefone2', $_POST[telefone2]);
			$telefones->SetDados('website', $_POST[website]);
			$telefones->SetDados('email', $_POST[email]);
			if($_GET[acao] != "editar") {
				$telefones->SalvarNovo();
				//$strScrp = "alert('Cadastro realizado com sucesso!'); Ajax('telefones/incluir', 'conteudo', '');";
			}
			$strScrp = "Ajax('telefones/gerenciar', 'conteudo', '');";
			$telefones->Salvar();
		}
	}
	if($_GET[acao] == "editar") {
		$strLoCase = $LANG['useful_telephones']['editing'];
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$telefones->LoadTelefones($_GET[codigo]);
		$row = $telefones->RetornaTodosDados();
	} else {		
		if($j == 0) {
			$row = "";
		} else {
			$row = $_POST;
			$row[nome] = $_POST[nom];
		}
		$strLoCase = $LANG['useful_telephones']['including'];
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="telefones/img/telefones.png" alt="TELEFONES ÚTEIS"> <span class="h3"><?php echo $LANG['useful_telephones']['useful_telephones']?> [<?php echo $strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?php echo $strLoCase.' '.$LANG['useful_telephones']['contatc']?> </td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="telefones/incluir_ajax.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1"><?php echo $LANG['useful_telephones']['contact_information']?></span></legend>
        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287"><?php echo $r[1]?>* <?php echo $LANG['useful_telephones']['name']?> <br />
                <label>
                  <input name="nom" value="<?php echo $row[nome]?>" type="text" class="forms" <?php echo $disable?> id="nom" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"></td>
          </tr>
          <tr>
            <td><?php echo $LANG['useful_telephones']['address1']?><br />
              <input name="endereco" value="<?php echo $row[endereco]?>" type="text" class="forms" <?php echo $disable?> id="endereco" size="50" maxlength="150" /></td>
            <td><?php echo $LANG['useful_telephones']['address2']?><br />
              <input name="bairro" value="<?php echo $row[bairro]?>" type="text" class="forms" <?php echo $disable?> id="bairro" /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['useful_telephones']['city']?><br />
                <input name="cidade" value="<?php echo $row[cidade]?>" <?php echo $disable?> type="text" class="forms" <?php echo $disable?> id="cidade" size="30" maxlength="50" />
              <br /></td>
            <td><?php echo $LANG['useful_telephones']['state']?><br />
                <input name="estado" value="<?php echo $row[estado]?>" <?php echo $disable?> type="text" class="forms" <?php echo $disable?> id="estado" maxlength="50" />
            </td>
          </tr>
          <tr>
            <td><?php echo $LANG['useful_telephones']['country']?><br />
                <input name="pais" value="<?php echo $row[pais]?>" <?php echo $disable?> type="text" class="forms" <?php echo $disable?> id="pais" size="30" maxlength="50" />
              <br /></td>
            <td>&nbsp;
            </td>
          </tr>
          <tr>
            <td><?php echo $LANG['useful_telephones']['zip']?><br />
              <input name="cep" value="<?php echo $row[cep]?>" type="text" class="forms" <?php echo $disable?> id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" /></td>
            <td><?php echo $LANG['useful_telephones']['cellphone']?><br />
              <input name="celular" value="<?php echo $row[celular]?>" type="text" class="forms" <?php echo $disable?> id="celular" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td><?php echo $r[8]?>* <?php echo $LANG['useful_telephones']['phone1']?><br />
              <input name="telefone1" value="<?php echo $row[telefone1]?>" type="text" class="forms" <?php echo $disable?> id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td><?php echo $LANG['useful_telephones']['phone2']?><br />
              <input name="telefone2" value="<?php echo $row[telefone2]?>" type="text" class="forms" <?php echo $disable?> id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['useful_telephones']['email']?><br />
              <input name="email" value="<?php echo $row[email]?>" type="text" class="forms" <?php echo $disable?> id="email" size="40" /></td>
            <td><?php echo $LANG['useful_telephones']['website']?> <br />
              <input name="website" value="<?php echo $row[website]?>" type="text" class="forms" <?php echo $disable?> id="site" size="40" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
		<br />
        <div align="center"><br />
          <input name="Salvar" type="submit" class="forms" <?php echo $disable?> id="Salvar" value="<?php echo $LANG['useful_telephones']['save']?>" />
        </div>
      </form>      </td>
    </tr>
  </table>
</div>
<script>
  document.getElementById('nom').focus();
</script>
