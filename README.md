# Api
Prueba ingeniero/tecnólogo de Integraciones

## Installation
- **Install a server side application. Example: Xampp, Wamp, Lampp, Laragon, etc.**
- **Clone the repository on the root. (htdocs for xampp and wamp, etc).**
- **Open terminal and run the following commands:**
     * -cd api
     * -composer install
     * -npm install
     * -cp .env.example .env
     
 - **Create database api:**
     * -mysql -u root
     * -create database laravel;
     * -exit
     * -php artisan migrate
     
 - **Open terminal and run the following commands-test:**
      * -cp .env.testing.example .env
      * -php artisan test
      
 - **Create database test:**
      * -mysql -u root
      * -create database testing;
      * -exit
      
- **To finish and deploy the application, run the command:**
   * -php artisan optimize:clear
   * -php artisan serve
