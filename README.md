# App

### Requirements
* Apache 2
* PHP 7.0
* MySQL 5.7
* Node JS 6.x
* Apache Cordova 7.x
* Depends of Yii2
**NOTE:** You can install XAMPP to complete the requirements.

### Install development environment
* Clone the repository
* Install db of the project.
* Change the **user**, **password** and **database** in the *web/common/config/main-local.php*.
* Create a symbolic link to the path of the **web** folder repository *toget* and other to the **movil** folder into the *public_html* folder from the server.
* Replace the string *"/proyects/toget/web"* for the route to *web* folder into the server, in the file *.htaccess* from *web* folder.
* Enter in the browser [http://localhost/route_to_movil/www/](http://localhost/route_to_movil/www/) to see the mobile app.
* Enter in the browser [http://localhost/route_to_web/](http://localhost/route_to_web/) to see the web app.

**NOTE:** It's not necessary upload the *web/common/config/main-local.php* file to the repository.
