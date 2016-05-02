Git PHP Admin
================
Simple HTML UI written in PHP for executing GIT commands from web page.
I met a lot of people who have to work with GIT, but have no permissions for using SSH.
So they need to pull new version of the project to server or push it back (in case of old-fashioned FTP development without local copy)

Requirements
---------
* PHP >= 5.0
* Git installed

Bower components (Bootstrap, jQuery, Font Awesome) is already included and linked.

Installation
------------
### Manually
1. Download the project in zip to subdirectory of your git root
2. (optional) if you cannot run webpage from first subdirectory level, change the working directory in the script, it is defined by
```php
define('GIT_ROOT', dirname(__DIR__));
```

What is necessary
---------
1. repo has to be initialized "git init" with web server (typically apache) user (so from this interface)
2. repository has to be set manually "git add origin https://username/server.com/myproject.git
3. credetials has to be set to remember "git config credential.helper store"
4. first push has to be mady manually to get the password "git push --force origin master"
5. all files has to be accessible for Apache user

If you do not know how to do it, you can Google it, I will later write some manual.

What is implemented
----------
* Git initialization
* Commit with notice and author info
* Push to repository
* Pull from repository

What should be implemented in near future
----------
* Custom Git directory (no it has to be set inside the script)
* Adding repository
* Saving the credentials
* Checking rights
* --force versions of the commands

Support
-------
If you have some problems, please post them here.

Licence
-------
This project is under [MIT](http://opensource.org/licenses/MIT) license.