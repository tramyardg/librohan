```
Concordia University
Dept. of Computer Science & Software Engineering
COMP 353 – Databases
Warm-up Project
```
Title: Shipping Company
Due: February 20, 2019
Maximum Mark: 6%

In this project, you and your group are required to develop a miniature database application system,
described below, and evaluate a number of queries and transactions against the database. For this,
you should use the faculty MySQL DBMS through the Group Account assigned to your group –
a string of the form ”xyc3534”, for some letters x and y. The PODs during the lab sessions will
help you resolve possible problems you may have, for instance, connecting or interacting with the
DB server.

# Project Description

A Canadian company needs your help to manage their data. The includes the following information
about their employees, departments, branches, and projects. For each employee, the company
records the employee ID, first name, last name, social insurance number (SIN), birthdate, address,
gender, salary, the department he/she works in, and the immediate supervisor to whom he/she
reports. For each project, the company records the project name and ID, the department to which
it belongs, and the location (city) in which the project is being carried out. For the purpose of
benefits, the company records information about the dependents of the employees. This information
includes, dependent name, gender, birthdate, and the relationship to the employee (spouse, son,
daughter, etc). Each employee works on at least one project, and different employees may work
on the same project and spend different hours. The information recorded for each department
includes department name, ID, its manager (SIN), and the start date of the manager. Finally, each
department can have branches/offices in several cities.

1. Express the company information in the E/R model. Use arrows to indicate the constraints
    on the relationships. Underline the key attributes for the entity and relationship sets.
2. Convert the E/R diagram into 6 relations: Employees, Departments, Projects, WorksOn,
    DeptLocations, and Dependents.
3. Write SQL scripts to create the Company database and populate the tables with appropriate
    data. Also write SQL scripts of the queries and transactions given below. Include at least 10
    representative tuples in each table so that the result of each query includes at least one tuple.
    Note that the Graphical User-Interface (GUI) is not required in this project but encouraged.
    
       1. Find the birth date and address of every employee(s) whose first name is ”Smith.”
       2. Find all the employees who work for the ”R&D” department.
       3. For each project carried out in Montreal, list the project ID, the ID of the department
          in charge, and the name of the department’s manager.
       4. For each department, list the projects carried out by employees in that department,
          ordered by department’s name and projects’ names.
       5. Find the average salary of the employees in each department.
       6. Show the resulting salaries if the salary of every employee working on the project ”XYZ”
          is raised by 11%.
       7. For each employee, list the number of dependents who were born before the year 2010

# Project Report: Structure and Contents

Each group should submit their project report through Moodle before the deadline, one report per
group. The report should include the following parts. (1) DESIGN: The E/R diagram of the design
of the database given in the project description (or a revised version, if deemed necessary). (2)
The SQL statements formulated and used to create the database. Pick appropriate data types for
the attributes and include them in your report. (3) The SQL statements formulated to express the
required queries and transactions mentioned. (4) Populate each table in the database with at least
10 representative and appropriate tuples. (5) For each relationRcreated in your database, report
the result of the following SQL statement:

```
SELECT COUNT(*) FROM R;
```
A Final Note:Your report should also include the Originality FORM as the cover page that is
signed by EVERY member of the group. The cover page should also include the name and ID of
every member of the group members together with the ”Group Account” assigned by Stan’s email
confirmation of your group registration.

---
The version of MYSQL in use this term is `5.6.43` and PHP is version `7.2.11`.

To run mysql use the following:
```
[login] 101 => mysql -h cqc353.encs.concordia.ca -u cqc353_4 -p cqc353_4
Enter password: c353dbms
```

---
To access the web pages
- [https://cqc353.encs.concordia.ca/](https://cqc353.encs.concordia.ca/)
- username/password: cqc353_4/c353dbms
