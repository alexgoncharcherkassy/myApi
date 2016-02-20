<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("@App/default/index.html.twig")
     */
    public function indexAction()
    {
       return [];
    }
    /**
     * @Route("/secure", name="secured_zone")
     * @Template("@App/securedarea/securedResource.html.twig")
     */
    public function securedResourceAction()
    {
        $user = $this->getUser();
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')
            ->findAll();

        return ['user' => $user,
                'posts' => $posts
        ];

    }
    /**
     * @Route("/login", name="login_route")
     * @Template("@App/security/login.html.twig")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return [
                'last_username' => $lastUsername,
                'error'         => $error,
        ];
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