Hey!
I've made a library package for laravel6/7 users. This package can be useful for UK based companies.

This is a [_takepayments_] payment gateway which is not available from their website. So, I decided to make it as a library for laravel users. I'm  trying to develope it under MIT license.

`composer require svodya/payzone`

All you need to pass your data to _cart_ `Session('cart')`

Publish your required files as follows:

To publish Configuration file

`php artisan vendor:publish --tag=config`

To publish Assets

`php artisan vendor:publish --tag=public --force`
