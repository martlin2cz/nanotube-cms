# nanotube-cms
The content managment system tiny as nanotubes!

Extremelly small, lightweight, but amazingly powerful CMS. Made for small personal presentations. No categories, no comments, no menu creation, no user roles. No bilions of bilions of templates and plugins.

![logo](https://cdn.rawgit.com/martlin2cz/nanotube-cms/master/_about/logo.png)

Take a look into `_samples` directory to see how to use.

Some preview images:
![sample web](https://cdn.rawgit.com/martlin2cz/nanotube-cms/master/_about/screen-sample1.png =300x)
![welcome site of nanoadmin](https://cdn.rawgit.com/martlin2cz/nanotube-cms/master/_about/screen-nanoadmin-welcome.png =300x)
![edit site form](https://cdn.rawgit.com/martlin2cz/nanotube-cms/master/_about/screen-nanoadmin-edit-site.png =300x)
![admins table](https://cdn.rawgit.com/martlin2cz/nanotube-cms/master/_about/screen-nanoadmin-admins.png =300x)
![installation wizzard](https://cdn.rawgit.com/martlin2cz/nanotube-cms/master/_about/screen-nanoadmin-installation.png =300x)

## Main concepts

### Sites

Everything is about the sites. Your web is composite of sites. No categories, tags and other 'crap'. Just sites.

### Admins

The build-in administrative tool, nanoadmin allows access to multiple admins. Each admin has its credentials. There is no secrets, one admin can easily modify data of another (i.e. if forgets password). nanotube assumes admins knows and trusts themselves to not to do anything bad to others.

### Templates

In nanotube I say, you never can make precise web design without programing or HTML/CSS coding. So, template, the-how-the-final-web-page-would-like is just a PHP class. You can override one of provided or implement completelly custom. 

### Plugins

Simillarly to templates, plugin is also just a class. Inserting plugin into page is just a calling function (or method). Each plugin can be installed (if needs) and provide some configuration.

### Configuration

The configuration of whole web is centralized and stored in one file and done in one form.

### The last one turns the lights off

When everything fails, the nanotube allows you to log in into nanoadmin using built-in ('superuser') nanoadmin. Because of huge security risk, this user (in fact only his password, another nanoadmin correctly sits in database) is avaible only when database is offline.

## Usage

### Install nanotube
To install nanotube clone into required folder on your server. Then, open in browser adress `<ROOT>/nanotube-cms/nanoadmin/` (where `<ROOT>` is url of your web). Log in using the nanoadmin (u: nanoadmin, p: his\_nano\_password) and open site `<ROOT>/nanotube-cms/nanoadmin/instalation/`. Then follow the instructions. After installation you should open Web config site and change nanoadmin's password.

### Create web

Easiest way how to create your web is to clone provided sample webapp and modify. Copy contents of folder `_sample_web` into your `<ROOT>/` folder. Take a look into `templates` folder. Try rename (move) some of template files there to `MyTemplate.php` to became active. Choose one which fits your requirements the most or particullary modify it. Also, setup resources (styles, scripts and images).

### Web ready, add content

When complete, you should delete everything starting with `_` (`$ rm -r _*`) from `<ROOT>` and your web is ready. You can log in into nanoadmin (`<ROOT>/nanotube-cms/nanoadmin/`) and add some sites. 

### Implement plugin

Go to directory `<ROOT>/nanotube-cms/plugins/core/HelloWorld` and take a look how plugins in nanotube works. Clone this directory (you should create new category directory, instead of creating new plugin as core plugin) and - do as you want.

### Updating

If new update of nanotube is released (I don't think this is gonna ever happen), just update the `<ROOT>/nanoadmin-cms/` directory. And also, check your template and config file.

### Uninstall

The uninstallation is currently not supported. But - you just have to remove all files and delete database. Look into your database, nanotube tables are prefixed with `nt`.

## Anything?

Contact me!
