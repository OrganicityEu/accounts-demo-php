# OrganiCity Accounts - PHP Demo

This repository shows, how the [Organicity Accounts](http://accounts.organicity.eu/) can be used with the [oauth2-client](https://github.com/thephpleague/oauth2-client) for [PHP](https://php.net).

The example

* uses the [oauth2-client](https://github.com/thephpleague/oauth2-client)
* uses the *Authorization Code Flow*
* decodes and verifies [JWT tokens](https://jwt.io/) with [php-jwt](firebase/php-jwt)

## Getting started

### Ubuntu 14.04

* Requirements: Apache with PHP5 is installed:

```
cd /var/www/html/
git clone git@github.com:OrganicityEu/accounts-demo-php.git
cd accounts-demo-php
composer install
```

Open: http://localhost/accounts-demo-php