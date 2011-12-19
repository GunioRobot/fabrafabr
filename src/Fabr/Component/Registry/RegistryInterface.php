<?php

namespace Fabr\Component\Registry;

interface RegistryInterface
{
    /**
     * @abstract
     * @return \Fabr\CoreBundle\Entity\UserRepository
     */
    public function getUserManager();

    /**
     * @abstract
     * @return \Fabr\CoreBundle\Entity\DepartmentRepository
     */
    public function getDepartmentManager();

    /**
     * @abstract
     * @return \Exception
     */
    public function getNotFoundException();
}