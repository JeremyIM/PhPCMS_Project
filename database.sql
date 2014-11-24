SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`user` ;

CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `password` VARCHAR(128) NULL,
  `password_salt` VARCHAR(32) NULL,
  `created_by_id` INT NULL,
  `modified_by_id` INT NULL,
  `created_date` DATETIME NULL,
  `last_modified_date` VARCHAR(45) NULL,
  `permissions_id` INT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_user_created_by_idx` (`created_by_id` ASC),
  INDEX `user_mod_by_idx` (`modified_by_id` ASC),
  CONSTRAINT `user_created_by`
    FOREIGN KEY (`created_by_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_mod_by`
    FOREIGN KEY (`modified_by_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`permission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`permission` ;

CREATE TABLE IF NOT EXISTS `mydb`.`permission` (
  `permissions_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`permissions_id`),
  UNIQUE INDEX `permissions_id_UNIQUE` (`permissions_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`css`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`css` ;

CREATE TABLE IF NOT EXISTS `mydb`.`css` (
  `css_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(255) NULL,
  `active_status` TINYINT(1) NULL,
  `created_by_id` INT NULL,
  `modified_by_id` INT NULL,
  `created_date` DATETIME NULL,
  `modified_date` DATETIME NULL,
  `style_snippet` LONGTEXT NULL,
  PRIMARY KEY (`css_id`),
  UNIQUE INDEX `css_id_UNIQUE` (`css_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`page`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`page` ;

CREATE TABLE IF NOT EXISTS `mydb`.`page` (
  `page_id` INT NOT NULL AUTO_INCREMENT,
  `page_name` VARCHAR(45) NULL,
  `web_name` VARCHAR(45) NULL,
  `description` VARCHAR(255) NULL,
  `created_by_id` INT NULL,
  `modified_by_id` INT NULL,
  `created_date` DATETIME NULL,
  `modified_date` DATETIME NULL,
  `active_css` INT NULL,
  PRIMARY KEY (`page_id`),
  UNIQUE INDEX `page_id_UNIQUE` (`page_id` ASC),
  INDEX `page_created_by_idx` (`created_by_id` ASC),
  INDEX `page_mod_by_idx` (`modified_by_id` ASC),
  INDEX `active_css_idx` (`active_css` ASC),
  CONSTRAINT `page_created_by`
    FOREIGN KEY (`created_by_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `page_mod_by`
    FOREIGN KEY (`modified_by_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `active_css`
    FOREIGN KEY (`active_css`)
    REFERENCES `mydb`.`css` (`css_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`content_area`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`content_area` ;

CREATE TABLE IF NOT EXISTS `mydb`.`content_area` (
  `content_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `div_name` VARCHAR(45) NULL,
  `in_article_id` INT NULL,
  `page_order_pos` INT NULL,
  `description` VARCHAR(255) NULL,
  `created_by_id` INT NULL,
  `modified_by_id` INT NULL,
  `created_date` DATETIME NULL,
  `modified_date` INT NULL,
  `active_css` INT NULL,
  PRIMARY KEY (`content_id`),
  UNIQUE INDEX `content_id_UNIQUE` (`content_id` ASC),
  INDEX `ca_created_by_idx` (`created_by_id` ASC),
  INDEX `ca_mod_by_idx` (`modified_by_id` ASC),
  CONSTRAINT `ca_created_by`
    FOREIGN KEY (`created_by_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ca_mod_by`
    FOREIGN KEY (`modified_by_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`article` ;

CREATE TABLE IF NOT EXISTS `mydb`.`article` (
  `article_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `title` VARCHAR(100) NULL,
  `description` VARCHAR(255) NULL,
  `page_id` INT NULL,
  `created_by_id` INT NULL,
  `modified_by_id` INT NULL,
  `created_date` DATETIME NULL,
  `modified_date` DATETIME NULL,
  `active_css` INT NULL,
  `all_pages` TINYINT(1) NULL,
  `content_area_id` INT NULL,
  `the_content` LONGTEXT NULL,
  PRIMARY KEY (`article_id`),
  UNIQUE INDEX `article_id_UNIQUE` (`article_id` ASC),
  INDEX `art_created_by_idx` (`created_by_id` ASC),
  INDEX `art_mod_by_idx` (`modified_by_id` ASC),
  INDEX `page_id_idx` (`page_id` ASC),
  INDEX `content_id_idx` (`content_area_id` ASC),
  UNIQUE INDEX `created_date_UNIQUE` (`created_date` ASC),
  CONSTRAINT `art_created_by`
    FOREIGN KEY (`created_by_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `art_mod_by`
    FOREIGN KEY (`modified_by_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `page_id`
    FOREIGN KEY (`page_id`)
    REFERENCES `mydb`.`page` (`page_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `content_id`
    FOREIGN KEY (`content_area_id`)
    REFERENCES `mydb`.`content_area` (`content_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`user_roles` ;

CREATE TABLE IF NOT EXISTS `mydb`.`user_roles` (
  `user_role_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NULL,
  `permissions_id` INT NULL,
  PRIMARY KEY (`user_role_id`),
  UNIQUE INDEX `user_role_id_UNIQUE` (`user_role_id` ASC),
  INDEX `user_id_idx` (`user_id` ASC),
  INDEX `permission_id_idx` (`permissions_id` ASC),
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `permission_id`
    FOREIGN KEY (`permissions_id`)
    REFERENCES `mydb`.`permission` (`permissions_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
