<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 11/2/16
 * Time: 8:07 PM
 */

namespace UserCredentialsBundle\Security\Provider;


use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use UserCredentialsBundle\Entity\User;

class CustomUserProvider implements UserProviderInterface
{

    public function loadUserByUsername($username)
    {
        // TODO: Implement loadUserByUsername() method.
        $user = new User();
        $user->setPassword('$2y$12$gh6A3ysqSkgfjo093f8tduaUIbczLfp229p0uAwnB.65sC8so4HMy');
        $user->setUsername("kamil");
        $user->setEmail("email");

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        // TODO: Implement supportsClass() method.
        return $class === 'UserCredentialsBundle\Entity\User';
    }
}