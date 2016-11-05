<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 11/5/16
 * Time: 2:56 PM
 */

namespace UserCredentialsBundle\Security\Provider;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use UserCredentialsBundle\Entity\User;

class UserProvider implements UserProviderInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * UserProvider constructor.
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * @param string $username
     * @return User
     */
    public function loadUserByUsername($username)
    {
        /** @var User */
        $user = $this->om->getRepository('UserCredentialsBundle:User')->findOneBy(['_username' => $username]);

        if ($user) {
            return $user;
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    /**
     * @param UserInterface $user
     * @return User
     */
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
        return $class === 'UserCredentialsBundle\Entity\User';
    }
}