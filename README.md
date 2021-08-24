# Laravel-Plates

A Laravel driver for the powerful native PHP templating system [Plates](http://platesphp.com).

## Folder Structure

- **`config`**: Folder containing the package settings
- **`src`**: Folder containing the package classes

### Requirements

- **PHP 7.3** or higher
- **Composer**

## Installation

1. Add the following line to the `require` section of your `composer.json`:

    ```shell
    "millieofzo/laravel-plates": "dev-master"
    ```
   
2. Or install the package with composer

    ```shell
    composer require millieofzo/laravel-plates
    ```
3. Next, run `composer install` to actually install the package.

4. Register the service provider

In your Laravel application, edit the `app/config/app.php` file and add this
line to the `providers` array:

  ```shell
    'MillieOfzo\Plates\PlatesServiceProvider',
  ```

5. Publish the config

    ```shell
    php artisan vendor:publish --provider="MillieOfzo\Plates\PlatesServiceProvider" --tag="config"
    ```