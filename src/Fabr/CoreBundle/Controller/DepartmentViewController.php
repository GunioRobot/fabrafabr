<?php

namespace Fabr\CoreBundle\Controller;

use Fabr\Component\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DepartmentViewController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function execute(Request $request)
    {
        $departments = explode('/', $request->get('department'));

        $department = null;
        $manager = $this->getRegistry()->getDepartmentManager();

        if (count($departments) == 1 && !$departments[0])
        {
            $departments = $manager->findActiveByParent(null);
        }
        else
        {
            while (!empty($departments))
            {
                $name = array_shift($departments);
                $department = $manager->findOneActiveByName($name, $department ? $department->getId() : null);

                if (!$department)
                    throw $this->getRegistry()->getNotFoundException();
            }

            $departments = array($department);
        }

        $current = $departments;

        while (!empty($current))
        {
            $current = $manager->findActiveByParent($current);
            $departments = array_merge($departments, $current);
        }

        $manager = $this->getRegistry()->getUserManager();
        $users = $manager->findActiveByDepartment($departments);

        return array('department' => $department, 'users' => $users);
    }
}
