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

<div class="info">
   <?php echo '<span class="warning">' . $LANG['general']['warning'] . '</span> ' . $LANG['general']['disclaimer_end_of_activities'] ?>
</div>

<dl>
    <dt><b>20/08/2015 - Versão 6.0</b><br />
    <dd><ul type="circle">
            <li>Remoção do short-tag para compatibilidade com versões mais recentes do PHP;</li>
            <li>Adicionada chamada para participar da Franquia Smile Odonto;</li>
            <li>Alterado o módulo de Profissionais para Dentistas;</li>
            <li>Corrigida exclusão de Dentistas;</li>
            <li>Corrigida exclusão de Convênios/Planos e Honorários;</li>
            <li>Criada versão em espanhol;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>17/09/2013 - Versão 5.0</b><br />
    <dd><ul type="circle">
            <li>Correção de bug no lançamento de Contas a Receber;</li>
            <li>Correção de bug na codificação de caracteres com acento em vários campos;</li>
            <li>Adicionado campo de pesquisa por endereço e indicação em pacientes;</li>
            <li>Melhoria da pesquisa por aniversariantes em pacientes;</li>
            <li>Adicionado link para Tabela de Honorários;</li>
            <li>Correção da exibição de títulos em relatórios;</li>
            <li>Correção de bug para edição de cheques;</li>
            <li>Adicionadas fotos de início;</li>
            <li>Correção de bug para excluir agendamento de paciente excluído;</li>
            <li>Correção de bug nas pemissões de funcionários;</li>
            <li>Adicionada restrição de horário de atendimento de profissonal com bloqueio da agenda;</li>
            <li>Correção de bug em evolução do tratamento por um funcionário;</li>
            <li>Adicionado controle de acesso para funcionários e profissionais;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>21/12/2009 - Versão 4.0</b><br />
    <dd><ul type="circle">
            <li>Corrigido bug na seleção de convênios nos pacientes;</li>
            <li>Melhorado o sistema de redimensionamento de fotos;</li>
            <li>Adicionado campo de pesquisa por telefone, em pacientes;</li>
            <li>Alterada a tabela de honorários, por convênio; cada convênio poderá ter um valor por procedimento;</li>
            <li>Adicionados os campos Início e Término das atividades dos profissionais;</li>
            <li>Adicionado campo para marcação de pacientes falecidos; o nome, na listagem, aparece em cinza;</li>
            <li>Corrigidos bug na configuração e adicionadas mensagens de erro;</li>
            <li>Adicionada a situação do paciente na listagem, em frente ao nome;</li>
            <li>Adicionado índice informativo para os orçamentos confirmados: Aberto ou Pago;</li>
            <li>O tempo de expiração da sessão foi aumentado para 24 horas;</li>
            <li>Adicionada área radiológica para os pacientes;</li>
            <li>Adicionado controle de acesso para funcionários e profissionais;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>03/08/2009 - Versão 3.0</b><br />
    <dd><ul type="circle">
            <li>Lançada a versão 3.0 do sistema</li>
        </ul></dd>
    </dt>
    <dt><b>07/07/2009</b><br />
    <dd><ul type="circle">
            <li>Corrigido bug na impressão da agenda, que não mostrava o dia da semana;</li>
            <li>Corrigido bug na impressão de receitas, atestados e outros, que não mostrava o mês;</li>
            <li>Corrigido erro na impressão do odontograma;</li>
            <li>Atualizado forma de busca por aniversariantes no mês, em Pacientes;</li>
            <li>Corrigido erro na impressão de orçamentos;</li>
            <li>Corrigido bug nos materiais laboratoriais do paciente;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>10/05/2009</b><br />
    <dd><ul type="circle">
            <li>Adicionado o suporte a multi-idiomas;</li>
            <li>Adicionado o idioma inglês;</li>
            <li>Adicionado o suporte à Materiais Laboratoriais por pacientes com status de acompanhamento;</li>
            <li>Adicionada cor vermelha para pacientes em débito;</li>
            <li>Corrigido bug no orçamento para valores decimais;</li>
            <li>Adicionada caixa de texto para observações gerais em Fornecedores;</li>
            <li>Adicionados campos adicionais para correspondência em Contatos Úteis;</li>
            <li>Adicionada opção de impressão de etiquetas em Contatos Úteis;</li>
            <li>Adicionados campos bancários adicionais em Fornecedores;</li>
            <li>Adicionado módulo de cadastro de Convênios/Planos;</li>
            <li>Adicionado módulo de cadastro de Laboratórios;</li>
            <li>Corrigido bug inserção de logomarca da clínica;</li>
            <li>Adicionada possiblidade de editar a Evolução do Tratamento, em Pacientes;</li>
            <li>Adicionada opção de deletar lançamento do caixa;</li>
            <li>Adicionada opção de impressão de relatório do fluxo caixa;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>28/02/2009</b><br />
    <dd><ul type="circle">
            <li>Alterado o banco de dados de forma a desvincular os funcionários e profissionais do CPF, retirando sua obrigatoriedade;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>25/06/2008 - Versão 2.0</b><br />
    <dd><ul type="circle">
            <li>Corrigido o Configurador: fontes e funcionamento de atualizações;</li>
            <li>Corrigido erro com o valor nulo (zero) na tabéla de honorários;</li>
            <li>Corrigida rotina de backup;</li>
            <li>Corrigidos os links para impressões;</li>
            <li>Corrigida a rotina de cheques da clínica, que não registrava as datas de compensação;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>28/05/2008</b><br />
    <dd><ul type="circle">
            <li>Corrigido bug de nova instalação;</li>
            <li>Corrigido bug no menu de contexto da agenda;</li>
            <li>Corrigido bug no menu de contexto do orçamento de pacientes;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>17/05/2008</b><br />
    <dd><ul type="circle">
            <li>Adicionada a primeira versão do Odontograma;</li>
            <li>Correção de alguns erros de português;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>16/05/2008</b><br />
    <dd><ul type="circle">
            <li>Adicionado módulo de tabela de honorários;</li>
            <li>Corrigido bug na paginação de relatórios de clientes;</li>
            <li>Corrigido bug de pagamento de parcelas de Orçamentos não confirmados;</li>
            <li>Corrigido bug que não permitia a impressão de Orçamentos não confirmados;</li>
            <li>Adicionada integração entre procedimentos do Orçamento e Tabela de Honorários;</li>
            <li>Corrigido bug de pagamentos de parcelas;</li>
            <li>Corrigido bug do CPF errado ou já existente;</li>
            <li>Corrigido bug que permitia Funcionários e Dentistas apagarem Pacientes;</li>
            <li>Adicionada área de Ortodontia;</li>
            <li>Adicionada área de Implantodontia;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>15/05/2008</b><br />
    <dd><ul type="circle">
            <li>Adicionado método de busca de Pacientes por Profissional a quem foram encaminhados;</li>
            <li>Adicionado método de busca de Pacientes por Profissional que Atendeu;</li>
            <li>Alterados links de impressão de Boleto e Orçamento para a página do Orçamento correspondente;</li>
            <li>Adicionada função de Dar Baixa/Cancelar em Parcelas de Orçamentos;</li>
            <li>Adicionado relatório no controle de Caixa da Clínica para separar pagamentos de Pacientes por Dentistas;</li>
            <li>Adicionados métodos de impressão Encaminhamento, Laudo/Parecer e Agradecimento pelo Encaminhamento;</li>
            <li>Adicionada versão para impressão das fichas de cadastro de Paciente, Profissinal e Funcionário;</li>
        </ul><br /></dd>
    </dt>
    <dt><b>14/05/2008</b><br />
    <dd><ul type="circle">
            <li>Alterado o módulo de Dentistas para Profissionais;</li>
            <li>Adicionadas categorias de outras áreas profissionais (CRO, CRM, CRFa, CRP, CREFITO);</li>
            <li>Adicionadas áreas de tratamento do paciente na ficha de cadastro;</li>
            <li>Adicionado relatório de Pacientes pela área de tratamento;</li>
            <li>Adicionado relatório de Pacientes com parcelas a pagar vencidas;</li>
            <li>Adicionada geração de Recibo no pagamento de parcelas;</li>
            <li>Adicionada versão impressa de relatórios de pacientes;</li>
        </ul></dd>
    </dt>
    <dt><b>16/02/2008 - Versão 1.0</b><br />
    <dd><ul type="circle">
            <li>Lançada a versão 1.0 do sistema</li>
        </ul></dd>
    </dt>
    <dt><b>06/08/2006 - Versão 0.18</b><br />
    <dd><ul type="circle">
            <li>Lançada a versão 0.18 do sistema</li>
        </ul></dd>
    </dt>
    <dt><b>12/02/2007 - Versão 0.14</b><br />
    <dd><ul type="circle">
            <li>Lançada a versão 0.14 do sistema</li>
        </ul></dd>
    </dt>
    <dt><b>27/12/2006 - Versão 0.11beta</b><br />
    <dd><ul type="circle">
            <li>Lançada a versão 0.11beta do sistema</li>
        </ul></dd>
    </dt>
</dl>
