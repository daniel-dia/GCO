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
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
	if(!verifica_nivel('pagamentos', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if(isset($_POST['Salvar'])) {
        $row = mysql_fetch_array(mysql_query("SELECT * FROM v_orcamento WHERE pago = 'Não' AND codigo_parcela = ".$_POST['parcela']));
        mysql_query("UPDATE parcelas_orcamento SET pago = 'Sim', datapgto = '".date('Y-m-d')."', valor = '".$_POST['valor']."' WHERE codigo = ".$_POST['parcela']);
        mysql_query("INSERT INTO caixa (data, dc, valor, descricao) VALUES ('".date('Y-m-d')."', '+', '".$_POST['valor']."', 'Pagamento da parcela ".$row['codigo_parcela']." - Paciente: ".$row['paciente']." - Dentista: ".$row['dentista']."')");
        echo '<script>if(confirm("'.$LANG['payment']['payment_successfully_done'].'\n\n'.$LANG['payment']['patient'].': '.$row['paciente'].'\n\n'.$LANG['payment']['professional'].': '.(($row['sexo_dentista'] == 'Masculino')?'Dr. ':'Dra. ').$row['dentista'].'\n\n'.$LANG['payment']['total_to_pay'].': '.$LANG['general']['currency'].' '.money_form($_POST['valor']).'\n\n'.$LANG['payment']['deadline'].': '.converte_data($row['data'], 2).'\n\n'.$LANG['payment']['payment_date'].': '.date('d/m/Y').'\n\n'.$LANG['payment']['do_you_wish_to_print_the_receipt'].'")) { window.open("relatorios/recibo.php?codigo_parcela='.$_POST['parcela'].'", "'.$LANG['payment']['receipt'].'",  "height=350,width=320,status=yes,toolbar=no,menubar=no,location=no") }</script>';
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="pagamentos/img/parcelas.png" alt="<?php echo $LANG['payment']['payment']?>"> <span class="h3"><?php echo $LANG['payment']['payment']?> </span></td>
      <td width="6%" valign="bottom"></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="26"><?php echo $LANG['payment']['payment']?> </td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pagamentos/parcelas_ajax.php" onsubmit="formSender(this, 'conteudo'); return false;">
      <fieldset>
        <legend><span class="style1"><?php echo $LANG['payment']['plot_information']?> </span></legend>
        <table width="450" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><?php echo $LANG['payment']['pass_the_optic_reader_or']?><BR><?php echo $LANG['payment']['type_the_bar_code']?><BR><br />
                  <input autocomplete="off" name="parcela" value="<?php echo $_GET['codigo']?>" <?php echo $disable?> type="text" class="forms" id="parcela" size="50" maxlength="11" onkeypress="return Bloqueia_Caracteres(event);" onkeyup="javascript:Ajax('pagamentos/dadosparcela', 'pagamento', 'parcela='%2Bthis.value)" />
            </td>
          </tr>
          <tr>
            <td align="center"><div id="pagamento"></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
      </fieldset>
      </form>
      </td>
    </tr>
  </table>
</div>
<script>
document.getElementById('parcela').focus();
Ajax('pagamentos/dadosparcela', 'pagamento', 'parcela=<?php echo $_GET['codigo']?>');
</script>
