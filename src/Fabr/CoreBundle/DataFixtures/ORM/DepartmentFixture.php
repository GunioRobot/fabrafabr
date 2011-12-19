<?php

namespace Fabr\CoreBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Fabr\CoreBundle\Entity\Department;

class DepartmentFixture extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $department = new Department();
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Отдел по работе с клиентами');
        $department->setName('call');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setParent($this->getReference('department:call'));
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Ключевые клиенты');
        $department->setName('vip');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setParent($this->getReference('department:call'));
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Организаторы торговых процедур');
        $department->setName('org');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setParent($this->getReference('department:call'));
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Потенциальные плательщики и организаторы');
        $department->setName('potential');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setCreatedAt(new DateTime());
        $department->setTitle('IT отдел');
        $department->setName('it');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setParent($this->getReference('department:it'));
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Тестирование');
        $department->setName('test');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setParent($this->getReference('department:it'));
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Интеграция');
        $department->setName('soap');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setParent($this->getReference('department:it'));
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Экспериментальная разработка');
        $department->setName('rnd');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setParent($this->getReference('department:it'));
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Управление проектами');
        $department->setName('project');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setParent($this->getReference('department:it'));
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Технические писатели');
        $department->setName('editor');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setParent($this->getReference('department:it'));
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Техническая поддержка');
        $department->setName('support');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setCreatedAt(new DateTime());
        $department->setTitle('PR отдел');
        $department->setName('pr');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setCreatedAt(new DateTime());
        $department->setTitle('HR отдел');
        $department->setName('hr');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Административно-хозяйственная часть');
        $department->setName('office');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Администрация');
        $department->setName('top');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Бухгалтерия');
        $department->setName('account');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Группа аналитики');
        $department->setName('analyst');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Отдел развития');
        $department->setName('expansion');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $department = new Department();
        $department->setCreatedAt(new DateTime());
        $department->setTitle('Юридический отдел');
        $department->setName('jury');
        $manager->persist($department);
        $this->addReference('department:' . $department->getName(), $department);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}