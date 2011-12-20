<?php

namespace Fabr\CoreBundle\Entity;

use DateTime;

class Department
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \Fabr\CoreBundle\Entity\Department
     */
    private $parent;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setName($value)
    {
        $this->name = $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setTitle($value)
    {
        $this->title = $value;
    }

    /**
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param \DateTime $value
     */
    public function setCreatedAt(DateTime $value)
    {
        $this->createdAt = $value;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \Fabr\CoreBundle\Entity\Department $value
     */
    public function setParent(Department $value)
    {
        $this->parent = $value;
    }

    /**
     * @return \Fabr\CoreBundle\Entity\Department
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function getPath()
    {
        $parent = $this->getParent();
        return ($parent ? $parent->getPath() . '/' : '') . $this->getName();
    }
}