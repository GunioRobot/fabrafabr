<?php

namespace Fabr\CoreBundle\Controller;

use Fabr\Component\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function execute(Request $request)
    {
        return array();
    }
}
