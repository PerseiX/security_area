<?php

namespace UserCredentialsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('UserCredentialsBundle:Default:index.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
var_dump($this->getUser());
        var_dump($authenticationUtils->getLastAuthenticationError());
//        var_dump($this->getDoctrine()->getRepository("UserCredentialsBundle:User")->loadUserByUsername($request->get('username')));
        return $this->render('UserCredentialsBundle:Default:login.html.twig');
    }
}
