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
	/**
	 * Classe das Especialidades dos Dentistas das clínicas
	 *
	 */
	class TEspecialidades {
		private $codigo;
		private $descricao;
		function __construct($intCodigo = "") {
			if($intCodigo != "") {
				$this->GetEspecContent($intCodigo);
			}
		}
		function GetEspecContent($intCodigo) {
			$row = mysql_fetch_array(mysql_query("SELECT * FROM `especialidades` WHERE `codigo` = '$intCodigo'"));
			if($row[codigo] != "") {
				$this->codigo = $row[codigo];
				$this->descricao = $row[descricao];
			}
		}
		function GetDescricao() {
			return $this->descricao;
		}
		function SetDescricao($strDescricao) {
			$this->descricao = $strDescricao;
			mysql_query("UPDATE `especialidade` SET `descricao` = '".$this->descricao."' WHERE `codigo` = '".$this->codigo."'");
		}
		function ChangeEspecialidade($intNovoCodigo) {
			$this->GetEspecContent($intCodigo);
		}
		function ListEspecialidades() {
			$i = 0;
			$query = mysql_query("SELECT * FROM `especialidades` ORDER BY `descricao` ASC") or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][codigo] = $row[codigo];
				$lista[$i][descricao] = $row[descricao];
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe dos dentistas das clínicas
	 *
	 */
	class TDentistas {
		private $dados;
		function LoadDentista($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `dentistas` WHERE `codigo` = '".$intCodigo."'"));
			$this->dados = $row;
			if($this->dados[sexo] == "Masculino") {
				$this->dados[titulo] = "Dr.";
			} else {
				$this->dados[titulo] = "Dra.";
			}
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo' && $chave != 'titulo' && $chave != 'foto') {
                    $sql = "UPDATE `dentistas` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->dados[codigo]."'";
					mysql_query($sql);
                    echo mysql_error() ? $sql . ': ' . mysql_error() : '';
				}
			}
		}
		function SalvarNovo() {
			mysql_query("INSERT INTO `dentistas` (`codigo`) VALUES ('')") or die("Erro em SalvarNovo(): ".mysql_error());
			$this->dados['codigo'] = mysql_insert_id();
		}
		function ListDentistas($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `dentistas` ORDER BY `nome` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][codigo] = $row[codigo];
				$lista[$i][nome] = $row[nome];
				$lista[$i][cpf] = $row[cpf];
				$lista[$i][conselho_tipo] = $row[conselho_tipo];
				$lista[$i][conselho_estado] = $row[conselho_estado];
				$lista[$i][conselho_numero] = $row[conselho_numero];
				$lista[$i][telefone] = $row[telefone1];
				$lista[$i][ativo] = $row[ativo];
				if($row[sexo] == "Masculino") {
					$lista[$i][titulo] = "Dr.";
				} else {
					$lista[$i][titulo] = "Dra.";
				}
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe dos pacientes da clínica
	 *
	 */
	class TPacientes {
		private $dados;
		private $codigo_anterior;
		function LoadPaciente($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `pacientes` WHERE `codigo` = '".$intCodigo."'"));
			$this->dados = $row;
			$this->codigo_anterior = $this->dados[codigo];
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `pacientes` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->codigo_anterior."'");
				}
			}
			if($this->codigo_anterior != $this->dados[codigo]) {
				mysql_query("UPDATE `pacientes` SET `codigo` = '".$this->dados[codigo]."' WHERE `codigo` = '".$this->codigo_anterior."'");
				$this->codigo_anterior = $this->dados[codigo];
			}
		}
		function SalvarNovo() {
			mysql_query("INSERT INTO `pacientes` (`codigo`) VALUES ('".$this->dados[codigo]."')") or die("Erro em SalvarNovo(): ".mysql_error());
			$this->codigo_anterior = $this->dados[codigo];
		}
		function ListPacientes($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `pacientes` ORDER BY `nome` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][nome] = $row[nome];
				$lista[$i][codigo] = $row[codigo]; 
				$i++;
			}
			return $lista;
		}
		
		function ProximoCodigo() {
			$row = mysql_fetch_array(mysql_query("SELECT `codigo` FROM `pacientes` ORDER BY `codigo` DESC LIMIT 1"));
			return($row[codigo] + 1);
		}
	}
	/**
	 * Classe dos Funcionários da clínica
	 *
	 */
	class TFuncionarios {
		private $dados;
		function LoadFuncionario($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `funcionarios` WHERE `codigo` = '".$intCodigo."'"));
			$this->dados = $row;
			if($this->dados[sexo] == "Masculino") {
				$this->dados[titulo] = "Sr.";
			} else {
				$this->dados[titulo] = "Sra.";
			}
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `funcionarios` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->dados[codigo]."'");
				}
			}
		}
		function SalvarNovo() {
			mysql_query("INSERT INTO `funcionarios` (`codigo`) VALUES ('')") or die("Erro em SalvarNovo(): ".mysql_error());
			$this->dados['codigo'] = mysql_insert_id();
		}
		function ListFuncionarios($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `funcionarios` ORDER BY `nome` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][codigo] = $row[codigo];
				$lista[$i][nome] = $row[nome];
				$lista[$i][cpf] = $row[cpf];
				$lista[$i][funcao1] = $row[funcao1];
				$lista[$i][ativo] = $row[ativo];
				if($row[sexo] == "Masculino") {
					$lista[$i][titulo] = "Sr.";
				} else {
					$lista[$i][titulo] = "Sra.";
				}
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe dos Fornecedores da clínica
	 *
	 */
	class TFornecedores {
		private $dados;
		private $codigo_anterior;
		function LoadFornecedores($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `fornecedores` WHERE `codigo` = '".$intCodigo."'"));
			$this->dados = $row;
			$this->codigo_anterior = $this->dados[codigo];
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `fornecedores` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->codigo_anterior."'");
				}
			}
		}
		function SalvarNovo() {
			$codigo = next_autoindex('fornecedores');
			mysql_query("INSERT INTO `fornecedores` (`codigo`) VALUES ('".$codigo."')") or die("Erro em SalvarNovo(): ".mysql_error());
			$this->codigo_anterior = $codigo;
		}
		function ListFornecedores($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `fornecedores` ORDER BY `nomefantasia` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][nome] = $row[nomefantasia];
				$lista[$i][codigo] = $row[codigo];
				$lista[$i][cidade_uf] = $row[cidade]."/".$row[estado];
				$lista[$i][telefone] = $row[telefone1];
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe dos Laboratórios Clínicos
	 *
	 */
	class TLaboratorio {
		private $dados;
		private $codigo_anterior;
		function LoadLaboratorio($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `laboratorios` WHERE `codigo` = '".$intCodigo."'"));
			$this->dados = $row;
			$this->codigo_anterior = $this->dados[codigo];
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `laboratorios` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->codigo_anterior."'");
				}
			}
		}
		function SalvarNovo() {
			$codigo = next_autoindex('laboratorios');
			mysql_query("INSERT INTO `laboratorios` (`codigo`) VALUES ('".$codigo."')") or die("Erro em SalvarNovo(): ".mysql_error());
			$this->codigo_anterior = $codigo;
		}
		function ListLaboratorios($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `laboratorios` ORDER BY `nomefantasia` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][nome] = $row[nomefantasia];
				$lista[$i][codigo] = $row[codigo];
				$lista[$i][cidade_uf] = $row[cidade]."/".$row[estado];
				$lista[$i][telefone] = $row[telefone1];
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe dos Convênios
	 *
	 */
	class TConvenio {
		private $dados;
		private $codigo_anterior;
		function LoadConvenio($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `convenios` WHERE `codigo` = '".$intCodigo."'"));
			$this->dados = $row;
			$this->codigo_anterior = $this->dados[codigo];
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `convenios` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->codigo_anterior."'");
				}
			}
		}
		function SalvarNovo() {
			$codigo = next_autoindex('convenios');
			mysql_query("INSERT INTO `convenios` (`codigo`) VALUES ('".$codigo."')") or die("Erro em SalvarNovo(): ".mysql_error());
			$this->codigo_anterior = $codigo;
		}
		function ListConvenios($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `convenios` ORDER BY `nomefantasia` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][nome] = $row[nomefantasia];
				$lista[$i][codigo] = $row[codigo];
				$lista[$i][cidade_uf] = $row[cidade]."/".$row[estado];
				$lista[$i][telefone] = $row[telefone1];
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe do livro caixa da clínica e 
	 * dos funcionários
	 * 
	 */
	class TCaixa {
		private $dados;
		private $dbase;
		function __construct($strDBase = '') {
			if($strDBase != '') {
				$this->dbase = $strDBase;
			} else {
				$this->dbase = 'caixa';
			}
		}
		function LoadCaixa($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `".$this->dbase."` WHERE `codigo` = '".$intCodigo."'"));
			$this->dados = $row;
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `".$this->dbase."` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->dados[codigo]."'");
				}
			}
		}
		function SalvarNovo() {
			$codigo = next_autoindex($this->dbase);
			mysql_query("INSERT INTO `".$this->dbase."` (`codigo`) VALUES ('".$codigo."')") or die("Erro em SalvarNovo(): ".mysql_error());
			$this->dados[codigo] = $codigo;
		}
		function ListCaixa($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `".$this->dbase."` ORDER BY `data` DESC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][codigo] = $row[codigo];
				$lista[$i][data] = $row[data];
				$lista[$i][dc] = $row[dc];
				$lista[$i][valor] = $row[valor];
				$lista[$i][descricao] = $row[descricao];
				$i++;
			}
			return $lista;
		}
		function SaldoTotal($strCPF = "") {
			if($strCPF == "") {
				$where = "";
			} else {
				$where = "`codigo_dentista` = '".$strCPF."' AND";
			}
			$saldo_positivo = mysql_fetch_array(mysql_query("SELECT SUM(`valor`) as `saldo_positivo` FROM `".$this->dbase."` WHERE ".$where." `dc` = '+'"));
			$saldo_negativo = mysql_fetch_array(mysql_query("SELECT SUM(`valor`) as `saldo_negativo` FROM `".$this->dbase."` WHERE ".$where." `dc` = '-'"));
			$saldo_positivo = $saldo_positivo[saldo_positivo];
			$saldo_negativo = $saldo_negativo[saldo_negativo];
			return($saldo_positivo - $saldo_negativo);
		}
	}
	/**
	 * Classe dos Telefones
	 *
	 */
	class TTelefones {
		private $dados;
		private $codigo_anterior;
		function LoadTelefones($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `telefones` WHERE `codigo` = '".$intCodigo."'"));
			$this->dados = $row;
			$this->codigo_anterior = $this->dados[codigo];
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `telefones` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->codigo_anterior."'");
				}
			}
		}
		function SalvarNovo() {
			$codigo = next_autoindex('telefones');
			mysql_query("INSERT INTO `telefones` (`codigo`) VALUES ('".$codigo."')") or die("Erro em SalvarNovo(): ".mysql_error());
			$this->codigo_anterior = $codigo;
		}
		function ListTelefones($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `telefones` ORDER BY `nome` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][nome] = $row[nome];
				$lista[$i][codigo] = $row[codigo];
				$lista[$i][telefone1] = $row[telefone1];
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe dos Patrimônios da Clínica
	 *
	 */
	class TPatrimonios {
		private $dados;
		private $codigo_anterior;
		function LoadPatrimonio($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `patrimonio` WHERE `codigo` = '".$intCodigo."'"));
			$this->dados = $row;
			$this->codigo_anterior = $this->dados[codigo];
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `patrimonio` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->codigo_anterior."'");
				}
			}
			if($this->codigo_anterior != $this->dados[codigo]) {
				mysql_query("UPDATE `patrimonio` SET `codigo` = '".$this->dados[codigo]."' WHERE `codigo` = '".$this->codigo_anterior."'");
				$this->codigo_anterior = $this->dados[codigo];
			}
		}
		function SalvarNovo() {
			mysql_query("INSERT INTO `patrimonio` (`codigo`) VALUES ('".$this->dados[codigo]."')") or die("Erro em SalvarNovo(): ".mysql_error());
			$this->codigo_anterior = $this->dados[codigo];
		}
		function ListPatrimonio($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `patrimonio` ORDER BY `descricao` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][descricao] = $row[descricao];
				$lista[$i][codigo] = $row[codigo];
				$lista[$i][valor] = $row[valor];
				$lista[$i][setor] = $row[setor];
				$i++;
			}
			return $lista;
		}
		function ValorTotal() {
			$saldo = mysql_fetch_array(mysql_query("SELECT SUM(`valor`) as `saldo` FROM `patrimonio`"));
			$saldo = $saldo[saldo];
			return($saldo);
		}
	}
	/**
	 * Classe da Agenda de Consultas
	 *
	 */
	class TAgendas {
		private $dados;
		function LoadAgenda($datData, $timHora, $intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `agenda` WHERE `data` = '".$datData."' AND  `hora` = '".$timHora."' AND  `codigo_dentista` = '".$intCodigo."'"));
			$this->dados = $row;
			$this->dados[data] = $datData;
			$this->dados[hora] = $timHora;
			$this->dados[codigo_dentista] = $intCodigo;
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'data' && $chave != 'hora' && $chave != 'codigo_dentista') {
					mysql_query("UPDATE `agenda` SET `".$chave."` = '".$valor."' WHERE `data` = '".$this->dados[data]."' AND `hora` = '".$this->dados[hora]."' AND  `codigo_dentista` = '".$this->dados[codigo_dentista]."'");
				}
			}
		}
		function SalvarNovo() {
			mysql_query("INSERT INTO `agenda` (`data`, `hora`, `codigo_dentista`) VALUES ('".$this->dados[data]."', '".$this->dados[hora]."', '".$this->dados[codigo_dentista]."')") or die("Erro em SalvarNovo(): ".mysql_error());
		}
		function ListAgenda($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `agenda` ORDER BY `data`, `hora` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][descricao] = $row[descricao];
				$lista[$i][procedimento] = $row[procedimento];
				$lista[$i][data] = $row[data];
				$lista[$i][hora] = $row[hora];
				$lista[$i][codigo_dentista] = $row[codigo_dentista];
				$i++;
			}
			return $lista;
		}
		function ExistHorario() {
			return(mysql_num_rows(mysql_query("SELECT * FROM `agenda` WHERE `data` = '".$this->dados[data]."' AND `hora` = '".$this->dados[hora]."' AND  `codigo_dentista` = '".$this->dados[codigo_dentista]."'")));
		}
	}
	/**
	 * Classe das contas a pagar e a receber
	 * 
	 */
	class TContas {
		private $dados;
		private $dbase;
		function __construct($strOpcao, $strEntrada = '') {
			if($strOpcao == 'dentista' && $strEntrada == '') {
				$this->dbase = 'contaspagar_dent';
			} elseif($strOpcao == 'clinica' && $strEntrada == '') {
				$this->dbase = 'contaspagar';
			} elseif($strOpcao == 'dentista' && $strEntrada != '') {
				$this->dbase = 'contasreceber_dent';
			} elseif($strOpcao == 'clinica' && $strEntrada != '') {
				$this->dbase = 'contasreceber';
			}
		}
		function LoadConta($intCodigo) {
			$this->dados = mysql_fetch_assoc(mysql_query("SELECT * FROM `".$this->dbase."` WHERE `codigo` = ".$intCodigo));
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo' && $chave != 'codigo_dentista') {
					mysql_query("UPDATE `".$this->dbase."` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->dados[codigo]."'");
				}
			}
		}
		function SalvarNovo() {
			$this->dados[codigo] = next_autoindex($this->dbase);
			if($this->dbase == 'contaspagar_dent') {
				mysql_query("INSERT INTO `".$this->dbase."` (`codigo`, `codigo_dentista`) VALUES ('".$this->dados[codigo]."', '".$this->dados[codigo_dentista]."')") or die("Erro em SalvarNovo(): ".mysql_error());
			} elseif($this->dbase == 'contaspagar') {
				mysql_query("INSERT INTO `".$this->dbase."` (`codigo`) VALUES ('".$this->dados[codigo]."')") or die("Erro em SalvarNovo(): ".mysql_error());
			} elseif($this->dbase == 'contasreceber_dent') {
				mysql_query("INSERT INTO `".$this->dbase."` (`codigo`, `codigo_dentista`) VALUES ('".$this->dados[codigo]."', '".$this->dados[codigo_dentista]."')") or die("Erro em SalvarNovo(): ".mysql_error());
			} elseif($this->dbase == 'contasreceber') {
				mysql_query("INSERT INTO `".$this->dbase."` (`codigo`) VALUES ('".$this->dados[codigo]."')") or die("Erro em SalvarNovo(): ".mysql_error());
			}
		}
		function ListConta($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `".$this->dbase."` ORDER BY `datavencimento` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][codigo] = $row[codigo];
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe dos cheques recebidos
	 * 
	 */
	class TCheques {
		private $dados;
		private $dbase;
		function __construct($strOpcao = '') {
			if($strOpcao == 'dentista') {
				$this->dbase = 'cheques_dent';
			} else {
				$this->dbase = 'cheques';
			}
		}
		function LoadCheque($intCodigo) {
			$this->dados = mysql_fetch_assoc(mysql_query("SELECT * FROM `".$this->dbase."` WHERE `codigo` = ".$intCodigo));
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `".$this->dbase."` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->dados[codigo]."'");
				}
			}
		}
		function SalvarNovo() {
			$this->dados[codigo] = next_autoindex($this->dbase);
			if($this->dbase == 'cheques_dent') {
				mysql_query("INSERT INTO `".$this->dbase."` (`codigo`, `codigo_dentista`) VALUES ('".$this->dados[codigo]."', '".$this->dados[codigo_dentista]."')") or die("Erro em SalvarNovo(): ".mysql_error());
			} else {
				mysql_query("INSERT INTO `".$this->dbase."` (`codigo`) VALUES ('".$this->dados[codigo]."')") or die("Erro em SalvarNovo(): ".mysql_error());
			}
		}
		function ListCheque($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `".$this->dbase."` ORDER BY `codigo` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][codigo] = $row[codigo];
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe do controle de estoques
	 *
	 */
	class TEstoque {
		private $dados;
		private $dbase;
		function __construct($strOpcao) {
			if($strOpcao == 'dentista') {
				$this->dbase = 'estoque_dent';
			} elseif($strOpcao == 'clinica') {
				$this->dbase = 'estoque';
			}
		}
		function LoadConta($intCodigo) {
			$this->dados = mysql_fetch_assoc(mysql_query("SELECT * FROM `".$this->dbase."` WHERE `codigo` = ".$intCodigo));
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo' && $chave != 'codigo_dentista') {
					mysql_query("UPDATE `".$this->dbase."` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->dados[codigo]."'");
				}
			}
		}
		function SalvarNovo() {
			$this->dados[codigo] = next_autoindex($this->dbase);
			if($this->dbase == 'estoque_dent') {
				mysql_query("INSERT INTO `".$this->dbase."` (`codigo`, `codigo_dentista`) VALUES ('".$this->dados[codigo]."', '".$this->dados[codigo_dentista]."')") or die("Erro em SalvarNovo(): ".mysql_error());
			} elseif($this->dbase == 'estoque') {
				mysql_query("INSERT INTO `".$this->dbase."` (`codigo`) VALUES ('".$this->dados[codigo]."')") or die("Erro em SalvarNovo(): ".mysql_error());
			}
		}
		function ListConta($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `".$this->dbase."` ORDER BY `descricao` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i][codigo] = $row[codigo];
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe do controle da tablea de honorários
	 *
	 */
	class THonorarios {
		private $dados;
		function LoadInfo($strCodigo) {
			$this->dados = mysql_fetch_assoc(mysql_query("SELECT * FROM `honorarios` WHERE `codigo` = '".$strCodigo."'"));
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `honorarios` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->dados['codigo']."'");
				}
			}
		}
		function SalvarNovo() {
            mysql_query("INSERT INTO `honorarios` (codigo) VALUES ('".$this->dados['codigo']."')") or die("Erro em SalvarNovo(): ".mysql_error());
		}
		function Consulta($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `honorarios` ORDER BY `codigo` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i]['codigo'] = $row['codigo'];
				$lista[$i]['procedimento'] = $row['procedimento'];
				$lista[$i]['valor_particular'] = $row['valor_particular'];
				$lista[$i]['valor_convenio'] = $row['valor_convenio'];
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe para controle de orçamento
	 * 
	 */
	class TOrcamento {
		private $dados;
		private $dadosPagamentos;
		private $dadosProcedimentos;
		function LoadOrcamento($intCodigo) {
			$this->dados = mysql_fetch_assoc(mysql_query("SELECT * FROM `orcamento` WHERE `codigo` = ".$intCodigo));
			$i = 0;
			$query = mysql_query("SELECT * FROM `procedimentos_orcamento` WHERE `codigo_orcamento` = ".$intCodigo);
			while($row = mysql_fetch_assoc($query)) {
				foreach($row as $chave => $valor) {
					$this->dadosProcedimentos[$i][$chave] = $valor;
				}
				$i++;
			}
			$i = 0;
			$query = mysql_query("SELECT * FROM `pagamentos_orcamento` WHERE `codigo_orcamento` = ".$intCodigo);
			while($row = mysql_fetch_assoc($query)) {
				foreach($row as $chave => $valor) {
					$this->dadosPagamentos[$i][$chave] = $valor;
				}
				$i++;
			}
		}
		function RetornaDados($strCampo) {
			return($this->dados[$strCampo]);
		}
		function RetornaDadosPagamentos($strCampo, $intIndice) {
			return($this->dadosPagamentos[$intIndice][$strCampo]);
		}
		function RetornaDadosProcedimentos($strCampo, $intIndice) {
			return($this->dadosProcedimentos[$intIndice][$strCampo]);
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function SetDadosPagamentos($strCampo, $strValor, $intIndice) {
			$this->dadosPagamentos[$intIndice][$strCampo] = $strValor;
		}
		function SetDadosProcedimentos($strCampo, $strValor, $intIndice) {
			$this->dadosProcedimentos[$intIndice][$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `orcamento` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->dados['codigo']."'");
				}
			}
		}
		function SalvarPagamentos() {
			foreach($this->dadosPagamentos as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `orcamento` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->dados['codigo']."'");
				}
			}
		}
	}
	/**
	 * Classe dos exames objetivos dos pacientes da clínica
	 *
	 */
	class TExObjetivo {
		private $dados;
		function LoadExObjetivo($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `exameobjetivo` WHERE `codigo_paciente` = '".$intCodigo."'"));
			$this->dados = $row;
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo_paciente') {
					mysql_query("UPDATE `exameobjetivo` SET `".$chave."` = '".$valor."' WHERE `codigo_paciente` = '".$this->dados[codigo_paciente]."'");
				}
			}
		}
		function SalvarNovo() {
			mysql_query("INSERT INTO `exameobjetivo` (`codigo_paciente`) VALUES ('".$this->dados[codigo_paciente]."')") or die("Erro em SalvarNovo(): ".mysql_error());
		}
	}
	/**
	 * Classe da evolução no tratamento dos pacientes da clínica
	 *
	 */
	class TEvolucao {
		private $dados;
		function LoadEvolucao($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `evolucao` WHERE `codigo` = '".$intCodigo."'"));
			$this->dados = $row;
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function ApagaDados() {
            mysql_query("DELETE FROM evolucao WHERE codigo = ".$this->dados['codigo']);
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo') {
					mysql_query("UPDATE `evolucao` SET `".$chave."` = '".$valor."' WHERE `codigo` = '".$this->dados[codigo]."'");
				}
			}
		}
		function SalvarNovo() {
			$this->dados[codigo] = next_autoindex('evolucao');
			mysql_query("INSERT INTO `evolucao` (`codigo_paciente`, `codigo`) VALUES ('".$this->dados[codigo_paciente]."', '".$this->dados[codigo]."')") or die("Erro em SalvarNovo(): ".mysql_error());
		}
		function ListEvolucao($sql = "") {
			$i = 0;
			if($sql == "") {
				$sql = "SELECT * FROM `evolucao` WHERE `codigo_paciente` = '".$this->dados[codigo_paciente]."' ORDER BY `data` ASC";
			}
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_array($query)) {
				$lista[$i] = $row[codigo];
				$i++;
			}
			return $lista;
		}
	}
	/**
	 * Classe dos inquéritos de saúde dos pacientes da clínica
	 *
	 */
	class TInquerito {
		private $dados;
		function LoadInquerito($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `inquerito` WHERE `codigo_paciente` = '".$intCodigo."'"));
			$this->dados = $row;
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
				if($chave != 'codigo_paciente') {
					mysql_query("UPDATE `inquerito` SET `".$chave."` = '".$valor."' WHERE `codigo_paciente` = '".$this->dados[codigo_paciente]."'");
				}
			}
		}
		function SalvarNovo() {
			mysql_query("INSERT INTO `inquerito` (`codigo_paciente`) VALUES ('".$this->dados[codigo_paciente]."')") or die("Erro em SalvarNovo(): ".mysql_error());
		}
	}
	/**
	 * Classe da Ortodontia dos pacientes da clínica
	 *
	 */
	class TOrtodontia {
		private $dados;
		function LoadOrtodontia($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `ortodontia` WHERE `codigo_paciente` = '".$intCodigo."'"));
			$this->dados = $row;
            if($this->dados == '') {
                $this->dados['codigo_paciente'] = $intCodigo;
            }
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
                $set[] = $chave;
                $value[] = "'".$valor."'";
			}
			$set = implode(', ', $set);
			$value = implode(', ', $value);
			mysql_query("REPLACE INTO ortodontia (".$set.") VALUES (".$value.")") or die('Line 933: '.mysql_error());
		}
	}
	/**
	 * Classe da Implantodontia dos pacientes da clínica
	 *
	 */
	class TImplantodontia {
		private $dados;
		function LoadImplantodontia($intCodigo) {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `implantodontia` WHERE `codigo_paciente` = '".$intCodigo."'"));
			$this->dados = $row;
            if($this->dados == '') {
                $this->dados['codigo_paciente'] = $intCodigo;
            }
		}
		function RetornaDados($strCampo) {
			return $this->dados[$strCampo];
		}
		function RetornaTodosDados() {
			return $this->dados;
		}
		function SetDados($strCampo, $strValor) {
			$this->dados[$strCampo] = $strValor;
		}
		function Salvar() {
			foreach($this->dados as $chave => $valor) {
                $set[] = $chave;
                $value[] = "'".$valor."'";
			}
			$set = implode(', ', $set);
			$value = implode(', ', $value);
			mysql_query("REPLACE INTO implantodontia (".$set.") VALUES (".$value.")") or die('Line 965: '.mysql_error());
		}
	}
	/**
	 * Classe dos dados da clínica para cabeçalhos
	 *
	 */
	class TClinica {
        private $cnpj;
        private $razaosocial;
        private $fantasia;
        private $proprietario;
        private $endereco;
        private $bairro;
        private $cidade;
        private $estado;
        private $cep;
        private $pais;
        private $fundacao;
        private $telefone1;
        private $telefone2;
        private $fax;
        private $email;
        private $web;
        private $banco1;
        private $agencia1;
        private $conta1;
        private $banco2;
        private $agencia2;
        private $conta2;
        private $idioma;
        private $logomarca;
        /**
         * Declara os atributos
         *
         */
        function getCNPJ() { return $this->cnpj; }
        function setCNPJ($strCNPJ) { $this->cnpj = $strCNPJ; }

        function getRazaoSocial() { return $this->razaosocial; }
        function setRazaoSocial($strRazaoSocial) { $this->razaosocial = $strRazaoSocial; }

        function getFantasia() { return $this->fantasia; }
        function setFantasia($strFantasia) { $this->fantasia = $strFantasia; }

        function getProprietario() { return $this->proprietario; }
        function setProprietario($strProprietario) { $this->proprietario = $strProprietario; }

        function getEndereco() { return $this->endereco; }
        function setEndereco($strEndereco) { $this->endereco = $strEndereco; }

        function getBairro() { return $this->bairro; }
        function setBairro($strBairro) { $this->bairro = $strBairro; }

        function getCidade() { return $this->cidade; }
        function setCidade($strCidade) { $this->cidade = $strCidade; }

        function getEstado() { return $this->estado; }
        function setEstado($strEstado) { $this->estado = $strEstado; }

        function getCEP() { return $this->cep; }
        function setCEP($strCEP) { $this->cep = $strCEP; }
        
        function getPais() { return $this->pais; }
        function setPais($strPais) { $this->pais = $strPais; }

        function getFundacao() { return $this->fundacao; }
        function setFundacao($strFundacao) { $this->fundacao = $strFundacao; }

        function getTelefone1() { return $this->telefone1; }
        function setTelefone1($strTelefone1) { $this->telefone1 = $strTelefone1; }

        function getTelefone2() { return $this->telefone2; }
        function setTelefone2($strTelefone2) { $this->telefone2 = $strTelefone2; }

        function getFax() { return $this->fax; }
        function setFax($strFax) { $this->fax = $strFax; }

        function getEmail() { return $this->email; }
        function setEmail($strEmail) { $this->email = $strEmail; }

        function getWeb() { return $this->web; }
        function setWeb($strWeb) { $this->web = $strWeb; }

        function getBanco1() { return $this->banco1; }
        function setBanco1($strBanco1) { $this->banco1 = $strBanco1; }

        function getAgencia1() { return $this->agencia1; }
        function setAgencia1($strAgencia1) { $this->agencia1 = $strAgencia1; }

        function getConta1() { return $this->conta1; }
        function setConta1($strConta1) { $this->conta1 = $strConta1; }

        function getBanco2() { return $this->banco2; }
        function setBanco2($strBanco2) { $this->banco2 = $strBanco2; }

        function getAgencia2() { return $this->agencia2; }
        function setAgencia2($strAgencia2) { $this->agencia2 = $strAgencia2; }

        function getConta2() { return $this->conta2; }
        function setConta2($strConta2) { $this->conta2 = $strConta2; }

        function getIdioma() { return $this->idioma; }
        function setIdioma($strIdioma) { $this->idioma = $strIdioma; }

        function getLogomarca() { return $this->logomarca; }
        function setLogomarca($strLogomarca) { $this->logomarca = $strLogomarca; }
        /**
         * Métodos da classe
         *
         */
		function LoadInfo() {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM `dados_clinica`"));
            $this->CNPJ = $row['cnpj'];
            $this->RazaoSocial = $row['razaosocial'];
            $this->Fantasia = $row['fantasia'];
            $this->Proprietario = $row['proprietario'];
            $this->Endereco = $row['endereco'];
            $this->Bairro = $row['bairro'];
            $this->Cidade = $row['cidade'];
            $this->Estado = $row['estado'];
            $this->Cep = $row['cep'];
            $this->Pais = $row['pais'];
            $this->Fundacao = $row['fundacao'];
            $this->Telefone1 = $row['telefone1'];
            $this->Telefone2 = $row['telefone2'];
            $this->Fax = $row['fax'];
            $this->Email = $row['email'];
            $this->Web = $row['web'];
            $this->Banco1 = $row['banco1'];
            $this->Agencia1 = $row['agencia1'];
            $this->Conta1 = $row['conta1'];
            $this->Banco2 = $row['banco2'];
            $this->Agencia2 = $row['agencia2'];
            $this->Conta2 = $row['conta2'];
            $this->Idioma = $row['idioma'];
            $this->Logomarca = $row['logomarca'];
		}
		function Salvar() {
            $sql  = "UPDATE dados_clinica SET ";
            $sql .= "cnpj = '".$this->CNPJ."', ";
            $sql .= "razaosocial = '".$this->RazaoSocial."', ";
            $sql .= "fantasia = '".$this->Fantasia."', ";
            $sql .= "proprietario = '".$this->Proprietario."', ";
            $sql .= "endereco = '".$this->Endereco."', ";
            $sql .= "bairro = '".$this->Bairro."', ";
            $sql .= "cidade = '".$this->Cidade."', ";
            $sql .= "estado = '".$this->Estado."', ";
            $sql .= "cep = '".$this->Cep."', ";
            $sql .= "pais = '".$this->Pais."', ";
            $sql .= "fundacao = '".$this->Fundacao."', ";
            $sql .= "telefone1 = '".$this->Telefone1."', ";
            $sql .= "telefone2 = '".$this->Telefone2."', ";
            $sql .= "fax = '".$this->Fax."', ";
            $sql .= "email = '".$this->Email."', ";
            $sql .= "web = '".$this->Web."', ";
            $sql .= "banco1 = '".$this->Banco1."', ";
            $sql .= "agencia1 = '".$this->Agencia1."', ";
            $sql .= "conta1 = '".$this->Conta1."', ";
            $sql .= "banco2 = '".$this->Banco2."', ";
            $sql .= "agencia2 = '".$this->Agencia2."', ";
            $sql .= "conta2 = '".$this->Conta2."', ";
            $sql .= "idioma = '".$this->Idioma."'";
            mysql_query($sql) or die('Line 1001: '. mysql_error());
		}
	}
	/**
	 * Classe do texto da receita
	 *
	 */
	class TReceita {
        private $receita;
        private $codigo_paciente;
        /**
         * Declara os atributos
         *
         */
        function getReceita() { return $this->receita; }
        function setReceita($strReceita) { $this->receita = $strReceita; }

        function getCodigo_Paciente() { return $this->codigo_paciente; }
        function setCodigo_Paciente($strCodigo_Paciente) { $this->codigo_paciente = $strCodigo_Paciente; }
        /**
         * Métodos da classe
         *
         */
        function LoadInfo() {
            $row = mysql_fetch_assoc(mysql_query("SELECT * FROM `receitas` WHERE codigo_paciente = ".$this->Codigo_Paciente));
            $this->Receita = $row['receita'];
        }
		function SalvarNovo() {
            $sql  = "INSERT INTO receitas ";
            $sql .= "(receita, codigo_paciente) ";
            $sql .= "VALUES ('Amoxil(Amoxicilina).................................................... 500 mg ............................................................ 1cx
1(uma) cápsula de 8(oito) em 8(oito) horas durante 7(sete) dias




Cataflam(Diclofenaco).................................................. 50mg ............................................................. 1cx
1(um) comprimido de 8(oito) em 8(oito) horas durante 7(sete) dias




Tylenol(Paracetamol).................................................... 750mg ............................................................ 1cx
1(um) comprimido de 4(quatro) em 4(quatro) horas durante 2(dois) dias ou quando houver dor.', ";
            $sql .= "'".$this->Codigo_Paciente."')";
            mysql_query($sql) or die('Line 1152: '. mysql_error());
		}
		function Salvar() {
            $sql  = "UPDATE receitas SET ";
            $sql .= "receita = '".$this->Receita."' ";
            $sql .= "WHERE codigo_paciente = ".$this->Codigo_Paciente;
            mysql_query($sql) or die('Line 1158: '. mysql_error());
		}
	}
	/**
	 * Classe do texto do atestado
	 *
	 */
	class TAtestado {
        private $atestado;
        private $codigo_paciente;
        /**
         * Declara os atributos
         *
         */
        function getAtestado() { return $this->atestado; }
        function setAtestado($strAtestado) { $this->atestado = $strAtestado; }

        function getCodigo_Paciente() { return $this->codigo_paciente; }
        function setCodigo_Paciente($strCodigo_Paciente) { $this->codigo_paciente = $strCodigo_Paciente; }
        /**
         * Métodos da classe
         *
         */
		function LoadInfo() {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM atestados WHERE codigo_paciente = ".$this->Codigo_Paciente));
            $this->Atestado = $row['atestado'];
		}
		function SalvarNovo() {
            $sql  = "INSERT INTO atestados ";
            $sql .= "(atestado, codigo_paciente) ";
            $sql .= "VALUES ('Atesto para fins trabalhistas e/ou escolares que o paciente supracitada esteve sob meus cuidados durante este dia realizando uma cirurgia oral avançada de exodontia (extração) de dentes cisos, e deverá ficar 4(quatro) dias em repouso absoluto a partir desta data.


Ressalto que este repouso será importante para o sucesso do tratamento e tranquilidade pós-operatória.



Sem mais, fico a disposição para quaisquer esclarecimentos.





CID (Código Internacional de Doenças) = K07.3', ";
            $sql .= "'".$this->Codigo_Paciente."')";
            mysql_query($sql) or die('Line 1203: '. mysql_error());
		}
		function Salvar() {
            $sql  = "UPDATE atestados SET ";
            $sql .= "atestado = '".$this->Atestado."' ";
            $sql .= "WHERE codigo_paciente = ".$this->Codigo_Paciente;
            mysql_query($sql) or die('Line 1209: '. mysql_error());
		}
	}
	/**
	 * Classe do texto do pedido de exames
	 *
	 */
	class TExame {
        private $exame;
        private $codigo_paciente;
        /**
         * Declara os atributos
         *
         */
        function getExame() { return $this->exame; }
        function setExame($strExame) { $this->exame = $strExame; }

        function getCodigo_Paciente() { return $this->codigo_paciente; }
        function setCodigo_Paciente($strCodigo_Paciente) { $this->codigo_paciente = $strCodigo_Paciente; }
        /**
         * Métodos da classe
         *
         */
		function LoadInfo() {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM exames WHERE codigo_paciente = ".$this->Codigo_Paciente));
            $this->Exame = $row['exame'];
		}
		function SalvarNovo() {
            $sql  = "INSERT INTO exames ";
            $sql .= "(exame, codigo_paciente) ";
            $sql .= "VALUES ('Solicito para o(a) paciente supracitado os seguintes exames laboratoriais para finalidade de tratamento odontológico:


- Hemograma Completo

- Coagulograma

- Colesterol

- Triglicérides

- Glicose

- Anti-H.I.V.', ";
            $sql .= "'".$this->Codigo_Paciente."')";
            mysql_query($sql) or die('Line 1254: '. mysql_error());
		}
		function Salvar() {
            $sql  = "UPDATE exames SET ";
            $sql .= "exame = '".$this->Exame."' ";
            $sql .= "WHERE codigo_paciente = ".$this->Codigo_Paciente;
            mysql_query($sql) or die('Line 1260: '. mysql_error());
		}
	}
	/**
	 * Classe do texto do pedido de encaminhamento
	 *
	 */
	class TEncaminhamento {
        private $encaminhamento;
        private $codigo_paciente;
        /**
         * Declara os atributos
         *
         */
        function getEncaminhamento() { return $this->encaminhamento; }
        function setEncaminhamento($strEncaminhamento) { $this->encaminhamento = $strEncaminhamento; }

        function getCodigo_Paciente() { return $this->codigo_paciente; }
        function setCodigo_Paciente($strCodigo_Paciente) { $this->codigo_paciente = $strCodigo_Paciente; }
        /**
         * Métodos da classe
         *
         */
		function LoadInfo() {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM encaminhamentos WHERE codigo_paciente = ".$this->Codigo_Paciente));
            $this->Encaminhamento = $row['encaminhamento'];
		}
		function SalvarNovo() {
            $sql  = "INSERT INTO encaminhamentos ";
            $sql .= "(encaminhamento, codigo_paciente) ";
            $sql .= "VALUES ('Prezado colega,

Encaminho o(a) paciente para a realização de um tratamento endodôntico no dente 26 conforme imagem radiográfica visível na radiografia em anexo.

Fico a disposição para qualquer esclarecimento.

Atenciosamente.', ";
            $sql .= "'".$this->Codigo_Paciente."')";
            mysql_query($sql) or die('Line 1298: '. mysql_error());
		}
		function Salvar() {
            $sql  = "UPDATE encaminhamentos SET ";
            $sql .= "encaminhamento = '".$this->Encaminhamento."' ";
            $sql .= "WHERE codigo_paciente = ".$this->Codigo_Paciente;
            mysql_query($sql) or die('Line 1304: '. mysql_error());
		}
	}
	/**
	 * Classe do texto do pedido de laudos
	 *
	 */
	class TLaudo {
        private $laudo;
        private $codigo_paciente;
        /**
         * Declara os atributos
         *
         */
        function getLaudo() { return $this->laudo; }
        function setLaudo($strLaudo) { $this->laudo = $strLaudo; }

        function getCodigo_Paciente() { return $this->codigo_paciente; }
        function setCodigo_Paciente($strCodigo_Paciente) { $this->codigo_paciente = $strCodigo_Paciente; }
        /**
         * Métodos da classe
         *
         */
		function LoadInfo() {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM laudos WHERE codigo_paciente = ".$this->Codigo_Paciente));
            $this->Laudo = $row['laudo'];
		}
		function SalvarNovo() {
            $sql  = "INSERT INTO laudos ";
            $sql .= "(laudo, codigo_paciente) ";
            $sql .= "VALUES ('Paciente apresenta-se com lesão periapical radiolúcida sugestiva de cisto.

Recomendamos que faça o tratamento adequado para a regressão desta lesão.

Fico à disposição para qualquer esclarecimento.

Atenciosamente.', ";
            $sql .= "'".$this->Codigo_Paciente."')";
            mysql_query($sql) or die('Line 1342: '. mysql_error());
		}
		function Salvar() {
            $sql  = "UPDATE laudos SET ";
            $sql .= "laudo = '".$this->Laudo."' ";
            $sql .= "WHERE codigo_paciente = ".$this->Codigo_Paciente;
            mysql_query($sql) or die('Line 1348: '. mysql_error());
		}
	}
	/**
	 * Classe do texto do pedido de laudos
	 *
	 */
	class TAgradecimento {
        private $agradecimento;
        private $codigo_paciente;
        /**
         * Declara os atributos
         *
         */
        function getAgradecimento() { return $this->agradecimento; }
        function setAgradecimento($strAgradecimento) { $this->agradecimento = $strAgradecimento; }

        function getCodigo_Paciente() { return $this->codigo_paciente; }
        function setCodigo_Paciente($strCodigo_Paciente) { $this->codigo_paciente = $strCodigo_Paciente; }
        /**
         * Métodos da classe
         *
         */
		function LoadInfo() {
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM agradecimentos WHERE codigo_paciente = ".$this->Codigo_Paciente));
            $this->Agradecimento = $row['agradecimento'];
		}
		function SalvarNovo() {
            $sql  = "INSERT INTO agradecimentos ";
            $sql .= "(agradecimento, codigo_paciente) ";
            $sql .= "VALUES ('Agradeço o encaminhamento do(a) paciente em questão e encaminho de volta para a continuidade do tratamento após ter executado todo o tratamento solicitado.

Fico à disposição para esclarecimentos.

Atenciosamente.', ";
            $sql .= "'".$this->Codigo_Paciente."')";
            mysql_query($sql) or die('Line 1384: '. mysql_error());
		}
		function Salvar() {
            $sql  = "UPDATE agradecimentos SET ";
            $sql .= "agradecimento = '".$this->Agradecimento."' ";
            $sql .= "WHERE codigo_paciente = ".$this->Codigo_Paciente;
            mysql_query($sql) or die('Line 1390: '. mysql_error());
		}
	}
?>
