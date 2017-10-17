/*
Create xml_parser database
*/

create database if not exists `xml_parser`;

USE `xml_parser`;

/* Create departments table */

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Import some default departments */

insert  into `departments`(`id`,`name`) values (1,'Development'),(2,'Marketing'),(3,'Management');

/* Create employees table */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `salary` decimal(10,0) DEFAULT NULL,
  `department_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_employees` (`department_id`),
  CONSTRAINT `FK_employees` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Import some default employees */

insert  into `employees`(`id`,`name`,`salary`,`department_id`) values
(1,'Courtney Pollak','1000',1),
(2,'Bennie Shaffer','1500',2),
(3,'Odis Marks','1200',2),
(4,'Charles Beverly','3200',3);
