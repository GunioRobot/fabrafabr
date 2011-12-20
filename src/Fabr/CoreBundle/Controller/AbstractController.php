<?php

namespace Fabr\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fabr\CoreBundle\Entity\User;

/**
 * @method \Symfony\Component\HttpFoundation\Request getRequest
 */
abstract class AbstractController extends Controller
{
    /**
     * @return \Fabr\CoreBundle\Entity\User
     */
    public function getUser()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        return $user instanceof User ? $user : null;
    }

    /**
     * @return \Fabr\CoreBundle\Entity\UserRepository
     */
    public function getUserRepository()
    {
        return $this->getDoctrine()->getRepository('FabrCoreBundle:User');
    }

    /**
     * @return \Fabr\CoreBundle\Entity\DepartmentRepository
     */
    public function getDepartmentRepository()
    {
        return $this->getDoctrine()->getRepository('FabrCoreBundle:Department');
    }
}
