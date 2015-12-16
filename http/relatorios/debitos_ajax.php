
<h1 class="page-header">Relatório de Débitos</h1>

<div class="form-inline">
    <div class="form-group acol-sm-3" style="position: relative;">
        <label for="data-inicial">Data Inicial</label><br>
        <input id="data_inicial" type="text" name="data_inicial" class="form-control"></input>
     </div>
   
    <div class="form-group acol-sm-3" style="position: relative;">
        <label for="data_final">Data final</label><br>
        <input id="data_final" type="text" name="data_final" class="form-control"></input>
    </div>
    
     <div class="form-group acol-sm-3">
        <label for="pago">Pago</label><br>
        <select id="pago" type="text" name="pago" class="form-control">
            <option value="Não" selected>Não</option>
            <option value="Sim">Sim</option>
         </select>
         
    </div>
    
    <div class="form-group acol-sm-3">
        <label>&nbsp;</label><br>
        <a href="javascript:Ajax('relatorios/debitospesquisa','pesquisa','data_inicial=' %2B document.getElementById('data_inicial').value %2B'&data_final=' %2B document.getElementById('data_final').value %2B'&pago=' %2B document.getElementById('pago').value)" class="btn btn-primary">Pesquisar</a>
    </div> 
</div>
<br>

<div id="pesquisa" style="background-color:white">
    
</div>

<script type="text/javascript">

$('#data_inicial').datetimepicker({ 
    sideBySide: false,
    locale: 'pt-br',
    viewMode: 'years', 
    format: 'DD/MM/YYYY',   
}).on('dp.change',function(){ })

$('#data_final').datetimepicker({ 
    sideBySide: false,
    locale: 'pt-br',
    viewMode: 'years', 
    format: 'DD/MM/YYYY',   
}).on('dp.change',function(){ })


</script>