<?php

namespace App\Modules;

use Slim\App;
use App\Helpers\Enforcer;

abstract class AModule implements IModule
{
	protected $container;
    protected $app;

    protected $loaded = false;

    public function __construct() {
    	$c = get_called_class();
        if (!$c::MODULE_NAME)
        {
            throw new \Exception('Constant MODULE_NAME is not defined on subclass ' . get_class($c));
        }
    }

    public function initialization(App $app)
    {
        $this->container = $app->getContainer();
        $this->app = $app;
    }

    public function afterInitialization()
    {
        $this->loaded = true;
    }

    public function isInitModule()
    {
        return (bool) $this->loaded;
    }

    public static function getName()
    {
        return static::MODULE_NAME;
    }

    public function checkRequireModule(array $arr = [])
    {}

    public function installModule()
    {}

    public function uninstallModule()
    {}

    public function registerRoute()
    {}

    public function registerMiddleware()
    {}

    public function registerDi()
    {}
}