<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render(
            '@App/default/index.html.twig',
            array()
        );
    }
    /**
     * @Route("/secure", name="secured_zone")
     */
    public function securedResourceAction()
    {
        $user = $this->getUser();

        return $this->render(
            '@App/securedarea/securedResource.html.twig',
            array(
                'user'         => $user,
            )
        );

    }
    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            '@App/security/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }
    /**
     * Register
     *
     *
     * @param Request $request
     */
    public function signUpAction(Request $request)
    {
    }
}