 
<div class="collapse navbar-collapse navbar-ex1-collapse navbar-default sidebar" role="navigation" style="margin-bottom: 0">
    <div class="sidebar-nav">
        
        <div id="submenu">
        
        </div>
        
        <ul class="nav" id="side-menu">

              <!--  <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div> 
                        </li>-->
            <li><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $LANG['menu']['file']?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:Ajax('dentistas/gerenciar','conteudo','')" ><?php echo $LANG['menu']['professionals']?>		</a>      </li>
                    <li><a href="javascript:Ajax('pacientes/gerenciar','conteudo','')" ><?php echo $LANG['menu']['patients']?>		</a> </li>
                    <li><a href="javascript:Ajax('funcionarios/gerenciar','conteudo','')"><?php echo $LANG['menu']['employees']?>		</a> </li>
                    <li><a href="javascript:Ajax('fornecedores/gerenciar','conteudo','')" ><?php echo $LANG['menu']['supliers']?>		</a> </li>
                    <li><a href="javascript:Ajax('agenda/agenda','conteudo','')" ><?php echo $LANG['menu']['calendar']?>		</a> </li>
                    <li><a href="javascript:Ajax('patrimonio/gerenciar','conteudo','')" ><?php echo $LANG['menu']['patrimony']?>		</a> </li>
                    <li><a href="javascript:Ajax('estoque/estoque','conteudo','')" ><?php echo $LANG['menu']['stock_control']?>		</a> </li>
                    <li><a href="javascript:Ajax('laboratorio/gerenciar','conteudo','')" ><?php echo $LANG['menu']['laboratory']?>		</a> </li>
                    <li><a href="javascript:Ajax('convenios/gerenciar','conteudo','')" ><?php echo $LANG['menu']['plans']?>		</a> </li>
                    <li><a href="javascript:Ajax('honorarios/gerenciar','conteudo','')"><?php echo $LANG['menu']['fees']?>		</a></li>
               </ul>    
            </li>
            <li><a href="#"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> <?php echo $LANG['menu']['monetary']?><span class="fa arrow"></span></a>
                  <ul  class="nav nav-second-level">
                    <li><a href="javascript:Ajax('contaspagar/contaspagar','conteudo','')"><?php echo $LANG['menu']['accounts_payable']?></a></li>
                    <li><a href="javascript:Ajax('contasreceber/contasreceber','conteudo','')"><?php echo $LANG['menu']['accounts_receivable']?></a></li>
                    <li><a href="javascript:Ajax('caixa/caixa','conteudo','')"><?php echo $LANG['menu']['cash_flow']?></a></li>
                    <li><a href="javascript:Ajax('cheques/cheques','conteudo','')"><?php echo $LANG['menu']['check_control']?></a></li>
                    <li><a href="javascript:Ajax('pagamentos/parcelas','conteudo','')" ><?php echo $LANG['menu']['payments']?></a></li>
                </ul>
            </li>
            <li><a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <?php echo $LANG['menu']['updates']?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="http://www.smileodonto.com.br/gco/" target="_blank" ><?php echo $LANG['menu']['search_for_update_on_website']?></a></li>
                </ul>
            </li>
            <li><a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> <?php echo $LANG['menu']['utilities']?><span class="fa arrow"></span></a>
                <ul  class="nav nav-second-level">
                    <li><a href="javascript:Ajax('arquivos/daclinica/arquivos','conteudo','')"><?php echo $LANG['menu']['clinic_files']?></a> </li>
                    <li><a href="javascript:Ajax('arquivos/manuais_codigos/manuais','conteudo','')"><?php echo $LANG['menu']['manuals_and_codes']?></a></li>
                    <li><a href="javascript:Ajax('telefones/gerenciar','conteudo','')" ><?php echo $LANG['menu']['usefull_telephones']?></a> </li>
                    <li><a href="javascript:Ajax('backup/backupfazer','conteudo','')" ><?php echo $LANG['menu']['backup_generation']?></a> </li>
                    <li><a href="javascript:Ajax('backup/restaurar','conteudo','')"><?php echo $LANG['menu']['backup_restoration']?></a></li>
                </ul>
            </li>
            <li><a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <?php echo $LANG['menu']['configuration']?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:Ajax('configuracoes/senhaadm','conteudo','')" ><?php echo $LANG['menu']['admin_password']?></a> </li>
                    <li><a href="javascript:Ajax('configuracoes/dadosclinica','conteudo','')"><?php echo $LANG['menu']['clinic_information']?></a></li>
                    <li><a href="javascript:Ajax('configuracoes/idioma','conteudo','')"><?php echo $LANG['menu']['language']?></a> </li>
                    <li><a href="javascript:Ajax('configuracoes/permissoes','conteudo','')"><?php echo $LANG['menu']['permissions']?></a></li>
                </ul>
            </li>
            <li><a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> <?php echo $LANG['menu']['help']?><span class="fa arrow"></a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:Ajax('sobre/notas','conteudo','')"> <?php echo $LANG['menu']['version_notes']?></a> </li>
                    <li><a href="javascript:Ajax('sobre/gpl','conteudo','')">   <?php echo $LANG['menu']['gpl_license']?></a> </li>
                    <li><a href="http://www.smileodonto.com.br" target="_blank"><?php echo $LANG['menu']['smile_website']?></a> </li>
                    <li><a href="javascript:Ajax('sobre/sobre','conteudo','')"> <?php echo $LANG['menu']['about_gco']?></a></li>
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
    

   
