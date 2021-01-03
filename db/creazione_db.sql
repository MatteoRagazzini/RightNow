-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema rightnow
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema rightnow
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rightnow` DEFAULT CHARACTER SET utf8 ;
USE `rightnow` ;

-- -----------------------------------------------------
-- Table `rightnow`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rightnow`.`user` (
  `userid` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) UNIQUE NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `email` VARCHAR(256) UNIQUE NOT NULL,
  `disattivo` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`userid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rightnow`.`user_google`
-- -----------------------------------------------------
--CREATE TABLE IF NOT EXISTS `rightnow`.`user_google` (
 -- `id` INT NOT NULL,
 -- `googleid` VARCHAR(100) NOT NULL UNIQUE,
 -- PRIMARY KEY (`id`)),
 -- INDEX `fk_user_google_id` (`user_google` ASC),
 -- CONSTRAINT `fk_user_google_id`
   -- FOREIGN KEY (`user`)
  --  REFERENCES `rightnow`.`user` (`userid`)
   -- ON DELETE NO ACTION
   -- ON UPDATE NO ACTION,
--ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rightnow`.`event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rightnow`.`event` (
  `eventid` INT NOT NULL AUTO_INCREMENT,
  `eventname` VARCHAR(100) NOT NULL,
  `eventcity` VARCHAR(256) NOT NULL,
  `eventdescription` TEXT NOT NULL,
  `eventpreview` TINYTEXT NOT NULL,
  `maxtickets` INT NOT NULL,
  `date` DATE NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `public` TINYINT NOT NULL,
  `imgevent` MEDIUMBLOB NOT NULL,
  `organiser` INT NOT NULL,
  PRIMARY KEY (`eventid`),
  CONSTRAINT `fk_event_user`
    FOREIGN KEY (`organiser`)
    REFERENCES `rightnow`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rightnow`.`category`
-- -----------------------------------------------------
--CREATE TABLE IF NOT EXISTS `rightnow`.`category` (
  --`categoryid` INT NOT NULL AUTO_INCREMENT,
  --`categoryname` VARCHAR(50) NOT NULL,
 -- PRIMARY KEY (`categoryid`))
--ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rightnow`.`ticket`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `rightnow`.`ticket` (
  `event` INT NOT NULL,
  `user` INT NOT NULL,
  `bought` TINYINT NOT NULL DEFAULT 0,
  `notification` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`event`, `user`),
  CONSTRAINT `fk_ticket_event`
    FOREIGN KEY (`event`)
    REFERENCES `rightnow`.`event` (`eventid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_user`
    FOREIGN KEY (`user`)
    REFERENCES `rightnow`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `rightnow`.`invitation`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `rightnow`.`invitation` (
  `event` INT NOT NULL,
  `user` INT NOT NULL,
  `sendername` INT NOT NULL,
  PRIMARY KEY (`event`, `user`),
  CONSTRAINT `fk_invitation_event`
    FOREIGN KEY (`event`)
    REFERENCES `rightnow`.`event` (`eventid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invitation_user`
    FOREIGN KEY (`user`)
    REFERENCES `rightnow`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rightnow`.`list`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rightnow`.`list` (
  `listid` INT NOT NULL AUTO_INCREMENT,
  `listname` VARCHAR(50) NOT NULL,
  `listorganiser` INT NOT NULL,
  PRIMARY KEY (`listid`),
  CONSTRAINT `fk_list_user`
    FOREIGN KEY (`listorganiser`)
    REFERENCES `rightnow`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rightnow`.`enlist`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `rightnow`.`enlist` (
  `list` INT NOT NULL,
  `user` INT NOT NULL,
  PRIMARY KEY (`list`, `user`),
  CONSTRAINT `fk_list_enlist`
    FOREIGN KEY (`list`)
    REFERENCES `rightnow`.`list` (`listid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_enlist`
    FOREIGN KEY (`user`)
    REFERENCES `rightnow`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `rightnow`.`admin`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `rightnow`.`admin` (
  `adminid` INT NOT NULL AUTO_INCREMENT,
  `user` INT UNIQUE NOT NULL,
  PRIMARY KEY (`adminid`),
  CONSTRAINT `fk_user_admin`
    FOREIGN KEY (`user`)
    REFERENCES `rightnow`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `rightnow`.`visual`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `rightnow`.`visual` (
  `landingid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) UNIQUE NOT NULL,
  `imgpath` VARCHAR(200) NOT NULL,
  `imgtitle` VARCHAR(50) NOT NULL,
  `imgtext` TEXT NOT NULL,
  `title1` VARCHAR(50) NOT NULL,
  `title2` VARCHAR(50) NOT NULL,
  `title3` VARCHAR(50) NOT NULL,
  `text1` TEXT NOT NULL,
  `text2` TEXT NOT NULL,
  `text3` TEXT NOT NULL,
  `credits` TEXT NOT NULL,
  `used` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`landingid`),
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
