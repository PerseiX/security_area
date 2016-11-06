<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 11/6/16
 * Time: 10:12 PM
 */

namespace UserCredentialsBundle\Security\Authentication\Token;


use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class CustomToken extends AbstractToken
{
    private $createdAt;

    /**
     * CustomToken constructor.
     * @param array $roles
     */
    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        $this->setAuthenticated(count($roles) > 0);
    }

    /**
     * @return string
     */
    public function getCredentials()
    {
        return "";
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}