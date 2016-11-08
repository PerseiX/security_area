<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 11/8/16
 * Time: 11:03 PM
 */

namespace UserCredentialsBundle\Security\Authentication\Manager;


use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use UserCredentialsBundle\Security\Authentication\Provider\CustomAuthenticationProvider;

class CustomAuthenticationManager implements AuthenticationManagerInterface
{
    /**
     * @var CustomAuthenticationProvider
     */
    private $provider;

    /**
     * CustomAuthenticationManager constructor.
     * @param CustomAuthenticationProvider $provider
     */
    public function __construct(CustomAuthenticationProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param TokenInterface $token
     * @return \UserCredentialsBundle\Security\Authentication\Token\CustomToken
     */
    public function authenticate(TokenInterface $token)
    {
        if (!$this->provider->supports($token)) {
            throw new AuthenticationException("The support of Token is invalid!");
        }

        $newToken = $this->provider->authenticate($token);

        if (!$newToken->getUser()->isEnabled()) {
            throw new AuthenticationException("The found user is disabled!");
        }

        $newToken->setAuthenticated(true);

        return $newToken;
    }
}