# Restaurant-Application

ZendSkeletonApplication
Introduction

This is a skeleton application using the Zend Framework MVC layer and module systems. This application is meant to be used as a starting place for those looking to get their feet wet with Zend Framework.
Installation using Composer

The easiest way to create a new Zend Framework project is to use Composer. If you don't have it already installed, then please install as per the documentation.

To create your new Zend Framework project:

$ composer create-project -sdev zendframework/skeleton-application path/to/install

Once installed, you can test it out immediately using PHP's built-in web server:

$ php -S 0.0.0.0:8080 -t public/ public/index.php

This will start the cli-server on port 8080, and bind it to all network interfaces.

Note: The built-in CLI server is for development only.
Development mode

The skeleton ships with zf-development-mode by default, and provides three aliases for consuming the script it ships with:

<code>

$ composer development-enable  # enable development mode 

$ composer development-disable # enable development mode

$ composer development-status  # whether or not development mode is enabled 

</code>

You may provide development-only modules and bootstrap-level configuration in config/development.config.php.dist, and development-only application configuration in config/autoload/development.local.php.dist. Enabling development mode will copy these files to versions removing the .dist suffix, while disabling development mode will remove those copies.
Running Unit Tests

To run the supplied skeleton unit tests, you need to do one of the following:

    During initial project creation, select to install the MVC testing support.

    After initial project creation, install zend-test:

    $ composer require --dev zendframework/zend-test

Once testing support is present, you can run the tests using:

$ ./vendor/bin/phpunit


Web server setup
Apache setup

To setup apache, setup a virtual host to point to the public/ directory of the project and you should be ready to go! It should look something like below:

<VirtualHost *:80>
    ServerName zf2-app.localhost
    DocumentRoot /path/to/zf2-app/public
    <Directory /path/to/zf2-app/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
        <IfModule mod_authz_core.c>
        Require all granted
        </IfModule>
    </Directory>
</VirtualHost>
