<?php

namespace Fabr\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    /**
     * @Template
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function loginAction(Request $request)
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
