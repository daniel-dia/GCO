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
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
?><html>
<head></head>
<body topmargin="0" leftmargin="0" bgcolor="#F0F0F0" style="font-family: Verdana">
<?php
	$sql = stripslashes($_GET['sql']);
	$query = mysql_query($sql) or die('Erro: '.mysql_error());
	while($row = mysql_fetch_array($query)) {
		$nome = $row[nome];
		if($nome == '') {
            $nome = $row['nomefantasia'];
		}
		$end = $row['endereco'];
		$bairro = $row['bairro'];
		$cidade = $row['cidade'];
		$estado = $row['estado'];
		$cep = $row['cep'];
		$obs = $row['obs_etiqueta'];
?>
			  <font size="2" face="Roman 17cpi"><?php echo $nome?> <?php echo isset($_GET['nasc']) ? '(' .converte_data($row['nascimento'],2). ')' : ''?><br>
              <font size="1" face="Roman 17cpi"><?php echo $end?> - <?php echo $bairro?><br>
              <font size="1" face="Roman 17cpi"><?php echo $cidade?> - <?php echo $estado?> - <?php echo $LANG['reports']['zip']?>: <?php echo $cep?><br>
              <font size="2" face="Roman 17cpi"><?php echo $obs?><br>
              <font size="1" face="Roman 17cpi"><br><br><br>


<?php
	}
?>
<script>
window.print();
</script>
</body>
</html>
