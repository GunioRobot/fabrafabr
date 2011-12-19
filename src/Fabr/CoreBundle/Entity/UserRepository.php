<?php

namespace Fabr\CoreBundle\Entity;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findActive()
    {
        return $this->findAll();
    }

    public function findActiveByDepartment($value)
    {
        if (is_array($value) && count($value) == 1)
            $value = array_pop($value);

        if ($value)
        {
            $query = is_array($value)
                ? '
                    SELECT u
                    FROM FabrCoreBundle:User u
                    WHERE u.department IN (:value)
                '
                : '
                    SELECT u
                    FROM FabrCoreBundle:User u
                    WHERE u.department = :value
                ';

            $query = $this->getEntityManager()
                ->createQuery($query)
                ->setParameter('value', $value);
        }
        else
        {
            $query = '
                SELECT u
                FROM FabrCoreBundle:User u
                WHERE u.department IS NULL
            ';

            $query = $this->getEntityManager()->createQuery($query);
        }

        return $query->getResult();
    }
}