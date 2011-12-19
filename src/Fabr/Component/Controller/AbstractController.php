<?php

namespace Fabr\Component\Controller;

use Fabr\Component\Registry\RegistryInterface;
use \Symfony\Component\HttpFoundation\Request;

abstract class AbstractController
{
    /**
     * @var \Fabr\Component\Registry\RegistryInterface
     */
    private $registry;

    /**
     * @return \Fabr\Component\Registry\RegistryInterface
     */
    protected function getRegistry()
    {
        return $this->registry;
    }

    /**
     * @param \Fabr\Component\Registry\RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @abstract
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    abstract function execute(Request $request);
}