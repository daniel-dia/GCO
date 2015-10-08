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
    $paciente = new TPacientes();
    $paciente->LoadPaciente($_GET['codigo']);
    $query = mysql_query("SELECT * FROM odontograma WHERE codigo_paciente = ".$_GET['codigo']) or die('Line 39: '.mysql_error());
    while($row = mysql_fetch_assoc($query)) {
        $dente[$row['dente']] = $row['descricao'];
    }
?>
<br />
<div align="center"><font size="4"><b><?php echo $LANG['reports']['odontogram']?></b></font></div><br /><br />
<font size="2"><?php echo $LANG['reports']['patient']?>:<br />
<b><?php echo $paciente->RetornaDados('nome').' ['.$paciente->RetornaDados('codigo').']'?></b><br />
<br />
<?php echo $LANG['reports']['print_date']?>:<br />
<b><?php echo date('d/m/Y')?></b></font><br /><br />
<br />
<div align="center">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background: url('../pacientes/img/odontograma.gif') center center no-repeat;">
        <tr>
          <td width="38%" align="right">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
<?php
    $height = ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))?'21':'23');
    for($i = 18; $i != 49; $i++) {
?>
              <tr>
                <td width="100%" align="right" valign="middle" style="height: <?php echo $height?>px; border: 1px dashed #000000">
                  &nbsp;<?php echo $dente[$i]?>
                </td>
              </tr>
<?php
        if($i == 11) {
            $i = 40;
        }
        if($i < 40) {
            $i -= 2;
        }
    }
?>
            </table>
          </td>
          <td width="24%" align="center">

          </td>
          <td width="38%" align="center">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
<?php
    for($i = 28; $i != 39; $i++) {
?>
              <tr>
                <td width="100%" align="left" valign="middle" style="height: <?php echo $height?>px; border: 1px dashed #000000">
                  <?php echo $dente[$i]?>&nbsp;
                </td>
              </tr>
<?php
        if($i == 21) {
            $i = 30;
        }
        if($i < 30) {
            $i -= 2;
        }
    }
?>
            </table>
          </td>
        </tr>
      </table>
</div>
<script>
window.print();
</script>
<?php
    include "../timbre_foot.php";
?>
