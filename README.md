# Restaurant-Application

## Theory

The Restaurant - Application is an open source project for everyone who needs an order system for the restaurant.

This system is seperated into three view fields. 
1. Manager
2. Waitress
3. Kitchen

1 Manager 
- the Manager is like the admin of this system. He can create a card with all articles and also create as many waitress as needed.
- he has controll about the daily, weekly, monthly and yearly income of the restaurant. He can see every action from the waitress.

2. Waitress
- 



## Technicals




<pre>
$ composer development-enable   
$ composer development-disable
$ composer development-status 
</pre>

Web server setup
Apache setup
virtual host 

<pre>
<VirtualHost *:80>

    ServerName zf2-app.localhost

DocumentRoot /path/to/z3-app/public

<Directory /path/to/zf3-app/public>

    DirectoryIndex index.php
    
    AllowOverride All
    
    Order allow,deny
    
    Allow from all
    
    <IfModule mod_authz_core.c>
    
    Require all granted
    
    </IfModule>
    
 </Directory>

</VirtualHost>
</pre>
