<?php

namespace Fabr\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DepartmentController extends AbstractController
{
    /**
     * @Template
     * @return array
     */
    public function viewAction()
    {
        $path = explode('/', $this->getRequest()->get('path'));
        
        $current = null;
        $parent = array();

        $repository = $this->getDepartmentRepository();

        if ($path[0])
        {
            while (!empty($path))
            {
                $current = $repository->findOneActiveByName(
                    array_shift($path),
                    $current ? $current->getId() : null
                );

                if (!$current)
                    throw $this->createNotFoundException();

                if (!empty($path))
                    $parent[] = $current;
            }
        }

        $nested = $repository->findActiveByParent($current);

        $level = $nested;
        $collector = $current ? array_merge(array($current), $nested) : $nested;

        while (!empty($level))
        {
            $level = $repository->findActiveByParent($level);
            $collector = array_merge($collector, $level);
        }

        $repository = $this->getUserRepository();
        $users = $repository->findActiveByDepartment($collector);

        $default = array(
            'title'  => 'Сотрудники',
            'route'  => 'core_department_view',
            'params' => array('path' => null)
        );
        
        $callback = function ($i) {
            return array(
                'title'  => $i->getTitle(),
                'route'  => 'core_department_view',
                'params' => array('path' => $i->getPath())
            );
        };

        return array(
            'users'      => $users,
            'title'      => $current ? $current->getTitle() : $default['title'],
            'submenu'    => array_map($callback, $nested),
            'breadcrumb' => $current
                ? array_merge(array($default), array_map($callback, $parent))
                : array_map($callback, $parent),
        );
    }
}
