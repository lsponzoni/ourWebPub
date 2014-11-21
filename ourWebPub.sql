SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Periodico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Periodico` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Periodico` (
  `issn` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `volumeAtual` INT NULL,
  `fasciculoAtual` INT NULL,
  `mesAtual` DATE NULL,
  `qualisAtual` VARCHAR(2) NULL,
  `alcance` VARCHAR(45) NULL,
  PRIMARY KEY (`issn`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`HistoricoPeriodico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`HistoricoPeriodico` ;

CREATE TABLE IF NOT EXISTS `mydb`.`HistoricoPeriodico` (
  `qualis` VARCHAR(2) NOT NULL,
  `Periodico_issn` INT NOT NULL,
  `volume` INT NOT NULL,
  `fasciculo` INT NOT NULL,
  `mes` DATE NOT NULL,
  PRIMARY KEY (`Periodico_issn`, `fasciculo`, `volume`, `mes`),
  CONSTRAINT `fk_Qualis_Periódico1`
    FOREIGN KEY (`Periodico_issn`)
    REFERENCES `mydb`.`Periodico` (`issn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Conferencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Conferencia` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Conferencia` (
  `acronimo` VARCHAR(10) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `qualisAtual` VARCHAR(2) NULL,
  `alcance` VARCHAR(45) NULL,
  PRIMARY KEY (`acronimo`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`HistoricoConferencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`HistoricoConferencia` ;

CREATE TABLE IF NOT EXISTS `mydb`.`HistoricoConferencia` (
  `qualis` INT NOT NULL,
  `numEvento` INT NOT NULL,
  `anoEvento` YEAR NOT NULL,
  `Conferencia_acronimo` VARCHAR(10) NOT NULL,
  INDEX `fk_HistoricoConferencia_Conferencia1_idx` (`Conferencia_acronimo` ASC),
  PRIMARY KEY (`anoEvento`, `numEvento`),
  CONSTRAINT `fk_HistoricoConferencia_Conferencia1`
    FOREIGN KEY (`Conferencia_acronimo`)
    REFERENCES `mydb`.`Conferencia` (`acronimo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Publicacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Publicacao` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Publicacao` (
  `titulo` VARCHAR(75) NOT NULL,
  `local` VARCHAR(45) NOT NULL,
  `ano` YEAR NOT NULL,
  `PagInicial` INT NULL DEFAULT NULL,
  `PagFinal` INT NULL DEFAULT NULL,
  `link` VARCHAR(140) NULL DEFAULT NULL,
  `dataExata` DATE NULL DEFAULT NULL,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  `HistoricoPeriodico_Periodico_issn` INT NULL DEFAULT NULL,
  `HistoricoPeriodico_fasciculo` INT NULL DEFAULT NULL,
  `HistoricoPeriodico_volume` INT NULL DEFAULT NULL,
  `HistoricoPeriodico_mes` DATE NULL DEFAULT NULL,
  `HistoricoConferencia_anoEvento` YEAR NULL DEFAULT NULL,
  `HistoricoConferencia_numEvento` INT NULL DEFAULT NULL,
  `idPublicacao` INT NOT NULL,
  `capituloLivro` INT NULL DEFAULT NULL,
  `edicoesLivro` INT NULL DEFAULT NULL,
  PRIMARY KEY (`idPublicacao`),
  INDEX `fk_Publicacao_HistoricoPeriodico1_idx` (`HistoricoPeriodico_Periodico_issn` ASC, `HistoricoPeriodico_fasciculo` ASC, `HistoricoPeriodico_volume` ASC, `HistoricoPeriodico_mes` ASC),
  INDEX `fk_Publicacao_HistoricoConferencia1_idx` (`HistoricoConferencia_anoEvento` ASC, `HistoricoConferencia_numEvento` ASC),
  UNIQUE INDEX `titulo_UNIQUE` (`titulo` ASC),
  CONSTRAINT `fk_Publicacao_HistoricoPeriodico1`
    FOREIGN KEY (`HistoricoPeriodico_Periodico_issn` , `HistoricoPeriodico_fasciculo` , `HistoricoPeriodico_volume` , `HistoricoPeriodico_mes`)
    REFERENCES `mydb`.`HistoricoPeriodico` (`Periodico_issn` , `fasciculo` , `volume` , `mes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Publicacao_HistoricoConferencia1`
    FOREIGN KEY (`HistoricoConferencia_anoEvento` , `HistoricoConferencia_numEvento`)
    REFERENCES `mydb`.`HistoricoConferencia` (`anoEvento` , `numEvento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Administrador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Administrador` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Administrador` (
  `login` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`login`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Publicador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Publicador` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Publicador` (
  `idPublicador` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(75) NOT NULL,
  `login` VARCHAR(45) NULL,
  `senha` VARCHAR(45) NULL,
  `endereco` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `convidadoPor` INT NULL,
  PRIMARY KEY (`idPublicador`),
  UNIQUE INDEX `Publicadorcol_UNIQUE` (`nome` ASC),
  INDEX `fk_Publicador_Publicador1_idx` (`convidadoPor` ASC),
  CONSTRAINT `fk_Publicador_Publicador1`
    FOREIGN KEY (`convidadoPor`)
    REFERENCES `mydb`.`Publicador` (`idPublicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Grupo` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Grupo` (
  `Grupo` INT NOT NULL AUTO_INCREMENT,
  `Lider` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `cadastroOficial` INT NOT NULL,
  PRIMARY KEY (`Grupo`),
  INDEX `fk_Grupo_Publicador1_idx` (`Lider` ASC),
  CONSTRAINT `fk_Grupo_Publicador1`
    FOREIGN KEY (`Lider`)
    REFERENCES `mydb`.`Publicador` (`idPublicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Publicacao_has_Publicador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Publicacao_has_Publicador` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Publicacao_has_Publicador` (
  `Publicacao_idPublicacao` INT NOT NULL,
  `Publicador_idPublicador` INT NOT NULL,
  `homologa` TINYINT(1) NULL DEFAULT FALSE,
  PRIMARY KEY (`Publicacao_idPublicacao`, `Publicador_idPublicador`),
  INDEX `fk_Publicacao_has_Publicador_Publicador1_idx` (`Publicador_idPublicador` ASC),
  CONSTRAINT `fk_Publicacao_has_Publicador_Publicacao`
    FOREIGN KEY (`Publicacao_idPublicacao`)
    REFERENCES `mydb`.`Publicacao` (`idPublicacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Publicacao_has_Publicador_Publicador`
    FOREIGN KEY (`Publicador_idPublicador`)
    REFERENCES `mydb`.`Publicador` (`idPublicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`PublicaPeloGrupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PublicaPeloGrupo` ;

CREATE TABLE IF NOT EXISTS `mydb`.`PublicaPeloGrupo` (
  `Grupo_Grupo` INT NOT NULL,
  `Publicador_idPublicador` INT NOT NULL,
  PRIMARY KEY (`Grupo_Grupo`, `Publicador_idPublicador`),
  INDEX `fk_Grupo_has_Publicador_Publicador1_idx` (`Publicador_idPublicador` ASC),
  INDEX `fk_Grupo_has_Publicador_Grupo1_idx` (`Grupo_Grupo` ASC),
  CONSTRAINT `fk_Grupo_has_Publicador_Grupo1`
    FOREIGN KEY (`Grupo_Grupo`)
    REFERENCES `mydb`.`Grupo` (`Grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Grupo_has_Publicador_Publicador1`
    FOREIGN KEY (`Publicador_idPublicador`)
    REFERENCES `mydb`.`Publicador` (`idPublicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Instituicao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Instituicao` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Instituicao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `pais` VARCHAR(2) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC),
  UNIQUE INDEX `Instituição_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`TrabalhaEm`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`TrabalhaEm` ;

CREATE TABLE IF NOT EXISTS `mydb`.`TrabalhaEm` (
  `Publicador_idPublicador` INT NOT NULL,
  `idInstituicao` INT NOT NULL,
  PRIMARY KEY (`Publicador_idPublicador`, `idInstituicao`),
  INDEX `fk_Publicador_has_table1_table11_idx` (`idInstituicao` ASC),
  INDEX `fk_Publicador_has_table1_Publicador1_idx` (`Publicador_idPublicador` ASC),
  CONSTRAINT `fk_Publicador_has_table1_Publicador1`
    FOREIGN KEY (`Publicador_idPublicador`)
    REFERENCES `mydb`.`Publicador` (`idPublicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Publicador_has_table1_table11`
    FOREIGN KEY (`idInstituicao`)
    REFERENCES `mydb`.`Instituicao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Abreviaturas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Abreviaturas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Abreviaturas` (
  `nome` VARCHAR(20) NULL,
  `Publicador_idPublicador` INT NOT NULL,
  PRIMARY KEY (`Publicador_idPublicador`),
  CONSTRAINT `fk_Abreviaturas_Publicador1`
    FOREIGN KEY (`Publicador_idPublicador`)
    REFERENCES `mydb`.`Publicador` (`idPublicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`AreaDePesquisa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`AreaDePesquisa` ;

CREATE TABLE IF NOT EXISTS `mydb`.`AreaDePesquisa` (
  `nome` VARCHAR(45) NOT NULL,
  `codAreaPesquisa` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`codAreaPesquisa`),
  UNIQUE INDEX `codAreaPesquisa_UNIQUE` (`codAreaPesquisa` ASC),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`AreaDePesquisa_has_Publicador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`AreaDePesquisa_has_Publicador` ;

CREATE TABLE IF NOT EXISTS `mydb`.`AreaDePesquisa_has_Publicador` (
  `AreaDePesquisa_nome` VARCHAR(45) NOT NULL,
  `Publicador_idPublicador` INT NOT NULL,
  PRIMARY KEY (`AreaDePesquisa_nome`, `Publicador_idPublicador`),
  INDEX `fk_AreaDePesquisa_has_Publicador_Publicador1_idx` (`Publicador_idPublicador` ASC),
  INDEX `fk_AreaDePesquisa_has_Publicador_AreaDePesquisa1_idx` (`AreaDePesquisa_nome` ASC),
  CONSTRAINT `fk_AreaDePesquisa_has_Publicador_AreaDePesquisa1`
    FOREIGN KEY (`AreaDePesquisa_nome`)
    REFERENCES `mydb`.`AreaDePesquisa` (`nome`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AreaDePesquisa_has_Publicador_Publicador1`
    FOREIGN KEY (`Publicador_idPublicador`)
    REFERENCES `mydb`.`Publicador` (`idPublicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`AreaDePesquisa_has_Grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`AreaDePesquisa_has_Grupo` ;

CREATE TABLE IF NOT EXISTS `mydb`.`AreaDePesquisa_has_Grupo` (
  `AreaDePesquisa_codAreaPesquisa` INT NOT NULL,
  `Grupo_Grupo` INT NOT NULL,
  PRIMARY KEY (`AreaDePesquisa_codAreaPesquisa`, `Grupo_Grupo`),
  INDEX `fk_AreaDePesquisa_has_Grupo_Grupo1_idx` (`Grupo_Grupo` ASC),
  INDEX `fk_AreaDePesquisa_has_Grupo_AreaDePesquisa1_idx` (`AreaDePesquisa_codAreaPesquisa` ASC),
  CONSTRAINT `fk_AreaDePesquisa_has_Grupo_AreaDePesquisa1`
    FOREIGN KEY (`AreaDePesquisa_codAreaPesquisa`)
    REFERENCES `mydb`.`AreaDePesquisa` (`codAreaPesquisa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AreaDePesquisa_has_Grupo_Grupo1`
    FOREIGN KEY (`Grupo_Grupo`)
    REFERENCES `mydb`.`Grupo` (`Grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Publicacao_has_AreaDePesquisa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Publicacao_has_AreaDePesquisa` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Publicacao_has_AreaDePesquisa` (
  `Publicacao_idPublicacao` INT NOT NULL,
  `AreaDePesquisa_codAreaPesquisa` INT NOT NULL,
  PRIMARY KEY (`Publicacao_idPublicacao`, `AreaDePesquisa_codAreaPesquisa`),
  INDEX `fk_Publicacao_has_AreaDePesquisa_AreaDePesquisa1_idx` (`AreaDePesquisa_codAreaPesquisa` ASC),
  INDEX `fk_Publicacao_has_AreaDePesquisa_Publicacao1_idx` (`Publicacao_idPublicacao` ASC),
  CONSTRAINT `fk_Publicacao_has_AreaDePesquisa_Publicacao1`
    FOREIGN KEY (`Publicacao_idPublicacao`)
    REFERENCES `mydb`.`Publicacao` (`idPublicacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Publicacao_has_AreaDePesquisa_AreaDePesquisa1`
    FOREIGN KEY (`AreaDePesquisa_codAreaPesquisa`)
    REFERENCES `mydb`.`AreaDePesquisa` (`codAreaPesquisa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Publicacao_has_Grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Publicacao_has_Grupo` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Publicacao_has_Grupo` (
  `Publicacao_idPublicacao` INT NOT NULL,
  `Grupo_Grupo` INT NOT NULL,
  `homologa` TINYINT(1) NULL,
  PRIMARY KEY (`Publicacao_idPublicacao`, `Grupo_Grupo`),
  INDEX `fk_Publicacao_has_Grupo_Grupo1_idx` (`Grupo_Grupo` ASC),
  INDEX `fk_Publicacao_has_Grupo_Publicacao1_idx` (`Publicacao_idPublicacao` ASC),
  CONSTRAINT `fk_Publicacao_has_Grupo_Publicacao1`
    FOREIGN KEY (`Publicacao_idPublicacao`)
    REFERENCES `mydb`.`Publicacao` (`idPublicacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Publicacao_has_Grupo_Grupo1`
    FOREIGN KEY (`Grupo_Grupo`)
    REFERENCES `mydb`.`Grupo` (`Grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Correcao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Correcao` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Correcao` (
  `Publicacao_idPublicacao` INT NOT NULL,
  `descricao` VARCHAR(140) NULL,
  INDEX `fk_Correçao_Publicacao1_idx` (`Publicacao_idPublicacao` ASC),
  PRIMARY KEY (`Publicacao_idPublicacao`),
  CONSTRAINT `fk_Correçao_Publicacao1`
    FOREIGN KEY (`Publicacao_idPublicacao`)
    REFERENCES `mydb`.`Publicacao` (`idPublicacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Publicacao_has_Referencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Publicacao_has_Referencias` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Publicacao_has_Referencias` (
  `Publicacao_idPublicacao` INT NOT NULL,
  `Publicacao_referencia` INT NULL DEFAULT NULL,
  `descricaoRef` VARCHAR(140) NULL,
  PRIMARY KEY (`Publicacao_idPublicacao`),
  INDEX `fk_Publicacao_has_Publicacao_Publicacao2_idx` (`Publicacao_referencia` ASC),
  INDEX `fk_Publicacao_has_Publicacao_Publicacao1_idx` (`Publicacao_idPublicacao` ASC),
  CONSTRAINT `fk_Publicacao_has_Publicacao_Publicacao1`
    FOREIGN KEY (`Publicacao_idPublicacao`)
    REFERENCES `mydb`.`Publicacao` (`idPublicacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Publicacao_has_Publicacao_Publicacao2`
    FOREIGN KEY (`Publicacao_referencia`)
    REFERENCES `mydb`.`Publicacao` (`idPublicacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ConvitesValidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ConvitesValidos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ConvitesValidos` (
  `token` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `Publicador_idPublicador` INT NULL,
  `expiraEm` DATETIME NULL,
  PRIMARY KEY (`token`),
  UNIQUE INDEX `token_UNIQUE` (`token` ASC),
  INDEX `fk_ConvitesValidos_Publicador1_idx` (`Publicador_idPublicador` ASC),
  CONSTRAINT `fk_ConvitesValidos_Publicador1`
    FOREIGN KEY (`Publicador_idPublicador`)
    REFERENCES `mydb`.`Publicador` (`idPublicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
