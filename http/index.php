<!DOCTYPE html>
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
	include "lib/config.inc.php";
    if(!$install) {
        header('Location: ./configurador.php');
    } else {
        
    }
    

	include "lib/func.inc.php";
	include "lib/classes.inc.php";
	require_once 'lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=utf-8", true);

?>
    <?php
    if(checklog()!=1){
         $redirect = "login.php";
         header("location:$redirect");
         die();
    }
?>

<html>
<head> 
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gerenciador Clínico Odontológico</title>
    <link rel="SHORTCUT ICON" href="favicon.ico">

    <!-- date time -->
    <script language="javascript" type="text/javascript" src="lib/script.js"></script>
    <script language="javascript" type="text/javascript" src="lib/ajax_search.js"></script>
    
    <script language="javascript" type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/sb-admin-2.js"></script>
    <script language="javascript" type="text/javascript" src="js/metisMenu.min.js"></script>
    
    <!-- date time -->
    <script language="javascript" type="text/javascript" src="js/moment-with-locales.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>

    
    
     <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css" />

    <!-- Theme CSS-->
    <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css" />  
    
    <!-- Custom Fonts -->
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS -->
    <link href="css/gco.css" rel="stylesheet" type="text/css" />
    
       <!-- Date Time Picker -->
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
 
 
</head>
    
<body>
    <input type="hidden" id="ScriptID" value="0" />
    
    <div id="wrapper">
        
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

            <div class="navbar-header" > 
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="imagens/Tooth.png"  style="display:inline"/> Clínica Orthosul
                </a>
            </div>
            <!-- /.navbar-header -->
            
            <?php include "menutop.php"; ?>
            <!-- /.navbar-top-links -->
            
            <?php include "menu.php"; ?>
            <!-- /.navbar-static-side -->
        </nav>
        
        
        <div id="page-wrapper">
            <div id="conteudo">
            </div>
        
        
             <!-- <div>
              <div class="rodape col-xs-12" id="rodape"> <br />
                    <?php echo $LANG['general']['smile_odontology']?> - <?php echo $LANG['general']['enhancing_your_smile']?> - <a href="http://www.smileodonto.com.br" target="_blank">www.smileodonto.com.br </a><br>
                    <br />
                    <?php echo $LANG['general']['be_part_of_smile']?><br />
                    <a href="https://icons8.com/download-huge-windows8-set">Windows icons by Icons8</a>
                </div>
               
            </div> -->
        </div>
    </div>
    
</body>
</html>
