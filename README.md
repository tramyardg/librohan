# Setup
1. Download or clone this repo.
- https://github.com/tramyardg/librohan.git
2. Configure [`database.ini`](https://github.com/tramyardg/librohan/blob/master/database.ini) file to match your MySQL database environment
```
; MySQL database configuration file

host = "localhost"
port = "3306"
user = "root"
password = ""
dbname = "librohandb"
charset = "UTF-8"
```
3. Import [`schema.sql`](https://github.com/tramyardg/librohan/blob/master/db/schema.sql) to phpMyadmin or copy and paste it to MySQL terminal
4. You can then access the app here: http://localhost/librohan/index.php
