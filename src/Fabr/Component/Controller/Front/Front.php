<?php

namespace Fabr\Component\Controller\Front;

use Exception;
use Fabr\Component\Registry\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Parser;

class Front implements FrontInterface
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface
     */
    private $engine;

    /**
     * @var \Fabr\Component\Registry\RegistryInterface
     */
    private $registry;

    /**
     * @var array
     */
    private $map;

    /**
     * @var string
     */
    private $routeKey = '_route';

    /**
     * @var string
     */
    private $formatKey = '_format';

    /**
     * @var string
     */
    private $formatDefault = 'html';

    /**
     * @var string
     */
    private $templateKey = 'template';

    /**
     * @var string
     */
    private $controllerKey = 'controller';

    /**
     * @var string
     */
    private $methodKey = 'method';

    /**
     * @var string
     */
    private $methodDefault = 'execute';

    /**
     * @throws \Exception
     */
    private function notFound()
    {
        throw $this->registry->getNotFoundException();
    }

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $engine
     * @param \Fabr\Component\Registry\RegistryInterface $registry
     * @param string $config
     */
    public function __construct(EngineInterface $engine, RegistryInterface $registry, $config)
    {
        $this->engine = $engine;
        $this->registry = $registry;

        $parser = new Parser();
        $this->map = $parser->parse(file_get_contents($config));
    }

    /**
     * @abstract
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function execute(Request $request)
    {
        $route = $request->attributes->get($this->routeKey);
        $format = $request->attributes->has($this->formatKey)
            ? $request->attributes->get($this->formatKey)
            : $this->formatDefault;

        if (
            !array_key_exists($route, $this->map) ||
            !is_array($this->map[$route]) ||
            !array_key_exists($this->controllerKey, $this->map[$route]) ||
            !array_key_exists($this->templateKey, $this->map[$route]) ||
            !$this->map[$route][$this->templateKey]
        )
            $this->notFound();

        $config = $this->map[$route];
        $controller = new $config[$this->controllerKey]($this->registry);

        $method = array_key_exists($this->methodKey, $config)
            ? $config[$this->methodKey]
            : $this->methodDefault;

        return $this->engine->renderResponse(
            sprintf($config[$this->templateKey], $format),
            $controller->$method($request)
        );

    }
}