Yii2 Mailer
===========
A custom modular mailer extension for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist tmukherjee13/yii2-mailer "*"
```

or add

```
"tmukherjee13/yii2-mailer": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
$emailReset = new \tmukherjee13\mailer\ResetPassword(array(
            'user' => Yii::$app->user->identity,
            'hash' => 'asdfas56ads1f1asdfdf',
            /* other dynamic data for email */
        ));
        $emailReset->send();```