<?php

namespace Fabr\Component\Registry;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Container implements RegistryInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return \Exception
     */
    public function getNotFoundException()
    {
        return new NotFoundHttpException();
    }

    /**
     * @return \Fabr\CoreBundle\Entity\DepartmentRepository
     */
    public function getDepartmentManager()
    {
        return $this->container->get('doctrine')->getEntityManager()->getRepository('FabrCoreBundle:Department');
    }

    /**
     * @abstract
     * @return \Fabr\CoreBundle\Entity\UserRepository
     */
    public function getUserManager()
    {
        return $this->container->get('doctrine')->getEntityManager()->getRepository('FabrCoreBundle:User');
    }
}