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
	include "../timbre_head.php";
	$sql = "SELECT * FROM v_orcamento WHERE codigo_orcamento = ".$_GET['codigo'];
	$query = mysql_query($sql) or die('Line 40: '.mysql_error());
	$row = mysql_fetch_array($query);
?>
<font size="3"><?php echo $LANG['reports']['patient']?>: <b><?php echo $row['paciente'].' ['.$row['codigo_paciente'].']'?></b><br /></font><font style="font-size: 3px;">&nbsp;<br /></font>
<font size="2"><?php echo $LANG['reports']['plots_for_odontological_treatment']?> <b><?php echo (($row['sexo_dentista'] == 'Masculino')?'Dr.':'Dra.').' '.$row['dentista']?></b></font><br /><br />
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse">
<?php
    $i = 1;
	$sql = "SELECT * FROM v_orcamento WHERE codigo_orcamento = ".$_GET['codigo']." ORDER BY codigo_parcela LIMIT ".$row['parcelas'];
    $query = mysql_query($sql) or die('Line 48: '.mysql_error());
    while($row = mysql_fetch_array($query)) {
?>
  <tr style="font-size: 12px">
    <td width="38%" align="center" valign="middle">
      <font size="5"><?php echo $i?></font>&nbsp;&nbsp;<img align="middle" src="codigo_barra.php?codigo=<?php echo (completa_zeros($row['codigo_parcela'], ZEROS))?>" border="0">
    </td>
    <td width="32%" align="center" valign="middle">
      <table width="95%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td width="38%" valign="top" align="left" height="20"><font style="font-size: 11px;">
            Valor: </font>
          </td>
          <td width="62%" valign="top" align="left"><font style="font-size: 11px;">
            <b><?php echo $LANG['general']['currency'].' '.money_form($row['valor'])?></b>
          </td>
        </tr>
        <tr>
          <td align="left"><font style="font-size: 11px;">
            <?php echo $LANG['reports']['payment_due']?>: </font>
          </td>
          <td align="left"><font style="font-size: 11px;">
            <b><?php echo converte_data($row['data'], 2)?></b>
          </td>
        </tr>
      </table>
    </td>
    <td width="30%" align="center" valign="top">
      <font style="font-size: 8px;"><?php echo $LANG['reports']['employee_signature']?></font>
    </td>
  </tr>
<?php
        flush();
        $i++;
    }
?>
</table>
<script>
window.print();
</script>
<?php
    include "../timbre_foot.php";
?>
