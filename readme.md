This project is developed using LARAVEL framework in PHP.
The project is tested with following versoins:
php 7.1
apache 2.4
mysql 5.6

You can clone/download the project and follow below steps:
1. Create a database crm or you can edit the .env file and change the database name that you already created.
2. Create mysql user crm or you can create new mysql user and grant ALL access to crm database/your database that you created.
3. Change the mysql user password in .env file
4. Give write access to storage/ directory e.g. chmod -R 777 storage/
5. In addition, make sure that the rewrite module is enabled for your web server.
6. Go to project directory though command prompt. e.g. cd /var/www/html/simple_crm
7. Run command php artisan migrate --seed
8. Go to browser and open http://your-website/simple_crm/public
