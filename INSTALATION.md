# Introducion

This document describes instalation, updating and uninstalation of *nanotube-cms*.

## Installation
### Step one - the empty web

Assuming you want to have your web project in `webby` directory. Do
````
    $ mkdir webby
    $ cd webby
    $ git init
````
or 
````
    $ git clone .../webby.git
````

You have the web.

### Step two - add the nanotube sources
Nextly, you have to add the nanotube. Use `git submodule add` to do so:
````
    $ git submodule add https://github.com/martlin2cz/nanotube-cms
````

### Step three - create the web structure
To create the web structure (index, php, js, css) do following:
````
    $ cp -r nanotube-cms/empty-web-template/* .
````

If you now open the webby root directory in the browser (let's assume its `http://localhost/webby`), you shall see something - obviously filled with the errors.

You can now get rid of all the debug stuff by switching nanotube to the production branch for instance by:
````
    $ echo -e "\tbranch = production" >> .gitmodules
    $ git submodule update --remote nanotube-cms/
````

The nanotube-cms directory may now contain only the production code - the subdirectory `nanotube`.

### Step four - create the database
Nanotube need MySQL database. Log in into your favourite MySQL client and create one. It is also recomented to have separate login for nanotube database. Take look at `nanotube-cms/nanoadmin/instalation/init-db.sql` to see one way how to do it.

### Step five - the instalation itself
If you verified nanotube may be working in your environment, you could set up the web. Here starts the interresting things.

Open the browser with `http://localhost/webby/nanotube-cms/nanoadmin`. You will see the login dialog. Log in with following credentials: Username: `nanoadmin`, Password: `his_nano_pa55word`. You'll some errors, but don't worry much about them, you will be logged so. Then go to page `http://localhost/webby/nanotube-cms/nanoadmin/instalation`. If you were really logged in, you'll see page with the few steps. Wallk one by one.

First one creates the web configuration file. If this operation fails, increase the access rules to the `webby/config` directory (for instance by temporary `chmod 777 config/`). Then continue to set up the database connection. Nanotube will then check the connection. If fails, make sure your credentials are correct.

Keep in mind that once you start, you have to complete the instalation. If something would go well, you may probably restart from scratch - delete the generated configuration file (`webby/config/nanoconfig.php`) and re-create the database. 

If the instalation proceeds sucessfully, test the web again. You may now see the real content (the one "hello world" site). If so, you shall create your own admin account and relog to it before any further work. Then you could start to create your web - add some sites, instal plugins and update the template.

The template may be just and subclass of some of the predefined templates. See `nanotube-cms/templates/*/*.php` how it works.

### Step six - deploy to the server
Once you have completed your web at the local side, just simply and as usual `push` your local changes and `clone` or `pull` at the server side. 
````
    $ git commit -m "Web completed and ready to upload to server"
    $ git push
    $ ssh login@webserver.com
    webserver $ cd WEBDIR
    webserver $ git pull
````
You may need to update the nanotube module (`init` obviously only at first run), do so:
````
    webserver $ git submodule init
    webserver $ git submodule update
````

## Update
Update is just simple. Only fetch the latest nanotube, i.e.:
````
    $ git submodule update
````

## Uninstalation
To uninstall nanotube, drop the nanotube database, and remove all the nanotube-related contents (inc. the submodule). 

