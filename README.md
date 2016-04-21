Form designer for SkeekS CMS
===================================

The module provides an opportunity to collect a variety of forms through the admin panel. Manage elemntov order forms, and views. Configure whom to notify.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist skeeks/cms-module-form2 "*"
```

or add

```
"skeeks/cms-module-form2": "*"
```

Configuration app
----------

```php

'components' =>
[
    'cmsMarketplace' =>
    [
        'class' => '\skeeks\cms\marketplace\CmsMarketplaceComponent',
    ],
    'i18n' => [
        'translations' =>
        [
            'skeeks/marketplace' => [
                'class'             => 'yii\i18n\PhpMessageSource',
                'basePath'          => '@skeeks/cms/marketplace/messages',
                'fileMap' => [
                    'skeeks/marketplace' => 'main.php',
                ],
            ]
        ]
    ],
],
'modules' =>
[
    'cmsMarketplace' => [
        'class'         => 'skeeks\cms\marketplace\CmsMarketplaceModule',
    ]
]

```

SkeekS CMS Marketplace
----------

[Page on SkeekS CMS Marketplace](http://marketplace.cms.skeeks.com/solutions/podderjka-klientov/obratnaya-svyaz/12-konstruktor-web-form-2)

___

> [![skeeks!](https://gravatar.com/userimage/74431132/13d04d83218593564422770b616e5622.jpg)](http://skeeks.com)  
<i>SkeekS CMS (Yii2) — quickly, easily and effectively!</i>  
[skeeks.com](http://skeeks.com) | [en.cms.skeeks.com](http://en.cms.skeeks.com) | [cms.skeeks.com](http://cms.skeeks.com) | [marketplace.cms.skeeks.com](http://marketplace.cms.skeeks.com)


