//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else if(window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        alert("Este navegador não suporta AJAX!");
    }
}
//Our XmlHttpRequest object to get the auto suggest
var searchReq = getXmlHttpRequestObject();
var divSugestao = '';
var fieldPesquisa;
var fieldCodigo;
var fieldParticular;
var fieldConvenio;

// AGENDA
//Starts the AJAX request.
function searchSuggest(txtSearch, txtCodigo, divSuggest) {
    if (searchReq.readyState == 4 || searchReq.readyState == 0) {
        divSugestao = divSuggest;
        fieldPesquisa = txtSearch;
        fieldCodigo = txtCodigo;
        var str = escape(fieldPesquisa.value);
        searchReq.open("GET", 'agenda/searchSuggest.php?search=' + str, true);
        searchReq.onreadystatechange = handleSearchSuggest;
        searchReq.send(null);
    }
}
//Called when the AJAX response is returned.
function handleSearchSuggest() {
    if (searchReq.readyState == 4) {
        var ss = document.getElementById(divSugestao);
        var header = '<div class="search_suggest">';
        var suggest = '';
        ss.innerHTML = '';
        var str = unescape(searchReq.responseText.replace(/\+/g , " "));;
        str = str.split("\n");
        for(i=0; i < str.length - 1; i++) {
            //Build our element string.  This is cleaner using the DOM, but
            //IE doesn't support dynamically added attributes.
            var cod = str[i].split(" - ");
            cod = cod[cod.length - 1];
            suggest += '<div onmouseover="javascript:suggestOver(this);" ';
            suggest += 'onmouseout="javascript:suggestOut(this);" ';
            suggest += 'onclick="javascript:setSearch(this.innerHTML, \''+ cod +'\', \''+fieldCodigo+'\', \''+fieldPesquisa.id+'\', \''+divSugestao+'\');" ';
            suggest += 'class="suggest_link">' + str[i] + '</div>';
        }
        var footer = '</div>';
        ss.innerHTML = header+suggest+footer;
    }
}

// PACIENTES - ORÇAMENTO
//Starts the AJAX request.
function searchOrcSuggest(txtSearch, txtCodigo, txtParticular, txtConvenio, divSuggest, convenio) {
    if (searchReq.readyState == 4 || searchReq.readyState == 0) {
        divSugestao = divSuggest;
        fieldCodigo = txtCodigo;
        fieldPesquisa = txtSearch;
        fieldParticular = txtParticular;
        fieldConvenio = txtConvenio;
        var str = escape(fieldPesquisa.value);
        searchReq.open("GET", 'pacientes/searchSuggest.php?search='+str+'&codigo_convenio='+convenio, true);
        searchReq.onreadystatechange = handleOrcSearchSuggest;
        searchReq.send(null);
    }
}
//Called when the AJAX response is returned.
function handleOrcSearchSuggest() {
    if (searchReq.readyState == 4) {
        var ss = document.getElementById(divSugestao);
        var header = '<div class="search_suggest">';
        var suggest = '';
        ss.innerHTML = '';
        var str = unescape(searchReq.responseText.replace(/\+/g , " "));;
        str = str.split("\n");
        for(i=0; i < str.length - 1; i++) {
            //Build our element string.  This is cleaner using the DOM, but
            //IE doesn't support dynamically added attributes.
            var datas = str[i].split(" |.:.| ");
            codigo = datas[0];
            procedimento = datas[1];
            valor_particular = datas[2];
            valor_convenio = datas[3];
            suggest += '<div onmouseover="javascript:suggestOver(this);" ';
            suggest += 'onmouseout="javascript:suggestOut(this);" ';
            suggest += 'onclick="javascript:setOrcSearch(\''+ codigo +'\', \''+ procedimento +'\', \''+ valor_particular +'\', \''+ valor_convenio +'\', \''+ divSugestao +'\');" ';
            suggest += 'class="suggest_link">' + procedimento + '</div>';
        }
        var footer = '</div>';
        ss.innerHTML = header+suggest+footer;
    }
}

//Mouse over function
function suggestOver(div_value) {
    div_value.className = 'suggest_link_over';
}

//Mouse out function
function suggestOut(div_value) {
    div_value.className = 'suggest_link';
}

//AGENDA
//Click function
function setSearch(value, codigo, fieldCode, fieldSearch, divSuggest) {
    document.getElementById(fieldSearch).value = value;
    document.getElementById(fieldCode).value = codigo;
    document.getElementById(divSuggest).innerHTML = '';
    document.getElementById(fieldSearch).focus();
    document.getElementById(fieldSearch).blur();
}

//PACIENTES - ORÇAMENTO
//Click function
function setOrcSearch(txtCodigo, txtProcedimento, txtParticular, txtConvenio,  divSuggest) {
    document.getElementById(fieldCodigo).value = txtCodigo;
    document.getElementById(fieldPesquisa.id).value = txtProcedimento;
    document.getElementById(fieldParticular).value = txtParticular;
    document.getElementById(fieldConvenio).value = txtConvenio;
    document.getElementById(divSuggest).innerHTML = '';
    document.getElementById(fieldPesquisa.id).focus();
    document.getElementById(fieldPesquisa.id).blur();
}

//Esconde os abertos
function esconde_itens(strNome) {
  for(var i = 0; i < 100; i++){
    var bs;
    if(bs = document.getElementById("search"+i)) {
        bs.innerHTML = '';
    }
  }
}
//Keycodes que devem ser monitorados
var TAB = 9;
var ESC = 27;
var KEYUP = 38;
var KEYDN = 40;
var ENTER = 13;

