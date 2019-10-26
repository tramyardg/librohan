# DDL
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS dependents;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS departments;
DROP TABLE IF EXISTS works_on;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `departments`
(
  `dept_id`     INT PRIMARY KEY NOT NULL,
  `dept_name`   VARCHAR(40)     NOT NULL,
  `manager_sin` VARCHAR(15),
  `branch`      VARCHAR(40),
  `start_date`  DATETIME
);

CREATE TABLE `employees`
(
  `employee_id`   INT PRIMARY KEY     NOT NULL AUTO_INCREMENT,
  `first_name`    VARCHAR(30)         NOT NULL,
  `last_name`     VARCHAR(40)         NOT NULL,
  `sin`           VARCHAR(15) UNIQUE  NOT NULL,
  `birth_date`    DATE,
  `address`       VARCHAR(150),
  `gender`        CHAR(1),
  `salary`        NUMERIC(8, 2),
  `dept_id`       INT,
  `supervisor_id` INT,
  FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`)
);

CREATE TABLE `dependents`
(
  `dependent_id` INT,
  `employee_id`  INT,
  `name`         VARCHAR(30),
  `gender`       CHAR(1),
  `birth_date`   DATE,
  `relationship` VARCHAR(30),
  PRIMARY KEY (dependent_id, employee_id),
  FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`)
);

CREATE TABLE `projects`
(
  `project_id`   INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `project_name` VARCHAR(50)     NOT NULL,
  `dept_id`      INT,
  `location`     VARCHAR(40),
  FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`)
);

CREATE TABLE works_on (
  `employee_id` INT,
  `project_id`  INT,
  PRIMARY KEY (`employee_id`, `project_id`),
  FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`)
);

ALTER TABLE `departments`
  ADD FOREIGN KEY (`manager_sin`) REFERENCES `employees` (`sin`);

ALTER TABLE employees
  ADD FOREIGN KEY (supervisor_id) REFERENCES employees (employee_id);

# An alternative to temporarily disable all the foreign keys:
# SET FOREIGN_KEY_CHECKS=0;
# When you need to turn it on:
# SET FOREIGN_KEY_CHECKS=1;