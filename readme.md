This project is developed using LARAVEL framework in PHP.
The project is tested with following versoins:
<br/>php 7.1
<br/>apache 2.4
<br/>mysql 5.6
<br/>composer should be installed on your system in case you want to make further developments.(https://getcomposer.org/download/) but not compulsory.

You can clone/download the project and follow below steps:
1. Create a database named crm in mysql.
2. Create mysql user crm and grant ALL access to crm database.
3. Through command prompt go to project directory where you cloned/downloaded the project. e.g. cd /var/www/html/simple_crm
4. Rename file .env.example to .env
5. Change the mysql DB_USERNAME and DB_PASSWORD values in .env file
6. Give write access to storage/ directory e.g. chmod -R 777 storage/
7. Run command php artisan key:generate from command prompt
8. Run command php artisan migrate --seed
9. Go to browser and open http://your-website/simple_crm/public OR you can change host file and change DocumentRoot to http://your-website/simple_crm/public

Note: 
1. Default email-id to log in crm is admin@admin.com and password is password. Please login to the interface and go to Users. Then modify Admin user and change password.
2. Make sure that the rewrite module is enabled for your web server. Mostly this is enabled by default. read more
https://www.digitalocean.com/community/tutorials/how-to-set-up-mod_rewrite-for-apache-on-centos-7
