CREATE TABLE `tbl_estado` (
  `cod_estado` int(11) NOT NULL,
  `nome_estado` varchar(100) DEFAULT NULL,
  `cicla` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Unidades Federativas';

insert into bd_locadora_w.tbl_estado(cod_estado, nome_estado, cicla) select UF_ID, UF_NOME, UF_UF from testeestado.estado;





CREATE TABLE `tbl_cidade` (
  `cod_cidade` int(11) NOT NULL,
  `nome_cidade` varchar(120) DEFAULT NULL,
  `cod_estado` int(11) DEFAULT NULL
   FOREIGN KEY (`cod_estado`)
    REFERENCES `bd_locaadora_w`.`estado` (`cod_estado`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Municipios das Unidades Federativas';

insert into bd_locadora_w.tbl_estado(cod_cidade, nome_cidade, cod_estado) select CT_ID, 
CT_NOME, CT_UF from testeestado.cidade;


 alter table tbl_endereco  add  FOREIGN KEY (`cod_cidade`)
    REFERENCES `bd_locaadora_w`.`tbl_cidade` (`cod_cidade`);

    -- https://github.com/chinnonsantos/sql-paises-estados-cidades/blob/master/MySQL/estado.sql






