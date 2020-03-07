# Engage Liverpool WordPress theme

A WordPress theme for engageliverpool.com.

## Local development

If you want to work on this theme, you can preview your changes locally using the included Vagrant VM.

You will need [Vagrant](http://www.vagrantup.com/downloads.html) and [Virtualbox](https://www.virtualbox.org/) installed. For example, on a Mac with [Homebrew](https://brew.sh/), you might run:

    brew cask install virtualbox
    brew cask install vagrant

You will also want to copy `.vagrant.yml.example` to `.vagrant.yml`, and add any required config options.

    cp .vagrant.yml.example .vagrant.yml

Now you can boot up the VM:

    vagrant up

The VM will automatically install WordPress, phpMyAdmin and MailHog, which you can access at:

* WordPress: http://localhost:8000
* phpMyAdmin: http://localhost:3000
* MailHog: http://localhost:8025

WordPress and MySQL usernames and passwords are defined at the top of `provision/provision.sh`.

You can (re)build the CSS stylesheets by running this on the host machine:

    bin/make-css

Or set them to rebuild automatically when changed:

    bin/make-css --watch

You will need [Sass](https://sass-lang.com/) installed. For example, on a Mac with [Homebrew](https://brew.sh/), you might run:

    brew install sass/sass/sass
