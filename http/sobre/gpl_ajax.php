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
	header("Content-type: text/html; charset=ISO-8859-1", true);
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="74%">&nbsp;&nbsp;<img src="sobre/img/gpl.png" alt="Sobre"> <span class="h3"><?php echo $LANG['gpl']['']?></span></td>
      <td width="7%" valign="bottom">&nbsp;</td>
      <td width="19%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br />
  <div class="sobre" id="sobre">
    <p>&nbsp;</p>
    <p align="center"><img src="sobre/img/gnu.png" alt="GNU" width="99" height="97" /><br />
    </p>
    <fieldset>
  <legend><?php echo $LANG['gpl']['protection']?></legend>
  <p><?php echo $LANG['gpl']['gco_is_protected']?></p>
  </fieldset><br />
  <legend><fieldset>
  <legend>Tradu&ccedil;&atilde;o da GPL para o Portugu&ecirc;s do Brasil </legend>
  <p align="center"><strong> LICEN&Ccedil;A P&Uacute;BLICA GERAL GNU<br />
  Vers&atilde;o 2, junho de 1991</strong></p>
  <p> This is an unofficial translation of the GNU General Public License<br />
    into Brazilian Portuguese. It was not published by the Free Software<br />
    Foundation, and does not legally state the distribution terms for<br />
    software that uses the GNU GPL -- only the original English text of<br />
    the GNU GPL does that. However, we hope that this translation will<br />
    help Brazilian Portuguese speakers understand the GNU GPL better.</p>
  <p> Esta &eacute; uma tradu&ccedil;&atilde;o n&atilde;o-oficial da Licen&ccedil;a P&uacute;blica Geral GNU (&quot;GPL<br />
    GNU&quot;) para o portugu&ecirc;s do Brasil. Ela n&atilde;o foi publicada pela Free<br />
    Software Foundation, e legalmente n&atilde;o afirma os termos de distribui&ccedil;&atilde;o<br />
    de software que utiliza a GPL GNU -- apenas o texto original da GPL<br />
    GNU, em ingl&ecirc;s, faz isso. Contudo, esperamos que esta tradu&ccedil;&atilde;o ajude<br />
    aos que utilizam o portugu&ecirc;s do Brasil a entender melhor a GPL GNU.</p>
  <p> Copyright (C) 1989, 1991 Free Software Foundation, Inc. 675 Mass Ave,<br />
    Cambridge, MA 02139, USA</p>
  <p>A qualquer pessoa &eacute; permitido copiar e distribuir c&oacute;pias desse<br />
    documento de licen&ccedil;a, desde que sem qualquer altera&ccedil;&atilde;o.</p>
  <p> Introdu&ccedil;&atilde;o</p>
  <p> As licen&ccedil;as de muitos software s&atilde;o desenvolvidas para restringir sua<br />
    liberdade de compartilh&aacute;-lo e mud&aacute;-lo. Contr&aacute;ria a isso, a Licen&ccedil;a<br />
    P&uacute;blica Geral GNU pretende garantir sua liberdade de compartilhar e<br />
    alterar software livres -- garantindo que o software ser&aacute; livre e<br />
    gratuito para os seus usu&aacute;rios. Esta Licen&ccedil;a P&uacute;blica Geral aplica-se &agrave;<br />
    maioria dos software da Free Software Foundation e a qualquer outro<br />
    programa cujo autor decida aplic&aacute;-la. (Alguns outros software da FSF<br />
    s&atilde;o cobertos pela Licen&ccedil;a P&uacute;blica Geral de Bibliotecas, no entanto.)<br />
    Voc&ecirc; pode aplic&aacute;-la tamb&eacute;m aos seus programas.</p>
  <p> Quando nos referimos a software livre, estamos nos referindo a<br />
    liberdade e n&atilde;o a pre&ccedil;o. Nossa Licen&ccedil;a P&uacute;blica Geral foi desenvolvida<br />
    para garantir que voc&ecirc; tenha a liberdade de distribuir c&oacute;pias de<br />
    software livre (e cobrar por isso, se quiser); que voc&ecirc; receba o<br />
    c&oacute;digo-fonte ou tenha acesso a ele, se quiser; que voc&ecirc; possa mudar o<br />
    software ou utilizar partes dele em novos programas livres e<br />
    gratuitos; e que voc&ecirc; saiba que pode fazer tudo isso.</p>
  <p> Para proteger seus direitos, precisamos fazer restri&ccedil;&otilde;es que impe&ccedil;am<br />
    a qualquer um negar estes direitos ou solicitar que voc&ecirc; deles<br />
    abdique. Estas restri&ccedil;&otilde;es traduzem-se em certas responsabilidades para<br />
    voc&ecirc;, se voc&ecirc; for distribuir c&oacute;pias do software ou modific&aacute;-lo.</p>
  <p> Por exemplo, se voc&ecirc; distribuir c&oacute;pias de um programa, gratuitamente<br />
    ou por alguma quantia, voc&ecirc; tem que fornecer aos recebedores todos os<br />
    direitos que voc&ecirc; possui. Voc&ecirc; tem que garantir que eles tamb&eacute;m<br />
    recebam ou possam obter o c&oacute;digo-fonte. E voc&ecirc; tem que mostrar-lhes<br />
    estes termos para que eles possam conhecer seus direitos.</p>
  <p> N&oacute;s protegemos seus direitos em dois passos: (1) com copyright do<br />
    software e (2) com a oferta desta licen&ccedil;a, que lhe d&aacute; permiss&atilde;o legal<br />
    para copiar, distribuir e/ou modificar o software.</p>
  <p> Al&eacute;m disso, tanto para a prote&ccedil;&atilde;o do autor quanto a nossa,<br />
    gostar&iacute;amos de certificar-nos que todos entendam que n&atilde;o h&aacute; qualquer<br />
    garantia nestes software livres. Se o software &eacute; modificado por algu&eacute;m<br />
    mais e passado adiante, queremos que seus recebedores saibam que o que<br />
    eles obtiveram n&atilde;o &eacute; original, de forma que qualquer problema<br />
    introduzido por terceiros n&atilde;o interfira na reputa&ccedil;&atilde;o do autor<br />
    original.</p>
  <p> Finalmente, qualquer programa &eacute; amea&ccedil;ado constantemente por patentes<br />
    de software. Queremos evitar o perigo de que distribuidores de<br />
    software livre obtenham patentes individuais, o que tem o efeito de<br />
    tornar o programa propriet&aacute;rio. Para prevenir isso, deixamos claro que<br />
    qualquer patente tem que ser licenciada para uso livre e gratuito por<br />
    qualquer pessoa, ou ent&atilde;o que nem necessite ser licenciada.</p>
  <p> Os termos e condi&ccedil;&otilde;es precisas para c&oacute;pia, distribui&ccedil;&atilde;o e<br />
    modifica&ccedil;&atilde;o se encontram abaixo:<br />
    
    <br />
    LICEN&Ccedil;A P&Uacute;BLICA GERAL GNU<br />
    TERMOS E CONDI&Ccedil;&Otilde;ES PARA C&Oacute;PIA, DISTRIBUI&Ccedil;&Atilde;O E MODIFICA&Ccedil;&Atilde;O</p>
  <p> 0. Esta licen&ccedil;a se aplica a qualquer programa ou outro trabalho que<br />
    contenha um aviso colocado pelo detentor dos direitos autorais<br />
    informando que aquele pode ser distribu&iacute;do sob as condi&ccedil;&otilde;es desta<br />
    Licen&ccedil;a P&uacute;blica Geral. O &quot;Programa&quot; abaixo refere-se a qualquer<br />
    programa ou trabalho, e &quot;trabalho baseado no Programa&quot; significa tanto<br />
    o Programa em si como quaisquer trabalhos derivados, de acordo com a<br />
    lei de direitos autorais: isto quer dizer um trabalho que contenha o<br />
    Programa ou parte dele, tanto originalmente ou com modifica&ccedil;&otilde;es, e/ou<br />
    tradu&ccedil;&atilde;o para outros idiomas. (Doravante o processo de tradu&ccedil;&atilde;o est&aacute;<br />
    inclu&iacute;do sem limites no termo &quot;modifica&ccedil;&atilde;o&quot;.) Cada licenciado &eacute;<br />
    mencionado como &quot;voc&ecirc;&quot;.</p>
  <p>Atividades outras que a c&oacute;pia, a distribui&ccedil;&atilde;o e modifica&ccedil;&atilde;o n&atilde;o est&atilde;o<br />
    cobertas por esta Licen&ccedil;a; elas est&atilde;o fora de seu escopo.  O ato de<br />
    executar o Programa n&atilde;o &eacute; restringido e o resultado do Programa &eacute;<br />
    coberto apenas se seu conte&uacute;do contenha trabalhos baseados no Programa<br />
    (independentemente de terem sido gerados pela execu&ccedil;&atilde;o do<br />
    Programa). Se isso &eacute; verdadeiro depende do que o programa faz.</p>
  <p> 1. Voc&ecirc; pode copiar e distribuir c&oacute;pias fi&eacute;is do c&oacute;digo-fonte do<br />
    Programa da mesma forma que voc&ecirc; o recebeu, usando qualquer meio,<br />
    deste que voc&ecirc; consp&iacute;cua e apropriadamente publique em cada c&oacute;pia um<br />
    aviso de direitos autorais e uma declara&ccedil;&atilde;o de inexist&ecirc;ncia de<br />
    garantias; mantenha intactas todos os avisos que se referem a esta<br />
    Licen&ccedil;a e &agrave; aus&ecirc;ncia total de garantias; e forne&ccedil;a a outros<br />
    recebedores do Programa uma c&oacute;pia desta Licen&ccedil;a, junto com o Programa.</p>
  <p>Voc&ecirc; pode cobrar pelo ato f&iacute;sico de transferir uma c&oacute;pia e pode,<br />
    opcionalmente, oferecer garantia em troca de pagamento.</p>
  <p> 2. Voc&ecirc; pode modificar sua c&oacute;pia ou c&oacute;pias do Programa, ou qualquer<br />
    parte dele, assim gerando um trabalho baseado no Programa, e copiar e<br />
    distribuir essas modifica&ccedil;&otilde;es ou trabalhos sob os termos da se&ccedil;&atilde;o 1<br />
    acima, desde que voc&ecirc; tamb&eacute;m se enquadre em todas estas condi&ccedil;&otilde;es:</p>
  <p> a) Voc&ecirc; tem que fazer com que os arquivos modificados levem avisos<br />
    proeminentes afirmando que voc&ecirc; alterou os arquivos, incluindo a<br />
    data de qualquer altera&ccedil;&atilde;o.</p>
  <p> b) Voc&ecirc; tem que fazer com que quaisquer trabalhos que voc&ecirc;<br />
    distribua ou publique, e que integralmente ou em partes contenham<br />
    ou sejam derivados do Programa ou de suas partes, sejam<br />
    licenciados, integralmente e sem custo algum para quaisquer<br />
    terceiros, sob os termos desta Licen&ccedil;a.</p>
  <p> c) Se qualquer programa modificado normalmente l&ecirc; comandos<br />
    interativamente quando executados, voc&ecirc; tem que fazer com que,<br />
    quando iniciado tal uso interativo da forma mais simples, seja<br />
    impresso ou mostrado um an&uacute;ncio de que n&atilde;o h&aacute; qualquer garantia<br />
    (ou ent&atilde;o que voc&ecirc; fornece a garantia) e que os usu&aacute;rios podem<br />
    redistribuir o programa sob estas condi&ccedil;&otilde;es, ainda informando os<br />
    usu&aacute;rios como consultar uma c&oacute;pia desta Licen&ccedil;a. (Exce&ccedil;&atilde;o: se o<br />
    Programa em si &eacute; interativo mas normalmente n&atilde;o imprime estes<br />
    tipos de an&uacute;ncios, seu trabalho baseado no Programa n&atilde;o precisa<br />
    imprimir um an&uacute;ncio.)</p>
  <p>Estas exig&ecirc;ncias aplicam-se ao trabalho modificado como um todo. Se<br />
    se&ccedil;&otilde;es identific&aacute;veis de tal trabalho n&atilde;o s&atilde;o derivadas do Programa, e<br />
    podem ser razoavelmente consideradas trabalhos independentes e<br />
    separados por si s&oacute;, ent&atilde;o esta Licen&ccedil;a, e seus termos, n&atilde;o se aplicam<br />
    a estas se&ccedil;&otilde;es quando voc&ecirc; distribui-las como trabalhos em<br />
    separado. Mas quando voc&ecirc; distribuir as mesmas se&ccedil;&otilde;es como parte de um<br />
    todo que &eacute; trabalho baseado no Programa, a distribui&ccedil;&atilde;o como um todo<br />
    tem que se enquadrar nos termos desta Licen&ccedil;a, cujas permiss&otilde;es para<br />
    outros licenciados se estendem ao todo, portanto tamb&eacute;m para cada e<br />
    toda parte independente de quem a escreveu.</p>
  <p>Desta forma, esta se&ccedil;&atilde;o n&atilde;o tem a inten&ccedil;&atilde;o de reclamar direitos os<br />
    contestar seus direitos sobre o trabalho escrito completamente por<br />
    voc&ecirc;; ao inv&eacute;s disso, a inten&ccedil;&atilde;o &eacute; a de exercitar o direito de<br />
    controlar a distribui&ccedil;&atilde;o de trabalhos, derivados ou coletivos,<br />
    baseados no Programa.</p>
  <p>Adicionalmente, a mera adi&ccedil;&atilde;o ao Programa de outro trabalho n&atilde;o<br />
    baseado no Programa (ou de trabalho baseado no Programa) em um volume<br />
    de armazenamento ou meio de distribui&ccedil;&atilde;o n&atilde;o faz o outro trabalho<br />
    parte do escopo desta Licen&ccedil;a.</p>
  <p> 3. Voc&ecirc; pode copiar e distribuir o Programa (ou trabalho baseado<br />
    nele, conforme descrito na Se&ccedil;&atilde;o 2) em c&oacute;digo-objeto ou em forma<br />
    execut&aacute;vel sob os termos das Se&ccedil;&otilde;es 1 e 2 acima, desde que voc&ecirc;<br />
    fa&ccedil;a um dos seguintes:</p>
  <p> a) O acompanhe com o c&oacute;digo-fonte completo e em forma acess&iacute;vel<br />
    por m&aacute;quinas, que tem que ser distribu&iacute;do sob os termos das Se&ccedil;&otilde;es<br />
    1 e 2 acima e em meio normalmente utilizado para o interc&acirc;mbio de<br />
    software; ou,</p>
  <p> b) O acompanhe com uma oferta escrita, v&aacute;lida por pelo menos tr&ecirc;s<br />
    anos, de fornecer a qualquer um, com um custo n&atilde;o superior ao<br />
    custo de distribui&ccedil;&atilde;o f&iacute;sica do material, uma c&oacute;pia do<br />
    c&oacute;digo-fonte completo e em forma acess&iacute;vel por m&aacute;quinas, que tem<br />
    que ser distribu&iacute;do sob os termos das Se&ccedil;&otilde;es 1 e 2 acima e em meio<br />
    normalmente utilizado para o interc&acirc;mbio de software; ou,</p>
  <p> c) O acompanhe com a informa&ccedil;&atilde;o que voc&ecirc; recebeu em rela&ccedil;&atilde;o &agrave;<br />
    oferta de distribui&ccedil;&atilde;o do c&oacute;digo-fonte correspondente. (Esta<br />
    alternativa &eacute; permitida somente em distribui&ccedil;&atilde;o n&atilde;o comerciais, e<br />
    apenas se voc&ecirc; recebeu o programa em forma de c&oacute;digo-objeto ou<br />
    execut&aacute;vel, com oferta de acordo com a Subse&ccedil;&atilde;o b acima.)</p>
  <p>O c&oacute;digo-fonte de um trabalho corresponde &agrave; forma de trabalho<br />
    preferida para se fazer modifica&ccedil;&otilde;es. Para um trabalho em forma<br />
    execut&aacute;vel, o c&oacute;digo-fonte completo significa todo o c&oacute;digo-fonte de<br />
    todos os m&oacute;dulos que ele cont&eacute;m, mais quaisquer arquivos de defini&ccedil;&atilde;o<br />
    de &quot;interface&quot;, mais os &quot;scripts&quot; utilizados para se controlar a<br />
    compila&ccedil;&atilde;o e a instala&ccedil;&atilde;o do execut&aacute;vel. Contudo, como exce&ccedil;&atilde;o<br />
    especial, o c&oacute;digo-fonte distribu&iacute;do n&atilde;o precisa incluir qualquer<br />
    componente normalmente distribu&iacute;do (tanto em forma original quanto<br />
    bin&aacute;ria) com os maiores componentes (o compilador, o &quot;kernel&quot; etc.) do<br />
    sistema operacional sob o qual o execut&aacute;vel funciona, a menos que o<br />
    componente em si acompanhe o execut&aacute;vel.</p>
  <p>Se a distribui&ccedil;&atilde;o do execut&aacute;vel ou c&oacute;digo-objeto &eacute; feita atrav&eacute;s da<br />
    oferta de acesso a c&oacute;pias de algum lugar, ent&atilde;o ofertar o acesso<br />
    equivalente a c&oacute;pia, do mesmo lugar, do c&oacute;digo-fonte equivale &agrave;<br />
    distribui&ccedil;&atilde;o do c&oacute;digo-fonte, mesmo que terceiros n&atilde;o sejam compelidos<br />
    a copiar o c&oacute;digo-fonte com o c&oacute;digo-objeto.</p>
  <p> 4. Voc&ecirc; n&atilde;o pode copiar, modificar, sub-licenciar ou distribuir o<br />
    Programa, exceto de acordo com as condi&ccedil;&otilde;es expressas nesta<br />
    Licen&ccedil;a. Qualquer outra tentativa de c&oacute;pia, modifica&ccedil;&atilde;o,<br />
    sub-licenciamento ou distribui&ccedil;&atilde;o do Programa n&atilde;o &eacute; valida, e<br />
    cancelar&aacute; automaticamente os direitos que lhe foram fornecidos por<br />
    esta Licen&ccedil;a. No entanto, terceiros que de voc&ecirc; receberam c&oacute;pias ou<br />
    direitos, fornecidos sob os termos desta Licen&ccedil;a, n&atilde;o ter&atilde;o suas<br />
    licen&ccedil;as terminadas, desde que permane&ccedil;am em total concord&acirc;ncia com<br />
    ela.</p>
  <p> 5. Voc&ecirc; n&atilde;o &eacute; obrigado a aceitar esta Licen&ccedil;a j&aacute; que n&atilde;o a<br />
    assinou. No entanto, nada mais o dar&aacute; permiss&atilde;o para modificar ou<br />
    distribuir o Programa ou trabalhos derivados deste. Estas a&ccedil;&otilde;es s&atilde;o<br />
    proibidas por lei, caso voc&ecirc; n&atilde;o aceite esta Licen&ccedil;a. Desta forma, ao<br />
    modificar ou distribuir o Programa (ou qualquer trabalho derivado do<br />
    Programa), voc&ecirc; estar&aacute; indicando sua total aceita&ccedil;&atilde;o desta Licen&ccedil;a<br />
    para faz&ecirc;-los, e todos os seus termos e condi&ccedil;&otilde;es para copiar,<br />
    distribuir ou modificar o Programa, ou trabalhos baseados nele.</p>
  <p> 6. Cada vez que voc&ecirc; redistribuir o Programa (ou qualquer trabalho<br />
    baseado nele), os recebedores adquirir&atilde;o automaticamente do<br />
    licenciador original uma licen&ccedil;a para copiar, distribuir ou modificar<br />
    o Programa, sujeitos a estes termos e condi&ccedil;&otilde;es. Voc&ecirc; n&atilde;o poder&aacute; impor<br />
    aos recebedores qualquer outra restri&ccedil;&atilde;o ao exerc&iacute;cio dos direitos<br />
    ent&atilde;o adquiridos. Voc&ecirc; n&atilde;o &eacute; respons&aacute;vel em garantir a concord&acirc;ncia de<br />
    terceiros a esta Licen&ccedil;a.</p>
  <p> 7. Se, em conseq&uuml;&ecirc;ncia de decis&otilde;es judiciais ou alega&ccedil;&otilde;es de<br />
    infringimento de patentes ou quaisquer outras raz&otilde;es (n&atilde;o limitadas a<br />
    assuntos relacionados a patentes), condi&ccedil;&otilde;es forem impostas a voc&ecirc;<br />
    (por ordem judicial, acordos ou outras formas) e que contradigam as<br />
    condi&ccedil;&otilde;es desta Licen&ccedil;a, elas n&atilde;o o livram das condi&ccedil;&otilde;es desta<br />
    Licen&ccedil;a. Se voc&ecirc; n&atilde;o puder distribuir de forma a satisfazer<br />
    simultaneamente suas obriga&ccedil;&otilde;es para com esta Licen&ccedil;a e para com as<br />
    outras obriga&ccedil;&otilde;es pertinentes, ent&atilde;o como conseq&uuml;&ecirc;ncia voc&ecirc; n&atilde;o poder&aacute;<br />
    distribuir o Programa. Por exemplo, se uma licen&ccedil;a de patente n&atilde;o<br />
    permitir&aacute; a redistribui&ccedil;&atilde;o, livre de &quot;royalties&quot;, do Programa, por<br />
    todos aqueles que receberem c&oacute;pias direta ou indiretamente de voc&ecirc;,<br />
    ent&atilde;o a &uacute;nica forma de voc&ecirc; satisfazer a ela e a esta Licen&ccedil;a seria a<br />
    de desistir completamente de distribuir o Programa.</p>
  <p>Se qualquer parte desta se&ccedil;&atilde;o for considerada inv&aacute;lida ou n&atilde;o<br />
    aplic&aacute;vel em qualquer circunst&acirc;ncia particular, o restante da se&ccedil;&atilde;o se<br />
    aplica, e a se&ccedil;&atilde;o como um todo se aplica em outras circunst&acirc;ncias.</p>
  <p>O prop&oacute;sito desta se&ccedil;&atilde;o n&atilde;o &eacute; o de induzi-lo a infringir quaisquer<br />
    patentes ou reivindica&ccedil;&atilde;o de direitos de propriedade outros, ou a<br />
    contestar a validade de quaisquer dessas reivindica&ccedil;&otilde;es; esta se&ccedil;&atilde;o<br />
    tem como &uacute;nico prop&oacute;sito proteger a integridade dos sistemas de<br />
    distribui&ccedil;&atilde;o de software livres, o que &eacute; implementado pela pr&aacute;tica de<br />
    licen&ccedil;as p&uacute;blicas. V&aacute;rias pessoas t&ecirc;m contribu&iacute;do generosamente e em<br />
    grande escala para os software distribu&iacute;dos usando este sistema, na<br />
    certeza de que sua aplica&ccedil;&atilde;o &eacute; feita de forma consistente; fica a<br />
    crit&eacute;rio do autor/doador decidir se ele ou ela est&aacute; disposto a<br />
    distribuir software utilizando outro sistema, e um licenciado n&atilde;o pode<br />
    impor qualquer escolha.</p>
  <p>Esta se&ccedil;&atilde;o destina-se a tornar bastante claro o que se acredita ser<br />
    conseq&uuml;&ecirc;ncia do restante desta Licen&ccedil;a.</p>
  <p> 8. Se a distribui&ccedil;&atilde;o e/ou uso do Programa s&atilde;o restringidos em certos<br />
    pa&iacute;ses por patentes ou direitos autorais, o detentor dos direitos<br />
    autorais original, e que colocou o Programa sob esta Licen&ccedil;a, pode<br />
    incluir uma limita&ccedil;&atilde;o geogr&aacute;fica de distribui&ccedil;&atilde;o, excluindo aqueles<br />
    pa&iacute;ses de forma a tornar a distribui&ccedil;&atilde;o permitida apenas naqueles ou<br />
    entre aqueles pa&iacute;ses ent&atilde;o n&atilde;o exclu&iacute;dos. Nestes casos, esta Licen&ccedil;a<br />
    incorpora a limita&ccedil;&atilde;o como se a mesma constasse escrita nesta Licen&ccedil;a.</p>
  <p> 9. A Free Software Foundation pode publicar vers&otilde;es revisadas e/ou<br />
    novas da Licen&ccedil;a P&uacute;blica Geral de tempos em tempos. Estas novas<br />
    vers&otilde;es ser&atilde;o similares em esp&iacute;rito &agrave; vers&atilde;o atual, mas podem diferir<br />
    em detalhes que resolvem novos problemas ou situa&ccedil;&otilde;es.</p>
  <p>A cada vers&atilde;o &eacute; dada um n&uacute;mero distinto. Se o Programa especifica um<br />
    n&uacute;mero de vers&atilde;o espec&iacute;fico desta Licen&ccedil;a que se aplica a ele e a<br />
    &quot;qualquer nova vers&atilde;o&quot;, voc&ecirc; tem a op&ccedil;&atilde;o de aceitar os termos e<br />
    condi&ccedil;&otilde;es daquela vers&atilde;o ou de qualquer outra vers&atilde;o publicada pela<br />
    Free Software Foundation. Se o programa n&atilde;o especifica um n&uacute;mero de<br />
    vers&atilde;o desta Licen&ccedil;a, voc&ecirc; pode escolher qualquer vers&atilde;o j&aacute; publicada<br />
    pela Free Software Foundation.</p>
  <p> 10. Se voc&ecirc; pretende incorporar partes do Programa em outros<br />
    programas livres cujas condi&ccedil;&otilde;es de distribui&ccedil;&atilde;o s&atilde;o diferentes,<br />
    escreva ao autor e solicite permiss&atilde;o. Para o software que a Free<br />
    Software Foundation det&eacute;m direitos autorais, escreva &agrave; Free Software<br />
    Foundation; &agrave;s vezes n&oacute;s permitimos exce&ccedil;&otilde;es a este caso. Nossa<br />
    decis&atilde;o ser&aacute; guiada pelos dois objetivos de preservar a condi&ccedil;&atilde;o de<br />
    liberdade de todas as deriva&ccedil;&otilde;es do nosso software livre, e de<br />
    promover o compartilhamento e reutiliza&ccedil;&atilde;o de software em aspectos<br />
    gerais.</p>
  <p> AUS&Ecirc;NCIA DE GARANTIAS</p>
  <p> 11. UMA VEZ QUE O PROGRAMA &Eacute; LICENCIADO SEM &Ocirc;NUS, N&Atilde;O H&Aacute; QUALQUER<br />
    GARANTIA PARA O PROGRAMA, NA EXTENS&Atilde;O PERMITIDA PELAS LEIS<br />
    APLIC&Aacute;VEIS. EXCETO QUANDO EXPRESSADO DE FORMA ESCRITA, OS DETENTORES<br />
    DOS DIREITOS AUTORAIS E/OU TERCEIROS DISPONIBILIZAM O PROGRAMA &quot;NO<br />
    ESTADO&quot;, SEM QUALQUER TIPO DE GARANTIAS, EXPRESSAS OU IMPL&Iacute;CITAS,<br />
    INCLUINDO, MAS N&Atilde;O LIMITADO A, AS GARANTIAS IMPL&Iacute;CITAS DE<br />
    COMERCIALIZA&Ccedil;&Atilde;O E AS DE ADEQUA&Ccedil;&Atilde;O A QUALQUER PROP&Oacute;SITO. O RISCO TOTAL<br />
    COM A QUALIDADE E DESEMPENHO DO PROGRAMA &Eacute; SEU. SE O PROGRAMA SE<br />
    MOSTRAR DEFEITUOSO, VOC&Ecirc; ASSUME OS CUSTOS DE TODAS AS MANUTEN&Ccedil;&Otilde;ES,<br />
    REPAROS E CORRE&Ccedil;&Otilde;ES.</p>
  <p> 12. EM NENHUMA OCASI&Atilde;O, A MENOS QUE EXIGIDO PELAS LEIS APLIC&Aacute;VEIS OU<br />
    ACORDO ESCRITO, OS DETENTORES DOS DIREITOS AUTORAIS, OU QUALQUER OUTRA<br />
    PARTE QUE POSSA MODIFICAR E/OU REDISTRIBUIR O PROGRAMA CONFORME<br />
    PERMITIDO ACIMA, SER&Atilde;O RESPONSABILIZADOS POR VOC&Ecirc; POR DANOS, INCLUINDO<br />
    QUALQUER DANO EM GERAL, ESPECIAL, ACIDENTAL OU CONSEQ&Uuml;ENTE,<br />
    RESULTANTES DO USO OU INCAPACIDADE DE USO DO PROGRAMA (INCLUINDO, MAS<br />
    N&Atilde;O LIMITADO A, A PERDA DE DADOS OU DADOS TORNADOS INCORRETOS, OU<br />
    PERDAS SOFRIDAS POR VOC&Ecirc; OU POR OUTRAS PARTES, OU FALHAS DO PROGRAMA<br />
    AO OPERAR COM QUALQUER OUTRO PROGRAMA), MESMO QUE TAL DETENTOR OU<br />
    PARTE TENHAM SIDO AVISADOS DA POSSIBILIDADE DE TAIS DANOS.</p>
  <p> FIM DOS TERMOS E CONDI&Ccedil;&Otilde;ES</p>
  <p> Como Aplicar Estes Termos aos Seus Novos Programas</p>
  <p> Se voc&ecirc; desenvolver um novo programa, e quer que ele seja utilizado<br />
    amplamente pelo p&uacute;blico, a melhor forma de alcan&ccedil;ar este objetivo &eacute;<br />
    torn&aacute;-lo software livre que qualquer um pode redistribuir e alterar,<br />
    sob estes termos.</p>
  <p> Para isso, anexe os seguintes avisos ao programa. &Eacute; mais seguro<br />
    anex&aacute;-los logo no in&iacute;cio de cada arquivo-fonte para refor&ccedil;arem mais<br />
    efetivamente a inexist&ecirc;ncia de garantias; e cada arquivo deve possuir<br />
    pelo menos a linha de &quot;copyright&quot; e uma indica&ccedil;&atilde;o de onde o texto<br />
    completo se encontra.</p>
  <p> &lt;uma linha que forne&ccedil;a o nome do programa e uma id&eacute;ia do que ele faz.&gt;<br />
    Copyright (C) &lt;ano&gt;  &lt;nome do autor&gt;<br />
  <br />
    Este programa &eacute; software livre; voc&ecirc; pode redistribu&iacute;-lo e/ou<br />
    modific&aacute;-lo sob os termos da Licen&ccedil;a P&uacute;blica Geral GNU, conforme<br />
    publicada pela Free Software Foundation; tanto a vers&atilde;o 2 da<br />
    Licen&ccedil;a como (a seu crit&eacute;rio) qualquer vers&atilde;o mais nova.</p>
  <p> Este programa &eacute; distribu&iacute;do na expectativa de ser &uacute;til, mas SEM<br />
    QUALQUER GARANTIA; sem mesmo a garantia impl&iacute;cita de<br />
    COMERCIALIZA&Ccedil;&Atilde;O ou de ADEQUA&Ccedil;&Atilde;O A QUALQUER PROP&Oacute;SITO EM<br />
    PARTICULAR. Consulte a Licen&ccedil;a P&uacute;blica Geral GNU para obter mais<br />
    detalhes.<br />
  <br />
    Voc&ecirc; deve ter recebido uma c&oacute;pia da Licen&ccedil;a P&uacute;blica Geral GNU<br />
    junto com este programa; se n&atilde;o, escreva para a Free Software<br />
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA<br />
    02111-1307, USA.</p>
  <p>Inclua tamb&eacute;m informa&ccedil;&otilde;es sobre como contact&aacute;-lo eletronicamente e por<br />
    carta.</p>
  <p>Se o programa &eacute; interativo, fa&ccedil;a-o mostrar um aviso breve como este,<br />
    ao iniciar um modo interativo:</p>
  <p> Gnomovision vers&atilde;o 69, Copyright (C) ano nome do autor<br />
    O Gnomovision n&atilde;o possui QUALQUER GARANTIA; para obter mais<br />
    detalhes digite `show w'. Ele &eacute; software livre e voc&ecirc; est&aacute;<br />
    convidado a redistribui-lo sob certas condi&ccedil;&otilde;es; digite `show c'<br />
    para obter detalhes.</p>
  <p>Os comandos hipot&eacute;ticos `show w' e `show c' devem mostrar as partes<br />
    apropriadas da Licen&ccedil;a P&uacute;blica Geral. Claro, os comandos que voc&ecirc; usar<br />
    podem ser ativados de outra forma que `show w' e `show c'; eles podem<br />
    at&eacute; ser cliques do mouse ou itens de um menu -- o que melhor se<br />
    adequar ao programa.</p>
  <p>Voc&ecirc; tamb&eacute;m deve obter do seu empregador (se voc&ecirc; trabalha como<br />
    programador) ou escola, se houver, uma &quot;declara&ccedil;&atilde;o de aus&ecirc;ncia de<br />
    direitos autorais&quot; sobre o programa, se necess&aacute;rio. Aqui est&aacute; um<br />
    exemplo; altere os nomes:</p>
  <p> Yoyodyne, Inc., aqui declara a aus&ecirc;ncia de quaisquer direitos<br />
    autorais sobre o programa `Gnomovision' (que executa interpreta&ccedil;&otilde;es<br />
    em compiladores) escrito por James Hacker.</p>
  <p> &lt;assinatura de Ty Coon&gt;, 1o. de abril de 1989<br />
    Ty Con, Vice-presidente</p>
  <p>Esta Licen&ccedil;a P&uacute;blica Geral n&atilde;o permite incorporar seu programa em<br />
    programas propriet&aacute;rios. Se seu programa &eacute; uma biblioteca de<br />
    sub-rotinas, voc&ecirc; deve considerar mais &uacute;til permitir ligar aplica&ccedil;&otilde;es<br />
    propriet&aacute;rias com a biblioteca. Se isto &eacute; o que voc&ecirc; deseja, use a<br />
    Licen&ccedil;a P&uacute;blica Geral de Bibliotecas GNU, ao inv&eacute;s desta Licen&ccedil;a.</p>
  </fieldset>
  </div>
  </div>
