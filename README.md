# X-Phalcon-Config-Center

[![Build Status](https://travis-ci.org/limingxinleo/x-phalcon-config-center.svg?branch=master)](https://travis-ci.org/limingxinleo/x-phalcon-config-center)

## 安装
~~~
composer require limingxinleo/x-phalcon-config-center
~~~

## 文件类型支持
- php
- ini

> 其他类型随缘支持

## 使用
~~~php
<?php

use Xin\Phalcon\Config\Center\Client;

$config = Client::getInstance();
$config->load('/your/path/to/config/dir/');

$name = Client::getInstance()->get('app')->name;
~~~