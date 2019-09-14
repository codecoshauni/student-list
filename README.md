See [my app](http://b29825zy.beget.tech/) on hosting.
# Students list
Simple CRUD PHP application with authorization by cookie-token and displaying a list of students with sorting, searching and pagination. MVC architecture, dependency injection, table data gateway and routing were used.

### Requirements
* [PHP] >= 7.0
* [MySql] = 8.0

### Installation
1. Clone the repository using `git clone https://github.com/codecoshauni/student-list.git` command
2. Set `public` directory as a document root on your web server
3. Configure URL rewriting on your web server (Example for Apache):

    Create in you `public` directory `.htaccess` file containing this code:
    ```
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule .* index.php [L]
    ```
4. Set your database settings in `src/dbconfig.ini` configuration file
5. Import `students-dump.sql` in your MySql database
