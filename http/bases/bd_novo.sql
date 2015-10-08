# phpMyAdmin SQL Dump
# version 3.2.0.1
# http://www.phpmyadmin.net
#
# Servidor: localhost
# Tempo de Geração: Dez 20, 2009 as 00:18
# Versão do Servidor: 5.1.37
# Versão do PHP: 5.3.0

#
# Banco de Dados: `gerenciador`
#

# ############################

#
# Estrutura da tabela `agenda`
#

CREATE TABLE IF NOT EXISTS `agenda` (
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `codigo_dentista` varchar(11) NOT NULL,
  `codigo_paciente` int(10) default NULL,
  `descricao` varchar(90) default NULL,
  `procedimento` varchar(15) default NULL,
  `faltou` enum('Sim','Não') NOT NULL default 'Não',
  PRIMARY KEY  (`data`,`hora`,`codigo_dentista`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `agenda_obs`
#

CREATE TABLE IF NOT EXISTS `agenda_obs` (
  `data` date NOT NULL,
  `codigo_dentista` varchar(11) NOT NULL,
  `obs` longtext,
  PRIMARY KEY  (`data`,`codigo_dentista`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `agradecimentos`
#

CREATE TABLE `agradecimentos` (
  `agradecimento` TEXT NULL DEFAULT NULL ,
  `codigo_paciente` INT NOT NULL ,
  PRIMARY KEY ( `codigo_paciente` )
) ENGINE = MYISAM;

# ############################

#
# Estrutura da tabela `ajuda`
#

CREATE TABLE IF NOT EXISTS `ajuda` (
  `codigo` int(10) NOT NULL auto_increment,
  `topico` varchar(200) NOT NULL,
  `texto` text NOT NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

#
# Extraindo dados da tabela `ajuda`
#

INSERT INTO `ajuda` (`codigo`, `topico`, `texto`) VALUES
(1, 'Dentistas', '<b><h3>Incluir Dentista</b></h3>\r\n<br>\r\n<br>\r\n<b>Caminho:</b> Arquivo > Dentistas > Incluir novo dentista\r\n<br>\r\n<br>\r\n<b><h3>Excluir Dentista</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Dentistas\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do dentista a ser excluído do sistema. A direita do número do CRO, aparecerá a opção EXCLUIR. Confirme exclusão.\r\n<br>\r\n<br>\r\n<b><h3>Editar dados do Dentista</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Dentistas\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do dentista que irá alterar as informações. A direita do número do CRO, aparecerá a opção EDITAR. Clique e confirme alterações.\r\n<br>\r\n<br>\r\n<b><h3>Procurar Dentista Cadastrado</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Dentistas\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do dentista a ser procurado do sistema.\r\n<br>\r\n<br>\r\n<b><h3>Relatório Total dos Dentistas</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Dentistas\r\n<br><br>\r\nJá aparecerá, por padrão, todos dentistas cadastrados. Listagem por ordem alfabética.\r\n'),
(2, 'Funcionários', '<b><h3>Incluir Funcionário</b></h3>\r\n<br>\r\n<br>\r\n<b>Caminho:</b> Arquivo > Funcionários > Incluir novo funcionário\r\n<br>\r\n<br>\r\n<b><h3>Excluir Funcionário</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Funcionários\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do funcionário a ser excluído do sistema. A direita da Função Principal, aparecerá a opção EXCLUIR. Confirme exclusão.\r\n<br>\r\n<br>\r\n<b><h3>Editar dados do Funcionário</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Funcionários\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do funcionário que irá alterar as informações. A direita da Função Principal, aparecerá a opção EDITAR. Clique e confirme alterações.\r\n<br>\r\n<br>\r\n<b><h3>Procurar Funcionário Cadastrado</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Funcionários\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do funcionário a ser procurado do sistema.\r\n<br>\r\n<br>\r\n<b><h3>Relatório Total dos Funcionários</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > funcionários\r\n<br><br>\r\nJá aparecerá, por padrão, todos funcionários cadastrados. Listagem por ordem alfabética.'),
(3, 'Pacientes', '<b><h3>Incluir Paciente</b></h3>\r\n<br>\r\n<br>\r\n<b>Caminho:</b> Arquivo > Pacientes > Incluir novo paciente\r\n<br>\r\n<br>\r\n<b><h3>Excluir Paciente</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Pacientes\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do paciente a ser excluído do sistema. A direita do número da ficha clínica \r\n\r\naparecerá a opção EXCLUIR. Confirme exclusão.\r\n<br>\r\n<br>\r\n<b><h3>Editar dados do Paciente</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Pacientes\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do paciente que irá alterar as informações. A direita do número da ficha clínica \r\n\r\naparecerá a opção EDITAR. Clique e confirme alterações.\r\n<br>\r\n<br>\r\n<b><h3>Procurar Paciente Cadastrado</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Pacientes\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do paciente a ser procurado do sistema.\r\n<br>\r\n<br>\r\n<b><h3>Relatório Total dos Pacientes</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Pacientes\r\n<br><br>\r\nJá aparecerá, por padrão, todos pacientes cadastrados. Listagem por ordem alfabética.');

# ############################

#
# Estrutura da tabela `arquivos`
#

CREATE TABLE IF NOT EXISTS `arquivos` (
  `codigo` int(20) NOT NULL auto_increment,
  `nome` varchar(20) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tamanho` float NOT NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `atestados`
#

CREATE TABLE IF NOT EXISTS `atestados` (
  `atestado` longtext,
  `codigo_paciente` int(11) NOT NULL,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `caixa`
#

CREATE TABLE IF NOT EXISTS `caixa` (
  `codigo` int(15) NOT NULL auto_increment,
  `data` date default NULL,
  `dc` enum('+','-') default NULL,
  `valor` float default NULL,
  `descricao` varchar(255) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `caixa_dent`
#

CREATE TABLE IF NOT EXISTS `caixa_dent` (
  `codigo` int(15) NOT NULL auto_increment,
  `codigo_dentista` varchar(11) default NULL,
  `data` date default NULL,
  `dc` enum('+','-') default NULL,
  `valor` float default NULL,
  `descricao` varchar(255) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `cheques`
#

CREATE TABLE IF NOT EXISTS `cheques` (
  `codigo` int(50) NOT NULL auto_increment,
  `valor` float default NULL,
  `nometitular` varchar(80) default NULL,
  `numero` varchar(50) default NULL,
  `banco` varchar(50) default NULL,
  `agencia` varchar(20) default NULL,
  `recebidode` varchar(80) default NULL,
  `encaminhadopara` varchar(80) default NULL,
  `compensacao` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `cheques_dent`
#

CREATE TABLE IF NOT EXISTS `cheques_dent` (
  `codigo` int(50) NOT NULL auto_increment,
  `codigo_dentista` varchar(11) NOT NULL,
  `valor` float default NULL,
  `nometitular` varchar(80) default NULL,
  `numero` varchar(50) default NULL,
  `banco` varchar(50) default NULL,
  `agencia` varchar(20) default NULL,
  `recebidode` varchar(80) default NULL,
  `encaminhadopara` varchar(80) default NULL,
  `compensacao` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `contaspagar`
#

CREATE TABLE IF NOT EXISTS `contaspagar` (
  `codigo` int(20) NOT NULL auto_increment,
  `datavencimento` date default NULL,
  `descricao` varchar(150) default NULL,
  `valor` float default NULL,
  `datapagamento` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `contaspagar_dent`
#

CREATE TABLE IF NOT EXISTS `contaspagar_dent` (
  `codigo` int(20) NOT NULL auto_increment,
  `codigo_dentista` varchar(11) default NULL,
  `datavencimento` date default NULL,
  `descricao` varchar(150) default NULL,
  `valor` float default NULL,
  `datapagamento` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `contasreceber`
#

CREATE TABLE IF NOT EXISTS `contasreceber` (
  `codigo` int(20) NOT NULL auto_increment,
  `datavencimento` date default NULL,
  `descricao` varchar(150) default NULL,
  `valor` float default NULL,
  `datapagamento` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `contasreceber_dent`
#

CREATE TABLE IF NOT EXISTS `contasreceber_dent` (
  `codigo` int(20) NOT NULL auto_increment,
  `codigo_dentista` varchar(11) default NULL,
  `datavencimento` date default NULL,
  `descricao` varchar(150) default NULL,
  `valor` float default NULL,
  `datapagamento` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `convenios`
#

CREATE TABLE IF NOT EXISTS `convenios` (
  `codigo` int(15) NOT NULL auto_increment,
  `nomefantasia` varchar(80) default NULL,
  `cpf` varchar(50) NOT NULL default '',
  `razaosocial` varchar(80) default NULL,
  `atuacao` varchar(80) default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(40) default NULL,
  `cidade` varchar(40) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `celular` varchar(15) default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `inscricaoestadual` varchar(40) default NULL,
  `website` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `nomerepresentante` varchar(80) default NULL,
  `apelidorepresentante` varchar(50) default NULL,
  `emailrepresentante` varchar(100) default NULL,
  `celularrepresentante` varchar(15) default NULL,
  `telefone1representante` varchar(15) default NULL,
  `telefone2representante` varchar(15) default NULL,
  `banco` varchar(50) default NULL,
  `agencia` varchar(15) default NULL,
  `conta` varchar(15) default NULL,
  `favorecido` varchar(50) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

INSERT INTO convenios (codigo, nomefantasia) VALUES (1, 'Particular');
INSERT INTO convenios (codigo, nomefantasia, cidade, estado, pais, cep) VALUES (2, 'Smile', 'Arcos', 'MG', 'Brasil', '35588-000');

# ############################

#
# Estrutura da tabela `dados_clinica`
#

CREATE TABLE IF NOT EXISTS `dados_clinica` (
  `cnpj` varchar(50) default NULL,
  `razaosocial` varchar(80) default NULL,
  `fantasia` varchar(90) default NULL,
  `proprietario` varchar(50) default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(40) default NULL,
  `cidade` varchar(40) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `fundacao` varchar(4) default NULL,
  `telefone1` varchar(13) default NULL,
  `telefone2` varchar(13) default NULL,
  `fax` varchar(13) default NULL,
  `email` varchar(100) default NULL,
  `web` varchar(100) default NULL,
  `banco1` varchar(50) default NULL,
  `agencia1` varchar(15) default NULL,
  `conta1` varchar(15) default NULL,
  `banco2` varchar(50) default NULL,
  `agencia2` varchar(15) default NULL,
  `conta2` varchar(15) default NULL,
  `idioma` varchar(50) default NULL,
  `logomarca` blob
) ENGINE=MyISAM;

#
# Extraindo dados da tabela `dados_clinica`
#

INSERT INTO `dados_clinica` (`cnpj`, `razaosocial`, `fantasia`, `proprietario`, `endereco`, `bairro`, `cidade`, `estado`, `pais`, `cep`, `fundacao`, `telefone1`, `telefone2`, `fax`, `email`, `web`, `banco1`, `agencia1`, `conta1`, `banco2`, `agencia2`, `conta2`, `logomarca`) VALUES
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

# ############################

#
# Estrutura da tabela `dentistas`
#

CREATE TABLE IF NOT EXISTS `dentistas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `usuario` varchar(15) CHARACTER SET latin7 COLLATE latin7_general_cs DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `telefone1` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `telefone2` varchar(15) DEFAULT NULL,
  `sexo` enum('Masculino','Feminino') NOT NULL,
  `nomemae` varchar(80) DEFAULT NULL,
  `rg` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `comissao` float DEFAULT NULL,
  `codigo_areaatuacao1` int(5) DEFAULT NULL,
  `codigo_areaatuacao2` int(5) DEFAULT NULL,
  `codigo_areaatuacao3` int(5) DEFAULT NULL,
  `conselho_tipo` varchar(30) DEFAULT NULL,
  `conselho_estado` varchar(30) DEFAULT NULL,
  `conselho_numero` varchar(30) DEFAULT NULL,
  `ativo` enum('Sim','Não') DEFAULT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `foto` blob,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `dentista_atendimento`
#
CREATE TABLE dentista_atendimento (
  codigo_dentista int(11) NOT NULL,
  dia_semana tinyint(1) NOT NULL,
  hora_inicio time NOT NULL,
  hora_fim time NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  PRIMARY KEY (codigo_dentista,dia_semana)
);

# ############################

#
# Estrutura da tabela `encaminhamentos`
#

CREATE TABLE `encaminhamentos` (
  `encaminhamento` TEXT NULL DEFAULT NULL ,
  `codigo_paciente` INT NOT NULL ,
  PRIMARY KEY ( `codigo_paciente` )
) ENGINE = MYISAM;

# ############################

#
# Estrutura da tabela `especialidades`
#

CREATE TABLE IF NOT EXISTS `especialidades` (
  `codigo` int(5) NOT NULL auto_increment,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

#
# Extraindo dados da tabela `especialidades`
#

INSERT INTO `especialidades` (`codigo`, `descricao`) VALUES
(1, 'Cirurgia e Traumatologia Buco Maxilo Faciais'),
(2, 'Clínica Geral'),
(3, 'Dentistica'),
(4, 'Dentistica Restauradora'),
(5, 'Disfuncao Temporo-Mandibular e Dor-Orofacial'),
(6, 'Endodontia'),
(7, 'Estomatologia'),
(8, 'Implantodontia'),
(9, 'Odontologia do Trabalho'),
(10, 'Odontologia em Saude Coletiva'),
(11, 'Odontologia Legal'),
(12, 'Odontologia para Pacientes com Necessidades Especiais'),
(13, 'Odontogeriatria'),
(14, 'Odontopediatria'),
(15, 'Ortodontia'),
(16, 'Ortodontia e Ortopedia Facial'),
(17, 'Ortopedia Funcional dos Maxilares'),
(18, 'Patologia Bucal'),
(19, 'Periodontia'),
(20, 'Protese Buco Maxilo Facial'),
(21, 'Protese Dentaria'),
(22, 'Radiologia'),
(23, 'Radiologia Odontologica e Imaginologia'),
(24, 'Saúde Coletiva');

# ############################

#
# Estrutura da tabela `estoque`
#

CREATE TABLE IF NOT EXISTS `estoque` (
  `codigo` int(15) NOT NULL auto_increment,
  `descricao` varchar(150) default NULL,
  `quantidade` varchar(25) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `estoque_dent`
#

CREATE TABLE IF NOT EXISTS `estoque_dent` (
  `codigo` int(15) NOT NULL auto_increment,
  `codigo_dentista` varchar(11) default NULL,
  `descricao` varchar(150) default NULL,
  `quantidade` varchar(25) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `evolucao`
#

CREATE TABLE IF NOT EXISTS `evolucao` (
  `codigo_paciente` int(10) NOT NULL,
  `codigo` int(10) NOT NULL auto_increment,
  `procexecutado` varchar(150) default NULL,
  `procprevisto` varchar(150) default NULL,
  `data` date default NULL,
  `codigo_dentista` varchar(11) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `exameobjetivo`
#

CREATE TABLE IF NOT EXISTS `exameobjetivo` (
  `codigo_paciente` int(10) NOT NULL,
  `pressao` varchar(150) default NULL,
  `peso` varchar(150) default NULL,
  `altura` varchar(150) default NULL,
  `edema` varchar(150) default NULL,
  `face` varchar(150) default NULL,
  `atm` varchar(150) default NULL,
  `linfonodos` varchar(150) default NULL,
  `labio` varchar(150) default NULL,
  `mucosa` varchar(150) default NULL,
  `soalhobucal` varchar(150) default NULL,
  `palato` varchar(150) default NULL,
  `orofaringe` varchar(150) default NULL,
  `lingua` varchar(150) default NULL,
  `gengiva` varchar(150) default NULL,
  `higienebucal` varchar(150) default NULL,
  `habitosnocivos` varchar(150) default NULL,
  `aparelho` enum('Sim','Não') default NULL,
  `lesaointra` varchar(150) default NULL,
  `observacoes` text,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;


# ############################

#
# Estrutura da tabela `exames`
#

CREATE TABLE IF NOT EXISTS `exames` (
  `exame` text,
  `codigo_paciente` int(11) NOT NULL,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `fornecedores`
#

CREATE TABLE IF NOT EXISTS `fornecedores` (
  `codigo` int(15) NOT NULL auto_increment,
  `nomefantasia` varchar(80) default NULL,
  `cpf` varchar(50) NOT NULL default '',
  `razaosocial` varchar(80) default NULL,
  `atuacao` varchar(80) default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(40) default NULL,
  `cidade` varchar(40) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `celular` varchar(15) default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `inscricaoestadual` varchar(40) default NULL,
  `website` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `nomerepresentante` varchar(80) default NULL,
  `apelidorepresentante` varchar(50) default NULL,
  `emailrepresentante` varchar(100) default NULL,
  `celularrepresentante` varchar(15) default NULL,
  `telefone1representante` varchar(15) default NULL,
  `telefone2representante` varchar(15) default NULL,
  `banco` varchar(50) default NULL,
  `agencia` varchar(15) default NULL,
  `conta` varchar(15) default NULL,
  `favorecido` varchar(50) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `fotospacientes`
#

CREATE TABLE IF NOT EXISTS `fotospacientes` (
  `codigo_paciente` int(10) NOT NULL,
  `codigo` int(10) NOT NULL auto_increment,
  `foto` mediumblob NOT NULL,
  `legenda` varchar(50) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `foto_padrao`
#

CREATE TABLE IF NOT EXISTS `foto_padrao` (
  `foto` blob NOT NULL
) ENGINE=MyISAM;

#
# Extraindo dados da tabela `foto_padrao`
#

INSERT INTO `foto_padrao` (`foto`) VALUES
(0xffd8ffe000104a4649460001010100c100c10000ffdb00430001010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101ffdb00430101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101ffc0001108008c006a03011100021101031101ffc4001e0001000104030101000000000000000000000a020708090304050601ffc4004010000005030104070408050305000000000102030405000611070812213109131422415191526171d215162332538193d11762a1c1e12473b23342b1f0f1ffc4001a010100030101010000000000000000000000020304010507ffc4003511000103020306040504020301000000000100021103210412311341516171f0228191a11432b1c1d1234252e162f133829205ffda000c03010002110311003f0099b76871f8eb7ea9ff007af417cfd3b438fc75bf54ff00bd113b438fc75bf54ffbd117e0ba58a1933854a1e62b1803d44d4456fee7d5bb16cf4565ee5be2162134004542ba95dc5b018e0042984c06f754803c3bdddf4e227b2d1abb74e9ebd562b5ddd235b2e5a4b9d175aaad173a390501a2abafcb988081b038e5e39e353c87f8fa69bb8ca81aac8d41cda58031c6c442b3b23d2fbb2547aa297d7092738110df41bb812860440047bc3c4d81100f2c79d4c5071fdaee36ff004b3eda892469e674e21772dfe972d91e75f1191afd7517bd8fb79041ca68064774037f38c88fc31438778fdaef31dc754da52e2749eecb366c1da0f4cf535ba4e6cbbdd8cd24a87701ac820753dc1d50a853710f4c0fc6aa2c8e3369f3f2fa4ad2ca94dda653bace3f5fcc2bca0e963630e5436433c1630e43cf81b1e9505d5576871f8eb7ea9ff7a2276871f8eb7ea9ff007a2276871f8eb7ea9ff7a2276871f8eb7ea9ff007a22e1a22511759d3b4192265dca809244011131b8070011e7c8338c067c6ba04a2d41ededd20b07a2117f566064c54bb2451395264c4e439d1c6f9416531c485c8e788ef0055f4e91798001bdff00be5e9c3ad352b35a09bff88d093d6776f518fd4cda4354f53e49dbe9db9e4cc9b950c616e574a9498111100100373001c08e78f956f661da078b5fbf7bb76e2bcf2f7ba65c60eee1c3cc5d58c5dd3972613aebaaa98444445450e71c9b9f13088f1abc35a370efbdca103da2ebad80f20a90b696e8ba980f20f4a4a2b8b606abea16984aa13164dd52f0ae90394c0541e2e2dcfba60360cdcc7eaf038f000f31cd56fa6c7ea3d2dc7f2ba091a18e91ef6efd548a7600e94735f8f6374d3591f358eb80e6237612cb2c541a4981b05005575bba9adec97250139ab057a059a491c6defcf9db7ad94711f2b5f97d0f7ee6782dfc327ad641aa2f192e9b96cb90a749648c07228430640c062f01c871e158e216c3aaedd71712889444a225116186d89aeecf4774ea7a48cf08829f472bd590ea703ae5298f802e40444377180e7e3563469c49b71be9ea78a8bdc1bbc1b127a6f1e927c942b758752a6b566fe9bbca71d2ae557ce96168455432856ad44e2254910308ee13c7743966bd6a2c0c60e275b46bf40bcb73cbc9719b9b026607f7bf77056c2ae514a225112889445ced9cb866e1076d1651bba6ca9176eba27122a8ac99b793513397025314c002021e35c201041b82208e21774b85293e89fdb8dcea55bc868dea0c9f69bb2dc6a0de35ebc5cc771271bbc5222639941de59ca3802ef644db9f9d79788a591d61e13a18b5e7ac7e7d46fc3d50406b8cb87a86c98326c4ee3c7aadeafa7e5cab22d0bf6889444a22e25942a4989cc6dcc721f7800880721e78ff0035d0ba3b95177e988d727cf6eb8bd368e5f71b95133b7e5218037cbbc25029c388f1f22980442b5e1e9e67c99cbf7f4fae92562c554102989926e40b5b766dd3cac77ad0e57a8b1a5112889444a22511288af56cfba9f29a45aaf695e714baa828c64db157ea8e24151b9950df218738dcc672020354d66e661e4ba1d94877f133bfed3e7653afd16be1b6a2e9a5a974b354a3f4945b65d5129badfb4509be60de130e4726e381c008080578ee96b8e9df55ebb5c1c03e2411efd77fdf5575ea289444a22f0ae4700d61de38ce3aa48c60f1e3b86f0a934c4f4fc2ea85574904f1e7b68fb80fd61952b444897f293bc6c807c315e8612d9a4dfbfc2f3b131b410328234e63bee1600d6e59d2889444a2251128894455a66dc55237b2aa66f1f03947c38fa570e87a1fa229b1746a4c3995d99ad132f8fb1648909e22050c8067f2e3e7c78d78d5624f5fb77f65e8513fa22370038f7afd392d8497880552af6dc0555175288be62f0eac6df9121f3de6ea631cf81478f970c873f3a9344ebd945081dbb8c736d0f7989c0383c326410f12a4631723efe3e15e96163c4bcbad26b662419601ff00931758695b1569444a225112889444a22a89f7d3ff00713ff98570e87a15c3a1e854d57a308a51d98ed8373c248943cbbc531873efc863cbdd5e2d599efbd17a586ca6940b811af38fbf25b19aa95e9444a22f9dba1a99d433e02980bb8d57371c8e7b9c0031f0a90fb84898e467d88fba84a7481c3b989da16e905c0401774b2c4c86070a1c4dff00cfeb5e9614822470f79bfd579759b96a9ef5858395b1569444a225112889444a22a89ff513ff00713ff98570e87a21bdb8a9ad746522b35d986d503263f6892072f01e4299fc31c38d78b5a73690bd3c2340a573ac70feef2085b1228888644303e5552bc800d8caaa8a29445d27c81176ca94c4138f54a00007f31703c0780f0e2203e01c38d75bec75efe88a21bd2d766a903ad6d24fa8ea1bcca0a0914c609bc888e439f31c788e43956ec2ba001d6077d7cd79b8b01af0f17dc6e758ecf2b2d481830610ce7038cf9d7a01521535d44a225112889444a22f7ed68771705c7070cd5232cb48c9b36a54cbf78dd62c501c72e41c6a2f30d7744efd4c5a77a9d86c8565a960e8959d6f2c90a4aa510c943147390fb12fdee001bc3bff00f686078f3c66bc47dce6e24f9f70bd5a632d368e035b5c75d4efd5650d414d2889445498044a2018c88638fbe8bab407d301a14f6e9b6995e1148196756faa0b1c83dd3aa9282207c0094378039948411388f11eee4d5a68bf2bc104df522343aefb0f2e2b362585cc91123c422419e0205dd1d47085193592322a289285326aa4a1935113944874ce51c18a601e4203efaf55ae9008b8dc78fd0fb2f3efa1f3bce9c79ae1a9225112889444a225116e27a2e76279ad5fbf233566e764a37b26da5bb43717081bfd73d4950145248a72ee29bfb807c870eac788873ac588abab0473bf7c6cb450a45ce0ed1a3dcfa296eb2688b16a8344080449ba49a2994000a0522650290a005e000528014003800057987fd2f43ed65daa2251128894456f750b4d6dad4883790770b34dcb674d1c35314e5298bbaba66267bdc84b9c944390e3c82a40ff00befd7aa1f16b795153e905e8ef9ad1195737d59ad8cbda6ed550eb9504f7c8d8c6111032ea0177c4c60e3bd9dc01ce78d6bc3d5876f20db9f48f2b7e163c4321b22047888fa99de78cad3f9c864cc621c374c5112983c8439857a520dc68b1aa6ba89444a22511663ec87b265dbb4b5eac59b464e0b6cb57888c9bd297b8a22060de290c25129833801e3de0c8565c457d9f847cdbf88e9e5e9aabe8d2351c2de1bdfbdfeca68fa13a5103a31a6b6e5876fb441ab486649207ea49bbd6ac040eb5538f31318e26e79dd0ee8700af2dce275d64cf1d67be8bd10d0c194191d67901e415e2a8a25112889444a22511588da52d186bcb46af88b996e82e8042bd553ebc8530114220a180433c8dc3ba3e1e1526120dbbefbdca2f00b1c0cc46e13eca071a82c9bc75e771316a25ea1aca3a45302f22948a98a05f1ce31cf98d7b54fe51f995e408bc19b9f2e5bd7c6d58ba9444a22fc1e43f0a22973743c5a5111da02da593410fa41d2e2a2aa80075a39c88072e581e381fcabc6aff003bbaf19e3dfb68bd1c37fc79a66d6b46ff00517dcb717542bd2889444a225115260110ee8e07ceba175700ac4440c2b280001ccc6e001f98d775fb988e1c1488e82da4ad6cf486ed636769268fdc56fb09868eae79d64bb241b20b90e644144cc4113ee184c51011e021ff008ab68b333875ddcbb9f2e8b2d7aa29b48de6c35e37d3eea19926fd794917b24e4dbcbbe74b39547ccca9c4dfdebd868800700bce1dcae8d75128894441e43445231e899daaad7b7603f87171bf6f1ea1ce42b632ca94a50503052e4044374796403808f3e39af32bd321c4ea3bfc9dfaf25b30b518d191c622609d21c748f4befeaa4451d32c65504dcb17e8b94140289544d42180404038f7447fa70cd65bee023feba77c7cd6ff000c73f30bdc0f8e6a0a0bf6889444a22b57aa5abf66693c1b999baa51bb24914543814ca90a711294440302601cf0a9341d45ef11bfbff7b97090352a3e5b58f4b249bc5df5bda5ea9d048a2a25db89f7f7789378a25307201cf0e239c70e75b29e1c9d4ebbbf3f7fed61a9892e96b45ee083a5f7fdf96e5a38d45d54bcf54259796bb265e492cb286537575d45085130e7ba0611c07f2870f3cf3adcc6065c6bde8b35e4b89927b81c95b7ab112889444a22e702a221f78c537f3631fd03351f17007d947c5c01f65ebc05c9336b48252508fd666e90301c87454394a2203bc19dd128f3e78c08f21c8508cdaff6a4b679b3ef4a1ea7e9828c985c4bb9978c4770870595150a0981b182e404dc4a38001e58e23e3592a61b7b23d63af7a95736bbdbcc7d3f3c392df16cff00d247a3dab0dda377b269c1c92a5214c9bb549d418e2001c077bba006371e21efcd647d370d4758d47b77e8b5b2bb1d69bf3b7de39f05b1784b9612e2689bd879266fdba8192aad9722a41e019e2511e59c71c71e154477bfd15e2f7171c57bb5c45ac3dabfa4af4a342527b0102fd1b86eb4ca299906aa10e9365440400a7390c381def0f7639d5eca2e75f4f2f481afa8f259eae2594f421c7f8837e72a347b4aedaba99b404c3b5a4a59d21187554ea9922b1c8dca43604bba42e03977473ceb7d3a197fbd7bb0581ef7d4273481711e7cb9715854750ea984ea18c73184444c61111111f78d69d171515d44a225112889444a22511288bd38b9994857047316f9cb25886de28a0a9c81bc1c844a530070a8b9a1c2e39738de11670e847484ebb68a48b63b59e732b1698a60ab174b1d448e997818a291c44bba2001f747203c6a87e198e16d79f77f65632abd9bc91699e5df05b206fd37f2e08200bd9e415c114c161044702a8103ac10ef72dfce2a8f85a9fcbe8adf8b7ff01dff00d96812727e5ae391752b30f577af1e2c759655650e7131ce22223de11adc1a1ba6bc7f1c02cd179debc6a9225112889444a225112889444a225112889445d806ca0f1eefaff8a8671cd4338e6bb5d8833f7b8797f9c7f6ab323ffc7dff000aadb72efd57211aa65f7fc78ffefa5366e3f33801c1bf92a26b13a77df55c866e99804318f8007ed5dd881a120f383f85115083b96c1749ece8d5f44ac892d0fd0bd9b768ad4976d6f236af5b5ad8baf37aa51f7d36b91ea7665afa3da76c7502c8ba2ee827da74942cfbb6b69c25d675671c4de64115d0711ed31d5cc2a9151d558c19723a9c35907e6351c43834874897385b72f670ee6bb0f4dd470f85c4d587ed9957c55b6a1c7232852da31f51a696571d987df35ed0ad3bfd09b37522edd59beadd9e63b356865a175db367ba75ac517774d3cb6f546e28059fc9e9b276e69ec2ddb73b44826adebf9e5be776c0ec212d886610f332df4d8a49b9987bda18d2d356a39a5c32165d80fcd2e7006c5b31a932042af2d1aafad503be16831eda64d66bce5ace6e634b2d36bde2eda85b221ad686b8e6b1e46bb16dd82ef539c4d6a6e98dad64696595a55aa529a93703a9e696edc1a4facae9e2564dfb6d449624f75baedad598c87d49710885fce08b24c99dbabc9028d4adb1f0814dc4bdcf606c89da53f9987708fe53979a7c33a6b4d4a4da7469d1ac6b39ce0d751ae4ecea35b933de27265da1d036571df9b195eba796f5e72b237ae9dcd5c562db315a9737a7f012cf9fdce9687dc6ea1195adacae1c76224144c4dc4e2e6b68cd6c2989365aa2c99ceb09293b45ab031dc14cab9cb4789a1c4b03b2db68d99a77326329f181924407155d5c356a4d792fa25f4d8dacea4c74bfe1df9432b9d5ad6bb3b229b88ac03812c017b7b34e9d6982fa43b546b9de8e74e276e3d0cb42c67365e9aea642deb396c4eb9be2ef6f6dbd92958eb552669bd74e9158d05650af71c6161aef3a1313481e088a2a1dac2a07d1a6d2f8a8e7667b03416e513bceed5d6d34baee10b3e1f1b897ec4bb0cca469d2ac2a39aeda54c8490c027f8d3f108a977785794d76359972d98401755b4e8bae93163a3a890fb3928daf4fafb236ebeb355d4b8c3277816dc1d2b6eea434dd21bc9141dde490a0cc4b0ee8529fde8f0e6d77c3b641d90d6cadcb39b27cb9c3fe7f0fcb7d5061ea599b5a3f12ea7b56e122a6d5cc2cda8fd4cbb0bd2f1dea6963e2b2fabd40d90ad40b93672b6b49353eddb90baa1b2bc2ed07a93713d2dda8c3d8f16c185c13d7d5fae1bc9db31b2aa5a2dede8872fe2ed8806737746f404b20464b387f16939e36a3a2b178232563498d86cb89ca1adb3fe69372605f8053ab4067c2328d5a6fdb609b8aaae22a014da039d52a5da096063490c199f2d75ae26c66a868337b06d7b73502d5d4fb2b5974dee5b8a5aca6f7d58ac6ef858f637d41c547dc12768bd87bf606d9b8c5e37b765e2668251b45ad06aa2fc8d139033f41cb64ada64bdc58e069bc00ecae00cb49203a5af70d411acdb459eb34d2a6dacca94b1145ef34c55a62a340a8d6871616d56b1d21a43a632de264156305917c04407e39fed56647ff0087bfe166dbf2efd501914399847e1c2bb91f3fb63cc9fa04dbf00bb1d9d2f673f131bf7ab3237f8b7d02ab68ee5ff96fe1735494128894459276bdddb324c58f67c16ae587acd037858acae286677b6cf531a7300fef38f9e9b7b3e84ddf8e6f98c7d24a5db00322bdb50eea1176ac13b598c63751317657073d0e6d70f71a6ea65ae8396a871ca40021b948f09893fe44adaca983752632bd2c435f4c39a2a614d269a81ce2ecd54d404ed1b395b961a191695929696dfce585d5ae2e9e29ac9a576d6afdcba5f73a733b3b5d36a426a7343e8f586a6995af093afef68d94b62461ee2b6d63dc57a19ab24dfab7ba48ad14b251265913d0ec248a7f2542c0f1155a4b7f51d9c919483e1366eecbadd6b67ff522a6209f88a2caefa4fcd857b1b57f429ec58d71a80b0b5ecf154b4ed223c321597d52da7dbea3c26d2f0af1aea2dc0eb5ba0b40ed9b7ef1d48bc51bb2f16ac743ee67d361317dbcea88d5696b8dabc041186b412616c5b8e0864a25a251e254c2d6502c344f806ccd6710d6e51faadcb0de439dcef59eb634556e2dbfaae3881866b6a557e7a918779766a874cce1032b218ddd65d8bbb6a182b96e5da2a7d0b32659a7ae3b34e98682c736564e39456de96d3e67a2cd5ddcf26a268948fe3253f852f4cd183404deb72ccb12aea9bb239dee0a0e0288cc3f4eb3ea9b1b879a860731b4f65d7635ae7e29fb370f88c1d1c30b8f09a4dc30ce78b4ec1d005c661c0ab2d646a5b1b4f497687d357510f5f3ad6e80d30858e966ce9ba2d6dd3581a8cd6f978e241b2a432cf8928d5b1a35a11a9933377472aebef22025ab9ecccfa4e9ff008cbc9e799997fb59a95614e862e89692712ca2d041b3767545424f1902070d564d30daab4a1adcf6febb2d61ea829b47db3a571ba611f1a94fd9a5d9fdca30ba44b685c7cb3f667603a9a0aab63a859a7c8b696293eb8944adf76087b3d67d8548348399b13533cc3b6bf3ed08d727cd6d3e5e6b68c7510f6e24d3ac716ca228819a9fc298a1f0e0911b6ff8efafcffe365f0b6aed33090f2fa2f2b2f684d3a1b1b668b93647bf918a938f47e98d2b9883b82d46375d8e67a8a9f47ea4b680bb671cbd4ee2ed76a2b36da185bb3247f6f4d499a04ed21c3c559b5d9234a808743a3f64b469e289deaa66318d7619ce63bf4b06fc0d4ca478a8b9ae607d3916ab96a3c9cd2ccd96d1217c76aa6a86983ed2fb3f44f45edfd488fb06ddd43b93561f4c6af4ada7257b3bbc6e5b5a0aca7118cbea3328eb792b51b41db71ef10170d8d3469870f8145c580374cb26537ed0d5a85b98b05386021b9412e9f112665c77c7255d7af44d1661b0ecaa29b6abeb97572c350d47b1b4cb46cc0664cad047eecd3b963955eb1a511288bd4ec497b4a7a97e5a227624bda53d4bf2d113b125ed29ea5f96889d892f694f52fcb444ec497b4a7a97e5a227624bda53d4bf2d113b125ed29ea5f96889d892f694f52fcb444ec497b4a7a97e5a227624bda53d4bf2d113b125ed29ea5f96889d892f694f52fcb444ec497b4a7a97e5a227624bda53d4bf2d117fffd9);

# ############################

#
# Estrutura da tabela `funcionarios`
#

CREATE TABLE IF NOT EXISTS `funcionarios` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) default NULL,
  `cpf` varchar(50) default NULL,
  `usuario` varchar(15) character set latin7 collate latin7_general_cs default NULL,
  `senha` varchar(32) default NULL,
  `rg` varchar(50) default NULL,
  `estadocivil` enum('solteiro','casado','divorciado','viuvo') default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(50) default NULL,
  `cidade` varchar(50) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `nascimento` date default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `celular` varchar(15) default NULL,
  `sexo` enum('Masculino','Feminino') default NULL,
  `email` varchar(100) default NULL,
  `nomemae` varchar(80) default NULL,
  `nascimentomae` date default NULL,
  `nomepai` varchar(80) default NULL,
  `nascimentopai` date default NULL,
  `enderecofamiliar` varchar(220) default NULL,
  `funcao1` varchar(80) default NULL,
  `funcao2` varchar(80) default NULL,
  `admissao` date default NULL,
  `demissao` date default NULL,
  `observacoes` text,
  `ativo` enum('Sim','Não') default NULL,
  `foto` blob,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

#
# Extraindo dados da tabela `funcionarios`
#

INSERT INTO `funcionarios` (`codigo`, `nome`, `cpf`, `usuario`, `senha`, `rg`, `estadocivil`, `endereco`, `bairro`, `cidade`, `estado`, `pais`, `cep`, `nascimento`, `telefone1`, `telefone2`, `celular`, `sexo`, `email`, `nomemae`, `nascimentomae`, `nomepai`, `nascimentopai`, `enderecofamiliar`, `funcao1`, `funcao2`, `admissao`, `demissao`, `observacoes`, `ativo`, `foto`) VALUES
(1, 'Administrador', '11111111111', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 'solteiro', '', '', '', 'MG', 'Brasil', '', NULL, '', '', '', 'Masculino', '', '', NULL, '', NULL, '', 'Administrador da clínica', '', NULL, NULL, '', 'Sim', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `honorarios`
--

CREATE TABLE IF NOT EXISTS `honorarios` (
  `codigo` varchar(10) NOT NULL DEFAULT '',
  `procedimento` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM;

INSERT INTO `honorarios` (`codigo`, `procedimento`) VALUES
('EX001', 'Consulta inicial: exame clínico e plano de tratamento'),
('EX002', 'Urgência: noturna, sábado, domingos e feriados'),
('EX003', 'Avaliação técnica: perícia inicial ou final'),
('EX004', 'Falta a consulta'),
('DE001', 'Restauração de Amálgama - 1 Face'),
('DE002', 'Restauração de Amálgama - 2 Face'),
('DE003', 'Restauração de Amálgama - 3 Faces'),
('DE005', 'Restauração de Amálgama - Pim'),
('DE004', 'Restauração  de almálgama - 4 Faces'),
('DE006', 'Restauração Resina Folopolimerizável - 1 Face'),
('DE007', 'Restauração Resina Fotopolimerizável - 2 Face'),
('DE009', 'Restauraçao Resina Fotopolimerizável - 4 Face'),
('DE010', 'Faceta em Resina Fotopolimerizável'),
('DE011', 'Núcleo de Preenchimento em Ionômero de Viddro'),
('DE012', 'Núcleo de Preenchimento em Resina Folopolimerizável'),
('DE014', 'Núcleo de Preenchimento em Almálgama'),
('DE016', 'Pino de Retenção Intradicular'),
('DE017', 'Clareamento de Dente Vitalizado ( por Elemento )'),
('DE018', 'Restauração Inlay e Onlay (Arglas-Solidex)'),
('DE019', 'Clareamento  de Dente Vitalizado e Desvitalizado com Moldeiras de Uso Caseiro (por arcada)'),
('DE020', 'Restauração Metálica Fundida'),
('DE021', 'Restauração Temporária'),
('EN002', 'Tratamento Endodôntico Pré-Molares (não inclue radiografias)'),
('EN003', 'Tratamento Endodôntico Molar (não inclue radiografias)'),
('EN004', 'Retratamento Endodôntico Incisivo ou Canino (não inclue radiografias)'),
('EN005', 'Retratamento Endodôntico Pré- Molar (não inclue radiografias)'),
('EN001', 'Tratamento Endodôntico Incisivo ou Canino (não inclue radiografias)'),
('DE022', 'Clareamento Dental em Consultório - Técnica com peróxido de carbamida a 35% - Dente Unitário'),
('OD001', 'Aplicação Tópica de Flúor-Verniz ( quatro hemiarcadas )'),
('OD002', 'Aplicação de Salante ( por elemento)'),
('OD003', 'Aplicação de Salante- Téorica Invasiva (por elemento)'),
('OD004', 'Aplicação Cariostático 1 Sessão ( quatro hemiarcadas)'),
('DE015', 'Ajuste Oclusal ( por sessão )'),
('DE008', 'Restauraçao Resina Fotopolimerizável - 3 Face'),
('DE013', 'Restauração Inlay Onlay de Porcelana'),
('EN006', 'Retratamento do Molar (não inclue radiografias)'),
('EN008', 'Remoção de Núcleo Intrarradicular (por elemento) (não inclue radiografias)'),
('EN009', 'Capeamento Pulpar (excluindo restauração final)'),
('EN010', 'Pulpotomia'),
('EN011', 'Clareamento Dental em consultório-Técnica com peróxido de carbamida a 35% por d'),
('EN012', 'Preparo para Núcleo Intrarradicular'),
('EN014', 'Urgência Endodôntico Pulpectoma (Indenpente da sequência do tratamento)'),
('EN015', 'Apicectomia de Caninos ou Incisivos (não inclue radiografias)'),
('EN016', 'Apicectomia de Caninos -Incisivos com Obturação Retrograda (não inclue radiografias)'),
('EN013', 'Tratamento de Dentes Rizogênese Incompleta (por sessão)'),
('EN007', 'Tratademento de Perfuração (não inclue radiografias)'),
('EN017', 'Apicectomia Pré-Molares (não inclue radiografias)'),
('EN018', 'Apicectomia Pré-Molares com obturação retrograda (não inclue radiografias)'),
('EN019', 'Apicectomia de Molares (não inclue radiografias)'),
('EN020', 'Apicectomia de Molares com obturação retrogada (não inclue radiografias)'),
('EN021', 'Remoção de Corpo estranho intracanal por conduto'),
('EN022', 'Curativo de demora'),
('EN023', 'Reembasamento provisório'),
('EN024', 'Restauração Temporária'),
('OD005', 'Remineralização- Fluorterapia (quatro sessões)'),
('OD006', 'Adequação do Meio Bucal com Iônomero de Vidro (por hemiarcada)'),
('OD007', 'Adequação do Meio Bucal com IRM (por hemiarcada)'),
('OD008', 'Restauração a Iônomero de vidro (1 face)'),
('OD009', 'Restauraão Preventiva (iônomero + selante)'),
('OD011', 'Pulpotomia'),
('OD012', 'Tratamento Endodôntico em Decidios (não inclue as radiografias)'),
('OD013', 'Exdontia de Dentes Decídios'),
('OD014', 'Mantenedor de Espaço'),
('OD015', 'Placa de Mordida'),
('OD017', 'Condicionamento Odontopediatria (por sessão)'),
('OD018', 'Ulotomia'),
('OD019', 'Utlectomia'),
('OD020', 'Restauração Temporária'),
('OD010', 'Coroa de Aço'),
('OD016', 'Plano Inclinado'),
('PE001', 'Tratamento Não Cirúrgico da Periodontite Leve (por segmento) Baixo Risco'),
('PE002', 'Tratamento Não Cirúrgico da Periodontite Moderado  (Por Segmento) Médio Risco'),
('PE003', 'Tramento Não Cirúrgico da Periodontite Grave (Por Segmento) Alto Risco'),
('PE004', 'Tratamento de Processo Agudo (por sessão)'),
('PE005', 'Controle de Placa Bacteriana (por sessão)'),
('PE006', 'Dessensilização Dentária (por segmento)'),
('PE007', 'Imobilização Dentária Com Resina Fotopolimerizável (dentes)'),
('PE008', 'Ajuste Oclusal ( por sessão )'),
('PE010', 'Placa de  Mordida Miorelaxante'),
('PE011', 'Proservação Pré-Cirúrgia (por segmento)'),
('PE012', 'Gegivectomia (por segmento)'),
('PE013', 'Cirúrgia Retalho ( por segmento)'),
('PE014', 'Sepultamento Radicular (por raiz)'),
('PE015', 'Cunha distal'),
('PE016', 'Extensão de Vestíbulo (por Segmento)'),
('PE017', 'Enxerto Pediculado (por segmento)'),
('PE018', 'Enxerto Livre ( por segmento)'),
('PE019', 'Enxerto Conjuntivo Subepitelial'),
('PE020', 'Frenectomia ou  Bridectomia'),
('PE021', 'Odonto-Sessão ( por elemento)'),
('PE022', 'Amputação Radicular Sem Obturação Retrograda- por Raiz'),
('PE023', 'Amputação Radicular Com Obturação Retrograda- por Raiz'),
('PE025', 'Tratamento Periodico de Manutenção para periodontite leve de 6 em 6 meses'),
('PE026', 'Tratamento Periodico de Manutenção para periodontite leve de 4 em 4 meses'),
('PE027', 'Tratamento Periodico de Manutenção para periodontite leve de 2 em 2 meses'),
('PR001', 'Profilaxia: Pol. Coron. (4 hemiarcadas) e Apl. de Jato de Bicarbonato - Tartarec'),
('PR002', 'Aplicação de Jato de Bicabornato'),
('PR003', 'Or. de Higiene Bucal.:cárie d.,doen. period.,câncer b.,manut. de prótese.,uso de dentif. e enxaguat.'),
('PR004', 'Aplicação Tópica de Flúor (excluindo profilaxia )'),
('PR005', 'Controle de Placa Bacteriana ( por sessão )'),
('PR006', 'Tratamento de Gengivite-Terapêutica básica ( duas hemiarcadas)'),
('TE001', 'Teste de Risco de Cárie'),
('TE002', 'Ph'),
('TE003', 'Capacidade Tampão'),
('TE004', 'Fluxo Salivar'),
('TE005', 'Biópsia de Lesões Sugestivas (Acrescentar os Honorários do Laboratório)'),
('TE006', 'Citologia Esfoliativa (acrescentar honorários do laboratório)'),
('RA001', 'Periapical'),
('RA002', 'Interproximal ( Bite-Wing )'),
('RA003', 'Oclusal'),
('RA004', 'RX Postero Anterior ou Antero Posterior'),
('RA005', 'RX da ATM Série Completa ( três incidências )'),
('RA006', 'Panorâmica'),
('RA008', 'Telerradiografia sem Traçados Computadorizado'),
('RA009', 'RX de Mão ( Carpal )'),
('PO023', 'Prótese Fixa Adesiva Direta (por elemento)'),
('PO001', 'Planejamento em Prótese-modelo de est. par. montagem em articul. semi ajustável'),
('PO002', 'Enceramento de Diagnóstico (por elemento)'),
('PO003', 'Ajuste Oclusal(por sessão)'),
('PO004', 'Restauração Metálica Fundida'),
('PO005', 'Restauração Inlay e Onlay de Porcelana'),
('PO006', 'Remoção de Restaurações Metálicas ou Coroas'),
('PO007', 'Recolocação de Restauração Metálica Fundida ou Coras'),
('PO008', 'Núcleo Metálico Fundido'),
('PO009', 'Coroa Provisória em Dente de Estoque'),
('PO010', 'Coroa Provisória Prensada em Acrílico no Laboratório'),
('PO011', 'Reembasamento Provisório'),
('PO012', 'Coroa de Jaqueta Acrílica'),
('PO013', 'Coroa de Porcelana  Pura'),
('PO014', 'Coroa Metalo Cerâmica'),
('PO016', 'Coroa de Venner'),
('PO017', 'Coroa Total Metálica'),
('PO018', 'Coroa 3/4 ou 4/5'),
('PO019', 'Faceta Laminada de Porcelana'),
('PO020', 'Prótese Fixa em Metalo Cerâmica(por elemento)'),
('PO021', 'Prótese Fixa em Metalo Pástica(por elemento)'),
('PO025', 'Prótese Fixa Adesiva Indireta em Metalo Plástica(3 elementos)'),
('PO024', 'Prótese Fixa  Adesiva Indireta em Metalo Cerâmica(3 elementos)'),
('PO026', 'Prótese Parcial Removível Provisória em Acrílico ou sem Grampos'),
('PO027', 'Prótese Parcial Removível com grampos Bilateral'),
('PO028', 'Prótese Parcial Removível para Encaixes'),
('PO029', 'Encaixe Fêmea (por elemento)'),
('PO030', 'Encaixe Macho(por elemento)'),
('PO031', 'Reembasamento de Prótese Total ou Parcial'),
('PO032', 'Prótese Total'),
('PO033', 'Prótese Total Caracterizada'),
('PO034', 'Prótese Total Imediata'),
('PO035', 'Casquete de Moldagem'),
('PO036', 'Ponto de solda'),
('PO037', 'Guia Cirúrgico para Prótese Imediata ou para Cirurgia de Implante'),
('PO038', 'Placa de Mordida Miorrelaxante'),
('PO040', 'Jig ou Front Platô'),
('PO041', 'Conserto em Prótese Total ou Parcial'),
('PO042', 'Reparo ou substituição de dentes em Prótese total ou Parcial'),
('PO043', 'Clareamento Dental consultório-Técnica com Peróxido de carbamida e 35%(Por Elemento)'),
('PO044', 'Claream. Dent. com Moldeira de uso cas. para Dentes Vital. e Desvit.(por arcada)'),
('PO045', 'Restauração Inlay e Onlay(Artglas/Solidex)'),
('PO046', 'Prótese Fixa em Metalo(Artglas/Solidex)(Por Elemento)'),
('PO047', 'Prótese Fixa Adesiva Indireta em Metalo(Artglas/Solidex)(3 elementos)'),
('PO048', 'Restauração Temporária'),
('OR001', 'Aparelho Ortodôntico Fixo Metálico - 1 arcada'),
('OR002', 'Aparelho Ortodôntico Fixo Estético (POLICARBOXILATO) :: 1 arcada'),
('OR003', 'Manutenção de Ap. Ortodôntico :: 20% à 30% Salário Mínimo :: Apresentação em 22% Salário'),
('OR004', 'Placa Lábio Ativa'),
('OR005', 'Aparelho Extra Bucal'),
('OR006', 'Arco Lingual'),
('OR007', 'Botão de Nance'),
('OR008', 'Barra Transpalatina Fixa'),
('OR009', 'Barra Transpalatina Removível'),
('OR010', 'Quadrihélice'),
('OR011', 'Grade Palatina FIxa'),
('OR012', 'Pendulum de Hilgers com mola de TMA'),
('OR013', 'Pendex de Hilgers com mola de TMA'),
('OR014', 'Distalizador de Molar, tipo Jones Jig'),
('OR015', 'Herbst Encapsulado'),
('OR016', 'Mascara Facial-Delaire, tração reversa( sem o diajuntor )'),
('OR017', 'Mentoneira'),
('OR018', 'Disjuntor Palatino tipo Haas, Hirax'),
('OR019', 'Disjuntor Palatino tipo McNammara, Faltin'),
('OR020', 'Frankel'),
('OR021', 'Bimier'),
('OR022', 'Planas'),
('OR023', 'Aparelho Removível com Alça de Binator Invertida'),
('OR024', 'Aparelho Removível com alça de Escheler'),
('OR025', 'Bionator de Baiters'),
('OR027', 'Aparelho de Thurow'),
('OR028', 'Placa de Hawley (Aparelho de Contenção Superior)'),
('OR029', 'Placa de Hawley com torno expansor'),
('OR030', 'Grade Palatina Removível'),
('OR031', 'Planejamento em Ortodontia'),
('OR026', 'Blaca dupla de Sanders'),
('CO001', 'Exodontia (por elemento de permanente)'),
('CO002', 'Exodontia a Retalho'),
('CO003', 'Exodontia (Raiz Residual)'),
('CO004', 'Alveoloplastia(por segmento)'),
('CO006', 'Biópsia de Lesões Sugestivas  (acrescentar valor cobrado em laboratório)'),
('CO005', 'Ulotomia'),
('CO007', 'Sulcoplastia ( por arcada )'),
('CO008', 'Cirurgia para Torus Palatino'),
('CO009', 'Cirurgia para Torus Mandibular-Unilateral'),
('CO010', 'Cirurgia para Torus Mandibular-Bilateral'),
('CO011', 'Apicectomia de Caninos ou Incisivos'),
('CO012', 'Apcectomia Caninos/Incisivos com Obturação Retrograda'),
('CO013', 'Apcectomia Prè-Molares'),
('CO014', 'Apcectomia Pré-Molares com obturação retrograda'),
('CO015', 'Apcectomia de Molares'),
('CO017', 'Frenetomia ou Bridectomia'),
('CO018', 'Remoção de Dentes Inclusos ou Impactados'),
('CO019', 'Cirurgia de Tumores Intra-Óssea'),
('CO020', 'Tratamento de Lesão Cística(enucaleação)'),
('CO021', 'Tratamento de Lesão Cística(marzupialização e enucleação final)'),
('CO022', 'Remoção de Corpo Estranho no Selo Maxilar'),
('CO023', 'Tratamento Cirúrgico de Fístula Buço-Sinucal ou Buco-Nasal com Retalho'),
('CO024', 'Excisão de Glândula Sublingual'),
('CO025', 'Excisão de Glândula Submandibular'),
('CO026', 'Excisão de Glândula Parótida'),
('CO027', 'Excisão de Rânula'),
('CO028', 'Excisão de Tumor de Glândula Salivar'),
('CO029', 'Retirada de Cálculo Salivar'),
('CO030', 'Excisão de Mucocele de Desenvolvimento'),
('CO031', 'Drenagem de Abcesso'),
('CO032', 'Ulectomia'),
('CO033', 'Sinusotomia'),
('CO034', 'Plástico do Canal de Stenon'),
('CO035', 'Palentolabioplastia Bilateral'),
('CO036', 'Tratamento Cirúrgico do Lábio Leporino'),
('CO037', 'Recosntrução Parcial do Lábio Traumatizado'),
('CO038', 'Reconstrução Total de Lábio Traumatizado'),
('CO039', 'Redução Cirúrgica de Luxação de ATM'),
('CO040', 'Tratamento Cirúrgico para Aniquilose de ATM(por lado)'),
('CO041', 'Tratamento Cirúrgico para Osteomelite dos Ossos da Face'),
('CO042', 'Excisão de Sutura de Lesão da Boca com Rotação de Retalho'),
('CO043', 'Suturas Simples de Face'),
('CO044', 'Suturas Múltiplas de Face'),
('CO045', 'Maxilectomia com ou sem Esvaziamento Orbitário'),
('CO047', 'Osteotomia e Osteoplastia de Mandíbula para Micrognatismo'),
('CO046', 'Osteotomia e Osteoplastia de Mandíbula para Prognatismo'),
('CO048', 'Osteotomia e Osteoplastia de Mandíbula para Laterognostismo'),
('CO049', 'Osteotomia e Osteoplastia de Maxila Tipo Le Fort I'),
('CO050', 'Osteotomia e Osteoplastia de Maxila Tipo Le Fort II'),
('CO051', 'Osteotomia e Osteplastia de Maxila Tipo Le Fort III'),
('CO052', 'Reconstrução Total da Mandíbula com Enxerto Ósseo/Prótese'),
('CO053', 'Reconstrução Parcial da Mandíbula com Enxerto Ósseo/Prótese'),
('CO054', 'Reconstrução de Sulco Gengivo-Labial'),
('CO055', 'Excisão em Cunha de Lábio Sutura'),
('CO056', 'Cirurgia de Hipertrofia do Lábio'),
('CO057', 'Cirurgia para Microstomia'),
('CO058', 'Redução de Fratura de Osso Próprios do Nariz'),
('CO059', 'Redução Incluenta de Fratura Unilateral de Mandibula'),
('CO060', 'Redução Cruenta de Fratura Unilateral Mandíbula'),
('CO061', 'Redução Incluenta de Fratura Bilateral de Mandíbula'),
('CO062', 'Redução Cruenta de Fratura Bilateral de Mandíbula'),
('CO063', 'Redução Cruenta de Fratura Cominutiva de Mandibula'),
('CO064', 'Redução de Fratura de Côndido Mandíbula'),
('CO065', 'Fraturas Alvéolo-Dentárias-Redução Cruenta'),
('CO066', 'Fraturas Alvéolo-Dentárias-Redução Incruenta'),
('CO067', 'Reimplante de Dente (por elemento)'),
('CO068', 'Redução Inoruenta de Fratura de Le Fort I'),
('CO069', 'Redução Incruenta de Fratura Le Fort II'),
('CO070', 'Redução Incruenta de Fratura Le Fort III'),
('CO071', 'Redução Cruenta de Fratura Le Fort I'),
('CO072', 'Redução Cruenta de Fratura Le Fort II'),
('CO074', 'Fraturas Complexas do Segmento Fixo da Face'),
('CO073', 'Redução Cruenta de Fratura Le Fort III'),
('CO075', 'Fraturas Complexas do Segmento da Face com Fixação Pericraniana'),
('CO077', 'Fratura do Arco Zigomático - Redução cirúrgica sem fixação'),
('CO078', 'Fratura do Osso Zigomático - Redução Cirúrgica e Fixação'),
('CO079', 'Retirada de Fios Intra ou Trans-Ósseos'),
('CO080', 'Retirada de Bloqueio Maxilo-Mandibular'),
('CO081', 'Retirada de Ancoragem e Cerclagens'),
('CO082', 'Cirurgia de Cisto'),
('CO083', 'Artroplastia para Luxação Rescidivante da ATM'),
('CO084', 'Ressecção Parcial da Mandíbula'),
('CO085', 'Ressecção Parcial de Mandíbula com enxerto ósseo'),
('CO086', 'Hemimandibuloctomia'),
('CO087', 'Hemimandibulectomia com colação de prótese'),
('CO088', 'Hemimandibulectomia com enxerto ósseo'),
('CO089', 'Mnadibulectomias com Reconstrução Microcirúrgica'),
('CO090', 'Mandibulectomia com Reconstrução de osteomicutanêa'),
('CO091', 'Osteoplastia de Etmóido Orbitárias'),
('CO092', 'Osteoplastia de Mandíbula'),
('CO093', 'Osteoplastia de Órbita'),
('CO094', 'Ressecção do Meso Infra Estrutura do Maxila Superior'),
('CO095', 'Ressecção Total de Maxila Inclinada Exenter de Órbita'),
('CO096', 'Ressecção Maxilar Superior Reconstrução à custa Retalhos'),
('IM001', 'Ato Cirúrgico de Inserção do Pino de Titânio'),
('IM002', 'Planejamento Cirúrgico e Protético com modelos de estudo'),
('IM003', 'Coroa Total sobre Implante em Metalo Artglas/Solidex'),
('IM004', 'Coroa Total sobre Implante em Metalo Cerâmica (Porcelana)'),
('IM005', 'Barra para Prótese Total Fixa ou Removível Sobre Implante (Over Dental0'),
('IM006', 'Interm. e Adapt. para prótese sobre implante:Oring. Munhões,Uclas etc(unitários)'),
('IM007', 'Coroa Total Provisória sobre Implante em Acrílico'),
('OR032', 'Manutenção de Ap. Ortodôntico :: 20% à 30% Salário Mínimo :: Apresentação em 30% Salário'),
('DE023', 'Clareamento Dental em Consultório a Layser :: Por Arcada'),
('EX005', 'Urgência Horário Normal (independente da sequência do tratamento)'),
('OR033', 'Aparelho Ortodôntico Fixo Estético (CERÂMICA) :: 1 Arcada'),
('CO097', 'Aumento de Coroa Clínica'),
('CO098', 'Enxerto Ósseo Autôgeno em Bloco para Ganho de Volume - Por Segmento'),
('CO099', 'Enxertos Utilizando Bio-Materiais (Acrescentar o Valor do Bio-Material)'),
('CO100', 'Exodontia de CISO ''Incluso ou Impactado'''),
('EN025', 'Tratamento Endodôntico de Molar acima de 3 condutos (não inclue radiografias)'),
('EN026', 'Retratamento Endodôntico de Molar acima de 3 condutos (não inlcue radiografias)'),
('IM008', 'Elemento de Porcelana para Ponte Sobre Implante'),
('CO101', 'Apicectomia de Molares - Com obturação retrograda'),
('CO102', 'Osteoplastia Zigomático - Maxilar'),
('PE009', 'Remoção  de Fatores de Retenção'),
('PE028', 'Manutenção do Tratamento Cirúrgico'),
('PE029', 'Aumento de Coroa Clínica (por elemento)'),
('PE030', 'Tratamento Regenerativo com uso de Barreia'),
('IM009', 'Guia Cirúrgico para Cirurgia de Implante Unitário ou Múltiplos');


# ############################

#
# Estrutura da tabela `honorarios_convenios`
#

CREATE TABLE IF NOT EXISTS `honorarios_convenios` (
  `codigo_convenio` int(11) NOT NULL,
  `codigo_procedimento` varchar(10) NOT NULL,
  `valor` float NOT NULL,
  PRIMARY KEY (`codigo_convenio`,`codigo_procedimento`)
) ENGINE=MyISAM;

INSERT INTO `honorarios_convenios` (`codigo_convenio`, `codigo_procedimento`, `valor`) VALUES
(1, 'EX001', 61),
(1, 'EX002', 116),
(1, 'EX003', 45),
(1, 'EX004', 49),
(1, 'DE001', 52),
(1, 'DE002', 66),
(1, 'DE003', 77),
(1, 'DE005', 100),
(1, 'DE004', 77.5),
(1, 'DE006', 63),
(1, 'DE007', 66),
(1, 'DE009', 100),
(1, 'DE010', 110),
(1, 'DE011', 63),
(1, 'DE012', 80),
(1, 'DE014', 80),
(1, 'DE016', 171),
(1, 'DE017', 40),
(1, 'DE018', 426),
(1, 'DE019', 268),
(1, 'DE020', 219),
(1, 'DE021', 46),
(1, 'EN002', 220),
(1, 'EN003', 350),
(1, 'EN004', 203),
(1, 'EN005', 270),
(1, 'EN001', 188),
(1, 'DE022', 189),
(1, 'OD001', 35.26),
(1, 'OD002', 35),
(1, 'OD003', 42),
(1, 'OD004', 32),
(1, 'DE015', 64),
(1, 'DE008', 94),
(1, 'DE013', 450),
(1, 'EN006', 470),
(1, 'EN008', 114),
(1, 'EN009', 68),
(1, 'EN010', 79),
(1, 'EN011', 189),
(1, 'EN012', 52),
(1, 'EN014', 83),
(1, 'EN015', 177),
(1, 'EN016', 202),
(1, 'EN013', 78),
(1, 'EN007', 130),
(1, 'EN017', 209),
(1, 'EN018', 236),
(1, 'EN019', 242),
(1, 'EN020', 269),
(1, 'EN021', 89),
(1, 'EN022', 102),
(1, 'EN023', 34),
(1, 'EN024', 46),
(1, 'OD005', 35),
(1, 'OD006', 66),
(1, 'OD007', 65),
(1, 'OD008', 59),
(1, 'OD009', 60),
(1, 'OD011', 78),
(1, 'OD012', 142),
(1, 'OD013', 44),
(1, 'OD014', 208),
(1, 'OD015', 174),
(1, 'OD017', 47),
(1, 'OD018', 72),
(1, 'OD019', 78),
(1, 'OD020', 46),
(1, 'OD010', 125),
(1, 'OD016', 176),
(1, 'PE001', 67),
(1, 'PE002', 78),
(1, 'PE003', 90),
(1, 'PE004', 80),
(1, 'PE005', 32),
(1, 'PE006', 40),
(1, 'PE007', 111),
(1, 'PE008', 64),
(1, 'PE010', 177),
(1, 'PE011', 61),
(1, 'PE012', 140),
(1, 'PE013', 150),
(1, 'PE014', 148),
(1, 'PE015', 139),
(1, 'PE016', 154),
(1, 'PE017', 147),
(1, 'PE018', 175),
(1, 'PE019', 175),
(1, 'PE020', 126),
(1, 'PE021', 143),
(1, 'PE022', 179),
(1, 'PE023', 205),
(1, 'PE025', 159),
(1, 'PE026', 159),
(1, 'PE027', 159),
(1, 'PR001', 56),
(1, 'PR002', 80),
(1, 'PR003', 40),
(1, 'PR004', 40),
(1, 'PR005', 32),
(1, 'PR006', 74),
(1, 'TE001', 40),
(1, 'TE002', 40),
(1, 'TE003', 40),
(1, 'TE004', 40),
(1, 'TE005', 230),
(1, 'TE006', 200),
(1, 'RA001', 7),
(1, 'RA002', 7),
(1, 'RA003', 13),
(1, 'RA004', 23),
(1, 'RA005', 50),
(1, 'RA006', 23),
(1, 'RA008', 23),
(1, 'RA009', 23),
(1, 'PO023', 189),
(1, 'PO001', 85),
(1, 'PO002', 92),
(1, 'PO003', 64),
(1, 'PO004', 219),
(1, 'PO005', 440),
(1, 'PO006', 39),
(1, 'PO007', 50),
(1, 'PO008', 154),
(1, 'PO009', 86),
(1, 'PO010', 176),
(1, 'PO011', 34),
(1, 'PO012', 215),
(1, 'PO013', 508),
(1, 'PO014', 448),
(1, 'PO016', 363),
(1, 'PO017', 256),
(1, 'PO018', 252),
(1, 'PO019', 441),
(1, 'PO020', 602),
(1, 'PO021', 459),
(1, 'PO025', 578),
(1, 'PO024', 808),
(1, 'PO026', 427),
(1, 'PO027', 751),
(1, 'PO028', 1013),
(1, 'PO029', 432),
(1, 'PO030', 432),
(1, 'PO031', 221),
(1, 'PO032', 962),
(1, 'PO033', 1205),
(1, 'PO034', 618),
(1, 'PO035', 71),
(1, 'PO036', 151),
(1, 'PO037', 215),
(1, 'PO038', 170),
(1, 'PO040', 84),
(1, 'PO041', 127),
(1, 'PO042', 61),
(1, 'PO043', 189),
(1, 'PO044', 268),
(1, 'PO045', 426),
(1, 'PO046', 430),
(1, 'PO047', 580),
(1, 'PO048', 46),
(1, 'OR001', 368),
(1, 'OR002', 580),
(1, 'OR003', 120),
(1, 'OR004', 190),
(1, 'OR005', 247),
(1, 'OR006', 217),
(1, 'OR007', 225),
(1, 'OR008', 223),
(1, 'OR009', 136),
(1, 'OR010', 225),
(1, 'OR011', 225),
(1, 'OR012', 254),
(1, 'OR013', 280),
(1, 'OR014', 251),
(1, 'OR015', 378),
(1, 'OR016', 209),
(1, 'OR017', 114),
(1, 'OR018', 258),
(1, 'OR019', 221),
(1, 'OR020', 291),
(1, 'OR021', 291),
(1, 'OR022', 291),
(1, 'OR023', 286),
(1, 'OR024', 237),
(1, 'OR025', 274),
(1, 'OR027', 264),
(1, 'OR028', 160),
(1, 'OR029', 180),
(1, 'OR030', 149),
(1, 'OR031', 222),
(1, 'OR026', 286),
(1, 'CO001', 77),
(1, 'CO002', 100),
(1, 'CO003', 78),
(1, 'CO004', 106),
(1, 'CO006', 230),
(1, 'CO005', 71),
(1, 'CO007', 117),
(1, 'CO008', 138),
(1, 'CO009', 111),
(1, 'CO010', 168),
(1, 'CO011', 177),
(1, 'CO012', 202),
(1, 'CO013', 209),
(1, 'CO014', 236),
(1, 'CO015', 242),
(1, 'CO017', 126),
(1, 'CO018', 188),
(1, 'CO019', 188),
(1, 'CO020', 210),
(1, 'CO021', 243),
(1, 'CO022', 232),
(1, 'CO023', 188),
(1, 'CO024', 424),
(1, 'CO025', 688),
(1, 'CO026', 562.19),
(1, 'CO027', 457),
(1, 'CO028', 424),
(1, 'CO029', 172),
(1, 'CO030', 117),
(1, 'CO031', 63),
(1, 'CO032', 78),
(1, 'CO033', 193),
(1, 'CO034', 359),
(1, 'CO035', 433),
(1, 'CO036', 337),
(1, 'CO037', 337),
(1, 'CO038', 484),
(1, 'CO039', 330),
(1, 'CO040', 550),
(1, 'CO041', 411),
(1, 'CO042', 448),
(1, 'CO043', 73),
(1, 'CO044', 91.2),
(1, 'CO045', 440),
(1, 'CO047', 765),
(1, 'CO046', 765),
(1, 'CO048', 765),
(1, 'CO049', 550),
(1, 'CO050', 789),
(1, 'CO051', 936),
(1, 'CO052', 1138),
(1, 'CO053', 716),
(1, 'CO054', 152),
(1, 'CO055', 156),
(1, 'CO056', 264),
(1, 'CO057', 440),
(1, 'CO058', 440),
(1, 'CO059', 205),
(1, 'CO060', 477),
(1, 'CO061', 249),
(1, 'CO062', 789),
(1, 'CO063', 703),
(1, 'CO064', 455),
(1, 'CO065', 132),
(1, 'CO066', 73),
(1, 'CO067', 117),
(1, 'CO068', 356),
(1, 'CO069', 356),
(1, 'CO070', 411),
(1, 'CO071', 550),
(1, 'CO072', 765),
(1, 'CO074', 411),
(1, 'CO073', 765),
(1, 'CO075', 1138),
(1, 'CO077', 337),
(1, 'CO078', 440),
(1, 'CO079', 44),
(1, 'CO080', 41),
(1, 'CO081', 41),
(1, 'CO082', 108),
(1, 'CO083', 752),
(1, 'CO084', 514),
(1, 'CO085', 624),
(1, 'CO086', 587),
(1, 'CO087', 716),
(1, 'CO088', 789),
(1, 'CO089', 1138),
(1, 'CO090', 936),
(1, 'CO091', 862),
(1, 'CO092', 789),
(1, 'CO093', 936),
(1, 'CO094', 466),
(1, 'CO095', 826),
(1, 'CO096', 991),
(1, 'IM001', 850),
(1, 'IM002', 120),
(1, 'IM003', 530),
(1, 'IM004', 720),
(1, 'IM005', 430),
(1, 'IM006', 240),
(1, 'IM007', 320),
(1, 'OR032', 140),
(1, 'DE023', 490),
(1, 'EX005', 70),
(1, 'OR033', 850),
(1, 'CO097', 132),
(1, 'CO098', 700),
(1, 'CO099', 420),
(1, 'CO100', 188),
(1, 'EN025', 400),
(1, 'EN026', 450),
(1, 'IM008', 600),
(1, 'CO101', 269),
(1, 'CO102', 441),
(1, 'PE009', 62),
(1, 'PE028', 65),
(1, 'PE029', 132),
(1, 'PE030', 445),
(1, 'IM009', 215),
(2, 'EX001', 0),
(2, 'EX002', 45),
(2, 'EX003', 0),
(2, 'EX004', 30),
(2, 'DE001', 35),
(2, 'DE002', 40),
(2, 'DE003', 45),
(2, 'DE005', 60),
(2, 'DE004', 50),
(2, 'DE006', 40),
(2, 'DE007', 50),
(2, 'DE009', 65),
(2, 'DE010', 85),
(2, 'DE011', 35),
(2, 'DE012', 40),
(2, 'DE014', 45),
(2, 'DE016', 70),
(2, 'DE017', 35),
(2, 'DE018', 250),
(2, 'DE019', 150),
(2, 'DE020', 140),
(2, 'DE021', 35),
(2, 'EN002', 180),
(2, 'EN003', 260),
(2, 'EN004', 160),
(2, 'EN005', 210),
(2, 'EN001', 140),
(2, 'DE022', 110),
(2, 'OD001', 30),
(2, 'OD002', 30),
(2, 'OD003', 35),
(2, 'OD004', 20),
(2, 'DE015', 45),
(2, 'DE008', 55),
(2, 'DE013', 360),
(2, 'EN006', 320),
(2, 'EN008', 70),
(2, 'EN009', 35),
(2, 'EN010', 40),
(2, 'EN011', 110),
(2, 'EN012', 35),
(2, 'EN014', 35),
(2, 'EN015', 140),
(2, 'EN016', 180),
(2, 'EN013', 40),
(2, 'EN007', 70),
(2, 'EN017', 155),
(2, 'EN018', 170),
(2, 'EN019', 190),
(2, 'EN020', 220),
(2, 'EN021', 40),
(2, 'EN022', 40),
(2, 'EN023', 20),
(2, 'EN024', 30),
(2, 'OD005', 30),
(2, 'OD006', 35),
(2, 'OD007', 30),
(2, 'OD008', 35),
(2, 'OD009', 35),
(2, 'OD011', 40),
(2, 'OD012', 90),
(2, 'OD013', 30),
(2, 'OD014', 80),
(2, 'OD015', 70),
(2, 'OD017', 30),
(2, 'OD018', 35),
(2, 'OD019', 40),
(2, 'OD020', 35),
(2, 'OD010', 60),
(2, 'OD016', 80),
(2, 'PE001', 40),
(2, 'PE002', 45),
(2, 'PE003', 50),
(2, 'PE004', 40),
(2, 'PE005', 20),
(2, 'PE006', 25),
(2, 'PE007', 60),
(2, 'PE008', 45),
(2, 'PE010', 120),
(2, 'PE011', 30),
(2, 'PE012', 70),
(2, 'PE013', 100),
(2, 'PE014', 100),
(2, 'PE015', 80),
(2, 'PE016', 80),
(2, 'PE017', 90),
(2, 'PE018', 100),
(2, 'PE019', 100),
(2, 'PE020', 90),
(2, 'PE021', 80),
(2, 'PE022', 110),
(2, 'PE023', 140),
(2, 'PE025', 80),
(2, 'PE026', 80),
(2, 'PE027', 80),
(2, 'PR001', 40),
(2, 'PR002', 40),
(2, 'PR003', 30),
(2, 'PR004', 30),
(2, 'PR005', 15),
(2, 'PR006', 40),
(2, 'TE001', 30),
(2, 'TE002', 30),
(2, 'TE003', 30),
(2, 'TE004', 30),
(2, 'TE005', 110),
(2, 'TE006', 90),
(2, 'RA001', 5),
(2, 'RA002', 5),
(2, 'RA003', 10),
(2, 'RA004', 20),
(2, 'RA005', 40),
(2, 'RA006', 20),
(2, 'RA008', 20),
(2, 'RA009', 20),
(2, 'PO023', 100),
(2, 'PO001', 40),
(2, 'PO002', 50),
(2, 'PO003', 45),
(2, 'PO004', 140),
(2, 'PO005', 400),
(2, 'PO006', 20),
(2, 'PO007', 35),
(2, 'PO008', 70),
(2, 'PO009', 45),
(2, 'PO010', 90),
(2, 'PO011', 20),
(2, 'PO012', 100),
(2, 'PO013', 410),
(2, 'PO014', 350),
(2, 'PO016', 170),
(2, 'PO017', 150),
(2, 'PO018', 150),
(2, 'PO019', 400),
(2, 'PO020', 350),
(2, 'PO021', 200),
(2, 'PO025', 310),
(2, 'PO024', 630),
(2, 'PO026', 180),
(2, 'PO027', 360),
(2, 'PO028', 650),
(2, 'PO029', 290),
(2, 'PO030', 290),
(2, 'PO031', 110),
(2, 'PO032', 290),
(2, 'PO033', 350),
(2, 'PO034', 230),
(2, 'PO035', 40),
(2, 'PO036', 90),
(2, 'PO037', 120),
(2, 'PO038', 140),
(2, 'PO040', 50),
(2, 'PO041', 45),
(2, 'PO042', 40),
(2, 'PO043', 110),
(2, 'PO044', 150),
(2, 'PO045', 250),
(2, 'PO046', 250),
(2, 'PO047', 450),
(2, 'PO048', 35),
(2, 'OR001', 0),
(2, 'OR002', 300),
(2, 'OR003', 77),
(2, 'OR004', 120),
(2, 'OR005', 130),
(2, 'OR006', 120),
(2, 'OR007', 120),
(2, 'OR008', 120),
(2, 'OR009', 80),
(2, 'OR010', 120),
(2, 'OR011', 120),
(2, 'OR012', 120),
(2, 'OR013', 120),
(2, 'OR014', 120),
(2, 'OR015', 180),
(2, 'OR016', 120),
(2, 'OR017', 70),
(2, 'OR018', 120),
(2, 'OR019', 120),
(2, 'OR020', 120),
(2, 'OR021', 120),
(2, 'OR022', 120),
(2, 'OR023', 120),
(2, 'OR024', 120),
(2, 'OR025', 120),
(2, 'OR027', 120),
(2, 'OR028', 120),
(2, 'OR029', 130),
(2, 'OR030', 80),
(2, 'OR031', 100),
(2, 'OR026', 120),
(2, 'CO001', 30),
(2, 'CO002', 45),
(2, 'CO003', 35),
(2, 'CO004', 65),
(2, 'CO006', 110),
(2, 'CO005', 30),
(2, 'CO007', 60),
(2, 'CO008', 80),
(2, 'CO009', 100),
(2, 'CO010', 130),
(2, 'CO011', 140),
(2, 'CO012', 180),
(2, 'CO013', 155),
(2, 'CO014', 170),
(2, 'CO015', 190),
(2, 'CO017', 90),
(2, 'CO018', 100),
(2, 'CO019', 120),
(2, 'CO020', 150),
(2, 'CO021', 190),
(2, 'CO022', 190),
(2, 'CO023', 140),
(2, 'CO024', 350),
(2, 'CO025', 510),
(2, 'CO026', 400),
(2, 'CO027', 360),
(2, 'CO028', 310),
(2, 'CO029', 110),
(2, 'CO030', 90),
(2, 'CO031', 35),
(2, 'CO032', 35),
(2, 'CO033', 180),
(2, 'CO034', 240),
(2, 'CO035', 310),
(2, 'CO036', 250),
(2, 'CO037', 250),
(2, 'CO038', 400),
(2, 'CO039', 250),
(2, 'CO040', 410),
(2, 'CO041', 350),
(2, 'CO042', 300),
(2, 'CO043', 45),
(2, 'CO044', 60),
(2, 'CO045', 320),
(2, 'CO047', 600),
(2, 'CO046', 600),
(2, 'CO048', 600),
(2, 'CO049', 400),
(2, 'CO050', 610),
(2, 'CO051', 710),
(2, 'CO052', 930),
(2, 'CO053', 545),
(2, 'CO054', 110),
(2, 'CO055', 115),
(2, 'CO056', 195),
(2, 'CO057', 360),
(2, 'CO058', 350),
(2, 'CO059', 130),
(2, 'CO060', 340),
(2, 'CO061', 190),
(2, 'CO062', 410),
(2, 'CO063', 520),
(2, 'CO064', 320),
(2, 'CO065', 110),
(2, 'CO066', 45),
(2, 'CO067', 60),
(2, 'CO068', 300),
(2, 'CO069', 300),
(2, 'CO070', 310),
(2, 'CO071', 450),
(2, 'CO072', 500),
(2, 'CO074', 300),
(2, 'CO073', 510),
(2, 'CO075', 800),
(2, 'CO077', 250),
(2, 'CO078', 320),
(2, 'CO079', 35),
(2, 'CO080', 35),
(2, 'CO081', 35),
(2, 'CO082', 100),
(2, 'CO083', 550),
(2, 'CO084', 400),
(2, 'CO085', 490),
(2, 'CO086', 430),
(2, 'CO087', 510),
(2, 'CO088', 590),
(2, 'CO089', 900),
(2, 'CO090', 705),
(2, 'CO091', 650),
(2, 'CO092', 600),
(2, 'CO093', 710),
(2, 'CO094', 300),
(2, 'CO095', 600),
(2, 'CO096', 735),
(2, 'IM001', 600),
(2, 'IM002', 60),
(2, 'IM003', 420),
(2, 'IM004', 530),
(2, 'IM005', 350),
(2, 'IM006', 130),
(2, 'IM007', 250),
(2, 'OR032', 105),
(2, 'DE023', 300),
(2, 'EX005', 35),
(2, 'OR033', 600),
(2, 'CO097', 80),
(2, 'CO098', 500),
(2, 'CO099', 210),
(2, 'CO100', 100),
(2, 'EN025', 290),
(2, 'EN026', 350),
(2, 'IM008', 430),
(2, 'CO101', 220),
(2, 'CO102', 310),
(2, 'PE009', 30),
(2, 'PE028', 35),
(2, 'PE029', 80),
(2, 'PE030', 300),
(2, 'IM009', 120);

# ############################

#
# Estrutura da tabela `implantodontia`
#

CREATE TABLE IF NOT EXISTS `implantodontia` (
  `codigo_paciente` int(10) NOT NULL,
  `tratamento` enum('Sim','Não') default NULL,
  `regioes` varchar(200) default NULL,
  `expectativa` varchar(200) default NULL,
  `areas` varchar(200) default NULL,
  `marca` varchar(200) default NULL,
  `enxerto` enum('Sim','Não') default NULL,
  `tipoenxerto` varchar(200) default NULL,
  `observacoes` text default NULL,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `inquerito`
#

CREATE TABLE IF NOT EXISTS `inquerito` (
  `codigo_paciente` int(10) NOT NULL,
  `tratamento` enum('Sim','Não') default NULL,
  `motivotrat` varchar(150) default NULL,
  `hospitalizado` enum('Sim','Não') default NULL,
  `motivohosp` varchar(150) default NULL,
  `cardiovasculares` enum('Sim','Não') default NULL,
  `sanguineo` enum('Sim','Não') default NULL,
  `reumatico` enum('Sim','Não') default NULL,
  `respiratorio` enum('Sim','Não') default NULL,
  `qualresp` varchar(150) default NULL,
  `gastro` enum('Sim','Não') default NULL,
  `qualgastro` varchar(150) default NULL,
  `renal` enum('Sim','Não') default NULL,
  `diabetico` enum('Sim','Não') default NULL,
  `contagiosa` enum('Sim','Não') default NULL,
  `qualcont` varchar(150) default NULL,
  `anestesia` enum('Sim','Não') default NULL,
  `complicacoesanest` varchar(150) default NULL,
  `alergico` enum('Sim','Não') default NULL,
  `qualalergico` varchar(150) default NULL,
  `observacoes` text,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `laboratorios`
#

CREATE TABLE IF NOT EXISTS `laboratorios` (
  `codigo` int(15) NOT NULL auto_increment,
  `nomefantasia` varchar(80) default NULL,
  `cpf` varchar(50) NOT NULL default '',
  `razaosocial` varchar(80) default NULL,
  `atuacao` varchar(80) default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(40) default NULL,
  `cidade` varchar(40) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `celular` varchar(15) default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `inscricaoestadual` varchar(40) default NULL,
  `website` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `nomerepresentante` varchar(80) default NULL,
  `apelidorepresentante` varchar(50) default NULL,
  `emailrepresentante` varchar(100) default NULL,
  `celularrepresentante` varchar(15) default NULL,
  `telefone1representante` varchar(15) default NULL,
  `telefone2representante` varchar(15) default NULL,
  `banco` varchar(50) default NULL,
  `agencia` varchar(15) default NULL,
  `conta` varchar(15) default NULL,
  `favorecido` varchar(50) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `laboratorios_procedimentos`
#

CREATE TABLE IF NOT EXISTS laboratorios_procedimentos (
  codigo int NOT NULL auto_increment,
  codigo_laboratorio int NOT NULL,
  codigo_paciente int NOT NULL,
  codigo_dentista int NOT NULL,
  procedimento TEXT NOT NULL,
  datahora DATETIME NOT NULL,
  PRIMARY KEY (codigo)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `laboratorios_procedimentos_status`
#

CREATE TABLE IF NOT EXISTS laboratorios_procedimentos_status (
  codigo int NOT NULL auto_increment,
  codigo_procedimento int NOT NULL,
  `status` TEXT NOT NULL,
  datahora DATETIME NOT NULL,
  PRIMARY KEY (codigo)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `laudos`
#

CREATE TABLE `laudos` (
  `laudo` TEXT NULL DEFAULT NULL ,
  `codigo_paciente` INT NOT NULL ,
  PRIMARY KEY ( `codigo_paciente` )
) ENGINE = MYISAM;

# ############################

#
# Estrutura da tabela `odontograma`
#

CREATE TABLE `odontograma` (
  `codigo_paciente` INT NOT NULL ,
  `dente` INT(2) NULL DEFAULT NULL ,
  `descricao` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY ( `codigo_paciente` , `dente` )
) ENGINE = MYISAM;

# ############################

#
# Estrutura da tabela `orcamento`
#

CREATE TABLE IF NOT EXISTS `orcamento` (
  `codigo` int(10) NOT NULL auto_increment,
  `codigo_paciente` int(10) NOT NULL,
  `data` date default NULL,
  `formapagamento` enum('À vista','Cheque pré-datado','Promissória','Desconto em folha','Cartão') default NULL,
  `aserpago` enum('Particular','Convênio') default NULL,
  `valortotal` float default NULL,
  `parcelas` enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20') default NULL,
  `desconto` float default NULL,
  `codigo_dentista` varchar(11) default NULL,
  `confirmado` enum('Sim','Não') NOT NULL default 'Não',
  `entrada` float default '0',
  `entrada_tipo` enum('R$','%') NOT NULL default 'R$',
  `baixa` enum('Sim','Não') NOT NULL default 'Não',
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `ortodontia`
#

CREATE TABLE IF NOT EXISTS `ortodontia` (
  `codigo_paciente` int(10) NOT NULL,
  `tratamento` enum('Sim','Não') default NULL,
  `previsao` varchar(200) default NULL,
  `razoes` varchar(200) default NULL,
  `motivacao` varchar(200) default NULL,
  `perfil` varchar(200) default NULL,
  `simetria` varchar(200) default NULL,
  `tipologia` varchar(200) default NULL,
  `classe` varchar(200) default NULL,
  `mordida` varchar(200) default NULL,
  `spee` varchar(200) default NULL,
  `overbite` varchar(200) default NULL,
  `overjet` varchar(200) default NULL,
  `media` varchar(200) default NULL,
  `atm` varchar(200) default NULL,
  `radio` text default NULL,
  `modelo` text default NULL,
  `observacoes` text default NULL,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `pacientes`
#

CREATE TABLE IF NOT EXISTS `pacientes` (
  `codigo` int(10) NOT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `cpf` varchar(50) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `estadocivil` enum('solteiro','casado','divorciado','viuvo') DEFAULT NULL,
  `sexo` enum('Masculino','Feminino') DEFAULT NULL,
  `etnia` enum('africano','asiatico','caucasiano','latino','orientemedio','multietnico') DEFAULT NULL,
  `profissao` varchar(80) DEFAULT NULL,
  `naturalidade` varchar(80) DEFAULT NULL,
  `nacionalidade` varchar(80) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `bairro` varchar(40) DEFAULT NULL,
  `cidade` varchar(40) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `falecido` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `cep` varchar(9) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `telefone1` varchar(15) DEFAULT NULL,
  `telefone2` varchar(15) DEFAULT NULL,
  `hobby` varchar(250) DEFAULT NULL,
  `indicadopor` varchar(80) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `obs_etiqueta` varchar(90) DEFAULT NULL,
  `tratamento` set('Ortodontia','Implantodontia','Dentística','Prótese','Odontopediatria','Cirurgia','Endodontia','Periodontia','Radiologia','DTM','Odontogeriatria','Ortopedia') DEFAULT NULL,
  `codigo_dentistaprocurado` int(11) NOT NULL,
  `codigo_dentistaatendido` int(11) NOT NULL,
  `codigo_dentistaencaminhado` int(11) NOT NULL,
  `nomemae` varchar(80) DEFAULT NULL,
  `nascimentomae` date DEFAULT NULL,
  `profissaomae` varchar(150) DEFAULT NULL,
  `nomepai` varchar(80) DEFAULT NULL,
  `nascimentopai` date DEFAULT NULL,
  `profissaopai` varchar(150) DEFAULT NULL,
  `telefone1pais` varchar(15) DEFAULT NULL,
  `telefone2pais` varchar(15) DEFAULT NULL,
  `enderecofamiliar` varchar(150) DEFAULT NULL,
  `datacadastro` date DEFAULT NULL,
  `dataatualizacao` date DEFAULT NULL,
  `status` enum('Avaliação','Em tratamento','Concluído','Em revisão') DEFAULT NULL,
  `objetivo` text,
  `observacoes` text,
  `codigo_convenio` int(11) NOT NULL,
  `outros` varchar(100) DEFAULT NULL,
  `matricula` varchar(20) DEFAULT NULL,
  `titular` varchar(80) DEFAULT NULL,
  `validadeconvenio` varchar(25) DEFAULT NULL,
  `foto` blob,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `parcelas_orcamento`
#

CREATE TABLE IF NOT EXISTS `parcelas_orcamento` (
  `codigo` int(100) NOT NULL auto_increment,
  `codigo_orcamento` int(10) NOT NULL,
  `datavencimento` date default NULL,
  `valor` float default NULL,
  `pago` enum('Sim','Não') NOT NULL default 'Não',
  `datapgto` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `patrimonio`
#

CREATE TABLE IF NOT EXISTS `patrimonio` (
  `codigo` int(10) NOT NULL auto_increment,
  `setor` varchar(40) default NULL,
  `descricao` varchar(150) default NULL,
  `valor` float default NULL,
  `dataaquisicao` date default NULL,
  `tempogarantia` varchar(30) default NULL,
  `cor` varchar(30) default NULL,
  `quantidade` varchar(20) default NULL,
  `fornecedor` varchar(50) default NULL,
  `numeronotafiscal` varchar(30) default NULL,
  `dimensoes` varchar(30) default NULL,
  `observacoes` text,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `permissoes`
#

CREATE TABLE IF NOT EXISTS `permissoes` (
  `nivel` varchar(30) NOT NULL,
  `area` enum('profissionais','pacientes','funcionarios','fornecedores','agenda','patrimonio','estoque','laboratorios','convenios','honorarios','contas_pagar','contas_receber','caixa','cheques','pagamentos','arquivos_clinica','manuais','contatos','backup_gerar','backup_restaurar','informacoes','idiomas') NOT NULL DEFAULT 'profissionais',
  `permissao` set('L','V','E','I','A') NOT NULL,
  PRIMARY KEY (`nivel`,`area`)
) ENGINE=MyISAM;

INSERT INTO permissoes VALUES
  ('Dentista', 'profissionais', 'L,V'),
  ('Dentista', 'pacientes', 'L,V,E,I,A'),
  ('Dentista', 'funcionarios', 'L,V'),
  ('Dentista', 'fornecedores', 'L,V,I,A'),
  ('Dentista', 'agenda', 'L,E'),
  ('Dentista', 'patrimonio', ''),
  ('Dentista', 'estoque', 'L,V,E,I,A'),
  ('Dentista', 'laboratorios', 'L,V,E,I'),
  ('Dentista', 'convenios', 'L,V'),
  ('Dentista', 'honorarios', 'L,V'),
  ('Dentista', 'contas_pagar', 'L,V,E,I,A'),
  ('Dentista', 'contas_receber', 'L,V,E,I,A'),
  ('Dentista', 'caixa', 'L,V,E,I,A'),
  ('Dentista', 'cheques', 'L,V,E,I,A'),
  ('Dentista', 'pagamentos', 'L'),
  ('Dentista', 'arquivos_clinica', 'L'),
  ('Dentista', 'manuais', 'L'),
  ('Dentista', 'contatos', 'L,V,I'),
  ('Dentista', 'backup_gerar', 'L'),
  ('Dentista', 'backup_restaurar', 'L'),
  ('Dentista', 'informacoes', 'V'),
  ('Dentista', 'idiomas', 'V'),
  ('Funcionario', 'profissionais', 'L,V'),
  ('Funcionario', 'pacientes', 'L,V,E,I,A'),
  ('Funcionario', 'funcionarios', 'L,V'),
  ('Funcionario', 'fornecedores', 'L,V,E,I'),
  ('Funcionario', 'agenda', ''),
  ('Funcionario', 'patrimonio', ''),
  ('Funcionario', 'estoque', 'L,V,E,I,A'),
  ('Funcionario', 'laboratorios', 'L,V,E,I'),
  ('Funcionario', 'convenios', 'L,V'),
  ('Funcionario', 'honorarios', 'L,V'),
  ('Funcionario', 'contas_pagar', ''),
  ('Funcionario', 'contas_receber', ''),
  ('Funcionario', 'caixa', ''),
  ('Funcionario', 'cheques', ''),
  ('Funcionario', 'pagamentos', 'L'),
  ('Funcionario', 'arquivos_clinica', 'L'),
  ('Funcionario', 'manuais', 'L'),
  ('Funcionario', 'contatos', 'L,V,I'),
  ('Funcionario', 'backup_gerar', 'L'),
  ('Funcionario', 'backup_restaurar', ''),
  ('Funcionario', 'informacoes', 'V'),
  ('Funcionario', 'idiomas', 'V');

# ############################

#
# Estrutura da tabela `procedimentos_orcamento`
#

CREATE TABLE IF NOT EXISTS `procedimentos_orcamento` (
  `codigo` int(10) NOT NULL auto_increment,
  `codigo_orcamento` int(10) NOT NULL,
  `codigoprocedimento` varchar(10) default NULL,
  `dente` varchar(15) default NULL,
  `descricao` varchar(150) default NULL,
  `particular` float default NULL,
  `convenio` float default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `radiografias`
#

CREATE TABLE IF NOT EXISTS `radiografias` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_paciente` int(11) NOT NULL,
  `foto` longblob NOT NULL,
  `legenda` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `modelo` enum('Panoramica','Oclusal','Periapical','Interproximal','ATM','PA','AP','Lateral') NOT NULL,
  `diagnostico` text NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `receitas`
#

CREATE TABLE IF NOT EXISTS `receitas` (
  `receita` longtext,
  `codigo_paciente` int(11) NOT NULL,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `telefones`
#

CREATE TABLE IF NOT EXISTS `telefones` (
  `codigo` int(10) NOT NULL auto_increment,
  `nome` varchar(80) default NULL,
  `endereco` varchar(50) default NULL,
  `bairro` varchar(50) default NULL,
  `cidade` varchar(50) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `celular` varchar(15) default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `email` varchar(150) default NULL,
  `website` varchar(150) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura para visualizar `v_agenda`
#

CREATE VIEW v_agenda AS ( SELECT tp.codigo AS codigo_paciente, ta.data AS data, ta.hora AS hora, ta.descricao AS descricao, ta.procedimento AS procedimento, ta.faltou AS faltou, td.nome AS nome_dentista, td.sexo AS sexo_dentista FROM agenda ta INNER JOIN pacientes tp ON tp.codigo = ta.codigo_paciente INNER JOIN dentistas td ON td.codigo = ta.codigo_dentista );

# ############################

#
# Estrutura para visualizar `v_evolucao`
#

CREATE VIEW v_evolucao AS ( SELECT tp.codigo AS codigo_paciente, tp.nome AS paciente, td.sexo AS sexo_dentista, td.nome AS dentista, te.procexecutado AS executado, te.procprevisto AS previsto, te.data AS data FROM evolucao te INNER JOIN dentistas td ON te.codigo_dentista = td.codigo INNER JOIN pacientes tp ON te.codigo_paciente = tp.codigo );

# ############################

#
# Estrutura para visualizar `v_orcamento`
#

CREATE VIEW v_orcamento AS ( SELECT tpo.codigo_orcamento AS codigo_orcamento, tor.parcelas AS parcelas, tor.confirmado AS confirmado, tor.baixa AS baixa, tpo.codigo AS codigo_parcela, tpo.datavencimento AS data, tpo.valor AS valor, tpo.pago AS pago, tpo.datapgto AS datapgto, tp.codigo AS codigo_paciente, tp.nome AS paciente, td.nome AS dentista, td.sexo AS sexo_dentista FROM parcelas_orcamento tpo INNER JOIN orcamento tor ON tpo.codigo_orcamento = tor.codigo INNER JOIN pacientes tp ON tor.codigo_paciente = tp.codigo JOIN dentistas td ON tor.codigo_dentista = td.codigo );

