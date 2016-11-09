<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 11/9/16
 * Time: 9:03 AM
 */

namespace UserCredentialsBundle\Security\Authentication\Checker;


use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;

class CustomUserChecker implements UserCheckerInterface
{
    /**
     * @param UserInterface $user
     * @throws AccountExpiredException
     */
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof \UserCredentialsBundle\Entity\User) {
            return;
        }

        if (!$user->isEnabled()) {
            throw new AccountExpiredException("User is disabled");
        }

        if (!$user->isAccountNonExpired()) {
            throw new AccountExpiredException("User is expired!");
        }

        if (!$user->isAccountNonLocked()) {
            throw new AccountExpiredException("User is locked");
        }

        if (!$user->isCredentialsNonExpired()) {
            throw new AccountExpiredException("User credentials is expired");
        }
    }

    /**
     * @param UserInterface $user
     * @throws AccountExpiredException
     */
    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof \UserCredentialsBundle\Entity\User) {
            return;
        }

        if (!$user->isEnabled()) {
            throw new AccountExpiredException("User is disabled");
        }
    }
}