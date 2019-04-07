# nanotube-cms
The content managment system tiny as nanotubes!

Extremelly small, lightweight, but amazingly powerful CMS. Made for small personal presentations. No categories, no comments, no menu creation, no user roles. No bilions of bilions of templates and plugins.

![logo](https://raw.githubusercontent.com/martlin2cz/nanotube-cms/master/_about/logo.png)


Some preview images:
![sample web](https://raw.githubusercontent.com/martlin2cz/nanotube-cms/master/_about/screen-sample1.png =300x)
![welcome site of nanoadmin](https://raw.githubusercontent.com/martlin2cz/nanotube-cms/master/_about/screen-nanoadmin-welcome.png =300x)
![edit site form](https://raw.githubusercontent.com/martlin2cz/nanotube-cms/master/_about/screen-nanoadmin-edit-site.png =300x)
![admins table](https://raw.githubusercontent.com/martlin2cz/nanotube-cms/master/_about/screen-nanoadmin-admins.png =300x)
![installation wizzard](https://raw.githubusercontent.com/martlin2cz/nanotube-cms/master/screen-nanoadmin-installation.png =300x)

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

### Installation

Instalation is described in INSTALATION.md file.

### Implement plugin

Go to directory `<ROOT>/nanotube-cms/plugins/core/HelloWorld` and take a look how plugins in nanotube works. Clone this directory (you should create new category directory, instead of creating new plugin as core plugin) and - do as you want.

### Updating

Update process is described in INSTALATION.md file.

### Uninstall
Uninstalation is described in INSTALATION.md file.

## Anything?

Contact me!
