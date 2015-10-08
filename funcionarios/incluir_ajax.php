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
	if(($_GET['codigo'] != '' && !verifica_nivel('funcionarios', 'E')) || ($_GET['codigo'] == '' && !verifica_nivel('funcionarios', 'I'))) {
		$disable = 'disabled';
		$disable2 = $disable;
		if($_GET['codigo'] == $_SESSION['codigo']) {
			$disable2 = '';
		}
	}
	$funcionario = new TFuncionarios();
	if(isset($_POST[Salvar])) {
		if($_POST[sosenha] == 'true') {
			if($_POST[senha] != '') {
				if($_POST[senha] != $_POST[confsenha]) {
					$j++;
					$r[29] = '<font color="#FF0000">';
					$r[30] = '<font color="#FF0000">';
				}
				$senha = mysql_fetch_array(mysql_query("SELECT * FROM `funcionarios` WHERE `codigo` = '".$_GET[codigo]."'"));
				if(md5($_POST[senhaatual]) != $senha[senha] && (checknivel('Dentista') || checknivel('Funcionario'))) {
					$j++;
					$r[28] = '<font color="#FF0000">';
				}
			}
			if($j == 0) {
				$funcionario->LoadFuncionario($_GET[codigo]);
				$strScrp = "Ajax('funcionarios/gerenciar', 'conteudo', '');";	
				if($_POST[senha] != "") {
					$funcionario->SetDados('senha', md5($_POST[senha]));
				}
				$funcionario->Salvar();
			}
		} else {
			$obrigatorios[1] = 'nom';
			$obrigatorios[] = 'funcao1';
			$obrigatorios[] = 'login';
			$i = $j = 0;
			foreach($_POST as $post => $valor) {
				$i++;
				if(array_search($post, $obrigatorios) && $valor == "") {
				    $j++;
					$r[$i] = '<font color="#FF0000">';
				}
			}
			if($_POST[senha] != $_POST[confsenha] || $_POST[senha] == "" && $_GET[acao] != "editar") {
				$j++;
				$r[28] = '<font color="#FF0000"> *';
				$r[29] = '<font color="#FF0000"> *';
			}
			if($_POST[senha] != '' && $_GET[acao] == 'editar') {
				if($_POST[senha] != $_POST[confsenha]) {
					$j++;
					$r[29] = '<font color="#FF0000">';
					$r[30] = '<font color="#FF0000">';
				}
				$senha = mysql_fetch_array(mysql_query("SELECT * FROM `funcionarios` WHERE `codigo` = '".$_GET[codigo]."'"));
				if(md5($_POST[senhaatual]) != $senha[senha] && (checknivel('Dentista') || checknivel('Funcionario'))) {
					$j++;
					$r[28] = '<font color="#FF0000">';
				}
			}
			if($j == 0) {
				if($_GET[acao] == "editar") {
					$funcionario->LoadFuncionario($_GET['codigo']);
					$strScrp = "Ajax('funcionarios/gerenciar', 'conteudo', '');";
				}

				$funcionario->SetDados('nome', utf8_decode ( htmlspecialchars( utf8_encode($_POST['nom']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
				$funcionario->SetDados('cpf', $_POST[cpf]);
				if($_POST[senha] != "") {
					$funcionario->SetDados('senha', md5($_POST[senha]));
				}
				$funcionario->SetDados('login', $_POST[login]);
				$funcionario->SetDados('rg', $_POST[rg]);
				$funcionario->SetDados('estadocivil', $_POST[estadocivil]);
				$funcionario->SetDados('endereco', $_POST[endereco]);
				$funcionario->SetDados('bairro', $_POST[bairro]);
				$funcionario->SetDados('cidade', $_POST[cidade]);
				$funcionario->SetDados('estado', $_POST[estado]);
				$funcionario->SetDados('pais', $_POST[pais]);
				$funcionario->SetDados('cep', $_POST[cep]);
				$funcionario->SetDados('nascimento', converte_data($_POST[nascimento], 1));
				$funcionario->SetDados('telefone1', $_POST[telefone1]);
				$funcionario->SetDados('telefone2', $_POST[telefone2]);
				$funcionario->SetDados('celular', $_POST[celular]);
				$funcionario->SetDados('sexo', $_POST[sexo]);
				$funcionario->SetDados('email', $_POST[email]);
				$funcionario->SetDados('nomemae', $_POST[nomemae]);
				$funcionario->SetDados('nascimentomae', converte_data($_POST[nascimentomae], 1));
				$funcionario->SetDados('nomepai', $_POST[nomepai]);
				$funcionario->SetDados('nascimentopai', converte_data($_POST[nascimentopai], 1));
				$funcionario->SetDados('enderecofamiliar', $_POST[enderecofamiliar]);
				$funcionario->SetDados('funcao1', $_POST[funcao1]);
				$funcionario->SetDados('funcao2', $_POST[funcao2]);
				$funcionario->SetDados('admissao', converte_data($_POST[admissao], 1));
				$funcionario->SetDados('demissao', converte_data($_POST[demissao], 1));
				$funcionario->SetDados('observacoes', $_POST[observacoes]);
				$funcionario->SetDados('ativo', $_POST[ativo]);
				$funcionario->SetDados('usuario', $_POST[usuario]);
				if($_GET[acao] != "editar") {
					$funcionario->SalvarNovo();
				}
				$funcionario->Salvar();
				$strScrp = "Ajax('funcionarios/gerenciar', 'conteudo', 'codigo=".$_POST['codigo']."&acao=editar');";
			}
		}
	}
	if($_GET[acao] == "editar") {
		$strLoCase = $LANG['employee']['editing'];
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$funcionario->LoadFuncionario($_GET[codigo]);
		$row = $funcionario->RetornaTodosDados();
		$row[nascimento] = converte_data($row[nascimento], 2);
		$row[nascimentomae] = converte_data($row[nascimentomae], 2);
		$row[nascimentopai] = converte_data($row[nascimentopai], 2);
		$row[admissao] = converte_data($row[admissao], 2);
		$row[demissao] = converte_data($row[demissao], 2);
	} else {
		if(checknivel('Dentista') || checknivel('Funcionario')) {
			die('<script>alert(\''.substr($frase_adm, 12).'\'); Ajax(\'funcionarios/gerenciar\', \'conteudo\', \'\')</script>');
		}
		if($j == 0) {
			$row = "";
		} else {
			$row = $_POST;
			$row[nome] = $_POST[nom];
		}
		$strLoCase = $LANG['employee']['including'];
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="funcionarios/img/funcionario.png" alt="<?php echo $LANG['employee']['manage_employee']?>" width="21" height="31"> <span class="h3"><?php echo $LANG['employee']['manage_employee']?> [<?php echo $strLoCase?>] </span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?php echo $strLoCase.' '.$LANG['employee']['employee']?></td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="funcionarios/incluir_ajax.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><fieldset>
        <legend><span class="style1"><?php echo $LANG['employee']['personal_information']?></span></legend>
        <table width="592" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="280"><?php echo $r[1]?>* <?php echo $LANG['employee']['name']?><br />
                <label>
                  <input name="nom" value="<?php echo $row[nome]?>" <?php echo $disable?> type="text" class="forms" id="nom" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="156"><?php echo $LANG['employee']['document1']?><br />
			  <input name="cpf" value="<?php echo $row[cpf]?>" type="text" class="forms" id="cpf" maxlength="50" />
            </td>
            <td width="156" rowspan="10" valign="top"><br />
    		<iframe height="300" scrolling="No" name="foto_frame" id="foto_frame" width="150" src="funcionarios/fotos.php?codigo=<?php echo $row[codigo]?><?php echo (($_GET[acao] != "editar")?'&disabled=yes':'')?>" frameborder="0"></iframe>
            </td>
   		  </tr>
          <tr>
            <td><?php echo $LANG['employee']['document2']?><br />
              <input name="rg" value="<?php echo $row[rg]?>" <?php echo $disable?> type="text" class="forms" id="rg" /></td>
            <td><?php echo $LANG['employee']['relationship_status']?><br /><select name="estadocivil" <?php echo $disable?> class="forms" id="estadocivil">
<?php
	$valores = array('solteiro' => $LANG['employee']['single'], 'casado' => $LANG['employee']['married'], 'divorciado' => $LANG['employee']['divorced'], 'viuvo' => $LANG['employee']['widowed']);
	foreach($valores as $chave => $valor) {
		if($row[estadocivil] == $chave) {
			echo '<option value="'.$chave.'" selected>'.$valor.'</option>';
		} else {
			echo '<option value="'.$chave.'">'.$valor.'</option>';
		}
	}
?>       
			 </select></td>
          </tr>
          <tr>
            <td><?php echo $LANG['employee']['address1']?><br />
              <input name="endereco" value="<?php echo $row[endereco]?>" <?php echo $disable?> type="text" class="forms" id="endereco" size="50" maxlength="150" /></td>
            <td><?php echo $LANG['employee']['address2']?><br />
              <input name="bairro" value="<?php echo $row[bairro]?>" <?php echo $disable?> type="text" class="forms" id="bairro" /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['employee']['city']?><br />
                <input name="cidade" value="<?php echo $row[cidade]?>" <?php echo $disable?> type="text" class="forms" id="cidade" size="30" maxlength="50" />
              <br /></td>
            <td><?php echo $LANG['employee']['state']?><br />
                <input name="estado" value="<?php echo $row[estado]?>" <?php echo $disable?> type="text" class="forms" id="estado" maxlength="50" />
            </td>
          </tr>
          <tr>
            <td><?php echo $LANG['employee']['country']?><br />
                <input name="pais" value="<?php echo $row[pais]?>" <?php echo $disable?> type="text" class="forms" id="pais" size="30" maxlength="50" />
              <br /></td>
            <td>&nbsp;
            </td>
          </tr>
          <tr>
            <td><?php echo $LANG['employee']['zip']?><br />
              <input name="cep" value="<?php echo $row[cep]?>" <?php echo $disable?> type="text" class="forms" id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" /></td>
            <td><?php echo $LANG['employee']['birthdate']?><br />
              <input name="nascimento" value="<?php echo $row[nascimento]?>" <?php echo $disable?> type="text" class="forms" id="nascimento" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['employee']['phone1']?><br />
              <input name="telefone1" value="<?php echo $row[telefone1]?>" <?php echo $disable?> type="text" class="forms" id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td><?php echo $LANG['employee']['phone2']?><br />
              <input name="telefone2" value="<?php echo $row[telefone2]?>" <?php echo $disable?> type="text" class="forms" id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['employee']['cellphone']?><br />
              <input name="celular" value="<?php echo $row[celular]?>" <?php echo $disable?> type="text" class="forms" id="celular" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" /></td>
            <td><?php echo $LANG['employee']['gender']?><br /><select name="sexo" <?php echo $disable?> class="forms" id="sexo">
<?php
	$valores = array('Masculino' => $LANG['employee']['male'], 'Feminino' => $LANG['employee']['female']);
	foreach($valores as $chave => $valor) {
		if($row[sexo] == $chave) {
			echo '<option value="'.$chave.'" selected>'.$valor.'</option>';
		} else {
			echo '<option value="'.$chave.'">'.$valor.'</option>';
		}
	}
?>       
			 </select></td>
          </tr>
          <tr>
            <td><?php echo $LANG['employee']['email']?><br />
              <input name="email" value="<?php echo $row[email]?>" <?php echo $disable?> type="text" class="forms" id="email" size="50" /></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <br />
         <fieldset>
        <legend><span class="style1"><?php echo $LANG['employee']['familiar_information']?></span></legend>

        <table width="497" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="287"><?php echo $LANG['employee']['mothers_name']?><br />
                <label>
                <input name="nomemae" value="<?php echo $row[nomemae]?>" <?php echo $disable?> type="text" class="forms" id="nome_mae" size="50" maxlength="80" />
                </label>
                <br />
                <label></label></td>
            <td width="210"><?php echo $LANG['employee']['birthdate']?><br />
                <input name="nascimentomae" value="<?php echo $row[nascimentomae]?>" <?php echo $disable?> type="text" class="forms" id="nascimento_mae" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['employee']['fathers_name']?><br />
              <input name="nomepai" value="<?php echo $row[nomepai]?>" <?php echo $disable?> type="text" class="forms" id="nome_pai" size="50" maxlength="80" /></td>
            <td><?php echo $LANG['employee']['birthdate']?><br />
                <input name="nascimentopai" value="<?php echo $row[nascimentopai]?>" <?php echo $disable?> type="text" class="forms" id="nascimento_pai" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo $LANG['employee']['complete_address_in_case_of_be_different_from_personal']?><br />
                <input name="enderecofamiliar" value="<?php echo $row[enderecofamiliar]?>" <?php echo $disable?> type="text" class="forms" id="endereco_familiar" size="78" maxlength="220" />                <br /></td>
            </tr>
        </table>
        </fieldset>

         <fieldset>
        <legend><span class="style1"><?php echo $LANG['employee']['professional_information']?> </span></legend>

        <table width="519" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="264"><?php echo $r[21]?>* <?php echo $LANG['employee']['main_function']?> <br />
                <label>
                <input name="funcao1" value="<?php echo $row[funcao1]?>" <?php echo $disable?> type="text" class="forms" id="funcao1" size="40" maxlength="80" />
                </label>
                <br />
                <br />
                <label></label></td>
            <td width="255"><?php echo $LANG['employee']['secondary_function']?><br />
              <label>
              <input name="funcao2" value="<?php echo $row[funcao2]?>" <?php echo $disable?> type="text" class="forms" id="funcao2" size="40" maxlength="80" />
              <br />
              <br />
              </label></td>
          </tr>
          <tr>
            <td><label><?php echo $LANG['employee']['admission_date']?><br />
                <input name="admissao" value="<?php echo $row[admissao]?>" <?php echo $disable?> type="text" class="forms" id="data_admissao" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" />
                <br />
              </label></td>
            <td><?php echo $LANG['employee']['resignation_date']?><br />
              <input name="demissao" value="<?php echo $row[demissao]?>" <?php echo $disable?> type="text" class="forms" id="data_demissao" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" /></td>
          </tr>
          <tr>
            <td><br /><?php echo $LANG['employee']['comments']?><br />
              <label>
              <textarea name="observacoes" <?php echo $disable?> cols="25" rows="4"><?php echo $row[observacoes]?></textarea>
              </label></td>
            <td valign="top"><br /><?php echo $LANG['employee']['active_on_clinic']?>?<br />
              <label>
              <select name="ativo" <?php echo $disable?> class="forms" id="ativo">
<?php
	$valores = array('Sim' => $LANG['employee']['yes'], 'Não' => $LANG['employee']['no']);
	foreach($valores as $chave => $valor) {
		if($row[ativo] == $chave) {
			echo '<option value="'.$chave.'" selected>'.$valor.'</option>';
		} else {
			echo '<option value="'.$chave.'">'.$valor.'</option>';
		}
	}
?>       
			 </select>
              </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>	
	    <br />
        <fieldset>
        <legend><span class="style1"><?php echo $LANG['employee']['personal_access_information']?></span></legend>
        <table width="287" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td><?php echo $r[27]?><?php echo $LANG['employee']['login']?> <br />
              <input name="usuario" value="<?php echo $row[usuario]?>" <?php echo $disable?> type="text" class="forms" id="usuario" maxlength="15" />
              <br />
              <br /></td>
          </tr>
<?php
	$x = 28;
	if($disable == 'disabled' && $disable2 == '') {
		echo '<input type="hidden" name="sosenha" value="true">';
	}
	if($_GET[acao] == 'editar' && (checknivel('Dentista') || checknivel('Funcionario'))) {
		$nova = "Nova ";
?>
          <tr>
            <td width="287"><?php echo $r[28]?><?php echo $LANG['employee']['current_password']?> <br />
              <input name="senhaatual" value="" <?php echo $disable2?> type="password" class="forms" id="senhaatual" maxlength="32" />
              <br />
              <br />              </td>
          </tr>
<?php
		$x++;
	}
?>
          <tr>
            <td><?php echo $r[$x]?><?php echo $LANG['employee']['new_password']?> <br />
              <input name="senha" value="" <?php echo $disable2?> type="password" class="forms" id="senha" maxlength="32" />
              <br />
              <br /></td>
          </tr>
          <tr>
            <td><?php echo $r[($x+1)]?><?php echo $LANG['employee']['retype_new_password']?><br />
              <input name="confsenha" value="" <?php echo $disable2?> type="password" class="forms" id="confsenha" maxlength="32" />
              <br />
              <br /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <div align="center"><br />
          <input name="Salvar" type="submit" <?php echo $disable2?> class="forms" id="Salvar" value="<?php echo $LANG['employee']['save']?>" />
        </div>
      </form>      </td>
    </tr>
    <tr>
      <td align="right">
        <img src="imagens/icones/imprimir.gif"> <a href="relatorios/funcionario.php?codigo=<?php echo $row['codigo']?>" target="_blank"><?php echo $LANG['employee']['print_sheet']?></a>&nbsp;
      </td>
    </tr>
  </table>
</div>
<script>
  document.getElementById('nom').focus();
</script>
