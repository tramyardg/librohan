1. Find the **birth date** and **address** of every **employee(s)** whose **first name** is _”Smith"._
```sql
SELECT
  birth_date,
  address
FROM employees
WHERE first_name = 'Smith';
```

2. Find all the **employees** who work for the _”R&D”_ **department**.
```sql
SELECT
  e.first_name,
  e.last_name
FROM employees e, departments d
WHERE e.dept_id = d.dept_id
      AND d.dept_name = 'R&D';
```

3. For each **project** carried out in **Montreal**, list the **project ID**, the **ID of the department** in charge, and the **name** of the **department’s manager**.
```sql
SELECT
  p.project_id,
  p.project_name,
  d.dept_id,
  e.last_name as 'manager''s last name'
FROM projects p, employees e, departments d
WHERE p.dept_id = d.dept_id
AND d.manager_sin = e.sin
AND p.location = 'Montreal';
```

4. For each **department**, list the **projects** carried out by **employees** in that department, **ordered by department’s name** and **projects’ names**.
```sql
select p.project_name, d.dept_name, e.employee_id
    from projects p, employees e, departments d
    where p.dept_id = d.dept_id
    and d.manager_sin = e.sin
    order by d.dept_name;
```

5. Find the **average salary** of the **employees** in each **department**.
```sql
SELECT
  d.dept_name   AS 'department name',
  avg(e.salary) AS 'average salary'
FROM employees e, departments d
WHERE e.dept_id = d.dept_id
GROUP BY d.dept_name;
```

6. Show the resulting **salaries** if the salary of every **employee** working on the **project** _”XYZ”_ is raised by _11%_.
```sql
select distinct e.employee_id, e.first_name, e.last_name,
e.salary+(e.salary*0.11) as "salary raised by 11%"
from employees e, projects p, works_on w
where e.employee_id = w.employee_id
and p.project_id = w.project_id
and p.project_name = 'XYZ';
```

7. For each **employee**, list the number of **dependents** who were **born** before the year _2010_.
```sql
select * from dependents where birth_date < "2010-12-30";
```
