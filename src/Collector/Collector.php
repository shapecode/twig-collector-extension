<?php

namespace Shapecode\Twig\Extensions\Collector;

/**
 * Class Collector
 *
 * @package Shapecode\Twig\Extensions\Collector
 * @author  Nikita Loges
 */
class Collector
{

    /** @var array */
    protected $collections = [];

    /** @var Collector */
    protected static $instance;

    /**
     */
    protected function __construct()
    {

    }

    /**
     * @return Collector
     */
    public function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Collector();
        }

        return self::$instance;
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $this->collections[$name][] = $value;
    }

    /**
     * @param $name
     *
     * @return string
     */
    public function get($name)
    {
        if (!isset($this->collections[$name])) {
            return '';
        }

        return implode(' ', $this->collections[$name]);
    }
}
