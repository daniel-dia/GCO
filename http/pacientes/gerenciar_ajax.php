<?php
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php'; 
	if(!checklog()) {
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
	if(!verifica_nivel('pacientes', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `pacientes` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
		mysql_query("DELETE FROM `exameobjetivo` WHERE `codigo_paciente` = '".$_GET[codigo]."'") or die(mysql_error());
		mysql_query("DELETE FROM `inquerito` WHERE `codigo_paciente` = '".$_GET[codigo]."'") or die(mysql_error());
        mysql_query("UPDATE agenda SET descricao = NULL , procedimento = NULL , faltou = 'Não' , codigo_paciente = NULL WHERE codigo_paciente = '".$_GET[codigo]."'");
	}
?>
<script>
    function esconde(campo) {
        if(campo.selectedIndex == 7) {
            document.getElementById('procurar').style.display = 'none';
            document.getElementById('procurar1').style.display = '';
            document.getElementById('procurar2').style.display = 'none';
            document.getElementById('procurar3').style.display = 'none';
            document.getElementById('procurar4').style.display = 'none';
            document.getElementById('id_procurar').value = 'procurar1';
        } else if(campo.selectedIndex == 10 || campo.selectedIndex == 11) {
            document.getElementById('procurar').style.display = 'none';
            document.getElementById('procurar1').style.display = 'none';
            document.getElementById('procurar2').style.display = 'none';
            document.getElementById('procurar3').style.display = 'none';
            document.getElementById('procurar4').style.display = 'none';
            document.getElementById('id_procurar').value = 'procurar';
            Ajax('pacientes/pesquisa', 'pesquisa', 'campo='%2Bdocument.getElementById('campo').value);
        } else if(campo.selectedIndex == 8 || campo.selectedIndex == 9) {
            document.getElementById('procurar').style.display = 'none';
            document.getElementById('procurar1').style.display = 'none';
            document.getElementById('procurar2').style.display = '';
            document.getElementById('procurar2').selectedIndex = 0;
            document.getElementById('procurar3').style.display = 'none';
            document.getElementById('procurar4').style.display = 'none';
            document.getElementById('id_procurar').value = 'procurar2';
        } else if(campo.selectedIndex == 1) {
            document.getElementById('procurar').style.display = 'none';
            document.getElementById('procurar1').style.display = 'none';
            document.getElementById('procurar2').style.display = 'none';
            document.getElementById('procurar3').style.display = '';
            document.getElementById('procurar3').selectedIndex = 0;
            document.getElementById('procurar4').style.display = 'none';
            document.getElementById('id_procurar').value = 'procurar3';
        } else if(campo.selectedIndex == 5) {
            document.getElementById('procurar').style.display = 'none';
            document.getElementById('procurar1').style.display = 'none';
            document.getElementById('procurar2').style.display = 'none';
            document.getElementById('procurar3').style.display = 'none';
            document.getElementById('procurar3').selectedIndex = 0;
            document.getElementById('procurar4').style.display = '';
            document.getElementById('id_procurar').value = 'procurar3';
        } else {
            document.getElementById('procurar').style.display = '';
            document.getElementById('procurar1').style.display = 'none';
            document.getElementById('procurar2').style.display = 'none';
            document.getElementById('procurar3').style.display = 'none';
            document.getElementById('procurar4').style.display = 'none';
            document.getElementById('id_procurar').value = 'procurar';
        }
    }
    function niver() {

        var pesq = '';

        document.getElementById('dia1').disabled = true;
        document.getElementById('mes2').disabled = true;
        document.getElementById('dia2').disabled = true;

        if ( document.getElementById('mes1').options[document.getElementById('mes1').selectedIndex].value != '' ) {
            pesq %2B= document.getElementById('mes1').options[document.getElementById('mes1').selectedIndex].value;
            document.getElementById('dia1').disabled = false;
        }
        if ( document.getElementById('dia1').value != '' ) {
            pesq %2B= '-' %2B document.getElementById('dia1').value;
            document.getElementById('mes2').disabled = false;
        }

        if ( document.getElementById('mes2').options[document.getElementById('mes2').selectedIndex].value != '' ) {
            pesq %2B= '_' %2B document.getElementById('mes2').options[document.getElementById('mes2').selectedIndex].value;
            document.getElementById('dia2').disabled = false;
        }
        if ( document.getElementById('dia2').value != '' ) {
            pesq %2B= '-' %2B document.getElementById('dia2').value;
        }

        Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2B pesq %2B'&campo='%2Bdocument.getElementById('campo').options[document.getElementById('campo').selectedIndex].value)
    }
</script> 
<div class="conteudo" id="conteudo_central">
    <h1 class="page-header"> <?php echo $LANG['patients']['manage_patients']?> </h1>
    <div class="form-inline">
    <div class="input-group">     
            <div class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></div>
      	      <select name="campo" id="campo" class="form-control " onchange="esconde(this)">
      	        <option value="nome"><?php echo $LANG['patients']['name']?></option>
      	        <option value="nascimento"><?php echo $LANG['patients']['birthdays']?></option>
      	        <option value="matricula"><?php echo $LANG['patients']['clinical_sheet']?></option>
      	        <option value="cidade"><?php echo $LANG['patients']['city']?></option>
      	        <option value="cep"><?php echo $LANG['patients']['zip']?></option>
      	        <option value="telefone"><?php echo $LANG['patients']['telephone']?></option>
      	        <option value="profissao"><?php echo $LANG['patients']['profession']?></option>
      	        <option value="area"><?php echo $LANG['patients']['treatment_area']?></option>
      	        <option value="procurado"><?php echo $LANG['patients']['professional_searched']?></option>
      	        <option value="atendido"><?php echo $LANG['patients']['professional_who_answered']?></option>
      	        <option value="debito"><?php echo $LANG['patients']['patients_in_debt']?></option>
                <option value="agendados"><?php echo $LANG['patients']['scheduled_patients']?></option>
                <option value="indicacao"><?php echo $LANG['patients']['indicated_by']?></option>
                <option value="endereco"><?php echo $LANG['patients']['address1']?></option>
      	      </select>
      	      <input type="hidden" id="id_procurar" value="procurar">
    </div>
    <div  class="form-group">
      	      <input name="procurar" id="procurar" type="text" class="form-control " size="20" maxlength="40" oninput="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
      	      <select name="procurar1" id="procurar1" style="display:none" class="form-control " onchange="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
                <option value=""></option>
                <option value="Ortodontia"><?php echo $LANG['patients']['orthodonty']?></option>
                <option value="Implantodontia"><?php echo $LANG['patients']['implantodonty']?></option>
                <option value="Dentística"><?php echo $LANG['patients']['dentistic']?></option>
                <option value="Prótese"><?php echo $LANG['patients']['prosthesis']?></option>
                <option value="Odontopediatria"><?php echo $LANG['patients']['odontopediatry']?></option>
                <option value="Cirurgia"><?php echo $LANG['patients']['surgery']?></option>
                <option value="Endodontia"><?php echo $LANG['patients']['endodonty']?></option>
                <option value="Periodontia"><?php echo $LANG['patients']['periodonty']?></option>
                <option value="Radiologia"><?php echo $LANG['patients']['radiology']?></option>
                <option value="DTM"><?php echo $LANG['patients']['dtm']?></option>
                <option value="Odontogeriatria"><?php echo $LANG['patients']['odontogeriatry']?></option>
                <option value="Ortopedia"><?php echo $LANG['patients']['orthopedy']?></option>
      	      </select>
      	      <select name="procurar2" id="procurar2" style="display:none" class="form-control " onchange="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
                <option></option>
                    <?php
                        $dentista = new TDentistas();
                        $lista = $dentista->ListDentistas();
                        for($i = 0; $i < count($lista); $i++) {
                            if($row[codigo_dentistaprocurado] == $lista[$i][codigo]) {
                                echo '<option value="'.$lista[$i][codigo].'" selected>'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
                            } else {
                                echo '<option value="'.$lista[$i][codigo].'">'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
                            }
                        }
                    ?>  
			  </select>
              <div id="procurar3" style="display:none">
                  <select name="mes1" id="mes1" class="form-control " onchange="javascript:niver()">
                      <option value=""></option>
                      <?php
                      for($i = 1; $i <= 12; $i++) {
                          echo '                <option value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'">'.nome_mes($i).'</option>';
                      }
                      ?>
                  </select>
                  <input name="dia1" id="dia1" disabled="disabled" type="text" class="forms" size="4" maxlength="2" onkeyup="javascript:niver()">
                  <br />

                  <select name="mes2" id="mes2" disabled="disabled" class="form-control " onchange="javascript:niver()" style="margin-top: 3px;">
                      <option value=""></option>
                      <?php
                      for($i = 1; $i <= 12; $i++) {
                          echo '   <option value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'">'.nome_mes($i).'</option>';
                      }
                      ?>
                  </select>
                  <input name="dia2" id="dia2" disabled="disabled" type="text" class="forms" size="4" maxlength="2" onkeyup="javascript:niver()">
              </div>
      	      <input name="procurar4" id="procurar4" style="display:none" type="text" class="form-control " size="20" maxlength="13" onkeypress="return Ajusta_Telefone(this, event);" onkeyup="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
        </div>
    
    <div  class="form-group">
    <?php if (verifica_nivel('contatos', 'I')) { ?>
             <a href="javascript:Ajax('pacientes/incluir', 'conteudo', '')">
            <button type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $LANG['patients']['include_new_patient']; ?>
            </button>
                 </a>
            <?php }?>
    </div>
    </div>
</div>
    <br>
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa=&campo=nome');
  </script>
</div>
