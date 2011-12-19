<?php

namespace Fabr\CoreBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Fabr\CoreBundle\Entity\User;

class UserFixture extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $user = new User();
        $user->setCreatedAt(new DateTime());
        $user->setDepartment($this->getReference('department:rnd'));
        $user->setFirstname('Максим');
        $user->setMidname('Сергеевич');
        $user->setLastname('Пряхин');
        $user->setEmail('m.pryakhin@gmail.com');
        $user->setPassword('123');

        $manager->persist($user);
        $this->addReference('user:' . $user->getUsername(), $user);

        $user = new User();
        $user->setCreatedAt(new DateTime());
        $user->setDepartment($this->getReference('department:it'));
        $user->setFirstname('Алексей');
        $user->setMidname('Викторович');
        $user->setLastname('Александров');
        $user->setEmail('cherep86@gmail.com');
        $user->setPassword('123');

        $manager->persist($user);
        $this->addReference('user:' . $user->getUsername(), $user);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}