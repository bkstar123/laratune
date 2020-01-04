# laratune    
> A lightweight Laravel package provides a capability of tuning application database-persistent key/value settings

## 1. Requirements  

It is recommended to install this package with PHP version 7.1.3+ and Laravel Framework version 5.6+ 

## 2. Installation
    composer require bkstar123/laratune

Run ```php artisan migrate``` to create **settings** table for storing key/value settings.

## 3. Usage

```php
<?php
Setting::get('sitename', 'Default Site Name'); // same result as config('settings.sitename', 'Default Site Name')
Setting::set('sitename', 'YourSiteName'); // Define a key & value pair in settings table and load it to config('settings')
Setting::all(); // Get a collection of all records in settings table
Setting::forget('sitename'); // Delete a key & value pair from setting tables and unload it from config('settings')
Setting::purge(); // Truncate settings table and unload the entire config('settings') array
```