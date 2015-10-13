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
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) {
		die($frase_log);
	}
	include "../timbre_head.php";
	$row = mysql_fetch_assoc(mysql_query("SELECT * FROM radiografias WHERE codigo = ".$_GET['codigo']));
?>
<p align="center"><font size="3"><b><?php echo $LANG['patients']['radio_diagnosis']?></b></font></p>
<br />
<div align="center"><img src="../pacientes/verfoto_r.php?codigo=<?php echo $_GET['codigo']?>&tamanho=a4"  /></div>
<br />
<table width="650" align="center">
  <tr height="30" valign="top">
    <td width="15%"><b><?php echo $LANG['patients']['patient']?>:</b></td>
    <td width="85%"><?php echo encontra_valor('pacientes', 'codigo', $row['codigo_paciente'], 'nome')?></td>
  </tr>
  <tr height="30" valign="top">
    <td><b><?php echo $LANG['patients']['date']?>:</b></td>
    <td><?php echo converte_data($row['data'], 2)?></td>
  </tr>
  <tr height="30" valign="top">
    <td><b><?php echo $LANG['patients']['legend']?>:</b></td>
    <td><?php echo $row['legenda']?></td>
  </tr>
  <tr height="30" valign="top">
    <td colspan="2"><b><?php echo $LANG['patients']['radio_diagnosis']?>:</b><br />
      <?php echo nl2br($row['diagnostico'])?></td>
  </tr>
</table>
<?php
    include "../timbre_foot.php";
?>
<script>
window.print();
</script>
