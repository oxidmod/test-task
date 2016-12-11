<?php

namespace TestTask\Services\Container;

class Container extends \Slim\Container
{
    /**
     * @var string
     */
    private $injectionsPath;

    public function __construct(array $values)
    {
        if (!empty($values['injectionsPath'])) {
            $this->injectionsPath = rtrim($values['injectionsPath'], DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }
        parent::__construct($values);
        $this['__PROJECT_ROOT__'] = realpath(__DIR__.'/../../..');
    }

    /**
     * @inheritdoc
     */
    public function __get($name)
    {
        if (!$this->has($name)) {
            $this->loadInjection($name);
        }
        return parent::__get($name);
    }

    /**
     * @inheritdoc
     */
    public function __isset($name)
    {
        if (!$this->has($name)) {
            $this->loadInjection($name);
        }
        return parent::__isset($name);
    }

    /**
     * @inheritdoc
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            $this->loadInjection($id);
        }
        return parent::get($id);
    }

    /**
     * @inheritdoc
     */
    public function has($id)
    {
        if (!parent::has($id)) {
            $this->loadInjection($id);
        }
        return parent::has($id);
    }


    /**
     * Try to load services from injections folder
     *
     * @param string $name
     */
    private function loadInjection(string $name)
    {
        if (null === $this->injectionsPath) {
            return;
        }

        $injectionFile = "{$this->injectionsPath}{$name}.php";
        if (is_readable($injectionFile)) {
            $injection = require_once $injectionFile;
            if (is_callable($injection)) {
                $injection = call_user_func($injection, $this);
            }
            $this[$name] = $injection;
        }
    }

}