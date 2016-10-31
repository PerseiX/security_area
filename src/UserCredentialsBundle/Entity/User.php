<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 10/30/16
 * Time: 11:18 AM
 */

namespace UserCredentialsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package UserCredentialsBundle\Entity
 *
 * @ORM\Entity(repositoryClass="UserCredentialsBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="username", type="string", length=64)
     */
    private $_username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $email;


    /**
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $_password;

    /**
     * @ORM\Column(type="string")
     */
    private $salt;

    /**
     * @ORM\Column(type="string")
     */
    private $roles;

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return array('ROLE_ADMIN');
    }

    /**
     * @return string The password
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @return string The username
     */
    public function getUsername()
    {
       return $this->_username;
    }

    /**
     */
    public function eraseCredentials()
    {
       return "credentials";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
       {
         $this->id = $id;

        return $this;
       }

    /**
     * @param $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->_username = $username;

        return $this;
    }

    /**
     * @param $salt
     * @return $this
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->_password = $password;

        return $this;
    }

    /**
     * @param array $role
     * @return $this
     */
    public function setRoles($role)
    {
        $this->roles = $role;

        return $this;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->_username,
            $this->_password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->_username,
            $this->_password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}
