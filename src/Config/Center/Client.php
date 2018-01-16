<?php
// +----------------------------------------------------------------------
// | Client.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

namespace Xin\Phalcon\Config\Center;

use Phalcon\Config;
use Phalcon\Config\Adapter\Ini;
use Symfony\Component\Finder\Finder;
use Xin\Traits\Common\InstanceTrait;

class Client
{
    use InstanceTrait;

    /** @var Config[] */
    public $configs = [];

    // public $exts = [
    //     'php'=>
    // ];

    /**
     * @desc   加载配置文件
     * @author limx
     * @param $dir
     */
    public function load($dir)
    {
        /** @var Finder $finder */
        $finder = Finder::create()->files()->in($dir);

        foreach ($finder as $file) {
            $path = $file->getRealPath();
            $name = $file->getRelativePathname();
            $ext = $file->getExtension();
            $key = str_replace(".{$ext}", "", $name);
            $key = str_replace("/", ".", $key);
            $this->initConfig($key, $path, $ext);
        }
    }

    /**
     * @desc   初始化配置
     * @author limx
     * @param $key  配置KEY
     * @param $path 配置地址
     * @param $ext  配置扩展名
     */
    public function initConfig($key, $path, $ext)
    {
        switch ($ext) {
            case 'php':
                $config = include $path;
                $this->configs[$key] = new Config($config);
                break;
            case 'ini':
                $this->configs[$key] = new Ini($path, INI_SCANNER_NORMAL);
        }
    }

    public function flush()
    {
        $this->configs = [];
    }

    /**
     * @desc   获取到某个配置文件
     * @author limx
     * @param $key 配置文件的KEY
     * @return Config
     * @throws ConfigCenterException
     */
    public function get($key)
    {
        if (!isset($this->configs[$key])) {
            throw new ConfigCenterException('配置不存在');
        }

        return $this->configs[$key];
    }
}
