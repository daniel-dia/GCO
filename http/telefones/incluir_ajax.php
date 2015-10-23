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
	if(($_GET['codigo'] != '' && !verifica_nivel('contatos', 'E')) || ($_GET['codigo'] == '' && !verifica_nivel('contatos', 'I'))) {
        $disable = 'disabled';
    }
	$telefones = new TTelefones();
  
	if(isset($_POST[Salvar])) { 
		$obrigatorios[1] = 'nom';
		$obrigatorios[2] = 'telefone1';
		$i = $j = 0;
    
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
				$r[$i] = 'has-error';
			    $j++;
			}
		}
		if($j == 0) {
			if($_GET[acao] == "editar") {
				$telefones->LoadTelefones($_GET[codigo]);
			}
			$telefones->SetDados('nome',  ( htmlspecialchars( ($_POST['nom']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$telefones->SetDados('endereco',  ( htmlspecialchars( ($_POST['endereco']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$telefones->SetDados('bairro',  ( htmlspecialchars( ($_POST['bairro']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$telefones->SetDados('cidade',  ( htmlspecialchars( ($_POST['cidade']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$telefones->SetDados('estado', $_POST[estado]);
			$telefones->SetDados('pais',  ( htmlspecialchars( ($_POST['pais']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$telefones->SetDados('cep', $_POST[cep]);
			$telefones->SetDados('celular', $_POST[celular]);
			$telefones->SetDados('telefone1', $_POST[telefone1]);
			$telefones->SetDados('telefone2', $_POST[telefone2]);
			$telefones->SetDados('website', $_POST[website]);
			$telefones->SetDados('email', $_POST[email]);
			if($_GET[acao] != "editar") {
				$telefones->SalvarNovo();
				//$strScrp = "alert('Cadastro realizado com sucesso!'); Ajax('telefones/incluir', 'conteudo', '');";
			}
			$strScrp = "Ajax('telefones/gerenciar', 'conteudo', '');";
			$telefones->Salvar();
		}
	}
	if($_GET[acao] == "editar") {
		$strLoCase = $LANG['useful_telephones']['editing'];
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$telefones->LoadTelefones($_GET[codigo]);
		$row = $telefones->RetornaTodosDados();
	} else {		
		if($j == 0) {
			$row = "";
		} else {
			$row = $_POST;
			$row[nome] = $_POST[nom];
		}
		$strLoCase = $LANG['useful_telephones']['including'];
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>


    <h1 class="page-header"> 
   <?php echo $LANG['useful_telephones']['contact_information']?>
    </h1>

    <div class="conteudo" id="table dados"><br>

 
      <form class="form-horizontal" id="form2" name="form2" method="POST" action="telefones/incluir_ajax.php<?php echo $frmActEdt?>" 
          onsubmit="formSender(this, 'conteudo'); return false;">
    
         
          <div class="form-group <?php echo $r[1]?>">
          <label class="control-label col-sm-2 input-lg">*<?php echo $LANG['useful_telephones']['name']?>    </label>
          <div class="col-sm-10"><input class="input-lg form-control" name="nom" value="<?php echo $row[nome]?>" type="text" <?php echo $disable?> id="nom" size="50" maxlength="80" />
          </div></div>
          <div class="form-group">
          <label class="control-label col-sm-2"> <?php echo $LANG['useful_telephones']['address1']?></labeL>
          <div class="col-sm-10"><input name="endereco" value="<?php echo $row[endereco]?>" type="text" class="form-control" <?php echo $disable?> id="endereco" size="50" maxlength="150" /> 
          </div></div>
          <div class="form-group">
          <label class="control-label col-sm-2"><?php echo $LANG['useful_telephones']['address2']?></label>
          <div class="col-sm-10"><input name="bairro" value="<?php echo $row[bairro]?>" type="text" class="form-control" <?php echo $disable?> id="bairro" /> 
          </div></div>
          <div class="form-group">
          <label class="control-label col-sm-2"><?php echo $LANG['useful_telephones']['city']?></label>
          <div class="col-sm-10"><input name="cidade" value="<?php echo $row[cidade]?>" <?php echo $disable?> type="text" class="form-control" <?php echo $disable?> id="cidade" size="30" maxlength="50" />
          </div></div>
          <div class="form-group">
          <label class="control-label col-sm-2"><?php echo $LANG['useful_telephones']['state']?></label>
          <div class="col-sm-10"><input name="estado" value="<?php echo $row[estado]?>" <?php echo $disable?> type="text" class="form-control" <?php echo $disable?> id="estado" maxlength="50" />
          </div></div>
          <div class="form-group">
          <label class="control-label col-sm-2"><?php echo $LANG['useful_telephones']['country']?></label>
          <div class="col-sm-10"><input name="pais" value="<?php echo $row[pais]?>" <?php echo $disable?> type="text" class="form-control" <?php echo $disable?> id="pais" size="30" maxlength="50" />
          </div></div>
          <div class="form-group">
          <label class="control-label col-sm-2"> <?php echo $LANG['useful_telephones']['zip']?></label>
          <div class="col-sm-10"><input name="cep" value="<?php echo $row[cep]?>" type="text" class="form-control" <?php echo $disable?> id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" />
          </div></div>
          <div class="form-group">
          <label class="control-label col-sm-2"><?php echo $LANG['useful_telephones']['cellphone']?></label>
          <div class="col-sm-10"><input name="celular" value="<?php echo $row[celular]?>" type="text" class="form-control" <?php echo $disable?> id="celular" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" />
          </div></div>
          <div class="form-group <?php echo $r[9]?>">
          <label class="control-label col-sm-2"> *<?php echo $LANG['useful_telephones']['phone1']?></label>
          <div class="col-sm-10"><input name="telefone1" value="<?php echo $row[telefone1]?>" type="text" class="form-control" <?php echo $disable?> id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" />
          </div></div>
          <div class="form-group">
          <label class="control-label col-sm-2"><?php echo $LANG['useful_telephones']['phone2']?></label>
          <div class="col-sm-10"><input name="telefone2" value="<?php echo $row[telefone2]?>" type="text" class="form-control" <?php echo $disable?> id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" />
          </div></div>
          <div class="form-group">
          <label class="control-label col-sm-2"><?php echo $LANG['useful_telephones']['email']?></label>
          <div class="col-sm-10"><input name="email" value="<?php echo $row[email]?>" type="text" class="form-control" <?php echo $disable?> id="email" size="40" />
          </div></div>
          <div class="form-group">
          <label class="control-label col-sm-2"><?php echo $LANG['useful_telephones']['website']?> </label>
          <div class="col-sm-10"><input name="website" value="<?php echo $row[website]?>" type="text" class="form-control" <?php echo $disable?> id="site" size="40" />
          </div> </div>
          
          <div class="form-group">
          <div class="col-sm-10 col-sm-offset-2">
            <button class="btn btn-primary" name="Salvar" type="submit" <?php echo $disable?> id="Salvar" >
                <?php echo $LANG['useful_telephones']['save']?>
            </button>
            </div>  
          </div>
          
      </form>   
</div>
<script>
  document.getElementById('nom').focus();
</script>
