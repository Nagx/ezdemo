# eZ Platform Demo - Com to Code

### Why this demo ?
This demo is for Com to Code, based on eZ Platform demo.

Features added:
- User profile page
- User contact page

## Installation

Installation instructions below are for installing a demo installation of eZ Platform in latest version _with_ demo content and demo website.
Full installation documentation is kept current [in the online docs](https://doc.ezplatform.com/en/latest/getting_started/install_using_composer/)
#### Prerequisites

These instructions assume you have already installed:
- PHP _(7.1 or higher)_
- Web Server _(Recommeneded: Apache / Nginx. Use of php's built in development server is also possible)_
- Database server _(MySQL 5.5+)_
- [Composer](https://doc.ezplatform.com/en/latest/getting_started/about_composer/)
- Git _(for development)_

For further information [on requirements see online doc](https://doc.ezplatform.com/en/latest/getting_started/requirements_and_system_configuration/).


#### Install eZ Platform Com to Code (demo distribution)_

Assuming you have prerequisites sorted out, you can get the install up and running with the following commands in your terminal:

``` bash
composer create-project --no-dev --keep-vcs ezsystems/ezplatform-demo
cd ezplatform-demo
composer install

php bin/console ezplatform:install platform-demo
php bin/console kaliop:migration:migrate
```

_Note: If  composer is installed localy instead of globally, the first command will start with `php composer.phar`._

During the installation process you will be asked to input things like database host name, login, password, etc.
They will be placed in `<ezplatform>/app/config/parameters.yml`.

Next you will receive instructions on how to install data into the database, and how to run a simplified dev server using the `bin/console server:run` command.
_Tip: For a more complete and better performing setup using Apache or Nginx, read up on how to [install eZ Platform manually](https://doc.ezplatform.com/en/latest/getting_started/install_manually/)._

When the database is ready, open your `<ezplatform>/app/config/parameters.yml`, add this line :
``` bash
    env(MAILER_HOST): smtp.gmail.com
    env(MAILER_USER): 'yourMail@gmail.com'
    env(MAILER_PASSWORD): 'yourPassword'
```
_Note: If your email account require the two steps authentication, an error will come._
_Make a new address for this demo._

## New or Edited files
- app/config/routing.yml
- app/config/security.yml
- app/Resources/views/themes/tastefulplanet/user/profile.html.twig
- app/Resources/views/themes/tastefulplanet/user/contact.html.twig
- src/AppBundle/Controller/UserProfileController.php
- src/AppBundle/Entity/MailContact.php
- src/AppBundle/Form/Type/MailContactType.php
- src/AppBundle/MigrationVersions/20180916205136_mysql_create-mail-contact-table.sql
- src/AppBundle/Repository/MailContactRepository.php
- src/AppBundle/Resources/config/doctrine/MailContact.orm.yml


## Issue tracker
- missing translations
- user_id not save when email sent
- no support two steps email authentication


## COPYRIGHT
Copyright (C) 1999-2018 eZ Systems AS. All rights reserved.

## LICENSE
http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
