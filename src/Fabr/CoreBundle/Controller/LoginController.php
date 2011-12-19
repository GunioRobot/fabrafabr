<?php

namespace Fabr\CoreBundle\Controller;

use Fabr\Component\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class LoginController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function execute(Request $request)
    {
        $session = $request->getSession();

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)
                ? $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR)
                : $session->get(SecurityContext::AUTHENTICATION_ERROR)
        );
    }
}
