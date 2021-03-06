<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\User;
use Mcfedr\JsonFormBundle\Controller\JsonController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ApiUserType;

class ApiController extends JsonController
{
    const LIMIT_PAGE = 10;
    const START_PAGE = 1;

    /**
     * @Route("/api/posts", name="api_posts")
     * @Method("GET")
     */
    public function showAllPostAction(Request $request)
    {
        $page = $request->get('start', self::START_PAGE);
        $limit = $request->get('limit', self::LIMIT_PAGE);
        $start = $page * $limit - $limit;
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')
            ->findAllPost($start, $limit);
        if (!$posts) {
            return new JsonResponse(array('message' => 'Not found posts'), 404);
        }

        return new JsonResponse(array('posts' => $posts), 200);
    }

    /**
     * @Route("/api/posts/{slug}", name="api_posts_id")
     * @Method("GET")
     */
    public function showPostAction($slug)
    {
        $post = $this->getDoctrine()->getRepository('AppBundle:Post')
            ->findOneBy(array('slug' => $slug));

        return new JsonResponse(array('post' => $post));
    }

    /**
     * @Route("/api/posts/search/{data}", name="api_posts_search")
     * @Method("GET")
     */
    public function searchPostAction($data)
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')
            ->search($data);

        return new JsonResponse(array('posts' => $posts));
    }

    /**
     * @Route("/api/users/{id}/posts", name="api_users")
     * @Method("GET")
     */
    public function userPostAction($id)
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')
            ->findBy(['author' => $id]);

        return new JsonResponse(['posts' => $posts]);
    }

    /**
     * @Route("/api/users/my/posts", name="api_users")
     * @Method("GET")
     */
    public function userMyPostAction()
    {
        $user = $this->getUser();
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')
            ->findBy(['author' => $user]);

        return new JsonResponse(['posts' => $posts]);
    }

    /**
     * @Route("/api/login", name="api_login")
     * @Method("POST")
     */
    public function loginAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(ApiUserType::class, $user);
        $this->handleJsonForm($form, $request);
        if ($form->isValid()) {
            $username = $em->getRepository('AppBundle:User')
                ->findOneBy(array('email' => $user->getUsername()));
            if (!$username) {
                return new JsonResponse(array('message' => 'Not valid email'), 400);
            }
            $pass = $user->getPlainPassword();
            if ($this->get('security.password_encoder')->isPasswordValid($username, $pass)) {
                return new JsonResponse(array('user' => $username,'apiKey' => $username->getApiKey()), 200);
            }

            return new JsonResponse(array('message' => 'Not valid password'), 400);

        }

        return new JsonResponse(array('message' => 'Not valid fields', 400));

    }
}
