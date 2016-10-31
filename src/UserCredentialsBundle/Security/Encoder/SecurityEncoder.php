<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 10/27/16
 * Time: 7:18 PM
 */

namespace UserCredentialsBundle\Security\Encoder;

use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class SecurityEncoder extends BasePasswordEncoder
{

    public function encodePassword($raw, $salt)
    {
        if ($this->isPasswordTooLong($raw)) {
            throw new BadCredentialsException('Invalid password.');
        }
        var_dump("dupa"); die;
        // ...
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        if ($this->isPasswordTooLong($raw)) {
            return false;
        }
    }
}