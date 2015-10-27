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
?>
    
<div class="navbar-default sidebar" role="navigation" style="margin-bottom: 0">
    <div class="sidebar-nav">
        <ul class="nav" id="side-menu">

            <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
            <li><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $LANG['menu']['file']?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:Ajax('dentistas/gerenciar','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/dentista.png" /><?php echo $LANG['menu']['professionals']?>		</a>      </li>
                    <li><a href="javascript:Ajax('pacientes/gerenciar','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/paciente.png" /><?php echo $LANG['menu']['patients']?>		</a> </li>
                    <li><a href="javascript:Ajax('funcionarios/gerenciar','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/funcionario.png" /><?php echo $LANG['menu']['employees']?>		</a> </li>
                    <li><a href="javascript:Ajax('fornecedores/gerenciar','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/fornecedor.png" /><?php echo $LANG['menu']['supliers']?>		</a> </li>
                    <li><a href="javascript:Ajax('agenda/agenda','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/agenda.png" /><?php echo $LANG['menu']['calendar']?>		</a> </li>
                    <li><a href="javascript:Ajax('patrimonio/gerenciar','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/patrimonio.png" /><?php echo $LANG['menu']['patrimony']?>		</a> </li>
                    <li><a href="javascript:Ajax('estoque/estoque','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/estoque.png" /><?php echo $LANG['menu']['stock_control']?>		</a> </li>
                    <li><a href="javascript:Ajax('laboratorio/gerenciar','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/laboratorio.png" /><?php echo $LANG['menu']['laboratory']?>		</a> </li>
                    <li><a href="javascript:Ajax('convenios/gerenciar','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/treinamento.png" /><?php echo $LANG['menu']['plans']?>		</a> </li>
                    <li><a href="javascript:Ajax('honorarios/gerenciar','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/honorarios.png" /><?php echo $LANG['menu']['fees']?>		</a></li>
               </ul>    
            </li>
            <li><a href="#"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> <?php echo $LANG['menu']['monetary']?><span class="fa arrow"></span></a>
                  <ul  class="nav nav-second-level">
                    <li><a href="javascript:Ajax('contaspagar/contaspagar','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/contaspagar.png" /><?php echo $LANG['menu']['accounts_payable']?></a></li>
                    <li><a href="javascript:Ajax('contasreceber/contasreceber','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/contasreceber.png" /><?php echo $LANG['menu']['accounts_receivable']?></a></li>
                    <li><a href="javascript:Ajax('caixa/caixa','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/caixa.png" /><?php echo $LANG['menu']['cash_flow']?></a></li>
                    <li><a href="javascript:Ajax('cheques/cheques','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/cheques.png" /><?php echo $LANG['menu']['check_control']?></a></li>
                    <li><a href="javascript:Ajax('pagamentos/parcelas','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/parcelas.png" /><?php echo $LANG['menu']['payments']?></a></li>
                </ul>
            </li>
            <li><a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <?php echo $LANG['menu']['updates']?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="http://www.smileodonto.com.br/gco/" target="_blank" ><img class="submenu-img" src="imagens/icons_menupop/atualizacoes_buscar.png" /><?php echo $LANG['menu']['search_for_update_on_website']?></a></li>
                </ul>
            </li>
            <li><a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> <?php echo $LANG['menu']['utilities']?><span class="fa arrow"></span></a>
                <ul  class="nav nav-second-level">
                    <li><a href="javascript:Ajax('arquivos/daclinica/arquivos','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/arquivo.png" /><?php echo $LANG['menu']['clinic_files']?></a> </li>
                    <li><a href="javascript:Ajax('arquivos/manuais_codigos/manuais','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/arquivo.png" /><?php echo $LANG['menu']['manuals_and_codes']?></a></li>
                    <li><a href="javascript:Ajax('telefones/gerenciar','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/telefone.png" /><?php echo $LANG['menu']['usefull_telephones']?></a> </li>
                    <li><a href="javascript:Ajax('backup/backupfazer','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/gerarbackup.png" /><?php echo $LANG['menu']['backup_generation']?></a> </li>
                    <li><a href="javascript:Ajax('backup/restaurar','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/restaurarbackup.png" /><?php echo $LANG['menu']['backup_restoration']?></a></li>
                </ul>
            </li>
            <li><a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <?php echo $LANG['menu']['configuration']?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:Ajax('configuracoes/senhaadm','conteudo','')" ><img class="submenu-img" src="imagens/icons_menupop/usuarios.png" /><?php echo $LANG['menu']['admin_password']?></a> </li>
                    <li><a href="javascript:Ajax('configuracoes/dadosclinica','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/clinica.png" /><?php echo $LANG['menu']['clinic_information']?></a></li>
                    <li><a href="javascript:Ajax('configuracoes/idioma','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/site.png" /><?php echo $LANG['menu']['language']?></a> </li>
                    <li><a href="javascript:Ajax('configuracoes/permissoes','conteudo','')"><img class="submenu-img" src="imagens/icons_menupop/usuarios.png" /><?php echo $LANG['menu']['permissions']?></a></li>
                </ul>
            </li>
            <li><a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> <?php echo $LANG['menu']['help']?><span class="fa arrow"></a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:Ajax('sobre/notas','conteudo','')"> <img class="submenu-img" src="imagens/icons_menupop/notas.png" /><?php echo $LANG['menu']['version_notes']?></a> </li>
                    <li><a href="javascript:Ajax('sobre/gpl','conteudo','')">   <img class="submenu-img" src="imagens/icons_menupop/gnu.png" /><?php echo $LANG['menu']['gpl_license']?></a> </li>
                    <li><a href="http://www.smileodonto.com.br" target="_blank"><img class="submenu-img" src="imagens/icons_menupop/site.png" /><?php echo $LANG['menu']['smile_website']?></a> </li>
                    <li><a href="javascript:Ajax('sobre/sobre','conteudo','')"> <img class="submenu-img" src="imagens/icons_menupop/icon.png" /><?php echo $LANG['menu']['about_gco']?></a></li>
                </ul>
            </li> 
            <li>
                <a href="sair.php"><span class="glyphicon glyphicon-log-out"></span> <?php echo $LANG['menu']['logout']?></a>
            </li>
            <li>
                <div id="saudacao"></div>
            </li>
        </ul>
     </div>
</div>
    

   
