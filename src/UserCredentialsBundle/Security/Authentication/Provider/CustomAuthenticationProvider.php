<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 11/6/16
 * Time: 10:24 PM
 */

namespace UserCredentialsBundle\Security\Authentication\Provider;


use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use UserCredentialsBundle\Security\Authentication\Token\CustomToken;


class CustomAuthenticationProvider implements  AuthenticationProviderInterface
{
    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var CacheItemPoolInterface
     */
    private $cachePool;

    /**
     * CustomAuthenticationProvider constructor.
     * @param UserProviderInterface $userProvider
     * @param CacheItemPoolInterface $cachePool
     */
    public function __construct(UserProviderInterface $userProvider, CacheItemPoolInterface $cachePool)
    {
        $this->userProvider = $userProvider;
        $this->cachePool = $cachePool;
    }

    /**
     * @param TokenInterface $token
     * @return CustomToken
     */
    public function authenticate(TokenInterface $token)
    {
        /** @var $user \UserCredentialsBundle\Entity\User */
        /** @var $token \UserCredentialsBundle\Security\Authentication\Token\CustomToken */
        $user = $this->userProvider->loadUserByUsername($token->getUsername());

        if($user && $token->getToken() == $user->getToken())
        {
            $authenticatedToken = new CustomToken($user->getRoles());
            $authenticatedToken->setUser($user);

            return $authenticatedToken;
        }
        throw new AuthenticationException('The Custom authentication failed.');
    }

    /**
     * @param TokenInterface $token
     * @return bool
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof CustomToken;
    }
}