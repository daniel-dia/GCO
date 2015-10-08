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
	if($_GET[acao] == 'editar') {
		$odontograma = "<a href=\"javascript:Ajax('pacientes/odontograma','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$orcamento = "<a href=\"javascript:Ajax('pacientes/orcamento','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$objetivo = "<a href=\"javascript:Ajax('pacientes/objetivo','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$evolucao = "<a href=\"javascript:Ajax('pacientes/evolucao','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$inquerito = "<a href=\"javascript:Ajax('pacientes/inquerito','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$ortodontia = "<a href=\"javascript:Ajax('pacientes/ortodontia','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$implantodontia = "<a href=\"javascript:Ajax('pacientes/implantodontia','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$fotos = "<a href=\"javascript:Ajax('pacientes/fotos','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$outros = "<a href=\"javascript:Ajax('pacientes/outros','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$radio = "<a href=\"javascript:Ajax('pacientes/radio','conteudo','codigo=".$_GET[codigo].$acao."')\">";
	}
	if(($_GET['codigo'] != '' && !verifica_nivel('pacientes', 'E')) || ($_GET['codigo'] == '' && !verifica_nivel('pacientes', 'I'))) {
        $disable = 'disabled';
	}
?>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr style="background-image: url('pacientes/img/fundo_submenu_pacientes.jpg')">
    <td align="center" width="20%"><a href="javascript:Ajax('pacientes/incluir','conteudo','codigo=<?php echo $_GET[codigo].$acao?>')"><span class="link_submenu_pacientes"><?php echo $LANG['patients']['clinical_sheet']?></span></a></td>
    <td align="center" width="15%"><?php echo $odontograma.'<span class="link_submenu_pacientes">'.$LANG['patients']['odontogram']?></span></a></td>
    <td align="center" width="15%"><?php echo $orcamento.'<span class="link_submenu_pacientes">'.$LANG['patients']['budget']?></span></a></td>
    <td align="center" width="25%"><?php echo $objetivo.'<span class="link_submenu_pacientes">'.$LANG['patients']['objective_examination']?></span></a></td>
    <td align="center" width="25%"><?php echo $evolucao.'<span class="link_submenu_pacientes">'.$LANG['patients']['treatment_evolution']?></span></a></td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
</table>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr style="background-image: url('pacientes/img/fundo_submenu_pacientes.jpg')">
    <td align="center" width="20%"><?php echo $inquerito.'<span class="link_submenu_pacientes">'.$LANG['patients']['health_investigation']?></span></a></td>
    <td align="center" width="15%"><?php echo $ortodontia.'<span class="link_submenu_pacientes">'.$LANG['patients']['orthodonty']?></span></a></td>
    <td align="center" width="20%"><?php echo $implantodontia.'<span class="link_submenu_pacientes">'.$LANG['patients']['implantodonty']?></span></a></td>
    <td align="center" width="15%"><?php echo $fotos.'<span class="link_submenu_pacientes">'.$LANG['patients']['photos']?></span></a></td>
    <td align="center" width="15%"><?php echo $radio.'<span class="link_submenu_pacientes">'.$LANG['patients']['radiograph']?></span></a></td>
    <td align="center" width="15%"><?php echo $outros.'<span class="link_submenu_pacientes">'.$LANG['patients']['others']?></span></a></td>
  </tr>
</table>
