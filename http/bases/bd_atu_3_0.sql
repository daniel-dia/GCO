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
