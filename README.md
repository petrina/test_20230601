After cloning the project, follow these steps:

1. Open the terminal in the root directory of the project. Execute the commands 'sudo chmod -R 777 storage', 'composer install', 'npm install' and 'npm run dev' to set the necessary permissions and install the project dependencies .

2. Open another terminal in the root folder of the project. With Docker installed, execute 'docker-compose build' in the terminal to build the Docker environment.

3. 'docker-compose up -d'

4. Once Docker has been built, use the command 'docker exec -it app sh' to access the Docker container's shell.

5. Inside the Docker container, execute 'php artisan migrate' to perform the database migrations.
6. The .env settings should be configured as follows:

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=password

7. The application is accessible at http://localhost:8000/ and the adminer is accessible at http://localhost:8080/

For Adminer access, use the following credentials:

'mysql'

'db'

'root'

'password'

'laravel'
8. Run tests. In the PHP Artisan container, run 'php artisan test'.


