# Simple CRM Solution
This is a plug and play tool that can be used by any team.

## Getting Started
You can clone/download the project and follow the steps. It will create a crm with all backend and frontend set up for you.
Then you will have to create users and other stuff like business units, departments etc. to make it personal for your team.

### Prerequisites
This project is developed using LARAVEL framework in PHP.
You need a webserver for this project. You can also run the project on your localhost and test it.
You also need following packages installed on your webserver:
* php 7.1 
* apache 2.4 
* mysql 5.6 

### Installing & Deployment
* Create a database named crm in mysql.
* Create mysql user crm and grant ALL access to crm database.
* Through command prompt go to project directory where you cloned/downloaded the project. e.g. ```cd /var/www/html/simple_crm```
* Rename file .env.example to .env e.g. ```mv .env.example .env```
* Change the mysql DB_USERNAME and DB_PASSWORD values in .env file
* Give write access to storage/ directory e.g. ```chmod -R 777 storage/```
* Run command ```php artisan key:generate```
* Run command ```php artisan migrate --seed```
* Go to browser and open http://your-website/simple_crm/public

## Built With
Laravel 5.6

## Notes
* Default email-id to log in crm is admin@admin.com and password is password. Please login to the interface and go to Users. Then modify Admin user and change password.
* Make sure that the rewrite module is enabled for your web server. Mostly this is enabled by default. read morehttps://www.digitalocean.com/community/tutorials/how-to-set-up-mod_rewrite-for-apache-on-centos-7
* you can change host file and point DocumentRoot to http://your-website/simple_crm/public if you want to hide the full path of project.
