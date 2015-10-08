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
	//include "../lib/config.inc.php";
	//include "../lib/func.inc.php";
	//include "../lib/classes.inc.php";
	//header("Content-type: text/html; charset=ISO-8859-1", true);
	//if(!checklog()) {
	//	die($frase_log);
	//}
	$clinica = new TClinica();
	$clinica->LoadInfo();
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gerenciador Clínico Odontológico Smile Odonto - <?php echo $LANG['general']['administration_in_your_hands']?></title>
<link rel="SHORTCUT ICON" href="favicon.ico">
<link href="../css/smile.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../lib/script.js"></script>
</head>
<body style="background-color: #FFFFFF">
<table align="center" width="700" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left">
      <table align="center" width="700" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" colspan="2" style="border-bottom: 2px solid #000000;">
            <?php echo (($clinica->Logomarca != '')?'<img src="../configuracoes/verfoto_p.php" border="0" alt="Logomarca de '.$clinica->Fantasia.'">':'')?>
            <font size="2"><b><?php echo $clinica->Fantasia?></b></font>
          </td>
        </tr>
        <tr>
          <td width="70%">
            <font size="1">
            <?php echo $clinica->Endereco.' :: '.$clinica->Bairro.' :: '.$clinica->Cidade.' :: '.$clinica->Estado.' :: CEP '.$clinica->Cep.' :: '.$clinica->Pais?>
            </font>
          </td>
          <td width="30%" align="right">
            <font size="1">
            <?php echo $clinica->Telefone1?>
            </font>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
    <br />&nbsp;
    </td>
  </tr>
  <tr>
    <td height="760" valign="top" align="left">
