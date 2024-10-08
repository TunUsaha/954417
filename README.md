# 954417

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`User` (
  `id` INT NOT NULL,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Technician`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Technician` (
  `id` INT NOT NULL,
  `Specialization` VARCHAR(45) NULL,
  `Availbaility` VARCHAR(45) NULL,
  `User_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Technician_User1_idx` (`User_id` ASC) ,
  CONSTRAINT `fk_Technician_User1`
    FOREIGN KEY (`User_id`)
    REFERENCES `mydb`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`RepairRequest`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`RepairRequest` (
  `id` INT NOT NULL,
  `Description` VARCHAR(45) NULL,
  `Status` VARCHAR(45) NULL,
  `RequestedDate` DATETIME NULL,
  `ScheduleDate` DATETIME NULL,
  `User_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_RepairRequest_User_idx` (`User_id` ASC) ,
  CONSTRAINT `fk_RepairRequest_User`
    FOREIGN KEY (`User_id`)
    REFERENCES `mydb`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Assignment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Assignment` (
  `id` INT NOT NULL,
  `AcceptDate` VARCHAR(45) NULL,
  `ScheduledDate` VARCHAR(45) NULL,
  `Status` VARCHAR(45) NULL,
  `Technician_id` INT NOT NULL,
  `RepairRequest_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Assignment_Technician1_idx` (`Technician_id` ASC) ,
  INDEX `fk_Assignment_RepairRequest1_idx` (`RepairRequest_id` ASC) ,
  CONSTRAINT `fk_Assignment_Technician1`
    FOREIGN KEY (`Technician_id`)
    REFERENCES `mydb`.`Technician` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Assignment_RepairRequest1`
    FOREIGN KEY (`RepairRequest_id`)
    REFERENCES `mydb`.`RepairRequest` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`EquipmentRequest`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`EquipmentRequest` (
  `id` INT NOT NULL,
  `NameEquipmentRequest` VARCHAR(45) NULL,
  `Description` VARCHAR(45) NULL,
  `Assignment_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_EquipmentRequest_Assignment1_idx` (`Assignment_id` ASC) ,
  CONSTRAINT `fk_EquipmentRequest_Assignment1`
    FOREIGN KEY (`Assignment_id`)
    REFERENCES `mydb`.`Assignment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Equipment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Equipment` (
  `id` INT NOT NULL,
  `Name` VARCHAR(45) NULL,
  `QuantityAvailable` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`IssueRequisition`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`IssueRequisition` (
  `id` INT NOT NULL,
  `EquipmentRequest_id` INT NOT NULL,
  `Equipment_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_IssueRequisition_EquipmentRequest1_idx` (`EquipmentRequest_id` ASC) ,
  INDEX `fk_IssueRequisition_Equipment1_idx` (`Equipment_id` ASC) ,
  CONSTRAINT `fk_IssueRequisition_EquipmentRequest1`
    FOREIGN KEY (`EquipmentRequest_id`)
    REFERENCES `mydb`.`EquipmentRequest` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_IssueRequisition_Equipment1`
    FOREIGN KEY (`Equipment_id`)
    REFERENCES `mydb`.`Equipment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
