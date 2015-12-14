
<h1 class="page-header">Relatório de Débitos</h1>

<div class="form-inline">
    <div class="form-group col-sm-3">
        <label for="data-inicial">Data Inicial</label><br>
        <input id="data-inicial" type="text" name="data-inicial" class="form-control">
    </div>

   
    <div class="form-group col-sm-3">
        <label for="data-final">Data final</label><br>
        <input id="data-final" type="text" name="data-final" class="form-control">
    </div>
    
     <div class="form-group col-sm-3">
        <label for="pago">Pago</label><br>
        <select id="pago" type="text" name="pago" class="form-control">
            <option value="Não" selected>Não</option>
            <option value="Sim">Sim</option>
         </select>
         
    </div>
    
    <div class="form-group col-sm-3">
        <label>&nbsp;</label><br>
        <a href="javascript:Ajax('relatorios/debitospesquisa','pesquisa','')" class="btn btn-primary">Pesquisar</a>
    </div> 
</div>
<div id="pesquisa" class="col-sm-12">
    
</div>

 <script type="text/javascript">
             
    $('#data-inicial').datetimepicker({ 
        sideBySide: false,
        locale: 'pt-br',
        viewMode: 'days', 
        format: 'DD/MM/YYYY',   
    }).on('dp.change',function(){ })
  
    $('#data-final').datetimepicker({ 
        sideBySide: false,
        locale: 'pt-br',
        viewMode: 'days', 
        format: 'DD/MM/YYYY',   
    }).on('dp.change',function(){ })
          
</script>