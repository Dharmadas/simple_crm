This project is developed using LARAVEL framework in PHP.
The project is tested with following versoins:
php 7.1
apache 2.4
mysql 5.6
composer should be installed on your system.(https://getcomposer.org/download/)

You can clone/download the project and follow below steps:
1. Through command prompt go to project directory where you cloned/downloaded.
2. Rename .env.example to .env
3. Create a database crm or you can edit the .env file and change the database name that you already created.(If you have already created db, don't create any table inside it)
4. Create mysql user crm or you can create new mysql user and grant ALL access to crm database or your database that you created.
5. Change the mysql user password in .env file
6. Give write access to storage/ directory e.g. chmod -R 777 storage/
7. In addition, make sure that the rewrite module is enabled for your web server.
8. Go to project directory though command prompt. e.g. cd /var/www/html/simple_crm
9. Run command php artisan key:generate
10. Run command php artisan migrate --seed
11. Go to browser and open http://your-website/simple_crm/public OR you can change host file and change DocumentRoot to http://your-website/simple_crm/public
12. Default email-id is admin@admin.com and password is password. Please login to the interface and go Users. Then modify Admin user and change password.