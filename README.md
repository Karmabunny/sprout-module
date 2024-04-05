SproutCMS 4 Module Template
===========================

SproutCMS is a flexible and feature rich cms and application framework, developed in PHP,
designed to enable quick and agile custom development. SproutCMS was built to reward
innovation and encourage developers to produce complex applications.
It is built by developers, for developers.


This a _module template_ project for Sprout 4. It provides a sample module as a Composer package to be loaded into your Sprout project.


Getting started
---------------

```sh
composer create-project sproutcms/module my-module
```

Now update the `composer.json` file:

1. Update the package name
2. Update (or remove) description + keywords
3. Update the license (optional)
4. Update the namespace (recommended)

_Note:_ when updating the namespace, be sure to also update the namespaces in the sample 'Demo' module.


### Usage

Install this into your project by publishing the package or with a local or VCS repository:

```json
{
    "repositories": [{
        "type": "vcs",
        "url": "https://github.com/user/my-module"
    }]
}
```


### Patch Locals

This tool will symlink sibling folders as package into a project. This is great for fast development across multiple packages. The `sproutcms/site` package has an example configuration for this.


### Multiple Modules

It's possible to house more than one Sprout module in the same Composer package. One can configure multiple namespaces or simply create multiple module classes.

