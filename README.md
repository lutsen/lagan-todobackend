Lagan Todo-Backend
==================

A [Todo-Backend](http://www.todobackend.com/) example built with [Lagan](https://www.laganphp.com/).


Requirements
------------

- PHP 5.5 or newer
- A database. I use MySQL in this repo for now, but others should work as well. [Check out the RedBean documentation for that](http://redbeanphp.com/index.php?p=/connection).
- An Apache webserver if you want to use the .htaccess URL rewriting. But other webservers should work as well; [check out the Slim documentation for that](http://www.slimframework.com/docs/start/web-servers.html).
- [PDO plus driver for your database](http://php.net/manual/en/book.pdo.php) (Usually installed)
- [Multibyte String Support](http://php.net/manual/en/book.mbstring.php) (Usually installed too)



Install Lagan Todo-Backend
==========================

First install Lagan Todo-Backend and its dependencies with [Composer](https://getcomposer.org/) with this command: `$ php composer.phar create-project lagan/lagan-todobackend [project-name]`  
(Replace [project-name] with the desired directory name for your new project)

The Composer script creates the *cache* directory, *config.php* file and RedBean *rb.php* file for you.

Update *config.php* with:
- your database settings
- your server paths
- the admin user(s) and their password(s)

Lagan uses [Slim HTTP Basic Authentication middleware](http://www.appelsiini.net/projects/slim-basic-auth) to authenticate users for the admin interface. Make sure to change the password in *config.php*, and use HTTPS to login securely.



About the Lagan Todo-Backend
============================


Todo content model
------------------

The Lagan Todo-Backend uses the Todo content model. This is in the *Todo.php* file in the *models/lagan* directory. It contains a type, a description and an aray with different content properties, just like any Lagan model.

If you want to work with Lagan, you can add your own content models by just adding class files like this to the *models/lagan* directory. Lagan will automatically create and update database tables for them. Nice!


Property types
--------------

The Todo content model the Boolean, Hashid, Slug and String property types. All property types have their own Lagan Property type controller. Each property type controller is a dependency, added with Composer using the *composer.json* file. This way new property types can be developed seperate from the Lagan project code. There are many more Lagan property type controllers available.


Todo-Backend API routes
-----------------------

The Todo-Backend API routes are in the *todobackend.php* file in the *routes* directory.

All routes in this directory are automatically included in your Lagan app.


Admin interface
---------------
Lagan comes with a web interface that is "automagically" created. You can enter the Lagan web interface by going to the */admin* directory on the webserver where you installed Lagan. Here you can log in with the username and password you added in the *config.php* file. Now you can add or edit content objects based on the Lagan models.



Why use Lagan?
==============

- Content models are easily created and modified
- Content models consist of a simple combination of arrays
- Content models can be any combination of properties
- Configuration and editing are separated
- All configuration is done by code, so developers are in control there
- Content can be edited with a web interface, so editors can do their thing
- The web interface is automagically created
- Lagan is built on proven open-source PHP libraries:
  - [Slim framework](http://www.slimframework.com/)
  - [RedBean ORM](http://redbeanphp.com/)
  - [Twig template engine](http://twig.sensiolabs.org/)
- It is easy to extend with new content property types


More about Lagan
----------------

You can learn more about Lagan on the [Lagan website](https://www.laganphp.com/).



Lagan is a project of [Lútsen Stellingwerff](http://lutsen.land/) from [HoverKraft](http://www.hoverkraft.nl/), and started as the backend for [Cloud 9](https://www.cloud9.world/).