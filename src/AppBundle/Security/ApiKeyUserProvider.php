<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 18.02.16
 * Time: 19:10
 */

namespace AppBundle\Security;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiKeyUserProvider implements UserProviderInterface
{
    /** @var  EntityManager $em */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getUsernameForApiKey($apiKey)
    {
        // Look up the username based on the token in the database, via
        // an API call, or do something entirely different
        $username = $this->em->getRepository('AppBundle:User')
            ->findOneBy(['apiKey' => $apiKey])->getUsername();

        if (!$username) {
            throw new UsernameNotFoundException(sprintf("User '%s' not found.", $username));
        }

        return $username;
    }

    public function loadUserByUsername($username)
    {
        $user = $this->em->getRepository('AppBundle:User')
            ->findOneBy(array('email' => $username));

        return $user;
        /*return new User(
            $username,
            null,
            // the roles for the user - you may choose to determine
            // these dynamically somehow based on the user
            'ROLE_USER'
        );*/
    }

    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return 'Symfony\Component\Security\Core\User\User' === $class;
    }
}
