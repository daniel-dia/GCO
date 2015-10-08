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
  session_start();
  
  //------------------------------------------------------------------------//
  
  function conecta($server, $user, $pass, $bd) {
  
    $conn = mysql_connect($server, $user, $pass) or die(mysql_error());
    $sele = mysql_select_db($bd, $conn) or die(mysql_error());

  }
  
  conecta($server, $user, $pass, $bd);
  $idioma = mysql_fetch_assoc(mysql_query("SELECT idioma FROM dados_clinica"));
  $idioma = $idioma['idioma'];

  //------------------------------------------------------------------------//

  function converte_data($data, $op) {
  
    if($op == 1) {
      $new_data = explode("/", $data);
      $new_data = array_reverse($new_data);
      $new_data = implode("-", $new_data);
    } elseif($op == 2) {
      $new_data = explode("-", $data);
      $new_data = array_reverse($new_data);
      $new_data = implode("/", $new_data);
      if($new_data == '00/00/0000') {
        $new_data = '';
      }
    } elseif ( $op == 3 ) {

        $new_data = explode("-", $data);
        $new_data = mktime ( 0 , 0 , 0 , $new_data[1] , $new_data[2] , $new_data[0] );

    }
    return $new_data;
  
  }

  //------------------------------------------------------------------------//

  function converte_datahora($data, $op) {
    $data = explode(' ', $data);
    $data[0] = converte_data($data[0], $op);
    return(implode(' ', $data));
  }

  //------------------------------------------------------------------------//
  
  function encontra_valor($table_search, $field_search, $value_search, $field_return) {
  
    $sql = "SELECT * FROM $table_search WHERE $field_search = '$value_search'";
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    $nome = $row[$field_return];
    return $nome;
  
  }

  //------------------------------------------------------------------------//

  function nome_semana($data) {
    global $LANG;
    switch(date('w', strtotime($data))) {
        case 0: return $LANG['func']['sunday']; break;
        case 1: return $LANG['func']['monday']; break;
        case 2: return $LANG['func']['tuesday']; break;
        case 3: return $LANG['func']['wednesday']; break;
        case 4: return $LANG['func']['thursday']; break;
        case 5: return $LANG['func']['friday']; break;
        case 6: return $LANG['func']['saturday']; break;
    }
  }

  //------------------------------------------------------------------------//

  function nome_mes($mes) {
    global $LANG;
    switch($mes) {
      case 1: $month = $LANG['func']['january']; break;
      case 2: $month = $LANG['func']['february']; break;
      case 3: $month = $LANG['func']['march']; break;
      case 4: $month = $LANG['func']['april']; break;
      case 5: $month = $LANG['func']['may']; break;
      case 6: $month = $LANG['func']['june']; break;
      case 7: $month = $LANG['func']['july']; break;
      case 8: $month = $LANG['func']['august']; break;
      case 9: $month = $LANG['func']['september']; break;
      case 10: $month = $LANG['func']['october']; break;
      case 11: $month = $LANG['func']['november']; break;
      case 12: $month = $LANG['func']['december']; break;
    }
    return $month;
  }
  
  //------------------------------------------------------------------------//

  function next_autoindex($table) {
  
    global $bd;
    $sql = "SHOW TABLE STATUS FROM `$bd` LIKE '$table'";
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    return($row["Auto_increment"]);
  
  }

  //------------------------------------------------------------------------//

  function is_valid_codigo($codigo) {
  	return(mysql_num_rows(mysql_query("SELECT `codigo` FROM `pacientes` WHERE `codigo` = '".$codigo."'")) === 0);
  }

  //------------------------------------------------------------------------//

  function is_valid_cpf($cpf, $dbase = ''){
  	
  	$ret = true;
  	$falses[1] = '00000000000';
  	$falses[] = '11111111111';
  	$falses[] = '22222222222';
  	$falses[] = '33333333333';
  	$falses[] = '44444444444';
  	$falses[] = '55555555555';
  	$falses[] = '66666666666';
  	$falses[] = '77777777777';
  	$falses[] = '88888888888';
  	$falses[] = '99999999999';
  	if($dbase != '') {
  		$ret = mysql_num_rows(mysql_query("SELECT `cpf` FROM `".$dbase."` WHERE `cpf` = '".$cpf."'")) == 0;
  	}
  	if(array_search($cpf, $falses)) {
  		return false;
  	}
  	$cpf_dig1 = 11 - ((($cpf[0] * 10) + ($cpf[1] * 9) + ($cpf[2] * 8) + ($cpf[3] * 7) + ($cpf[4] * 6) + ($cpf[5] * 5) + ($cpf[6] * 4) + ($cpf[7] * 3) + ($cpf[8] * 2)) % 11);
    if ($cpf_dig1 == "10" || $cpf_dig1 == "11") {
      $cpf_dig1 = "0";
    }
    $cpf_dig2 = 11 - ((($cpf[0] * 11) + ($cpf[1] * 10) + ($cpf[2] * 9) + ($cpf[3] * 8) + ($cpf[4] * 7) + ($cpf[5] * 6) + ($cpf[6] * 5) + ($cpf[7] * 4) + ($cpf[8] * 3) + ($cpf[9] * 2)) % 11);
    if ($cpf_dig2 == "10" || $cpf_dig2 == "11") {
      $cpf_dig2 = "0";
    }
    return($ret && $cpf[9] == $cpf_dig1 && $cpf[10] == $cpf_dig2);

  }

  //------------------------------------------------------------------------//

  function is_valid_cnpj($cnpj, $dbase = ''){

    $ret = true;
  	if($dbase != '') {
  		$ret = mysql_num_rows(mysql_query("SELECT `cpf` FROM `".$dbase."` WHERE `cpf` = '".$cnpj."'")) == 0;
  	}
    $cnpj_dig1 = 11 - ((($cnpj[0] * 5) + ($cnpj[1] * 4) + ($cnpj[2] * 3) + ($cnpj[3] * 2) + ($cnpj[4] * 9) + ($cnpj[5] * 8) + ($cnpj[6] * 7) + ($cnpj[7] * 6) + ($cnpj[8] * 5) + ($cnpj[9] * 4) + ($cnpj[10] * 3) + ($cnpj[11] * 2)) % 11);
    if ($cnpj_dig1 == "10" || $cnpj_dig1 == "11") {    
      $cnpj_dig1 = "0";
    }
    $cnpj_dig2 = 11 - ((($cnpj[0] * 6) + ($cnpj[1] * 5) + ($cnpj[2] * 4) + ($cnpj[3] * 3) + ($cnpj[4] * 2) + ($cnpj[5] * 9) + ($cnpj[6] * 8) + ($cnpj[7] * 7) + ($cnpj[8] * 6) + ($cnpj[9] * 5) + ($cnpj[10] * 4) + ($cnpj[11] * 3) + ($cnpj[12] * 2)) % 11);
    if ($cnpj_dig2 == "10" || $cnpj_dig2 == "11") {
      $cnpj_dig2 = "0";
    }
    return($ret && $cnpj[12] == $cnpj_dig1 && $cnpj[13] == $cnpj_dig2);

  }

  //------------------------------------------------------------------------//

  function saudacao() {
  	if(date(H) >= 0 && date(H) < 12) {
  		return $LANG['func']['good_morning'];
  	} elseif(date(H) >= 12 && date(H) < 18) {
  		return $LANG['func']['good_afternoon'];
  	} elseif(date(H) >= 18 && date(H) <= 23) {
  		return $LANG['func']['good_night'];
  	}
  }

  //------------------------------------------------------------------------//

  function amanha() {
  
    $dia = date(d);
    $mes = date(m);
    $ano = date(Y);
    $dia_sem = date(w);
    $qtd_dias = date(t);
    if($dia_sem == 6) {
      $dia = $dia + 2;
    } else {
      $dia = $dia + 1;
    }
    if($dia > $qtd_dias) {
      $mes = $mes + 1;
      $dia = 1;
    }
    if($mes > 12) {
      $ano = $ano + 1;
      $mes = 1;
    }
    while(strlen($dia) < 2) {
      $dia = "0".$dia;
    }
    while(strlen($mes) < 2) {
      $mes = "0".$mes;
    }
    while(strlen($ano) < 4) {
      $ano = "0".$ano;
    }
    return($ano.'-'.$mes.'-'.$dia);
  
  }

  //------------------------------------------------------------------------//

  function maismes($data, $qtde) {
  	$data = explode("-", $data);
  	$dia = $data[2];
  	$mes = $data[1] + $qtde;
  	$ano = $data[0];
  	while($mes > 12) {
  		$mes -= 12;
  		$ano++;
  	}
  	if(strlen($mes) < 2) {
  		$mes = "0".$mes;
  	}
  	return($ano."-".$mes."-".$dia);
  }

  //------------------------------------------------------------------------//

  function money_form($valor) {
  
    $novo_valor = explode('.', round($valor, 2));
	while(strlen($novo_valor[1]) < 2) {
	  $novo_valor[1] .= "0";
	}
	return(implode('.', $novo_valor));
  
  }

  //------------------------------------------------------------------------//

  function hoje() {
  
	return(date(Y.'-'.m.'-'.d));
  
  }

  //------------------------------------------------------------------------//

  function is_date($data) {
  
  	$data = explode('-', $data);
	return((count($data) == 3) && (strlen($data[0]) == 4) && (strlen($data[1]) == 2) && (strlen($data[2]) == 2));
  
  }

  //------------------------------------------------------------------------//

  function pega_tipo($filename) {
      $tipo = explode('.', $filename);
      $tipo = array_reverse($tipo);
      $tipo = strtoupper($tipo[0]);
      return $tipo;
    }

  //------------------------------------------------------------------------//

  function format_size($tam) {
      $extensoes = array("B", "KB", "MB", "GB", "TB");
      $ntam = $tam;
      $i = 0;
      while($ntam > 1024) {
        $ntam = ceil($ntam / 1024);
        $i++;
      }
      return($ntam." ".$extensoes[$i]);
    }

  //------------------------------------------------------------------------//

  function checklog() {
  	global $_SESSION;
  	return($_SESSION[codigo] != '');
  }

  //------------------------------------------------------------------------//

  function checknivel($nivel) {
  	global $_SESSION;
  	return($_SESSION[nivel] == $nivel);
  }

  //------------------------------------------------------------------------//

  function ajaxurlencode($str) {
  	$str = urlencode($str);
  	$str = ereg_replace(" ", "%2B", $str);
  	$str = ereg_replace("%", "%25", $str);
  	return($str);
  }

  //------------------------------------------------------------------------//

  function ajaxurldecode($str) {
  	$str = urldecode($str);
  	$str = ereg_replace("%2B", " ", $str);
  	$str = ereg_replace("%25", "%", $str);
  	return($str);
  }

  //------------------------------------------------------------------------//

  function imagecreatefromall($file, $filename) {
	$ext = explode(".", $filename);
	$ext = strtolower($ext[count($ext)-1]);
 	switch($ext) {
		case 'JPG':
		case 'JPEG':
		case 'jpg':
		case 'jpeg': $foto = imagecreatefromjpeg($file);
			break;
		case 'PNG':
		case 'png': $foto = imagecreatefrompng($file);
			break;
		case 'GIF':
		case 'gif': $foto = imagecreatefromgif($file);
			break;
	}
	return $foto;
  }

  //------------------------------------------------------------------------//

  function ajusta_cpf($cpf, $op) {
    if($op == 1) {
        $ncpf = $cpf;
        $cpf = '';
        for($i = 0; $i < strlen($ncpf); $i++) {
            if($ncpf[$i] != '.' && $ncpf[$i] != '-') {
                $cpf .= $ncpf[$i];
            }
        }
    } elseif($op == 2) {
      if($cpf != '') {
          $cpf = substr($cpf, 0, 3).'.'.substr($cpf, 3, 3).'.'.substr($cpf, 6, 3).'-'.substr($cpf, 9, 2);
      }
    }
    return $cpf;
  }

  //------------------------------------------------------------------------//

  function ajusta_cnpj($cnpj, $op) {
    if($op == 1) {
        $ncnpj = $cnpj;
        $cnpj = '';
        for($i = 0; $i < strlen($ncnpj); $i++) {
            if($ncnpj[$i] != '.' && $ncnpj[$i] != '-' && $ncnpj[$i] != '/') {
                $cnpj .= $ncnpj[$i];
            }
        }
    } elseif($op == 2) {
      if($cnpj != '') {
          $cnpj = substr($cnpj, 0, 2).'.'.substr($cnpj, 2, 3).'.'.substr($cnpj, 5, 3).'/'.substr($cnpj, 8, 4).'-'.substr($cnpj, 12, 2);
      }
    }
    return $cnpj;
  }

  //------------------------------------------------------------------------//

  function limpa_orcamentos() {
    $query = mysql_query("SELECT codigo FROM orcamento WHERE formapagamento IS NULL");
    $num = mysql_num_rows($query);
    if($num > 0) {
        while($row = mysql_fetch_array($query)) {
            mysql_query("DELETE FROM orcamento WHERE codigo = ".$row['codigo']) or die('Line 403: '.mysql_error());
            mysql_query("DELETE FROM parcelas_orcamento WHERE codigo_orcamento = ".$row['codigo']) or die('Line 404: '.mysql_error());
            mysql_query("DELETE FROM procedimentos_orcamento WHERE codigo_orcamento = ".$row['codigo']) or die('Line 405: '.mysql_error());
        }
    }
  }

  //------------------------------------------------------------------------//

  function completa_zeros($string, $qtd) {
    while(strlen($string) < $qtd) {
        $string = '0'.$string;
    }
    return($string);
  }

  //------------------------------------------------------------------------//

  function CodigoBarras($code) {
      /**
       * Função original de Autor Desconhecido
       * Encontrado em: http://www.vivaolinux.com.br/scripts/verScript.php?codigo=1394
       *
       */
      $lw = 2; $hi = 25;
      $Lencode = array('0001101','0011001','0010011','0111101','0100011',
                       '0110001','0101111','0111011','0110111','0001011');
      $Rencode = array('1110010','1100110','1101100','1000010','1011100',
                       '1001110','1010000','1000100','1001000','1110100');
      $ends = '101'; $center = '01010';
      /* UPC-A Must be 11 digits, we compute the checksum. */
      if ( strlen($code) != 11 ) { die("UPC-A Must be 11 digits."); }
      /* Compute the EAN-13 Checksum digit */
      $ncode = '0'.$code;
      $even = 0; $odd = 0;
      for ($x=0;$x<12;$x++) {
       if ($x % 2) { $odd += $ncode[$x]; } else { $even += $ncode[$x]; }
      }
      $code.=(10 - (($odd * 3 + $even) % 10)) % 10;
      /* Create the bar encoding using a binary string */
      $bars=$ends;
      $bars.=$Lencode[$code[0]];
      for($x=1;$x<6;$x++) {
       $bars.=$Lencode[$code[$x]];
      }
      $bars.=$center;
      for($x=6;$x<12;$x++) {
       $bars.=$Rencode[$code[$x]];
      }
      $bars.=$ends;
      /* Generate the Barcode Image */
      $img = ImageCreate($lw*95+30,$hi+30);
      $fg = ImageColorAllocate($img, 0, 0, 0);
      $bg = ImageColorAllocate($img, 255, 255, 255);
      ImageFilledRectangle($img, 0, 0, $lw*95+30, $hi+30, $bg);
      $shift=10;
      for ($x=0;$x<strlen($bars);$x++) {
       if (($x<10) || ($x>=45 && $x<50) || ($x >=85)) { $sh=10; } else { $sh=0; }
       if ($bars[$x] == '1') { $color = $fg; } else { $color = $bg; }
       ImageFilledRectangle($img, ($x*$lw)+15,5,($x+1)*$lw+14,$hi+5+$sh,$color);
      }
      /* Add the Human Readable Label */
      ImageString($img,4,5,$hi-5,$code[0],$fg);
      for ($x=0;$x<5;$x++) {
       ImageString($img,5,$lw*(13+$x*6)+15,$hi+5,$code[$x+1],$fg);
       ImageString($img,5,$lw*(53+$x*6)+15,$hi+5,$code[$x+6],$fg);
      }
      ImageString($img,4,$lw*95+17,$hi-5,$code[11],$fg);
      /* Output the Header and Content. */
      header("Content-Type: image/png");
          ImagePNG($img);
  }

  //------------------------------------------------------------------------//

    function verifica_nivel($area, $permissao, $nivel = '') {
        if($nivel == '') {
            $nivel = $_SESSION['nivel'];
        }

        return($nivel == 'Administrador' || mysql_num_rows(mysql_query("SELECT * FROM permissoes WHERE nivel = '".$nivel."' AND area = '".$area."' AND permissao LIKE '%".$permissao."%'")) > 0);
    }

?>
