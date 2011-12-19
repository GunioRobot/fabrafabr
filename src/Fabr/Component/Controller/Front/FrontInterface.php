<?php

namespace Fabr\Component\Controller\Front;

use \Symfony\Component\HttpFoundation\Request;

interface FrontInterface
{
    /**
     * @abstract
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function execute(Request $request);
}