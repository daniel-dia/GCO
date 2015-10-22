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
?>
  <table class="table table-hover">
  <tr>
      <th align="left"><?php echo $LANG['useful_telephones']['name']?></td>
      <th align="left"><?php echo $LANG['useful_telephones']['telephone']?></td>
      <th align="center"> </td>
    </tr>
<?php
    $_GET['pesquisa'] =  ( htmlspecialchars( ($_GET['pesquisa']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') );
	if($_GET[pg] != '') {
		$limit = ($_GET[pg]-1)*PG_MAX;
	} else {
		$limit = 0;
		$_GET[pg] = 1;
	}
	$sql = "SELECT * FROM `telefones` WHERE `nome` LIKE '%$_GET[pesquisa]%' ORDER BY `nome` ASC";
	$telefones = new TTelefones();
	$lista = $telefones->ListTelefones($sql.' LIMIT '.$limit.', '.PG_MAX);
	$total_regs = $telefones->ListTelefones($sql);
	 
	for($i = 0; $i < count($lista); $i++) {
		 
?>
    <?php if (verifica_nivel('contatos', 'V')) {   ?>
    
        <tr>
            <td><a href="javascript:Ajax(\'telefones/incluir\', \'conteudo\', \'codigo=' <?php echo $lista[$i][codigo] ?>'&acao=editar\')">            <?php echo $lista[$i][nome]?>                </a>            </td>
            <td><?php echo $lista[$i][telefone1]?></td>
            <td><?php echo ((verifica_nivel('contatos', 'A'))?'<a href="javascript:Ajax(\'telefones/gerenciar\', \'conteudo\', \'codigo='.$lista[$i][codigo].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.png" alt="Excluir" width="19" height="19" border="0"></a>':'')?></td>
        </tr>

    <?php } else{?>   
 <tr>
            <td><?php echo $lista[$i][nome]?></td>
            <td><?php echo $lista[$i][telefone1]?></td>
            <td><?php echo ((verifica_nivel('contatos', 'A'))?'<a href="javascript:Ajax(\'telefones/gerenciar\', \'conteudo\', \'codigo='.$lista[$i][codigo].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.png" alt="Excluir" width="19" height="19" border="0"></a>':'')?></td>
        </tr>
   <?php
	}
	}
?>
  </table>
  <br>

 
      <?php echo $LANG['useful_telephones']['total_contacts']?>: <b><?php echo count($total_regs)?></b>
      
     <img src="imagens/icones/etiquetas.png" border=""> <a href="etiquetas/print_etiqueta.php?sql=<?php echo ajaxurlencode($sql)?>" target="_blank"><?php echo $LANG['suppliers']['print_labels']?></a>

  </table>
