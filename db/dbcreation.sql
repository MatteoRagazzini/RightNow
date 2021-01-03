SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


CREATE SCHEMA IF NOT EXISTS `rightnow` DEFAULT CHARACTER SET utf8 ;
USE `rightnow` ;

CREATE USER 'sec_user'@'localhost' IDENTIFIED BY 'S8vRYngDwBCU';
GRANT SELECT, INSERT, UPDATE, DELETE ON `rightnow`.* TO 'sec_user'@'localhost';


CREATE TABLE IF NOT EXISTS `rightnow`.`user` (
  `userid` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(30) UNIQUE NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` CHAR(128) NOT NULL,
  `salt` CHAR(128) NOT NULL,
  `disattivo` TINYINT NULL DEFAULT 0
) ENGINE = InnoDB;

CREATE TABLE `rightnow`.`login_attempts` (
  `user_id` INT(11) NOT NULL,
  `time` VARCHAR(30) NOT NULL
) ENGINE=InnoDB;

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
  `visualid` INT NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`visualid`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

alter table rightnow.list add constraint organiser_list unique index(listname, listorganiser);



INSERT INTO `visual` (`visualid`, `name`, `imgpath`, `imgtitle`, `imgtext`, `title1`, `title2`, `title3`, `text1`, `text2`, `text3`, `credits`, `used`) VALUES (NULL, 'Palloncini-01', 'res/background8.jpg', 'Right Now', 'Organizing events has never been so easy. Start right now', 'Organize', 'Connect', 'Manage', 'By joining our community you can create any type of event! The best thing is that you can also share them with your friends and have fun together!', 'You don\'t know what to do tomorrow night? Don\'t worry, we got you! With our platform you can search for events near you and join them.', 'We provide a easy interface where you can see all your events, so you don\'t forget to hang out in the evening!', 'Made by Paolo Penazzi, Matteo Ragazzini, Davide Alpi', '1')
