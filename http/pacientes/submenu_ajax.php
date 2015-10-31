<?php
    include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php'; 

    $acao = "&acao=". $_GET[acao]; 

	if($_GET[acao] == 'editar') {
		$ficha = "<a href=\"javascript:Ajax('pacientes/incluir','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$odontograma = "<a href=\"javascript:Ajax('pacientes/odontograma','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$orcamento = "<a href=\"javascript:Ajax('pacientes/orcamento','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$objetivo = "<a href=\"javascript:Ajax('pacientes/objetivo','conteudo','codigo=".$_GET[codigo].$acao."')\">";
		$evolucao  = "<a href=\"javascript:Ajax('pacientes/evolucao' ,'conteudo','codigo=".$_GET[codigo].$acao."')\">";
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

  <?php if($_GET[acao] == 'editar') { ?>
 
    <ul class="nav nav-pills nav-stacked">
        <!--<li><a href="javascript:Ajax('pacientes/incluir','conteudo','codigo=<?php echo $_GET[codigo].$acao?>')"><span class="link_submenu_pacientes"><?php echo $LANG['patients']['clinical_sheet']?></span></a></li>-->
        <li>
            <?php echo $ficha ?> 
            <h4>
            <!-- <img class="photosmall img-circle" height="30" src="pacientes/verfoto.php?size=30&codigo=<?php echo $_GET['codigo']?> "> <?php echo $row[nome]?> -->
            <?php echo $_GET['nome']?>
            </h4></a>
        </li>
        <li><?php echo $ficha.'<span class="link_submenu_pacientes">'.$LANG['patients']['clinical_sheet']?></span></a></li>
        <li><?php echo $odontograma.'<span class="link_submenu_pacientes">'.$LANG['patients']['odontogram']?></span></a></li>
        <li><?php echo $orcamento.'<span class="link_submenu_pacientes">'.$LANG['patients']['budget']?></span></a></li>
        <li><?php echo $objetivo.'<span class="link_submenu_pacientes">'.$LANG['patients']['objective_examination']?></span></a></li>
        <li><?php echo $evolucao. '<span class="link_submenu_pacientes">'.$LANG['patients']['treatment_evolution'] ?></span></a></li>
        <li><?php echo $inquerito.'<span class="link_submenu_pacientes">'.$LANG['patients']['health_investigation']?></span></a></li>
        <li><?php echo $ortodontia.'<span class="link_submenu_pacientes">'.$LANG['patients']['orthodonty']?></span></a></li>
        <li><?php echo $implantodontia.'<span class="link_submenu_pacientes">'.$LANG['patients']['implantodonty']?></span></a></li>
        <li><?php echo $fotos.'<span class="link_submenu_pacientes">'.$LANG['patients']['photos']?></span></a></li>
        <li><?php echo $radio.'<span class="link_submenu_pacientes">'.$LANG['patients']['radiograph']?></span></a></li>
        <li><?php echo $outros.'<span class="link_submenu_pacientes">'.$LANG['patients']['others']?></span></a></li>
    </ul>
 
  <?php } ?>
<br>
