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
	if(!verifica_nivel('permissoes', 'V')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
    $_GET['nivel'] = (($_GET['nivel'] != '')?$_GET['nivel']:'Dentista');
	if(isset($_POST['enviar'])) {
        unset($_POST['nivel'], $_POST['enviar']);
        mysql_query("DELETE FROM permissoes WHERE nivel = '".$_GET['nivel']."'");
        echo mysql_error();
        foreach($_POST as $area => $perm) {
            mysql_query("INSERT INTO permissoes VALUES ('".$_GET['nivel']."', '".$area."', '".implode(',', $perm)."')");
        }
        echo '<script type="text/javascript">Ajax("configuracoes/permissoes", "conteudo", "nivel='.$_GET['nivel'].'")</script>';
        /*echo '<pre>';
        print_r($_POST);
        echo '</pre>';*/
	}
?>
<style>
.texto1 tr:hover {
    background-color: #C0C0C0;
}
</style>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="wallpapers/img/login.png" alt="<?php echo $LANG['settings']['permissions']?>"> <span class="h3"><?php echo $LANG['settings']['permissions']?></span></td>
      <td width="6%" valign="bottom"></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td height="23"><?php echo $LANG['admin_password']['change_admin_password']?></td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="configuracoes/permissoes_ajax.php?nivel=<?php echo $_GET['nivel']?>" onsubmit="formSender(this, 'conteudo'); return false;">
        <fieldset>
        <legend><span class="style1"><?php echo $LANG['settings']['permissions']?></span></legend>
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td align="center"><select name="nivel" class="forms" onchange="javascript:Ajax('configuracoes/permissoes', 'conteudo', '&nivel='%2Bthis.value)">
<?php
    $valores = array('Dentista' => $LANG['settings']['professionals'], 'Funcionario' => $LANG['settings']['employees']);
    foreach($valores as $chave => $valor) {
        echo '            <option value="'.$chave.'" '.(($_GET['nivel'] == $chave)?'selected':'').'>'.$valor.'</option>'."\n";
    }
?>
            </select></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="3" align="center" class="texto">
              <tr class="tabela_titulo">
                <td width="40%" align="center"><?php echo $LANG['settings']['module']?></td>
                <td width="12%" align="center"><?php echo $LANG['settings']['access']?></td>
                <td width="12%" align="center"><?php echo $LANG['settings']['view']?></td>
                <td width="12%" align="center"><?php echo $LANG['settings']['edit']?></td>
                <td width="12%" align="center"><?php echo $LANG['settings']['insert']?></td>
                <td width="12%" align="center"><?php echo $LANG['settings']['delete']?></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="3" align="center" class="texto1">
              <tr>
                <td colspan="6"><b><?php echo $LANG['menu']['files']?></b></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'profissionais'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td width="40%">&nbsp;&nbsp;<?php echo $LANG['menu']['professionals']?></td>
                <td width="12%" align="center"><input type="checkbox" name="profissionais[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td width="12%" align="center"><input type="checkbox" name="profissionais[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td width="12%" align="center"><input type="checkbox" name="profissionais[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td width="12%" align="center"><input type="checkbox" name="profissionais[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td width="12%" align="center"><input type="checkbox" name="profissionais[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'pacientes'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['patients']?></td>
                <td align="center"><input type="checkbox" name="pacientes[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="pacientes[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="pacientes[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="pacientes[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="pacientes[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'funcionarios'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['employees']?></td>
                <td align="center"><input type="checkbox" name="funcionarios[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="funcionarios[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="funcionarios[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="funcionarios[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="funcionarios[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'fornecedores'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['supliers']?></td>
                <td align="center"><input type="checkbox" name="fornecedores[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="fornecedores[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="fornecedores[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="fornecedores[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="fornecedores[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'agenda'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['calendar']?></td>
                <td align="center"><input type="checkbox" name="agenda[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"><input type="checkbox" name="agenda[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'patrimonio'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['patrimony']?></td>
                <td align="center"><input type="checkbox" name="patrimonio[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="patrimonio[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="patrimonio[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="patrimonio[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="patrimonio[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'estoque'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['stock_control']?></td>
                <td align="center"><input type="checkbox" name="estoque[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="estoque[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="estoque[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="estoque[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="estoque[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'laboratorios'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['laboratory']?></td>
                <td align="center"><input type="checkbox" name="laboratorios[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="laboratorios[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="laboratorios[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="laboratorios[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="laboratorios[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'convenios'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['plans']?></td>
                <td align="center"><input type="checkbox" name="convenios[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="convenios[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="convenios[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="convenios[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="convenios[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'honorarios'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $LANG['menu']['fee_table']?></td>
                <td align="center"><input type="checkbox" name="honorarios[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="honorarios[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="honorarios[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="honorarios[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="honorarios[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
              <tr>
                <td colspan="6"><b><?php echo $LANG['menu']['monetary']?></b></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'contas_pagar'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['accounts_payable']?></td>
                <td align="center"><input type="checkbox" name="contas_pagar[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contas_pagar[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contas_pagar[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contas_pagar[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contas_pagar[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'contas_receber'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['accounts_receivable']?></td>
                <td align="center"><input type="checkbox" name="contas_receber[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contas_receber[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contas_receber[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contas_receber[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contas_receber[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'caixa'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['cash_flow']?></td>
                <td align="center"><input type="checkbox" name="caixa[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"><input type="checkbox" name="caixa[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="caixa[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'cheques'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['check_control']?></td>
                <td align="center"><input type="checkbox" name="cheques[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="cheques[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="cheques[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="cheques[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="cheques[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'pagamentos'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['payments']?></td>
                <td align="center"><input type="checkbox" name="pagamentos[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
              </tr>
              <tr>
                <td colspan="6"><b><?php echo $LANG['menu']['utilities']?></b></td>
              </tr>
              <tr>
                <td colspan="6">&nbsp;&nbsp;<b><?php echo $LANG['menu']['files']?></b></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'arquivos_clinica'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $LANG['menu']['clinic_files']?></td>
                <td align="center"><input type="checkbox" name="arquivos_clinica[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="arquivos_clinica[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"><input type="checkbox" name="arquivos_clinica[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="arquivos_clinica[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'manuais'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $LANG['menu']['manuals_and_codes']?></td>
                <td align="center"><input type="checkbox" name="manuais[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="manuais[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'contatos'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['usefull_telephones']?></td>
                <td align="center"><input type="checkbox" name="contatos[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contatos[]" value="V" <?php echo ((in_array('V', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contatos[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contatos[]" value="I" <?php echo ((in_array('I', $perm))?'checked':'')?> /></td>
                <td align="center"><input type="checkbox" name="contatos[]" value="A" <?php echo ((in_array('A', $perm))?'checked':'')?> /></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'backup_gerar'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['backup_generation']?></td>
                <td align="center"><input type="checkbox" name="backup_gerar[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'backup_restaurar'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['backup_restoration']?></td>
                <td align="center"><input type="checkbox" name="backup_restaurar[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
              </tr>
              <tr>
                <td colspan="6"><b><?php echo $LANG['menu']['configuration']?></b></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'informacoes'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['clinic_information']?></td>
                <td align="center"><input type="checkbox" name="informacoes[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"><input type="checkbox" name="informacoes[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"></td>
              </tr>
<?php
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$_GET['nivel']."' AND area = 'idiomas'"));
    $perm = explode(',', $row['permissao']);
?>
              <tr>
                <td>&nbsp;&nbsp;<?php echo $LANG['menu']['language']?></td>
                <td align="center"><input type="checkbox" name="idiomas[]" value="L" <?php echo ((in_array('L', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"><input type="checkbox" name="idiomas[]" value="E" <?php echo ((in_array('E', $perm))?'checked':'')?> /></td>
                <td align="center"></td>
                <td align="center"></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><input name="enviar" type="submit" class="forms" id="enviar" value="<?php echo $LANG['settings']['save']?>" /></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
        </table>
        </fieldset>
      </form>
      </td>
    </tr>
  </table>
