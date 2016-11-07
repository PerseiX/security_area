<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 11/6/16
 * Time: 10:16 PM
 */

namespace UserCredentialsBundle\Security\Firewall;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use UserCredentialsBundle\Security\Authentication\Token\CustomToken;

class CustomAuthenticationListener implements ListenerInterface
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var AuthenticationManagerInterface
     */
    protected $authenticationManager;

    /**
     * CustomAuthenticationListener constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param AuthenticationManagerInterface $authenticationManager
     */
    public function __construct(TokenStorageInterface $tokenStorage, AuthenticationManagerInterface $authenticationManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->authenticationManager = $authenticationManager;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $username = $request->query->get('username');
        $requestToken = $request->query->get('token');

        $token = new CustomToken();
        if($username){
            $token->setUser($username);
            $token->setToken($requestToken);
            $dataTime = new DateTime();

            $token->setCreatedAt($dataTime->format);
            $token->setExpirationDate($dataTime->format);
        }
        try{
            $authenticationToken = $this->authenticationManager->authenticate($token);
            $this->tokenStorage->setToken($authenticationToken);

            return;
        }
        catch(AuthenticationException $e)
        {
           var_dump($e->getMessage());
        }

        $response = new Response();
        $response->setStatusCode(Response::HTTP_FORBIDDEN);
        $event->setResponse($response);
    }
}