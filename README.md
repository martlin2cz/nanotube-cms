# nanotube-cms
The content managment system tiny as nanotubes!

Extremelly small, lightweight, but amazingelly powerful CMS.

Take a look into `_samples` directory to see how to use.

Some preview images:

## Main concepts

### Sites

Everything is about the sites. Your web is composite of sites. No categories, tags and other 'crap'. Just list of sites.

### Admins

The build-in administrative tool, nanoadmin allows access to multiple admins. Each admin has its credentials. There is no secrets, one admin can easily modify data of another (i.e. if forgets password). nanotube assumes admins knows and trusts themselves to not to do anything bad to others.

### Templates

In nanotube I say, you never can make precise web design without programing or HTML/CSS coding. So, templates, the-how-the-final-web-page-would-like is just a PHP class. You can override one of provided or you can implement completelly custom.

### Plugins

Simillarly to templates, plugin is also just a class. Inserting plugin into page is just a calling function (or method). Each plugin can be installed (if needs) and provide some configuration.

### Configuration

The configuration of whole web is centralized and stored in one file and done in one form.

### The last one turns the lights off

When everything fails, the nanotube allows you to log in into nanoadmin using built-in ('superuser') nanoadmin. Because of huge security risk, this user (in fact only his password, another nanoadmin correctly sits in database) is avaible only when database is offline.

## Samples

See directory `_samples` to see how your web can look like. See dictory `_about` to see some graphics (logos and screenshots).

## Installation
To install nanotube clone into required folder on your server. Then, open in browser adress `ROOT/nanotube-cms/nanoadmin/` (where ROOT is url of your app). Log in using the nanoadmin (u: nanoadmin, p: his\_nano\_password) and open site `ROOT/nanotube-cms/nanoadmin/instalation/`. Then follow the instructions. After installation you should open Web config site and 1) specify links format and 2) change nanoadmin's password.

### Create template

Then choose one of the samples (recomended), copy its directory content into ROOT and - you can start to design your web! When complete, you should delete everything starting with `_` (`$ rm -r _*`) from ROOT.

### Implement plugin

Go to directory `ROOT/nanotube-cms/plugins/core/HelloWorld` and take a look how plugins in nanotube works. Clone this directory (you should create new category directory, instead of creating new plugin as core plugin) and - do as you want.

### Updating

If new update is done (I don't think this is gonna ever happen), just update the `ROOT/nanoadmin-cms/` directory. And also, check your template and config file.

### Uninstall

The uninstallation is currently not supported. But - you just have to remove all files and delete database. Look into your database, nanotube tables are prefixed with `nt`.

## Anything?

Contact me!
