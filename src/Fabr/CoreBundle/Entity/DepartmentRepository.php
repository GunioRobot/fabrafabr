<?php

namespace Fabr\CoreBundle\Entity;

use Doctrine\ORM\NoResultException;
use Doctrine\ORM\EntityRepository;

class DepartmentRepository extends EntityRepository
{
    public function findOneActiveByName($name, $parent = null)
    {
        return $this->findOneBy(array('parent' => $parent, 'name' => $name));
    }

    public function findActiveByParent($value)
    {
        if (is_array($value) && count($value) == 1)
            $value = array_pop($value);

        if ($value)
        {
            $query = is_array($value)
                ? '
                    SELECT d
                    FROM FabrCoreBundle:Department d
                    WHERE d.parent IN (:value)
                '
                : '
                    SELECT d
                    FROM FabrCoreBundle:Department d
                    WHERE d.parent = :value
                ';

            $query = $this->getEntityManager()
                ->createQuery($query)
                ->setParameter('value', $value);
        }
        else
        {
            $query = '
                SELECT d
                FROM FabrCoreBundle:Department d
                WHERE d.parent IS NULL
            ';

            $query = $this->getEntityManager()->createQuery($query);
        }

        return $query->getResult();
    }
}