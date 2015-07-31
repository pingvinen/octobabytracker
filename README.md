BabyTracker
===========

Database stuff
--------------

Default database values (remember to replace `***` with your password).

```sql
CREATE DATABASE `babytracker` /*!40100 DEFAULT CHARACTER SET utf8 */;
create user 'babytracker'@'localhost' identified by '***';
grant all on `babytracker%`.* to 'babytracker'@'localhost';
flush privileges;
```
