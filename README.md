# Part 1 - Contributions of Group Members

* Yifei GAO - 299905@university-365.com : Analyze project requirements and write project requirements instruction manual.
* Huiyang HU - 299889@university-365.com : Verify the result, make the project implementation plan, and supervise the construction progress.
* Xin WANG - 	299902@university-365.com : Test code, sort questions, and write a problem feedback manual.
* Chu WANG - 299953@university-365.com : design database structure, design web layout, define models and controllers, and write code.

# Part 2 - How to install this system on a new machine

1. Open mysql service.
2. Create a new database called ***carnival***.
3. Copy and paste ***.env.example*** file, and rename it to ***.env***.
4. Customize ***.env*** file: change the ***DB_USERNAME*** and ***DB_PASSWORD*** to your database user, change the ***CARNIVAL_DAYS*** to how long the carnival will take(integer), and change ***CURRENT_DAY*** to which day it is now(value from 0 to ***CARNIVAL_DAYS***).
5. Run ***composer install*** command in current folder.
6. Run ***npm install*** command in current folder.
7. Run ***npm run dev*** command in current folder.
8. Run ***php artisan migrate*** command in current folder.
9. Run ***php artisan key:generate*** command in current folder.
10. Run ***php artisan serve*** command in current folder.
11. The website will be served on ***localhost:8000***.