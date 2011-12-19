<?php

namespace Fabr\CoreBundle\Entity;

use DateTime;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $midname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \Fabr\CoreBundle\Entity\Department
     */
    private $department;


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
    public function setEmail($value)
    {
        $this->email = $value;
    }

    /**
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $value
     */
    public function setPassword($value)
    {
        $encoder = new MessageDigestPasswordEncoder();
        $this->salt = md5(time());
        $this->password = $encoder->encodePassword($value, $this->salt);
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $value
     */
    public function setFirstname($value)
    {
        $this->firstname = $value;
    }

    /**
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $value
     */
    public function setMidname($value)
    {
        $this->midname = $value;
    }

    /**
     * @return string 
     */
    public function getMidname()
    {
        return $this->midname;
    }

    /**
     * @param string $value
     */
    public function setLastname($value)
    {
        $this->lastname = $value;
    }

    /**
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
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
    public function setDepartment(Department $value)
    {
        $this->department = $value;
    }

    /**
     * @return \Fabr\CoreBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @return void
     */
    public function eraseCredentials()
    {
        
    }

    /**
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return bool
     */
    public function equals(UserInterface $user)
    {
        return md5($this->getUsername()) == md5($user->getUsername());
    }

    public function __sleep()
    {
        return array('email');
    }
}