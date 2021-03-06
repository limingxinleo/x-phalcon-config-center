<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Config;

use Tests\TestCase;
use Xin\Phalcon\Config\Center\Client;

class BaseTest extends TestCase
{
    public function testNameCase()
    {
        $this->assertEquals('app', Client::getInstance()->get('app')->name);
        $this->assertEquals('data', Client::getInstance()->get('data')->name);
        $this->assertEquals('dbs.db1', Client::getInstance()->get('dbs.db1')->name);
        $this->assertEquals('dbs.db2', Client::getInstance()->get('dbs.db2')->name);
        $this->assertEquals('dbs.db2', Client::getInstance()->get('dbs.db2')->name);
        $this->assertEquals('dbs.redis', Client::getInstance()->get('dbs.redis')->name);
    }

    public function testOffsetGetCase()
    {
        $this->assertEquals('dbs.db2', Client::getInstance()->get('dbs.db2')['name']);
    }

    public function testMacroCase()
    {
        Client::macro('getAppValue', function ($key) {
            return Client::getInstance()->get('app')->$key;
        });

        $this->assertEquals('app', Client::getInstance()->getAppValue('name'));
    }

    public function testIniArrayCase()
    {
        $arr = Client::getInstance()->get('data')->array->test;
        $this->assertEquals([1, 'Thanks'], $arr->toArray());
    }
}
