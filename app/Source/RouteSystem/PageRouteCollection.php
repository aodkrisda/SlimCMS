<?php

namespace App\Source\RouteSystem;

/**
* 
*/
class PageRouteCollection implements Interfaces\IRouteCollection
{
	protected static $_self;
	protected static $collection = [];

	protected function __construct(){}

	public static function instance(){
		if( !(self::$_self instanceof self) )
			self::$_self = new self();

		return self::$_self;
	}

	public static function add(Interfaces\IRouteResource $resource){
		$info = $resource->getInfo();
		$collectionName = str_replace('/', "_", substr($info['path'], 1));

		self::$collection[$collectionName] = $resource;
	}

	public static function pop(){
		return array_pop(self::$collection);
	}

	public static function flush(){
		self::$collection = [];
	}

	public static function getAll(){
		return self::$collection;
	}

	public static function sort($callable){
		self::$collection = usort(self::$collection, $callable);
		return self::$collection;
	}

	public static function register(\Slim\App $app){
		foreach(self::getAll() as $resource){
			$resource->registerRoute($app);
		}
	}
}