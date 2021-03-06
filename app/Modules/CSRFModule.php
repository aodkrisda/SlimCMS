<?php

namespace App\Modules;

use Slim\Csrf\Guard;
use Slim\App;
use App\Middleware\CSRFMiddleware;

class CSRFModule extends AModule
{
    const MODULE_NAME = 'csrf';

    public function initialization(App $app)
    {
        parent::initialization($app);
    }

    public function registerDi()
    {
    	$this->container['csrf'] = function ($c) {
		    return new Guard;
		};
    }

    public function registerMiddleware()
    {
    	$this->app->add(new CSRFMiddleware());
    }
}
