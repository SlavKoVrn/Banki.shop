<h2 align="center">Тестовое задание</h2>
<div class=WordSection1>

<h4 align="center">Разработать прототип хостинга изображений.</h4>
<p class=MsoNormal>Инструменты для реализации задания:</p>

<p class=MsoNormal>- <span class=SpellE>фреймворк</span> <span class=SpellE>Laravel</span>/Yii2</p>

<p class=MsoNormal>- <span class=SpellE>mysql</span></p>

<h5 align="center">1. Реализовать форму для загрузки изображений.</h5>

<p class=MsoNormal>При загрузке изображений должны соблюдаться следующие
правила:</p>

<p class=MsoNormal>- в 1 запрос, в одной форме, можно загружать до 5 файлов</p>

<p class=MsoNormal>- название каждого файла должно <span class=SpellE>транслителироваться</span>
на английский язык и приводиться к нижнему регистру</p>

<p class=MsoNormal>- название каждого файла должно быть уникальным, и, если
файл с таким названием существует, нужно задавать новому файлу уникальное
название</p>

<p class=MsoNormal>- все файлы должны отправляться в одну директорию</p>

<p class=MsoNormal>- записывать в БД инфу о загруженных файлах: название файла,
дата и время загрузки</p>

<h5 align="center">2. Реализовать страницу просмотра информации об
                   изображениях.</h5>

<p class=MsoNormal>На странице должны быть реализованы:</p>

<p class=MsoNormal>- вывод информации о загруженных файлах (название файла,
дата и время загрузки)</p>

<p class=MsoNormal>- просмотр превью изображения</p>

<p class=MsoNormal>- возможность просмотра оригинального изображения</p>

<p class=MsoNormal>- сортировка по названию/дате и времени загрузки изображения</p>

<p class=MsoNormal>- возможность скачать файл в <span class=SpellE>zip</span>
архиве</p>

<h5 align="center">3. Реализовать API</h5>

<p class=MsoNormal>- вывод информации о загруженных файлах в <span
class=SpellE>json</span></p>

<p class=MsoNormal>- получить данные о загруженном файле по <span class=SpellE>id</span>
в <span class=SpellE>json</span></p>

<p class=MsoNormal>Код задания необходимо выложить на <span class=SpellE>github</span>/<span
class=SpellE>gitlab</span>/<span class=SpellE>bitbucket</span>.</p>

<p class=MsoNormal>Бонусом будет возможность просмотра результата в общем
доступе (<span class=GramE>например</span> <span class=SpellE>vds</span>)</p>

</div>
<h2 align="center">Демо версия</h2>
<a href="http://banki.shop.kadastrcard.ru/admin" target="_blank">http://banki.shop.kadastrcard.ru/admin</a>

```
логин:admin
пароль:123456
```

<h2 align="center">API</h2>

<a href="http://banki.shop.kadastrcard.ru/api" target="_blank">http://banki.shop.kadastrcard.ru/api - LIST images</a><br/>
<a href="http://banki.shop.kadastrcard.ru/api?page=2" target="_blank">http://banki.shop.kadastrcard.ru/api?page=2 - LIST page 2 images</a><br/>
<a href="http://banki.shop.kadastrcard.ru/api?sort=name" target="_blank">http://banki.shop.kadastrcard.ru/api?sort=name - LIST images SORT BY name</a><br/>
<a href="http://banki.shop.kadastrcard.ru/api?sort=-name" target="_blank">http://banki.shop.kadastrcard.ru/api?sort=-name - LIST images SORT BY name DESC</a><br/>
<a href="http://banki.shop.kadastrcard.ru/api?sort=datetime" target="_blank">http://banki.shop.kadastrcard.ru/api?sort=datetime - LIST images SORT BY datetime</a><br/>
<a href="http://banki.shop.kadastrcard.ru/api?sort=-datetime" target="_blank">http://banki.shop.kadastrcard.ru/api?sort=-datetime - LIST images SORT BY datetime DESC</a><br/>
<a href="http://banki.shop.kadastrcard.ru/api/image/2" target="_blank">http://banki.shop.kadastrcard.ru/api/image/2 - VIEW 2 image</a>

<h2 align="center">Тесты</h2>

<h4 align="center">Установка</h4>

```
composer require codeception/module-rest
composer require codeception/module-phpbrowser
/vendor/codeception/module-phpbrowser/src/Codeception/Module/PhpBrowser.php
строка 127
заменить
    public ?AbstractBrowser $client = null;
на
    public $client = null;
php vendor/bin/codecept build
```

<h4 align="center">Запуск</h4>

```
php -d display_errors=0 vendor/bin/codecept run -- backend/tests/functional/UploadCest
php -d display_errors=0 vendor/bin/codecept run -- backend/tests/functional/ApiCest
```

<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](https://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![build](https://github.com/yiisoft/yii2-app-advanced/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-advanced/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
