# 4.0

CREATE TABLE dentista_atendimento (
  codigo_dentista int(11) NOT NULL,
  dia_semana tinyint(1) NOT NULL,
  hora_inicio time NOT NULL,
  hora_fim time NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  PRIMARY KEY (codigo_dentista,dia_semana)
);

