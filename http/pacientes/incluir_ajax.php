<?php
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php'; 
	if(!checklog()) {
		die($frase_log);
	}
	$paciente = new TPacientes();
	if(isset($_POST['Salvar'])) {
        $_POST['tratamento'] = @implode(',', $_POST['tratamento']);
		$obrigatorios[1] = 'codigo';
		$obrigatorios[] = 'nom';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
				$r[$i] = '<font color="#FF0000">';
			    $j++;
			}
		}
		if(!is_valid_codigo($_POST[codigo]) && $_GET[acao] != "editar") {
			$j++;
			$r[1] = '<font color="#FF0000">';
        }
		if($j === 0) {
			if($_GET[acao] == "editar") {
				$paciente->LoadPaciente($_POST[codigo]);
				$strScrp = "Ajax('pacientes/gerenciar', 'conteudo', '')";
			}
			$paciente->SetDados('codigo', $_POST[codigo]);
			$paciente->SetDados('nome',  ( htmlspecialchars( ($_POST['nom']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('cpf', $_POST[cpf]);
			$paciente->SetDados('rg', $_POST[rg]);
			$paciente->SetDados('estadocivil',  ( htmlspecialchars( ($_POST['estadocivil']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('sexo', $_POST[sexo]);
			$paciente->SetDados('etnia', $_POST[etnia]);
			$paciente->SetDados('profissao',  ( htmlspecialchars( ($_POST['profissao']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('naturalidade',  ( htmlspecialchars( ($_POST['naturalidade']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('nacionalidade',  ( htmlspecialchars( ($_POST['nacionalidade']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('nascimento', converte_data($_POST[nascimento], 1));
			$paciente->SetDados('endereco',  ( htmlspecialchars( ($_POST['endereco']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('bairro',  ( htmlspecialchars( ($_POST['bairro']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('cidade',  ( htmlspecialchars( ($_POST['cidade']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('estado', $_POST[estado]);
			$paciente->SetDados('pais',  ( htmlspecialchars( ($_POST['pais']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('falecido', $_POST[falecido]);
			$paciente->SetDados('cep', $_POST[cep]);
			$paciente->SetDados('celular', $_POST[celular]);
			$paciente->SetDados('telefone1', $_POST[telefone1]);
			$paciente->SetDados('telefone2', $_POST[telefone2]);
			$paciente->SetDados('hobby',  ( htmlspecialchars( ($_POST['hobby']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('indicadopor',  ( htmlspecialchars( ($_POST['indicadopor']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('email', $_POST[email]);
			$paciente->SetDados('obs_etiqueta',  ( htmlspecialchars( ($_POST['obs_etiqueta']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('tratamento', $_POST[tratamento]);
			$paciente->SetDados('codigo_dentistaprocurado', $_POST[codigo_dentistaprocurado]);
			$paciente->SetDados('codigo_dentistaatendido', $_POST[codigo_dentistaatendido]);
			$paciente->SetDados('codigo_dentistaencaminhado', $_POST[codigo_dentistaencaminhado]);
			$paciente->SetDados('nomemae',  ( htmlspecialchars( ($_POST['nomemae']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('nascimentomae', converte_data($_POST[nascimentomae], 1));
			$paciente->SetDados('profissaomae',  ( htmlspecialchars( ($_POST['profissaomae']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('nomepai',  ( htmlspecialchars( ($_POST['nomepai']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('nascimentopai', converte_data($_POST[nascimentopai], 1));
			$paciente->SetDados('profissaopai',  ( htmlspecialchars( ($_POST['profissaopai']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('telefone1pais', $_POST[telefone1pais]);
			$paciente->SetDados('telefone2pais', $_POST[telefone2pais]);
			$paciente->SetDados('enderecofamiliar', $_POST[enderecofamiliar]);
			$paciente->SetDados('datacadastro', converte_data($_POST[datacadastro], 1));
			$paciente->SetDados('dataatualizacao', date(Y.'-'.m.'-'.d));
			$paciente->SetDados('status', $_POST[status]);
			$paciente->SetDados('objetivo',  ( htmlspecialchars( ($_POST['objetivo']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('observacoes',  ( htmlspecialchars( ($_POST['observacoes']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
			$paciente->SetDados('codigo_convenio', $_POST[convenio]);
			$paciente->SetDados('outros', $_POST[outros]);
			$paciente->SetDados('matricula', $_POST[matricula]);
			$paciente->SetDados('titular', $_POST[titular]);
			$paciente->SetDados('validadeconvenio', $_POST[validadeconvenio]);
			if($_GET[acao] != "editar") {
                $paciente->SalvarNovo();
				$objetivo = new TExObjetivo();
				$objetivo->SetDados('codigo_paciente', $_POST['codigo']);
				$objetivo->SalvarNovo();
				$objetivo = new TInquerito();
				$objetivo->SetDados('codigo_paciente', $_POST['codigo']);
				$objetivo->SalvarNovo();
				$objetivo = new TAtestado();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$objetivo = new TReceita();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$objetivo = new TExame();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$objetivo = new TEncaminhamento();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$objetivo = new TLaudo();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$objetivo = new TAgradecimento();
				$objetivo->Codigo_Paciente = $_POST['codigo'];
				$objetivo->SalvarNovo();
				$strScrp = "Ajax('pacientes/gerenciar', 'conteudo', 'codigo=".$_POST[codigo]."&acao=editar')";
			}
			$paciente->Salvar();
		}
	}
	if($_GET[acao] == "editar") {
		$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
		$paciente->LoadPaciente($_GET[codigo]);
		$row = $paciente->RetornaTodosDados();
		$row[nascimento] = converte_data($row[nascimento], 2);
		$row[nascimentomae] = converte_data($row[nascimentomae], 2);
		$row[nascimentopai] = converte_data($row[nascimentopai], 2);
		$row[datacadastro] = converte_data($row[datacadastro], 2);
		$strCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
		$strLoCase = $LANG['patients']['editing'];
		$acao = '&acao=editar';
	} else {
		$strCase = $LANG['patients']['including'];
		$strLoCase = $LANG['patients']['including'];
		$row = $_POST;
		$row[nome] = $_POST[nom];
		if(!isset($_POST[codigo]) || $j == 0) {
			$row = "";
			$row[codigo] = $paciente->ProximoCodigo();
		} else {
			$row[codigo] = $_POST[codigo];
		}
	}
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>



<link href="../css/smile.css" rel="stylesheet" type="text/css" />

   

 
<div class="conteudo" id="table dados">
        <!-- ------------------------------------------------------------------------------------------------------------------------------------>       
             
    <div class="panel apanel-primary" class="clearfix">
        <h1 class="page-header"> 
            <a href="javascript:Ajax('pacientes/fotos','conteudo','codigo=<?php echo $row['codigo']; ?>&acao=editar')" ><img style="height:100px" class="img-circle" src="pacientes/verfoto.php?size=200&codigo=<?php echo $row['codigo']; ?>"></a>    
            <?php echo $strCase?></h1> 
        
        <?php if($_GET[acao] != "editar") { ?>
        <label> <?php echo $r[1]?>* <?php echo $LANG['patients']['clinical_sheet']?></label>
        <input name="codigo" value="<?php echo $row[codigo]?>" type="text" class="form-control" <?php echo $disable?> id="codigo" />
        <?php } ?>

        <?php if(em_debito($row['codigo'])){ ?>
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-alert"></span> <?php echo $LANG['patients']['patients_in_debt']; ?>
        </div>
        <?php } ?>

        <div class="row multiline">     
                        <div class="col-xs-12">
                            <label class="input-lg"><?php echo $r[2]?>*<?php echo $LANG['patients']['name']?></label>
                            <input name="nom" value="<?php echo $row[nome]?>" type="text" class="input-lg form-control form-lg" <?php echo $disable?> id="nom" size="50" maxlength="80" />
</div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <label><?php echo $r[3]?><?php echo $LANG['patients']['document1']?></label>
                            <input name="cpf" value="<?php echo $row['cpf']?>" type="text" class="form-control" <?php echo $disable?> id="cpf" maxlength="50" />
 </div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <label><?php echo $LANG['patients']['document2']?></label>
                           <input name="rg" value="<?php echo $row[rg]?>" type="text" class="form-control" <?php echo $disable?> id="rg" />
 </div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <label><?php echo $LANG['patients']['relationship_status']?></label>
                            <select name="estadocivil" class="form-control" <?php echo $disable?> id="estadocivil">
                                <?php
                                    $valores = array('solteiro' => $LANG['patients']['single'], 'casado' => $LANG['patients']['married'], 'divorciado' => $LANG['patients']['divorced'], 'viuvo' => $LANG['patients']['widowed']);
                                    foreach($valores as $chave => $valor) {
                                        if($row[estadocivil] == $chave) {
                                            echo '<option value="'.$chave.'" selected>'.$valor.'</option>';
                                        } else {
                                            echo '<option value="'.$chave.'">'.$valor.'</option>';
                                        }
                                    }
                                ?>       
                            </select>    
  </div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <label><?php echo $LANG['patients']['gender']?></label>
                            <select name="sexo" class="form-control" <?php echo $disable?> id="sexo">
                            <?php
                                $valores = array('Masculino' => $LANG['patients']['male'], 'Feminino' => $LANG['patients']['female']);
                                foreach($valores as $chave => $valor) {
                                    if($row[sexo] == $chave) {
                                        echo '<option value="'.$chave.'" selected>'.$valor.'</option>';
                                    } else {
                                        echo '<option value="'.$chave.'">'.$valor.'</option>';
                                    }
                                }
                            ?>       
                         </select>
</div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                             <label><?php echo $LANG['patients']['ethnicity']?></label><select name="etnia" class="form-control" <?php echo $disable?> id="etnia">
                                <?php
                                    $valores = array('africano' => $LANG['patients']['african'], 'asiatico' => $LANG['patients']['asian'], 'caucasiano' => $LANG['patients']['caucasian'], 'latino' => $LANG['patients']['latin'], 'orientemedio' => $LANG['patients']['middle_eastern'], 'multietnico' => $LANG['patients']['multi_ethnic']);
                                    foreach($valores as $chave => $valor) {
                                        if($row[etnia] == $chave) {
                                            echo '<option value="'.$chave.'" selected>'.$valor.'</option>';
                                        } else {
                                            echo '<option value="'.$chave.'">'.$valor.'</option>';
                                        }
                                    }
                                ?>       
                             </select> 
</div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <label><?php echo $LANG['patients']['profession']?></label>
                            <input name="profissao" value="<?php echo $row[profissao]?>" type="text" class="form-control" <?php echo $disable?> id="profissao" />                            
</div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <label><?php echo $LANG['patients']['naturality']?></label>
                            <input name="naturalidade" value="<?php echo $row[naturalidade]?>" type="text" class="form-control" <?php echo $disable?> id="naturalidade" />
</div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <label><?php echo $LANG['patients']['nationality']?></label>
                            <input name="nacionalidade" value="<?php echo $row[nacionalidade]?>" type="text" class="form-control" <?php echo $disable?> id="nacionalidade" />
</div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                        <label><?php echo $LANG['patients']['birthdate']?></label>
                                  <input name="nascimento" value="<?php echo $row[nascimento]?>" type="text" class="form-control" <?php echo $disable?> id="nascimento" maxlength="10" onKeypress="return Ajusta_Data(this, event);" />
</div>
                        <div class="col-lg-6 col-md-6 col-sm-8">
                            <label><?php echo $LANG['patients']['address1']?></label>
                            <input name="endereco" value="<?php echo $row[endereco]?>" type="text" class="form-control" <?php echo $disable?> id="endereco" size="50" maxlength="150" />
</div>
                        <div class="col-lg-3 col-md-3 col-sm-4">
                         <label><?php echo $LANG['patients']['address2']?></label>
                                  <input name="bairro" value="<?php echo $row[bairro]?>" type="text" class="form-control" <?php echo $disable?> id="bairro" />
</div>
                        <div class="col-sm-4">
                         <label><?php echo $LANG['patients']['city']?></label>
                                    <input name="cidade" value="<?php echo $row[cidade]?>" <?php echo $disable?> type="text" class="form-control" <?php echo $disable?> id="cidade" size="30" maxlength="50" />
</div>
                        <div class="col-lg-1 col-sm-2 col-xs-6" >
                        <label><?php echo $LANG['patients']['state']?></label>
                                    <input name="estado" value="<?php echo $row[estado]?>" <?php echo $disable?> type="text" class="form-control" <?php echo $disable?> id="estado" maxlength="50" />
</div>
                        <div class="col-lg-2 col-sm-4 col-xs-6">
                          <label><?php echo $LANG['patients']['country']?></label>
                                    <input name="pais" value="<?php echo $row[pais]?>" <?php echo $disable?> type="text" class="form-control" <?php echo $disable?> id="pais" size="30" maxlength="50" />
</div>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                              <label><?php echo $LANG['patients']['dead']?></label><select name="falecido" class="form-control" <?php echo $disable?> id="falecido">
                            <?php
                        $valores = array('Não' => $LANG['patients']['no'], 'Sim' => $LANG['patients']['yes']);
                        foreach($valores as $chave => $valor) {
                            if($row[falecido] == $chave) {
                                echo '<option value="'.$chave.'" selected>'.$valor.'</option>';
                            } else {
                                echo '<option value="'.$chave.'">'.$valor.'</option>';
                            }
                        }
                    ?>
                                 </select>  
</div>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                             <label><?php echo $LANG['patients']['zip']?></label>
                                  <input name="cep" value="<?php echo $row[cep]?>" type="text" class="form-control" <?php echo $disable?> id="cep" size="10" maxlength="9" onKeypress="return Ajusta_CEP(this, event);" />
</div>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <label><?php echo $LANG['patients']['cellphone']?></label>
                            <input name="celular" value="<?php echo $row[celular]?>" type="text" class="form-control" <?php echo $disable?> id="celular" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" />
</div>
                        <div class="col-lg-2 col-md-3 col-sm-3" style="overflow:elipses">
                            <label><?php echo $LANG['patients']['residential_phone']?></label>
                            <input name="telefone1" value="<?php echo $row[telefone1]?>" type="text" class="form-control" <?php echo $disable?> id="telefone1" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" />
</div>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <label><?php echo $LANG['patients']['comercial_phone']?></label>
                            <input name="telefone2" value="<?php echo $row[telefone2]?>" type="text" class="form-control" <?php echo $disable?> id="telefone2" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" />
</div>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <label><?php echo $LANG['patients']['hobby']?></label><input name="hobby" value="<?php echo $row[hobby]?>" type="text" class="form-control" <?php echo $disable?> id="hobby" size="50" />
</div>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <label><?php echo $LANG['patients']['indicated_by']?></label><input name="indicadopor" value="<?php echo $row[indicadopor]?>" type="text" class="form-control" <?php echo $disable?> id="indicacao" />
</div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <label><?php echo $LANG['patients']['email']?></label><input name="email" value="<?php echo $row[email]?>" type="text" class="form-control" <?php echo $disable?> id="email" size="50" />
</div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label><?php echo $LANG['patients']['comments_for_label']?> </label>
                            <input name="obs_etiqueta" value="<?php echo $row[obs_etiqueta]?>" type="text" class="form-control" <?php echo $disable?> id="obs_etiqueta" />
                        </div>
                    </div>
        
    </div><br><br>
    <div  class="apanel-footer" style="text-align:right">
              <a class="btn  btn-default" href="relatorios/paciente.php?codigo=<?php echo $row['codigo']?>" target="_blank"><span class="glyphicon glyphicon-print"></span> <?php echo $LANG['patients']['print_sheet']?></a>
              <input name="Salvar" type="submit" class="btn btn-primary" <?php echo $disable?> id="Salvar" value="<?php echo $LANG['patients']['save']?>" />
            </div>      
</div>

<br><br>
    <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $LANG['patients']['plan_information']?></h3>
                </div>
                <div class="panel-body">

                    <div class="col-sm-4">
                        <label>
                            <?php echo $LANG['patients']['select_plan']?>
                        </label>
                        <select name="convenio" class="form-control" <?php echo $disable?> id="convenio">
                            <?php
                                $query1 = mysql_query("SELECT * FROM convenios ORDER BY nomefantasia");
                                while($row1 = mysql_fetch_assoc($query1)) {
                                    if($row[codigo_convenio] == $row1['codigo']) {
                                        echo '<option value="'.$row1['codigo'].'" selected>'.$row1['nomefantasia'].'</option>';
                                    } else {
                                        echo '<option value="'.$row1['codigo'].'">'.$row1['nomefantasia'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>
                            <?php echo $LANG['patients']['card_number']?>
                        </label>
                        <input name="matricula" value="<?php echo $row[matricula]?>" type="text" class="form-control" <?php echo $disable?> id="matricula" size="20" />
                    </div>
                    <div class="col-sm-4">
                        <label>
                            <?php echo $LANG['patients']['good_thru']?>
                        </label>
                        <input name="validadeconvenio" value="<?php echo $row[validadeconvenio]?>" type="text" class="form-control" <?php echo $disable?> id="validadeconvenio" size="20" />
                    </div>                 
                    <div class="col-sm-12">
                        <label>
                            <?php echo $LANG['patients']['holder_name']?>
                        </label>
                        <input name="titular" value="<?php echo $row[titular]?>" type="text" class="form-control" <?php echo $disable?> id="titular" size="40" />
                    </div>
                </div>
            </div>
 <!-- ------------------------------------------------------------------------------------------------------------------------------------>   
    <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $LANG['patients']['treatments_to_do']?></h3>
                </div>
                <div class="panel-body">
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra1" ><input name="tratamento[]" value="Ortodontia" <?php echo ((strpos($row[tratamento], 'Ortodontia')!== false)?'checked':'')?> type="checkbox" id="tra1" /> <?php echo $LANG['patients']['orthodonty']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra2" ><input name="tratamento[]" value="Implantodontia" <?php echo ((strpos($row[tratamento], 'Implantodontia')!== false)?'checked':'')?> type="checkbox" id="tra2" /> <?php echo $LANG['patients']['implantodonty']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra3" ><input name="tratamento[]" value="Dentística" <?php echo ((strpos($row[tratamento], 'Dentística')!== false)?'checked':'')?> type="checkbox" id="tra3" /> <?php echo $LANG['patients']['dentistic']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra4" ><input name="tratamento[]" value="Prótese" <?php echo ((strpos($row[tratamento], 'Prótese')!== false)?'checked':'')?> type="checkbox" id="tra4" /> <?php echo $LANG['patients']['prosthesis']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra5" ><input name="tratamento[]" value="Odontopediatria" <?php echo ((strpos($row[tratamento], 'Odontopediatria')!== false)?'checked':'')?> type="checkbox" id="tra5" /> <?php echo $LANG['patients']['odontopediatry']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra6" ><input name="tratamento[]" value="Cirurgia" <?php echo ((strpos($row[tratamento], 'Cirurgia')!== false)?'checked':'')?> type="checkbox" id="tra6" /> <?php echo $LANG['patients']['surgery']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra7" ><input name="tratamento[]" value="Endodontia" <?php echo ((strpos($row[tratamento], 'Endodontia')!== false)?'checked':'')?> type="checkbox" id="tra7" /> <?php echo $LANG['patients']['endodonty']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra8" ><input name="tratamento[]" value="Periodontia" <?php echo ((strpos($row[tratamento], 'Periodontia')!== false)?'checked':'')?> type="checkbox" id="tra8" /> <?php echo $LANG['patients']['periodonty']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra9" ><input name="tratamento[]" value="Radiologia" <?php echo ((strpos($row[tratamento], 'Radiologia')!== false)?'checked':'')?> type="checkbox" id="tra9" /> <?php echo $LANG['patients']['radiology']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra10"><input name="tratamento[]" value="DTM" <?php echo ((strpos($row[tratamento], 'DTM')!== false)?'checked':'')?> type="checkbox" id="tra10" /> <?php echo $LANG['patients']['dtm']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra11"><input name="tratamento[]" value="Odontogeriatria" <?php echo ((strpos($row[tratamento], 'Odontogeriatria')!== false)?'checked':'')?> type="checkbox" id="tra11" /> <?php echo $LANG['patients']['odontogeriatry']?></label>
                    <label class="col-lg-2 col-sm-4 col-md-3 col-xs-6" for="tra12"><input name="tratamento[]" value="Ortopedia" <?php echo ((strpos($row[tratamento], 'Ortopedia')!== false)?'checked':'')?> type="checkbox" id="tra12" /> <?php echo $LANG['patients']['orthopedy']?></label>
                </div>
            </div>
 <!-- ------------------------------------------------------------------------------------------------------------------------------------>   
    <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $LANG['patients']['professional_informations']?></h3>
                </div>
                <div class="panel-body">
                    
                    <div class="form-group col-sm-4">
                        <label><?php echo $LANG['patients']['professional_searched']?></label>
                        <select name="codigo_dentistaprocurado" class="form-control" <?php echo $disable?> id="codigo_dentistaprocurado">
                        <option> </option>
                        <?php
                            $dentista = new TDentistas();
                            $lista = $dentista->ListDentistas();
                            for($i = 0; $i < count($lista); $i++) {
                                if($row[codigo_dentistaprocurado] == $lista[$i][codigo]) {
                                    echo '<option value="'.$lista[$i][codigo].'" selected>'.$lista[$i][titulo].' '.$lista[$i][nome].')</option>';
                                } else {
                                    echo '<option value="'.$lista[$i][codigo].'">'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
                                }
                            }
                        ?>
                         </select>
                    </div>

                    <div class="form-group  col-sm-4">
                        <label><?php echo $LANG['patients']['answered_by']?></label>
                        <select name="codigo_dentistaatendido" class="form-control" <?php echo $disable?> id="codigo_dentistaatendido">
                    <option></option>
                        <?php
                            $dentista = new TDentistas();
                            $lista = $dentista->ListDentistas();
                            for($i = 0; $i < count($lista); $i++) {
                                if($row[codigo_dentistaatendido] == $lista[$i][codigo]) {
                                    echo '<option value="'.$lista[$i][codigo].'" selected>'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
                                } else {
                                    echo '<option value="'.$lista[$i][codigo].'">'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
                                }
                            }
                        ?>
                 </select>
                    </div>

                    <div class="form-group col-sm-4">
                        <label><?php echo $LANG['patients']['forwarded_to']?></label>
                        <select name="codigo_dentistaencaminhado" class="form-control" <?php echo $disable?> id="codigo_dentistaencaminhado">
                    <option></option>
                        <?php
                            $dentista = new TDentistas();
                            $lista = $dentista->ListDentistas();
                            for($i = 0; $i < count($lista); $i++) {
                                if($row[codigo_dentistaencaminhado] == $lista[$i][codigo]) {
                                    echo '<option value="'.$lista[$i][codigo].'" selected>'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
                                } else {
                                    echo '<option value="'.$lista[$i][codigo].'">'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
                                }
                            }
                        ?>
                     </select>
                    </div> 
                    
                </div>
            </div>
 <!-- ------------------------------------------------------------------------------------------------------------------------------------>   
    <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $LANG['patients']['familiar_information']?></h3>
                </div>
                <div class="panel-body">
                    <div class="col-sm-12 form-group">
                       <label><?php echo $LANG['patients']['father_name']?> </label>
                    <input name="nomepai" value="<?php echo $row[nomepai]?>" type="text" class="form-control" <?php echo $disable?> id="nomepai" size="50" maxlength="80" />
                    </div>
                    
                    <div class="col-sm-4 form-group">
                        <label><?php echo $LANG['patients']['birthdate']?></label>
                        <input name="nascimentopai" value="<?php echo $row[nascimentopai]?>" type="text" class="form-control" <?php echo $disable?> id="nascimentopai" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" />
                    </div>
                    
                    <div class="col-sm-4 form-group">
                        <label><?php echo $LANG['patients']['father_profession']?> </label>
                        <input name="profissaopai" value="<?php echo $row[profissaopai]?>" type="text" class="form-control" <?php echo $disable?> id="profissaopai" size="50" maxlength="80" />
                    </div>
                    
                    <div class="col-sm-4 form-group">
                         <label><?php echo $LANG['patients']['telephone']?></label>
                        <input name="telefone1pais" value="<?php echo $row[telefone1pais]?>" type="text" class="form-control" <?php echo $disable?> id="telefone1pais" size="20" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" />
                    </div>


                    
                    <div class="col-sm-12 form-group">
                        <label><td width="287"><?php echo $LANG['patients']['mother_name']?>  </label>
                        <input name="nomemae" value="<?php echo $row[nomemae]?>" type="text" class="form-control" <?php echo $disable?> id="nomemae" size="50" maxlength="80" />

                    </div>
                    
                    <div class="col-sm-4 form-group">
                        <label><?php echo $LANG['patients']['birthdate']?></label>
                        <input name="nascimentomae" value="<?php echo $row[nascimentomae]?>" type="text" class="form-control" <?php echo $disable?> id="nascimentomae" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" />

                    </div>
                    
                    <div class="col-sm-4 form-group">
                        <label><?php echo $LANG['patients']['mother_profession']?> </label>
                        <input name="profissaomae" value="<?php echo $row[profissaomae]?>" type="text" class="form-control" <?php echo $disable?> id="profissaomae" size="50" maxlength="80" />

                    </div>
                    
                    <div class="col-sm-4 form-group">
                        <label><?php echo $LANG['patients']['telephone']?></label>
                        <input name="telefone2pais" value="<?php echo $row[telefone2pais]?>" type="text" class="form-control" <?php echo $disable?> id="telefone2pais" size="20" maxlength="13" onKeypress="return Ajusta_Telefone(this, event);" />

                    </div>
                    
                    <div class="col-sm-12 form-group">
                        <label><?php echo $LANG['patients']['complete_address_in_case_of_be_different_from_personal']?></label>
                        <input name="enderecofamiliar" value="<?php echo $row[enderecofamiliar]?>" type="text" class="form-control" <?php echo $disable?> id="endereco_familiar" size="78" maxlength="220" />                

                    </div>
                    




                        

                        

                        
                        

                        
     
                </div>
            </div>
 <!-- ------------------------------------------------------------------------------------------------------------------------------------>       
    <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $LANG['patients']['extra_information']?></h3>
                </div>
                <div class="panel-body">
                    
                    <div class="form-group"> 
                        <div class="col-sm-4">
                        <label><?php echo $LANG['patients']['record_date']?>  </label>
                            <?php
                                if($_GET[acao] == "editar") {
                            ?>
                        <input name="datacad" disabled value="<?php echo $row[datacadastro]?>" type="text" class="form-control" <?php echo $disable?> id="datacad" size="20" maxlength="10" />
                        <input name="datacadastro" value="<?php echo $row[datacadastro]?>" type="hidden" id="datacadastro" />
                            <?php
                                } else {
                            ?>
                        <input name="datacadastro" value="<?php echo date(d.'/'.m.'/'.Y)?>" type="text" class="form-control" <?php echo $disable?> id="datacadastro" size="20" maxlength="10" onKeypress="return Ajusta_Data(this, event);" />
                        <input name="datacad" value="" type="hidden" id="datacad" />
                            <?php
                                }
                            ?>

                        </div >

                        <div class="col-sm-4">
                        <label><?php echo $LANG['patients']['last_update']?>  </label>
                        <input name="dataatua" disabled value="<?php echo converte_data($row[dataatualizacao], 2)?>" type="text" class="form-control" <?php echo $disable?> id="dataatua" size="20" />
                        <input name="dataatualizacao" value="<?php echo converte_data($row[dataatualizacao], 2)?>" type="hidden" id="dataatualizacao" />
                        </div>

                        <div class="col-sm-4">
                        <label><?php echo $LANG['patients']['patient_status']?> </label>
                        <select name="status" class="form-control" <?php echo $disable?> id="status">
                        <?php
                        $valores = array('Avaliação' => $LANG['patients']['evaluation'], 'Em tratamento' => $LANG['patients']['in_treatment'], 'Em revisão' => $LANG['patients']['in_revision'], 'Concluído' => $LANG['patients']['closed']);
                        foreach($valores as $chave => $valor) {
                        if($row[status] == $chave) {
                        echo '<option value="'.$chave.'" selected>'.$valor.'</option>';
                        } else {
                        echo '<option value="'.$chave.'">'.$valor.'</option>';
                        }}?>       
                        </select> 
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <div class="col-sm-6">
                        <label>  <?php echo $LANG['patients']['main_objective_of_the_consultation']?></label>
                        <textarea name="objetivo"  class="form-control" cols="25" rows="4"><?php echo $row[objetivo]?></textarea>
                        </div>

                        <div class="col-sm-6">
                        <label><?php echo $LANG['patients']['comments']?></label>
                        <textarea name="observacoes" class="form-control" cols="25" rows="4"><?php echo $row[observacoes]?></textarea>
                        </div>
                      </div>
       
                </div>
            </div>
 <!-- ------------------------------------------------------------------------------------------------------------------------------------>   
  <!-- ------------------------------------------------------------------------------------------------------------------------------------>
 
    
           <br style="clear:both" />
           <div style="text-align:right">
              <a class="btn  btn-default" href="relatorios/paciente.php?codigo=<?php echo $row['codigo']?>" target="_blank"><span class="glyphicon glyphicon-print"></span> <?php echo $LANG['patients']['print_sheet']?></a>
              <input name="Salvar" type="submit" class="btn btn-primary" <?php echo $disable?> id="Salvar" value="<?php echo $LANG['patients']['save']?>" />
            </div>
          </form> 

             
            

            <script>
            document.getElementById('nom').focus();
            </script>
</div>
 
<script> 
    Ajax('pacientes/submenu','submenu','nome=<?php echo $strCase; ?>&codigo=<?php echo $_GET[codigo].$acao ?>');
</script>