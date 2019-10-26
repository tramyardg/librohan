# Specs: 
# 30 employees: 10 managers
# 10 departments
# 20 projects

SET FOREIGN_KEY_CHECKS = 0;
DELETE FROM employees;
DELETE FROM departments;
DELETE FROM projects;
DELETE FROM works_on;
SET FOREIGN_KEY_CHECKS = 1;

SET FOREIGN_KEY_CHECKS = 0;
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (1, 'Seward', 'Tinman', '017-943-715', '1962-08-22', '8341 Westend Crossing, Sainte-Anne-des-Monts, QC, D0C 5Y0, CA', 'M', 66344, 2, 2);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (2, 'Winthrop', 'Dillingstone', '343-784-626', '1978-06-30', '934 Dawn Point, Beaconsfield, QC, T1I 0N3, CA', 'M', 70898, 5, 2);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (3, 'Everett', 'Greydon', '691-925-682', '1956-04-22', '92234 Cottonwood Lane, Acton Vale, QC, E8G 0Z8, CA', 'M', 86482, 9, 8);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (4, 'Hi', 'Lowis', '536-022-935', '1972-09-21', '4219 Prairie Rose Pass, Forestville, QC, J1J 9D0, CA', 'M', 90817, 5, 2);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (5, 'Vincenty', 'Shepherdson', '654-182-989', '1972-03-17', '2174 Prairieview Place, Maskinongé, QC, N6I 7H1, CA', 'M', 30333, 8, 8);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (6, 'Robinett', 'Litel', '664-600-771', '1958-02-05', '8126 Summit Circle, Les Cèdres, QC, A0C 0D3, CA', 'F', 47186, 8, 1);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (7, 'Ali', 'Traher', '444-446-306', '1974-06-11', '0074 New Castle Center, Baie-Comeau, QC, C8R 8R8, CA', 'F', 70677, 2, 8);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (8, 'Pansy', 'Cammock', '060-154-506', '1989-11-15', '4 Longview Pass, Farnham, QC, Z8U 1W2, CA', 'F', 48648, 4, 7);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (9, 'Carolan', 'Chalkly', '255-601-245', '1958-01-25', '52 Green Crossing, Prévost, QC, G0I 3Z3, CA', 'F', 30042, 10, 4);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (10, 'Pete', 'Poolton', '877-773-955', '1962-01-24', '2 Hallows Parkway, Fermont, QC, L6O 8Q6, CA', 'M', 78665, 4, 1);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (11, 'Emmet', 'Sawforde', '331-648-741', '1986-10-14', '3058 Melody Crossing, Beloeil, QC, U3I 5G1, CA', 'M', 33963, 2, 4);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (12, 'Abagael', 'Pendreigh', '197-983-843', '1975-03-09', '742 Trailsway Plaza, Beloeil, QC, G0U 8L3, CA', 'F', 46414, 6, 6);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (13, 'Erhart', 'Stickley', '313-684-889', '1992-08-05', '6 Mandrake Alley, Dollard-Des Ormeaux, QC, N9Q 0O2, CA', 'M', 74179, 8, 5);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (14, 'Willette', 'Whitehead', '732-603-995', '1967-02-26', '5309 Hoepker Way, Malartic, QC, V8W 6S8, CA', 'F', 49363, 4, 8);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (15, 'Maisie', 'MacGahey', '250-189-782', '1998-09-17', '65 Johnson Center, Adstock, QC, F2H 0L5, CA', 'F', 71853, 5, 1);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (16, 'Ivy', 'Brabyn', '315-971-013', '1997-10-19', '19301 Thierer Point, Oka, QC, Z1L 3F0, CA', 'F', 56249, 8, 3);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (17, 'Wilmar', 'Pavia', '153-734-694', '1958-01-22', '81 Pawling Circle, Beauharnois, QC, R2O 1V9, CA', 'M', 98751, 8, 9);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (18, 'Craggie', 'Grangier', '349-986-760', '1952-07-17', '981 South Lane, Boucherville, QC, Y7S 2K8, CA', 'M', 75178, 10, 5);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (19, 'Dell', 'Hearnes', '215-121-410', '1979-10-07', '069 Hagan Parkway, Montréal-Ouest, QC, H9P 2T7, CA', 'M', 62433, 2, 5);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (20, 'Natalee', 'Mimmack', '333-778-802', '1974-07-28', '089 Corben Center, Saguenay, QC, T0H 3Q2, CA', 'F', 75113, 3, 9);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (21, 'Janifer', 'Dowbakin', '958-657-494', '1961-05-19', '16041 Shasta Center, Berthierville, QC, V6R 7H1, CA', 'F', 65206, 5, 9);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (22, 'Ali', 'Janowicz', '823-775-216', '1969-08-19', '26930 Sunbrook Parkway, Rivière-du-Loup, QC, N9O 4M4, CA', 'F', 84828, 1, 7);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (23, 'Joyan', 'Van', '382-836-501', '1955-07-05', '50009 Pearson Trail, Port-Cartier, QC, T0G 3B9, CA', 'F', 50649, 10, 1);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (24, 'Bruce', 'Boeter', '223-639-673', '1971-01-11', '47220 Northwestern Lane, Côte-Saint-Luc, QC, I5K 4Q3, CA', 'M', 45541, 7, 1);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (25, 'Heindrick', 'Insley', '237-400-867', '1968-03-08', '969 Surrey Parkway, Maniwaki, QC, L7V 8R3, CA', 'M', 78500, 4, 10);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (26, 'Melinda', 'Lough', '336-315-557', '1980-02-02', '84220 Center Park, L''Épiphanie, QC, X8G 6A6, CA', 'F', 87983, 8, 1);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (27, 'Raeann', 'Roscamps', '247-006-931', '1994-09-28', '961 Sauthoff Hill, Saint-Bruno-de-Guigues, QC, M8H 4K6, CA', 'F', 56472, 6, 1);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (28, 'Smith', 'Kirkness', '697-450-056', '1987-06-30', '9439 American Park, Danville, QC, J6K 7R0, CA', 'M', 47245, 7, 4);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (29, 'Brigham', 'Kirkebye', '533-406-685', '1984-05-05', '52163 Portage Street, Sainte-Martine, QC, C3F 5V3, CA', 'M', 57116, 4, 3);
insert into employees (employee_id, first_name, last_name, sin, birth_date, address, gender, salary, dept_id, supervisor_id) values (30, 'Marji', 'Bernardos', '059-920-725', '1966-05-01', '2 Charing Cross Hill, Maniwaki, QC, K0M 4C0, CA', 'F', 56064, 1, 6);
SET FOREIGN_KEY_CHECKS = 1;

# 10 departments
SET FOREIGN_KEY_CHECKS = 0;
insert into departments (dept_id, dept_name, manager_sin, branch, start_date) values (1, 'Business Development', '823-775-216', 'Toronto', '1987-04-09');
insert into departments (dept_id, dept_name, manager_sin, branch, start_date) values (2, 'Marketing', '444-446-306', 'Vancouver', '1984-02-28');
insert into departments (dept_id, dept_name, manager_sin, branch, start_date) values (3, 'Support', '333-778-802', 'Montreal', '1971-11-08');
insert into departments (dept_id, dept_name, manager_sin, branch, start_date) values (4, 'Services', '877-773-955', 'Quebec city', '1960-05-09');
insert into departments (dept_id, dept_name, manager_sin, branch, start_date) values (5, 'R&D', '536-022-935', 'Montreal', '1964-11-24');
insert into departments (dept_id, dept_name, manager_sin, branch, start_date) values (6, 'QA', '247-006-931', 'Kingston', '1960-02-27');
insert into departments (dept_id, dept_name, manager_sin, branch, start_date) values (7, 'Human Resources', '697-450-056', 'Calgary', '1952-04-11');
insert into departments (dept_id, dept_name, manager_sin, branch, start_date) values (8, 'Finance', '153-734-694', 'Montreal', '1986-10-02');
insert into departments (dept_id, dept_name, manager_sin, branch, start_date) values (9, 'Design', '691-925-682', 'Montreal', '1968-01-29');
insert into departments (dept_id, dept_name, manager_sin, branch, start_date) values (10, 'Production', '349-986-760', 'Laval', '1987-11-21');
SET FOREIGN_KEY_CHECKS = 1;

# 20 projects
SET FOREIGN_KEY_CHECKS = 0;
insert into projects (project_id, project_name, dept_id, location) values (1, 'VYL', 1, 'Toronto');
insert into projects (project_id, project_name, dept_id, location) values (2, 'RNA', 6, 'Kingston');
insert into projects (project_id, project_name, dept_id, location) values (3, 'LWV', 7, 'Calgary');
insert into projects (project_id, project_name, dept_id, location) values (4, 'BHH', 10, 'Laval');
insert into projects (project_id, project_name, dept_id, location) values (5, 'OYM', 8, 'Montreal');
insert into projects (project_id, project_name, dept_id, location) values (6, 'XYZ', 10, 'Laval');
insert into projects (project_id, project_name, dept_id, location) values (7, 'HSD', 5, 'Montreal');
insert into projects (project_id, project_name, dept_id, location) values (8, 'QDY', 9, 'Montreal');
insert into projects (project_id, project_name, dept_id, location) values (9, 'SZJ', 2, 'Vancouver');
insert into projects (project_id, project_name, dept_id, location) values (10, 'SFT', 9, 'Montreal');
insert into projects (project_id, project_name, dept_id, location) values (11, 'QJD', 2, 'Vancouver');
insert into projects (project_id, project_name, dept_id, location) values (12, 'TOX', 6, 'Kingston');
insert into projects (project_id, project_name, dept_id, location) values (13, 'BNS', 9, 'Montreal');
insert into projects (project_id, project_name, dept_id, location) values (14, 'HFS', 7, 'Calgary');
insert into projects (project_id, project_name, dept_id, location) values (15, 'VLJ', 4, 'Quebec city');
insert into projects (project_id, project_name, dept_id, location) values (16, 'NDE', 2, 'Vancouver');
insert into projects (project_id, project_name, dept_id, location) values (17, 'ILK', 3, 'Montreal');
insert into projects (project_id, project_name, dept_id, location) values (18, 'VGM', 4, 'Quebec city');
insert into projects (project_id, project_name, dept_id, location) values (19, 'SWH', 1, 'Toronto');
insert into projects (project_id, project_name, dept_id, location) values (20, 'IAY', 6, 'Kingston');
SET FOREIGN_KEY_CHECKS = 1;

# a) Each employee works on at least one project, and 
# e.g. employee with id 14
# b) different employees may work on the same project and spend different hours
# employee with id 24, 17, and 22 work on the same project with id 1
SET FOREIGN_KEY_CHECKS = 0;
insert into works_on (employee_id, project_id) values (14, 16);
insert into works_on (employee_id, project_id) values (14, 13);
insert into works_on (employee_id, project_id) values (3, 14);
insert into works_on (employee_id, project_id) values (27, 6);
insert into works_on (employee_id, project_id) values (24, 1);
insert into works_on (employee_id, project_id) values (20, 2);
insert into works_on (employee_id, project_id) values (17, 1);
insert into works_on (employee_id, project_id) values (5, 3);
insert into works_on (employee_id, project_id) values (15, 16);
insert into works_on (employee_id, project_id) values (9, 7);
insert into works_on (employee_id, project_id) values (27, 17);
insert into works_on (employee_id, project_id) values (18, 12);
insert into works_on (employee_id, project_id) values (23, 6);
insert into works_on (employee_id, project_id) values (17, 4);
insert into works_on (employee_id, project_id) values (1, 14);
insert into works_on (employee_id, project_id) values (15, 6);
insert into works_on (employee_id, project_id) values (26, 14);
insert into works_on (employee_id, project_id) values (9, 18);
insert into works_on (employee_id, project_id) values (14, 13);
insert into works_on (employee_id, project_id) values (22, 1);
insert into works_on (employee_id, project_id) values (24, 19);
SET FOREIGN_KEY_CHECKS = 1;


select * from employees;
select * from departments;
select * from projects;
select * from works_on;
