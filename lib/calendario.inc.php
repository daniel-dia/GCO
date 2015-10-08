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
    ***********************************
    *
    * Quick Calendar Using PHP and AJAX
    * Copyright (C) 2005-2007
    * Version 1.1;
    * Last modified: 23 Jan 2007
    * Author: Bernard Peh
    * Email: bpeh@sitecritic.net
    * Website://web-developer.sitecritic.net/
    * File Name: quick_calendar.php
    *
    * LICENSE:
    * This is my contribution back to the open source community. You may modify the codes according
    * to your needs but please keep this section intact.
    *
    * DESCRIPTION:
    * Generate a simple calendar that can integrate seamlessly into any system with minimal
    * installation. You must be running PHP 4 at the minimal.
    *
    * SPECIAL THANKS TO FRIENDS FROM EVOLT.ORG
    * Adam Taylor, kirk837
    *
    */

	include_once "../lib/config.inc.php";
	include_once "../lib/func.inc.php";
	include_once "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
@header("Content-type: text/html; charset=ISO-8859-1", true);

$y = date('Y');
$m = date('m');
$d = date('d');
$today = array('day'=>$d, 'month'=>$m, 'year'=>$y);
if (isset($_GET['m'])) {
	$y = $_GET['y'];
	$m = $_GET['m'];
}
$css = 'calendar';
class CreateQCalendarArray {

	var $daysInMonth;
	var $weeksInMonth;
	var $firstDay;
	var $week;
	var $month;
	var $year;

	function CreateQCalendarArray($month, $year) {
		$this->month = $month;
		$this->year = $year;
		$this->week = array();
		$this->daysInMonth = date("t",mktime(0,0,0,$month,1,$year));
		// get first day of the month
		$this->firstDay = date("w", mktime(0,0,0,$month,1,$year));
		$tempDays = $this->firstDay + $this->daysInMonth;
		$this->weeksInMonth = ceil($tempDays/7);
		$this->fillArray();
	}

	function fillArray() {
		// create a 2-d array
		for($j=0;$j<$this->weeksInMonth;$j++) {
			for($i=0;$i<7;$i++) {
				$counter++;
				$this->week[$j][$i] = $counter;
				// offset the days
				$this->week[$j][$i] -= $this->firstDay;
				if (($this->week[$j][$i] < 1) || ($this->week[$j][$i] > $this->daysInMonth)) {
					$this->week[$j][$i] = "";
				}
			}
		}
	}
}

class QCalendar {

	var $html;
	var $weeksInMonth;
	var $week;
	var $month;
	var $year;
	var $today;
	var $links;
	var $css;

	function QCalendar($cArray, $today, &$links, $css='') {
		$this->month = $cArray->month;
		$this->year = $cArray->year;
		$this->weeksInMonth = $cArray->weeksInMonth;
		$this->week = $cArray->week;
		$this->today = $today;
		$this->links = $links;
		$this->css = $css;
		$this->createHeader();
		$this->createBody();
		$this->createFooter();
	}

	function createHeader() {
  		$header  = date('M', mktime(0,0,0,$this->month,1,$this->year));
        /*switch($header) {
            case 'Feb' : $header = 'Fev'; break;
            case 'Apr' : $header = 'Abr'; break;
            case 'May' : $header = 'Mai'; break;
            case 'Aug' : $header = 'Ago'; break;
            case 'Sep' : $header = 'Set'; break;
            case 'Oct' : $header = 'Out'; break;
            case 'Dec' : $header = 'Dez'; break;
  		}*/
        $header .= ' '.$this->year;
  		$nextMonth = $this->month+1;
  		$prevMonth = $this->month-1;
  		// thanks adam taylor for modifying this part
		switch($this->month) {
			case 1:
	   			$lYear = $this->year;
   				$pYear = $this->year-1;
   				$nextMonth=2;
   				$prevMonth=12;
   				break;
  			case 12:
   				$lYear = $this->year+1;
   				$pYear = $this->year;
   				$nextMonth=1;
   				$prevMonth=11;
      			break;
  			default:
      			$lYear = $this->year;
	   			$pYear = $this->year;
    	  		break;
  		}
		// --
		$this->html = "<table cellspacing='0' cellpadding='0' class='$this->css'>
		<tr>
		<th class='header'>&nbsp;<a href=\"javascript:;\" onclick=\"displayQCalendar('$this->month','".($this->year-1)."')\" class='headerNav' title='Ano anterior'>&lt;&lt;</a></th>
		<th class='header'>&nbsp;<a href=\"javascript:;\" onclick=\"displayQCalendar('$prevMonth','$pYear')\" class='headerNav' title='Mes anterior'>&lt;</a></th>
		<th colspan='3' class='header'>$header</th>
		<th class='header'>&nbsp;<a href=\"javascript:;\" onclick=\"displayQCalendar('$nextMonth','$lYear')\" class='headerNav' title='Proximo mes'>&gt;</a></th>
		<th class='header'>&nbsp;<a href=\"javascript:;\" onclick=\"displayQCalendar('$this->month','".($this->year+1)."')\"  class='headerNav' title='Proximo ano'>&gt;&gt;</a></th>
		</tr>";
	}

	function createBody(){
		// start rendering table
		$this->html.= "<tr><th>D</th><th>S</th><th>T</th><th>Q</th><th>Q</th><th>S</th><th>S</th></tr>";
		for($j=0;$j<$this->weeksInMonth;$j++) {
			$this->html.= "<tr>";
			for ($i=0;$i<7;$i++) {
                if(strlen($this->week[$j][$i]) === 1) {
                    $this->week[$j][$i] = "0".$this->week[$j][$i];
                }
                if(strlen($this->month) === 1) {
                    $this->month = "0".$this->month;
                }
				$cellValue = '<a href="javascript:;" onclick="javascript:escolheData(\''.$this->week[$j][$i].'/'.$this->month.'/'.$this->year.'\')">'.$this->week[$j][$i].'</a>';
				// if today
				if (($this->today['day'] == $this->week[$j][$i]) && ($this->today['month'] == $this->month) && ($this->today['year'] == $this->year)) {
					$cell = "<div class='today'>$cellValue</div>";
				}
				// else normal day
				else {
					$cell = "$cellValue";
				}
				$this->html.= "<td>$cell</td>";
			}
			$this->html.= "</tr>";
		}
	}

	function createFooter() {
        $month = date('M', mktime(0,0,0,$this->today['month'],1,$this->today['year']));
        switch($month) {
            case 'Feb' : $month = 'Fev'; break;
            case 'Apr' : $month = 'Abr'; break;
            case 'May' : $month = 'Mai'; break;
            case 'Aug' : $month = 'Ago'; break;
            case 'Sep' : $month = 'Set'; break;
            case 'Oct' : $month = 'Out'; break;
            case 'Dec' : $month = 'Dez'; break;
  		}
		$this->html .= "<tr><td colspan='7' class='footer'><a href=\"javascript:;\" onclick=\"displayQCalendar('{$this->today['month']}','{$this->today['year']}')\" class='footerNav'>{$this->today['day']} $month {$this->today['year']}</a></td></tr></table>";
	}

	function render() {
		echo $this->html;
	}
}

    $cArray = &new CreateQCalendarArray($m, $y);
    $cal = &new QCalendar($cArray, $today, $links, $css);
    $cal->render();
?>
