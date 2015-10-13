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
?>
<link href="../css/smile.css" rel="stylesheet" type="text/css" />
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="74%">&nbsp;&nbsp;&nbsp;<img src="sobre/img/sobre.png" alt="Sobre"> <span class="h3"><?php echo $LANG['about']['about']?></span></td>
      <td width="7%" valign="bottom">&nbsp;</td>
      <td width="19%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br />
  <div class="sobre" id="sobre">
    <p>&nbsp;</p>
    <fieldset>
  <legend><?php echo $LANG['about']['copyright']?></legend>
  <p><?php echo $LANG['about']['all_rights_reserved']?></p>
  <p><?php echo $LANG['about']['gco_is_protected']?><br />
  </p>
  </fieldset><br />
  <legend><fieldset><legend><?php echo $LANG['about']['general']?></legend>
  <p><?php echo $LANG['about']['gco_is_developed']?></p>
  <p>- <?php echo $LANG['about']['html']?><br />
     <br />
     - <?php echo $LANG['about']['php']?><br />
     <br />
     - <?php echo $LANG['about']['mysql']?><br />
     <br />
     - <?php echo $LANG['about']['css']?><br />
     <br />
     - <?php echo $LANG['about']['ajax']?><br />
     <br />
     - <?php echo $LANG['about']['javascript']?></p>
  <p align="center">    <br />
    <strong><?php echo $LANG['about']['smile_supports']?></strong><br />
    </p>
  </fieldset>
  </div>
</div>
