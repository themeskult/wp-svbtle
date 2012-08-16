# Wordpress plugin: a theme updater for GitHub-hosted Wordpress themes

Do you wish that you could somehow get update notifications within WordPress for _custom_ themes that you use for your site? Perhaps a custom theme that you had developed specifically for your site? Or a theme you developed for a client site?  And do you wish you could do "automatic updates" to those custom themes just like you can for _public_ themes available from WordPress.org?

This WordPress plugin lets you host a custom theme in a Github _public_ repository (private repos are not supported) and then notify sites when a new version of the theme is available.  Those sites can then perform an auto-update just as with publicly available themes.  The plugin also allows you to roll back to a previous version of the theme.

This plugin works with WordPress in both a standalone and MultiSite mode and has been tested up to WordPress 3.3.x.  It can be found in the WordPress plugin directory at:

* http://wordpress.org/extend/plugins/theme-updater/

Bugs, feature requests or other suggestions should be filed as [issues at the plugin's Github repository](https://github.com/UCF/Theme-Updater/issues)

## Screenshots

![Screenshot One](https://github.com/UCF/Theme-Updater/raw/master/screenshot-1.png)  

---

![Screenshot Two](https://github.com/UCF/Theme-Updater/raw/master/screenshot-2.png)  

---

![Screenshot Three](https://github.com/UCF/Theme-Updater/raw/master/screenshot-3.png)  

---

## Installation

[Here](https://github.com/UCF/Theme-Updater-Demo) is a sample theme.  [Download (.zip)](https://github.com/UCF/Theme-Updater-Demo/zipball/v1.1.0)

### 1 - Publish your theme to a public GitHub Repository

### 2 - Update Your theme's `style.css`

Add `Github Theme URI` to your `style.css` header, this will be where the plugin looks for updates.  I also recommend using [semantic versioning](http://semver.org/) for the version number. (Note that the version number does _not_ need to start with "v" as shown in the examples below. You can simply use a number such as "1.2.0". You just need to be consistent with how you create version numbers.)

Example header:

    Theme Name: Example  
    Theme URI: http://example.com/  
    Github Theme URI: https://github.com/username/repo
    Description: My Example Theme
    Author: person
    Version: v1.0.0

Push these changes back to the project.

### 3 - Create a new tag and push the change back to the repo

    $ git tag v1.0.0
    $ git push origin v1.0.0

Note, your tag numbers and theme version numbers should match.  If you want to increment the version number, be sure to update and commit your `style.css` prior to creating the new git tag.

### 4 - Upload your modified theme to your WordPress site

Before the plugin can work, your theme with the `Github Theme URI` addition needs to be uploaded to our WordPress site. 

* Create a ZIP file of your theme on your local computer.
* Inside your WordPress admin menu (standalone) or network admin menu (MultiSite) go to the Install Themes panel and click on "Upload".
* Choose your ZIP file and press "Install Now".

Your theme will now be installed inside of WordPress and can be activated for your site.  From this point forward all updates will be installed automatically once the plugin is activated.

### 5 - Download and install the plugin

Inside your WordPress admin menu (standalone) or network admin menu (MultiSite) choose "Add New" under the Plugins menu.  Search for "Theme Updater" and this will bring you to [the plugin's WordPress page](http://wordpress.org/extend/plugins/theme-updater/) where you can install the plugin directly into your WordPress installation. (Alternatively you can visit that page, download the plugin as a zip file and upload it to your WordPress install, but why go through all that work?)

With the plugin installed and activated (it must be network activated on multisite installs) on your site and the theme uploaded, the next time you push a new tag to your Github repository, it will be recognized by the plugin and an update notice will appear in your admin menu.

This is no configuration or settings panel for this plugin.

---

## Updating The Theme

The process of updating your theme and generating auto-update notifications is now simply this:

### 1 - Make your changes to the theme and commit those changes to your local git repository.

### 2 - **IMPORTANT** - Update your `style.css` file with a new version number and commit that change to your local repository.

### 3 - Push your changes to the Github repository

    $ git push origin master

### 4 - Create a new tag and push the change back to the repo

    $ git tag v1.1.0
    $ git push origin v1.1.0

Note, you should use the **identical** number for the tag that you did for a version number in `style.css` in step #2. 

That's it. Now any sites with your theme installed will receive an update notification the next time their WordPress installation checks for updates.

---

## Code Comments

The flow of the plugin is:

### 1 - Get the Theme's Update URI

Code is a mashup of Wordpress source.  I'm looking at:

* [`get_themes()`](http://core.trac.wordpress.org/browser/trunk/wp-includes/theme.php?rev=17978#L249)  
* [`get_theme_data()`](http://core.trac.wordpress.org/browser/trunk/wp-includes/theme.php?rev=17978#L163)


### 2 - Get the github tags

Pull the tags trough the [Repository Refs API](http://develop.github.com/p/repo.html).

### 3 - Notify Worpress of the Update

Publish the update details to the `response` array in the `update_themes` transient, similar to how [Wordpress updates themes](http://core.trac.wordpress.org/browser/trunk/wp-includes/update.php?rev=17978#L188).

## Changelog

*** v1.3.7 - July 23, 2012
* URLencode repo and user names
* Handle Github API errors appropriately

*** v1.3.6 - July 23, 2012
* Fixed [Incorrect Github Project URL Error](https://github.com/UCF/Theme-Updater/issues/22)

### v1.3.5 - July 23, 2012
* [Compabitilty with new Github API](https://github.com/UCF/Theme-Updater/issues/18)
* Updated README to address the following issues: [Installation for MultiSite should mention "Network Activate"](https://github.com/UCF/Theme-Updater/issues/13) and [Docs should mention that there is no configuration or settings panel](https://github.com/UCF/Theme-Updater/issues/15)

### v1.3.4 - February 8, 2012
* Fix to [SSL issue](https://github.com/UCF/Theme-Updater/issues/3). Code by Github user bainternet. Added by Github user danyork.
