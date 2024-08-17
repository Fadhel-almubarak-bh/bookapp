
# BookApp Package

## Overview

This package is designed to manage books, authors, categories, and locations. It provides a set of models, controllers, views, and migrations to help you easily manage your library of books in a Laravel application. 

## Installation
**1. Add the following part to composer.json:** 
>```
>"repositories": [
>    {
>        "type": "vcs",
>        "url": "https://github.com/Fadhel-almubarak-bh/bookapp.git"
>    }
>]
>```
**2. Run the following command in terminal in main directory of the package:**
>```
>composer require xs4arabia/bookapp
>```
**3. Run the following command in terminal to migrate database:**
>```
>php artisan migrate
>```
## Use Publish Tags

This is a Laravel composer package that contains multiple tags to get the resources needed to upgrade and customize App.


Run the following command in terminal in the main directory of the App

**To get migrations files of database:**
>```
>php artisan vendor:publish --tag=bookapp-migrations
>```
**To get Views:**
>```
>php artisan vendor:publish --tag=bookapp-views
>```
**To get Models:**
>```
>php artisan vendor:publish --tag=bookapp-models
>```
**To get Controllers:**
>```
>php artisan vendor:publish --tag=bookapp-controlelrs
>```
**To get Routes:**
>```
>php artisan vendor:publish --tag=bookapp-routes
>```
**To get all publish without controlelrs and models:**
>```
>php artisan vendor:publish --tag=bookapp
>```
>OR
>```
>php artisan vendor:publish --tag=laravel-assets
>```

## Usage
   

After installation and setup, you can access the following functionalities:

- Manage Authors: Create, edit, view, and delete authors.
- Manage Books: Create, edit, view, and delete books.
- Manage Categories: Create, edit, view, and delete categories.
- Manage Locations: Create, edit, view, and delete locations.

Also, the web view will work automatically.

**The tree of the package**

url

├── books

│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── <book id>

│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── edit

├── authors

│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── <author id>

│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── edit

├── categories

│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── <category id>

│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── edit

└── locations

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── <location id>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── edit




