Camdram
========================

The portal website for student theatre in Cambridge

[![Build Status](https://travis-ci.org/camdram/camdram.png?branch=master)](https://travis-ci.org/camdram/camdram)

Camdram is an open source project developed for the benefit of the Cambridge student theatre community. Anyone can contribute to the bugs and new features. Below are the steps required to set up a development checkout of Camdram. For the sake of brevity, these instructions assume that the reader is familiar with a number of technologies, such as developing on a Linux based platform, using Git and Github. A brief overview of the software stack can be found [here](https://github.com/camdram/camdram/wiki/Software-Stack). [Github's help](http://help.github.com) is comprehensive and can be used to find more information about using Git in general. 

If you encounter any problems with the instructions below, please [create a Github issue]( https://github.com/camdram/camdram/issues/new) or send an e-mail to websupport@camdram.net. 

1) Install programs
--------------------

Use one of the following commands to install the necessary packages required to run Camdram

###Debian-based distributions, e.g. Ubuntu

    $ sudo apt-get install git-core php5 php5-cli curl php5-curl php5-intl php5-sqlite php-apc php5-gd php5-json

###RPM-based distributions, e.g. Fedora

    $ sudo yum install git php php-cli curl php-intl php-pdo php-gd

###OSX
    
Make sure you have [Macports]( https://www.macports.org/) installed and up to date.

    $ sudo port install git php55 php55-curl php55-intl php55-sqlite php55-openssl php55-mysql php55-mbstring php55-gd

Additionally, make sure to replace every invocation of "php" with "php55" below.

2) Get a copy of the Camdram repository
----------------------------------------------

Camdram's development model follows the standard idioms used by FOSS projects hosted on Github. If you are interested in just experimenting with the codebase, clone the project from the project's homepage. If you'd like to contribute to the project than you will want to [fork the repository](https://help.github.com/articles/fork-a-repo).

After obtaining a copy of the code change into the newly created 'camdram' directory before proceeding:

    cd camdram

3) Install PHP dependencies
-------------------------------

Symfony (and therefore Camdram) uses [Composer](https://getcomposer.org/) to download the PHP libraries it uses. First, install composer locally inside the Camdram source code folder:

    curl -sS https://getcomposer.org/installer | php

This downloads a file named 'composer.phar'. Run this to download all the PHP libaries:

    php composer.phar install -n
    
If this generates an error `unable to open database file`, check if the subdirectory app/data exists.  If not, create it (`mkdir app/data`).  

If app/data/orm.db and app/data/odm.db already exist, delete them or chown them to your user and try again.

4) Create a database
---------------------------

Run the command below to generate a SQLite datastore which contains randomly-generated sample data

    php app/console camdram:database:update
    
Should this (or any other php commands) produce 'out of memory' errors ("allowed memory size exhausted" or similar), you can allow more memory for this command only like this:

    php -d memory_limit=512M app/console camdram:database:update

This is most likely to happen with database updates and calls to `composer.phar`.  Naturally you need to consider how much memory (RAM) your system has available.

5) Run the web server
---------------------------

Run `php app/console server:run` to start a web server. You should then be able to visit [http://localhost:8000/app_dev.php](http://localhost:8000/app_dev.php) in your web browser to see your personal version of Camdram's homepage.

The 'app_dev.php' in the URL launches Camdram in the 'development' environment, which is optimized for the frequent code changes that occur when doing development work. It also contains a useful toolbar at the foot of the page which contains, amongst other information, useful information about load times, memory usage and the number of SQL queries run. [Read more about Symfony's environments here](https://github.com/camdram/camdram/wiki/The-Symfony-environments), including information about how to use the 'production' environment.

If this produces a Date/Time related error, make sure that the function "date.timezone" is set in php.ini

6) Read the Wiki
----------------

[The Wiki][1] has various pieces of information about both the current and in-development 
versions of Camdram. Reading through those pages can give insight into the more esoteric
parts of the system.

The following wiki pages detail how to create a server set-up that's more similar to the live version of Camdram:

 * [Setting up an Apache virtual host](https://github.com/camdram/camdram/wiki/Setting-up-an-Apache-virtual-host)
 * [Setting up a MySQL database](https://github.com/camdram/camdram/wiki/Setting-up-a-MySQL-database)
 * [External API registration](https://github.com/camdram/camdram/wiki/API-registration)
 * [Sphinx setup guide](https://github.com/camdram/camdram/wiki/Sphinx%20setup%20guide)

You can also [read information about Camdram's suite of tests](https://github.com/camdram/camdram/wiki/Running-and-creating-tests)

7) Pull in other people's changes
-------------------------------------

At a later date, once your local repository has become out of sync with Gituhb (because other people have committed code), you can run the following commands to pull in other people's changes and update your checkout:

    git pull
    php composer.phar install
    php app/console camdram:database:update

This will pull in the latest code, update any changes to the dependencies and update the database. If you have forked the project then be sure that you have followed all of the instructions in the help guide, particularly noting the need to [configure remotes](https://getcomposer.org/). The second and third command may not be necessary if no one has recently changed the dependencies or database schema, but there's never any harm in running them (apart from database camdram:database:update with a SQLite, which completely drops and recreates the whole database).


8) Write some code
--------------------

 * The site uses the Symfony PHP framework - (read the documentation)[http://symfony.com/doc/2.3/index.html]
 * Use the Github issue tracker to get an idea what we're currently working on.
   If you think you know how to do something, write the code, commit it, and 
   submit a pull request.
 * If you want to discuss how to implement a new feature or how to fix a bug, 
   get in touch with one of the developers. It would probably be wise to get in
   touch before starting on any significant projects to avoid wasted effort!
 * Visit http://try.github.io/ if you're not familiar with Git.
 * Code should ideally conform to the style guide here: http://www.php-fig.org/psr/psr-2/.  
   If this is far too daunting, a poorly styled but functional improvement is better than no improvement.
   You can use http://cs.sensiolabs.org/ to (mostly) clean your code up after writing it.

9) Check your code 
--------------------

Depending on the type of change, make sure to check it works as a logged-in and/or non-logged in visitor.

You can log in to your local instance of Camdram with one of three default accounts:
 * user1@camdram.net
 * user2@camdram.net
 * admin@camdram.net (this is an admin user)

The password for each is just 'password'.  

10) Commit some code
----------------------

 * Run `git add file1.php file2.php` for each file you wish to include in the commit
 * Run `git commit` and enter a message describing the changes you have made
 * Run `git push` to send your changes to Github

It is good practice to include the relevant issue number (prefixed with a hash #) at the end of the commit message - this will cause your commit message to appear on the issue page on Github.

[1]: http://github.com/camdram/camdram/wiki
