# 2.0

# 2.2

CREATE TABLE IF NOT EXISTS convenios (
  codigo int(15) NOT NULL auto_increment,
  nomefantasia varchar(80) default NULL,
  cpf varchar(50) NOT NULL default '',
  razaosocial varchar(80) default NULL,
  atuacao varchar(80) default NULL,
  endereco varchar(150) default NULL,
  bairro varchar(40) default NULL,
  cidade varchar(40) default NULL,
  estado varchar(50) default NULL,
  pais varchar(50) default NULL,
  cep varchar(9) default NULL,
  celular varchar(15) default NULL,
  telefone1 varchar(15) default NULL,
  telefone2 varchar(15) default NULL,
  inscricaoestadual varchar(40) default NULL,
  website varchar(100) default NULL,
  email varchar(100) default NULL,
  nomerepresentante varchar(80) default NULL,
  apelidorepresentante varchar(50) default NULL,
  emailrepresentante varchar(100) default NULL,
  celularrepresentante varchar(15) default NULL,
  telefone1representante varchar(15) default NULL,
  telefone2representante varchar(15) default NULL,
  banco varchar(50) default NULL,
  agencia varchar(15) default NULL,
  conta varchar(15) default NULL,
  favorecido varchar(50) default NULL,
  PRIMARY KEY  (codigo)
) ENGINE=MyISAM;

ALTER TABLE pacientes CHANGE convenio convenio varchar(50) default NULL;
CREATE TABLE IF NOT EXISTS dentistas_temp (
  codigo INT NOT NULL AUTO_INCREMENT,
  nome varchar(80) default NULL,
  cpf varchar(50) default NULL,
  usuario varchar(15) character set latin7 collate latin7_general_cs default NULL,
  senha varchar(32) default NULL,
  endereco varchar(150) default NULL,
  bairro varchar(50) default NULL,
  cidade varchar(50) default NULL,
  estado varchar(50) default NULL,
  pais varchar(50) default NULL,
  cep varchar(9) default NULL,
  nascimento date default NULL,
  telefone1 varchar(15) default NULL,
  celular varchar(15) default NULL,
  telefone2 varchar(15) default NULL,
  sexo enum('Masculino','Feminino') NOT NULL,
  nomemae varchar(80) default NULL,
  rg varchar(50) default NULL,
  email varchar(100) default NULL,
  comissao float default NULL,
  codigo_areaatuacao1 int(5) default NULL,
  codigo_areaatuacao2 int(5) default NULL,
  codigo_areaatuacao3 int(5) default NULL,
  conselho_tipo varchar(30) default NULL,
  conselho_estado varchar(30) default NULL,
  conselho_numero varchar(30) default NULL,
  ativo enum('Sim','Nï¿½o') default NULL,
  foto blob,
  PRIMARY KEY  (codigo)
) ENGINE=MyISAM;
INSERT INTO dentistas_temp (nome, cpf, usuario, senha, endereco, bairro, cidade, estado, cep, nascimento, telefone1, celular, telefone2,
  sexo, nomemae, rg, email, comissao, codigo_areaatuacao1, codigo_areaatuacao2, codigo_areaatuacao3, conselho_tipo, conselho_estado,
  conselho_numero, ativo, foto) SELECT * FROM dentistas;
DROP TABLE dentistas;
RENAME TABLE dentistas_temp TO dentistas;
UPDATE agenda SET cpf_dentista = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentista);
UPDATE agenda_obs SET cpf_dentista = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentista);
UPDATE caixa_dent SET cpf_dentista = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentista);
UPDATE cheques_dent SET cpf_dentista = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentista);
UPDATE contaspagar_dent SET cpf_dentista = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentista);
UPDATE contasreceber_dent SET cpf_dentista = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentista);
UPDATE estoque_dent SET cpf_dentista = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentista);
UPDATE evolucao SET cpf_dentista = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentista);
UPDATE pacientes SET cpf_dentistaprocurado = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentistaprocurado), cpf_dentistaatendido = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentistaatendido), cpf_dentistaencaminhado = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentistaencaminhado), convenio = (SELECT codigo FROM convenios WHERE nome = convenio);
UPDATE orcamento SET cpf_dentista = (SELECT codigo FROM dentistas WHERE cpf = cpf_dentista);
ALTER TABLE agenda CHANGE cpf_dentista codigo_dentista INT NOT NULL;
ALTER TABLE agenda_obs CHANGE cpf_dentista codigo_dentista INT NOT NULL;
ALTER TABLE caixa_dent CHANGE cpf_dentista codigo_dentista INT NOT NULL;
ALTER TABLE cheques_dent CHANGE cpf_dentista codigo_dentista INT NOT NULL;
ALTER TABLE contaspagar_dent CHANGE cpf_dentista codigo_dentista INT NOT NULL;
ALTER TABLE contasreceber_dent CHANGE cpf_dentista codigo_dentista INT NOT NULL;
ALTER TABLE estoque_dent CHANGE cpf_dentista codigo_dentista INT NOT NULL;
ALTER TABLE evolucao CHANGE cpf_dentista codigo_dentista INT NOT NULL;
ALTER TABLE pacientes CHANGE cpf_dentistaprocurado codigo_dentistaprocurado INT NOT NULL, CHANGE cpf_dentistaatendido codigo_dentistaatendido INT NOT NULL, CHANGE cpf_dentistaencaminhado codigo_dentistaencaminhado INT NOT NULL, ADD pais varchar(50) default NULL AFTER estado, CHANGE estado estado varchar(50) default NULL, CHANGE convenio codigo_convenio INT NOT NULL;
ALTER TABLE orcamento CHANGE cpf_dentista codigo_dentista INT NOT NULL;

ALTER TABLE dados_clinica CHANGE estado estado varchar(50) default NULL, ADD pais varchar(50) default NULL AFTER estado, ADD idioma varchar(50) default NULL AFTER conta2;
UPDATE dados_clinica SET idioma = 'pt_br';
ALTER TABLE fornecedores CHANGE estado estado varchar(50) default NULL, ADD pais varchar(50) default NULL AFTER estado, ADD observacoes text default NULL AFTER telefone2representante, CHANGE banco banco1 varchar(50) default NULL, CHANGE agencia agencia1 varchar(15) default NULL, CHANGE conta conta1 varchar(15) default NULL, CHANGE favorecido favorecido1 varchar(50) default NULL, ADD banco2 varchar(50) default NULL, ADD agencia2 varchar(15) default NULL, ADD conta2 varchar(15) default NULL, ADD favorecido2 varchar(50) default NULL;
ALTER TABLE telefones CHANGE estado estado varchar(50) default NULL, ADD pais varchar(50) default NULL AFTER estado;

ALTER TABLE pacientes CHANGE estadocivil estadocivil varchar(50) default NULL, CHANGE etnia etnia varchar(50) default NULL;
UPDATE pacientes SET estadocivil = 'solteiro' WHERE estadocivil = 'Solteiro(a)';
UPDATE pacientes SET estadocivil = 'casado' WHERE estadocivil = 'Casado(a)';
UPDATE pacientes SET estadocivil = 'divorciado' WHERE estadocivil = 'Separado(a)';
UPDATE pacientes SET estadocivil = 'divorciado' WHERE estadocivil = 'Divorciado(a)';
UPDATE pacientes SET estadocivil = 'casado' WHERE estadocivil = 'Amasiado(a)';
UPDATE pacientes SET estadocivil = 'viuvo' WHERE estadocivil = 'Viï¿½vo(a)';
UPDATE pacientes SET etnia = 'caucasiano' WHERE etnia = 'Branco';
UPDATE pacientes SET etnia = 'africano' WHERE etnia = 'Moreno';
UPDATE pacientes SET etnia = 'africano' WHERE etnia = 'Negro';
UPDATE pacientes SET etnia = 'multietnico' WHERE etnia = 'Pardo';
UPDATE pacientes SET etnia = 'asiatico' WHERE etnia = 'Amarelo';
ALTER TABLE pacientes CHANGE estadocivil estadocivil enum('solteiro','casado','divorciado','viuvo') default NULL, CHANGE etnia etnia enum('africano','asiatico','caucasiano','latino','orientemedio','multietnico') default NULL;

ALTER TABLE funcionarios CHANGE estadocivil estadocivil varchar(50) default NULL;
UPDATE funcionarios SET estadocivil = 'solteiro' WHERE estadocivil = 'Solteiro(a)';
UPDATE funcionarios SET estadocivil = 'casado' WHERE estadocivil = 'Casado(a)';
UPDATE funcionarios SET estadocivil = 'divorciado' WHERE estadocivil = 'Separado(a)';
UPDATE funcionarios SET estadocivil = 'divorciado' WHERE estadocivil = 'Divorciado(a)';
UPDATE funcionarios SET estadocivil = 'casado' WHERE estadocivil = 'Amasiado(a)';
UPDATE funcionarios SET estadocivil = 'viuvo' WHERE estadocivil = 'Viï¿½vo(a)';
ALTER TABLE funcionarios CHANGE estadocivil estadocivil enum('solteiro','casado','divorciado','viuvo') default NULL;

CREATE TABLE IF NOT EXISTS funcionarios_temp (
  codigo INT NOT NULL AUTO_INCREMENT,
  nome varchar(80) default NULL,
  cpf varchar(50) default NULL,
  usuario varchar(15) character set latin7 collate latin7_general_cs default NULL,
  senha varchar(32) default NULL,
  rg varchar(50) default NULL,
  estadocivil enum('Solteiro(a)','Casado(a)','Separado(a)','Divorciado(a)','Amasiado(a)','Viï¿½vo(a)') default NULL,
  endereco varchar(150) default NULL,
  bairro varchar(50) default NULL,
  cidade varchar(50) default NULL,
  estado varchar(50) default NULL,
  pais varchar(50) default NULL,
  cep varchar(9) default NULL,
  nascimento date default NULL,
  telefone1 varchar(15) default NULL,
  telefone2 varchar(15) default NULL,
  celular varchar(15) default NULL,
  sexo enum('Masculino','Feminino') default NULL,
  email varchar(100) default NULL,
  nomemae varchar(80) default NULL,
  nascimentomae date default NULL,
  nomepai varchar(80) default NULL,
  nascimentopai date default NULL,
  enderecofamiliar varchar(220) default NULL,
  funcao1 varchar(80) default NULL,
  funcao2 varchar(80) default NULL,
  admissao date default NULL,
  demissao date default NULL,
  observacoes text,
  ativo enum('Sim','Nï¿½o') default NULL,
  foto blob,
  PRIMARY KEY  (codigo)
) ENGINE=MyISAM;
INSERT INTO funcionarios_temp (nome, cpf, usuario, senha, rg, estadocivil, endereco, bairro, cidade, estado, cep, nascimento,
  telefone1, telefone2, celular, sexo, email, nomemae, nascimentomae, nomepai, nascimentopai, enderecofamiliar, funcao1, funcao2,
  admissao, demissao, observacoes, ativo, foto) SELECT * FROM funcionarios;
DROP TABLE funcionarios;
RENAME TABLE funcionarios_temp TO funcionarios;
DROP VIEW IF EXISTS v_agenda;
CREATE VIEW v_agenda AS ( SELECT tp.codigo AS codigo_paciente, ta.data AS data, ta.hora AS hora, ta.descricao AS descricao, ta.procedimento AS procedimento, ta.faltou AS faltou, td.nome AS nome_dentista, td.sexo AS sexo_dentista FROM agenda ta INNER JOIN pacientes tp ON tp.codigo = ta.codigo_paciente INNER JOIN dentistas td ON td.codigo = ta.codigo_dentista );
DROP VIEW IF EXISTS v_evolucao;
CREATE VIEW v_evolucao AS ( SELECT tp.codigo AS codigo_paciente, tp.nome AS paciente, td.sexo AS sexo_dentista, td.nome AS dentista, te.procexecutado AS executado, te.procprevisto AS previsto, te.data AS data FROM evolucao te INNER JOIN dentistas td ON te.codigo_dentista = td.codigo INNER JOIN pacientes tp ON te.codigo_paciente = tp.codigo );
DROP VIEW IF EXISTS v_orcamento;
CREATE VIEW v_orcamento AS ( SELECT tpo.codigo_orcamento AS codigo_orcamento, tor.parcelas AS parcelas, tor.confirmado AS confirmado, tor.baixa AS baixa, tpo.codigo AS codigo_parcela, tpo.datavencimento AS data, tpo.valor AS valor, tpo.pago AS pago, tpo.datapgto AS datapgto, tp.codigo AS codigo_paciente, tp.nome AS paciente, td.nome AS dentista, td.sexo AS sexo_dentista FROM parcelas_orcamento tpo INNER JOIN orcamento tor ON tpo.codigo_orcamento = tor.codigo INNER JOIN pacientes tp ON tor.codigo_paciente = tp.codigo JOIN dentistas td ON tor.codigo_dentista = td.codigo );

ALTER TABLE cheques ADD agencia VARCHAR( 20 ) NOT NULL AFTER banco;
ALTER TABLE cheques_dent ADD agencia VARCHAR( 20 ) NOT NULL AFTER banco;

ALTER TABLE pacientes CHANGE cpf cpf VARCHAR(50) NOT NULL, CHANGE rg rg VARCHAR(50) NOT NULL;
ALTER TABLE dados_clinica CHANGE cnpj cnpj VARCHAR(50) NOT NULL;
ALTER TABLE fornecedores CHANGE cpf cpf VARCHAR(50) NOT NULL;

CREATE TABLE IF NOT EXISTS laboratorios (
  codigo int(15) NOT NULL auto_increment,
  nomefantasia varchar(80) default NULL,
  cpf varchar(50) NOT NULL default '',
  razaosocial varchar(80) default NULL,
  atuacao varchar(80) default NULL,
  endereco varchar(150) default NULL,
  bairro varchar(40) default NULL,
  cidade varchar(40) default NULL,
  estado varchar(50) default NULL,
  pais varchar(50) default NULL,
  cep varchar(9) default NULL,
  celular varchar(15) default NULL,
  telefone1 varchar(15) default NULL,
  telefone2 varchar(15) default NULL,
  inscricaoestadual varchar(40) default NULL,
  website varchar(100) default NULL,
  email varchar(100) default NULL,
  nomerepresentante varchar(80) default NULL,
  apelidorepresentante varchar(50) default NULL,
  emailrepresentante varchar(100) default NULL,
  celularrepresentante varchar(15) default NULL,
  telefone1representante varchar(15) default NULL,
  telefone2representante varchar(15) default NULL,
  banco varchar(50) default NULL,
  agencia varchar(15) default NULL,
  conta varchar(15) default NULL,
  favorecido varchar(50) default NULL,
  PRIMARY KEY  (codigo)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS laboratorios_procedimentos (
  codigo int NOT NULL auto_increment,
  codigo_paciente int NOT NULL,
  codigo_dentista int NOT NULL,
  procedimento TEXT NOT NULL,
  datahora DATETIME NOT NULL,
  PRIMARY KEY (codigo)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS laboratorios_procedimentos_status (
  codigo int NOT NULL auto_increment,
  codigo_procedimento int NOT NULL,
  `status` TEXT NOT NULL,
  datahora DATETIME NOT NULL,
  PRIMARY KEY (codigo)
) ENGINE=MyISAM;

# 3.0

ALTER TABLE laboratorios_procedimentos ADD codigo_laboratorio int NOT NULL AFTER codigo;

# 3.5

ALTER TABLE dentistas ADD data_inicio DATE NOT NULL AFTER ativo, ADD data_fim DATE NOT NULL AFTER data_inicio;
ALTER TABLE pacientes ADD falecido ENUM('Sim', 'Nï¿½o') NOT NULL DEFAULT 'Nï¿½o' AFTER pais;

ALTER TABLE convenios CHANGE codigo codigo INT(15) NOT NULL, DROP PRIMARY KEY;
UPDATE convenios SET codigo = codigo + 2;
UPDATE pacientes SET codigo_convenio = codigo_convenio + 2;
INSERT INTO convenios (codigo, nomefantasia) VALUES (1, 'Particular');
INSERT INTO convenios (codigo, nomefantasia, cidade, estado, pais, cep) VALUES (2, 'Smile', 'Arcos', 'MG', 'Brasil', '35588-000');
ALTER TABLE convenios ADD PRIMARY KEY(`codigo`), CHANGE codigo codigo INT(15) NOT NULL AUTO_INCREMENT;
UPDATE pacientes SET codigo_convenio = 1 WHERE codigo_convenio = 2;

CREATE TABLE honorarios_convenios (
  codigo_convenio INT NOT NULL,
  codigo_procedimento VARCHAR(10) NOT NULL,
  valor FLOAT NOT NULL,
  PRIMARY KEY(codigo_convenio, codigo_procedimento)
);

INSERT INTO honorarios_convenios SELECT 1 codigo_convenio, codigo codigo_procedimento, valor_particular valor FROM honorarios;
INSERT INTO honorarios_convenios SELECT 2 codigo_convenio, codigo codigo_procedimento, valor_convenio valor FROM honorarios;

ALTER TABLE honorarios DROP valor_particular, DROP valor_convenio;

CREATE TABLE radiografias (
  codigo INT NOT NULL AUTO_INCREMENT,
  codigo_paciente INT NOT NULL,
  foto LONGBLOB NOT NULL,
  legenda VARCHAR(100) NOT NULL,
  data DATE NOT NULL,
  modelo ENUM('Panoramica', 'Oclusal', 'Periapical', 'Interproximal', 'ATM', 'PA', 'AP', 'Lateral') NOT NULL,
  diagnostico TEXT NOT NULL,
  PRIMARY KEY(codigo)
);

CREATE TABLE permissoes (
  nivel VARCHAR(30) NOT NULL,
  area ENUM('profissionais',
            'pacientes',
            'funcionarios',
            'fornecedores',
            'agenda',
            'patrimonio',
            'estoque',
            'laboratorios',
            'convenios',
            'honorarios',
            'contas_pagar',
            'contas_receber',
            'caixa',
            'cheques',
            'pagamentos',
            'arquivos_clinica',
            'manuais',
            'contatos',
            'backup_gerar',
            'backup_restaurar',
            'informacoes',
            'idiomas') NOT NULL,
  permissao SET('L', 'V', 'E', 'I', 'A'),
  PRIMARY KEY (nivel, area)
);

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

# 4.0

CREATE TABLE dentista_atendimento (
  codigo_dentista int(11) NOT NULL,
  dia_semana tinyint(1) NOT NULL,
  hora_inicio time NOT NULL,
  hora_fim time NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  PRIMARY KEY (codigo_dentista,dia_semana)
);

